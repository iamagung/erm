@extends('perawat.master.main')
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
                            <th>No Antrian</th>
                            <th>Daftar Via</th>
                            <th>Nomor Regist</th>
                            <th>Tanggal Regist</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Umur</th>
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
    <div id="myModal" class="modal fade" role="dialog" style="">
        <div class="modal-dialog text-center" style="margin: 20% auto;" role="document">
            <span class="fa fa-spinner fa-spin fa-3x w-100"></span>
        </div>
    </div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">
    var table = $('#tbl-list').DataTable({
        ajax: {
            url: "{{ route('dataRegistrasiPerawat') }}",
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
                if(row.id_antre != '-') {
                    no_antre = row.noAntre;
                }
                else {
                    no_antre = row.NoUrut;
                }

                return no_antre;
            }
        }, 
        {
            name: 'daftar_via',
            data: 'daftar_via',
            width: '5%',
        }, 
        {
            name: 'no_register',
            data: 'No_Register',
        }, 
        {
            name: 'tgl',
            data: 'Tgl_Register',
        }, 
        {
            name: 'no_rm',
            data: 'No_RM',
        }, 
        {
            name: 'nama_pasien',
            data: 'Nama_Pasien',
        }, 
        {
            name: 'umur',
            width: '8%',
            render: function (data, type, row, meta) {
                var is_geriatri = (row.is_geriatri == 'Y') ? ' <font style="color:red">(Geriatri)</font>' : '';
                return `${row.Umur} ${is_geriatri}`;
            }
        }, 
        {
            name: 'action',
            width: '17%',
            render: function (data, type, row, meta) {
                var btnClass1 = 'btn-warning';
                var btnClass2 = 'btn-danger';
                var title_pgl = 'Px hanya bisa dipanggil secara manual.'
                if(row.id_antre != '-'){
                    var panggil = `panggil('${row.id_antre}')`;
                    var id_antre = row.id_antre;
                    var hitBPJS = `hitBPJS('${row.id_antre}', 5)`;
                    if (row.status_panggil == 'antripoli') {
                        title_pgl = 'Panggil Pasien.';
                        btnClass1 = 'btn-success';
                    } else {
                        title_pgl = 'Pasien Sudah Dipanggil';
                    }
                } else {
                    var panggil = `panggil_gagal()`;
                    var id_antre = 0;
                    var hitBPJS = "panggil_gagal()";
                }


                var col = `<a href="javascript:void(0);" onclick="${panggil}" class="btn btn-sm ${btnClass1}" title="${title_pgl}"><i class="fa fa-bell" aria-hidden="true"></i></a>
                    <a href="{!! url('perawat/add_rekap_medik/setPasien/${row.No_Register}/${id_antre}') !!}" class="btn btn-sm btn-primary kerjakan">Kerjakan</a>`;

                if(row.status_panggil == 'panggilpoli'){
                    col += ` <a href="javascript:void(0);" onclick="${hitBPJS}" class="btn btn-sm ${btnClass2}" title="Selesaikan Proses di Poli (Px BPJS)"><i class="fa fa-check" aria-hidden="true"></i></a>
                        `;
                }
                var trapis = `{{(auth::user()->is_terapis == 'Y')?'Y':'N'}}`;
                if (trapis == 'N') {
                    if (row.status_panggil == 'layanpoli') {
                        var col = `<a href="javascript:void(0);" class="btn btn-sm btn-default">Dalam Pelayanan</a>
                            <a href="javascript:void(0);" onclick="${hitBPJS}" class="btn btn-sm ${btnClass2}" title="Selesaikan Proses di Poli (Px BPJS)"><i class="fa fa-check" aria-hidden="true"></i></a>
                            `;
                    } else if (row.status_panggil == 'akhirpoli' || row.status_panggil == 'antrifarmasi') {
                        btnClass2 = 'btn-success';
                        var col = `<a href="javascript:void(0);" class="btn btn-sm btn-success">Px Selesai Dilayani</a>`;
                    }
                } else {
                    var col = `
                        <a href="{!! url('perawat/add_rekap_medik/setPasien/${row.No_Register}/${id_antre}') !!}" class="btn btn-sm btn-primary kerjakan">Kerjakan</a>`;
                }


                return col;
            }
        },]
    });

    $(document).ready(function () {
        table.ajax.reload();
    });

    
    $(document).on('click', '.kerjakan', function(){
        $("#myModal").modal({
            backdrop: "static", 
            keyboard: false, 
            show: true 
        });
    });
    // swal('Gagal', data.message , data.status);
    function panggil(id_antrean){
        // NANTI ARAHKAN KE FUNCTION PANGGIL DI FILE registPerawatController.PHP route('')
        $.post("{{route('perawatPanggil')}}",{id_antrean:id_antrean}).done(function(data){
            console.log(data);
            if(data.status == "success"){
                table.ajax.reload();
                // swal({'Berhasil', data.message , showConfirmationButton:false,timer:1000});
                swal({
                    title: 'Berhasil',
                    type: 'success',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1000
                })
            }else{
                // swal({'Gagal', data.message , showConfirmationButton:false,timer:1000});
                swal({
                    title: 'Gagal!!',
                    type: 'error',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            // swal('Notice!', 'Masih Dalam Tahap Pengembangan! Udah masuk ke kontroler. Tinggal simpan ke tabel yang buat pemanggilan.', 'info');
        });
    }

    function panggil_gagal(){
        swal('Notice!','Pasien tidak punya nomor antrean poli!','error');
    }


    function hitBPJS(id, task_id='') {
        swal({
          title: "Tandai Pasien Sudah Dikerjakan?",
          text: "Tindakan ini akan menyelesaikan proses pemeriksaan di Poli untuk kebutuhan Antrian Online BPJS. Informasi lebih lanjut hubungi Tim IT RS.",
          type: "info",
          showCancelButton: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal',
          closeOnConfirm: false,
      }, function(){
        // $.post("{!! route('perawatHitBPJS') !!}",{id:id, task_id:'4'}).done(function(data){
            // if(data.status=='success'){
                $.post("{!! route('perawatHitBPJS') !!}",{id:id, task_id:'5'}).done(function(data){
                    if(data.status=='success'){
                        table.ajax.reload();
                        swal("Sukses!", "Berhasil memproses data!", "success");
                    }else{
                        swal("Galat!", "Gagal memproses data!", "error");
                    }
                });
            // }else{
                // swal("Galat!", "Gagal memproses data!", "error");
            // }
        // });
    });
    }
</script>
@stop
