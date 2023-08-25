<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <?php
    $poli = DB::connection('rsu')->table('tm_poli')->get();
    // $poli = DB::connection('rsu')->table('tm_poli')->get();
    $value_status = ['Y','T'];
    if($id=='0'){
      $login1 = DB::table('login_dokter')->select('dokter_id')->get();
      $i=0;
      $login=[];
      foreach ($login1 as $key) {
        $login[$i]=$key->dokter_id;
        $i++;
      }
      if(count($login)==0){
        $dokter = DB::connection('rsu')->table('tm_setupall')->where('groups','Dokter')->get();
        // $dokter = DB::connection('rsu')->table('tm_setupall')->where('groups','Dokter')->get();
      }else{
        $dokter = DB::connection('rsu')->table('tm_setupall')
          ->where('groups','Dokter')
          // ->whereNotIn('setupall_id',$login)
          ->get();
        // $dokter = DB::connection('rsu')->table('tm_setupall')->where('groups','Dokter')->whereNotIn('setupall_id',$login)->get();
      }

      $nama_dokter='';
      $nama_poli='';
      $ttd = '';
      $jenis_dokter = '';
    }else{
      $poliedit = DB::table('login_dokter')->join('users as u','u.id','login_dokter.user_id')->where('login_dokter.id',$id)->first();
      $nama_dokter=$poliedit->Nama_Dokter;
      $nama_poli=$poliedit->poli_id;
      $ttd = $poliedit->ttd;
      $jenis_dokter = $poliedit->jenis_dokter;
    }
    ?>
    <style type="text/css">
      .chzn-container{width: 100% !important;}
    </style>
    <!-- Modal content-->
    <div class="modal-content">
      <form id="data_poli" action="{!! route('simpanDokter') !!}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Dokter</h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id_admin" value="{!! $id !!}" readonly>
          <div class="col-lg-12 col-md-12">
              <?php
              if($id==0){
              ?>
              <div class="form-group">
                <label class="col-lg-4 col-md-4">Nama Dokter</label>
                <div class="col-lg-8 col-md-8">
                  <select class="chzn-select form-control" name="id_dokter" required>
                    <option value="" selected>..:: Nama Dokter ::..</option>
                    <?php
                    foreach ($dokter as $key) {
                      ?>
                      <option value="{!! $key->setupall_id !!}">{!! $key->nilaichar !!}</option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <?php
              }else{
              ?>
              <div class="form-group">
                <label class="col-lg-4 col-md-4">Nama Dokter</label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="" class="form-control" value="{!! $nama_dokter !!}" readonly style="border-radius: 10px !important" required>
                </div>
              </div>
              <?php
              }
              ?>
              <div class="clearfix" style="margin-bottom: 10px"></div>

              <div class="form-group">
                <label class="col-lg-4 col-md-4">Nama Poli</label>
                <div class="col-lg-8 col-md-8">
                  <select name="id_poli" id="id_poli" class="chzn-select form-control" required>
                    <option value="" selected>..:: Nama Poli ::..</option>
                    <?php
                    foreach ($poli as $key) {
                      $sel = '';
                      if($nama_poli==$key->KodePoli){
                        $sel = 'selected';
                      }
                      ?>
                      <option {!! $sel !!} value="{!! $key->KodePoli !!}">{!! $key->NamaPoli !!}</option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>

              <div class="form-group">
                <label class="col-lg-4 col-md-4" for="jenisdokter">Jenis Dokter</label>
                <div class="col-lg-8 col-md-8">
                  <select name="jenisdokter" id="jenisdokter" class="chzn-select form-control" required>
                    <option value="" selected disabled>..:: Pilih Jenis Dokter ::..</option>
                    <option value="U" {{($jenis_dokter == 'U') ? 'selected': ''}}>Dokter Umum / Dokter Gigi</option>
                    <option value="S" {{($jenis_dokter == 'S') ? 'selected': ''}}>Dokter Spesialis</option>
                  </select>
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>

              <?php
              if($id==0){
              ?>
              <div class="form-group">
                <label class="col-lg-4 col-md-4">Username </label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="username" class="form-control" style="border-radius: 10px !important" placeholder="username" required>
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>

              <div class="form-group">
                <label class="col-lg-4 col-md-4">Password </label>
                <div class="col-lg-8 col-md-8">
                  <input type="password" name="password" class="form-control" style="border-radius: 10px !important" placeholder="password" required>
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>
              <?php
              }
              ?>

              <div class="form-group">
                <label class="col-lg-4 col-md-4">Tanda tangan </label>
                <div class="col-lg-8 col-md-8">
                  <input type="file" name="ttd" class="form-control" style="border-radius: 10px !important">
                  @if($ttd!='')
                    @if(file_exists('ttd/'.$ttd))
                      <img src="{{ asset('ttd/'.$ttd) }}" alt="tanda tangan" style="width:30%">
                    @else
                    @endif
                  @endif
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>
          </div>
          <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Proses">
      </div>
      </form>
    </div>

  </div>
</div>

<!-- <script src="{!!  asset('adminAsset/js/jquery-ui-1.10.3.min.js') !!}" type="text/javascript"></script> -->
<script type="text/javascript">
    $(function() {
        $(".chzn-select").chosen();
    });;


</script>
