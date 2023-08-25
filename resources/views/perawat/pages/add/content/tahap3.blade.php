<div class="col-lg-12 col-md-12 tahap3" style="padding: 0px">
	<!-- <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script> -->
	<form id="tahap3">
		<input type="hidden" name="nama" value="{!! $rekap->nama_perawat !!}">
		<input type="hidden" name="jenis_kasusnya" value="">
		@if(isset($rekap->jenis_kasus))
			<input type="hidden" name="simpan_atas" value="belum">
		@else
			<input type="hidden" name="simpan_atas" value="">
		@endif
		<div class="col-lg-12 col-md-12">
			<a href="{{route('cetak3')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
			<a href="{{route('cetak3',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
		</div>
		<div class="clearfix"></div>
		<style type="text/css">
			.form1{
				width: 70% !important;
				display:inline !important;
			}
			.chzn-container{width: 100% !important;}
		</style>
		<!-- Pengkajian Keperawatan -->
		<div class="col-lg-12 col-md-12">
			<i><b style="color: red">(*) </b>wajib diisi, jika tidak ada beri <b> - </b></i>
		</div>
		<div class="box box-success">
			<div class="box-heading">
				<div class="col-lg-6 col-md-6">
					<label style="font-weight: bold;font-size: 25px">I. Pengkajian Keperawatan</label>
				</div>
				<div class="col-lg-6 col-md-6">
					<button type="button" class="btn pull-right" id="maximize" data-toggle="collapse" data-target="#demo">Minimize</button>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
			</div>
			<div class="box-body">
				<div id="demo">
					<div class="col-lg-12 col-md-12">
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Tanggal/Jam Pengerjaan</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="" class="form-control" value="{!! date('d-m-Y, h:i:s', strtotime($rekap->tanggalPengerjaan)) !!}" readonly>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pendaftaran Melalui<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check = ['checked',''];
								if (isset($rekap2->daftar_melalui)) {
									if($rekap2->daftar_melalui=='On'){
										$check= ['checked',''];
									} elseif($rekap2->daftar_melalui=='Off'){
										$check= ['','checked'];
									}
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="daftar_melalui" value="On" checked> Online</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Off" name="daftar_melalui"> Offline</label>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Kategori Pembayaran<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<select class="form-control" name="kategori_pembayaran">
									<option value="">..:: Pilih Kategori Pembayaran ::..</option>
									<?php
									$display = 'display: none';
									$check = ['checked','', ''];
									if (isset($rekap2->kategori_pembayaran)) {
										if($rekap2->kategori_pembayaran=='UMUM'){
											$check= ['checked', '', ''];
										} elseif($rekap2->kategori_pembayaran=='BPJS'){
											$check= ['', 'checked', ''];
										} elseif($rekap2->kategori_pembayaran!='' && $rekap2->kategori_pembayaran!='BPJS' && $rekap2->kategori_pembayaran!='UMUM'){
											$check= ['', '', 'checked'];
											$display = '';
										}
									}
									?>
									@foreach($cat_bayar as $cat)
									<option value="{{$cat->nilaichar}}" {{(isset($rekap2->kategori_pembayaran))?(($rekap2->kategori_pembayaran==$cat->nilaichar)?'selected':''):(($dataRegist->Kode_Ass==$cat->subgroups)?'selected':'')}}>{{$cat->nilaichar}}</option>
									@endforeach
									<option value="Lainnya">LAINNYA</option>
								</select>
								<input type="text" name="kategori_lainnya" class="form-control" style="display: none;" value="{{(isset($rekap2->kategori_pembayaran))?$rekap2->kategori_pembayaran:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Agama/ Nilai Kepercayaan<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<select class="form-control" name="agama">
									<option value="">..:: Pilih Agama ::..</option>
									<option @if(!empty($rekap->agama) && $rekap->agama=='Islam') selected @endif value="Islam">Islam</option>
									<option @if(!empty($rekap->agama) && $rekap->agama=='Kristen') selected @endif value="Kristen">Kristen</option>
									<option @if(!empty($rekap->agama) && $rekap->agama=='Katolik') selected @endif value="Katolik">Katolik</option>
									<option @if(!empty($rekap->agama) && $rekap->agama=='Hindu') selected @endif value="Hindu">Hindu</option>
									<option @if(!empty($rekap->agama) && $rekap->agama=='Buddha') selected @endif value="Buddha">Buddha</option>
									<option @if(!empty($rekap->agama) && $rekap->agama=='Kong Hu Cu') selected @endif value="Kong Hu Cu">Kong Hu Cu</option>
									<option @if(!empty($rekap->agama) && $rekap->agama=='Lainnya') selected @endif value="Lainnya">Lainnya</option>
								</select>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Suku/Budaya<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="suku" class="form-control" value="{{ (isset($rekap2->suku))?$rekap2->suku:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pendidikan<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<select class="form-control" name="pendidikan">
									<option value="">..:: Pilih Pendidikan ::..</option>
									<option @if(!empty($rekap->pendidikan) && $rekap->pendidikan=='SD Se-derajat') selected @endif value="SD Se-derajat">SD Se-derajat</option>
									<option @if(!empty($rekap->pendidikan) && $rekap->pendidikan=='SMP Se-derajat') selected @endif value="SMP Se-derajat">SMP Se-derajat</option>
									<option @if(!empty($rekap->pendidikan) && $rekap->pendidikan=='SMA Se-derajat') selected @endif value="SMA Se-derajat">SMA Se-derajat</option>
									<option @if(!empty($rekap->pendidikan) && $rekap->pendidikan=='DIII (Diploma)') selected @endif value="DIII (Diploma)">DIII (Diploma)</option>
									<option @if(!empty($rekap->pendidikan) && $rekap->pendidikan=='S1 (Sarjana)') selected @endif value="S1 (Sarjana)">S1 (Sarjana)</option>
									<option @if(!empty($rekap->pendidikan) && $rekap->pendidikan=='S2 (Master)') selected @endif value="S2 (Master)">S2 (Master)</option>
									<option @if(!empty($rekap->pendidikan) && $rekap->pendidikan=='S3 (Doktoral)') selected @endif value="S3 (Doktoral)">S3 (Doktoral)</option>
									<option @if(!empty($rekap->pendidikan) && $rekap->pendidikan=='Lainnya') selected @endif value="Lainnya">Lainnya</option>
								</select>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pekerjaan<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="pekerjaan" class="form-control" value="{{!empty($rekap->pekerjaan)?$rekap->pekerjaan:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Status Pernikahan<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check = ['','',''];
								if (isset($rekap2->status_pernikahan)) {
									if($rekap2->status_pernikahan=='Menikah'){
										$check= ['checked','',''];
									} elseif($rekap2->status_pernikahan=='Belum'){
										$check= ['','checked',''];
									} elseif($rekap2->status_pernikahan=='Janda/Duda'){
										$check= ['','','checked'];
									}
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="status_pernikahan" value="Menikah"> Sudah Menikah</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Belum" name="status_pernikahan"> Belum Menikah</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[2] !!} value="Janda/Duda" name="status_pernikahan"> Janda/Duda</label>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Keluhan Utama<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<textarea name="keluhan_utama" style="width: 100%;" required>{{(isset($rekap2->keluhan_utama))?$rekap2->keluhan_utama:''}}</textarea>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px;"></div>
					<hr>
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Jenis Kasus</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								@if(isset($rekap->jenis_kasus))
								<label> <input type="radio" name="jenis_kasus" value="B" @if($rekap->jenis_kasus == "BARU") checked @endif> Kasus Baru</label>
								<label style="margin-left: 10px"> <input type="radio" value="L" name="jenis_kasus" @if($rekap->jenis_kasus == "LAMA") checked @endif > Kasus Lama</label>
								@else
								<label> <input type="radio" name="jenis_kasus" value="B" @if($rekap->agama == '') checked @endif> Kasus Baru</label>
								<label style="margin-left: 10px"> <input type="radio" value="L" name="jenis_kasus" @if($rekap->agama != '') checked @endif > Kasus Lama</label>
								@endif
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Riwayat Kesehatan<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check = ['',''];
								$display1 = 'display: none';
								if (isset($rekap2->riwayat_kesehatan)) {
									if($rekap2->riwayat_kesehatan=='N'){
										$check= ['checked',''];
									} elseif($rekap2->riwayat_kesehatan !='N' && $rekap2->riwayat_kesehatan != ''){
										$check= ['','checked'];
										$display1 = '';
									}
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="riwayat_kesehatan" value="N" checked> Tidak Pernah Opname</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Y" name="riwayat_kesehatan"> Pernah Opname</label>
								<span id="dengan_sakit" style="{{$display1}}"><label style="margin-left: 10px">Dengan sakit: &nbsp; <input type="text" name="sakit_opname" value="{{(isset($rekap2->riwayat_kesehatan))?$rekap2->riwayat_kesehatan:''}}"></label>
								</span>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Riwayat Operasi<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check = ['',''];
								$display1 = 'display: none';
								if (isset($rekap2->riwayat_operasi)) {
									if($rekap2->riwayat_operasi=='N'){
										$check= ['checked',''];
									} elseif($rekap2->riwayat_operasi !='N' && $rekap2->riwayat_operasi != ''){
										$check= ['','checked'];
										$display1 = '';
									}
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="riwayat_operasi" value="N" checked> Tidak</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Y" name="riwayat_operasi"> Pernah Operasi</label>
								<span id="operasi_hari_ke" style="{{$display1}}"><label style="margin-left: 10px">Pasca operasi hari ke: &nbsp; <input type="text" name="operasi_hari_ke" value="{{(isset($rekap2->riwayat_operasi))?$rekap2->riwayat_operasi:''}}"></label>
								</span>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Riwayat KB<sup style="color: red;">*</sup></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check = ['checked',''];
								$display1 = 'display: none';
								if (isset($rekap2->riwayat_kb)) {
									if($rekap2->riwayat_kb=='N'){
										$check= ['checked',''];
									} else{
										$check= ['','checked'];
										$display1 = '';
									}
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="riwayat_kb" value="N" checked> Tidak</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Y" name="riwayat_kb"> Ya</label>
								<span id="lama_pemakaian" class="kbY" style="{!! $display1 !!}"><label style="margin-left: 10px">Lama Pemakaian:<sup style="color: red;">*</sup> &nbsp; <input type="text" name="lama_pemakaian" value="{{(isset($rekap2->riwayat_kb)) ? $rekap2->riwayat_kb:''}}" placeholder="Isikan jumlah hari"> Hari</label></span>
							</div>
						</div>
						<div class="form-group kbY" style="{!! $display1 !!}">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></label>
							<label class="col-lg-1 col-md-1 col-sm-12 col-xs-12">Jenis:<sup style="color: red;">*</sup> </label>
							<?php
							$check = ['', '', '', '', '', ''];
							$display1 = 'display: none';
							if (isset($rekap2->jenis_kb)) {
								if($rekap2->jenis_kb=='Suntik'){
									$check= ['checked', '', '', '', '', ''];
								} elseif($rekap2->jenis_kb=='Pil'){
									$check= ['', 'checked', '', '', '', ''];
								} elseif($rekap2->jenis_kb=='IUD'){
									$check= ['', '', 'checked', '', '', ''];
								} elseif($rekap2->jenis_kb=='MOW'){
									$check= ['', '', '', 'checked', '', ''];
								} elseif($rekap2->jenis_kb=='Implan'){
									$check= ['', '', '', '', 'checked', ''];
								} else{
									$check= ['', '', '', '', '', 'checked'];
									$display1 = '';
								}
							}
							?>
							<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<label> <input type="radio" {!! $check[0] !!} name="jenis_kb" value="Suntik" checked> Suntik</label>
								<label> <input type="radio" {!! $check[1] !!} name="jenis_kb" value="Pil"> Pil</label>
								<label> <input type="radio" {!! $check[2] !!} name="jenis_kb" value="IUD"> IUD</label>
								<label> <input type="radio" {!! $check[3] !!} name="jenis_kb" value="MOW"> MOW</label>
								<label> <input type="radio" {!! $check[4] !!} name="jenis_kb" value="Implan"> Implan</label>
								<label> <input type="radio" {!! $check[5] !!} name="jenis_kb" value="Lain-lain"> Lain-lain</label>
								<span id="kb_lain" style="{!! $display1 !!}"><label><input type="text" name="kb_lain" value="{{(isset($rekap2->jenis_kb))?$rekap2->jenis_kb:''}}"></label></span>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px;"></div>
					<div class="col-lg-12 col-md-12" style="">
						<div class="col-lg-4 col-md-4" style="padding: 0px">
							<div class="col-lg-12 col-md-12" style="border:1px solid #ccc;box-shadow: 0px 5px 5px #ccc;">
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<h3>Status Fisik <small style="font-size: 14px;"><i>(wajib diisi)</i></small></h3>
								</div>
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<table class="table table-bordered">
										<tr>
											<td>1. Tekanan Darah<sup style="color: red;">*</sup></td>
											<td>
												<?php
												$tekanan_darah=['0','0'];
												if($rekap->tekanan_darah!=''){
													$tekanan_darah = explode('/',$rekap->tekanan_darah);
													if(count($tekanan_darah)>1){
														$tekanan_darah = explode('/',$rekap->tekanan_darah);
													}else{
														$tekanan_darah=['0','0'];
													}
												}
												?>
												<input type="text" style="width:30%" onclick="this.select()" name="tekanan_darah[]" id="td1" onkeyup="fisikKeyup();" value="{!! $tekanan_darah[0] !!}">
												/
												<input type="text" style="width:30%" onclick="this.select()" name="tekanan_darah[]" id="td2" onkeyup="fisikKeyup();" value="{!! $tekanan_darah[1] !!}">
												mmhg
											</td>
										</tr>
										<tr>
											<td>2. Frekuensi Nadi<sup style="color: red;">*</sup></td>
											<td><input type="text" onclick="this.select()" class="form-control form1" id="fNadi" name="frek_nadi" value="{!! ($rekap->frek_nadi==0)?'':$rekap->frek_nadi !!}" onkeyup="fisikKeyup();">x/menit</td>
										</tr>
										<tr>
											<td>3. Suhu<sup style="color: red;">*</sup></td>
											<td><input type="text" onclick="this.select()" class="form-control form1" id="suh" name="suhu" value="{!! ($rekap->suhu==0)?'':$rekap->suhu !!}" onkeyup="fisikKeyup();">&deg;C</td>
										</tr>
										<tr>
											<td>4. Frekuensi Nafas<sup style="color: red;">*</sup></td>
											<td><input type="text" onclick="this.select()" class="form-control form1" id="fNafas" name="frek_nafas" value="{!! ($rekap->frek_nafas==0)?'':$rekap->frek_nafas !!}" onkeyup="fisikKeyup();">x/menit</td>
										</tr>
									</table>
									<div class="clearfix" style="margin-bottom: 10px"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="col-lg-12 col-md-12" style="box-shadow: 0px 5px 5px #ccc;border: 1px solid #ccc;">
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<h3>Antropometri <small style="font-size: 14px;"><i>(wajib diisi)</i></small></h3>
								</div>
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<table class="table table-bordered">
										<tr>
											<td>1. Berat Badan<sup style="color: red;">*</sup></td>
											<td><input type="text" onclick="this.select()" class="form-control" name="berat_badan" value="{!! ($rekap->berat_badan == 0)?'':$rekap->berat_badan !!}"></td>
										</tr>
										<tr>
											<td>2. Tinggi Badan<sup style="color: red;">*</sup></td>
											<td><input type="text" onclick="this.select()" class="form-control" name="tinggi_badan" value="{!! ($rekap->tinggi_badan==0)?'':$rekap->tinggi_badan !!}"></td>
										</tr>
										<tr>
											<td>3. Lingkar Kepala<sup style="color: red;">*</sup></td>
											<td><input type="text" onclick="this.select()" class="form-control" name="lingkar_kepala" value="{!! ($rekap->lingkar_kepala==0)?'':$rekap->lingkar_kepala !!}"></td>
										</tr>
										<tr>
											<td>4. IMT <br/><i>*Khusus pediatri</i></td>
											<td><input type="text" onclick="this.select()" class="form-control" name="imt" value="{!! ($rekap->imt==0)?'':$rekap->imt !!}"></td>
										</tr>
									</table>
									<div class="clearfix" style="margin-bottom: 10px"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4" style="padding: 0px">
							<div class="col-lg-12 col-md-12" style="box-shadow: 0px 5px 5px #ccc;border: 1px solid #ccc">
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<h3>Fungsional</h3>
								</div>
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<table class="table table-bordered">
										<tr>
											<td>
												<label for="alatBantu">1. Alat Bantu</label>
											</td>
											<td>
												<?php
												$check='';
												if($rekap->alat_bantu!=''){
													$check='checked';
												}
												?>
												<input type="checkbox" {!! $check !!} id="alatBantu" name="alat_bantu" value="ada">
											</td>
										</tr>
										<tr>
											<td>
												<label for="prothesa">2. Prothesa</label>
											</td>
											<td>
												<?php
												$check='';
												if($rekap->prothesa!=''){
													$check='checked';
												}
												?>
												<input type="checkbox" {!! $check !!} id="prothesa" name="prothesa" value="ada">
											</td>
										</tr>
										<tr>
											<td>
												<label for="cacatTubuh">3. Cacat Tubuh</label>
											</td>
											<td>
												<?php
												$check='';
												if($rekap->cacat_tubuh!=''){
													$check='checked';
												}
												?>
												<input type="checkbox" {!! $check !!} id="cacatTubuh" name="cacat_tubuh" value="ada">
											</td>
										</tr>
										<tr>
											<td>
												<label>4. ADL</label>
											</td>
											<td>
												<?php
												$check=['checked',''];
												if($rekap->adi=='mandiri'){
													$check=['checked',''];
												}else if($rekap->adi=='dibantu'){
													$check=['','checked'];
												}
												?>
												<label> <input type="radio" {!! $check[0] !!} name="adi" value="mandiri"> Mandiri</label>
												<br/>
												<label> <input type="radio" {!! $check[1] !!} name="adi" value="dibantu"> Dibantu</label>
											</td>
										</tr>
										<!-- <tr>
											<td>
												<label>5 Riwayat Jatuh</label>
											</td>
											<td>
												<?php
												$check=['','checked'];
												if($rekap->riwayat_jatuh=='+'){
													$check=['checked',''];
												}else if($rekap->riwayat_jatuh=='-'){
													$check=['','checked'];
												}
												?>
												<label> <input type="radio" {!! $check[0] !!} name="riwayat_jatuh" value="+"> +</label>
												<label style="margin-left: 20px"> <input type="radio" {!! $check[1] !!} name="riwayat_jatuh" value="-"> -</label>
											</td>
										</tr>
										<tr>
											<td>
												<label>6 Skrining Nyeri</label>
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
														<label> <input type="radio" {!! $check[0] !!} id="adaSkriningNyeri" name="skrining_nyeri" value="Ada"> Ada</label>
													</div>
													<div class="col-lg-8 col-md-8">
														<input type="text" name="skrining_nyeri_lain" class="form-control" style="border-radius: 10px !important;{!! $display !!}" value="{!! $rekap->skrining_nyeri !!}">
													</div>
												</div>
												<br/>
												<label> <input type="radio" {!! $check[1] !!} name="skrining_nyeri" value="Tidak"> Tidak</label>
											</td>
										</tr> -->
									</table>
									<div class="clearfix" style="margin-bottom: 10px"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- FORM BAWAH -->
					<div class="clearfix" style="margin-bottom: 20px"></div>
					<div class="col-lg-12 col-md-12">
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Status Gizi</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check = ['','','','',''];
								if (isset($rekap2->status_gizi)) {
									if($rekap2->status_gizi=='Buruk'){
										$check= ['checked','','','',''];
									} elseif($rekap2->status_gizi=='Kurang'){
										$check= ['','checked','','',''];
									} elseif($rekap2->status_gizi=='Baik'){
										$check= ['','','checked','',''];
									} elseif($rekap2->status_gizi=='Lebih'){
										$check= ['','','','checked',''];
									} elseif($rekap2->status_gizi=='Obesitas'){
										$check= ['','','','','checked'];
									}
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="status_gizi" value="Buruk" checked> Buruk</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Kurang" name="status_gizi"> Kurang</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[2] !!} value="Baik" name="status_gizi"> Baik</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[3] !!} value="Lebih" name="status_gizi"> Lebih</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[4] !!} value="Obesitas" name="status_gizi"> Obesitas</label>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$stunting = '';
								$wasting = '';
								if(!empty($rekap2->stunting_wasting)){
									$k = explode("+", $rekap2->stunting_wasting);
									if($k[0]=='Y'){
										$stunting = 'checked';
									}
									if($k[1]=='Y'){
										$wasting = 'checked';
									}
								}
								?>
								<label> <input type="checkbox" {!! $stunting !!} value="Y" name="stunting"> Stunting</label><br>
								<label> <input type="checkbox" {!! $wasting !!} value="Y" name="wasting"> Wasting</label>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<!-- <div class="form-group">
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
								<label> <input type="checkbox" {!! $check[0] !!} value="Depresi"> Depresi</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[1] !!} value="Takut"> Takut</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[2] !!} value="Agresif"> Agresif</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[3] !!} value="Melukai diri sendiri/ Orang lain"> Melukai diri sendiri/ Orang lain</label>

								<label style="display: none"> <input type="checkbox" {!! $check[0] !!} name="status_psikologi[]" value="Depresi"> Depresi</label>
								<label style="display: none"> <input type="checkbox" {!! $check[1] !!} name="status_psikologi[]" value="Takut"> Takut</label>
								<label style="display: none"> <input type="checkbox" {!! $check[2] !!} name="status_psikologi[]" value="Agresif"> Agresif</label>
								<label style="display: none"> <input type="checkbox" {!! $check[3] !!} name="status_psikologi[]" value="Melukai diri sendiri/ Orang lain"> Melukai diri sendiri/ Orang lain</label>
							</div>
						</div> -->
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Status Psikologi</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check=['','','','','','','',''];
								$lain = '';
								if($rekap->status_psikologi!=''){
									$st = explode("+", $rekap->status_psikologi);
									for ($i=0; $i < count($st)-1; $i++) {
										if($st[$i]=='Tenang'){
											$check[0] = 'checked';
										}elseif($st[$i]=='Cemas'){
											$check[1] = 'checked';
										}elseif($st[$i]=='Sedih'){
											$check[2] = 'checked';
										}elseif($st[$i]=='Depresi'){
											$check[3] = 'checked';
										}elseif($st[$i]=='Marah'){
											$check[4] = 'checked';
										}elseif($st[$i]=='Hiperaktif'){
											$check[5] = 'checked';
										}elseif($st[$i]=='Mengganggu Sekitar'){
											$check[6] = 'checked';
										}else{
											$check[7] = 'checked';
											$lain = $st[$i];
										}
									}
								}
								?>
								<label> <input type="checkbox" {!! $check[0] !!} class="disableKL" value="Tenang" name="status_psikologi[]"> Tenang</label>
								<label style="margin-left: 20px"> <input type="checkbox" class="disableKL" {!! $check[1] !!} value="Cemas" name="status_psikologi[]"> Cemas</label>
								<label style="margin-left: 20px"> <input type="checkbox" class="disableKL" {!! $check[2] !!} value="Sedih" name="status_psikologi[]"> Sedih</label>
								<label style="margin-left: 20px"> <input type="checkbox" class="disableKL" {!! $check[3] !!} value="Depresi" name="status_psikologi[]"> Depresi</label>
								<label style="margin-left: 20px"> <input type="checkbox" class="disableKL" {!! $check[4] !!} value="Marah" name="status_psikologi[]"> Marah</label>
								<label style="margin-left: 20px"> <input type="checkbox" class="disableKL" {!! $check[5] !!} value="Hiperaktif" name="status_psikologi[]"> Hiperaktif</label>
								<label style="margin-left: 20px"> <input type="checkbox" class="disableKL" {!! $check[6] !!} value="Mengganggu Sekitar" name="status_psikologi[]"> Mengganggu Sekitar</label>
								<label> <input type="checkbox" {!! $check[7] !!} value="Lain-lain" class="disableKL" name="status_psikologi[]"> Lain-lain <input type="text" class="disableKL" name="status_psikologi_lain" value="{{$lain}}"></label>
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
										<label> <input type="checkbox" {!! $check[0] !!} class="disableKL" id="hambatanBahasa" value="Bahasa" name="hambatan[]"> Bahasa</label>
										<!-- <label style="display: none"> <input type="checkbox" {!! $check[0] !!} id="hambatanBahasa" name="hambatan[]" value="Bahasa"> Bahasa</label> -->
									</div>
									<div class="col-lg-8 col-md-8">
										<input type="text" name="bahasa_lain" class="form-control disableKL" style="border-radius: 10px !important;{!! $display !!}" value="{!! $bahasaval !!}">
									</div>
								</div><br/>
								<label> <input type="checkbox" {!! $check[1] !!} class="disableKL" value="Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)" name="hambatan[]"> Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)</label>
								<!-- <label style="display: none"> <input type="checkbox" {!! $check[1] !!} name="hambatan[]" value="Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)"> Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)</label> -->
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Alergi </label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="alergi" class="form-control" value="{!! $rekap->alergi !!}" placeholder="Kosongi jika tidak ada alergi">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Riwayat Pengobatan </label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="riwayat_pengobatan" class="form-control" value="{!! (isset($rekap2->riwayat_pengobatan))?$rekap2->riwayat_pengobatan:'' !!}" placeholder="Kosongi jika tidak ada riwayat pengobatan">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pengkajian Nyeri</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check = ['','','',''];
								if (isset($rekap2->pengkajian_nyeri)) {
									if($rekap2->pengkajian_nyeri=='0'){
										$check= ['checked','','',''];
									} elseif($rekap2->pengkajian_nyeri=='1-3'){
										$check= ['','checked','',''];
									} elseif($rekap2->pengkajian_nyeri=='4-6'){
										$check= ['','','checked',''];
									} elseif($rekap2->pengkajian_nyeri=='7-10'){
										$check= ['','','','checked'];
									}
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="pengkajian_nyeri" value="0"> Tidak Ada Nyeri (0)</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="1-3" name="pengkajian_nyeri"> Nyeri Ringan (1-3)</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[2] !!} value="4-6" name="pengkajian_nyeri"> Nyeri Sedang (4-6)</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[3] !!} value="7-10" name="pengkajian_nyeri"> Nyeri Berat (7-10)</label>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Pengkajian Risiko Jatuh Time Up & Go Test (TUG):</label>
							<?php
								$check1=['',''];
								$check2=['',''];
								$check3=['','',''];
								if ((isset($rekap2->risiko_jatuh))) {
									if($rekap2->risiko_jatuh!=''){
										$rsk = explode("+", $rekap2->risiko_jatuh);
										if($rsk[0]=='Y'){
											$check1[0] = 'checked';
										}else{
											$check1[1] = 'checked';
										}

										if($rsk[1]=='Y'){
											$check2[0] = 'checked';
										}else{
											$check2[1] = 'checked';
										}

										if($rsk[2]=='Tidak'){
											$check3[0] = 'checked';
										}elseif($rsk[2]=='Sedang'){
											$check3[1] = 'checked';
										}else{
											$check3[2] = 'checked';
										}
									}
								}
							?>
							<label class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></label>
							<label class="col-lg-9 col-md-9 col-sm-12 col-xs-12">a. Cara berjalan pasien saat akan duduk di kursi, apakah pasien tampak tak seimbang (sempoyongan / limbung)?</label>
							<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<label> <input type="radio" {!! $check1[0] !!} name="risiko_jatuh1" value="Y"> Ya</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check1[1] !!} value="N" name="risiko_jatuh1"> Tidak</label>
							</div>
							<label class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></label>
							<label class="col-lg-9 col-md-9 col-sm-12 col-xs-12">b. Apakah pasien memegang pinggiran kursi / meja / benda lain sebagai penopang saat duduk?</label>
							<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<label> <input type="radio" {!! $check2[0] !!} name="risiko_jatuh2" value="0"> Ya</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check2[1] !!} value="N" name="risiko_jatuh2"> Tidak</label>
							</div>
							<label class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></label>
							<label class="col-lg-3 col-md-3 col-sm-12 col-xs-12">HASIL:</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<label> <input type="radio" {!! $check3[0] !!} name="hasil_risiko_jatuh" value="Tidak"> Tidak Berisiko (Tidak ditemukan a dan b)</label><br>
								<label> <input type="radio" {!! $check3[1] !!} name="hasil_risiko_jatuh" value="Sedang"> Risiko Rendah (Ditemukan salah satu a dan b)</label><br>
								<label> <input type="radio" {!! $check3[2] !!} name="hasil_risiko_jatuh" value="Tinggi"> Risiko Tinggi (Ditemukan a dan b)</label>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
					</div>
					<div class="clearfix" style="margin-bottom: 20px"></div>
				</div>
			</div>
		</div>

		<!-- Pengkajian Medis -->
		<div class="clearfix" style="margin-bottom: 20px"></div>
		@if($rekap->alergi!='')
		@if($rekap->alergi!='-')
		<div class="col-lg-12 col-md-12" style="background:red;padding:0px;margin:0px">&nbsp;</div>
		@endif
		@endif
		<div class="box box-success">
			<div class="box-heading">
				<div class="col-lg-8 col-md-8">
					<!--<label style="font-weight: bold;font-size: 25px">II. Pengkajian Medis</label>-->
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
			</div>
			<div class="box-body">
				@if (Auth::user()->is_terapis == 'Y')
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<h3 class="col-lg-12 col-md-12" style="padding: 0; margin: 0; text-align: center;"><b>RIWAYAT KUNJUNGAN PASIEN</b></h3>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<div style="overflow: auto;max-height:400px">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Tgl Kunjungan</th>
									<th>Diagnosa</th>
									<th>ICD 10</th>
									<th>Tindakan & Obat-obatan</th>
									<th>Icd 9 cm</th>
									<th>Poli</th>
									<th>Tgl Kontrol</th>
									<th width="5%">Aksi</th>
								</tr>
							</thead>
							<tbody id="hasilRekapRJ">
								<?php
								if(count($rekap1)!=0){
									foreach ($rekap1 as $key) {
										?>
										<tr>
											<td>{{$key->tanggalKunjungan}}</td>
											<td>
												<ol>
													<?php
													if($key->diagnosa!=''){
														$diag = explode(";", $key->diagnosa);
														for ($i=0; $i < count($diag)-1; $i++) {
															?>
															<li>{{$diag[$i]}}</li>
															<?php
														}
													}
													?>
												</ol>
											</td>
											<td>
												<ol>
													<?php
													if($key->icd10!=''){
														$diag = explode(";", $key->icd10);
														for ($i=0; $i < count($diag)-1; $i++) {
															?>
															<li>{{$diag[$i]}}</li>
															<?php
														}
													}
													?>
												</ol>
											</td>
											<td>
												<?php
													$obat = DB::connection('rsu')->table('tr_rawatjalanobat')->where('No_Register',$key->no_Register)->get();
													echo (count($obat)!=0)?'Obat-obatan':'Obat yang diresepkan';
												?>
												<!-- Obat-obatan -->
												<ol>
													<?php
													// $obat = DB::connection('rsu')->table('tr_rawatjalanobat')->where('No_Register',$key->no_Register)->get();
													// if(count($obat)!=0){
													// 	foreach ($obat as $keyO) {
													// 		echo '<li>'.$keyO->NamaBrg.' <b>( '.$keyO->Jml.' '.$keyO->Satuan.')</b></li>';
													// 	}
													// }
													?>
													<?php
													// $obat = DB::connection('rsu')->table('tr_rawatjalanobat')->where('No_Register',$key->no_Register)->get();
													if(count($obat)!=0){
														foreach ($obat as $keyO) {
															echo '<li>'.$keyO->NamaBrg.' <b>( '.round($keyO->Jml, 0).' '.$keyO->Satuan.')</b></li>';
														}
													} else {
														$obat = DB::table('tr_resep_d')->where('No_Register',$key->no_Register)->get();
														if(count($obat)!=0){
															foreach ($obat as $keyO) {
																echo '<li>'.$keyO->NamaBrg.' <b>( '.round($keyO->Jumlah, 0).' '.$keyO->Satuan.')</b></li>';
															}
														}
													}
													?>
												</ol>
												<?php
												$rm = DB::table('tr_resep_racikan_m')->where('No_Register', $key->no_Register)->first();
												if($rm){ ?>
												Obat Racikan
												<!-- Obat Racik -->
												<ol>
													<?php
													$rd = DB::table('tr_resep_racikan_d')->where('No_Resep', $rm->No_Resep)->get();
													if(count($rd)!=0){
														foreach ($rd as $vd) {
															echo "<li>$vd->NamaBrg $vd->Dosis$vd->Satuan <b>($vd->Jumlah)</b></li>";
														}
													}
													?>
												</ol>
												<?php } ?>
												Tindakan<br/>
												<ol>
													<?php
													if($key->tindakan!=''){
														$diag = explode(";", $key->tindakan);
														for ($i=0; $i < count($diag)-1; $i++) {
															?>
															<li>{{$diag[$i]}}</li>
															<?php
														}
													}
													?>
												</ol>
											</td>
											<td>
												<ol>
													<?php
													if($key->icd9!=''){
														$diag = explode(";", $key->icd9);
														for ($i=0; $i < count($diag)-1; $i++) {
															?>
															<li>{{$diag[$i]}}</li>
															<?php
														}
													}
													?>
												</ol>
											</td>
											<td>{{$key->NamaPoli}}</td>
											<td>{{$key->tgl_kontrol}}</td>
											<td><a href="javascript:void(0);" onclick="detailRekapRJ('{{$key->id_rekapMedik}}')" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
										</tr>
										<?php
									}
								}else{
									?>
									<tr>
										<td colspan="7">Tidak ada data</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 20px"></div>
				@endif
				<?php
					$title = (Auth::user()->is_terapis == 'Y')?'TERAPIS':'PERAWAT';
					if (Auth::user()->is_terapis == 'Y') {
						$s = (isset($rekap2->anamnesis_perawat)) ? $rekap2->anamnesis_perawat : '';
						$o = (isset($rekap2->pemeriksaanFisik_perawat)) ? $rekap2->pemeriksaanFisik_perawat : '';
						$a = (isset($rekap2->diagnosis_perawat)) ? $rekap2->diagnosis_perawat : '';
						$p = (isset($rekap2->rencana_terapi_perawat)) ? $rekap2->rencana_terapi_perawat : '';
						$instruksi = (isset($rekap2->instruksi_ppa_perawat)) ? $rekap2->instruksi_ppa_perawat : '';
					} else {
						$s = (isset($rekap2->anamnesis_perawat)) ? $rekap2->anamnesis_perawat : '';
						$o = (isset($rekap2->pemeriksaanFisik_perawat)) ? $rekap2->pemeriksaanFisik_perawat : '';
						$a = (isset($rekap2->diagnosis_perawat)) ? $rekap2->diagnosis_perawat : '';
						$p = (isset($rekap2->rencana_terapi_perawat)) ? $rekap2->rencana_terapi_perawat : '';
						$instruksi = (isset($rekap2->instruksi_ppa_perawat)) ? $rekap2->instruksi_ppa_perawat : '';

					}
				?>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<h3 class="col-lg-12 col-md-12" style="padding: 0; margin: 0; text-align: center;"><b>SOAP PARAMEDIS ({{$title}})</b></h3>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="col-lg-12 col-md-12" style="padding: 0px">
					<div class="col-lg-6 col-md-6">
						<div class="clearfix"></div>
						<div class="col-lg-12 col-md-12" style="padding: 0px">
							<label class="col-lg-12 col-md-12" style="padding:0px">Anamnesis (S)<sup style="color: red;">*</sup> </label>
							<textarea class="form-control" placeholder="Anamnesis (S)" name="anamnesis">{{$s}}</textarea>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="col-lg-12 col-md-12" style="padding: 0px">
							<label class="col-lg-12 col-md-12" style="padding:0px">Pemeriksaan Fisik (O)<sup style="color: red;">*</sup></label>
							<textarea class="form-control" placeholder="Pemeriksaan Fisik (O)" name="pemeriksaanFisik">{{$o}}</textarea>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="col-lg-12 col-md-12" style="padding: 0px">
							<label class="col-lg-12 col-md-12" style="padding:0px">Instruksi PPA Termasuk Pasca Bedah</label>
							<textarea class="form-control" placeholder="Instruksi Ditulis dengan Rinci Dan Jelas (Kosongi jika tidak ada instruksi)" name="instruksi_ppa">{{$instruksi}}</textarea>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="col-lg-12 col-md-12" style="padding: 0px">
							<label class="col-lg-12 col-md-12" style="padding:0px">Assessment (A) </label>
							<div class="clearfix"></div>
							<textarea class="form-control" placeholder="Assessment (A)" name="diagnosis_tambahan">{{$a}}</textarea>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="col-lg-12 col-md-12" style="padding: 0px">
							<label class="col-lg-12 col-md-12" style="padding: 0px">Rencana dan terapi (P) </label>
							<textarea class="form-control" placeholder="Rencana dan Terapi (P)" name="rencana3">{{$p}}</textarea>
							<div class="clearfix" style="margin-bottom: 10px"></div>
						</div>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
				<div class="col-md-12">
					<label for="tarif_tindakan">Tindakan Dan Tarif Layanan</label>
					<select name="tarif_tindakan" id="tarif_tindakan" class="form-control">
						<option value="">.:: Pilih Tarif dan Tindakan ::.</option>
						@foreach ($tnt as $t)
							<option value="{{json_encode($t)}}">{{$t->NamaTindakan . " - Rp." . (int)$t->Total}}</option>
						@endforeach
					</select>
					<div class="clearfix" style="margin-bottom: 10px"></div>
					<label>Daftar Pilihan Tindakan & Tarif Layanan</label>
					<table id="table_tarif_tindakan" class="table table-bordered">
						<thead>
							<tr>
								<th>Tindakan</th>
								<th>Tarif Layanan</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody id="data_tarif_tindakan">
							@if(count($data_tnt) == 0)
								<tr id="default_title_tarif">
									<td colspan="4" style="text-align: center;">Tidak Ada Data Tarif Dan Tindakan</td>
								</tr>
								@endif
							@if(count($data_tnt) > 0)
								@foreach ($data_tnt as $key => $dt)
									<tr id="tempat_tnt_{{$dt->RwID}}">
										<input type="hidden" name="idtindakan[]" value="">
										<input type="hidden" name="kode_tindakan[]" value="{{$dt->KodeTindakan}}">
										<input type="hidden" name="nama_tindakan[]" value="{{$dt->NamaTindakan}}">
										<input type="hidden" name="kode_poli[]" value="{{$dt->KodePoli}}">
										<input type="hidden" name="tarif_tindakan[]" value="{{$dt->TarifTindakan}}">
										<td>{{$dt->NamaTindakan}}</td>
										<td>Rp. {{(int)($dt->TarifTindakan)}}</td>
										<td style="text-align: center;"><a href="javascript:void(0);" disabled class="btn btn-danger" onclick="return false">Hapus</a></td>
									</tr>
								@endforeach
							@endif
							<tr id="total_tarif_head">
								<td colspan="2" style="text-align: center;"><strong>Total Tarif</strong></td>
								@if(count($data_tnt) > 0)
									<td id="total_tnt" colspan="2" style="text-align: center;">Rp. {{$total_tnt}}</td>
									<input type="hidden" name="total_tarif_tindakan" id="total_tarif_tindakan" value="{{$total_tnt}}">
								@else
									<td id="total_tnt" colspan="2" style="text-align: center;">Rp. 0</td>
									<input type="hidden" name="total_tarif_tindakan" id="total_tarif_tindakan" value="0">
								@endif
							</tr>
						</tbody>
					</table>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
			</div>
		</div>

		@if(auth::user()->is_terapis == 'Y' && auth::user()->kodePoli == 117)
			{{-- Fisioterapi --}}
			@include('form-pengkajian.fisioterapi')
			{{-- Okupasi Terapi --}}
			@include('form-pengkajian.okupasi_terapi')
			{{-- Terapi Wicara --}}
			@include('form-pengkajian.terapi_wicara')
			{{-- Orthotik --}}
			@include('form-pengkajian.orthotik')
		@endif

		<div class="col-lg-12 col-md-12" style="text-align: center;">
			<a href="javascript:void(0);" class="btn btn-success" id="simpan_tahap" onclick="simpantahap3(0)">Simpan</a>
		</div>
		<div class="clearfix" style="margin-bottom: 10px"></div>
	</form>
</div>
<div class="clearfix"></div>
<div class="modal_layout_obat1"></div>

@section('js_tahap3')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" language="JavaScript">
	var simpanDiag =$('textarea[name=diagnosis3]').html();
	var simpanKode =$('textarea[name=icd103]').html();
	var simpanTindakan =$('textarea[name=tindakan3]').html();
	var simpanKod =$('textarea[name=icd93]').html();

	$(document).ready(function () {
		//tarifdantindakan select option style
		$("#tarif_tindakan").select2();

		//check kasus apa yang sekarang dikerjakan
		let kasus = $("input[name=jenis_kasus]:checked").val();
		//jika kasus lama tidak ditemukan maka langsung ke kasus baru
		if(kasus == "B"){
			$(`input[name=status_gizi][value='Baik']`).prop("checked",true);
			$(`input[class=disableKL][value='Tenang']`).prop("checked",true);
			$(`input[name=pengkajian_nyeri][value='0']`).prop("checked",true);
			$("input[name=risiko_jatuh1][value='N']").prop("checked",true);
			$("input[name=risiko_jatuh2][value='N']").prop("checked",true);
			$("input[name=hasil_risiko_jatuh][value='Tidak']").prop("checked",true);

			$("input[name=jenis_kasus]:checked").val("BARU")
		}else{
			$("input[name=jenis_kasusnya]").val("LAMA")
		}

		if( $("input[name=simpan_atas]").val() != "" ){
			var rm = "{!! Session::get('no_RM') !!}";
			$.post("{!! route('getKasusSaatIni') !!}",{rm: rm}).done(function(result){
				if(result.status == "success"){
					if (result.data1) {
						var td = result.data1.tekanan_darah.split('/');
						$('input[name=agama]').val(result.data1.agama);
						$('input[name=pekerjaan]').val(result.data1.pekerjaan);
						$('input[name=frek_nadi]').val(result.data1.frek_nadi);
						$('input[name=suhu]').val(result.data1.suhu);
						$('input[name=frek_nafas]').val(result.data1.frek_nafas);
						$('input[name=berat_badan]').val(result.data1.berat_badan);
						$('input[name=alergi]').val(result.data1.alergi);
						$('input[name=tinggi_badan]').val(result.data1.tinggi_badan);
						$('input[name=lingkar_kepala]').val(result.data1.lingkar_kepala);
						$('input[name=imt]').val(result.data1.imt);
						$(`input[name=adi][value='${result.data1.adi}']`).prop("checked",true);
						$('#td1').val(td[0]);
						$('#td2').val(td[1]);
						$('select[name=pendidikan]').val(result.data1.pendidikan).change();
					}
					if (result.data2) {
						$('select[name=kategori_pembayaran]').val(result.data2.kategori_pembayaran).change();
						$(`input[name=daftar_melalui][value='${result.data2.daftar_melalui}']`).prop("checked",true);
						$('textarea[name=keluhan_utama]').text(result.data2.keluhan_utama);
						$('input[name=suku]').val(result.data2.suku);
						$(`input[name=status_pernikahan][value='${result.data2.status_pernikahan}']`).prop("checked",true);
						$(`input[name=status_gizi][value='${result.data2.status_gizi}']`).prop("checked",true);
						$('input[name=riwayat_pengobatan]').val(result.data1.riwayat_pengobatan);
						$(`input[name=pengkajian_nyeri][value='${result.data2.pengkajian_nyeri}']`).prop("checked",true);
					}
				}else{
					swal({
						title:"Gagal Memuat",
						type: result.status,
						text:'Gagal Memuat Kasus Saat Ini'
					});
				}
			});
		}
	});

	//tarif tindakan
	var tempat_tindakan = 0;
	let totaltarif = parseInt($("#total_tarif_tindakan").val());
	$("#tarif_tindakan").change(function (e) { 
		//default pilihan
		e.preventDefault();
		let data = JSON.parse(e.target.value);
		console.log(data);

		//setdata ke tabel
		tempat_tindakan++;
		$("#default_title_tarif").hide();
		var html = "";
		html += `<tr id="tempat_tnt_${tempat_tindakan}">`;
		html += `<input type="hidden" name="idtindakan[]" value="">`;
		html += `<input type="hidden" name="kode_tindakan[]" value="${data.KodeTindakan}">`;
		html += `<input type="hidden" name="nama_tindakan[]" value="${data.NamaTindakan}">`;
		html += `<input type="hidden" name="kode_poli[]" value="${data.KodePoli}">`;
		html += `<input type="hidden" name="tarif_tindakan[]" value="${parseInt(data.Total)}">`;
		html += "<td>"+ data.NamaTindakan +"</td>";
		html += "<td class='tarifnya'>Rp. "+ parseInt(data.Total) +"</td>";
		html += '<td style="text-align: center;"><a href="javascript:void(0);" class="btn btn-danger" onclick="hapus_tindakan('+tempat_tindakan+','+parseInt(data.Total)+')">Hapus</a></td>';
		html += "</tr>";
		$("#table_tarif_tindakan > tbody").append($("#total_tarif_head").before(html));

		//hitung totaltarif
		totaltarif += parseInt(data.Total);
		$("#total_tarif_tindakan").val(totaltarif);
		$("#total_tnt").text("Rp. "+totaltarif);
		console.log(totaltarif);
	});

	function hapus_tindakan(id,harga){		
		swal({
				title: "Hapus Tindakan",
				text: "Data Yang Dihapus Dapat Ditambahkan Lagi",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal',
				closeOnConfirm: true,
				//closeOnCancel: false
			},
			function(){
				// pengurangan totaltarif
				totaltarif -= parseInt(harga);
				$("#total_tarif_tindakan").val(totaltarif);
				$("#total_tnt").text("Rp. "+totaltarif);

				//hapus row
				var tr_tempat_dropping_obj = $('#tempat_tnt_'+id);
				tr_tempat_dropping_obj.remove();

				//tampilan defaul jika data kosong
				if(totaltarif == 0){
					$("#default_title_tarif").show();
				}
			});
	}

	$('input[name=jenis_kasus]').change(function(){
		var jns = $('input[name=jenis_kasus]:checked').val();
		var rm = "{!! Session::get('no_RM') !!}";
		if(jns=='L'){
			$.post("{!! route('getKasusLama') !!}",{rm: rm}).done(function(result){
				if(result.status == "success"){
					if (result.data1) {
						var td = result.data1.tekanan_darah.split('/');
						$('input[name=agama]').val(result.data1.agama);
						$('input[name=pekerjaan]').val(result.data1.pekerjaan);
						$('input[name=frek_nadi]').val(result.data1.frek_nadi);
						$('input[name=suhu]').val(result.data1.suhu);
						$('input[name=frek_nafas]').val(result.data1.frek_nafas);
						$('input[name=berat_badan]').val(result.data1.berat_badan);
						$('input[name=alergi]').val(result.data1.alergi);
						$('input[name=tinggi_badan]').val(result.data1.tinggi_badan);
						$('input[name=lingkar_kepala]').val(result.data1.lingkar_kepala);
						$('input[name=imt]').val(result.data1.imt);
						$(`input[name=adi][value='${result.data1.adi}']`).prop("checked",true);
						$('#td1').val(td[0]);
						$('#td2').val(td[1]);
						$('select[name=pendidikan]').val(result.data1.pendidikan).change();
					}
					if (result.data2) {
						$('select[name=kategori_pembayaran]').val(result.data2.kategori_pembayaran).change();
						$(`input[name=daftar_melalui][value='${result.data2.daftar_melalui}']`).prop("checked",true);
						$('textarea[name=keluhan_utama]').text(result.data2.keluhan_utama);
						$('input[name=suku]').val(result.data2.suku);
						$(`input[name=status_pernikahan][value='${result.data2.status_pernikahan}']`).prop("checked",true);
						$(`input[name=status_gizi][value='${result.data2.status_gizi}']`).prop("checked",true);
						$('input[name=riwayat_pengobatan]').val(result.data1.riwayat_pengobatan);
						$(`input[name=pengkajian_nyeri][value='${result.data2.pengkajian_nyeri}']`).prop("checked",true);
					}
					$("input[name=jenis_kasusnya]").val("LAMA")
				}else{
					$("input[value='B']").prop("checked", true);
					$("input[name=jenis_kasusnya]").val("BARU")
					swal({
						title:"Tidak Ada Kasus Lama",
						type: result.status,
						text:'Anda Akan Dialihkan Ke Kasus Baru'
					});
				}
			});
		}else if(jns == "B"){
			$.post("{!! route('getKasusBaru') !!}",{rm: rm}).done(function(result){
				$("input[name=jenis_kasusnya]").val("BARU")
				if (result.data1) {
					var td = result.data1.tekanan_darah.split('/');
					$('input[name=agama]').val(result.data1.agama);
					$('input[name=pekerjaan]').val(result.data1.pekerjaan);
					$('input[name=frek_nadi]').val(result.data1.frek_nadi);
					$('input[name=suhu]').val(result.data1.suhu);
					$('input[name=frek_nafas]').val(result.data1.frek_nafas);
					$('input[name=berat_badan]').val(result.data1.berat_badan);
					$('input[name=tinggi_badan]').val(result.data1.tinggi_badan);
					$('input[name=lingkar_kepala]').val(result.data1.lingkar_kepala);
					$('input[name=imt]').val(result.data1.imt);
					$(`input[name=adi][value='${result.data1.adi}']`).prop("checked",true);
					$('#td1').val(td[0]);
					$('#td2').val(td[1]);
					$('select[name=pendidikan]').val(result.data1.pendidikan).change();
				}
				if (result.data2.length > 0) {
					$('select[name=kategori_pembayaran]').val(result.data2.kategori_pembayaran).change();
					$(`input[name=daftar_melalui][value='${result.data2.daftar_melalui}']`).prop("checked",true);
					$('textarea[name=keluhan_utama]').text(result.data2.keluhan_utama);
					$('input[name=suku]').val(result.data2.suku);
					$(`input[name=status_pernikahan][value='${result.data2.status_pernikahan}']`).prop("checked",true);
					$(`input[name=status_gizi][value='${result.data2.status_gizi}']`).prop("checked",true);
					$('input[name=riwayat_pengobatan]').val(result.data1.riwayat_pengobatan);
					$(`input[name=pengkajian_nyeri][value='${result.data2.pengkajian_nyeri}']`).prop("checked",true);
				}else{
					$(`input[name=status_gizi][value='Baik']`).prop("checked",true);
					$(`input[class=disableKL][value='Tenang']`).prop("checked",true);
					$(`input[name=pengkajian_nyeri][value='0']`).prop("checked",true);
					$("input[name=risiko_jatuh1][value='N']").prop("checked",true);
					$("input[name=risiko_jatuh2][value='N']").prop("checked",true);
					$("input[name=hasil_risiko_jatuh][value='Tidak']").prop("checked",true);
				}
			});
			$('input[name=kategori_lainnya]').hide();
			$('input[name=kategori_lainnya]').removeAttr('required');
		}
	});

	$('input[name=kategori_pembayaran]').change(function(){
		var kategori_pembayaran = $('input[name=kategori_pembayaran]:checked').val();
		if(kategori_pembayaran=='Lainnya'){
			$('input[name=kategori_lainnya]').show();
			$('input[name=kategori_lainnya]').attr('required','required');
		}else{
			$('input[name=kategori_lainnya]').hide();
			$('input[name=kategori_lainnya]').removeAttr('required');
		}
	});

	$('input[name=riwayat_kesehatan]').change(function(){
		var riwayat_kesehatan = $('input[name=riwayat_kesehatan]:checked').val();
		if(riwayat_kesehatan=='Y'){
			$('#dengan_sakit').show();
			$('input[name=sakit_opname]').attr('required','required');
		}else{
			$('#dengan_sakit').hide();
			$('input[name=sakit_opname]').removeAttr('required');
		}
	});

	$('input[name=riwayat_operasi]').change(function(){
		var riwayat_operasi = $('input[name=riwayat_operasi]:checked').val();
		if(riwayat_operasi=='Y'){
			$('#operasi_hari_ke').show();
			$('input[name=operasi_hari_ke]').attr('required','required');
		}else{
			$('#operasi_hari_ke').hide();
			$('input[name=operasi_hari_ke]').removeAttr('required');
		}
	});

	$('input[name=riwayat_kb]').change(function(){
		var riwayat_kb = $('input[name=riwayat_kb]:checked').val();
		if(riwayat_kb=='Y'){
			$('.kbY').show();
			$('input[name=operasi_hari_ke]').attr('required','required');
		}else{
			$('.kbY').hide();
			$('input[name=operasi_hari_ke]').removeAttr('required');
		}
	});

	$('input[name=jenis_kb]').change(function(){
		var jenis_kb = $('input[name=jenis_kb]:checked').val();
		if(jenis_kb=='Lain-lain'){
			$('#kb_lain').show();
			$('input[name=kb_lain]').attr('required','required');
		}else{
			$('#kb_lain').hide();
			$('input[name=kb_lain]').removeAttr('required');
		}
	});

	$('textarea[name=keluhan_utama]').change(function(){
		var kategori_pembayaran = $('input[name=kategori_pembayaran]:checked').val();
		if(kategori_pembayaran=='Lainnya'){
			$('input[name=anamnesis]').attr('required','required');
		}else{
			$('input[name=kategori_lainnya]').hide();
			$('input[name=kategori_lainnya]').removeAttr('required');
		}
	});

	var maximize = 1;
	$('#maximize').click(function(){
		if(maximize==1){
			maximize=0;
			$('#maximize').html('Minimize');
		}else{
			maximize=1;
			$('#maximize').html('Maximize');
		}
	});

	$('textarea[name=keluhan_utama]').keyup(function(){
		$('textarea[name=anamnesis]').text($.trim($("textarea[name=keluhan_utama]").val()));
	}); 

	function fisikKeyup(){
		var text = '';
		if ($('#td1').val() != '' || $('#td2').val() != '') {
			text += 'Tekanan darah: '+$('#td1').val()+'/'+$('#td2').val()+' mmHg\n';
		}
		if ($('#fNadi').val()!= '') {
			text += 'Frekuensi Nadi: '+$('#fNadi').val()+' x/menit\n';
		}
		if ($('#suh').val()!= '') {
			text += 'Suhu: '+$('#suh').val()+' °C \n';
		}
		if ($('#fNafas').val()!= '') {
			text += 'Frekuensi Nafas: '+$('#fNafas').val()+' x/menit\n';
		}
		$('textarea[name=pemeriksaanFisik]').text(text);
	}

		// CARI PERTANYAAN
		function cari_pertanyaan(){
			var tanya = $('textarea[name=rujuk3]').val();
			$('.tempat_tanya').html('');
			if(tanya!=''){
				// swal(tanya);
				$.post("{{route('cari_pertanyaan')}}",{tanya:tanya},function(data){
					var html = '';
					if(data.status=='success'){
						if(data.data.length>0){
							$.each(data.data,function(k,v){
								html+='<a href="javascript:void(0)" onclick="set_pertanyaan(\''+v.Rujuk+'\')">'+v.Rujuk+'</a><br>';
							});
						}
					}
					$('.tempat_tanya').html(html);
				});
			}
		}
		// END CARI PERTANYAAN
		// SET PERTANYAAN
		function set_pertanyaan(data){
			$('textarea[name=rujuk3]').val(data);
			$('.tempat_tanya').html('');
		}
		// END SET PERTANYAAN

		function diagnosaKeyUp(){
			var dt = $('#diagnosaUp').val();
			// swal('Asik');
			if(dt==''){
				$('#diagnosa-choice').html('');
			}else{
				$.post("{{url('diagnosaUp')}}",{data:dt},function(data){
					var html = '';
					if(data.status=='success'){
						if(data.data.length >0 ){
							html+='<p><i><b>(*) Klik</b> daftar diagnosa untuk memilih diagnosa</i></p>';
							$.each(data.data,function(data,value){
								html+='<p onclick="diagnosaChose(\''+value.KodeICD+'(+)'+value.Diagnosa+'\')" class="btn" style="background: #eee;padding:2px;margin-bottom: 5px">'+value.Diagnosa+'('+value.KodeICD+')</p>';
							});
						}else{
							html='<i><b>Tidak ada yang cocok</b></i>';
						}
						$('#diagnosa-choice').html(html);
					}
				});
			}
		}

		function tindakanKeyUp(){
			var dt = $('#tindakanUp').val();
			if(dt==''){
				$('#tindakan-choice').html('');
			}else{
				$.post("{{ route('tindakanUp') }}",{data:dt},function(data){
					var html = '';
					var des = [];
					if(data.status=='success'){
						if(data.data.length >0 ){
							html+='<p><i><b>(*) Klik</b> daftar tindakan untuk memilih tindakan</i></p>';
							var i=0;
							$.each(data.data,function(data,value){
								des[i] = value.Description.replace(/"/g,"\\\"");
								html+="<p onclick='tindakanChose(\""+value.Code+"(+)"+des[i]+"\")' class='btn' style='background: #eee;padding:2px;margin-bottom: 5px'>"+value.Description+"("+value.Code+")</p>";
								i++;
							});
						}else{
							html='<i><b>Tidak ada yang cocok</b></i>';
						}
						$('#tindakan-choice').html(html);
					}
				});
			}
		}

		function diagnosaChose(diag){
			var hasilDiagnosa ='';
			var isi = diag.split("(+)");
			simpanDiag += isi[1]+';';
			simpanKode += isi[0]+';';
			$('textarea[name=diagnosis3]').html(simpanDiag);
			$('textarea[name=icd103]').html(simpanKode);

			splitDiag = simpanDiag.split(';');
			splitKode = simpanKode.split(';');
			for (var i = 0; i < splitDiag.length-1; i++) {
				if (i == 0) {
					hasilDiagnosa += '<b><u>Diagnosa Primer:</u></b> &nbsp;<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+i+')">'+splitDiag[i]+'('+splitKode[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div><br>';
				}else{
					if (i == 1) {
						hasilDiagnosa += '<b><u>Diagnosa Sekunder:</u></b>&nbsp;';
					}
					hasilDiagnosa += '<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+i+')">'+splitDiag[i]+'('+splitKode[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
				}
			}
			$('#hasilDiagnosa').html(hasilDiagnosa);
			$('#diagnosa-choice').html('');
			$('#diagnosaUp').val('');
		}

		function tindakanChose(diag){
			var hasilDiagnosa ='';
			var isi = diag.split("(+)");
			simpanTindakan += isi[1]+';';
			simpanKod += isi[0]+';';
			$('textarea[name=tindakan3]').html(simpanTindakan);
			$('textarea[name=icd93]').html(simpanKod);

			splitTindakan = simpanTindakan.split(';');
			splitKod = simpanKod.split(';');
			for (var i = 0; i < splitTindakan.length-1; i++) {
				hasilDiagnosa += '<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteTindakan('+i+')">'+splitTindakan[i]+'('+splitKod[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
			}
			$('#hasilTindakan').html(hasilDiagnosa);
			$('#tindakan-choice').html('');
			$('#tindakanUp').val('');
		}

		jQuery(function($){
			$("input[name=tekanan_darah]").mask("9?99/9?99");
			$("input[name=frek_nadi]").mask("9?99");
			$("input[name=suhu]").mask("9?99");
			$("input[name=frek_nafas]").mask("9?99");
			$("input[name=skor_nyeri]").mask("9?99");
			$("input[name=skor_jatuh]").mask("9?99");
			$("input[name=skor_jatuh]").mask("9?99");
			$("input[name=berat_badan]").mask("9?99");
			$("input[name=tinggi_badan]").mask("9?99");
			$("input[name=lingkar_kepala]").mask("9?99");
			$("input[name=imt]").mask("9?99");
			$("input[name=discharge]").mask("9?99");
		});

		function executeCommands(){
			// var oShell = new ActiveXObject("Shell.Application");
			// var commandtoRun = "C:\\Windows\\Notepad.exe";

			// oShell.ShellExecute(commandtoRun, "", "", "open", "1");

			MyObject = new ActiveXObject( "WScript.Shell" )

			MyObject.Run("file:///D:/simars/simarseresep.exe") ;
		}
	</script>
	<script src="{!! url('adminAsset/js/ckeditor1/ckeditor.js') !!}"></script>
	<script src="{!! url('adminAsset/js/ckeditor1/adapters/jquery.js') !!}"></script>
	<script type="text/javascript">
		$( '#editor1' ).ckeditor({width:'100%', height: '400px', toolbar: [
		// { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: ['NewPage', 'Preview', 'Print', '-', 'Templates' ] },
		// { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		// { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-'] },
		// { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		// { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
		// { name: 'tools', items: [ 'Maximize' ] },
		// '/',
		// { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		// { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
		// { name: 'styles', items: [ 'Font', 'FontSize' ] },
		// { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		// { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
		CKEDITOR.env.isCompatible = true,
		]});
	</script>
	<script type="text/javascript">

		$(function() {
			$(".chzn-select").chosen();
		});;

		function deleteDiagnosa(i){
			swal({
				title: "Hapus Diagnosa",
				text: "Anda yakin?!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal',
				closeOnConfirm: true,
        //closeOnCancel: false
    },
    function(){
    	var hasilDiagnosa ='';
    	splitDiag = simpanDiag.split(';');
    	splitKode = simpanKode.split(';');
    	simpanDiag='';
    	simpanKode='';
    	for (var j = 0; j < splitDiag.length-1; j++) {
    		if(j!=i){
    			if (simpanDiag == '') {
    				hasilDiagnosa += '<b><u>Diagnosa Primer:</u></b> &nbsp;<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+j+')">'+splitDiag[j]+'('+splitKode[j]+')</a><div class="clearfix" style="margin-bottom: 10px"></div><br>';
    			}else{
    				if (simpanDiag.split(';').length == 2) {
    					hasilDiagnosa += '<b><u>Diagnosa Sekunder:</u></b>&nbsp;';
    				}
    				hasilDiagnosa += '<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+j+')">'+splitDiag[j]+'('+splitKode[j]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
    			}
    			simpanDiag+=splitDiag[j]+';';
    			simpanKode+=splitKode[j]+';';
		    		// hasilDiagnosa += '<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+j+')">'+splitDiag[j]+'('+splitKode[j]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
		    	}
		    }
		    console.log(simpanDiag)
		    $('textarea[name=diagnosis3]').html('');
		    $('textarea[name=icd103]').html('');
		    $('#hasilDiagnosa').html('');

		    $('textarea[name=diagnosis3]').html(simpanDiag);
		    $('textarea[name=icd103]').html(simpanKode);
		    $('#hasilDiagnosa').html(hasilDiagnosa);

		});
		}


		$('select[name=diagnosa_chose]').change(function(){
			var hasilDiagnosa ='';
			var kodeDiag = $('select[name=diagnosa_chose]').val();
			var isi = kodeDiag.split("(+)");
			simpanDiag += isi[1]+';';
			simpanKode += isi[0]+';';
			$('textarea[name=diagnosis3]').html(simpanDiag);
			$('textarea[name=icd103]').html(simpanKode);

			splitDiag = simpanDiag.split(';');
			splitKode = simpanKode.split(';');
			for (var i = 0; i < splitDiag.length-1; i++) {
				hasilDiagnosa += '<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+i+')">'+splitDiag[i]+'('+splitKode[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
			}
			$('#hasilDiagnosa').html(hasilDiagnosa);
		});

		function deleteTindakan(i){
			swal({
				title: "Hapus Tindakan",
				text: "Anda yakin?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal',
				closeOnConfirm: true,
				//closeOnCancel: false
			},
			function(){
				var hasilDiagnosa ='';
				splitTindakan = simpanTindakan.split(';');
				splitKod = simpanKod.split(';');
				simpanTindakan='';
				simpanKod='';
				for (var j = 0; j < splitTindakan.length-1; j++) {
					if(j==i){

					}else{
						simpanTindakan+=splitTindakan[j]+';';
						simpanKod+=splitKod[j]+';';
						hasilDiagnosa += '<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteTindakan('+j+')">'+splitTindakan[j]+'('+splitKod[j]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
					}
				}
				$('textarea[name=tindakan3]').html('');
				$('textarea[name=icd93]').html('');
				$('#hasilTindakan').html('');

				$('textarea[name=tindakan3]').html(simpanTindakan);
				$('textarea[name=icd93]').html(simpanKod);
				$('#hasilTindakan').html(hasilDiagnosa);

			});
		}

		$('select[name=tindakan_chose]').change(function(){
			var hasilDiagnosa ='';
			var kodeDiag = $('select[name=tindakan_chose]').val();
			var isi = kodeDiag.split("(+)");
			simpanTindakan += isi[1]+';';
			simpanKod += isi[0]+';';
			$('textarea[name=tindakan3]').html(simpanTindakan);
			$('textarea[name=icd93]').html(simpanKod);

			splitTindakan = simpanTindakan.split(';');
			splitKod = simpanKod.split(';');
			for (var i = 0; i < splitTindakan.length-1; i++) {
				hasilDiagnosa += '<a href="#" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteTindakan('+i+')">'+splitTindakan[i]+'('+splitKod[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
			}
			$('#hasilTindakan').html(hasilDiagnosa);
		});

		$('input[name=skrining_nyeri]').change(function(){
			var skrining_nyeri = $('input[name=skrining_nyeri]:checked').val();
			if(skrining_nyeri=='Ada'){
				$('input[name=skrining_nyeri_lain]').show();
				$('input[name=skrining_nyeri_lain]').attr('required','required');
			}else{
				$('input[name=skrining_nyeri_lain]').hide();
				$('input[name=skrining_nyeri_lain]').removeAttr('required');
			}
		});

		window.onload = function(){
			$('input[name=skrining_nyeri]').change(function(){
				var skrining_nyeri = $('input[name=skrining_nyeri]:checked').val();
				if(skrining_nyeri=='Ada'){
					$('input[name=skrining_nyeri_lain]').show();
					$('input[name=skrining_nyeri_lain]').attr('required','required');
				}else{
					$('input[name=skrining_nyeri_lain]').hide();
					$('input[name=skrining_nyeri_lain]').removeAttr('required');
				}
			});
		}

		function simpantahap3(redir){
			//deteksi kasus
			let kasus = $("input[name=jenis_kasus]:checked").val();

			$("#simpan_tahap").attr('disabled','disabled');
			$("#simpan_tahap").text('Loading...');
			var i = 0;
			if(kasus == "B"){
				if($('input[name=discharge').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					i++;
					swal('Discharge hari harus diisi')
				}
	
				if($('textarea[name=anamnesis]').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal('Anamnesis harus diisi');
					i++;
				}
	
				if($('input[name=bahasa_lain]').is(':visible')){
					var bahasa_lain = $('input[name=bahasa_lain]').val();
					if(bahasa_lain==''){
						$("#simpan_tahap").attr('disabled','disabled');
						$("#simpan_tahap").text('Loading...');
						swal('Hambatan bahasa harus diisi');
						i++;
					}
				}
	
				if($('input[name=frek_nadi]').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal('Frekuensi Nadi harus diisi');
					i++;
				}
				if($('input[name=suhu]').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal('Suhu harus diisi');
					i++;
				}
				if($('input[name=frek_nafas]').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal('Frekuensi Nafas harus diisi');
					i++;
				}
				if($('input[name=berat_badan]').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal('Berat Badan harus diisi');
					i++;
				}
				if($('input[name=tinggi_badan]').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal('Tinggi Badan harus diisi');
					i++;
				}
				if($('#td1').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal('Tekanan Darah harus diisi');
					i++;
				}
				if($('#td2').val()==''){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal('Tekanan Darah harus diisi');
					i++;
				}
			}
			
			//default 0 untuk antropomedi
			if($("#td1").val() == "" || $("#td1").val() == null){
				$("#td1").val(0);
			};
			if($("#td2").val() == "" || $("#td2").val() == null){
				$("#td2").val(0);
			};
			if($("input[name=frek_nadi]").val() == "" || $("input[name=frek_nadi]").val() == null){
				$("input[name=frek_nadi]").val(0);
			};
			if($("input[name=suhu]").val() == "" || $("input[name=suhu]").val() == null){
				$("input[name=suhu]").val(0);
			};
			if($("input[name=frek_nafas]").val() == "" || $("input[name=frek_nafas]").val() == null){
				$("input[name=frek_nafas]").val(0);
			};
			if($("input[name=berat_badan]").val() == "" || $("input[name=berat_badan]").val() == null){
				$("input[name=berat_badan]").val(0);
			};
			if($("input[name=tinggi_badan]").val() == "" || $("input[name=tinggi_badan]").val() == null){
				$("input[name=tinggi_badan]").val(0);
			};
			if($("input[name=lingkar_kepala]").val() == "" || $("input[name=lingkar_kepala]").val() == null){
				$("input[name=lingkar_kepala]").val(0);
			};
			if($("input[name=imt]").val() == "" || $("input[name=imt]").val() == null){
				$("input[name=imt]").val(0);
			};

			if(i==0){
				var data = $('form#tahap3').serialize();
				$.post("{!! route('simpanTahap3') !!}",data)
				.done(function(data){
					if(data.status=='success'){
						if(redir==0){
							window.location="{{route('content3')}}";
						}else{
							simpantahapEresep();
						}
					}else if(data.status == 'errortarif'){
						$("#simpan_tahap").removeAttr('disabled');
						$("#simpan_tahap").text('Simpan');
						swal("Warning !",'Terjadi Kesalahan Ketika Menyimpan Tarif Dan Tindakan, Silahkan Coba Lagi','warning');
					}else{
						if(redir==0){
							$("#simpan_tahap").removeAttr('disabled');
							$("#simpan_tahap").text('Simpan');
							swal("Warning !",'Tidak ada perubahan','warning');
						}else{
							simpantahapEresep();
						}
					}
				})
				.fail(function(err){
					$("#simpan_tahap").removeAttr('disabled');
					$("#simpan_tahap").text('Simpan');
					swal("Error !",'Terjadi Kesalahan Ketika Menyimpan Data','error');
				});;
			}

		}

		function simpantahapEresep(){
			//deteksi kasus
			let kasus = $("input[name=jenis_kasus]:checked").val();
			var i = 0;
			if(kasus == "B"){
				if($('input[name=discharge').val()==''){
					i++;
					swal('Discharge hari harus diisi')
				}
				if($('textarea[name=tindakan3]').val()!=''){
					var diag = $('textarea[name=tindakan3]').val().split(';');
					var kode = $('textarea[name=icd93]').val().split(';');
					if(kode.length==1){
						i++;
						swal('Jangan lupa Kode icd9 akhiri menggunakan ";"');
					}
					if(diag.length==1){
						i++;
						swal('Jangan lupa Tindakan akhiri menggunakan ";"');
					}
					if(diag.length!=kode.length){
						i++;
						swal('Tindakan dan Kode ICD jumlahnya ";" tidak sama');
					}
				}
	
				if($('textarea[name=diagnosis3]').val()!=''){
					var diag = $('textarea[name=diagnosis3]').val().split(';');
					var kode = $('textarea[name=icd103]').val().split(';');
					if(kode.length==1){
						i++;
						swal('Jangan lupa kode icd10 akhiri menggunakan ";"');
					}
					if(diag.length==1){
						i++;
						swal('Jangan lupa diagnosa akhiri menggunakan ";"');
					}
					if(diag.length!=kode.length){
						i++;
						swal('Diagnosa dan Kode ICD jumlahnya ";" tidak sama');
					}
				}else{
					swal('Diagnosa harus diisi');
					i++;
				}
	
				if($('textarea[name=anamnesis]').val()==''){
					swal('Anamnesis harus diisi');
					i++;
				}
	
				if($('input[name=bahasa_lain]').is(':visible')){
					var bahasa_lain = $('input[name=bahasa_lain]').val();
					if(bahasa_lain==''){
						swal('Hambatan bahasa harus diisi');
						i++;
					}
				}
			}

			//default 0 untuk antropomedi
			if($("#td1").val() == "" || $("#td1").val() == null){
				$("#td1").val(0);
			};
			if($("#td2").val() == "" || $("#td2").val() == null){
				$("#td2").val(0);
			};
			if($("input[name=frek_nadi]").val() == "" || $("input[name=frek_nadi]").val() == null){
				$("input[name=frek_nadi]").val(0);
			};
			if($("input[name=suhu]").val() == "" || $("input[name=suhu]").val() == null){
				$("input[name=suhu]").val(0);
			};
			if($("input[name=frek_nafas]").val() == "" || $("input[name=frek_nafas]").val() == null){
				$("input[name=frek_nafas]").val(0);
			};
			if($("input[name=berat_badan]").val() == "" || $("input[name=berat_badan]").val() == null){
				$("input[name=berat_badan]").val(0);
			};
			if($("input[name=tinggi_badan]").val() == "" || $("input[name=tinggi_badan]").val() == null){
				$("input[name=tinggi_badan]").val(0);
			};
			if($("input[name=lingkar_kepala]").val() == "" || $("input[name=lingkar_kepala]").val() == null){
				$("input[name=lingkar_kepala]").val(0);
			};
			if($("input[name=imt]").val() == "" || $("input[name=imt]").val() == null){
				$("input[name=imt]").val(0);
			};

			if(i==0){
				var data = $('form#tahap3').serialize();
				$.post("{!! route('simpanTahapResep') !!}",data,function(data){
					if(data.status=='success'){
						window.location="{{route('pembuatanObat')}}";
					}else{
						window.location="{{route('pembuatanObat')}}";
					}
				});
			}

		}

		$('#inputNamaPerawat').val("{!! $rekap->nama_perawat !!}")

		// $('input[name=bahasa_lain]').hide();
		$('#hambatanBahasa').change(function(){
			if($('input[name=bahasa_lain]').is(':visible')){
				$('input[name=bahasa_lain]').hide();
				$('input[name=bahasa_lain]').removeAttr('required');
			}else{
				$('input[name=bahasa_lain]').show();
				$('input[name=bahasa_lain]').attr('required','required');
			}
		});
		function upload(id){
			window.open("{!! url('rekap_medik/p5/') !!}/"+id);
		}
		function camera(id){
			window.open("{!! url('rekap_medik/p3/') !!}/"+id);
		}
		function edit(id){
			window.open("{!! url('rekap_medik/p1/') !!}/"+id);
		}

		function kirimRujukan(){
			var poli = $('select[name=poli_rujuk]').val();
			var rujuk = $('textarea[name=rujuk3]').val();
			var id_rekap = "{!! Session::get('id_rekap') !!}";
			var i=0;
			if(rujuk==''){
				swal('Rujukan hasrus diisi');
				i++;
			}
			if(poli==''){
				swal('Poli harus dipilih');
				i++;
			}
			if(i==0){
				$.post("{{route('simpanRujuk')}}",{rujuk:rujuk,poli:poli,id_rekap:id_rekap},function(data){
					if(data.status=='success'){
						$(".table_rujuk").load(location.href + " .table_rujuk>*", "");
						swal('Data berhasil dimasukkan');
					}
				});
			}
		}

		function hapusRujukan(id){
			swal({
				title: "Anda yakin?",
				text: "Data akan dihapus!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal',
				closeOnConfirm: false,
				//closeOnCancel: false
			},
			function(){
				$.post("{!! route('hapusRujuk') !!}",{id:id}).done(function(data){
					if(data.status=='success'){
						$(".table_rujuk").load(location.href + " .table_rujuk>*", "");
						swal('Data berhasil dihapus');
					}else{
						swal("Gagal!", "Data gagal dihapus!", "error");
					}
				});
			});
		}

		function detailRekapRJ(id){
			$.post("{!! route('modalDetRekap') !!}",{id:id}).done(function(data){
				if(data.status=='success'){
					$('.modal_layout_obat1').html(data.content);
					$('.modal_layout_obat1').show();
					$('#myModal').modal('show');
				}
			});
		}
	</script>
	@stop
