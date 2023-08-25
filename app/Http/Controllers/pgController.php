<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
// use App\Model\Profil;
// use App\Model\Galeri;
use App\Model\User;
use Illuminate\Support\Facades\DB;



// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, Session, PDF;

class pgController extends Controller
{
    //
    public function index(Request $request){
    	// $data = DB::connection('pgsql')->table('dicomimage')->get();
    	// return $data;
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
    }	
}
