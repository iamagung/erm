<style type="text/css">
	.pake-bg{
		background-color: #D5F2E0;
	}
	label.form-control {
		font-weight: normal !important;
		background-color: #eee;
	}
</style>
<div class="col-lg-12 col-md-12 tahap3" style="padding: 0px">
	<?php
		$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
		$rekap2 = DB::table('rekam_medis_lanjutan')->where('rekam_medis_id',Session::get('id_rekap'))->first();
		$cat_bayar = DB::connection('rsu')->table('tm_setupall')->where('groups','Asuransi')->get();
	?>
	<form id="tahap3">
		<input type="hidden" name="nama" value="{!! $rekap->nama_perawat !!}">
		<!-- <div class="col-lg-12 col-md-12">
			<a href="{{route('cetak3')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
			<a href="{{route('cetak3',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
		</div> -->
		<div class="clearfix"></div>
		<style type="text/css">
			.form1{
				width: 70% !important;
				display:inline !important;
			}
			.chzn-container{width: 100% !important;}
		</style>
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="panel-group">
			<!-- I. Riwayat Kesehatan dan Data Diri Pasien -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<div class="row">
							<div class="col-lg-8 col-md-8">
								<label style="font-weight: bold; font-size: 20px">I. Riwayat Kesehatan dan Data Diri Pasien</label>
							</div>
							<div class="col-lg-4 col-md-4">
								<a id="max1" class="btn btn-sm btn-info pull-right" data-toggle="collapse" href="#step1">Tutup</a>
							</div>
						</div>
					</h4>
				</div>
				<!-- <div id="step1" class="panel-collapse collapse in"> -->
				<div id="step1" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tgl_tiba" class="col-md-4">Tanggal/Jam tiba di ruangan</label>
									<div class="col-md-8">
										<input type="text" id="tgl_tiba" name="tgl_tiba" class="form-control" value="{!! date('d-m-Y, H:i:s') !!}" readonly>
									</div>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row sub-title">
							<div class="col-md-12" style="margin: 10px auto 5px">
								<h4 class="col-md-12" style="font-weight: bold; text-decoration: underline;">A. Riwayat Kesehatan</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="riwayatpas">Riwayat Penyakit Pasien (Penyakit Utama / Operasi / Cedera Mayor)</label>
									<input type="text" id="riwayatpas" name="riwayatpas" class="form-control" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="riwayatkel">Riwayat Penyakit Keluarga</label>
									<input type="text" id="riwayatkel" name="riwayatkel" class="form-control" value="">
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row sub-title">
							<div class="col-md-12" style="margin: 10px auto 5px">
								<h4 class="col-md-12" style="font-weight: bold; text-decoration: underline;">B. Status Sosial, Ekonomi, Spiritual, Suku/Budaya, Nilai Kepercayaan</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="pekerjaanpj">Pekerjaan Penanggung Jawab/OT Pasien</label>
									<input type="text" id="pekerjaanpj" name="pekerjaanpj" class="form-control" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="pendidikanpj">Pendidikan Suami/Istri/PJ/OT</label>
									<input type="text" id="pendidikanpj" name="pendidikanpj" class="form-control" value="">
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group col-md-12">
									<label for="psikologiot">Status Psikologi Orang Tua</label>
									<input type="text" id="psikologiot" name="psikologiot" class="form-control" value="">
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="agama">Agama/Nilai Kepercayaan</label>
									<input type="text" id="agama" name="agama" class="form-control" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="suku">Suku</label>
									<input type="text" id="suku" name="suku" class="form-control" value="">
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>

			<!-- II. Pengkajian Keperawatan -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<div class="row">
							<div class="col-lg-8 col-md-8">
								<label style="font-weight: bold; font-size: 20px">II. Pengkajian Keperawatan</label>
							</div>
							<div class="col-lg-4 col-md-4">
								<a id="max2" class="btn btn-sm btn-info pull-right" data-toggle="collapse" href="#step2">Buka</a>
							</div>
						</div>
					</h4>
				</div>
				<div id="step2" class="panel-collapse collapse in">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="tgl_hd">Tanggal Mulai Hemodialisa</label>
									<input type="text" id="tgl_hd" name="tgl_hd" class="form-control" value="">
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row" style="padding: 0 30px;">
							<div class="panel pake-bg">
								<div class="panel-body">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nomesin" class="col-md-4">No. Mesin</label>
											<div class="col-md-8">
												<input type="text" id="nomesin" name="nomesin" class="form-control" value="">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tipe_dialiser" class="col-md-4">Tipe Dialiser N/R</label>
											<div class="col-md-8">
												<input type="text" id="tipe_dialiser" name="tipe_dialiser" class="form-control" value="">
											</div>
										</div>
									</div>
									<div class="clearfix" style="margin-bottom: 10px;"></div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="hd_ke" class="col-md-4">Hemodialisa Ke</label>
											<div class="col-md-8">
												<input type="text" id="hd_ke" name="hd_ke" class="form-control" value="">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="riwayatalergi" class="col-md-4">Riwayat Alergi</label>
											<div class="col-md-8">
												<input type="text" id="riwayatalergi" name="riwayatalergi" class="form-control" value="">
											</div>
										</div>
									</div>
									<div class="clearfix" style="margin-bottom: 10px;"></div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="diagnosa" class="col-md-4">Diagnosa</label>
											<div class="col-md-8">
												<input type="text" id="diagnosa" name="diagnosa" class="form-control" value="">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="carabayar" class="col-md-4">Cara Bayar</label>
											<div class="col-md-8">
												<input type="text" id="carabayar" name="carabayar" class="form-control" value="">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="keluhanutama">Keluhan Utama</label>
									<input type="text" id="keluhanutama" name="keluhanutama" class="form-control" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="nyeri">Nyeri</label>
									<input type="text" id="nyeri" name="nyeri" class="form-control" value="">
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="nrsva">NRS/VA</label>

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="wongbaker">WONG BAKER FACE SCALE</label>

								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row sub-title">
							<div class="col-md-12" style="margin: 10px auto 5px">
								<h4 class="col-md-12" style="font-weight: bold; text-decoration: underline;">PEMERIKSAAN FISIK</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="keadaanumum">Keadaan Umum</label>
									<input type="text" id="keadaanumum" name="keadaanumum" class="form-control" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="td[]">Tekanan Darah</label>
									<div class="input-group">
										<input type="text" id="td1" name="td[]" class="form-control" maxlength="3">
										<span class="input-group-addon">/</span>
										<input type="text" id="td2" name="td[]" class="form-control" maxlength="3">
										<span class="input-group-addon">mmHg</span>
									</div>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<div class="col-md-12">
									<label for="nadi">Nadi</label>
								</div>
								<div class="col-md-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="nadi[0]" id="reguler" value="reguler" checked>
										<label class="form-check-label" for="reguler"> Reguler</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="nadi[0]" id="ireguler" value="ireguler">
										<label class="form-check-label" for="ireguler"> Ireguler Frekwensi</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<input type="text" id="nadi" name="nadi[1]" class="form-control" maxlength="3">
										<span class="input-group-addon">x/menit</span>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<div class="col-md-12">
									<label for="pernafasan">Pernafasan</label>
								</div>
								<!--  -->
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<div class="col-md-12">
									<label for="konjungtiva">Konjungtiva</label>
								</div>
								<div class="col-md-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="konjungtiva" id="tidak" value="N" checked>
										<label class="form-check-label" for="tidak"> Tidak Anemis</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="konjungtiva" id="anemis" value="Y">
										<label class="form-check-label" for="anemis"> Anemis</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="konjungtiva" id="lain" value="Lainnya">
										<label class="form-check-label" for="lain"> Lain-lain</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<input type="text" id="konjungtiva_lain" name="konjungtiva_lain" class="form-control" placeholder="Ketik konjungtiva ...">
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<div class="col-md-12">
									<label for="ekstrimitas">Ekstrimitas</label>
								</div>
								<!--  -->
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<div class="col-md-12">
									<label for="bb">Berat Badan</label>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">Pre HD</span>
										<input type="text" id="bb1" name="bb[]" class="form-control" maxlength="3" placeholder="___">
										<span class="input-group-addon">Kg</span>
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon">BB Kering</span>
										<input type="text" id="bb2" name="bb[]" class="form-control" maxlength="3" placeholder="___">
										<span class="input-group-addon">Kg</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">BB HD y.1</span>
										<input type="text" id="bb3" name="bb[]" class="form-control" maxlength="3" placeholder="___">
										<span class="input-group-addon">Kg</span>
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon">Post HD</span>
										<input type="text" id="bb4" name="bb[]" class="form-control" maxlength="3" placeholder="___">
										<span class="input-group-addon">Kg</span>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<div class="col-md-12">
									<label for="tb">Tinggi Badan</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input type="text" id="tb" name="tb" class="form-control" maxlength="3" placeholder="___">
										<span class="input-group-addon">cm</span>
									</div>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<div class="col-md-12">
									<label for="vascular">Akses Vascular</label>
								</div>
								<div class="col-md-4">
									<div class="col-md-6" style="padding: 0;">
										<span>AV - Fistula HD Karakter:</span>
									</div>
									<div class="input-group col-md-6">
										<span class="input-group-addon">
											<input type="radio" id="av1" name="vascular" class="" value="Subclavia">
										</span>
										<label for="av1" class="form-control">Subclavia</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="av2" name="vascular" class="" value="Jugular">
										</span>
										<label for="av2" class="form-control">Jugular</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="av3" name="vascular" class="" value="Femoral">
										</span>
										<label for="av3" class="form-control">Femoral</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="av4" name="vascular" class="" value="Lainnya">
										</span>
										<input type="text" id="av5" name="vascular_lain" class="form-control" placeholder="Lain-lain">
									</div>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label class="col-md-12" for="risikojatuh">Risiko Jatuh</label>
							</div>
							<div class="col-md-12" style="margin-bottom: 10px;">
								<div class="col-md-4">
									<span id="jatuh1">1. Riwayat jatuh yang baru atau dalam bulan terakhir</span>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh1-1" name="jatuh1" value="0">
										</span>
										<label for="jatuh1-1" class="form-control">Tidak (0)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh1-2" name="jatuh1" class="" value="25">
										</span>
										<label for="jatuh1-2" class="form-control">Iya (25)</label>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="margin-bottom: 10px;">
								<div class="col-md-4">
									<span id="jatuh2">2. Diagnosis medis sekunder > 2</span>
								</div>
								<div class="col-md-2">
									<label class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh2-1" name="jatuh2" value="0">
										</span>
										<label class="form-control" for="jatuh2-1">Tidak (0)</label>
									</label>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh2-2" name="jatuh2" class="" value="15">
										</span>
										<label class="form-control" for="jatuh2-2">Iya (15)</label>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="margin-bottom: 10px;">
								<div class="col-md-4">
									<span id="jatuh3">3. Alat bantu jalan</span>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh3-1" name="jatuh3" value="0">
										</span>
										<label class="form-control" for="jatuh3-1">Bad Rest (0)</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh3-2" name="jatuh3" class="" value="15">
										</span>
										<label class="form-control" for="jatuh3-2">Penopang, Tongkat (15)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh3-3" name="jatuh3" class="" value="30">
										</span>
										<label class="form-control" for="jatuh3-3">Furniture (30)</label>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="margin-bottom: 10px;">
								<div class="col-md-4">
									<span id="jatuh4">4. Memakai terapi heparin lock / iv</span>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh4-1" name="jatuh4" value="0">
										</span>
										<label class="form-control" for="jatuh4-1">Tidak (0)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh4-2" name="jatuh4" class="" value="20">
										</span>
										<label class="form-control" for="jatuh4-2">Iya (20)</label>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="margin-bottom: 10px;">
								<div class="col-md-4">
									<span id="jatuh5">5. Cara berjalan / berpindah</span>
								</div>
								<div class="col-md-2" style="width: 30% !important;">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh5-1" name="jatuh5" value="0">
										</span>
										<label class="form-control" for="jatuh5-1">Normal/Bed Rest/Imobilisasi (0)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh5-2" name="jatuh5" class="" value="15">
										</span>
										<label class="form-control" for="jatuh5-2">Lemah (15)</label>
									</div>
								</div>
								<div class="col-md-2" style="width: 20% !important;">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh5-3" name="jatuh5" class="" value="30">
										</span>
										<label class="form-control" for="jatuh5-3">Terganggu (30)</label>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="margin-bottom: 10px;">
								<div class="col-md-4">
									<span id="jatuh6">6. Status mental</span>
								</div>
								<div class="col-md-4" style="width: 30% !important;">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh6-1" name="jatuh6" value="0">
										</span>
										<label class="form-control" for="jatuh6-1">Orientasi Sesuai Kemampuan (0)</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="jatuh6-2" name="jatuh6" class="" value="15">
										</span>
										<label class="form-control" for="jatuh6-2">Lupa Keterbatasan (15)</label>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="margin-bottom: 10px;">
								<div class="col-md-4">
									<label>Total Skor & Kesimpulan</label>
								</div>
								<div class="col-md-2">
									<div class="input-group">
										<input type="text" id="totalskor" class="form-control" name="totalskor">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="radio" id="kesimpulan1" name="kesimpulan" class="" value="Tidak Berisiko">
										</span>
										<label class="form-control" for="kesimpulan1">Tidak Berisiko</label>
										<span class="input-group-addon">
											<input type="radio" id="kesimpulan2" name="kesimpulan" class="" value="Risiko Rendah">
										</span>
										<label class="form-control" for="kesimpulan2">Risiko Rendah</label>
										<span class="input-group-addon">
											<input type="radio" id="kesimpulan3" name="kesimpulan" class="" value="Risiko Tinggi">
										</span>
										<label class="form-control" for="kesimpulan3">Risiko Tinggi</label>
									</div>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>

			<!-- III. Pengkajian Dokter -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<div class="row">
							<div class="col-lg-8 col-md-8">
								<label style="font-weight: bold; font-size: 20px">III. Pengkajian Dokter</label>
							</div>
							<div class="col-lg-4 col-md-4">
								<a id="max3" class="btn btn-sm btn-info pull-right" data-toggle="collapse" href="#step3">Buka</a>
							</div>
						</div>
					</h4>
				</div>
				<div id="step3" class="panel-collapse collapse">
					<div class="panel-body">

					</div>
					<div class="panel-footer text-center">
						<button type="button" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>
		</div> 
	</form>
</div>
<div class="clearfix"></div>

@section('js_tahap3')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{!! url('adminAsset/js/ckeditor1/ckeditor.js') !!}"></script>
<script src="{!! url('adminAsset/js/ckeditor1/adapters/jquery.js') !!}"></script>

<script type="text/javascript">
	$(document).ready(function() {

	});

	var max1 = 0;
	$('#max1').click(function() {
		if (max1 == 1) {
			max1 = 0;
			$('#max1').html('Tutup');
		} else {
			max1 = 1;
			$('#max1').html('Buka');
		}
	});
	var max2 = 1;
	$('#max2').click(function() {
		if (max2 == 1) {
			max2 = 0;
			$('#max2').html('Tutup');
		} else {
			max2 = 1;
			$('#max2').html('Buka');
		}
	});
	var max3 = 1;
	$('#max3').click(function() {
		if (max3 == 1) {
			max3 = 0;
			$('#max3').html('Tutup');
		} else {
			max3 = 1;
			$('#max3').html('Buka');
		}
	});

	$(function() {
		$(".chzn-select").chosen();
	});

	window.onload = function() {
		$('input[name=skrining_nyeri]').change(function() {
			var skrining_nyeri = $('input[name=skrining_nyeri]:checked').val();
			if (skrining_nyeri == 'Ada') {
				$('input[name=skrining_nyeri_lain]').show();
				$('input[name=skrining_nyeri_lain]').attr('required', 'required');
			} else {
				$('input[name=skrining_nyeri_lain]').hide();
				$('input[name=skrining_nyeri_lain]').removeAttr('required');
			}
		});
	}
</script>
@stop