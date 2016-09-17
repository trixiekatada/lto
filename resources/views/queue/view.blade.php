
@extends('layouts.view_queue')


@section('content')
<title>Login</title>
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
        color:  #FFF0F5;
        text-decoration: none;
    }
    ul li a:hover{
        color: #fff;
        background: #90EE90;
    }
    ul li ul.dropdown{
        min-width: 140px; /* Set width of the dropdown */
        background: #27da93;
        display: none;
        position: absolute;
        z-index: 1000;
        left: 0;
    }
    ul li:hover ul.dropdown{
        display: block; /* Display the dropdown */
    }
    ul li ul.dropdown li{
        display: block;
    }
</style>

<script type="text/javascript">
$(function(){
  setInterval(function(){
    window.location.reload();
  },2000);

});
</script>
        <div class="containerz">
            <div class="box">
                <div class="box2"> 
                   <div class="header">
  <div class="container">
      <div class="logo">
        <h1><a href="index.html">LTO QUEUE MANAGEMENT SYSTEM</a></h1>
      </div>
    <div class="top-nav">
      <ul class="right-icons">
        <li><a href="{{ URL::to('/') }}"><i class="glyphicon glyphicon-user"></i>Home page</a></li>
        
      </ul>

    <div class="clearfix"> </div>
  
         
        <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
        <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>

        <div id="small-dialog" class="mfp-hide">
          
        </div>
       
  
    </div>
    <div class="clearfix"> </div>
    </div>  
</div>

<div class="login-right">
  <div class="container">

    <h3>View All Current Serving</h3>
 <div class="container">
  <div class="future">  
      <div >
        <ul align="center">     
          <li><div class="project-fur">
              <center><h2 style="color:black">Teller 1</h2></center>
            <div class="fur">
              <div class="fur1">
                <h6 class="fur-name">Now Serving : </h6>
                <h1 style="color:black;" align="center" size="1000px" class="current">{{ $teller1 }}</h1>
              </div><br><br>
              <div class="fur2">
                <span>EVALUATION</span>
              </div>
            </div>          
          </div></li>
            <li><div class="project-fur">
              <center><h2 style="color:black">Teller 2</h2></center>
            <div class="fur">
              <div class="fur1">
                <h6 class="fur-name">Now Serving : </h6>
                <h1 style="color:black;" align="center" size="1000px" class="current">{{ $teller2 }}</h1>
              </div><br><br>
              <div class="fur2">
                <span>PHOTO AND SIGNATURE</span>
              </div>
            </div>          
          </div></li>
            <li><div class="project-fur">
              <center><h2 style="color:black">Teller 3</h2></center>
            <div class="fur">
              <div class="fur1">
                <h6 class="fur-name">Now Serving : </h6>
                <h1 style="color:black;" align="center" size="1000px" class="current">{{ $teller3 }}</h1>
              </div><br><br>
              <div class="fur2">
                <span>APPROVING</span>
              </div>
            </div>          
          </div></li>
            <li><div class="project-fur">
              <center><h2 style="color:black">Teller 4</h2></center>
            <div class="fur">
              <div class="fur1">
                <h6 class="fur-name">Now Serving : </h6>
                <h1 style="color:black;" align="center" size="1000px" class="current">{{ $teller4 }}</h1>
              </div><br><br>
              <div class="fur2">
                <span>CASHIER</span>
              </div>
            </div>          
          </div></li>
           <li><div class="project-fur">
              <center><h2 style="color:black">Teller 5</h2></center>
            <div class="fur">
              <div class="fur1">
                <h6 class="fur-name">Now Serving : </h6>
                <h1 style="color:black;" align="center" size="1000px" class="current">{{ $teller5 }}</h1>
              </div><br><br>
              <div class="fur2">
                <span>RELEASING</span>
              </div>
            </div>          
          </div></li>
      
    </div>
    <br>
    <br>
    <div class="project-fur"></div>               
    </div>
  </div>
</div>
</div>
</div> 
  </div>
                </div>   
            </div>
           
        </div>

@stop 