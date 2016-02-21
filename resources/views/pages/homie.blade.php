<!DOCTYPE html>
<html>
<head>
<title>MQUES</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.min.js"></script>
<script src="js/scripts.js"></script>
<link href="css/styles.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

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
				<li> <a href="#">Add Transaction &#9662;</a>
           					 <ul class="dropdown">
                				<li><a href="{{ URL::to('/registerV') }}">Register Vehicle</a></li>
                				<li><a href="{{ URL::to('/registerL') }}">Register License</a></li>
           					 </ul>
        				</li>
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

<div class="blog">
<div class="container">
	
   <div class="col-md-9 blog-head">
	     <div class="blog-top">
	         <a href="blog_single.html"><img src="images/test.png" class="img-responsive" alt=""/></a>
	         <h2><a href="blog_single.html"> LTO QUEUE MANAGEMENT SYSTEM </a></h2>
	         <h4>Vision</h4>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make. a type specimen book. It has survived not only five centuries. but also the leap into electronic typesetting, remaining essentially unchanged. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, </p>
	         <!-- <a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a> -->
	           <!-- <div class="links">
		  		  <ul class="blog-links">
		  			<li><a href="#"><i class="blog_circle">24 </i><span>Comments</span></a></li>
		  			<li><a href="#"><i class="glyphicon glyphicon-heart"> </i><span>Like</span></a></li>
		  		  </ul>
		  	   </div> -->
		 </div>  
		  <div class="blog-top">
	         <h4>Mission</h4>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make. a type specimen book. It has survived not only five centuries. but also the leap into electronic typesetting, remaining essentially unchanged. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, </p>
	         <a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
	           <!-- <div class="links">
		  		  <ul class="blog-links">
		  			<li><a href="#"><i class="blog_circle">24 </i><span>Comments</span></a></li>
		  			<li><a href="#"><i class="glyphicon glyphicon-heart"> </i><span>Like</span></a></li>
		  		  </ul>
		  	   </div> -->
		 </div>  
		 
	</div>
	<div class="col-md-3 blog-sidebar">
		<div class="blog-list">
	     	<h4>Categories</h4>
			<ul >
				<li><a href="#"><i class="glyphicon glyphicon-arrow-right"> </i>History of LTO</a></li>
				<li><a href="#"><i class="glyphicon glyphicon-arrow-right"> </i>Services</a></li>
				<li><a href="#"><i class="glyphicon glyphicon-arrow-right"> </i>Other LTO Services</a></li>
			</ul>
			
			<div class="clearfix"> </div>
		 </div>
		 <div class="blog-list1">
	     	<h4>Popular Posts</h4>
			<div class="blog-list-top">
				<div class="blog-img">
					<a href="blog_single.html"><img class="img-responsive" src="images/lto_office.png" alt=""></a>
				</div>
				<div class="blog-text">
					<p ><a href="#">Lorem ipsum dolor sit amet, consectetuer</a></p>
					<span class="link">
						Feb 14, 2015
						<a href="#">
							<i class="glyphicon glyphicon-heart"> </i>
						</a>16
					</span>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="blog-list-top">
				<div class="blog-img">
					<a href="blog_single.html"><img class="img-responsive" src="images/new_plates.png" alt=""></a>
				</div>
				<div class="blog-text">
					<p ><a href="blog_single.html">Lorem ipsum dolor sit amet, consectetuer</a></p>
					<span class="link">
						Feb 14, 2015
						<a href="#">
							<i class="glyphicon glyphicon-heart"> </i>
						</a>16
					</span>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="blog-list-top">
				<div class="blog-img">
					<a href="blog_single.html"><img class="img-responsive" src="images/ltfrb_logo.png" alt=""></a>
				</div>
				<div class="blog-text">
					<p ><a href="blog_single.html">Lorem ipsum dolor sit amet, consectetuer</a></p>
					<span class="link">
						Feb 14, 2015
						<a href="#">
							<i class="glyphicon glyphicon-heart"> </i>
						</a>16
					</span>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="blog-list-top">
				<div class="blog-img">
					<a href="blog_single.html"><img class="img-responsive" src="images/test_car.png" alt=""></a>
				</div>
				<div class="blog-text">
					<p ><a href="blog_single.html">Lorem ipsum dolor sit amet, consectetuer</a></p>
					<span class="link">
						Dec 14, 2013
						<a href="#">
							<i class="glyphicon glyphicon-heart"> </i>
						</a>16
					</span>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="blog-list-top">
				<div class="blog-img">
					<a href="blog_single.html"><img class="img-responsive" src="images/pnp_logo.png" alt=""></a>
				</div>
				<div class="blog-text">
					<p ><a href="blog_single.html">Lorem ipsum dolor sit amet, consectetuer</a></p>
					<span class="link">
						Dec 14, 2013
						<a href="#">
							<i class="glyphicon glyphicon-heart"> </i>
						</a>16
					</span>
				</div>
				<div class="clearfix"> </div>
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
<!--//footer-->
</body>
</html>