<!DOCTYPE html>
<html manifest="cache.manifest">
<head>
<title>DICOM Web Viewer</title>
<meta charset="UTF-8">
<meta name="description" content="DICOM Web Viewer (DWV) static version">
<meta name="keywords" content="DICOM,HTML5,JavaScript,medical,imaging,DWV">
<link type="text/css" rel="stylesheet" href="../../css/style.css">
<style type="text/css" >
body { background-color: #222; color: white; font-size: 80%; }
#pageHeader h1 { display: inline-block; margin: 0; color: #fff; }
#pageHeader a { color: #ddf; }
#pageHeader .toolbar { display: inline-block; float: right; }
.toolList ul { padding: 0; }
.toolList li { list-style-type: none; }
#pageMain { position: absolute; height: 92%; width: 99%; bottom: 5px; left: 5px; background-color: #333; }
.infotl { text-shadow: 0 1px 0 #000; }
.infotc { text-shadow: 0 1px 0 #000; }
.infotr { text-shadow: 0 1px 0 #000; }
.infocl { text-shadow: 0 1px 0 #000; }
.infocr { text-shadow: 0 1px 0 #000; }
.infobl { text-shadow: 0 1px 0 #000; }
.infobc { text-shadow: 0 1px 0 #000; }
.infobr { text-shadow: 0 1px 0 #000; }
.dropBox { margin: 20px; }
.ui-icon { zoom: 125%; }
.tagsTable tr:nth-child(even) { background-color: #333; }
.drawList tr:nth-child(even) { background-color: #333; }
button, input, li, table { margin-top: 0.2em; }
li button, li input { margin: 0; }
.history_list { width: 100%; }
</style>
<link type="text/css" rel="stylesheet" href="../../ext/jquery-ui/themes/ui-darkness/jquery-ui-1.12.1.min.css">
<style type="text/css" >
.ui-widget-content { background-color: #222; background-image: url();}
</style>
<!-- Third party (dwv) -->
<script type="text/javascript" src="../../ext/modernizr/modernizr.js"></script>
<script type="text/javascript" src="../../ext/i18next/i18next.min.js"></script>
<script type="text/javascript" src="../../ext/i18next/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="../../ext/i18next/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="../../ext/konva/konva.min.js"></script>
<script type="text/javascript" src="../../ext/magic-wand/magic-wand.js"></script>
<script type="text/javascript" src="../../ext/jszip/jszip.min.js"></script>
<!-- Third party (viewer) -->
<script type="text/javascript" src="../../ext/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../../ext/jquery-ui/jquery-ui-1.12.1.min.js"></script>
<script type="text/javascript" src="../../ext/flot/jquery.flot.min.js"></script>
<!-- decoders -->
<script type="text/javascript" src="../../decoders/pdfjs/jpx.js"></script>
<script type="text/javascript" src="../../decoders/pdfjs/util.js"></script>
<script type="text/javascript" src="../../decoders/pdfjs/arithmetic_decoder.js"></script>
<script type="text/javascript" src="../../decoders/pdfjs/jpg.js"></script>
<script type="text/javascript" src="../../decoders/rii-mango/lossless-min.js"></script>
<!-- Local -->
<script type="text/javascript" src="../../dwv-0.22.1.min.js"></script>
<!-- Launch the app -->
<script type="text/javascript" src="appgui.js"></script>
<script type="text/javascript" src="applauncher.js"></script>

<?php
$files = glob('./file_bro/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
$id = $_GET['id'];
$url = $id;

// $gmb = explode("\\", $url);
// $n = count($gmb);

$img = '../../file_bro/img.dcm';
// // $gmb = explode("\\", $url);
// system('xcopy "'.$url.'" "D:\htdocsD\dicom\file_bro" /e /i');
// rename('D:\\htdocsD\\dicom\\file_bro\\'.$gmb[$n-1],'D:\\htdocsD\\dicom\\file_bro\\img.dcm');
// // $n = count($gmb);
// $al = 'file:///D:/semuaV/'.$gmb[$n-1];
if(file_put_contents($img, file_get_contents($id))){
  file_put_contents($img, file_get_contents($id));
}else {
  echo '<script language="javascript">';
  echo 'alert("File Dicom Tidak ditemukan!")';
  echo '</script>';
}

?>
<script type="text/javascript">

		setTimeout(function awal() {
			$('.imagefilesdiv').attr('style','display:none');
			$('.imageurldiv').attr('style','display:block');
			$('.loaderSelect').attr('style','display:none');
			$('.imageurl').attr('value','http://192.168.1.8/rs_wahidin_dev/public/dwv/file_bro/img.dcm').trigger('change');
			// $('.imageurl').focus();
			// $('.imageurl').attr('value','<?php echo $id?>').trigger('change');
			// $('.imageurl').attr('id','url-sub');
			$('.imageurl').submit();
			// ayoKirim();
		}, 1000);

	// function datas(foto){
	// 	$('.imageurl').val('<?php echo $id?>');
	// };	
	// window.onload = function(){  
	// 	$('.imageurl').val('<?php echo $id?>');
	// };	
</script>
</head>

<body>

<!-- DWV -->
<div id="dwv">

<div id="pageHeader">
<!-- Title -->
<h1>DWV  <span class="dwv-version"></span></h1>

<!-- Toolbar -->
<div class="toolbar"></div>

</div><!-- /pageHeader -->

<div id="pageMain">

<!-- Open file -->
<div class="openData" title="File">
<div class="loaderlist"></div>
<div id="progressbar"></div>
</div>

<!-- Toolbox -->
<div class="toolList" title="Toolbox"></div>

<!-- History -->
<div class="history" title="History"></div>

<!-- Tags -->
<div class="tags" title="Tags"></div>

<!-- DrawList -->
<div class="drawList" title="Draw list"></div>

<!-- Help -->
<div class="help" title="Help"></div>

<!-- Layer Container -->
<div class="layerDialog" title="Image">
<div class="dropBox"></div>
<div class="layerContainer">
<canvas class="imageLayer">Only for HTML5 compatible browsers...</canvas>
<div class="drawDiv"></div>
<div class="infoLayer">
<div class="infotl"></div>
<div class="infotc"></div>
<div class="infotr"></div>
<div class="infocl"></div>
<div class="infocr"></div>
<div class="infobl"></div>
<div class="infobc"></div>
<div class="infobr" style="bottom: 64px;"></div>
<div class="plot"></div>
</div><!-- /infoLayer -->
</div><!-- /layerContainer -->
</div><!-- /layerDialog -->

</div><!-- /pageMain -->

</div><!-- /dwv -->

</body>

<!-- Mirrored from ivmartel.github.io/dwv/demo/stable/viewers/static/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 11:06:07 GMT -->
</html>
