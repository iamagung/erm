<div class="box box-success">
    <div class="box-heading">
        <div class="col-lg-6 col-md-6">
            <label style="font-weight: bold;font-size: 25px">Laboratorium Patologi Anatomi</label>
        </div>
        <div class="col-lg-6 col-md-6">
            <button type="button" class="btn pull-right" id="toggle_labpatologi" data-toggle="collapse" data-target="#form_laborat_patologi" aria-controls="form_laborat_patologi">Tampilkan</button>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
    <div class="box-body">
        <div id="form_laborat_patologi" class="collapse" style="height:0px">
            <input hidden type="text" name="id_form_laborat_patologi" value="">
            <div class="col-lg-12 col-md-12">
                <h4> <strong>Lembar Permintaan Pemeriksaan Laboratorium Patologi Anatomi</strong> </h4>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Bahan Berasal Dari : </label>
                            <input type="text" style="margin-left: 20px;margin-right:20%" value="">
                            <label for=""><span>Tanggal Pengambilan :</span> </label>
                            <input type="datetime-local" style="margin-left: 20px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Cairan Pleura">
                                    <span>Cairan Plura</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Cairan Peritonium">
                                    <span>Cairan Peritonium</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Cairan Sinovial">
                                    <span>Cairan Sinovial</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Cairan Pericardium">
                                    <span>Cairan Pericardium</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Lain-lain">
                                    <span>Lain-lain</span>
                                </label>
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Vagina">
                                    <span>Vagina</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Serviks">
                                    <span>Serviks</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Cavum Uteri">
                                    <span>Cavum Uteri</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Urine">
                                    <span>Urine</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Sikatan Bronkus">
                                    <span>Sikatan Bronkus</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Bilasan Bronkus">
                                    <span>Bilasan Bronkus</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="Sputum">
                                    <span>Sputum</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input type="radio" name="bahan_berasal" value="FNAB">
                                    <span>FNAB</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Cara Pengambilan : </label>
                            <label for="" style="margin-left:26px">
                                <input type="radio" name="cara_pengambilan" value="Apusan">
                                <span>Apusan</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="cara_pengambilan" value="Spontan">
                                <span>Spontan</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="cara_pengambilan" value="Bilasan">
                                <span>Bilasan</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="cara_pengambilan" value="Sikatan">
                                <span>Sikatan</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="cara_pengambilan" value="Pungsi">
                                <span>Pungsi</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="cara_pengambilan" value="Aspirasi">
                                <span>Aspirasi</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="cara_pengambilan" value="Lain-lain">
                                <span>Lain-lain</span>
                                <input type="text" name="cara_pengambilan_input" value="">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Cara / Cairan Fiksasi : </label>
                            <label for="" style="margin-left:15px">
                                <input type="radio" name="cara_fiksasi" value="Alkohol 96">
                                <span>Alkohol 96%</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="cara_fiksasi" value="Fiksasi Kering dan Methanol">
                                <span>Fiksasi Kering dan Methanol</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="cara_fiksasi" value="Lain-lain">
                                <span>Lain-lain</span>
                                <input type="text" name="cara_fiksasi_input" value="">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">
                                <span>Diagnosis Klinik :</span>
                            </label>
                            <textarea style="margin-left:2%" rows="3" type="text" class="form-control" name="diagnosis_klinik_anatomi" value="" ></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Ginekologi : </label>
                            <label for="" style="margin-left:2%">
                                <input type="radio" name="ginekologi" value="Pramenopause">
                                <span>Pramenopause</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="ginekologi" value="Menopause">
                                <span>Menopause / Pascamenopause</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <span>Operasi/Radiasi/Kemoterapi :</span>
                                        <input type="text" style="margin-left:20px" name="pramenopause_operasi" value="">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        <span>Haid Terakhir :</span>
                                        <input type="text" style="margin-left:110px" name="pramenopause_haid" value="">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">
                                                <span>Kontrasepsi :</span>
                                            </label>
                                            <label style="margin-left: 120px" for=""> 
                                                <input type="radio" name="pramenopause_kontrasepsi" value="PIL">
                                                <span>Pil</span>
                                            </label>
                                            <label for=""> 
                                                <input type="radio" name="pramenopause_kontrasepsi" value="Suntik">
                                                <span>Suntik</span>
                                            </label>
                                            <label for=""> 
                                                <input type="radio" name="pramenopause_kontrasepsi" value="AKDR">
                                                <span>AKDR</span>
                                            </label>
                                            <label for=""> 
                                                <input type="radio" name="pramenopause_kontrasepsi" value="Lain-lain">
                                                <span>Lain-lain</span>
                                                <input type="text" name="pramenopause_kontrasepsi_input">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <span style="margin-right: 120px">Tgl Terakhir :</span>
                                        <input type="text" name="menopause_tgl" value="">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        <span style="margin-right: 50px">Daur / Siklus Hais : (Hari)</span>
                                        <input type="text" name="menopause_daur_siklus" value="">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        <span style="margin-right: 80px">Terapi Hormon Lain</span>
                                        <input type="text" name="menopause_terapi_hormon" value="">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Status Ginekologi : </label>
                            <label for="" style="margin-left:2%">
                                <input type="radio" name="status_ginekologi" value="Tidak Ada Kelainan">
                                <span>Tidak Ada Kelainan</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="status_ginekologi" value="Eritroplakia">
                                <span>Eritroplakia</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="status_ginekologi" value="Perdarahan Sentuh">
                                <span>Perdarahan Sentuh</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="status_ginekologi" value="Fluor Albus">
                                <span>Fluor Albus</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="status_ginekologi" value="Leukoplakia">
                                <span>Leukoplakia</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="status_ginekologi" value="Perdarahan Abnormal Lainnya">
                                <span>Perdarahan Abnormal Lainnya</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="status_ginekologi" value="Servicitis">
                                <span>Servicitis</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="status_ginekologi" value="Lesi">
                                <span>Lesi</span>
                            </label>
                            <label for="" style="margin-left:10px">
                                <input type="radio" name="status_ginekologi" value="Lain-lain">
                                <span>Lain-lain</span>
                                <input type="text" name="status_ginekologi_lain" value="">
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <label for="">Non Ginekologi : </label>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <label for="">Lokasi Jaringan yang sakit / lokasi pengambilan bahan (gambar skematis bila mungkin)</label>
                            </div>
                            <div class="col-md-8">
                                <label for="" style="margin-left:10px">
                                    <input type="radio" name="gambar_skematis" value="Gambar Terlampir">
                                    <span>Gambar Terlampir</span>
                                </label>
                                <label for="" style="margin-left:10px">
                                    <input type="radio" name="gambar_skematis" value="Gambar Tidak Terlampir">
                                    <span>Gambar Tidak Terlampir</span>
                                </label>
                            </div>
                            <div class="col-md-4 pull-right">
                                <div class="row">
                                    <label for="">Hasil Pemeriksaan Endoskopi dan Radiologi</label>
                                    <label for="">(Rincian Gambar)</label>
                                </div>
                                <div class="col-md-12">
                                    <label for="" style="margin-left:10px">
                                        <input type="radio" name="gambar_skematis" value="Ada Endoskopi dan Radiologi">
                                        <span>Ada</span>
                                    </label>
                                    <label for="" style="margin-left:10px">
                                        <input type="radio" name="gambar_skematis" value="Tidak Ada Endoskopi dan Radiologi">
                                        <span>Tidak Ada</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                                <label for="">Pemeriksaan sipatologi sebelumnya di RSU dr. Wahidin Sudiro Husodo / Laboratorium Lainnya :</label>
                                <textarea style="margin-left:2%" rows="3" type="text" class="form-control" name="pemeriksaan_laborat_lama" value="" ></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <span>Tanggal :</span>
                                    </label>
                                    <input type="datetime-local" name="tanggal_pemeriksaan_laborat_lama" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <span>No.</span>
                                    </label>
                                    <input type="text" name="no_pemeriksaan_laborat_lama" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        <span>Hasil :</span>
                                    </label>
                                    <input type="text" name="hasil_pemeriksaan_laborat_lama" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success" style="width:100%"><i class="fa fa-save"></i> <span style="margin-left:10px">Simpan Pemeriksaan Laboratorium Patologi Anatomi</span> </button>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
        </div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
    </div>
</div>

<script type="text/javascript">

</script>