@extends('layouts.masters')

@section('title')
MQUES
@stop

@section('content')
<style type="text/css">
    ul li{
        display: inline-block;
        position: relative;
        line-height: 21px;
        text-align: left;
    }
    ul li a{
        display: block;
        padding: 8px 25px;
        color:	#FFF0F5;
        text-decoration: none;
    }
    ul li a:hover{
        color: #fff;
        background: #90EE90;
    }
    ul li ul.dropdown{
        min-width: 140px; /* Set width of the dropdown */
        background:	#27da93;
        display: none;
        position: absolute;
        z-index: 1000;
        left: 0;
    }
    ul li:hover ul.dropdown{
        display: block;	/* Display the dropdown */
    }
    ul li ul.dropdown li{
        display: block;
    }
    .center {
  	margin: auto;
    width: 1185px;
    border:2px solid #708090;
    padding: 10px;
    height: 800px;
}
.button{
    text-decoration: none;
	font-size: 1.5em;
	border: .05px solid #fff;
	color:#fff;
	padding: 0.3em 0.5em;
	display:inline-block;
	margin: 0em 0 0;
    }
</style>

<div class="header">
	<div class="container">
		<!--logo-->
			<div class="logo">
				<h1><a href="{{ URL::to('/home') }}">MQUES</a></h1>
			</div>
		<!--//logo-->
		<div class="top-nav"> 
			<ul class="right-icons">
				<li><a  href="{{ URL::to('/home') }}">Home</a></li>
				<li><a  href="{{ URL::to('/about') }}">About Us</a></li>
        		<li><a  href="{{ URL::to('/viewQueue') }}">View Queue</a></li>
				<li><a  href="{{ URL::to('/auth/logout') }}"><i class="glyphicon glyphicon-user"> </i>Logout</a></li>
			</ul>
		</div>		
	</div>
</div>

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
<div class="container">
<form class="form-horizontal" role="form" method="POST" action="/registerL">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
		<div class="loan-point">
		 @foreach($data as $data)
			<div class="center1"> 
			<div class="form-style-6">
			<h1>Registration of License Form</h1>
				

				<label>Name</label><input type="text" name="name" value="{{ $data->name }}">
				<label>Present Address(No.,Street,City/Municipality,Province)</label><input type="text" name="address" value="{{ $data->address }}">
				<label>Nationality</label><input type="text" name="nationality" value="{{ old('nationality') }}">
				<label>Gender</label></br>
					<?php echo Form::select('gender', array('Female' => 'Female', 'Male' => 'Male'));?>
					
				<label>Birthday</label><input type="date" class="form-control" name="birth" id="datepicker" value="{{ $data->birth }}">
				<label>Height(cm)</label><input type="text" name="height" value="{{ old('height') }}">
				<label>Weight(kg)</label><input type="text" name="weight" value="{{ old('weight') }}">
				<label>Tel No/CP No.</label><input type="text" name="telNo" value="{{ $data->mobile }}">
					 <!-- @endforeach -->
					<label>Type of Application(TOA)</label>
							<?php echo Form::select('TOA', array('New' => 'New', 'Delinquent_Dormant_Liscence' => 'Delinquent/Dormant Liscence', 'Change_Classification' => (array('Proof_to_Non-Proof' => 'Proof to Non-Proof', 'Non-Proof_to_Proof' => 'Non-Proof to Proof' )), 'Foreign_Lic_Convertion' => 'Foreign Licencse Convertion',
						'Renewal' => 'Renewal', 'Additional_Restriction_Code' => 'Additional Restriction Code', 'Duplicate' => 'Duplicate', 'Change_Civil_Status' => 'Change Civil Status', 'Change_Name' => 'Change Name',
						'Change_Of_Birth' => 'Change Of Birth', 'Others' => 'Others' ));?>
					
					<label>Type of License Applied for(TLA)</label>
						<?php  echo Form::select('TLA', array('Student_Permit' => 'Student Permit', 'Non-Proofesional' => 'Non-Proofesional', 'Professional' => 'Professional', 'Conductor' => 'Conductor'));?>
					
					<label>Driving Skill Acquired or Will be Acquired Thru(DSA)</label>
						<?php echo Form::select('DSA', array('Driving_School' => 'Driving School', 'License_Private_Person' => 'License Private Person'));?>
					
					<label>Educational Attainment(EA)</label>
						<?php  echo Form::select('EA', array('Informal_Schooling' => 'Informal Schooling', 'Elementary' => 'Elementary', 'High_School' => 'High School', 'Vocational' => 'Vocational', 'College' => 'College', 'Post_Graduate' => 'Post Graduate'));?>
						
					<label>Blood Type</label><input type="text" name="bloodType" value="{{ old('bloodType') }}">
					<label>Organ Donor?</label></br><?php echo Form::select('donorBoolean', array('Yes' => 'Yes', 'No' => 'No'));?></td>
					<label>Civil Status</label></br><?php echo Form::select('civilStatus', array('Single' => 'Single', 'Married' => 'Married', 'Window'.'/'.'er' => 'Window/er', 'Separeted' => 'Separated'));?>
					<label>Hair</label></br> <?php echo Form::select('hair', array('Black' => 'Black', 'Brown' => 'Brown', 'Blonde' => 'Blonde', 'Others' => 'Others'));?>
					
					<label>Eyes</label></br><?php echo Form::select('eyes', array('Black' => 'Black', 'Brown' => 'Brown', 'Gray' => 'Gray', 'Others' => 'Others'));?>
					<label>Built</label></br><?php echo Form::select('built', array('Light' => 'Light', 'Medium' => 'Medium', 'Heavy' => 'Heavy'));?>
					<label>Complexion</label></br><?php echo Form::select('complexion', array('Light' => 'Light', 'Fair' => 'Fair', 'Dark' => 'Dark'));?>
					<label>Date</label><?php $date = new DateTime(); ?>
                       <input type="text" class="form-control" name="date" value='<?php echo $date->format('m/d/Y'); ?>'>
    
					<label>Birth Place</label><input type="text" name="birthPlace" value="{{ old('birthPlace') }}">
					<label>Father's Name</label><input type="text" name="fatherName" value="{{ old('fatherName') }}">
					<label>Mother's Name</label><input type="text" name="motherName" value="{{ old('motherName') }}">
						

			</div>	
		</div>
	</div>
</div>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/>	
<div class="about-middle">
		<div class="container">		
			<div class="col-md-8 about-mid">
				<h4>Application For Driver's License</h4>
				<b>Requirements</b>
				<br>
				Original NSO <br>
				Certificate of Stock Reported (CSR) <br>
				Certificate of Quality Control <br>
				Valid PNP-TMG MV Clearance Certificate <br>
				Duly accomplished and approved Motor Vehicle Inspection Report (MVIR) <br>
				Appropriate insurance certificate of cover <br>
				Valid Certificate of Public Convenience duly confirmed by the LTFRB, in case of for hire MV’s <br>
				Valid Motorized Tricycle Operators Permit (MTOP), for TC only <br>
				Taxpayer’s Identification Number (TIN)<br>
				
			</div>
			<div class="col-md-4 about-mid1">
				<p>Convert the Above Form into PDF File</p>
				<label class="hvr-sweep-to-right button"><input type="submit" value="Save As" placeholder="" align="center"></label>
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
					<p >© 2015 MQUES. Team Artisan. </p>
				</div>
		<div class="clearfix"> </div>
	 	</div>
	</div>
	</form>
@stop

