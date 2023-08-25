<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Rekap Medik <span style="float:right;margin-right: 20px"><a href="{{ url('all/rekam_medik_new/cetak/'.$rekap->id_rekapMedik) }}" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-print"></i> Cetak</a></span></h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 col-md-12" style="">
          <div class="col-lg-4 col-md-4">
            <div class="col-lg-12 col-md-12" style="border:1px solid #ccc;box-shadow: 0px 5px 5px #ccc;">
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <h3>Tanda Vital</h3>
              </div>
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <table class="table table-bordered">
                  <tr>
                    <td>1 Tekanan Darah</td>
                    <td>{!! $rekap->tekanan_darah !!} mmhg</td>
                  </tr>
                  <tr>
                    <td>2 Frekuensi Nadi</td>
                    <td>{!! $rekap->frek_nadi !!} x/menit</td>
                  </tr>
                  <tr>
                    <td>3 Suhu</td>
                    <td>{!! $rekap->suhu !!} ^C</td>
                  </tr>
                  <tr>
                    <td>4 Frekuensi Nafas</td>
                    <td>{!! $rekap->frek_nafas !!} x/menit</td>
                  </tr>
                  <tr>
                    <td>5 Skor Nyeri</td>
                    <td>{!! $rekap->skor_nyeri !!}</td>
                  </tr>
                  <tr>
                    <td>6 Skor Jatuh</td>
                    <td>{!! $rekap->skor_jatuh !!}</td>
                  </tr>
                </table>
                <div class="clearfix" style="margin-bottom: 10px"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="col-lg-12 col-md-12" style="box-shadow: 0px 5px 5px #ccc;border: 1px solid #ccc;">
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <h3>Antromometri</h3>
              </div>
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <table class="table table-bordered">
                  <tr>
                    <td>1 Berat Badan</td>
                    <td>{!! $rekap->berat_badan !!}</td>
                  </tr>
                  <tr>
                    <td>2 Tinggi Badan</td>
                    <td>{!! $rekap->tinggi_badan !!}</td>
                  </tr>
                  <tr>
                    <td>3 Lingkar Kepala *</td>
                    <td>{!! $rekap->lingkar_kepala !!}</td>
                  </tr>
                  <tr>
                    <td>4 IMT <br/><i>*Khusus pediatri</i></td>
                    <td>{!! $rekap->imt !!}</td>
                  </tr>
                </table>
                <div class="clearfix" style="margin-bottom: 10px"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="col-lg-12 col-md-12" style="box-shadow: 0px 5px 5px #ccc;border: 1px solid #ccc">
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <h3>Fungsional</h3>
              </div>
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <table class="table table-bordered">
                  <tr>
                    <td>
                      <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12" for="alatBantu">1 Alat Bantu</label>
                    </td>
                    <td>
                      <?php
                      $check='';
                      if($rekap->alat_bantu!=''){
                        $check='checked';
                      }
                      ?>
                      <input type="checkbox" disabled {!! $check !!} id="alatBantu" name="alat_bantu" value="ada">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12" for="prothesa">2 Prothesa</label>
                    </td>
                    <td>
                      <?php
                      $check='';
                      if($rekap->prothesa!=''){
                        $check='checked';
                      }
                      ?>
                      <input type="checkbox" disabled {!! $check !!} id="prothesa" name="prothesa" value="ada">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12" for="cacatTubuh">3 Cacat Tubuh</label>
                    </td>
                    <td>
                      <?php
                      $check='';
                      if($rekap->cacat_tubuh!=''){
                        $check='checked';
                      }
                      ?>
                      <input type="checkbox" disabled {!! $check !!} id="cacatTubuh" name="cacat_tubuh" value="ada">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">4 ADI</label>
                    </td>
                    <td>
                      <?php
                      $check=['',''];
                      if($rekap->adi=='mandiri'){
                        $check=['checked',''];
                      }else if($rekap->adi=='dibantu'){
                        $check=['','checked'];
                      }
                      ?>
                      <label> <input type="radio" disabled {!! $check[0] !!} name="adi" value="mandiri"> Mandiri</label>
                      <label style="margin-left: 20px"> <input type="radio" disabled {!! $check[1] !!} name="adi" value="dibantu"> Dibantu</label>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">5 Riwayat Jatuh</label>
                    </td>
                    <td>
                      <?php
                      $check=['',''];
                      if($rekap->riwayat_jatuh=='+'){
                        $check=['checked',''];
                      }else if($rekap->riwayat_jatuh=='-'){
                        $check=['','checked'];
                      }
                      ?>
                      <label> <input type="radio" disabled {!! $check[0] !!} name="riwayat_jatuh" value="+"> +</label>
                      <label style="margin-left: 20px"> <input type="radio" disabled {!! $check[1] !!} name="riwayat_jatuh" value="-"> -</label>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">6 Skrining Nyeri</label>
                    </td>
                    <td>
                      <?php
                      $check=['',''];
                      $display = 'display: none';
                      if($rekap->skrining_nyeri=='Tidak' || $rekap->skrining_nyeri==''){
                        $check=['','checked'];
                      }else{
                        $display = '';
                        $check=['checked',''];
                      }
                      ?>
                      <div class="col-lg-12 col-md-12" style="padding: 0px">
                        <div class="col-lg-4 col-md-4" style="padding: 0px">
                          <label> <input type="radio" disabled {!! $check[0] !!} id="adaSkriningNyeri" name="skrining_nyeri" value="Ada"> Ada</label>
                        </div>
                        <div class="col-lg-8 col-md-8">
                          <?php
                          echo ($rekap->skrining_nyeri!='Tidak') ? $rekap->skrining_nyeri:'';
                          ?>
                        </div>
                      </div>
                      <br/>
                      <label> <input type="radio" disabled {!! $check[1] !!} name="skrining_nyeri" value="Tidak"> Tidak</label>
                    </td>
                  </tr>
                </table>
                <div class="clearfix" style="margin-bottom: 10px"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix" style="margin-bottom: 20px"></div>
        <div class="col-lg-12 col-md-12" style="box-shadow: 0px 10px 10px #ddd;border:1px solid #ccc;background: #fafafa">
          <div class="clearfix" style="margin-bottom: 10px"></div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Status Psikologi</label>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <?php
              $check=['','','',''];
              if($rekap->status_psikologi!=''){
                $st = explode("+", $rekap->status_psikologi);
                for ($i=0; $i < count($st)-1; $i++) {
                  if($st[$i]=='Depresi'){
                    $check[0] = 'checked';
                  }
                  if($st[$i]=='Takut'){
                    $check[1] = 'checked';
                  }
                  if($st[$i]=='Agresif'){
                    $check[2] = 'checked';
                  }
                  if($st[$i]=='Melukai diri sendiri/ Orang lain'){
                    $check[3] = 'checked';
                  }
                }
              }
              ?>
              <label> <input type="checkbox" disabled {!! $check[0] !!} name="status_psikologi[]" value="Depresi"> Depresi</label>
              <label style="margin-left: 20px"> <input type="checkbox" disabled {!! $check[1] !!} name="status_psikologi[]" value="Takut"> Takut</label>
              <label style="margin-left: 20px"> <input type="checkbox" disabled {!! $check[2] !!} name="status_psikologi[]" value="Agresif"> Agresif</label>
              <label style="margin-left: 20px"> <input type="checkbox" disabled {!! $check[3] !!} name="status_psikologi[]" value="Melukai diri sendiri/ Orang lain"> Melukai diri sendiri/ Orang lain</label>
            </div>
          </div>
          <div class="clearfix" style="margin-bottom: 10px"></div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Hambatan edukasi</label>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <?php
              $check=['',''];
              $bahasaval = '';
              $display = 'display: none';
              if($rekap->hambatan!=''){
                $st = explode("+", $rekap->hambatan);
                for ($i=0; $i < count($st)-1; $i++) {
                  if($st[$i]=='Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)'){
                    $check[1] = 'checked';
                  }else{
                    $check[0] = 'checked';
                    $display = '';
                    $bahasaval = $st[$i];
                  }
                }
              }
              ?>
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <div class="col-lg-4 col-md-4" style="padding: 0px">
                  <label> <input type="checkbox" disabled {!! $check[0] !!} id="hambatanBahasa" name="hambatan[]" value="Bahasa"> Bahasa</label>
                </div>
                <div class="col-lg-8 col-md-8">
                  <input type="text" readonly name="bahasa_lain" class="form-control" style="border-radius: 10px !important;{!! $display !!}" value="{!! $bahasaval !!}">
                </div>
              </div>
              <br/><label> <input type="checkbox" disabled {!! $check[1] !!} name="hambatan[]" value="Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)"> Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)</label>
            </div>
          </div>
          <div class="clearfix" style="margin-bottom: 10px"></div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Agama/ Nilai Kepercayaan</label>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <input type="text" readonly name="agama" class="form-control" value="{!! $rekap->agama !!}">
            </div>
          </div>
          <div class="clearfix" style="margin-bottom: 10px"></div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pendidikan</label>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <input type="text" readonly name="pendidikan" class="form-control" value="{!! $rekap->pendidikan !!}">
            </div>
          </div>
          <div class="clearfix" style="margin-bottom: 10px"></div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pekerjaan</label>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <input type="text" readonly name="pekerjaan" class="form-control" value="{!! $rekap->pekerjaan !!}">
            </div>
          </div>
          <div class="clearfix" style="margin-bottom: 10px"></div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Alergi</label>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <input type="text" readonly name="alergi" class="form-control" value="{!! $rekap->alergi !!}">
            </div>
          </div>
          <div class="clearfix" style="margin-bottom: 10px"></div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Discharge Planning</label>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
              <input type="text" readonly name="discharge" class="form-control" value="{!! $rekap->discharge !!}">
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
              Hari
            </div>
          </div>
          <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
        <div class="clearfix" style="margin-bottom: 20px"></div>
        <div class="col-lg-12 col-md-12" style="box-shadow: 0px 10px 10px #ddd;border: 1px solid #ccc;background: #fafafa">
          <div class="clearfix" style="margin-bottom: 10px"></div>
          <div class="col-lg-12 col-md-12" style="padding: 0px">
            <div class="col-lg-6 col-md-6">
              <label class="col-lg-12 col-md-12" style="padding: 0px">Anamnesis (S) dan Pemeriksaan fisik (O)</label>
              Anamnesis (S)
              <div class="clearfix"></div>
              <?php
              if($rekap->foto_anamnesis!=''){
                ?>
                <div class="col-lg-12 col-md-12">
                  <img src="{{asset($rekap->foto_anamnesis)}}" style="width: 100%">
                </div>
                <div class="clearfix"></div>
                <?php
              }
              ?>
              <textarea class="form-control" placeholder="Text Here" name="anamnesis" readonly>{{$rekap->anamnesis}}</textarea>
              <div class="clearfix" style="margin-bottom: 10px"></div>

              Pemerksaan Fisik (O)
              <div class="clearfix"></div>
              <?php
              if($rekap->fotoPemeriksaanFisik!=''){
                ?>
                <div class="col-lg-12 col-md-12">
                  <img src="{{asset($rekap->fotoPemeriksaanFisik)}}" style="width: 100%">
                </div>
                <div class="clearfix"></div>
                <?php
              }
              ?>
              <textarea class="form-control" placeholder="Text Here" name="anamnesis" readonly>{{$rekap->pemeriksaanFisik}}</textarea>
              <div class="clearfix" style="margin-bottom: 10px"></div>
            </div>
            <div class="col-lg-6 col-md-6">

              <div class="col-lg-12 col-md-12" style="padding: 0px">
                Kesan Status Gizi
                <?php
                $check = ['','',''];
                if($rekap->kesan_gizi!=''){
                  $st = explode("+", $rekap->kesan_gizi);
                  for ($i=0; $i < count($st)-1; $i++) {
                    switch ($st[$i]) {
                      case '1':
                        $check[0]='checked';
                        break;
                      case '2':
                        $check[1]='checked';
                        break;
                      case '3':
                        $check[2]='checked';
                        break;

                      default:
                        # code...
                        break;
                    }
                  }
                }
                ?>
                <br/><label><input type="checkbox" {{$check[0]}} name="gizi[]" value="1" disabled>Gizi Kurang/ Buruk</label>
                <br/><label><input type="checkbox" {{$check[1]}} name="gizi[]" value="2" disabled>Gizi Cukup</label>
                <br/><label><input type="checkbox" {{$check[2]}} name="gizi[]" value="3" disabled>Gizi lebih</label>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <div class="col-lg-8 col-md-8" style="padding: 0px">
                  <label class="col-lg-12 col-md-12" style="padding: 0px">Diagnosa</label>
                  <div class="clearfix"></div>
                  <?php
                  if($rekap->fotodiagnosa!=''){
                    ?>
                    <div class="col-lg-12 col-md-12">
                      <img src="{!! asset($rekap->fotodiagnosa) !!}" style="width: 100%">
                    </div>
                    <div class="clearfix"></div>
                    <?php
                  }
                  ?>
                  <ol>
                  <?php
                  if($rekap->diagnosa!=''){
                    $n = explode(";", $rekap->diagnosa);
                    for ($i=0; $i < count($n)-1; $i++) {
                      ?>
                      <li>{{$n[$i]}}</li>
                      <?php
                    }
                  }
                  ?>
                  </ol>
                </div>
                <div class="col-lg-4 col-md-4" style="padding: 0px">  Kode ICD 10
                  <div class="clearfix"></div>
                  <ol>
                  <?php
                  if($rekap->icd10!=''){
                    $n = explode(";", $rekap->icd10);
                    for ($i=0; $i < count($n)-1; $i++) {
                      ?>
                      <li>{{$n[$i]}}</li>
                      <?php
                    }
                  }
                  ?>
                  </ol>
                </div>
              </div>
              <div class="col-lg-12 col-md-12" style="padding: 0px">
                <div class="col-lg-8 col-md-8" style="padding: 0px">
                  <label>Tindakan</label>
                  <ol>
                  <?php
                  if($rekap->tindakan!=''){
                    $n = explode(";", $rekap->tindakan);
                    for ($i=0; $i < count($n)-1; $i++) {
                      ?>
                      <li>{{$n[$i]}}</li>
                      <?php
                    }
                  }
                  ?>
                  </ol>
                </div>
                <div class="col-lg-4 col-md-4">
                  ICD 9
                  <ol>
                  <?php
                  if($rekap->icd9!=''){
                    $n = explode(";", $rekap->icd9);
                    for ($i=0; $i < count($n)-1; $i++) {
                      ?>
                      <li>{{$n[$i]}}</li>
                      <?php
                    }
                  }
                  ?>
                  </ol>
                </div>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>
              <!-- <div style="display:none"> -->
              <div>
                <label class="col-lg-12 col-md-12" style="padding: 0px">Rencana dan terapi (P)</label>
                <div class="clearfix"></div>
                <?php
                if($rekap->foto_rencana!=''){
                  ?>
                  <div class="col-lg-12 col-md-12">
                    <img src="{{asset($rekap->foto_rencana)}}" style="width: 100%">
                  </div>
                  <div class="clearfix"></div>
                  <?php
                }
                ?>
                <textarea class="form-control" placeholder="Text Here" name="rencana3" readonly>{{$rekap->rencana_terapi}}</textarea>
                <div class="clearfix" style="margin-bottom: 10px"></div>
              </div>

              <div class="table_rujuk">
                <?php
                $rujukan = DB::table('rujukan_rm')->where('rekapMedik_id',$rekap->id_rekapMedik)->get();
                if(count($rujukan)!=0){
                  ?>
                  Hasil rujukan
                  <table class="table table-bordered">
                    <tr>
                      <th>Rujukan</th>
                      <th>Hasil Rujukan</th>
                    </tr>
                    <?php
                    foreach ($rujukan as $key) {
                      ?>
                      <tr>
                        <td>
                          {!! $key->Rujuk !!}
                        </td>
                        <td>
                          <p>Poli <b>{{$key->NamaPoli}}</b></p>
                          <p>Dokter <b>{{$key->DokterPoli}}</b></p>
                          <p>Hasil</p>
                          <p><b>{{$key->HasilRujuk}}</b></p>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </table>
                  <div class="clearfix" style="margin-bottom: 10px"></div>
                  <?php
                }
                ?>
              </div>

              <div class="clearfix" style="margin-bottom: 10px"></div> <!-- Resep -->
              <div class="col-lg-12 col-md-12 tahap5" style="padding: 0px">
                Obat Resep
                <table class="table table-bordered" style="background: #fff">
                  <thead>
                    <tr>
                      <th>Nama Obat</th>
                      <th>Qty</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(count($tr_rajalobat)>0){
                      foreach ($tr_rajalobat as $key) {
                        ?>
                        <tr>
                          <td>{{$key->NamaBrg}}</td>
                          <td>{{$key->Jml.' '.$key->Satuan}}</td>
                        </tr>
                        <?php
                      }
                    }else if(count($tr_resep)>0){
                      foreach ($tr_resep as $key) {
                        ?>
                        <tr>
                          <td>{{$key->NamaBrg}}</td>
                          <td>{{$key->Jumlah.' '.$key->Satuan}}</td>
                        </tr>
                        <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="2">tidak ada resep</td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <div class="clearfix" style="margin-bottom: 10px"></div>
              <div class="col-lg-12 col-md-12 tahap5" style="padding: 0px">
                Obat Racikan
                <table class="table table-bordered" style="background: #fff">
                  <thead>
                    <tr>
                      <th>Nama Obat</th>
                      <th>Qty</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(count($tr_racikan)==0){
                      ?>
                      <tr>
                        <td colspan="2">tidak ada racikan</td>
                      </tr>
                      <?php
                    }else{
                      foreach ($tr_racikan as $key => $v) {
                        ?>
                        <tr>
                          <td>{{$v->NamaBrg}}</td>
                          <td>{{$v->Jumlah.' '.$v->Satuan}}</td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="clearfix" style="margin-bottom: 20px"></div>
        </div>
        <div class="clearfix" style="margin-bottom: 20px"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
