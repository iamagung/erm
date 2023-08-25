<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Libraries\Datagrid;

class Paket_resep_d extends Model
{
    protected $table = 'paket_resep_d';
    protected $primaryKey = 'id_paket_d';
    public $timestamps = false;

    public function paket_d(){
        return $this->belongsTo('App\Model\Paket_resep_m', 'paket_m_id');
    }
}
