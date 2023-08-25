<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center"><strong>Cari Resep Obat</strong></h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12" style="padding-left: 50px; padding-right: 50px">
					<label for="cari_resep">Nama Paket Resep</label>
					<input type="hidden" id="id_paket_m">
					<input type="text" id="cari_resep" name="cari_resep" class="form-control" placeholder="Masukkan kata kunci paket resep ...">
					<div id="list-resep"></div>
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
						<tbody id="result-obat"></tbody>
					</table>
					<div class="text-center" style="margin-top: 10px;">
						<div class="row">
							<div class="col-md-6">
								<button id="gunakan_resep" class="btn btn-success form-control"><b>GUNAKAN</b></button>
							</div>
							<div class="col-md-6">
								<button id="hapus_list" class="btn btn-danger form-control" disabled><b>HAPUS</b></button>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix" style="margin-bottom: 20px"></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$('#cari_resep').keyup(function(){
		$('#list-resep').html('<i>Loading...</i>');
		var cari = $('#cari_resep').val();
		if (cari == '') {
			$('#list-resep').html('');
		}else {
			var data = {
				cari:cari,
				jenis:'Generic',
			};
			$.post("{{route('get_paket_resep')}}",data,function(data){
				var tag = '';
				if(data.data.length!=0){
					$.each(data.data,function(index,value){
						tag += '<a href="javascript:void(0)" onclick="setPaket(\''+value.id_paket_m+'\',\''+value.nama_paket+'\')">'+value.nama_paket+'</a><br>';
					});
				}else{
					tag = 'Tidak ditemukan';
				}
				$('#list-resep').html(tag);
			});
		}
	});

	function setPaket(id,nama){
		$('#result-obat').html('<tr><td colspan="3" style="text-align: center;">Loading...</td></tr>');
		$('#list-resep').html('');
		$('#cari_resep').val(nama);
		$('#id_paket_m').val(id);
		$.post("{{route('select_paket_resep')}}",{id:id, jns:'pilih', jenis:'Generic'},function(data){
			var html = '';
			if(data.data.length!=0){
				$.each(data.data,function(index,value){
					html += `<tr><td>${value.item_code}</td>
						<td>${value.item_name}</td>
						<td>${value.item_unitofitem}</td>
					</tr>`;
				});
			}
			$('#result-obat').html(html);
			$("#hapus_list").prop('disabled', false);
		});
	}

	$("#gunakan_resep").click(function (e) { 
		e.preventDefault();
		var id = $("#id_paket_m").val();
		$("#gunakan_resep").html('<i><b>MOHON TUNGGU...</b></i>');
		$("#gunakan_resep").prop('disabled',true);
		$.post("{{route('select_paket_resep')}}",{id:id, jns:'gunakan'},
			function(data){
			$('#hasilCari').html('');
			var html2 = '';
			var i = 0;
			var nos = '';
			var noR_trkhir = '';
			var signa = ['',''];
			if(data.data.length != 0){
				nos += '1';
				$.each(data.data, function(index,value){
					i++;
					if (value.signa) {
						signa = value.signa.split("x");
					}
					html2 += `
						<tr id="fr-${i}">
							<td class="min"></td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="no_R_${i}" id="no_R_${i}" style="width:30px;" value="${value.no_r}" class="bg-info"></td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="kode_obat_${i}" id="kode_obat_${i}" class="kode_obat bg-info" data-no="${i}" style="width:60px;" value="${value.KodeBrg}"></td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="nama_obat_${i}" id="nama_obat_${i}" class="nama_obat bg-info" data-no="${i}" value="${value.NamaBrg}"></td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="saldo_${i}" id="saldo_${i}" style="width:50px;" value="${value.saldo}" disabled class="bg-info"></td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="jumlah_${i}" id="jumlah_${i}" style="width:30px;" value="${(value.jumlah)?value.jumlah:''}"></td>
							<td class="min">
							  <input class="bg-info" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan_${i}" id="satuan_${i}" style="width:60px;" value="${value.Satuan}" class="bg-info">
							</td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="kode_gd_${i}" id="kode_gd_${i}" style="width:50px;" value="${value.KodeGd}" class="bg-info"></td>
							<td class="min"><input type="time" onkeydown="ModifyEnterKeyPressAsTab(event);" name="jam_signa_${i}" id="jam_signa_${i}" style="width:90px;" value='07:00:00' class="bg-info"></td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="signa1_${i}" id="signa1_${i}" style="width:30px;" value="${signa[0]}"></td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="signa2_${i}" id="signa2_${i}" style="width:30px;" value="${signa[1]}"></td>
							<td>
							  <input class="data-list-txt form-control bg-info" onkeydown="ModifyEnterKeyPressAsTab(event);" type="text" value="SESUDAH MAKAN" name="petunjuk_khusus_${i}" id="petunjuk_khusus_${i}">
							  <select style="width:160px;" class="data-list form-control" onkeydown="ModifyEnterKeyPressAsTab(event);" id="list2${i}" onchange="setValuePetunjuk2(this.value,${i})">
								<option value="" style="display:none"></option>
								<?php
								  foreach ($petunjuk_khusus as $key) {
									?>
									<option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
									<?php
								  }
								?>
							  </select>

							</td>
							<td class="min">
							  <select class="chzn-select form-control bg-info" onkeydown="ModifyEnterKeyPressAsTab(event);" name="satuan_signa_${i}" id="satuan_signa_${i}" style="width:120px;">
									<option value="" disabled selected></option>
										<?php
										foreach ($satuan_signa as $key) {
										  ?>
										  <option value="{!! $key->nilaichar !!}">{!! $key->nilaichar !!}</option>
										  <?php
										}
										?>
								</select>
							</td>
							<td class="min"><input type="text" onkeydown="ModifyEnterKeyPressAsTab(event);" name="signa_khusus_${i}" id="signa_khusus_${i}" placeholder="(Memo)"></td>
							<td class="min">
							  <select class="chzn-select form-control bg-info" onkeydown="ModifyEnterKeyPressAsTab(event);" name="is_kronis${i}" id="is_kronis${i}" style="width:120px;">
									<option value="" disabled selected>Pilih</option>
									<option value="Y">Kronis</option>
									<option value="N">Non Kronis</option>
								</select>
							</td>
							<td class="min">`;
							if (i != 1) {
								html2 += `<button type="button" name="button" class="btn btn-danger remove-fr" data-no="${i}">Hapus</button>`;
							}
						html2 += `</td>
							</tr>
					`;
					if (i != 1) {
						nos += `,${i}`;
					}
					noR_trkhir = value.no_r;
				});
			}
			$("#no_R_last").val(noR_trkhir);
			var html = `<input type="hidden" name="fr-count" id="fr-count" value="${i}">
					  <input type="hidden" name="fr-counter" id="fr-counter" value="${i}">
					  <input type="hidden" name="fr-nos" id="fr-nos" value="${nos}">
					  <input type="hidden" name="fr-no_R" id="fr-no_R" value="">`;
			html += html2;

			$('#hasilCari').html(html);
		});
		$('#myModal').modal('hide');
	});

	$("#hapus_list").click(function (e) { 
		e.preventDefault();
		var data = {
			id: $("#id_paket_m").val(),
			jenis: 'Generic',
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
			$("#hapus_list").html('<i><b>Loading ...</b></i>');
			$("#hapus_list").prop('disabled',true);
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
		});
	});

</script>
