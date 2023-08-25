<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<?php
		$poli = DB::connection('rsu')->table('tm_poli')->get();

		$value_status = ['Y','T'];
		if($id=='0'){
			$nama_dokter='';
			$nama_poli='';
			$is_terapis = '';
		}else{
			$user = DB::table('users')->where('id',$id)->first();
			$nama_dokter=$user->nama;
			$nama_poli=$user->kodePoli;
			$is_terapis = ($user->is_terapis == 'Y') ? 'checked' : '';
		}
		?>
		<style type="text/css">
			.chzn-container{width: 100% !important;}
		</style>
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="background: #00c4ff">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Data Perawat</h4>
			</div>
			<div class="modal-body">
				<form id="data_poli">
					<input type="hidden" name="id_admin" value="{!! $id !!}" readonly>
					<div class="col-lg-12 col-md-12">
						@if($id == 0)
						<div class="form-group">
							<label class="col-lg-4 col-md-4">Nama Perawat</label>
							<div class="col-lg-8 col-md-8">
								<input type="text" name="nama_perawat" value="" class="form-control" placeholder="Nama Perawat">
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-lg-4 col-md-4">Nama Dokter</label>
							<div class="col-lg-8 col-md-8">
								<input type="text" name="" class="form-control" value="{!! $nama_dokter !!}" readonly style="border-radius: 10px !important">
							</div>
						</div>
						@endif
						<div class="clearfix" style="margin-bottom: 10px"></div>

						<div class="form-group">
							<label class="col-lg-4 col-md-4">Nama Poli</label>
							<div class="col-lg-8 col-md-8">
								<select name="id_poli" id="id_poli" class="chzn-select form-control" onchange="terapis_form()">
									<option value="" selected>..:: Nama Poli ::..</option>
									@foreach($poli as $key)
										@php $sel = ''; @endphp
										@if($nama_poli == $key->KodePoli)
											@php $sel = 'selected'; @endphp
										@endif
										<option {!! $sel !!} value="{!! $key->KodePoli !!}">{!! $key->NamaPoli !!}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>

						<div id="isTerapis" class="form-group" style="display: none;">
							<label class="col-lg-4 col-md-4">Terapis?</label>
							<div class="col-lg-4 col-md-4">
								<div class="input-group">
									<span class="input-group-addon">
										<input type="checkbox" id="is_terapis" name="is_terapis" value="Y" {{ $is_terapis }}>
									</span>
									<label for="is_terapis" class="form-control">Ya</label>
								</div>
							</div>
							<div class="clearfix" style="margin-bottom: 10px"></div>
						</div>

						@if($id == 0)
						<div class="form-group">
							<label class="col-lg-4 col-md-4">Username </label>
							<div class="col-lg-8 col-md-8">
								<input type="text" name="username" class="form-control" style="border-radius: 10px !important" placeholder="username">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>

						<div class="form-group">
							<label class="col-lg-4 col-md-4">Password </label>
							<div class="col-lg-8 col-md-8">
								<input type="password" name="password" class="form-control" style="border-radius: 10px !important" placeholder="password">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						@endif
					</div>
					<div class="clearfix"></div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#" onclick="kirimData()" class="btn btn-success">Proses</a>
			</div>
		</div>

  </div>
</div>

<script type="text/javascript">
	$(function() {
		$(".chzn-select").chosen();
		terapis_form();
	});

	function terapis_form(){
		if ($("#id_poli").val() == 117)
			$("#isTerapis").show();
		else
			$("#isTerapis").hide();
	}

	function kirimData(){
		var data = $('form#data_poli').serialize();
		var i = 0;
		var id = $('input[name=id_admin]').val();
		var nama = $('input[name=nama_perawat]').val();
		var poli = $('select[name=id_poli]').val();
		var username = $('input[name=username]').val();
		var password = $('input[name=password]').val();

		if(id==0){
			if(password==''){
				swal('Password harus diisi');
				i++;
			}
			if(username==''){
				swal('Username harus diisi');
				i++;
			}
		}

		if(poli==''){
			swal('Poli harus dipilih');
			i++;
		}

		if(nama==''){
			swal('Nama perawat harus diisikan');
			i++;
		}

		if(i==0){
			$.post("{!! route('simpanPerawat') !!}",data,function(hasil){
				if(hasil.status=='success'){
					$('#myModal').modal('hide');
					// location.reload();
					// $(".box-body").load(location.href + " .box-body>*", "");
					$("table#dataPoli").load(location.href + " #dataPoli>*", "");
					$("ul.pagination").load(location.href + " .pagination>*", "");
					swal('Berhasil disimpan');
				}else if(hasil.status=='tidak'){
					$('#myModal').modal('hide');
					// location.reload();
					// $(".box-body").load(location.href + " .box-body>*", "");
					$("table#dataPoli").load(location.href + " #dataPoli>*", "");
					$("ul.pagination").load(location.href + " .pagination>*", "");
					swal('Tidak ada yang berubah');
				}else if(hasil.status=='exist'){
					swal('Username Sudah ada');
				}else{
					swal('Gagal disimpan');
				}
			},'json');
		}else{

		}
	}
</script>