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
	<div class="loan-col">
				<h3>Register</h3>
	</div>
	<div class="container">
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<div class="panel-body">

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

	<form class="form-horizontal" role="form" method="POST" action="/auth/register
	">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-info">
	
	<label >Name</label>
		<input type="text" class="form-control" name="name" value="{{ old('name') }}">	
	<label > Address</label>
		<input type="text" class="form-control" name="address" value="{{ old('address') }}">
	<label >Mobile Number</label>
		<input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">
	<label >Date of Birth</label>
		<input type="date" class="form-control" name="birth" id="datepicker" value="{{ old('birth') }}">
		</br>
	<label >Gender</label>
	<!-- <input type="email" class="form-control" name="gender" value="{{ old('gender') }}"> -->
	<?php 
	echo Form::select('gender', array('female' => 'Female', 'male' => 'Male'));
	?>	
	</br></br>
	<label >Email Address</label>
		<input type="email" class="form-control" name="email" value="{{ old('email') }}">
	<label >Password</label>
		<input type="password" class="form-control" name="password">
	<label >Confirm Password</label>
		<input type="password" class="form-control" name="password_confirmation">
<!-- </form> -->
</div>
		<div class="form-group" align="center">
		<div class="sub">
		<label class="hvr-sweep-to-right"><input type="submit" value="Register" placeholder="" align="center"></label>
		</div>
			<p>Already have a MQUES account? <a href="{{ URL::to('/auth/login') }}">Login</a></p>						
		</div>
	</div>

	</form>
	
	</div>
	</div>
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