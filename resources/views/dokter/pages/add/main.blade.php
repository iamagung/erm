@extends('dokter.master.main')
@section('content')

<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">
    <h1 class="text-center">
        <b>Tambah Rekam Medis</b>
    </h1>
</section>
<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
  <div class="col-lg-12 col-md-12" style="padding: 0px">
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
          <input type="button" class="btn btn-primary" style="border-radius: 10px !important;width: 100%" value="Cek" id="btnCek">
        </div>
        <div class="col-lg-6 col-md-6">
          <a href="#" id="prosesBtn"><input type="submit" class="btn btn-success" id="btnProses" style="border-radius: 10px !important;width: 100%" value="Proses" disabled></a>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix" style="margin-bottom: 10px"></div>
  <div class="col-md-12 col-md-12">

    <div class="box">

      <div class="box-header">

        <div class="box-tools pull-right">

          <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>

        </div>

      </div>

      <div class="box-body">
        <?php
        function tampil($label,$name){
          echo '<div class="form-group">'.
          '<label class="col-lg-4 col-md-4">'.$label.'</label>'.
          '<div class="col-lg-8 col-md-8">'.
          '<input type="text" name="'.$name.'" id="'.$name.'" class="form-control" style="border-radius: 10px !important" placeholder="'.$label.'">'.
          '</div>'.
          '</div>'.
          '<div class="clearfix" style="margin-bottom: 10px"></div>';
        }
        ?>

        <div class="col-lg-12 col-md-12">
          <?= tampil('Nama Pasien','nama') ?>
          <?= tampil('Nama Poli','poli') ?>
        </div>
        <div class="clearfix"></div>
      </div>

    </div>

  </div>
</div>
<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
  <div class="">
    <div class="">
      <h4 class='text-center'>
        SUDAH DIKERJAKAN PERAWAT
      </h4>
    </div>
    <table class="table table-bordered table-striped" id="dataPoli">
        <thead>
            <tr>
                <th class="text-center">No. RM</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Poli</th>
                <th class="text-center">Tgl</th>
            </tr>
        </thead>
        <tbody>
          @if (!empty($rekap))
            @foreach ($rekap as $key)
              <tr style="cursor:pointer;" class="klikCek" data-norm="{{ $key->no_RM }}">
                <td>{{ $key->no_RM }}</td>
                <td>{{ $key->Nama_Pasien }}</td>
                <td>{{ $key->NamaPoli }}</td>
                <td>{{ date("d-m-Y H:i:s", strtotime($key->tanggalKunjungan)) }}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
    </table>
  </div>
</div>
@stop
@section('js')
<script type="text/javascript">
    $('input[name=id]').keyup(function(){
        $('#btnProses').attr('disabled','disabled');
    });
    function cek() {
      var rm = $('input[name=id]').val();
      $.post("{!! route('cekPasien') !!}",{id:rm},function(data){
          if(data.status=='success'){
              if(data.rekap.NamaDokter!=null){
                  swal('Sudah ditangani oleh dokter '+data.rekap.NamaDokter);
              }else{
                  if(data.data.Kode_Poli=='{!! $dokter->poli_id !!}'){
                      $('#btnProses').removeAttr('disabled');
                      $('#prosesBtn').attr('href','{!! url("/") !!}/dokter/add_rekap_medik/setPasien/'+data.rekap.id_rekapMedik)
                  }
              }
              $('#nama').val(data.data.Nama_Pasien);
              $('#poli').val(data.data.NamaPoli);
          }else if(data.status=='ada'){
              swal('Pasien terdaftar tapi belum ditangani oleh perawat');
              $('#nama').val(data.data.Nama_Pasien);
              $('#poli').val(data.data.NamaPoli);
          }else{
              swal("Pasien tidak melakukan registrasi");
          }
      });
    }
    $('#btnCek').click(function(){
      cek();
    });
    $(".klikCek").on('click', function(){
      var norm = $(this).data('norm');
      $('input[name=id]').val(norm);
      cek();
    });
</script>
@yield('js_modal')
@stop
