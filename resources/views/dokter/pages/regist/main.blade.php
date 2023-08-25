@extends('dokter.master.main')
@section('content')

<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">
    <h1 class="text-center">
        <b>Data Pasien Hari Ini</b>
    </h1>
</section>
<div class="col-md-12 col-md-12">
    <div class="box">
        <div class="box-header">
            <div class="box-tools pull-right">
                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12" style="overflow: auto">
                <table id="tbl-list" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Urut</th>
                            <th>Nomor Regist</th>
                            <th>Tanggal Regist</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="hasilCari"></tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="modal_layout"></div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#tbl-list').DataTable({
            ajax: {
                url: "{{ route('dataRegistrasi') }}",
                method: "GET",
                xhrFields: {
                    withCredentials: true
                }
            },
            columns: [{
                searchable: false,
                name: 'no',
                width: '5%',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                name: 'no_antre',
                width: '5%',
                render: function (data, type, row, meta) {
                    var no_antre = '-';
                    return no_antre;
                }
            }, 
            {
                name: 'no_register',
                data: 'no_Register',
            }, 
            {
                name: 'tgl',
                data: 'tanggalKunjungan',
            }, 
            {
                name: 'no_rm',
                data: 'no_RM',
            }, 
            {
                name: 'nama_pasien',
                data: 'Nama_Pasien',
            }, 
            {
                name: 'action',
                width: '15%',
                searchable: false,
                render: function (data, type, row, meta) {
                    return `<a href="{!! url('dokter/add_rekap_medik/setPasien/${row.id_rekapMedik}') !!}" class="btn btn-sm btn-primary">Kerjakan</a>`;
                }
            },]
        });
    });

    function tampilkan(data){
        var d = data.data.length;
        var html = '';
        if(d==0){
            html = '<tr>'+
            '<td colspan="7">Data tidak ada</td>'+
            '</tr>';
        }else{
            var i=1;
            $.each( data.data, function( key, value ) {
                var tgl, nourut = '';
                var sp = value.tanggalKunjungan;
                var sp_tgltime = sp.split(" ");
                var sp_tgl = sp_tgltime[0].split("-");
                tgl = sp_tgl[2]+'-'+sp_tgl[1]+'-'+sp_tgl[0];
                if (value.noAntre != "-") {
                    nourut = value.noAntre;
                } else {
                    nourut = value.NoUrut;
                }
                html += '<tr>'+
                '<td>'+i+'</td>'+
                // '<td>'+nourut+'</td>'+
                '<td>-</td>'+
                '<td>'+value.no_Register+'</td>'+
                '<td>'+tgl+' '+sp_tgltime[1]+'</td>'+
                '<td>'+value.no_RM+'</td>'+
                '<td>'+value.Nama_Pasien+'</td>'+
                '<td>'+
                    '<a href="{!! url("/") !!}/dokter/add_rekap_medik/setPasien/'+value.id_rekapMedik+'" class="btn btn-sm btn-primary">Kerjakan</a>'+
                '</td>'+
                '</tr>';
                i++;
            });
        }
        return html;
    }  
</script>
@stop