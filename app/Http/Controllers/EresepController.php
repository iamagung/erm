<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
use App\Model\Paket_resep_m;
use App\Model\Paket_resep_d;
use App\Model\User;

// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, DB, Session;

date_default_timezone_set('Asia/Jakarta');

class EresepController extends Controller
{
	public function modalSimpanResep(Request $request)
	{
		// return $request['data'];
		// $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
		// $reg = DB::connection('rsu')->table('tr_registrasi')->where('No_Register',$rekap->no_Register)->first();
		// $resep = DB::connection('rsu')->table('tr_resep_m')->where('No_Register', $reg->No_Register)->first();
		// $data = DB::connection('rsu')->table('tr_resep_d')->where('No_Register', $rekap->no_Register)->where('No_Resep', $resep->No_Resep)->orderBy('No_R','asc')->paginate(10, ['*'], 'racikan');
		// $data = array();

		$nos = explode(",",$request['data']['nos']);
		foreach ($nos as $key) {
			// tambahkan data sebelum key
			$data['data'][$key] = [
				'No_R' => $request['data']['no_R_'.$key],
				'KodeBrg' => $request['data']['kode_obat_'.$key],
				'NamaBrg' => $request['data']['nama_obat_'.$key],
				'Satuan' => $request['data']['satuan_'.$key],
				'KodeGD' => $request['data']['kode_gd_'.$key],
				'KodePoli' => $request['data']['poli_id'],
				'SatuanSigna' => $request['data']['satuan_signa_'.$key],
				'jumlah' => $request['data']['jumlah_'.$key],
				'signa' => $request['data']['signa1_'.$key].'x'.$request['data']['signa2_'.$key],
			];
		}
		//baru
		$find = Paket_resep_m::find($request['data']['id_paket_m']);
		$data['id_paket_m'] = ($find) ? $request['data']['id_paket_m'] : '';
		$data['nama_paket_m'] = ($find) ? $find->nama_paket : '';
		$data['noRegistrasi'] = $request->data['noReg'];
		$data['keterangan'] = $request->data['keterangan'];
		// return $data['noRegistrasi'];
		$content = view('dokter.pages.modal.simpanPaketResep')->with('data',$data)->render();
		return ['status'=>'success','content'=>$content];
	}

	public function simpanPaketResep(Request $request)
	{
		if (!$request->id_paket_m) {
			//membuat kondisi jika terisi id
			$save = new Paket_resep_m;
			// $save->no_register = $request->noReg;
			$save->nama_paket = $request->nama_paket;
			$save->user_id = $request->user_id;
			$save->poli_id = $request->poli_id;
			$save->jenis_paket = $request->jenis;
			if ($request->jenis == "Racikan") {
				$save->mf = $request->MF;
			}
			// $save->keterangan = $request->keterangan;
			$save->save();

		} else {
			//hapus
			$save = Paket_resep_m::find($request->id_paket_m);
			$find = Paket_resep_m::find($request->id);
			if ($find) {
				if ($request->jenis == "Generic") {
					$find2 = DB::table('paket_resep_d')
						->where('paket_m_id', $find->id_paket_m)
						->get();
					if ($find2) {
						foreach ($find2 as $v) {
							DB::table('paket_resep_d')->where('id_paket_d', $v->id_paket_d)->delete();
						}
						$return = ['success', 'Berhasil menghapus resep!'];
					} else {
						$return = ['error', 'Gagal menghapus data!'];
					}
				} else {
					$find2 = DB::table('paket_racikan_d')
						->where('paket_m_id', $find->id_paket_m)
						->get();
					if ($find2) {
						foreach ($find2 as $v) {
							DB::table('paket_racikan_d')->where('id_paket_racikan_d', $v->id_paket_racikan_d)->delete();
						}
						$return = ['success', 'Berhasil menghapus racikan!'];
					} else {
						$return = ['error', 'Gagal menghapus data!'];
					}
				}

				$find->delete();
				return ['status'=> $return[0], 'message'=> $return[1]];
			} else {
				return ['status'=> 'error', 'message'=> 'Gagal menghapus data!'];
			}

		
		}



		if ($save) {
			if ($request->jenis == "Generic") {
				$nos = explode(",",$request->nos);
				foreach ($nos as $key) {
					$data2 = [
						'paket_m_id' => $save->id_paket_m,
						'no_r' => $request->{'no_R_'.$key},
						'kode_barang' => $request->{'kode_obat_'.$key},
						'jumlah' => $request->{'jumlah'.$key},
						'jumlah' => $request->{'jumlah'.$key},
						'signa' => $request->{'signa'.$key},
					];

					$save2 = DB::table('paket_resep_d')->insert($data2);
				}
				return ['status'=> 'success', 'message'=> 'Berhasil menyimpan resep!'];
			} else {
				for ($i=1; $i <= 8; $i++) { 
					if ($request->{'obat'.$i} && $request->{'satuan'.$i}) {
						$data2 = [
							'paket_m_id' => $save->id_paket_m,
							'kode_barang' => $request->{'obat'.$i},
							'satuan' => $request->{'satuan'.$i},
							// 'is_kronis' => $request->{'is_kronis'.$i},
						];
						$save2 = DB::table('paket_racikan_d')->insert($data2);
					}
				}
				return ['status'=> 'success', 'message'=> 'Berhasil menyimpan racikan!'];
			}
		} else {
			return ['status'=> 'error', 'message'=> 'Gagal menyimpan data!'];
		}
	}

	

	public function modalListResep()
	{
		$data['satuan_signa'] = DB::connection('rsu')->table('tm_setupall')
		->where('groups', 'Satuan Racikan')
		->get();
		$data['petunjuk_khusus'] = DB::connection('rsu')->table('tm_setupall')
		->where('groups', 'Petunjuk Khusus')
		->get();
		$content = view('dokter.pages.modal.daftarPaketResep', $data)->render();
		return ['status'=>'success','content'=>$content];
	}

	public function get_paket_resep(Request $request)
	{
		// $dokter = DB::table('login_dokter')->where('user_id', Auth::user()->id)->first();
		$data = Paket_resep_m::where([
			['user_id','=', Auth::user()->id],
			['nama_paket','like','%'.$request->cari.'%'],
			['jenis_paket','=', $request->jenis],
		])->limit(10)->get();
		return ['status'=>'success','data'=>$data];
	}

	public function select_paket_resep(Request $request)
	{
		$datas = array();
		if ($request->jenis == 'Racikan') {
			$data = DB::table('paket_racikan_d')
				->where('paket_m_id', $request->id)
				->orderBy('id_paket_racikan_d','asc')
				->get();
		} else {
			$data = DB::table('paket_resep_d')
				->where('paket_m_id', $request->id)
				->orderBy('No_R','asc')
				->get();
		}
		if ($request->jns == 'pilih') {
			foreach ($data as $k => $v) {
				// $obat = DB::connection('rsu')
				// ->table('tm_barang')
				// ->select('tm_stockbrg_fifo.KodeBrg', 'tm_stockbrg_fifo.NamaBrg', 'tm_barang.Satuan')
				// ->join('tm_stockbrg_fifo','tm_stockbrg_fifo.KodeBrg','=','tm_barang.KodeBrg')
				// ->where('tm_barang.KodeBrg', $v->kode_barang)
				// ->where('tm_stockbrg_fifo.KodeGd', 'LFAR')
				// ->first();
				$cekDokter = DB::table('login_dokter')
					->where('user_id', Auth::user()->id)->first();
				$cekGD = DB::connection('rsu')
					->table('tm_poli')
					->where('KodePoli', $cekDokter->poli_id)
					->first();
				$obat = $this->getKode($request, ['kode'=> $cekGD->LoketObat,'cari'=>$v->kode_barang]);

				$datas[$k] = $obat['data'][0];
				if ($request->jenis == 'Racikan') {
					$datas[$k]['satuan'] = $v->satuan;
				}
			}
		} elseif($request->jns == 'gunakan') {
			$cekResepLama = DB::connection('rsu')->table('tr_registrasi')->where('No_RM', Session::get('no_RM'))->orderBy('Tgl_Register', 'DESC')->get();
			foreach ($data as $k => $v) {
				// $obat = DB::connection('rsu')
				// ->table('tm_barang')
				// ->selectRaw('tm_stockbrg_fifo.KodeBrg, tm_stockbrg_fifo.KodeGd, tm_stockbrg_fifo.NamaBrg, tm_barang.Satuan, TRUNCATE(sum(tm_stockbrg_fifo.StockAkhir),0) as saldo')
				// ->join('tm_stockbrg_fifo','tm_stockbrg_fifo.KodeBrg','=','tm_barang.KodeBrg')
				// ->where('tm_barang.KodeBrg', $v->kode_barang)
				// ->where('tm_stockbrg_fifo.KodeGd', 'LFAR')
				// ->first();
				$cekDokter = DB::table('login_dokter')
					->where('user_id', Auth::user()->id)
					->first();
				$cekGD = DB::connection('rsu')
					->table('tm_poli')
					->where('KodePoli', $cekDokter->poli_id)
					->first();
				$obat = $this->getKode($request, ['kode'=> $cekGD->LoketObat,'cari'=>$v->kode_barang]);
				$getObatLama = DB::table('tr_resep_d')
					->where([
						['No_Register', $cekResepLama[1]->No_Register],
						['KodeBrg', $v->kode_barang]
					])->first();
				$jumlah = ($getObatLama) ? number_format($getObatLama->Jumlah, 0, ',', '') : $v->jumlah;
				$signa = ($getObatLama) ? $getObatLama->Signa1.'x'.$getObatLama->Signa2 : $v->signa;
				$datas[$k] = array(
					'KodeBrg' => $obat['data'][0]['item_code'],
					'KodeGd' => $obat['data'][0]['unit_nickname'],
					'NamaBrg' => $obat['data'][0]['item_name'],
					'Satuan' => $obat['data'][0]['item_unitofitem'],
					'saldo' => $obat['data'][0]['stock'],
					'jumlah' => $jumlah,
					'signa' => $signa,
				);
				$datas[$k]['no_r'] = $v->no_r;
			}
		}
		return ['status'=>'success','data'=>$datas];
	}

	public function hapus_paket_resep(Request $request)
	{
		$find = Paket_resep_m::find($request->id);
		if ($find) {
			if ($request->jenis == "Generic") {
				$find2 = DB::table('paket_resep_d')
					->where('paket_m_id', $find->id_paket_m)
					->get();
				if ($find2) {
					foreach ($find2 as $v) {
						DB::table('paket_resep_d')->where('id_paket_d', $v->id_paket_d)->delete();
					}
					$return = ['success', 'Berhasil menghapus resep!'];
				} else {
					$return = ['error', 'Gagal menghapus data!'];
				}
			} else {
				$find2 = DB::table('paket_racikan_d')
					->where('paket_m_id', $find->id_paket_m)
					->get();
				if ($find2) {
					foreach ($find2 as $v) {
						DB::table('paket_racikan_d')->where('id_paket_racikan_d', $v->id_paket_racikan_d)->delete();
					}
					$return = ['success', 'Berhasil menghapus racikan!'];
				} else {
					$return = ['error', 'Gagal menghapus data!'];
				}
			}

			$find->delete();
			return ['status'=> $return[0], 'message'=> $return[1]];
		} else {
			return ['status'=> 'error', 'message'=> 'Gagal menghapus data!'];
		}
	}

	// public function pembuatanObat(){
		// $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
		// $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
		// $reg = DB::connection('rsu')->table('tr_registrasi')->where('No_Register',$rekap->no_Register)->first();
		// $resep = DB::connection('rsu')->table('tr_resep_m')->where('No_Register', $reg->No_Register)->first();
		// $newKode = $this->getNoResep($dokter->poli_id);

		// if ($resep) {
		//   $racikan = DB::connection('rsu')->table('tr_resep_racikan_m')->where('No_Register', $rekap->no_Register)->where('No_Resep', $resep->No_Resep)->orderBy('No_R','asc')->get();
		//   $racikanPasien = DB::connection('rsu')->table('tr_resep_d')->where('No_Register', $rekap->no_Register)->where('No_Resep', $resep->No_Resep)->orderBy('No_R','asc')->paginate(10, ['*'], 'racikan');
		//   if ($this->checkNoResepDub($resep->No_Resep)) {
		//     $this->updateNoResep($resep->No_Resep,$resep->No_Register);
		//   }
		//   $resep = DB::connection('rsu')->table('tr_resep_m')->where('No_Register', $reg->No_Register)->first();
		// }else {
		//   // $racikanPasien = DB::connection('rsu')->table('tr_resep_d')->where('No_Register', $rekap->no_Register)->where('No_Resep', $newKode)->orderBy('No_R','asc')->paginate(10, ['*'], 'racikan');
		//   $racikan = null;
		//   $racikanPasien = null;
		//   $dataResep['noReg'] = $rekap->no_Register;
		//   $dataResep['noResep'] = $newKode;
		//   $dataResep['tglResep'] = date("Y-m-d H:i:s");
		//   $dataResep['poli_id'] = $dokter->poli_id;
		//   $dataResep['dokter'] = $dokter->Nama_Dokter;
		//   $dataResep['Nama_Pasien'] = $rekap->Nama_Pasien;
		//   $dataResep['Tgl_Lahir'] = $reg->Tgl_Lahir;
		//   $dataResep['no_RM'] = $rekap->no_RM;
		//   $dataResep['NamaAsuransi'] = $reg->NamaAsuransi;
		//   $dataResep['BB'] = $rekap->berat_badan;
		//   $dataResep['TB'] = $rekap->tinggi_badan;
		//   $historyAlergi = DB::connection('rsu')->table('tr_resep_m')->where('No_Register',$rekap->no_Register)->first();
		//   $isAlergi = 'TIDAK ADA ALERGI';
		//   $namaAlergi = '';
		//   if ($historyAlergi) {
		//     $isAlergi = $historyAlergi->isAlergi;
		//     $namaAlergi = $historyAlergi->NamaAlergi;
		//   } else {
		//     $historyAlergi = DB::connection('rsu')->table('tr_resep_m')->where('No_RM',Session::get('no_RM'))->orderBy('No_Register','DESC')->first();
		//     if ($historyAlergi) {
		//       $isAlergi = $historyAlergi->isAlergi;
		//       $namaAlergi = $historyAlergi->NamaAlergi;
		//     }
		//   }

		//   $dataResep['isAlergi'] = $isAlergi;
		//   $dataResep['NamaAlergi'] = $namaAlergi;
		//   $this->saveResepController($dataResep);
		//   $resep = DB::connection('rsu')->table('tr_resep_m')->where('No_Register', $reg->No_Register)->first();
		// }

		// $no_R_last = $this->getNoRController($rekap->no_Register);
		// $data = [
		//     'identitas'=>Identitas::find(1),
		//     'active'=>'7',
		//     'active_sub'=>'71',
		//     'dokter'=>$dokter,
		//     'satuan_signa'=>DB::connection('rsu')->table('tm_setupall')->where('groups', 'Satuan Racikan')->get(),
		//     'petunjuk_khusus'=>DB::connection('rsu')->table('tm_setupall')->where('groups', 'Petunjuk Khusus')->get(),
		//     'satuan'=>DB::table('tm_setupall')->where('groups', 'Satuan')->get(),
		//     'rekap'=>$rekap,
		//     'reg'=>$reg,
		//     'resep'=>$resep,
		//     'newKode'=>$newKode,
		//     // 'racikanPasien'=>DB::table('tr_resep_d')->where('No_Register', $rekap->no_Register)->orderBy('No_R','asc')->get(),
		//     'racikanPasien'=>$racikanPasien,
		//     'racikan'=>$racikan,
		//     'no_R_last'=>$no_R_last,
		// ];
		// return view('dokter.pages.form.pembuatanObat', $data);
	// }

	public function pembuatanObat(){
		$dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
		$poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli', $dokter->poli_id)->first();
		$dokter->kodeGD = $poli->LoketObat;
		$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();

		$reg = DB::connection('rsu')->table('tr_registrasi')->where('No_Register',$rekap->no_Register)->first();
		// return response()->json($reg);
		$resep = DB::table('tr_resep_m')->where('No_Register', $reg->No_Register)->first();
		// return json_encode($resep);
		$newKode = $this->getNoResep($dokter->poli_id);

		if ($resep) {
			$racikan = DB::table('tr_resep_racikan_m')->where('No_Register', $rekap->no_Register)->where('No_Resep', $resep->No_Resep)->orderBy('No_R','asc')->get();
			$racikanPasien = DB::table('tr_resep_d')->where('No_Register', $rekap->no_Register)->where('No_Resep', $resep->No_Resep)->orderBy('No_R','asc')->paginate(10, ['*'], 'racikan');
			if ($this->checkNoResepDub($resep->No_Resep)) {
				$this->updateNoResep($resep->No_Resep,$resep->No_Register);
			}
			$resep = DB::table('tr_resep_m')->where('No_Register', $reg->No_Register)->first();
		} else {
			$racikan = null;
			$racikanPasien = null;
			$dataResep['noReg'] = $rekap->no_Register;
			$dataResep['noResep'] = $newKode;
			$dataResep['tglResep'] = date("Y-m-d H:i:s");
			$dataResep['poli_id'] = $dokter->poli_id;
			$dataResep['dokter'] = $dokter->Nama_Dokter;
			$dataResep['Nama_Pasien'] = $rekap->Nama_Pasien;
			$dataResep['Tgl_Lahir'] = $reg->Tgl_Lahir;
			$dataResep['no_RM'] = $rekap->no_RM;
			$dataResep['NamaAsuransi'] = $reg->NamaAsuransi;
			$dataResep['BB'] = $rekap->berat_badan;
			$dataResep['TB'] = $rekap->tinggi_badan;
			$dataResep['kodeGD'] = $poli->LoketObat;
			$historyAlergi = DB::table('tr_resep_m')->where('No_Register',$rekap->no_Register)->first();
			$isAlergi = 'TIDAK ADA ALERGI';
			$namaAlergi = '';
			if ($historyAlergi) {
				$isAlergi = $historyAlergi->isAlergi;
				$namaAlergi = $historyAlergi->NamaAlergi;
			} else {
				$historyAlergi = DB::table('tr_resep_m')->where('No_RM',Session::get('no_RM'))->orderBy('No_Register','DESC')->first();
				if ($historyAlergi) {
					$isAlergi = $historyAlergi->isAlergi;
					$namaAlergi = $historyAlergi->NamaAlergi;
				}
			}

			$dataResep['isAlergi'] = $isAlergi;
			$dataResep['NamaAlergi'] = $namaAlergi;
			$this->saveResepController($dataResep);
			$resep = DB::table('tr_resep_m')->where('No_Register', $reg->No_Register)->first();
		}

		$no_R_last = $this->getNoRController($rekap->no_Register);
		$data = [
			'identitas'=>Identitas::find(1),
			'active'=>'7',
			'active_sub'=>'71',
			'dokter'=>$dokter,
			'content'=>'eresep',
			'title'=>'E-Resep',
			'include'=>'dokter.pages.form.pembuatanObat',
			'satuan_signa'=>DB::connection('rsu')->table('tm_setupall')->where('groups', 'Satuan Racikan')->get(),
			'petunjuk_khusus'=>DB::connection('rsu')->table('tm_setupall')->where('groups', 'Petunjuk Khusus')->get(),
			'satuan'=>DB::table('tm_setupall')->where('groups', 'Satuan')->get(),
			'rekap'=>$rekap,
			'reg'=>$reg,
			'resep'=>$resep,
			'newKode'=>$newKode,
			// 'racikanPasien'=>DB::table('tr_resep_d')->where('No_Register', $rekap->no_Register)->orderBy('No_R','asc')->get(),
			'racikanPasien'=>$racikanPasien,
			'racikan'=>$racikan,
			'no_R_last'=>$no_R_last,
		];
		return view('dokter.pages.add.content', $data);
	}

	public function saveResepController($dataResep)
	{
		while ($this->checkNoResep($dataResep['noResep'])) {
			$newKode = $this->getNoResep($dataResep['poli_id']);
			$dataResep['noResep'] = $newKode;
		}

		$data2 = [
			'No_Register' => $dataResep['noReg'],
			'No_Resep' => $dataResep['noResep'],
			'Tgl_Resep' => $dataResep['tglResep'],
			'Tgl' => date("Y-m-d H:i:s"),
			'KodePoli' => $dataResep['poli_id'],
			'KodeGD' => $dataResep['kodeGD'],
			'Dokter' => $dataResep['dokter'],
			'SIP' => $dataResep['poli_id'],
			'isAlergi' => $dataResep['isAlergi'],
			'NamaAlergi' => $dataResep['NamaAlergi'],
			'BB' => $dataResep['BB'],
			'TB' => $dataResep['TB'],
			'NamaPasien' => $dataResep['Nama_Pasien'],
			'TglLahir' => $dataResep['Tgl_Lahir'],
			'No_RM' => $dataResep['no_RM'],
			'JenisPasien' => $dataResep['NamaAsuransi'],
			'SatuanBB' => 'Kg',
			'TS' => date("Y-m-d H:i:s"),
			'Estimasi' => date('Y-m-d H:i:s',strtotime('+5 minutes',strtotime(date("Y-m-d H:i:s")))),
		];
		DB::table('tr_resep_m')->insert($data2);
		$cek = DB::table('tr_resep_m_loket')
			->where([
				['No_Register', '=', $dataResep['noReg']],
				['No_Resep', '=', $dataResep['noResep']],
			])->first();
		if (!$cek) {
			DB::table('tr_resep_m_loket')->insert($data2);
		}
	}

	public function getNoResep($kodePoli)
	{
		$y = date('y');
		$kodePoli = $kodePoli;
		$resep = DB::table('tr_resep_m')
			->where('No_Resep', 'like', $y.$kodePoli.'%')
			->orderBy('No_Resep','DESC')->first();
		if ($resep) {
		}else {
			return $y.$kodePoli.'000001';
		}
		$kode = $resep->No_Resep;
		$kodeSplit = explode($y.$kodePoli,$kode);
		$newKode = $kodeSplit[1];
		$newKode = (int)$newKode;
		$newKode++;
		$newKodeString = '';
		$newKodeString = $y.$kodePoli.$newKode;
		if ($newKode < 10) {
			$newKodeString = $y.$kodePoli.'00000'.$newKode;
		}elseif ($newKode < 100) {
			$newKodeString = $y.$kodePoli.'0000'.$newKode;
		}elseif ($newKode < 1000) {
			$newKodeString = $y.$kodePoli.'000'.$newKode;
		}elseif ($newKode < 10000) {
			$newKodeString = $y.$kodePoli.'00'.$newKode;
		}elseif ($newKode < 100000) {
			$newKodeString = $y.$kodePoli.'0'.$newKode;
		}
		return $newKodeString;
	}

	public function checkNoResep($No_Resep)
	{
		$resep = DB::table('tr_resep_m')
			->where('No_Resep', $No_Resep)
			->orderBy('Tgl_Resep','DESC')->first();
		if ($resep) {
			return true;
		}
		return false;
	}

	public function checkNoResepDub($No_Resep)
	{
		$resep = DB::table('tr_resep_m')
			->where('No_Resep', $No_Resep)
			->orderBy('Tgl_Resep','DESC')->count();
		if ($resep > 1) {
			return true;
		}
		return false;
	}

	public function updateNoResep($No_Resep,$No_Register)
	{
		$resep = DB::table('tr_resep_m')->where('No_Register', $No_Register)->where('No_Resep', $No_Resep)->orderBy('Tgl_Resep','DESC')->first();
		if ($resep) {
			$newKode = $this->getNoResep($resep->KodePoli);

			DB::table('tr_resep_m')
				->where('No_Register', $resep->No_Register)
				->where('Tgl_Resep', $resep->Tgl_Resep)
				->update(['No_Resep' => $newKode]);
			DB::table('tr_resep_m_loket')
				->where('No_Register', $resep->No_Register)
				->where('Tgl_Resep', $resep->Tgl_Resep)
				->update(['No_Resep' => $newKode]);
			return true;
		}
		return false;
	}

	public function numberToRomanRepresentation($number) {
		$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		$returnValue = '';
		while ($number > 0) {
			foreach ($map as $roman => $int) {
				if($number >= $int) {
					$number -= $int;
					$returnValue .= $roman;
					break;
				}
			}
		}
		return $returnValue;
	}

	public function pembuatanObatSave(Request $request)
	{
		// $newdata = new ;
		// $newdata-> = $request->noReg;
		// $newdata-> = $request->noResep;
		// $newdata-> = $request->No_R;
		// $newdata-> = $request->kode_obat;
		// $newdata-> = $request->nama_obat;
		// $newdata-> = $request->jumlah;
		// $newdata-> = $request->satuan;
		// $newdata-> = $request->kode_gd;
		// $newdata-> = $request->jam_signa;
		// $newdata-> = $request->signa1;
		// $newdata-> = $request->signa2;
		// $newdata-> = $request->petunjuk_khusus;
		// $newdata-> = $request->satuan_signa;
		// $newdata-> = $request->signa_khusus;
		// $newdata->save();

		// update stok barang,
		$obat = DB::connection('rsu')->table('tm_stockbrg_fifo')->where('KodeBrg', $request->kode_obat)->where('tm_stockbrg_fifo.KodeGd', 'LFAR')->first();
		// if ($obat->StockAwal - $request->jumlah < 0) {
		//   return ['status'=>'error','msg'=>'Stok obat tidak cukup!'];
		// }
		// $minStock = $obat->StockAwal - $request->jumlah;
		// DB::connection('rsu')->table('tm_stockbrg_fifo')->where('KodeBrg', $request->kode_obat)->where('tm_stockbrg_fifo.KodeGd', 'LFAR')->update(['StockAwal'=>$minStock]);

		$noResep = $request->noResep;
		$newdata2 = DB::connection('rsu')->table('tr_resep_m')->where('No_Register', $request->noReg)->where('No_Resep', $noResep)->first();
		if ($newdata2 && $request->isEdit == 'true') {
			$data2 = [
				// 'No_Register' => $request->noReg,
				// 'No_Resep' => $request->noResep,
				'Tgl_Resep' => $request->tglResep, // >>
				// 'Tgl' => date("Y-m-d H:i:s"), // >>
				// 'KodePoli' => $request->poli_id,
				// 'isProcessed' => 'N',
				// 'KodeGD' => $request->kode_gd,
				// 'Dokter' => $request->dokter,
				// 'SIP' => '', //>>>
				// 'isPrinted' => 'N',
				'isAlergi' => $request->alergi,
				'NamaAlergi' => ($request->alergi == 'ADA ALERGI') ? $request->namaAlergi : '',
				'BB' => $request->bb,
				'TB' => $request->tb,
				// 'NamaPasien' => $request->Nama_Pasien,
				// 'TglLahir' => $request->Tgl_Lahir,
				// 'No_RM' => $request->no_RM,
				// 'JenisPasien' => $request->NamaAsuransi,//>>s
				'SatuanBB' => $request->satuanBB,
				// 'TS' => date("Y-m-d H:i:s"), //>>>>>
				// 'JamSigna' => $request->jam_signa,
				// 'SatuanSigna' => $request->satuan_signa,
				// 'SignaKhusus' => $request->signa_khusus,
				// 'Estimasi' => date("Y-m-d H:i:s"), //>>>>>
				// 'Updater' => 0, // >>>
			];
			$newdata2 = DB::table('tr_resep_m')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->update($data2);
			$newdata2 = DB::table('tr_resep_m_loket')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->update($data2);
		}else {
			$noResep = $this->getNoResep($request->poli_id);
			$data2 = [
				'No_Register' => $request->noReg,
				'No_Resep' => $noResep,
				'Tgl_Resep' => $request->tglResep,
				'Tgl' => date("Y-m-d H:i:s"),
				'KodePoli' => $request->poli_id,
				// 'isProcessed' => 'N',
				'KodeGD' => $request->kode_gd,
				'Dokter' => $request->dokter,
				'SIP' => $request->poli_id, //>>>
				// 'isPrinted' => 'N',
				'isAlergi' => $request->alergi,
				'NamaAlergi' => ($request->alergi == 'ADA ALERGI') ? $request->namaAlergi : '',
				'BB' => $request->bb,
				'TB' => $request->tb,
				'NamaPasien' => $request->Nama_Pasien,
				'TglLahir' => $request->Tgl_Lahir,
				'No_RM' => $request->no_RM,
				'JenisPasien' => $request->NamaAsuransi,
				'SatuanBB' => $request->satuanBB,
				'TS' => date("Y-m-d H:i:s"),
				'JamSigna' => $request->jam_signa,
				'SatuanSigna' => $request->satuan_signa,
				'SignaKhusus' => $request->signa_khusus,
				'Estimasi' => date('Y-m-d H:i:s',strtotime('+5 minutes',strtotime(date("Y-m-d H:i:s")))), //>>>>> tambah 5 menit dr tgl TS
				// 'Updater' => 0, // >>>
			];
			$newdata2 = DB::table('tr_resep_m')->insert($data2);
		}

		$data = [
			'No_Register' => $request->noReg,
			'No_Resep' => $noResep,
			'No_R' => $request->No_R,
			'KodeBrg' => $request->kode_obat,
			'NamaBrg' => $request->nama_obat,
			'Jumlah' => $request->jumlah,
			'JumlahRomawi' => $this->numberToRomanRepresentation(round($request->jumlah)),
			'Satuan' => $request->satuan,
			'Konv' => 1,
			'KodeGD' => $request->kode_gd,
			'KodePoli' => $request->poli_id,
			'Signa1' => $request->signa1,
			'Signa2' => $request->signa2,
			'Keterangan' => $request->petunjuk_khusus,
			// 'Det' => '', // >>
			// 'JmlDet' => '', //>>
			'JamSigna' => $request->jam_signa,
			'SatuanSigna' => $request->satuan_signa,
			'SignaKhusus' => $request->signa_khusus,
			// 'Updater' => 0,
		];

		$newdata = DB::table('tr_resep_d')->insert($data);
		if ($newdata) {
			return ['status'=>'success','msg'=>'','data'=>$data];
		}
		return ['status'=>'error','msg'=>''];
	}

	public function pembuatanObatSave2(Request $request)
	{
		// return $request->all();
		$obat = DB::connection('rsu')->table('tm_stockbrg_fifo')->where('KodeBrg', $request->kode_obat)->where('tm_stockbrg_fifo.KodeGd', 'LFAR')->first();

		$noResep = $request->noResep;
		$newdata2 = DB::table('tr_resep_m')->where('No_Register', $request->noReg)->where('No_Resep', $noResep)->first();
		if ($newdata2 && $request->isEdit == 'true') {
			$data2 = [
				'Tgl_Resep' => $request->tglResep, // >>
				'isAlergi' => $request->alergi,
				'NamaAlergi' => ($request->alergi == 'ADA ALERGI') ? $request->namaAlergi : '',
				'BB' => $request->bb,
				'TB' => $request->tb,
				'SatuanBB' => $request->satuanBB,
			];
			$newdata2 = DB::table('tr_resep_m')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->update($data2);
			$newdata2 = DB::table('tr_resep_m_loket')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->update($data2);
		}else {
			$noResep = $this->getNoResep($request->poli_id);
			$data2 = [
				'No_Register' => $request->noReg,
				'No_Resep' => $noResep,
				'Tgl_Resep' => $request->tglResep,
				'Tgl' => date("Y-m-d H:i:s"),
				'KodePoli' => $request->poli_id,
				// 'isProcessed' => 'N',
				'KodeGD' => $request->kode_gd,
				'Dokter' => $request->dokter,
				'SIP' => $request->poli_id, //>>>
				// 'isPrinted' => 'N',
				'isAlergi' => $request->alergi,
				'NamaAlergi' => ($request->alergi == 'ADA ALERGI') ? $request->namaAlergi : '',
				'BB' => $request->bb,
				'TB' => $request->tb,
				'NamaPasien' => $request->Nama_Pasien,
				'TglLahir' => $request->Tgl_Lahir,
				'No_RM' => $request->no_RM,
				'JenisPasien' => $request->NamaAsuransi,
				'SatuanBB' => $request->satuanBB,
				'TS' => date("Y-m-d H:i:s"),
				'JamSigna' => $request->jam_signa,
				'SatuanSigna' => $request->satuan_signa,
				'SignaKhusus' => $request->signa_khusus,
				'Estimasi' => date('Y-m-d H:i:s',strtotime('+5 minutes',strtotime(date("Y-m-d H:i:s")))), //>>>>> tambah 5 menit dr tgl TS
				'Updater' => 0,
			];
			$newdata2 = DB::table('tr_resep_m')->insert($data2);
		}

		$nos = explode(",",$request->nos);
		foreach ($nos as $key) {
			$data = [
				'No_Register' => $request->noReg,
				'No_Resep' => $noResep,
				'No_R' => $request->{'no_R_'.$key},
				'KodeBrg' => $request->{'kode_obat_'.$key},
				'NamaBrg' => $request->{'nama_obat_'.$key},
				'Jumlah' => $request->{'jumlah_'.$key},
				'JumlahRomawi' => $this->numberToRomanRepresentation(round($request->{'jumlah_'.$key})),
				'Satuan' => $request->{'satuan_'.$key},
				'Konv' => 1,
				'KodeGD' => $request->{'kode_gd_'.$key},
				'KodePoli' => $request->poli_id,
				'Signa1' => $request->{'signa1_'.$key},
				'Signa2' => $request->{'signa2_'.$key},
				'is_kronis' => $request->{'is_kronis'.$key},
				'Keterangan' => $request->{'petunjuk_khusus_'.$key},
				// 'Det' => '', // >>
				// 'JmlDet' => '', //>>
				'JamSigna' => $request->{'jam_signa_'.$key},
				'SatuanSigna' => $request->{'satuan_signa_'.$key},
				'SignaKhusus' => $request->{'signa_khusus_'.$key},
				// 'Updater' => 0,
			];

			$newdata = DB::table('tr_resep_d')->insert($data);
		}

		if ($newdata) {
			return ['status'=>'success','msg'=>'','data'=>$data];
		}
		return ['status'=>'error','msg'=>''];
	}

	public function pembuatanObatResepSave(Request $request)
	{
		$noResep = $request->noResep;
		$newdata2 = DB::table('tr_resep_m')
			->where('No_Register', $request->noReg)
			->where('No_Resep', $noResep)
			->first();
		if ($newdata2 && $request->isEdit == 'true') {
			$data2 = [
				// 'No_Register' => $request->noReg,
				// 'No_Resep' => $request->noResep,
				'Tgl_Resep' => $request->tglResep, // >>
				// 'Tgl' => date("Y-m-d H:i:s"), // >>
				// 'KodePoli' => $request->poli_id,
				// 'isProcessed' => 'N',
				// 'KodeGD' => $request->kode_gd,
				// 'Dokter' => $request->dokter,
				// 'SIP' => '', //>>>
				// 'isPrinted' => 'N',
				'isAlergi' => $request->alergi,
				'NamaAlergi' => ($request->alergi == 'ADA ALERGI') ? $request->namaAlergi : '',
				'BB' => $request->bb,
				'TB' => $request->tb,
				// 'NamaPasien' => $request->Nama_Pasien,
				// 'TglLahir' => $request->Tgl_Lahir,
				// 'No_RM' => $request->no_RM,
				// 'JenisPasien' => $request->NamaAsuransi,//>>s
				'SatuanBB' => $request->satuanBB,
				// 'TS' => date("Y-m-d H:i:s"), //>>>>>
				// 'JamSigna' => $request->jam_signa,
				// 'SatuanSigna' => $request->satuan_signa,
				// 'SignaKhusus' => $request->signa_khusus,
				// 'Estimasi' => date("Y-m-d H:i:s"), //>>>>>
				// 'Updater' => 0, // >>>
			];
			$newdata2 = DB::table('tr_resep_m')
				->where('No_Register', $request->noReg)
				->where('No_Resep', $request->noResep)
				->update($data2);
			$newdata2 = DB::table('tr_resep_m_loket')
				->where('No_Register', $request->noReg)
				->where('No_Resep', $request->noResep)
				->update($data2);
		} else {
			$noResep = $this->getNoResep($request->poli_id);
			$data2 = [
				'No_Register' => $request->noReg,
				'No_Resep' => $noResep,
				'Tgl_Resep' => $request->tglResep,
				'Tgl' => date("Y-m-d H:i:s"),
				'KodePoli' => $request->poli_id,
				// 'isProcessed' => 'N',
				'KodeGD' => $request->kode_gd,
				'Dokter' => $request->dokter,
				'SIP' => $request->poli_id, //>>>
				// 'isPrinted' => 'N',
				'isAlergi' => $request->alergi,
				'NamaAlergi' => ($request->alergi == 'ADA ALERGI') ? $request->namaAlergi : '',
				'BB' => $request->bb,
				'TB' => $request->tb,
				'NamaPasien' => $request->Nama_Pasien,
				'TglLahir' => $request->Tgl_Lahir,
				'No_RM' => $request->no_RM,
				'JenisPasien' => $request->NamaAsuransi,
				'SatuanBB' => $request->satuanBB,
				'TS' => date("Y-m-d H:i:s"),
				'JamSigna' => $request->jam_signa,
				'SatuanSigna' => $request->satuan_signa,
				'SignaKhusus' => $request->signa_khusus,
				'Estimasi' => date('Y-m-d H:i:s',strtotime('+5 minutes',strtotime(date("Y-m-d H:i:s")))), //>>>>> tambah 5 menit dr tgl TS
				// 'Updater' => 0, // >>>
			];
			$newdata2 = DB::table('tr_resep_m')->insert($data2);
		}

		return ['status'=>'success','msg'=>$newdata2];
	}

    // public function pembuatanObatResepDel(Request $request)
    // {
      // $data = DB::connection('rsu')->table('tr_resep_m')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->first();
      // if ($data) {
      //   DB::connection('rsu')->table('tr_resep_d')->where('No_Resep', $request->noResep)->delete();
      //   DB::connection('rsu')->table('tr_resep_d_loket')->where('No_Resep', $request->noResep)->delete();
      //   DB::connection('rsu')->table('tr_resep_m')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->delete();
      //   DB::connection('rsu')->table('tr_resep_m_loket')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->delete();
      //   DB::connection('rsu')->table('tr_resep_racikan_d')->where('No_Resep', $request->noResep)->delete();
      //   DB::connection('rsu')->table('tr_resep_racikan_d_loket')->where('No_Resep', $request->noResep)->delete();
      //   DB::connection('rsu')->table('tr_resep_racikan_m')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->delete();
      //   DB::connection('rsu')->table('tr_resep_racikan_m_loket')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->delete();
      // }
      // return ['status'=>'success','msg'=>''];
    // }

	public function pembuatanObatResepDelItem(Request $request)
	{
		$data = DB::table('tr_resep_m')->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->first();
		if ($data) {
			if ($request->type=='resep') {
				DB::table('tr_resep_d')->where('No_Resep', $request->noResep)->where('No_R', $request->No_R)->delete();
				DB::table('tr_resep_d_loket')->where('No_Resep', $request->noResep)->where('No_R', $request->No_R)->delete();
			}
			if ($request->type=='racik') {
				DB::table('tr_resep_racikan_d')->where('No_Resep', $request->noResep)->where('No_R', $request->No_R)->delete();
				DB::table('tr_resep_racikan_d_loket')->where('No_Resep', $request->noResep)->where('No_R', $request->No_R)->delete();

				DB::table('tr_resep_racikan_m')
				->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->where('No_R', $request->No_R)
				->delete();
				DB::table('tr_resep_racikan_m_loket')
				->where('No_Register', $request->noReg)->where('No_Resep', $request->noResep)->where('No_R', $request->No_R)
				->delete();
			}
			return ['status'=>'success','msg'=>''];
		}
		return ['status'=>'error','msg'=>''];
	}

	public function buatEditResep(){
		$dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
		$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
		$resep = DB::table('tr_resep_m')->where('No_Register', $rekap->no_Register)->first();
		$racikan = DB::table('tr_resep_racikan_m')->where('No_Register', $rekap->no_Register)->where('No_Resep', $resep->No_Resep)->orderBy('No_R','asc')->get();

		$data = [
			'identitas'=>Identitas::find(1),
			'active'=>'7',
			'active_sub'=>'72',
			'dokter'=>$dokter,
			'rekap'=>$rekap,
			'resep'=>$resep,
			'racikan'=>$racikan,
			'petunjuk_khusus'=>DB::connection('rsu')->table('tm_setupall')->where('groups', 'Petunjuk Khusus')->get(),
			'satuan'=>DB::connection('rsu')->table('tm_setupall')->where('groups', 'Satuan Racikan')->get(),
		];
		return view('dokter.pages.form.Buat-EditResep', $data);
	}

	public function buatEditResepSave(Request $request)
	{
		// return $request->all();
		$newKode = $this->getNoR2($request->No_Register);

		for ($i=1; $i <= 8; $i++) {
			$obat = $request->{'Obat'.$i};
			$nama = $request->{'NamaObat'.$i};
			$dosis = $request->{'Dosis'.$i};
			$satuan = $request->{'Satuan'.$i};

			$dataD = [
				'No_R' => $newKode,
				'No_Resep' => $request->No_Resep,
				'No_Urut' => $i,
				'KodeBrg' => $obat,
				'NamaBrg' => $nama,
				'Dosis' => $dosis,
				'Satuan' => $satuan,
				'MF' => $request->MF,
				'Signa1' => $request->Signa1,
				'Signa2' => $request->Signa2,
				'Jumlah' => $request->Jumlah,
				'SignaKhusus' => $request->SignaKhusus,
				'Keterangan' => $request->Keterangan,
				'SignaKhusus' => $request->Keterangan,
				'JamSigna' => $request->JamSigna,
			];
			if (!empty($obat) && !empty($nama) && !empty($dosis) && !empty($satuan)) {
				$saveD = DB::table('tr_resep_racikan_d')->insert($dataD);
			}
		}

		$data = [
			'No_R' => $newKode,
			'No_Resep' => $request->No_Resep,
			'No_Register' => $request->No_Register,
			'No_RM' => $request->No_RM,
			'MF' => $request->MF,
			'Jumlah' => $request->Jumlah,
			'JamSigna' => $request->JamSigna,
			'Signa1' => $request->Signa1,
			'Signa2' => $request->Signa2,
			'SignaKhusus' => $request->SignaKhusus,
			'Keterangan' => $request->Keterangan,
			'Obat1' => $request->Obat1,
			'Obat2' => $request->Obat2,
			'Obat3' => $request->Obat3,
			'Obat4' => $request->Obat4,
			'Obat5' => $request->Obat5,
			'Obat6' => $request->Obat6,
			'Obat7' => $request->Obat7,
			'Obat8' => $request->Obat8,
			'NamaObat1' => $request->NamaObat1,
			'NamaObat2' => $request->NamaObat2,
			'NamaObat3' => $request->NamaObat3,
			'NamaObat4' => $request->NamaObat4,
			'NamaObat5' => $request->NamaObat5,
			'NamaObat6' => $request->NamaObat6,
			'NamaObat7' => $request->NamaObat7,
			'NamaObat8' => $request->NamaObat8,
			'Dosis1' => $request->Dosis1,
			'Dosis2' => $request->Dosis2,
			'Dosis3' => $request->Dosis3,
			'Dosis4' => $request->Dosis4,
			'Dosis5' => $request->Dosis5,
			'Dosis6' => $request->Dosis6,
			'Dosis7' => $request->Dosis7,
			'Dosis8' => $request->Dosis8,
			'Satuan1' => $request->Satuan1,
			'Satuan2' => $request->Satuan2,
			'Satuan3' => $request->Satuan3,
			'Satuan4' => $request->Satuan4,
			'Satuan5' => $request->Satuan5,
			'Satuan6' => $request->Satuan6,
			'Satuan7' => $request->Satuan7,
			'Satuan8' => $request->Satuan8,
			'is_kronis1' => $request->is_kronis1,
			'is_kronis2' => $request->is_kronis2,
			'is_kronis3' => $request->is_kronis3,
			'is_kronis4' => $request->is_kronis4,
			'is_kronis5' => $request->is_kronis5,
			'is_kronis6' => $request->is_kronis6,
			'is_kronis7' => $request->is_kronis7,
			'is_kronis8' => $request->is_kronis8,
			'namaRacikan' => $request->namaRacikan,
		];
		$save = DB::table('tr_resep_racikan_m')->insert($data);
		if ($save) {
			return ['status'=>'success'];
		}
		return ['status'=>'error'];
	}

	public function buatEditResepModal(Request $request){
		$data['racikan'] = DB::table('tr_resep_racikan_d')
			->where('No_Resep',$request->noResep)
			->where('No_R',$request->noR)
			->get();
		$data['racikanDetail'] = DB::table('tr_resep_racikan_m')
			->where('No_Resep',$request->noResep)
			->where('No_R',$request->noR)
			->first();
		$content = view('dokter.pages.modal.detailRacikan',$data)->render();
		return ['status'=>'success','content'=>$content];
	}

    public function historyPasien(){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        if(Session::has('id_rekap')){
          $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        }else{
          $rekap = '';
        }
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'7',
            'active_sub'=>'73',
            'dokter'=>$dokter,
            'rekap'=>$rekap,
        ];
        return view('dokter.pages.form.historyPasien', $data);
    }

    public function cetakReport(){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $reg = DB::connection('rsu')->table('tr_registrasi')->where('No_Register',$rekap->no_Register)->first();
        $resep = DB::table('tr_resep_m_loket')->where('No_Register', $reg->No_Register)->first();
        $printed = "N";
        if ($resep) {
          if ($resep->isPrinted=='Y') {
            $printed = "Y";
          }
          DB::table('tr_resep_m_loket')->where('No_Register', $reg->No_Register)->update(['isPrinted'=>'Y']);
        }

        $racikan1 = DB::table('tr_resep_d')
        ->select('tr_resep_d.No_R','tr_resep_d.No_Register', DB::raw("'resep' AS asal"),
          'tr_resep_d.NamaBrg AS a1_nama',
          'tr_resep_d.JumlahRomawi AS a1_jml',
          'tr_resep_d.Signa1 AS a1_signa',
          'tr_resep_d.Signa2 AS a1_signa2',
          'tr_resep_d.Keterangan AS a1_ket',
          'tr_resep_d.SignaKhusus AS a1_signakhusus',
          DB::raw("NULL AS b2_nama1"),
          DB::raw("NULL AS b2_jml1"),
          DB::raw("NULL AS b2_nama2"),
          DB::raw("NULL AS b2_jml2"),
          DB::raw("NULL AS b2_nama3"),
          DB::raw("NULL AS b2_jml3"),
          DB::raw("NULL AS b2_nama4"),
          DB::raw("NULL AS b2_jml4"),
          DB::raw("NULL AS b2_nama5"),
          DB::raw("NULL AS b2_jml5"),
          DB::raw("NULL AS b2_nama6"),
          DB::raw("NULL AS b2_jml6"),
          DB::raw("NULL AS b2_nama7"),
          DB::raw("NULL AS b2_jml7"),
          DB::raw("NULL AS b2_nama8"),
          DB::raw("NULL AS b2_jml8"),
          DB::raw("NULL AS b2_mf"),
          DB::raw("NULL AS b2_mfjumlah"),
          DB::raw("NULL AS b2_signa1"),
          DB::raw("NULL AS b2_signa2"),
          DB::raw("NULL AS b2_signakhusus"),
          DB::raw("NULL AS b2_ket")
        )
        ->where('tr_resep_d.No_Register', $rekap->no_Register);

        $racikan = DB::table('tr_resep_racikan_m')
        ->select('tr_resep_racikan_m.No_R','tr_resep_racikan_m.No_Register', DB::raw("'racik' AS asal"),
          DB::raw("NULL AS a1_nama"),
          DB::raw("NULL AS a1_jml"),
          DB::raw("NULL AS a1_signa"),
          DB::raw("NULL AS a1_signa2"),
          DB::raw("NULL AS a1_ket"),
          DB::raw("NULL AS a1_signakhusus"),
          'tr_resep_racikan_m.NamaObat1 AS b2_nama1',
          'tr_resep_racikan_m.Dosis1 AS b2_jml1',
          'tr_resep_racikan_m.NamaObat2 AS b2_nama2',
          'tr_resep_racikan_m.Dosis2 AS b2_jml2',
          'tr_resep_racikan_m.NamaObat3 AS b2_nama3',
          'tr_resep_racikan_m.Dosis3 AS b2_jml3',
          'tr_resep_racikan_m.NamaObat4 AS b2_nama4',
          'tr_resep_racikan_m.Dosis4 AS b2_jml4',
          'tr_resep_racikan_m.NamaObat5 AS b2_nama5',
          'tr_resep_racikan_m.Dosis5 AS b2_jml5',
          'tr_resep_racikan_m.NamaObat6 AS b2_nama6',
          'tr_resep_racikan_m.Dosis6 AS b2_jml6',
          'tr_resep_racikan_m.NamaObat7 AS b2_nama7',
          'tr_resep_racikan_m.Dosis7 AS b2_jml7',
          'tr_resep_racikan_m.NamaObat8 AS b2_nama8',
          'tr_resep_racikan_m.Dosis8 AS b2_jml8',
          'tr_resep_racikan_m.MF AS b2_mf',
          'tr_resep_racikan_m.Jumlah AS b2_mfjumlah',
          'tr_resep_racikan_m.Signa1 AS b2_signa1',
          'tr_resep_racikan_m.Signa2 AS b2_signa2',
          'tr_resep_racikan_m.SignaKhusus AS b2_signakhusus',
          'tr_resep_racikan_m.Keterangan AS b2_ket'
        )
        ->where('tr_resep_racikan_m.No_Register', $rekap->no_Register)
        ->unionAll($racikan1)
        ->orderBy('No_R','ASC')
        ->get();

        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'7',
            'active_sub'=>'74',
            'dokter'=>$dokter,
            'rekap'=>$rekap,
            'reg'=>$reg,
            'resep'=>$resep,
            'racikanPasien'=>$racikan,
            'printed'=>$printed,
        ];
        return view('dokter.pages.form.cetakReport2', $data);
    }

    public function cetakAntrian($id_resep){
        $dokter = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('u.id',Auth::User()->id)->first();
        $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $resep = DB::table('tr_resep_m_loket')->where('No_Register', $rekap->no_Register)->first();
        $tglResep = date("Y-m-d");
        if ($resep) {
          $splittglResep = explode(' ',$resep->Tgl_Resep);
          $tglResep = $splittglResep[0];
        }
        $resepNow = DB::table('tr_resep_m_loket')->where('No_Resep', $id_resep)->where('Tgl_Resep','like', $tglResep.'%')->first();
        $noUrutC = DB::table('tr_resep_m_loket')->where('Tgl_Resep','<', $resepNow->Tgl_Resep)->where('Tgl_Resep','like', $tglResep.'%')->get();
        $noUrut = count($noUrutC)+1;

        // $noUrutC = DB::connection('rsu')->table('tr_resep_m_loket')->where('Tgl_Resep','like', $tglResep.'%')->get();
        // $noUrut = count($noUrutC);
        $data = [
            'identitas'=>Identitas::find(1),
            'active'=>'7',
            'active_sub'=>'74',
            'rekap'=>$rekap,
            'resep'=>$resep,
            'dokter'=>$dokter,
            'noUrut'=>$noUrut,
        ];
        return view('dokter.pages.form.cetakAntrian', $data);
    }

	function getKode(Request $request, $req=0)
	{
		$cekDokter = DB::table('login_dokter')
			->where('user_id', Auth::user()->id)
			->first();
		$cekGD = DB::connection('rsu')
			->table('tm_poli')
			->where('KodePoli', $cekDokter->poli_id)
			->first();

		$kode = $request->kode;
		$cari = $request->cari;
		if ($req != 0) {
			$kode = $req['kode'];
			$cari = $req['cari'];
		}
		// if($kode=='kode_obat'){
			// // $data = DB::table('tm_barang')->where('KodeBrg','like','%'.$cari.'%')->limit(50)->get();
			// // $data = DB::table('tm_barang')->where('KodeBrg','like','%'.$cari.'%')->where('KodeGd', 'LFAR')->limit(50)->get();
			// $data = DB::connection('rsu')
			// ->table('tm_barang')
			// // ->select('tm_stockbrg_fifo.KodeBrg','tm_stockbrg_fifo.KodeGd','tm_stockbrg_fifo.NamaBrg','tm_barang.Satuan',DB::raw("SELECT SUM(tm_stockbrg_fifo.StockAkhir) as saldo"))
			// ->selectRaw('tm_stockbrg_fifo.KodeBrg,tm_stockbrg_fifo.KodeGd,tm_stockbrg_fifo.NamaBrg,tm_barang.Satuan, sum(tm_stockbrg_fifo.StockAkhir) as saldo')
            // ->join('tm_stockbrg_fifo','tm_stockbrg_fifo.KodeBrg','=','tm_barang.KodeBrg')
            // ->where('tm_stockbrg_fifo.KodeBrg','like','%'.$cari.'%')
            // ->where('tm_stockbrg_fifo.KodeGd', 'LFAR')
            // ->groupBy('tm_stockbrg_fifo.KodeBrg')
            // ->limit(50)->get();
		// }
		// elseif($kode=='nama_obat'){
			// // $data = DB::table('tm_barang')->where('NamaBrg','like','%'.$cari.'%')->limit(50)->get();
			// $data = DB::connection('rsu')
			// ->table('tm_barang')
			// // ->select('tm_stockbrg_fifo.KodeBrg','tm_stockbrg_fifo.KodeGd','tm_stockbrg_fifo.NamaBrg','tm_barang.Satuan',DB::raw("SELECT SUM(tm_stockbrg_fifo.StockAkhir) as saldo"))
			// ->selectRaw('tm_stockbrg_fifo.KodeBrg,tm_stockbrg_fifo.KodeGd,tm_stockbrg_fifo.NamaBrg,tm_barang.Satuan, TRUNCATE(sum(tm_stockbrg_fifo.StockAkhir),0) as saldo')
			// ->join('tm_stockbrg_fifo','tm_stockbrg_fifo.KodeBrg','=','tm_barang.KodeBrg')
			// ->where('tm_stockbrg_fifo.NamaBrg','like','%'.$cari.'%')
			// ->where('tm_stockbrg_fifo.KodeGd', 'LFAR')
			// ->groupBy('tm_stockbrg_fifo.KodeBrg')
			// ->limit(50)->get();
		// }
		$dt = [
			'term' => $cari,
			'unit_code' => $cekGD->LoketObat,
		];

		$curl = curl_init();
		curl_setopt_array($curl, array(
			// CURLOPT_URL => "https://192.168.1.3:8192/e_resep_api/get_obat",
			// CURLOPT_URL => "https://192.168.1.4:8188/e_resep_api/get_obat",
			CURLOPT_URL => "https://117.102.75.166:8188/e_resep_api/get_obat",
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
			CURLOPT_SSL_VERIFYHOST => FALSE,
			CURLOPT_SSL_VERIFYPEER => FALSE,
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($response) {
			$return = ['status'=>'success','data'=> json_decode($response, true),'source'=> 'sirama'];
		} else {
			$return = ['status'=>'error','data'=> "cURL Error #:" . $err];
		}
		return $return;
	}

	public function getNoRController($noReg){
		$No_R = $this->getNoR2($noReg);
		// $No_R = '';
		// $data = DB::connection('rsu')->table('tr_resep_d')->where('No_Register', $noReg)->orderBy('No_R','desc')->first();
		// if ($data) {
		//   $dataSplit = explode('/',$data->No_R);
		//   if (count($dataSplit)>0) {
		//     $num = $dataSplit[1];
		//     $No_R = "R/".++$num;
		//   }else {
		//     $No_R = 'R/1';
		//   }
		// }else {
		//   $No_R = 'R/1';
		// }
		return $No_R;
	}

	function getNoR(Request $request){
		$noReg = $request->noReg;
		$No_R = $this->getNoR2($noReg);
		// $No_R = '';
		// $data = DB::connection('rsu')->table('tr_resep_d')->where('No_Register', $noReg)->orderBy('No_R','desc')->first();
		// if ($data) {
		//   $dataSplit = explode('/',$data->No_R);
		//   if (count($dataSplit)>0) {
		//     $num = $dataSplit[1];
		//     $No_R = "R/".++$num;
		//   }else {
		//     $No_R = 'R/1';
		//   }
		// }else {
		//   $No_R = 'R/1';
		// }
		return ['status'=>'success','No_R'=>$No_R];
	}

	function getNoR2($noReg){
		$No_R = '';
		// $data = DB::connection('rsu')->table('tr_resep_d')->where('No_Register', $noReg)->orderBy('No_R','desc')->first();
		$data = DB::select(DB::raw("SELECT tr_resep_racikan_m.No_R FROM tr_resep_racikan_m WHERE tr_resep_racikan_m.No_Register=:noReg UNION SELECT tr_resep_d.No_R FROM tr_resep_d WHERE tr_resep_d.No_Register=:noReg2 ORDER BY No_R desc limit 1"), array('noReg' => $noReg,'noReg2' => $noReg));

		if ($data) {
			$dataSplit = explode('/',$data[0]->No_R);
			if (count($dataSplit)>0) {
				$num = $dataSplit[1];
				$No_R = "R/".++$num;
			}else {
				$No_R = 'R/1';
			}
		}else {
			$No_R = 'R/1';
		}
		return $No_R;
	}

    function get_history(Request $request){
        $awal = $request->awal;
        $akhir = $request->akhir;
        // $data = DB::table('tm_barang')->limit(50)->get();
        $data = DB::connection('rsu')->table('tr_registrasi')->where('No_RM', $request->No_RM)->where('Tgl_Register', '>=', $awal)->where('Tgl_Register', '<=', $akhir)->get();
        if(count($data)!=0){
            $status='success';
        }else{
            $status='error';
        }
        return ['status'=>$status,'data'=>$data];
    }

    public function getHistoryDetail(Request $request)
    {
      $no = $request->noreg;
      $resepPoli = null;
      $resepPoliGet = DB::connection('rsu')->table('tr_resep_d_loket')->where('No_Register', $no)->get();
      if (count($resepPoliGet) > 0) {
        $resepPoli = $resepPoliGet;
      }
      $resepFarmasi = null;
      $resepFarmasiGet = DB::connection('rsu')->table('tr_rawatjalanobat')->where('No_Register', $no)->get();
      if (count($resepFarmasiGet) > 0) {
        $resepFarmasi = $resepFarmasiGet;
      }
      $diagnosa = null;
      $diagnosaGet = DB::connection('rsu')->table('tr_rawatjalantindakan')->where('No_Register', $no)->get();
      if (count($diagnosaGet) > 0) {
        $diagnosa = $diagnosaGet;
      }
      return ['status'=>'success','no'=>$no,'resepPoli'=>$resepPoli,'resepFarmasi'=>$resepFarmasi,'diagnosa'=>$diagnosa];
    }
}
