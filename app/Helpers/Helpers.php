<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Model\AntrianFarmasi;
class Helpers{
	public static function dateIndo($param,$request='tanggal'){
		$bulan = [
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		];
		$split = explode('-', $param);
		if($request=='hari'){ # Dengan nama hari
			$hari = Helpers::getDay(date('D',strtotime($param)));
			return $hari . ' ' . $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		}else{ # Tanpa nama hari
			return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		}
	}
	public static function getDay($param){
		if($param=='Sun'){
			$hari = 'Minggu';
		}elseif($param=='Mon'){
			$hari = 'Senin';
		}elseif($param=='Tue'){
			$hari = 'Selasa';
		}elseif($param=='Wed'){
			$hari = 'Rabu';
		}elseif($param=='Thu'){
			$hari = 'Kamis';
		}elseif($param=='Fri'){
			$hari = 'Jumat';
		}else{
			$hari = 'Sabtu';
		}
		return $hari;
	}
	# Custom response start
	public static function resInternal($msg,$code=500,$data=[]){ # Template rest internal
		return response()->json([
			'metadata' => [
				'message' => $msg,
				'code'    => $code,
			],
			'response' => $data,
		]);
	}
	public static function resApi($msg='Terjadi kesalahan sistem',$code=500,$data=[]){ # Template rest api
		return response()->json([
			'metadata' => [
				'message' => $msg,
				'code'    => $code,
			],
			'response' => $data,
		],$code);
	}
	# Custom response end
	public static function generateNoAntrianFarmasi() { # Generate no antrian farmasi
		$today = date('Y-m-d');
		$tanggal = date("Y-m-d", strtotime($today));
		$check = AntrianFarmasi::whereDate('created_at', '=', $tanggal)->orderBy('id_antrian_farmasi', 'DESC')->first();
		if (!empty($check)) {
			$no_antrian = (int)$check->no_antrian_farmasi + 1;
		} else {
			$no_antrian = 1;
		}
        return $no_antrian;
	}
	# Logging start
	public static function logging($param=[]){
		# Modify parameter for logging start
		for($i=0; $i<5; $i++){
			$arr[$i] = isset($param[$i]) ? $param[$i] : (
				$i==0 ? 'NO MESSAGES' : (
					$i==1 ? false : '-'
				)
			);
		}
		# Modify parameter for logging end

		$title   = $arr[0];
		$status  = $arr[1]; # Status => true{jika program berhasil}, false{jika program gagal}
		$errMsg  = $arr[2];
		$errLine = $arr[3];
		$data    = $arr[4];

		$res = [
			$title => [
				'messageErr' => $errMsg,
				'line'       => $errLine,
				'data'       => $data,
			]
		];
		if($status){ # If $status => true, unset key
			unset($res[$title]['messageErr'],$res[$title]['line']);
		}
		Log::info(json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
		return true;
	}
	# Logging end
}