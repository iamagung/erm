<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Libraries\Datagrid;

class Identitas extends Model
{
    protected $table = 'identitas';
    protected $primaryKey = 'id_identitas';
    public $timestamps = false;

    public function by(){
        return $this->belongsTo('App\Model\User','editor_id');
    }

    public static function getBeritaSekolah($input)
    {
        $table  = 'berita';
        $select = '*';
        
        $replace_field  = [
            ['old_name' => 'statu', 'new_name' => 'status'],
            ['old_name' => 'terbit', 'new_name' => 'tanggal'],
            // ['old_name' => 'terbit', 'new_name' => 'jam'],
        ];

        $param = [
            'input'         => $input->all(),
            'select'        => $select,
            'table'         => $table,
            'replace_field' => $replace_field
        ];
        $datagrid = new Datagrid;
        $data = $datagrid->datagrid_query($param, function($data){
            return $data->where('kategori','1')->orderBy('id_berita','DESC');
            // return $data;
        });
        return $data;
    }

    public static function getEvent($input)
    {
        $table  = 'berita';
        $select = '*';
        
        $replace_field  = [
            ['old_name' => 'statu', 'new_name' => 'status'],
            ['old_name' => 'terbit', 'new_name' => 'tanggal'],
            // ['old_name' => 'terbit', 'new_name' => 'jam'],
        ];

        $param = [
            'input'         => $input->all(),
            'select'        => $select,
            'table'         => $table,
            'replace_field' => $replace_field
        ];
        $datagrid = new Datagrid;
        $data = $datagrid->datagrid_query($param, function($data){
            return $data->where('kategori','2')->orderBy('id_berita','DESC');
            // return $data;
        });
        return $data;
    }

    public static function getPengumuman($input)
    {
        $table  = 'berita';
        $select = '*';
        
        $replace_field  = [
            ['old_name' => 'statu', 'new_name' => 'status'],
            ['old_name' => 'terbit', 'new_name' => 'tanggal'],
            // ['old_name' => 'terbit', 'new_name' => 'jam'],
        ];

        $param = [
            'input'         => $input->all(),
            'select'        => $select,
            'table'         => $table,
            'replace_field' => $replace_field
        ];
        $datagrid = new Datagrid;
        $data = $datagrid->datagrid_query($param, function($data){
            return $data->where('kategori','3')->orderBy('id_berita','DESC');
            // return $data;
        });
        return $data;
    }
}
