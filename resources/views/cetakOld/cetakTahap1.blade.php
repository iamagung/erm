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
			<td style="font-size: 20px;font-weight: bold;text-align: center;border: 1px solid #000">SURAT PERSETUJUAN UMUM (GENERAL CONSENT)</td>
		</tr>
		<tr>
			<td style="border: 1px solid #000">
				<?php
		        $persetujuan=['',''];
		        if($syarat->persetujuan!=''){
		            $isian = explode("=", $syarat->persetujuan);
		            $persetujuan = [$isian[0],$isian[1]];
		            $replace = '<textarea disabled class="form-control" name="syarat[]" placeholder="text-Form" style="width: 80%;border:none !important;height: 100px">'.$persetujuan[0].'</textarea>';
		            $replace1 = '<textarea disabled class="form-control" name="syarat[]" placeholder="text-Form" style="width: 80%;border:none !important;height: 100px">'.$persetujuan[1].'</textarea>';
		            // $replace = $isian[0];
		            // $replace1 = $isian[1];
		            echo str_replace(["isian1","isian2"], [$replace,$replace1], $iden->info); 
		        }else{
		            $replace = '<textarea disabled class="form-control" name="syarat[]" placeholder="text-Form" style="width: 80%;border:none !important;height: 100px">'.$persetujuan[0].'</textarea>';
		            $replace1 = '<textarea disabled class="form-control" name="syarat[]" placeholder="text-Form" style="width: 80%;border:none !important;height: 100px">'.$persetujuan[1].'</textarea>';
		            echo str_replace(["isian1","isian2"], [$replace,$replace1], $iden->info); 
		        }
		    ?>
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