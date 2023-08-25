<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TmCustomer extends Model
{
    protected $connection = 'rsu';
    protected $table = 'tm_customer';
    protected $primaryKey = "KodeCust";
    public $timestamps = false;

    public function antrian(){
        // return $this->hasMany('App\Model\ApmAntrian', 'KodeCust', 'no_rm');
        return $this->hasMany('App\Model\ApmAntrian', 'no_rm', 'KodeCust');
    }
}
