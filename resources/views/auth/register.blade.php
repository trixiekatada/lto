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
        <li><span ><i class="glyphicon glyphicon-phone"> </i>Your Number here!</span></li>
        <li><a  href="{{ URL::to('/auth/login') }}"><i class="glyphicon glyphicon-user"> </i>Login</a></li>
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
          {!! Form::open() !!}
        <form class="form-horizontal" role="form" method="POST" action="">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <input type="text" name="firstname" value="{{ old('name') }}" placeholder="First Name" required="" >
            <input type="text" name="lastname" value="{{ old('name') }}"  placeholder="Last Name" required="" >
            <input type="text" name="address" placeholder="Address" required="" >
            <input type="text" name="birthdate"   placeholder="Birthdate" required="" >
            <input type="text" name="mobile"   placeholder="Mobile Number" required="" >
            <input type="text" name="gender"  placeholder="Gender" required="" >
            <input type="text" name="email"  value="{{ old('email') }}" placeholder="Email" required="" >
            <input type="password" name="password"  placeholder="Password " required="">
            <input type="password" name="password_confirmation"  placeholder="Confirm Password " required="">
            <h4>Counter Assign</h4>
            {!! Form::select('counter', $owners, Input::old('counter'),['class'=>'form-control']) !!}
            <br><br>
            <label class="hvr-sweep-to-right">
              <button type="submit">sign up</button>
            
            </label>
          </form>
          {!! Form::close() !!}
          <p>Already have a Real Home account? <a href="/auth/login">Login</a></p>
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


@stop 