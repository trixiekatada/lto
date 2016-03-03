
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
    <div class="login-top">
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
        </div>
<!--<div id="camera"></div>-->
     
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


    


    $("#camera").webcam({
      width: 320,
      height: 240,
      mode: "callback",
      swffile: "/js/jscam_canvas_only.swf",
      onTick: function(remain) {

          if (0 == remain) {
              jQuery("#status").text("Cheese!");
          } else {
              jQuery("#status").text(remain + " seconds remaining...");
          }
      },

      onSave: function(data) {

          var col = data.split(";");
      // Work with the picture. Picture-data is encoded as an array of arrays... Not really nice, though =/
      },

      onCapture: function () {
          webcam.save();

        // Show a flash for example
      },

      debug: function (type, string) {
          // Write debug information to console.log() or a div, ...
      },

      onLoad: function () {
      // Page load
          var cams = webcam.getCameraList();
          for(var i in cams) {
              jQuery("#cams").append("<li>" + cams[i] + "</li>");
          }
      }
    });
  });
</script>


@stop 