<?php 
if(Auth::user()->level == '2') {
	$view = 'dokter.master.main';
} else {
	$view = 'perawat.master.main';
}
// echo $view;
?>
@extends($view)

@section('css')
<style type="text/css">
	a .panel-heading:hover {
		opacity: 0.7;
	}
</style>
@stop

@section('content')
<section class="content-header">
	<h1 class="text-center">Pemanggilan Antrian</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Sedang Dilayani</h3>
				</div>
				<div class="panel-body text-center">
					<h3 style="margin:0;">L300</h3>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Belum Dipanggil</h3>
				</div>
				<div class="panel-body text-center">
					<h3 style="margin:0;">L300</h3>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Jumlah Antrian</h3>
				</div>
				<div class="panel-body text-center">
					<h3 style="margin:0;">L300</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-success">
								<div class="panel-heading text-center">
									<h4><b>Sedang Dilayani: </b></h4>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a href="">
								<div class="panel panel-danger">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-7">
												<h4>Ulangi Panggilan<br>Pasien</h4>
											</div>
											<div class="col-md-3">
												<h4><i class="fa fa-retweet" style="font-size: 40px;"></i></h4>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-6">
							<a href="">
								<div class="panel panel-info">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-7">
												<h4>Ulangi Panggilan<br>Pasien Gariatri</h4>
											</div>
											<div class="col-md-3">
												<h4><i class="fa fa-retweet" style="font-size: 40px;"></i></h4>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a href="">
								<div class="panel panel-danger">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-7">
												<h4>Pasien<br>Selanjutnya</h4>
											</div>
											<div class="col-md-3">
												<h4><i class="fa fa-chevron-circle-right" style="font-size: 40px;"></i></h4>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-6">
							<a href="">
								<div class="panel panel-info">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-7">
												<h4>Pasien Gariatri<br>Selanjutnya</h4>
											</div>
											<div class="col-md-3">
												<h4><i class="fa fa-chevron-circle-right" style="font-size: 40px;"></i></h4>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Antrian Pasien:</h3>
								</div>
								<div class="panel-body">
									Panel content
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Antrian Pasien Geriatri:</h3>
								</div>
								<div class="panel-body">
									Panel content
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Sudah Terlayani</h3>
				</div>
				<div class="panel-body">
					Panel content
				</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('js')
@stop