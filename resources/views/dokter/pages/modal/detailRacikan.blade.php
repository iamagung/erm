<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Racikan</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 col-md-12" style="">

          <div class="col-lg-12 col-md-12">
            <div class="col-lg-12 col-md-12" style="border:1px solid #ccc;box-shadow: 0px 5px 5px #ccc;">
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <h3>Obat</h3>
              </div>
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <table class="table table-bordered">
                  @if (count($racikan) > 0)
                    @foreach ($racikan as $key)
                      <tr>
                        <td class="text-center">{{ $key->No_Urut }}.</td>
                        <td>{{ $key->KodeBrg }}</td>
                        <td>{{ $key->NamaBrg }}</td>
                        <td class="text-right">{{ $key->Dosis }}</td>
                        <td>{{ $key->Satuan }}</td>
                      </tr>
                    @endforeach
                  @endif
                </table>
                <table class="table table-bordered">
                  <tr>
                    <td>Perintah</td>
                    <td>{{ $racikanDetail->MF }}</td>
                  </tr>
                  <tr>
                    <td>Jumlah</td>
                    <td>{{ $racikanDetail->Jumlah }}</td>
                  </tr>
                  <tr>
                    <td>Jam Signa</td>
                    <td>{{ $racikanDetail->JamSigna }}</td>
                  </tr>
                  <tr>
                    <td>Signa</td>
                    <td>{{ number_format($racikanDetail->Signa1,0) }}</td>
                  </tr>
                  <tr>
                    <td>dd</td>
                    <td>{{ number_format($racikanDetail->Signa2,0) }}</td>
                  </tr>
                  <tr>
                    <td>Signa Khusus</td>
                    <td>{{ $racikanDetail->SignaKhusus }}</td>
                  </tr>
                  <tr>
                    <td>Petunjuk Khusus</td>
                    <td>{{ $racikanDetail->Keterangan }}</td>
                  </tr>
                </table>
                <div class="clearfix" style="margin-bottom: 10px"></div>
              </div>
            </div>
          </div>

        </div>
        <div class="clearfix" style="margin-bottom: 20px"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
