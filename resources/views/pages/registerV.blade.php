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
		<!--logo-->
			<div class="logo">
				<h1><a href="{{ URL::to('/home') }}">MQUES</a></h1>
			</div>
		<!--//logo-->
		<div class="top-nav">
			<ul class="right-icons">
				<li><a  href="{{ URL::to('/home') }}">Home</a></li>
				<li><a  href="{{ URL::to('/about') }}">About Us</a></li>
				<!-- <li> <a href="#">Add Transaction &#9662;</a>
           					 <ul class="dropdown">
                				<li><a href="{{ URL::to('/registerV') }}">Register Vehicle</a></li>
                				<li><a href="{{ URL::to('/registerL') }}">Register License</a></li>
           					 </ul>
        				</li> -->
        		<li><a  href="{{ URL::to('/viewQueue') }}">View Queue</a></li>
				<li><a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a></li>
				<li><a  href="{{ URL::to('/auth/logout') }}"><i class="glyphicon glyphicon-user"> </i>Rhea</a></li>
				
				
			</ul>
				   
				<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
				<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
			<!---//pop-up-box---->
				<div id="small-dialog" class="mfp-hide">
					    <!----- tabs-box ---->
				<div class="sap_tabs">	
				     <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">			  	 
						  <div class="resp-tabs-container">
						  		<div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
								 	<div class="facts">
									  	<div class="login">
											<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search Address, Neighborhood, City or Zip';}">		
									 		<input type="submit" value="">
									 	</div>        
							        </div>
						  		</div>
					      </div>
					 </div>
					 <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
				    	<script type="text/javascript">
						    $(document).ready(function () {
						        $('#horizontalTab').easyResponsiveTabs({
						            type: 'default', //Types: default, vertical, accordion           
						            width: 'auto', //auto or any width like 600px
						            fit: true   // 100% fit in a container
						        });
						    });
			  			 </script>	
				</div>
				</div>
				 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>
					
	
		</div>
		<div class="clearfix"> </div>
		</div>	
</div>
	<div class="clearfix"> </div>
		<!--initiate accordion-->
		<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
		</script>
      		
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
	<div class="home-loan">
		<h3>Registration of Vehicle Form</h3>
		 
		<div class="loan-point">
		<div class="center1">
			<table width="1185px" border="2px">
				<tr>
				<td align="center"> TO: MV INSPECTOR- THIS FORM WILL BE USED AS<BR/> A SOURE DOCUMENT IN COMPUTERIZATION <BR/>FILL UP COMPLETELY AND ACCURATELY IN INK.</td>
					<TD align="center">MOTOR VEHICLE <BR/> INSPECTION REPORT</TD>
			</table>
		</div>
		<div align="center"> OWNERSHIP AND DOCUMENTATION</div>
			<div class="center1">
			<table width="1185px" border="2px" >
			
			 
				<tr>
					<tr><td align="center">Owner's Complete Name <input type="text" name="name" value="{{ old('name') }}">
					<td align="center"> Address <input type="text" name="address" value="{{ old('address') }}"></td>
					<td align="center"> Agency <input type="text" name="agency" value="{{ old('agency') }}"></td>
					<td align="center"> Date <?php $dt = new DateTime(); ?>
                       <input type="text" class="form-control" name="date" value='<?php echo $dt->format('m/d/Y'); ?>'>
                    </td>
					</tr></td>	
					
				</tr>
				
				<tr>
					<td align="center">ACQUIRED FROM
					<td align="center" >Authorized Agency(For Hire Only)<input type="text" name="authAgency" value="{{ old('authAgency') }}"></td>
					<td align="center"> File Number <input type="text" name="fileNumber" value="{{ old('fileNumber') }}"></td>
					<td></td>
					<TR>
						<TD align="center" >Name:<input type="text" name="AcqName" value="{{ old('AcqName') }}"><br> 
						<br>Address:<input type="text" name="AcqAddress" value="{{ old('AcqAddress') }}"></TD>
						<td align="center">Type Of Registration
						<br>
						<?php  
						echo Form::select('registrationType', array('New' => 'New', 'Renewal' => 'Renewal'));?>
						</td>
						<td align="center">MVRR Number(Latest)<input type="text" name="MVRRNo" value="{{ old('MVRRNo') }}" ></td>
						<td align="center">CHPG Control Number<input type="text" name="CHPGNo" value="{{ old('CHPGNo') }}"></td>
					</TR>
					<tr>
						<td align="center">ENCUMBRANCE</td>
					<td align="center" >Certificate of payment number (C.P)<input type="text" name="CertPaymentNo" value="{{ old('CertPaymentNo') }}"></td>
					<td align="center"> Informal Entry Number (I.E) <input type="text" name="inEntryNo" value="{{ old('inEntryNo') }}"></td>
					<td></td>
					</tr>
					<tr>
						<TD align="center" >Name:<input type="text" name="enName" value="{{ old('enName') }}"><br> 
						<br>Address:<input type="text" name="enAddress" value="{{ old('enAddress') }}"></TD>
						<td align="center">Insurer<input type="text" name="insurer" value="{{ old('insurer') }}"></td>
						<td align="center">Policy Number<input type="text" name="policyNumber" value="{{ old('policyNumber') }}"></td>
						<td></td>
					</tr>
					<TR>
						<td align="center">Kind Of Vehicle
						<br>
				<?php 
				echo Form::select('kindOfVehicle', array('New' => 'New', '2ND Hand' => '2ND Hand','Result' => 'Result',
					'Car' => 'Car','Truck' => 'Truck','Hire' => 'Hire','MC' => 'MC','TC' => 'TC'));?>
					</td>
						<td align="center">Expiry Date<input type="date" class="form-control" name="expiryDate" id="datepicker" value="{{ old('expiryDate') }}"></td>
						<td align="center">Cert. of Cover No.<input type="text" name="certOfCoverNo" value="{{ old('certOfCoverNo') }}"></td>
						<td align="center">Endorsement No.<input type="text" name="endorsementNo" value="{{ old('endorsementNo') }}"></td>
					</TR>
					<tr>
						
							<td align="center " >Date of Endorsement<input type="date" class="form-control" id="datepicker" name="dateOfEndorsement" value="{{ old('dateOfEndorsement') }}"></td>
							<td align="center">Amount Of Coverage
							<td align="center">PL <br>P<input type="text" name="AmountCoveragePL" value="{{ old('AmountCoveragePL') }}"></td>
							<td align="center">TPL <br>P<input type="text" name="AmountCoverageTPL" value="{{ old('AmountCoverageTPL') }}"></td>
						
					</tr>

					</td>
				</tr>
			</table>
			</div>
			
	</div>
	

	<div align="center"> IDENTIFICATION AND INSPECTION</div>
			<div class="center1">
			<table width="1185px" border="2px" >
			 
				<tr>
					<tr>
					<td align="center">Classification
						<?php echo Form::select('classification', array('PUJ' => 'PUJ', 'PUV' => 'PUV','Private' => 'Private'));?>
					</td>
					<td align="center"> Make/Brand <input type="text" name="make_brand" value="{{ old('make_brand') }}"></td>
					<td align="center"> Plate NO. <input type="text" name="plateNo" value="{{ old('plateNo') }}"></td>
					<td align="center"> Type of Fuel 
						<?php echo Form::select('fuelType', array('Gas' => 'Gas', 'Diesel' => 'Diesel','LPG' => 'LPG',
						'CNG' => 'CNG','Electric' => 'Electric'));?>
						</td>
					</tr></td>	
					
				</tr>
				
				<tr>
					<td align="center">Motor Number<input type="text" name="motorNo" value="{{ old('motorNo') }}"></td>
					<td align="center" >Serial/Chassis Number<input type="text" name="serial_chassisNo" value="{{ old('serial_chassisNo') }}"></td>
					<td align="center"> Series <input type="text" name="series" value="{{ old('series') }}"></td>
					<td align="center"> Type of Body <input type="text" name="typeOfBody" value="{{ old('typeOfBody') }}"></td>
					<tr>
							<td align="center"> No. of Door <input type="text" name="noOfDoor" value="{{ old('noOfDoor') }}"></td>
							<td align="center"> Year Model <input type="text" name="yearModel" value="{{ old('yearModel') }}"></td>
							<td align="center " >I HEREBY NOTIFY THAT ALL INFORMATION AND STENCIL BELOW ARE TRUE AND CORRECT.
							<td align="center">INPECTOR'S PRINTED NAME AND SIGNATURE <img src="images/arrow.png" size="220px"></td>
							
						
					</tr>

					</td>
				</tr>
			</table>
			</div>
			
	</div>
			</table>
			</div>
			 
			</div>
			</div>
	</div>
</div>
</div>
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

