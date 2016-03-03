@extends('layouts.login')


@section('title')
MQUE
@stop




@section('content')
<title>MQUE Dashboard</title>
<style type="text/css">

    ul li{
        display: inline-block;
        position: relative;
        line-height: 21px;
        text-align: left;
        margin-right: 10px;     
        color: #000;
    }
    ul li:after{
      content: ' | ';
    }
    ul li a, ul li a:active{
      color: #000;
    }
    .status{
      display: block;
      float: left;
      position: relative;
      width: 33%;
    }
    .status p { font-size: 20px; }
    .red { color: #f00; }
    .div-status{
      
      text-align: center;
      color: #000;
      font-weight: bold;
      margin-top: 15px;
    }
    .timer {
      width: 60px; border: none; background-color:none; font-size: 30px; font-weight: bold; line-height: 30px;
    }
    .div-timer{
      text-align: right;
      float: right;
      width: 250px;
    }
    .footer {
      clear: both;
      position: relative;
      margin-top: 10px;
    }
    span .timer { float: left; }
    .info { color: #000; }
</style>


<body>
<div class="header">
    <div class="container">
        <div class="logo">
            <h1><a href="#">MQUES</a></h1>
        </div>
    
      <div class="top-nav">
          <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-user"></i>{{ $session['firstname'] }}</a></li>
              <li><a href="{{ URL::to('/teller/logout') }}">Logout</a></li>
          </ul>
      </div>
    </div>
</div>
<div class="container">
  
  <div class="pre-topp">
    <h5>{{ $counter_label }} Counter</h5>
    <p>It may change by the teller. Suspend queue manually.</p>
  </div>
   
  <div class="row div-status">
    <div class="div-timer">
        <span id="minutes" class="timer">00</span> : <span id="seconds" class="timer">00</span>
    </div>

    <h1>Teller {{ $session->counter_id }}</h1>
    <div class="status">
      <p><label class="red">Currently serving #:</label>
      <span class="red">{{ $current_serve_label }}</span></p>
    </div>
    <div class="status">
      <p><label>Total Pending Queue:</label> 
      @if( $queue_pending > 0 )
        <a href="#" data-toggle="modal" data-target="#queue_modal" >{{ $queue_pending }}</a></p>
      @else
        <span>{{ $queue_pending }}</span></p>
      @endif
    </div>

    <div class="status">
    
    {!! ( $queue_pending > 0 ) ? '<p><form method="post" action=""><input type="hidden" name="_token" id="token" value="'.csrf_token().'"><input type="hidden" name="current_serve" value="'.$current_serve.'" /><button type="submit" class="btn btn-primary">Next Queue</button></form></p>' : '' !!}
   
    

    </div>
  </div>
  <hr/>
  <div class="container info">
  @if( isset($client_info) ) 
  {{-- Display all client information here --}}  

    <h2>Client Information</h2>
    <table class="table table-striped">
      <tr> 
        <td>Transaction type:</td>
        <td>{{ $transaction_info->transaction_type_name }}</td>
      </tr>
      <tr> 
        <td>Name:</td>
        <td>{{ $client_info->first_name }} {{ $client_info->last_name }}</td>
      </tr>
    </table>
   @endif 


  </div>
<!--  queueu modal  -->
<!-- Modal -->
<div class="modal fade" id="queue_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Current on Queue</h4>
      </div>
      <div class="modal-body">
       <table class="table table-striped">
       <thead>
        <tr>
          <th>Priority #</th>
          <th>Name</th>          
        </tr>
       </thead>
       </tbody>
       @foreach ($queue_pending_details as $queue)
          <tr>
            <td>{{ $queue->queue_label }}</td>
            <td>{{ $queue->first_name }} {{ $queue->last_name }}</td>
          </tr>
        @endforeach
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- end of queue modal -->

	<div class="footer">
		<div class="container">
			<div class="col-md-4 footer-logo">
				<h2><a href="index.html">MQUES</a></h2>
			</div>
			<div class="col-md-8 footer-class">
				<p >© 2015 MQUES. Team Artisan. </p>
			</div>
		<div class="clearfix"> </div>
	 	</div>
	</div>

<script type="text/javascript">

    $(function(){
          // set minutes
        var mins = 1;
        var secs = (mins * 60);
        var sec_ = secs * 1000;
        var timeout;
        var alert_prompt = false;

        setInterval( function(){
            var formData = new FormData();
            formData.append('current_serve', {{ $current_serve }});
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
              url: '/dashboard',
              data: formData,
              processData: false,
              contentType: false,
              type: 'POST',
              success: function(data){
                window.location.reload();
              }
            });
        }, sec_);

        //modal
        function countdown() {
          timeout = setTimeout(function(){
             minutes = $('#minutes');
            seconds = $('#seconds');
            // if less than a minute remaining
            console.log(minutes);
            if (seconds < 59) {
              seconds.html( secs );
            } else {
              min = getminutes();
              sec = getseconds();
              minutes.html( min );
              seconds.html( sec );
            }
            secs--;
            if (secs < 0) {
              clearTimeout(timeout);
              return;
            }
            //prompt only once if the time is 30 sec below  
            if( secs < 30 && alert_prompt == false){
              alert('Time is about to run out.');
              alert_prompt = true;
            }
            countdown();

          }, 1000);
        } 

       
        function getminutes() {
          // minutes is seconds divided by 60, rounded down
          mins = Math.floor(secs / 60);
          return ("0" + mins).substr(-2);
        }

        function getseconds() {
          // take mins remaining (as seconds) away from total seconds remaining
          return ("0" + (secs - Math.round(mins * 60))).substr(-2);
        }
        {!! ( $current_serve > 0 ) ? 'countdown();':'' !!}
        
});
    </script>
</body>
@stop