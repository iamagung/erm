@extends('dokter.master.main')
@section('content')

<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">

    <h1 class="text-center">

        <b>History Pasien</b>

    </h1>

</section>
<div class="col-md-12 col-md-12">
    <div class="box">
        <div class="box-header">
            <div class="box-tools pull-right">
                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>
            </div>
            @if(Session::has('id_rekap'))
            <a href="{{route('pembuatanObat')}}" class="btn btn-warning">Kembali</a>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="box-body">
            <!-- <div class="col-lg-12 col-md-12">
                <a href="#" class="btn btn-primary" style="border-radius: 10px !important" onclick="formAdmin(0)"><i class="fa fa-plus"> Tambah Admin</i></a>
            </div> -->
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="row">
            <div class="col-lg-3 col-md-3" style="padding: 0px">
                <div class="form-group">
                    <label class="col-lg-3 col-md-3">Tanggal</label>
                    <div class="col-lg-9 col-md-9">
                      @if(Session::has('id_rekap'))
                      <input type="hidden" name="no_RM" id="no_RM" value="{{ $rekap->no_RM }}">
                      @endif
                        <input autocomplete="off" type="text" name="username" class="form-control awal" style="border-radius: 10px !important" placeholder="">
                    </div>
                </div>
                <div class="clearfix" style="margin-bottom: 10px"></div>

                <div class="form-group">
                    <label style="text-align: center;" class="col-lg-12 col-md-12">s/d</label>
                </div>
                <div class="clearfix" style="margin-bottom: 10px"></div>

                <div class="form-group">
                    <label class="col-lg-3 col-md-3"></label>
                    <div class="col-lg-9 col-md-9">
                        <input autocomplete="off" type="text" name="username" class="form-control akhir" style="border-radius: 10px !important" placeholder="">
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="col-lg-12 col-md-12" style="overflow: auto">
                    <table class="table table-bordered table-hover" id="dataPoli">
                        <thead>
                            <tr>
                                <th>Trans. Reg</th>
                                <th>No. Reg</th>
                                <th>Tgl. Reg</th>
                                <!-- <th width="5%">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody id="hasil-history">

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>

                <div class="clearfix"></div>


            </div>

            <div class="col-lg-9 col-md-9" style="padding: 0px">
                <div class="clearfix"></div>
                <div class="col-lg-12 col-md-12" style="overflow: auto">
                    <h1 class="text-center">
                        <b>Resep</b>
                    </h1>
                    <table class="table table-bordered table-striped" id="dataPoli">
                        <thead>
                            <tr>
                                <th>Kode ICD</th>
                                <th>Kode Poli</th>
                                <th>Diagnosa</th>
                                <!-- <th width="5%">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody id="diagnosa">

                            <tr>
                                <!-- <td>
                                    <a href="#" onclick="detailRekapRJ()" class="btn btn-sm btn-success">Lihat</a>
                                </td> -->
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>

                <div class="clearfix"></div>

                <h1 class="text-center">
                    <b>Resep</b>
                </h1>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h4 class="text-center">
                            <b>Resep Dari Poli</b>
                        </h4>
                        <div class="clearfix" style="margin-bottom: 10px"></div>
                        <div class="col-lg-12 col-md-12" style="overflow: auto">
                            <table class="table table-bordered table-striped" id="dataPoli">
                                <thead>
                                    <tr>
                                        <th>JenisResep</th>
                                        <th>No_R</th>
                                        <th>KodeObat</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Signa 1</th>
                                        <th>Signa 2</th>
                                        <th>Petunjuk Khusus</th>
                                        <!-- <th width="5%">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody id="resepPoli">

                                    <tr>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h4 class="text-center">
                            <b>Pemberian Dari Farmasi</b>
                        </h4>
                        <div class="clearfix" style="margin-bottom: 10px"></div>
                        <div class="col-lg-12 col-md-12" style="overflow: auto">
                            <table class="table table-bordered table-striped" id="dataPoli">
                                <thead>
                                    <tr>
                                      <th>JenisResep</th>
                                      <th>No_R</th>
                                      <th>KodeObat</th>
                                      <th>Nama Obat</th>
                                      <th>Jumlah</th>
                                        <!-- <th width="5%">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody id="resepFarmasi">

                                    <tr>
                                        <!-- <td>
                                            <a href="#" onclick="detailRekapRJ()" class="btn btn-sm btn-success">Lihat</a>
                                        </td> -->
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>

            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>



            <!-- <div class="col-lg-2 col-md-2" style="padding: 0px">
                <button type="button" class="btn btn-success btn-lg col-lg-12 col-md-12">Racik</button>
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <button type="button" class="btn btn-warning btn-lg col-lg-12 col-md-12">History</button>
            </div> -->

        </div>

    </div>

    <div class="modal_layout"></div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">
    // PAKAI
    $('.awal').datetimepicker({
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

    $('.akhir').datetimepicker({
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

    function getHistory() {
      var awal = $('.awal').val();
      var akhir = $('.akhir').val();
      var error = 0;
      if(akhir=='' || awal==''){
          error=1;
      }else{
          if(akhir<awal){
              error=2;
          }
      }

      if(error==0){
          $('#hasil-history').html('<tr><td colspan="3">Loading .....</td></tr>');
          var data = {
              awal:awal,
              akhir:akhir,
              No_RM:$("#no_RM").val(),
          };
          $.post("{{route('get_history')}}",data).done(function(data){
              var tag = '';
              if(data.status=='success'){
                  if(data.data.length!=0){
                      $.each(data.data,function(index,value){
                          tag += '<tr style="cursor:pointer;" onclick="getDetail('+value.No_Register+')">';
                          // tag += '<td>'+value.KodeBrg+'</td>';
                          // tag += '<td>'+value.NamaBrg+'</td>';
                          // tag += '<td>'+value.KodeBrg+'</td>';

                          tag += '<td>'+value.TransReg+'</td>';
                          tag += '<td>'+value.No_Register+'</td>';
                          tag += '<td>'+value.Tgl_Register+'</td>';
                          tag += '</tr>';
                      })
                  }else{
                      tag += '<tr>';
                      tag += '<td colspan="3">Tidak ditemukan</td>';
                      tag += '</tr>';
                  }
              }else{
                  tag = '<tr><td colspan="3">Tidak ditemukan</td></tr>';
              }
              $('#hasil-history').html(tag);
          });
      }else if(error==1){

      }else if(error==2){
          swal('Tanggal akhir harus kurang dari tanggal awal');
      }
    }

    function getDetail(noreg) {
      var data = {
          noreg:noreg,
      };
      $.post("{{route('get_historyDetail')}}",data,function(data){
          var tag = '';
          if(data.status=='success'){
              if(data.resepPoli){
                  $.each(data.resepPoli,function(index,value){
                      tag += '<tr>';
                      // tag += '<td>'+value.KodeBrg+'</td>';
                      // tag += '<td>'+value.NamaBrg+'</td>';
                      // tag += '<td>'+value.KodeBrg+'</td>';

                      tag += '<td>PATEN</td>';
                      tag += '<td>'+value.No_R+'</td>';
                      tag += '<td>'+value.KodeBrg+'</td>';
                      tag += '<td>'+value.NamaBrg+'</td>';
                      tag += '<td>'+value.Jumlah+'</td>';
                      tag += '<td>'+value.Signa1+'</td>';
                      tag += '<td>'+value.Signa2+'</td>';
                      tag += '<td>'+value.Keterangan+'</td>';
                      tag += '</tr>';
                  })
              }else{
                  tag += '<tr>';
                  tag += '<td colspan="8">Tidak ditemukan</td>';
                  tag += '</tr>';
              }
          }else{
              tag = '<tr><td colspan="8">Tidak ditemukan</td></tr>';
          }
          $('#resepPoli').html(tag);

          tag = '';
          if(data.status=='success'){
              if(data.resepFarmasi){
                  $.each(data.resepFarmasi,function(index,value){
                      tag += '<tr>';
                      // tag += '<td>'+value.KodeBrg+'</td>';
                      // tag += '<td>'+value.NamaBrg+'</td>';
                      // tag += '<td>'+value.KodeBrg+'</td>';

                      tag += '<td>PATEN</td>';
                      tag += '<td>'+value.No_RawatJL+'</td>';
                      tag += '<td>'+value.KodeBrg+'</td>';
                      tag += '<td>'+value.NamaBrg+'</td>';
                      tag += '<td>'+value.Jml+'</td>';
                      tag += '</tr>';
                  })
              }else{
                  tag += '<tr>';
                  tag += '<td colspan="5">Tidak ditemukan</td>';
                  tag += '</tr>';
              }
          }else{
              tag = '<tr><td colspan="5">Tidak ditemukan</td></tr>';
          }
          $('#resepFarmasi').html(tag);

          tag = '';
          if(data.status=='success'){
              if(data.diagnosa){
                  $.each(data.diagnosa,function(index,value){
                      tag += '<tr>';
                      // tag += '<td>'+value.KodeBrg+'</td>';
                      // tag += '<td>'+value.NamaBrg+'</td>';
                      // tag += '<td>'+value.KodeBrg+'</td>';

                      tag += '<td>'+value.DiagnosaPrimer+'</td>';
                      tag += '<td>'+value.KodePoli+'</td>';
                      tag += '<td>'+value.NamaDiagnosaPrimer+'</td>';
                      tag += '</tr>';
                  })
              }else{
                  tag += '<tr>';
                  tag += '<td colspan="3">Tidak ditemukan</td>';
                  tag += '</tr>';
              }
          }else{
              tag = '<tr><td colspan="3">Tidak ditemukan</td></tr>';
          }
          $('#diagnosa').html(tag);
      });
    }

    $('.awal').change(function(){
      getHistory();
    });

    $('.akhir').change(function(){
      getHistory();
        // var awal = $('.awal').val();
        // var akhir = $('.akhir').val();
        // var error = 0;
        // if(awal==''){
        //     error=1;
        // }else{
        //     if(akhir<awal){
        //         error=2;
        //     }
        // }
        //
        // if(error==0){
        //     var data = {
        //         awal:awal,
        //         akhir:akhir,
        //     };
        //     $.post("{{route('get_history')}}",data,function(data){
        //         var tag = '';
        //         if(data.status=='success'){
        //             if(data.data.length!=0){
        //                 $.each(data.data,function(index,value){
        //                     tag += '<tr>';
        //                     tag += '<td>'+value.KodeBrg+'</td>';
        //                     tag += '<td>'+value.NamaBrg+'</td>';
        //                     tag += '<td>'+value.KodeBrg+'</td>';
        //                     tag += '</tr>';
        //                 })
        //             }else{
        //                 tag += '<tr>';
        //                 tag += '<td colspan="3">Tidak ditemukan</td>';
        //                 tag += '</tr>';
        //             }
        //         }else{
        //             tag = '<tr><td colspan="3">Tidak ditemukan</td></tr>';
        //         }
        //         $('#hasil-history').html(tag);
        //     });
        // }else if(error==1){
        //
        // }else if(error==2){
        //     swal('Tanggal akhir harus kurang dari tanggal awal');
        // }
    });
    // END PAKAI
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
