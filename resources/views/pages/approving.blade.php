@extends('layouts.login')


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
				<li><a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a></li>
				<li><a  href=""><i class="glyphicon glyphicon-user"> </i>{{ Auth::user()->firstname }}</a</li>
				<li><a  href="{{ URL::to('/auth/logout') }}">Logout</a></li>
			</ul>
		</div>

		<div class="top-nav">
			
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
				
					
	
		</div>
		<div class="clearfix"> </div>
		</div>	
</div>
	<div class="clearfix"> </div>
		<!--initiate accordion-->

      		
	</div>
</div>
<!--//-->	
	<div class="container">
<br>
<div class="premiumm">
	<div class="pre-topp">
		<h5>Approving Counter</h5>
		<p>It may change by the teller. Suspend queue manually.</p>
	</div>
</div>
	<div class="future">	
			<div ><br><br><br>
					<ul>			
						
							 <div class="future">
        <ul align="center">
            <li><div class="project-fur">
                <div class="fur2">
                    <span>Teller 2</span>
                </div>
                <div class="fur">
                                        <div class="fur1">
                                            <h6 class="fur-name">Now Serving</h6>
                                            <h1 align="center" size="500px">
                                            {{ $t1 }}
                                            </h1>
                                        </div>
                                        <div class="fur2">
                                   
                                            <span>APPROVING</span>
                                         </div>
                                    </div>     
                                        </div></li>
                                    </ul>
                                </div>

		<div class="future">    
    

                    <ul align="center">         
                        <li><div class="project-fur">
                            <div class="fur2">
                            <span>Teller 1</span>
                            </div>
                                    <div class="fur">
                                        <div class="fur1">
                                            <h6 class="fur-name">Now Serving</h6>
                                            <h1 align="center" size="500px">
                                              {{ $t2 }}
                                            </h1>
                                        </div>
                                        <div class="fur2">
                                        
                                            <span>EVALUATION</span>
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
                                            <h1 align="center" size="500px">
                                                
                                              {{ $t3 }}
                                            </h1>
                                        </div>
                                        <div class="fur2">
                                          
                                            <span>PHOTO SIGNATURE</span>
                                         </div>
                                    </div>                  
                                </div></li>
                                <li><div class="project-fur">
                                <div class="fur2">
                                            <span>Teller 4</span>
                                         </div>
                                    <div class="fur">
                                        <div class="fur1">
                                            <h6 class="fur-name">Now Serving</h6>
                                            <h1 align="center" size="500px">
                                             
                                                {{ $t4 }}
                                                
                                            </h1>
                                        </div>
                                        <div class="fur2">
                                 
                                            <span>CASHIER</span>
                                         </div>
                                    </div>                  
                            </div></li>
                             <li><div class="project-fur">
                                <div class="fur2">
                                            <span>Teller 5</span>
                                         </div>
                                    <div class="fur">
                                        <div class="fur1">
                                            <h6 class="fur-name">Now Serving</h6>
                                            <h1 align="center" size="500px">
                                        {{ $t5 }}
                                            </h1>
                                        </div>
                                        <div class="fur2">
                                           
                                            <span>RECEIVING</span>
                                         </div>
                                    </div>                  
                            </div></li>
                            
							
							
					
					<script type="text/javascript">
						$(window).load(function() {
							$('#btnNextQueue').click(function(){
								/*var $_token = $('#token').val();
								$.ajax({
									type: 'post',
									header: { 'X-XSRF-TOKEN' : $_token },
									url: 'teller/sampleCall',
									data: {},
									success: function(data){
										console.log(data);
									}
								});*/		

							});

							$("#flexiselDemo1").flexisel({
								visibleItems: 2,   		
								enableResponsiveBreakpoints: false,
						    	responsiveBreakpoints: { 
						    		portrait: { 
						    			changePoint:480,
						    			visibleItems: 1
						    		}, 
						    		landscape: { 
						    			changePoint:640,
						    			visibleItems: 1
						    		},
						    		tablet: { 
						    			changePoint:768,
						    			visibleItems: 2
						    		}
						    	}
						    });
						    
						});
			</script>
			<script type="text/javascript" src="js/jquery.flexisel.js"></script>
			
		</div>
										
		</div>
		<div>
				 <div class="create">
        <h4></h4>        
        
        
        <form method="post" action="">
        	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        	<button class="hvr-sweep-to-right" style="float:right">Next Queue</button>
        </form>

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