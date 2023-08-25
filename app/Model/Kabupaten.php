<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'mst_kabupaten';
    protected $primaryKey = 'id';
    protected $connection = 'apm';
    public $timestamps = false;
}
