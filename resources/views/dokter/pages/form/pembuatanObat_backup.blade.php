@extends('dokter.master.main')
@section('content')
<style media="screen">
  /* table {
    width: inherit !important;
  }
  tr {}
  td, th {
    width: auto;
    border: 1px solid #eee;
  }
  td.min, th.min {
    width: 1px !important;
    white-space: nowrap !important;
  } */
</style>
<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">

    <h1 class="text-center">

        <b>Pembuatan Resep</b>

    </h1>

</section>
<?php
// $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
?>
<div class="col-md-12 col-md-12">

    <div class="box">

        <div class="box-header">

            <div class="box-tools pull-right">

                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>
            </div>

        </div>

        <div class="box-body">
            <!-- <div class="col-lg-12 col-md-12">
                <a href="#" class="btn btn-primary" style="border-radius: 10px !important" onclick="formAdmin(0)"><i class="fa fa-plus"> Tambah Admin</i></a>
            </div> -->
            <input type="hidden" name="poli_id" id="poli_id" value="{{ $dokter->poli_id }}">
            <input type="hidden" name="dokter" id="dokter" value="{{ $dokter->Nama_Dokter }}">
            <input type="hidden" name="Nama_Pasien" id="Nama_Pasien" value="{{ $rekap->Nama_Pasien }}">
            <input type="hidden" name="no_RM" id="no_RM" value="{{ $rekap->no_RM }}">
            <input type="hidden" name="NamaAsuransi" id="NamaAsuransi" value="{{ $reg->NamaAsuransi }}">
            <input type="hidden" name="Tgl_Lahir" id="Tgl_Lahir" value="{{ $reg->Tgl_Lahir }}">

            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-8 col-md-8 col-lg-offset-1 col-md-offset-1" style="padding: 0px">
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group col-lg-12 col-md-12" style="padding: 0px">
                    <div class="col-lg-2 col-md-2" style="padding: 0px">
                        <label class="col-lg-12 col-md-12">No. Resep</label>
                    </div>
                    <div class="col-lg-10 col-md-10" style="padding: 0px">
                        <div class="col-lg-11 col-md-11">
                            <input type="hidden" name="isEdit" id="isEdit" value="{{ ($resep) ? 'true' : 'false' }}">
                            <input type="text" id="noResep" name="noResep" class="form-control" style="border-radius: 10px !important" value="{{ ($resep) ? $resep->No_Resep : '' }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group col-lg-12 col-md-12" style="padding: 0px">
                    <div class="col-lg-2 col-md-2" style="padding: 0px">
                        <label class="col-lg-12 col-md-12">No. Register</label>
                    </div>
                    <div class="col-lg-10 col-md-10" style="padding: 0px">
                        <div class="col-lg-11 col-md-11">
                            <input type="text" id="noReg" name="search" class="form-control" style="border-radius: 10px !important" value="{{$rekap->no_Register}}" readonly>
                        </div>
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group col-lg-12 col-md-12" style="padding: 0px">
                    <div class="col-lg-2 col-md-2" style="padding: 0px">
                        <label class="col-lg-12 col-md-12">Tgl. Resep</label>
                    </div>
                    <div class="col-lg-10 col-md-10" style="padding: 0px">
                        <div class="col-lg-11 col-md-11">
                          <?php
                            $tglResep = date('Y-m-d H:i:s');
                            if($resep){
                              $tglResep = $resep->Tgl_Resep;
                            }
                          ?>
                            <input type="datetime" id="tglResep" data-date-format="yyyy-mm-dd hh:ii:ss" name="tglResep" class="form-control lahir" style="border-radius: 10px !important" value="{{ $tglResep }}">
                        </div>
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group col-lg-12 col-md-12" style="padding: 0px">
                    <div class="col-lg-2 col-md-2" style="padding: 0px">
                        <label class="col-lg-12 col-md-12">Dokter</label>
                    </div>
                    <div class="col-lg-10 col-md-10" style="padding: 0px">
                        <div class="col-lg-11 col-md-11">
                            <input type="text" id="searchtext" name="search" class="form-control" style="border-radius: 10px !important" value="{{$dokter->Nama_Dokter}}" readonly>
                        </div>
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group col-lg-12 col-md-12" style="padding: 0px">
                    <div class="col-lg-2 col-md-2" style="padding: 0px">
                        <label class="col-lg-12 col-md-12">Berat Badan</label>
                    </div>
                    <div class="col-lg-7 col-md-7" style="padding: 0px">
                        <div class="col-lg-12 col-md-12">
                            <input value="{{ ($resep) ? number_format($resep->BB,0) : $rekap->berat_badan }}" type="text" id="bb" name="bb" class="form-control" style="border-radius: 10px !important">
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1" style="padding: 0px">
                        <!-- <div class="col-lg-12 col-md-12">kg</div> -->
                        <select name="satuanBB" id="satuanBB" style="border-style: none;">
                            <option value="Kg" {{ ($resep) ? ($resep->SatuanBB=='Kg') ? 'selected' : '' : '' }}>Kg</option>
                            <option value="gram" {{ ($resep) ? ($resep->SatuanBB=='gram') ? 'selected' : '' : '' }}>gram</option>
                        </select>
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group col-lg-12 col-md-12" style="padding: 0px">
                    <div class="col-lg-2 col-md-2" style="padding: 0px">
                        <label class="col-lg-12 col-md-12">Tinggi Badan</label>
                    </div>
                    <div class="col-lg-7 col-md-7" style="padding: 0px">
                        <div class="col-lg-12 col-md-12">
                            <input value="{{ ($resep) ? number_format($resep->TB,0) : $rekap->tinggi_badan }}" type="text" id="tb" name="tb" class="form-control" style="border-radius: 10px !important">
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1" style="padding: 0px">
                        <div class="col-lg-12 col-md-12">cm</div>
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                <div class="form-group col-lg-12 col-md-12" style="padding: 0px">
                    <div class="col-lg-2 col-md-2" style="padding: 0px">
                        <label class="col-lg-12 col-md-12">Alergi</label>
                    </div>
                    <div class="col-lg-10 col-md-10" style="padding: 0px">
                        <div class="col-lg-11 col-md-11">
                            <!-- <input type="text" id="searchtext" name="search" class="form-control" style="border-radius: 10px !important"> -->
                            <select name="alergi" id="alergi" class="form-control col-lg-6 col-md-6">
                                <option value="TIDAK ADA ALERGI" {{ ($resep) ? ($resep->isAlergi=='TIDAK ADA ALERGI') ? 'selected' : '' : '' }}>TIDAK ADA ALERGI</option>
                                <option value="ADA ALERGI" {{ ($resep) ? ($resep->isAlergi=='ADA ALERGI') ? 'selected' : '' : ($rekap->alergi != '' && $rekap->alergi != '-') ? 'selected' : '' }}>ADA ALERGI</option>
                                <option value="TIDAK TAHU" {{ ($resep) ? ($resep->isAlergi=='TIDAK TAHU') ? 'selected' : '' : '' }}>TIDAK TAHU</option>
                            </select>
                            <div class="clearfix" style="margin-bottom: 10px"></div>
                            <input value="{{ ($resep) ? ($resep->isAlergi=='ADA ALERGI') ? $resep->NamaAlergi : '' : $rekap->alergi }}" type="text" id="namaAlergi" name="namaAlergi" placeholder="Isi jika ada ada alergi" class="form-control col-lg-6 col-md-6" style="border-radius: 10px !important">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-2" style="padding: 0px">
                <a href="{{route('buatEditResep')}}">
                    <button type="button" class="btn btn-success btn-lg col-lg-12 col-md-12">Racik</button>
                </a>
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <a href="{{route('historyPasien')}}">
                    <button type="button" class="btn btn-warning btn-lg col-lg-12 col-md-12">History</button>
                </a>
            </div>

            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12" style="overflow: auto">
              <style media="screen">
                .data-list-txt {
                  min-width: 90%;
                  max-width: 90%;
                  display: inline;
                  border-right: none;
                  border-radius: 4px 0 0 4px;
                  background-color: #fff;
                }
                .data-list {
                  margin-top: -34px;
                }
              </style>

                <table class="table table-bordered table-striped" id="dataPoli">
                    <thead>
                        <tr>
                            <th class="min text-center" style="width:10px;"><!--<i class="fa fa-check-square-o" aria-hidden="true"></i>--></th>
                            <th class="min" style="width:10px;">No R</th>
                            <th class="min">Kode</th>
                            <th class="min">Obat</th>
                            <th class="min">Jumlah</th>
                            <th class="min">Satuan</th>
                            <th class="min">Kode GD</th>
                            <th class="min">Jam Signa</th>
                            <th class="min">Signa1</th>
                            <th class="min">Signa2</th>
                            <th>Petunjuk Khusus</th>
                            <th class="min">Satuan Signa</th>
                            <th class="min">Signa Khusus</th>
                            <th class="min">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="hasilCari">
                      @if (count($racikanPasien)>0)
                        @foreach ($racikanPasien as $key)
                          <tr>
                            <td class="min text-center"> <input type="checkbox" name="resepIds[]" class="delResepItem" data-type='resep' value="{{ $key->No_R }}"> </td>
                            <td class="min">{{ $key->No_R }}</td>
                            <td class="min">{{ $key->KodeBrg }}</td>
                            <td class="min">{{ $key->NamaBrg }}</td>
                            <td class="min">{{ number_format($key->Jumlah,0) }}</td>
                            <td class="min">{{ $key->Satuan }}</td>
                            <td class="min">{{ $key->KodeGD }}</td>
                            <td class="min">{{ $key->JamSigna }}</td>
                            <td class="min">{{ $key->Signa1 }}</td>
                            <td class="min">{{ $key->Signa2 }}</td>
                            <td>{{ $key->Keterangan }}</td>
                            <td class="min">{{ $key->SatuanSigna }}</td>
                            <td class="min">{{ $key->SignaKhusus }}</td>
                            <td class="min">
                              {{-- <a href="#" onclick="detailRekapRJ({{ $key->No_R }},{{ $key->No_Register }})" class="btn btn-sm btn-success">Lihat</a> --}}
                            </td>
                          </tr>
                        @endforeach
                      @endif
                        <tr>
                            <td class="min"></td>
                            <td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="no_R" id="no_R" style="width:30px;"></td>
                            <td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="kode_obat" id="kode_obat" style="width:60px;"></td>
                            <td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="nama_obat" id="nama_obat"></td>
                            <td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="jumlah" id="jumlah" style="width:30px;"></td>
                            <td class="min">
                              <input class="" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan" id="satuan" style="width:60px;">
                              {{-- <select class="chzn-select" name="satuan" id="satuan"> --}}
        	                    	{{-- <option value="" disabled selected></option> --}}
        			                    <?php
        			                    // foreach ($satuan as $key) {
        			                      ?>
        			                      {{-- <option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option> --}}
        			                      <?php
        			                    // }
        			                    ?>
        	                  	{{-- </select> --}}
                            </td>
                            <td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="kode_gd" id="kode_gd" style="width:50px;"></td>
                            <td class="min"><input type="time" onkeydown="ModifyEnterKeyPressAsTab(event);" name="jam_signa" id="jam_signa" style="width:90px;" value='07:00:00'></td>
                            <td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="signa1" id="signa1" style="width:30px;"></td>
                            <td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="signa2" id="signa2" style="width:30px;"></td>
                            <td>

                              <input class="data-list-txt form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" type="text" value="" name="petunjuk_khusus" id="petunjuk_khusus">
                              <select style="width:160px;" class="data-list form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" id="list2" onchange="setValuePetunjuk(this.value)">
                                <option value="" style="display:none"></option>
                                <?php
                                  foreach ($petunjuk_khusus as $key) {
                                    ?>
                                    <option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
                                    <?php
                                  }
                                ?>
                              </select>

                            </td>
                            <td class="min">
                              <select class="chzn-select form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan_signa" id="satuan_signa" style="width:120px;">
        	                    	<option value="" disabled selected></option>
        			                    <?php
        			                    foreach ($satuan_signa as $key) {
        			                      ?>
        			                      <option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
        			                      <?php
        			                    }
        			                    ?>
        	                  	</select>
                            </td>
                            <td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="signa_khusus" id="signa_khusus" placeholder="(Memo)"></td>
                            <td class="min">
                                {{-- <a href="javascript:void(0);" onclick="simpanResep()" class="btn btn-sm btn-primary">Simpan</a> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="tempat-obat"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 col-md-12">
                <div>
                  {{-- {{ $racikanPasien->appends(['res' => $res->currentPage()])->links() }} untuk multipagination --}}
                  {{ ($racikanPasien) ? $racikanPasien->links() : '' }}
                    {{-- <ul class="pagination" style="float:none"> --}}
                        <?php
                        // $total = 1;
                        // $paging1 = ceil(count($total)/10);
                        // $page=1;
                        ?>
                        {{-- <li class='disabled'><a href='#'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>
                        <li class='disabled'><a href='#'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li> --}}
                        <?php
                        // $batas = 4;
                        // $start_number = ($page > $batas)? $page - $batas : 1; // Untuk awal link number
                        // $end_number = ($page < ($paging1 - $batas))? $page + $batas : $paging1;
                        // for ($i = $start_number; $i <= $end_number; $i++) {
                        //     if($i==1){
                        //         $a = 'class="active"';
                        //     }else{
                        //         $a = '';
                        //     }
                        //     echo "<li $a><a href='#' onclick='page($i)'>$i</a></li>";
                        // }
                        // if($page==$paging1){
                            ?>
                            {{-- <li class="disabled"><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                            <li class="disabled"><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li> --}}
                            <?php
                        // }else{
                            ?>
                            {{-- <li><a href='#' onclick="page({!! $start_number+1 !!})"><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                            <li><a href='#' onclick="page({!! $paging1 !!})"><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li> --}}
                            <?php
                        // }
                        ?>
                    {{-- </ul> --}}
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12" style="overflow: auto">
                <table class="table table-bordered table-striped" id="dataPoli">
                  <thead>
                      <tr>
                          <th></th>
                          <th>No_Resep</th>
                          <th>R</th>
                          <th>MF</th>
                          <th>Keterangan</th>
                          <th>Nama Obat 1</th>
                          <th>Nama Obat 2</th>
                          <th width="5%">Aksi</th>
                      </tr>
                  </thead>
                  <tbody id="">
                    @if (count($racikan)>0)
                      @foreach ($racikan as $key)
                        <tr>
                            <td class="text-center"><input type="checkbox" name="resepIds[]" class="delResepItem" data-type='racik' value="{{ $key->No_R }}"></td>
                            <td>{{ $key->No_Resep }}</td>
                            <td>{{ $key->No_R }}</td>
                            <td>{{ $key->MF }}</td>
                            <td>{{ $key->Keterangan }}</td>
                            <td>{{ $key->NamaObat1 }}</td>
                            <td>{{ $key->NamaObat2 }}</td>
                            <td>
                              <a href="javascript:void(0)" onclick="detailRacikanObat('{{ $key->No_Resep }}','{{ $key->No_R }}')" class="btn btn-sm btn-success">Lihat</a>
                            </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 col-md-12">
                {{-- PAGING HERE --}}
            </div>
            <div class="clearfix" style="margin-bottom: 50px;"></div>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="col-lg-6 col-md-6">
                      <div class="clearfix" style="margin-bottom: 10px"></div>
                      <div class="col-lg-6 col-md-6">
                          <!-- <button type="button" class="btn btn-warning btn-md" href="{!! route('cetakReport') !!}"> -->
                          <a class="btn btn-warning btn-md" href="{!! route('cetakReport') !!}">
                              <i class="fa fa-print" aria-hidden="true"></i> Cetak Resep
                          <!-- </button> -->
                          </a>
                          <!-- <i class="fa fa-print" aria-hidden="true"></i> -->
                          <!-- <input type="button" class="btn btn-warning btn-md" value="Cetak Resep" onclick=""/> -->
                      </div>

                      <div class="col-lg-6 col-md-6">
                        <a class="btn btn-default btn-md" href="{!! route('cetakAntrian',['no_resep'=>$resep->No_Resep]) !!}">
                          <i class="fa fa-print" aria-hidden="true"></i> Cetak Antrian
                        </a>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="col-lg-6 col-md-6">
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="clearfix" style="margin-bottom: 10px"></div>
                        <button type="button" class="btn btn-danger btn-md" onclick="delResepItem();">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                        </button>
                      </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="col-lg-6 col-md-6">
                      <div class="col-lg-6 col-md-6">
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="clearfix" style="margin-bottom: 10px"></div>
                        <button type="button" class="btn btn-primary btn-md" onclick="saveResep();">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan
                        </button>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="col-lg-6 col-md-6">
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="clearfix" style="margin-bottom: 10px"></div>
                        <button type="button" class="btn btn-danger btn-md" onclick="window.location.href='{{ route('content2') }}'">
                        <i class="fa fa-times" aria-hidden="true"></i> Keluar
                        </button>
                      </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="modal_layout"></div>
    <div class="other-page"></div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">
    function ModifyEnterKeyPressAsTab(event)
    {
        var caller;
        var key;
        if (window.event)
        {
            caller = window.event.srcElement; //Get the event caller in IE.
            key = window.event.keyCode; //Get the keycode in IE.
        }
        else
        {
            caller = event.target; //Get the event caller in Firefox.
            key = event.which; //Get the keycode in Firefox.
        }
        if (key == 13) //Enter key was pressed.
        {
            cTab = caller.tabIndex; //caller tabIndex.
            maxTab = 0; //highest tabIndex (start at 0 to change)
            minTab = cTab; //lowest tabIndex (this may change, but start at caller)
            // allById = document.getElementsByTagName("input"); //Get input elements.
            allById = document.querySelectorAll('input, select'); //Get input elements.
            allByIndex = []; //Storage for elements by index.
            c = 0; //index of the caller in allByIndex (start at 0 to change)
            i = 0; //generic indexer for allByIndex;
            for (id in allById) //Loop through all the input elements by id.
            {
                allByIndex[i] = allById[id]; //Set allByIndex.
                tab = allByIndex[i].tabIndex;
                if (caller == allByIndex[i])
                    c = i; //Get the index of the caller.
                if (tab > maxTab)
                    maxTab = tab; //Get the highest tabIndex on the page.
                if (tab < minTab && tab >= 0)
                    minTab = tab; //Get the lowest positive tabIndex on the page.
                i++;
            }
            //Loop through tab indexes from caller to highest.
            for (tab = cTab; tab <= maxTab; tab++)
            {
                //Look for this tabIndex from the caller to the end of page.
                for (i = c + 1; i < allByIndex.length; i++)
                {
                    if (allByIndex[i].tabIndex == tab)
                    {
                        allByIndex[i].focus(); //Move to that element and stop.
                        return;
                    }
                }
                //Look for the next tabIndex from the start of page to the caller.
                for (i = 0; i < c; i++)
                {
                    if (allByIndex[i].tabIndex == tab + 1)
                    {
                        allByIndex[i].focus(); //Move to that element and stop.
                        return;
                    }
                }
                //Continue searching from the caller for the next tabIndex.
            }

            //The caller was the last element with the highest tabIndex,
            //so find the first element with the lowest tabIndex.
            for (i = 0; i < allByIndex.length; i++)
            {
                if (allByIndex[i].tabIndex == minTab)
                {
                    allByIndex[i].focus(); //Move to that element and stop.
                    return;
                }
            }
        }
    }

    function saveResep() {
      var data = {
          isEdit:$("#isEdit").val(),
          noReg:$("#noReg").val(),
          noResep:$("#noResep").val(),
          kode_gd:$("#kode_gd").val(),
          jam_signa:$("#jam_signa").val(),
          satuan_signa:$("#satuan_signa").val(),
          signa_khusus:$("#signa_khusus").val(),
          poli_id:$("#poli_id").val(),
          dokter:$("#dokter").val(),
          alergi:$("#alergi").val(),
          namaAlergi:$("#namaAlergi").val(),
          bb:$("#bb").val(),
          tb:$("#tb").val(),
          Nama_Pasien:$("#Nama_Pasien").val(),
          Tgl_Lahir:$("#Tgl_Lahir").val(),
          no_RM:$("#no_RM").val(),
          NamaAsuransi:$("#NamaAsuransi").val(),
          satuanBB:$("#satuanBB").val(),
          tglResep:$("#tglResep").val(),
      };

      $.post("{{route('pembuatanObatResepSave')}}",data).done(function(data){
          swal('Berhasil');
          if(data.status=='success'){
            setTimeout(function() {
          	 window.location.href = '{{ route('content2') }}';
           }, 1500);
            // location.reload();
          }else{
            swal('Gagal');
          }
      }).fail(function(data) {
        swal('Gagal');
      });
    }

    function delResepItem() {
      if ($(".delResepItem"). is(":checked")) {
        if ($("#noResep").val()) {
          swal(
            {
              title: "Apa anda yakin menghapus data data Ini?",
              text: "Data data akan dihapus dari sistem dan tidak dapat dikembalikan!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Saya yakin!",
              cancelButtonText: "Batal!",
              closeOnConfirm: false
            },
            function(){
              $.each($(".delResepItem:checked"), function(){
                var data = {
                  No_R:$(this).val(),
                  type:$(this).data('type'),
                  noReg:$("#noReg").val(),
                  noResep:$("#noResep").val()
                };

                $.post("{{route('pembuatanObatResepDelItem')}}",data).done(function(data){
                    if(data.status=='success'){
                      swal('Berhasil');
                      location.reload();
                    }else{
                      swal('Gagal');
                    }
                }).fail(function(data) {
                  swal('Gagal');
                });
              });
            }
          );
        }else {
          swal('Resep belum ada!');
        }
      }else {
        swal('Tidak ada item yang dipilih!');
      }
    }

    function delResep() {
      var retVal = confirm("Anda yakin ingin menghapus data ini?");
       if( retVal == true ) {
         var data = {
             noReg:$("#noReg").val(),
             noResep:$("#noResep").val(),
         };

         $.post("{{route('pembuatanObatResepDel')}}",data).done(function(data){
             if(data.status=='success'){
               swal('Berhasil');
               location.reload();
             }else{
               swal('Gagal');
             }
         }).fail(function(data) {
           swal('Gagal');
         });

          return true;
       } else {
          return false;
       }
    }

    // GET OBAT
    $('input[name=kode_obat]').keyup(function(){
        // $('input[name=no_R]').val('');
        $('input[name=nama_obat]').val('');
        var kode = 'kode_obat';
        var cari = $('input[name=kode_obat]').val();
        if (cari == '') {
          $('#tempat-obat').html('');
        }else {
          var data = {
            cari:cari,
            kode:kode,
          };
          $.post("{{route('get_kode_resep')}}",data,function(data){
            var tag = '';
            if(data.data.length!=0){
              $.each(data.data,function(index,value){
                tag += '<a href="javascript:void(0)" onclick="setObat(\''+value.KodeBrg+'\',\''+value.NamaBrg+'\',\''+value.KodeGd+'\',\''+value.Satuan+'\')">'+value.KodeBrg+'</a><br>';
              });
            }else{
              tag = 'Tidak ditemukan';
            }
            $('#tempat-obat').html(tag);
          });
        }
    });
    $('input[name=nama_obat]').keyup(function(){
        // $('input[name=no_R]').val('');
        $('input[name=kode_obat]').val('');
        var kode = 'nama_obat';
        var cari = $('input[name=nama_obat]').val();
        if (cari == '') {
          $('#tempat-obat').html('');
        }else {
          var data = {
            cari:cari,
            kode:kode,
          };
          $.post("{{route('get_kode_resep')}}",data,function(data){
            var tag = '';
            if(data.data.length!=0){
              $.each(data.data,function(index,value){
                tag += '<a href="javascript:void(0)" onclick="setObat(\''+value.KodeBrg+'\',\''+value.NamaBrg+'\',\''+value.KodeGd+'\',\''+value.Satuan+'\')">'+value.NamaBrg+' <span style="color:#000;">(Stok : '+value.saldo+')</span></a><br>';
              });
            }else{
              tag = 'Tidak ditemukan';
            }
            $('#tempat-obat').html(tag);
          });
        }
    });

    function simpanResep() {
      var data = {
          isEdit:$("#isEdit").val(),
          noReg:$("#noReg").val(),
          noResep:$("#noResep").val(),
          No_R:$("#no_R").val(),
          kode_obat:$("#kode_obat").val(),
          nama_obat:$("#nama_obat").val(),
          jumlah:$("#jumlah").val(),
          satuan:$("#satuan").val(),
          kode_gd:$("#kode_gd").val(),
          jam_signa:$("#jam_signa").val(),
          signa1:$("#signa1").val(),
          signa2:$("#signa2").val(),
          petunjuk_khusus:$("#petunjuk_khusus").val(),
          satuan_signa:$("#satuan_signa").val(),
          signa_khusus:$("#signa_khusus").val(),
          poli_id:$("#poli_id").val(),
          dokter:$("#dokter").val(),
          alergi:$("#alergi").val(),
          namaAlergi:$("#namaAlergi").val(),
          bb:$("#bb").val(),
          tb:$("#tb").val(),
          Nama_Pasien:$("#Nama_Pasien").val(),
          Tgl_Lahir:$("#Tgl_Lahir").val(),
          no_RM:$("#no_RM").val(),
          NamaAsuransi:$("#NamaAsuransi").val(),
          satuanBB:$("#satuanBB").val(),
          tglResep:$("#tglResep").val(),
      };
      $.post("{{route('pembuatanObatSave')}}",data).done(function(data){
          if(data.status=='success'){
            swal('Berhasil');
            location.reload();
          }else{
            swal('Gagal');
          }
      }).fail(function(data) {
        swal('Gagal');
      });

      $('input[name=kode_obat]').val('');
      $('input[name=nama_obat]').val('');
      $('input[name=kode_gd]').val('');
      $('input[name=satuan]').val('');
      $("#no_R").val('')
      $('#tempat-obat').html('');
    }

    function setObat(kode,nama,KodeGd,satuan){
      var data = {
          noReg:$("#noReg").val(),
      };
      $.post("{{ route('get_nor') }}",data).done(function(data){
          if(data.status=='success'){
            $('input[name=no_R]').val(data.No_R);
          }else{
            swal('Gagal');
          }
      }).fail(function(data) {
        swal('Gagal');
      });

        $('input[name=kode_obat]').val(kode);
        $('input[name=nama_obat]').val(nama);
        $('input[name=kode_gd]').val(KodeGd);
        $('input[name=satuan]').val(satuan);

        var spart = satuan.toLowerCase();
        spart = spart.split(" ");
        for ( var i = 0; i < spart.length; i++ )
        {
        	var j = spart[i].charAt(0).toUpperCase();
        	spart[i] = j + spart[i].substr(1);
        }
        spart = spart.join(" ");
        $("#satuan_signa option[value="+spart+"]").attr('selected', 'selected');
        $('#tempat-obat').html('');
        $('#jumlah').focus();
    }
    // END GET OBAT

    function page(i){
        var searchby = $('select[name=searchby]').val();
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var hasil = 'searchby = '+searchby+'\ncariText = '+cariText+'\ncariStatus = '+cariStatus+'\ni = '+i;
        $.post("{!! route('page_ajukan_pertanyaan') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:i}).done(function(data){
            $('#hasilCari').html('');
            $('#hasilCari').html(tampilkan(data.data));
            $('.pagination').html(halaman_page(data.i,data.data));
        });
    }

    function halaman_page(i,data){
        var pageination = '';
        if(i==1){
            pageination+= "<li class='disabled'><a href='#'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+= "<li><a href='#' onclick='page(1)'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='page("+(i-1)+")'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }

        var batas = 4;
        var start = '';
        var end = '';
        var akhir = Math.ceil((data.total.length/10));

        if(i>batas){
            start = parseInt(i)-parseInt(batas);
        }else{
            start = 1;
        }

        if(i<(akhir-batas)){
            end = parseInt(i)+parseInt(batas);
        }else{
            end = akhir;
        }

        var a='';
        for (var j = start; j <= end; j++) {
            if(j==i){
                a = 'class="active"';
            }else{
                a ='';
            }
            pageination+="<li "+a+"><a href='#' onclick='page("+j+")'>"+j+"</a></li>";
        }

        if(i==akhir){
            pageination+="<li class='disabled'><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+="<li><a href='#' onclick='page("+(parseInt(i)+1)+")'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='page("+akhir+")'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }
        return pageination;
        // return alert('batas = '+batas+'\ni = '+i+'\nstart = '+start+'\nAkhir = '+end);
    }

    $('input[name=id]').keyup(function(){
        $('#btnProses').attr('disabled','disabled');
    });

    $('#btnCek').click(function(){
        var rm = $('input[name=id]').val();
        if(rm=='Budiman'){
            $('#btnProses').removeAttr('disabled');
            $('#nama').val('Budiman');
            $('#jk').val('Laki-laki');
            $('#tgl_lahir').val('1994-06-28');
        }else{
            return alert('Data not found');
        }
    });

    $('.lahir').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        // format:'yyyy-mm-dd',
        minView: 2,
        forceParse: 0,
    });

    $('select[name=searchby]').change(function(){
        var searchby = $('select[name=searchby]').val();
        var cariText = '';
        var cariStatus = $('#searchdate').val();
        $('#searchtext').val('');
        if(searchby=='tanggalKunjungan'){
            $('#searchtext').hide();
            $('#searchdate').show();
        }else{
            $('#searchtext').show();
            $('#searchdate').hide();
        }
        $.post("{!! route('page_ajukan_pertanyaan') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('.pagination').html(halaman_page(1,data.data));
            }
        });
    });

    $('input[name=searchdate]').change(function(){
        var searchby = $('select[name=searchby]').val();
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        $.post("{!! route('page_ajukan_pertanyaan') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('.pagination').html(halaman_page(1,data.data));
            }
        });
    });

    $('#searchtext').keyup(function(){
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var by = $('select[name=searchby]').val();
        $.post("{!! route('page_ajukan_pertanyaan') !!}",{cariText:cariText,cariStatus:cariStatus,by:by,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('.pagination').html(halaman_page(1,data.data));
            }
        });
    });

    function tampilkan(data){
        var d = data.data.length;
        var html = '';
        if(d==0){
            html = '<tr>'+
            '<td colspan="8">Data tidak ada</td>'+
            '</tr>';
        }else{
            var i=1;
            $.each( data.data, function( key, value ) {
            var tgl = '';
            var sp = value.tanggalKunjungan;
            var sp_tgltime = sp.split(" ");
            var sp_tgl = sp_tgltime[0].split("-");
            tgl = sp_tgl[2]+'-'+sp_tgl[1]+'-'+sp_tgl[0];
            html += '<tr>'+
            '<td>'+i+'</td>'+
            '<td>'+tgl+' '+sp_tgltime[1]+'</td>'+
            '<td>'+value.no_RM+'</td>'+
            '<td>'+value.Nama_Pasien+'</td>'+
            '<td>'+value.nama_poliRujuk+'</td>'+
            '<td>'+
                '<a href="#" onclick="detailRekapRJ('+value.id_rekapMedik+')" class="btn btn-sm btn-success">Lihat</a>'
            '</td>'+
            '</tr>';
            i++;
            });
        }
        return html;
    }

    function detailRekapRJ(id){
        $.post("{!! route('modalDetRekap') !!}",{id:id}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout').html(data.content);
                $('.modal_layout').show();
                $('#myModal').modal('show');
            }
        });
    }

    function detailRacikanObat(noResep,noR){
        $.post("{!! route('buatEditResepModal') !!}",{noResep:noResep,noR:noR}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout').html(data.content);
                $('.modal_layout').show();
                $('#myModal').modal('show');
            }
        });
    }

    function setValuePetunjuk(value) {
        $('#petunjuk_khusus').val(value);
        $('#list2')[0].selectedIndex = 0;
    }
</script>
@stop
