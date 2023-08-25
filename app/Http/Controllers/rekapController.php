<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
// use App\Model\Profil;
// use App\Model\Galeri;
use App\Model\User;
use App\Traits\KebidananKandungan;
use App\Traits\OkupasiTerapi;
use App\Traits\Orthotik;
use App\Traits\Fisioterapi;
use App\Traits\TarifDanTindakan;
use App\Traits\TerapiWicara;
// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, DB, Session;

date_default_timezone_set('Asia/Jakarta');

class rekapController extends Controller
{
    use TarifDanTindakan,KebidananKandungan,TerapiWicara,OkupasiTerapi,Orthotik,Fisioterapi;

    public function simpanTahap1(Request $request){
        $syarat = '';
        for($i=0;$i<count($request->syarat);$i++){
            $syarat.=$request->syarat[$i].'=';
        }

        $data = ['persetujuan'=>$syarat];
        $insert = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update($data);
        if($insert){
            Session::flash('title','Successs');
            Session::flash('message','Persyaratan disimpan');
            Session::flash('type','success');
            return ['status'=>'success'];
        }else{
            Session::flash('title','Whoops');
            Session::flash('message','Persyaratan gagal disimpan');
            Session::flash('type','success');
            return ['status'=>'error'];
        }
    }

    public function simpanTahap2(Request $request){
        $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $filename1=$rekap->fotodiagnosa;
        $filename2=$rekap->fotoicd10;
        $filename3=$rekap->fotoobat;
        $filename4=$rekap->fotoicd9;

        if($request->ifoto1!=''){
            if($rekap->fotodiagnosa!=''){
                if(file_exists($rekap->fotodiagnosa)){
                    unlink($rekap->fotodiagnosa);
                }
            }
            $filename1 = 'foto/'.$this->uploadFile($request->ifoto1);
        }

        if($request->ifoto2!=''){
            if($rekap->fotoicd10!=''){
                if(file_exists($rekap->fotoicd10)){
                    unlink($rekap->fotoicd10);
                }
            }
            $filename2 = 'foto/'.$this->uploadFile($request->ifoto2);
        }

        if($request->ifoto3!=''){
            if($rekap->fotoobat!=''){
                if(file_exists($rekap->fotoobat)){
                    unlink($rekap->fotoobat);
                }
            }
            $filename3 = 'foto/'.$this->uploadFile($request->ifoto3);
        }

        if($request->ifoto3!=''){
            if($rekap->fotoicd9!=''){
                if(file_exists($rekap->fotoicd9)){
                    unlink($rekap->fotoicd9);
                }
            }
            $filename3 = 'foto/'.$this->uploadFile($request->ifoto3);
        }
        $data = [
            'fotodiagnosa' => $filename1,
            'fotoicd10' => $filename2,
            'fotoobat' => $filename3,
            'fotoicd9' => $filename4,
            'diagnosa' => $request->diagnosa,
            'icd10' => $request->icd10,
            'icd9' => $request->icd93,
            'tindakan' => $request->tindakan3,
        ];
        $in = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update($data);
        if($in){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error'];
        }
    }

    function uploadFile($gambar){
        $fileName = '';
        $photo = $gambar;
        try {
            if(strlen($photo) > 128) {
                list($ext, $data)   = explode(';', $photo);
                list(, $data)       = explode(',', $data);
                $data = base64_decode($data);

                $fileName = mt_rand().time().'.jpg';
                file_put_contents('foto/'.$fileName, $data);
            }
        }
        catch (\Exception $e) {
            $msg = $e;
        }
        return $fileName;
    }

    function simpanTahap3(Request $request){
        $hambatan = '';
        $skrining = '';
        $psikologi = '';
        $gizi = '';
        if($request->skrining_nyeri=='Ada'){
            $skrining = $request->skrining_nyeri_lain;
        }else{
            $skrining = $request->skrining_nyeri;
        }
        if(!empty($request->hambatan)){
            for ($i=0; $i < count($request->hambatan); $i++) {
                if($request->hambatan[$i]=='Bahasa'){
                    $hambatan .=$request->bahasa_lain.'+';
                } else{
                    // return 'masuk sini su==='.$request->hambatan[$i];
                    $hambatan .= $request->hambatan[$i].'+';
                }
            }
        }
        if(!empty($request->gizi)){
            for ($i=0; $i < count(array($request->gizi)); $i++) {
                $gizi .= $request->gizi[$i].'+';
            }
        }
        if(!empty($request->status_psikologi)){
            if (Auth::user()->level == '2') {
                $psikologi = $request->status_psikologi;
            } else {
                foreach ($request->status_psikologi as $v) {
                    if ($v == 'Lain-lain') {
                        $psikologi .= $request->status_psikologi_lain;
                    } else {
                        $psikologi .= $v;
                    }
                    $psikologi.='+';
                }
            }
        }

        if($request->poli_rujuk!=''){
            $poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli',$request->poli_rujuk)->first();
            $idPoli = $poli->KodePoli;
            $namaPoli = $poli->NamaPoli;
        }else{
            $idPoli = NULL;
            $namaPoli = NULL;
        }

        $tekanan_darah = join('/',$request->tekanan_darah);
        $data = [
            'nama_perawat'=>$request->nama,
            'tekanan_darah'=>$tekanan_darah,
            'frek_nadi'=>$request->frek_nadi,
            'suhu'=>$request->suhu,
            'frek_nafas'=>$request->frek_nafas,
            'skor_nyeri'=>$request->skor_nyeri,
            'skor_jatuh'=>$request->skor_jatuh,
            'berat_badan'=>$request->berat_badan,
            'tinggi_badan'=>$request->tinggi_badan,
            'lingkar_kepala'=>$request->lingkar_kepala,
            'imt'=>$request->imt,
            'alat_bantu'=>$request->alat_bantu,
            'prothesa'=>$request->prothesa,
            'cacat_tubuh'=>$request->cacat_tubuh,
            'adi'=>$request->adi,
            'riwayat_jatuh'=>$request->riwayat_jatuh,
            'skrining_nyeri'=>$skrining,
            'status_psikologi'=>$psikologi,
            'hambatan'=>$hambatan,
            'agama'=>$request->agama,
            'agama_edu'=>$request->agama,
            'anutan'=>$request->agama,
            'pendidikan'=>$request->pendidikan,
            'pendidikan_edu'=>$request->pendidikan,
            'pekerjaan'=>$request->pekerjaan,
            'alergi'=>$request->alergi,
            'jenis_kasus'=>$request->jenis_kasusnya,
        ];

        $stunting_wasting = $request->stunting.'+'.$request->wasting;
        $risiko_jatuh = $request->risiko_jatuh1.'+'.$request->risiko_jatuh2.'+'.$request->hasil_risiko_jatuh;

        $data2 = [
            'rekam_medis_id'=> Session::get('id_rekap'),
            'daftar_melalui'=> $request->daftar_melalui,
            'kategori_pembayaran'=> ($request->kategori_pembayaran=='Lainnya')?$request->kategori_lainnya:$request->kategori_pembayaran,
            'keluhan_utama'=>$request->keluhan_utama,
            'suku'=>$request->suku,
            'status_pernikahan'=>$request->status_pernikahan,
            'riwayat_kesehatan'=>($request->riwayat_kesehatan == "Y")?$request->sakit_opname:$request->riwayat_kesehatan,
            'riwayat_operasi'=>($request->riwayat_operasi == 'Y')?$request->operasi_hari_ke:$request->riwayat_operasi,
            'riwayat_kb'=>($request->riwayat_kb=='Y')?$request->lama_pemakaian:$request->riwayat_kb,
            'jenis_kb'=>($request->riwayat_kb !='N')?(($request->jenis_kb=='Lain-lain')?$request->kb_lain:$request->jenis_kb):'',
            'status_gizi'=>$request->status_gizi,
            'stunting_wasting'=>$stunting_wasting,
            'riwayat_pengobatan'=>$request->riwayat_pengobatan,
            'pengkajian_nyeri'=>$request->pengkajian_nyeri,
            'risiko_jatuh'=>$risiko_jatuh,
        ];
        if (Auth::user()->level == '3') {
            if (Auth::user()->is_terapis == 'Y') {
                $data += ['nama_terapis' => Auth::user()->nama];
                $data2 += [
                    'anamnesis_terapis'=>$request->anamnesis,
                    'pemeriksaanFisik_terapis'=>$request->pemeriksaanFisik,
                    'rencana_terapi_terapis'=>$request->rencana3,
                    'diagnosis_terapis'=>$request->diagnosis_tambahan,
                    'instruksi_ppa_terapis'=>$request->instruksi_ppa,
                ];
            } else {
                $data2 += [
                    'anamnesis_perawat'=>$request->anamnesis,
                    'pemeriksaanFisik_perawat'=>$request->pemeriksaanFisik,
                    'rencana_terapi_perawat'=>$request->rencana3,
                    'diagnosis_perawat'=>$request->diagnosis_tambahan,
                    'instruksi_ppa_perawat'=>$request->instruksi_ppa,
                ];
            }
        } else {
            $data2 += [
                'is_ranap'=>$request->is_ranap,
                'instruksi_ppa'=>$request->instruksi_ppa,
            ];

            $data += [
                'discharge'=>$request->discharge,
                'kesan_gizi'=>$gizi,
                'diagnosa'=>$request->diagnosis3,
                'icd10'=>$request->icd103,
                'icd9'=>$request->icd93,
                'tindakan'=>$request->tindakan3,
                'poli_rujuk'=>$idPoli,
                'nama_poliRujuk'=>$namaPoli,
                'diruju_ke'=>$request->rujuk3,
                'tgl_kontrol'=>$request->tgl_kontrol,
                'anamnesis'=>$request->anamnesis,
                'pemeriksaanFisik'=>$request->pemeriksaanFisik,
                'rencana_terapi'=>$request->rencana3,
                // 'diagnosis_tambahan'=>$request->diagnosis_tambahan,
            ];
        }

        $in = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update($data);

        $get = DB::table('rekam_medis_lanjutan')->where('rekam_medis_id', Session::get('id_rekap'))->first();
        if (empty($get)) {
            $in2 = DB::table('rekam_medis_lanjutan')->insert($data2);
        } else {
            $in2 = DB::table('rekam_medis_lanjutan')
                ->where('id', $get->id)
                ->update($data2);
        }

        //setup tarif dan tindakan
        $data_rekap = DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->first();
        if(Auth::user()->level == 2){
            $data_dokter = DB::table('login_dokter')->where('user_id', Auth::user()->id )->first();
        }else{
            $data_dokter = (object)[
                "poli_id" => Auth::user()->kodePoli,
                "Nama_Dokter" => ""
            ];
        }

        $no_urut = 1;
        //indikator untuk simpan dan delete berhasil / tidak
        $deleteTindakan = false;
        $simpan = false;
        $simpan2 = false;
        //generateNoTindakan (ketika simpan sudah tidak generate, langsugn ambil dari table rekam medik)
        $nomorUnik = $this->GenerateNoTindakan($data_dokter, $data_rekap);
        // $nomorUnik = $data_rekap->noTindakan;
        //generateNoRawatJL (tidak jasi generate tapi ambil dari table tm_rawatjalan)
        // $nomorUnikRJ = $this->GenerateNoRawatJL($data_rekap); //tidak dipakai
        $nomorUnikRJ = DB::connection('rsu')->table('tm_rawatjalan')->where('No_Register', $data_rekap->no_Register)->first()->No_RawatJL;
        //get table tr_registrasi untuk mengambil asuransi
        $tr_registrasi = DB::connection('rsu')->table('tr_registrasi')
                            ->where('No_Register', $data_rekap->no_Register)
                            ->first();
        //simpan data ke table tr_rawatjalantindakan dan tr_rawatjalantindakan_d
        if( isset($request->nama_tindakan) && !empty($tr_registrasi) ){
            $GT = 0;
            foreach($request->nama_tindakan as $key => $nt){
                $GT += (int) $request->tarif_tindakan[$key];
            };
            //proses simpan tarif dan tindakan
            $simpanTarifDanTindakan = $this->SimpanTarifDanTindakan($request, $data_rekap, $data_dokter, $nomorUnik, $nomorUnikRJ, $no_urut, $GT, $tr_registrasi);
            // return $simpanTarifDanTindakan;
            $simpan = $simpanTarifDanTindakan[0];
            $simpan2 = $simpanTarifDanTindakan[1];
        }
        //end of simpan tarif dan tindakan
        
        /* simpan form rehab jika polinya adalah poli rehab (117) */
        if(Auth::user()->level == 3 && $data_dokter->poli_id == 117){
            $fisioterapi = $this->modifyAndSaveFisioterapi($request);
            $terapiWicara = $this->modifyAndSaveTerapiWicara($request);
            $okupasiTerapi = $this->modifyAndSaveOkupasiTerapi($request);
            $orthotik = $this->modifyAndSaveOrthotik($request);
        }
        
        /* simpan form kandungan jika polinya adalah poli kandungan (113) */
        // if(Auth::user()->kodePoli == 113 && Auth::user()->level == 3){
        //     $kandungan = $this->modifyAndSaveKandungan($request);
        // }

        if($in || $in2 || $simpan || $simpan2 ){
            /* validasi untuk penyimpanan poli kandungan */
            // if(Auth::user()->kodePoli == 113 && Auth::user()->level == 3 && !$kandungan){
            //     return ['status'=>'error'];
            // }

            /* validasi untuk penyimpanan poli rehab */
            // if(Auth::user()->level == 3 && $data_dokter->poli_id == 117){
            //     if(!$terapiWicara || !$okupasiTerapi || !$orthotik  || !$fisioterapi){
            //         return ['status'=>'error'];
            //     }
            // }

            Session::flash('title','Successs');
            Session::flash('message','Rekap disimpan');
            Session::flash('type','success');
            return ['status'=>'success'];
        }else{
            return ['status'=>'error'];
        }
    }

    function simpanTahapResep(Request $request){
        // print_r($request->all());
        // return 'stop';
        $hambatan = '';
        $skrining = '';
        $psikologi = '';
        $gizi = '';
        if($request->skrining_nyeri=='Ada'){
            $skrining = $request->skrining_nyeri_lain;
        }else{
            $skrining = $request->skrining_nyeri;
        }
        if(count($request->hambatan)>0){
            for ($i=0; $i < count($request->hambatan); $i++) {
                if($request->hambatan[$i]=='Bahasa'){
                    $hambatan .=$request->bahasa_lain.'+';
                } else{
                    $hambatan .= $request->hambatan[$i].'+';
                }
            }
        }
        if(count($request->gizi)>0){
            for ($i=0; $i < count($request->gizi); $i++) {
                $gizi .= $request->gizi[$i].'+';
            }
        }
        if(count($request->status_psikologi)>0){
            for ($i=0; $i < count($request->status_psikologi); $i++) {
                $psikologi .= $request->status_psikologi[$i].'+';
            }
        }

        if($request->poli_rujuk!=''){
            $poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli',$request->poli_rujuk)->first();
            $idPoli = $poli->KodePoli;
            $namaPoli = $poli->NamaPoli;
        }else{
            $idPoli = NULL;
            $namaPoli = NULL;
        }

        $tekanan_darah = join('/',$request->tekanan_darah);

        $data = [
            'nama_perawat'=>$request->nama,
            'tekanan_darah'=>$request->tekanan_darah,
            'frek_nadi'=>$request->frek_nadi,
            'suhu'=>$request->suhu,
            'frek_nafas'=>$request->frek_nafas,
            'skor_nyeri'=>$request->skor_nyeri,
            'skor_jatuh'=>$request->skor_jatuh,
            'berat_badan'=>$request->berat_badan,
            'tinggi_badan'=>$request->tinggi_badan,
            'lingkar_kepala'=>$request->lingkar_kepala,
            'imt'=>$request->imt,
            'alat_bantu'=>$request->alat_bantu,
            'prothesa'=>$request->prothesa,
            'cacat_tubuh'=>$request->cacat_tubuh,
            'adi'=>$request->adi,
            'riwayat_jatuh'=>$request->riwayat_jatuh,
            'skrining_nyeri'=>$skrining,
            'status_psikologi'=>$psikologi,
            'hambatan'=>$hambatan,
            'agama'=>$request->agama,
            'agama_edu'=>$request->agama,
            'anutan'=>$request->agama,
            'pendidikan'=>$request->pendidikan,
            'pendidikan_edu'=>$request->pendidikan,
            'pekerjaan'=>$request->pekerjaan,
            'alergi'=>$request->alergi,
            'discharge'=>$request->discharge,
            'anamnesis'=>$request->anamnesis,
            'rencana_terapi'=>$request->rencana3,
            'kesan_gizi'=>$gizi,
            'diagnosa'=>$request->diagnosis3,
            'icd10'=>$request->icd103,
            'icd9'=>$request->icd93,
            'tindakan'=>$request->tindakan3,
            'poli_rujuk'=>$idPoli,
            'nama_poliRujuk'=>$namaPoli,
            'diruju_ke'=>$request->rujuk3,
            'jenis_kasus'=>$request->jenis_kasusnya,
        ];

        $in = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update($data);
        if($in){
            Session::flash('title','Successs');
            Session::flash('message','Rekap disimpan');
            Session::flash('type','success');
            return ['status'=>'success'];
        }else{
            return ['status'=>'error'];
        }
    }

    function pageSalinanResep(Request $request){
        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by=='No_Register'){
           $data=[
                'total' =>DB::connection('rsu')->table('tr_rawatjalanobat')->select('No_Register')->where('No_RM',Session::get('no_RM'))->distinct()->get(),
                'data' =>DB::connection('rsu')->table('tr_rawatjalanobat')->select('No_Register')->where('No_RM',Session::get('no_RM'))->limit($limit)->offset($offset)->distinct()->orderBy('No_Register','DESC')->get(),
                // 'total' =>DB::table('tr_rawatjalanobat')->select('No_Register')->distinct()->get(),
                // 'data' =>DB::table('tr_rawatjalanobat')->select('No_Register')->limit($limit)->offset($offset)->distinct()->get(),
            ];
        }else{
            if($request->by=='No_Register'){
                $data=[
                    'total' =>DB::connection('rsu')->table('tr_rawatjalanobat')->select('No_Register')->where('No_RM',Session::get('no_RM'))->where($request->by,'like','%'.$request->cariText.'%')->distinct()->get(),
                    'data' =>DB::connection('rsu')->table('tr_rawatjalanobat')->select('No_Register')->where('No_RM',Session::get('no_RM'))->where($request->by,'like','%'.$request->cariText.'%')->limit($limit)->offset($offset)->distinct()->orderBy('No_Register','DESC')->get(),
                    // 'total' =>DB::table('tr_rawatjalanobat')->select('No_Register')->where($request->by,'like','%'.$request->cariText.'%')->distinct()->get(),
                    // 'data' =>DB::table('tr_rawatjalanobat')->select('No_Register')->where($request->by,'like','%'.$request->cariText.'%')->limit($limit)->offset($offset)->distinct()->get(),
                ];
            }else{
                if($request->cariStatus==''){
                    $request->cariStatus=date('Y-m-d');
                }
                $tracer = DB::connection('rsu')->table('tr_tracer')->where($request->by,'like','%'.$request->cariStatus.'%')->get();
                $id_reg = [''];
                if(count($tracer)!=0){
                    $id_reg = [];
                    $i=0;
                    foreach ($tracer as $key) {
                        $id_reg[$i] = $key->No_Register;
                        $i++;
                    }
                }

                $data=[
                    'total' =>DB::connection('rsu')->table('tr_rawatjalanobat')->select('No_Register')->where('No_RM',Session::get('no_RM'))->whereIn('No_Register',$id_reg)->distinct()->get(),
                    'data' =>DB::connection('rsu')->table('tr_rawatjalanobat')->select('No_Register')->where('No_RM',Session::get('no_RM'))->whereIn('No_Register',$id_reg)->limit($limit)->distinct()->orderBy('No_Register','DESC')->get(),
                    // 'total' =>DB::table('tr_rawatjalanobat')->select('No_Register')->whereIn('No_Register',$id_reg)->distinct()->get(),
                    // 'data' =>DB::table('tr_rawatjalanobat')->select('No_Register')->whereIn('No_Register',$id_reg)->limit($limit)->distinct()->get(),
                ];
            }
        }
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    function detsalinanobat(Request $request){
        $obat = DB::connection('rsu')->table('tr_rawatjalanobat')->select('NamaBrg','Jml','Satuan','TS')->where('No_register',$request->data)->get();
        $tracer = DB::connection('rsu')->table('tr_tracer')->where('No_Register',$request->data)->first();
        $tg = '-';
        if(count($tracer)!=0){
            $tg = date('Y-m-d',strtotime($tracer->Tgl_Register));
        }
        return ['status'=>'success','dt'=>$obat,'i'=>$request->i,'tgl'=>$tg];
    }

    function pageRekapRJ(Request $request){
        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='tanggalKunjungan'){
           $data=[
                'total' =>DB::table('rekap_medik')->where('no_RM',Session::get('no_RM'))->orderBy('tanggalKunjungan','ASC')->get(),
                'data' =>DB::table('rekap_medik')
                    ->leftjoin('rekam_medis_lanjutan', 'rekap_medik.id_rekapMedik', 'rekam_medis_lanjutan.rekam_medis_id')
                    ->where('no_RM',Session::get('no_RM'))
                    ->orderBy('tanggalKunjungan','ASC')
                    ->limit($limit)
                    ->offset($offset)
                    ->get(),
            ];
        }else{
            if($request->by=='tanggalKunjungan'){
                $data=[
                    'total' =>DB::table('rekap_medik')->where('no_RM',Session::get('no_RM'))->where($request->by,'like','%'.$request->cariStatus.'%')->orderBy('tanggalKunjungan','ASC')->get(),
                    'data' =>DB::table('rekap_medik')
                        ->leftjoin('rekam_medis_lanjutan', 'rekap_medik.id_rekapMedik', 'rekam_medis_lanjutan.rekam_medis_id')
                        ->where('no_RM',Session::get('no_RM'))
                        ->where($request->by,'like','%'.$request->cariStatus.'%')
                        ->orderBy('tanggalKunjungan','ASC')
                        ->limit($limit)
                        ->offset($offset)
                        ->get(),
                ];
            }else{
                $data=[
                    'total' =>DB::table('rekap_medik')->where('no_RM',Session::get('no_RM'))->where($request->by,'like','%'.$request->cariText.'%')->orderBy('tanggalKunjungan','ASC')->get(),
                    'data' =>DB::table('rekap_medik')
                        ->leftjoin('rekam_medis_lanjutan', 'rekap_medik.id_rekapMedik', 'rekam_medis_lanjutan.rekam_medis_id')
                        ->where('no_RM',Session::get('no_RM'))
                        ->where($request->by,'like','%'.$request->cariText.'%')
                        ->orderBy('tanggalKunjungan','ASC')
                        ->limit($limit)
                        ->offset($offset)
                        ->get(),
                ];
            }
        }
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    public function modalDetRekap(Request $request){
        $data['rekap'] = DB::table('rekap_medik')->where('id_rekapMedik',$request->id)->first();
        $data['tr_resep'] = DB::table('tr_resep_m as trm')
            ->select(
                'trm.No_Register as No_Register',
                'trm.No_Resep as No_Resep',
                'trd.No_Register as noRegister',
                'trd.No_Resep as noResep',
                'trd.NamaBrg as NamaBrg',
                'trd.Jumlah as Jumlah',
                'trd.Satuan as Satuan'
            )
            ->leftJoin('tr_resep_d as trd','trd.No_Resep','trm.No_resep')
            ->where('trm.No_Register',$data['rekap']->no_Register)->get();
        $data['tr_rajalobat'] = DB::connection('rsu')->table('tr_rawatjalanobat')
            ->select('No_Register', 'NamaBrg', 'Jml', 'Satuan')
            ->where('No_Register',$data['rekap']->no_Register)->get();
        $data['tr_racikan'] = DB::table('tr_resep_racikan_m as trrm')
            ->select(
                'trrm.No_Register as No_Register',
                'trrm.No_Resep as No_Resep',
                'trrd.No_Resep as noResep',
                'trrd.NamaBrg as NamaBrg',
                'trrd.Satuan as Satuan',
                'trrd.Jumlah as Jumlah',
            )
            ->leftJoin('tr_resep_racikan_d as trrd','trrd.No_Resep','trrm.No_resep')
            ->where('trrm.No_Register',$data['rekap']->no_Register)->get();
        $content = view('dokter.pages.modal.detailRekapRJ',$data)->render();
        return ['status'=>'success','content'=>$content];
    }

    public function simpanRujuk(Request $request){
      // return $request->all();
      $rm = DB::table('rekap_medik')->where('id_rekapMedik',$request->id_rekap)->first();

      $poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli',$request->poli)->first();
      $idPoli = $poli->KodePoli;
      $namaPoli = $poli->NamaPoli;

      $data = [
        'rekapMedik_id'=>$rm->id_rekapMedik,
        'KodePoli'=>$idPoli,
        'NamaPoli'=>$namaPoli,
        'Rujuk'=>$request->rujuk,
        'DariKodePoli'=>$rm->KodePoli,
        'DariPoli'=>$rm->NamaPoli,
        'DariKodeDokter'=>$rm->KodeDokter,
        'DariDokter'=>$rm->NamaDokter,
        'NamaPasien'=>$rm->Nama_Pasien
      ];

      $in = DB::table('rujukan_rm')->insert($data);
      if($in){
        $ret = [
          'status'=>'success'
        ];
      }else{
        $ret = [
          'status'=>'failed'
        ];
      }
      return $ret;
    }

    public function hapusRujuk(Request $request){
        $in = DB::table('rujukan_rm')->where('id_rujukan',$request->id)->delete();
        if($in){
            $ret = [
                'status'=>'success'
            ];
        }else{
            $ret = [
                'status'=>'failed'
            ];
        }
        return $ret;
    }

    function simpanTahap4(Request $request){
        // return $request->all();
        $kesKomunikasi = $request->kesulitan_komunikasi;
        $bahasa = '';
        $penterjemah = $request->penterjemah;
        $hambatan = '';
        $program = '';
        $yang_edu = '';
        $metode_edu = '';
        $respon_edu = '';
        $keterbatasan_fisik = '';

        if(!empty($request->yang_edu)){
            for ($i=0; $i < count($request->yang_edu); $i++) {
                $yang_edu .=$request->yang_edu[$i].'+';
            }
        }

        if(!empty($request->metode_edu)){
            for ($i=0; $i < count($request->metode_edu); $i++) {
                $metode_edu .=$request->metode_edu[$i].'+';
            }
        }

        if(!empty($request->respon_edu)){
            for ($i=0; $i < count($request->respon_edu); $i++) {
                $respon_edu .=$request->respon_edu[$i].'+';
            }
        }

        if(!empty($request->program)){
            for ($i=0; $i < count($request->program); $i++) {
                if($request->program[$i]=='lainnya'){
                    $program .=$request->edukasi_lain.'+';
                } else{
                    $program .=$request->program[$i].'+';
                }
            }
        }

        if(!empty($request->hambatan)){
            for ($i=0; $i < count($request->hambatan); $i++) {
                if($request->hambatan[$i]=='lainnya'){
                    $hambatan .=$request->hambatan_lain.'+';
                } else{
                    $hambatan .=$request->hambatan[$i].'+';
                }
            }
        }

        if($request->kesulitan_komunikasi=='Ada'){
            $kesKomunikasi = $request->kesulitan_komunikasi_lain;
        }

        if(!empty($request->bahasa_dipakai)){
            for ($i=0; $i < count($request->bahasa_dipakai); $i++) {
                if($request->bahasa_dipakai[$i]=='Bahasa_lainnya'){
                    $bahasa .=$request->bahasa_dipakai_lain.'+';
                } else{
                    $bahasa .=$request->bahasa_dipakai[$i].'+';
                }
            }
        }

        // if($request->penterjemah=='lainnya'){
            $penterjemah = $request->penterjemah_lain;
        // }

        $data = [
            'nama_panggilan'=>$request->nama_panggilan,
            'agama_edu'=>$request->agama_edu,
            'anutan'=>$request->anutan,
            'pendidikan_edu'=>$request->pendidikan_edu,
            'komunikasi'=>$kesKomunikasi,
            'bahasa_edu'=>$bahasa,
            'penterjemah'=>$penterjemah,
            'hambatan_edu'=>$hambatan,
            'kesediaan'=>$request->kesediaan,
            'program'=>$program,
            'materi_edu'=>$request->materi_edu,
            'yang_edu'=>$yang_edu,
            'metode_edu'=>$metode_edu,
            'respon_edu'=>$respon_edu,
        ];
        // return ['data' => $data, 'request' => $request->all()];

        if(!empty($request->keterbatasan_fisik)){
            foreach ($request->keterbatasan_fisik as $v) {
                if ($v == 'N') {
                    $keterbatasan_fisik = $v;
                    break;
                } else {
                    if ($v == 'Lainnya') {
                        $keterbatasan_fisik .= $request->keterbatasan_lainnya;
                    } else {
                        $keterbatasan_fisik .= $v;
                    }
                    $keterbatasan_fisik.='+';
                }
            }
        }

        $data2 = [
            'rekam_medis_id'=> Session::get('id_rekap'),
            'mampu_belajar_edu'=> $request->mampu_belajar,
            'mampu_baca_tulis_edu'=>$request->mampu_baca_tulis,
            'bhs_isyarat_edu'=>$request->bhs_isyarat,
            'tipe_pembelajaran_edu'=>$request->tipe_pembelajaran,
            'hambatan_emosional_edu'=>$request->hambatan_emosional,
            'keterbatasan_fisik_edu'=>$keterbatasan_fisik,
        ];

        $error_in = 0;
        $message_in = "";

        try {
            $in = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->update($data);
        } catch (\Exception $e) {
            $error_in += 1;
            $message_in .= json_encode($e->getMessage(), true);
        }

        if($error_in == 0 ){
            $get = DB::table('rekam_medis_lanjutan')->where('rekam_medis_id', Session::get('id_rekap'))->first();
            if (empty($get)) {
                try {
                    $in2 = DB::table('rekam_medis_lanjutan')->insert($data2);
                } catch (\Exception $th) {
                    $error_in += 1;
                    $message_in .= json_encode($th->getMessage(), true);
                }
            } else {
                try{
                    $in2 = DB::table('rekam_medis_lanjutan')
                        ->where('id', $get->id)
                        ->update($data2);
                } catch (\Exception $th) {
                    $error_in += 1;
                    $message_in .= json_encode($th->getMessage(), true);
                }
            }
        }

        // if($in || $in2){
        if($error_in == 0){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error' , 'message'=>$message_in];
        }
    }

    public function simpanEdu(Request $request){
        if(isset($request->id_rekap)){
            $id = $request->id_rekap;
        }else{
            $id = Session::get('id_rekap');
        }
        $data = [
            'rekapMedik_id'=>$id,
            'edukasi_ke'=>$request->yang,
            'metode_edukasi'=>$request->metode,
            'sarana_edukasi'=>$request->sarana,
            'response_edukasi'=>$request->response,
            'materi_edukasi'=>$request->materi,
            'edukator'=>$request->edukator,
            'disiplin'=>$request->disiplin,
        ];
        $insert = DB::table('edukasi_rm')->insert($data);
        if($insert){
            return ['status'=>'success'];
        }else{
            return ['sttaus'=>'error'];
        }
    }

    public function hapusEdukasi(Request $request){
        // return $request->all();
        $delete = DB::table('edukasi_rm')->where('id_edukasi',$request->id)->delete();
        if($delete){
            return ['status'=>'success'];
        }else{
            return ['sttaus'=>'error'];
        }
    }

    function pageRadio(Request $request){
        // return $request->all();
        $dbcon = pg_connect("host='192.168.1.172' user='postgres' password='postgres5432' dbname='dicom'");
        $rm = strtoupper(Session::get('no_RM'));
        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='imagedate'){
            $query = "SELECT * FROM dicomimages WHERE imagepat = '$rm' ORDER BY imagedate DESC limit $limit offset ".$offset;
            $querytot = "SELECT * FROM dicomimages WHERE imagepat = '$rm'";
        }else{
            if($request->by=='imagedate'){
                $tgl = ''.date('Ymd',strtotime($request->cariStatus)).'';
                $query = "SELECT * FROM dicomimages WHERE imagepat='$rm' AND $request->by ='".$tgl."' ORDER BY imagedate DESC limit $limit offset ".$offset;
                $querytot = "SELECT * FROM dicomimages WHERE imagepat='$rm' AND $request->by ='".$tgl."'";
            }else{
                $query = "SELECT * FROM dicomimages WHERE imagepat='$rm' AND $request->by like '%".$request->cariText."%' ORDER BY imagedate DESC limit $limit offset ".$offset;
                $querytot = "SELECT * FROM dicomimages WHERE imagepat='$rm' AND $request->by like '%".$request->cariText."%'";
            }
        }
        // return $query;
        $result = pg_query($dbcon, $query) or die("Query gagal  " );
        $datatot = pg_num_rows ($result);
        $resulttot = pg_query($dbcon, $querytot) or die("Query gagal  " );
        $total = pg_num_rows ($resulttot);
        $i = 0;
        $data = [];
        while ($result1= pg_fetch_array($result)) {
            $data[$i] = $result1;
            $i++;
        }

        $data = [
            'datatot'=>$datatot,
            'data'=>$data,
            'total'=>$total,
        ];
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }

    function ask(Request $request){
        return 'Hello World';
    }

    function pageLab(Request $request){
        // return $request->all();
        $dbcon = pg_connect("host='192.168.1.172' user='postgres' password='postgres5432' dbname='lims2'");
        $rm = Session::get('no_RM');
        $limit = 10;
        $offset = ($request->i-1)*$limit;
        if($request->cariText=='' && $request->by!='periksa_tgl'){
            $query = "
                SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                c.nama as nama_lab
                FROM tab_lab_master as a
                JOIN tab_lab_detil as b ON b.id_master=a.id
                JOIN tab_kdlab as c ON c.id=b.id_lab
                WHERE a.no_rm = '".Session::get('no_RM')."'
                ORDER BY a.periksa_tgl DESC
                LIMIT $limit
                OFFSET $offset
            ";
            $querytot = "
                SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                c.nama as nama_lab
                FROM tab_lab_master as a
                JOIN tab_lab_detil as b ON b.id_master=a.id
                JOIN tab_kdlab as c ON c.id=b.id_lab
                WHERE a.no_rm = '".Session::get('no_RM')."'
                ORDER BY a.periksa_tgl DESC
            ";
        }else{
            if($request->by=='periksa_tgl'){
                $tgl = "".date('Y-m-d',strtotime($request->cariStatus))."";
                $query = "
                    SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                    b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                    c.nama as nama_lab
                    FROM tab_lab_master as a
                    JOIN tab_lab_detil as b ON b.id_master=a.id
                    JOIN tab_kdlab as c ON c.id=b.id_lab
                    WHERE a.no_rm = '".Session::get('no_RM')."'
                    AND DATE($request->by) = '$tgl'
                    ORDER BY a.periksa_tgl DESC
                    LIMIT $limit
                    OFFSET $offset
                ";

                $querytot = "
                    SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                    b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                    c.nama as nama_lab
                    FROM tab_lab_master as a
                    JOIN tab_lab_detil as b ON b.id_master=a.id
                    JOIN tab_kdlab as c ON c.id=b.id_lab
                    WHERE a.no_rm = '".Session::get('no_RM')."'
                    AND DATE($request->by) = '$tgl'
                    ORDER BY a.periksa_tgl DESC
                ";
            }else{
                if($request->by=='nama_lab'){
                    $request->by='c.nama';
                }
                $query = "
                    SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                    b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                    c.nama as nama_lab
                    FROM tab_lab_master as a
                    JOIN tab_lab_detil as b ON b.id_master=a.id
                    JOIN tab_kdlab as c ON c.id=b.id_lab
                    WHERE a.no_rm = '".Session::get('no_RM')."'
                    AND $request->by like '%$request->cariText%'
                    ORDER BY a.periksa_tgl DESC
                    LIMIT $limit
                    OFFSET $offset
                ";

                $querytot = "
                    SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                    b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                    c.nama as nama_lab
                    FROM tab_lab_master as a
                    JOIN tab_lab_detil as b ON b.id_master=a.id
                    JOIN tab_kdlab as c ON c.id=b.id_lab
                    WHERE a.no_rm = '".Session::get('no_RM')."'
                    AND $request->by like '%$request->cariText%'
                    ORDER BY a.periksa_tgl DESC
                ";
            }
        }
        // return $query;
        $result = pg_query($dbcon, $query) or die("Query gagal  " );
        $datatot = pg_num_rows ($result);
        $resulttot = pg_query($dbcon, $querytot) or die("Query gagal  " );
        $total = pg_num_rows ($resulttot);
        $i = 0;
        $data = [];
        while ($result1= pg_fetch_array($result)) {
            $data[$i] = $result1;
            $i++;
        }

        $data = [
            'datatot'=>$datatot,
            'data'=>$data,
            'total'=>$total,
        ];
        return ['status'=>'success','data'=>$data,'i'=>$request->i];
    }


    function diagnosaUp(Request $request){
        // return 'Asik';
        $diag = DB::connection('rsu')->table('tm_diagnosa_bpjs')
        ->where('Diagnosa','like','%'.$request->data.'%')
        ->orWhere('KodeICD','like','%'.$request->data.'%')->limit(100)->get();
        return ['status'=>'success','data'=>$diag];
    }

    function tindakanUp(Request $request){
        $tind = DB::table('refprocedure')
            ->where('Description','like','%'.$request->data.'%')
            ->orWhere('Code','like','%'.$request->data.'%')->limit(100)->get();
        return ['status'=>'success','data'=>$tind];
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

    function cari_pertanyaan(Request $request){
      $tanya = $request->tanya;
      $pertanyaan = DB::table('rujukan_rm')->where('Rujuk','like','%'.$tanya.'%')->distinct()->limit(10)->get();
      return ['status'=>'success','data'=>$pertanyaan];
    }

    public function getKasusBaru(Request $request)
    {
        $dt1 = DB::table('rekap_medik')
            ->where('no_RM',$request->rm)
            ->orderBy('tanggalKunjungan', 'DESC')
            ->get();
        $data = DB::table('rekam_medis_lanjutan')
            ->where('rekam_medis_id', $dt1[0]->id_rekapMedik)
            // ->where('rekam_medis_id', $dt1->id_rekapMedik)
            ->first();
            
        $dt1_ = [];
        $dt2 = [];

        foreach (collect($data)->toArray() as $key => $value) {
            if(is_string($value) || $value == null){
                if($key == "daftar_melalui" || $key == "kategori_pembayaran" || $key == "suku" || $key == "status_pernikahan"){
                    $dt2[$key] = $data->$key;
                }elseif($key == "status_gizi"){
                    $dt2[$key] = "Baik";
                }elseif($key == "pengkajian_nyeri"){
                    $dt2[$key] = "0";
                }elseif($key == "status_psikologi"){
                    $dt2[$key] = "Tenang+";
                }elseif($key == "risiko_jatuh"){
                    $dt2[$key] = "N+N+Tidak";
                }else{
                    $dt2[$key] = "";
                }
            }elseif(is_numeric($value)){
                if($key == 'id'){
                    $dt2[$key] = null;
                }else{
                    $dt2[$key] = 0;
                }
            }
        }
        
        foreach (collect($dt1[0])->toArray() as $key => $value) {
            if(is_string($value)){
                if($key == 'no_RM' || $value == null){
                    $dt1_[$key] = $request->rm;
                }elseif($key == 'status_psikologi'){
                    $dt1_[$key] = "Tenang+";
                }elseif($key == 'pendidikan' || $key == "pekerjaan"){
                    $dt1_[$key] = $dt1[0]->$key;
                }elseif($key == 'no_Register'){
                    $dt1_[$key] = $dt1[0]->no_Register;
                }elseif($key == 'tanggalKunjungan'){
                    $dt1_[$key] = $dt1[0]->tanggalKunjungan;
                }elseif($key == 'tanggalPengerjaan'){
                    $dt1_[$key] = $dt1[0]->tanggalPengerjaan;
                }else{
                    $dt1_[$key] = "";
                }
            }elseif(is_numeric($value)){
                if($key == 'id_rekapMedik'){
                    $dt1_[$key] = null;
                }elseif($key == 'noUrut'){
                    $dt1_[$key] = $dt1[0]->noUrut;
                }else{
                    $dt1_[$key] = 0;
                }
            }
        }

        // return ['data1'=> $dt1, 'data2'=> $data];
        return ['data1'=> $dt1_, 'data2'=> $dt2];
    }

    public function getKasusLama(Request $request)
    {
        $dt1 = DB::table('rekap_medik')
            ->where('no_RM',$request->rm)
            ->orderBy('tanggalKunjungan', 'DESC')
            ->get();

        if(!isset($dt1[1])){
            return ['status' => 'error'];
        }

        $dt2 = DB::table('rekam_medis_lanjutan')
            ->where('rekam_medis_id', $dt1[1]->id_rekapMedik)
            ->first();

        return ['data1'=> $dt1[1], 'data2'=> $dt2, 'status' => 'success'];
    }

    public function getKasusSaatIni(Request $request)
    {
        $dt1 = DB::table('rekap_medik')
            ->where('no_RM',$request->rm)
            ->orderBy('tanggalKunjungan', 'DESC')
            ->get();

        if(!isset($dt1[0])){
            return ['status' => 'error'];
        }

        $dt2 = DB::table('rekam_medis_lanjutan')
            ->where('rekam_medis_id', $dt1[0]->id_rekapMedik)
            ->first();

        return ['data1'=> $dt1[0], 'data2'=> $dt2, 'status' => 'success'];
    }

    public function membatalkanEdit()
    {
        $dataOld = Session::get('dataTindakan');
        $dataOld_d = Session::get('dataTindakan_d');

        $proses = $this->ProsesBatalEdit($dataOld, $dataOld_d);

        if($proses){
            Session::forget('dataTindakan');
            Session::forget('dataTindakan_d');
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }

    public function membatalkanPengerjaan(Request $request)
    {
        $noRegister = $request->noRegister;
        $proses = $this->ProsesBatalMengerjakan($noRegister);

        if($proses){
            Session::forget('dataTindakan');
            Session::forget('dataTindakan_d');
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }
}
