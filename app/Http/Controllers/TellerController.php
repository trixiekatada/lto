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

class TellerController extends Controller
{
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

        return view('pages.registration', compact('r','rp','rpr','rpro','rproc'));

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

//login get in routes
    public function index(){
      //check if we have session if has, then redirect
      if( Session::has('teller_counter_id') ){
        $counter = Session::get('teller_counter_id');
        $redirect = $this->__get_page( $counter );
        return Redirect::intended( $redirect );
      }


      return view('teller.login');
    }

     public function register(){
      $owners = Counter::all();

      foreach ($owners as $data) {
          $owner[$data->counter_name] = $data->counter_name;
      }
    
      return view('teller.register')->with('owners', $owner);
    }

    public function get_logout(){
      Session::flush();
      return Redirect::intended('/');
    }

//login post
    public function login(Request $request)
    {      
        $input = Input::all();
        $remember = (Input::has('remember')) ? true : false;

        $auth = Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password']
            ], $remember
        );

        if ($auth) 
        {
            $counter_id = Auth::user()->counter_id;
            Session::put('teller_counter_id',Auth::user()->counter_id);

            $redirect = $this->__get_page( $counter_id );
            return Redirect::intended( $redirect );
        }
        else {
          //@TODO flash error message on the page
          echo "auth";
          var_dump($auth);
        }
    }
    //return which page the teller is assigned to
    private function __get_page( $counter ){
      switch( $counter ){
        case 'registration': $page = '/registration'; break;
        case 'approving': $page = '/registration'; break;
        case 'cashier': $page = '/registration'; break;
        case 'photo signature': $page = '/photosignature'; break;
        case 'receiving': $page = '/receiving'; break;       
      }
      return '/pages'.$page;
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
