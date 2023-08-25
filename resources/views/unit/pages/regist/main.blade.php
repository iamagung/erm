@extends('unit.master.main')
@section('content')

<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">
	<h1 class="text-center">
		<b>Data Pasien Hari Ini</b>
	</h1>
</section>
<div class="col-md-12 col-md-12">
	<div class="box">
		<div class="box-header">
			<div class="box-tools pull-right">
				<button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="clearfix" style="margin-bottom: 10px"></div>
			<div class="col-lg-12 col-md-12" style="padding: 0px">
				<div class="col-lg-8 col-md-8" style="padding: 0px">
					<div class="col-lg-6 col-md-6">
						<input type="text" id="searchtext" name="search" class="form-control" style="border-radius: 10px !important" placeholder="Search...">
						<input type="text" name="searchdate" id="searchdate" style="display: none;border-radius: 10px !important" class="form-control date lahir">
					</div>
					<div class="col-lg-6 col-md-6">
						<select class="form-control" name="searchby" style="border-radius: 10px !important">
							<option value="Nama_Pasien">Nama Pasien</option>
							<option value="No_Register">Nomor Regist</option>
							<option value="No_RM">No RM</option>
						</select>
					</div>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>
			<div class="col-lg-12 col-md-12" style="overflow: auto">
				<table class="table table-bordered table-striped" id="dataPoli">
					<thead>
						<tr>
							<th width="5%">No Antrian</th>
							<th>No. Register</th>
							<th>Nama Pasien</th>
							<th>No. RM</th>
							<th>Poli Asal</th>
							<th>Tanggal</th>
							<th width="15%">Aksi</th>
						</tr>
					</thead>
					<tbody id="hasilCari">
						<?php
							$i=1;
							foreach ($regist as $key) { ?>
							<tr>
								<td>{!! ($key->noAntre != '-')?$key->noAntre:$key->noUrut !!}</td>
								<td>{!! $key->no_Register !!}</td>
								<td>{!! $key->Nama_Pasien !!}</td>
								<td>{!! $key->no_RM !!}</td>
								<td>{!! $key->DariPoli !!}</td>
								<td>{!! date('d-m-Y h:i:s', strtotime($key->tanggalPengerjaan)) !!}</td>
								<td>
									<?php
									if($key->id_antre != '-'){
										$panggil = "panggil(".$key->id_antre.")";
										$id_antre = $key->id_antre;
									} else {
										$panggil = "swal('Notice!','Pasien tidak punya nomor antrean poli!','error')";
										$id_antre = 0;
									}
									?>
									<a href="javascript:void(0);" onclick="{{$panggil}}" class="btn btn-sm btn-success"><i class="fa fa-bell" aria-hidden="true"></i></a>
									<a href="{!! url('unit/add_rekap_medik/setPasien/'.$key->rekapMedik_id) !!}" class="btn btn-sm btn-primary kerjakan">Kerjakan</a>
								</td>
							</tr>
						<?php $i++; } ?>
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
			<div class="col-lg-12 col-md-12">
				<div>
					<ul class="pagination" style="float:none">
						<?php
							$paging1 = ceil(count($total)/10);
							$page=1;
						?>
						<li class='disabled'><a href='javascript:void(0);'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>
						<li class='disabled'><a href='javascript:void(0);'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>
						<?php
							$batas = 4;
							$start_number = ($page > $batas)? $page - $batas : 1;
							$end_number = ($page < ($paging1 - $batas))? $page + $batas : $paging1;
							for ($i = $start_number; $i <= $end_number; $i++) {
								if($i==1){
									$a = 'class="active"';
								}else{
									$a = '';
								}
								echo "<li $a><a href='javascript:void(0);' onclick='page($i)'>$i</a></li>";
							}
							if($page==$paging1){ ?>
								<li class="disabled"><a href='javascript:void(0);'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
								<li class="disabled"><a href='javascript:void(0);'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
							<?php } else { ?>
								<li><a href='javascript:void(0);' onclick="page({!! $start_number+1 !!})"><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
								<li><a href='javascript:void(0);' onclick="page({!! $paging1 !!})"><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
							<?php } ?>
					</ul>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="modal_layout"></div>
	<div id="myModal" class="modal fade" role="dialog" style="">
		<div class="modal-dialog text-center" style="margin: 20% auto;" role="document">
			<span class="fa fa-spinner fa-spin fa-3x w-100"></span>
		</div>
	</div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">

	function page(i){
		var searchby = $('select[name=searchby]').val();
		var cariText = $('#searchtext').val();
		var cariStatus = $('#searchdate').val();
		var hasil = 'searchby = '+searchby+'\ncariText = '+cariText+'\ncariStatus = '+cariStatus+'\ni = '+i;
		$.post("{!! route('pageRegistPerawat') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:i}).done(function(data){
			$('#hasilCari').html('');
			$('#hasilCari').html(tampilkan(data.i, data.data));
			$('.pagination').html(halaman_page(data.i,data.data));
		});
	}

	function halaman_page(i,data){
		var pageination = '';
		if(i==1){
			pageination+= "<li class='disabled'><a href='javascript:void(0);'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
			"<li class='disabled'><a href='javascript:void(0);'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
		}else{
			pageination+= "<li><a href='javascript:void(0);' onclick='page(1)'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
			"<li><a href='javascript:void(0);' onclick='page("+(i-1)+")'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
		}

		var batas = 4;
		var start = '';
		var end = '';
		var akhir = Math.ceil((data.total.length/10));

		if(i>batas){
			start = parseInt(i)-parseInt(batas);
		}else{
			start = 1;
		}

		if(i<(akhir-batas)){
			end = parseInt(i)+parseInt(batas);
		}else{
			end = akhir;
		}

		var a='';
		for (var j = start; j <= end; j++) {
			if(j==i){
				a = 'class="active"';
			}else{
				a ='';
			}
			pageination+="<li "+a+"><a href='javascript:void(0);' onclick='page("+j+")'>"+j+"</a></li>";
		}

		if(i==akhir){
			pageination+="<li class='disabled'><a href='javascript:void(0);'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
			"<li class='disabled'><a href='javascript:void(0);'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
		}else{
			pageination+="<li><a href='javascript:void(0);' onclick='page("+(parseInt(i)+1)+")'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
			"<li><a href='javascript:void(0);' onclick='page("+akhir+")'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
		}
		return pageination;
		// return alert('batas = '+batas+'\ni = '+i+'\nstart = '+start+'\nAkhir = '+end);
	}

	$('input[name=id]').keyup(function(){
		$('#btnProses').attr('disabled','disabled');
	});

	$('#btnCek').click(function(){
		var rm = $('input[name=id]').val();
		if(rm=='Budiman'){
			$('#btnProses').removeAttr('disabled');
			$('#nama').val('Budiman');
			$('#jk').val('Laki-laki');
			$('#tgl_lahir').val('1994-06-28');
		}else{
			return alert('Data not found');
		}
	});

	$('.lahir').datetimepicker({
		//language:  'fr',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		format:'yyyy-mm-dd HH:ii',
		minView: 0,
		forceParse: 0,
	});

	$('select[name=searchby]').change(function(){
		var searchby = $('select[name=searchby]').val();
		var cariText = '';
		var cariStatus = $('#searchdate').val();
		$('#searchtext').val('');
		if(searchby=='Tgl_Register'){
			$('#searchtext').hide();
			$('#searchdate').show();
		}else{
			$('#searchtext').show();
			$('#searchdate').hide();
		}
		$.post("{!! route('pageRegistPerawat') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
			if(data.status=='success'){
				$('#hasilCari').html('');
				$('#hasilCari').html(tampilkan(data.data));
				$('.pagination').html(halaman_page(1,data.data));
			}
		});
	});

	$('select[name=searchdate]').change(function(){
		var searchby = $('select[name=searchby]').val();
		var cariText = $('#searchtext').val();
		var cariStatus = $('#searchdate').val();
		$.post("{!! route('pageRegistPerawat') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
			if(data.status=='success'){
				$('#hasilCari').html('');
				$('#hasilCari').html(tampilkan(data.data));
				$('.pagination').html(halaman_page(1,data.data));
			}
		});
	});

	$('#searchtext').keyup(function(){
		var cariText = $('#searchtext').val();
		var cariStatus = $('#searchdate').val();
		var by = $('select[name=searchby]').val();
		$.post("{!! route('pageRegistPerawat') !!}",{cariText:cariText,cariStatus:cariStatus,by:by,i:1}).done(function(data){
			if(data.status=='success'){
				$('#hasilCari').html('');
				$('#hasilCari').html(tampilkan(data.data));
				$('.pagination').html(halaman_page(1,data.data));
			}
		});
	});

	function tampilkan(no='',data){
		var d = data.data.length;
		var html = '';
		if(d==0){
			html = '<tr>'+
			'<td colspan="7">Data tidak ada</td>'+
			'</tr>';
		}else{
			var i=1;
			if (no > 1) {
				i = (no-1)+'1';
			}
			$.each( data.data, function( key, value ) {
				var tgl, nourut, panggil = '';
				var id_antre = '0';
				var sp = value.Tgl_Register;
				var sp_tgltime = sp.split(" ");
				var sp_tgl = sp_tgltime[0].split("-");
				tgl = sp_tgl[2]+'-'+sp_tgl[1]+'-'+sp_tgl[0];
				if (value.noAntre != "-") {
					nourut = value.noAntre;
				} else {
					nourut = value.NoUrut;
				}

				if (value.id_antre != "-") {
					panggil = `panggil(${value.id_antre})`;
					id_antre = value.id_antre;
				} else {
					panggil = `swal('Notice!','Pasien tidak punya nomor antrean poli!','error')`;
				}
				html += '<tr>'+
				'<td>'+nourut+'</td>'+
				'<td>'+value.No_Register+'</td>'+
				'<td>'+tgl+' '+value.Jam_Register+'</td>'+
				'<td>'+value.No_RM+'</td>'+
				'<td>'+value.Nama_Pasien+'</td>'+
				'<td>'+
				`<a href="javascript:void(0);" onclick="${panggil}" class="btn btn-sm btn-success"><i class="fa fa-bell" aria-hidden="true"></i></a>
				<a href="{!! url("/") !!}/perawat/add_rekap_medik/setPasien/${value.No_Register}/${id_antre}" class="btn btn-sm btn-primary kerjakan">Kerjakan</a>`+
				'</td>'+
				'</tr>';
				i++;
			});
		}
		return html;
	}

	$(".kerjakan").click(function() {
		$("#myModal").modal({
			backdrop: "static", 
			keyboard: false, 
			show: true 
		});
	});

	function panggil(id_antrean){
		swal('Notice!', 'Masih Dalam Tahap Pengembangan! Udah masuk ke kontroler. Tinggal simpan ke tabel yang buat pemanggilan.', 'info');
	}
</script>
@stop
