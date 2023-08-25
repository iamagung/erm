<?php
switch ($id) {
	case '1':
		$judul = 'Diagnosa';
		break;
	case '2':
		$judul = 'ICD - 10';
		break;
	case '3':
		$judul = 'Obat - obatan';
		break;
	case '4':
		$judul = 'ICD - 9';
		break;
	case '5':
		$judul = 'Anamnesis';
		break;
	case '6':
		$judul = 'Rencana dan Terapi';
		break;
case '7':
		$judul = 'Pemeriksaan FIsik';
		break;

	default:
		$judul = '';
		break;
}
?>
<h2>{!! $judul !!}</h2>
<form method="post" action="{!! url('rekap_medik/simpanP5/'.$id) !!}" enctype="multipart/form-data">
	<input type="file" id="foto1" accept="image/*" name="foto" required>
	<input type="submit" value="Simpan">
	<br>
	<img src="" style="width: 200px" id="hfoto">

</form>
<script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>

<script type="text/javascript">
	function readURL(input,id) {

		if (input.files && input.files[0]) {
		    var reader = new FileReader();

		    reader.onload = function(e) {
		      	$('#hfoto').attr('src', e.target.result);
		    }

		    reader.readAsDataURL(input.files[0]);
		}
	}

	$("#foto1").change(function() {
	  	readURL(this);
	});
</script>
