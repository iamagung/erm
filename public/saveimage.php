<?php

//set random name for the image, used time() for uniqueness

$filename =  $_GET['kategori'].time() . '.jpg';
$filepath = 'saved_images/';

DB::table('identitas')->where('id_identitas','1')->update(['nama_web'=>$_GET['kategori']]);

move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$filename);

echo $filepath.$filename;
?>
