<div class="box box-success">
    <div class="box-heading">
        <div class="col-lg-6 col-md-6">
            <label style="font-weight: bold;font-size: 25px">II. Fisioterapi</label>
        </div>
        <div class="col-lg-6 col-md-6">
            <button type="button" class="btn pull-right" id="toggle_fisioterapi" data-toggle="collapse" data-target="#form_fisioterapi">Tampilkan</button>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
    <div class="box-body">
        <div id="form_fisioterapi" class="collapse" style="height:0px">
            <input hidden type="text" name="id_form_fisioterapi" value="">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="diagnosa_medis_fisio"><h4><strong>Diagnosa Medis</strong></h4></label>
                        <input type="text" id="diagnosa_medis_fisio" name="diagnosa_medis_fisio" class="form-control">
                    </div>
                </div>
                <h4><strong>ANAMNESA FISIOTERAPI (Autoanamnesis/Heteroanamnesis)*</strong></h4>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="keluhan_fisio"><h4><strong>Keluhan Utama</strong></h4></label>
                        <input type="text" id="keluhan_fisio" name="keluhan_fisio" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="riwayat_sekarang_fisio"><h4><strong>Riwayat Penyakit Sekarang</strong></h4></label>
                        <input type="text" id="riwayat_sekarang_fisio" name="riwayat_sekarang_fisio" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="riwayat_dahulu_fisio"><h4><strong>Riwayat Penyakit Dahulu & Penyerta</strong></h4></label>
                        <input type="text" id="riwayat_dahulu_fisio" name="riwayat_dahulu_fisio" class="form-control">
                    </div>
                </div>
                <h4><strong>PEMERIKSAAN FISIK </strong></h4>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="inspeksi_fisio"><h4><strong>Inspeksi</strong></h4></label>
                        <input type="text" id="inspeksi_fisio" name="inspeksi_fisio" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="palpasi_fisio"><h4><strong>Palpasi</strong></h4></label>
                        <input type="text" id="palpasi_fisio" name="palpasi_fisio" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="auskultasi_fisio"><h4><strong>Auskultasi/Perkusi</strong></h4></label>
                        <input type="text" id="auskultasi_fisio" name="auskultasi_fisio" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pemeriksaan_khusus_fisio"><h4><strong>PEMERIKSAAN KHUSUS(LGS/MMT/ANTROPOMETRI/TES REFLEK)*</strong></h4></label>
                        <textarea id="pemeriksaan_khusus_fisio" name="pemeriksaan_khusus_fisio" class="form-control"></textarea>
                    </div>
                </div>
                <h4><strong>DIAGNOSA FISIOTERAPI</strong></h4>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="impaiment_fisio"><h4><strong>Impaiment</strong></h4></label>
                        <input type="text" id="impaiment_fisio" name="impaiment_fisio" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="functional_limitation_fisio"><h4><strong>Functional Limitation</strong></h4></label>
                        <input type="text" id="functional_limitation_fisio" name="functional_limitation_fisio" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="disability_fisio"><h4><strong>Disability</strong></h4></label>
                        <input type="text" id="disability_fisio" name="disability_fisio" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rencana_intervensi_fisio"><h4><strong>RENCANA INTERVENSI FISIOTERAPI</strong></h4></label>
                        <textarea id="rencana_intervensi_fisio" name="rencana_intervensi_fisio" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="evaluasi_fisio"><h4><strong>EVALUASI</strong></h4></label>
                        <textarea id="evaluasi_fisio" name="evaluasi_fisio" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //form primary (untuk validasi required all)
    let form_fisioterapi = {!! json_encode($form_fisioterapi) !!};
    let data_fisioterapi = {!! json_encode($data_fisioterapi) !!};

    $(document).ready(function () {
        //validasi jika data sudah ada
        $.each(data_fisioterapi, function (key, v) { 
             if(v != null && v != ""){
                 if(key == "rencana_intervensi_fisio" || key == "evaluasi_fisio" || key == "pemeriksaan_khusus_fisio"){
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