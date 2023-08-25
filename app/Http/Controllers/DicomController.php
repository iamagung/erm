<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
// use App\Model\Profil;
// use App\Model\Galeri;
use App\Model\User;



// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, DB, Session, PDF;

class DicomController extends Controller
{
    function main(Request $request){
        $url = base64_encode('file:///Y:/ad.dcm');
        $id = $request->id;
        $decode = base64_decode($url);
        $data = [
            'image'=>$decode,
        ];
        return view('dwv.main',$data);
    }
}
