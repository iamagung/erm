<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Obat</h4>
      </div>
      <form id="formObatRekap">
      <div class="modal-body">
        <div class="col-lg-12 col-md-12">Nama Obat</div>
        <div class="col-lg-12 col-md-12">
          <style type="text/css">
            .chzn-container{
              width: 100% !important;
            }
          </style>
            
          <?php
          $obat = DB::connection('rsu')->table('trrawatjalanobat')->get();
          // $obat = DB::connection('rsu')->table('trrawatjalanobat')->get();
          ?>
          <select class="form-control obat_list" name="nama_obat">
            <option value="" selected>..:: Nama Obat ::..</option>
            <?php
            foreach ($obat as $key) {
              ?>
              <option value="{!! $key->NamaBrg !!}">{!! $key->NamaBrg !!}</option>
              <?php
            }
            ?>
          </select>  
        </div>
        <div class="col-lg-12 col-md-12">Qty</div>
        <div class="col-lg-12 col-md-12"><input type="text" class="form-control" name="qtt"></div>
        <div class="col-lg-12 col-md-12">Aturan Penggunaan</div>
        <div class="col-lg-12 col-md-12"><textarea class="form-control" name="ket"></textarea></div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
            <a href="#" class="btn btn-success pull-right" onclick="simpanobatrekap()">Tambah</a>
      </div>
      </form>
    </div>

  </div>
</div>
<script type="text/javascript">
  function simpanobatrekap(){
    var data = $('form#formObatRekap').serialize();
    $.post("{!! route('tambahObatRekap') !!}",data,function(data){
        if(data.status=='success'){
          swal('Success !','Obat ditambahkan','success');
          $(".tahap5").load(location.href + " .tahap5>*", "");
          $('#myModal').modal('hide');
        }else{
          swal('Whooops !','Obat gagal ditambahkan','error');
        }
    });
  }
  
  $(function() {
        $(".obat_list").chosen();
    });;
</script>