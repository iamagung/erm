<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ApmAntrian extends Model
{
    protected $connection = 'apm';
    protected $table = 'antrian';
    protected $primaryKey = 'id';

    public function tm_customer(){
        return $this->belongsTo('App\Model\TmCustomer', 'no_rm', 'KodeCust');
    }
}
