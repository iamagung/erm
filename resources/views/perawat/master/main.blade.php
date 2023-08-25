<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Perawat - {!! $identitas->nama_web !!}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" href="{!!  asset($identitas->favicon) !!}">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="{!!  asset('adminAsset/css/bootstrap-3.3.4.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!!  asset('adminAsset/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!!  asset('adminAsset/css/AdminLTE.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!!  asset('adminAsset/css/sweetalert.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!!  asset('adminAsset/css/custom.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('adminAsset/css/bootstrap-datetimepicker.min.css') !!}" rel='stylesheet' type='text/css' />

	<!-- <link href="{!!  asset('adminAsset/css/datatables/dataTables.bootstrap.css') !!}" rel="stylesheet" type="text/css" /> -->
	<!-- <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script> -->
	<link href="{!!  asset('adminAsset/plugin_new/datatables/datatables.min.css') !!}" rel="stylesheet" type="text/css" />
	<script src="{!!  asset('adminAsset/js/jquery-mask.js') !!}" type="text/javascript"></script>
	<script src="{!!  asset('adminAsset/js/mask.js') !!}" type="text/javascript"></script>
	<link href="{{ asset('adminAsset/css/chosen.min.css') }}" rel="stylesheet" media="screen">
	<style type="text/css">
		.skin-black .navbar .nav > li > a:hover, .skin-black .navbar .nav > li > a:active, .skin-black .navbar .nav > li > a:focus, .skin-black .navbar .nav .open > a, .skin-black .navbar .nav .open > a:hover, .skin-black .navbar .nav .open > a:focus{
			background: #d400d7;
		}
		.navbar-nav > .user-menu > .dropdown-menu > li.user-header{
			background: #d400d7 !important;
		}
	</style>
</head>
<body class="skin-black">
	<header class="header">
		@php $nama_level = (auth::user()->is_terapis == 'Y')?'Terapis':'Perawat'; @endphp
		<a href="{!! route('home') !!}" class="logo" style="background: #d400d7">{{$nama_level}} web</a>
		<nav class="navbar navbar-static-top" role="navigation" style="background: #d998da">
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user"></i>
							<span>{!! $dokter->nama !!}<i class="caret"></i></span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header bg-light-blue">
								<?php
								if (Auth::user()->foto_user==null) {
									$foto_user = "blank-profile.jpg";
								}else{
									$foto_user = Auth::user()->foto_user;
								}
								// $foto_user = "blank-profile.jpg";
								?>
								<img src="{!! asset($identitas->favicon) !!}" class="img-circle" alt="User Image" />
								<p>
									{!!  $dokter->nama !!} - Perawat web
								</p>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<a href="{!! route('profilePerawat') !!}" class="btn btn-default btn-flat">Profil</a>
								</div>
								<div class="pull-right">
									<a href="{!! url('logouts') !!}" class="btn btn-default btn-flat">Keluar</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<aside class="left-side sidebar-offcanvas">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{!! asset($identitas->favicon) !!}" class="img-circle" alt="User Image" />
					</div>
					<div class="pull-left info">
						<p>Hello, {!!  $dokter->nama !!}</p>
						<a href="{!! url('logouts') !!}"><i class="fa fa-key text-danger"></i> Keluar</a>
					</div>
				</div>
				<ul class="sidebar-menu">
					<!-- <li class="@if($active == 1) active @endif"><a href="{!! route('home') !!}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> -->
					<!-- <li class="@if($active == 8) active @endif"><a href="{!! route('antrian') !!}"><i class="fa fa-users"></i> <span>Antrian Pasien</span></a></li> -->
					<!-- <li class="@if($active == 3) active @endif"><a href="{!! route('dataRegistrasiPerawat') !!}"><i class="fa fa-users"></i> <span>Data Registrasi Pasien</span></a></li> -->
					<li class="@if($active == 3) active @endif"><a href="{!! route('dataRegistrasiPerawat') !!}"><i class="fa fa-users"></i> <span>Input Rekam Medis</span></a></li>
					<!-- <li class="@if($active == 4) active @endif"><a href="{!! route('dataRekapMedikPerawat') !!}"><i class="fa fa-briefcase"></i> <span>Data Rekam Medis</span></a></li> -->
					<!-- <li class="@if($active == 4) active @endif"><a href="{!! route('rekam_new_all') !!}"><i class="fa fa-briefcase"></i> <span>Data Rekam Medis</span></a></li> -->
					<li class="@if($active == 4) active @endif"><a href="{!! route('rekam_new_all') !!}"><i class="fa fa-briefcase"></i> <span>History Pasien</span></a></li>
					<li class="@if($active == 4) active @endif"><a href="javascript:void(0);" onclick="swal('Notice!','Menu sedang dalam proses pengembangan.','info');"><i class="fa fa-briefcase"></i> <span>History Obat</span></a></li>
					<li class="@if($active == 1) active @endif"><a href="{!! route('home') !!}"><i class="fa fa-dashboard"></i> <span>Grafik Kunjungan Pasien</span></a></li>
					<?php
					/*
					<li class="treeview @if($active == 3) active @endif">
					<a href="#">
					<i class="fa fa-list-alt"></i> <span>Modul Web</span>
					<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
					<li class="@if($active_sub == 31) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Logo</a></li>
					<li class="@if($active_sub == 32) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Profil</a></li>
					<li class="@if($active_sub == 33) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Crew</a></li>
					<li class="@if($active_sub == 34) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Video</a></li>
					<li class="@if($active_sub == 35) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Menu</a></li>
					</ul>
					</li>
					<li class="treeview @if($active_sub == 4) active @endif ">
					<a href="#">
					<i class="fa fa-user"></i> <span>Modul Pengguna</span>
					<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
					<li class="@if($active_sub == 41) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Editor</a></li>
					<li class="@if($active_sub == 42) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Polres</a></li>
					<li class="@if($active_sub == 43) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Twitter</a></li>
					</ul>
					</li>
					<li>
					<a href="">
					<i class="fa fa-tags"></i> <span>Modul Iklan</span>
					</a>
					</li>
					<!--<li><a href="?menu=kata_jorok"><i class="fa fa-paperclip"></i> <span>Modul Kata Jorok</span></a></li>-->
					*/
					?>
				</ul>
			</section>
		</aside>

		<aside class="right-side">
			<div class="col-lg-12 col-md-12">
				<?php
				if(Session::has('no_RM')){
					$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
					$customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',Session::get('no_RM'))->first();

					// CEK USING REGISTER
					$alergi = DB::connection('rsu')->table('tr_resep_m')->where('No_Register',$rekap->no_Register)->first();
					if(count(array($alergi))!=0){

					}else{
						$alergi = DB::connection('rsu')->table('tr_resep_m')->where('No_RM',Session::get('no_RM'))->orderBy('No_Register','DESC')->first();
					}
					// $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',Session::get('no_RM'))->first();
					?>
					<div class="col-md-12 col-md-12" style="border: 2px solid #ddd;background: #eee;box-shadow: 0px 4px 10px #ddd;margin-top: 10px;padding: 10px">
						<div class="col-lg-4 col-md-4" style="padding: 0px">
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-4 col-md-4" style="padding: 0px">Nama Pasien</label>
								<label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! $rekap->Nama_Pasien !!} {{(isset($customer)?'('.$customer->JenisKel.')':'')}}</label>
							</div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-4 col-md-4" style="padding: 0px">No Register</label>
								<label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! $rekap->no_Register !!}</label>
							</div>
							<!-- <div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-4 col-md-4" style="padding: 0px">Jenis Kelamin</label>
								<label class="col-lg-8 col-md-8" style="color: #1f07d2">:
									<?php
									if (isset($customer)) {
										echo ($customer->JenisKel=='L') ? 'Laki-laki' : 'Perempuan';
									}
									?>
								</label>
							</div> -->
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-4 col-md-4" style="padding: 0px">Poliklinik</label>
								<label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! $rekap->NamaPoli !!}</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-4" style="padding: 0px">
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-4 col-md-4" style="padding: 0px">No RM</label>
								<label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! $rekap->no_RM !!}</label>
							</div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-4 col-md-4" style="padding: 0px">Tanggal lahir</label>
								<label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! (isset($customer))?date('d-m-Y',strtotime($customer->TglLahir)):'' !!}</label>
							</div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-4 col-md-4" style="padding: 0px">Alamat</label>
								<label class="col-lg-8 col-md-8" style="color: #1f07d2">: {{(isset($customer)?$customer->Alamat:'')}}</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-4" style="padding: 0px">
							@if(isset($alergi))
							@if(!empty($alergi))
							@if($alergi->isAlergi!='TIDAK ADA ALERGI' && $alergi->isAlergi!='TIDAK TAHU')
							<div class="col-lg-12 co-md-12" style="padding: 0px">
								<div class="blinking" style="text-align: center;font-size: 16pt">
									{{$alergi->isAlergi}}<br>({{$alergi->NamaAlergi}})
								</div>
							</div>
							@else
							@endif
							@endif
							@endif
						</div>
						<div class="clearfix"></div>
						<a href="{!! route('content2') !!}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Lanjutkan</a>
						<!-- IF POLI REHAB / NOT -->
						@if(auth::user()->kodePoli == '117')
						<a href="javascript:void(0);" onclick="finish_add()" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Selesai & Pindah Ke Dokter</a>
							@if(auth::user()->is_terapis != 'Y')
							<a href="javascript:void(0);" onclick="pindah_terapis('terapis')" class="btn btn-sm btn-warning"><i class="fa fa-save"></i> Selesai & Pindah Ke Terapis</a>
							@endif
						@else
						<a href="javascript:void(0);" onclick="finish_add()" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Selesai</a>
						@endif
						<!--  -->
						@if(($rekap->anamnesis=='' || $rekap->diagnosa == '') && auth::user()->is_terapis != 'Y')
						<a href="javascript:void(0);" onclick="batal_mengerjakan()" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash-o"></i> Batal Mengerjakan</a>
						@else
						<a href="javascript:void(0);" onclick="cancel_mengerjakan()" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash-o"></i> Batal Edit</a>
						@endif
					</div>
					<?php
				}
				?>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>

			@yield('content')
		</aside>

		<aside class="right-side">
			<div class="col-lg-12 col-md-12" style="background: white;padding: 10px">
				<i>Designed By <b><a href="http://natusi.co.id" target="_blank">CV. NATUSI</a></b></i> &copy;2018
			</div>
		</aside>
	</div>

	<script type="text/javascript" src="{!! asset('adminAsset/webcam/webcam.js') !!}"></script>

	<script type="text/javascript" src="{!! asset('adminAsset/js/bootstrap-datetimepicker.min.js') !!}"></script>
	<!-- jQuery UI 1.10.3 -->
	<script src="{!!  asset('adminAsset/js/jquery-ui-1.10.3.min.js') !!}" type="text/javascript"></script>
	<!-- Bootstrap -->
	<script src="{!!  asset('adminAsset/js/bootstrap.min.js') !!}" type="text/javascript"></script>
	<!-- DATA TABES SCRIPT -->
	<!-- <script src="{!!  asset('adminAsset/js/plugins/datatables/jquery.dataTables.js') !!}" type="text/javascript"></script> -->
	<!-- <script src="{!!  asset('adminAsset/js/plugins/datatables/dataTables.bootstrap.js') !!}" type="text/javascript"></script> -->
	<script src="{!! asset('adminAsset/plugin_new/datatables/datatables.min.js') !!}" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="{!!  asset('adminAsset/js/AdminLTE/app_tu.js') !!}" type="text/javascript"></script>
	<script src="{!!  asset('adminAsset/js/sweetalert.min.js') !!}" type="text/javascript"></script>
	<script src="{!!  asset('adminAsset/js/validate.js') !!}" type="text/javascript"></script>

	<script src="{{ asset('adminAsset/js/chosen.jquery.min.js') }}"></script>

	<script type="text/javascript">
		function finish_add(){
			<?php
			if(Session::has('id_rekap')){
				if($rekap->tekanan_darah == '' || $rekap->frek_nadi == '' || $rekap->suhu == '' || $rekap->frek_nafas == '' || $rekap->berat_badan == '' || $rekap->tinggi_badan == '' || $rekap->lingkar_kepala == '' || $rekap->agama == '' || $rekap->pendidikan == '' || $rekap->pekerjaan == ''){
					?>
					swal('Notice','Periksa isian Anda! Pastikan Status Fisik, Antropometri, Agama, Pendidikan, dan Pekerjaan terisi.', 'info');
					<?php
				}else{
					?>
					swal({
						title: "Anda yakin mengakhiri pengisian?",
						text: "Data akan disimpan!",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: '#00a65a',
						confirmButtonText: 'Ya, akhiri!',
						cancelButtonText: 'Batal',
						closeOnConfirm: false,
						//closeOnCancel: false
					},
					function(){
						window.location="{!! route('unset_RM') !!}";
					});
					<?php
				}
			}
			?>
		}

		function batal_mengerjakan(){
			@if(Session::has('id_rekap'))
				swal({
					title: "Anda yakin membatalkan pengisian?",
					text: "Data tidak akan disimpan!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: '#f56954',
					confirmButtonText: 'Ya, lanjutkan!',
					cancelButtonText: 'Batal',
					closeOnConfirm: false,
					//closeOnCancel: false
				}, function() {
					swal.close();
					$.post("{!! route('membatalkanPengerjaan') !!}", {noRegister: {!! $rekap->no_Register ?? "" !!} }).done(function(response){
						if(response.status == "success"){
							window.location="{!! route('batal_mengerjakan') !!}";
						}else{
							swal("Error !",'Gagal Ketika Membatalkan Pengerjaan, Silahkan Coba Lagi','error');
						}
					}).fail(function(err){
						swal("Error !",'Gagal Ketika Membatalkan Pengerjaan, Silahkan Coba Lagi','error');
					});
				});
			@endif
		}

		function cancel_mengerjakan(){
			swal({
				title: "Anda yakin membatalkan pengisian?",
				text: "Data tidak akan disimpan!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#f56954',
				confirmButtonText: 'Ya, lanjutkan!',
				cancelButtonText: 'Batal',
				closeOnConfirm: false,
			},
			function(){
				swal.close();
				$.post("{!! route('membatalkanEdit') !!}",{})
				.done(function(response){
					if(response.status == "success"){
						window.location="{!! route('cancel_mengerjakan') !!}";
					}else{
						swal("Error !",'Gagal Ketika Membatalkan Edit, Silahkan Coba Lagi','error');
					}
				}).fail(function(err){
					swal("Error !",'Gagal Ketika Membatalkan Edit, Silahkan Coba Lagi','error');
				});
			});
		}

		function pindah_terapis(ke) {
			swal({
				title: "Pindah Pasien Ke Terapis?",
				text: "Data akan disimpan dan pasien akan diarahkan ke terapis.",
				type: "info",
				showCancelButton: true,
				confirmButtonColor: '#00a65a',
				confirmButtonText: 'Simpan & Pindahkan Pasien',
				cancelButtonText: 'Batal',
				closeOnConfirm: false,
			}, function(){
				swal.close();
				$.post("{!! route('pindahPasienRehab') !!}", {ke:ke}).done(function(res){
					if(res.status == "success"){
						swal({
							title: "Data Tersimpan & Pasien Berhasil Di Pindah",
							text: "Klik OK untuk kembali ke list pasien.",
							type: "success"
						}, function(){
							window.location = "{!! route('dataRegistrasiPerawat') !!}";
						});
					}else{
						swal("Galat!", 'Gagal Menyimpan! Silahkan Coba Lagi', 'error');
					}
				}).fail(function(err){
					swal("Galat!", 'Gagal Menyimpan! Silahkan Coba Lagi', 'error');
				});
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

		$(function() {
			$("#example1").dataTable({
				"bLengthChange": false,
				"oLanguage": {
					"sLengthMenu": "Tampilkan _MENU_ data per halaman",
					"sSearch": "Pencarian: ",
					"sZeroRecords": "Maaf, tidak ada data yang ditemukan",
					"sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
					"sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
					"sInfoFiltered": "(di filter dari _MAX_ total data)"
				}
			});
		});

		// tooltip demo
		$('.tooltip-demo').tooltip({
			selector: "[data-toggle=tooltip]",
			container: "body"
		})
	</script>
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('.sidebar-menu').find('.active').closest('.treeview').addClass('active');
	</script>

	@yield('js')
	@yield('js_tahap2')
	@yield('js_tahap3')
	@yield('js_tahap4')
	@yield('js_modal_obat')
	@yield('js_modal_laborat')
	@yield('js_modal_radio')
</body>
</html>
