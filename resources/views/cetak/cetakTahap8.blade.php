<!DOCTYPE html>
<html>
<head>
	<title>Tahap 1</title>
	<style type="text/css">
		thead td {
			/*font-weight: bold;*/
			text-align: center;
		}
		tbody tr td {
			text-align: left;
			vertical-align: top;
		}
		ol {
			margin: 0;
			padding-left: 20px; 
		}
	</style>
</head>
<body>
	<?php
	if($customer->JenisKel=='P'){
		$kelamin = 'Perempuan';
	}else{
		$kelamin = 'Laki-laki';
	}
	?>
	<!-- <table width="100%">
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
	</table> -->
	<table id="kop" width="100%" border="1">
		<tr>
			<!-- <td rowspan="2" width="8%">
				<img src="{!! asset($iden->favicon) !!}" style="width: 2cm">
			</td> -->
			<td colspan="2" width="72%" style="font-size: 20px;font-weight: bold;text-align: center;">
				CATATAN PERKEMBANGAN PASIEN TERINTEGRASI
			</td>
			<td width="20%" rowspan="2" style="vertical-align: bottom; text-align: right;">
				<span>Label</span>
			</td>
		</tr>
		<!-- <tr>
			<td>
				Poliklinik: {{$syarat->NamaPoli}}
			</td>
		</tr> -->
	</table>
	<table id="body" width="100%" border="1">
		<thead>
			<tr>
				<td width="5%" style="font-weight: bold;">
					TGL<br>&<br>JAM
				</td>
				<td width="20%" style="font-weight: bold;">
					Profesional Pemberi Asuhan
				</td>
				<td width="35%">
					<b>HASIL ASESMEN PASIEN DAN PEMBERI PELAYANAN</b><br>
					<small><i>(Tulis dengan format SOAP/ADME, disertai sasaran. Tulis Nama, beri Paraf pada akhir catatan)</i></small>
				</td>
				<td width="25%">
					<b>INSTRUKSI PPA TERMASUK PASCA BEDAH</b><br>
					<small><i>(Instruksi Ditulis dengan Rinci dan Jelas)</i></small>
				</td>
				<td width="15%">
					<b>REVIEW & VERIFIKASI DPJP</b><br>
					<small><i>(Tulis Nama, beri Paraf, Tgl., Jam)<br>(DPJP harus membaca / mereview seluruh Rencana Asuhan)</i></small>
				</td>
			</tr>
		</thead>
		<tbody>
	        <?php
	        	$ttd = '';
	        	if (Auth::user()->level == '2') {
	        		$get = DB::table('login_dokter')->where('user_id', Auth::user()->id)->first();
		        	$ttd = asset('ttd/'.$get->ttd);
	        	}
		        $rekap = DB::table('rekap_medik')->where('no_RM',Session::get('no_RM'))->orderBy('tanggalKunjungan','ASC')->limit(10)->get();
		        $total = DB::table('rekap_medik')->where('no_RM',Session::get('no_RM'))->get(); 
	        ?>
			<?php foreach ($rekap as $key) {
				$k = DB::table('rekam_medis_lanjutan')->where('rekam_medis_id',$key->id_rekapMedik)->first();
				?>
				<tr>
					<td>
						{{$key->tanggalKunjungan}}
					</td>
					<td>
						<table>
							<tr>
								<td colspan="3"><b>{{(!empty($key->NamaPoli))?$key->NamaPoli:'-'}}</b></td>
							</tr>
							<tr>
								<td>
									<b>Perawat</b>
								</td>
								<td>:</td>
								<td>{{(!empty($key->nama_perawat))?$key->nama_perawat:'-'}}</td>
							</tr>
							<tr>
								<td>
									<b>Dokter</b>
								</td>
								<td>:</td>
								<td>{{(!empty($key->NamaDokter))?$key->NamaDokter:'-'}}</td>
							</tr>
						</table>
					</td>
					<!-- <td>{{$key->NamaPoli}}</td> -->
					<td>
						<table>
							<tr>
								<td>
									<b>S</b>
								</td>
								<td>:</td>
								<td>
									<ol>
										<li>{{(!empty($k->anamnesis_perawat))?$k->anamnesis_perawat:'-'}}</li>
										<li>{{(!empty($key->anamnesis))?$key->anamnesis:'-'}}</li>
									</ol>
								</td>
							</tr>
							<tr>
								<td>
									<b>O</b>
								</td>
								<td>:</td>
								<td>
									<ol>
										<li>{{(!empty($k->pemeriksaanFisik_perawat))?$k->pemeriksaanFisik_perawat:'-'}}</li>
										<li>{{(!empty($key->pemeriksaanFisik))?$key->pemeriksaanFisik:'-'}}</li>
									</ol>
								</td>
							</tr>
							<tr>
								<td>
									<b>A</b>
								</td>
								<td>:</td>
								<td>
									<ol>
										<li>{{(!empty($k->diagnosis_perawat))?$k->diagnosis_perawat:'-'}}</li>
										<li>{{(!empty($key->diagnosis_tambahan))?$key->diagnosis_tambahan:'-'}}</li>
									</ol>
								</td>
							</tr>
							<tr>
								<td>
									<b>P</b>
								</td>
								<td>:</td>
								<td>
									<ol>
										<li>{{(!empty($k->rencana_terapi_perawat))?$k->rencana_terapi_perawat:'-'}}</li>
										<li>{{(!empty($key->rencana_terapi))?$key->rencana_terapi:'-'}}</li>
									</ol>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<ol>
							<li>{{(!empty($k->instruksi_ppa_perawat))?$k->instruksi_ppa_perawat:'-'}}</li>
							<li>{{(!empty($k->instruksi_ppa))?$k->instruksi_ppa:'-'}}</li>
						</ol>
					</td>
					<td>
						@if(!empty($key->NamaDokter))
						<img src="{{$ttd}}" width="150">
						@endif
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
<?php
if($download==''){
?>
<script type="text/javascript">
	// window.print();
</script>
<?php
}
?>
</html>