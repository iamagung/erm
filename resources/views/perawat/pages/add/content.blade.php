@extends('perawat.master.main')
@section('content')

@if(in_array(Auth::user()->kodePoli, ['123']))
<style type="text/css">
    .buletan {
        border: 1px solid #0dad0a;
        color: #0dad0a;
        background: #fff;
    }
    .round-tabs{
        padding: 6px 6px;
        line-height: 0px !important;
    }
    .liner {
        left: 0 !important;
        right: 57% !important;
        width: 28% !important;
    }
    .active {
        font-weight: bold;
    }
</style>
@else
<style type="text/css">
    #myTab {
        display: flex;
        justify-content: center;
    }
    .round-tabs{
        padding: 6px 6px;
        line-height: 0px !important;
    }
    .liner {
        left: 0 !important;
        right: 55% !important;
        width: 10% !important;
    }
    .active {
        font-weight: bold;
    }
</style>
@endif

<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">
    <h1 class="text-center">
        <b id="page_title">{{$title}}</b>
    </h1>
</section>
<div class="col-lg-12 col-md-12 refreshContent">
    @if(in_array(Auth::user()->kodePoli, ['123',]))
    <div class="board-inner">
        <div class="liner" style="top: 40% !important;"></div>
        <ul class="nav nav-tabs" id="myTab">
            <?php
                $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
                $display2='';
                $display3='';

                if($rekap->tekanan_darah == '' || $rekap->frek_nadi == '' || $rekap->suhu == '' || $rekap->frek_nafas == '' || $rekap->skor_nyeri == '' || $rekap->skor_jatuh == '' || $rekap->berat_badan == '' || $rekap->tinggi_badan == '' || $rekap->lingkar_kepala == '' || $rekap->agama == '' || $rekap->pendidikan == '' || $rekap->pekerjaan == ''){
                    $display3 = 'display:none';
                }
                if($rekap->persetujuan==''){
                    $display2 = 'display: none';
                    $display3 = 'display: none';
                }
                $active = ['','','','','','','',''];
                switch ($content) {
                    case '1':
                        $active[0]='active';
                        break;
                    case '2':
                        $active[1]='active';
                        break;
                    case '3':
                        $active[2]='active';
                        break;
                    case '4':
                        $active[3]='active';
                        break;
                    case '5':
                        $active[4]='active';
                        break;
                    case '6':
                        $active[5]='active';
                        break;
                    case '7':
                        $active[6]='active';
                        break;
                    case '8':
                        $active[7]='active';
                        break;
                    
                    default:
                        # code...
                        break;
                }
            ?>
            <li class='{{$active[7]}}' style="text-align:center;">
                <a href="{{route('contentGizi')}}" title="Assesmen Gizi">
                    <span class="round-tabs buletan">
                        <img src="{!! asset('adminAsset/img/icon/gizi.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Assesment Gizi</span>
            </li>
            <li class='{{$active[1]}}' style="text-align:center;">
                <a href="{{route('content2')}}" title="Pengkajian Awal Pasien Rawat Jalan">
                    <span class="round-tabs two">
                        <img src="{!! asset('adminAsset/img/icon/1.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Pengkajian Awal</span>
            </li>
            <li class='{{$active[2]}}' style="text-align:center;">
                <a href="{{route('content3')}}" title="Formulir Edukasi Pasien & Keluarga Terintegrasi Rawat Jalan">
                    <span class="round-tabs three">
                        <img src="{!! asset('adminAsset/img/icon/2.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Edukasi</span>
            </li>
            <li class='{{$active[3]}}' style="text-align:center;">
                <a href="{{route('content4')}}" title="Ringkasan Medis Pasien">
                    <span class="round-tabs four">
                        <img src="{!! asset('adminAsset/img/icon/3.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Ringkasan Medis</span>
            </li>
            <li class='{{$active[4]}}' style="text-align:center;">
                <a href="{{route('content5')}}" title="Riwayat Resep">
                    <span class="round-tabs five">
                        <img src="{!! asset('adminAsset/img/icon/4.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Riwayat Resep</span>
            </li>
            <li class='{{$active[5]}}' style="text-align:center;">
                <a href="{{route('content6')}}" title="Hasil Laboratorium">
                    <span class="round-tabs six">
                        <img src="{!! asset('adminAsset/img/icon/5.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Hasil Lab</span>
            </li>
            <li class='{{$active[6]}}' style="text-align:center;">
                <a href="{{route('content7')}}" title="Hasil Radiologi">
                    <span class="round-tabs seven">
                        <img src="{!! asset('adminAsset/img/icon/6.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Radiologi</span>
            </li>
        </ul>
    </div>
    @else
    <div class="board-inner">
        <div class="liner" style="top: 40% !important;"></div>
        <ul class="nav nav-tabs" id="myTab">
            <?php
                $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
                $display2='';
                $display3='';

                if($rekap->tekanan_darah == '' || $rekap->frek_nadi == '' || $rekap->suhu == '' || $rekap->frek_nafas == '' || $rekap->skor_nyeri == '' || $rekap->skor_jatuh == '' || $rekap->berat_badan == '' || $rekap->tinggi_badan == '' || $rekap->lingkar_kepala == '' || $rekap->agama == '' || $rekap->pendidikan == '' || $rekap->pekerjaan == ''){
                    $display3 = 'display:none';
                }
                if($rekap->persetujuan==''){
                    $display2 = 'display: none';
                    $display3 = 'display: none';
                }
                $active = ['','','','','','',''];
                switch ($content) {
                    case '1':
                        $active[0]='active';
                        break;
                    case '2':
                        $active[1]='active';
                        break;
                    case '3':
                        $active[2]='active';
                        break;
                    case '4':
                        $active[3]='active';
                        break;
                    case '5':
                        $active[4]='active';
                        break;
                    case '6':
                        $active[5]='active';
                        break;
                    case '7':
                        $active[6]='active';
                        break;
                    
                    default:
                        # code...
                        break;
                }
            ?>
            <!-- <li class="{{$active[0]}}">
                <a href="{{route('content1')}}" title="Syarat dan Ketentuan">
                    <span class="round-tabs one">
                        <b style="font-size: 35px;">1</b>
                    </span>
                </a>
            </li> -->
            <li class='{{$active[1]}}' style="text-align:center;">
                <a href="{{route('content2')}}" title="Pengkajian Awal Pasien Rawat Jalan">
                    <span class="round-tabs two">
                        <!-- <b style="font-size: 35px;">1</b> -->
                        <img src="{!! asset('adminAsset/img/icon/1.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Pengkajian Awal</span>
            </li>
            <li class='{{$active[2]}}' style="text-align:center;">
                <a href="{{route('content3')}}" title="Formulir Edukasi Pasien & Keluarga Terintegrasi Rawat Jalan">
                    <span class="round-tabs three">
                        <!-- <b style="font-size: 35px;">2</b> -->
                        <img src="{!! asset('adminAsset/img/icon/2.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Edukasi</span>
            </li>
            <li class='{{$active[3]}}' style="text-align:center;">
                <a href="{{route('content4')}}" title="Ringkasan Medis Pasien">
                    <span class="round-tabs four">
                        <!-- <b style="font-size: 35px;">3</b> -->
                        <img src="{!! asset('adminAsset/img/icon/3.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Ringkasan Medis</span>
            </li>
            <li class='{{$active[4]}}' style="text-align:center;">
                <a href="{{route('content5')}}" title="Riwayat Resep">
                    <span class="round-tabs five">
                        <!-- <b style="font-size: 35px;">4</b> -->
                        <img src="{!! asset('adminAsset/img/icon/4.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Riwayat Resep</span>
            </li>
            <li class='{{$active[5]}}' style="text-align:center;">
                <a href="{{route('content6')}}" title="Hasil Laboratorium">
                    <span class="round-tabs six">
                        <!-- <b style="font-size: 35px;">5</b> -->
                        <img src="{!! asset('adminAsset/img/icon/5.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Hasil Lab</span>
            </li>
            <li class='{{$active[6]}}' style="text-align:center;">
                <a href="{{route('content7')}}" title="Hasil Radiologi">
                    <span class="round-tabs seven">
                        <!-- <b style="font-size: 35px;">6</b> -->
                        <img src="{!! asset('adminAsset/img/icon/6.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Radiologi</span>
            </li>
            <!-- <li class='{{$active[6]}}' style="text-align:center;">
                <a href="#" title="Data Tarif & Tindakan" onclick="alert('Menu Belum Tersedia');">
                    <span class="round-tabs seven">
                        <b style="font-size: 35px;">7</b>
                        <img src="{!! asset('adminAsset/img/icon/1.png') !!}">
                    </span>
                </a>
                <span class="text-success" style="position: relative; bottom: 15px;">Tarif & Tindakan</span>
            </li> -->
        </ul>
    </div>
    @endif
</div>
<div class="clearfix" style="margin-bottom: 10px"></div>
<div class="col-md-12 col-md-12">

    <div class="box">

        <div class="box-header">

            <div class="box-tools">
                <div class="col-lg-6 col-md-6">
                    <!-- <div id="namaPerawat">
                        <label class="col-lg-4 col-md-4" style="margin-top: 10px">Nama Perawat</label>
                        <div class="col-lg-8 col-md-8">
                            <input type="text" id="inputNamaPerawat" class="form-control" style="border-radius: 10px !important" placeholder="Nama Perawat">
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <button class="btn btn-default btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-default btn-sm pull-right" id="refreshbtn" title="Refresh" onclick="refreshtahap2()"><i class="fa fa-refresh"></i></button>
                </div>

            </div>

        </div>

        <div class="box-body">
            <div class="tab-content">
                <div class="" id="tahap1">
                    @include($include)
                </div>
            </div>
        </div>
    </div>

</section>
@stop
@section('js')
<script type="text/javascript">

    function refreshtahap2(){
    //     $(".syaratClass").load(location.href + " .syaratClass>*", "");
    //     $(".tahap21").load(location.href + " .tahap21>*", "");
    //     $(".tahap31").load(location.href + " .tahap31>*", "");
    //     $(".tahap41").load(location.href + " .tahap41>*", "");
    //     $(".tahap51").load(location.href + " .tahap51>*", "");
    //     $(".tahap61").load(location.href + " .tahap61>*", "");
    //     $(".tahap71").load(location.href + " .tahap71>*", "");
        // $(".refreshContent").load(location.href + " .refreshContent>*", "");
        location.reload();
    }

    $('#namaPerawat').hide();
    $('.box-header').css({"background":""});
    function title_page(title){
        if(title=='Pengkajian Pasien Rawat Jalan - POLI DALAM'){
            $('#namaPerawat').hide();
            $('#refreshbtn').show();
            $('.box-header').css({"background":""});
        }else if(title=='Ringkasan Medis Rawat Jalan'){
            $('#namaPerawat').hide();
            $('#refreshbtn').show();
            $('.box-header').css({"background":""});
        }else{
            $('#namaPerawat').hide();
            $('#refreshbtn').show();
            $('.box-header').css({"background":""});
        }
        $('#page_title').html(title);
    }
</script>

<script type="text/javascript">
    $('#inputNamaPerawat').keyup(function(){
        var nama = $('#inputNamaPerawat').val();
        $('#NamaPerawatPakai').val(nama);
    });
</script>
@stop