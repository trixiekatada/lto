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
    .alert_label{ color: #f00; }
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
              <li><a href="{{ URL::to('/teller/logout/?s='.$counter_label_) }}">Logout</a></li>
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
      <span class="alert_label timer">Alert!</span>
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
        <a href="#" data-toggle="modal" data-target="#queue_modal" id="queue_pending" >{{ $queue_pending }}</a></p>
      @else
        <a href="#" data-toggle="modal" data-target="#queue_modal" id="queue_pending" >{{ $queue_pending }}</a></p>
      @endif
    </div>

    <div class="status">
    
    @if ( $queue_pending > 0 AND $start === true ) 
    
<<<<<<< HEAD
      <p><form method="post" action=""><input type="hidden" name="_token" id="token" value="{{csrf_token()}}"><input type="hidden" name="current_serve" value="{{ $current_serve }}" /><button type="submit" class="btn btn-primary">Next Queue</button></form></p>
=======
      <p><form method="post" action=""><input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><input type="hidden" name="current_serve" value="{{ $current_serve }}" /><button type="submit" class="btn btn-primary">Next Queue</button></form></p>
>>>>>>> 62a45adb836f96b926d848cb4fba45ce42ab7147
    @endif
   
    @if( isset($start) AND $start === false )
      <p><form method="post" action=""><input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><input type="hidden" value="true" name="start"/> <button type="submit" class="btn btn-primary">Start</button></form></p>
    @endif
    

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
        <td>License Registration</td>
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
       <table class="table table-striped" id="queue_details">
       <thead>
        <tr>
          <th>Priority #</th>
          <th>Name</th>          
        </tr>
       </thead>
       <tbody>
       @if ( !empty($queue_pending_details) )
         @foreach ($queue_pending_details as $queue)
            <tr>
              <td>{{ $queue->queue_label }}</td>
              <td>{{ $queue->first_name }} {{ $queue->last_name }}</td>
            </tr>
          @endforeach
        @endif
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

        blink('.alert_label');
        $('.alert_label').hide();
          // set minutes
        var min = {{ $minutes }};
        var sec = {{ $seconds }};
        var secs = ( min * 60 ) + sec;

        var sec_ = secs * 1000;
        var timeout;
        var alert_prompt = false;

        setInterval( function(){
           //console.log('run');
          $.ajax({
            url: '/queue/check',
            data: {'teller':{{ $session->counter_id }}, '_token': '{{ csrf_token() }}' },
            type: 'POST',
            dataType: 'json',
            success: function(data){
              var txt = '';
              if( data.queue_pending > 0 ){
                $('#queue_pending').text(data.queue_pending);

                $.each( data.queue_pending_details, function(key, val){
                   txt += '<tr><td>'+ val.queue_label +'</td><td>'+ val.first_name +' '+ val.last_name +'</td></tr>';
                });
                //console.log(txt);
                $('#queue_details tbody').html('').html(txt);
              }
              //console.log(data.queue_pending);
            }
          });

        }, 2000 );


        function check_queue(){
          
          $.ajax({
            url: '/queue/check',
            data: {'teller':{{ $session->counter_id }}, '_token': '{{ csrf_token() }}' },
            type: 'POST',
            dataType: 'json',
            success: function(data){
              console.log(data);
            }
          });
          
        }


        function next_queue(){

           var formData = new FormData();
              formData.append('current_serve', {{ $current_serve }});
              formData.append('_token', '{{ csrf_token() }}');

              $.ajax({
                url: '/pages/{{ $counter_label_ }}',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                  window.location.reload();
                }
              });
        }
        

        function blink(selector){
            $(selector).animate({opacity:0}, 50, "linear", function(){
                $(this).delay(300);
                $(this).animate({opacity:1}, 50, function(){
                  blink(this);
                });
                $(this).delay(300);
            });
        }

        //modal
        function countdown() {
          timeout = setTimeout(function(){
             minutes = $('#minutes');
            seconds = $('#seconds');
            // if less than a minute remaining
            //console.log(minutes);
            if (seconds < 59) {
              seconds.html( secs );
            } else {
              min = getminutes();
              sec = getseconds();
              minutes.html( min );
              seconds.html( sec );
            }
            secs--;
            if (secs <= 0) {
              clearTimeout(timeout);
              next_queue();
              return;
            }
            //prompt only once if the time is 30 sec below  
            if( secs < 30 && alert_prompt == false){
              //alert('Time is about to run out.');
              $('.alert_label').show();
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
          return ("0" + (secs - Math.round(min * 60))).substr(-2);
        }
        {!! ( $current_serve > 0 ) ? 'countdown();':'' !!}
});
    </script>
</body>
@stop