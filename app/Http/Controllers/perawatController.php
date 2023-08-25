<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
// use App\Model\Profil;
// use App\Model\Galeri;
use App\Model\User;
use App\Traits\TarifDanTindakan;
// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, DB, Session;

date_default_timezone_set('Asia/Jakarta');

class perawatController extends Controller
{
    use TarifDanTindakan;
    //

    public function __construct() {
        $this->url_apm='http://117.102.75.166:8191/api/siramaerm/taskBpjs';
    }

    public function main(Request $request){
        $perawat = DB::table('users')->where('id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'1',
            'active_sub'=>'',
            'tgl'=>'',
            'dokter'=>$perawat,
        ];
    	return view('perawat.dashboard.main',$data);
    }

    public function mainchart(Request $request){
        $perawat = DB::table('users')->where('id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'1',
            'active_sub'=>'',
            'tgl'=>$request->tgl,
            'dokter'=>$perawat,
        ];
        return view('perawat.dashboard.main',$data);
    }



    /*===============================================================
    ======================== TAMBAH REKAP MEDIS =====================
    ===============================================================*/
    public function setPasien(Request $request){
        $getAntrian = DB::connection('apm')->table('antrian')
            ->where('id', $request->id_antrean)
            ->first();

        $data = DB::connection('rsu')->table('tr_tracer')->where('No_Register',$request->id)->first();
        $customer = DB::connection('rsu')->table('tm_customer')
            ->where('KodeCust',$data->No_RM)->first();

        if(Session::has('id_rekap')){
            return Redirect::to($_SERVER['HTTP_REFERER'])
                ->with('title','Whooops !')
                ->with('message','Anda sedang menangani pasien')
                ->with('type','warning');
        }else{
            if(!empty($customer)){
                /* STORE PROGRESS ANTRIAN KE BPJS */
                if ($getAntrian) {
                    if ($getAntrian->no_rm == $data->No_RM) {
                        $dt = [
                            'no_antrian' => $getAntrian->nomor_antrian_poli,
                            'task_id' => '4',
                        ];

                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $this->url_apm,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "url_apm",
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

                        DB::connection('apm')->table('antrian')->where('id', $request->id_antrean)->update(['status' => 'layanpoli']);
                    }
                }

                // //initial NoTindakan
                // $dataGenerate = [
                //     "poli_id" => $data->Kode_Poli,
                // ];
                // $dataGenerate2 = [
                //     "no_Register" => $data->No_Register,
                //     "no_RM" => $data->No_RM
                // ];
                // //generate NoTindakan dan Simpan Dibawah
                // $noUnik = $this->GenerateNoTindakanNew((object) $dataGenerate, (object) $dataGenerate2);
                // $noTindakan = $data->Kode_Poli . substr(date('Y'),2) . str_pad($noUnik, 6 ,"0",STR_PAD_LEFT);

                $user = DB::table('users')->where('id',Auth::User()->id)->first();
                $tgl = date('Y-m-d',strtotime($data->Tgl_Register));
                $tgl .= ' '.$data->Jam_Register;

                $bf = DB::table('rekap_medik')->where('no_RM',$data->No_RM)->orderBy('id_rekapMedik','DESC')->first();

                if(!empty($bf)){
                    $bf_edu = DB::table('edukasi_rm')->where('rekapMedik_id', $bf->id_rekapMedik)->orderBy('id_edukasi','ASC')->get();
                    $alergi=$bf->alergi;
                    $discharge=$bf->discharge;
                    $pendidikan=$bf->pendidikan;
                    $agama=$bf->agama;
                    $pekerjaan=$bf->pekerjaan;
                    $persetujuan=$bf->persetujuan;
                    $tekanan_darah=$bf->tekanan_darah;
                    $frek_nadi=$bf->frek_nadi;
                    $suhu=$bf->suhu;
                    $frek_nafas=$bf->frek_nafas;
                    $skor_nyeri=$bf->skor_nyeri;
                    $skor_jatuh=$bf->skor_jatuh;
                    $berat=$bf->berat_badan;
                    $tinggi=$bf->tinggi_badan;
                    $lingkar=$bf->lingkar_kepala;
                    $alatbantu=$bf->alat_bantu;
                    $prothesa=$bf->prothesa;
                    $cacat_tubuh=$bf->cacat_tubuh;
                    $adi=$bf->adi;
                    $riwayat_jatuh=$bf->riwayat_jatuh;
                    $skrining_nyeri=$bf->skrining_nyeri;
                    $status_psikologi=$bf->status_psikologi;
                    $hambatan=$bf->hambatan;
                    $imt=$bf->imt;
                    $anutan = $bf->anutan;
                    $komunikasi=$bf->komunikasi;
                    $bahasa_edu=$bf->bahasa_edu;
                    $penterjemah=$bf->penterjemah;
                    $hambatan_edu=$bf->hambatan_edu;
                }else{
                    $alergi='-';
                    $discharge='0';
                    $pendidikan='-';
                    $agama=$customer->Agama;
                    $pekerjaan=$customer->Agama;
                    $persetujuan='-=-';
                    $tekanan_darah='0/0';
                    $frek_nadi='0';
                    $suhu='0';
                    $frek_nafas='0';
                    $skor_nyeri='0';
                    $skor_jatuh='0';
                    $berat='0';
                    $tinggi='0';
                    $lingkar='0';
                    $alatbantu='';
                    $prothesa='';
                    $cacat_tubuh='';
                    $adi='';
                    $riwayat_jatuh='';
                    $skrining_nyeri='';
                    $status_psikologi='';
                    $hambatan='';
                    $imt='0';
                    $anutan=$customer->Agama;
                    $komunikasi='';
                    $bahasa_edu='';
                    $penterjemah='';
                    $hambatan_edu='';
                }

                $insert = [
                    'persetujuan'=>$persetujuan,
                    'tanggalKunjungan'=>$tgl,
                    'tanggalPengerjaan'=>date('Y-m-d H:i:s'),
                    'no_RM'=>$data->No_RM,
                    'no_Register'=>$data->No_Register,
                    'rwid_id'=>$data->rwid,
                    'noUrut'=>$data->NoUrut,
                    'KodePoli'=>$user->kodePoli,
                    'NamaPoli'=>$user->namaPoli,
                    'Nama_Pasien'=>$data->Nama_Pasien,
                    'nama_perawat'=>Auth::getUser()->nama,
                    'tekanan_darah'=>$tekanan_darah,
                    'frek_nadi'=>$frek_nadi,
                    'suhu'=>$suhu,
                    'frek_nafas'=>$frek_nafas,
                    'skor_nyeri'=>$skor_nyeri,
                    'skor_jatuh'=>$skor_jatuh,
                    'berat_badan'=>$berat,
                    'tinggi_badan'=>$tinggi,
                    'lingkar_kepala'=>$lingkar,
                    'imt'=>$imt,
                    'alat_bantu'=>$alatbantu,
                    'prothesa'=>$prothesa,
                    'cacat_tubuh'=>$cacat_tubuh,
                    'adi'=>$adi,
                    'riwayat_jatuh'=>$riwayat_jatuh,
                    'skrining_nyeri'=>$skrining_nyeri,
                    'status_psikologi'=>$status_psikologi,
                    'hambatan'=>$hambatan,
                    'agama'=>$agama,
                    'pekerjaan'=>$pekerjaan,
                    'alergi'=>$alergi,
                    'discharge'=>$discharge,
                    'pendidikan'=>$pendidikan,
                    'nama_panggilan'=>$data->Nama_Pasien,
                    'agama_edu'=>$agama,
                    'anutan'=>$anutan,
                    'pendidikan_edu'=>$pendidikan,
                    'komunikasi'=>$komunikasi,
                    'bahasa_edu'=>$bahasa_edu,
                    'penterjemah'=>$penterjemah,
                    'hambatan_edu'=>$hambatan_edu,
                    'aksi_perawat'=>'0',
                    'aksi_dokter'=>'0',
                ];
                $exist = DB::table('rekap_medik')->where('no_Register',$data->No_Register)->where('tanggalKunjungan',$tgl)->where('no_RM',$data->No_RM)->get();
                if(count($exist)==0){
                    DB::table('rekap_medik')->insert($insert);
                    $rekap = DB::table('rekap_medik')->orderBy('id_rekapMedik','DESC')->first();

                    //cekdata untuk insert no tindakan, jika masih kosong maka insert jika sudah ada maka do nothing
                    // if(empty($rekap->noTindakan)){
                    //     try {
                    //         DB::table('rekap_medik')->where('no_RM',$data->No_RM)->where('no_Register', $data->No_Register)->update(['noTindakan' => $noTindakan]);
                    //     } catch (\Exception $th) {
                    //         return $th->getMessage();
                    //     }
                    // }

                    // DUPLIKAT DATA EDUKASI
                    if (isset($bf_edu)) {
                        if (!empty($bf_edu)) {
                            foreach ($bf_edu as $v) {
                                $insert_edu = [
                                    'rekapMedik_id'=>$rekap->id_rekapMedik,
                                    'edukasi_ke'=>$v->edukasi_ke,
                                    'metode_edukasi'=>$v->metode_edukasi,
                                    'sarana_edukasi'=>$v->sarana_edukasi,
                                    'response_edukasi'=>$v->response_edukasi,
                                    'materi_edukasi'=>$v->materi_edukasi,
                                    'edukator'=>$v->edukator,
                                    'disiplin'=>$v->disiplin,
                                ];

                                DB::table('edukasi_rm')->insert($insert_edu);
                            }
                        }
                    }

                    Session::put('no_RM',$data->No_RM);
                    Session::put('id_rekap',$rekap->id_rekapMedik);
                    return Redirect::route('content2');
                }else{
                    $rekap = DB::table('rekap_medik')->where('no_Register',$data->No_Register)->where('tanggalKunjungan',$tgl)->where('no_RM',$data->No_RM)->first();
                    Session::put('no_RM',$data->No_RM);
                    Session::put('id_rekap',$rekap->id_rekapMedik);
                    return Redirect::route('content2');
                }
            }else{
                return Redirect::route('dataRegistrasiPerawat')->with('title','Whooops !')->with('message','Pasien tidak terdaftar di sistem')->with('type','error');
            }
        }
    }

    public function cekPasien(Request $request){
        // return $request->id;
        $regist = DB::connection('rsu')->table('tr_tracer')->where('No_RM',$request->id)->where('Tgl_Register','like',date('Y-m-d').'%')->first();
        // $regist = DB::connection('rsu')->table('tr_tracer')->where('No_RM',$request->id)->where('Tgl_Register','like',date('Y-m-d'))->first();
        if(count($regist)==0){
            return ['status'=>'error'];
        }else{
            return ['status'=>'success','data'=>$regist];
        }
    }

    public function formTambahRekapMedik(){
        $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
        ];
        return view('perawat.pages.add.content',$data);
    }

    public function modalDetailPasien(Request $request){
        if($request->rm=='Budiman'){
            $rm = 'Budiman';
        }else{
            $rm = '';
        }
        $data = ['rm'=>$rm];
        $content = view('dokter.pages.modal.detailpasien',$data)->render();
        return ['status'=>'success','content'=>$content];
    }

    public function modalTambahObat(Request $request){
        $content = view('dokter.pages.modal.tambahobat')->render();
        return ['status'=>'success','content'=>$content];
    }

    public function modalTambahLaborat(Request $request){
        $content = view('dokter.pages.modal.tambahlaborat')->render();
        return ['status'=>'success','content'=>$content];
    }

    public function modalTambahRadio(Request $request){
        $content = view('dokter.pages.modal.tambahradiologi')->render();
        return ['status'=>'success','content'=>$content];
    }

    /*===============================================================
    ======================== DATA REKAP MEDIS =====================
    ===============================================================*/
    public function dataRekapMedik(){
        $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'4',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'rekap'=>DB::table('rekap_medik as r')->select('no_RM','Nama_Pasien')->distinct()->limit(10)->get(),
            'total'=>DB::table('rekap_medik as r')->select('no_RM','Nama_Pasien')->distinct()->get(),
        ];
        return view('perawat.pages.data.main',$data);
    }

    public function pageData(Request $request){
        // return $request->all();
        $dokter = DB::table('users')->where('id',Auth::User()->id)->first();

        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='tanggalKunjungan'){
           $data=[
                'total' =>DB::table('rekap_medik as r')->select('no_RM','Nama_Pasien')->distinct()->get(),
                'data' =>DB::table('rekap_medik as r')->select('no_RM','Nama_Pasien')->limit($limit)->offset($offset)->distinct()->get(),
            ];
        }else{
            if($request->by=='tanggalKunjungan'){
                $data=[
                    'total'=>DB::table('rekap_medik as r')->where($request->by,'like','%'.$request->cariStatus.'%')->where('KodePoli',$dokter->kodePoli)->get(),
                    'data'=>DB::table('rekap_medik as r')->where($request->by,'like','%'.$request->cariStatus.'%')->where('KodePoli',$dokter->kodePoli)->orderBy('tanggalKunjungan','ASC')->limit($limit)->offset($offset)->get(),
                ];
            }else{
                $data=[
                    'total'=>DB::table('rekap_medik as r')->select('no_RM','Nama_Pasien')->where($request->by,'like','%'.$request->cariText.'%')->distinct()->get(),
                    'data'=>DB::table('rekap_medik as r')->select('no_RM','Nama_Pasien')->where($request->by,'like','%'.$request->cariText.'%')->limit($limit)->offset($offset)->distinct()->get(),
                ];
            }
        }
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    public function gantiRekap(Request $request){
        if(Session::has('id_rekap')){
            Session::flash('title','Whooops');
            Session::flash('message','Anda sedang menangani pasien');
            Session::flash('type','warning');
            return redirect::to($_SERVER['HTTP_REFERER']);
        }else{
            $data = DB::table('rekap_medik')->where('id_rekapMedik',$request->id)->first();
            // $data = DB::connection('rsu')table('tr_tracer')->where('No_Register',$request->id)->first();

            Session::put('no_RM',$data->no_RM);
            Session::put('id_rekap',$data->id_rekapMedik);
            return Redirect::route('content2');
        }
    }

    public function detailRekapPasien(Request $request){
        $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'4',
            'no_RM'=>$request->id,
            'active_sub'=>'',
            'dokter'=>$dokter,
            'rekap'=>DB::table('rekap_medik as r')->where('no_RM',$request->id)->where('aksi_perawat','1')->orderBy('tanggalKunjungan','DESC')->limit(10)->get(),
            'total'=>DB::table('rekap_medik as r')->where('no_RM',$request->id)->where('aksi_perawat','1')->get(),
        ];

        return view('perawat.pages.data.detail',$data);
    }

    public function pageDataDetail(Request $request){
        // return $request->all();
        $dokter = DB::table('users')->where('id',Auth::User()->id)->first();

        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='tanggalKunjungan'){
           $data=[
                'total' =>DB::table('rekap_medik as r')->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->orderBy('tanggalKunjungan','DESC')->get(),
                'data' =>DB::table('rekap_medik as r')->limit($limit)->offset($offset)->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->get(),
            ];
        }else{
            if($request->by=='tanggalKunjungan'){
                $data=[
                    'total'=>DB::table('rekap_medik as r')->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where($request->by,'like','%'.$request->cariStatus.'%')->get(),
                    'data'=>DB::table('rekap_medik as r')->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where($request->by,'like','%'.$request->cariStatus.'%')->orderBy('tanggalKunjungan','ASC')->limit($limit)->offset($offset)->get(),
                ];
            }else{
                $data=[
                    'total'=>DB::table('rekap_medik as r')->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where($request->by,'like','%'.$request->cariText.'%')->get(),
                    'data'=>DB::table('rekap_medik as r')->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where($request->by,'like','%'.$request->cariText.'%')->orderBy('tanggalKunjungan','DESC')->limit($limit)->offset($offset)->get(),
                ];
            }
        }
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    /*===============================================================
    ======================== PROFILE ADMIN ==========================
    ===============================================================*/
    public function profile(){
        $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'',
            'active_sub'=>'',
            'dokter'=>$dokter,
        ];
        return view('perawat.pages.profile.main',$data);
    }

    public function formUbahPasswordAdmin(){
        $content =  view('perawat.pages.profile.form')->render();
        return ['status'=>'success','content'=>$content];
    }

    public function updatePasswordAdmin(Request $request){
        $user = User::find(Auth::User()->id);
        // return $user;
        if(Hash::check($request->lama,$user->password)==true){
            $user->password = Hash::make($request->baru);
            $user->save();
            $hasil = 'Success';
            $message = 'Berhasil diupdate';
            $type = 'success';
        }else{
            $hasil = 'Gagal';
            $message = 'Gagal diupdate, Password lama anda salah';
            $type = 'error';
        }
        return Redirect::route('profilePerawat')->with('title',$hasil)->with('message',$message)->with('type',$type);
    }

    // END USER PERAWAT

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
