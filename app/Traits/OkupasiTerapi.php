<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

trait OkupasiTerapi{

    public function modifyAndSaveOkupasiTerapi($data)
    {
        // convert serialize request to object
        $data = (object) $data->toArray();
        
        //validasi jika sudah ada maka update jika belum maka insert
        if( isset($data->id_form_okupasi_terapi) && !empty($data->id_form_okupasi_terapi) ){
            //update form okupasi terapi ke table rekam_medis_okupasi_terapi
            $simpanForm = $this->saveFormOkupasiTerapi($data, "update");
        }else{
            //tambah rekamMedik_id
            $data->rekapMedik_id = Session::get('id_rekap');
            //simpan form okupasi terapi ke table rekam_medis_okupasi_terapi
            $simpanForm = $this->saveFormOkupasiTerapi($data, "insert");
        }

        return $simpanForm;
    }

    public function saveFormOkupasiTerapi($data, $type = "insert") //type hanya ada insert dan update
    {
        try {
            //buat variable data request digunakan untuk simpan / update
            $dataReq = [];

            //get kolom name table rekam_medis_okupasi_terapi
            $kolomName = Schema::getColumnListing('rekam_medis_okupasi_terapi');
            //hapus kolom id karena primary key dan autoincrement
            unset($kolomName[0]);

            //isi wadah data request dengan nama kolom dan value
            foreach ($kolomName as $k => $v) {
                if(isset($data->$v)){
                    $namaKey = $v . "_input";
                    if($data->$v == "ada"){
                        $dataReq[$v] = $data->$namaKey;
                    }else{
                        $dataReq[$v] = $data->$v;
                    }
                }
            }

            //finishing
            if($type == "update"){
                $simpanForm = DB::table('rekam_medis_okupasi_terapi')->where('id_form_okupasi_terapi', $data->id_form_okupasi_terapi)->update($dataReq);
            }else{
                $simpanForm = DB::table('rekam_medis_okupasi_terapi')->insert($dataReq);
            }

            //jika simpan/update berhasil
            if($simpanForm){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return ['status' => 'error','code' => 500 ,'message' => 'Terjadi Kesalahan Ketika Menyimpan Form Okupasi Terapi', 'messageErr' => $e->getMessage()];
        }
    }
}