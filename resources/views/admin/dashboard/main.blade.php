@extends('admin.master.main')
@section('content')

<!-- <script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script> -->
<section class="content-header">

    <h1 class="text-center">

        <b>.: Selamat Datang di Halaman Rekam Medis :.</b>

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

        <div class="box-header">

            <div class="box-tools pull-right">

                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>

            </div>

        </div>

        <div class="box-body">
            <div class="col-lg-12 col-md-12">
                <form method="post" action="{!! route('dashboardAdminchart') !!}">
                    {{ csrf_field() }}
                    <div class="col-lg-4 col-md-4" style="padding: 0px">
                        <input class="form-control lahir" type="text" name="tgl" placeholder="2018-03-09" value="{{$tgl}}" readonly>
                    </div>
                    <input type="submit" value="Cari" class="btn btn-primary">
                </form>
            </div>
            <div class="col-lg-12 col-md-12">
                <div id="container"></div>
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

    $('.lahir').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        format:'yyyy-mm-dd',
        minView: 2,
        forceParse: 0,
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

    function checkTime(i)
    {
        if (i < 10)
        {
            i = "0" + i;
        }
        return i;
    }

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Kunjungan'
            },
            subtitle: {
                text: 'Kunjungan pasie poli RSUD Wahidin Sudiro Husodo'
            },
            xAxis: {
                categories: [
                    <?php
                    for ($i=0; $i < 7; $i++) { 
                        $tglt = date('d-m-Y',strtotime("+ $i days",strtotime($tgle)));
                        echo "'$tglt',";
                    }
                    ?>
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah pasien'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} orang</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
            <?php
            $poli = DB::connection('rsu')->table('tr_tracer')->select('Kode_Poli','NamaPoli')->distinct()->get();
            foreach ($poli as $key) {
                ?>
                {
                    name: '{!! $key->NamaPoli !!}',
                    data: [
                        <?php
                        for ($i=0; $i < 7; $i++) { 
                            $tglt = date('Y-m-d',strtotime("+ $i days",strtotime($tgle)));
                            $jum = count(DB::connection('rsu')->table('tr_tracer')->where('Tgl_Register','like',$tglt.'%')->where('Kode_Poli',$key->Kode_Poli)->get());
                            echo "$jum,";
                        }
                        ?>
                    ]

                },
                <?php
            }
            ?>
            ]
        });  
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