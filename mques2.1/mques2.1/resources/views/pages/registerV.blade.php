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
</head>
<body>

<div class="header">
	<div class="container">
		
			<div class="logo">
				<h1><a href="{{ URL::to('/home') }}">MQUES</a></h1>
			</div>
		
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
<form class="form-horizontal" role="form" method="POST" action="/registerV">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div>
		
			<div class="form-style-6">
			<h1>Registration of Vehicle Form</h1>
			 @foreach($data as $data)
				
					Owner's Complete Name <input type="text" name="name" value="{{ $data->name }}">
					Address <input type="text" name="address" value="{{ $data->address }}">
					Agency <input type="text" name="agency" value="{{ old('agency') }}">
					Date <?php $date = new DateTime(); ?>
                    <input type="text" class="form-control" name="date" value='<?php echo $date->format('m/d/Y'); ?>'>

				<!-- @endforeach -->
				
					<h3 align="center">ACQUIRED FROM</h3>
					Authorized Agency(For Hire Only)<input type="text" name="authAgency" value="{{ old('authAgency') }}">
					File Number <input type="text" name="fileNumber" value="{{ old('fileNumber') }}">
					
					
					Name:<input type="text" name="AcqName" value="{{ old('AcqName') }}">
					Address:<input type="text" name="AcqAddress" value="{{ old('AcqAddress') }}">
					Type Of Registration
						<?php  
						echo Form::select('registrationType', array('New' => 'New', 'Renewal' => 'Renewal'));?>
			
					MVRR Number(Latest)<input type="text" name="MVRRNo" value="{{ old('MVRRNo') }}" >
					CHPG Control Number<input type="text" name="CHPGNo" value="{{ old('CHPGNo') }}">
					
					<h3 align="center">ENCUMBRANCE</h3>
					Certificate of payment number (C.P)<input type="text" name="CertPaymentNo" value="{{ old('CertPaymentNo') }}">
					Informal Entry Number (I.E) <input type="text" name="inEntryNo" value="{{ old('inEntryNo') }}">
					
					
					Name:<input type="text" name="enName" value="{{ old('enName') }}">
					Address:<input type="text" name="enAddress" value="{{ old('enAddress') }}">
					Insurer<input type="text" name="insurer" value="{{ old('insurer') }}">
					Policy Number<input type="text" name="policyNumber" value="{{ old('policyNumber') }}">
						
					Kind Of Vehicle	
					<?php 
					echo Form::select('kindOfVehicle', array('New' => 'New', '2ND Hand' => '2ND Hand','Result' => 'Result',
					'Car' => 'Car','Truck' => 'Truck','Hire' => 'Hire','MC' => 'MC','TC' => 'TC'));?>
					
					 Expiry Date<input type="date" class="form-control" name="expiryDate" id="datepicker" value="{{ old('expiryDate') }}">
					 Cert. of Cover No.<input type="text" name="certOfCoverNo" value="{{ old('certOfCoverNo') }}">
					 Endorsement No.<input type="text" name="endorsementNo" value="{{ old('endorsementNo') }}">
					
						
					 Date of Endorsement<input type="date" class="form-control" id="datepicker" name="dateOfEndorsement" value="{{ old('dateOfEndorsement') }}">
					 Amount Of Coverage
					 PL <br>P<input type="text" name="AmountCoveragePL" value="{{ old('AmountCoveragePL') }}">
					 TPL <br>P<input type="text" name="AmountCoverageTPL" value="{{ old('AmountCoverageTPL') }}">
						
					Classification
						<?php echo Form::select('classification', array('PUJ' => 'PUJ', 'PUV' => 'PUV','Private' => 'Private'));?>
					
					Make/Brand <input type="text" name="make_brand" value="{{ old('make_brand') }}">
					Plate NO. <input type="text" name="plateNo" value="{{ old('plateNo') }}">
					Type of Fuel 
						<?php echo Form::select('fuelType', array('Gas' => 'Gas', 'Diesel' => 'Diesel','LPG' => 'LPG',
						'CNG' => 'CNG','Electric' => 'Electric'));?>
						
					
					Motor Number<input type="text" name="motorNo" value="{{ old('motorNo') }}">
					Serial/Chassis Number<input type="text" name="serial_chassisNo" value="{{ old('serial_chassisNo') }}">
					Series <input type="text" name="series" value="{{ old('series') }}">
					Type of Body <input type="text" name="typeOfBody" value="{{ old('typeOfBody') }}">
					
					No. of Door <input type="text" name="noOfDoor" value="{{ old('noOfDoor') }}">
					Year Model <input type="text" name="yearModel" value="{{ old('yearModel') }}">

				</div>
				</div>
			 
			</div>
			</div>
	</div>
</div>
</div>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
</br></br></br></br></br></br></br></br></br></br>
<div class="about-middle">
		<div class="container">		
			<div class="col-md-8 about-mid">
				<h4>Motor Vehicle Related Transaction</h4>
				<b>Requirements</b>
				<br>
				Original Sales Invoice of MV <br>
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

