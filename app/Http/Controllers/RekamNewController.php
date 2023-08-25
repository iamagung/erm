<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
// use App\Model\Profil;
// use App\Model\Galeri;
use App\Model\User;



// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, DB;

class RekamNewController extends Controller
{
    function main(Request $request){
        $awal = date('Y-m-d');
        $akhir = date('Y-m-d');

        if(isset($request->awal)){
          $awal = $request->awal;
        }
        if(isset($request->akhir)){
          $akhir = $request->akhir;
        }
        $akhir1 = date('Y-m-d',strtotime('+1 days',strtotime($akhir)));
        $limit = 10;

        // GET DATA USER
        if(Auth::getUser()->level=='3'){
          $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
          $kode_poli = $dokter->kodePoli;
          $namaPoli = DB::connection('rsu')->table('tm_poli')->where('KodePoli',$kode_poli)->first();
          $nama = $namaPoli->NamaPoli;
          $master = 'perawat.master.main';
        }else if(Auth::getUser()->level=='2'){
          $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();;
          $kode_poli = $dokter->poli_id;
          $namaPoli = DB::connection('rsu')->table('tm_poli')->where('KodePoli',$kode_poli)->first();
          $nama = $namaPoli->NamaPoli;
          $master = 'dokter.master.main';
        }else if(Auth::getUser()->level=='1'){
          $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
          $kode_poli = 'all';
          $nama = 'Semua Poli';
          $master = 'admin.master.main';
        }
        // END GET DATA USER

        // ISSET POLI
        if(isset($request->poli)){
          $id_kode_poli = $request->poli;
          if($id_kode_poli!='all'){
            $rekap = DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->where('KodePoli',$id_kode_poli)->limit($limit)->get();
            $total = DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->where('KodePoli',$id_kode_poli)->get();
          }else{
            $rekap = DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->limit($limit)->get();
            $total = DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->get();
          }
        }else{
          $id_kode_poli='';
          if($kode_poli!='all'){
            $rekap = DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')
              ->where([
                ['tanggalKunjungan', '>=',$awal],
                ['tanggalKunjungan', '<=', $akhir1],
                ['KodePoli',$kode_poli],
                ['aksi_dokter', 1],
              ])->limit($limit)->get();
            $total = DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')
              ->where([
                ['tanggalKunjungan', '>=',$awal],
                ['tanggalKunjungan', '<=', $akhir1],
                ['KodePoli',$kode_poli],
                ['aksi_dokter', 1],
              ])->get();
          }else{
            $rekap = DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->limit($limit)->get();
            $total = DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->get();
          }
        }
        // END ISSET POLI

        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'4',
            'awal'=>$awal,
            'akhir'=>$akhir,
            'active_sub'=>'',
            'kodePoli'=>$kode_poli,
            'id_kode_poli'=>$id_kode_poli,
            'namaPoli'=>$nama,
            'dokter'=>$dokter,
            'rekap'=>$rekap,
            'total'=>$total,
            'master'=>$master,
        ];
        return view('rekam_medis.main',$data);
    }

    function page(Request $request){
      // return $request->all();
      $awal = $request->awal;
      $akhir = $request->akhir;

      $akhir1 = date('Y-m-d',strtotime('+1 days',strtotime($akhir)));

      $limit = 10;
      $offset = ($request->i-1)*$limit;

      // ISSET POLI
      $id_kode_poli = $request->poli;
      if($id_kode_poli!='all'){
        if($request->cariText=='' && $request->by!='tanggalKunjungan'){
          $data1 = [
            'data' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->where('KodePoli',$id_kode_poli)->limit($limit)->offset($offset)->get(),
            'total' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->where('KodePoli',$id_kode_poli)->get(),
          ];
        }else{
          if($request->by!='tanggalKunjungan'){
            $data1 = [
              'data' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where($request->by,'like','%'.$request->cariText.'%')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->where('KodePoli',$id_kode_poli)->limit($limit)->offset($offset)->get(),
              'total' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where($request->by,'like','%'.$request->cariText.'%')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->where('KodePoli',$id_kode_poli)->get(),
            ];
          }else{
            $data1 = [
              'data' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where($request->by,'like','%'.$request->cariStatus.'%')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->where('KodePoli',$id_kode_poli)->limit($limit)->offset($offset)->get(),
              'total' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where($request->by,'like','%'.$request->cariStatus.'%')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->where('KodePoli',$id_kode_poli)->get(),
            ];
          }
        }
      }else{
        if($request->cariText=='' && $request->by!='tanggalKunjungan'){
          $data1 = [
            'data' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->limit($limit)->offset($offset)->get(),
            'total' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->get(),
          ];
        }else{
          if($request->by!='tanggalKunjungan'){
            $data1 = [
              'data' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where($request->by,'like','%'.$request->cariText.'%')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->limit($limit)->offset($offset)->get(),
              'total' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where($request->by,'like','%'.$request->cariText.'%')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->get(),
            ];
          }else{
            $data1 = [
              'data' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where($request->by,'like','%'.$request->cariStatus.'%')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->limit($limit)->offset($offset)->get(),
              'total' => DB::table('rekap_medik as r')->select('id_rekapMedik','no_RM','Nama_Pasien','tanggalKunjungan','NamaPoli')->where($request->by,'like','%'.$request->cariStatus.'%')->where('tanggalKunjungan', '>=',$awal)->where('tanggalKunjungan', '<=', $akhir1)->get(),
            ];
          }
        }
      }
      // END ISSET POLI

      $data = [
          'status'=>'success',
          'data'=>$data1,
          'i'=>$request->i,
      ];
      return $data;
    }

    public function cetak(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',$request->id_rekam)->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();

        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>'',
        ];
        return view('cetak.cetakTahap3',$data);
    }
}
