<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Libraries\Datagrid;

class M_poli extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    public $timestamps = false;
    protected $connection = 'rsu';

    
}
