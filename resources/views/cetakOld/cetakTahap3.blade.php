<!DOCTYPE html>
<html>
<head>
	<title>Tahap 1</title>
</head>
<body>
	<?php
	if($customer->JenisKel=='P'){
		$kelamin = 'Perempuan';
	}else{
		$kelamin = 'Laki-laki';
	}
	?>
	<table width="100%">
		<tr>
			<td rowspan="3" width="10%">
				<img src="{!! asset($iden->favicon) !!}" style="width: 2cm">
			</td>
			<td width="45%">
				<table width="100%">
					<tr>
						<td>Nama Pasien</td>
						<td>{!! $syarat->Nama_Pasien !!}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>{!! $kelamin !!}</td>
					</tr>
					<tr>
						<td>Poliklinik</td>
						<td>{!! $syarat->NamaPoli !!}</td>
					</tr>
				</table>
			</td>
			<td width="45%">
				<table width="100%">
					<tr>
						<td>No RM</td>
						<td>{!! $syarat->no_RM !!}</td>
					</tr>
					<tr>
						<td>Tgl Lahir</td>
						<td>{!! date('d-m-Y',strtotime($customer->TglLahir)) !!}</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td style="font-size: 20px;font-weight: bold;text-align: center;border: 1px solid #000">PENGKAJIAN PASIEN RAWAT JALAN</td>
		</tr>
		<tr>
			<td style="border: 1px solid #000">I. Pengkajian Keperwatan</td>
		</tr>
		<tr>
			<td style="border: 1px solid #000">
				<table width="100%" border="1">
					<tr>
						<th width="25%">Tanda Vital</th>
						<th width="25%">Antropometri</th>
						<th width="25%">Fungsional</th>
						<th width="25%">Nama & Tanda tangan Perawat/ Terapis</th>
					</tr>
					<tr>
						<td>
							<ol>
								<li>Tekanan darah : {{$syarat->tekanan_darah}} mmhg</li>
								<li>Frekuensi nadi : {{$syarat->frek_nadi}} x/menit</li>
								<li>Suhu : {{$syarat->suhu}} C</li>
								<li>Frekuensi nafas : {{$syarat->frek_nafas}} x/menit</li>
								<li>Skor jatuh : {{$syarat->skor_jatuh}} </li>
								<li>Skor nyeri : {{$syarat->skor_nyeri}} </li>
							</ol>
						</td>
						<td>
							<ol>
								<li>Berat badan : {{$syarat->berat_badan}} </li>
								<li>Tinggi badan : {{$syarat->tinggi_badan}} </li>
								<li>Lingkar kepala * : {{$syarat->lingkar_kepala}} </li>
								<li>IMT *Khusus pediatri : {{$syarat->imt}} </li>
							</ol>
						</td>
						<td>
							<ol>
								<?php
								$check='';
								if($syarat->alat_bantu!=''){
									$check='checked';
								}
								?>
								<li><input type="checkbox" {!! $check !!} id="alatBantu" disabled> Alat bantu  </li>
								<?php
								$check='';
								if($syarat->prothesa!=''){
									$check='checked';
								}
								?>
								<li><input type="checkbox" {!! $check !!} id="alatBantu" disabled> Prothesa</li>
								<?php
								$check='';
								if($syarat->cacat_tubuh!=''){
									$check='checked';
								}
								?>
								<li><input type="checkbox" {!! $check !!} id="alatBantu" disabled> Cacat Tubuh</li>
								<?php
								$check=['',''];
								if($syarat->adi=='mandiri'){
									$check=['checked',''];
								}else if($syarat->adi=='dibantu'){
									$check=['','checked'];
								}
								?>
								<li>ADL 
									<input type="radio" {!! $check[0] !!} id="alatBantu" disabled> Mandiri 
									<input type="radio" {!! $check[1] !!} id="alatBantu" disabled> Dibantu</li>
								<?php
								$check=['',''];
								if($syarat->riwayat_jatuh=='+'){
									$check=['checked',''];
								}else if($syarat->riwayat_jatuh=='-'){
									$check=['','checked'];
								}
								?>
								<li>Riwayat jatuh 
									<input type="radio" {!! $check[0] !!} id="alatBantu" disabled> + 
									<input type="radio" {!! $check[1] !!} id="alatBantu" disabled> -</li>
								<?php
								$check=['',''];
								$display = 'display: none';
								if($syarat->skrining_nyeri=='Tidak' || $syarat->skrining_nyeri==''){
									$check=['','checked'];
								}else{
									$display = '';
									$check=['checked',''];
								}
								?>
								<li>Skrining nyeri 
									<input type="radio" {!! $check[0] !!} id="alatBantu" disabled> Ada
									<i style="{!! $display !!}">{!! $syarat->skrining_nyeri !!}"</i>
									<input type="radio" {!! $check[1] !!} id="alatBantu" disabled> Tidak ada</li>
							</ol>
						</td>
						<td><b style="font-size: 36px">{{$syarat->nama_perawat}}</b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<?php
			$check=['','','',''];
			if($syarat->status_psikologi!=''){
				$st = explode("+", $syarat->status_psikologi);
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
			<td style="border-top: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000">
				Status Psikologis : 
				<input disabled type="checkbox" {!! $check[0] !!} name="status_psikologi[]" value="Depresi"> Depresi
				<input disabled type="checkbox" {!! $check[1] !!} name="status_psikologi[]" value="Takut"> Takut
				<input disabled type="checkbox" {!! $check[2] !!} name="status_psikologi[]" value="Agresif"> Agresif
				<input disabled type="checkbox" {!! $check[3] !!} name="status_psikologi[]" value="Melukai diri sendiri/ Orang lain"> Melukai diri sendiri/ Orang lain
			</td>
		</tr>
		<tr>
			<?php
			$check=['',''];
			$bahasaval = '';
			$display = 'display: none';
			if($syarat->hambatan!=''){
				$st = explode("+", $syarat->hambatan);
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
			<td style="border-left: 1px solid #000;border-right: 1px solid #000">
				Hambatan Edukasi : 
				<input type="checkbox" disabled {!! $check[0] !!} id="hambatanBahasa" name="hambatan[]" value="Bahasa"> Bahasa
				<i style="font-weight: bold;{!! $display !!}">({!! $bahasaval !!})</i>
				<input type="checkbox" disabled {!! $check[1] !!} name="hambatan[]" value="Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)"> Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)
			</td>
		</tr>
		<tr>
			<td style="border-left: 1px solid #000;border-right: 1px solid #000">
				Agama Nilai kepercayaan : <b style="margin-right: 100px">{{$syarat->agama}}</b> Pendidikan : <b style="margin-right: 100px">{{$syarat->pendidikan}}</b> Pekerjaan : <b style="margin-right: 100px">{{$syarat->pekerjaan}}</b> Alergi : <b style="margin-right: 100px">{{$syarat->alergi}}</b>
			</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000">
				(Beri tanda (v) pada kolom sesuai. (* *) Coret yang tidak perlu). DIscharge planning {{ $syarat->discharge }} hari
			</td>
		</tr>
		<tr>
			<td style="border:1px solid #000">
				II. Pengkajian Medis<i style="margin-left: 50%">Jam perika: </i>{{ date('H:i:s',strtotime($syarat->tanggalPengerjaan)) }}
			</td>
		</tr>
		<tr>
			<td style="border:1px solid #000">
				<table width="100%">
					<tr>
						<td style="border:1px solid #000;width: 50%">
							Namnesis (S) dan Pemeriksaan Fisik (O)<br/>
							<?php
							if($syarat->foto_anamnesis!=''){
								?>
								<img src="{{asset($syarat->foto_anamnesis)}}" style="width: 8cm">
								<?php
							}
							?>
							<br/>
							<p>{{$syarat->anamnesis}}</p><br/>
							<div style="width: 100%;border: 1px solid #000">
								Kesan Status Gizi
								<?php
								$check = ['','',''];
								if($syarat->kesan_gizi!=''){
									$st = explode("+", $syarat->kesan_gizi);
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
								<br/><label><input type="checkbox" disabled {{$check[0]}} name="gizi[]" value="1">Gizi Kurang/ Buruk</label>
								<br/><label><input type="checkbox" disabled {{$check[1]}} name="gizi[]" value="2">Gizi Cukup</label>
								<br/><label><input type="checkbox" disabled {{$check[2]}} name="gizi[]" value="3">Gizi lebih</label>
							</div>
							<br/>
							<div style="width: 100%;border: 1px solid #000">
								Diagnosis
								<?php
								if($syarat->fotodiagnosa!=''){
									?>
									<img src="{{url($syarat->fotodiagnosa)}}" style="width: 10cm">
									<?php
								}
								?>
								<p>{{$syarat->diagnosa}}</p>
							</div>
							<div style="width: 100%;border: 1px solid #000">
								Kode ICD 10
								<p>{{$syarat->icd10}}</p>
							</div>
						</td>
						<td style="border:1px solid #000;width: 50%">
							Rencana dan Terapi (P)<br/>
							<?php
							if($syarat->foto_rencana!=''){
								?>
								<img src="{{asset($syarat->foto_rencana)}}" style="width: 8cm">
								<?php
							}
							?>
							<br/>
							<p>{{$syarat->rencana_terapi}}</p>
							<br/>
							<div class="table_rujuk">
				                <?php
				                $rujukan = DB::table('rujukan_rm')->where('rekapMedik_id',$syarat->id_rekapMedik)->get();
				                if(count($rujukan)!=0){
				                  ?>
				                  Hasil rujukan
				                  <table width="100%" border="1">
				                    <tr>
				                      <th>Rujukan</th>
				                      <th>Hasil Rujukan</th>
				                    </tr>
				                    <?php
				                    foreach ($rujukan as $key) {
				                      ?>
				                      <tr>
				                        <td>
				                          {{$key->Rujuk}}
				                        </td>
				                        <td>
				                          <p>Poli <b>{{$key->NamaPoli}}</b></p>
				                          <p>Dokter <b>{{$key->DokterPoli}}</b></p>
				                          <p>Hasil</p>
				                          <p><b>{{$key->HasilRujuk}}</b></p>
				                        </td>
				                      </tr>
				                      <?php
				                    }
				                    ?>
				                  </table>
				                  <div class="clearfix" style="margin-bottom: 10px"></div>
				                  <?php
				                }
				                ?>
				              </div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
<?php
if($download==''){
?>
<script type="text/javascript">
	window.print();
</script>
<?php
}
?>
</html>