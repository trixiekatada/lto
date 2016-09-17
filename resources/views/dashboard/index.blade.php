@extends('layouts.login')

@section('title')
MQUE
@stop
@section('content')

<style type="text/css">

    ul li{
        display: inline-block;
        position: relative;
        line-height: 21px;
        text-align: left;
    }
    ul li:after{
      content: ' | ';
    }
    ul li a, ul li a:active{
      color: #000;
    }
    .status{
      position: absolute;
      margin-left: 800px;
      margin-top: 300px;
      width: 100%;
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
    <br>
        <div class="premiumm">
            <div class="pre-topp">
            <h5>{{ $counter_label }} Counter</h5>
            <p>.......................................................................................................</p>
            </div>
        </div>
        <br><br><br>
         
<br><br><br>
<ul align="left">
<div class="pending" color="black">

    <h3 >Total Pending Queue:</h3>
    @if( $queue_pending > 0 )
        <h2><a href="#" data-toggle="modal" data-target="#queue_modal" id="queue_pending" style="color:black">{{ $queue_pending }}</a></h2>
      @else
        <h2><a href="#" data-toggle="modal" data-target="#queue_modal" id="queue_pending" >{{ $queue_pending }}</a></h2>
      @endif
</div>
  
<div class="duration">
    <h3>Duration time of teller: </h3>
    <div class="div-timer">
      <span class="alert_label timer">Alert!</span>
        <span id="minutes" class="timer">00</span> : <span id="seconds" class="timer">00</span>
    </div>
</div>

    <div class="status">
    @if ( $queue_pending > 0 AND $start === true ) 
      <p><form method="post" action=""><input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><input type="hidden" name="current_serve" value="{{ $current_serve }}" /><button type="submit" class="btn btn-primary">Next Queue</button></form></p>
    @endif
    @if( isset($start) AND $start === false )
      <p><form method="post" action=""><input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><input type="hidden" value="true" name="start"/> <button type="submit" class="btn btn-primary">Start</button></form></p>
    @endif
    </div>

<li>
<div class="project-fur" color="black">
<div align="center"><br><br>
    <h2>Teller {{ $session->counter_id }}</h2>
</div>
<div class="fur">
<div class="fur1"><br>
    <h2 class="red">Currently serving # : </h2><br><br><br>
     <h1><center><span class="red">{{ $current_serve_label }}</span></center></h1>
<br><br><br><br>
<div align="center">
<h1>
   
</h1></div>
 @if( isset($client_info) ) 
<span>Customer's Information</span><br>
<span>Customer Name: {{ $client_info->first_name }} {{ $client_info->last_name }}</span><br>
<span>Transaction: Register License  </span><br>
<span>Date Of Registration: {{$client_info->created_at }}</span>
 @endif 
</div>
</div>     
</div></li>

</ul>
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

<br><br>
       
    </div>
</div>
<br><br><br><br><br>
<br>
	<div class="footer-bottom">
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
    $(document).ready(function(){

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

         $('#subscribe').click(function(e){
         e.preventDefault(); // this prevents the form from submitting
            $.ajax({
              url: '/dashboard/index',
              type: "post",
              data: {'minutes':$('input[name=minutes]').val(), 'seconds':$('input[name=seconds]').val(),'_token': $('input[name=_token]').val()},
              dataType: 'JSON',
              success: function (data) {
                console.log(data); // this is good
              }
            });
          });

       
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
                url: '/pages/{{ str_replace(' ','_', $counter_label_) }}',
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
            if (seconds < 0) {
              seconds.html( secs );
            } else {
              min = getminutes();
              sec = getseconds();
              minutes.html( min );
              seconds.html( sec );
            }
            secs++;
            console.log(secs);
            if (secs <= 0) {
              clearTimeout(timeout);
              next_queue();
              return;
            }
            //prompt only once if the time is 30 sec below  
            if( secs == 120 && alert_prompt == false){
              var answer = confirm('Your time to serve this client is up. do you want to continue?');
                  if (answer)
                  {
                    console.log('yes');
                      //alert('Time is about to run out.');
                    $('.alert_label').show();
                    alert_prompt = true;
                  }
                  else
                  {
                    console.log('no');
                    clearTimeout(timeout);
                    next_queue();
                     $('.alert_label').show();
                    alert_prompt = true;
                    return;
                  }
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