@extends('layouts.login')


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
      .fullscreen_bg {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-size: cover;
    background-position: 50% 50%;
    background-repeat:repeat;
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

                 <li><a href="#"><i class="glyphicon glyphicon-user" value=""></i></a></li>
				<li><a  href="{{ URL::to('/client/logout') }}"><i class="glyphicon glyphicon-user"> </i>Logout</a></li>

			</ul>
		</div>	
</div>
</div>

<div class="blog">
<div class="container">
	<center><h2 style="color:green">* LTO QUEUE MANAGEMENT SYSTEM *</h2></center>
    <div class="about-head">
        <div class="container">
                <div class="about-in">
                    <img src="/images/photo.jpg" class="thumb" alt="a picture">       
                    <h6 ><a href="blog_single.html">Lorem ipsum dolor sit amet, consectetur adipisci ngelit. Donec nisi sem, vestibulum Etortor tortor in turpis. Proin mauris nulla, rutrum aliquet arcu vel</a></h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nisi sem, vestibulum ac lobortis quis, aliquet in metus. Suspendi sse a nibh id eros consectetur laoreet. Etiam viverra auctor orci, eu mattis ipsum rutrum nec.
                        Etortor tortor in turpis. Proin mauris nulla, rutrum aliquet arcu vel, porttitor varius dolor. Phasellus vitae tincidunt orci, et faucibus eros. Sed dolor sapien, pharetra placerat feugiat.</p>
                </div>
        </div>
    </div>
	
        <div class="container">
            <h2>Get QR Code</h2>
            <div class="us-choose">
                <div class="col-md-6 why-choose">
                    <div class="  ser-grid ">
                        <a href="{{ URL::to('/client/registerLicense') }}"><i class="hi-icon hi-icon-archive glyphicon glyphicon-pencil"> </i></a>
                    </div>
                    <div class="ser-top beautiful"> 
                        <h5>GET QR CODE</h5>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

<br><br><br>
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
</body>
</html>