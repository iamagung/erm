<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
use App\Model\AntrianFarmasi;
use App\Model\User;
use App\Helpers\Helpers as Help; // Helpers

use Redirect, Auth, Hash, DB, Session;
date_default_timezone_set('Asia/Jakarta');

class unsetController extends Controller
{
  function main(Request $request){
    $rute = '';
    // $url_apm='http://117.102.75.166:8191/api/siramaerm/taskBpjs';
    $url_apm='http://192.168.2.111/develop/apm-rsu/public/api/siramaerm/taskBpjs';
    if(Auth::User()->level=='2'){
      $get1 = DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->first();
      $get2 = DB::connection('apm')->table('antrian')->where('No_Register', $get1->no_Register)->first();
      $getResep = DB::table('tr_resep_d')->where('No_Register', $get1->no_Register)->first(); # Get resep (non racikan)
      $getRacikan = DB::table('tr_resep_racikan_m')->where('No_Register', $get1->no_Register)->first(); # Get racikan (Racikan)
      if($get2) {
        if ($getRacikan || $getResep) { # Jika antrian ada resep (racikan/nonracikan)
          $update = DB::connection('apm')->table('antrian')->where('No_Register', $get1->no_Register)->update(['status' => 'antrifarmasi']);
        } else {
          $update = DB::connection('apm')->table('antrian')->where('No_Register', $get1->no_Register)->update(['status' => 'akhirpoli']);
        }
        /* send task_id if status updated */ 
        if ($update) {
          $dt = ['no_antrian'=>$get2->nomor_antrian_poli, 'task_id'=>'5', 'jenisresep'=>$getRacikan ? $getResep ? 'Racikan' : 'Non racikan' : 'Tidak ada'];
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => $url_apm,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($dt),
            CURLOPT_HTTPHEADER => array(
              "accept: */*",
              "accept-language: en-US,en;q=0.8",
              "content-type: application/json",
            ),
          ));
          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);
          # Add antrean farmasi to bpjs 
          if ($getRacikan || $getResep) { # Jika pasien memiliki resep (Racikan/Non racikan)
            $hitAntreanFarmasi = $this->addAntreanFarmasi($get1,$get2,$getRacikan,$getResep);
          }
        }
      }

      DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update(['aksi_dokter'=>'1']);
      DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update(['jenis_kasus'=>null]);
      $rute = 'rekam_new_all';
    }else if(Auth::User()->level=='3'){
      if(Auth::User()->is_terapis == 'Y')
        $col = 'nama_terapis';
      else
        $col = 'nama_perawat';

      DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update(['aksi_perawat'=>'1', 'aksi_terapis'=>'1', $col => Auth::user()->nama, 'aksi_dokter' => '0']);
      DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update(['jenis_kasus'=>null]);
      $rute = 'dataRegistrasiPerawat';
    }else{
    }
    $return = redirect()->route($rute)->with('title','Terima Kasih !')->with('message','Data telah disimpan')->with('type','success');
    Session::forget('no_RM');
    Session::forget('id_rekap');
    return $return;
  }

  public function addAntreanFarmasi($get1,$get2,$getRacikan,$getResep) {
    $url_apm_farmasi='http://192.168.2.111/develop/apm-rsu/public/api/siramaerm/antreanAddFarmasi';
    $tgl = date("Y-m-d", strtotime($get2->tgl_periksa));
    if (!$antrian = AntrianFarmasi::where('kode_booking', $get2->kode_booking)->whereDate('created_at', '=', $tgl)->first()) {
      $antrianFarmasi = new AntrianFarmasi;
      $antrianFarmasi->antrian_id = $get2->id;
      $antrianFarmasi->no_rm = $get2->no_rm;
      $antrianFarmasi->kode_booking = $get2->kode_booking;
      $antrianFarmasi->no_antrian_farmasi = Help::generateNoAntrianFarmasi();
      $antrianFarmasi->jenis_resep = $getRacikan?'Racikan':'Non racikan'; # Jika ada data $getRacikan maka jenisresep = Racikan
      $antrianFarmasi->keterangan = $getRacikan?$getRacikan->Keterangan:$getResep->Keterangan;
      $antrianFarmasi->save();
    }
    # init data antrean add farmasi
    $dtFarmasi = [
      'kodebooking'=>(!$antrian)?$antrianFarmasi->kode_booking:$antrian->kode_booking, 
      'jenisresep'=>$getRacikan?'Racikan':'Non racikan', # Jika ada data $getRacikan maka jenisresep = Racikan
      'nomorantrean'=>(!$antrian)?$antrianFarmasi->no_antrian_farmasi:$antrian->no_antrian_farmasi,
      'keterangan'=>$getRacikan?$getRacikan->Keterangan:$getResep->Keterangan,
    ];
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url_apm_farmasi,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30000,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($dtFarmasi),
      CURLOPT_HTTPHEADER => array(
        "accept: */*",
        "accept-language: en-US,en;q=0.8",
        "content-type: application/json",
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
  }
}
