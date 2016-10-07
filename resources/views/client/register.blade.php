@extends('layouts.login')


@section('content')
 <div class="containerz">
            <div class="box">
                <div class="box2">
                  @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

    <title>Register</title>
</head>
<body>
<!--header-->
  <div class="navigation">
      <div class="container-fluid">
        <nav class="pull">
          <ul>
            <li><a  href="index.html">Home</a></li>
            <li><a  href="about.html">About Us</a></li>
            <li><a  href="blog.html">Blog</a></li>
            <li><a  href="terms.html">Terms</a></li>
            <li><a  href="privacy.html">Privacy</a></li>
            <li><a  href="contact.html">Contact</a></li>
          </ul>
        </nav>      
      </div>
    </div>

<div class="header">
  <div class="container">
    <!--logo-->
      <div class="logo">
        <h1><a href="index.html">Please Register</a></h1>
      </div>
    <!--//logo-->
    <div class="top-nav">
      <ul class="right-icons">
        <li><a  href="{{ URL::to('/client/login') }}"><i class="glyphicon glyphicon-user"> </i>Login</a></li>
      </ul>
    
    <div class="clearfix"> </div>
  
         
        <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
        <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>

  
    </div>
    <div class="clearfix"> </div>
    </div>  
</div>


<div class="login-right">
  <div class="container">
    <h3>Register</h3>
    <div class="login-top">
        <div class="form-info">
           <div class="span3">
          {!! Form::open() !!}
        <form class="form-horizontal" role="form" method="POST" action="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>First Name</label>
            <input type="text" name="first_name" class="span3" required="" >
            <label>Last Name</label>
            <input type="text" name="last_name" class="span3" required="" >
            <label>Address</label>
            <input type="text" name="address" class="span3" required="" >
            <label>Birthdate : </label>
            <input type="text" name="birthdate"   Pleaseceholder="Birthdate" required="" >
            <label>Mobile # : </label>
            <input type="text" name="mobile"   placeholder="Mobile Number" required="" >
            <label>Gender : </label>
            {!! Form::select('gender', array('Female' => 'Female', 'Male' => 'Male')); !!}<br>
            <label>Email : </label>
            <input type="text" name="email"  value="{{ old('email') }}" placeholder="Email" required="" >
            <label>Username</label>
            <input type="text" name="username" class="span3" required="" >
            <label>Password</label>
            <input type="password" name="password" class="span3" required="" >
            <label >Confirm Password</label>
            <input type="password" class="span3" name="confirmPassword" required="" >
   

      <br/>
       
            <br><br>
            <label class="hvr-sweep-to-right">
              <button type="submit">Register</button>
            
            </label>
          </form>
          </div>
          {!! Form::close() !!}
     
        </div>
      
  </div>
</div>
</div>

<div class="footer-bottom">
    <div class="container">
      <div class="col-md-4 footer-logo">
        <h2><a href="index.html">LTO</a></h2>
      </div>
      <div class="col-md-8 footer-class">
        <p >© 2015 LTO. All Rights Reserved | Design by  MQues</a> </p>
      </div>
    <div class="clearfix"> </div>
    </div>
  </div>

<script>
$(function(){
  setInterval( function(){
      $('.msg').fadeOut(1000);
    }, 5000 );

});
</script>
@stop 