<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
use Redirect, Auth, Hash, DB, Session;

date_default_timezone_set('Asia/Jakarta');

class AntrianController extends Controller
{
	/* MENU PEMANGGILAN ANTRIAN */
	public function index_dokter()
	{
        if (Auth::user()->level == '2') {
            $user = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id', Auth::user()->id)->first();
        } else {
            $user = DB::table('users')->where('id',Auth::user()->id)->first();
        }

        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'8',
            'active_sub'=>'',
            'tgl'=>'',
            'dokter'=>$user,
        ];
		return view('antrian.main', $data);
	}

}
