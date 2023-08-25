<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
use App\Model\User;

use Redirect, Auth, Hash, DB;

class registController extends Controller
{
    public function main(Request $request){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        // $rekapMedik = DB::table('rekap_medik')->select('rwid_id')->where('tanggalKunjungan','like',date('Y-m-d').'%')->get();

        // $total = DB::table('rekap_medik')
        //     ->where([
        //         ['tanggalKunjungan','like',date('Y-md')],
        //         ['KodePoli',$dokter->poli_id],
        //         ['nama_perawat','!=',null],
        //         ['aksi_dokter','0']
        //     ])->get();
        if($request->ajax()){
            $regist1 = DB::table('rekap_medik')
                ->where("tanggalKunjungan","like","%".date("Y-m-d")."%")
                ->where([
                    ['KodePoli', $dokter->poli_id],
                    ['nama_perawat', '!=', null],
                    ['aksi_dokter', '0']
                ])->orderBy('noUrut','ASC')
                ->get();

            return ['data' => $regist1];
        }

        $regist = [];
        // foreach ($regist1 as $k => $v) {
        //     $getAntrian = DB::connection('apm')
        //         ->table('antrian')
        //         ->where([
        //             ['no_rm', $v->no_RM],
        //             ['tgl_periksa','like',date('Y-m-d').'%']
        //         ])->first();
        //     $v->noAntre = ($getAntrian)?(($getAntrian->nomor_antrian_poli)?$getAntrian->nomor_antrian_poli:'-'):'-';
        //     $v->id_antre = ($getAntrian)?$getAntrian->id:'-';
        //     $regist[$k] = $v;
        // }

        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'3',
            'active_sub'=>'',
            // 'regist'=>$regist,
            // 'regist'=>$regist1,
            // 'total'=>$regist1,
            'dokter'=>$dokter,
        ];
        return view('dokter.pages.regist.main',$data);
    }

    public function pageRegist(Request $request){
        // return $request->all();
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();

        // $rekapMedik1 = DB::table('rekap_medik')->select('rwid_id')->where('tanggalKunjungan','like',date('Y-m-d').'%')->get();

        // $i=0;
        // $rekapMedik=[];
        // foreach ($rekapMedik1 as $key) {
        //     $rekapMedik[$i] = $key->rwid_id;
        //     $i++;
        // }

        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='aktif'){
            $total = DB::table('rekap_medik')->where('nama_perawat','!=',null)->where('KodePoli',$dokter->poli_id)->where('aksi_dokter','0')->where('tanggalKunjungan','like',date('Y-m-d').'%')->get();
            $regist1 = DB::table('rekap_medik')->where('nama_perawat','!=',null)->where('KodePoli',$dokter->poli_id)->where('aksi_dokter','0')->where('tanggalKunjungan','like',date('Y-m-d').'%')->orderBy('NoUrut','ASC')->limit($limit)->offset($offset)->get();
            foreach ($regist1 as $k => $v) {
                $getAntrian = DB::connection('apm')
                    ->table('antrian')
                    ->where([
                        ['no_rm', $v->no_RM],
                        ['tgl_periksa', 'like', date('Y-m-d').'%']
                    ])->first();
                $v->noAntre = ($getAntrian)?(($getAntrian->nomor_antrian_poli)?$getAntrian->nomor_antrian_poli:'-'):'-';
                $v->id_antre = ($getAntrian)?$getAntrian->id:'-';
                $regist[$k] = $v;
            }
            $data=[
                'total' =>$total,
                'data' =>$regist,
            ];
        }else{
            if($request->by=='aktif'){
                $total = DB::table('rekap_medik')->where('nama_perawat','!=',null)->where('aksi_dokter','0')->where($request->by,$request->cariStatus)->where('KodePoli',$dokter->poli_id)->where('tanggalKunjungan','like',date('Y-m-d').'%')->get();
                $regist1 = DB::table('rekap_medik')->where('nama_perawat','!=',null)->where('aksi_dokter','0')->where('KodePoli',$dokter->poli_id)->where('tanggalKunjungan','like',date('Y-m-d').'%')->orderBy('NoUrut','ASC')->where($request->by,$request->cariStatus)->limit($limit)->offset($offset)->get();
                foreach ($regist1 as $k => $v) {
                    $getAntrian = DB::connection('apm')
                        ->table('antrian')
                        ->where([
                            ['no_rm', $v->no_RM],
                            ['tgl_periksa', 'like', date('Y-m-d').'%']
                        ])->first();
                    $v->noAntre = ($getAntrian)?(($getAntrian->nomor_antrian_poli)?$getAntrian->nomor_antrian_poli:'-'):'-';
                    $v->id_antre = ($getAntrian)?$getAntrian->id:'-';
                    $regist[$k] = $v;
                }
                $data=[
                    'total'=>$total,
                    'data'=>$regist,
                ];
            }else{
                $total = DB::table('rekap_medik')->where('nama_perawat','!=',null)->where('aksi_dokter','0')->where($request->by,'like','%'.$request->cariText.'%')->where('KodePoli',$dokter->poli_id)->where('tanggalKunjungan','like',date('Y-m-d').'%')->get();
                $regist1 = DB::table('rekap_medik')->where('nama_perawat','!=',null)->where('aksi_dokter','0')->where('KodePoli',$dokter->poli_id)->where('tanggalKunjungan','like',date('Y-m-d').'%')->orderBy('NoUrut','ASC')->where($request->by,'like','%'.$request->cariText.'%')->limit($limit)->offset($offset)->get();
                foreach ($regist1 as $k => $v) {
                    $getAntrian = DB::connection('apm')
                        ->table('antrian')
                        ->where([
                            ['no_rm', $v->no_RM],
                            ['tgl_periksa', 'like', date('Y-m-d').'%']
                        ])->first();
                    $v->noAntre = ($getAntrian)?(($getAntrian->nomor_antrian_poli)?$getAntrian->nomor_antrian_poli:'-'):'-';
                    $v->id_antre = ($getAntrian)?$getAntrian->id:'-';
                    $regist[$k] = $v;
                }
                $data=[
                    'total'=>$total,
                    'data'=>$regist,
                ];
            }
        }
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    /*
    if(!empty($request->foto)){
        $ukuranFile1 = filesize($request->icon);
        if(!file_exists("adminasset/assets/images/datamaster/barang")){
            unlink("adminasset/assets/images/datamaster/barang");
        }

        if ($ukuranFile1 <= 500000) {
            $ext_foto1 = $request->foto->getClientOriginalExtension();
            $filename1 = "img_barang_".date('Ymd-His').".".$ext_foto1;
            $temp_foto1 = 'adminasset/assets/images/datamaster/barang';
            $proses1 = $request->foto->move($temp_foto1, $filename1);
            $barang->photo = $filename1;
        }else{
            $file1=$_FILES['foto']['name'];
            if(!empty($file1)){
                $direktori1="adminasset/assets/images/datamaster/barang"; //tempat upload foto
                $name1='foto'; //name pada input type file
                $namaBaru1="img_barang_".date('Ymd-His'); //name pada input type file
                $quality1=50; //konversi kualitas gambar dalam satuan %
                $upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
            }
            $ext_foto1 = $request->foto->getClientOriginalExtension();
            $barang->photo = $namaBaru1.".".$ext_foto1;
        }
    }
    */
}
