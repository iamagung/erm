<div class="box box-success">
    <div class="box-heading">
        <div class="col-lg-6 col-md-6">
            <label style="font-weight: bold;font-size: 25px">Laboratorium PK</label>
        </div>
        <div class="col-lg-6 col-md-6">
            <button type="button" onclick="halamanLaborat()" class="btn pull-right" >Kembali</button>
            <button type="button" class="btn pull-right" id="toggle_labpk" data-toggle="collapse" data-target="#form_laborat_pk" aria-controls="form_terapi_wicara">Tampilkan</button>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
    <div class="box-body">
        <div id="form_laborat_pk" class="collapse" style="height:0px">
            <input hidden type="text" name="id_form_laborat_pk" value="">
            <div class="col-lg-12 col-md-12">
                <h4> <strong>Lembar Permintaan Pemeriksaan Laboratorium PK</strong> </h4>
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
                                <input type="checkbox" value="ya" name="hema_led"> LED
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_hdt"> Hapusan Darah Tepi (HDT)
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_bt"> BT (Bleedting Time)
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_ct"> CT (Clotting Time)
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_goldar"> Golongan Darah
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hema_asptulang"> Aspirasi Sumsum Tulang
                            </label>
                        </div>
                    </div>
                    {{-- form hematologi end --}}

                    {{-- form faal hati start --}}
                    <div class="form-group">
                        <h4> <strong>Faal Hati (LFT)</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="lft_bilirtotal"> Bilirubin Total
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="lft_bilirdirect"> Bilirubin Direct
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="lft_sgot"> SGOT
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="lft_sgpt"> SGPT
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="lft_albumin"> Albumin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="lft_totalprotein"> Total Protein
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="lft_globulin"> Globulin
                            </label>
                        </div>
                    </div>
                    {{-- form faal hati end --}}
    
                    {{-- form tumor marker start  --}}
                    <div class="form-group">
                        <h4> <strong>Tumor Marker</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="tm_cea"> CEA
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="tm_psa"> PSA
                            </label>
                        </div>
                    </div>
                    {{-- form tumor marker end  --}}

                    {{-- form tumor marker start  --}}
                    <div class="form-group">
                        <h4> <strong>Torch</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="torch_toxoplasma"> Ig G / Ig M Toxoplasma
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="torch_rubella"> Ig G / Ig M Rubella
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="torch_cmv"> Ig G / Ig M CMV
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="torch_hsv"> Ig G / Ig M HSV
                            </label>
                        </div>
                    </div>
                    {{-- form tumor marker end  --}}
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
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="urine_testnarko"> Test Narkoba
                            </label>
                        </div>
                    </div>
                    {{-- form urine end --}}

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
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="rft_asamurat"> Asam Urat
                            </label>
                        </div>
                    </div>
                    {{-- form faal ginjal end --}}

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

                    {{-- form tiroid start --}}
                    <div class="form-group">
                        <h4> <strong>Tiroid</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="tiroid_t3"> T3
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="tiroid_t4"> T4
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="tiroid_tshs"> TSHs
                            </label>
                        </div>
                    </div>
                    {{-- form tiroid end --}}

                    {{-- form hepatitis start --}}
                    <div class="form-group">
                        <h4> <strong>Hepatitis</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hepat_antihav"> Ig G / Ig M Anti HAV
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hepat_hbsag"> HbsAg
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hepat_hbsab"> HBsAb
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="hepat_anttihvc"> Anti HVC
                            </label>
                        </div>
                    </div>
                    {{-- form hepatitis end --}}
                </div>

                {{-- LEFT RIGHT --}}
                <div class="col-md-4">
                    {{-- form Faeces start --}}
                    <div class="form-group">
                        <h4> <strong>Faeces</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="faeces_lengkap"> Faeces Lengkap
                            </label>
                        </div>
                    </div>
                    {{-- form Faeces end --}}

                    {{-- form Glukosa Darah start --}}
                    <div class="form-group">
                        <h4> <strong>Glukosa Darah</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="glukd_bsn"> BSN
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="glukd_2jpp"> 2 Jam PP
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="glukd_gda"> GDA
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="glukd_hba1c"> HbA 1 c
                            </label>
                        </div>
                    </div>
                    {{-- form Glukosa Darah end --}}

                    {{-- form Profil LIPID start --}}
                    <div class="form-group">
                        <h4> <strong> Profil LIPID </strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="profid_kolesterol"> Kolesterol
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="profid_trigliserida"> Trigliserida
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="profid_ldl"> LDL
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="profid_hdl"> HDL
                            </label>
                        </div>
                    </div>
                    {{-- form Profil LIPID end --}}

                    {{-- form Mikrobiologi start --}}
                    <div class="form-group">
                        <h4> <strong> Mikrobiologi </strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="mikrob_bta"> BTA
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="mikrob_swapv"> Swap Vagina
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="mikrob_prego"> Preparat GO
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="mikrob_btakulit"> BTA Kulit
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="mikrob_jamurkoh"> Jamur KoH
                            </label>
                        </div>
                    </div>
                    {{-- form Mikrobiologi end --}}

                    {{-- form Imunoserologi start --}}
                    <div class="form-group">
                        <h4> <strong> Imunoserologi </strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="imuno_widslide"> Widal Slide
                            </label>
                        </div>
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
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="imuno_antridung"> Ig G / Ig M Anti Dengue
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="imuno_salmonella"> Ig G / Ig M Salmonella
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="imuno_salmontubex"> Ig G / Ig M Samonella Tubex
                            </label>
                        </div>
                    </div>
                    {{-- form Imunoserologi end --}}
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success" style="width:100%"><i class="fa fa-save"></i> <span style="margin-left:10px">Simpan Pemeriksaan Laboratorium PK</span> </button>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
</div>

<script type="text/javascript">

</script>