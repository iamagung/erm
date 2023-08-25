<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AntrianFarmasi extends Model
{
    protected $connection = 'apm';
    protected $table = 'antrian_farmasi';
    protected $primaryKey = 'id_antrian_farmasi';
}
