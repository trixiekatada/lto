@extends('layouts.masters')

@section('content')
  
<div class="header">
	<div class="container">
		<!--logo-->
			<div class="logo">
				<h1><a  href="{{ URL::to('/home') }}">MQUES</a></h1>
			</div>
	</div>
</div>
<div class="login-right">
	
	
<!--  <div class="container-fluid"> -->
 <div class="row">

 <div class="col-md-8 col-md-offset-2">
 <!-- <div class="panel panel-default"> -->
 <!-- <div class="panel-heading">Login</div> -->
 <div class="panel-body">
					
     @if (Session::has('flash_error'))
	 <div class="alert alert-danger">
	 <strong>Whoops! </strong> There were some problems with your input. <br> <br>
	 <ul>
	
            @foreach ($errors->all() as $error)
		 <li>{{ $error }} </li>
	    @endforeach
	 </ul>
	 </div>
     @endif

 <form class="form-horizontal" role="form" method="POST" action="/auth/login">
 <input type="hidden" name="_token" value="{{ csrf_token() }}">

 <h3><span>Log</span>in</h3> 
 <div class="form-info">
					<!-- <form> -->
					<label >E-mail Address: </label>
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						<label >Password: </label>
						<input type="password" class="form-control" name="password">
						 <label class="hvr-sweep-to-right">
				           <input type="submit" value="Submit">
				          </label>
				           <a  href="{{ URL::to('/password/email') }}">Forgot Your Password? </a>
					<!-- </form> -->
				</div>
				<div class="create">
				<h4>New To MQUES?</h4>
				<a class="hvr-sweep-to-right" href="{{ URL::to('/auth/register') }}">Create an Account</a>
				<div class="clearfix"> </div>
			</div>
 </form>
</div>

<!--  </div> -->
 </div>
 </div>
 </div>
 <!-- </div> -->
 <!-- </div> -->
 </div>
<div class="footer">
	<div class="container">
		<div class="footer-top-at">
			
			<div class="col-md-3 amet-sed">
				<h4>Customer Support</h4>
				<p>Mon-Fri, 7AM-7PM </p>
				<p>Sat-Sun, 8AM-5PM </p>
				<p>177-869-6559</p>	
			</div>
			
		<div class="clearfix"> </div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="col-md-4 footer-logo">
				<h2><a href="index.html">MQUES</a></h2>
			</div>
			<div class="col-md-8 footer-class">
				<p >© 2015 MQUES. </p>
			</div>
		<div class="clearfix"> </div>
	 	</div>
	</div>
</div>
@stop