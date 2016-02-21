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
<form class="form-horizontal" role="form" method="POST" action="/registerL">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="home-loan">
		<h3>Application for Driver's License Form</h3>
		 
		<div class="loan-point">
		<div class="center1">
			<table width="1185px" border="2px">
				<tr>
				<td align="center"> INSTRUCTIONS</br>1.Accomplish the form correctly<BR/> 2.Print data legibly in capital letters <BR/>3.Submit this form to CSR/EVALATOR together with the required supporting documents</td>
					<TD align="center">APPLICATION FOR <BR/> DRIVER'S LICENSE</TD>
			</table>
		</div>
			<div class="center1">
			<table width="1185px" border="2px" >
			
			 
				<tr>
					<tr><td align="center">Name <input type="text" name="name" value="{{ old('name') }}">
					<td align="center">Present Address(No.,Street,City/Municipality,Province) <input type="text" name="address" value="{{ old('address') }}"></td>
					<td align="center"> Nationality <input type="text" name="nationality" value="{{ old('nationality') }}"></td>
					<td align="center">Gender</br>
					<?php echo Form::select('gender', array('Female' => 'Female', 'Male' => 'Male'));?></td>
					</tr></td>	
					
				</tr>
				
				<tr>
					<td align="center">Birtday<input type="date" class="form-control" name="birth" id="datepicker" value="{{ old('birth') }}">
					<td align="center" >Height(cm)<input type="text" name="height" value="{{ old('height') }}"></td>
					<td align="center"> Weight(kg)<input type="text" name="weight" value="{{ old('weight') }}"></td>
					<td align="center">Tel No/CP No.<input type="text" name="telNo" value="{{ old('telNo') }}"></td>
					<TR>
						<TD align="center" >Type of Application(TOA)
							<?php echo Form::select('TOA', array('New' => 'New', 'Delinquent_Dormant_Liscence' => 'Delinquent/Dormant Liscence', 'Change_Classification' => (array('Proof_to_Non-Proof' => 'Proof to Non-Proof', 'Non-Proof_to_Proof' => 'Non-Proof to Proof' )), 'Foreign_Lic_Convertion' => 'Foreign Licencse Convertion',
						'Renewal' => 'Renewal', 'Additional_Restriction_Code' => 'Additional Restriction Code', 'Duplicate' => 'Duplicate', 'Change_Civil_Status' => 'Change Civil Status', 'Change_Name' => 'Change Name',
						'Change_Of_Birth' => 'Change Of Birth', 'Others' => 'Others' ));?>
						</TD>
						<td align="center">Type of License Applied for(TLA)
						<br>
						<?php  echo Form::select('TLA', array('Student_Permit' => 'Student Permit', 'Non-Proofesional' => 'Non-Proofesional', 'Professional' => 'Professional', 'Conductor' => 'Conductor'));?>
						</td>
						<td align="center">Driving Skill Acquired or Will be Acquired Thru(DSA)
						</br><?php echo Form::select('DSA', array('Driving_School' => 'Driving School', 'License_Private_Person' => 'License Private Person'));?>
						</td>
						<td align="center">Educational Attainment(EA)
						<?php  echo Form::select('EA', array('Informal_Schooling' => 'Informal Schooling', 'Elementary' => 'Elementary', 'High_School' => 'High School', 'Vocational' => 'Vocational', 'College' => 'College', 'Post_Graduate' => 'Post Graduate'));?>
						</td>
					</TR>
					<tr>
						<td align="center">Blood Type <input type="text" name="bloodType" value="{{ old('bloodType') }}">
					<td align="center" >Organ Donor?</br><?php echo Form::select('donorBoolean', array('Yes' => 'Yes', 'No' => 'No'));?></td>
					<td align="center"> Civil Status</br><?php echo Form::select('civilStatus', array('Single' => 'Single', 'Married' => 'Married', 'Window'.'/'.'er' => 'Window/er', 'Separeted' => 'Separated'));?></td>
					<td align="center">Hair </br> <?php echo Form::select('hair', array('Black' => 'Black', 'Brown' => 'Brown', 'Blonde' => 'Blonde', 'Others' => 'Others'));?></td>
					</tr>
					<tr>
						<TD align="center" >Eyes </br><?php echo Form::select('eyes', array('Black' => 'Black', 'Brown' => 'Brown', 'Gray' => 'Gray', 'Others' => 'Others'));?></TD>
						<td align="center">Built </br><?php echo Form::select('built', array('Light' => 'Light', 'Medium' => 'Medium', 'Heavy' => 'Heavy'));?></td>
						<td align="center">Complexion </br><?php echo Form::select('complexion', array('Light' => 'Light', 'Fair' => 'Fair', 'Dark' => 'Dark'));?></td>
						<td></td>
					</tr>
					<TR>
						<td align="center">Birth Place<input type="text" name="birthPlace" value="{{ old('birthPlace') }}"></td>
						<td align="center">Father's Name<input type="text" name="fatherName" value="{{ old('fatherName') }}"></td>
						<td align="center">Mother's Name<input type="text" name="motherName" value="{{ old('motherName') }}"></td>
						<td align="center">THIS IS TO CERTIFY THAT THE INFORMATION ABOVE I GIVEN IS TRUE AND CORRECT <img src="images/arrow.png" size="220px"></td>
					</TR>
					

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

