<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Libraries\Datagrid;

class Paket_resep_m extends Model
{
    protected $table = 'paket_resep_m';
    protected $primaryKey = 'id_paket_m';
    public $timestamps = false;

    public function paket_d(){
        return $this->hasMany('App\Model\Paket_resep_d', 'paket_m_id');
    }
}
