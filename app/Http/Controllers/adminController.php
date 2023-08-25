<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\compressFile;
use App\Model\Identitas;
use App\Http\Models\TmCustomer as Cust;
use App\Http\Models\ApmAntrian as Apm;
// use App\Model\Profil;
// use App\Model\Galeri;
use App\Model\User;



// Sistem Administrasi & Neraca Scaffolding
use Redirect, Auth, Hash, DB, Session, PDF;

class adminController extends Controller
{
    //
    public function main(Request $request)
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '1',
            'tgl' => '',
            'active_sub' => '',
        ];
        return view('admin.dashboard.main', $data);
    }

    public function mainchart(Request $request)
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '1',
            'tgl' => $request->tgl,
            'active_sub' => '',
        ];
        return view('admin.dashboard.main', $data);
    }

    public function grafikKunjungan(Request $request)
    {
        $kabupaten = ['3576', '3516'];
        $kunjungan = DB::connection('apm')->table('antrian as a')
            ->rightjoin('tm_customer as t', 't.KodeCust', 'a.no_rm')
            ->join('antrian_pasien_baru as apb', 'apb.no_rm', 't.KodeCust')
            ->whereIn('kabupaten_id', $kabupaten)
            ->selectRaw('count(a.id) pasien, year(tgl_periksa) group_by')
            ->groupBy('group_by')->get();
        // $kunjungan = ApmAntrian::with('tm_customer')->whereBetween('tgl_periksa', [$today . '-01-01', $today . '-12-31'])->groupBy(DB::raw("YEAR(tgl_periksa)"))->get();
        $poli = DB::connection('rsu')->table('mapping_poli_bridging')->join('tm_poli', 'mapping_poli_bridging.kdpoli_rs', '=', 'tm_poli.KodePoli', 'left')
            ->groupBy('mapping_poli_bridging.kdpoli_rs')
            ->get();
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '6',
            'tgl' => '',
            'active_sub' => '',
            'poli' => $poli,
            'kunjungan' => $kunjungan
        ];
        return view('admin.pages.grafikKunjungan.main', $data);
    }

    public function kunjunganChart(Request $request)
    {
        $kodePoli = $request->pilih_poli;
        $today = date('Y-m-d');
        $range = ['0', '100'];
        $jenis_kelamin = $request->jenis_kelamin;
        $kodePoli = $request->pilih_poli;
        $group_by = $request->group_by;
        $is_pasien_baru = $request->jenis_pasien;
        $kabupaten = $request->alamat;
        $range = explode(',', $request->range_umur);
        if ($request->range_umur == 'balita') {
            $range = ['0', '5'];
        } else if ($request->range_umur == 'anak') {
            $range = ['5', '12'];
        } else if ($request->range_umur == 'remaja') {
            $range = ['12', '26'];
        } else if ($request->range_umur == 'dewasa') {
            $range = ['26', '46'];
        } else if ($request->range_umur == 'lansia') {
            $range = ['46', '100'];
        }
        // $range = [date('Y-m-d h:i:s', strtotime('-' . $range[1] . ' day')), date('Y-m-d h:i:s', strtotime('-' . $range[0] . ' day'))];

        if ($jenis_kelamin == 'semua') {
            $jenis_kelamin = ['0', 'L', 'P', '3', '4'];
        } else {
            $jenis_kelamin = [$jenis_kelamin];
        }

        if ($is_pasien_baru == 'semua') {
            $is_pasien_baru = ['Y', 'N'];
        } else {
            $is_pasien_baru = [$is_pasien_baru];
        }

        if ($kabupaten == 'semua') {
            $kabupaten = ['3576', '3516'];
        } else {
            $kabupaten = [$kabupaten];
        }
        // return Cust::has('antrian')->with('antrian')->limit(10)->get();
        return $data = Apm::with('tm_customer')
                    ->where('tgl_periksa', '2023-08-24')
                    // ->selectRaw('count(id) pasien, year(tgl_periksa) group_by, month(tgl_periksa) month')
                    // ->whereBetween('tgl_periksa', [$request->tahun_mulai . '-08-01', $request->tahun_akhir . '-12-31'])
                    ->limit('10')
                    ->get();
                    // ->groupBy('group_by', 'month')
        // if ($kodePoli == 'semua') {
        //     $data = DB::connection('apm')->table('antrian as a')
        //         ->rightjoin('tm_customer as t', 't.KodeCust', 'a.no_rm')
        //         ->join('antrian_pasien_baru as apb', 'apb.no_rm', 't.KodeCust')
        //         ->whereIn('JenisKel', $jenis_kelamin)
        //         ->whereIn('is_pasien_baru', $is_pasien_baru)
        //         ->whereIn('kabupaten_id', $kabupaten)
        //         // ->whereBetween('TglLahir', $range)
        //         ->whereRaw('DATEDIFF(a.tgl_periksa,t.TglLahir) between ? and ? ', $range)
        //         ->selectRaw('count(a.id) pasien, year(tgl_periksa) group_by, month(tgl_periksa) month')
        //         ->whereBetween('tgl_periksa', [$request->tahun_mulai . '-01-01', $request->tahun_akhir . '-12-31'])
        //         ->groupBy('group_by', 'month')->get();
        // } else {
        //     $data = DB::connection('apm')->table('antrian as a')
        //         ->rightjoin('tm_customer as t', 't.KodeCust', 'a.no_rm')
        //         ->join('antrian_pasien_baru as apb', 'apb.no_rm', 't.KodeCust')
        //         ->whereIn('JenisKel', $jenis_kelamin)
        //         ->whereIn('is_pasien_baru', $is_pasien_baru)
        //         ->whereIn('kabupaten_id', $kabupaten)
        //         ->where('kode_poli', $kodePoli)
        //         // ->whereBetween('TglLahir', $range)
        //         ->whereRaw('DATEDIFF(a.tgl_periksa,t.TglLahir) between ? and ? ', $range)
        //         ->selectRaw('count(a.id) pasien, year(tgl_periksa) group_by, month(tgl_periksa) month')
        //         ->whereBetween('tgl_periksa', [$request->tahun_mulai . '-01-01', $request->tahun_akhir . '-12-31'])
        //         ->groupBy('group_by', 'month')->get();
        // }
        // return $data = ApmAntrian::with('tm_customer')->whereBetween('tgl_periksa', [$request->tahun_mulai . '-01-01', $request->tahun_akhir . '-12-31'])->count();


        return response()->json($data);
        // return $data = ApmAntrian::with('tm_customer')->where('tgl_periksa', '2023-07-18')->get();

        // return response()->json($data);
        // return view('admin.grafikKunjungan.main', $data);
    }

    public function cariPoli(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::connection('rsu')->table('tm_poli')->where('NamaPoli', 'ilike', '%' . $cari . '%')->get();
            return response()->json($data);
        }
    }
    // USER ADMIN

    public function userAdmin()
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '',
            'active_sub' => '21',
            'admin' => DB::table('users')->where('id', '!=', Auth::User()->id)->where('level', '1')->limit(10)->get(),
            'total' => DB::table('users')->where('id', '!=', Auth::User()->id)->where('level', '1')->get(),
        ];
        return view('admin.pages.userAdmin.main', $data);
    }

    public function formAdmin(Request $request)
    {
        $id = $request->id;
        $data = ['id' => $id];
        $content = view('admin.pages.userAdmin.form', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function detailAdmin(Request $request)
    {
        $id = $request->id;
        $data = ['id' => $id];
        $content = view('admin.pages.userAdmin.detail', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function simpanAdmin(Request $request)
    {
        $data1 = [
            'nama' => $request->nama_admin,
            'alias' => $request->nama_admin,
            'telp' => $request->telp_admin,
            'alamat' => $request->alamat_admin,
            'aktif' => $request->status_admin,
            'foto_user' => '',
            'level' => '1',
        ];
        $data2 = [
            'username' => $request->username_admin,
            'password' => Hash::make($request->password_admin),
        ];
        if ($request->id_admin == 0) {
            $data = array_merge($data1, $data2);
        } else {
            $data = array_merge($data1);
        }

        $exist = DB::table('users')->where('username', $request->username_admin)->first();
        if ($request->id_admin == '0') {
            if (empty($exist)) {
                $insert = DB::table('users')->insert($data);
                if ($insert) {
                    return ['status' => 'success'];
                } else {
                    return ['status' => 'error'];
                }
            } else {
                return ['status' => 'exist'];
            }
        } else {
            $update = DB::table('users')->where('id', $request->id_admin)->update($data);
            if ($update == 1) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'tidak'];
            }
        }
    }

    public function deleteAdmin(Request $request)
    {
        $delete = DB::table('users')->where('id', $request->id)->delete();
        if ($delete) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function resetAdmin(Request $request)
    {
        $delete = DB::table('users')->where('id', $request->id)->first();
        $data = ['password' => Hash::make($delete->username)];
        $update = DB::table('users')->where('id', $request->id)->update($data);
        if ($update) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function pageAdmin(Request $request)
    {
        // return $request->all();
        $limit = 10;
        $offset = ($request->i - 1) * $limit;
        if ($request->cariText == '' && $request->by != 'aktif') {
            $data = [
                'total' => DB::table('users')->where('id', '!=', Auth::User()->id)->where('level', '1')->get(),
                'data' => DB::table('users')->where('id', '!=', Auth::User()->id)->where('level', '1')->limit($limit)->offset($offset)->get(),
            ];
        } else {
            if ($request->by == 'aktif') {
                $data = [
                    'total' => DB::table('users')->where('id', '!=', Auth::User()->id)->where('level', '1')->where($request->by, $request->cariStatus)->get(),
                    'data' => DB::table('users')->where('id', '!=', Auth::User()->id)->where('level', '1')->where($request->by, $request->cariStatus)->limit($limit)->offset($offset)->get(),
                ];
            } else {
                $data = [
                    'total' => DB::table('users')->where('id', '!=', Auth::User()->id)->where('level', '1')->where($request->by, 'like', '%' . $request->cariText . '%')->get(),
                    'data' => DB::table('users')->where('id', '!=', Auth::User()->id)->where('level', '1')->where($request->by, 'like', '%' . $request->cariText . '%')->limit($limit)->offset($offset)->get(),
                ];
            }
        }
        return ['status' => 'success', 'data' => $data, 'i' => $request->i];
    }

    // END USER ADMIN

    // USER DOKTER

    public function userDokter()
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '',
            'active_sub' => '22',
            'dokter' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->limit(10)->get(),
            'total' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->get(),
        ];
        return view('admin.pages.userDokter.main', $data);
    }

    public function formDokter(Request $request)
    {
        $id = $request->id;
        $data = ['id' => $id];
        $content = view('admin.pages.userDokter.form', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function detailDokter(Request $request)
    {
        $id = $request->id;
        $data = ['id' => $id];
        $content = view('admin.pages.userDokter.detail', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function deleteDokter(Request $request)
    {
        $cari = DB::table('login_dokter as l')->where('l.id', $request->id)->first();
        if ($cari->ttd != '') {
            if (file_exists('ttd/' . $cari->ttd)) {
                unlink('ttd/' . $cari->ttd);
            }
        }
        $userDel = DB::table('users')->where('id', $cari->user_id)->delete();
        $delete = DB::table('login_dokter')->where('id', $request->id)->delete();
        if ($delete) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function resetDokter(Request $request)
    {
        $delete = DB::table('login_dokter as l')->join('users as u', 'u.id', 'l.user_id')->where('l.id', $request->id)->first();
        $data = ['password' => Hash::make($delete->username)];
        $update = DB::table('users')->where('id', $delete->user_id)->update($data);
        if ($update) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function simpanDokter(Request $request)
    {
        $poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli', $request->id_poli)->first();

        // Upload Foto
        $nameFile = '';
        if ($_FILES['ttd']['name'] != '') {
            $ukuranFile1 = filesize($request->ttd);

            if ($ukuranFile1 <= 500000) {
                $ext_foto1 = $request->ttd->getClientOriginalExtension();
                $filename1 = "ttd_" . date('Ymd-His') . "." . $ext_foto1;
                $temp_foto1 = 'ttd/';
                $proses1 = $request->ttd->move($temp_foto1, $filename1);
                $nameFile = $filename1;
            } else {
                $file1 = $_FILES['ttd']['name'];
                if (!empty($file1)) {
                    $direktori1 = "ttd/"; //tempat upload foto
                    $name1 = 'ttd'; //name pada input type file
                    $namaBaru1 = "ttd_" . date('Ymd-His'); //name pada input type file
                    $quality1 = 50; //konversi kualitas gambar dalam satuan %
                    $upload1 = compressFile::UploadCompress($namaBaru1, $name1, $direktori1, $quality1);
                }
                $ext_foto1 = $request->ttd->getClientOriginalExtension();
                $nameFile = $namaBaru1 . "." . $ext_foto1;
            }
        }
        // End upload foto

        $data1 = [
            'poli_id' => $request->id_poli,
            'Nama_Poli' => $poli->NamaPoli,
            'ttd' => $nameFile,
            'jenis_dokter' => $request->jenisdokter,
        ];

        if ($request->id_admin == '0') {
            $exist = DB::table('users')->where('username', $request->username)->first();
            if (empty($exist)) {
                $dataUser = [
                    'nama' => '',
                    'alias' => '',
                    'telp' => '',
                    'alamat' => '',
                    'aktif' => '',
                    'foto_user' => '',
                    'level' => '2',
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                ];

                $insertUser = DB::table('users')->insert($dataUser);
                if ($insertUser) {
                    $userBaru = DB::table('users')->orderBy('id', 'DESC')->first();
                    $dokter = DB::connection('rsu')->table('tm_setupall')->where('groups', 'Dokter')->where('setupall_id', $request->id_dokter)->first();
                    $data2 = [
                        'dokter_id' => $request->id_dokter,
                        'Nama_Dokter' => $dokter->nilaichar,
                        'user_id' => $userBaru->id,
                    ];

                    $data = array_merge($data1, $data2);

                    $insert = DB::table('login_dokter')->insert($data);
                    Session::flash('message', 'Gagal disimpan');
                    if ($insert) {
                        Session::flash('message', 'Berhasil disimpan');
                        return Redirect::to('admin/user/dokter');
                    } else {
                        return Redirect::to('admin/user/dokter');
                    }
                } else {
                    return Redirect::to('admin/user/dokter');
                }
            } else {
                Session::flash('message', 'User Dokter sudah ada');
                return Redirect::to('admin/user/dokter');
            }
        } else {
            $ld = DB::table('login_dokter')->where('id', $request->id_admin)->first();
            if ($_FILES['ttd']['name'] != '') {
                if ($ld->ttd != '') {
                    if (file_exists('ttd/' . $ld->ttd)) {
                        unlink('ttd/' . $ld->ttd);
                    }
                }
            }
            $data = $data1;
            $update = DB::table('login_dokter')->where('id', $request->id_admin)->update($data);
            Session::flash('message', 'Gagal disimpan');
            if ($update) {
                Session::flash('message', 'Berhasil disimpan');
                return Redirect::to('admin/user/dokter');
            } else {
                return Redirect::to('admin/user/dokter');
            }
        }
    }

    public function pageDokter(Request $request)
    {
        // return $request->all();
        $limit = 10;
        $offset = ($request->i - 1) * $limit;
        if ($request->cariText == '' && $request->by != 'aktif') {
            $data = [
                'total' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->get(),
                'data' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->limit($limit)->offset($offset)->get(),
            ];
        } else {
            if ($request->by == 'aktif') {
                $data = [
                    'total' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->where($request->by, $request->cariStatus)->get(),
                    'data' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->where($request->by, $request->cariStatus)->limit($limit)->offset($offset)->get(),
                ];
            } else {
                $data = [
                    'total' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->where($request->by, 'like', '%' . $request->cariText . '%')->get(),
                    'data' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->where($request->by, 'like', '%' . $request->cariText . '%')->limit($limit)->offset($offset)->get(),
                ];
            }
        }
        return ['status' => 'success', 'data' => $data, 'i' => $request->i];
    }

    // END USER DOKTER

    // USER PERAWAT

    public function userPerawat()
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '',
            'active_sub' => '23',
            'dokter' => DB::table('users as u')->where('level', '3')->limit(10)->get(),
            'total' => DB::table('users as u')->where('level', '3')->get(),
        ];
        return view('admin.pages.userPerawat.main', $data);
    }

    public function formPerawat(Request $request)
    {
        $id = $request->id;
        $data = ['id' => $id];
        $content = view('admin.pages.userPerawat.form', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function detailPerawat(Request $request)
    {
        $id = $request->id;
        $data = ['id' => $id];
        $content = view('admin.pages.userPerawat.detail', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function deletePerawat(Request $request)
    {
        $delete = DB::table('users')->where('id', $request->id)->delete();
        if ($delete) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function resetPerawat(Request $request)
    {
        $delete = DB::table('users')->where('id', $request->id)->first();
        $data = ['password' => Hash::make($delete->username)];
        $update = DB::table('users')->where('id', $delete->id)->update($data);
        if ($update) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function simpanPerawat(Request $request)
    {
        // return $request->all();
        $poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli', $request->id_poli)->first();
        // $poli = DB::connection('rsu')->table('tm_poli')->where('KodePoli',$request->id_poli)->first();
        $data1 = [
            'kodePoli' => $request->id_poli,
            'namaPoli' => $poli->NamaPoli,
        ];

        if ($request->id_admin == '0') {
            $exist = DB::table('users')->where('username', $request->username)->orWhere('nama', $request->nama_perawat)->first();
            if (empty($exist)) {
                $dataUser = [
                    'nama' => $request->nama_perawat,
                    'alias' => '',
                    'telp' => '',
                    'alamat' => '',
                    'aktif' => '',
                    'foto_user' => '',
                    'level' => '3',
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'kodePoli' => $request->id_poli,
                    'namaPoli' => $poli->NamaPoli,
                    'is_terapis' => $request->is_terapis,
                ];

                $insertUser = DB::table('users')->insert($dataUser);
                if ($insertUser) {
                    return ['status' => 'success'];
                } else {
                    return ['sttaus' => 'error'];
                }
            } else {
                return ['status' => 'exist'];
            }
        } else {
            $data = $data1;
            $update = DB::table('users')->where('id', $request->id_admin)->update($data);
            if ($update == 1) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'tidak'];
            }
        }
    }

    public function pagePerawat(Request $request)
    {
        // return $request->all();
        $limit = 10;
        $offset = ($request->i - 1) * $limit;
        if ($request->cariText == '' && $request->by != 'aktif') {
            $data = [
                'total' => DB::table('users')->where('level', '3')->get(),
                'data' => DB::table('users')->where('level', '3')->limit($limit)->offset($offset)->get(),
            ];
        } else {
            if ($request->by == 'aktif') {
                $data = [
                    'total' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->where($request->by, $request->cariStatus)->get(),
                    'data' => DB::table('login_dokter as l')->select('l.*', 'u.*', 'l.id as i')->join('users as u', 'u.id', 'l.user_id')->where($request->by, $request->cariStatus)->limit($limit)->offset($offset)->get(),
                ];
            } else {
                $data = [
                    'total' => DB::table('users')->where('level', '3')->where($request->by, 'like', '%' . $request->cariText . '%')->get(),
                    'data' => DB::table('users')->where('level', '3')->where($request->by, 'like', '%' . $request->cariText . '%')->limit($limit)->offset($offset)->get(),
                ];
            }
        }
        return ['status' => 'success', 'data' => $data, 'i' => $request->i];
    }

    // END USER PERAWAT

    // POLI

    public function poli()
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '3',
            'active_sub' => '',
            'poli' => $poli = DB::connection('rsu')->table('tm_poli')->limit(10)->get(),
            'total' => $poli = DB::connection('rsu')->table('tm_poli')->get(),
            // 'poli'=>$poli = DB::connection('rsu')->table('tm_poli')->limit(10)->get(),
            // 'total'=>$poli = DB::connection('rsu')->table('tm_poli')->get(),
        ];
        return view('admin.pages.poli.main', $data);
    }

    public function formPoli(Request $request)
    {
        $id = $request->id;
        $data = ['id' => $id];
        $content = view('admin.pages.poli.form', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function detailPoli(Request $request)
    {
        $id = $request->id;
        $data = ['id' => $id];
        $content = view('admin.pages.poli.detail', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function simpanPoli(Request $request)
    {

        $data = [
            'nama_poli' => $request->nama_poli,
            'status_poli' => $request->status_poli,
        ];
        if ($request->id_poli == '0') {
            $insert = DB::connection('rsu')->table('tm_poli')->insert($data);
            if ($insert) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error'];
            }
        } else {
            $update = DB::connection('rsu')->table('tm_poli')->where('id_poli', $request->id_poli)->update($data);
            if ($update == 1) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'tidak'];
            }
        }
    }

    public function pagePoli(Request $request)
    {
        // return $request->all();
        $limit = 10;
        $offset = ($request->i - 1) * $limit;
        if ($request->cariText == '') {
            $data = [
                'total' => DB::connection('rsu')->table('tm_poli')->get(),
                'data' => DB::connection('rsu')->table('tm_poli')->limit($limit)->offset($offset)->get(),
                // 'total' =>DB::connection('rsu')->table('tm_poli')->get(),
                // 'data' =>DB::connection('rsu')->table('tm_poli')->limit($limit)->offset($offset)->get(),
            ];
        } else {
            $data = [
                'total' => DB::connection('rsu')->table('tm_poli')->where($request->by, 'like', '%' . $request->cariText . '%')->get(),
                'data' => DB::connection('rsu')->table('tm_poli')->where($request->by, 'like', '%' . $request->cariText . '%')->limit($limit)->offset($offset)->get(),
                // 'total'=>DB::connection('rsu')->table('tm_poli')->where($request->by,'like','%'.$request->cariText.'%')->get(),
                // 'data'=>DB::connection('rsu')->table('tm_poli')->where($request->by,'like','%'.$request->cariText.'%')->limit($limit)->offset($offset)->get(),
            ];
        }
        return ['status' => 'success', 'data' => $data, 'i' => $request->i];
    }

    // END POLI

    // REKAP MEDIK

    public function rekapMedik()
    {
        $dokter = DB::table('users')->where('id', Auth::User()->id)->first();
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '4',
            'active_sub' => '',
            'dokter' => $dokter,
            'rekap' => DB::table('rekap_medik as r')->select('no_RM', 'Nama_Pasien')->distinct()->limit(10)->get(),
            'total' => DB::table('rekap_medik as r')->select('no_RM', 'Nama_Pasien')->distinct()->get(),
        ];
        return view('admin.pages.data.main', $data);
    }

    public function pageData(Request $request)
    {
        // return $request->all();
        $dokter = DB::table('users')->where('id', Auth::User()->id)->first();

        $limit = 10;
        $offset = ($request->i - 1) * $limit;
        if ($request->cariText == '' && $request->by != 'tanggalKunjungan') {
            $data = [
                'total' => DB::table('rekap_medik as r')->select('no_RM', 'Nama_Pasien')->distinct()->get(),
                'data' => DB::table('rekap_medik as r')->select('no_RM', 'Nama_Pasien')->limit($limit)->offset($offset)->distinct()->get(),
            ];
        } else {
            if ($request->by == 'tanggalKunjungan') {
                $data = [
                    'total' => DB::table('rekap_medik as r')->where($request->by, 'like', '%' . $request->cariStatus . '%')->where('KodePoli', $dokter->kodePoli)->get(),
                    'data' => DB::table('rekap_medik as r')->where($request->by, 'like', '%' . $request->cariStatus . '%')->where('KodePoli', $dokter->kodePoli)->orderBy('tanggalKunjungan', 'ASC')->limit($limit)->offset($offset)->get(),
                ];
            } else {
                $data = [
                    'total' => DB::table('rekap_medik as r')->select('no_RM', 'Nama_Pasien')->where($request->by, 'like', '%' . $request->cariText . '%')->distinct()->get(),
                    'data' => DB::table('rekap_medik as r')->select('no_RM', 'Nama_Pasien')->where($request->by, 'like', '%' . $request->cariText . '%')->limit($limit)->offset($offset)->distinct()->get(),
                ];
            }
        }
        return ['status' => 'success', 'data' => $data, 'i' => $request->i];
    }

    public function detailRekapPasien(Request $request)
    {
        $dokter = DB::table('users')->where('id', Auth::User()->id)->first();
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '4',
            'no_RM' => $request->id,
            'active_sub' => '',
            'dokter' => $dokter,
            'rekap' => DB::table('rekap_medik as r')->where('no_RM', $request->id)->orderBy('tanggalKunjungan', 'DESC')->limit(10)->get(),
            'total' => DB::table('rekap_medik as r')->where('no_RM', $request->id)->get(),
        ];

        return view('admin.pages.data.detail', $data);
    }

    public function pageDataDetail(Request $request)
    {
        // return $request->all();
        $dokter = DB::table('users')->where('id', Auth::User()->id)->first();

        $limit = 10;
        $offset = ($request->i - 1) * $limit;
        if ($request->cariText == '' && $request->by != 'tanggalKunjungan') {
            $data = [
                'total' => DB::table('rekap_medik as r')->where('no_RM', $request->no_RM)->where('NamaDokter', '!=', null)->orderBy('tanggalKunjungan', 'DESC')->get(),
                'data' => DB::table('rekap_medik as r')->limit($limit)->offset($offset)->where('no_RM', $request->no_RM)->where('NamaDokter', '!=', null)->get(),
            ];
        } else {
            if ($request->by == 'tanggalKunjungan') {
                $data = [
                    'total' => DB::table('rekap_medik as r')->where($request->by, 'like', '%' . $request->cariStatus . '%')->where('NamaDokter', '!=', null)->get(),
                    'data' => DB::table('rekap_medik as r')->where($request->by, 'like', '%' . $request->cariStatus . '%')->where('NamaDokter', '!=', null)->orderBy('tanggalKunjungan', 'ASC')->limit($limit)->offset($offset)->get(),
                ];
            } else {
                $data = [
                    'total' => DB::table('rekap_medik as r')->where('no_RM', $request->no_RM)->where($request->by, 'like', '%' . $request->cariText . '%')->where('NamaDokter', '!=', null)->get(),
                    'data' => DB::table('rekap_medik as r')->where('no_RM', $request->no_RM)->where($request->by, 'like', '%' . $request->cariText . '%')->where('NamaDokter', '!=', null)->orderBy('tanggalKunjungan', 'DESC')->limit($limit)->offset($offset)->get(),
                ];
            }
        }
        return ['status' => 'success', 'data' => $data, 'i' => $request->i];
    }

    public function formTambahRekapMedik()
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '4',
            'active_sub' => '',
        ];
        return view('admin.pages.add.content', $data);
    }

    public function modalDetailPasien(Request $request)
    {
        if ($request->rm == 'Budiman') {
            $rm = 'Budiman';
        } else {
            $rm = '';
        }
        $data = ['rm' => $rm];
        $content = view('admin.pages.modal.detailpasien', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function modalTambahObat(Request $request)
    {
        $content = view('admin.pages.modal.tambahobat')->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function modalTambahLaborat(Request $request)
    {
        $content = view('admin.pages.modal.tambahlaborat')->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function modalTambahRadio(Request $request)
    {
        $content = view('admin.pages.modal.tambahradiologi')->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function gantiRekap(Request $request)
    {
        if (Session::has('id_rekap')) {
            return Redirect::to($_SERVER['HTTP_REFERER'])->with('title', 'Whooops')->with('message', 'Anda sedang menangani pasien')->with('type', 'warning');
        } else {
            $data = DB::table('rekap_medik')->where('id_rekapMedik', $request->id)->first();
            // $data = DB::connection('rsu')table('tr_tracer')->where('No_Register',$request->id)->first();

            Session::put('no_RM', $data->no_RM);
            Session::put('id_rekap', $data->id_rekapMedik);
            return Redirect::route('content2');
        }
    }

    // END REKAP MEDIK



    /*===============================================================
    ======================== PROFILE ADMIN ==========================
    ===============================================================*/
    public function profile()
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '',
            'active_sub' => '',
        ];
        return view('admin.pages.profile.main', $data);
    }

    public function formUbahPasswordAdmin()
    {
        $content =  view('admin.pages.profile.form')->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function updatePasswordAdmin(Request $request)
    {
        $user = User::find(Auth::User()->id);
        // return $user;
        if (Hash::check($request->lama, $user->password) == true) {
            $user->password = Hash::make($request->baru);
            $user->save();
            $hasil = 'Success';
            $message = 'Berhasil diupdate';
            $type = 'success';
        } else {
            $hasil = 'Gagal';
            $message = 'Gagal diupdate, Password lama anda salah';
            $type = 'error';
        }
        return Redirect::route('profileAdmin')->with('title', $hasil)->with('message', $message)->with('type', $type);
    }

    // END PROFIL
    // TERMIN
    public function term()
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '5',
            'active_sub' => '51',
        ];
        return view('admin.pages.termin.main', $data);
    }

    public function updateTerm(Request $request)
    {
        // return $request->all();
        DB::table('identitas')->where('id_identitas', '1')->update(['info' => $request->syarat]);
        return Redirect::route('term')->with('title', 'Success')->with('message', 'Perubahan berhasil disimpan')->with('type', 'success');
    }
    // END TERMIN
    // LOGO
    public function logo()
    {
        $data = [
            'identitas' => Identitas::find(1),
            'active' => '5',
            'active_sub' => '52',
        ];
        return view('admin.pages.icon.main', $data);
    }

    public function updateLogo(Request $request)
    {
        $iden = Identitas::find(1);
        if ($iden->favicon != '') {
            if (!file_exists($iden->favicon)) {
                unlink($iden->favicon);
            }
        }

        if ($request->logo != '') {
            $ext_foto1 = $request->logo->getClientOriginalExtension();
            $filename1 = "Logo_" . date('Ymd-His') . "." . $ext_foto1;
            $temp_foto1 = 'logo/';
            $proses1 = $request->logo->move($temp_foto1, $filename1);
            // return $request->all();
            $logo = 'logo/' . $filename1;
        } else {
            $logo = $iden->favicon;
        }

        $data = [
            'favicon' => $logo,
            'tanya' => $request->tanya,
            'jawab' => $request->jawab,
        ];
        DB::table('identitas')->where('id_identitas', '1')->update($data);
        return Redirect::route('logo')->with('title', 'Success')->with('message', 'Perubahan berhasil disimpan')->with('type', 'success');
    }
    // END LOGO

    /*
    if(!empty($request->foto)){
        $ukuranFile1 = filesize($request->icon);
        if(!file_exists("adminasset/assets/images/datamaster/barang")){
            unlink("adminasset/assets/images/datamaster/barang");
        }

        if ($ukuranFile1 <= 500000) {
            $ext_foto1 = $request->foto->getClientOriginalExtension();
            $filename1 = "img_barang_".date('Ymd-His').".".$ext_foto1;
            $temp_foto1 = 'adminasset/assets/images/datamaster/barang';
            $proses1 = $request->foto->move($temp_foto1, $filename1);
            $barang->photo = $filename1;
        }else{
            $file1=$_FILES['foto']['name'];
            if(!empty($file1)){
                $direktori1="adminasset/assets/images/datamaster/barang"; //tempat upload foto
                $name1='foto'; //name pada input type file
                $namaBaru1="img_barang_".date('Ymd-His'); //name pada input type file
                $quality1=50; //konversi kualitas gambar dalam satuan %
                $upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
            }
            $ext_foto1 = $request->foto->getClientOriginalExtension();
            $barang->photo = $namaBaru1.".".$ext_foto1;
        }
    }
    */

    public function pdf(Request $request)
    {

        // instantiate and use the dompdf class
        $dompdf = new PDF();
        // $dompdf->loadHtml('hello world');

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        // $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
