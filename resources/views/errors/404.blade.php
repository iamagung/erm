<html>
    <head>
        <title>Page Not Found.</title>
        <!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="{!! url('bootstrap/css/bootstrap.min.css') !!}">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="{!! url('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') !!}">
	    <!-- Ionicons -->
	    <link rel="stylesheet" href="{!! url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') !!}">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }
            .Notitle {
            	font-size: 98px;
                margin-bottom: 40px;
                font-weight: 600;
                color: #fff;
            }
            .title {
                font-size: 72px;
                margin-bottom: 40px;
                font-weight: 600;
                color: #fff;
            }
            .awanbawah {
            	background-image: url('{!! url('dist/img/bottomAsset.png') !!}');
            	position: absolute;
            	bottom: 0px;
            	left:0px;
            	width: 100%;
            	height: 250px;
            	background-position-y: 80%;
            	background-repeat: no-repeat;
            	background-size: cover;
            	z-index: -10;
            }
            .btnBack {
            	position: relative;
            	border: solid 3px #fff;
            	border-radius: 20px;
            	padding: 2px 10px;
            	font-size: 18px;
            	font-weight: 600;
            	background: transparent !important;
            }
            .btnBack > i {
            	margin-right: 10px;
            }
            .btnBack:hover {
            	background: #fff !important;
            	border-color: #fff !important;
            	color: #41c0f3 !important;
            }
            .btnBack:hover>i {
            	color: #41c0f3 !important;
            }
        </style>
    </head>
    <body style="background: #41c0f3;">
        <div class="container">
            <div class="content">
                <div class="Notitle">404</div>
                <div class="title">Oops.. Halaman tidak ditemukan.</div>
                <a href="javascript:history.back()" class="btn btn-info btnBack"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                <div class='awanbawah'></div>
            </div>
        </div>
        <!-- jQuery 2.1.4 -->
	    <script src="{!! url('plugins/jQuery/jQuery-2.1.4.min.js') !!}"></script>
	    <!-- jQuery UI 1.11.4 -->
	    <script src="{!! url('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') !!}"></script>
	    <!-- Bootstrap 3.3.5 -->
    	<script src="{!! url('bootstrap/js/bootstrap.min.js') !!}"></script>
    </body>
</html>