<?php
$files = glob('./file_bro/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
$url = 'file:///V:/151076056/asoi.dcm';
$img = './file_bro/img.dcm';
file_put_contents($img, file_get_contents($url));
?>