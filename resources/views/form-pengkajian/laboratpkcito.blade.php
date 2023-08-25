<div class="box box-success">
    <div class="box-heading">
        <div class="col-lg-6 col-md-6">
            <label style="font-weight: bold;font-size: 25px">Laboratorium PK Cito</label>
        </div>
        <div class="col-lg-6 col-md-6">
            <button type="button" class="btn pull-right" id="toggle_labpk_cito" data-toggle="collapse" data-target="#form_laborat_pk_cito" aria-controls="form_laborat_pk_cito">Tampilkan</button>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
    <div class="box-body">
        <div id="form_laborat_pk_cito" class="collapse" style="height:0px">
            <input hidden type="text" name="id_form_laborat_pk_cito" value="">
            <div class="col-lg-12 col-md-12">
                <h4> <strong>Lembar Permintaan Pemeriksaan Laboratorium PK Cito</strong> </h4>
                {{-- LEFT FORM --}}
                <div class="col-md-4">
                    {{-- form hematologi star  --}}
                    <div class="form-group">
                        <h4> <strong>Hematologi</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_darahlengkap"> Darah Lengkap
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_hemoglobin"> Hemoglobin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_eritrosit"> Eritrosit
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_hematrokrit"> Hematrokrit
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_mcvhc"> MCV, MCH, MCHC
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_leukosit"> Leukosit
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_hitungjenis"> Hitung Jenis
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_trombosit"> Trombosit
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_bt"> BT & CT
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_goldar"> Golongan Darah
                            </label>
                        </div>
                    </div>
                    {{-- form hematologi end --}}

                    {{-- form faal ginjal start --}}
                    <div class="form-group">
                        <h4> <strong>Faal Ginjal (RFT)</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="rft_bun"> BUN / Urea
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="rft_kreatinin"> Kreatinin
                            </label>
                        </div>
                    </div>
                    {{-- form faal ginjal end --}}
                </div>

                {{-- LEFT MID --}}
                <div class="col-md-4">
                    {{-- form urine start --}}
                    <div class="form-group">
                        <h4> <strong>Urine</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="urine_lengkap"> Urine Lengkap
                            </label>
                        </div>
                        <label style="margin-left: 30px"> - Albumin</label>
                        <label style="margin-left: 30px"> - Glukosa</label>
                        <label style="margin-left: 30px"> - Bilirubin</label>
                        <label style="margin-left: 30px"> - Urobilin</label>
                        <label style="margin-left: 30px"> - Keton</label>
                        <label style="margin-left: 30px"> - Nitrit</label>
                        <label style="margin-left: 30px"> - Sedimen</label>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="urine_plantest"> Plano Test
                            </label>
                        </div>
                    </div>
                    {{-- form urine end --}}

                    {{-- form elektrolit start --}}
                    <div class="form-group">
                        <h4> <strong>Elektrolit</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="elek_natrium"> Natrium
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="elek_kalium"> Kalium
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="elek_chlorida"> Chlorida
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="elek_analisagas"> Analisa Gas Darah
                            </label>
                        </div>
                    </div>
                    {{-- form elektrolit end --}}
                </div>

                {{-- LEFT RIGHT --}}
                <div class="col-md-4">
                    {{-- form Glukosa Darah start --}}
                    <div class="form-group">
                        <h4> <strong>Glukosa Darah</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="glukd_gda"> GDA
                            </label>
                        </div>
                    </div>
                    {{-- form Glukosa Darah end --}}

                    {{-- form Imunoserologi start --}}
                    <div class="form-group">
                        <h4> <strong> Imunoserologi </strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="imuno_crp"> CRP
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="imuno_troponim1"> Troponim I
                            </label>
                        </div>
                    </div>
                    {{-- form Imunoserologi end --}}

                    {{-- form Lain-lain start --}}
                    <div class="form-group">
                        <h4> <strong> Lain-lain </strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="" name="lain_check1">
                                <input type="text" value="" name="lain_lain1">
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="" name="lain_check2">
                                <input type="text" value="" name="lain_lain2">
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="" name="lain_check3">
                                <input type="text" value="" name="lain_lain3">
                            </label>
                        </div>
                    </div>
                    {{-- form Lain-lain end --}}
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success" style="width:100%"><i class="fa fa-save"></i> <span style="margin-left:10px">Simpan Pemeriksaan Laboratorium PK Cito</span> </button>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
</div>

<script type="text/javascript">

</script>