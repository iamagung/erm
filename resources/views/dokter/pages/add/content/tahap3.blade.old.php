<div class="col-lg-12 col-md-12 tahap3" style="padding: 0px">
	<!-- <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script> -->

	<?php
		$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
		$rekap2 = DB::table('rekam_medis_lanjutan')->where('rekam_medis_id',Session::get('id_rekap'))->first();
		$cat_bayar = DB::connection('rsu')->table('tm_setupall')->where('groups','Asuransi')->get();
		//getdata tarif dan tindakan untuk select option
		$kodepoli = DB::table('login_dokter')->where('user_id', Auth::user()->id )->first();
		$tnt1 = DB::connection('rsu')->table('tr_tindakan_m')->where('KodePoli', $kodepoli->poli_id)->get();
		$tnt2 = DB::connection('rsu')->table('tr_tindakan_m_')->where('KodePoli', $kodepoli->poli_id)->get();
		$tnt = $tnt1->merge($tnt2);
		
		//get data tarif dan tindakan jika sudah ada
		$data_tnt = DB::connection('rsu')->table('tr_rawatjalantindakan')
			->where('No_RM', $rekap->no_RM)
			->where('KodePoli', $kodepoli->poli_id)
			->where('No_Register', $rekap->no_Register)
			->get();
		if(count($data_tnt) > 0){
			$total_tnt = 0;
			foreach ($data_tnt as $key => $dt) {
				$total_tnt += (int)$dt->TarifTindakan;
			}
		}

	?>
	<form id="tahap3">
		<input type="hidden" name="nama" value="{!! $rekap->nama_perawat !!}">
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
				<div class="col-lg-8 col-md-8">
					<label style="font-weight: bold;font-size: 25px">I. Pengkajian Keperawatan</label>
					<i>(Klik <b>TAMPILKAN</b> untuk menampilkan data)</i>
				</div>
				<div class="col-lg-4 col-md-4">
					<button type="button" class="btn pull-right" id="maximize" data-toggle="collapse" data-target="#demo">Tampilkan</button>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
			</div>
			<div class="box-body">
				<div id="demo" class="collapse" style="height:0px">
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
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pendaftaran Melalui</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$check = ['checked',''];
								if (isset($rekap2)) {
									if($rekap2->daftar_melalui=='On'){
										$check= ['checked',''];
									} elseif($rekap2->daftar_melalui=='Off'){
										$check= ['','checked'];
									}
								}
								?>
								<label> <input type="radio" {!! $check[0] !!} name="" value="On" checked disabled> Online</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Off" name="" disabled> Offline</label>
								<input type="hidden" name="daftar_melalui" value="{{(isset($rekap2))?$rekap2->daftar_melalui:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Kategori Pembayaran</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<select class="form-control" name="" disabled>
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
									<option value="{{$cat->nilaichar}}" {{(isset($rekap2->kategori_pembayaran))?(($rekap2->kategori_pembayaran==$cat->nilaichar)?'selected':''):''}}>{{$cat->nilaichar}}</option>
									@endforeach
									<option value="Lainnya">LAINNYA</option>
								</select>
								<input type="hidden" name="kategori_pembayaran" value="{{(isset($rekap2))?$rekap2->kategori_pembayaran:''}}">
								<input type="text" name="kategori_lainnya" class="form-control" style="display: none;" value="{{(isset($rekap2->kategori_pembayaran))?$rekap2->kategori_pembayaran:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Keluhan Utama</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<textarea name="keluhan_utama" style="width: 100%;" readonly>{{(isset($rekap2->keluhan_utama))?$rekap2->keluhan_utama:''}}</textarea>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px;"></div>
					<hr>
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Riwayat Kesehatan</label>
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
								<label> <input type="radio" {!! $check[0] !!} name="" value="N" disabled> Tidak Pernah Opname</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Y" name="" disabled> Pernah Opname</label>
								<span id="dengan_sakit" style="{{$display1}}"><label style="margin-left: 10px">Dengan sakit: &nbsp; <input type="text" name="sakit_opname" value="{{(isset($rekap2->riwayat_kesehatan))?$rekap2->riwayat_kesehatan:''}}" readonly></label>
								<input type="hidden" name="riwayat_kesehatan" value="{{(isset($rekap2))?$rekap2->riwayat_kesehatan:''}}">
								</span>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Riwayat Operasi</label>
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
								<label> <input type="radio" {!! $check[0] !!} name="" disabled value="N"> Tidak</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Y" name="" disabled> Pernah Operasi</label>
								<span id="operasi_hari_ke" style="{{$display1}}"><label style="margin-left: 10px">Pasca operasi hari ke: &nbsp; <input type="text" name="operasi_hari_ke" value="{{(isset($rekap2->riwayat_operasi))?$rekap2->riwayat_operasi:''}}" readonly></label>
								</span>
								<input type="hidden" name="riwayat_operasi" value="{{(isset($rekap2))?$rekap2->riwayat_operasi:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Riwayat KB</label>
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
								<label> <input type="radio" {!! $check[0] !!} name="" disabled value="N"> Tidak</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Y" name="" disabled> Ya</label>
								<span id="lama_pemakaian" class="kbY" style="{!! $display1 !!}"><label style="margin-left: 10px">Lama Pemakaian: &nbsp; <input type="text" name="lama_pemakaian" value="{{(isset($rekap2->riwayat_kb)) ? $rekap2->riwayat_kb:''}}" readonly></label></span>
								<input type="hidden" name="riwayat_kb" value="{{(isset($rekap2))?$rekap2->riwayat_kb:''}}">
							</div>
						</div>
						<div class="form-group kbY" style="{!! $display1 !!}">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></label>
							<label class="col-lg-1 col-md-1 col-sm-12 col-xs-12">Jenis: </label>
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
								<label> <input type="radio" {!! $check[0] !!} name="" value="Suntik"> Suntik</label>
								<label> <input type="radio" {!! $check[1] !!} name="" value="Pil"> Pil</label>
								<label> <input type="radio" {!! $check[2] !!} name="" value="IUD"> IUD</label>
								<label> <input type="radio" {!! $check[3] !!} name="" value="MOW"> MOW</label>
								<label> <input type="radio" {!! $check[4] !!} name="" value="Implan"> Implan</label>
								<label> <input type="radio" {!! $check[5] !!} name="" value="Lain-lain"> Lain-lain</label>
								<span id="kb_lain" style="{!! $display1 !!}"><label><input type="text" name="kb_lain" value="{{(isset($rekap2->jenis_kb))?$rekap2->jenis_kb:''}}" readonly></label></span>
								<input type="hidden" name="jenis_kb" value="{{(isset($rekap2))?$rekap2->jenis_kb:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px;"></div>
					<div class="col-lg-12 col-md-12" style="">
						<div class="col-lg-4 col-md-4" style="padding: 0px">
							<div class="col-lg-12 col-md-12" style="border:1px solid #ccc;box-shadow: 0px 5px 5px #ccc;">
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<h3>Status Fisik</h3>
								</div>
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<table class="table table-bordered">
										<tr>
											<td>1. Tekanan Darah </td>
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
												<input readonly type="text" style="width:30%" onclick="this.select()" name="tekanan_darah[]" value="{!! $tekanan_darah[0] !!}">
												/
												<input readonly type="text" style="width:30%" onclick="this.select()" name="tekanan_darah[]" value="{!! $tekanan_darah[1] !!}">
												mmhg
											</td>
										</tr>
										<tr>
											<td>2. Frekuensi Nadi </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control form1" name="frek_nadi" value="{!! $rekap->frek_nadi !!}">x/menit</td>
										</tr>
										<tr>
											<td>3. Suhu </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control form1" name="suhu" value="{!! $rekap->suhu !!}">^C</td>
										</tr>
										<tr>
											<td>4. Frekuensi Nafas </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control form1" name="frek_nafas" value="{!! $rekap->frek_nafas !!}">x/menit</td>
										</tr>
										<tr>
											<td>5. GCS </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control form1" name="gcs" value=""></td>
										</tr>
										<!-- <tr>
											<td>5 Skor Nyeri </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control form1" name="skor_nyeri" value="{!! $rekap->skor_nyeri !!}"></td>
										</tr> -->
										<!-- <tr>
											<td>6 Skor Jatuh </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control form1" name="skor_jatuh" value="{!! $rekap->skor_jatuh !!}"></td>
										</tr> -->
									</table>
									<div class="clearfix" style="margin-bottom: 10px"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="col-lg-12 col-md-12" style="box-shadow: 0px 5px 5px #ccc;border: 1px solid #ccc;">
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<h3>Antropometri</h3>
								</div>
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<table class="table table-bordered">
										<tr>
											<td>1. Berat Badan </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control" name="berat_badan" value="{!! $rekap->berat_badan !!}"></td>
										</tr>
										<tr>
											<td>2. Tinggi Badan </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control" name="tinggi_badan" value="{!! $rekap->tinggi_badan !!}"></td>
										</tr>
										<tr>
											<td>3. Lingkar Kepala </td>
											<td><input readonly type="text" onclick="this.select()" class="form-control" name="lingkar_kepala" value="{!! $rekap->lingkar_kepala !!}"></td>
										</tr>
										<tr>
											<td>4. IMT <br/><i>*Khusus pediatri</i></td>
											<td><input readonly type="text" onclick="this.select()" class="form-control" name="imt" value="{!! $rekap->imt !!}"></td>
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
												<input type="checkbox" {!! $check !!} id="alatBantu" disabled value="ada">
												<input type="checkbox" style="display: none" {!! $check !!} id="alatBantu" name="alat_bantu" value="ada">
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
												<input type="checkbox" {!! $check !!} id="prothesa" disabled value="ada">
												<input type="checkbox" style="display: none" {!! $check !!} id="prothesa" name="prothesa" value="ada">
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
												<input type="checkbox" {!! $check !!} id="cacatTubuh" disabled value="ada">
												<input type="checkbox" style="display: none" {!! $check !!} id="cacatTubuh" name="cacat_tubuh" value="ada">
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
												<label> <input disabled type="radio" {!! $check[0] !!} value="mandiri"> Mandiri</label>
												<br/>
												<label> <input disabled type="radio" {!! $check[1] !!} value="dibantu"> Dibantu</label>
												<input type="hidden" name="adi" value="{{$rekap->adi}}">
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
												<label> <input type="radio" {!! $check[0] !!} disabled value="+"> +</label>
												<label style="margin-left: 20px"> <input type="radio" {!! $check[1] !!} disabled value="-"> -</label>
												<input type="hidden" name="riwayat_jatuh" value="{{$rekap->riwayat_jatuh}}">
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
														<label> <input type="radio" {!! $check[0] !!} id="adaSkriningNyeri" disabled value="Ada"> Ada</label>
													</div>
													<div class="col-lg-8 col-md-8">
														<input readonly type="text" name="skrining_nyeri_lain" class="form-control" style="border-radius: 10px !important;{!! $display !!}" value="{!! $rekap->skrining_nyeri !!}">
													</div>
												</div>
												<br/>
												<label> <input type="radio" {!! $check[1] !!} disabled value="Tidak"> Tidak</label>
												<input type="hidden" name="skrining_nyeri" value="{{$rekap->skrining_nyeri}}">
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
								<label> <input type="radio" {!! $check[0] !!} name="" disabled value="Buruk"> Buruk</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Kurang" name="" disabled> Kurang</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[2] !!} value="Baik" name="" disabled> Baik</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[3] !!} value="Lebih" name="" disabled> Lebih</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[4] !!} value="Obesitas" name="" disabled> Obesitas</label>
								<input type="hidden" name="status_gizi" value="{{(isset($rekap2))?$rekap2->status_gizi:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$stunting = '';
								$wasting = '';
								$k = ['', ''];
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
								<label> <input type="checkbox" {!! $stunting !!} value="Y" name="" disabled> Stunting</label><br>
								<label> <input type="checkbox" {!! $wasting !!} value="Y" name="" disabled> Wasting</label>
								<input type="hidden" name="stunting" value="{{$k[0]}}">
								<input type="hidden" name="wasting" value="{{$k[1]}}">
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
								<label> <input type="checkbox" {!! $check[0] !!} value="Tenang" name="status_psikologi[]" disabled> Tenang</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[1] !!} value="Cemas" name="" disabled> Cemas</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[2] !!} value="Sedih" name="" disabled> Sedih</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[3] !!} value="Depresi" name="" disabled> Depresi</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[4] !!} value="Marah" name="" disabled> Marah</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[5] !!} value="Hiperaktif" name="" disabled> Hiperaktif</label>
								<label style="margin-left: 20px"> <input type="checkbox" {!! $check[6] !!} value="Mengganggu Sekitar" name="" disabled> Mengganggu Sekitar</label>
								<label> <input type="checkbox" {!! $check[7] !!} value="Lain-lain" name="" disabled> Lain-lain <input type="text" name="status_psikologi_lain" value="{{$lain}}" readonly></label>
								<input type="hidden" name="status_psikologi" value="{{(isset($rekap))?$rekap->status_psikologi:''}}">
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
										<label> <input type="checkbox" {!! $check[0] !!} id="hambatanBahasa" value="Bahasa" disabled> Bahasa</label>
										<label style="display: none"> <input type="checkbox" {!! $check[0] !!} id="hambatanBahasa" name="hambatan[]" value="Bahasa"> Bahasa</label>
									</div>
									<div class="col-lg-8 col-md-8">
										<input type="text" name="bahasa_lain" class="form-control" style="border-radius: 10px !important;{!! $display !!}" value="{!! $bahasaval !!}" readonly>
									</div>
								</div><br/>
								<label> <input type="checkbox" {!! $check[1] !!} value="Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)" disabled> Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)</label>
								<label style="display: none"> <input type="checkbox" {!! $check[1] !!} name="hambatan[]" value="Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)"> Cacat/ Fisik/ Kognitif (Gangguan Penglihatan/ Pendengaran/ Lain)</label>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Agama/ Nilai Kepercayaan <b style="color:red">*</b></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$select = ['','','','','','',''];
								if($rekap->agama!='' || $rekap->agama!=null){
									switch ($rekap->agama) {
										case 'Islam':
										$select[0] = 'selected';
										break;
										case 'Kristen':
										$select[1] = 'selected';
										break;
										case 'Katolik':
										$select[2] = 'selected';
										break;
										case 'Hindu':
										$select[3] = 'selected';
										break;
										case 'Buddha':
										$select[4] = 'selected';
										break;
										case 'Kong Hu Cu':
										$select[5] = 'selected';
										break;
										case 'Lainnya':
										$select[6] = 'selected';
										break;

										default:
												# code...
										break;
									}
								}
								?>
								<select class="form-control" disabled>
									<option value="">..:: Pilih Agama ::..</option>
									<option {{$select[0]}} value="Islam">Islam</option>
									<option {{$select[1]}} value="Kristen">Kristen</option>
									<option {{$select[2]}} value="Katolik">Katolik</option>
									<option {{$select[3]}} value="Hindu">Hindu</option>
									<option {{$select[4]}} value="Buddha">Buddha</option>
									<option {{$select[5]}} value="Kong Hu Cu">Kong Hu Cu</option>
									<option {{$select[6]}} value="Lainnya">Lainnya</option>
								</select>
								<input type="hidden" name="agama" value="{{$rekap->agama}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Suku/Budaya <b style="color: red">(*)</b></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="suku" class="form-control" value="{{ (isset($rekap2->suku))?$rekap2->suku:''}}" readonly>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pendidikan <b style="color: red">(*)</b></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php
								$select = ['','','','','','','',''];
								if($rekap->pendidikan!='' || $rekap->pendidikan!=null){
									switch ($rekap->pendidikan) {
										case 'SD Se-derajat':
										$select[0] = 'selected';
										break;
										case 'SMP Se-derajat':
										$select[1] = 'selected';
										break;
										case 'SMA Se-derajat':
										$select[2] = 'selected';
										break;
										case 'DIII (Diploma)':
										$select[3] = 'selected';
										break;
										case 'S1 (Sarjana)':
										$select[4] = 'selected';
										break;
										case 'S2 (Master)':
										$select[5] = 'selected';
										break;
										case 'S3 (Doktoral)':
										$select[6] = 'selected';
										break;
										case 'Lainnya':
										$select[7] = 'selected';
										break;

										default:
												# code...
										break;
									}
								}
								?>
								<select class="form-control" disabled>
									<option value="">..:: Pilih Pendidikan ::..</option>
									<option {{$select[0]}} value="SD Se-derajat">SD Se-derajat</option>
									<option {{$select[1]}} value="SMP Se-derajat">SMP Se-derajat</option>
									<option {{$select[2]}} value="SMA Se-derajat">SMA Se-derajat</option>
									<option {{$select[3]}} value="DIII (Diploma)">DIII (Diploma)</option>
									<option {{$select[4]}} value="S1 (Sarjana)">S1 (Sarjana)</option>
									<option {{$select[5]}} value="S2 (Master)">S2 (Master)</option>
									<option {{$select[6]}} value="S3 (Doktoral)">S3 (Doktoral)</option>
									<option {{$select[7]}} value="Lainnya">Lainnya</option>
								</select>
								<input type="hidden" name="pendidikan" value="{{$rekap->pendidikan}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Pekerjaan <b style="color: red">(*)</b></label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="pekerjaan" class="form-control" value="{!! $rekap->pekerjaan !!}" readonly>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Status Pernikahan</label>
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
								<label> <input type="radio" {!! $check[0] !!} name="" disabled value="Menikah" > Sudah Menikah</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="Belum" name="" disabled> Belum Menikah</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[2] !!} value="Janda/Duda" name="" disabled> Janda/Duda</label>
								<input type="hidden" name="status_pernikahan" value="{{(isset($rekap2))?$rekap2->status_pernikahan:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Alergi </label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="alergi" class="form-control" value="{!! $rekap->alergi !!}" placeholder="Kosongi jika tidak ada alergi" readonly>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Riwayat Pengobatan </label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<input type="text" name="riwayat_pengobatan" class="form-control" value="{!! (isset($rekap2->riwayat_pengobatan))?$rekap2->riwayat_pengobatan:'' !!}" placeholder="Kosongi jika tidak ada riwayat pengobatan" readonly>
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
								<label> <input type="radio" {!! $check[0] !!} name="" disabled value="0"> Tidak Ada Nyeri (0)</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[1] !!} value="1-3" name="" disabled> Nyeri Ringan (1-3)</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[2] !!} value="4-6" name="" disabled> Nyeri Sedang (4-6)</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check[3] !!} value="7-10" name="" disabled> Nyeri Berat (7-10)</label>
								<input type="hidden" name="pengkajian_nyeri" value="{{(isset($rekap2))?$rekap2->pengkajian_nyeri:''}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Pengkajian Risiko Jatuh Time Up & Go Test (TUG):</label>
							<?php
								$check1=['',''];
								$check2=['',''];
								$check3=['','',''];
								$rsk = ['', '', ''];
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
								<label> <input type="radio" {!! $check1[0] !!} name="" disabled value="Y"> Ya</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check1[1] !!} value="N" name="" disabled> Tidak</label>
								<input type="hidden" name="risiko_jatuh1" value="{{$rsk[0]}}">
							</div>
							<label class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></label>
							<label class="col-lg-9 col-md-9 col-sm-12 col-xs-12">b. Apakah pasien memegang pinggiran kursi / meja / benda lain sebagai penopang saat duduk?</label>
							<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<label> <input type="radio" {!! $check2[0] !!} name="" disabled value="0"> Ya</label>
								<label style="margin-left: 10px"> <input type="radio" {!! $check2[1] !!} value="N" name="" disabled> Tidak</label>
								<input type="hidden" name="risiko_jatuh2" value="{{$rsk[1]}}">
							</div>
							<label class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></label>
							<label class="col-lg-3 col-md-3 col-sm-12 col-xs-12">HASIL:</label>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<label> <input type="radio" {!! $check3[0] !!} name="" disabled value="Tidak"> Tidak Berisiko (Tidak ditemukan a dan b)</label><br>
								<label> <input type="radio" {!! $check3[1] !!} name="" disabled value="Sedang"> Risiko Rendah (Ditemukan salah satu a dan b)</label><br>
								<label> <input type="radio" {!! $check3[2] !!} name="" disabled value="Tinggi"> Risiko Tinggi (Ditemukan a dan b)</label>
								<input type="hidden" name="hasil_risiko_jatuh" value="{{$rsk[2]}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<!-- <div class="form-group">
							<label class="col-lg-4 col-md-4 col-sm-12 col-xs-12">Discharge Planning <b style="color: red">(*)</b></label>
							<div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
								<input type="text" name="discharge" class="form-control" value="{!! $rekap->discharge !!}">
							</div>
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
								Hari
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div> -->
					</div>
					<div class="clearfix" style="margin-bottom: 20px"></div>
				</div>
			</div>
		</div>

		<!-- Pengkajian Medis -->
		<div class="clearfix" style="margin-bottom: 20px"></div>
		@if($rekap->alergi!='')
		@if($rekap->alergi!='-')
		<div class="col-lg-12 col-md-12" style="background:red;padding:0px;margin:0px;z-index: 1;">&nbsp;</div>
		@endif
		@endif
		<div class="box box-success">
			<div class="box-heading">
				<div class="col-lg-8 col-md-8">
					<label style="font-weight: bold;font-size: 25px">II. Pengkajian Medis</label>
				</div>
				<div class="clearfix" style="margin-bottom: 10px"></div>
			</div>
			<div class="box-body">
					<div class="col-lg-12 col-md-12" style="padding: 0px">
						<div class="col-lg-6 col-md-6">
							<h3 class="col-lg-12 col-md-12" style="padding: 0; margin: 0; text-align: center;"><b>S O A P<sup style="color: red;">*</sup></b></h3>
							<div class="clearfix"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-12 col-md-12" style="padding:0px">Anamnesis (S) <font color="red">*</font> @if(Auth::User()->level != '3')<i class="fa fa-camera pull-right" onclick="camera(5)"></i><i class="fa fa-edit pull-right" onclick="edit(5)"></i><i class="fa fa-upload pull-right" onclick="upload(5)"></i>@endif</label>
								<div class="clearfix"></div>
								<?php if($rekap->foto_anamnesis!=''){ ?>
									<div class="col-lg-12 col-md-12">
										<img src="{{asset($rekap->foto_anamnesis)}}" style="width: 100%">
									</div>
									<div class="clearfix"></div>
								<?php } ?>
								<textarea class="form-control" placeholder="Anamnesis (S)" name="anamnesis">{{$rekap->anamnesis}}</textarea>
							</div>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-12 col-md-12" style="padding:0px">Pemeriksaan Fisik (O) @if(Auth::User()->level != '3')<i class="fa fa-camera pull-right" onclick="camera(7)"></i><i class="fa fa-edit pull-right" onclick="edit(7)"></i><i class="fa fa-upload pull-right" onclick="upload(7)"></i>@endif</label>
								<div class="clearfix"></div>
								<?php
								if($rekap->fotoPemeriksaanFisik!=''){
									?>
									<div class="col-lg-12 col-md-12">
										<img src="{{asset($rekap->fotoPemeriksaanFisik)}}" style="width: 100%">
									</div>
									<div class="clearfix"></div>
									<?php
								}
								?>
								<textarea class="form-control" placeholder="Pemeriksaan Fisik (O)" name="pemeriksaanFisik">{{$rekap->pemeriksaanFisik}}</textarea>
							</div>
							<!-- <div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-12 col-md-12" style="padding:0px">Diagnosis (A) </label>
								<div class="clearfix"></div>
								<textarea class="form-control" placeholder="Diagnosis (A)" name="diagnosis_tambahan">{{$rekap->diagnosis_tambahan}}</textarea>
							</div> -->
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<label class="col-lg-12 col-md-12" style="padding: 0px">Alergi<font color="red">**</font></label>
							<div class="clearfix"></div>
							<input class="form-control" value="{{(isset($rekap->alergi))?$rekap->alergi:''}}" disabled>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								Kesan Status Gizi
								<?php
								$check = ['','','','',''];
								if($rekap->kesan_gizi!=''){
									$st = explode("+", $rekap->kesan_gizi);
									for ($i=0; $i < count($st)-1; $i++) {
										switch ($st[$i]) {
											case '1':
											$check[0]='checked';
											break;
											case '2':
											$check[1]='checked';
											break;
											case '3':
											$check[2]='checked';
											break;
											case '3':
											$check[3]='checked';
											break;
											case '3':
											$check[4]='checked';
											break;

											default:
											# code...
											break;
										}
									}
								}
								?>
								<br/><label><input type="radio" {{$check[0]}} name="gizi" value="1">Buruk</label>
								<br/><label><input type="radio" {{$check[1]}} name="gizi" value="2">Kurang</label>
								<br/><label><input type="radio" {{$check[2]}} name="gizi" value="3">Baik</label>
								<br/><label><input type="radio" {{$check[3]}} name="gizi" value="4">Lebih</label>
								<br/><label><input type="radio" {{$check[4]}} name="gizi" value="5">Obesitas</label>
							</div>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-12 col-md-12" style="padding: 0px">Diagnosa ICD 10 (A) <font color="red">*</font><i class="fa fa-camera pull-right" onclick="camera(1)"></i><i class="fa fa-edit pull-right" onclick="edit(1)"></i><i class="fa fa-upload pull-right" onclick="upload(1)"></i></label>
								<div class="col-lg-8 col-md-8" style="padding: 0px">
									<div class="clearfix"></div>
									<?php
									if($rekap->fotodiagnosa!=''){
										?>
										<div class="col-lg-12 col-md-12">
											<img src="{!! asset($rekap->fotodiagnosa) !!}" style="width: 100%">
										</div>
										<div class="clearfix"></div>
										<?php
									}
									?>
									<textarea style="display: none" class="form-control" style="display: block" placeholder="Text Here" name="diagnosis3">{{$rekap->diagnosa}}</textarea>
								</div>
								<div class="col-lg-4 col-md-4" style="padding: 0px">
									<div class="clearfix"></div>
									<textarea style="display: none" class="form-control" style="display: block" placeholder="Text Here" name="icd103">{{$rekap->icd10}}</textarea>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<input type="text" id="diagnosaUp" onclick="this.select()" onkeyup="diagnosaKeyUp()" class="form-control" placeholder="Diagnosa" style="margin-bottom: 10px">
									<div id="diagnosa-choice" class="col-lg-12 col-md-12" style="padding: 0px;max-height: 300px;overflow: auto"></div>
									<!-- <select class="chzn-select form-control" name="diagnosa_chose">
									<option value="" selected>..:: Diagnosa ::..</option>
										<?php
										$diag = DB::connection('rsu')->table('tm_diagnosa_bpjs')->get();
										foreach ($diag as $key) { ?>
										  <option value="{!! $key->KodeICD.'(+)'.$key->Diagnosa !!}">{!! $key->KodeICD.' '.$key->Diagnosa !!}</option>
										  <?php
										}
										?>
									</select> -->
								</div>
							</div>
							<i><b>Klik</b> daftar diagnosa untuk menghapus diagnosa</i>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" id="hasilDiagnosa" style="padding: 0px;display: block">
								<?php
								if($rekap->diagnosa!=''){
									$diag = explode(';', $rekap->diagnosa);
									$kodeicd10  = explode(';', $rekap->icd10);
									for ($i=0; $i < count($diag)-1; $i++) {
										?>
										@if($i==0)
										<b><u>Diagnosa Primer:</u></b>&nbsp;<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa({{$i}})">
											{{$diag[$i]}} ({{$kodeicd10[$i]}})
										</a><br>
										@else
										@if($i==1)
										<b><u>Diagnosa Sekunder:</u></b>&nbsp;
										@endif
										<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa({{$i}})">
											{{$diag[$i]}} ({{$kodeicd10[$i]}})
										</a>
										@endif
										<div class="clearfix" style="margin-bottom: 10px"></div>
										<?php
									}
								}
								?>
							</div>

							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<div class="col-lg-8 col-md-8" style="padding: 0px">
									<label class="col-lg-12 col-md-12" style="padding: 0px">Tindakan (Kode ICD 9 CM)</label>
									<div class="clearfix"></div>
									<textarea style="display: none" class="form-control" placeholder="Text Here" name="tindakan3">{{$rekap->tindakan}}</textarea>
								</div>
								<div class="col-lg-4 col-md-4" style="padding: 0px">
									<!-- <label>Kode ICD 9</label>  -->
									<div class="clearfix"></div>
									<textarea style="display: none" class="form-control" placeholder="Text Here" name="icd93">{{$rekap->icd9}}</textarea>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<input type="text" id="tindakanUp" onclick="this.select()" onkeyup="tindakanKeyUp()" class="form-control" placeholder="Tindakan" style="margin-bottom: 10px">
									<div id="tindakan-choice" class="col-lg-12 col-md-12" style="padding: 0px;max-height: 300px;overflow: auto"></div>
									<!--
									<select class="chzn-select form-control" name="tindakan_chose">
										<option value="" selected>..:: Tindakan ::..</option>
											<?php
											$tind = DB::table('refprocedure')->get();
											foreach ($tind as $key) {
											  ?>
											  <option value="{!! $key->Code.'(+)'.$key->Description !!}">{!! $key->Code.' '.$key->Description !!}</option>
											  <?php
											}
											?>
									</select>-->
								</div>
							</div>

							<i><b>Klik</b> daftar tindakan untuk menghapus tindakan</i>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" id="hasilTindakan" style="padding: 0px;display: block">
								<?php
								if($rekap->tindakan!=''){
									$diag = explode(';', $rekap->tindakan);
									$kodeicd10  = explode(';', $rekap->icd9);
									for ($i=0; $i < count($diag)-1; $i++) {
										?>
										<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteTindakan({{$i}})">{{$diag[$i]}} ({{$kodeicd10[$i]}})</a><div class="clearfix" style="margin-bottom: 10px"></div>
										<?php
									}
								}
								?>
							</div>

							<div class="clearfix" style="margin-bottom: 10px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<label class="col-lg-12 col-md-12" style="padding: 0px">Rencana dan terapi (P) @if(Auth::User()->level != '3')<i class="fa fa-camera pull-right" onclick="camera(6)"></i><i class="fa fa-edit pull-right" onclick="edit(6)"></i><i class="fa fa-upload pull-right" onclick="upload(6)"></i>@endif</label>
								<div class="clearfix"></div>
								<?php
								if($rekap->foto_rencana!=''){
									?>
									<div class="col-lg-12 col-md-12">
										<img src="{{asset($rekap->foto_rencana)}}" style="width: 100%">
									</div>
									<div class="clearfix"></div>
									<?php
								}
								?>
								<textarea class="form-control" placeholder="Text Here" name="rencana3">{{$rekap->rencana_terapi}}</textarea>
							</div>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<label class="col-lg-12 col-md-12" style="padding: 0px">Instruksi PPA Termasuk Pasca Bedah</label>
							<div class="clearfix"></div>
							<textarea class="form-control" placeholder="Instruksi Ditulis dengan Rinci Dan Jelas (Kosongi jika tidak ada instruksi)" name="instruksi_ppa">{{(isset($rekap2->instruksi_ppa))?$rekap2->instruksi_ppa:''}}</textarea>
							<div class="clearfix" style="margin-bottom: 10px"></div>
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
									{{-- tarif dan tindakan default untuk dokter --}}
									{{-- @if($rekap->aksi_dokter == 0)
										@foreach ($tnt as $key => $dt)
											@if($dt->NamaTindakan == "Konsultasi ke Dokter Spesialis")
												<tr id="tempat_tnt_{{substr($dt->KodeTindakan,-3)}}">
													<input type="hidden" name="idtindakan[]" value="">
													<input type="hidden" name="kode_tindakan[]" value="{{$dt->KodeTindakan}}">
													<input type="hidden" name="nama_tindakan[]" value="{{$dt->NamaTindakan}}">
													<input type="hidden" name="kode_poli[]" value="{{$dt->KodePoli}}">
													<input type="hidden" name="tarif_tindakan[]" value="{{$dt->Total}}">
													<td>{{$dt->NamaTindakan}}</td>
													<td>Rp. {{(int)($dt->Total)}}</td>
													<td style="text-align: center;"><a href="javascript:void(0);" class="btn btn-danger" onclick="hapus_tindakan({{substr($dt->KodeTindakan,-3) . ',' . (int)($dt->Total)}})">Hapus</a></td>
												</tr>
											@endif
										@endforeach
									@endif --}}
									@if(count($data_tnt) > 0)
										@foreach ($data_tnt as $key => $dt)
											<tr id="tempat_tnt_{{$dt->RwID}}">
												<input type="hidden" name="idtindakan[]" value="{{$dt->RwID}}">
												<input type="hidden" name="kode_tindakan[]" value="{{$dt->KodeTindakan}}">
												<input type="hidden" name="nama_tindakan[]" value="{{$dt->NamaTindakan}}">
												<input type="hidden" name="kode_poli[]" value="{{$dt->KodePoli}}">
												<input type="hidden" name="tarif_tindakan[]" value="{{$dt->TarifTindakan}}">
												<td>{{$dt->NamaTindakan}}</td>
												<td>Rp. {{(int)($dt->TarifTindakan)}}</td>
												<td style="text-align: center;"><a href="javascript:void(0);" class="btn btn-danger" onclick="hapus_tindakan({{$dt->RwID . ',' . (int)($dt->TarifTindakan)}})">Hapus</a></td>
											</tr>
										@endforeach
										@foreach ($tnt as $key => $dt)
											@if($dt->NamaTindakan == "Konsultasi ke Dokter Spesialis")
												<tr id="tempat_tnt_{{substr($dt->KodeTindakan,-3)}}">
													<input type="hidden" name="idtindakan[]" value="">
													<input type="hidden" name="kode_tindakan[]" value="{{$dt->KodeTindakan}}">
													<input type="hidden" name="nama_tindakan[]" value="{{$dt->NamaTindakan}}">
													<input type="hidden" name="kode_poli[]" value="{{$dt->KodePoli}}">
													<input type="hidden" name="tarif_tindakan[]" value="{{$dt->Total}}">
													<td>{{$dt->NamaTindakan}}</td>
													<td>Rp. {{(int)($dt->Total)}}</td>
													<td style="text-align: center;"><a href="javascript:void(0);" class="btn btn-danger" onclick="hapus_tindakan({{substr($dt->KodeTindakan,-3) . ',' . (int)($dt->Total)}})">Hapus</a></td>
												</tr>
											@endif
										@endforeach
									@else
										@foreach ($tnt as $key => $dt)
											@if($dt->NamaTindakan == "Konsultasi ke Dokter Spesialis")
												<tr id="tempat_tnt_{{substr($dt->KodeTindakan,-3)}}">
													<input type="hidden" name="idtindakan[]" value="">
													<input type="hidden" name="kode_tindakan[]" value="{{$dt->KodeTindakan}}">
													<input type="hidden" name="nama_tindakan[]" value="{{$dt->NamaTindakan}}">
													<input type="hidden" name="kode_poli[]" value="{{$dt->KodePoli}}">
													<input type="hidden" name="tarif_tindakan[]" value="{{$dt->Total}}">
													<td>{{$dt->NamaTindakan}}</td>
													<td>Rp. {{(int)($dt->Total)}}</td>
													<td style="text-align: center;"><a href="javascript:void(0);" class="btn btn-danger" onclick="hapus_tindakan({{substr($dt->KodeTindakan,-3) . ',' . (int)($dt->Total)}})">Hapus</a></td>
												</tr>
											@endif
										@endforeach
									@endif
									<tr id="default_title_tarif">
										<td colspan="4" style="text-align: center;">Tidak Ada Data Tarif Dan Tindakan</td>
									</tr>
									<tr id="total_tarif_head">
										<td colspan="2" style="text-align: center;"><strong>Total Tarif</strong></td>
										@if(count($data_tnt) > 0)
											@foreach ($tnt as $key => $dt)
												@if($dt->NamaTindakan == "Konsultasi ke Dokter Spesialis")
													<td id="total_tnt" colspan="2" style="text-align: center;">Rp. {{(int) $dt->Total + (int) $total_tnt}}</td>
													<input type="hidden" name="total_tarif_tindakan" id="total_tarif_tindakan" value="{{(int) $dt->Total + (int) $total_tnt}}">
												@endif
											@endforeach
											{{-- <td id="total_tnt" colspan="2" style="text-align: center;">Rp. {{$total_tnt}}</td>
											<input type="hidden" name="total_tarif_tindakan" id="total_tarif_tindakan" value="{{$total_tnt}}"> --}}
										@else
											@foreach ($tnt as $key => $dt)
												@if($dt->NamaTindakan == "Konsultasi ke Dokter Spesialis")
													<td id="total_tnt" colspan="2" style="text-align: center;">Rp. {{(int) $dt->Total}}</td>
													<input type="hidden" name="total_tarif_tindakan" id="total_tarif_tindakan" value="{{$dt->Total}}">
												@endif
											@endforeach
											{{-- <td id="total_tnt" colspan="2" style="text-align: center;"></td>
											<input type="hidden" name="total_tarif_tindakan" id="total_tarif_tindakan" value=""> --}}
										@endif
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<label>Riwayat Kunjungan Pasien</label>
							<div style="overflow: auto;max-height:400px">
								<?php
								$rekap1 = DB::table('rekap_medik')->where('no_RM',Session::get('no_RM'))->orderBy('tanggalKunjungan','DESC')->limit(30)->get();
								?>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Tanggal kunjungan</th>
											<th>Diagnosa</th>
											<th>ICD 10</th>
											<th>Tindakan & Obat-obatan</th>
											<th>Icd 9 cm</th>
											<th>Poli</th>
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
														Obat-obatan
														<ol>
															<?php
															$obat = DB::connection('rsu')->table('tr_rawatjalanobat')->where('No_Register',$key->no_Register)->get();
															if(count($obat)!=0){
																foreach ($obat as $keyO) {
																	echo '<li>'.$keyO->NamaBrg.' <b>( '.$keyO->Jml.' '.$keyO->Satuan.')</b></li>';
																}
															}
															?>
														</ol>
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
							<div class="clearfix" style="margin-bottom: 20px"></div>
							<label>Rujukan/ Konsultasi</label>
							<div class="table_rujuk">
								<?php
								$rujukan = DB::table('rujukan_rm')->where('rekapMedik_id',Session::get('id_rekap'))->get();
								if(count($rujukan)!=0){
									?>
									Hasil rujukan
									<table class="table table-bordered">
										<tr>
											<th>Rujukan</th>
											<th>Hasil Rujukan</th>
										</tr>
										<?php
										foreach ($rujukan as $key) {
											?>
											<tr>
												<td>
													{!! $key->Rujuk !!}
													<br/>
													<a href="javascript:void(0);" onclick="hapusRujukan('{{$key->id_rujukan}}')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
												</td>
												<td>
													<p>Poli <b>{{$key->NamaPoli}}</b></p>
													<p>Dokter <b>{{$key->DokterPoli}}</b></p>
													<p>Hasil</p>
													<p><b>{{$key->HasilRujuk}}</b></p>
												</td>
											</tr>
											<?php
										}
										?>
									</table>
									<div class="clearfix" style="margin-bottom: 10px"></div>
									<?php
								}
								?>
							</div>
							<div class="col-lg-12 col-md-12" style="border: 1px solid #ccc">
								<div class="clearfix" style="margin-bottom: 10px"></div>
								Dirujuk/ Konsul ke
								<div class="clearfix" style="margin-bottom: 10px"></div>
								<div class="col-lg-12 col-md-12" style="padding: 0px">
									<div class="col-lg-12 col-md-12" style="padding: 0px">
										<select class="chzn-select form-control" name="poli_rujuk">
											<option value="" selected>..:: Nama Poli ::..</option>
											<?php
											$poli = DB::connection('rsu')->table('tm_poli')->get();
											foreach ($poli as $key) {
												?>
												<option value="{!! $key->KodePoli !!}">{!! $key->NamaPoli !!}</option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="clearfix" style="margin-bottom: 10px"></div>
								<textarea id="editor1" class="form-control" placeholder="Text Here" name="rujuk3">{{$identitas->tanya}}</textarea>
								<div class="clearfix" style="margin-bottom: 10px"></div>
								<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="kirimRujukan()">Kirim rujukan</a>
								<div class="clearfix" style="margin-bottom: 10px"></div>
							</div>
							<div class="clearfix" style="margin-bottom: 20px"></div>
							<div class="col-lg-12 col-md-12" style="padding: 0px">
								<div class="col-lg-6 col-md-6" style="padding: 0px">
									<label class="">Kunjungan Kontrol</label>
									<div class="">
										<input type="date" name="tgl_kontrol" id="tgl_kontrol" class="form-control" style="width: 100% !important" value="{{$rekap->tgl_kontrol}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<label class="">Discharge Planning</label>
									<div class="">
										<input type="text" name="discharge" class="form-control" value="{!! $rekap->discharge !!}" style="width: 85% !important; display:inline !important"> <span>Hari</span>
									</div>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<label class="">Rawat Inap<font color="red">*</font></label>
							<div class="">
								<?php
								$check = ['checked',''];
								if (isset($rekap2->is_ranap)) {
									if($rekap2->is_ranap=='N'){
										$check= ['checked',''];
									} elseif($rekap2->is_ranap=='Y'){
										$check= ['','checked'];
									}
								}
								?>
								<label> <input type="radio" name="is_ranap" value="N" checked {!! $check[0] !!}> Tidak</label>
								<label style="margin-left: 10px"> <input type="radio" value="Y" name="is_ranap" {!! $check[1] !!}> Ya</label>
							</div>
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<!-- <label class="">Obat (E-Resep)</label> -->
							<!-- <div class="col-lg-12 col-md-12 tahap5" style="padding: 0px"> -->
								<!-- <?php
								$resep = DB::connection('rsu')->table('tr_rawatjalanobat')->where('No_Register',$rekap->no_Register)->get();
								?>
								Obat E-Resep
								<a href="javascript:void(0)" onclick="simpantahap3(1)" id="simpan_eresep" class="btn btn-sm btn-primary">E Resep</a> -->
								<!-- <table class="table table-bordered" style="background: #fff">
									<thead>
										<tr>
											<th>Nama Obat</th>
											<th>Qty</th>
										</tr>
									</thead>
									<tbody>
									<?php
									if(count($resep)==0){
										?>
										<tr>
											<td colspan="2">Belum ada resep d e-resep</td>
										</tr>
										<?php
									}else{
										foreach ($resep as $key) {
											?>
											<tr>
												<td>{{$key->NamaBrg}}</td>
												<td>{{$key->Jml.' '.$key->Satuan}}</td>
											</tr>
											<?php
										}
									}
									?>
									</tbody>
								</table> -->
							<!-- </div> -->
						</div>
						<div class="clearfix" style="margin-bottom: 20px"></div>
						@if($umurcust >= 65)
							<label for="pengkajian_paripurna">Pasien ini berstatus geriatri, apakah anda ingin mengakses form "Pengkajian Paripurna"? <a href="javascript:void(0)" class="btn-success" style="padding-left:10px; padding-right:10px;" id="show_geriatri">Ya</a></label>
						@endif
						<div class="col-md-12 formGeriatri">
							@include('dokter.pages.form.formGeriatri')
						</div>
					</div>

					<div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="col-lg-12 col-md-12" style="text-align: center;">
						<a href="javascript:void(0);" class="btn btn-success" id="simpan_tahap" onclick="simpantahap3(0)">Simpan</a>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>
			</div>
		</div>
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
		$("#tarif_tindakan").select2();
		$(".formGeriatri").hide();
		$("#default_title_tarif").hide();

		var gizi = `{{(isset($rekap2))?$rekap2->status_gizi:''}}`;
		if (gizi == 'Buruk') {
			$("input[name=gizi][value='1']").prop("checked", true);
		} else if(gizi == 'Kurang'){
			$("input[name=gizi][value='2']").prop("checked", true);
		} else if(gizi == 'Baik'){
			$("input[name=gizi][value='3']").prop("checked", true);
		} else if(gizi == 'Lebih'){
			$("input[name=gizi][value='4']").prop("checked", true);
		} else if(gizi == 'Obesitas'){
			$("input[name=gizi][value='5']").prop("checked", true);
		}
	});
	$("#show_geriatri").click(function (e) { 
		e.preventDefault();
		$(".formGeriatri").show();
		$("#show_geriatri").hide();
	});
	$("#hide_geriatri").click(function (e) { 
		e.preventDefault();
		$(".formGeriatri").hide();
		$("#show_geriatri").show();
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
	var maximize = 1;
	$('#maximize').click(function(){
		if(maximize==1){
			maximize=0;
			$('#maximize').html('Tutup');
		}else{
			maximize=1;
			$('#maximize').html('Tampilkan');
		}
	});

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
		    	hasilDiagnosa += '<b><u>Diagnosa Primer:</u></b> &nbsp;<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+i+')">'+splitDiag[i]+'('+splitKode[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div><br>';
    		}else{
    			if (i == 1) {
			    	hasilDiagnosa += '<b><u>Diagnosa Sekunder:</u></b>&nbsp;';
			    }
		    	hasilDiagnosa += '<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+i+')">'+splitDiag[i]+'('+splitKode[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
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
				hasilDiagnosa += '<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteTindakan('+i+')">'+splitTindakan[i]+'('+splitKod[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
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
    				hasilDiagnosa += '<b><u>Diagnosa Primer:</u></b> &nbsp;<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+j+')">'+splitDiag[j]+'('+splitKode[j]+')</a><div class="clearfix" style="margin-bottom: 10px"></div><br>';
    			}else{
    				if (simpanDiag.split(';').length == 2) {
    					hasilDiagnosa += '<b><u>Diagnosa Sekunder:</u></b>&nbsp;';
    				}
    				hasilDiagnosa += '<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+j+')">'+splitDiag[j]+'('+splitKode[j]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
    			}
    			simpanDiag+=splitDiag[j]+';';
    			simpanKode+=splitKode[j]+';';
		    		// hasilDiagnosa += '<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+j+')">'+splitDiag[j]+'('+splitKode[j]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
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
				hasilDiagnosa += '<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteDiagnosa('+i+')">'+splitDiag[i]+'('+splitKode[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
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
						hasilDiagnosa += '<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteTindakan('+j+')">'+splitTindakan[j]+'('+splitKod[j]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
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
				hasilDiagnosa += '<a href="javascript:void(0);" class="btn-sm btn-danger" style="margin-bottom: 15px;margin-right: 5px;line-height: 10px" onclick="deleteTindakan('+i+')">'+splitTindakan[i]+'('+splitKod[i]+')</a><div class="clearfix" style="margin-bottom: 10px"></div>';
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
			if(redir == 0){
				$("#simpan_tahap").attr('disabled','disabled');
				$("#simpan_tahap").text('Loading...');
				$("#simpan_eresep").attr('disabled','disabled');
			}else{
				$("#simpan_eresep").attr('disabled','disabled');
				$("#simpan_eresep").text('Loading...');
				$("#simpan_tahap").attr('disabled','disabled');
			}
			var i = 0;

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

			if(i==0){
				var data = $('form#tahap3').serialize();
				$.post("{!! route('simpanTahap3') !!}",data,function(data){
					if(data.status=='success'){
						if(redir==0){
							window.location="{{route('content3')}}";
						}else{
							simpantahapEresep();
						}
					}else{
						if(redir==0){
							$("#simpan_tahap").removeAttr('disabled');
							$("#simpan_tahap").text('Simpan');
							swal("Warning !",'Tidak ada perubahan','warning');
						}else{
							simpantahapEresep();
						}
					}
				});
			}

		}

		function simpantahapEresep(){
			var i = 0;

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
