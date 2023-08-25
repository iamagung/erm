<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <?php
    $poliedit = DB::table('login_dokter as l')->join('users as u','u.id','l.user_id')->where('l.id',$id)->first();
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Dokter Poli</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-lg-4 col-md-4">Nama Dokter</label>
          <div class="col-lg-8 col-md-8">
            <input type="text" class="form-control" readonly value="{!! $poliedit->Nama_Dokter !!}" style="border-radius: 10px !important">
          </div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>

        <div class="form-group">
          <label class="col-lg-4 col-md-4">Nama Poli</label>
          <div class="col-lg-8 col-md-8">
            <input type="text" class="form-control" readonly value="{!! $poliedit->Nama_Poli !!}" style="border-radius: 10px !important">
          </div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>

        <div class="form-group">
          <label class="col-lg-4 col-md-4">Jenis Dokter</label>
          <div class="col-lg-8 col-md-8">
            <input type="text" class="form-control" readonly value="{!! ($poliedit->jenis_dokter)?($poliedit->jenis_dokter == 'S')?'Dokter Spesialis':'Dokter Umum/Gigi':'-' !!}" style="border-radius: 10px !important">
          </div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>

        <div class="form-group">
          <label class="col-lg-4 col-md-4">Username Dokter</label>
          <div class="col-lg-8 col-md-8">
            <input type="text" class="form-control" readonly value="{!! $poliedit->username !!}" style="border-radius: 10px !important">
          </div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>

        <div class="form-group">
          <label class="col-lg-4 col-md-4">TTD</label>
          <div class="col-lg-8 col-md-8">
            @if($poliedit->ttd!='')
              @if(file_exists('ttd/'.$poliedit->ttd))
                <img src="{{ asset('ttd/'.$poliedit->ttd) }}" alt="tanda tangan" style="width:30%">
              @else
              @endif
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
