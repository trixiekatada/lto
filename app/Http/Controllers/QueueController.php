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
  
   

    public function view_all(){

        //get current serve
        $data_view['teller1'] = $this->get_current(1)->queue_label;
        $data_view['teller2'] = $this->get_current(2)->queue_label;
        $data_view['teller3'] = $this->get_current(3)->queue_label;
        $data_view['teller4'] = $this->get_current(4)->queue_label;
        $data_view['teller5'] = $this->get_current(5)->queue_label;
        $data_view['teller6'] = $this->get_current(6)->queue_label;

        //get next queue
        $data_view['teller_n1'] = $this->get_next(1)->queue_label;
        $data_view['teller_n2'] = $this->get_next(2)->queue_label;
        $data_view['teller_n3'] = $this->get_next(3)->queue_label;
        $data_view['teller_n4'] = $this->get_next(4)->queue_label;
        $data_view['teller_n5'] = $this->get_next(5)->queue_label;
        $data_view['teller_n6'] = $this->get_next(6)->queue_label;

        return view('queue.view', $data_view);
    }

    private function get_current( $teller ){

        $record = Queue::where('counterID_fk', $teller)->first();
        //var_dump($record);
        if( empty($record) ){
            $record = new Queue;
            $record->queue_label = 0;
            
        }
        return $record;
    }

    //called via ajax returns number of queue
    //same logic as teller controller initialize() but only returns json
    public function check_queue(){

        $teller = Input::get('teller');
        //all all how many on queue on that teller
        $queue_pending = Queue::where('counterID_fk', $teller )
                        ->where('status', 0)
                        ->leftJoin('tbl_register_license', 'rl_id', '=', 'transactionID_fk')
                        ->leftJoin('tbl_client_info', 'tbl_client_info.client_id', '=', 'tbl_register_license.client_id')
                        ->orderBy('queue_id', 'asc')
                        ->orderByRaw('FIELD("client_type", "1,2,0")')
                        ->get();
                   
        //do not display the currently serving queue
        if( count($queue_pending) > 1 && !empty($queue_pending) ){
          $first = 0; 
          $first_queue = $queue_pending[$first];      
          unset( $queue_pending[$first] );
          //end   
        }
        $data_view['queue_pending_details'] = $queue_pending;
        $queue_pending = count($queue_pending);
        $data_view['queue_pending'] = $queue_pending;

        return json_encode( $data_view );

    }

    private function get_next( $teller ){

        $record = Queue::where('counterID_fk', $teller)->orderBy('created_at', 'asc')->get();

        //var_dump($record);
        if( empty($record) OR count($record) < 2 ){
            $record = new Queue;
            $record->queue_label = 0;
            
        } else {
            
            $record = $record[1];
        }
        return $record;
    }

    public function next_queue(Request $request){

        //check if we have post
        $method = $request->method();
        $request_url = $_SERVER['REQUEST_URI'];
       
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
                
            } else if( Input::has('start') ) {
                Session::put('start', true);
               
            }
            return Redirect::intended($request_url);
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
