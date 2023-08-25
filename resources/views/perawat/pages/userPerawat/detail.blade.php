<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <?php
    $poliedit = DB::table('users')->where('id',$id)->first();
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Perawat Poli</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-lg-4 col-md-4">Nama Perawat</label>
          <div class="col-lg-8 col-md-8">
            <input type="text" class="form-control" readonly value="{!! $poliedit->nama !!}" style="border-radius: 10px !important">
          </div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>

        <div class="form-group">
          <label class="col-lg-4 col-md-4">Nama Poli</label>
          <div class="col-lg-8 col-md-8">
            <input type="text" class="form-control" readonly value="{!! $poliedit->namaPoli !!}" style="border-radius: 10px !important">
          </div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>

        <div class="form-group">
          <label class="col-lg-4 col-md-4">Username Perawat</label>
          <div class="col-lg-8 col-md-8">
            <input type="text" class="form-control" readonly value="{!! $poliedit->username !!}" style="border-radius: 10px !important">
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>