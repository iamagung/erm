<div class="box box-success">
    <div class="box-heading">
        <div class="col-lg-6 col-md-6">
            <label style="font-weight: bold;font-size: 25px">IV. Terapi Wicara</label>
        </div>
        <div class="col-lg-6 col-md-6">
            <button type="button" class="btn pull-right" id="toggle_terapi" data-toggle="collapse" data-target="#form_terapi_wicara">Tampilkan</button>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
    <div class="box-body">
        <div id="form_terapi_wicara" class="collapse" style="height:0px">
            <input hidden type="text" name="id_form_terapi_wicara" value="">
            <div class="col-lg-12 col-md-12">
                <h4> <strong>Pemeriksaan</strong> </h4>
                
                {{-- LEFT FORM --}}
                <div class="col-md-6">
                    <div class="form-group">
                        {{-- FORM ORGAN ORAL MOTOR --}}
                        <h4> <strong><u>Organ Oral Motor</u></strong> </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Rahang</label>
                            <div class="col-md-10">
                                <input type="text" name="organ_rahang" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bibir</label>
                            <div class="col-md-10">
                                <input type="text" name="organ_bibir" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Lidah</label>
                            <div class="col-md-10">
                                <input type="text" name="organ_lidah" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Gigi</label>
                            <div class="col-md-10">
                                <input type="text" name="organ_gigi" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Palatum</label>
                            <div class="col-md-10">
                                <input type="text" name="organ_palatum" class="form-control">
                            </div>
                        </div>
                        {{-- END OF FORM ORGAN ORAL MOTOR --}}

                        {{-- FORM BAHASA --}}
                        <h4> <strong><u>BAHASA</u></strong> </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Reseptif</label>
                            <div class="col-md-10">
                                <input type="text" name="bahasa_reseptif" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Expresif</label>
                            <div class="col-md-10">
                                <input type="text" name="bahasa_expresif" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nonverbal</label>
                            <div class="col-md-10">
                                <input type="text" name="bahasa_nonverbal" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Menulis</label>
                            <div class="col-md-10">
                                <input type="text" name="bahasa_menulis" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Membaca</label>
                            <div class="col-md-10">
                                <input type="text" name="bahasa_membaca" class="form-control">
                            </div>
                        </div>
                        {{-- END OF FORM BAHASA --}}

                        {{-- FORM BICARA --}}
                        <h4> <strong> <u>BICARA</u> </strong> </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Reseptif</label>
                            <div class="col-md-10">
                                <input type="text" name="bicara_reseptif" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Expresif</label>
                            <div class="col-md-10">
                                <input type="text" name="bicara_expresif" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nonverbal</label>
                            <div class="col-md-10">
                                <input type="text" name="bicara_nonverbal" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Menulis</label>
                            <div class="col-md-10">
                                <input type="text" name="bicara_menulis" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Membaca</label>
                            <div class="col-md-10">
                                <input type="text" name="bicara_membaca" class="form-control">
                            </div>
                        </div>
                        {{-- END OF FORM BICARA --}}

                        {{-- FORM SUARA --}}
                        <h4> <strong> <u>SUARA</u> </strong> </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Loudness</label>
                            <div class="col-md-10">
                                <input type="text" name="suara_loudness" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Quality</label>
                            <div class="col-md-10">
                                <input type="text" name="suara_quality" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pitch</label>
                            <div class="col-md-10">
                                <input type="text" name="suara_pitch" class="form-control">
                            </div>
                        </div>
                        {{-- END OF FORM SUARA --}}

                        {{-- FORM FEEDING --}}
                        <h4> <strong> <u>FEEDING</u> </strong> </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Menggigit</label>
                            <div class="col-md-10">
                                <input type="text" name="feeding_menggigit" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Mengunyah</label>
                            <div class="col-md-10">
                                <input type="text" name="feeding_mengunyah" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Menelan</label>
                            <div class="col-md-10">
                                <input type="text" name="feeding_menelan" class="form-control">
                            </div>
                        </div>
                        {{-- END OF FORM FEEDING --}}
                    </div>
                </div>
                {{-- RIGHT FORM --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <h4> <strong>Catatan Medis</strong> </h4>
                        <div class="form-group col-lg-12">
                            <textarea name="catatan_medis_terapi_wicara" id="catatan_medis_terapi_wicara" cols="30" rows="11" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4> <strong>Diagnosa Terapi Wicara</strong> </h4>
                        <div class="form-group col-lg-12">
                            <textarea name="diagnosa_terapi_wicara" id="diagnosa_terapi_wicara" cols="30" rows="11" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                {{-- FORM BAWAH --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pmx_khusus_terapi_wicara"><h4><strong>PMX Khusus</strong></h4></label>
                        <input type="text" id="pmx_khusus_terapi_wicara" name="pmx_khusus_terapi_wicara" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pemeriksaan_terapi_wicara"><h4><strong>Pemeriksaan</strong></h4></label>
                        <input type="text" id="pemeriksaan_terapi_wicara" name="pemeriksaan_terapi_wicara" class="form-control">
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //form primary (untuk validasi required all)
    let form_terapi_wicara = {!! json_encode($form_terapi_wicara) !!};
    let data_terapi_wicara = {!! json_encode($data_terapi_wicara) !!};

    $(document).ready(function () {
        //validasi jika data sudah ada
        $.each(data_terapi_wicara, function (key, v) { 
             if( v != null && v != ""){
                 if( key == "catatan_medis_terapi_wicara" || key == "diagnosa_terapi_wicara" ){
                    //untuk textarea
                    $("textarea[name='"+key+"']").val(v);
                }else{
                    //untuk input
                    $("input[name='"+key+"']").val(v);
                }
             }
        });
    });
</script>