<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

trait KebidananKandungan{

    public function modifyAndSaveKandungan($data)
    {
        // convert serialize request to object
        $data = (object) $data->toArray();

        //validasi untuk form anc dan anc_dokter
        if( $data->anc == "Ya" && isset($data->anc_dokter) && $data->anc_dokter == "Lain-lain"){
            $data->anc_dokter = $data->anc_dokter_input;
        }elseif( $data->anc == "Tidak" ){
            $data->anc_dokter = "";
        }
        //validasi untuk form imunisasi_tt
        if( $data->imunisasi_tt == "Tidak"){
            $data->berapa_kali_imunisasi = 0;
        }
        
        //validasi jika sudah ada maka update jika belum maka insert
        if( isset($data->id_form_kebidanan) && !empty($data->id_form_kebidanan) ){
            //update form kandungan ke table rekam_medis_kandungan
            $simpanForm = $this->saveFormKandungan($data, "update");
        }else{
            //tambah rekamMedik_id
            $data->rekapMedik_id = Session::get('id_rekap');
            //simpan form kandungan ke table rekam_medis_kandungan
            $simpanForm = $this->saveFormKandungan($data, "insert");
        }

        return $simpanForm;
    }

    public function saveFormKandungan($data, $type = "insert") //type hanya ada insert dan update
    {
        try {
            //buat variable data request digunakan untuk simpan / update
            $dataReq = [];

            //get kolom name table rekam_medis_kandungan
            $kolomName = Schema::getColumnListing('rekam_medis_kandungan');
            //hapus kolom id karena primary key dan autoincrement
            unset($kolomName[0]);

            //isi wadah data request dengan nama kolom dan value
            foreach ($kolomName as $k => $v) {
                if(isset($data->$v)){
                    $dataReq[$v] = $data->$v;
                }
            }

            //finishing
            if($type == "update"){
                $simpanForm = DB::table('rekam_medis_kandungan')->where('id_form_kebidanan', $data->id_form_kebidanan)->update($dataReq);
            }else{
                $simpanForm = DB::table('rekam_medis_kandungan')->insert($dataReq);
            }

            //jika simpan/update berhasil
            if($simpanForm){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return ['status' => 'error','code' => 500 ,'message' => 'Terjadi Kesalahan Ketika Menyimpan Form Kebidanan', 'messageErr' => $e->getMessage()];
        }
    }
}