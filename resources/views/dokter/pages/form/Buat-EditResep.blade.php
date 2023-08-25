@extends('dokter.master.main')
@section('content')
<style media="screen">
	.data-list-txt {
		min-width: 90%;
		max-width: 90%;
		display: inline;
		border-right: none;
		border-radius: 4px 0 0 4px;
		background-color: #fff;
	}
	.data-list {
		margin-top: -34px;
	}
</style>
<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">
	<h1 class="text-center">
		<b>Buat - Edit Racikan</b>
	</h1>
</section>
<div class="col-md-12 col-md-12">
	<div class="box">
		<div class="box-header">
			<div class="box-tools pull-right">
				<button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>
			</div>
			<a href="{{ route('pembuatanObat') }}" class="btn btn-warning">Kembali</a>
			<div class="clearfix"></div>
		</div>
		<div class="box-body">
			<div class="clearfix" style="margin-bottom: 10px"></div>
			<div class="row">
				<input type="hidden" id="user_id" value="{{Auth::user()->id}}" />
				<input type="hidden" name="poli_id" id="poli_id" value="{{ $dokter->poli_id }}">
				<input type="hidden" id="noReg" name="noReg"  value="{{ $rekap->no_Register }}">
				<input type="hidden" id="no_RM" name="no_RM"  value="{{ $rekap->no_RM }}">
				<input type="hidden" name="No_Resep" id="No_Resep" value="{{ $resep->No_Resep }}">

				<div id="form-racik" class="col-lg-11 col-md-11 col-lg-offset-1 col-md-offset-1" style="padding: 0px">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Nama Racikan</label>
							<div class="col-lg-10 col-md-10">
								<input type="hidden" id="id_racik" name="id_racik" value="">
								<input type="text" name="nama_racikan" id="nama_racikan" class="form-control" style="border-radius: 10px !important" placeholder="Cari racikan obat / buat racikan baru ...">
								<div id="list-racikan"></div>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>

					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Obat 1</label>
							<div class="col-lg-3 col-md-3">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="obat1" id="obat1" class="form-control kdObat" style="border-radius: 10px !important" data-obat='1' readonly placeholder="Kode Obat 1">
							</div>
							<div class="col-lg-7 col-md-7">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="namaobat1" id="namaobat1" class="form-control nmObat" style="border-radius: 10px !important" data-obat='1' placeholder="Cari/Ketikkan Nama Obat 1">
							</div>
							<div id="tempat-obat1"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<!-- <label class="col-lg-2 col-md-2">Dosis</label> -->
							<div class="col-lg-4 col-md-4">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="dosis1" id="dosis1" class="form-control" style="border-radius: 10px !important" placeholder="Dosis 1">
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan1" id="satuan1" style="border-radius: 10px !important">
									<option value="" disabled selected>- Satuan -</option>
									<?php
									foreach ($satuan as $key) {
										?>
										<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis1" id="is_kronis1" style="border-radius: 10px !important">
									<option value="" disabled selected>- Jenis Obat -</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>

					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Obat 2</label>
							<div class="col-lg-3 col-md-3">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="obat2" id="obat2" class="form-control kdObat" style="border-radius: 10px !important" data-obat='2' readonly placeholder="Kode Obat 2">
							</div>
							<div class="col-lg-7 col-md-7">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="namaobat2" id="namaobat2" data-obat='2' class="form-control nmObat" style="border-radius: 10px !important" placeholder="Cari/Ketikkan Nama Obat 2">
							</div>
							<div id="tempat-obat2"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<!-- <label class="col-lg-2 col-md-2">Dosis</label> -->
							<div class="col-lg-4 col-md-4">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="dosis2" id="dosis2" class="form-control" style="border-radius: 10px !important" placeholder="Dosis 2">
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan2" id="satuan2" style="border-radius: 10px !important">
									<option value="" disabled selected>- Satuan -</option>
									<?php
									foreach ($satuan as $key) {
										?>
										<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis2" id="is_kronis2" style="border-radius: 10px !important">
									<option value="" disabled selected>- Jenis Obat -</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>

					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Obat 3</label>
							<div class="col-lg-3 col-md-3">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="obat3" id="obat3" class="form-control kdObat" data-obat='3' style="border-radius: 10px !important" readonly placeholder="Kode Obat 3">
							</div>
							<div class="col-lg-7 col-md-7">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="namaobat3" id="namaobat3" data-obat='3' class="form-control nmObat" style="border-radius: 10px !important" placeholder="Cari/Ketikkan Nama Obat 3">
							</div>
							<div id="tempat-obat3"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<div class="col-lg-4 col-md-4">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="dosis3" id="dosis3" class="form-control" style="border-radius: 10px !important" placeholder="Dosis 3">
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan3" id="satuan3" style="border-radius: 10px !important">
									<option value="" disabled selected>- Satuan -</option>
									<?php
									foreach ($satuan as $key) {
										?>
										<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis3" id="is_kronis3" style="border-radius: 10px !important">
									<option value="" disabled selected>- Jenis Obat -</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>

					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Obat 4</label>
							<div class="col-lg-3 col-md-3">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="obat4" id="obat4" class="form-control kdObat" data-obat='4' style="border-radius: 10px !important" readonly placeholder="Kode Obat 4">
							</div>
							<div class="col-lg-7 col-md-7">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="namaobat4" id="namaobat4" data-obat='4' class="form-control nmObat" style="border-radius: 10px !important" placeholder="Cari/Ketikkan Nama Obat 4">
							</div>
							<div id="tempat-obat4"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<div class="col-lg-4 col-md-4">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="dosis4" id="dosis4" class="form-control" style="border-radius: 10px !important" placeholder="Dosis 4">
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan4" id="satuan4" style="border-radius: 10px !important">
									<option value="" disabled selected>- Satuan -</option>
									<?php
									foreach ($satuan as $key) {
										?>
										<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis4" id="is_kronis4" style="border-radius: 10px !important">
									<option value="" disabled selected>- Jenis Obat -</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>

					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Obat 5</label>
							<div class="col-lg-3 col-md-3">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="obat5" data-obat='5' id="obat5" class="form-control kdObat" style="border-radius: 10px !important" readonly placeholder="Kode Obat 5">
							</div>
							<div class="col-lg-7 col-md-7">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" data-obat='5' name="namaobat5" id="namaobat5" class="form-control nmObat" style="border-radius: 10px !important" placeholder="Cari/Ketikkan Nama Obat 5">
							</div>
							<div id="tempat-obat5"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<div class="col-lg-4 col-md-4">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="dosis5" id="dosis5" class="form-control" style="border-radius: 10px !important" placeholder="Dosis 5">
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan5" id="satuan5" style="border-radius: 10px !important">
									<option value="" disabled selected>- Satuan -</option>
									<?php
									foreach ($satuan as $key) {
										?>
										<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis5" id="is_kronis5" style="border-radius: 10px !important">
									<option value="" disabled selected>- Jenis Obat -</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>

					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Obat 6</label>
							<div class="col-lg-3 col-md-3">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="obat6" data-obat='6' id="obat6" class="form-control kdObat" style="border-radius: 10px !important" readonly placeholder="Kode Obat 6">
							</div>
							<div class="col-lg-7 col-md-7">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" data-obat='6' name="namaobat6" id="namaobat6" class="form-control nmObat" style="border-radius: 10px !important" placeholder="Cari/Ketikkan Nama Obat 6">
							</div>
							<div id="tempat-obat6"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<div class="col-lg-4 col-md-4">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="dosis6" id="dosis6" class="form-control" style="border-radius: 10px !important" placeholder="Dosis 6">
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan6" id="satuan6" style="border-radius: 10px !important">
									<option value="" disabled selected>- Satuan -</option>
									<?php
									foreach ($satuan as $key) {
										?>
										<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis6" id="is_kronis6" style="border-radius: 10px !important">
									<option value="" disabled selected>- Jenis Obat -</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>

					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Obat 7</label>
							<div class="col-lg-3 col-md-3">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="obat7" data-obat='7' id="obat7" class="form-control kdObat" style="border-radius: 10px !important" readonly placeholder="Kode Obat 7">
							</div>
							<div class="col-lg-7 col-md-7">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" data-obat='7' name="namaobat7" id="namaobat7" class="form-control nmObat" style="border-radius: 10px !important" placeholder="Cari/Ketikkan Nama Obat 7">
							</div>
							<div id="tempat-obat7"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<div class="col-lg-4 col-md-4">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="dosis7" id="dosis7" class="form-control" style="border-radius: 10px !important" placeholder="Dosis 7">
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan7" id="satuan7" style="border-radius: 10px !important">
									<option value="" disabled selected>- Satuan -</option>
									<?php
									foreach ($satuan as $key) {
										?>
										<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis7" id="is_kronis7" style="border-radius: 10px !important">
									<option value="" disabled selected>- Jenis Obat -</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>

					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="col-lg-2 col-md-2">Obat 8</label>
							<div class="col-lg-3 col-md-3">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="obat8" data-obat='8' id="obat8" class="form-control kdObat" style="border-radius: 10px !important" readonly placeholder="Kode Obat 8">
							</div>
							<div class="col-lg-7 col-md-7">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" data-obat='8' name="namaobat8" id="namaobat8" class="form-control nmObat" style="border-radius: 10px !important" placeholder="Cari/Ketikkan Nama Obat 8">
							</div>
							<div id="tempat-obat8"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<div class="col-lg-4 col-md-4">
								<input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="dosis8" id="dosis8" class="form-control" style="border-radius: 10px !important" placeholder="Dosis 8">
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan8" id="satuan8" style="border-radius: 10px !important">
									<option value="" disabled selected>- Satuan -</option>
									<?php
									foreach ($satuan as $key) {
										?>
										<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4">
								<select class="form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis8" id="is_kronis8" style="border-radius: 10px !important">
									<option value="" disabled selected>- Jenis Obat -</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</div>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>
			<div class="clearfix" style="margin-bottom: 10px"></div>

			<div class="row">
				<div class="col-lg-5 col-md-5 col-lg-offset-1 col-md-offset-1">
					<div class="form-group">
						<label class="col-lg-2 col-md-2">Perintah</label>
						<div class="col-lg-10 col-md-10">
							<input class="data-list-txt form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" type="text" value="" name="perintah" id="perintah" style="border-radius: 10px !important">
							<select class="data-list form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" id="list" onchange="setValuePerintah(this.value)" style="border-radius: 10px !important">
								<option value="" style="display:none"></option>
								<option value="mf. pulv. dtd. no">mf. pulv. dtd. no</option>
								<option value="mf. caps. dtd. no">mf. caps. dtd. no</option>
								<option value="mf. ungt. no">mf. ungt. no</option>
								<option value="mf. sol no">mf. sol no</option>
								<option value="mf. cream">mf. cream</option>
								<option value="mf. cream da in pot">mf. cream da in pot</option>
							</select>
						</div>
					</div>

					<div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="form-group">
						<label class="col-lg-2 col-md-2">Jumlah</label>
						<div class="col-lg-3 col-md-3">
							<input type="text" name="jumlah" onkeydown="ModifyEnterKeyPressAsTab(event);" id="jumlah" class="form-control" style="border-radius: 10px !important" placeholder="">
						</div>

						<label class="col-lg-3 col-md-3">Jam Signa</label>
						<div class="col-lg-4 col-md-4">
							<input type="text" value="07:00:00" onkeydown="ModifyEnterKeyPressAsTab(event);" name="jam_signa" id="jam_signa" class="form-control" style="border-radius: 10px !important" placeholder="">
						</div>
					</div>

					<div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="form-group">
						<label class="col-lg-2 col-md-2">Signa</label>
						<div class="col-lg-2 col-md-2">
							<input type="text" name="signa" onkeydown="ModifyEnterKeyPressAsTab(event);" id="signa" class="form-control" style="border-radius: 10px !important" placeholder="">
						</div>

						<label class="col-lg-2 col-md-2">dd</label>
						<div class="col-lg-2 col-md-2">
							<input type="text" name="dd" onkeydown="ModifyEnterKeyPressAsTab(event);" id="dd" class="form-control" style="border-radius: 10px !important" placeholder="">
						</div>

						<label class="col-lg-2 col-md-2">Sejumlah</label>
						<div class="col-lg-2 col-md-2">
							<input type="text" name="sejumlah" onkeydown="ModifyEnterKeyPressAsTab(event);" id="sejumlah" class="form-control" style="border-radius: 10px !important" placeholder="">
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="form-group">
						<label class="col-lg-2 col-md-2">Signa Khusus</label>
						<div class="col-lg-10 col-md-10">
							<input type="text" placeholder="Contoh : ue, S 1 dd 5, dst." name="SignaKhusus" id="SignaKhusus" class="form-control" style="border-radius: 10px !important" placeholder="">
						</div>
					</div>

					<div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="form-group">
						<label class="col-lg-2 col-md-2">Petunjuk Khusus</label>
						<div class="col-lg-10 col-md-10">
							<input class="data-list-txt form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" type="text" value="" name="petunjuk_khusus" id="petunjuk_khusus" style="border-radius: 10px !important">
							<select class="data-list form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" id="list2" onchange="setValuePetunjuk(this.value)" style="border-radius: 10px !important">
								<option value="" style="display:none"></option>
								<?php
								foreach ($petunjuk_khusus as $key) {
									?>
									<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>

				<div class="col-lg-5 col-md-5">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<button type="button" class="btn btn-success btn-md col-lg-12 col-md-12" id="simpan_paket_racikan">
								<i class="fa fa-save" aria-hidden="true"></i> Simpan Racikan
							</button>
						</div>
						<div class="col-lg-6 col-md-6">
							<button type="button" class="btn btn-danger btn-md col-lg-12 col-md-12" id="hapus_paket_racikan" style="display: none">
								<i class="fa fa-trash-o" aria-hidden="true"></i> Hapus Racikan
							</button>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<button type="button" class="btn btn-primary btn-md col-lg-12 col-md-12" id="tambah">
								<i class="fa fa-plus" aria-hidden="true"></i> Tambahkan
							</button>
						</div>
					</div>
					<!-- <div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="clearfix" style="margin-bottom: 10px"></div>
							<button type="button" class="btn btn-success btn-md col-lg-3 col-md-3" id="buatbaru">
								<i class="fa fa-plus-circle" aria-hidden="true"></i> Buat Baru
							</button>
						</div>
					</div> -->

				</div>
			</div>

			<div class="clearfix" style="margin-bottom: 10px"></div>
			<div class="col-lg-12 col-md-12" style="overflow: auto">
				<table class="table table-bordered table-striped" id="dataPoli">
					<thead>
						<tr>
							<th class="text-center"></th>
							<th>No_Resep</th>
							<th>R</th>
							<th>MF</th>
							<th>Keterangan</th>
							<th>Nama Obat 1</th>
							<th>Nama Obat 2</th>
							<th width="5%">Aksi</th>
						</tr>
					</thead>
					<tbody id="">
						@if (count($racikan)>0)
						@foreach ($racikan as $key)
						<tr>
							<td class="text-center"><input type="checkbox" name="resepIds[]" class="delResepItem" data-type='racik' value="{{ $key->No_R }}"></td>
							<td>{{ $key->No_Resep }}</td>
							<td>{{ $key->No_R }}</td>
							<td>{{ $key->MF }}</td>
							<td>{{ $key->Keterangan }}</td>
							<td>{{ $key->NamaObat1 }}</td>
							<td>{{ $key->NamaObat2 }}</td>
							<td>
								<a href="javascript:void(0)" onclick="detailRacikanObat('{{ $key->No_Resep }}','{{ $key->No_R }}')" class="btn btn-sm btn-success">Lihat</a>
							</td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
			<div class="col-lg-12 col-md-12">
				<div>
					<!-- PAGING HERE -->
				</div>
			</div>
			<div class="clearfix"></div>

			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="col-lg-6 col-md-6">
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<button type="button" class="btn btn-danger btn-md" onclick="delResepItem();">
							<i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
						</button>
					</div>
				</div>

				<div class="col-lg-6 col-md-6">
					<div class="col-lg-6 col-md-6">
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<button type="button" class="btn btn-primary btn-md col-lg-5 col-md-5" onclick="kembali()">
							<i class="fa fa-floppy-o" aria-hidden="true"></i> Selesai
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal_layout"></div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">
	function ModifyEnterKeyPressAsTab(event){
		var caller;
		var key;
		if (window.event) {
			caller = window.event.srcElement; //Get the event caller in IE.
			key = window.event.keyCode; //Get the keycode in IE.
		} else {
			caller = event.target; //Get the event caller in Firefox.
			key = event.which; //Get the keycode in Firefox.
		}

		if (key == 13) { //Enter key was pressed.
			cTab = caller.tabIndex; //caller tabIndex.
			maxTab = 0; //highest tabIndex (start at 0 to change)
			minTab = cTab; //lowest tabIndex (this may change, but start at caller)
			// allById = document.getElementsByTagName("input"); //Get input elements.
			allById = document.querySelectorAll('input, select'); //Get input elements.
			allByIndex = []; //Storage for elements by index.
			c = 0; //index of the caller in allByIndex (start at 0 to change)
			i = 0; //generic indexer for allByIndex;
			for (id in allById) {//Loop through all the input elements by id.
				allByIndex[i] = allById[id]; //Set allByIndex.
				tab = allByIndex[i].tabIndex;
				if (caller == allByIndex[i])
					c = i; //Get the index of the caller.
				if (tab > maxTab)
					maxTab = tab; //Get the highest tabIndex on the page.
				if (tab < minTab && tab >= 0)
					minTab = tab; //Get the lowest positive tabIndex on the page.
				i++;
			}
			//Loop through tab indexes from caller to highest.
			for (tab = cTab; tab <= maxTab; tab++) {
				//Look for this tabIndex from the caller to the end of page.
				for (i = c + 1; i < allByIndex.length; i++) {
					if (allByIndex[i].tabIndex == tab)
					{
						allByIndex[i].focus(); //Move to that element and stop.
						return;
					}
				}
				//Look for the next tabIndex from the start of page to the caller.
				for (i = 0; i < c; i++) {
					if (allByIndex[i].tabIndex == tab + 1)
					{
						allByIndex[i].focus(); //Move to that element and stop.
						return;
					}
				}
				//Continue searching from the caller for the next tabIndex.
			}

			//The caller was the last element with the highest tabIndex,
			//so find the first element with the lowest tabIndex.
			for (i = 0; i < allByIndex.length; i++) {
				if (allByIndex[i].tabIndex == minTab) {
					allByIndex[i].focus(); //Move to that element and stop.
					return;
				}
			}
		}
	}

	function kembali() {
		window.location.href="{{ route('pembuatanObat') }}";
	}
	function detailRacikan(No_Resep,No_R) {
		alert(No_Resep+"-"+No_R);
	}

	$("#tambah").click(function(event) {
		var poli_id = $("#poli_id").val();
		var noReg = $("#noReg").val();
		var no_RM = $("#no_RM").val();
		var No_Resep = $("#No_Resep").val();
		var data = {
			poli_id:poli_id,
			No_Resep:No_Resep,
			No_Register:noReg,
			No_RM:no_RM,
			namaRacikan:$("#nama_racikan").val(),
			MF:$("#perintah").val(),
			Jumlah:$("#jumlah").val(),
			JamSigna:$("#jam_signa").val(),
			Signa1:$("#signa").val(),
			Signa2:$("#dd").val(),
			sejumlah:$("#sejumlah").val(),
			SignaKhusus:$("#SignaKhusus").val(),
			Keterangan:$("#petunjuk_khusus").val(),
			Obat1:$("#obat1").val(),
			Obat2:$("#obat2").val(),
			Obat3:$("#obat3").val(),
			Obat4:$("#obat4").val(),
			Obat5:$("#obat5").val(),
			Obat6:$("#obat6").val(),
			Obat7:$("#obat7").val(),
			Obat8:$("#obat8").val(),
			NamaObat1:$("#namaobat1").val(),
			NamaObat2:$("#namaobat2").val(),
			NamaObat3:$("#namaobat3").val(),
			NamaObat4:$("#namaobat4").val(),
			NamaObat5:$("#namaobat5").val(),
			NamaObat6:$("#namaobat6").val(),
			NamaObat7:$("#namaobat7").val(),
			NamaObat8:$("#namaobat8").val(),
			Dosis1:$("#dosis1").val(),
			Dosis2:$("#dosis2").val(),
			Dosis3:$("#dosis3").val(),
			Dosis4:$("#dosis4").val(),
			Dosis5:$("#dosis5").val(),
			Dosis6:$("#dosis6").val(),
			Dosis7:$("#dosis7").val(),
			Dosis8:$("#dosis8").val(),
			Satuan1:$("#satuan1").val(),
			Satuan2:$("#satuan2").val(),
			Satuan3:$("#satuan3").val(),
			Satuan4:$("#satuan4").val(),
			Satuan5:$("#satuan5").val(),
			Satuan6:$("#satuan6").val(),
			Satuan7:$("#satuan7").val(),
			Satuan8:$("#satuan8").val(),
			is_kronis1:$("#is_kronis1").val(),
			is_kronis2:$("#is_kronis2").val(),
			is_kronis3:$("#is_kronis3").val(),
			is_kronis4:$("#is_kronis").val(),
			is_kronis5:$("#is_kronis5").val(),
			is_kronis6:$("#is_kronis6").val(),
			is_kronis7:$("#is_kronis7").val(),
			is_kronis8:$("#is_kronis8").val()
		};
		// alert('tambah -> '+JSON.stringify(data));
		var obat1 = $("#obat1").val();
		var namaobat1 = $("#namaobat1").val();
		var dosis1 = $("#dosis1").val();
		var satuan1 = $("#satuan1").val();
		if (obat1 && namaobat1 && dosis1 && satuan1) {
			// swal('save');
			$.post("{{route('buatEditResepSave')}}",data).done(function(data){
				if(data.status=='success'){
					swal('Berhasil');
					location.reload();
				}else{
					swal('Gagal!');
				}
			}).fail(function(data) {
				swal('Gagal!');
			});
		}else {
			swal('Obat pertama harus diisi!');
		}
	});

	$("#buatbaru").click(function(event) {
		swal("Fitur belum bisa digunakan!");
	});

	$("#simpan_paket_racikan").click(function (e) {
		e.preventDefault();
		var data = {
			noReg:$("#noReg").val(),
			keterangan:$("#petunjuk_khusus").val(),
			poli_id:$("#poli_id").val(),
			nama_paket:$("#nama_racikan").val(),
			user_id:$("#user_id").val(),
			poli_id:$("#poli_id").val(),
			jenis:'Racikan',
			MF:$("#perintah").val(),
		};
		for (var i = 1; i <= 8; i++) {
			data['obat'+i] = $('#obat'+i).val();
			data['satuan'+i] = $('#satuan'+i).val();
			// data['is_kronis'+i] = $('#is_kronis'+i).val();
		}

		if ($("#nama_racikan").val() != '') {
			$.post("{!! route('simpanPaketResep') !!}", data).done(function(data){
				if(data.status=='success'){
					swal('Berhasil', data.message, data.status);
				} else {
					swal('Gagal', data.message, data.status);
				}
			});
		} else {
			swal('Notice!', 'Nama paket racikan harap diisi!', 'info');
		}
	});

	$("#hapus_paket_racikan").click(function (e) {
		e.preventDefault();
		var data = {
			id: $("#id_racik").val(),
			jenis: 'Racikan',
		};
		swal({
			title: "Anda yakin?",
			text: "Data akan dihapus dan tidak dapat dikembalikan lagi.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Batal',
			closeOnConfirm: true,
			closeOnCancel: true
		}, function(){
			$("#hapus_paket_racikan").html('<i><b>Loading ...</b></i>');
			$("#hapus_paket_racikan").prop('disabled',true);
			$.post("{{route('hapus_paket_resep')}}", data, function(data){
				if (data.status == 'success') {
					swal('Sukses', data.message, 'success');
					$("#hapus_paket_racikan").html('<i class="fa fa-trash-o" aria-hidden="true"></i> Hapus Racikan');
					$("#hapus_paket_racikan").prop('disabled', false);
					$("#hapus_paket_racikan").hide();
					$('#form-racik').find('input:text').val('');
					$('#form-racik').find('select').val('');
				} else {
					swal('Error', 'Gagal menghapus data!', 'error');
					$("#hapus_paket_racikan").html('<i class="fa fa-trash-o" aria-hidden="true"></i> Hapus Racikan');
					$("#hapus_paket_racikan").prop('disabled', false);
				}
			});
		});
	});

	function setValuePetunjuk(value) {
		$('#petunjuk_khusus').val(value);
		$('#list2')[0].selectedIndex = 0;
	}
	function setValuePerintah(value) {
		$('#perintah').val(value);
		$('#list')[0].selectedIndex = 0;
	}

	$('.kdObat').keyup(function(){
		var id = $(this).data('obat');
		$('#namaobat'+id).val('');
		var kode = 'kode_obat';
		var cari = $(this).val();
		if (cari == '') {
			$('#tempat-obat'+id).html('');
		}else {
			var data = {
				cari:cari,
				kode:kode,
			};
			$.post("{{route('get_kode_resep')}}",data,function(data){
				var tag = '';
				if(data.data.length!=0){
					$.each(data.data,function(index,value){
						tag += '<a href="javascript:void(0)" onclick="setObat(\''+value.KodeBrg+'\',\''+value.NamaBrg+'\',\''+value.KodeGd+'\',\''+value.Satuan+'\',\''+id+'\')">'+value.KodeBrg+'</a><br>';
					});
				}else{
					tag = 'Tidak ditemukan';
				}
				$('#tempat-obat'+id).html(tag);
			});
		}
	});
	$('.nmObat').keyup(function(){
		var id = $(this).data('obat');
		$('#obat'+id).val('');
		var kode = 'nama_obat';
		var cari = $(this).val();
		if (cari == '') {
			$('#tempat-obat'+id).html('');
		}else {
			var data = {
				cari:cari,
				kode:kode,
			};
			$.post("{{route('get_kode_resep')}}",data,function(data){
				var tag = '';
				if(data.data.length!=0){
					$.each(data.data, function(index,value){
						// tag += '<a href="javascript:void(0)" onclick="setObat(\''+value.KodeBrg+'\',\''+value.NamaBrg+'\',\''+value.KodeGd+'\',\''+value.Satuan+'\',\''+id+'\')">'+value.NamaBrg+' <span style="color:#000;">(Stok : '+value.saldo+')</span></a><br>';
						tag += '<a href="javascript:void(0)" onclick="setObat(\''+value.item_code+'\',\''+value.item_name+'\',\''+value.unit_nickname+'\',\''+value.item_unitofitem+'\',\''+id+'\')">'+value.item_name+' <span style="color:#000;">(Stok : '+value.stock+')</span></a><br>';
					});
				}else{
					tag = 'Tidak ditemukan';
				}
				$('#tempat-obat'+id).html(tag);
			});
		}
	});

	function setObat(kode,nama,KodeGd,satuan,id){
		// var data = { // Gunakan saat save semua
		// 	noReg:$("#noReg").val(),
		// };
		// $.post("{{ route('get_nor') }}",data).done(function(data){
		// 	if(data.status=='success'){
		// 		$('input[name=no_R]').val(data.No_R);
		// 	}else{
		// 		swal('Gagal');
		// 	}
		// }).fail(function(data) {
		// 	swal('Gagal');
		// });

		$('#obat'+id).val(kode);
		$('#namaobat'+id).val(nama);
		// $('input[name=satuan]').val(satuan);
		$('#tempat-obat'+id).html('');
		$('#dosis'+id).focus();
	}

	function detailRacikanObat(noResep,noR){
		$.post("{!! route('buatEditResepModal') !!}",{noResep:noResep,noR:noR}).done(function(data){
			if(data.status=='success'){
				$('.modal_layout').html(data.content);
				$('.modal_layout').show();
				$('#myModal').modal('show');
			}
		});
	}

	// $("#nama_racikan").focus(function(event) {
	// 	swal("Fitur belum bisa digunakan!");
	// });

	$('#nama_racikan').keyup(function(){
		$('#list-racikan').html('<i>Loading...</i>');
		var cari = $('#nama_racikan').val();
		if (cari == '') {
			$('#list-racikan').html('');
		}else {
			var data = {
				cari:cari,
				jenis:'Racikan',
			};
			$.post("{{route('get_paket_resep')}}",data,function(data){
				var tag = '';
				if(data.data.length!=0){
					$.each(data.data,function(index,value){
						tag += '<a href="javascript:void(0)" onclick="setPaket(`'+value.id_paket_m+'`,`'+value.nama_paket+'`,`'+value.mf+'`)">'+value.nama_paket+'</a><br>';
					});
				}else{
					tag = `Tidak ditemukan. <a href="javascript:void(0)" onclick="$('#list-racikan').html('');">Buat Baru?</a>`;
				}
				$('#list-racikan').html(tag);
			});
		}
	});

	function setPaket(id,nama,mf){
		$('#list-racikan').html('<i>Memuat obat...</i>');
		$('#nama_racikan').val(nama);
		$('#id_racik').val(id);
		$('#perintah').val(mf);
		$.post("{{route('select_paket_resep')}}",{id:id, jns:'pilih', jenis:'Racikan'},function(data){
			var html = '';
			if(data.data.length!=0){
				$('#list-racikan').html('');
				$.each(data.data, function(c,v){
					$('#obat'+(c+1)).val(v.item_code);
					$('#namaobat'+(c+1)).val(v.item_name);
					$('#satuan'+(c+1)).val(v.satuan);
				});
				$('#hapus_paket_racikan').show();
			}
		});
	}

	function delResepItem() {
		if ($(".delResepItem"). is(":checked")) {
			if ($("#No_Resep").val()) {
				swal({
					title: "Apa anda yakin menghapus data data Ini?",
					text: "Data data akan dihapus dari sistem dan tidak dapat dikembalikan!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Saya yakin!",
					cancelButtonText: "Batal!",
					closeOnConfirm: false
				}, function(){
					$.each($(".delResepItem:checked"), function(){
						var data = {
							No_R:$(this).val(),
							type:$(this).data('type'),
							noReg:$("#noReg").val(),
							noResep:$("#No_Resep").val()
						};

						$.post("{{route('pembuatanObatResepDelItem')}}",data).done(function(data){
							if(data.status=='success'){
								swal('Berhasil');
								location.reload();
							}else{
								swal('Gagal');
							}
						}).fail(function(data) {
							swal('Gagal');
						});
					});
				});
			}else {
				swal('Resep belum ada!');
			}
		}else {
			swal('Tidak ada item yang dipilih!');
		}
	}
</script>
@stop
