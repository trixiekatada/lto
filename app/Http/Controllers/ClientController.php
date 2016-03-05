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
use App\User;
use App\Transactions;
use App\Queue;
use App\ClientInfo;
use App\RegisterLicense;

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

    //customer side
    public function p_login(){
        $input = Input::all();

        $login = User::where('username',Input::get('username'))->where('password', Input::get('password'))->get();

        //login succeded?
       if( count($login) > 0){
            Session::put( 'client_info', $login );
            
            return view( '/client/index' );
        } 
    }

     public function rl_view()
    {   
        //get username from session
        $client_id = Session::get('client_info'); //[0]->client_id;
        $client_id = $client_id[0]->client_id;
        $data = User::find( $client_id );
        return view('client.registerLicense')->with('data',$data);
    }

    public function register(){
        return view('client.register');
    }
    //store transaction
    public function rLicense(Request $request){

        $data = Input::all();

        $rules = array(
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'address' => 'required|string',
                'nationality' => 'required|string',
                'gender' => 'required',
                'birthdate' => 'required|string',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'telno' => 'required|numeric',
                'TOA' => 'required',
                'TLA' => 'required',
                'DSA' => 'required',
                'EA' => 'required',
                'bloodtype' => 'required|string',
                'donor' => 'required|string',
                'civilstatus' => 'required',
                'hair' => 'required',
                'eyes' => 'required',
                'built' => 'required',
                'complexion' => 'required',
                'birth_place' => 'required|string',
                'fathername' => 'required|string',
                'mothername' => 'required|string',
        );

        $validation = Validator::make($data, $rules);
        
        if($validation->passes()) {
            $license = new RegisterLicense;

            $client_info = Session::get('client_info');
            $id = $client_info[0]->client_id;
            $license->client_id = $id;
            $license->first_name = $data['first_name'];
            $license->last_name = $data['last_name'];
            $license->address = $data['address'];
            $license->nationality = $data['nationality'];
            $license->gender = $data['gender'];
            $license->birthdate = $data['birthdate'];
            $license->height = $data['height'];
            $license->weight = $data['weight'];
            $license->telno = $data['telno'];
            $license->TOA = $data['TOA'];
            $license->TLA = $data['TLA'];
            $license->DSA = $data['DSA'];
            $license->EA = $data['EA'];
            $license->bloodtype = $data['bloodtype'];
            $license->donor = $data['donor'];
            $license->civilstatus = $data['civilstatus'];
            $license->hair = $data['hair'];
            $license->eyes = $data['eyes'];
            $license->built = $data['built'];
            $license->complexion = $data['complexion'];
            $license->date = $data['date'];
            $license->birthplace = $data['birth_place'];
            $license->fathername = $data['fathername'];
            $license->mothername = $data['mothername']; 
            $license->save();

            $license_inserted_id = $license->rl_id;
            $license_to_update = RegisterLicense::find($license_inserted_id);
             //qr code
            $qr_code_filename = $license_to_update->rl_id;
            $qr_code_filename = strtolower($qr_code_filename);
            $qr_code_filename = $qr_code_filename.'_'.uniqid().'.png';
            $qr_code_full_filename = base_path().'/images/qrcode/'.$qr_code_filename;
            \QrCode::format('png')->size(250)->generate($license_to_update->rl_id, $qr_code_full_filename);
            $license_to_update->qrcode = $qr_code_full_filename;
            $license_to_update->save();



            return Redirect::to('/intopdfRL/?rl_id='. $license_inserted_id );
        }
        else 
       {
           exit();
           return Redirect::back()
               ->withErrors($validation)
               ->with('flash_error', 'Validation Errors!');
       }
    }

    //convert the form to Pdf
    public function RLtoPDF(){
        
        //get data to generate from url query string
        $id = Input::get('rl_id');
        $data = RegisterLicense::find($id);
     
        $full_name = ucwords($data->first_name.' '.$data->last_name);
        $file_name = 'License Registration - '. $full_name .'.pdf' ;
        
        $pdf = \App::make('dompdf.wrapper');
        $content = '<style type="text/css">
                    .form-style-6{
                        font: 85% Arial, Helvetica, sans-serif;
                        max-width: 800px;
                        margin: 5px auto;
                        padding: 10px;
                        background: #F7F7F7;    
                    }
                    .form-style-6 h1{
                        background: #43D1AF;
                        padding: 20px 0;
                        font-size: 120%;
                        font-weight: 300;
                        text-align: center;
                        color: #fff;
                        margin: -13px -13px 13px -13px;
                    }   
                    .form-style-6 ul{
                        padding:0;
                        margin:0;
                        list-style:none;
                    }
                    .form-style-6 ul li{
                        display: block;
                        margin-bottom: 10px;
                        min-height: 35px;
                        }

                    </style>

                    <!DOCTYPE html> 
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    
                    <div class="form-style-6">
                    <h1>License Registration</h1>
                    <ul>
                        <li>Name: '.$full_name.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                        Present Address: '.$data->address.' </li>

                        <li>Nationality: '.$data->nationality.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        Gender: '.$data->gender.'</li>
                          

                        <li>Birthday: '.$data->birth.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Height: '.$data->height.'</li>

                        <li>Weight: '.$data->weight.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Tel/Cp No: '.$data->telNo.' </li>
                        

                        <li>Type of Application(TOA): '.$data->TOA.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Type of License Applied for(TLA): '.$data->TLA.'</li>

                        <li>Driving Skill Acquired or Will be Acquired Thru(DSA): '.$data->DSA.' 
                           
                        <li>Educational Attainment(EA): '.$data->EA.' </li>
                        

                        <li>Blood Type: '.$data->bloodType.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Organ Donor?: '.$data->donorBoolean.'</li>

                        <li>Civil Status: '.$data->civilStatus.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;
                        Hair: '.$data->hair.' </li>
                        

                        <li>Eyes: '.$data->eyes.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Built: '.$data->built.' </li>

                        <li>Complexion: '.$data->complexion.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;
                        Birt Place: '.$data->birthPlace.' </li>
                        

                        <li>Fathers Name: '.$data->fatherName.' 
                        <li>Mothers Name: '.$data->motherName.' 
                        <li>Date Filed: '.$data->date.'
                        
                 <center><h3>Your QR Code:</h3><img src='.$data->qrcode.'>
                </body>
                </html>';

        
        

        $pdf->loadHTML($content);
        return $pdf->stream( $file_name, array('Attachment' => false));  


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