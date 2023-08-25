@extends('dokter.master.main')
@section('content')

<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">

    <h1 class="text-center">

        <b>Pertanyaan dari {{$rujuk->DariDokter}} ({{$rujuk->DariPoli}})</b>

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
        <form method="post" action="{{route('simpan_jawab_rujuk')}}">
            {{csrf_field()}}
            <input type="hidden" name="id_rekap" value="{{$rujuk->id_rujukan}}" readonly>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12">
                <a href="#" onclick="detailRekapRJ('{{$rujuk->rekapMedik_id}}')" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>Detail Diagnosa</a>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12" style="padding: 0px">
                <div class="col-lg-6 col-md-6">
                    <div style="border: 1px solid #ccc">
                        <div style="width: 100%;background: #ff7474;font-size: 20px;font-weight: bold;text-align: center;">
                            Pertanyaan
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            {!! $rujuk->Rujuk !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div style="border: 1px solid #ccc">
                        <div style="width: 100%;background: #74f1ff;font-size: 20px;font-weight: bold;text-align: center;">
                            Jawaban
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <textarea class="form-control" name="jawaban" required style="height: 200px" placeholder="Jawaban anda" onkeyup="cari_jawaban()"></textarea>
                            <div class="tempat_jawab"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div id="edukasi_table">
            <?php
            $edu = DB::table('edukasi_rm')->where('rekapMedik_id',$rujuk->rekapMedik_id)->get();
            if(count($edu)!=0){
                ?>
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <h3>Edukasi</h3>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 15%">Edukator (Bidang edukasi)</th>
                        <th style="width: 10%">Yang diedukasi</th>
                        <th style="width: 10%">Metode</th>
                        <th style="width: 40%">Materi</th>
                        <th style="width: 30%">Response</th>
                        <th style="width: 30%">Aksi</th>
                    </tr>
                    <?php
                    foreach ($edu as $key) {
                        ?>
                        <tr>
                            <td>{{$key->edukator}} ({{$key->disiplin}})</td>
                            <td>
                                <ul>
                                <?php
                                $metode = explode("+", $key->edukasi_ke);
                                for($i=0;$i<count($metode)-1;$i++){
                                    echo "<li>".$metode[$i]."</li>";
                                }
                                ?>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                <?php
                                $metode = explode("+", $key->metode_edukasi);
                                for($i=0;$i<count($metode)-1;$i++){
                                    echo "<li>".$metode[$i]."</li>";
                                }
                                ?>
                                </ul>
                            </td>
                            <td>{{$key->materi_edukasi}}</td>
                            <td>
                                <ul>
                                <?php
                                $metode = explode("+", $key->response_edukasi);
                                for($i=0;$i<count($metode)-1;$i++){
                                    echo "<li>".$metode[$i]."</li>";
                                }
                                ?>
                                </ul>
                            </td>
                            <td><a href="#" onclick="hapusEdukasi({{$key->id_edukasi}})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
            ?>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12" style="box-shadow: 0px 10px 10px #ddd;background: #fafafa">
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <h3>Form Edukasi</h3>
                <input type="hidden" name="id_rekapMedik" value="{{$rujuk->rekapMedik_id}}" readonly>
                <table class="table table-bordered">
                    <tr>
                        <td>Nama Edukator</td>
                        <td><input type="text" name="nama_edukator" class="form-control" placeholder="Ex: Dr. xxxxxxxxx SPPK"></td>
                    </tr>
                    <tr>
                        <td>Bidang Disiplin</td>
                        <td><input type="text" name="bidang_edukator" class="form-control" placeholder="Medis, Keperawatan, Dokter Gizi, Farmasi, Rehabilitasi"></td>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Siapa yang diedukasi</th>
                            <th>Metode Edukasi</th>
                            <th>Respon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label><input type="checkbox" class="yang_edu" name="yang_edu[]" value="Pasien">Pasien</label>
                                <br/><label><input type="checkbox" class="yang_edu" name="yang_edu[]" value="Ayah/ Ibu">Ayah/ Ibu</label>
                                <br/><label><input type="checkbox" class="yang_edu" name="yang_edu[]" value="Suami/ Istri">Suami/ Istri</label>
                                <br/><label><input type="checkbox" class="yang_edu" name="yang_edu[]" value="Anak">Anak</label>
                                <br/><label><input type="checkbox" class="yang_edu" name="yang_edu[]" value="Lainnya">Lainnya</label>
                            </td>
                            <td>
                                <label><input type="checkbox" class="metode_edu" name="metode_edu[]" value="Diskusi">Diskusi</label>
                                <br/><label><input type="checkbox" class="metode_edu" name="metode_edu[]" value="Peragaan">Peragaan</label>
                                <br/><label><input type="checkbox" class="metode_edu" name="metode_edu[]" value="Selebaran">Selebaran</label>
                                <br/><label><input type="checkbox" class="metode_edu" name="metode_edu[]" value="Audio Visual">Audio Visual</label>
                                <br/><label><input type="checkbox" class="metode_edu" name="metode_edu[]" value="Lainnya">Lainnya</label>
                            </td>
                            <td>
                                <label><input type="checkbox" class="response_edu" name="respon_edu[]" value="Tidak respon sama sekali (tak ada antusiasme dan keinginan belajar)">Tidak respon sama sekali (tak ada antusiasme dan keinginan belajar)</label>
                                <br/><label><input type="checkbox" class="response_edu" name="respon_edu[]" value="Tidak paham (ingin belajar tap[i kesulitan mengerti)">Tidak paham (ingin belajar tap[i kesulitan mengerti)</label>
                                <br/><label><input type="checkbox" class="response_edu" name="respon_edu[]" value="Paham hal yang diajarkan, tapi tidak bisa menjalaskan sendiri">Paham hal yang diajarkan, tapi tidak bisa menjalaskan sendiri</label>
                                <br/><label><input type="checkbox" class="response_edu" name="respon_edu[]" value="Dapat menjelaskan apa yang diajarkan, tapi harus dibantu edukator">Dapat menjelaskan apa yang diajarkan, tapi harus dibantu edukator</label>
                                <br/><label><input type="checkbox" class="response_edu" name="respon_edu[]" value="Dapat menjelaskan apa yang telah diajarkan tanpa dibantu">Dapat menjelaskan apa yang telah diajarkan tanpa dibantu</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <textarea name="materi_edu" style="width: 100%;height: 300px" placeholder="Materi Edukasi"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="col-lg-12 cl-md-12" style="text-align: center;">
                    <a href="#" onclick="simpanEdukasi()" class="btn btn-success btn-sm">Simpan Edukasi</a>
                </div>
                <div class="clearfix" style="margin-bottom: 10px"></div>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12" style="text-align: center;">
                <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </form>
        </div>

    </div>

    <div class="modal_layout"></div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">
// CARI PERTANYAAN
function cari_jawaban(){
  var jawab = $('textarea[name=jawaban]').val();
  $('.tempat_jawab').html('');
  if(jawab!=''){
    // swal(tanya);
    $.post("{{route('cari_jawaban')}}",{jawab:jawab},function(data){
      var html = '';
      if(data.status=='success'){
        if(data.data.length>0){
          $.each(data.data,function(k,v){
            html+='<a href="javascript:void(0)" onclick="set_jawaban(\''+v.HasilRujuk+'\')">'+v.HasilRujuk+'</a><br>';
          });
        }
      }
      $('.tempat_jawab').html(html);
    });
  }
}
// END CARI PERTANYAAN
// SET PERTANYAAN
function set_jawaban(data){
  $('textarea[name=jawaban]').val(data);
  $('.tempat_jawab').html('');
}
// END SET PERTANYAAN

    function simpanEdukasi(){
        var error = 0;
        var materi = $('textarea[name=materi_edu]').val();
        if(materi==''){
            swal("Materi harus diisi");
            error++;
        }

        var response='';
        var response_edu = $('.response_edu:checked');
        for(var i=0;i<response_edu.length;i++){
            response += response_edu[i].value+'+';
        }
        if(response==''){
            swal('response harus dipilih');
            error++;
        }

        var metode='';
        var metode_edu = $('.metode_edu:checked');
        for(var i=0;i<metode_edu.length;i++){
            metode += metode_edu[i].value+'+';
        }
        if(metode==''){
            swal('Metode harus dipilih');
            error++;
        }

        var yang='';
        var yang_edu = $('.yang_edu:checked');
        for(var i=0;i<yang_edu.length;i++){
            yang += yang_edu[i].value+'+';
        }
        if(yang==''){
            swal('Yang diedukasi harus dipilih');
            error++;
        }

        var edukator = $('input[name=nama_edukator]').val();
        var disiplin = $('input[name=bidang_edukator]').val();

        if(disiplin==''){
            swal('Bidang disiplin edukator harus diisi');
            error++;
        }

        if(edukator==''){
            swal("Nama edukator harus diisi");
            error++;
        }

        var id_rekap = $('input[name=id_rekapMedik]').val();

        if(error==0){
            $.post("{{route('simpanEdu')}}",{materi:materi,metode:metode,response:response,yang:yang,disiplin:disiplin,edukator:edukator,id_rekap:id_rekap},function(data){
                if(data.status=='success'){
                    swal("Success !",'Data berhasil ditambahkan','success');
                    $("#edukasi_table").load(location.href + " #edukasi_table>*", "");
                }else{
                    swal("Whoops !",'Data tidak berhasil ditambahkan','error');
                }
            });
        }
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

    function hapusEdukasi(id){
        swal({
        title: "Anda yakin?",
        text: "Data akan dihapus!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        //closeOnCancel: false
        },
        function(){
            $.post("{!! route('hapusEdukasi') !!}",{id:id}).done(function(data){
                if(data.status=='success'){
                    $("#edukasi_table").load(location.href + " #edukasi_table>*", "");
                    swal('Data berhasil dihapus');
                }else{
                    swal("Gagal!", "Data gagal dihapus!", "error");
                }
            });
        });
    }
</script>
@stop
