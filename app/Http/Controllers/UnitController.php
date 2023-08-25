<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Libraries\compressFile;
use App\Model\Identitas;
use App\Model\User;
use App\Traits\TarifDanTindakan;
use Redirect, Auth, Hash, DB, Session;

date_default_timezone_set('Asia/Jakarta');

class UnitController extends Controller
{
	public function __construct() {
		// $this->url_apm = env('URL_APM');\
		$url_apm='http://117.102.75.166:8191/api/siramaerm/taskBpjs';
	}

	public function data_regist_unit(Request $request){
		$unit = DB::table('users as u','u.id','l.user_id')
			->where('id', Auth::User()->id)
			->first();

		$total = DB::table('rujukan_rm')
			->select('rujukan_rm.*', 'rekap_medik.No_Register')
			->join('rekap_medik', 'rujukan_rm.rekapMedik_id', 'rekap_medik.id_rekapMedik')
			->where('rujukan_rm.KodePoli', $unit->kodePoli)
			->get();
		$regist1 = DB::table('rujukan_rm')
			->select('rujukan_rm.*', 'rekap_medik.*')
			->join('rekap_medik', 'rujukan_rm.rekapMedik_id', 'rekap_medik.id_rekapMedik')
			->where('rujukan_rm.KodePoli', $unit->kodePoli)
			->orderBy('tanggalPengerjaan','ASC')
			->limit(10)
			->get();

		$regist = [];
		foreach ($regist1 as $k => $v) {
			$getAntrian = DB::connection('apm')
			->table('antrian')
			->where([
				['no_rm', $v->no_RM],
				['tgl_periksa','like',date('Y-m-d').'%']
			])->first();
			$v->noAntre = ($getAntrian)?(($getAntrian->nomor_antrian_poli)?$getAntrian->nomor_antrian_poli:'-'):'-';
			$v->id_antre = ($getAntrian)?$getAntrian->id:'-';
			$regist[$k] = $v;
		}

		$data = [
			'identitas'=>Identitas::find(1),
			'active'=>'3',
			'active_sub'=>'',
			'regist'=>$regist,
			'total'=>$total,
			'dokter'=>$unit,
		];
		return view('unit.pages.regist.main',$data);
	}

	public function setPasien(Request $request){
		$data = DB::table('rekap_medik')->where('id_rekapMedik',$request->id)->first();

        if(Session::has('id_rekap')){
            return Redirect::to($_SERVER['HTTP_REFERER'])
                ->with('title','Whooops !')
                ->with('message','Anda sedang menangani pasien')
                ->with('type','warning');
        }else{
	        Session::put('no_RM',$data->no_RM);
	        Session::put('id_rekap',$data->id_rekapMedik);
	        return Redirect::route('unitContent1');
	    }
	}

	/* KONTEN */
	function content1(){
		$unit = DB::table('users')->where('id', Auth::User()->id)->first();
		$view = 'unit.pages.add.content';
		$include = 'unit.pages.add.content.tahap1';

		$rekap1 = DB::table('rekap_medik')
			->where('no_RM', Session::get('no_RM'))
			->orderBy('tanggalKunjungan','DESC')
			->paginate(10);
		$data = [
			'identitas'=>Identitas::find(1),
			'active'=>'2',
			'active_sub'=>'',
			'dokter'=>$unit,
			'content'=>'2',
			'title'=>'Pengkajian Awal Pasien Rawat Jalan',
			'include'=>$include,
			'rekap1'=>$rekap1,
		];
		return view($view, $data);
	}
}
