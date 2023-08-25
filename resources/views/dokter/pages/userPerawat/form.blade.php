<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <?php
    $poli = DB::connection('rsu')->table('tm_poli')->get();
    // $poli = DB::connection('rsu')->table('tm_poli')->get();
    $value_status = ['Y','T'];
    if($id=='0'){
      $nama_dokter='';
      $nama_poli='';
    }else{
      $user = DB::table('users')->where('id',$id)->first();
      $nama_dokter=$user->nama;
      $nama_poli=$user->kodePoli;
    }
    ?>
    <style type="text/css">
      .chzn-container{width: 100% !important;}
    </style>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Perawat</h4>
      </div>
      <div class="modal-body">
          <form id="data_poli">
          <input type="hidden" name="id_admin" value="{!! $id !!}" readonly>
          <div class="col-lg-12 col-md-12">
              <?php
              if($id==0){
              ?>
              <div class="form-group">
                <label class="col-lg-4 col-md-4">Nama Perawat</label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="nama_perawat" value="" class="form-control" placeholder="Nama Perawat">
                </div>
              </div>
              <?php
              }else{
              ?>
              <div class="form-group">
                <label class="col-lg-4 col-md-4">Nama Dokter</label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="" class="form-control" value="{!! $nama_dokter !!}" readonly style="border-radius: 10px !important">
                </div>
              </div>
              <?php
              }
              ?>
              <div class="clearfix" style="margin-bottom: 10px"></div>

              <div class="form-group">
                <label class="col-lg-4 col-md-4">Nama Poli</label>
                <div class="col-lg-8 col-md-8">
                  <input type="hidden" name="id_poli" readonly value="{{$dokter->poli_id}}">
                  <input type="text" name="" readonly value="{{$dokter->Nama_Poli}}" class="form-control">
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>

              <?php
              if($id==0){
              ?>
              <div class="form-group">
                <label class="col-lg-4 col-md-4">Username </label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="username" class="form-control" style="border-radius: 10px !important" placeholder="username">
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>

              <div class="form-group">
                <label class="col-lg-4 col-md-4">Password </label>
                <div class="col-lg-8 col-md-8">
                  <input type="password" name="password" class="form-control" style="border-radius: 10px !important" placeholder="password">
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>
              <?php
              }
              ?>
          </div>
          <div class="clearfix"></div>
          </form>
      </div>
      <div class="modal-footer">
          <a href="#" onclick="kirimData()" class="btn btn-success">Proses</a>
      </div>
    </div>

  </div>
</div>

<!-- <script src="{!!  asset('adminAsset/js/jquery-ui-1.10.3.min.js') !!}" type="text/javascript"></script> -->
<script type="text/javascript">
    $(function() {
        $(".chzn-select").chosen();
    });;

    function kirimData(){
        var data = $('form#data_poli').serialize();
        var i = 0;
        var id = $('input[name=id_admin]').val();
        var nama = $('input[name=nama_perawat]').val();
        var username = $('input[name=username]').val();
        var password = $('input[name=password]').val();
        
        if(id==0){
          if(password==''){
            swal('Password harus diisi');
            i++;
          }
          if(username==''){
            swal('Username harus diisi');
            i++;
          }
        }

        if(nama==''){
          swal('Nama perawat harus diisikan');
          i++;
        }

        if(i==0){
          $.post("{!! route('simpanPerawatDokter') !!}",data,function(hasil){
              if(hasil.status=='success'){
                  $('#myModal').modal('hide');
                  // location.reload();
                  // $(".box-body").load(location.href + " .box-body>*", "");
                  $("table#dataPoli").load(location.href + " #dataPoli>*", "");
                  $("ul.pagination").load(location.href + " .pagination>*", "");
                  swal('Berhasil disimpan');
              }else if(hasil.status=='tidak'){
                  $('#myModal').modal('hide');
                  // location.reload();
                  // $(".box-body").load(location.href + " .box-body>*", "");
                  $("table#dataPoli").load(location.href + " #dataPoli>*", "");
                  $("ul.pagination").load(location.href + " .pagination>*", "");
                  swal('Tidak ada yang berubah');
              }else if(hasil.status=='exist'){
                  swal('Username Sudah ada');
              }else{
                  swal('Gagal disimpan');
              }
          },'json');
        }else{

        }
    }
</script>