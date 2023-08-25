@extends('admin.master.main')
@section('css')
<style type="text/css">
	.select2-container--default .select2-selection--single {
		display: block;
		width: 100%;
		height: calc(2.5em + .1rem + 2px);
		padding: .175rem .5rem;
		font-size: 10pt;
		line-height: .8;
		color: #4f5467;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #e9ecef;
		border-radius: 2px;
		transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 35px;
	}
	.select2-container {
		display: block;
	}

	.select2-drop {
		border: 1px solid #e9ecef;
	}
</style>
@endsection
@section('content')

<!-- <script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script> -->
<section class="content-header">

    <h1 class="">

        <b>GRAFIK KUNJUNGAN PASIEN</b>

    </h1>

</section>
<!-- <div class="col-lg-12 col-md-12" style="padding: 0px">
    <div class="col-lg-12 col-md-12">
        <i>Gunakan Nomor RM</i> 
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="col-lg-8 col-md-8" style="padding: 0px">
            <input type="text" class="form-control" name="id" placeholder="Example: " style="border-radius: 10px !important">
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix" style="margin-bottom: 10px"></div>
<div class="col-lg-12 col-md-12" style="padding: 0px">
    <div class="col-lg-12 col-md-12" style="padding: 0px">
        <div class="col-lg-4 col-md-4" style="padding: 0px">
            <div class="col-lg-6 col-md-6">
                <input type="button" class="btn btn-primary" style="border-radius: 10px !important;width: 100%" value="Cek" id="btnCek" disabled>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div> -->
<div class="clearfix" style="margin-bottom: 10px"></div>
<div class="col-md-12 col-md-12">

    <div class="box">

        {{-- <div class="box-header">

            <div class="box-tools pull-right">

                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>

            </div>

        </div> --}}

        <div class="box-body">
            <div class="col-lg-12 col-md-12">
                <b style="font-size:18pt;">GRAFIK</b>
            </div>
            <div class="col-lg-12 col-md-12"><hr></div>
            <div class="col-lg-12 col-md-12">
                <form method="post" action="#" id="chartForm">
                    {{ csrf_field() }}
                    <div class="col-lg-3 col-md-3">
                        <label for="range_umur">Range Umur Pasien</label>
                        <select class="form-control" name="range_umur" id="range_umur" class="js-example-basic-single">
                            {{-- <option value="semua" selected>Semua Umur</option>
                            <option value="balita">Balita</option>
                            <option value="anak">Anak - anak</option>
                            <option value="remaja">Remaja</option>
                            <option value="dewasa">Dewasa</option>
                            <option value="lansia">Lansia / Geriatri</option> --}}
                            <option value="0,73000" selected>Semua</option>
                            <option value="0,6">0-6 Hari</option>
                            <option value="6,28">7-28 hari</option>
                            <option value="28,365">28 hari-1 tahun</option>
                            <option value="365,1460">1-4 tahun</option>
                            <option value="1460,5110">5-14 tahun</option>
                            <option value="5110,8760">15-24 tahun</option>
                            <option value="8760,16060">25-44 tahun</option>
                            <option value="16060,23360">45-64 tahun</option>
                            <option value="23360,73000">diatas 65 tahun</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="semua" selected>Semua Jenis Kelamin</option>
                            <option value="L">Laki - laki</option>
                            <option value="P">Perempuan</option>
                            <option value="3">Tidak dapat ditentukan</option>
                            <option value="4">Tidak mengisi</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <label for="jenis_pasien">Jenis Pasien</label>
                        <select class="form-control" name="jenis_pasien" id="jenis_pasien">
                            <option value="semua" selected>Semua Jenis Pasien</option>
                            <option value="Y">Pasien Baru</option>
                            <option value="N">Pasien Lama</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <label for="pilih_poli">Pilih Poli</label>
                        <select class="form-control" name="pilih_poli" id="pilih_poli">
                            <option value="semua" selected>Semua Poli</option>
                            @foreach ($poli as $p)
                                <option value="{{$p->kdpoli}}">{{$p->NamaPoli}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3" style="margin-top: 16px">
                        <label for="group_by">Tampilkan Grafik Berdasarkan</label>
                        <select class="form-control" name="group_by" id="group_by">
                            <option value="month">Bulan</option>
                            <option value="year" selected>Tahun</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3" style="margin-top: 16px">
                        <label for="tahun_mulai">Tahun Mulai</label>
                        <input type="text" name="tahun_mulai" id="tahun_mulai" value="<?php echo $kunjungan[0]->group_by ?>" class="form-control" style="width: 100%" readonly>
                    </div>
                    <div class="col-lg-3 col-md-3" style="margin-top: 16px">
                        <label for="tahun_akhir">Tahun Akhir</label>
                        <input type="text" name="tahun_akhir" id="tahun_akhir" value="<?php echo $kunjungan[0]->group_by ?>" class="form-control" style="width: 100%" readonly>
                    </div>
                    <div class="col-lg-3 col-md-3" style="margin-top: 16px">
                        <label for="alamat">Alamat Pasien</label>
                        <select class="form-control" name="alamat" id="alamat">
                            <option value="semua" selected>Semua Alamat</option>
                            <option value="3576">Dalam Kota Mojokerto</option>
                            <option value="3516">Luar Kota Mojokerto</option>
                        </select>
                    </div>
                    {{-- <div class="col-lg-3 col-md-3">
                        <input class="form-control lahir" type="text" name="tgl" placeholder="2018-03-09" value="{{$tgl}}" readonly>
                    </div> --}}
                    <input type="button" value="Cari" onclick="formChange()" class="btn btn-primary" style="width: 20%; margin-left: 20px; margin-top: 20px">
                </form>
            </div>
            <div class="col-lg-12 col-md-12"><hr></div>
            <div class="col-lg-12 col-md-12" style="border: 1px;border-color: #4f5467">
                <div id="loading" style="display: none;">
                    <center style="margin-top: 100px;"><img src="{!! url('adminAsset/img/loading.gif') !!}"></center>
                </div>
                <div id="chartContainer" style="margin-top: 20px"></div>
            </div>
            <code> 

                <h5><div class="text-right" id="time"></div><div style="text-align: right"><?php  echo date("D, d M Y");  ?></div></h5>

            </code>
            <div class="clearfix"></div>
        </div>
        <?php
        ?>

    </div>
    <div class="modal_layout"></div>

</section>


@stop
@section('js')
<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<script src="{!! asset('adminAsset/js/export.js') !!}"></script>

<?php
    if($tgl==''){
        $tgl = date('Y-m-d');
    }
    $tgl1 = strtotime('-6 day' , strtotime($tgl));
    $tgle = date('Y-m-d' , $tgl1);

?>
<script type="text/javascript">
    var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Decsember" ]
    // var range_umur = '';
    // var jenis_kelamin = '';
    // var jenis_pasien = '';
    // var pilih_poli = '';
    // var grafik_by = '';
    // var tahun_mulai = '';
    // var tahun_akhir = '';
    // var alamat = '';

    $(document).ready(function() {
        $('#range_umur').select2();
        $('#jenis_kelamin').select2();
        $('#jenis_pasien').select2();
        $('#group_by').select2();
        $('#alamat').select2();
        $('#pilih_poli').select2();

        Highcharts.chart('chartContainer', {
            chart: {
                type: 'line'
            },
            title: {
                text: '<b style="font-size: 12pt">' +
                    $('#range_umur option:selected').text() + 
                    ', ' + $('#jenis_kelamin option:selected').text() +
                    ', ' + $('#jenis_pasien option:selected').text() +
                    ', ' + $('#pilih_poli option:selected').text() +
                    ', ' + $('#alamat option:selected').text() + '</b>',
            },
            xAxis: {
                categories: [ <?php foreach ($kunjungan as $key) {
                    echo "'$key->group_by',";
                } ?> 
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah pasien'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                },
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                        {
                            name: 'Pasien',
                            data: [
                                <?php foreach ($kunjungan as $key) {
                                    echo "$key->pasien,";
                                } ?>
                            ]
                        },
                    ]
            // [
            // <?php $poli = count(DB::connection('rsu')->table('tr_tracer')->select('Kode_Poli','NamaPoli')->whereBetween('Tgl_Register', ['2022-01-01', '2023-12-30'])->distinct()->get()); ?>
            //     {
            //         name: $kunjungan,
            //         data: [
            //             <?php echo "$poli," ?>
            //         ]

            //     },
            // ]
        }); 
    });
    $('#tahun_mulai').datetimepicker({
        //language:  'fr',
        // weekStart: 1,
        // todayBtn:  1,
        // autoclose: 1,
        // todayHighlight: 1,
        startView: 4,
        format:'yyyy',
        minView: 4,
        forceParse: 0,
        autoclose: true
    });
    $('#tahun_akhir').datetimepicker({
        //language:  'fr',
        // weekStart: 1,
        // todayBtn:  1,
        // autoclose: 1,
        // todayHighlight: 1,
        startView: 4,
        format:'yyyy',
        minView: 4,
        forceParse: 0,
        autoclose: true
    });

    $(function() {
        startTime();
        $(".center").center();
        $(window).resize(function() {
            $(".center").center();
        });
    });

    /*  */
    function startTime()
    {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();

        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);

        //Check for PM and AM
        var day_or_night = (h > 11) ? "PM" : "AM";

        //Convert to 12 hours system
        if (h > 12)
            h -= 12;

        //Add time to the headline and update every 500 milliseconds
        $('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
        setTimeout(function() {
            startTime()
        }, 500);
    }

    function formChange() {
        data = new FormData($('#chartForm')[0]);
        $('#loading').show();
        $('#chartContainer').hide();
        $.ajax({
            url: "{{route('kunjunganChart')}}",
            type: 'POST',
			data: data,
			async: true,
			cache: false,
			contentType: false,
			processData: false,
        }).done(function(data) {
            $('#loading').hide();
            $('#chartContainer').show();
            console.log(data);
            var chart_group_by = [];
            var chart_pasien = [];
            var per_tahun = [];
            var tahun_mulai = parseInt($("#tahun_mulai").val());
            var tahun_akhir = parseInt($("#tahun_akhir").val());
            if($("#group_by").val() == 'year') {
                for (let index = tahun_mulai; index <= tahun_akhir; index++) {
                    tot_th = 0;
                    data.forEach(e => {
                        if(parseInt(e.group_by) == index){
                            tot_th+=parseInt(e.pasien);
                        }
                    });
                    chart_group_by.push(''+index+'');
                    chart_pasien.push(tot_th);
                    // let found = data.find(e => e.group_by == index);
                    // if(found != undefined) {
                    //     chart_group_by.push(found.group_by);
                    //     chart_pasien.push(found.pasien);
                    // } else {
                    //     chart_group_by.push(''+index+'');
                    //     chart_pasien.push(0);
                    // }
                    
                }
            } else {
                for (let index = tahun_mulai; index <= tahun_akhir; index++) {
                    for (let dex = 1; dex <= 12; dex++) {
                        tot_th = 0;
                        data.forEach(e => {
                            if(parseInt(e.month) == dex && parseInt(e.group_by) == index){
                                tot_th+=parseInt(e.pasien);
                            }
                        });
                        chart_group_by.push(bulan[dex-1]+'-'+index);
                        chart_pasien.push(tot_th);
                    }
                    
                    // let found = data.find(e => e.group_by == index);
                    // if(found != undefined) {
                    //     chart_group_by.push(found.group_by);
                    //     chart_pasien.push(found.pasien);
                    // } else {
                    //     chart_group_by.push(''+index+'');
                    //     chart_pasien.push(0);
                    // }
                    
                }
            }
            // data.forEach(e => {
            //     if(parseInt(e.group_by) == parseInt(data[data.length - 1].group_by)) {
            //         chart_group_by.push(e.group_by);
            //         chart_pasien.push(e.pasien);
            //         for (let index = (parseInt(e.group_by) + 1); index <= tahun_akhir; index++) {
            //             chart_group_by.push(''+index+'');
            //             chart_pasien.push(0);
            //         }
            //     } else {
            //         for (let index = tahun_mulai; index < parseInt(e.group_by); index++) {
            //             chart_group_by.push(''+index+'');
            //             chart_pasien.push(0);
            //             tahun_mulai++;
            //         }
            //         chart_group_by.push(e.group_by);
            //         chart_pasien.push(e.pasien);
            //     }
            // });
            Highcharts.chart('chartContainer', {
            chart: {
                type: 'line'
            },
            title: {
                text: '<b style="font-size: 12pt">' +
                    $('#range_umur option:selected').text() + 
                    ', ' + $('#jenis_kelamin option:selected').text() +
                    ', ' + $('#jenis_pasien option:selected').text() +
                    ', ' + $('#pilih_poli option:selected').text() +
                    ', ' + $('#alamat option:selected').text() + '</b>',
            },
            xAxis: {
                categories: chart_group_by,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah pasien'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                },
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                        {
                            name: 'Pasien',
                            data: chart_pasien,
                        },
                    ]
            // [
            // <?php $poli = count(DB::connection('rsu')->table('tr_tracer')->select('Kode_Poli','NamaPoli')->whereBetween('Tgl_Register', ['2022-01-01', '2023-12-30'])->distinct()->get()); ?>
            //     {
            //         name: $kunjungan,
            //         data: [
            //             <?php echo "$poli," ?>
            //         ]

            //     },
            // ]
        }); 
        }).fail(function() {
            $('#loading').hide();
            console.log('gagal');
            swal("MAAF!", "Terjadi Kesalahan, Silahkan Ulangi Kembali !!", "warning");
        })
    }

    function checkTime(i)
    {
        if (i < 10)
        {
            i = "0" + i;
        }
        return i;
    }
    
    function getDistance() {
        var mulai = parseInt($('#tahun_mulai').value);
        var akhir = parseInt($('#tahun_akhir').value);
        var range = new Array();

        for (let index = mulai; index <= akhir; index++) {
            range.push(index);
        }
        console.log(mulai);

        return range;
    }
</script>
<script type="text/javascript">
    $('input[name=id]').keyup(function(){
        var rm = $('input[name=id]').val();
        if(rm==''){
            $('#btnCek').attr('disabled','disabled');
        }else{
            $('#btnCek').removeAttr('disabled');
        }
        // return alert(rm);
    });

    $('#btnCek').click(function(){
        var rm = $('input[name=id]').val();
        $.post("{!! route('modalDetailPasien') !!}",{rm:rm}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout').html(data.content);
                $('.modal_layout').show();
                $('#myModal').modal('show');
            }
        })
    });

</script>
@stop