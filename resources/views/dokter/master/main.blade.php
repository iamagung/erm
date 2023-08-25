<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Dokter - {!! $identitas->nama_web !!}</title>
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

	@yield('css')
</head>
<body class="skin-black">
	<header class="header">
		<a href="{!! route('home') !!}" class="logo">Dokter web</a>
		<nav class="navbar navbar-static-top" role="navigation">
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<?php
					$rujuk = DB::table('rujukan_rm')->where('KodePoli', $dokter->poli_id)->where('HasilRujuk',null)->get();
					?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-globe"></i>({{count($rujuk)}})<i class="caret"></i>
						</a>
						<ul class="dropdown-menu" style="width: none">
							<?php
							foreach ($rujuk as $key) {
								?>
								<li style="border-bottom: 2px solid black">
									<a href="{{url('dokter/rujuk/'.$key->id_rujukan)}}" style="color: black !important">
										<p style="font-weight: bold;font-size: 15px">{{$key->NamaPasien}}</p>
										<p>{{$key->DariDokter}} ({{$key->DariPoli}})</p>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
					</li>
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user"></i>
							<span>{!! $dokter->Nama_Dokter !!}<i class="caret"></i></span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header bg-light-blue">
								<?php
								if (Auth::user()->foto_user==null) {
									$foto_user = "blank-profile.jpg";
								}else{
									$foto_user = Auth::user()->foto_user;
								}
								?>
								<img src="{!! asset($identitas->favicon) !!}" class="img-circle" alt="User Image" />
								<p>
									{!!  $dokter->Nama_Dokter !!} - Dokter web
								</p>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<a href="{!! route('profileDokter') !!}" class="btn btn-default btn-flat">Profil</a>
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
						<p>Hello, {!!  $dokter->Nama_Dokter !!}</p>
						<a href="{!! url('logouts') !!}"><i class="fa fa-key text-danger"></i> Keluar</a>
					</div>
				</div>
				<ul class="sidebar-menu">
					<!-- <li class="@if($active == 1) active @endif"><a href="{!! route('home') !!}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> -->
					<!-- <li class="@if($active == 8) active @endif"><a href="{!! route('antrian') !!}"><i class="fa fa-users"></i> <span>Antrian Pasien</span></a></li> -->
					<!-- <li class="@if($active == 2) active @endif"><a href="{!! route('tambahRekapMedik') !!}"><i class="fa fa-briefcase"></i> <span>Cari Rekam Medis</span></a></li> -->
					<!-- <li class="@if($active == 5) active @endif"><a href="{!! route('userPerawatDokter') !!}"><i class="fa fa-users"></i> <span>Data Perawat</span></a></li> -->
					<!-- <li class="@if($active == 3) active @endif"><a href="{!! route('dataRegistrasi') !!}"><i class="fa fa-users"></i> <span>Data Registrasi Pasien</span></a></li> -->
					<li class="@if($active == 3) active @endif"><a href="{!! route('dataRegistrasi') !!}"><i class="fa fa-users"></i> <span>Input Rekam Medis</span></a></li>

					<li class="treeview @if($active == 6) active @endif">
						<a href="#">
							<i class="fa fa-list-alt"></i> <span>Rujukan</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<?php
						$ajukan = count(DB::table('rujukan_rm')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->get());
						$jawab = count(DB::table('rujukan_rm')->where('KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->get());
						?>
						<ul class="treeview-menu">
							<li class="@if($active_sub == 61) active @endif"><a href="{{route('ajukan_pertanyaan')}}"><i class="fa fa-angle-double-right"></i> Ajukan Pertanyaan ({{$ajukan}})</a></li>
							<li class="@if($active_sub == 62) active @endif"><a href="{{route('jawab_pertanyaan')}}"><i class="fa fa-angle-double-right"></i> Jawab Pertanyaan ({{$jawab}})</a></li>
						</ul>
					</li>
					<li class="@if($active == 4) active @endif"><a href="{!! route('rekam_new_all') !!}"><i class="fa fa-briefcase"></i> <span>History Pasien</span></a></li>
					<li class="@if($active == 7) active @endif"><a href="{!! route('historyPasien') !!}"><i class="fa fa-clock-o"></i> <span>History Obat</span></a></li>
					<li class="@if($active == 4) active @endif"><a href="javascript:void(0);" onclick="swal('Notice!','Menu sedang dalam proses pengembangan.','info');"><i class="fa fa-briefcase"></i> <span>Jasa Konsultasi</span></a></li>
					<li class="@if($active == 1) active @endif"><a href="{!! route('home') !!}"><i class="fa fa-dashboard"></i> <span>Grafik Kunjungan Pasien</span></a></li>

					<!-- <li class="treeview @if($active == 7) active @endif">
						<a href="#">
							<i class="fa fa-list-alt"></i> <span>Form-form</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="@if($active_sub == 71) active @endif"><a href="route('pembuatanObat')"><i class="fa fa-angle-double-right"></i> Pembuatan Resep</a></li>
							<li class="@if($active_sub == 72) active @endif"><a href="route('buatEditResep')"><i class="fa fa-angle-double-right"></i> Buat - Edit Resep</a></li>

							<li class="@if($active_sub == 73) active @endif"><a href="route('historyPasien')"><i class="fa fa-angle-double-right"></i> History Pasien</a></li>

							<li class="@if($active_sub == 74) active @endif"><a href="route('cetakReport')"><i class="fa fa-angle-double-right"></i> Cetak Report</a></li>
						</ul>
					</li> -->

					<!-- <li class="@if($active == 4) active @endif"><a href="{!! route('dataRekapMedik') !!}"><i class="fa fa-briefcase"></i> <span>Data Rekam Medis</span></a></li> -->
					<!-- <li class="@if($active == 4) active @endif"><a href="{!! route('rekam_new_all') !!}"><i class="fa fa-briefcase"></i> <span>Data Rekam Medis</span></a></li> -->
					<!-- <li class="@if($active == 4) active @endif"><a href="{!! route('rekam_new_all') !!}"><i class="fa fa-briefcase"></i> <span>History Pasien</span></a></li> -->
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
				<?php if(Session::has('no_RM')){
					$dokter = DB::table('login_dokter')->where('user_id', auth::user()->id)->first();
					$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
					$customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',Session::get('no_RM'))->first();
					// CEK USING REGISTER
					$alergi = DB::connection('rsu')->table('tr_resep_m')->where('No_Register',$rekap->no_Register)->first();
					if(!empty($alergi)){

					}else{
						$alergi = DB::connection('rsu')->table('tr_resep_m')->where('No_RM',Session::get('no_RM'))->orderBy('No_Register','DESC')->first();
					}
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
					<a href="#" onclick="finish_add()" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Selesai</a>
					<!-- IF POLI REHAB / NOT -->
					@if($dokter->poli_id == '117')
					<a href="javascript:void(0);" onclick="pindah_terapis('terapis')" class="btn btn-sm btn-warning"><i class="fa fa-save"></i> Pindah Ke Terapis</a>
					@endif
					<!--  -->
					@if($rekap->anamnesis=='' || $rekap->diagnosa == '')
					<a href="#" onclick="batal_mengerjakan()" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash-o"></i> Batal Mengerjakan</a>
					@else
					<a href="#" onclick="cancel_mengerjakan()" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash-o"></i> Batal Edit</a>
					@endif
				</div>
			<?php } ?>
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
		let auth = {!! Auth::User()->level !!};
		<?php
		if(Session::has('id_rekap')){
			if($rekap->anamnesis=='' || $rekap->diagnosa == ''){
				?>
				swal('Notice','Periksa isian Anda! Pastikan Anamnesis (S) dan Diagnosa (A) sudah terisi.', 'info');
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
		<?php
		if(Session::has('id_rekap')){
			?>
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
				$.post("{!! route('membatalkanPengerjaan') !!}",{noRegister: {!! $rekap->no_Register ?? ""!!}  })
				.done(function(response){
					if(response.status == "success"){
						window.location="{!! route('batal_mengerjakan') !!}";
					}else{
						swal("Error !",'Gagal Ketika Membatalkan Pengerjaan, Silahkan Coba Lagi','error');
					}
				}).fail(function(err){
					swal("Error !",'Gagal Ketika Membatalkan Pengerjaan, Silahkan Coba Lagi','error');
				});
			});
			<?php
		}
		?>
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
