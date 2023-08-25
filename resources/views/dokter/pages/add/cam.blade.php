
	<?php
	switch ($id) {
		case '1':
			$judul = 'Diagnosa';
			break;
		case '2':
			$judul = 'ICD 10';
			break;
		case '3':
			$judul = 'Obat-obatana';
			break;
		case '4':
			$judul = 'ICD 9';
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
	<h1>Pengambilan foto {!! $judul !!}</h1>
	<div id="hasil"></div>

	<div id="my_camera1"></div>



	<!-- A button for taking snaps -->
	<form>
		<input type=button value="Take Snapshot" onClick="take_snapshot()">
	</form>

	<!-- First, include the Webcam.js JavaScript Library -->
	<script type="text/javascript" src="{!! asset('adminAsset/webcam/webcam.js') !!}"></script>
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 600,
			height: 460,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera1' );
	</script>
	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page

				// document.getElementById('results1').innerHTML =
				// 	'<h2>Processing:</h2>';

				Webcam.upload( data_uri, "{!! url('rekap_medik/simpanP3/'.$id) !!}", function(code, text) {
					var url = "{!! url('/') !!}";
					document.getElementById('hasil').innerHTML =
					'<h2>Here is your image:</h2>' +
					'<img src="'+url+'/'+text+'"><br/>'+
					'<button onclick="window.close()">Tutup</button><br/>';
				} );
			} );
		}
	</script>
