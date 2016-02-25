
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
  
         
        <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
        <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>

        <div id="small-dialog" class="mfp-hide">
          
        </div>
       
  
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
 		       <h4>Transaction ID</h4><br />
            <input type="text" class="text" placeholder="Transaction ID" name="transactionsID" value="{{ old('transactionsID') }}" />
            <h4>Verification Code</h4><br />
            <input type="password"  placeholder="Verification Code" name="verification_code" />       
        
            <br><br>
             <label class="hvr-sweep-to-right">
              <input type="submit" value="Submit"></a>
                   </label>
          </form>
          {!! Form::close() !!}
        </div>
     
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
    }, 3000 );
  });
</script>


@stop 