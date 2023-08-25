<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Pasien</h4>
      </div>
      <div class="modal-body">
        <?php
        if($rm==''){
          echo '<h1>Data tidak ditemukan</h1>';
        }else{
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
              <?= tampil('Jenis Kelamin','jk') ?>
              <?= tampil('Tanggal Lahir','tgl_lahir') ?>
          </div>
          <?php
        }
        ?>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
          <?php
          if($rm!=''){
              ?>
              <input type="button" class="btn btn-success pull-right" value="Proses">
              <?php
          }
          ?>
      </div>
    </div>

  </div>
</div>