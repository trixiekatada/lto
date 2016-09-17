
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

    <h3>Login</h3>
    <div class="login-top">
        <div class="form-info">
           <form class="form-horizontal" role="form" method="POST" action="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
 		       <h4>Username : </h4><br />
            <input type="text" class="text" placeholder="Username" name="username" value="{{ old('username') }}" />
            <h4>Password : </h4><br />
            <input type="password"  placeholder="Password" name="password" />       
        
            <br><br>
             <label class="hvr-sweep-to-right">
              <input type="submit" value="Submit"></a>
                   </label>
          </form>

          <div class="create">
        <a class="hvr-sweep-to-right" href="/client/register">Register</a>
        <div class="clearfix"> </div>
      </div>
        </div>

     
  </div>
</div>
</div> 
  </div>
                </div>   
            </div>
            
        </div>

@stop 