<style type="text/css">
	.edu tr ul{
		padding-left: 10px;
	}
</style>
<div class="col-lg-12 col-md-12 tahap4" style="padding: 0px">
	<script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>

	<?php
		$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
		$rekap2 = DB::table('rekam_medis_lanjutan')->where('rekam_medis_id',Session::get('id_rekap'))->first();
	?>
	<div class="col-lg-12 col-md-12">
		<a href="{{route('cetak4')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
    	<a href="{{route('cetak4',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
	</div>
	<form id="tahap4">
	<div class="clearfix"></div>
	<div class="col-lg-12 col-md-12">
		<i><b>(*) </b>wajib diisi, jika tidak ada beri <b> - </b></i>
	</div>
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-6 col-md-6">
			<div class="col-lg-12 col-md-12" style="padding: 0px">
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Nama Panggilan</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="nama_panggilan" value="{!! $rekap->nama_panggilan !!}" readonly>
					</div>
				</div>	
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Agama</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="agama_edu" value="{{$rekap->agama_edu}}" readonly>
					</div>
				</div>	
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<!-- <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Nilai-nilai yang dianut</label> -->
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Nilai-Nilai Kepercayaan</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<input type="text" readonly class="form-control" name="anutan" value="{!! $rekap->anutan !!}">
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="col-lg-12 col-md-12" style="padding: 0px">
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Keyakinan Pasien & Keluarga</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<input type="text" readonly class="form-control" name="anutan" value="{!! $rekap->anutan !!}">
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Suku dan Budaya</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<input type="text" readonly class="form-control" name="suku" value="{!! (isset($rekap2->suku))?$rekap2->suku:'' !!}">
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Pendidikan </label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="pendidikan_edu" value="{{$rekap->pendidikan_edu}}" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr style="border:2px solid #000;">
	<div class="col-lg-12 col-md-12" style="margin-top: 20px">
		<div class="col-lg-6 col-md-6">
			<div class="col-lg-12 col-md-12" style="padding: 0px">
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Bahasa yang dipakai</label>
					<?php
						$check=['','','',''];
						$display = 'display:none';
						$isi='';
						if($rekap->bahasa_edu!=''){
							$st = explode("+", $rekap->bahasa_edu);
							for ($i=0; $i < count($st)-1; $i++) { 
								if($st[$i]=='Indonesia'){
									$check[0]='checked';
								}else if($st[$i]=='Mandarin'){
									$check[1]='checked';
								}else if($st[$i]=='Inggris'){
									$check[2]='checked';
								}else{
									$display='';
									$isi = $st[$i];
									$check[3]='checked';
								}
							}
						}
					?>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<label> <input type="checkbox" name="bahasa_dipakai[]" value="Indonesia" {!! $check[0] !!}> Indonesia</label>
						<label style="margin-left: 20px"> <input type="checkbox" name="bahasa_dipakai[]" value="Mandarin" {!! $check[1] !!}> Mandarin</label>
						<label style="margin-left: 20px"> <input type="checkbox" name="bahasa_dipakai[]" value="Inggris" {!! $check[2] !!}> Inggris</label>
						<br/>
						<div class="col-lg-12 col-md-12" style="padding: 0px">
							<div class="col-lg-4 col-md-4" style="padding: 0px">
								<label> <input type="checkbox" id="bahasa_dipakai" name="bahasa_dipakai[]" value="Bahasa_lainnya" {!! $check[3] !!}> Lainnya</label>
							</div>
							<div class="col-lg-8 col-md-8">
								<input type="text" name="bahasa_dipakai_lain" class="form-control" style="border-radius: 10px !important;{!! $display !!}" value="{!! $isi !!}">
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Kemampuan Belajar</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<?php
							$check=['',''];
							if (isset($rekap2->mampu_belajar_edu)) {
								if($rekap2->mampu_belajar_edu=='Y'){
									$check=['checked',''];
								}else{
									$check=['','checked'];
								}
							}
						?>
						<label> <input type="radio" {!! $check[0] !!} name="mampu_belajar" value="Y" checked> Mampu</label>
						<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="N" name="mampu_belajar"> Tidak Mampu</label>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Kemampuan Baca Tulis</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<?php
							$check=['',''];
							if (isset($rekap2->mampu_baca_tulis_edu)) {
								if($rekap2->mampu_baca_tulis_edu=='Y'){
									$check=['checked',''];
								}else{
									$check=['','checked'];
								}
							}
						?>
						<label> <input type="radio" {!! $check[0] !!} name="mampu_baca_tulis" value="Y" checked> Baik</label>
						<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="N" name="mampu_baca_tulis"> Kurang</label>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Bahasa Isyarat</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<?php
							$check=['',''];
							if (isset($rekap2->bhs_isyarat_edu)) {
								if($rekap2->bhs_isyarat_edu=='Y'){
									$check=['','checked'];
								}else{
									$check=['checked',''];
								}
							}
						?>
						<label> <input type="radio" {!! $check[0] !!} name="bhs_isyarat" value="N" checked> Tidak</label>
						<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Y" name="bhs_isyarat"> Ya</label>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Perlu Penerjemah</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<input type="text" name="penterjemah_lain" class="form-control" value="{!! $rekap->penterjemah !!}" placeholder="Jika Ya, Bahasa apa? (Kosongi jika tidak)">
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Kesediaan Menerima Edukasi</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<?php
							$check=['checked',''];
							if($rekap->kesediaan=='' || $rekap->kesediaan=='Ya'){
								$check=['checked',''];
							}else{
								$check=['','checked'];
							}
						?>
						<label> <input type="radio" {!! $check[0] !!} name="kesediaan" value="Ya" checked> Ya</label>
						<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Tidak" name="kesediaan"> Tidak</label>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Pilihan Tipe Pembelajaran</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<?php
							$check=['',''];
							if (isset($rekap2->tipe_pembelajaran_edu)) {
								if($rekap2->tipe_pembelajaran_edu=='Verbal'){
									$check=['checked',''];
								}else{
									$check=['','checked'];
								}
							}
						?>
						<label> <input type="radio" {!! $check[0] !!} name="tipe_pembelajaran" value="Verbal" checked> Verbal</label>
						<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Tulisan" name="tipe_pembelajaran"> Tulisan</label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="col-lg-12 col-md-12" style="padding: 0px">
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Hambatan Emosional & Motivasi</label>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<input type="text" name="hambatan_emosional" class="form-control" value="{{ (isset($rekap2->hambatan_emosional_edu))?$rekap2->hambatan_emosional_edu:''}}" placeholder="Jika Ya, Sebutkan. (Kosongi jika tidak)">
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="form-group">
					<label class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Keterbatasan Fisik & Kognitif</label>
					<?php
						$check=['','','','','','','','',''];
						$display = 'display:none';
						$isi='';
						if(isset($rekap2->keterbatasan_fisik_edu)){
							$st = explode("+", $rekap2->keterbatasan_fisik_edu);
							if($st[0]=='N'){
								$check[0]='checked';
							} else {
								for ($i=0; $i < count($st)-1; $i++) { 
									if($st[$i]=='Tuna Rungu'){
										$check[1]='checked';
									}else if($st[$i]=='Tuna Wicara'){
										$check[2]='checked';
									}else if($st[$i]=='Tuna Netra'){
										$check[3]='checked';
									}else if($st[$i]=='Disabilitas'){
										$check[4]='checked';
									}else if($st[$i]=='Retardasi Mental'){
										$check[5]='checked';
									}else if($st[$i]=='Kesulitan Belajar'){
										$check[6]='checked';
									}else if($st[$i]=='Gangguan Bicara'){
										$check[7]='checked';
									}else{
										$display='';
										$isi = $st[$i];
										$check[8]='checked';
									}
								}
							}
						}
					?>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<label> <input type="checkbox" name="keterbatasan_fisik[]" value="N" {!! $check[0] !!}> Tidak</label>
						<label style="margin-left: 20px"> <input type="checkbox" name="keterbatasan_fisik[]" value="Tuna Rungu" {!! $check[1] !!}> Tuna Rungu</label><br>
						<label> <input type="checkbox" name="keterbatasan_fisik[]" value="Tuna Wicara" {!! $check[2] !!}> Tuna Wicara</label>
						<label style="margin-left: 20px"> <input type="checkbox" name="keterbatasan_fisik[]" value="Tuna Netra" {!! $check[3] !!}> Tuna Netra</label><br>
						<label> <input type="checkbox" name="keterbatasan_fisik[]" value="Disabilitas" {!! $check[4] !!}> Disabilitas</label>
						<label style="margin-left: 20px"> <input type="checkbox" name="keterbatasan_fisik[]" value="Retardasi Mental" {!! $check[5] !!}> Retardasi Mental</label><br>
						<label> <input type="checkbox" name="keterbatasan_fisik[]" value="Kesulitan Belajar" {!! $check[6] !!}> Kesulitan Belajar</label><br>
						<label> <input type="checkbox" name="keterbatasan_fisik[]" value="Gangguan Bicara" {!! $check[7] !!}> Gangguan Bicara</label>
						<br/>
						<div class="col-lg-12 col-md-12" style="padding: 0px">
							<div class="col-lg-4 col-md-4" style="padding: 0px">
								<label> <input type="checkbox" id="keterbatasan_fisik" name="keterbatasan_fisik[]" value="Lainnya" {!! $check[8] !!}> Lainnya</label>
							</div>
							<div class="col-lg-8 col-md-8">
								<input type="text" name="keterbatasan_lainnya" class="form-control" style="{!! $display !!}" value="{{$isi}}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="clearfix" style="margin-bottom: 10px"></div>
	<div class="col-lg-12 cl-md-12" style="text-align: center;">
		<a href="#" onclick="simpantahap4()" class="btn btn-success">Simpan</a>
	</div> -->
	<div class="clearfix" style="margin-bottom: 10px"></div>
	<!-- FORM BAWAH -->
	<div id="edukasi_table">
	<?php
	$edu = DB::table('edukasi_rm')->where('rekapMedik_id',Session::get('id_rekap'))->get();
	if(count($edu)!=0){
		?>
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<h3>Edukasi</h3>
		<table class="edu table table-bordered">
			<tr>
				<th style="width: 15%">Edukator (Bidang edukasi)</th>
				<th style="width: 10%">Sasaran</th>
				<th style="width: 10%">Metode</th>
				<th style="width: 10%">Sarana</th>
				<th style="width: 40%">Materi</th>
				<th style="width: 30%">Verifikasi Post-Edukasi</th>
				<th style="width: 30%">Aksi</th>
			</tr>
			<?php
			foreach ($edu as $key) {
				?>
				<tr>
					<td>{{$key->edukator}} ({{$key->disiplin}})</td>
					<td>
						<ul>
						<?php
							$metode = explode("+", $key->edukasi_ke);
							for($i=0;$i<count($metode)-1;$i++){
								echo "<li>".$metode[$i]."</li>";
							}
						?>
						</ul>
					</td>
					<td>
						<ul>
						<?php
							$metode = explode("+", $key->metode_edukasi);
							for($i=0;$i<count($metode)-1;$i++){
								echo "<li>".$metode[$i]."</li>";
							}
						?>
						</ul>
					</td>
					<td>
						<ul>
						<?php
							$sarana = explode("+", $key->sarana_edukasi);
							for($i=0;$i<count($sarana)-1;$i++){
								echo "<li>".$sarana[$i]."</li>";
							}
						?>
						</ul>
					</td>
					<td>{{$key->materi_edukasi}}</td>
					<td>
						<ul>
						<?php
							$metode = explode("+", $key->response_edukasi);
							for($i=0;$i<count($metode)-1;$i++){
								echo "<li>".$metode[$i]."</li>";
							}
						?>
						</ul>
					</td>
					<td><a href="#" onclick="hapusEdukasi({{$key->id_edukasi}})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a></td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
	?>
	</div>
	
	<div class="clearfix" style="margin-bottom: 10px"></div>
	<div class="col-lg-12 col-md-12" style="box-shadow: 0px 10px 10px #ddd;background: #fafafa">
		<div class="clearfix" style="margin-bottom: 10px"></div>
		<h3>Form Edukasi</h3>
		<table class="table table-bordered">
			<tr>
				<td>Nama Edukator</td>
				<td><input type="text" name="nama_edukator" class="form-control" placeholder="Ex: Dr. xxxxxxxxx SPPK" value="{{Auth::User()->nama}}"></td>
			</tr>
			<tr>
				<td>Bidang Disiplin</td>
				<td>
					<select id="bidang_edukator" name="bidang_edukator" class="form-control">
						<option value="">..:: Pilih Bidang Disiplin ::..</option>
						<option value="PENDAFTARAN">PENDAFTARAN</option>
						<option value="PERAWAT/BIDAN">PERAWAT/BIDAN</option>
						<option value="DOKTER">DOKTER</option>
						<option value="DOKTER ANESTESI">DOKTER ANESTESI</option>
						<option value="NUTRISIONIS">NUTRISIONIS</option>
						<option value="FISIOTERAPIS">FISIOTERAPIS</option>
						<option value="PERAWAT GIGI">PERAWAT GIGI</option>
						<option value="REHABILITAS MEDIS">REHABILITAS MEDIS</option>
						<option value="FARMASI">FARMASI</option>
					</select>
					<!-- <input type="text" name="bidang_edukator" class="form-control" placeholder="Medis, Keperawatan, Dokter Gizi, Farmasi, Rehabilitasi"> -->
				</td>
			</tr>
		</table>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Sasaran Edukasi</th>
					<th>Metode Edukasi</th>
					<th>Sarana Edukasi</th>
					<th>Verifikasi Post-Edukasi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?php
							$check=['','','','',''];
							$display = 'display:none';
							$isi='';
							if($rekap->yang_edu!=''){
								$st = explode("+", $rekap->yang_edu);
								for ($i=0; $i < count($st)-1; $i++) { 
									if($st[$i]=='1'){
										$check[0]='checked';
									}else if($st[$i]=='2'){
										$check[1]='checked';
									}else if($st[$i]=='3'){
										$check[2]='checked';
									}else if($st[$i]=='4'){
										$check[3]='checked';
									}else if($st[$i]=='5'){
										$check[4]='checked';
									}
								}
							}
						?>
						<label><input type="checkbox" class="yang_edu" {{$check[0]}} name="yang_edu[]" value="Pasien">Pasien</label>
						<br/><label><input type="checkbox" class="yang_edu" {{$check[1]}} name="yang_edu[]" value="Ayah/ Ibu">Ayah/ Ibu</label>
						<br/><label><input type="checkbox" class="yang_edu" {{$check[2]}} name="yang_edu[]" value="Suami/ Istri">Suami/ Istri</label>
						<br/><label><input type="checkbox" class="yang_edu" {{$check[3]}} name="yang_edu[]" value="Anak">Anak</label>
						<br/><label><input type="checkbox" class="yang_edu" {{$check[4]}} name="yang_edu[]" value="Lainnya">Lainnya</label>
					</td>
					<td>
						<?php
							$check=['','','','',''];
							$display = 'display:none';
							$isi='';
							if($rekap->metode_edu!=''){
								$st = explode("+", $rekap->metode_edu);
								for ($i=0; $i < count($st)-1; $i++) { 
									if($st[$i]=='1'){
										$check[0]='checked';
									}else if($st[$i]=='2'){
										$check[1]='checked';
									}else if($st[$i]=='3'){
										$check[2]='checked';
									}else if($st[$i]=='4'){
										$check[3]='checked';
									}else if($st[$i]=='5'){
										$check[4]='checked';
									}
								}
							}
						?>
						<label><input type="checkbox" class="metode_edu" {{$check[0]}} name="metode_edu[]" value="Individu">Individu</label>
						<br/><label><input type="checkbox" class="metode_edu" {{$check[1]}} name="metode_edu[]" value="Diskusi Kelompok">Diskusi Kelompok</label>
						<br/><label><input type="checkbox" class="metode_edu" {{$check[2]}} name="metode_edu[]" value="Ceramah">Ceramah</label>
						<br/><label><input type="checkbox" class="metode_edu" {{$check[3]}} name="metode_edu[]" value="Demonstrasi">Demonstrasi</label>
					</td>
					<td>
						<label><input type="checkbox" class="sarana_edu" {{$check[0]}} name="sarana[]" value="Leaflet">Leaflet</label>
						<br/><label><input type="checkbox" class="sarana_edu" {{$check[1]}} name="sarana[]" value="Audiovisual">Audiovisual</label>
						<br/><label><input type="checkbox" class="sarana_edu" {{$check[2]}} name="sarana[]" value="Lainnya">Lainnya</label>
					</td>
					<td>
						<?php
							$check=['','','','',''];
							$display = 'display:none';
							$isi='';
							if($rekap->respon_edu!=''){
								$st = explode("+", $rekap->respon_edu);
								for ($i=0; $i < count($st)-1; $i++) { 
									if($st[$i]=='1'){
										$check[0]='checked';
									}else if($st[$i]=='2'){
										$check[1]='checked';
									}else if($st[$i]=='3'){
										$check[2]='checked';
									}else if($st[$i]=='4'){
										$check[3]='checked';
									}else if($st[$i]=='5'){
										$check[4]='checked';
									}
								}
							}
						?>
						<label><input type="checkbox" class="response_edu" {{$check[0]}} name="respon_edu[]" value="Tidak Mengerti">Tidak Mengerti</label><br/>
						<label><input type="checkbox" class="response_edu" {{$check[1]}} name="respon_edu[]" value="Sudah Mengerti">Sudah Mengerti</label><br/>
						<label><input type="checkbox" class="response_edu" {{$check[2]}} name="respon_edu[]" value="Mampu Menjelaskan">Mampu Menjelaskan</label><br/>
						<label><input type="checkbox" class="response_edu" {{$check[3]}} name="respon_edu[]" value="Mampu Mendemonstrasikan">Mampu Mendemonstrasikan</label>
					</td>
				</tr>
				<tr>
					<td>Materi</td>
					<td colspan="3">
						<select id="materi_edu_cepat" name="materi_edu_cepat" class="form-control">
							<option value="" disabled>..:: Pilih Bidang Disiplin Terlebih Dahulu ::..</option>
						</select>
					</td>
				</tr>
				<tr>
					<td id="materi_edu" colspan="4" style="display:none;">
						<textarea name="materi_edu" style="width: 100%;height: 300px" placeholder="Materi Edukasi">{{$rekap->materi_edu}}</textarea>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="clearfix" style="margin-bottom: 10px"></div>
	</div>
	<div class="clearfix" style="margin-bottom: 10px"></div>
	<div class="col-lg-12 cl-md-12" style="text-align: center;">
		<a href="javascript:void(0);" onclick="simpanEdukasi()" class="btn btn-primary">Tambahkan Edukasi</a></a>
	</div>
	<div class="clearfix" style="margin-bottom: 10px"></div>
	<div class="col-lg-12 cl-md-12" style="text-align: center;">
		<a href="#" onclick="simpantahap4()" class="btn btn-success">Simpan</a>
	</div>
	</form>
</div>
<div class="clearfix"></div>
@section('js_tahap4')
<script type="text/javascript">
	
	// $(document).ready(function(){
		// var html = `<option value="" disabled selected>..:: Pilih Materi Langsung ::..</option>`;
		// var val = $('#bidang_edukator').val('PERAWAT/BIDAN');
		// html += `
		// 		<option value="Tanda-Tanda Vital">Tanda-Tanda Vital</option>
		// 		<option value="Pengkajian Awal">Pengkajian Awal</option>
		// 		<option value="Pengkajian Lanjutan">Pengkajian Lanjutan</option>
		// 		<option value="Penggunaan Alat yang Aman">Penggunaan Alat yang Aman</option>
		// 		<option value="" disabled readonly>..:: KHUSUS BIDAN ::..</option>
		// 		<option value="Persiapan Persalinan">Persiapan Persalinan</option>
		// 		<option value="KB">KB</option>
		// 		<option value="Lainnya">Lainnya</option>
		// `;
		// $('#materi_edu_cepat').html(html);
	// });

	$('#bidang_edukator').change(function(){
		var html = `<option value="" disabled selected>..:: Pilih Materi Langsung ::..</option>`;
		var val = $('#bidang_edukator').val();
		console.log(val);
		if(val == 'PENDAFTARAN'){
			html += `
				<option value="General Consent">General Consent</option>
				<option value="Jadwal Praktek Dokter">Jadwal Praktek Dokter</option>
				<option value="Biaya">Biaya</option>
				<option value="Poli dan Nama Dokter">Poli dan Nama Dokter</option>
				<option value="Alur">Alur</option>
				<option value="Lainnya">Lainnya</option>
			`;
		}else if(val == 'PERAWAT/BIDAN'){
			html += `
				<option value="Tanda-Tanda Vital">Tanda-Tanda Vital</option>
				<option value="Pengkajian Awal">Pengkajian Awal</option>
				<option value="Pengkajian Lanjutan">Pengkajian Lanjutan</option>
				<option value="Penggunaan Alat yang Aman">Penggunaan Alat yang Aman</option>
				<option value="" disabled readonly>..:: KHUSUS BIDAN ::..</option>
				<option value="Persiapan Persalinan">Persiapan Persalinan</option>
				<option value="KB">KB</option>
				<option value="Lainnya">Lainnya</option>
			`;
		}else if(val == 'DOKTER'){
			html += `
				<option value="Diagnosa Medis">Diagnosa Medis</option>
				<option value="Diit">Diit</option>
				<option value="Obat">Obat</option>
				<option value="Discharge Planning">Discharge Planning</option>
				<option value="Alternatif Pengobatan">Alternatif Pengobatan</option>
				<option value="Lainnya">Lainnya</option>
			`;
		}else if(val == 'DOKTER ANESTESI'){
			html += `
				<option value="Rencana Tindakan">Rencana Tindakan</option>
				<option value="Jenis Anastesi">Jenis Anastesi</option>
				<option value="Kelebihan dan Kelemahan Teknik Anastesi Yang Akan Diberikan">Kelebihan dan Kelemahan Teknik Anastesi Yang Akan Diberikan</option>
				<option value="Manajemen Nyeri">Manajemen Nyeri</option>
				<option value="Komplikasi/Efek Samping">Komplikasi/Efek Samping</option>
				<option value="Lainnya">Lainnya</option>
			`;
		}else if(val == 'NUTRISIONIS'){
			html += `
				<option value="Diet dan Nutrisi">Diet dan Nutrisi</option>
				<option value="Batasan Diet">Batasan Diet</option>
				<option value="Lainnya">Lainnya</option>
			`;
		}else if(val == 'FISIOTERAPIS'){
			html += `
				<option value="Lainnya" selected>Lainnya</option>
			`;
			$('#materi_edu').show();
		}else if(val == 'PERAWAT GIGI'){
			html += `
				<option value="Lainnya" selected>Lainnya</option>
			`;
			$('#materi_edu').show();
		}else if(val == 'REHABILITAS MEDIS'){
			html += `
				<option value="Lainnya" selected>Lainnya</option>
			`;
			$('#materi_edu').show();
		}else if(val == 'FARMASI'){
			html += `
				<option value="Lainnya" selected>Lainnya</option>
			`;
			$('#materi_edu').show();
		}
		$('#materi_edu_cepat').html(html);
	});

	$('#materi_edu_cepat').change(function(){
		var val = $('#materi_edu_cepat').val();
		if(val == 'Lainnya'){
			$('#materi_edu').show();
		}else{
			$('#materi_edu').hide();
		}
	});
	function simpanEdukasi(){
		var error = 0;
		var materi = '';
		if($('#materi_edu_cepat').val() == 'Lainnya'){
			materi = $('textarea[name=materi_edu]').val();
		}else{
			materi = $('#materi_edu_cepat').val();
		}
		if(materi==''){
			swal("Materi harus diisi");
			error++;
		}

		var response='';
		var response_edu = $('.response_edu:checked');
		for(var i=0;i<response_edu.length;i++){
			response += response_edu[i].value+'+';
		}
		if(response==''){
			swal('response harus dipilih');
			error++;
		}

		var metode='';
		var metode_edu = $('.metode_edu:checked');
		for(var i=0;i<metode_edu.length;i++){
			metode += metode_edu[i].value+'+';
		}
		if(metode==''){
			swal('Metode harus dipilih');
			error++;
		}

		var yang='';
		var yang_edu = $('.yang_edu:checked');
		for(var i=0;i<yang_edu.length;i++){
			yang += yang_edu[i].value+'+';
		}
		if(yang==''){
			swal('Yang diedukasi harus dipilih');
			error++;
		}

		var sarana='';
		var sarana_edu = $('.sarana_edu:checked');
		for(var i=0;i<sarana_edu.length;i++){
			sarana += sarana_edu[i].value+'+';
		}
		if(sarana==''){
			swal('Sarana Edukasi harus dipilih');
			error++;
		}

		var edukator = $('input[name=nama_edukator]').val();
		var disiplin = $('#bidang_edukator').val();

		if(disiplin==''){
			swal('Bidang disiplin edukator harus diisi');
			error++;
		}

		if(edukator==''){
			swal("Nama edukator harus diisi");
			error++;
		}

		if(error==0){
			$.post("{{route('simpanEdu')}}",{materi:materi,metode:metode,response:response,yang:yang,disiplin:disiplin,edukator:edukator, sarana:sarana},function(data){
				if(data.status=='success'){
					swal("Success !",'Data berhasil ditambahkan','success');
					$("#edukasi_table").load(location.href + " #edukasi_table>*", "");
				}else{
					swal("Whoops !",'Data tidak berhasil ditambahkan','error');
				}
			});
		}
	}

	function simpantahap4(){
		var i = 0;
		if($('input[name=edukasi_lain]').is(':visible')){
			var isi = $('input[name=edukasi_lain]').val();
			if(isi==''){
				swal('Bidang disiplin lainnya harus diisi');
				i++;
			}
		}

		if($('input[name=hambatan_lain]').is(':visible')){
			var isi = $('input[name=hambatan_lain]').val();
			if(isi==''){
				swal('Hambatan lainnya harus diisi');
				i++;
			}
		}


		if($('input[name=bahasa_dipakai_lain]').is(':visible')){
			var isi = $('input[name=bahasa_dipakai_lain]').val();
			if(isi==''){
				swal('Bahasa harus diisi');
				i++;
			}
		}

		// if($('input[name=penterjemah_lain]').is(':visible')){
		// 	var isi = $('input[name=penterjemah_lain]').val();
		// 	if(isi==''){
		// 		swal('Penterjemah harus diisi');
		// 		i++;
		// 	}
		// }

		var kesulitan = $('input[name=kesulitan_komunikasi]:checked').val();
		if(kesulitan=='Ada'){
			var isiKesulitan = $('input[name=kesulitan_komunikasi_lain]').val();
			if(isiKesulitan==''){
				swal('Kesulitan bahasa harus diisi');
				i++;
			}
		}

		var data = $('form#tahap4').serialize();
		if(i==0){
			$.post("{!! route('simpanTahap4') !!}",data,function(data){
				if(data.status=='success'){
					swal('Success');
					location.reload();
				}else{
					swal("Whoops !",'Data tidak berhasil ditambahkan','error');
				}
			});
		}
	}

	$('input[name=kesulitan_komunikasi]').change(function(){
		var kes = $('input[name=kesulitan_komunikasi]:checked').val();
			// alert(kes);
		if(kes=='Ada'){
			$('input[name=kesulitan_komunikasi_lain]').show();
			$('input[name=kesulitan_komunikasi_lain]').attr('required','required');
		}else{
			$('input[name=kesulitan_komunikasi_lain]').hide();
			$('input[name=kesulitan_komunikasi_lain]').removeAttr('required');
		}
	});

	$('#bahasa_dipakai').change(function(){
		if($('input[name=bahasa_dipakai_lain]').is(':visible')){
			$('input[name=bahasa_dipakai_lain]').hide();
			$('input[name=bahasa_dipakai_lain]').removeAttr('required');
		}else{
			$('input[name=bahasa_dipakai_lain]').show();
			$('input[name=bahasa_dipakai_lain]').attr('required','required');
		}
	});

	$('#keterbatasan_fisik').change(function(){
		if($('input[name=keterbatasan_lainnya]').is(':visible')){
			$('input[name=keterbatasan_lainnya]').hide();
			$('input[name=keterbatasan_lainnya]').removeAttr('required');
		}else{
			$('input[name=keterbatasan_lainnya]').show();
			$('input[name=keterbatasan_lainnya]').attr('required','required');
		}
	});

	$('#penterjemah').change(function(){
		if($('input[name=penterjemah_lain]').is(':visible')){
			$('input[name=penterjemah_lain]').hide();
			$('input[name=penterjemah_lain]').removeAttr('required');
		}else{
			$('input[name=penterjemah_lain]').show();
			$('input[name=penterjemah_lain]').attr('required','required');
		}
	});

	$('#hambatan').change(function(){
		if($('input[name=hambatan_lain]').is(':visible')){
			$('input[name=hambatan_lain]').hide();
			$('input[name=hambatan_lain]').removeAttr('required');
		}else{
			$('input[name=hambatan_lain]').show();
			$('input[name=hambatan_lain]').attr('required','required');
		}
	});

	$('#edukasi').change(function(){
		if($('#edukasi').is(':checked')){
			$('input[name=edukasi_lain]').attr('required','required');
			$('input[name=edukasi_lain]').show();
		}else{
			$('input[name=edukasi_lain]').removeAttr('required');
			$('input[name=edukasi_lain]').hide();
		}
	});

	function hapusEdukasi(id){
		swal({
        title: "Anda yakin?",
        text: "Data akan dihapus!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        //closeOnCancel: false
        },
        function(){
            $.post("{!! route('hapusEdukasi') !!}",{id:id}).done(function(data){
                if(data.status=='success'){
					$("#edukasi_table").load(location.href + " #edukasi_table>*", "");
					swal('Data berhasil dihapus');
                }else{
                    swal("Gagal!", "Data gagal dihapus!", "error");
                }
            });
        });
	}
</script>
@stop