<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Libraries\datagrid;

class barang extends Model
{
    //
    protected $table = 'barang';
    protected $primaryKey = 'id_brg';
    public $timestamps = false;

     public static function getJson($input)
    {
        $table  = 'barang';
        $select = '*';
        
        $replace_field  = [
            // ['old_name' => '', 'new_name' => ''],
        ];

        $param = [
            'input'         => $input->all(),
            'select'        => $select,
            'table'         => $table,
            'replace_field' => $replace_field,
        ];
        $datagrid = new Datagrid;
        $data = $datagrid->datagrid_query($param, function($data){
            return $data;
        });
        return $data;
    }

}
