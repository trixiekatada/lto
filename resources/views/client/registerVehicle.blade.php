@extends('layouts.login')


@section('title')

@stop


@section('content')
<div class="header">
	<div class="container">
		<title>Register Vehicle</title>
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
        <div class="panel-title">Register Vehicle Form (Please Fill up correctly)</div>
    </div>  
    <div class="panel-body" >
   
        <form id="signupform" class="form-horizontal" role="form" method="POST">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}" >
	        
            <div class="form-group">
                <label class="col-md-3 control-label">First Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="first_name" value="{{ $data->first_name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class="col-md-3 control-label">Last Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="last_name" value="{{ $data->last_name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Address</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="address" value="{{ $data->address }}">
                </div>
            </div>    
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Agency</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="agency"  value="{{ old('agency') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Date</label>
                <div class="col-md-9">
                    <?php $date = new DateTime(); ?>
                    <input type="text" class="form-control" name="date" value='<?php echo $date->format('m/d/Y'); ?>'>
                </div>
            </div>
           <h3 align="center">ACQUIRED FROM</h3>
             <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">File Number</label>
                <div class="col-md-9">
                    <input type="text"  class="form-control" name="fileNumber" value="{{ old('fileNumber') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Authorized Agency(For Hire Only)</label>
                <div class="col-md-9">
                     <input type="text"  class="form-control" name="authAgency" value="{{ old('authAgency') }}">
                </div>
            </div>
        	<div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Agency Name: </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="agencyName" value"{{ old('agencyName') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Agency AAddress</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="agencyAddress" value"{{ old('agencyAddress') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Type Of Registration</label>
                <div class="col-md-9">
                    {!! Form::select('TOR', array('New' => 'New','Renewal' => 'Renewal',)); !!}
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">MVRR Number(Latest)</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="MVRRNo" value"{{ old('MVRRNo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">CHPG Control Number</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="CHPGNo" value"{{ old('CHPGNo') }}">
                </div>
            </div>
            <h3 align="center">ENCUMBRANCE</h3>
              <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Certificate of payment number (C.P)</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="COPNo" value"{{ old('COPNo') }}">
                </div>
            </div>
              <div class="form-group">
                <label for="first_name" class="col-md-3 control-label"> Informal Entry Number (I.E)</label>
                <div class="col-md-9">
                   <input type="text" class="form-control" name="IENo" value"{{ old('IENo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Name: </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="ie_name" value"{{ old('ie_name') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Address</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="ie_address" value"{{ old('ie_address') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Insurer: </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="insurer" value"{{ old('insurer') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Policy Number</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="policyNumber" value"{{ old('policyNumber') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Kind of Vehicle</label>
                <div class="col-md-9">
                    {!! Form::select('kindOfVehicle', array('New' => 'New','Second Hand' => 'Second Hand','Result'=>'Result',
                    'Car'=>'Car','Truck'=>'Truck','Hire'=>'Hire','MC'=>'MC','TC'=>'TC')); !!}
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Expiry Date</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="expiryDate" value"{{ old('expiryDate') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="col-md-3 control-label">Cert. of Cover No.</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="COCNo" value"{{ old('COCNo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Endorsement No.</label>
                <div class="col-md-9">
                 <input type="text" class="form-control" name="ENo" value"{{ old('ENo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label"> Date of Endorsement</label>
                <div class="col-md-9">
                <input type="text" class="form-control" name="dateENo" value"{{ old('dateENo') }}">
                </div>
            </div>
            <h3 align="center">Amount Of Coverage</h3>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">PL</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="PL" value"{{ old('PL') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">TPL</label>
                <div class="col-md-9">
                   <input type="text" class="form-control" name="TPL" value"{{ old('TPL') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Classification</label>
                <div class="col-md-9">
                     {!! Form::select('classification', array('PUJ' => 'PUJ','PUV' => 'PUV','Private'=>'Private')); !!}
                </div>
            </div>
            <div class="form-group">
                <label for="birthplace" class="col-md-3 control-label">Make Brand</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="brand" value"{{ old('brand') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Plate Number</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="plateNo" value"{{ old('plateNo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Type of Fuel </label>
                <div class="col-md-9">
                    {!! Form::select('typeOfFuel', array('Gas' => 'Gas','Diesel' => 'Diesel','LPG'=>'LPG','CNG'=>'CNG','Electric'=>'Electric')); !!}
                </div>
            </div>
             <div class="form-group">
                <label for="password" class="col-md-3 control-label">Motor Number</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="motorNo" value"{{ old('motorNo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Serial/Chassis Number</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="serialNo" value"{{ old('serialNo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Series</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="series" value"{{ old('series') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Type of Body</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="typeOfBody" value"{{ old('typeOfBody') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Number of Door</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="doorNo" value"{{ old('doorNo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Year Model</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="yearModel" value"{{ old('yearModel') }}">
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