@extends('admin.master.layout')

@section('css')
@stop

@section('content')
<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
	<div class="loading" align="center" style="display: none;">
		<img src="{!! url('adminasset/assets/img/loadings.gif') !!}" width="45%">
	</div>
</div>
<section class="content">
	<div class="row">
		<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='padding:0px'>
			<div class="box box-primary main-layer">
				<div class="col-md-4 col-sm-4 col-xs-12 form-inline main-layer" style='padding:5px'>
					<button type="button" class="btn btn-sm btn-primary" id="btn-add">
						<span class="fa fa-plus"></span> &nbsp New {{ $data['title_main_sub'] }}
					</button>
				</div>
				<!-- Search -->
				<div class="col-md-8 col-sm-8 col-xs-12 form-inline main-layer" style="text-align: right;padding:5px;">
					<div class="form-group">
						<select class="input-sm form-control input-s-sm inline v-middle option-search" id="search-option"></select>
					</div>
					<div class="form-group">
						<input type="text" class="input-sm form-control" placeholder="Search" id="search">
					</div>
				</div>
				<div class='clearfix'></div>
				<div class="col-md-12" style='padding:0px'>
					<!-- Datagrid -->
					<div class="table-responsive">
						<table class="table table-striped b-t b-light" id="datagrid"></table>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<!-- Page Option -->
							<div class="col-sm-1 hidden-xs">
								<select class="input-sm form-control input-s-sm inline v-middle option-page" id="option"></select>
							</div>
							<!-- Page Info -->
							<div class="col-sm-6 text-center">
								<small class="text-muted inline m-t-sm m-b-sm" id="info"></small>
							</div>
							<!-- Paging -->
							<div class="col-sm-5 text-right text-center-xs">
								<ul class="pagination pagination-sm m-t-none m-b-none" id="paging"></ul>
							</div>
						</div>
					</footer>
				</div>
				<div class='clearfix'></div>
			</div>
			<div class="other-page"></div>
			<div class="modal-dialog"></div>
		</div>
	</section>
@stop

@section('js')

<script type="text/javascript">
	var datagrid = $("#datagrid").datagrid({
		url                     : "{{ route('tampileditor') }}",
		primaryField            : 'id', 
		rowNumber               : true, 
		rowCheck                : false, 
		searchInputElement      : '#search', 
		searchFieldElement      : '#search-option', 
		pagingElement           : '#paging', 
		optionPagingElement     : '#option', 
		pageInfoElement         : '#info',
		columns                 : [
			{field: 'name', title: 'Nama', editable: false, sortable: false, width: 150, align: 'left', search: true,
				rowStyler: function(rowData, rowIndex) {
					return video(rowData, rowIndex);
				}
			},
			{field: 'email', title: 'Username', editable: false, sortable: true, width: 200, align: 'left', search: true},
			// {field: 'previllage', title: 'Previllage', editable: false, sortable: true, width: 200, align: 'left', search: true},
			{field: 'pre', title: 'Previllage', editable: false, sortable: true, width: 100, align: 'left', search: false,
				rowStyler: function(rowData, rowIndex) {
					return pre(rowData, rowIndex);
				}
			},
			{field: 'edit', title: 'Edit', editable: false, sortable: false, width: 200, align: 'left', search: false,
				rowStyler: function(rowData, rowIndex) {
					return edit(rowData, rowIndex);
				}
			},
		]
	});

	$(document).ready(function() {
		datagrid.run();
	});

	$('#btn-add').click(function(){
		$('.loading').show();
		$('.main-layer').hide();
		$.post("{!! route('formaddeditor') !!}").done(function(data){
			if(data.status == 'success'){
				$('.loading').hide();
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-layer').show();
			}
		});
	});

	function hapus(rowIndex){
		var rowData = datagrid.getRowData(rowIndex);
	    swal({
			title:"Hapus Editor",
			text:"Apakah anda yakin ?",
			type:"warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Saya yakin!",
			cancelButtonText: "Batal!",
			closeOnConfirm: false
		},
		function(){
			$.post("{!! route('deleteeditor') !!}",{id:rowData.id}).done(function(data){
				if(data.status == 'success'){
					datagrid.reload();
					swal("Success!", "Editor telah dihapus !", "success");
				}else{
					datagrid.reload();
					swal("Maaf!", "Editor Gagal dihapus !", "error");
				}
			});
		});
	}

	function updated(rowIndex){
		var rowData = datagrid.getRowData(rowIndex);
		$('.loading').show();
		$('.main-layer').hide();
		$.post("{!! route('formaddeditor') !!}", {id:rowData.id}).done(function(data){
			if(data.status == 'success'){
				$('.loading').hide();
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-layer').show();
			}
		});
	}

	function reset(rowIndex){
		var rowData = datagrid.getRowData(rowIndex);
		$.post("{!! route('resetpasswordeditor') !!}", {id:rowData.id}).done(function(data){
			if(data.status == 'success'){
				datagrid.reload();
				swal("Success!", "Password berhasil diset ulang, default sama dengan email/username !", "success");
			}else{
				datagrid.reload();
				swal("Maaf!", "Password Gagal diset Ulang !", "error");
			}
		});
	}

	function video(rowData, rowIndex){
		if(rowData.kategori_galeri=='1'){
			var video = '<img src="{!! url("adminasset/assets/images/gallery/'+rowData.file_galeri+'") !!}" width="100%"';
		}else{
			var video = rowData.file_galeri;
		}
		return video;
	}
	function edit(rowData, rowIndex) {
		var tag = '<a href="javascript:void(0)" class="btn btn-sm btn-info m-0" onclick="updated('+rowIndex+')"><span class="fa fa-pencil"></span> &nbsp Edit</a>'+
		'<a href="javascript:void(0)" class="btn btn-sm btn-danger m-0" onclick="hapus('+rowIndex+')"><span class="fa fa-trash"></span> &nbsp Hapus</a>'+
		'<a href="javascript:void(0)" class="btn btn-sm btn-warning m-0" onclick="reset('+rowIndex+')"><span class="fa fa-refresh"></span> &nbsp Password</a>';
		return tag;
	}

	function pre(rowData, rowIndex){
		var tag = '';
		$cek = rowData.previllage.split(',');
		for (var i = 0; i < $cek.length - 1; i++) {
			if($cek[i] == 1){
				tag += 'berita,'; 
			}else if($cek[i] == 2){
				tag += 'even,'; 
			}else if($cek[i] == 3){
				tag += 'pengumuman,'; 
			}else if($cek[i] == 4){
				tag += 'galeri,'; 
			}
		}
			

		return tag;
	}
</script>
@stop