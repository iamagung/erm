<?php
	session_start();

	if (isset($_SESSION['userid']) && $_SESSION['level'] == 1) {
		include "../koneksi.php";
		$userid = $_SESSION['userid'];
		$level = $_SESSION['level'];
		$cek = tampilin("count", "*", "user", " where id_user='$userid' and level='$level'");
    	if ($cek==1) {
    		require "admin.php";
    	}else{
    		echo "<script>document.location.href='../masuk.html'</script>";
    	}
	} else {
	    echo "<script>document.location.href='../masuk.html'</script>";
	}
?>