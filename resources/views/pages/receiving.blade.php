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
</style>



<title>Index</title>
<body>
<div class="header">
    <div class="container">
        <div class="logo">
            <h1><a href="#">MQUES</a></h1>
        </div>
    
    <div class="top-nav">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-user"></i>{{ Auth::user()->firstname }}</a></li>
            <li><a href="{{ URL::to('/auth/logout') }}">Logout</a></li>
        </ul>
    </div>
    </div>
</div>
<div class="container">
    <br>
        <div class="premiumm">
            <div class="pre-topp">
            <h5>Receiving Counter</h5>
            <p>It may change by the teller. Suspend queue manually.</p>
            </div>
        </div>
        <br><br><br>



    <div class="future">
        <ul align="center">
            <li><div class="project-fur">
                <div class="fur2">
                    <span>Teller 5</span>
                </div>
                <div class="fur">
                                        <div class="fur1">
                                            <h6 class="fur-name">Now Serving</h6>
                                            <h1 align="center" size="500px">
                                             {{ $ph5->p_number }}
                                            </h1>
                                        </div>
                                        <div class="fur2">
                                         
                                            <span>RECEIVING</span>
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
                                              {{ $ph1->p_number }}
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
                                                
                                              {{ $ph2->p_number }}
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
                                             
                                                 {{ $ph3->p_number }}
                                                
                                            </h1>
                                        </div>
                                        <div class="fur2">
                                         
                                            <span>CASHIER</span>
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
                                            <h1 align="center" size="500px">
                                        {{ $ph4->p_number }}
                                            </h1>
                                        </div>
                                        <div class="fur2">
                                            
                                            <span>APPROVING</span>
                                         </div>
                                    </div>                  
                            </div></li>
                            <br><br>
                      <form method="post" action="">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <button class="hvr-sweep-to-right" style="float:right">Next Queue</button>
        </form>
        </div><br><br>
       
    </div>
</div>
<br><br><br><br><br>
<br>
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

</body>
@stop