<!DOCTYPE html>
<html lang="en">
<head>
    <title>MQUES</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">



   
   
    {!! HTML::style('css/bootstrap.css') !!}
    {!! HTML::style('css/style.css') !!}
    {!! HTML::style('css/styles.css') !!}
    {!! HTML::style('css/flexslider.css') !!}
    {!! HTML::style('css/default.css') !!}
    {!! HTML::style('css/popuo-box.css') !!}
    {!! HTML::style('fonts/gylphicons-halflings-regular.eot') !!}
    {!! HTML::style('fonts/gylphicons-halflings-regular.svg') !!}
    {!! HTML::style('fonts/gylphicons-halflings-regular.ttf') !!}
    {!! HTML::style('fonts/gylphicons-halflings-regular.woff') !!}
    {!! HTML::style('fonts/gylphicons-halflings-regular.woff2') !!}
    {!! HTML::style('fonts/Monstserrat-Regular.ttf') !!}
    {!! HTML::style('fonts/Oxygen-Regular.ttf') !!}
    {!! HTML::script('js/easyResponsiveTabs.js') !!}
    {!! HTML::script('js/jquery.flexisel.js') !!}
    {!! HTML::script('js/jquery.flexslider.js') !!}
    {!! HTML::script('js/jquery.magnific-popup.js') !!}
    {!! HTML::script('js/jquery.min.js') !!}
    {!! HTML::script('js/responsiveslides.min.js') !!}
    {!! HTML::script('js/scripts.js') !!}
    

    {!! HTML::style('datepicker/css/datepicker.css') !!}
    {!! HTML::script('datepicker/js/jquery-1.9.1.min.js') !!}
    {!! HTML::script('datepicker/js/bootstrap-datepicker.js') !!}



</head>
<body>
    <div class="header">
    <div class="container">
        
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
        @yield('content')
        @yield('script')



</div>
    </body>
    </html>
