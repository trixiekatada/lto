@extends('layouts.login')


@section('content')
<title>Login</title>
<style type="text/css">
.center1 {
  margin-left: 150px;
  color: black;
}
</style>
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
        <li><i class="glyphicon glyphicon-user"></i>Hi</li>
        
      </ul>

    <div class="clearfix"> </div>
  
         
       
       
  
    </div>
    <div class="clearfix"> </div>
    </div>  
</div>
<div class="login-right">
  <div class="container">
  {!! (isset($msg) ? '<h1 style="color: #f00; text-align:center;" class="msg">'.$msg.'</h1>' : '' ) !!}
  
    <h3>Scan QR Code Here!</h3>
     <div class="login-top">
         
        
            <div  class="center1" id="reader" style="width:400px;height:300px;"></div>
            <br>
            <h2 class="center1">QR Code Information:</h2>
            <span id="read" class="center1"></span>
            <br>

            <h4 class="center1">Read Error:</h4>

            <span id="read_error" class="center1"></span>

            <br>
            <h4 class="center1">Video Error:</h4>
            <span id="vid_error" class="center1"></span>
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
    }, 2000 );

    $('#reader').html5_qrcode(function(data){
      $('#read').html(data);
      window.location = 'http://localhost:8000/qrcode/';
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