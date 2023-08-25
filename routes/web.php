<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cetak-satu', function () {
	return view('cetak.cetak-satu');
});
Route::get('/cetak-dua', function () {
	return view('cetak.cetak-dua');
});

Route::get('generate-pdf', 'PdfGenerateController@pdfview')->name('generate-pdf');

Route::get('/', function () {
	return redirect()->route('dashboard');
})->name('home');

Route::get('/home', function () {
	return redirect()->route('dashboard');
});

Route::get('/admin', function () {
	return redirect()->route('dashboardAdmin');
});

Route::get('/dokter', function () {
	return redirect()->route('dashboard');
});

Route::get('/perawat', function () {
	return redirect()->route('dashboardPerawat');
});

Route::get('login', 'LoginController@formlogin')->name('login');
Route::post('dologin', 'LoginController@dologin')->name('dologin');
Route::group(['middleware' => 'dokter'], function () {
	Route::group(array('prefix' => 'dokter'), function () {

		Route::get('main', 'dokterController@main')->name('dashboard');
		Route::post('mainchart', 'dokterController@mainchart')->name('dashboardchart');
		Route::group(['prefix' => 'add_rekap_medik'], function () {
			Route::get('/', 'dokterController@tambahRekapMedik')->name('tambahRekapMedik');
			Route::get('/setPasien/{id}', 'dokterController@setPasien');
			Route::post('/cekPasien', 'dokterController@cekPasien')->name('cekPasien');
			Route::get('/formTambahRekapMedik', 'dokterController@formTambahRekapMedik')->name('formTambahRekapMedik');
			Route::post('/modalRekapMedik', 'dokterController@modalDetailPasien')->name('modalDetailPasien');
			Route::post('/modalTambahObat', 'dokterController@modalTambahObat')->name('modalTambahObat');
			Route::post('/modalTambahLaborat', 'dokterController@modalTambahLaborat')->name('modalTambahLaborat');
			Route::post('/modalTambahRadio', 'dokterController@modalTambahRadio')->name('modalTambahRadio');
		});
		Route::group(['prefix' => 'data_rekap_medik'], function () {
			Route::get('/', 'dokterController@dataRekapMedik')->name('dataRekapMedik');
			Route::post('/page', 'dokterController@pageData')->name('pageDataDokter');
			Route::get('/detailRekapPasien/{id}', 'dokterController@detailRekapPasien');
			Route::post('/pageData', 'dokterController@pageDataDetail')->name('pageDataDetailDokter');
		});
		Route::group(['prefix' => 'registrasi'], function () {
			Route::get('/', 'registController@main')->name('dataRegistrasi');
			Route::post('/page', 'registController@pageRegist')->name('pageRegist');
		});
		Route::group(['prefix' => 'profile'], function () {
			Route::get('/', 'dokterController@profile')->name('profileDokter');
			Route::post('form', 'dokterController@formUbahPasswordAdmin')->name('formUbahPasswordDokter');
			Route::post('update', 'dokterController@updatePasswordAdmin')->name('updatePasswordDokter');
		});
		Route::group(['prefix' => 'rujuk'], function () {
			Route::get('ajukan', 'dokterController@ajukanSoal')->name('ajukan_pertanyaan');
			Route::post('pageAjukan', 'dokterController@pageAjukan')->name('page_ajukan_pertanyaan');
			Route::get('jawab', 'dokterController@jawabSoal')->name('jawab_pertanyaan');
			Route::post('pageJawab', 'dokterController@pageJawab')->name('page_jawab_pertanyaan');
			Route::get('/{id}', 'dokterController@jawab_rujuk');
			Route::post('simpan', 'dokterController@simpan_jawab_rujuk')->name('simpan_jawab_rujuk');
			// CARI JAWABAN
			Route::post('cari_jawaban', 'dokterController@cari_jawaban')->name('cari_jawaban');
			// END CARI JAWABAN
		});
		Route::group(['prefix' => 'form'], function () {
			Route::get('pembuatanObat', 'EresepController@pembuatanObat')->name('pembuatanObat');
			Route::post('pembuatanObatSave', 'EresepController@pembuatanObatSave')->name('pembuatanObatSave');
			Route::post('pembuatanObatSave2', 'EresepController@pembuatanObatSave2')->name('pembuatanObatSave2');
			Route::post('pembuatanObatResepSave', 'EresepController@pembuatanObatResepSave')->name('pembuatanObatResepSave');
			Route::post('pembuatanObatResepDel', 'EresepController@pembuatanObatResepDel')->name('pembuatanObatResepDel');
			Route::post('pembuatanObatResepDelItem', 'EresepController@pembuatanObatResepDelItem')->name('pembuatanObatResepDelItem');
			Route::get('buatEditResep', 'EresepController@buatEditResep')->name('buatEditResep');
			Route::post('buatEditResepModal', 'EresepController@buatEditResepModal')->name('buatEditResepModal');
			Route::post('buatEditResepSave', 'EresepController@buatEditResepSave')->name('buatEditResepSave');
			Route::get('historyPasien', 'EresepController@historyPasien')->name('historyPasien');
			Route::get('cetakReport', 'EresepController@cetakReport')->name('cetakReport');
			Route::get('cetakAntrian/{id_resep}', 'EresepController@cetakAntrian')->name('cetakAntrian');
			Route::post('get_kode', 'EresepController@getKode')->name('get_kode_resep');
			Route::post('get_nor', 'EresepController@getNoR')->name('get_nor');
			Route::post('get_history', 'EresepController@get_history')->name('get_history');
			Route::post('get_historyDetail', 'EresepController@getHistoryDetail')->name('get_historyDetail');
			Route::post('/modalSimpanResep', 'EresepController@modalSimpanResep')->name('modalSimpanResep');
			Route::post('/modalListResep', 'EresepController@modalListResep')->name('modalListResep');
			Route::post('/simpanPaketResep', 'EresepController@simpanPaketResep')->name('simpanPaketResep');
			Route::post('get_paket_resep', 'EresepController@get_paket_resep')->name('get_paket_resep');
			Route::post('select_paket_resep', 'EresepController@select_paket_resep')->name('select_paket_resep');
			Route::post('hapus_paket_resep', 'EresepController@hapus_paket_resep')->name('hapus_paket_resep');
			// Route::post('pageAjukan','dokterController@pageAjukan')->name('page_ajukan_pertanyaan');
			// Route::get('jawab','dokterController@jawabSoal')->name('jawab_pertanyaan');
			// Route::post('pageJawab','dokterController@pageJawab')->name('page_jawab_pertanyaan');
			// Route::get('/{id}','dokterController@jawab_rujuk');
			// Route::post('simpan','dokterController@simpan_jawab_rujuk')->name('simpan_jawab_rujuk');
		});
		Route::group(['prefix' => 'perawat'], function () {
			Route::get('/', 'dokterController@userPerawat')->name('userPerawatDokter');
			Route::post('/form', 'dokterController@formPerawat')->name('formPerawatDokter');
			Route::post('/simpan', 'dokterController@simpanPerawat')->name('simpanPerawatDokter');
			Route::post('/page', 'dokterController@pagePerawat')->name('pagePerawatDokter');
			Route::post('/detail', 'dokterController@detailPerawat')->name('detailPerawatDokter');
			Route::post('/reset', 'dokterController@resetPerawat')->name('resetPerawatDokter');
			Route::post('/delete', 'dokterController@deletePerawat')->name('deletePerawatDokter');
		});
	});
});

Route::group(['middleware' => 'perawat'], function () {
	Route::group(array('prefix' => 'perawat'), function () {

		Route::get('main', 'perawatController@main')->name('dashboardPerawat');
		Route::post('mainchart', 'perawatController@mainchart')->name('dashboardPerawatchart');
		Route::group(['prefix' => 'add_rekap_medik'], function () {
			Route::get('/setPasien/{id}/{id_antrean}', 'perawatController@setPasien');
			Route::get('/formTambahRekapMedik', 'perawatController@formTambahRekapMedik')->name('formTambahRekapMedikPerawat');
			Route::post('/modalRekapMedik', 'perawatController@modalDetailPasien')->name('modalDetailPasien');
			Route::post('/modalTambahObat', 'perawatController@modalTambahObat')->name('modalTambahObat');
			Route::post('/modalTambahLaborat', 'perawatController@modalTambahLaborat')->name('modalTambahLaborat');
			Route::post('/modalTambahRadio', 'perawatController@modalTambahRadio')->name('modalTambahRadio');
		});
		Route::group(['prefix' => 'data_rekap_medik'], function () {
			Route::get('/', 'perawatController@dataRekapMedik')->name('dataRekapMedikPerawat');
			Route::post('/page', 'perawatController@pageData')->name('pageDataDokterPerawat');
			Route::get('/detailRekapPasien/{id}', 'perawatController@detailRekapPasien');
			Route::post('/pageData', 'perawatController@pageDataDetail')->name('pageDataDetailPerawat');
		});

		Route::group(['prefix' => 'registrasi'], function () {
			Route::get('/', 'registPerawatController@main')->name('dataRegistrasiPerawat');
			Route::post('/page', 'registPerawatController@pageRegist')->name('pageRegistPerawat');
			Route::post('/panggil', 'registPerawatController@panggil')->name('perawatPanggil');
			Route::post('/hitBPJS', 'registPerawatController@hitBPJS')->name('perawatHitBPJS');
		});
		Route::group(['prefix' => 'profile'], function () {
			Route::get('/', 'perawatController@profile')->name('profilePerawat');
			Route::post('form', 'perawatController@formUbahPasswordAdmin')->name('formUbahPasswordPerawat');
			Route::post('update', 'perawatController@updatePasswordAdmin')->name('updatePasswordPerawat');
		});
	});
});

Route::group(['prefix' => 'pindah'], function () {
	Route::post('/pindahPasienRehab', 'registPerawatController@pindahPasienRehab')->name('pindahPasienRehab');
});

Route::group(['middleware' => 'admin'], function () {
	Route::group(array('prefix' => 'admin'), function () {
		Route::get('main', 'adminController@main')->name('dashboardAdmin');
		Route::get('grafikKunjungan', 'adminController@grafikKunjungan')->name('grafikKunjungan');
		Route::post('mainchart', 'adminController@mainchart')->name('dashboardAdminchart');
		Route::post('kunjunganChart', 'adminController@kunjunganChart')->name('kunjunganChart');
		Route::group(['prefix' => 'user'], function () {
			Route::group(['prefix' => 'admin'], function () {
				Route::get('/', 'adminController@userAdmin')->name('userAdmin');
				Route::post('/form', 'adminController@formAdmin')->name('formAdmin');
				Route::post('/simpan', 'adminController@simpanAdmin')->name('simpanAdmin');
				Route::post('/page', 'adminController@pageAdmin')->name('pageAdmin');
				Route::post('/detail', 'adminController@detailAdmin')->name('detailAdmin');
				Route::post('/reset', 'adminController@resetAdmin')->name('resetAdmin');
				Route::post('/delete', 'adminController@deleteAdmin')->name('deleteAdmin');
			});
			Route::group(['prefix' => 'dokter'], function () {
				Route::get('/', 'adminController@userDokter')->name('userDokter');
				Route::post('/form', 'adminController@formDokter')->name('formDokter');
				Route::post('/simpan', 'adminController@simpanDokter')->name('simpanDokter');
				Route::post('/page', 'adminController@pageDokter')->name('pageDokter');
				Route::post('/detail', 'adminController@detailDokter')->name('detailDokter');
				Route::post('/reset', 'adminController@resetDokter')->name('resetDokter');
				Route::post('/delete', 'adminController@deleteDokter')->name('deleteDokter');
			});
			Route::group(['prefix' => 'perawat'], function () {
				Route::get('/', 'adminController@userPerawat')->name('userPerawat');
				Route::post('/form', 'adminController@formPerawat')->name('formPerawat');
				Route::post('/simpan', 'adminController@simpanPerawat')->name('simpanPerawat');
				Route::post('/page', 'adminController@pagePerawat')->name('pagePerawat');
				Route::post('/detail', 'adminController@detailPerawat')->name('detailPerawat');
				Route::post('/reset', 'adminController@resetPerawat')->name('resetPerawat');
				Route::post('/delete', 'adminController@deletePerawat')->name('deletePerawat');
			});
		});

		Route::group(['prefix' => 'add_rekap_medik'], function () {
			Route::get('/formTambahRekapMedik', 'adminController@formTambahRekapMedik')->name('formTambahRekapMedikAdmin');
			Route::post('/modalRekapMedik', 'adminController@modalDetailPasien')->name('modalDetailPasienAdmin');
			Route::post('/modalTambahObat', 'adminController@modalTambahObat')->name('modalTambahObatAdmin');
			Route::post('/modalTambahLaborat', 'adminController@modalTambahLaborat')->name('modalTambahLaboratAdmin');
			Route::post('/modalTambahRadio', 'adminController@modalTambahRadio')->name('modalTambahRadioAdmin');
		});

		Route::group(['prefix' => 'poli'], function () {
			Route::get('/', 'adminController@poli')->name('dataPoli');
			Route::post('/form', 'adminController@formPoli')->name('formPoli');
			Route::post('/simpan', 'adminController@simpanPoli')->name('simpanPoli');
			Route::post('/page', 'adminController@pagePoli')->name('pagePoli');
			Route::post('/detail', 'adminController@detailPoli')->name('detailPoli');
		});
		Route::group(['prefix' => 'term'], function () {
			Route::get('/', 'adminController@term')->name('term');
			Route::post('update', 'adminController@updateTerm')->name('updateTerm');
		});
		Route::group(['prefix' => 'icon'], function () {
			Route::get('/', 'adminController@logo')->name('logo');
			Route::post('update', 'adminController@updateLogo')->name('updateLogo');
		});
		Route::group(['prefix' => 'rekap_medik'], function () {
			Route::get('/', 'adminController@rekapMedik')->name('dataRekapMedikAdmin');
			Route::post('/page', 'adminController@pageData')->name('pageDataAdmin');
			Route::get('/detailRekapPasien/{id}', 'adminController@detailRekapPasien');
			Route::post('/pageData', 'adminController@pageDataDetail')->name('pageDataDetail');
		});
		Route::group(['prefix' => 'profile'], function () {
			Route::get('/', 'adminController@profile')->name('profileAdmin');
			Route::post('form', 'adminController@formUbahPasswordAdmin')->name('formUbahPasswordAdmin');
			Route::post('update', 'adminController@updatePasswordAdmin')->name('updatePasswordAdmin');
		});
		Route::get('pdf', 'adminController@pdf')->name('pdf');
	});
});

// ALL
Route::group(['middleware' => 'all'], function () {
	Route::group(['prefix' => 'all'], function () {
		Route::group(['prefix' => 'rekam_medik_new'], function () {
			Route::get('/', 'RekamNewController@main')->name('rekam_new_all');
			Route::post('/page', 'RekamNewController@page')->name('page_rekam_new_all');
			Route::get('/cetak/{id_rekam}', 'RekamNewController@cetak');
		});
	});

	Route::group(['prefix' => 'content'], function () {
		Route::get('content1', 'contentController@content1')->name('content1');
		Route::get('content2', 'contentController@content2')->name('content2');
		Route::get('content2_so_data', 'contentController@content2_so_data')->name('content2_so_data');
		Route::get('content3', 'contentController@content3')->name('content3');
		Route::get('content4', 'contentController@content4')->name('content4');
		Route::get('content5', 'contentController@content5')->name('content5');
		Route::get('content6', 'contentController@content6')->name('content6');
		Route::get('content7', 'contentController@content7')->name('content7');
		Route::get('contentEresep', 'EresepController@contentEresep')->name('contentEresep');
		Route::get('contentGizi', 'EresepController@contentGizi')->name('contentGizi');
	});

	Route::group(['prefix' => 'antrian'], function () {
		Route::get('/', 'AntrianController@index_dokter')->name('antrian');
	});
});

Route::group(['prefix' => 'rekap_medik'], function () {
	Route::get('gantiPerawat/{id}', 'perawatController@gantiRekap');
	Route::get('ganti/{id}', 'dokterController@gantiRekap');
	Route::get('gantiAdmin/{id}', 'adminController@gantiRekap');
	Route::post('simpanP3/{id}', 'dokterController@simpanFotoDraw');
	Route::post('simpanP1/{id}', 'dokterController@simpanEditDraw');
	Route::post('simpanP5/{id}', 'dokterController@simpanUploadDraw');
	Route::get('p3/{id}', 'dokterController@fotoDraw');
	Route::get('p1/{id}', 'dokterController@editDraw');
	Route::get('p5/{id}', 'dokterController@uploadDraw');

	Route::post('simpan_tahap1', 'rekapController@simpanTahap1')->name('simpanTahap1');
	Route::post('simpan_tahap2', 'rekapController@simpanTahap2')->name('simpanTahap2');
	Route::post('simpan_tahap3', 'rekapController@simpanTahap3')->name('simpanTahap3');
	Route::post('deleteTindakan', 'rekapController@deleteTindakan')->name('deleteTindakan');
	Route::post('simpan_tahap_resep', 'rekapController@simpanTahapResep')->name('simpanTahapResep');
	Route::post('simpan_tahap4', 'rekapController@simpanTahap4')->name('simpanTahap4');
	Route::post('simpanedukasi', 'rekapController@simpanEdu')->name('simpanEdu');
	Route::post('tambahObatRekap', 'rekapController@tambahObatRekap')->name('tambahObatRekap');
	Route::post('hapusObatRekap', 'rekapController@hapusObatRekap')->name('hapusObatRekap');
	Route::post('hapusRadio', 'rekapController@hapusRadio')->name('hapusRadio');
	Route::post('tambahRadio', 'rekapController@tambahRadio')->name('tambahRadio');
	Route::post('hapusLab', 'rekapController@hapusLab')->name('hapusLab');
	Route::post('tambahLab', 'rekapController@tambahLab')->name('tambahLab');
	Route::post('simpanRujuk', 'rekapController@simpanRujuk')->name('simpanRujuk');
	Route::post('hapusRujuk', 'rekapController@hapusRujuk')->name('hapusRujuk');
	Route::post('hapusEdukasi', 'rekapController@hapusEdukasi')->name('hapusEdukasi');
	Route::post('pageRadio', 'rekapController@pageRadio')->name('pageRadio');
	Route::post('pageLab', 'rekapController@pageLab')->name('pageLab');
	Route::post('getKasusLama', 'rekapController@getKasusLama')->name('getKasusLama');
	Route::post('getKasusBaru', 'rekapController@getKasusBaru')->name('getKasusBaru');
	Route::post('getKasusSaatIni', 'rekapController@getKasusSaatIni')->name('getKasusSaatIni');

	// CARI PERTANYAAN
	Route::post('cari_pertanyaan', 'rekapController@cari_pertanyaan')->name('cari_pertanyaan');
});

Route::get('logouts', function () {
	if (Session::has('no_RM')) {
		if (Auth::User()->level == '1') {
			return redirect()->route('dashboardAdmin')->with('title', 'Whooops !')->with('message', 'Anda belum menyelesaikan rekap medik')->with('type', 'error');
		} else if (Auth::User()->level == '2') {
			return redirect()->route('dashboard')->with('title', 'Whooops !')->with('message', 'Anda belum menyelesaikan rekap medik')->with('type', 'error');
		} else {
			return redirect()->route('dashboardPerawat')->with('title', 'Whooops !')->with('message', 'Anda belum menyelesaikan rekap medik')->with('type', 'error');
		}
	} else {
		Auth::logout();
		return redirect()->route('home');
	}
})->name('logouts');

Route::get('unset_RM', 'unsetController@main')->name('unset_RM');

Route::get('batal_mengerjakan', function () {
	if (Auth::User()->level == '2') {
		$data = [
			'anamnesis' => '',
			'diagnosa' => '',
			'icd10' => '',
			'tindakan' => '',
			'icd9' => '',
			'rencana_terapi' => '',
			'kesan_gizi' => '',
			'foto_anamnesis' => '',
			'foto_rencana' => '',
			'fotodiagnosa' => '',
			'KodeDokter' => '',
			'NamaDokter' => null,
			'jenis_kasus' => null,
			// 'noTindakan'=>null,
		];
		$update = DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->update($data);
		$deleteRujuk = DB::table('rujukan_rm')->where('rekapMedik_id', Session::get('id_rekap'))->delete();
		$deleteEdu = DB::table('edukasi_rm')->where('rekapMedik_id', Session::get('id_rekap'))->delete();
	} else if (Auth::User()->level == '3') {
		$delete = DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->delete();
		$deleteEdu = DB::table('edukasi_rm')->where('rekapMedik_id', Session::get('id_rekap'))->delete();
		// if (!empty($deleteEdu)) {
		// 	foreach ($deleteEdu as $v) {

		// 	}
		// }
	}
	Session::forget('no_RM');
	Session::forget('id_rekap');
	if (Auth::User()->level == '2') {
		return redirect()->route('dataRegistrasi')->with('title', 'Terima Kasih !')->with('message', 'Data telah disimpan')->with('type', 'success');
	} else if (Auth::User()->level == '3') {
		return redirect()->route('dataRegistrasiPerawat')->with('title', 'Terima Kasih !')->with('message', 'Data telah disimpan')->with('type', 'success');
	} else {
		return redirect()->route('dataRekapMedikAdmin')->with('title', 'Terima Kasih !')->with('message', 'Data telah disimpan')->with('type', 'success');
	}
})->name('batal_mengerjakan');

Route::get('cancel_mengerjakan', function () {
	Session::forget('no_RM');
	Session::forget('id_rekap');
	if (Auth::User()->level == '2') {
		$update = DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->update(["jenis_kasus" => null]);
		return redirect()->route('dataRegistrasi')->with('title', 'Terima Kasih !')->with('message', 'Data telah disimpan')->with('type', 'success');
	} else if (Auth::User()->level == '3') {
		$update = DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->update(["jenis_kasus" => null]);
		return redirect()->route('dataRegistrasiPerawat')->with('title', 'Terima Kasih !')->with('message', 'Data telah disimpan')->with('type', 'success');
	} else {
		$update = DB::table('rekap_medik')->where('id_rekapMedik', Session::get('id_rekap'))->update(["jenis_kasus" => null]);
		return redirect()->route('dataRekapMedikAdmin')->with('title', 'Terima Kasih !')->with('message', 'Data telah disimpan')->with('type', 'success');
	}
})->name('cancel_mengerjakan');

Route::get('p', function () {
	return Hash::make('admin');
});

Route::get('eresep', function () {
	$program_path = "C:\\Windows\\notepad.exe";
	if (file_exists($program_path)) {
		shell_exec($program_path);
		// fopen($program_path,'r');
		$return = '<script>window.close();</script>';
	} else {
		$return = '<script>alert("file tidak ditemukan Letakkan aplikasi di \n C:/Program Files (x86)/Microsoft Office/Office14/");</script>';
		$return .= '<script>window.close();</script>';
	}
	return $return;
})->name('eresep');

Route::get('zein', function () {
	return DB::connection('local')->table('districts')->limit(1)->get();
});

Route::group(['prefix' => 'cetak'], function () {
	Route::get('cetak1', 'cetakController@cetak1')->name('cetak1');
	Route::get('cetak2', 'cetakController@cetak2')->name('cetak2');
	Route::get('cetak3', 'cetakController@cetak3')->name('cetak3');
	Route::get('cetak4', 'cetakController@cetak4')->name('cetak4');
	Route::get('cetak5', 'cetakController@cetak5')->name('cetak5');
	Route::get('cetak6', 'cetakController@cetak6')->name('cetak6');
	Route::get('cetak7', 'cetakController@cetak7')->name('cetak7');
	Route::get('cetak8', 'cetakController@cetak8')->name('cetak8');
});

// Route::group(['prefix'=>'content'],function(){
// 	Route::get('content1','contentController@content1')->name('content1');
// 	Route::get('content2','contentController@content2')->name('content2');
// 	Route::get('content2_so_data','contentController@content2_so_data')->name('content2_so_data');
// 	Route::get('content3','contentController@content3')->name('content3');
// 	Route::get('content4','contentController@content4')->name('content4');
// 	Route::get('content5','contentController@content5')->name('content5');
// 	Route::get('content6','contentController@content6')->name('content6');
// 	Route::get('content7','contentController@content7')->name('content7');
// });

Route::get('pgsql', 'pgController@index');

Route::post('salinanResep', 'rekapController@pageSalinanResep')->name('salinanResep');
Route::post('detsalinanResep', 'rekapController@detsalinanobat')->name('obatDetailSalin');

Route::post('rekapRJ', 'rekapController@pageRekapRJ')->name('RekapRJ');
Route::post('modalrekapRJ', 'rekapController@modalDetRekap')->name('modalDetRekap');

Route::post('diagnosaUp', 'rekapController@diagnosaUp')->name('diagnosaUp');
Route::post('tindakanUp', 'rekapController@tindakanUp')->name('tindakanUp');
Route::post('tarifTindakanUp', 'rekapController@tarifTindakanUp')->name('tarifTindakanUp');
Route::post('membatalkanEdit', 'rekapController@membatalkanEdit')->name('membatalkanEdit');
Route::post('membatalkanPengerjaan', 'rekapController@membatalkanPengerjaan')->name('membatalkanPengerjaan');
Route::get('cariPoli', 'adminController@cariPoli')->name('cariPoli');
// ROUTE DICOM
Route::group(['prefix' => 'dicom'], function () {
	Route::get('main-{id}', 'DicomController@main');
});
