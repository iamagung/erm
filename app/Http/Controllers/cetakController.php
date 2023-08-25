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

date_default_timezone_set('Asia/Jakarta');

class cetakController extends Controller
{
    public function cetak1(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();

        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml(view('cetak.cetakTahap1',$data));
            // download pdf
            return $pdf->download($syarat->no_RM.'Tahap_1.pdf');
        }
        return view('cetak.cetakTahap1',$data);
    }

    public function cetak2(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();

        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml(view('cetak.cetakTahap2',$data));
            // download pdf
            return $pdf->download($syarat->no_RM.'Tahap_2.pdf');
        }
        return view('cetak.cetakTahap2',$data);
    }

    public function cetak3(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();
        
        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml(view('cetak.cetakTahap3',$data));
            // download pdf
            return $pdf->download($syarat->no_RM.'Tahap_3.pdf');
        }
        return view('cetak.cetakTahap3',$data);
    }

    public function cetak4(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();
        
        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml(view('cetak.cetakTahap4',$data));
            // download pdf
            return $pdf->download($syarat->no_RM.'Tahap_4.pdf');
        }
        return view('cetak.cetakTahap4',$data);
    }

    public function cetak5(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();
        
        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml(view('cetak.cetakTahap5',$data));
            // download pdf
            return $pdf->download($syarat->no_RM.'Tahap_5.pdf');
        }
        return view('cetak.cetakTahap5',$data);
    }

    public function cetak6(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();
        
        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml(view('cetak.cetakTahap6',$data));
            // download pdf
            return $pdf->download($syarat->no_RM.'Tahap_6.pdf');
        }
        return view('cetak.cetakTahap6',$data);
    }

    public function cetak7(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();
        
        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml(view('cetak.cetakTahap7',$data));
            // download pdf
            return $pdf->download($syarat->no_RM.'Tahap_7.pdf');
        }
        return view('cetak.cetakTahap7',$data);
    }

    public function pdfview(Request $request)
    {
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();
        
        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        switch ($request->id) {
            case '1':
                $view = 'cetak.cetakTahap1';
                break;
            case '2':
                $view = 'cetak.cetakTahap2';
                break;
            case '3':
                $view = 'cetak.cetakTahap3';
                break;
            case '4':
                $view = 'cetak.cetakTahap4';
                break;
            case '5':
                $view = 'cetak.cetakTahap5';
                break;
            case '6':
                $view = 'cetak.cetakTahap6';
                break;
            case '7':
                $view = 'cetak.cetakTahap7';
                break;
            
            default:
                $view = '';
                break;
        }

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml('pdfview');
            // download pdf
            return $pdf->stream();
        }
        return view('pdfview');
    }

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
    public function cetak8(Request $request){
        $iden = DB::table('identitas')->where('id_identitas','1')->first();
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $syarat2 = DB::table('rekam_medis_lanjutan')->where('rekam_medis_id',Session::get('id_rekap'))->first();
        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',$syarat->no_RM)->first();
        
        $download = '';
        if($request->has('download')){
            $download = $request->has('download');
        }
        $data = [
            'iden'=>$iden,
            'customer'=>$customer,
            'syarat'=>$syarat,
            'download'=>$download,
        ];

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
            // pass view file
            $pdf = PDF::loadHtml(view('cetak.cetakTahap8',$data));
            // download pdf
            return $pdf->download($syarat->no_RM.'Tahap_8.pdf');
        }
        return view('cetak.cetakTahap8',$data);
    }
}
