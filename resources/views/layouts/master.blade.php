<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image" href="public/css/img/amss.JPG"/>

    <title>Apartment</title>
        {!!HTML:: style('css/img/icon2.PNG')!!}
        {!!HTML:: style('css/bootstrap.min.css')!!}
        {!!HTML:: style('css/sb-admin.css')!!}
        {!!HTML:: style('css/plugins/morris.css')!!}
        {!!HTML:: style('font-awesome/css/font-awesome.min.css')!!}
        {!!HTML:: style('css/agency.css')!!}
        {!!HTML:: style('css/style.css')!!}
        {!!HTML:: script('js/bootstrap.min.js') !!}
        {!!HTML:: script('js/jquery.js') !!}
        {!!HTML:: script('js/plugins/morris/raphel.min.js') !!}
        {!!HTML:: script('js/plugins/morris/morris.min.js') !!}
        {!!HTML:: script('js/plugins/morris/morris-data.js') !!}


    

</head>

<body>

@section('nav')
<div class="header">
  <div class="container">
      <div class="logo">
        <h1><a href="index.html">LTO QUEUE MANAGEMENT SYSTEM</a></h1>
      </div>
    <div class="top-nav">
      <ul class="right-icons">
        <li><a href=""><i class="glyphicon glyphicon-user"></i>Home page</a></li>
        <li><a  href=""><i class="glyphicon glyphicon-user"></i>About Us</a></li> 
        <li><a  href=""><i class="glyphicon glyphicon-user"></i>View Queue</a></li>
        <li><a  href=""><i class="glyphicon glyphicon-user"></i>{{ Auth::user()->name }}</a></li>
         <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
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




@yield('content')
    






</body>
     </html>