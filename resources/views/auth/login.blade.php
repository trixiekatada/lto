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
         <script>
            $(document).ready(function() {
            $('.popup-with-zoom-anim').magnificPopup({
              type: 'inline',
              fixedContentPos: false,
              fixedBgPos: true,
              overflowY: 'auto',
              closeBtnInside: true,
              preloader: false,
              midClick: true,
              removalDelay: 300,
              mainClass: 'my-mfp-zoom-in'
            });
                                            
            });
        </script>
          
  
    </div>
    <div class="clearfix"> </div>
    </div>  
</div>
<div class="login-right">
  <div class="container">
    <h3>Login</h3>
    <div class="login-top">
        <div class="form-info">
          {!! Form::open() !!}
           <form class="form-horizontal" role="form" method="POST" action="/auth/login">
 		       <h4>Email Address</h4><br />
            <input type="text" class="text" placeholder="Email Adress" name="email" value="{{ old('email') }}" placeholder="email address">
            <h4>Password</h4><br />
            <input type="password"  placeholder="Password" name="password" placehoder="password">       
        
            <br><br>
             <label class="hvr-sweep-to-right">
              <input type="submit" value="Submit"></a>
                   </label>
          </form>
          {!! Form::close() !!}
        </div>
      <div class="create">
        <h4>New Teller?</h4>
        <a class="hvr-sweep-to-right" href="/auth/register">Create an Account</a>
        <div class="clearfix"> </div>
      </div>
  </div>
</div>
</div> 
  </div>
                </div>   
            </div>
            
        </div>




@stop 