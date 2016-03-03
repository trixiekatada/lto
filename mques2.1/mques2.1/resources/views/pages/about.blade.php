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
				<li> <a href="#">Add Transaction &#9662;</a>
           					 <ul class="dropdown">
                				<li><a href="{{ URL::to('/registerV') }}">Register Vehicle</a></li>
                				<li><a href="{{ URL::to('/registerL') }}">Register License</a></li>
                				<li><a href="{{ URL::to('/renewL') }}">Renew License</a></li>
           					 </ul>
        				</li>
        		<li><a  href="{{ URL::to('/viewQueue') }}">View Queue</a></li>
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
	<div class="about">	
	<div class="about-head">
		<div class="container">
			<h3>LTO QUEUE MANAGEMENT SYSTEM</h3>
				<div class="about-in">
					<a href="blog_single.html"><img src="images/at.jpg" alt="image" class="img-responsive ">	</a>			
					<h6 ><a href="blog_single.html">Lorem ipsum dolor sit amet, consectetur adipisci ngelit. Donec nisi sem, vestibulum Etortor tortor in turpis. Proin mauris nulla, rutrum aliquet arcu vel</a></h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nisi sem, vestibulum ac lobortis quis, aliquet in metus. Suspendi sse a nibh id eros consectetur laoreet. Etiam viverra auctor orci, eu mattis ipsum rutrum nec.
						Etortor tortor in turpis. Proin mauris nulla, rutrum aliquet arcu vel, porttitor varius dolor. Phasellus vitae tincidunt orci, et faucibus eros. Sed dolor sapien, pharetra placerat feugiat.</p>
				</div>
		</div>
	</div>
	<div class="about-middle">
		<div class="container">		
			<div class="col-md-8 about-mid">
				<h4>Lorem ipsum dolor</h4>
				<h6><a href="blog_single.html">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</a> </h6>
				<p >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen</p>
			</div>
			<div class="col-md-4 about-mid1">
				<p>The standard chunk of Lorem Ipsum used since adisipicing elit</p>
				<a href="blog_single.html" class="hvr-sweep-to-right more-in">READ MORE</a>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!---->
	<!---->
	<div class="choose-us">
		<div class="container">
			<h3>why choose us</h3>
			<div class="us-choose">
				<div class="col-md-6 why-choose">
					<div class="  ser-grid ">
						<i class="hi-icon hi-icon-archive glyphicon glyphicon-pencil"> </i>
					</div>
					<div class="ser-top beautiful"> 
						<h5>beautiful &amp; enjoyable designs</h5>
						<label>The standard chunk of Lorem</label>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-6 why-choose">
					<div class=" ser-grid">
						<i class="hi-icon hi-icon-archive glyphicon glyphicon-time"> </i>
					</div>
					<div class="ser-top beautiful"> 
						<h5>beautiful &amp; enjoyable designs</h5>
						<label>The standard chunk of Lorem</label>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="us-choose">
				<div class="col-md-6 why-choose">
					<div class=" ser-grid">
						<i class="hi-icon hi-icon-archive glyphicon glyphicon-cog"> </i>
					</div>
					<div class="ser-top beautiful"> 
						<h5>beautiful &amp; enjoyable designs</h5>
						<label>The standard chunk of Lorem</label>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-6 why-choose">
					<div class=" ser-grid">
						<i class="hi-icon hi-icon-archive glyphicon glyphicon-file"> </i>
					</div>
					<div class="ser-top beautiful"> 
						<h5>beautiful &amp; enjoyable designs</h5>
						<label>The standard chunk of Lorem</label>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
				
			</div>
		</div>
		<div class="container">
		<div class="content-events">
				<h3> Events & News</h3>
				<div class="news">
					<div class="col-md-4 new-more">
						<div class="event">
							<h4>26/06/2015</h4>
							<h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
						</div>
						<p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades goertayse</p>
						<a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
					</div>
					<div class="col-md-4 new-more">
						<div class="event">
							<h4>26/06/2015</h4>
							<h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
						</div>
						<p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades goertayse</p>
						<a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
					</div>
					<div class="col-md-4 new-more">
						<div class="event">
							<h4>26/06/2015</h4>
							<h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
						</div>
						<p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades goertayse</p>
						<a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="news">
					<div class="col-md-4 new-more">
						<div class="event">
							<h4>26/06/2015</h4>
							<h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
						</div>
						<p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades goertayse</p>
						<a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
					</div>
					<div class="col-md-4 new-more">
						<div class="event">
							<h4>26/06/2015</h4>
							<h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
						</div>
						<p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades goertayse</p>
						<a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
					</div>
					<div class="col-md-4 new-more">
						<div class="event">
							<h4>26/06/2015</h4>
							<h6><a href="blog_single.html">Sed ut perspiciatis unde omnis </a></h6>
						</div>
						<p>Kasertas lertyasea deeraeser miasera lertasa ritise doloert ferdas caplicabo nerafaes asety u lasec vaserat. nikertyade asetkertyptaiades goertayse.nikertyade asetkertyptaiades goertayse</p>
						<a class="hvr-sweep-to-right more" href="blog_single.html">Read More</a>
					</div>
					<div class="clearfix"> </div>
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