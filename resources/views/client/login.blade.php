
@extends('layouts.login')


@section('content')
<title>Login</title>
        <div class="containerz">
            <div class="box">
                <div class="box2"> 
                   <div class="header">
  <div class="container">
      <div class="logo">
        <h1><a href="index.html">LTO QUEUE MANAGEMENT SYSTEM</a></h1>
      </div>
    <div class="top-nav">
      <ul class="right-icons">
        <li><a href="{{ URL::to('/') }}"><i class="glyphicon glyphicon-user"></i>Home page</a></li>
        
      </ul>

    <div class="clearfix"> </div>
  
         
       
       
  
    </div>
    <div class="clearfix"> </div>
    </div>  
</div>
<div class="login-right">
  <div class="container">
  {!! (isset($msg) ? '<h1 style="color: #f00; text-align:center;" class="msg">'.$msg.'</h1>' : '' ) !!}
  
    <h3>Transaction Verification</h3>
    <!-- <div class="login-top">
         <div class="form-info">
          {!! Form::open() !!}
           <form class="form-horizontal" role="form" method="POST" action="/client/login">
             <h4>Email</h4><br />
            <input type="text" class="email" placeholder="Email" name="email" value="{{ old('email') }}" />
            <h4>Password</h4><br />
            <input type="password"  placeholder="Password" name="password" />
 		       <h4>Transaction ID</h4><br />
            <input type="text" class="text" placeholder="Transaction ID" name="transactionsID" value="{{ old('transactionsID') }}" />
            <h4>Verification Code</h4><br />
            <input type="password"  placeholder="Verification Code" name="verification_code" />       
        
            <br><br>
             <label class="hvr-sweep-to-right">
              <input type="submit" value="Submit"></a>
                   </label>
          </form>

          <div class="create">
        <h4>New Teller?</h4>
        <a class="hvr-sweep-to-right" href="/client/register">Make Transaction</a>
        <div class="clearfix"> </div>
      </div>
          {!! Form::close() !!}
        </div> -->
<div  class="center" id="reader" style="width:300px;height:280px;"></div>

<h6 class="center">QR Code Information:</h6>
<span id="read" class="center"></span>
<br>

<h6 class="center">Read Error:</h6>

<span id="read_error" class="center"></span>

<br>
<h6 class="center">Video Error:</h6>
<span id="vid_error" class="center"></span>
  </div>
</div>
</div> 
  </div>
                </div>   
            </div>
            
        </div>


<script>
  $(function(){
    $('input[type="submit"]').click(function(e){
     
      var transactionsID = $('input[name="transactionsID"]').val();
      var verification_code = $('input[name="verification_code"]').val();

      if( (transactionsID == '' || transactionsID == 'undefined') || (verification_code == '' || verification_code == 'undefined') ){
        alert('Please supply all information');
        e.preventDefault();
        
      } else {
        $('form').submit();
      }
    });
    setInterval( function(){
      $('.msg').fadeOut(1000);
    }, 5000 );

    $('#reader').html5_qrcode(function(data){
      $('#read').html(data);
      window.location = 'http://localhost:8000/qrcode/?rl_id=' + data;
    },
    function(error){
      $('#read_error').html(error);
    }, function(videoError){
      $('#vid_error').html(videoError);
    }
  );

 


    
  });
</script>


@stop 