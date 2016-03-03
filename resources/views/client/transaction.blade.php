
    <title>LTO Print</title>



<script type="text/javascript" src="js/scanner/js/lib/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="js/scanner/jsqrcode/grid.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/version.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/detector.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/formatinf.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/errorlevel.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/bitmat.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/datablock.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/bmparser.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/datamask.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/rsdecoder.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/gf256poly.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/gf256.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/decoder.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/QRCode.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/findpat.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/alignpat.js"></script>
<script type="text/javascript" src="js/scanner/jsqrcode/databr.js"></script>

<script type="text/javascript" src="js/scanner/js/qr.js"></script>
<script type="text/javascript" src="js/scanner/js/camera.js"></script>
<script type="text/javascript" src="js/scanner/js/init.js"></script>
    
    <script src="js/photo.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.plugin.html2canvas.js"></script>
    <script src="js/html2canvas.js"></script>
    <script src="js/creative.js"></script>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Welcome to LTO Service Unit</a>
            </div>
        </div>
      
    </nav>

    <header>
    <div id="printtransac">
    <br/>
    <br/>
     <h1>Your data with your Priority Number</h1>
        
        Name: {{ $transaction['name'] }}
        <br>
        Address: {{ $transaction['address'] }}
        <br>
        Date Registered: {{ $transaction['date'] }}
        <br>
        Transaction Type: {{ $transaction['transactionType'] }}
        <br>
        <h3>Priority Number: </h3> {{ $transaction['priorityID'] }}
        <br>
        <br>
         <button class="btn btn-primary btn-xl page-scroll" onclick="print()">Print</button>
        </div>
    </header>

    @yield('content')


