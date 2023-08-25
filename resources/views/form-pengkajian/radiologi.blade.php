<div class="box box-success">
    <div class="box-heading">
        <div class="col-lg-6 col-md-6">
            <label style="font-weight: bold;font-size: 25px">Radiologi</label>
        </div>
        <div class="col-lg-6 col-md-6">
            <button type="button" onclick="halamanRadiologi()" class="btn pull-right" >Kembali</button>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
    <div class="box-body">
        <div id="form_terapi_wicara" class="collapse show" style="height:0px">
            <input hidden type="text" name="id_form_terapi_wicara" value="">
            <div class="col-lg-12 col-md-12">
                <h4> <strong>Pemeriksaan Yang Diminta Harap Dicentang (&#10003)</strong> </h4>
                {{-- LEFT FORM --}}
                <div class="col-md-4">
                    {{-- form kepala star  --}}
                    <div class="form-group">
                        <h4> <strong>Kepala</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kepala_sap"> Skull AP
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kepala_sla"> Skull Lateral
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kepala_water"> Waters
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kepala_osn"> Os. Nasal
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kepala_tcm"> TMJ Close Mouth
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kepala_tom"> TMJ Open Mouth
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kepala_eisler"> Eisler
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kepala_lainnya">
                                <input type="text" name="kepala_lainnya" class="form-control-sm">
                            </label>
                        </div>
                    </div>
                    {{-- form kepala end --}}

                    {{-- form vertebrae start --}}
                    <div class="form-group">
                        <h4> <strong>Vertebrae</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="vert_cervap"> Cervical AP/Lat
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="vert_cervob"> Cervical Obl D-S
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="vert_thorap"> Thoracal AP/Lat
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="vert_thorbed"> Thoracal Bending D-S
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="vert_lumbap"> Lumbosacral AP/Lat
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="vert_lainnya">
                                <input type="text" name="vert_lainnya" class="form-control-sm">
                            </label>
                        </div>
                    </div>
                    {{-- form vertebrae end --}}
    
                    {{-- form dada start  --}}
                    <div class="form-group">
                        <h4> <strong>Dada</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="dada_thorap"> Thorax AP/PA
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="dada_thorlat"> Thorax Lat
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="dada_topl"> Top Lordotic
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="dada_lainnya">
                                <input type="text" name="dada_lainnya" class="form-control-sm">
                            </label>
                        </div>
                    </div>
                    {{-- form dada end  --}}
                </div>

                {{-- LEFT MID --}}
                <div class="col-md-4">
                    {{-- form extremitas start --}}
                    <div class="form-group">
                        <h4> <strong>Extremitas</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_manusdex"> Manus Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_wristdex"> Wrist Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_antebrachiidex"> Antebrachii Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_elbowdex"> Elbow Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_humerusdex"> Humerus Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_shoulderdex"> Shoulder Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_shoulderend"> Shoulder Endo-Exo
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_claviculadex"> Clavicula Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_pelvicap"> Pelvic AP
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_coxaeap"> Coxae AP
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_femurdex"> Femur Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_genudex"> Genu Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_crusisdex"> Crusis Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_ankledex"> Ankle Dex/Sin
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ext_lainnya">
                                <input type="text" name="ext_lainnya" class="form-control-sm">
                            </label>
                        </div>
                    </div>
                    {{-- form extremitas end --}}

                    {{-- form kontras start --}}
                    <div class="form-group">
                        <h4> <strong>Kontras</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kont_ivp"> IVP
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kont_coil"> Colon in Loop
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kont_uretro"> Uretrografi
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="kont_lainnya">
                                <input type="text" name="kont_lainnya" class="form-control-sm">
                            </label>
                        </div>
                    </div>
                    {{-- form kontras end --}}
                </div>
                {{-- LEFT RIGHT --}}
                <div class="col-md-4">
                    {{-- form abdoment start --}}
                    <div class="form-group">
                        <h4> <strong>Abdoment</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="abd_bof"> BOF
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="abd_lld"> LLD
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="abd_lainnya">
                                <input type="text" name="abd_lainnya" class="form-control-sm">
                            </label>
                        </div>
                    </div>
                    {{-- form abdoment end --}}

                    {{-- form ultrasonografi start --}}
                    <div class="form-group">
                        <h4> <strong>Ultrasonografi</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ult_abdup"> Abdoment Upper
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ult_abdlow"> Abdoment Lower
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ult_urol"> Urologi
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ult_mammae"> Mammae
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ult_echocar"> Echocardiografi
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="ult_lainnya">
                                <input type="text" name="ult_lainnya" class="form-control-sm">
                            </label>
                        </div>
                    </div>
                    {{-- form ultrasonografi end --}}

                    {{-- form ct-scan start --}}
                    <div class="form-group">
                        <h4> <strong>CT Scan (MSCT 128)</strong> </h4>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_head"> Head
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_nasopharinx"> Nasopharinkx
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_abdomen"> Abdomen
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_paru"> Paru
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_jantung"> Jantung
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_vertebra"> Vertebra
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_extremitas"> Extremitas
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_ctang"> CT Angio
                            </label>
                        </div>
                        <div class="form-inline">
                            <label style="margin-left: 10px">
                                <input type="checkbox" value="ya" name="cts_lainnya">
                                <input type="text" name="cts_lainnya" class="form-control-sm">
                            </label>
                        </div>
                    </div>
                    {{-- form ct-scan end --}}
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success" style="width:100%"><i class="fa fa-save"></i> <span style="margin-left:10px">Simpan Pemeriksaan Radiologi</span> </button>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
</div>

<script type="text/javascript">

</script>