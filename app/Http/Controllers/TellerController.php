<?php

namespace App\Http\Controllers;

use Request;
use App\User;
use App\Counter;
use App\Requests;
use App\AvailableList;
use App\Job;
use App\Http\Controllers\Controller;
use Redirect;
use Validator;
use Hash;
use App\QRCodeReader;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use View;
use DB;
use App\DateTime;
use App\Queue;
use App\ClientInfo;
use App\Transactions;
use App\TransactionType;

class TellerController extends Controller {

    protected $session = array();
    protected $data_view = array();

  public function __construct(){
    //debugging
    DB::enableQueryLog();

    //check if we have session, then redirect appropriately
    if( Session::has('teller_info') ){
      $this->session = Session::get('teller_info');
      $this->data_view['session'] = $this->session;

      //all all how many on queue on that teller
      $queue_pending = Queue::where('counterID_fk', $this->session['counter_id'])
                    ->where('status', 0)
                    ->leftJoin('tbl_transactions', 'transactions_id', '=', 'transactionID_fk')
                    ->leftJoin('tbl_client_info', 'client_id', '=', 'clientID_fk')
                    ->orderBy('queue_id', 'asc')
                    ->orderByRaw('FIELD("client_type", "1,2,0")')
                    ->get();
                 
      //do not display the currently serving queue
      $first = 0; 
      $first_queue = $queue_pending[$first];      
      unset( $queue_pending[$first] );
      //end 

      $this->data_view['queue_pending_details'] = $queue_pending;

      $queue_pending = count($queue_pending);
      $this->data_view['queue_pending'] = $queue_pending;

      //var_dump(DB::getQueryLog());
      //proper labels
      $counter_label = $this->get_counter_labels()[ $this->session->counter_id ];
      $this->data_view['counter_label'] = strtoupper( $counter_label );

      //get the current priority number
      $queue = Queue::where('counterID_fk', '=', $this->session->counter_id)
                    ->where('status', 0)
                    ->leftJoin('tbl_transactions', 'transactions_id', '=', 'transactionID_fk')
                    ->leftJoin('tbl_client_info', 'client_id', '=', 'clientID_fk')
                    ->orderBy('queue_id', 'asc')
                    ->orderByRaw('FIELD("client_type", "1,2,0")')
                    ->limit(1)
                    ->first();

      if( count($queue) > 0 ){   

        $current_serve = $queue->queue_id;
        $current_serve_label = $queue->queue_label;  
        $this->data_view['client_info'] = $first_queue;

        //get transaction type
        $transaction_info = Transactions::find( $queue->transactionID_fk);

        $this->data_view['transaction_info'] = $transaction_info;
        $this->data_view['transaction_info']->transaction_type_name = $this->get_transaction_labels()[ $transaction_info->transaction_type ];
      } else {
        $current_serve = 0;
        $current_serve_label = 0;
      }



      $this->data_view['current_serve'] = $current_serve;
      $this->data_view['current_serve_label'] = $current_serve_label;
      //var_dump($queue->transactionID_fk );
      //get customer information
     
      
      return view('dashboard.index', $this->data_view  );
    } else {
      return Redirect::intended('/');
    }
  }

  //login get in routes
  //default page
  public function index(){
  //check if we have session if has, then redirect
    if( Session::has('teller_info') ){
      $counter = Session::get('teller_info');
      //$redirect = $this->__get_page( $counter->counter_id );
       return view('dashboard.index', $this->data_view  );
    } else {
      return view('teller.login');  
    }
  }

  //get all counter labels
  private function get_counter_labels(){
    $counters = Counter::all();
    foreach( $counters as $counter ){
      $tmp_array[ $counter->counter_id ] = $counter->counter_name;
    }
    return $tmp_array;
  }

  //get all transaction type labels
  private function get_transaction_labels(){
    $transaction_types = TransactionType::all();
    foreach( $transaction_types as $transaction_type ){
      $tmp_array[ $transaction_type->transaction_type_id ] = $transaction_type->transaction_type_name;
    }
    return $tmp_array;
  }

  //registration logic
  public function register(){
    
    $counters = $this->get_counter_labels();
    return view('teller.register')->with('owners', $counters);
  }

  public function get_logout(){
    //flush session if we are going to logout since we're using it
    Session::flush();
    return Redirect::intended('/');
  }

  //login post
  public function login(Request $request) {    

    $input = Input::all();
    //if we have session then redirect
    if( Session::has('teller_info') ){
      $counter = Session::get('teller_info');
      //$redirect = $this->__get_page( $counter->counter_id );
       return Redirect::intended('/dashboard');
    }

    //if we don't have post
    if( count($input) < 1 ){
       return view('teller.login');
    }
    
    $remember = (Input::has('remember')) ? true : false;

    //authenticate the login information posted
    $auth = Auth::attempt([
      'email' => $input['email'],
      'password' => $input['password']
      ], $remember
    );

    //authentication successful
    if ($auth) {
      //once we authentication is successful, then put the necessary information into the session
      Session::put('teller_info',Auth::user());

      //redirect to the dashboard
      return Redirect::intended( '/dashboard' );
    } else {
      //flash error message on the page
      $data['msg'] = 'Invalid login details';
      return view('teller.login', $data);
    }
  }

  
   
   

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = Request::all();


        $rules = [
            'lastname'=> 'required|string',
            'firstname' => 'required|string',
            'gender'=> 'required|string',
            'birth'=> 'required|string',
            'address'=> 'required',
            'mobile'=> 'required|numeric',
            'email' => 'required|email',
            'counter' => 'required|string'
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
                $password = $data['password'];
                $password = Hash::make($password);

                $r = Input::get('counter');

                $teller = new User;
                $teller->firstname= $data['firstname'];
                $teller->lastname= $data['lastname'];
                $teller->gender= $data['gender'];
                $teller->birth= $data['birth'];
                $teller->address = $data['address'];
                $teller->mobile  = $data['mobile'];
                $teller->email = $data['email'];
                $teller->counter_id = $r;
                $teller->password = $password;
                $teller->save();
                return Redirect::to('/teller/login');
               } 
               else {
                    return Redirect::back()->withInput()->withErrors($validation);
               }
    }


   
   

  
    
}
