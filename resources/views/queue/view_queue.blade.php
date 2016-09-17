@extends('layouts.view_queue')


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
		
			<div class="logo">
				<h1><a href="index.html">MQUES</a></h1>
			</div>	
	</div>

</div>
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
								<h1 align="center" size="1000px" id="onepriorityid"></h1>
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
								<h1 align="center" size="500px" id="twopriorityid"></h1>
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
								<h1 align="center" size="500px" id="threepriorityid"></h1>
							</div>
							<div class="fur2">
								<span>APPROVING</span>
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
								<h1 align="center" size="500px" id="fourpriorityid"></h1>
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
								<h1 align="center" size="500px" id="fivepriorityid"></h1>
							</div>
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
	<div class="footer-bottom1">
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
<script type="text/javascript">
	getServing(); // This will run on page load
    setInterval(function(){
        getServing() // this will run after every 2 seconds
    }, 100000);

	function getServing()
	{
		$.ajax({
			type : 'get', 
			url : 'http://localhost:8000/getServing',       
			dataType: "json",
			success: function(response) {
				console.log(response);

				if(response['one'].length > 0){
					$("#onepriorityid").html(response['one'][0].priorityID);
				} else {
					$("#onepriorityid").html("Empty");
				}

				if(response['two'].length > 0){
					$("#twopriorityid").html(response['two'][0].priorityID);
				} else {
					$("#twopriorityid").html("Empty");
				}

				if(response['three'].length > 0){
					$("#threepriorityid").html(response['three'][0].priorityID);
				} else {
					$("#threepriorityid").html("Empty");
				}

				if(response['four'].length > 0){
					$("#fourpriorityid").html(response['four'][0].priorityID);
				} else {
					$("#fourpriorityid").html("Empty");
				}

				if(response['five'].length > 0){
					$("#fivepriorityid").html(response['five'][0].priorityID);
				} else {
					$("#fivepriorityid").html("Empty");
				}
			}, error: function(xhr,status,err) {
				console.log('error')
			}
		});
	}
</script>
@stop