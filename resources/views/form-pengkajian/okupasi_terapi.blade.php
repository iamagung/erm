
<div class="box box-success">
    <div class="box-heading">
        <div class="col-lg-6 col-md-6">
            <label style="font-weight: bold;font-size: 25px">III. Okupasi Terapi</label>
        </div>
        <div class="col-lg-6 col-md-6">
            <button type="button" class="btn pull-right" id="toggle_okupasi" data-toggle="collapse" data-target="#form_okupasi_terapi" aria-controls="form_okupasi_terapi">Tampilkan</button>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
    <div class="box-body">
        <div id="form_okupasi_terapi" class="collapse">
            <input hidden type="text" name="id_form_okupasi_terapi" value="">
            <div class="col-lg-12 col-md-12">
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <h4> <strong>I. Pengumpulan Data Riwayat Penyakit</strong> </h4>
                <div class="form-group col-lg-6">
                    <label for="informatif_subyektif">Informatif Subyektif (S)</label>
                    <input type="text" name="informatif_subyektif" class="form-control">
                </div>
                <div class="form-group col-lg-6">
                    <label for="informatif_obyektif">Informatif Obyektif (O)</label>
                    <input type="text" name="informatif_obyektif" class="form-control ">
                </div>
    
                <div class="clearfix" style="margin-bottom: 10px"></div>
                <h4> <strong>II. Pengkajian / Asesmen OT</strong> </h4>
    
                {{-- TAG A PARENT --}}
                <h5 style="margin-left:20px;"> <strong>Occupational Performance Component</strong> </h5>
                {{-- TAG A --}}
                <h5 style="margin-left:40px;"> <strong>A. Komponen Sensomotorik</strong> </h5>
                <h5 style="margin-left:70px;"> <strong>1. Sensori</strong> </h5>
                <div style="margin-left:80px;" class="form-inline">
                    <div class="col-md-4">
                        <label>a. Kesadaran Sensori</label>
                    </div>
                    <label style="margin-left: 10px">
                        <input type="radio" value="tidak" checked name="kesadaran_sensori" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="kesadaran_sensori" class="form-control"> Ada
                    </label>
                    <input type="text" name="kesadaran_sensori_input" class="form-control" style="margin-left: 10px">
                </div>
                <div style="margin-left:80px;" class="form-inline">
                    <div class="col-md-4">
                        <label>b. Proses Sensori</label>
                    </div>
                    <label style="margin-left: 10px">
                        <input type="radio" value="tidak" checked name="proses_sensori" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="proses_sensori" class="form-control"> Ada
                    </label>
                    <input type="text" name="proses_sensori_input" class="form-control" style="margin-left: 10px">
                </div>
                <div style="margin-left:80px;" class="form-inline">
                    <div class="col-md-4">
                        <label>c. Persepsi</label>
                    </div>
                    <label style="margin-left: 10px">
                        <input type="radio" value="tidak" checked name="persepsi" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="persepsi" class="form-control"> Ada
                    </label>
                    <input type="text" name="persepsi_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>2. Neuromuskular</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="neuromuskular" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="neuromuskular" class="form-control"> Ada
                    </label>
                    <input type="text" name="neuromuskular_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>3. Motorik</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="motorik" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="motorik" class="form-control"> Ada
                    </label>
                    <input type="text" name="motorik_input" class="form-control" style="margin-left: 10px">
                </div>
                {{-- END OF TAG A --}}
    
                {{-- TAG B --}}
                <h5 style="margin-left:40px;"> <strong>B. Komponen Kognitif dan Integrasi Kognitif</strong> </h5>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>1. Level Arousai/Motivasi</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="levelarousai" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="levelarousai" class="form-control"> Ada
                    </label>
                    <input type="text" name="levelarousai_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>2. Orientasi (Waktu,Orang,Tempat)</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="orientasi" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="orientasi" class="form-control"> Ada
                    </label>
                    <input type="text" name="orientasi_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>3. Recognition (Pemahaman)</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="recognition" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="recognition" class="form-control"> Ada
                    </label>
                    <input type="text" name="recognition_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>4. Rentang Atensi (Attention Span)</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="rentang_atensi" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="rentang_atensi" class="form-control"> Ada
                    </label>
                    <input type="text" name="rentang_atensi_input" class="form-control" style="margin-left: 10px">
                </div>
                <h5 style="margin-left:70px;"> <strong>5. Memori</strong> </h5>
                <div style="margin-left:80px;" class="form-inline">
                    <div class="col-md-4">
                        <label>a. Jangka Pendek (Short - Term)</label>
                    </div>
                    <label style="margin-left: 10px">
                        <input type="radio" value="tidak" checked name="memori_jangka_pendek" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="memori_jangka_pendek" class="form-control"> Ada
                    </label>
                    <input type="text" name="memori_jangka_pendek_input" class="form-control" style="margin-left: 10px">
                </div>
                <div style="margin-left:80px;" class="form-inline">
                    <div class="col-md-4">
                        <label>b. Jangka Panjang (Long - Term)</label>
                    </div>
                    <label style="margin-left: 10px">
                        <input type="radio" value="tidak" checked name="memori_jangka_panjang" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="memori_jangka_panjang" class="form-control"> Ada
                    </label>
                    <input type="text" name="memori_jangka_panjang_input" class="form-control" style="margin-left: 10px">
                </div>
                <div style="margin-left:80px;" class="form-inline">
                    <div class="col-md-4">
                        <label>c. Remote</label>
                    </div>
                    <label style="margin-left: 10px">
                        <input type="radio" value="tidak" checked name="memori_remote" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="memori_remote" class="form-control"> Ada
                    </label>
                    <input type="text" name="memori_remote_input" class="form-control" style="margin-left: 10px">
                </div>
                <div style="margin-left:80px;" class="form-inline">
                    <div class="col-md-4">
                        <label>d. Recent</label>
                    </div>
                    <label style="margin-left: 10px">
                        <input type="radio" value="tidak" checked name="memori_recent" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="memori_recent" class="form-control"> Ada
                    </label>
                    <input type="text" name="memori_recent_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>6. Sequencing (Mengurutkan)</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="sequencing" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="sequencing" class="form-control"> Ada
                    </label>
                    <input type="text" name="sequencing_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>7. Kategorisasi</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="kategorisasi" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="kategorisasi" class="form-control"> Ada
                    </label>
                    <input type="text" name="kategorisasi_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>8. Formasi Konsep</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="formasi_konsep" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="formasi_konsep" class="form-control"> Ada
                    </label>
                    <input type="text" name="formasi_konsep_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>9. Mengelola Waktu</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="mengelola_waktu" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="mengelola_waktu" class="form-control"> Ada
                    </label>
                    <input type="text" name="mengelola_waktu_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>10. Pemecahan Masalah</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="pemecahan_masalah" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="pemecahan_masalah" class="form-control"> Ada
                    </label>
                    <input type="text" name="pemecahan_masalah_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>11. Generalization of Learning</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="generalization" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="generalization" class="form-control"> Ada
                    </label>
                    <input type="text" name="generalization_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>12. Integration of Learning</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="integration" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="integration" class="form-control"> Ada
                    </label>
                    <input type="text" name="integration_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>13. Synthesis of Learning</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="synthesis" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="synthesis" class="form-control"> Ada
                    </label>
                    <input type="text" name="synthesis_input" class="form-control" style="margin-left: 10px">
                </div>
                {{-- END OF TAG B --}}
    
                {{-- TAG C --}}
                <h5 style="margin-left:40px;"> <strong>C. Keterampilan Psikososial</strong> </h5>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>1. Psikologis</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="psikologis" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="psikologis" class="form-control"> Ada
                    </label>
                    <input type="text" name="psikologis_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>2. Sosial</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="sosial" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="sosial" class="form-control"> Ada
                    </label>
                    <input type="text" name="sosial_input" class="form-control" style="margin-left: 10px">
                </div>
                {{-- END OF TAG C --}}
                {{-- END OF TAG A PARENT --}}
    
                {{-- TAG B PARENT --}}
                <h5 style="margin-left:20px;"> <strong>Occupational Performance Are</strong> </h5>
                
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>1. Aktivitas Kehidupan Sehari-hari (AKS)</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="aktivitas_kehidupan" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="aktivitas_kehidupan" class="form-control"> Ada
                    </label>
                    <input type="text" name="aktivitas_kehidupan_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>2. Produktivitas</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="produktivitas" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="produktivitas" class="form-control"> Ada
                    </label>
                    <input type="text" name="produktivitas_input" class="form-control" style="margin-left: 10px">
                </div>
                <div class="form-inline">
                    <div class="col-md-4">
                        <h5 style="margin-left:60px;"> <strong>3. Leisure & Bermain</strong> </h5>
                    </div>
                    <label style="margin-left: 65px">
                        <input type="radio" value="tidak" checked name="leisure" class="form-control"> Tidak Ada Kelainan
                    </label>
                    <label style="margin-left: 10px">
                        <input type="radio" value="ada" name="leisure" class="form-control"> Ada
                    </label>
                    <input type="text" name="leisure_input" class="form-control" style="margin-left: 10px">
                </div>
                {{-- END OF TAG B PARENT --}}
    
                <div class="form-group">
                    <h4> <strong>III. Ringkasan Kasus</strong> </h4>
                    <div class="form-group col-lg-12">
                        <input type="text" name="ringkasan_kasus" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <h4> <strong>IV. Program Okupasi Terapi (P)</strong> </h4>
                    <div class="form-group col-lg-12">
                        <input type="text" name="program_okupasi_terapi" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <h4> <strong>V. Program Latihan Di Rumah</strong> </h4>
                    <div class="form-group col-lg-12">
                        <input type="text" name="program_latihan_dirumah" class="form-control">
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let form_okupasi_terapi = {!! json_encode($form_okupasi_terapi) !!};
    let data_okupasi_terapi = {!! json_encode($data_okupasi_terapi) !!};

    $(document).ready(function () {
        //validasi jika data sudah ada
        $.each(data_okupasi_terapi, function (key, v) { 
             if( v != null && v != ""){
                 if( v != "tidak" ){
                    //untuk radio
                    $("input[name='"+key+"'][type='radio'][value='ada']").prop('checked', true);
                    //untuk inputan
                    $("input[name='"+key+"_input']").val(v);
                    $("input[name='"+key+"']").val(v);
                }
             }
        });

        //validasi agar border tidak berwarna merah (untuk input)
        $("input").change(function (e) { 
            e.preventDefault();
            if( $(this).val() != "" && $(this).val() != null ){
                $(this).css('border-color', 'black');
            }
        });
        $("input[type='radio']").change(function (e) { 
            e.preventDefault();
            let attrName = $(this).attr('name');
            if( $(this).val() == "tidak" ){
                $('input[name="'+attrName+'_input"]').css('border-color', 'black');
                $('input[name="'+attrName+'_input"]').val("");
            }
        });
    });

    //validasi form radio valuenya == ada tapi inputannya kosong
    function validasiFormOkupasi() {
        if(form_okupasi_terapi.length > 0){
            $validasi_form_okupasi = false;
            $.each(form_okupasi_terapi, function (ind, val) {
                if(val != "id_form_kebidanan" && val != "rekapMedik_id" && val != "informatif_subyektif" && val != "informatif_obyektif" && val != "ringkasan_kasus" && val != "program_okupasi_terapi" && val != "program_latihan_dirumah"){
                    //untuk radio
                    if( $('input[name="'+val+'"][type="radio"]:checked').val() == "ada"){
                        if( $('input[name="'+val+'_input"]').val() == null || $('input[name="'+val+'_input"]').val() == "" ){
                            $('input[name="'+val+'_input"]').css('border-color', 'red');
                            $validasi_form_okupasi = true;
                        
                        }
                    }
                }
            });
            
            console.log("hasilnya adalah = " + $validasi_form_okupasi);
            if($validasi_form_okupasi){
                swal("Data Tidak Lengkap",'Silahkan Cek Form Okupasi Terapi','error');
                return $validasi_form_okupasi;
            }
        }
    }
</script>