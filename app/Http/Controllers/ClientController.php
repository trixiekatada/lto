<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;

use Redirect;
use Validator;
use Hash;
use Session;
use Auth;
use View;
use DB;
use App\DateTime;
use Illuminate\Http\Request;

use App\Transactions;
use App\Queue;
use App\ClientInfo;

class ClientController extends Controller {
 
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
  
  	protected $loginPath = 'client/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
	public function __construct(){

	}


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'transaction_id' => 'required|max:255',
            'verification_code' => 'required',            
        ]);
    }

    public function index(){
      
    	return view('client.login');
    }

    public function post_login(){
    	//verify post if transaction is exists
    	//once login insert into tbl_queue

       $input = Input::all();
       //check if we have client info
       $if_client_exists = ClientInfo::where('email', Input::get('email'))->where('password', Hash::make(Input::get('password')) )->get();

       if( count($if_client_exists) > 0 ){
            $if_record_exist = Transactions::where('transactions_id', Input::get('transactionsID'))->where('verification_code', Input::get('verification_code'))->get();

            //if we have found record then enqueue
           if ( count($if_record_exist) > 0 ) {
                //if we have valid transaction then insert in the queue

                //get last queue label inserted
                //this is for the 350 limit per operation day
                $last_queue = Queue::orderBy('queue_id', 'ASC')->first();
                $last_queue_label = $last_queue->queue_label;
                if( $last_queue_label == 50 /* limit per day  */ ){
                    //reset to 0 if reached to 350
                    $new_queue_label = 1;
                } else {
                    $new_queue_label = $last_queue_label + 1;
                }

                $queue = new Queue;
                $queue->transactionID_fk = Input::get('transactionsID');
                $queue->processID_fk = 1;
                $queue->counterID_fk = 1;
                $queue->queue_label = $new_queue_label;             
                $queue->save();

                //display the priority number from the last inserted ID
                $priority_number = $queue->queue_label;

                $data['msg'] = 'Transaction verified <br/> Number: '. $priority_number;
                return view('client.login', $data);
            } else {
                $data['msg'] = 'Transaction unverified, please check your transaction details';
                return view('client.login', $data);
            }


       }


        //get all records from tbl_transactions that will match by the provided information
       /* $if_record_exist = Transactions::where('transactions_id', Input::get('transactionsID'))->where('verification_code', Input::get('verification_code'))->get();

        //if we have found record then enqueue
       if ( count($if_record_exist) > 0 ) {
            //if we have valid transaction then insert in the queue

            //get last queue label inserted
            //this is for the 350 limit per operation day
            $last_queue = Queue::orderBy('queue_id', 'ASC')->first();
            $last_queue_label = $last_queue->queue_label;
            if( $last_queue_label == 50 /* limit per day   ){
                //reset to 0 if reached to 350
                $new_queue_label = 1;
            } else {
                $new_queue_label = $last_queue_label + 1;
            }

            $queue = new Queue;
            $queue->transactionID_fk = Input::get('transactionsID');
            $queue->processID_fk = 1;
            $queue->counterID_fk = 1;
            $queue->queue_label = $new_queue_label;             
            $queue->save();

            //display the priority number from the last inserted ID
            $priority_number = $queue->queue_label;

            $data['msg'] = 'Transaction verified <br/> Number: '. $priority_number;
            return view('client.login', $data);
        } else {
            $data['msg'] = 'Transaction unverified, please check your transaction details';
            return view('client.login', $data);
        }
        */


    }

    public function register(){
        return view('client.register');
    }

    //insert client information
    public function store(Request $request){

        $data = Input::all();

        //validation rule and logic
        $rules = [
            'last_name'=> 'required|string',
            'first_name' => 'required|string',
            'gender'=> 'required|string',
            'birth'=> 'required|string',
            'address'=> 'required',
            'mobile'=> 'required|numeric',
            'email' => 'required|email',
            'client_type' => 'required|string'
        ];

        $messages = [
            'lastname.required'=> 'Should not be empty',
            'lastname.string' => 'Letters only',
            'firstname.required' => 'Should not be empty',
            'firstname.string'=> 'Letters only',
            'gender.required'=> 'Should not be empty',
            'gender.string'  => 'Letters only',
            'birth.required'=> 'Should not be empty',
            'birthdate.date' => 'Date only',
            'address.required' => 'Should not be empty',
            'mobile.required' => 'Should not be empty',
            'email.required' => 'Should not be empty',
            'email.email' => 'Should be email'
        ];

        $validation = Validator::make($data, $rules, $messages);
        if ($validation->passes()) {
          
            //once we have validated insert into tbl_client_info and tbl_transactions
            $client = new ClientInfo;
            $client->first_name= $data['first_name'];
            $client->last_name= $data['last_name'];
            $client->gender= $data['gender'];
            $client->birth= $data['birth'];
            $client->address = $data['address'];
            $client->mobile  = $data['mobile'];
            $client->email = $data['email'];
            $client->client_type = $data['client_type'];
            $client->password = Hash::make($data['password']);
            $client->save();

            //generated verification code and transaction id
            $client_inserted_id = $client->client_id;

            //insert first to get the transaction_id inserted then use it to the qr_code
            $transaction = new Transactions;
            $transaction->clientID_fk = $client_inserted_id;
            $transaction->transaction_type = Input::get('transaction_type');
            //any code as long as it it unique
            $transaction->verification_code = rand(10000, 100000);
            $transaction->save();

            $transaction_inserted_id = $transaction->transactions_id;
            $transaction_to_update = Transactions::find($transaction_inserted_id);

            //qr code
            $qr_code_filename = $transaction_to_update->transactions_id;
            $qr_code_filename = strtolower($qr_code_filename);
            $qr_code_filename = $qr_code_filename.'_'.uniqid().'.png';
            $qr_code_full_filename = base_path().'/images/qrcode/'.$qr_code_filename;
            \QrCode::format('png')->size(250)->generate($transaction_to_update->transactions_id, $qr_code_full_filename);
            $transaction_to_update->qrcode_url = $qr_code_full_filename;
            $transaction_to_update->save();

            

             

             $data['msg'] = 'Registration Complete <br/> Transaction #: '. $transaction_inserted_id . '<br/> Verification code: '. $transaction->verification_code ;
            
            return view('client.register', $data);

            //return Redirect::to('/client/login');
       } 
       else {
            return Redirect::back()->withInput()->withErrors($validation);
       }
    }
   
}