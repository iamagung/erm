@extends('dokter.master.main')
@section('content')

<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">

    <h1 class="text-center">

        <b>Report</b>

    </h1>

</section>
<style type="text/css">
    table, th, td {
  border: 1px solid black;
}
</style>
<div class="col-md-12 col-md-12">
    <div class="box">
        <div class="box-header">
            <div class="box-tools pull-right">
                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <!-- <div class="col-lg-12 col-md-12">
                <a href="#" class="btn btn-primary" style="border-radius: 10px !important" onclick="formAdmin(0)"><i class="fa fa-plus"> Tambah Admin</i></a>
            </div> -->
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="row">
                <div class="col-md-10 col-md-10 col-md-offset-1 col-md-offset-1">
                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="form-group">
                        <label class="col-lg-2 col-md-2">No. 1025</label>
                        
                    
                    <div class="clearfix" style="margin-bottom: 10px"></div>

                    <div class="form-group">
                        <label class="col-lg-2 col-md-2">Tanggal </label>
                        <label class="col-lg-2 col-md-2">: 24 Januari  2019</label>
                        <label class="col-lg-2 col-md-2">Alergi </label>
                        <label class="col-lg-2 col-md-2">: Tidak Ada Alergi</label>
                    </div>
                    
                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="form-group">
                        <label class="col-lg-2 col-md-2">Poli </label>
                        <label class="col-lg-2 col-md-2">: Poli Spesialis Kulit</label>
                    </div>

                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="form-group">
                        <label class="col-lg-2 col-md-2">Nama Dokter </label>
                        <label class="col-lg-2 col-md-2">: dr. Koko koko</label>
                    </div>

                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="form-group">
                        <label class="col-lg-2 col-md-2">No. SIP </label>
                        <label class="col-lg-2 col-md-2">: 1975224552285</label>
                    </div>

                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="form-group">
                        <label class="col-lg-2 col-md-2">Ttd. Dokter </label>
                        <label class="col-lg-2 col-md-2"></label>
                    </div>

                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="form-group">
                        <label class="col-lg-5 col-md-5"><h3>R/1. AKARBOSE 50MG TAB</h3></label>
                        <label class="col-lg-2 col-md-2"><h3>No. 1</h3></label>
                    </div>

                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    
                    <div class="form-group">
                        <label class="col-lg-5 col-md-5"><h2><b><i>S dd</i></b></h2></label>
                        <label class="col-lg-2 col-md-2"><h3></h3></label>
                    </div>
                    <div class="clearfix" style="margin-bottom: 10px"></div>

                    <div class="form-group">
                        <label class="col-lg-10 col-md-10"><h3 style="text-align: center;">Sesudah Makan</h3></label>
                    </div>
                    <hr>

                </div>

            </div>

            <div class="col-md-5 col-md-5 col-md-offset-1 col-md-offset-1">
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group">
                        <label class="col-lg-3 col-md-3">Nama Dokter </label>
                       <label class="col-lg-6 col-md-6">: lalalalla</label>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group">
                        <label class="col-lg-3 col-md-3">Tgl. Lahir </label>
                       <label class="col-lg-6 col-md-6">: Malang, 22 juni 1992</label>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group">
                        <label class="col-lg-3 col-md-3">No. RM </label>
                       <label class="col-lg-6 col-md-6">: 5000515215</label>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group">
                    <label class="col-lg-3 col-md-3">BB </label>
                    <label class="col-lg-3 col-md-3">: 57</label>
                    <label class="col-lg-1 col-md-1">kg</label>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group">
                        <label class="col-lg-3 col-md-3">TB </label>
                       <label class="col-lg-3 col-md-3">: 155</label>
                       <label class="col-lg-1 col-md-1">cm</label>
                </div>
            </div>

            <div class="col-md-5 col-md-5">
                <div class="col-md-6 col-md-6">
                    <table>
                  <tr>
                    <th>V</th>
                    <th width="90%"></th>
                  </tr>
                  <tr>
                    <td>H</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>D</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>L</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>S</td>
                    <td></td>
                  </tr>
                </table>
                </div>

                <div class="col-md-6 col-md-6">
                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="form-group">
                        <label class="col-lg-3 col-md-3"><h3>Apoteker</h3> </label>
                    </div>

                    <div class="clearfix" style="margin-bottom: 50px"></div>

                    <div class="form-group">
                        <label class="col-lg-12 col-md-12"><h3>Pasien / Keluarga</h3> </label>
                    </div>
                </div>
                
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            


            <!-- <div class="col-lg-2 col-md-2" style="padding: 0px">             
                <button type="button" class="btn btn-success btn-lg col-lg-12 col-md-12">Racik</button>
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <button type="button" class="btn btn-warning btn-lg col-lg-12 col-md-12">History</button>
            </div> -->

            

            

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="col-lg-6 col-md-6">
                        <div class="clearfix" style="margin-bottom: 10px"></div>
                        <button type="button" class="btn btn-warning btn-md col-lg-5 col-md-5">
                            <i class="fa fa-print" aria-hidden="true"></i> Cetak Resep
                        </button>
                    </div>
                </div>
            </div>
            
        </div>

    </div>

    <div class="modal_layout"></div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">
    function page(i){
        var searchby = $('select[name=searchby]').val();
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var hasil = 'searchby = '+searchby+'\ncariText = '+cariText+'\ncariStatus = '+cariStatus+'\ni = '+i;
        $.post("{!! route('page_ajukan_pertanyaan') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:i}).done(function(data){
            $('#hasilCari').html('');
            $('#hasilCari').html(tampilkan(data.data));
            $('.pagination').html(halaman_page(data.i,data.data));
        });
    }

    function halaman_page(i,data){
        var pageination = '';
        if(i==1){
            pageination+= "<li class='disabled'><a href='#'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+= "<li><a href='#' onclick='page(1)'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='page("+(i-1)+")'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }

        var batas = 4;
        var start = '';
        var end = '';
        var akhir = Math.ceil((data.total.length/10));

        if(i>batas){
            start = parseInt(i)-parseInt(batas);
        }else{
            start = 1;
        }

        if(i<(akhir-batas)){
            end = parseInt(i)+parseInt(batas);
        }else{
            end = akhir;
        }

        var a='';
        for (var j = start; j <= end; j++) {
            if(j==i){
                a = 'class="active"';
            }else{
                a ='';
            }
            pageination+="<li "+a+"><a href='#' onclick='page("+j+")'>"+j+"</a></li>";
        }

        if(i==akhir){
            pageination+="<li class='disabled'><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+="<li><a href='#' onclick='page("+(parseInt(i)+1)+")'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='page("+akhir+")'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }
        return pageination;
        // return alert('batas = '+batas+'\ni = '+i+'\nstart = '+start+'\nAkhir = '+end);
    }

    $('input[name=id]').keyup(function(){
        $('#btnProses').attr('disabled','disabled');
    });
    
    $('#btnCek').click(function(){
        var rm = $('input[name=id]').val();
        if(rm=='Budiman'){
            $('#btnProses').removeAttr('disabled');
            $('#nama').val('Budiman');
            $('#jk').val('Laki-laki');
            $('#tgl_lahir').val('1994-06-28');
        }else{
            return alert('Data not found');
        }
    });

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

    $('select[name=searchby]').change(function(){
        var searchby = $('select[name=searchby]').val();
        var cariText = '';
        var cariStatus = $('#searchdate').val();
        $('#searchtext').val('');
        if(searchby=='tanggalKunjungan'){
            $('#searchtext').hide();
            $('#searchdate').show();
        }else{
            $('#searchtext').show();
            $('#searchdate').hide();
        }
        $.post("{!! route('page_ajukan_pertanyaan') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('.pagination').html(halaman_page(1,data.data));
            }
        });
    });

    $('input[name=searchdate]').change(function(){
        var searchby = $('select[name=searchby]').val();
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        $.post("{!! route('page_ajukan_pertanyaan') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('.pagination').html(halaman_page(1,data.data));
            }
        });
    });

    $('#searchtext').keyup(function(){
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var by = $('select[name=searchby]').val();
        $.post("{!! route('page_ajukan_pertanyaan') !!}",{cariText:cariText,cariStatus:cariStatus,by:by,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('.pagination').html(halaman_page(1,data.data));
            }
        });
    });  

    function tampilkan(data){
        var d = data.data.length;
        var html = '';
        if(d==0){
            html = '<tr>'+
            '<td colspan="8">Data tidak ada</td>'+
            '</tr>';
        }else{
            var i=1;
            $.each( data.data, function( key, value ) {
            var tgl = '';
            var sp = value.tanggalKunjungan;
            var sp_tgltime = sp.split(" ");
            var sp_tgl = sp_tgltime[0].split("-");
            tgl = sp_tgl[2]+'-'+sp_tgl[1]+'-'+sp_tgl[0];
            html += '<tr>'+
            '<td>'+i+'</td>'+
            '<td>'+tgl+' '+sp_tgltime[1]+'</td>'+
            '<td>'+value.no_RM+'</td>'+
            '<td>'+value.Nama_Pasien+'</td>'+
            '<td>'+value.nama_poliRujuk+'</td>'+
            '<td>'+
                '<a href="#" onclick="detailRekapRJ('+value.id_rekapMedik+')" class="btn btn-sm btn-success">Lihat</a>'
            '</td>'+
            '</tr>';
            i++;
            });
        }
        return html;
    }  

    function detailRekapRJ(id){
        $.post("{!! route('modalDetRekap') !!}",{id:id}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout').html(data.content);
                $('.modal_layout').show();
                $('#myModal').modal('show');
            }
        });
    }
</script>
@stop