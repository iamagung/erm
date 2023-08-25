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
			<td style="font-size: 20px;font-weight: bold;text-align: center;border: 1px solid #000">RINGKASAN MEDIS RAWAT JALAN</td>
		</tr>
		<tr>
			<td style="border: 1px solid #000">
				<table width="100%">
					<tr>
						<th style="border: 1px solid #000">Tgl & jam berkunjung</th>
						<th style="border: 1px solid #000">Nama dan Tth Dokter</th>
					</tr>
					<tr>
						<td style="border: 1px solid #000">
							{!! date('d-m-Y (H:i:s)',strtotime($syarat->tanggalKunjungan)) !!}
						</td>
						<td style="border: 1px solid #000">
							<?php
							echo $syarat->NamaDokter;
							?>
						</td>
					</tr>
					<tr>
						<th style="border: 1px solid #000">Diagnosis</th>
						<th style="border: 1px solid #000">ICD 10</th>
					</tr>
					<tr>
						<td style="border: 1px solid #000">
							<?php
							echo $syarat->diagnosa.'<br/>';
							if($syarat->fotodiagnosa!=''){
							?>
								<img src="{!! asset($syarat->fotodiagnosa) !!}" style="width: 8cm">
							<?php
							}
							?>
						</td>
						<td style="border: 1px solid #000">
							<?php
							echo $syarat->icd10.'<br/>';
							if($syarat->fotoicd10!=''){
							?>
								<img src="{!! asset($syarat->fotoicd10) !!}" style="width: 8cm">
							<?php
							}
							?>
						</td>
					</tr>
					<tr>
						<th style="border: 1px solid #000">Obat-obatan/ Tindakan pemeriksaan</th>
						<th style="border: 1px solid #000">ICD 9 CM</th>
					</tr>
					<tr>
						<td style="border: 1px solid #000">
							<?php
							echo $syarat->obatobatan.'<br/>';
							if($syarat->fotoobat!=''){
							?>
								<img src="{!! asset($syarat->fotoobat) !!}" style="width: 8cm">
							<?php
							}
							?>
						</td>
						<td style="border: 1px solid #000">
							<?php
							echo $syarat->icd9.'<br/>';
							if($syarat->fotoicd9!=''){
							?>
								<img src="{!! asset($syarat->fotoicd9) !!}" style="width: 8cm">
							<?php
							}
							?>
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