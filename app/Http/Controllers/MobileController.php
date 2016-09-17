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
    $count = DB::SELECT(DB::RAW("SELECT count(*) as count FROM stepone_evaluation WHERE  priorityID <= (SELECT priorityID FROM stepone_evaluation WHERE user_id = client_id) ORDER BY priorityID ASC"));

    return Response::json($count[0]->count);
   }

   public function waitingTime(){

    $count = Queue::where('time_alloted', '<=', $client_info)->get()->count();

    return Response::json($count);
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
