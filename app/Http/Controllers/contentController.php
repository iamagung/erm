<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
// use App\Model\Profil;
// use App\Model\Galeri;
use App\Model\User;
use Illuminate\Support\Facades\Schema;
// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, DB, Session;

date_default_timezone_set('Asia/Jakarta');

class contentController extends Controller
{
    function content1(){
        if(Auth::User()->level=='1'){
            $dokter = '';
            $view = 'admin.pages.add.content';
            $include = 'admin.pages.add.content.tahap1';
        }else if(Auth::User()->level=='2'){
            $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
            $view = 'dokter.pages.add.content';
            $include = 'dokter.pages.add.content.tahap1';
        }else if(Auth::User()->level=='3'){
            $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
            $view = 'perawat.pages.add.content';
            $include = 'perawat.pages.add.content.tahap1';
        }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'content'=>'1',
            'title'=>'Syarat dan Ketentuan',
            'include'=>$include,
        ];
        return view($view,$data);
    }

    function content2_so_data(Request $request){
        $data = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->get();

        return ['status' => 'success', 'data' => $data];
    }

    function content2(){
        $rekap = '';
        $rekap2 = '';
        $form_kebidanan = [];
        $form_terapi_wicara = [];
        $form_okupasi_terapi = [];
        $form_orthotik = []; 
        $form_fisioterapi = [];
        $data_tnt = [];
        $total_tnt = 0;

        if(Auth::User()->level=='1'){
            $dokter = '';
            $view = 'admin.pages.add.content';
            $include = 'admin.pages.add.content.tahap3';
        }else if(Auth::User()->level=='2'){
            //kebutuhan form rehab (okupasi terapi,terapi wicara, orthotik)
            if (Auth::user()->KodePoli == '117') {
                $form_fisioterapi = Schema::getColumnListing('rekam_medis_fisioterapi');
                $form_terapi_wicara = Schema::getColumnListing('rekam_medis_terapi_wicara');
                $form_okupasi_terapi = Schema::getColumnListing('rekam_medis_okupasi_terapi');
                $form_orthotik = Schema::getColumnListing('rekam_medis_orthotik');
            }
            $rekap = DB::table('rekap_medik')
                ->select('id_rekapMedik', 'nama_perawat', 'jenis_kasus', 'tanggalPengerjaan', 'agama', 'pendidikan', 'No_RM',
                        'KodePoli', 'No_Register', 'pekerjaan', 'tekanan_darah', 'frek_nadi', 'suhu', 'frek_nafas', 'berat_badan',
                        'tinggi_badan', 'lingkar_kepala', 'imt', 'alat_bantu', 'prothesa', 'cacat_tubuh', 'adi', 'riwayat_jatuh',
                        'skrining_nyeri', 'status_psikologi', 'hambatan', 'alergi')
                ->where('id_rekapMedik',Session::get('id_rekap'))->first();
            $rekap2 = DB::table('rekam_medis_lanjutan')
                ->select('rekam_medis_id', 'anamnesis_perawat', 'pemeriksaanFisik_perawat', 'diagnosis_perawat', 'rencana_terapi_perawat',
                'instruksi_ppa_perawat', 'daftar_melalui', 'kategori_pembayaran', 'suku', 'status_pernikahan', 'keluhan_utama',
                'riwayat_kesehatan', 'riwayat_operasi', 'riwayat_kb', 'jenis_kb', 'status_gizi', 'stunting_wasting',
                'riwayat_pengobatan', 'pengkajian_nyeri', 'risiko_jatuh')
                ->where('rekam_medis_id',Session::get('id_rekap'))->first();
            $dokter = DB::table('login_dokter as l')->select('u.id', 'u.nama', 'l.user_id', 'l.poli_id', 'l.Nama_Dokter', 'l.dokter_id')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
            $view = 'dokter.pages.add.content';
            $include = 'dokter.pages.add.content.tahap3';
        }else if(Auth::User()->level=='3'){
            //kebutuhan form rehab (okupasi terapi,terapi wicara, orthotik)
            if (Auth::user()->is_terapis == 'Y') {
                $rekap = DB::table('rekap_medik')
                    ->select('id_rekapMedik', 'nama_perawat', 'jenis_kasus', 'tanggalPengerjaan', 'agama', 'pendidikan', 'No_RM',
                        'KodePoli', 'No_Register', 'pekerjaan', 'tekanan_darah', 'frek_nadi', 'suhu', 'frek_nafas', 'berat_badan',
                        'tinggi_badan', 'lingkar_kepala', 'imt', 'alat_bantu', 'prothesa', 'cacat_tubuh', 'adi', 'riwayat_jatuh',
                        'skrining_nyeri', 'status_psikologi', 'hambatan', 'alergi')
                    ->where('id_rekapMedik',Session::get('id_rekap'))->first();
                $rekap2 = DB::table('rekam_medis_lanjutan')
                    ->select('rekam_medis_id', 'anamnesis_perawat', 'pemeriksaanFisik_perawat', 'diagnosis_perawat',
                    'rencana_terapi_perawat', 'instruksi_ppa_perawat', 'daftar_melalui', 'kategori_pembayaran', 'suku',
                    'status_pernikahan', 'keluhan_utama', 'riwayat_kesehatan', 'riwayat_operasi', 'riwayat_kb', 'jenis_kb', 'status_gizi',
                    'stunting_wasting', 'riwayat_pengobatan', 'pengkajian_nyeri', 'risiko_jatuh')
                    ->where('rekam_medis_id',Session::get('id_rekap'))->first();
                $form_fisioterapi = Schema::getColumnListing('rekam_medis_fisioterapi');
                $form_terapi_wicara = Schema::getColumnListing('rekam_medis_terapi_wicara');
                $form_okupasi_terapi = Schema::getColumnListing('rekam_medis_okupasi_terapi');
                $form_orthotik = Schema::getColumnListing('rekam_medis_orthotik');
            } else {
                $rekap = DB::table('rekap_medik')
                    ->select('id_rekapMedik', 'nama_perawat', 'jenis_kasus', 'tanggalPengerjaan', 'agama', 'pendidikan', 'No_RM',
                        'KodePoli', 'No_Register', 'pekerjaan', 'tekanan_darah', 'frek_nadi', 'suhu', 'frek_nafas', 'berat_badan',
                        'tinggi_badan', 'lingkar_kepala', 'imt', 'alat_bantu', 'prothesa', 'cacat_tubuh', 'adi', 'riwayat_jatuh',
                        'skrining_nyeri', 'status_psikologi', 'hambatan', 'alergi')
                    ->where('no_RM', Session::get('no_RM'))
                    ->where('KodePoli', Auth::user()->kodePoli)
                    ->orderBy('id_rekapMedik', 'DESC')->skip(1)->take(1)->first();
                if ($rekap) {
                    $rekap2 = DB::table('rekam_medis_lanjutan')
                        ->select('rekam_medis_id', 'anamnesis_perawat', 'pemeriksaanFisik_perawat', 'diagnosis_perawat',
                        'rencana_terapi_perawat', 'instruksi_ppa_perawat', 'daftar_melalui', 'kategori_pembayaran', 'suku',
                        'status_pernikahan', 'keluhan_utama', 'riwayat_kesehatan', 'riwayat_operasi', 'riwayat_kb', 'jenis_kb',
                        'status_gizi', 'stunting_wasting','riwayat_pengobatan', 'pengkajian_nyeri', 'risiko_jatuh')
                        ->where('rekam_medis_id', $rekap->id_rekapMedik)->first();
                }
            }
            $dokter = DB::table('users')->select('id', 'nama')->where('id',Auth::User()->id)->first();
            $view = 'perawat.pages.add.content';
            $include = 'perawat.pages.add.content.tahap3';
        }
        $dataRegist = DB::connection('rsu')->table('tr_registrasi')
            ->select('Kode_Ass', 'No_RM', 'No_Register', 'Tgl_Register', 'Kode_Poli1')
            ->where('No_RM', Session::get('no_RM'))
            ->whereDate('Tgl_Register', '=', date('Y-m-d'))
            ->orderBy('Tgl_Register', 'DESC')
            ->first();
        if($rekap){
            //get data tarif dan tindakan jika sudah ada
            if (Auth::User()->level=='2') { #Jika user samadengan dokter
                $data_tnt = DB::connection('rsu')->table('tr_rawatjalantindakan')
                    ->where('No_RM', $rekap->No_RM)
                    // ->where('KodePoli', Auth::user()->kodePoli)
                    ->where('KodePoli', $dataRegist->Kode_Poli1)
                    ->where('No_Register', $rekap->No_Register)
                    ->get();

                if(count($data_tnt) > 0){
                    $total_tnt = 0;
                    foreach ($data_tnt as $key => $dt) {
                        $total_tnt += (int)$dt->TarifTindakan;
                    }

                    if(!Session::has('dataTindakan')){
                        Session::put('dataTindakan',$data_tnt);
                        $data_tnt_d = DB::connection('rsu')->table('tr_rawatjalantindakan_d')
                            ->where('NoRegister', $rekap->No_Register)
                            ->where('NoTindakan', $data_tnt[0]->NoTindakan)
                            ->get();
                        Session::put('dataTindakan_d', $data_tnt_d);
                    }
                }else{
                    Session::put('dataTindakan',$rekap->No_Register);
                    Session::put('dataTindakan_d',$rekap->No_Register);
                }
            } else {
                $data_tnt = DB::connection('rsu')->table('tr_rawatjalantindakan')
                ->select('No_RM','RwID', 'KodeTindakan', 'NamaTindakan', 'KodePoli', 'TarifTindakan', 'No_Register')
                ->where('No_RM', Session::get('no_RM'))
                // ->where('KodePoli', Auth::user()->kodePoli)
                ->where('KodePoli', $dataRegist->Kode_Poli1)
                ->where('No_Register', $dataRegist->No_Register)
                ->get();
                if(count($data_tnt) > 0){
                    foreach ($data_tnt as $key => $dt) {
                        $total_tnt += (int)$dt->TarifTindakan;
                    }
                }
            }
        }
        $tnt = DB::connection('rsu')->table('tr_tindakan_m')->where('KodePoli', $dataRegist->Kode_Poli1)->get();
        // $tnt = DB::connection('rsu')->table('tr_tindakan_m')
        //     ->select('KodePoli', 'KodeTindakan', 'NamaTindakan', 'Total')
        //     ->where('KodePoli', Auth::user()->kodePoli)->get();
        $cat_bayar = DB::connection('rsu')->table('tm_setupall')->select('nilaichar', 'groups', 'subgroups')->where('groups','Asuransi')->get();
        $rekap1 = DB::table('rekap_medik')
            ->select('id_rekapMedik', 'no_RM','tanggalKunjungan', 'diagnosa', 'icd10', 'no_Register', 'tindakan', 'icd9', 'NamaPoli', 'tgl_kontrol')
            ->where('no_RM', Session::get('no_RM'))
            ->orderBy('tanggalKunjungan','DESC')
            ->paginate(10);
        $data_fisioterapi = DB::table('rekam_medis_fisioterapi')
            ->where('rekapMedik_id', Session::get('id_rekap') )
            ->orderBy('id_form_fisioterapi', 'DESC')
            ->first();
        $data_terapi_wicara = DB::table('rekam_medis_terapi_wicara')
            ->where('rekapMedik_id', Session::get('id_rekap') )
            ->orderBy('id_form_terapi_wicara', 'DESC')
            ->first();
        $data_okupasi_terapi = DB::table('rekam_medis_okupasi_terapi')
            ->where('rekapMedik_id', Session::get('id_rekap') )
            ->orderBy('id_form_okupasi_terapi', 'DESC')
            ->first();
        $data_orthotik = DB::table('rekam_medis_orthotik')
            ->where('rekapMedik_id', Session::get('id_rekap') )
            ->orderBy('id_form_orthotik', 'DESC')
            ->first();

        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'content'=>'2',
            'title'=>'Pengkajian Awal Pasien Rawat Jalan',
            'include'=>$include,
            'rekap1'=>$rekap1,
            'rekap' => $rekap,
            'rekap2' => $rekap2,
            'dataRegist' => $dataRegist,
            'data_tnt' => $data_tnt,
            'tnt' => $tnt,
            'cat_bayar' => $cat_bayar,
            'total_tnt' => $total_tnt,
            'form_kebidanan'=> Auth::User()->level == 3 ? $form_kebidanan : (array) [],
            'data_kebidanan'=> !empty($data_kebidanan) ? $data_kebidanan : (object) [],
            'form_fisioterapi'=> Auth::User()->level == 3 ? $form_fisioterapi : (array) [],
            'data_fisioterapi'=> !empty($data_fisioterapi) ? $data_fisioterapi : (object) [],
            'form_terapi_wicara'=> Auth::User()->level == 3 ? $form_terapi_wicara : (array) [],
            'data_terapi_wicara'=> !empty($data_terapi_wicara) ? $data_terapi_wicara : (object) [],
            'form_okupasi_terapi'=> Auth::User()->level == 3 ? $form_okupasi_terapi : (array) [],
            'data_okupasi_terapi'=> !empty($data_okupasi_terapi) ? $data_okupasi_terapi : (object) [],
            'form_orthotik'=> Auth::User()->level == 3 ? $form_orthotik : (array) [],
            'data_orthotik'=> !empty($data_orthotik) ? $data_orthotik : (object) [],
        ];
        return view($view,$data);
    }

    function content3(){
        if(Auth::User()->level=='1'){
            $dokter = '';
            $view = 'admin.pages.add.content';
            $include = 'admin.pages.add.content.tahap4';
        }else if(Auth::User()->level=='2'){
            $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
            $view = 'dokter.pages.add.content';
            $include = 'dokter.pages.add.content.tahap4';
        }else if(Auth::User()->level=='3'){
            $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
            $view = 'perawat.pages.add.content';
            $include = 'perawat.pages.add.content.tahap4';
        }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'content'=>'3',
            'title'=>'Formulir Edukasi Pasien & Keluarga Terintegrasi Rawat Jalan',
            'include'=>$include,
        ];
        return view($view,$data);
    }

    function content4(){
        if(Auth::User()->level=='1'){
            $dokter = '';
            $view = 'admin.pages.add.content';
            $include = 'admin.pages.add.content.tahap21';
        }else if(Auth::User()->level=='2'){
            $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
            $view = 'dokter.pages.add.content';
            $include = 'dokter.pages.add.content.tahap21';
        }else if(Auth::User()->level=='3'){
            $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
            $view = 'perawat.pages.add.content';
            $include = 'perawat.pages.add.content.tahap21';
        }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'content'=>'4',
            'title'=>'Riwayat Medis Pasien',
            'include'=>$include,
        ];
        return view($view,$data);
    }

    function content5(){
        if(Auth::User()->level=='1'){
            $dokter = '';
            $view = 'admin.pages.add.content';
            $include = 'admin.pages.add.content.tahap5';
        }else if(Auth::User()->level=='2'){
            $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
            $view = 'dokter.pages.add.content';
            $include = 'dokter.pages.add.content.tahap5';
        }else if(Auth::User()->level=='3'){
            $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
            $view = 'perawat.pages.add.content';
            $include = 'perawat.pages.add.content.tahap5';
        }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'content'=>'5',
            'title'=>'Riwayat Resep',
            'include'=>$include,
        ];
        return view($view,$data);
    }

    function content6(){
        if(Auth::User()->level=='1'){
            $dokter = '';
            $view = 'admin.pages.add.content';
            $include = 'admin.pages.add.content.tahap6';
        }else if(Auth::User()->level=='2'){
            $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
            $view = 'dokter.pages.add.content';
            $include = 'dokter.pages.add.content.tahap6';
        }else if(Auth::User()->level=='3'){
            $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
            $view = 'perawat.pages.add.content';
            $include = 'perawat.pages.add.content.tahap6';
        }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'content'=>'6',
            'title'=>'Hasil Laboratorium',
            'include'=>$include,
        ];
        return view($view,$data);
    }

    function content7(){
        if(Auth::User()->level=='1'){
            $dokter = '';
            $view = 'admin.pages.add.content';
            $include = 'admin.pages.add.content.tahap7';
        }else if(Auth::User()->level=='2'){
            $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
            $view = 'dokter.pages.add.content';
            $include = 'dokter.pages.add.content.tahap7';
        }else if(Auth::User()->level=='3'){
            $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
            $view = 'perawat.pages.add.content';
            $include = 'perawat.pages.add.content.tahap7';
        }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'content'=>'7',
            'title'=>'Hasil Radiologi',
            'include'=>$include,
        ];
        return view($view,$data);
    }

    function content8(){
        // if(Auth::User()->level=='1'){
        //     $dokter = '';
        //     $view = 'admin.pages.add.content';
        //     $include = 'admin.pages.add.content.tahap7';
        // }else if(Auth::User()->level=='2'){
            $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
            $view = 'dokter.pages.add.content';
            $include = 'dokter.pages.add.content.tahap8';
        // }else if(Auth::User()->level=='3'){
        //     $dokter = DB::table('users')->where('id',Auth::User()->id)->first();
        //     $view = 'perawat.pages.add.content';
        //     $include = 'perawat.pages.add.content.tahap7';
        // }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'2',
            'active_sub'=>'',
            'dokter'=>$dokter,
            'content'=>'7',
            'title'=>'Data Tarif & Tindakan',
            'include'=>$include,
        ];
        return view($view,$data);
    }
}
