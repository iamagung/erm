<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ApmAntrian extends Model
{
    protected $connection = 'apm';
    protected $table = 'antrian';
    protected $primaryKey = 'id';

    // public function tm_customer(){
    //     return $this->belongsTo('App\Http\Models\TmCustomer', 'no_rm', 'KodeCust');
    // }
    public function tm_customer(){
        return $this->belongsTo('App\Http\Models\TmCustomer','no_rm','KodeCust');
    }
}
