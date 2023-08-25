<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
use App\Model\User;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Redirect, Auth, Hash, DB, Session;

class registPerawatController extends Controller
{
	public function __construct() {
		// $this->url_apm = 'http://117.102.75.166:8191/api/siramaerm/taskBpjs';
		$this->url_apm='http://192.168.2.111/develop/apm-rsu/public/api/siramaerm/taskBpjs';
	}

	public function main(Request $request)
	{
		$dokter = DB::table('users')->select('id', 'kodePoli', 'nama')->where('id', Auth::User()->id)->first();
		if($request->ajax()){
			if(Auth::user()->is_terapis == 'Y') {
				$rekapMedik = DB::table('rekap_medik')
				->select('rwid_id', 'tanggalKunjungan', 'aksi_terapis')
					->where('tanggalKunjungan', 'like', date('Y-m-d').'%')
					->where('aksi_terapis', '0')
					->get();

				$i=0;
				$rekapMedik1=[];
				foreach ($rekapMedik as $key) {
					$rekapMedik1[$i] = $key->rwid_id;
					$i++;
				}
				$regist = DB::connection('rsu')->table('tr_tracer')
					->select('rwid', 'No_RM', 'Kode_Poli', 'Kode_Poli', 'Tgl_Register', 'NoUrut', 'No_Register', 'Nama_Pasien', 'Umur')
					->whereIn('rwid', $rekapMedik1)
					->where('Kode_Poli', $dokter->kodePoli)
					->where('Tgl_Register','like',date('Y-m-d').'%')
					->orderBy('NoUrut','ASC')
					->get();
			} else {
				$rekapMedik = DB::table('rekap_medik')
					->select('rwid_id', 'tanggalKunjungan', 'aksi_terapis')
					->where('tanggalKunjungan','like',date('Y-m-d').'%')
					->where('aksi_perawat','1')
					->get();

				$i=0;
				$rekapMedik1=[];
				foreach ($rekapMedik as $key) {
					$rekapMedik1[$i] = $key->rwid_id;
					$i++;
				}
				$regist = DB::connection('rsu')->table('tr_tracer')
					->select('rwid', 'No_RM', 'Kode_Poli', 'Kode_Poli', 'Tgl_Register', 'NoUrut', 'No_Register', 'Nama_Pasien', 'Umur')
					->where('Kode_Poli', $dokter->kodePoli)
					->where('Tgl_Register','like',date('Y-m-d').'%')
					->orderBy('NoUrut','ASC')
					->get();
			}

			$regist_apm = [];
			$regist_simrs = [];
			$regist_done = [];
			foreach ($regist as $k => $v) {
				$getAntrian = DB::connection('apm')
					->table('antrian')
					->select('id', 'no_rm', 'tgl_periksa', 'nomor_antrian_poli', 'status', 'is_geriatri')
					->where([
						['no_rm', $v->No_RM],
						['tgl_periksa','like',date('Y-m-d').'%']
					])->first();

				if ($getAntrian && $getAntrian->nomor_antrian_poli) {
					$v->noAntre = ($getAntrian)?(($getAntrian->nomor_antrian_poli)?$getAntrian->nomor_antrian_poli:'-'):'-';
					$v->id_antre = ($getAntrian)?$getAntrian->id:'-';
					$v->daftar_via = ($getAntrian)?(($getAntrian->nomor_antrian_poli)?'Antrol':'Antrol (Belum Konfirmasi)'):'SIMRS';
					$v->status_panggil = $getAntrian->status;
					$v->is_geriatri = $getAntrian->is_geriatri;

					if (in_array($v->rwid, $rekapMedik1) || $v->status_panggil == 'akhirpoli') {
						$regist_done[count($regist_done)] = $v;
					} elseif (!in_array($v->rwid, $rekapMedik1) && $v->status_panggil == 'layanpoli') {
						$v->status_panggil = 'panggilpoli';
						$regist_apm[$k] = $v;
					} else {
						$regist_apm[$k] = $v;
					}
					
				} else {
					$v->noAntre = ($getAntrian)?(($getAntrian->nomor_antrian_poli)?$getAntrian->nomor_antrian_poli:'-'):'-';
					$v->id_antre = ($getAntrian)?$getAntrian->id:'-';
					$v->daftar_via = (!$getAntrian) ? 'SIMRS' : 'Antrol (Belum Konfirmasi)';
					$v->status_panggil = ($getAntrian) ? $getAntrian->status : '-';
					$v->is_geriatri = ($getAntrian) ? $getAntrian->is_geriatri : '-';

					if (!in_array($v->rwid, $rekapMedik1)) 
						$regist_simrs[count($regist_simrs)] = $v;
				}
			}

			usort($regist_apm, fn($a, $b) => strcmp($a->noAntre, $b->noAntre));
			usort($regist_done, fn($a, $b) => strcmp($a->noAntre, $b->noAntre));

			return ['data' => array_merge($regist_apm, $regist_simrs, $regist_done)];
		}

		$data = [
			'identitas'=>Identitas::find(1),
			'active'=>'3',
			'active_sub'=>'',
			'dokter'=>$dokter,
		];
		return view('perawat.pages.regist.main',$data);
	}

	public function pindahPasienRehab(Request $request)
	{
		if ($request->ke == "terapis") {
			DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->update(['aksi_terapis' => '0', 'aksi_perawat'=>'1', 'aksi_dokter' => null]);
			DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->update(['jenis_kasus' => null]);

			// $rute = (auth::user()->level == 2) ? 'dataRegistrasi' : 'dataRegistrasiPerawat';
			// $return = redirect()->route($rute)->with('title','Terima Kasih !')->with('message','Data telah disimpan')->with('type','success');
			Session::forget('no_RM');
			Session::forget('id_rekap');
			return ['status'=>'success'];
		}
	}

	public function panggil(Request $request)
	{
		try {
			DB::beginTransaction();
			$id_antrean = $request->id_antrean;
			//initial data
			$antrian = DB::connection('apm')->table('antrian')
				->where('id', $id_antrean)
				->first();

			//getcode counter
			$codeCounter = DB::connection('apm')->table('mapping_poli_bridging as mpb')
				->join('trans_konter_poli as tkp','tkp.poli_id','=','mpb.kdpoli_rs' )
				->join('mst_konterpoli as mk', 'mk.id','=','tkp.konter_poli_id')
				->where('mpb.kdpoli', $antrian->kode_poli)
				->first();

			$uid = $codeCounter->user_id;
			$kdCounterC =[['IRM'],['SAR','PAR','GIZ','ANT']];
			$c1 = in_array($antrian->kode_poli, $kdCounterC[0]);
			$c2 = in_array($antrian->kode_poli, $kdCounterC[1]);
			if($c1){
				$userCounter = DB::connection('apm')->table('users')->where('id',4)->first();
			}else if($c2){
				$userCounter = DB::connection('apm')->table('users')->where('id',5)->first();
			}else{
				$userCounter = DB::connection('apm')->table('users')->where('id',$uid)->first();
			}

			//update status antrian ke panggilpoli
			$update =  DB::connection('apm')->table('antrian')
				->where('id', $id_antrean)
				->where('status', "antripoli")
				->update(['status' => "panggilpoli"]);
			if($update){
				//jika berhasil update maka insert ke pemanggilan dan update status di antrian tracer jadi 2
				$q = DB::connection('apm')->table('antrian_tracer')
					->where('antrian_id',$id_antrean);
				$mtd = $antrian->metode_ambil;
				if($mtd=='WA'){
					$q = $q->where('from','wa');
				}else if($mtd=='SIMAPAN'){
					$q = $q->where('from','simapan');
				}else if($mtd=='JKN'){
					$q = $q->where('from','jkn');
				}else{
					$q = $q->where('from','counter');
				}
				$antrian_tracer = $q->where('to','poli')
					->update([
						'status_tracer' => 2,
						'time2' => date('H:i:s')
					]);
				$dataPemanggilan = [
					'antrian_id' => $antrian->id,
					'no_antrian' => $antrian->nomor_antrian_poli,
					'status' => 1,
					'dari' => $userCounter->lv_user
				];
				/* send task_id */
				$dt = ['no_antrian' => $antrian->nomor_antrian_poli, 'task_id' => '4',];
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => $this->url_apm,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30000,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode($dt),
					CURLOPT_HTTPHEADER => array(
						"accept: */*",
						"accept-language: en-US,en;q=0.8",
						"content-type: application/json",
					),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				/* -- */
				$update = DB::connection('apm')->table('pemanggilan')
					->where('dari',$userCounter->lv_user)
					->orderBy('id','DESC')
					->update(['tampilkan'=>1]);
				$pemanggilan = DB::connection('apm')->table('pemanggilan')->insert([$dataPemanggilan]);
				DB::commit();
				return [
					'status'=>'success',
					'code'=>200,
					'message'=>'Pasien dengan Nomor Antrian '.$antrian->nomor_antrian_poli.' berhasil dipanggil',
					'message2'=>json_decode($response, true),
					"data" => "if"
				];
			}else{
				//jika gagal update maka data sudah ada, cukup update status dipemanggilan untuk recall pasien
				$dataPemanggilan = [
					'antrian_id' => $antrian->id,
					'no_antrian' => $antrian->nomor_antrian_poli,
					'status' => 1,
					'dari' => $userCounter->lv_user
				];
				$update = DB::connection('apm')->table('pemanggilan')
					->where('dari',$userCounter->lv_user)
					->orderBy('id','DESC')
					->update(['tampilkan'=>1]);
				$pemanggilan = DB::connection('apm')->table('pemanggilan')->insert([$dataPemanggilan]);
				DB::commit();
				return [
					'status'=>'success',
					'code'=>200,
					'message'=>'Pasien dengan Nomor Antrian '.$antrian->nomor_antrian_poli.' berhasil dipanggil ulang',
					"data"=>"else"
				];
			}
		} catch (\Exception $e) {
			DB::rollback();
			return [
				'status'=>'error',
				'code'=>500,
				'message'=>'Gagal Memanggil Pasien Coba Ulangi Kembali',
				'messageerr'=>$e->getMessage(),
			];
		}
	}

	public function hitBPJS(Request $request)
	{
		$getAntrian = DB::connection('apm')->table('antrian')
			->where('id', $request->id)
			->first();

		if ($getAntrian) {
			$dt = [
				'no_antrian' => $getAntrian->nomor_antrian_poli,
				'task_id' => $request->task_id,
			];

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $this->url_apm,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30000,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($dt),
				CURLOPT_HTTPHEADER => array(
					"accept: */*",
					"accept-language: en-US,en;q=0.8",
					"content-type: application/json",
				),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			if ($response) {
				if ($request->task_id == '4') {
					DB::connection('apm')->table('antrian')->where('id', $request->id)->update(['status' => 'layanpoli']);
				} elseif ($request->task_id == '5') {
					DB::connection('apm')->table('antrian')->where('id', $request->id)->update(['status' => 'akhirpoli']);
				}

				return ['status'=>'success', 'data'=> json_decode($response, true),'urlsource'=>$this->url_apm];
			} else {
				return ['status'=>'error', 'data'=> "cURL Error #:" . $err];
			}
		} else {
			return ['status'=>'error', 'data'=> "No. Antrean Poli Tidak ditemukan"];
		}
	}

	public function update_antrian_apm($request)
	{

	}
}
