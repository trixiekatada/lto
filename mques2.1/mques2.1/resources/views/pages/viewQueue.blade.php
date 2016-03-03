@extends('layouts.masters')


@section('title')
Patient Information System
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
</style>
<div class="header">
	<div class="container">
		<!--logo-->
			<div class="logo">
				<h1><a href="index.html">MQUES</a></h1>
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
                				<li><a href="{{ URL::to('/renewL') }}">Renew License</a></li>
           					 </ul>
        				</li>
        		<li><a  href="{{ URL::to('/viewQueue') }}">View Queue</a></li> -->
				<li><a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a></li>
				<li><a  href="{{ URL::to('/auth/logout') }}"><i class="glyphicon glyphicon-user"> </i>Welcome!</a></li>
				
				
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
<!--//-->	
	<div class="container">

<div class="premium">
	<div class="pre-top">
		<h5>Current Queue</h5>
		<p>It may change by the teller. Cut off 150 transaction only everyday.</p>
	</div>
</div>
<div class="container">
	<div class="future">	
			<div >
					<ul align="center">			
						<li><div class="project-fur">
						<div class="fur2">
			                               	<span>Teller 1</span>
			                             </div>
									<div class="fur">
										<div class="fur1">
		                                    <h6 class="fur-name">Now Serving</h6>
		                                    <h1 align="center" size="500px">001</h1>
                               			</div>
			                            <div class="fur2">
			                               	<span>EVALUATION</span>
			                             </div>
									</div>					
							</div></li>
							<li><div class="project-fur">
							<div class="fur2">
			                               	<span>Teller 2</span>
			                             </div>
										<div class="fur">
										<div class="fur1">
		                                    <h6 class="fur-name">Now Serving</h6>
		                                    <h1 align="center" size="500px">006</h1>
                               			</div>
			                            <div class="fur2">
			                               	<span>PHOTO SIGNATURE</span>
			                             </div>
									</div>					
								</div></li>
								<li><div class="project-fur">
								<div class="fur2">
			                               	<span>Teller 3</span>
			                             </div>
									<div class="fur">
										<div class="fur1">
		                                    <h6 class="fur-name">Now Serving</h6>
		                                    <h1 align="center" size="500px">010</h1>
                               			</div>
			                            <div class="fur2">
			                               	<span>CASHIER</span>
			                             </div>
									</div>					
							</div></li>
							
					<script type="text/javascript">
						$(window).load(function() {
							$("#flexiselDemo1").flexisel({
								visibleItems: 6,   		
								enableResponsiveBreakpoints: true,
						    	responsiveBreakpoints: { 
						    		portrait: { 
						    			changePoint:480,
						    			visibleItems: 1
						    		}, 
						    		landscape: { 
						    			changePoint:640,
						    			visibleItems: 2
						    		},
						    		tablet: { 
						    			changePoint:768,
						    			visibleItems: 3
						    		}
						    	}
						    });
						    
						});
			</script>
			<script type="text/javascript" src="js/jquery.flexisel.js"></script>
		</div>
		<br>
		<br>

		<div class="project-fur">
	
		<div class="fur2">
			 	<table width="1080px" >
			 		<tr >
			 			<td align="center"><h4><b>Teller No.</h4></td>
			 			<td align="center"><h4><b>Serving</h4></td>
			 			<td align="center"><h4><b>Total Queue</h4></td>
			 			<td align="center"><h4><b>Minutes Process</h4></td>
			 			<td align="center"><h4><b>Total Hour/Minute/Seconds</h4></td>
			 		</tr>
			 		
			 		<tr class="fur2">
			 			<td align="center"><h4>1</h4></td>
			 			<td align="center"><h4>001</h4></td>
			 			<td align="center"><h4>24</h4></td>
			 			<td align="center"><h4>5</h4></td>
			 			<td align="center"><h4>01:32:08</h4></td>
			 		</tr>

			                         
		
			 	<tr class="fur2">
			 			<td align="center"><h4>2</h4></td>
			 			<td align="center"><h4>006</h4></td>
			 			<td align="center"><h4>24</h4></td>
			 			<td align="center"><h4>7</h4></td>
			 			<td align="center"><h4>02:30:01</h4></td>
			 		</tr>                            

			 	<tr class="fur2">
			 			<td align="center"><h4>3</h4></td>
			 			<td align="center"><h4>010</h4></td>
			 			<td align="center"><h4>24</h4></td>
			 			<td align="center"><h4>3</h4></td>
			 			<td align="center"><h4>00:32:08</h4></td>
			 		</tr>                            
	
			 	
			 		</table> 

		</div>
			</div>
										
		</div>
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
</div>

@stop