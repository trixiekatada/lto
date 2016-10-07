<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transaction;
use Response;
use Input;
use App\RegisterLicense;
use App\VehicleRegister;
use File;
use Auth;
use App\ClientInfo;
use App\Queue;
use App\User;
use Storage;
use DB;
use Session;

class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mlogin()
    {
        $input = Input::all();

        $login = User::where('username',Input::get('username'))->where('password', Input::get('password'))->get();

        //login succeded?
       if( count($login) > 0){
            Session::put( 'client_info', $login );
            return response()->json($login, 200);
        }
        else
        {
            return response()->json('wrong credentials',401);
        }
    }
    
    public function getqrcode(){
            
            
            $id = Input::get('client_id');

            $user_id = ($id!=null)? $id : 25 ;
            
            $data = RegisterLicense::find($user_id);
             
            if(!$data) 
             {
                die('user not found');
             }
    
             $base_path = $data->getAttributes()['qrcode'];


                if( File::exists($base_path) ){

                    $filetype = File::type( $base_path );

                    $response = Response::make( File::get( $base_path ) , 200 );

                    $response->header('Content-Type', $filetype);

                   return $response;
                }
        }


    public function getprioritynumber(){
        Session::get('client_info');
       $transaction = Queue::orderBy('queue_label', 'ASC')->get()->first();

       return Response::json($transaction);
    
     
   }

   public function getServing()
  {

    $step['one'] = Queue::where('counterID_fk', '=', 1)->orderBy('queue_label', 'ASC')->get();
    $step['two'] = Queue::where('counterID_fk', '=', 2)->orderBy('queue_label', 'ASC')->get();
    $step['three'] = Queue::where('counterID_fk', '=', 3)->orderBy('queue_label', 'ASC')->get();
    $step['four'] = Queue::where('counterID_fk', '=', 4)->orderBy('queue_label', 'ASC')->get();
    $step['five'] = Queue::where('counterID_fk', '=', 5)->orderBy('queue_label', 'ASC')->get();

    return Response::json($step);
  }


    public function setTime(){

    $user_id = Input::get('client_id');

    // $count = Steptwo_photosig::where('priorityID', '<=', $priorityID)->get()->count();
    $count = DB::SELECT(DB::RAW("SELECT count(*) as count FROM tbl_queues WHERE queue_label <= (SELECT queue_label FROM tbl_queues WHERE transactionID_fk = client_id) ORDER BY queue_label ASC"));

    return Response::json($count[0]->count);
   }

   public function getTime(){
    $time_alloc = Queue::where('status', '=', 0)->lists('time_alloted');
    // dd($time_alloc);
    $secondsSum = 0;
    $minutesSum = 0;
    for ($i=0; $i < count($time_alloc) ; $i++) { 
      $divide = explode(":", $time_alloc[$i]);
      
      $minutesSum += $divide[0];
      $secondsSum += $divide[1];
    }
      $totalSecond = ($secondsSum*(count($time_alloc)));

    return Response::json($totalSecond);
  }


    public function count() {
        //$transaction = Transaction::where('clientID_fk','=',$session['client_info']->client_id)->first();

        //$que = Queue::where('counterID_fk','=',$transaction->transactions_id)->first();

        //$queue_in_teller = Queue::where('counterID_fk','=',$queue->counterID_fk)->where('active','=',0)->get();

          $queue_pending = Queue::where('counterID_fk',2)
                        ->where('status', 0)
                        ->orderBy('queue_id', 'asc')
                        ->leftJoin('tbl_register_license', 'rl_id', '=', 'transactionID_fk')
                        ->leftJoin('tbl_client_info', 'tbl_client_info.client_id', '=', 'tbl_register_license.client_id')
                        ->lists('counterID_fk');
                      

        $data_view['queue_pending_details'] = $queue_pending;
        $queue_pending = count($queue_pending);
        $data_view['queue_pending'] = $queue_pending;

        return Response::json( $data_view );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
