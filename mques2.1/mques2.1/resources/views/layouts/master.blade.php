
<!DOCTYPE html>
<html lang="en">
<head>
<title>MQUES</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Real Home Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	  {!! HTML::style('users/css/bootstrap.css') !!}
    {!! HTML::style('users/js/jquery.min.js') !!}
    {!! HTML::script('users/js/scripts.js') !!}
    {!! HTML::script('users/css/styles.css') !!}
   
    {!! HTML::style('css/bootstrap.css') !!}
    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('css/style.css') !!}
    {!! HTML::style('css/styles.css') !!}


<script src="js/responsiveslides.min.js"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
</head>
<body >
		@yield('content')

    {!!HTML::script('js/jquery.js')!!}
    {!!HTML::script('js/bootstrap.min.js')!!}
    {!!HTML::script('js/jquery.easing.min.js')!!}
    {!!HTML::script('js/jquery.fittext.js')!!}
    {!!HTML::script('js/wow.min.js')!!}
    {!!HTML::script('js/creative.js')!!}



</body>
</html>