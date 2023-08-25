<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

trait Orthotik{

    public function modifyAndSaveOrthotik($data)
    {
        // convert serialize request to object
        $data = (object) $data->toArray();
        
        //validasi jika sudah ada maka update jika belum maka insert
        if( isset($data->id_form_orthotik) && !empty($data->id_form_orthotik) ){
            //update form orthotik ke table rekam_medis_orthotik
            $simpanForm = $this->saveFormOrthotik($data, "update");
        }else{
            //tambah rekamMedik_id
            $data->rekapMedik_id = Session::get('id_rekap');
            //simpan form orthotik ke table rekam_medis_orthotik
            $simpanForm = $this->saveFormOrthotik($data, "insert");
        }

        return $simpanForm;
    }

    public function saveFormOrthotik($data, $type = "insert") //type hanya ada insert dan update
    {
        try {
            //buat variable data request digunakan untuk simpan / update
            $dataReq = [];

            //get kolom name table rekam_medis_orthotik
            $kolomName = Schema::getColumnListing('rekam_medis_orthotik');
            //hapus kolom id karena primary key dan autoincrement
            unset($kolomName[0]);

            //isi wadah data request dengan nama kolom dan value
            foreach ($kolomName as $k => $v) {
                if(isset($data->$v)){
                    if( is_array($data->$v) ){
                        $keyName = $data->$v;
                        if(count($keyName) == 4){
                            $dataReq[$v] = $keyName[0] ."-". $keyName[1] ."-". $keyName[2] ."-". $keyName[3];
                        }elseif (count($keyName) == 2) {
                            $dataReq[$v] = $keyName[0] ."-". $keyName[1];
                        }
                    }else{
                        $dataReq[$v] = $data->$v;
                    }
                }
            }
            //finishing
            if($type == "update"){
                $simpanForm = DB::table('rekam_medis_orthotik')->where('id_form_orthotik', $data->id_form_orthotik)->update($dataReq);
            }else{
                $simpanForm = DB::table('rekam_medis_orthotik')->insert($dataReq);
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