<div class="col-lg-12 col-md-12 tahap3" style="padding: 0px">
    <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>

	<?php
	$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();	
	?>
	<form id="tahap3">
	<input type="hidden" id="NamaPerawatPakai" name="nama" readonly value="{!! $rekap->nama_perawat !!}">
	<div class="col-lg-12 col-md-12">
		<a href="{{route('cetak3')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
    	<a href="{{route('cetak3',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
	</div>
	<div class="clearfix"></div>
	<style type="text/css">
		.form1{
			 width: 70% !important;
			 display:inline !important;
		}
	</style>
	<!-- TANDA VITAL & ANTROPOMETRI -->
	<div class="col-lg-12 col-md-12" style="">
		<div class="col-lg-4 col-md-4" style="">
			<div class="col-lg-12 col-md-12" style="border:1px solid #ccc;box-shadow: 0px 5px 5px #ccc;">
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<h3>Tanda Vital</h3>	
				</div>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<table class="table table-bordered">
						<tr>
							<td>1 Tekanan Darah</td>
							<td><input type="text" class="form-control form1" name="tekanan_darah" value="{!! $rekap->tekanan_darah !!}">mmhg</td>
						</tr>
						<tr>
							<td>2 Frekuensi Nadi</td>
							<td><input type="text" class="form-control form1" name="frek_nadi" value="{!! $rekap->frek_nadi !!}">x/menit</td>
						</tr>
						<tr>
							<td>3 Suhu</td>
							<td><input type="text" class="form-control form1" name="suhu" value="{!! $rekap->suhu !!}">^C</td>
						</tr>
						<tr>
							<td>4 Frekuensi Nafas</td>
							<td><input type="text" class="form-control form1" name="frek_nafas" value="{!! $rekap->frek_nafas !!}">x/menit</td>
						</tr>
						<tr>
							<td>5 Skor Nyeri</td>
							<td><input type="text" class="form-control form1" name="skor_nyeri" value="{!! $rekap->skor_nyeri !!}"></td>
						</tr>
						<tr>
							<td>6 Skor Jatuh</td>
							<td><input type="text" class="form-control form1" name="skor_jatuh" value="{!! $rekap->skor_jatuh !!}"></td>
						</tr>
					</table>
					<div class="clearfix" style="margin-bottom: 10px"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4">
			<div class="col-lg-12 col-md-12" style="box-shadow: 0px 5px 5px #ccc;border: 1px solid #ccc;">
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<h3>Antromometri</h3>	
				</div>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<table class="table table-bordered">
						<tr>
							<td>1 Berat Badan</td>
							<td><input type="text" class="form-control" name="berat_badan" value="{!! $rekap->berat_badan !!}"></td>
						</tr>
						<tr>
							<td>2 Tinggi Badan</td>
							<td><input type="text" class="form-control" name="tinggi_badan" value="{!! $rekap->tinggi_badan !!}"></td>
						</tr>
						<tr>
							<td>3 Lingkar Kepala *</td>
							<td><input type="text" class="form-control" name="lingkar_kepala" value="{!! $rekap->lingkar_kepala !!}"></td>
						</tr>
						<tr>
							<td>4 IMT <br/><i>*Khusus pediatri</i></td>
							<td><input type="text" class="form-control" name="imt" value="{!! $rekap->imt !!}"></td>
						</tr>
					</table>
					<div class="clearfix" style="margin-bottom: 10px"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4">
			<div class="col-lg-12 col-md-12" style="box-shadow: 0px 5px 5px #ccc;border: 1px solid #ccc">
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<h3>Fungsional</h3>	
				</div>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<table class="table table-bordered">
						<tr>
							<td>
								<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12" for="alatBantu">1 Alat Bantu</label>
							</td>
							<td>
								<?php
								$check='';
								if($rekap->alat_bantu!=''){
									$check='checked';
								}
								?>
								<input type="checkbox" {!! $check !!} id="alatBantu" name="alat_bantu" value="ada">
							</td>
						</tr>
						<tr>
							<td>
								<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12" for="prothesa">2 Prothesa</label>
							</td>
							<td>
								<?php
								$check='';
								if($rekap->prothesa!=''){
									$check='checked';
								}
								?>
								<input type="checkbox" {!! $check !!} id="prothesa" name="prothesa" value="ada">
							</td>
						</tr>
						<tr>
							<td>
								<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12" for="cacatTubuh">3 Cacat Tubuh</label>
							</td>
							<td>
								<?php
								$check='';
								if($rekap->cacat_tubuh!=''){
									$check='checked';
								}
								?>
								<input type="checkbox" {!! $check !!} id="cacatTubuh" name="cacat_tubuh" value="ada">
							</td>
						</tr>
						<tr>
							<td>
								<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">4 ADI</label>
							</td>
							<td>
								<?php
								$check=['',''];
								if($rekap->adi=='mandiri'){
									$check=['checked',''];
								}else if($rekap->adi=='dibantu'){
									$check=['','checked'];
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="adi" value="mandiri"> Mandiri</label>
								<label style="margin-left: 20px"> <input type="radio" {!! $check[1] !!} name="adi" value="dibantu"> Dibantu</label>
							</td>
						</tr>
						<tr>
							<td>
								<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">5 Riwayat Jatuh</label>
							</td>
							<td>
								<?php
								$check=['',''];
								if($rekap->riwayat_jatuh=='+'){
									$check=['checked',''];
								}else if($rekap->riwayat_jatuh=='-'){
									$check=['','checked'];
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="riwayat_jatuh" value="+"> +</label>
								<label style="margin-left: 20px"> <input type="radio" {!! $check[1] !!} name="riwayat_jatuh" value="-"> -</label>
							</td>
						</tr>
						<tr>
							<td>
								<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">6 Skrining Nyeri</label>
							</td>
							<td>
								<?php
								$check=['',''];
								$display = 'display: none';
								if($rekap->skrining_nyeri=='Tidak' || $rekap->skrining_nyeri==''){
									$check=['','checked'];
								}else{
									$display = '';
									$check=['checked',''];
								}
								?>
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<div class="col-lg-4 col-md-4" style="padding: 0px">
										<label> <input type="radio" {!! $check[0] !!} id="adaSkriningNyeri" name="skrining_nyeri" value="Ada"> Ada</label>
									</div>
									<div class="col-lg-8 col-md-8">
										<input type="text" name="skrining_nyeri_lain" class="form-control" style="border-radius: 10px !important;{!! $display !!}" value="{!! $rekap->skrining_nyeri !!}">
									</div>
								</div>
								<br/>
								<label> <input type="radio" {!! $check[1] !!} name="skrining_nyeri" value="Tidak"> Tidak</label>
							</td>
						</tr>
					</table>
					<div class="clearfix" style="margin-bottom: 10px"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- FORM BAWAH -->
	<div class="clearfix" style="margin-bottom: 20px"></div>
	<div class="col-lg-12 col-md-12" style="box-shadow: 0px 10px 10px #ddd;border:1px solid #ccc;background: #fafafa">
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="form-group">
			<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Status Psikologi</label>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<?php
				$check=['','','',''];
				if($rekap->status_psikologi!=''){
					$st = explode("+", $rekap->status_psikologi);
					for ($i=0; $i < count($st)-1; $i++) { 
						if($st[$i]=='Depresi'){
							$check[0] = 'checked';
						} 
						if($st[$i]=='Takut'){
							$check[1] = 'checked';
						} 
						if($st[$i]=='Agresif'){
							$check[2] = 'checked';
						} 
						if($st[$i]=='Melukai diri sendiri/ Orang lain'){
							$check[3] = 'checked';
						}
					}
				}
				?>
				<label> <input type="checkbox" {!! $check[0] !!} name="status_psikologi[]" value="Depresi"> Depresi</label>
				<label style="margin-left: 20px"> <input type="checkbox" {!! $check[1] !!} name="status_psikologi[]" value="Takut"> Takut</label>
				<label style="margin-left: 20px"> <input type="checkbox" {!! $check[2] !!} name="status_psikologi[]" value="Agresif"> Agresif</label>
				<label style="margin-left: 20px"> <input type="checkbox" {!! $check[3] !!} name="status_psikologi[]" value="Melukai diri sendiri/ Orang lain"> Melukai diri sendiri/ Orang lain</label>
			</div>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="form-group">
			<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Hambatan edukasi</label>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<?php
				$check=['',''];
				$bahasaval = '';
				$display = 'display: none';
				if($rekap->hambatan!=''){
					$st = explode("+", $rekap->hambatan);
					for ($i=0; $i < count($st)-1; $i++) { 
						if($st[$i]=='Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)'){
							$check[1] = 'checked';
						}else{
							$check[0] = 'checked';
							$display = '';
							$bahasaval = $st[$i];
						} 
					}
				}
				?>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<div class="col-lg-4 col-md-4" style="padding: 0px">
						<label> <input type="checkbox" {!! $check[0] !!} id="hambatanBahasa" name="hambatan[]" value="Bahasa"> Bahasa</label>
					</div>
					<div class="col-lg-8 col-md-8">
						<input type="text" name="bahasa_lain" class="form-control" style="border-radius: 10px !important;{!! $display !!}" value="{!! $bahasaval !!}">
					</div>
				</div>
				<br/><label> <input type="checkbox" {!! $check[1] !!} name="hambatan[]" value="Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)"> Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)</label>
			</div>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="form-group">
			<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Agama/ Nilai Kepercayaan</label>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<input type="text" name="agama" class="form-control" value="{!! $rekap->agama !!}">
			</div>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="form-group">
			<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pendidikan</label>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<input type="text" name="pendidikan" class="form-control" value="{!! $rekap->pendidikan !!}">
			</div>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="form-group">
			<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pekerjaan</label>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<input type="text" name="pekerjaan" class="form-control" value="{!! $rekap->pekerjaan !!}">
			</div>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="form-group">
			<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Alergi</label>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<input type="text" name="alergi" class="form-control" value="{!! $rekap->alergi !!}">
			</div>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="form-group">
			<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Discharge Planning</label>
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
				<input type="text" name="discharge" class="form-control" value="{!! $rekap->discharge !!}">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
				Hari
			</div>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
	</div>
	<!-- FORM BAWAH -->
	<div class="clearfix" style="margin-bottom: 20px"></div>
	<div class="col-lg-12 col-md-12" style="box-shadow: 0px 10px 10px #ddd;border: 1px solid #ccc;background: #fafafa">
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="col-lg-12 col-md-12" style="padding: 0px">
			<div class="col-lg-6 col-md-6">
				<label class="col-lg-12 col-md-12" style="padding: 0px">Anamnesis (S) dan Pemeriksaan fisik (O) <i class="fa fa-camera pull-right" onclick="camera(5)"></i><i class="fa fa-edit pull-right" onclick="edit(5)"></i><i class="fa fa-upload pull-right" onclick="upload(5)"></i></label>
				<div class="clearfix"></div>
				<?php
				if($rekap->foto_anamnesis!=''){
					?>
					<div class="col-lg-12 col-md-12">
						<img src="{{asset($rekap->foto_anamnesis)}}" style="width: 100%">
					</div>
					<div class="clearfix"></div>
					<?php
				}
				?>
				<textarea class="form-control" placeholder="Text Here" name="anamnesis">{{$rekap->anamnesis}}</textarea>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					Kesan Status Gizi
					<?php
					$check = ['','',''];
					if($rekap->kesan_gizi!=''){
						$st = explode("+", $rekap->kesan_gizi);
						for ($i=0; $i < count($st)-1; $i++) { 
							switch ($st[$i]) {
								case '1':
									$check[0]='checked';
									break;
								case '2':
									$check[1]='checked';
									break;
								case '3':
									$check[2]='checked';
									break;
								
								default:
									# code...
									break;
							}
						}
					}
					?>
					<br/><label><input type="checkbox" {{$check[0]}} name="gizi[]" value="1">Gizi Kurang/ Buruk</label>
					<br/><label><input type="checkbox" {{$check[1]}} name="gizi[]" value="2">Gizi Cukup</label>
					<br/><label><input type="checkbox" {{$check[2]}} name="gizi[]" value="3">Gizi lebih</label>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<div class="col-lg-8 col-md-8" style="padding: 0px">
						<label class="col-lg-12 col-md-12" style="padding: 0px">Diagnosa <i class="fa fa-camera pull-right" onclick="camera(1)"></i><i class="fa fa-edit pull-right" onclick="edit(1)"></i><i class="fa fa-upload pull-right" onclick="upload(1)"></i></label>
						<div class="clearfix"></div>
						<?php
						if($rekap->fotodiagnosa!=''){
							?>
							<div class="col-lg-12 col-md-12">
								<img src="{!! asset($rekap->fotodiagnosa) !!}" style="width: 100%">
							</div>
							<div class="clearfix"></div>
							<?php
						}
						?>
						<textarea class="form-control" placeholder="Text Here" name="diagnosis3">{{$rekap->diagnosa}}</textarea>
					</div>
					<div class="col-lg-4 col-md-4" style="padding: 0px">	Kode ICD 10
						<div class="clearfix"></div>
						<textarea class="form-control" placeholder="Text Here" name="icd103">{{$rekap->icd10}}</textarea>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<label class="col-lg-12 col-md-12" style="padding: 0px">Rencana dan terapi (P) <i class="fa fa-camera pull-right" onclick="camera(6)"></i><i class="fa fa-edit pull-right" onclick="edit(6)"></i><i class="fa fa-upload pull-right" onclick="upload(6)"></i></label>
				<div class="clearfix"></div>
				<?php
				if($rekap->foto_rencana!=''){
					?>
					<div class="col-lg-12 col-md-12">
						<img src="{{asset($rekap->foto_rencana)}}" style="width: 100%">
					</div>
					<div class="clearfix"></div>
					<?php
				}
				?>
				<textarea class="form-control" placeholder="Text Here" name="rencana3">{{$rekap->rencana_terapi}}</textarea>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="col-lg-12 col-md-12" style="padding: 0px;;">
					Dirujuk/ Konsul ke
					<div class="clearfix"></div>
					<textarea class="form-control" placeholder="Text Here" name="rujuk3">{{$rekap->diruju_ke}}</textarea>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="col-lg-12 col-md-12 tahap5" style="padding: 0px">	
				<script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>

				<?php
				$resep = DB::table('trrawatjalanobat')->where('No_Register',$rekap->no_Register)->get();
				?>
				Obat E-Resep
				<table class="table table-bordered" style="background: #fff">
					<thead>
						<tr>
							<th>Nama Obat</th>
							<th>Qty</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(count($resep)==0){
							?>
							<tr>
								<td colspan="2">Belum ada resep d e-resep</td>
							</tr>
							<?php
						}else{
							foreach ($resep as $key) {
								?>
								<tr>
									<td>{{$key->NamaBrg}}</td>
									<td>{{$key->Jml.' '.$key->Satuan}}</td>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
			</div>
		</div>

		<div class="clearfix" style="margin-bottom: 10px"></div>
		<div class="col-lg-12 col-md-12" style="text-align: center;">
			<a href="#" class="btn btn-success" onclick="simpantahap3()">Simpan</a>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
	</div>
	</form>
</div>
<div class="clearfix"></div>

@section('js_tahap3')
<script type="text/javascript">

	$('input[name=skrining_nyeri]').change(function(){
		var skrining_nyeri = $('input[name=skrining_nyeri]:checked').val();
		if(skrining_nyeri=='Ada'){
			$('input[name=skrining_nyeri_lain]').show();
			$('input[name=skrining_nyeri_lain]').attr('required','required');
		}else{
			$('input[name=skrining_nyeri_lain]').hide();
			$('input[name=skrining_nyeri_lain]').removeAttr('required');
		}
	});

	window.onload = function(){
		$('input[name=skrining_nyeri]').change(function(){
			var skrining_nyeri = $('input[name=skrining_nyeri]:checked').val();
			if(skrining_nyeri=='Ada'){
				$('input[name=skrining_nyeri_lain]').show();
				$('input[name=skrining_nyeri_lain]').attr('required','required');
			}else{
				$('input[name=skrining_nyeri_lain]').hide();
				$('input[name=skrining_nyeri_lain]').removeAttr('required');
			}
		});
	}

	function simpantahap3(){
		var i = 0;

		if($('input[name=bahasa_lain]').is(':visible')){
			var bahasa_lain = $('input[name=bahasa_lain]').val();
			if(bahasa_lain==''){
				swal('Hambatan bahasa harus diisi');
				i++;
			}
		}

		var skrining_nyeri = $('input[name=skrining_nyeri]:checked').val();
		if(skrining_nyeri=='Ada'){
			var lain_nyeri = $('input[name=skrining_nyeri_lain]').val();
			if (lain_nyeri=='') {
				swal('Keterangan skrining nyeri harus diisi');
				i++;
			}
		}

		var perawat = $('#NamaPerawatPakai').val();
		var tekanan_darah = $('input[name=tekanan_darah]').val();
		var frek_nadi = $('input[name=frek_nadi]').val();
		var suhu = $('input[name=suhu]').val();
		var frek_nafas = $('input[name=frek_nafas]').val();
		var skor_nyeri = $('input[name=skor_nyeri]').val();
		var skor_jatuh = $('input[name=skor_jatuh]').val();
		var berat_badan = $('input[name=berat_badan]').val();
		var tinggi_badan = $('input[name=tinggi_badan]').val();
		var lingkar_kepala = $('input[name=lingkar_kepala]').val();
		var imt = $('input[name=imt]').val();

		if(isNaN(imt)){
			swal('IMT berupa angka');
			i++;
		}

		if(isNaN(lingkar_kepala)){
			swal('Lingkar kepala berupa angka');
			i++;
		}

		if(isNaN(tinggi_badan)){
			swal('Tinggi badan berupa angka');
			i++;
		}

		if(isNaN(berat_badan)){
			swal('Berat badan berupa angka');
			i++;
		}

		if(isNaN(skor_jatuh)){
			swal('Skor jatuh berupa angka');
			i++;
		}

		if(isNaN(skor_nyeri)){
			swal('Skor nyeri berupa angka');
			i++;
		}

		if(isNaN(frek_nafas)){
			swal('Frekuensi nafas berupa angka');
			i++;
		}

		if(isNaN(suhu)){
			swal('Suhu berupa angka');
			i++;
		}

		if(isNaN(frek_nadi)){
			swal('Frekuensi nadi berupa angka');
			i++;
		}

		if(isNaN(tekanan_darah)){
			swal('Tekanan darah berupa angka');
			i++;
		}

		if(perawat=='' || perawat==null){
			swal('Nama perawat tidak oleh kosong');
			i++;
		}

		if(i==0){
			var data = $('form#tahap3').serialize();
			$.post("{!! route('simpanTahap3') !!}",data,function(data){
				if(data.status=='success'){
					swal("Success !",'Data berhasil ditambahkan','success');
					$(".tahap3").load(location.href + " .tahap3>*", "");
				}else{
					swal("Success !",'Data berhasil ditambahkan','success');
				}
			});
		}

	}

	$('#inputNamaPerawat').val("{!! $rekap->nama_perawat !!}")

	// $('input[name=bahasa_lain]').hide();
	$('#hambatanBahasa').change(function(){
		if($('input[name=bahasa_lain]').is(':visible')){
			$('input[name=bahasa_lain]').hide();
			$('input[name=bahasa_lain]').removeAttr('required');
		}else{
			$('input[name=bahasa_lain]').show();
			$('input[name=bahasa_lain]').attr('required','required');
		}
	});
	function upload(id){
		window.open("{!! url('rekap_medik/p5/') !!}/"+id);
	}
	function camera(id){
		window.open("{!! url('rekap_medik/p3/') !!}/"+id);
	}
	function edit(id){
		window.open("{!! url('rekap_medik/p1/') !!}/"+id);
	}
</script>
@stop