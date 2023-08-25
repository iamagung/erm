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
			<td style="font-size: 20px;font-weight: bold;text-align: center;border: 1px solid #000">PENEMPELAN SALINAN RESEP</td>
		</tr>
		<tr>
			<td style="border: 1px solid #000">
				<table width="100%" border="1">
					<tr>
						<th>Nama Obat</th>
						<th>Quantiti</th>
						<th>Keterangan</th>
					</tr>
					<?php
					if($syarat->nama_obat==''){
						?>
						<tr>
							<td colspan="3">Belum ada</td>
						</tr>
						<?php
					}else{
						$st = explode("+", $syarat->nama_obat);
						$qtt = explode("+", $syarat->qtt);
						$ket = explode("+", $syarat->keterangan);
						for ($i=0; $i < count($st)-1; $i++) { 
							?>
							<tr>
								<td>{!! $st[$i] !!}</td>
								<td>{!! $qtt[$i] !!}</td>
								<td>{!! $ket[$i] !!}</td>
							</tr>
							<?php
						}
					}
					?>
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