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
				<li><a  href="{{ URL::to('/auth/logout') }}"><i class="glyphicon glyphicon-user"> </i>Logout</a></li>

			</ul>
				   
				
			
			
		
		</div>	
</div>
</div>



<div class="blog">
<div class="container">
	<h2>LTO QUEUE MANAGEMENT SYSTEM</h2>
	<table style="width:70%;align-text:center">
		<tr>
			<td>
				 <h4>Vision</h4>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make. a type specimen book. It has survived not only five centuries. but also the leap into electronic typesetting, remaining essentially unchanged. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, </p>
			</td>
			<td>
				 <h4>Mission</h4>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make. a type specimen book. It has survived not only five centuries. but also the leap into electronic typesetting, remaining essentially unchanged. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, </p>
			</td>
		</tr>
	</table>  
        <div id="loginbox" style="margin-top:50px;position:absolute;margin-top:-35%;float:right">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Add Transaction</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

        					 <div style="margin-top:10px" class="form-group">
                                     <div class="col-sm-12 controls">
                                      <a id="btn-login" href="{{ URL::to('/client/registerLicense') }}" class="hvr-sweep-to-right">License Registration </a>
                                    </div>
                                </div>
                                <br /><br><br>
                             <div style="margin-top:10px" class="form-group">
                                     <div class="col-sm-12 controls">
                                      <a id="btn-login" href="registerVehicle" class="hvr-sweep-to-right">Vehicle Registration </a>
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