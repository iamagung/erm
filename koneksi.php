<?php
  
$dbcon = pg_connect("host='localhost' user='postgres' password='root' dbname='postgres'");
        
    
    // Cek Koneksi Ke Server Database

    if ($dbcon) // Jika Ada Koneksi
    {
        echo "Koneksi Database Sukses";
    }
    else
    {
        echo "Koneksi Database Gagal";
    }
	$query = "SELECT * FROM dicomimages limit 10";
	// $result = pg_prepare($dbcon, "my_query", $query);
	// $result = pg_execute($dbcon, "my_query",array());
	$result = pg_query($dbcon, $query) or die("Query gagal  " );
	echo "<table>";
	while($arr = pg_fetch_array ($result, NULL, PGSQL_ASSOC)){
		echo '<tr>';
		echo '<td>'.$arr['imagenumbe'].'</td>';
		echo '<td>'.$arr['imagedate'].'</td>';
		echo '</tr>';
	}
	echo "</table>";
?>