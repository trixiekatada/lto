@extends('layouts.login')


@section('title')

@stop


@section('content')
<div class="header">
	<div class="container">
		
			<div class="logo">
				<h1><a href="index.html">MQUES</a></h1>
			</div>
	
		<div class="top-nav">
			<ul class="right-icons">
				<li><a  href="{{ URL::to('/client/login') }}"><i class="glyphicon glyphicon-user"> </i>User</a></li>			</ul>
			   
				<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
				<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	
				<div id="small-dialog" class="mfp-hide">
			
				
				</div>
		</div>
		<div class="clearfix"> </div>
		</div>	
</div>

<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title">Register License Form (Please Fill up correctly)</div>
    </div>  
    <div class="panel-body" >
        <form id="signupform" class="form-horizontal" role="form" method="POST">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">First Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="first_name" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class="col-md-3 control-label">Last Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="last_name" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Address</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="address" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Nationality</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="nationality" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Gender</label>
                <div class="col-md-9">
                    <?php echo Form::select('gender', array('Female' => 'Female', 'Male' => 'Male'));?>
            	</div>
        	</div>
        	<div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Birthdate</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="birthdate" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Height</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="height" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Weight</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="weight" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Tel No.</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="telno" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Type of Application</label>
                <div class="col-md-9">
                    <?php echo Form::select('TOA', array('New' => 'New', 'Delinquent_Dormant_Liscence' => 'Delinquent/Dormant Liscence', 'Change_Classification' => (array('Proof_to_Non-Proof' => 'Proof to Non-Proof', 'Non-Proof_to_Proof' => 'Non-Proof to Proof' )), 'Foreign_Lic_Convertion' => 'Foreign Licencse Convertion',
						'Renewal' => 'Renewal', 'Additional_Restriction_Code' => 'Additional Restriction Code', 'Duplicate' => 'Duplicate', 'Change_Civil_Status' => 'Change Civil Status', 'Change_Name' => 'Change Name',
						'Change_Of_Birth' => 'Change Of Birth', 'Others' => 'Others' ));?>
                </div>
            </div>
              <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Type of license Applied</label>
                <div class="col-md-9">
                    <?php  echo Form::select('TLA', array('Student_Permit' => 'Student Permit', 'Non-Proofesional' => 'Non-Proofesional', 'Professional' => 'Professional', 'Conductor' => 'Conductor'));?>
                </div>
            </div>
              <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Driving Skill Acquired or Will be Acquired Thru(DSA)</label>
                <div class="col-md-9">
                    <?php echo Form::select('DSA', array('Driving_School' => 'Driving School', 'License_Private_Person' => 'License Private Person'));?>
                </div>
            </div>
     
              <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Educational Attainment</label>
                <div class="col-md-9">
                    <?php  echo Form::select('EA', array('Informal_Schooling' => 'Informal Schooling', 'Elementary' => 'Elementary', 'High_School' => 'High School', 'Vocational' => 'Vocational', 'College' => 'College', 'Post_Graduate' => 'Post Graduate'));?>
                </div>
            	</div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Blood type</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="bloodtype" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Organ Donor?</label>
                <div class="col-md-9">
                    <?php echo Form::select('donor', array('Yes' => 'Yes', 'No' => 'No'));?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Civil Status</label>
                <div class="col-md-9">
                    <?php echo Form::select('civilStatus', array('Single' => 'Single', 'Married' => 'Married', 'Window'.'/'.'er' => 'Window/er', 'Separeted' => 'Separated'));?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Hair</label>
                <div class="col-md-9">
                    <?php echo Form::select('hair', array('Black' => 'Black', 'Brown' => 'Brown', 'Blonde' => 'Blonde', 'Others' => 'Others'));?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Eyes</label>
                <div class="col-md-9">
                    <?php echo Form::select('eyes', array('Black' => 'Black', 'Brown' => 'Brown', 'Gray' => 'Gray', 'Others' => 'Others'));?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Built</label>
                <div class="col-md-9">
                    <?php echo Form::select('built', array('Light' => 'Light', 'Medium' => 'Medium', 'Heavy' => 'Heavy'));?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Complexion</label>
                <div class="col-md-9">
                    <?php echo Form::select('complexion', array('Light' => 'Light', 'Fair' => 'Fair', 'Dark' => 'Dark'));?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Date of transaction</label>
                <div class="col-md-9">
                    <?php $date = new DateTime(); ?>
                    <input type="text" class="form-control" name="date" value='<?php echo $date->format('m/d/Y'); ?>'>
                </div>
            </div>
            <div class="form-group">
                <label for="icode" class="col-md-3 control-label">Birth Place</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="birthdate" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Mother's Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="mothername" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Father's Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="fathername" placeholder="">
                </div>
            </div>
            <div style="border-top: 1px solid #999; padding-top:50px"  class="form-group">
            

                <div class="col-md-offset-3 col-md-9">
                    <label class="hvr-sweep-to-right button"><input type="submit" value="Convert to PDF" placeholder="" align="center"></label>
                </div>                                           
                    
            </div>
            
            
            
        </form>
     </div>
</div>
</div>

	
@stop