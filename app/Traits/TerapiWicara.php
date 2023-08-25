<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

trait TerapiWicara{

    public function modifyAndSaveTerapiWicara($data)
    {
        // convert serialize request to object
        $data = (object) $data->toArray();
        
        //validasi jika sudah ada maka update jika belum maka insert
        if( isset($data->id_form_terapi_wicara) && !empty($data->id_form_terapi_wicara) ){
            //update form terapi_wicara ke table rekam_medis_terapi_wicara
            $simpanForm = $this->saveFormTerapiWicara($data, "update");
        }else{
            //tambah rekamMedik_id
            $data->rekapMedik_id = Session::get('id_rekap');
            //simpan form terapi_wicara ke table rekam_medis_terapi_wicara
            $simpanForm = $this->saveFormTerapiWicara($data, "insert");
        }

        return $simpanForm;
    }

    public function saveFormTerapiWicara($data, $type = "insert") //type hanya ada insert dan update
    {
        try {
            //buat variable data request digunakan untuk simpan / update
            $dataReq = [];

            //get kolom name table rekam_medis_terapi_wicara
            $kolomName = Schema::getColumnListing('rekam_medis_terapi_wicara');
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
                $simpanForm = DB::table('rekam_medis_terapi_wicara')->where('id_form_terapi_wicara', $data->id_form_terapi_wicara)->update($dataReq);
            }else{
                $simpanForm = DB::table('rekam_medis_terapi_wicara')->insert($dataReq);
            }

            //jika simpan/update berhasil
            if($simpanForm){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return ['status' => 'error','code' => 500 ,'message' => 'Terjadi Kesalahan Ketika Menyimpan Form Terapi Wicara', 'messageErr' => $e->getMessage()];
        }
    }
}