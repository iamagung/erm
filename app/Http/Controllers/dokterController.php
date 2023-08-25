<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
// use App\Model\Profil;
// use App\Model\Galeri;
use App\Model\User;



// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, DB, Session;

date_default_timezone_set('Asia/Jakarta');

class dokterController extends Controller
{
    //

    public function main(Request $request){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'1',
            'active_sub'=>'',
            'tgl'=>'',
            'dokter'=>$dokter,
        ];
    	return view('dokter.dashboard.main',$data);
    }

    public function mainchart(Request $request){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'1',
            'active_sub'=>'',
            'tgl'=>$request->tgl,
            'dokter'=>$dokter,
        ];
        return view('dokter.dashboard.main',$data);
    }



    /*===============================================================
    ======================== TAMBAH REKAP MEDIS =====================
    ===============================================================*/
    public function tambahRekapMedik(){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $regist = DB::connection('rsu')->table('tr_tracer')->where('Tgl_Register','like',date('Y-m-d').'%')->first();
        $rekap = null;
        if(!empty($regist)){}else {
          $rekap = DB::table('rekap_medik')->where('tanggalKunjungan','like',date('Y-m-d').'%')->get();
        }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'rekap'=>$rekap,
        ];
        return view('dokter.pages.add.main',$data);
    }

    public function setPasien(Request $request){
        // return $request->id;
        $data = DB::table('rekap_medik')->where('id_rekapMedik',$request->id)->first();
        // $data = DB::connection('rsu')table('tr_tracer')->where('No_Register',$request->id)->first();
        $user = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $insert = [
            'tanggalPengerjaan'=>date('Y-m-d H:i:s'),
            'KodeDokter'=>$user->dokter_id,
            'NamaDokter'=>$user->Nama_Dokter,
        ];
        DB::table('rekap_medik')->where('id_rekapMedik',$request->id)->update($insert);
        Session::put('no_RM',$data->no_RM);
        Session::put('id_rekap',$data->id_rekapMedik);
        return Redirect::route('content2');
    }

    public function cekPasien(Request $request){
        // return $request->id;
        $regist = DB::connection('rsu')->table('tr_tracer')->where('No_RM',$request->id)->where('Tgl_Register','like',date('Y-m-d').'%')->first();
        // $regist = DB::connection('rsu')->table('tr_tracer')->where('No_RM',$request->id)->where('Tgl_Register','like',date('Y-m-d'))->first();
        // return count($regist);
        if(empty($regist)){
            return ['status'=>'error'];
        }else{
            $rekap = DB::table('rekap_medik')->where('no_Register',$regist->No_Register)->where('no_RM',$regist->No_RM)->where('tanggalKunjungan','like',date('Y-m-d').'%')->first();
            if(count(array($rekap))==0){
                return ['status'=>'ada','data'=>$regist];
            }else{
                return ['status'=>'success','data'=>$regist,'rekap'=>$rekap];
            }
        }
    }

    public function formTambahRekapMedik(){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
        ];
        return view('dokter.pages.add.content',$data);
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
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'4',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'rekap'=>DB::table('rekap_medik as r')->select('no_RM','Nama_Pasien')->distinct()->limit(10)->get(),
            'total'=>DB::table('rekap_medik as r')->select('no_RM','Nama_Pasien')->distinct()->get(),
        ];
        return view('dokter.pages.data.main',$data);
    }

    public function pageData(Request $request){
        // return $request->all();
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();

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
            return Redirect::to($_SERVER['HTTP_REFERER'])->with('title','Whoops')->with('message','Anda sedang menangani pasien')->with('type','warning');
        }else{
            $data = DB::table('rekap_medik')->where('id_rekapMedik',$request->id)->first();
            if (!$data->NamaDokter && !$data->KodeDokter) {
                $user = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
                $insert = [
                    'tanggalPengerjaan'=>date('Y-m-d H:i:s'),
                    'KodeDokter'=>$user->dokter_id,
                    'NamaDokter'=>$user->Nama_Dokter,
                ];
                DB::table('rekap_medik')->where('id_rekapMedik',$request->id)->update($insert);
            }
            // $data = DB::connection('rsu')table('tr_tracer')->where('No_Register',$request->id)->first();

            Session::put('no_RM',$data->no_RM);
            Session::put('id_rekap',$data->id_rekapMedik);
            return Redirect::route('content2');
        }
    }

    public function detailRekapPasien(Request $request){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'4',
            'no_RM'=>$request->id,
            'active_sub'=>'',
            'dokter'=>$dokter,
            'rekap'=>DB::table('rekap_medik as r')->where('no_RM',$request->id)->where('aksi_perawat','1')->where('aksi_dokter','1')->orderBy('tanggalKunjungan','DESC')->limit(10)->get(),
            'total'=>DB::table('rekap_medik as r')->where('no_RM',$request->id)->where('aksi_perawat','1')->where('aksi_dokter','1')->get(),
        ];
        // return $data['rekap'];

        return view('dokter.pages.data.detail',$data);
    }

    public function pageDataDetail(Request $request){
        // return $request->all();
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();

        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='tanggalKunjungan'){
           $data=[
                'total' =>DB::table('rekap_medik as r')->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where('aksi_dokter','1')->orderBy('tanggalKunjungan','DESC')->get(),
                'data' =>DB::table('rekap_medik as r')->limit($limit)->offset($offset)->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where('aksi_dokter','1')->get(),
            ];
        }else{
            if($request->by=='tanggalKunjungan'){
                $data=[
                    'total'=>DB::table('rekap_medik as r')->where($request->by,'like','%'.$request->cariStatus.'%')->where('NamaDokter','!=',null)->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where('aksi_dokter','1')->get(),
                    'data'=>DB::table('rekap_medik as r')->where($request->by,'like','%'.$request->cariStatus.'%')->where('NamaDokter','!=',null)->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where('aksi_dokter','1')->orderBy('tanggalKunjungan','ASC')->limit($limit)->offset($offset)->get(),
                ];
            }else{
                $data=[
                    'total'=>DB::table('rekap_medik as r')->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where('aksi_dokter','1')->where($request->by,'like','%'.$request->cariText.'%')->where('NamaDokter','!=',null)->get(),
                    'data'=>DB::table('rekap_medik as r')->where('no_RM',$request->no_RM)->where('aksi_perawat','1')->where('aksi_dokter','1')->where($request->by,'like','%'.$request->cariText.'%')->where('NamaDokter','!=',null)->orderBy('tanggalKunjungan','DESC')->limit($limit)->offset($offset)->get(),
                ];
            }
        }
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    /*===============================================================
    ======================== PROFILE ADMIN ==========================
    ===============================================================*/
    public function profile(){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'',
            'active_sub'=>'',
            'dokter'=>$dokter,
        ];
        return view('dokter.pages.profile.main',$data);
    }

    public function formUbahPasswordAdmin(){
        $content =  view('dokter.pages.profile.form')->render();
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
        return Redirect::route('profileDokter')->with('title',$hasil)->with('message',$message)->with('type',$type);
    }

    public function editDraw(Request $request){
        $data = ['id'=>$request->id];
        $content = view('dokter.pages.add.as',$data);
        return $content;
    }

    public function simpanEditDraw(Request $request){
        $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        switch ($request->id) {
            case '1':
                if($rekap->fotodiagnosa!=''){
                    if(file_exists($rekap->fotodiagnosa)){
                        unlink($rekap->fotodiagnosa);
                    }
                }
                $kolom = 'fotodiagnosa';
                break;
            case '2':
                if($rekap->fotoicd10!=''){
                    if(file_exists($rekap->fotoicd10)){
                        unlink($rekap->fotoicd10);
                    }
                }
                $kolom = 'fotoicd10';
                break;
            case '3':
                if($rekap->fotoobat!=''){
                    if(file_exists($rekap->fotoobat)){
                        unlink($rekap->fotoobat);
                    }
                }
                $kolom = 'fotoobat';
                break;
            case '4':
                if($rekap->fotoicd9!=''){
                    if(file_exists($rekap->fotoicd9)){
                        unlink($rekap->fotoicd9);
                    }
                }
                $kolom = 'fotoicd9';
                break;
            case '5':
                if($rekap->foto_anamnesis!=''){
                    if(file_exists($rekap->foto_anamnesis)){
                        unlink($rekap->foto_anamnesis);
                    }
                }
                $kolom = 'foto_anamnesis';
                break;
            case '6':
                if($rekap->foto_rencana!=''){
                    if(file_exists($rekap->foto_rencana)){
                        unlink($rekap->foto_rencana);
                    }
                }
                $kolom = 'foto_rencana';
                break;
            case '7':
                if($rekap->fotoPemeriksaanFisik!=''){
                    if(file_exists($rekap->fotoPemeriksaanFisik)){
                        unlink($rekap->fotoPemeriksaanFisik);
                    }
                }
                $kolom = 'fotoPemeriksaanFisik';
                break;

            default:
                $kolom = '';
                break;
        }
        $fileName = '';
        $photo = $request->gambar;
        try {
            if(strlen($photo) > 128) {
                list($ext, $data)   = explode(';', $photo);
                list(, $data)       = explode(',', $data);
                $data = base64_decode($data);

                $fileName = mt_rand().time().'.jpg';
                file_put_contents('draw/'.$fileName, $data);
            }
        }
        catch (\Exception $e) {
            $msg = $e;
        }

        $insert = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update([$kolom=>'draw/'.$fileName]);
        if($insert){
            return '<script>window.close()</script>';
        }else{
            return '<a href="'.url('rekap_medik/p1/'.$id).'"><button onclick="window.close()">Kembali</button></a>';
        }
    }

    public function fotoDraw(Request $request){
        $data = ['id'=>$request->id];
        $content = view('dokter.pages.add.cam',$data);
        return $content;
    }

    public function simpanFotoDraw(Request $request){
        $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $judul = 'Foto';
        switch ($request->id) {
            case '1':
                if($rekap->fotodiagnosa!=''){
                    if(file_exists($rekap->fotodiagnosa)){
                        unlink($rekap->fotodiagnosa);
                    }
                }
                $kolom = 'fotodiagnosa';
                break;
            case '2':
                if($rekap->fotoicd10!=''){
                    if(file_exists($rekap->fotoicd10)){
                        unlink($rekap->fotoicd10);
                    }
                }
                $kolom = 'fotoicd10';
                break;
            case '3':
                if($rekap->fotoobat!=''){
                    if(file_exists($rekap->fotoobat)){
                        unlink($rekap->fotoobat);
                    }
                }
                $kolom = 'fotoobat';
                break;
            case '4':
                if($rekap->fotoicd9!=''){
                    if(file_exists($rekap->fotoicd9)){
                        unlink($rekap->fotoicd9);
                    }
                }
                $kolom = 'fotoicd9';
                break;
            case '5':
                if($rekap->foto_anamnesis!=''){
                    if(file_exists($rekap->foto_anamnesis)){
                        unlink($rekap->foto_anamnesis);
                    }
                }
                $kolom = 'foto_anamnesis';
                break;
            case '6':
                if($rekap->foto_rencana!=''){
                    if(file_exists($rekap->foto_rencana)){
                        unlink($rekap->foto_rencana);
                    }
                }
                $kolom = 'foto_rencana';
                break;
            case '7':
                if($rekap->fotoPemeriksaanFisik!=''){
                    if(file_exists($rekap->fotoPemeriksaanFisik)){
                        unlink($rekap->fotoPemeriksaanFisik);
                    }
                }
                $kolom = 'fotoPemeriksaanFisik';
                break;

            default:
                $kolom = '';
                break;
        }
        $filename =  $judul.time() . '.jpg';
        $filepath = 'saved_images/';

        move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$filename);

        $insert = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update([$kolom=>'saved_images/'.$filename]);
        if($insert){
            return $filepath.$filename;;
        }else{
            return '<a href="'.url('rekap_medik/p5/'.$id).'"><button onclick="window.close()">Tutup</button></a>';
        }
    }

    public function uploadDraw(Request $request){
        $data = ['id'=>$request->id];
        $content = view('dokter.pages.add.up',$data);
        return $content;
    }

    public function simpanUploadDraw(Request $request){
        $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        switch ($request->id) {
            case '1':
                if($rekap->fotodiagnosa!=''){
                    if(file_exists($rekap->fotodiagnosa)){
                        unlink($rekap->fotodiagnosa);
                    }
                }
                $kolom = 'fotodiagnosa';
                break;
            case '2':
                if($rekap->fotoicd10!=''){
                    if(file_exists($rekap->fotoicd10)){
                        unlink($rekap->fotoicd10);
                    }
                }
                $kolom = 'fotoicd10';
                break;
            case '3':
                if($rekap->fotoobat!=''){
                    if(file_exists($rekap->fotoobat)){
                        unlink($rekap->fotoobat);
                    }
                }
                $kolom = 'fotoobat';
                break;
            case '4':
                if($rekap->fotoicd9!=''){
                    if(file_exists($rekap->fotoicd9)){
                        unlink($rekap->fotoicd9);
                    }
                }
                $kolom = 'fotoicd9';
                break;
            case '5':
                if($rekap->foto_anamnesis!=''){
                    if(file_exists($rekap->foto_anamnesis)){
                        unlink($rekap->foto_anamnesis);
                    }
                }
                $kolom = 'foto_anamnesis';
                break;
            case '6':
                if($rekap->foto_rencana!=''){
                    if(file_exists($rekap->foto_rencana)){
                        unlink($rekap->foto_rencana);
                    }
                }
                $kolom = 'foto_rencana';
                break;
            case '7':
                if($rekap->fotoPemeriksaanFisik!=''){
                    if(file_exists($rekap->fotoPemeriksaanFisik)){
                        unlink($rekap->fotoPemeriksaanFisik);
                    }
                }
                $kolom = 'fotoPemeriksaanFisik';
                break;

            default:
                $kolom = '';
                break;
        }
        $id = $request->id;
        if(!empty($request->foto)){
            $ukuranFile1 = filesize($request->icon);
            if(!file_exists("adminasset/assets/images/datamaster/barang")){
                unlink("adminasset/assets/images/datamaster/barang");
            }

            if ($ukuranFile1 <= 500000) {
                $ext_foto1 = $request->foto->getClientOriginalExtension();
                $filename1 = "img_barang_".date('Ymd-His').".".$ext_foto1;
                $temp_foto1 = 'foto/';
                $proses1 = $request->foto->move($temp_foto1, $filename1);
                $nameFile = 'foto/'.$filename1;
            }else{
                $file1=$_FILES['foto']['name'];
                if(!empty($file1)){
                    $direktori1="foto/"; //tempat upload foto
                    $name1='foto'; //name pada input type file
                    $namaBaru1="img_barang_".date('Ymd-His'); //name pada input type file
                    $quality1=50; //konversi kualitas gambar dalam satuan %
                    $upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
                }
                $ext_foto1 = $request->foto->getClientOriginalExtension();
                $nameFile = 'foto/'.$namaBaru1.".".$ext_foto1;
            }
            $insert = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update([$kolom=>$nameFile]);
            if($insert){
                return '<script>window.close()</script>';
            }else{
                return '<a href="'.url('rekap_medik/p5/'.$id).'"><button onclick="window.close()">Tutup</button></a>';
            }
        }
        return '<a href="'.url('rekap_medik/p5/'.$id).'"><button onclick="window.close()">Tutup</button></a>';
    }

    // USER PERAWAT

    public function userPerawat(){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'5',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'dokter1' => DB::table('users as u')->where('level','3')->where('kodePoli',$dokter->poli_id)->limit(10)->get(),
            'total' => DB::table('users as u')->where('level','3')->where('kodePoli',$dokter->poli_id)->get(),
        ];
        return view('dokter.pages.userPerawat.main',$data);
    }

    public function formPerawat(Request $request){
        $id = $request->id;
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'id'=>$id,
            'dokter'=>$dokter,
        ];
        $content = view('dokter.pages.userPerawat.form',$data)->render();
        return ['status'=>'success','content'=>$content];
    }

    public function detailPerawat(Request $request){
        $id = $request->id;
        $data = ['id'=>$id];
        $content = view('dokter.pages.userPerawat.detail',$data)->render();
        return ['status'=>'success','content'=>$content];
    }

    public function deletePerawat(Request $request){
        $delete = DB::table('users')->where('id',$request->id)->delete();
        if($delete){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error'];
        }
    }

    public function resetPerawat(Request $request){
        $delete = DB::table('users')->where('id',$request->id)->first();
        $data = ['password'=>Hash::make($delete->username)];
        $update = DB::table('users')->where('id',$delete->id)->update($data);
        if($update){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error'];
        }
    }

    public function simpanPerawat(Request $request){
        // return $request->all();
        $poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli',$request->id_poli)->first();
        // $poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli',$request->id_poli)->first();
        $data1 = [
            'kodePoli' => $request->id_poli,
            'namaPoli' => $poli->NamaPoli,
        ];

        if($request->id_admin=='0'){
            $exist = DB::table('users')->where('username',$request->username)->orWhere('nama',$request->nama_perawat)->first();
            if(count($exist)==0){
                $dataUser = [
                    'nama' => $request->nama_perawat,
                    'alias' => '',
                    'telp' => '',
                    'alamat' => '',
                    'aktif' => '',
                    'foto_user' => '',
                    'level' => '3',
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'kodePoli' => $request->id_poli,
                    'namaPoli' => $poli->NamaPoli,
                ];

                $insertUser = DB::table('users')->insert($dataUser);
                if($insertUser){
                    return ['status'=>'success'];
                }else{
                    return ['sttaus'=>'error'];
                }
            }else{
                return ['status'=>'exist'];
            }
        }else{
            $data = $data1;
            $update = DB::table('users')->where('id',$request->id_admin)->update($data);
            if($update==1){
                return ['status'=>'success'];
            }else{
                return ['status'=>'tidak'];
            }
        }
    }

    public function pagePerawat(Request $request){
        // return $request->all();
        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='aktif'){
           $data=[
                'total' => DB::table('users')->where('level','3')->where('kodePoli',$dokter->poli_id)->get(),
                'data' => DB::table('users')->where('level','3')->where('kodePoli',$dokter->poli_id)->limit($limit)->offset($offset)->get(),
            ];
        }else{
            if($request->by=='aktif'){
                $data=[
                    'total'=>DB::table('login_dokter as l')->select('l.*','u.*','l.id as i')->join('users as u','u.id','l.user_id')->where($request->by,$request->cariStatus)->get(),
                    'data'=>DB::table('login_dokter as l')->select('l.*','u.*','l.id as i')->join('users as u','u.id','l.user_id')->where($request->by,$request->cariStatus)->limit($limit)->offset($offset)->get(),
                ];
            }else{
                $data=[
                    'total'=>DB::table('users')->where('level','3')->where('kodePoli',$dokter->poli_id)->where($request->by,'like','%'.$request->cariText.'%')->get(),
                    'data'=>DB::table('users')->where('level','3')->where('kodePoli',$dokter->poli_id)->where($request->by,'like','%'.$request->cariText.'%')->limit($limit)->offset($offset)->get(),
                ];
            }
        }
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    // END USER PERAWAT

    public function jawab_rujuk(Request $request){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'5',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'rujuk' => DB::table('rujukan_rm')->where('id_rujukan',$request->id)->first(),
        ];
        return view('dokter.pages.rujukan.main',$data);
    }

    public function simpan_jawab_rujuk(Request $request){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $dat = [
            'HasilRujuk'=>$request->jawaban,
            'KodeDokter'=>$dokter->dokter_id,
            'DokterPoli'=>$dokter->Nama_Dokter,
        ];
        $update = DB::table('rujukan_rm')->where('id_rujukan',$request->id_rekap)->update($dat);
        if($update){
            return Redirect::route('dashboard')->with('title','Success')->with('message','Jawaban disimpan')->with('type','success');
        }else{
            return Redirect::route('dashboard')->with('title','Whoops')->with('message','Jawaban tidak disimpan')->with('type','error');
        }
    }

    public function ajukanSoal(){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'6',
            'active_sub'=>'61',
            'dokter'=>$dokter,
            'rekap'=>DB::table('rujukan_rm')->select('rujukan_rm.*','rekap_medik.*','rujukan_rm.NamaPoli as nama_poliRujuk')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->orderBy('tanggalKunjungan','DESC')->limit(10)->get(),
            'total'=>DB::table('rujukan_rm')->select('rujukan_rm.*','rekap_medik.*','rujukan_rm.NamaPoli as nama_poliRujuk')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->get(),
        ];
        return view('dokter.pages.rujukan.ajukan',$data);
    }

    public function pageAjukan(Request $request){
        // return $request->all();
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();

        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='tanggalKunjungan'){
           $data=[
                'total' =>DB::table('rujukan_rm')->select('rujukan_rm.*','rekap_medik.*','rujukan_rm.NamaPoli as nama_poliRujuk')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->orderBy('tanggalKunjungan','DESC')->get(),
                'data' =>DB::table('rujukan_rm')->select('rujukan_rm.*','rekap_medik.*','rujukan_rm.NamaPoli as nama_poliRujuk')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->orderBy('tanggalKunjungan','DESC')->limit(10)->get(),
            ];
        }else{
            if($request->by=='tanggalKunjungan'){
                $data=[
                    'total'=>DB::table('rujukan_rm')->select('rujukan_rm.*','rekap_medik.*','rujukan_rm.NamaPoli as nama_poliRujuk')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->where($request->by,'like','%'.$request->cariStatus.'%')->orderBy('tanggalKunjungan','DESC')->get(),
                    'data'=>DB::table('rujukan_rm')->select('rujukan_rm.*','rekap_medik.*','rujukan_rm.NamaPoli as nama_poliRujuk')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->where($request->by,'like','%'.$request->cariStatus.'%')->orderBy('tanggalKunjungan','DESC')->limit($limit)->offset($offset)->get(),
                ];
            }else{
                $data=[
                    'total'=>DB::table('rujukan_rm')->select('rujukan_rm.*','rekap_medik.*','rujukan_rm.NamaPoli as nama_poliRujuk')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->where($request->by,'like','%'.$request->cariText.'%')->orderBy('tanggalKunjungan','DESC')->get(),
                    'data'=>DB::table('rujukan_rm')->select('rujukan_rm.*','rekap_medik.*','rujukan_rm.NamaPoli as nama_poliRujuk')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('DariKodeDokter',$dokter->dokter_id)->where('HasilRujuk',null)->where($request->by,'like','%'.$request->cariText.'%')->orderBy('tanggalKunjungan','DESC')->limit($limit)->offset($offset)->get(),
                ];
            }
        }
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    public function jawabSoal(){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'6',
            'active_sub'=>'62',
            'dokter'=>$dokter,
            'rekap'=>DB::table('rujukan_rm')->select('rekap_medik.*','rujukan_rm.*','rujukan_rm.KodePoli as kd_poli')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('rujukan_rm.KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->orderBy('tanggalKunjungan','DESC')->limit(10)->get(),
            'total'=>DB::table('rujukan_rm')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('rujukan_rm.KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->orderBy('tanggalKunjungan','DESC')->get(),
        ];
        return view('dokter.pages.rujukan.jawab',$data);
    }

    public function pageJawab(Request $request){
        // return $request->all();
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();

        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='tanggalKunjungan'){
           $data=[
                'total' =>DB::table('rujukan_rm')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('rujukan_rm.KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->orderBy('tanggalKunjungan','DESC')->get(),
                'data' =>DB::table('rujukan_rm')->select('rekap_medik.*','rujukan_rm.*','rujukan_rm.KodePoli as kd_poli')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('rujukan_rm.KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->orderBy('tanggalKunjungan','DESC')->limit(10)->get(),
            ];
        }else{
            if($request->by=='tanggalKunjungan'){
                $data=[
                    'total'=>DB::table('rujukan_rm')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('rujukan_rm.KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->where($request->by,'like','%'.$request->cariStatus.'%')->orderBy('tanggalKunjungan','DESC')->get(),
                    'data'=>DB::table('rujukan_rm')->select('rekap_medik.*','rujukan_rm.*','rujukan_rm.KodePoli as kd_poli')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('rujukan_rm.KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->where($request->by,'like','%'.$request->cariStatus.'%')->orderBy('tanggalKunjungan','DESC')->limit($limit)->offset($offset)->get(),
                ];
            }else{
                $data=[
                    'total'=>DB::table('rujukan_rm')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('rujukan_rm.KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->where($request->by,'like','%'.$request->cariText.'%')->orderBy('tanggalKunjungan','DESC')->get(),
                    'data'=>DB::table('rujukan_rm')->select('rekap_medik.*','rujukan_rm.*','rujukan_rm.KodePoli as kd_poli')->join('rekap_medik','rekap_medik.id_rekapMedik','rujukan_rm.rekapMedik_id')->where('rujukan_rm.KodePoli',$dokter->poli_id)->where('HasilRujuk',null)->where($request->by,'like','%'.$request->cariText.'%')->orderBy('tanggalKunjungan','DESC')->limit($limit)->offset($offset)->get(),
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

    function cari_jawaban(Request $request){
      $jawab = $request->jawab;
      $pertanyaan = DB::table('rujukan_rm')->where('HasilRujuk','like','%'.$jawab.'%')->distinct()->limit(10)->get();
      return ['status'=>'success','data'=>$pertanyaan];
    }
}
