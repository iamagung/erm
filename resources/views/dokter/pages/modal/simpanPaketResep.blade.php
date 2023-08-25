<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center"><strong>Paket Resep Baru</strong></h4>
			</div>
			<div class="modal-body">
				<?php $dokter = DB::table('login_dokter')->where('user_id', Auth::user()->id)->first(); ?>
				<div class="col-md-12" style="padding-left: 50px; padding-right: 50px">
					<label for="nama_resep">Nama Paket Resep<font color="red">*</font></label>
					<input type="hidden" id="user_id" value="{{Auth::user()->id}}" />
					<input type="hidden" id="poli_id" value="{{$dokter->poli_id}}" />
					<input type="hidden" id="noReg" name="noReg"  value="{{$data['noRegistrasi']}}">
					<input type="hidden" id="keterangan" name="keterangan"  value="{{$data['keterangan']}}">
					<input type="hidden" id="id_paket_m" value="{{$data['id_paket_m']}}">
					
					<input type="text" id="nama_resep" name="nama_resep" class="form-control" placeholder="Masukkan nama paket obat ..." value="{{$data['nama_paket_m']}}" required>
					<hr style="border: 1px solid green">
					<h4>List Obat : </h4>
					<table class="table">
						<thead>
							<tr>
								<th>Kode Obat</th>
								<th>Nama Obat</th>
								<th>Satuan</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data['data'] as $dt)
							<tr>
								<td>{{$dt['KodeBrg']}}</td>
								<td>{{$dt['NamaBrg']}}</td>
								<td>{{$dt['Satuan']}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-center">
						<button name="simpan_resep" id="simpan_resep" class="btn btn-primary form-control">SIMPAN</button>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 20px"></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
		
	</div>
</div>

<script>
	$("#simpan_resep").click(function (e) { 
		e.preventDefault();

		var data = {
			id: $("#id_paket_m").val(),
			jenis: 'Generic',
		};
		$.post("{{route('hapus_paket_resep')}}", data, function(data){
			if (data.status == 'success') {
				swal('Sukses', data.message, 'success');
				$('#myModal').modal('hide');
			} else {
				swal('Error', 'Gagal menghapus data!', 'error');
				$("#hapus_list").html('<b>HAPUS</b>');
				$("#hapus_list").prop('disabled', false);
			}
		});
		

		
		var data = {
			noReg:$("#noReg").val(),
			nos:$("#fr-nos").val(),
			nama_paket:$("#nama_resep").val(),
			user_id:$("#user_id").val(),
			poli_id:$("#poli_id").val(),
			jenis:'Generic',
			keterangan:$("#keterangan").val(),
			// id_paket_m:$("#id_paket_m").val(),
		};
		var nos = document.getElementById('fr-nos').value;
		var arr = nos.split(',');
		for (var i = 0; i < arr.length; i++) {
			data['no_R_'+arr[i]] = $('#no_R_'+arr[i]).val();
			data['kode_obat_'+arr[i]] = $('#kode_obat_'+arr[i]).val();
			data['nama_obat_'+arr[i]] = $('#nama_obat_'+arr[i]).val();
			data['satuan_'+arr[i]] = $('#satuan_'+arr[i]).val();
			data['kode_gd_'+arr[i]] = $('#kode_gd_'+arr[i]).val();
			data['jumlah'+arr[i]] = $('#jumlah_'+arr[i]).val();
			data['signa'+arr[i]] = $('#signa1_'+arr[i]).val()+'x'+$('#signa2_'+arr[i]).val();
		}
		if ($("#nama_resep").val() != '') {
			$.post("{!! route('simpanPaketResep') !!}", data).done(function(data){
				if(data.status=='success'){
					swal('Berhasil', data.message, data.status);
					$('#myModal').modal('hide');
				} else {
					swal('Gagal', data.message, data.status);
				}
			});
		} else {
			swal('Notice!', 'Nama paket resep harap diisi!', 'info');
		}
	});
</script>