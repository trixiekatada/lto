
@extends('layouts.login')


@section('content')
<title>Teller Login</title>
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

  
       
          
  
    </div>
    <div class="clearfix"> </div>
    </div>  
</div>
<div class="login-right">
  <div class="container">
    {!! (isset( $msg ) ? '<h1 style="color: #f00; text-align: center;" class="msg">'.$msg.'</h1>':'') !!}
    <h3>Teller Login</h3>
    <div class="login-top">
        <div class="form-info">
          {!! Form::open() !!}
           <form class="form-horizontal" role="form" method="POST" action="/teller/login">
 		       <h4>Email Address</h4><br />
            <input type="email" class="text" placeholder="Email Address" name="email" value="{{ old('email') }}" />
            <h4>Password</h4><br />
            <input type="password"  placeholder="Password" name="password" />       
        
            <br><br>
             <label class="hvr-sweep-to-right">
              <input type="submit" value="Submit"></a>
                   </label>
          </form>
          {!! Form::close() !!}
        </div>
      <div class="create">
        <h4>New Teller?</h4>
        <a class="hvr-sweep-to-right" href="/teller/register">Create an Account</a>
        <div class="clearfix"> </div>
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
     
      var email = $('input[name="email"]').val();
      var password = $('input[name="password"]').val();

      if( (email == '' || email == 'undefined') || (password == '' || password == 'undefined') ){
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