<div class="box box-success">
    <div class="box-heading">
        <div class="col-lg-6 col-md-6">
            <label style="font-weight: bold;font-size: 25px">V. Orthotik</label>
        </div>
        <div class="col-lg-6 col-md-6">
            <button type="button" class="btn pull-right" id="toggle_orthotik" data-toggle="collapse" data-target="#form_orthotik">Tampilkan</button>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
    <div class="box-body">
        <div id="form_orthotik" class="collapse" style="height:0px">
            <div class="col-lg-12 col-md-12">
                <input hidden type="text" name="id_form_orthotik" value="">

                {{-- FORM KEKUATAN OTOT BAGIAN KIRI --}}
                <div class="col-md-12">
                    <h4 style="margin-left:15px"> <u><strong>Kekuatan Otot</strong></u> </h4>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Dorsiflexors</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="dorsiflexors" value="1"> 1</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="dorsiflexors" value="2"> 2</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="dorsiflexors" value="3"> 3</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="dorsiflexors" value="4"> 4</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="dorsiflexors" value="5"> 5</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Plantarflexors</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="plantarflexors" value="1"> 1</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="plantarflexors" value="2"> 2</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="plantarflexors" value="3"> 3</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="plantarflexors" value="4"> 4</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="plantarflexors" value="5"> 5</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">KneeExtensors</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeextensors" value="1"> 1</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeextensors" value="2"> 2</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeextensors" value="3"> 3</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeextensors" value="4"> 4</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeextensors" value="5"> 5</label>
                        </div>
                    </div>
                    {{-- FORM KEKUATAN OTOT BAGIAN KANAN --}}
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Kneeflexors</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeflexors" value="1"> 1</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeflexors" value="2"> 2</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeflexors" value="3"> 3</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeflexors" value="4"> 4</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="kneeflexors" value="5"> 5</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">HipExtensors</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipextensors" value="1"> 1</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipextensors" value="2"> 2</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipextensors" value="3"> 3</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipextensors" value="4"> 4</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipextensors" value="5"> 5</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Hipflexors</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipflexors" value="1"> 1</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipflexors" value="2"> 2</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipflexors" value="3"> 3</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipflexors" value="4"> 4</label>
                            <label class="col-sm-1 col-form-label"> <input type="radio" name="hipflexors" value="5"> 5</label>
                        </div>
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 10px"></div>
                {{-- FORM LGS --}}
                <div class="col-md-12">
                    <div class="col-md-4">
                        <h4> <u><strong>LGS</strong></u> </h4>
                        <label class="col-form-label">Hip Flexors (120)</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Hip Extensors (30)</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Knee Flexors (130)</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Knee Extensors (1-10)</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Ankle Dorsi Flexors (30)</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Ankle Plantar Flexors (45)</label><br>
                    </div>
                    <div class="col-md-2">
                        <h4> <strong>Kiri</strong> </h4>
                        <input type="text" name="hipflexors_kk[]" class="form-control">
                        <input type="text" name="hipextensors_kk[]" class="form-control">
                        <input type="text" name="kneeflexors_kk[]" class="form-control">
                        <input type="text" name="kneeextensors_kk[]" class="form-control">
                        <input type="text" name="ankledorsiflexors_kk[]" class="form-control">
                        <input type="text" name="ankleplantarflexors_kk[]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <h4> <strong>Kanan</strong> </h4>
                        <input type="text" name="hipflexors_kk[]" class="form-control">
                        <input type="text" name="hipextensors_kk[]" class="form-control">
                        <input type="text" name="kneeflexors_kk[]" class="form-control">
                        <input type="text" name="kneeextensors_kk[]" class="form-control">
                        <input type="text" name="ankledorsiflexors_kk[]" class="form-control">
                        <input type="text" name="ankleplantarflexors_kk[]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <h4> <strong>Kiri</strong> </h4>
                        <input type="text" name="hipflexors_kk[]" class="form-control">
                        <input type="text" name="hipextensors_kk[]" class="form-control">
                        <input type="text" name="kneeflexors_kk[]" class="form-control">
                        <input type="text" name="kneeextensors_kk[]" class="form-control">
                        <input type="text" name="ankledorsiflexors_kk[]" class="form-control">
                        <input type="text" name="ankleplantarflexors_kk[]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <h4> <strong>Kanan</strong> </h4>
                        <input type="text" name="hipflexors_kk[]" class="form-control">
                        <input type="text" name="hipextensors_kk[]" class="form-control">
                        <input type="text" name="kneeflexors_kk[]" class="form-control">
                        <input type="text" name="kneeextensors_kk[]" class="form-control">
                        <input type="text" name="ankledorsiflexors_kk[]" class="form-control">
                        <input type="text" name="ankleplantarflexors_kk[]" class="form-control">
                    </div>
                </div>
                {{-- END OF FORM LGS --}}

                <div class="clearfix" style="margin-bottom: 10px"></div>
                {{-- FORM ALIGMENT TULANG --}}
                <div class="col-md-12">
                    <div class="col-md-4">
                        <h4> <u><strong>ALIGNMENT TULANG</strong></u> </h4>
                        <label class="col-form-label">Femur</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Tibia</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Patella Alta</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Pes Varus</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Plano Valgus</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Forefoot Adductus</label><br>
                    </div>
                    <div class="col-md-2">
                        <h4> <strong>Kiri</strong> </h4>
                        <input type="text" name="femur[]" class="form-control">
                        <input type="text" name="tibia[]" class="form-control">
                        <input type="text" name="patella_alta[]" class="form-control">
                        <input type="text" name="pes_varus[]" class="form-control">
                        <input type="text" name="plano_valgus[]" class="form-control">
                        <input type="text" name="forefoot_adductus[]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <h4> <strong>Kanan</strong> </h4>
                        <input type="text" name="femur[]" class="form-control">
                        <input type="text" name="tibia[]" class="form-control">
                        <input type="text" name="patella_alta[]" class="form-control">
                        <input type="text" name="pes_varus[]" class="form-control">
                        <input type="text" name="plano_valgus[]" class="form-control">
                        <input type="text" name="forefoot_adductus[]" class="form-control">
                    </div>
                </div>
                {{-- END OF FORM ALIGNMENT TULANG --}}

                {{-- FORM INFORMASI AMPUTASI --}}
                <div class="col-md-12">
                    <h4 style="margin-left: 15px"> <u><strong>INFORMASI AMPUTASI</strong></u> </h4>
                    <div class="col-md-4">
                        <label class="col-form-label">Sisi Lokasi Amputasi</label><br>
                        <div class="clearfix" style="margin-bottom: 13px"></div>
                        <label class="col-form-label">Lokasi Amputasi</label><br>
                        <div class="clearfix" style="margin-bottom: 13px"></div>
                        <label class="col-form-label">Level Amputasi</label><br>
                        <div class="clearfix" style="margin-bottom: 20px"></div>
                        <label class="col-form-label">Data Amputasi</label><br>
                        <div class="clearfix" style="margin-bottom: 20px"></div>
                        <label class="col-form-label">Penyebab Amputasi</label><br>
                        <div class="clearfix" style="margin-bottom: 20px"></div>
                        <label class="col-form-label">Kondisi Lingkungan</label><br>
                        <div class="clearfix" style="margin-bottom: 13px"></div>
                        <label class="col-form-label">Riwayat Medis</label><br>
                        <div class="clearfix" style="margin-bottom: 13px"></div>
                        <label class="col-form-label">Kondisi Medis Lain</label><br>
                        <div class="clearfix" style="margin-bottom: 13px"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-inline">
                            <label><input type="radio" name="sisi_lokasi_amputasi" value="Sisi Kiri">Sisi Kiri</label>
                            <label><input type="radio" name="sisi_lokasi_amputasi" value="Sisi Kanan" style="margin-left: 20px">Sisi Kanan</label>
                        </div>
                        <div class="clearfix" style="margin-bottom: 13px"></div>
                        <div class="form-inline">
                            <label><input type="radio" name="lokasi_amputasi" value="Bawah Lutut">Bawah Lutut</label>
                            <label><input type="radio" name="lokasi_amputasi" value="Atas Lutut" style="margin-left: 20px">Atas Lutut</label>
                            <label><input type="radio" name="lokasi_amputasi" value="Bawah Siku" style="margin-left: 20px">Bawah Siku</label>
                            <label><input type="radio" name="lokasi_amputasi" value="Atas Siku" style="margin-left: 20px">Atas Siku</label>
                        </div>
                        <div class="clearfix" style="margin-bottom: 13px"></div>
                        <div class="form-inline">
                            <label><input type="radio" name="level_amputasi" value="Short">Short</label>
                            <label><input type="radio" name="level_amputasi" value="Medium" style="margin-left: 20px">Medium</label>
                            <label><input type="radio" name="level_amputasi" value="Long" style="margin-left: 20px">Long</label>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="data_amputasi">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="penyebab_amputasi">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="kondisi_lingkungan">
                        </div>
                        <div class="form-inline">
                            <label><input type="radio" name="amputasi_riwayat_medis" value="Diabetes">Diabetes</label>
                            <label><input type="radio" name="amputasi_riwayat_medis" value="Trauma" style="margin-left: 20px">Trauma</label>
                            <label><input type="radio" name="amputasi_riwayat_medis" value="Infeksi" style="margin-left: 20px">Infeksi</label>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="kondisi_medis_lain">
                        </div>
                    </div>
                </div>
                {{-- END OF FORM INFORMASI AMPUTASI --}}
                
                {{-- FORM INFORMASI PROTHESIS --}}
                <div class="col-md-12">
                    <h4 style="margin-left:15px"> <u><strong>INFROMASI PROTHESIS & ORTHOSIS</strong></u> </h4>
                    <div class="col-md-4">
                        <label class="col-form-label">Prothesis</label><br>
                        <div class="clearfix" style="margin-bottom: 20px"></div>
                        <label class="col-form-label">Suspensi</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Tipe</label><br>
                        {{-- <div class="clearfix" style="margin-bottom: 11px"></div> --}}
                        <label class="col-form-label">Foot</label><br>
                        {{-- <div class="clearfix" style="margin-bottom: 11px"></div> --}}
                        <label class="col-form-label">Glove</label><br>
                        <div class="clearfix" style="margin-bottom: 11px"></div>
                        <label class="col-form-label">Othosis</label><br>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="prothesis">
                        <div class="clearfix" style="margin-bottom: 10px"></div>
                        <input class="form-control" type="text" name="suspensi">
                        <div class="form-inline">
                            <label><input type="radio" name="tipe" value="Endoskeletal">Endoskeletal</label>
                            <label><input type="radio" name="tipe" value="Eksoskeletal" style="margin-left: 20px">Eksoskeletal</label>
                        </div>
                        <div class="form-inline">
                            <label><input type="radio" name="foot" value="Sach Foot">Sach Foot</label>
                            <label><input type="radio" name="foot" value="Single Axis" style="margin-left: 20px">Single Axis</label>
                            <label><input type="radio" name="foot" value="Multi Axis" style="margin-left: 20px">Multi Axis</label>
                        </div>
                        <div class="form-inline">
                            <label><input type="radio" name="glove" value="Karet">Karet</label>
                            <label><input type="radio" name="glove" value="Kayu" style="margin-left: 20px">Kayu</label>
                        </div>
                        <input class="form-control" type="text" name="othosis">
                    </div>
                </div>
                {{-- END OF FORM INFORMASI PROTHESIS --}}

            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //form primary (untuk validasi required all)
    let form_orthotik = {!! json_encode($form_orthotik) !!};
    let data_orthotik = {!! json_encode($data_orthotik) !!};

    $(document).ready(function () {
        //validasi jika data sudah ada
        $.each(data_orthotik, function (key, v) {
             if( v != null && v != "" ){
                let value = v;
                if(typeof v == "string"){
                    if( value.includes("-") ){
                        let isiArray = value.split("-");
                        if( isiArray.length == 4 ){
                            $("input[name='"+key+"[]']").eq(0).val(isiArray[0]);
                            $("input[name='"+key+"[]']").eq(1).val(isiArray[1]);
                            $("input[name='"+key+"[]']").eq(2).val(isiArray[2]);
                            $("input[name='"+key+"[]']").eq(3).val(isiArray[3]);
                        }else{
                            $("input[name='"+key+"[]']").eq(0).val(isiArray[0]);
                            $("input[name='"+key+"[]']").eq(1).val(isiArray[1]);
                        }
                    }else{
                        $("input[name='"+key+"']").val(v);
                        $("input[name='"+key+"'][type='radio'][value='"+v+"']").prop('checked',true);
                    }
                }else{
                    $("input[name='"+key+"']").val(v);
                }
             }
        });
    });
</script>