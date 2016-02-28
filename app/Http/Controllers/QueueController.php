<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendReminderEmail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Session;
use App\Http\Controllers\ClientController;
use Input;
use App\Queue;
use App\Counter;
use Redirect;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
   

    public function index()
    {
        if( Session::has('teller_info') ){
            $this->session = Session::get('teller_info');
            $this->data_view['session'] = $this->session;

            //all all how many on queue on that teller
           $queue_pending = Queue::where('counterID_fk', $this->session['counter_id'])->get();
           $queue_pending = count($queue_pending);
           $this->data_view['queue_pending'] = $queue_pending;
            return view('dashboard.index', array('data_view' => $this->data_view ) );
        } else {
            return Redirect::intended('/');
        }
    }

    public function next_queue(Request $request){

        //check if we have post
        $method = $request->method();
       
        if( $method == 'POST' ){
            if( Input::has('current_serve') ){
                $queue = Queue::find( Input::get('current_serve') );

                //check if the current counter is equal to the number of counters
                $max_counter = Counter::count();
                //echo '<pre>';
                //var_dump($queue);
                //exit();
                if( $max_counter == $queue->counterID_fk ){
                    //update queue
                    $queue->status = 1;
                }

                $queue->processID_fk += 1;
                $queue->counterID_fk += 1;
                $queue->save();
                return Redirect::intended('/dashboard');
            }
        }
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
