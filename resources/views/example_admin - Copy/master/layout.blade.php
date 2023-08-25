<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{{ $data['identitas']->nama_web }}</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{!! asset('adminasset/assets/css/bootstrap.min.css')!!}" />
		<link rel="stylesheet" href="{!! asset('adminasset/assets/font-awesome/4.2.0/css/font-awesome.min.css')!!}" />
		<link rel="stylesheet" href="{!! asset('adminasset/assets/css/animate.css')!!}" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{!! asset('adminasset/assets/fonts/fonts.googleapis.com.css')!!}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{!! asset('adminasset/assets/css/ace.min.css')!!}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{!! asset('adminasset/assets/css/ace-part2.min.css')!!}" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{!! asset('adminasset/assets/css/ace-ie.min.css')!!}" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{!! asset('adminasset/assets/js/ace-extra.min.js') !!}"></script>

    	<link rel="stylesheet" href="{!! url('adminasset/assets/css/sweetalert.css') !!}">
    	<script src="{!! url('adminasset/assets/js/sweetalert-dev.js') !!}"></script>
		<link rel="stylesheet" href="{!! asset('adminasset/assets/css/select2.min.css') !!}" />
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->


		<!--[if lte IE 8]>
		<script src="{!! asset('adminasset/assets/js/html5shiv.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/respond.min.js') !!}"></script>
		<![endif]-->
		@yield('css')
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="{{ route('dashboard') }}" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Ace Admin
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="@if(Auth::user()->level ==0){!! asset('adminasset/assets/images/icon/'.$data['identitas']->favicon) !!} @else {!! asset('adminasset/assets/images/editor/'.Auth::user()->photo) !!} @endif" alt="Jason's Photo" style="height: 40px" />
								<span class="user-info">
									<small>Welcome,</small>
									{!! Auth::user()->name !!}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<!-- <li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>-->

								<li>
									<a href="{{ route('home') }}" target="blank">
										<i class="ace-icon fa fa-eye"></i>
										View Web
									</a>
								</li><li>
									<a href="javascript:void(0)" onclick="profil({!! Auth::user()->id !!})">
										<i class="ace-icon fa fa-user"></i>
										Akun
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="{{ route('logouts') }}">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
		<div id='tampilprofil'></div>
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>


				<?php
					$a = explode(',', Auth::user()->previllage);
					$galeri = 0;
					$memo = 0;
					$berita = 0;
					$even = 0;

					for($i = 0; $i < count($a)-1; $i++ ){
						if($a[$i] == 1){
							$berita = 1;
						}elseif($a[$i] == 2){
							$even = 1;
						}elseif($a[$i] == 3){
							$memo = 1;
						}elseif($a[$i] == 4){
							$galeri = 1;
						}
					}
				?>
			<div id="sidebar" class="sidebar responsive">
				@include('admin.master.side')
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<div class="page-header">
							<h1>
								{{ $data['title_main'] }}
								
									<small>
										@if($data['title_main_sub'] != '') <i class='ace-icon fa fa-angle-double-right'></i> @endif
										{{ $data['title_main_sub'] }}
									</small>
							</h1>
						</div><!-- /.page-header -->
						
						@yield('content')
					</div>
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Nessa Jaya Scaffolding</span> &copy; 2017
						</span>

						&nbsp; &nbsp; <span class="bigger-110">develop by <a href="http://natusi.co.id" target="blank">cv.natusi</a></span>
						<!-- <span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span> -->
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<!-- <script src="{!! asset('adminasset/assets/js/jquery.2.1.1.min.js') !!}"></script> -->
  		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>


		<!-- <![endif]-->

		<!--[if IE]>
			<script src="{!! asset('adminasset/assets/js/jquery.1.11.1.min.js') !!}"></script>
		<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='{{ asset('adminasset/assets/js/jquery.min.js')}}'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 	window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{!! asset('adminasset/assets/js/bootstrap.min.js') !!}"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="{!! asset('adminasset/assets/js/excanvas.min.js') !!}"></script>
		<![endif]-->
		<script src="{!! asset('adminasset/assets/js/jquery-ui.custom.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/jquery.ui.touch-punch.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/jquery.easypiechart.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/jquery.sparkline.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/jquery.flot.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/jquery.flot.pie.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/jquery.flot.resize.min.js') !!}"></script>

		<!-- ace scripts -->
		<script src="{!! asset('adminasset/assets/js/ace-elements.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/ace.min.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/animate.js') !!}"></script>
		<script src="{!! asset('adminasset/assets/js/datagrid.js') !!}"></script>


		<script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.js"></script> 

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
		</script>
		<script type="text/javascript">

			function profil(id){
				$.post('{!! route("profiledit") !!}').done(function(data){
					if(data.status == 'success'){
						$('#tampilprofil').html(data.content).fadeIn();
					}
				});
			}

	      @if(!empty(Session::get('message')))
	        swal({
	          title : "{{ Session::get('title') }}",
	          text : "{{ Session::get('message') }}",
	          type : "{{ Session::get('type') }}",
	          timer: 2000,
	          showConfirmButton: false
	        });
	      @endif
	    </script>
		@yield('js')
	</body>
</html>
