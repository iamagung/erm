<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

trait TarifDanTindakan{

    public function GenerateNoTindakan($data_dokter, $data_rekap)
    {
        $dataUntukNoTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan')
            ->where('No_RM', $data_rekap->no_RM)
            ->where('KodePoli', $data_dokter->poli_id)
            ->where('No_Register', $data_rekap->no_Register)
            ->where('NoTindakan', 'like',"%". $data_dokter->poli_id . substr(date('Y'),2) ."%")
            ->where('Tgl', 'like',"%". date('Y') ."%")
            ->orderBy('Tgl', 'DESC')
            ->first();
        //jika nomor tindakan pasien sudah ada maka pakai yang lama
        if(!empty($dataUntukNoTindakan)){
            return substr($dataUntukNoTindakan->NoTindakan,-6);
        }
        
        //menggenerate nomor tindakan yang baru
        if(empty($dataUntukNoTindakan)){
            $data= [];
            $newDataUntukNoTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan')
                ->where('KodePoli', $data_dokter->poli_id)
                ->where('NoTindakan', 'like',"%". $data_dokter->poli_id . substr(date('Y'),2) ."%")
                ->where('Tgl', 'like',"%". date('Y') ."%")
                ->orderBy('Tgl', 'DESC')
                ->limit(100)
                ->get();
            foreach ($newDataUntukNoTindakan as $k => $v) {
                array_push($data, $v->NoTindakan);
            }
            
            if(count($data) > 0){
                $newDataUntukNoTindakan = max($data);
            }else{
                $newDataUntukNoTindakan = 0;
            }

            //validasi untuk nomor tindakan yang baru saja digenerate
            if(!empty($newDataUntukNoTindakan)){
                $generateNo = substr($newDataUntukNoTindakan,-6) + 1;
                $unik = $data_dokter->poli_id . substr(date('Y'),2) . str_pad($generateNo, 6 ,"0",STR_PAD_LEFT);

                $dataUnik = [];
                $cekData = DB::connection('rsu')->table('tr_rawatjalantindakan')
                    ->where('KodePoli', $data_dokter->poli_id)
                    ->where('NoTindakan', $unik)
                    ->where('Tgl', 'like',"%". date('Y') ."%")
                    ->orderBy('Tgl', 'DESC')
                    ->get();
                    
                if(count($cekData) < 1){
                    return $generateNo;
                }else{
                    foreach ($cekData as $k => $v) {
                        array_push($dataUnik, $v->NoTindakan);
                    }
                    if(count($dataUnik) > 0){
                        $newUnik = max($dataUnik);
                    }else{
                        $newUnik = 0;
                    }
                    return substr($newUnik,-6) + 1;
                }
            }else{
                return 1;
            }
        }
    }

    public function GenerateNoTindakanNew($data_dokter, $data_rekap)
    {
        $dataUntukNoTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan')
            ->where('No_RM', $data_rekap->no_RM)
            ->where('KodePoli', $data_dokter->poli_id)
            ->where('No_Register', $data_rekap->no_Register)
            ->where('Tgl', 'like',"%". date('Y') ."%")
            ->orderBy('Tgl', 'DESC')
            ->first();
        //jika nomor tindakan pasien sudah ada maka pakai yang lama
        if(!empty($dataUntukNoTindakan)){
            return substr($dataUntukNoTindakan->NoTindakan,-6);
        }
        //menggenerate nomor tindakan yang baru
        if(empty($dataUntukNoTindakan)){
            $data= [];
            $newDataUntukNoTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan')
                ->where('KodePoli', $data_dokter->poli_id)
                ->where('NoTindakan', 'like',"%". $data_dokter->poli_id . substr(date('Y'),2) ."%")
                ->where('Tgl', 'like',"%". date('Y') ."%")
                ->orderBy('Tgl', 'DESC')
                // ->orderBy('NoTindakan', 'DESC')
                ->limit(100)
                ->get();
            foreach ($newDataUntukNoTindakan as $k => $v) {
                array_push($data, $v->NoTindakan);
            }
            $newDataUntukNoTindakan = max($data);
        }

        if(!empty($newDataUntukNoTindakan)){
            return substr($newDataUntukNoTindakan,-6) + 1;
        }else{
            return 1;
        }
    }

    public function GenerateNoRawatJL($data_rekap)
    {
        $dataUntukNoRawatJL = DB::connection('rsu')->table('tr_rawatjalantindakan')
            ->where('No_RM', $data_rekap->no_RM)
            ->where('No_Register', $data_rekap->no_Register)
            ->where('No_RawatJL', 'like',"%". substr(date('Ymd'),2) ."%")
            ->where('Tgl', 'like',"%". date('Y-m-d') ."%")
            ->orderBy('Tgl', 'DESC')
            ->first();
        //jika nomor tindakan pasien sudah ada maka pakai yang lama
        if(!empty($dataUntukNoRawatJL)){
            return substr($dataUntukNoRawatJL->NoTindakan,-3);
        }

        if(empty($dataUntukNoRawatJL)){
            //menggenerate nomor tindakan yang baru
            $dataUntukNoRawatJL = DB::connection('rsu')->table('tr_rawatjalantindakan')
            ->where('No_RawatJL', 'like',"%". substr(date('Ymd'),2) ."%")
            ->where('Tgl', 'like',"%". date('Y-m-d') ."%")
            ->orderBy('Tgl', 'DESC')
            ->first();
        }

        if(!empty($dataUntukNoRawatJL)){
            return substr($dataUntukNoRawatJL->NoTindakan,-3) + 1;
        }else{
            return 1;
        }
    }

    public function SimpanTarifDanTindakan($request, $data_rekap, $data_dokter, $nomorUnik, $nomorUnikRJ, $no_urut, $GT, $tr_registrasi)
    {
        $simpan = false;
        $simpan2 = false;
        //data diagnosa
        $namaDiagnosa = explode(';', $data_rekap->diagnosa);
        $diagnosa = explode(';', $data_rekap->icd10);

        $validasiTotalData = count($request->nama_tindakan) * 2;
        $looping = 0;

        $deleteSemuaTindakan = $this->DeleteSemuaTarifDanTindakan($data_rekap->no_Register);

        // return $request->nama_tindakan;
        $data_tindakan_d = [];
        foreach($request->nama_tindakan as $key => $nt){
            $data_tindakan = [
                "No_Register" => $data_rekap->no_Register,
                "NoTindakan" => $request->kode_poli[$key] . substr(date('Y'),2) . str_pad($nomorUnik, 6 ,"0",STR_PAD_LEFT),
                // "NoTindakan" => $nomorUnik,
                "NoUrut" => $no_urut++,
                "Tgl" => date("Y-m-d"),
                "No_RawatJL" => $nomorUnikRJ,
                "No_RM" => $data_rekap->no_RM,
                "KodeTindakan" => $request->kode_tindakan[$key],
                "NamaTindakan" => $nt,
                "TarifTindakan" => $request->tarif_tindakan[$key],
                "Jml" => 1,
                "Total" => $request->tarif_tindakan[$key],
                "KodeGD" => $request->kode_poli[$key],
                "Dokter" => $data_dokter->Nama_Dokter,
                "KodePoli" => $request->kode_poli[$key],
                "KodeLoket" => "",
                "KodeAss" => $tr_registrasi->Kode_Ass,
                "Kasir" => "",
                "GT" => $GT,
                "GTPPN" => "",
                "GTNilai" => $GT,
                "Dibayar" => "N",
                "PoliRujukan" => "",
                "NoBayar" => "",
                "Japel" => "", //di isi ketika menyimpan tr_rawatjalantindakan_d
                "JRS" => "", //di isi ketika menyimpan tr_rawatjalantindakan_d
                "NoSEP" => $tr_registrasi->NoSEP,
                "DiagnosaPrimer" => isset($diagnosa[0]) ? $diagnosa[0] : "",
                "Diagnosa1" => isset($diagnosa[1]) ? $diagnosa[1] : "",
                "Diagnosa2" => isset($diagnosa[2]) ? $diagnosa[2] : "",
                "Diagnosa3" => isset($diagnosa[3]) ? $diagnosa[3] : "",
                "Diagnosa4" => isset($diagnosa[4]) ? $diagnosa[4] : "",
                "Diagnosa5" => isset($diagnosa[5]) ? $diagnosa[5] : "",
                "NamaDiagnosa1" => isset($namaDiagnosa[1]) ? strtoupper($namaDiagnosa[1]) : "",
                "NamaDiagnosa2" => isset($namaDiagnosa[2]) ? strtoupper($namaDiagnosa[2]) : "",
                "NamaDiagnosa3" => isset($namaDiagnosa[3]) ? strtoupper($namaDiagnosa[3]) : "",
                "NamaDiagnosa4" => isset($namaDiagnosa[4]) ? strtoupper($namaDiagnosa[4]) : "",
                "NamaDiagnosa5" => isset($namaDiagnosa[5]) ? strtoupper($namaDiagnosa[5]) : "",
                "NamaDiagnosaPrimer" => isset($namaDiagnosa[0]) ? strtoupper($namaDiagnosa[0]) : "",
                "NoPeserta" => $tr_registrasi->NoPeserta,
                "NamaAsuransi" => $tr_registrasi->NamaAsuransi,
                "NoKuitansi" => "",
                "TS" => date("Y-m-d H:i:s"),
            ];
            // //prose simpan tindakan tr_tindakan_m/tr_tindakan_m_ ke table tr_rawatjalantindakan
            $simpan = DB::connection('rsu')->table('tr_rawatjalantindakan')->insert($data_tindakan);

            //get tindakan_d
            $get_tindakan_d = DB::connection('rsu')->table('tr_tindakan_d')->where('KodeTindakan', $request->kode_tindakan[$key])->get();
            //cek jika tindakan_d kosong maka ambil tindakan_d_
            //sementara dimatikan karena hanya menggunakan tr_tindakan_d saja
            // if(empty($get_tindakan_d)){
            //     $get_tindakan_d = DB::connection('rsu')->table('tr_tindakan_d_')->where('KodeTindakan', $request->kode_tindakan[$key])->get();
            // }

            $deleteSemuaRawatJalanTindakan_d = DB::connection('rsu')->table('tr_rawatjalantindakan_d')
                ->whereIn('NoRegister', [$data_rekap->no_Register])
                ->delete();

            //proses simpan tindakan_d / tindakan_d_ ke table tr_rawatjalantindakan_d
            if(!empty($get_tindakan_d)){
                if($looping < $validasiTotalData){
                    foreach ($get_tindakan_d as $no => $gtd) {
                        $looping++;
                        $data_tindakan_d[] = [
                            "NoTindakan" => $request->kode_poli[$key] . substr(date('Y'),2) . str_pad($nomorUnik, 6 ,"0",STR_PAD_LEFT),
                            // "NoTindakan" => $nomorUnik,
                            "Tgl" => date("Y-m-d"),
                            "NoUrut" => $gtd->NoUrut,
                            "NoRegister" => $data_rekap->no_Register,
                            "NoRawatJL" => $nomorUnikRJ, //backup lama = substr(date('Ymd'),2) . str_pad($nomorUnikRJ, 3 ,"0",STR_PAD_LEFT)
                            "KodeTindakan" => $request->kode_tindakan[$key],
                            "KodeBrg" => $gtd->KodeBrg,
                            "NamaBrg" => $gtd->NamaBrg,
                            "Jumlah" => $gtd->Jumlah,
                            "Satuan" => $gtd->Satuan,
                            "Konv" => $gtd->Konv,
                            "Total" => "",
                            "JmlTotal" => $gtd->Jumlah * $gtd->Konv,
                            "JmlEdit" => $gtd->Jumlah,
                            "Harga" => $gtd->Harga,
                            "TotalHargaPaket" => "", //memang kosong karena didbkosong
                            "TotalNilai" => $gtd->Harga * ($gtd->Jumlah * $gtd->Konv),
                            "KodeGD" => $request->kode_poli[$key],
                            "KodeAss" => $tr_registrasi->Kode_Ass,
                            "TglBeli" => "", //memang kosong karena didbkosong
                            "TotalVIP" => "", //memang kosong karena didbkosong
                            "HargaVIP" => "", //memang kosong karena didbkosong
                        ];
                    }
                }
            }
        }

        if($looping == count($data_tindakan_d)){
            $resetTotalTindakan = DB::connection('rsu')->table('tm_rawatjalan')->where('No_Register', $data_rekap->no_Register)->update(['TotalTindakan'=>0]);
            $simpan2 = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->insert($data_tindakan_d);
        }

        return [$simpan, $simpan2];
    }

    public function DeleteSemuaTarifDanTindakan($noRegistrasi)
    {
        $deleteTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->whereIn('NoRegister', [$noRegistrasi])->delete();
        $deleteTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan')->whereIn('No_Register', [$noRegistrasi])->delete();

        return $deleteTindakan;
    }

    public function ProsesBatalMengerjakan($noRegistrasi)
    {
        //check apakah ada tindakan atau tidak 
        $tindakan = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->where('NoRegister', $noRegistrasi)->get();
        if(count($tindakan) > 0){
            $deleteTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->whereIn('NoRegister', [$noRegistrasi])->delete();
            $deleteTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan')->whereIn('No_Register', [$noRegistrasi])->delete();
        }else{
            return true;
        }

        return $deleteTindakan;
    }

    public function ProsesBatalEdit($dataOld, $dataOld_d)
    {
        if( is_array(json_decode($dataOld)) && is_array(json_decode($dataOld)) ){
            //delete semua data yang ditable
            $deleteTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->whereIn('NoRegister', [$dataOld[0]->No_Register])->delete();
            $deleteTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan')->whereIn('No_Register', [$dataOld[0]->No_Register])->delete();
            
            //insert datalama yang telah disimpan disession
            foreach(json_decode($dataOld) as $kdo => $do){
                try {
                    $simpanOld = DB::connection('rsu')->table('tr_rawatjalantindakan')->insert([
                        "No_Register" => $do->No_Register,
                        "NoTindakan" => $do->NoTindakan,
                        "NoUrut" => $do->NoUrut,
                        "Tgl" => $do->Tgl,
                        "No_RawatJL" => $do->No_RawatJL,
                        "No_RM" => $do->No_RM,
                        "KodeTindakan" => $do->KodeTindakan,
                        "NamaTindakan" => $do->NamaTindakan,
                        "TarifTindakan" => $do->TarifTindakan,
                        "Jml" => $do->Jml,
                        "Total" => $do->Total,
                        "KodeGD" => $do->KodeGD,
                        "Dokter" => $do->Dokter,
                        "KodePoli" => $do->KodePoli,
                        "KodeLoket" => "",
                        "KodeAss" => $do->KodeAss,
                        "Kasir" => "",
                        "GT" => $do->GT,
                        "GTPPN" => "",
                        "GTNilai" => $do->GTNilai,
                        "Dibayar" => $do->Dibayar,
                        "PoliRujukan" => "",
                        "NoBayar" => "",
                        "Japel" => "",
                        "JRS" => "",
                        "NoSEP" => $do->NoSEP,
                        "DiagnosaPrimer" => $do->DiagnosaPrimer,
                        "Diagnosa1" => $do->Diagnosa1,
                        "Diagnosa2" => $do->Diagnosa2,
                        "Diagnosa3" => $do->Diagnosa3,
                        "Diagnosa4" => $do->Diagnosa4,
                        "Diagnosa5" => $do->Diagnosa5,
                        "NamaDiagnosa1" => $do->NamaDiagnosa1,
                        "NamaDiagnosa2" => $do->NamaDiagnosa2,
                        "NamaDiagnosa3" => $do->NamaDiagnosa3,
                        "NamaDiagnosa4" => $do->NamaDiagnosa4,
                        "NamaDiagnosa5" => $do->NamaDiagnosa5,
                        "NamaDiagnosaPrimer" => $do->NamaDiagnosaPrimer,
                        "NoPeserta" => $do->NoPeserta,
                        "NamaAsuransi" => $do->NamaAsuransi,
                        "NoKuitansi" => "",
                        "TS" => $do->TS,
                    ]);
                } catch (\Exception $e) {
                    return $e;
                }
            }
            foreach (json_decode($dataOld_d) as $kdod => $dod) {
                try {
                    $simpanOld_d = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->insert([
                        "NoTindakan" => $dod->NoTindakan,
                        "Tgl" => $dod->Tgl,
                        "NoUrut" => $dod->NoUrut,
                        "NoRegister" => $dod->NoRegister,
                        "NoRawatJL" => $dod->NoRawatJL,
                        "KodeTindakan" => $dod->KodeTindakan,
                        "KodeBrg" => $dod->KodeBrg,
                        "NamaBrg" => $dod->NamaBrg,
                        "Jumlah" => $dod->Jumlah,
                        "Satuan" => $dod->Satuan,
                        "Konv" => $dod->Konv,
                        "Total" => $dod->Total,
                        "JmlTotal" => $dod->Jumlah,
                        "JmlEdit" => $dod->Jumlah,
                        "Harga" => $dod->Harga,
                        "TotalHargaPaket" => $dod->TotalHargaPaket,
                        "TotalNilai" => $dod->TotalNilai,
                        "KodeGD" => $dod->KodeGD,
                        "KodeAss" => $dod->KodeAss,
                        "TglBeli" => $dod->TglBeli,
                        "TotalVIP" => $dod->TotalVIP,
                        "HargaVIP" => $dod->HargaVIP,
                    ]);
                } catch (\Exception $e) {
                    return $e;
                }
            }
        }else{
            //check apakah ada tindakan atau tidak 
            $tindakan = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->where('NoRegister', Session::get('dataTindakan'))->get();
            if(count($tindakan) > 0){
                $deleteTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan_d')->whereIn('NoRegister', [Session::get('dataTindakan')])->delete();
                $deleteTindakan = DB::connection('rsu')->table('tr_rawatjalantindakan')->whereIn('No_Register', [Session::get('dataTindakan_d')])->delete();
            }else{
                $deleteTindakan = true;
            }
            $simpanOld = true;
            $simpanOld_d = true;
        }

        if($deleteTindakan && $simpanOld && $simpanOld_d){
            return true;
        }
        return false;
    }
}