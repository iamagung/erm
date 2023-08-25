<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TmCustomer extends Model
{
    protected $connection = 'rsu';
    protected $table = 'tm_customer';
    protected $primaryKey = "KodeCust";
    public $timestamps = false;

    // public function antrian(){
    //     // return $this->hasMany('App\Model\ApmAntrian', 'KodeCust', 'no_rm');
    //     return $this->hasMany('App\Http\Models\ApmAntrian', 'no_rm', 'KodeCust');
    // }
    public function antrian(){
        return $this->hasMany('App\Http\Models\ApmAntrian', 'KodeCust');
    }
}