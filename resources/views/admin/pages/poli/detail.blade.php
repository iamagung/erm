<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <?php
    $value_status = ['1','0'];
    if($id=='0'){
      $id_poli = $id;
      $nama_poli = '';
      $status_poli = '';
    }else{
      $poliedit = DB::table('poli')->where('id_poli',$id)->first();
      $id_poli = $id;
      $nama_poli = $poliedit->nama_poli;
      $status_poli = $poliedit->status_poli;
    }
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Poli</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-lg-4 col-md-4">Nama Poli</label>
          <div class="col-lg-8 col-md-8">
            <input type="text" class="form-control" readonly value="{!! $nama_poli !!}">
          </div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>

        <div class="form-group">
          <label class="col-lg-4 col-md-4">Status</label>
          <div class="col-lg-8 col-md-8">
            @if($status_poli=='1')
            <input type="button" class="btn btn-primary" readonly value="Aktif">
            @else
            <input type="button" class="btn btn-danger" readonly value="Tidak Aktif">
            @endif
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>