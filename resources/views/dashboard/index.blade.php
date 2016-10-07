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
      text-align: left;
      float: left;
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

/* Another css*/
.pricing-table {
max-width: 500px;
margin: 0 auto;
border-radius: 0px;
}

.pricing-table:hover>.panel>.panel-body-landing {
    background: #5CB85C;
    -webkit-transition:  all .3s ease;
}
.pricing-table:hover>.panel>.panel-heading-landing-box {
    background: #f0f0f0 !important;
    color: #333 !important;
    -webkit-transition:  all .3s ease;
    
}
.pricing-table:hover>.panel>.controle-header {
    background: #5CB85C !important;
    /*    border: solid 2px #5CB85C !important;*/
    -webkit-transition:  all .3s ease;
}
.pricing-table:hover>.panel>.panel-footer {
    background: #5CB85C !important;
    /*    border: solid 2px #5CB85C !important;*/
    -webkit-transition:  all .3s ease;
}
.pricing-table:hover>.panel>.panel-footer>.btn {
    border: solid 1px #fff !important;
    -webkit-transition:  all .3s ease;
}
.btn-price:hover {
    background: #fff !important;
    color: #5CB85C !important;
    -webkit-transition:  all .3s ease;
}
.pricing-table:hover>.panel>.controle-header>.panel-title-landing {
    color: #fff !important;
    -webkit-transition:  all .3s ease;
}
.pricing-table:hover>.panel>.panel-body-landing>.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th{
    color: #fff !important;
    -webkit-transition:  all .3s ease;
}
.panel-heading-landing {
    background: #f7f7f7 !important; 
    padding: 20px !important; 
    border-top-left-radius: 10px !important;  
    border-top-right-radius: 10px !important; 
    border: solid 2px #5CB85C !important; 
    border-bottom: none !important;
}
.panel-heading-landing-box {
    background: #5CB85C !important; 
    color: #fff !important; 
    font-size: 78px !important; 
    padding: 3px !important; 
    border: solid 2px #5CB85C !important; 
    border-top: none !important;
    height: 100px !important;
}
.panel-title-landing {
    color: #626367 !important;
    font-size: 25px;
    font-weight: bold;
}
.panel-body-landing {
    border: solid 2px #ccc !important; 
    border-top: none !important; 
    border-bottom: none !important;
}
.panel-footer-landing {
    border: solid 2px #ccc !important; 
    border-bottom-left-radius: 10px !important; 
    border-bottom-right-radius: 10px !important; 
    border-top: none !important;
}

/*Another css*/
  
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
<div class="container" align="center">
 
            <div class="col-md-12" style="margin-top: 20px; align: left;">
                <div class="pricing-table">
                    <div class="panel panel-primary" style="border: none;">
                        <div class="controle-header panel-heading panel-heading-landing">
                            <h1 class="panel-title panel-title-landing">
                                Teller {{ $session->counter_id }} - Currently Serving Number:
                            </h1>
                        </div>
                        <div class="controle-panel-heading panel-heading panel-heading-landing-box">
                            {{ $current_serve_label }}
                        </div>
                        <div class="panel-body panel-body-landing">
                            <table class="table">
                              @if( isset($client_info) ) 
                                <tr>
                                    <td width="50px"><i class="fa fa-check"></i></td>
                                    <td>Customer's Information</td>
                                </tr>
                                <tr>
                                    <td width="50px"><i class="fa fa-check"></i></td>
                                    <td>Customer Name: {{ $client_info->first_name }} {{ $client_info->last_name }}</td>
                                </tr>
                                <tr>
                                    <td width="50px"><i class="fa fa-check"></i></td>
                                    <td>Transaction: Register License</td>
                                </tr>
                                <tr>
                                    <td width="50px"><i class="fa fa-check"></i></td>
                                    <td>Date Of Registration: {{ $client_info->created_at }}</td>
                                </tr>
                                @endif 
                            </table>
                        </div>
                        <div class="panel-footer panel-footer-landing">
                           @if ( $queue_pending > 0 AND $start === true )
                            <p><form method="post" action=""><input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                              <input type="hidden" name="current_serve" value="{{ $current_serve }}" />
                              <button type="submit" class="btn btn-price btn-success btn-lg">Next Queue</button>
                            </form></p>
                            
                            <p><form method="POST" action=""><input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="skip_this" value="true">        
                              <input type="hidden" name="current_serve" value="{{ $current_serve }}" />
                            <button type="submit" class="btn btn-price btn-success btn-lg">Skip Queue</button>
                            </form> 
                            </p>
                           @endif
                           @if( isset($start) AND $start === false )
                           <p><form method="post" action=""><input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" value="true" name="start"/>
                            <button type="submit" class="btn btn-price btn-success btn-lg">Start</button>
                          </form></p>
                           @endif
                        </div>
            </div>
            </div>
        </div>
<br>

    <h3>Duration time of teller: </h3>
    <!-- <div class="div-timer"> -->
      <span class="alert_label timer">Alert!</span>
        <span id="" class="timer">00</span> : <span id="" class="timer">00</span>
    <!-- </div> -->


<div class="container1" border="1px">
   @if( $queue_pending > 0 )
   <div class="col-md-6" border="1px">
      <div class="modal-body">
          <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">Total Pending Queue:</h3>
          </div>
          </div>
          <table class="table table-hover" id="queue_details">
            <thead>
              <thead>
                <th>Priority #</th>
                <th>Name</th>
                <th>Transaction</th>
              </thead>
            </thead>
              <tbody>
        @if ( !empty($queue_pending_details) )
        @foreach ($queue_pending_details as $queue)
              <tr>
              <td>{{ $queue->queue_label }}</td>
                <td>{{ $queue->first_name }} {{ $queue->last_name }}</td>
                <td>{{ $queue->transaction_type}}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
      </div>
    </div>
      @else
    <div class="col-md-6" border="1px">
      <div class="modal-body">
          <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">Total Pending Queue:</h3>
          </div>
          </div>
          <table class="table table-hover" id="queue_details">
            <thead>
              <thead>
                <th>Priority #</th>
                <th>Name</th>
                <th>Transaction</th>
              </thead>
            </thead>
              <tbody>
        @if ( !empty($queue_pending_details) )
        @foreach ($queue_pending_details as $queue)
              <tr>
              <td>{{ $queue->queue_label }}</td>
                <td>{{ $queue->first_name }} {{ $queue->last_name }}</td>
                <td>{{ $queue->transaction_type}}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
      </div>
    </div>
      @endif
</div>
</div>

</div>
<!--  queueu modal  -->
<!-- Modal -->

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
        var min = {{ $minutes }}-1;
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
            if( secs > 120 && alert_prompt == false){
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