@extends('admin.master.layout')

@section('extended_css')
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
				<div class="col-md-4 col-sm-4 col-xs-12 form-inline main-layer" style='padding:5px'>&nbsp;
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
	</div>
</section>
@stop

@section('js')
<script type="text/javascript">
	var id = "{!! $data['id'] !!}";
	var datagrid = $("#datagrid").datagrid({
		url                     : "{!! route('tampilBeritaPilihan') !!}",
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
			{field: 'video', title: 'Gambar', editable: false, sortable: false, width: 150, align: 'left', search: false,
				rowStyler: function(rowData, rowIndex) {
					return video(rowData, rowIndex);
				}
			},
			{field: 'judul', title: 'Judul', editable: false, sortable: true, width: 200, align: 'left', search: true},
			{field: 'terbit', title: 'Terbit', editable: false, sortable: true, width: 150, align: 'left', search: true,
				rowStyler: function(rowData, rowIndex) {
					return terbit(rowData, rowIndex);
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
	
	function video(rowData, rowIndex){
		var video = '<img src="{!! url("adminasset/assets/images/berita/'+rowData.gambar+'") !!}" width="100%"';
		return video;
	}

	function updated(rowIndex){
		var rowData = datagrid.getRowData(rowIndex);
		$('.loading').show();
		$('.main-layer').hide();
		var id="{!! $data['id'] !!}";
		$.post("{!! route('formUpdateBeritaPilihan') !!}", {id:rowData.id_berita_pilihan, berita:rowData.berita_id}).done(function(data){
			if(data.status == 'success'){
				$('.loading').hide();
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-layer').show();
			}
		});
	}

	function terbit(rowData, rowIndex){
		var terbit = '<div class="col-lg-12 cl-md-12">Tanggal : '+rowData.tanggal+'</div>'+
		'<div class="clearfix"></div>'+
		'<div class="col-lg-12 col-md-12">Pukul : '+rowData.jam+'</div>';
		return terbit;
	}
	function edit(rowData, rowIndex) {
		var tag = '<a href="javascript:void(0)" class="btn btn-sm btn-info m-0" onclick="updated('+rowIndex+')"><span class="fa fa-pencil"></span> &nbsp Edit</a>';
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