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

class TellerController extends Controller {

    protected $session = array();
    protected $data_view = array();

  public function __construct(){
    //check if we have session, then redirect appropriately
    if( Session::has('teller_info') ){
      $this->session = Session::get('teller_info');
      $this->data_view['session'] = $this->session;

      //all all how many on queue on that teller
      $queue_pending = Queue::where('counterID_fk', $this->session['counter_id'])->where('status', 0)->get();
      $queue_pending = count($queue_pending);
      $this->data_view['queue_pending'] = $queue_pending;

      //proper labels
      $counter_label = $this->get_counter_labels()[ $this->session->counter_id ];
      $this->data_view['counter_label'] = strtoupper( $counter_label );

      //get the current priority number
      $queue = Queue::where('counterID_fk', '=', $this->session->counter_id)->where('status', 0)->orderBy('queue_id', 'asc')->limit(1)->first();
      if( count($queue) > 1 ){
        $current_serve = $queue->queue_id;  
         $this->data_view['client_info'] = ClientInfo::find( $queue->transactionID_fk );
      } else {
        $current_serve = 0;
      }     
      $this->data_view['current_serve'] = $current_serve;
      
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
      return view( 'dashboard.index', $this->data_view );
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

  //return which page the teller is assigned to
  private function __get_page( $counter ){
    switch( $counter ){
      case 1: $page = '/registration'; break;
      case 2: $page = '/approving'; break;
      case 3: $page = '/cashier'; break;
      case 4: $page = '/photosignature'; break;
      case 5: $page = '/receiving'; break;       
    }
    //return '/pages'.$page;
    return '/dashboard';
  }

    public function getNextQueue(){
        if(Session::get('queue_id')){
        echo 'next clicked';
        //get the current custmer
        $queue_id = Session::get('queue_id');
        $job = Job::where('queue_id', $queue_id)->first();
        //increment the steps
        $steps = $job->counter_id;
        
        //update the steps
        Job::where('queue_id', $queue_id)->update(['counter_id' => $steps]);

        $counter_id = Session::get('counter_id');
        if(!empty($counter_id)){
          $p = Job::where('counter_id', $counter_id)->first();
          if(!empty($p)) Session::put('queue_id', $p->queue_id);
        }

          $t1 = Job::where('counter_id', '1')->first()['queue_id'];
          $t2 = Job::where('counter_id', '2')->first()['queue_id'];
          $t3 = Job::where('counter_id', '3')->first()['queue_id'];
          $t4 = Job::where('counter_id', '4')->first()['queue_id'];
          $t5 = Job::where('counter_id', '5')->first()['queue_id'];

          if(empty($t1)) $t1 = '0';
          if(empty($t2)) $t2 = '0';
          if(empty($t3)) $t3 = '0';
          if(empty($t4)) $t4 = '0';
          if(empty($t5)) $t5 = '0';
          Session::forget('counter_id') ;
        return view('pages.approving', array('t1' => $t1, 't2' => $t2, 't3' => $t3, 't4' => $t4,'t5' => $t5));
        }
       }


      public function processjob()
    {
      
      $t1 = Job::where('counter_id', '1')->first();
      $t2 = Job::where('counter_id', '2')->first();
      $t3 = Job::where('counter_id', '3')->first();
      $t4 = Job::where('counter_id', '4')->first();
      $t5 = Job::where('counter_id', '5')->first();

      if(empty($t1)){ $t1 = '0'; } else{ $t1 = $t1->queue_id; }
      if(empty($t2)){ $t2 = '0'; } else{ $t2 = $t2->queue_id; }
      if(empty($t3)){ $t3 = '0'; } else{ $t3 = $t3->queue_id; }
      if(empty($t4)){ $t4 = '0'; } else{ $t4 = $t4->queue_id; }
      if(empty($t5)){ $t5 = '0'; } else{ $t5 = $t5->queue_id; }

      $counter_id = Session::get('counter_id');
      if($counter_id = 1){
        Session::put('queue_id', $t1);
      }

      if($counter_id = 2){
        Session::put('queue_id', $t2);
      }

      if($counter_id = 3){
        Session::put('queue_id', $t3);
      }

      if($counter_id = 4){
        Session::put('queue_id', $t4);
      }

      if($counter_id = 5){
        Session::put('queue_id', $t5);
      }
      
      return view('pages.approving', array('t1' => $t1, 't2' => $t2, 't3' => $t3, 't4' => $t4,'t5' => $t5));
    }

    public function pjob()
    {
      
    
      $t1 = Job::where('steps', '1')->first()['queue_number'];
      $t2 = Job::where('steps', '2')->first()['queue_number'];
      $t3 = Job::where('steps', '3')->first()['queue_number'];
      $t4 = Job::where('steps', '4')->first()['queue_number'];
      $t5 = Job::where('steps', '5')->first()['queue_number'];

      if(empty($t1)) $t1 = '0';
      if(empty($t2)) $t2 = '0';
      if(empty($t3)) $t3 = '0';
      if(empty($t4)) $t4 = '0';
      if(empty($t5)) $t5 = '0';

      //$pppppp = Job::where('steps', '5')->first();

      //Session::put('queue_id', $pp->queue_id);
      //Session::put('queue_id', $ppp->queue_id);
      //Session::put('queue_id', $pppp->queue_id);
      //Session::put('queue_id', $ppppp->queue_id);
 
      //echo Session::get('queue_id');
        //return view('pages.approving',compact('pp','ppp','pppp','ppppp','pppppp'));
      return view('pages.cashier', array('t1' => $t1, 't2' => $t2, 't3' => $t3, 't4' => $t4,'t5' => $t5));
      //Session::put('queue_id', $t1->queue_id);
      //echo Session::get('queue_id');
    }

    public function apProcess()
    {
      $r = AvailableList::where('counter','validation')->first();
      $rp = AvailableList::where('counter','approving')->first();
      $rpr = AvailableList::where('counter','photo signature')->first();
      $rpro = AvailableList::where('counter','cashier')->first();
      $rproc = AvailableList::where('counter','receiving')->first();

        return view('pages.approving', compact('r','rp','rpr','rpro','rproc'));

    }

      public function aProcess()
    {
      $r = AvailableList::where('counter', '=', 'approving') ->increment('p_number');
        //increment the steps
        return view('pages.approving');
    }

    public function validationProcess()
    {
     
      $r = AvailableList::where('counter','validation')->first();
      $rp = AvailableList::where('counter','approving')->first();
      $rpr = AvailableList::where('counter','photo signature')->first();
      $rpro = AvailableList::where('counter','cashier')->first();
      $rproc = AvailableList::where('counter','receiving')->first();

        return view('pages.registration', ['data_view' => $this->data_view] );

    }

      public function valProcess()
    {
      $r = AvailableList::where('counter', '=', 'validation') ->increment('p_number');
        //increment the steps
        return view('pages.registration');
    }

    public function phProcess()
    {
      $ph1 = AvailableList::where('counter', 'validation')->first();
      $ph2 = AvailableList::where('counter', 'approving')->first();
      $ph3 = AvailableList::where('counter', 'photo signature')->first();
      $ph4 = AvailableList::where('counter', 'cashier')->first();
      $ph5 = AvailableList::where('counter', 'receiving')->first();


      return view('pages.photosignature', compact('ph1','ph2', 'ph3', 'ph4','ph4','ph5'));
    }

    public function pProcess()
    {
      $ph3 = AvailableList::where('counter', '=', 'photo signature') ->increment('p_number');
        return view('pages.photosignature');
    }

    public function caProcess()
    {
      $ph1 = AvailableList::where('counter', 'validation')->first();
      $ph2 = AvailableList::where('counter', 'approving')->first();
      $ph3 = AvailableList::where('counter', 'photo signature')->first();
      $ph4 = AvailableList::where('counter', 'cashier')->first();
      $ph5 = AvailableList::where('counter', 'receiving')->first();

      return view('pages.cashier', compact('ph1','ph2', 'ph3', 'ph4','ph4','ph5'));
    }

    public function cProcess()
    {
      $ph4 = AvailableList::where('counter', '=', 'cashier') ->increment('p_number');
        return view('pages.cashier');
    }

    public function reProcess()
    {
      $ph1 = AvailableList::where('counter', 'validation')->first();
      $ph2 = AvailableList::where('counter', 'approving')->first();
      $ph3 = AvailableList::where('counter', 'photo signature')->first();
      $ph4 = AvailableList::where('counter', 'cashier')->first();
      $ph5 = AvailableList::where('counter', 'receiving')->first();

      return view('pages.receiving', compact('ph1','ph2', 'ph3', 'ph4','ph4','ph5'));
    }

    public function rProcess()
    {
      $ph5 = AvailableList::where('counter', '=', 'receiving') ->increment('p_number');
        return view('pages.receiving');
    }

    /**rce.
     *
     * @return Response
     */
    public function getUserid($username)
    {
      $id=0;
      $user = User::getUserid($username);
      foreach($user as $u)
    {
          $id=$u["id"];
    }
    return $id;
    }

    public function getCounterid($counter_id)
    {
      $count=0;
      $counter = Counter::getCounterid($counter_id);
      foreach($counter as $c)
    {
          $count=$c["counter_id"];
    }
    return $count;
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


   
    public function generateQRCode(){
       // \QrCode::generate('Sample ', '../public/images/qrcodes/qrcode.svg');
       QRCodeReader::format('png')->size(250)->generate("", '../public/images/qrcodes');

   }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $idr
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

  
    
}
