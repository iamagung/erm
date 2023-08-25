@extends('Admin.master.layout')

@section('extended_css')
@stop

@section('content')
<section class="content-header">
	<h1>
		{{ $title }}
		<small>( {{$title}} )</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboardAdmin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><i class="fa fa-newspaper-o"></i> Modul Berita</li>
		<li class="active">{{$title}}</li>
	</ol>
</section>
<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
	<div class="loading" align="center" style="display: none;">
		<img src="{!! url('AssetsAdmin/dist/img/loading.gif') !!}" width="45%">
	</div>
</div>
<section class="content">
	<div class="row">
		<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='padding:0px'>
			<div class="box box-primary main-layer">
				<div class="col-md-4 col-sm-4 col-xs-12 form-inline main-layer" style='padding:5px'>
					<button type="button" class="btn btn-sm btn-primary" id="btn-add">
						<span class="fa fa-plus"></span> &nbsp New {{$title}}
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

@section('script')
<script type="text/javascript">
	var id="<?php echo $id ?>"
	var datagrid = $("#datagrid").datagrid({
		url                     : "{!! route('tampilBeritaSekolah') !!}",
		queryParams 			: { kategori : id },
		primaryField            : 'id_berita', 
		rowNumber               : true, 
		rowCheck                : false, 
		searchInputElement      : '#search', 
		searchFieldElement      : '#search-option', 
		pagingElement           : '#paging', 
		optionPagingElement     : '#option', 
		pageInfoElement         : '#info',
		columns                 : [
			{field: 'judul', title: 'Judul', editable: false, sortable: true, width: 200, align: 'left', search: true},
			{field: 'terbit', title: 'Terbit', editable: false, sortable: true, width: 150, align: 'left', search: true,
				// custom_search: {appendClass: 'input-sm form-control',
    //                 option: [
    //                 	{text:'Aktif',value:'1'},
    //                 	{text:'Tidak Aktif',value:'0'}
    //                 ]
    //             },
				rowStyler: function(rowData, rowIndex) {
					return terbit(rowData, rowIndex);
				}
			},
			{field: 'statu', title: 'Status', editable: false, sortable: true, width: 150, align: 'left', search: true,
				custom_search: {appendClass: 'input-sm form-control',
                    option: [
                    	{text:'Aktif',value:'1'},
                    	{text:'Tidak Aktif',value:'0'}
                    ]
                },
				rowStyler: function(rowData, rowIndex) {
					return status(rowData, rowIndex);
				}
			},
			{field: 'edit', title: 'Edit', editable: false, sortable: true, width: 150, align: 'left', search: false,
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
		var id="<?php echo $id ?>";
		$.post("{!! route('formAddBeritaSekolah') !!}",{kategori: id}).done(function(data){
			if(data.status == 'success'){
				$('.loading').hide();
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-layer').show();
			}
		});
	});

	function updated(rowIndex){
		var rowData = datagrid.getRowData(rowIndex);
		$('.loading').show();
		$('.main-layer').hide();
		var id="<?php echo $id ?>";
		$.post("{!! route('formUpdateBeritaSekolah') !!}", {id:rowData.id_berita,kategori: id }).done(function(data){
			if(data.status == 'success'){
				$('.loading').hide();
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-layer').show();
			}
		});
	}

	function hapus(rowIndex){
		var rowData = datagrid.getRowData(rowIndex);
	    swal({
			title:"Hapus berita",
			text:"Apakah anda yakin ?",
			type:"warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Saya yakin!",
			cancelButtonText: "Batal!",
			closeOnConfirm: false
		},
		function(){
			$.post("{!! route('deleteBeritaSekolah') !!}",{id:rowData.id_berita}).done(function(data){
				if(data.status == 'success'){
					datagrid.reload();
					swal("Success!", "Berita telah dihapus !", "success");
				}else if(data.status=='fail'){
					datagrid.reload();
					swal("Maaf!", "Anda bukan pemilik berita ini !", "error");
				}else{
					datagrid.reload();
					swal("Maaf!", "Berita telah dihapus sebelum ini !", "error");
				}
			});
		});
	}

	function terbit(rowData, rowIndex){
		var terbit = '<div class="col-lg-12 cl-md-12">Tanggal : '+rowData.tanggal+'</div>'+
		'<div class="clearfix"></div>'+
		'<div class="col-lg-12 col-md-12">Pukul : '+rowData.jam+'</div>';
		return terbit;
	}
	function edit(rowData, rowIndex) {
		var tag = '<a href="javascript:void(0)" class="btn btn-sm btn-info m-0" onclick="updated('+rowIndex+')"><span class="fa fa-pencil"></span> &nbsp Edit</a>'+
		'<a href="javascript:void(0)" class="btn btn-sm btn-danger m-0" onclick="hapus('+rowIndex+')"><span class="fa fa-trash"></span> &nbsp Hapus</a>';
		return tag;
	}
	function status(rowData, rowIndex){
		var tag = '';
		if(rowData.status==1){
			tag='Aktif';
		}else{
			tag='Tidak Aktif';
		}
		return tag;
	}
</script>
@stop