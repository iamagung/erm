@extends('Admin.master.layout')

@section('extended_css')
@stop

@section('content')
<section class="content-header">
	<h1>
		{{ $title }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboardAdmin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><i class="fa fa-newspaper-o"></i> Modul Berita</li>
		<li class="active">Draft Berita</li>
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
				<!-- Search -->
				<div class="col-md-12 col-sm-12 col-xs-12 form-inline main-layer" style="text-align: right;padding:5px;">
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
	var datagrid = $("#datagrid").datagrid({
		url                     : "{!! route('AdmingetBeritaDraft') !!}",
		primaryField            : 'id_berita', 
		rowNumber               : true, 
		rowCheck                : false, 
		searchInputElement      : '#search', 
		searchFieldElement      : '#search-option', 
		pagingElement           : '#paging', 
		optionPagingElement     : '#option', 
		pageInfoElement         : '#info',
		columns                 : [
			{field: 'judul', title: 'Judul Berita', editable: false, sortable: true, width: 200, align: 'left', search: true},
			{field: 'nama_menu', title: 'Kategori', editable: false, sortable: true, width: 150, align: 'left', search: true},
			// {field: 'komentar', title: 'Komentar', editable: false, sortable: false, width: 300, align: 'left', search: false,
			// 	rowStyler: function(rowData, rowIndex) {
			// 		return komentar(rowData, rowIndex);
			// 	}
			// },
			{field: 'waktu', title: 'Waktu', editable: false, sortable: true, width: 150, align: 'left', search: true,
				rowStyler: function(rowData, rowIndex) {
					return waktu(rowData, rowIndex);
				}
			},
			{field: 'menu', title: 'Menu', sortable: false, width: 100, align: 'center', search: false, 
				rowStyler: function(rowData, rowIndex) {
					return menu(rowData, rowIndex);
				}
			}
		]
	});

	$(document).ready(function() {
		datagrid.run();
	});

	$('#btn-add').click(function(){
		$('.loading').show();
		$('.main-layer').hide();
		$.post("{!! route('formAddEditor') !!}").done(function(data){
			if(data.status == 'success'){
				$('.loading').hide();
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-layer').show();
			}
		});
	});

	function komentar(rwoData, rowIndex){
		var komentar = "<i class='fa fa-comment-o'> 0 Komentar</i>";
		return komentar;
	}

	function waktu(rowData, rowIndex){
		var waktu = '<div> Tanggal '+rowData.tanggal+'<br/>Jam ('+rowData.jam+')';
		return waktu;
	}

	function menu(rowData, rowIndex) {
        var menu =
	        '<div class="btn-group">' +
	        '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a>' +
	        '<ul class="dropdown-menu pull-right">' +
	        '<li onclick="detailBerita(' + rowIndex + ')"><a href="javascript:void(0);"><i class="fa fa-eye"></i> View</a></li>' +
	        '<li onclick="editBerita(' + rowIndex + ')"><a href="javascript:void(0);"><i class="fa fa-pencil"></i> Edit</a></li>' +
	        '<li onclick="hapusBerita(' + rowIndex + ')"><a href="javascript:void(0);"><i class="fa fa-trash-o"></i> Delete</a></li>' +
	        '</ul>' +
	        '</div>';
        return menu;
    }

    function detailBerita(rowIndex){
        var rowData = datagrid.getRowData(rowIndex);
        var base = '<?php echo url('/')?>';
		var win = window.open(base+'/berita/'+rowData.id_berita+'-detail.html', '_blank');
  		win.focus();
    }

    function editBerita(rowIndex){
        var rowData = datagrid.getRowData(rowIndex);
		$('.loading').show();
		$('.main-layer').hide();
        // swal("Good",rowData.judul,"success");
        $.post("{!! route('AdminupdateBerita') !!}",{id:rowData.id_berita}).done(function(data){
			$('.loading').hide();
			if(data.status == 'success'){
				$('.other-page').html(data.content).fadeIn();
			} else if(data.status=='fail'){
				$('.main-layer').show();
				swal("Maaf","Ini bukan berita milik anda !","error");
			} else {
				$('.main-layer').show();
			}
		});
    }

    function hapusBerita(rowIndex){
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
			$.post("{!! route('AdmindoDeleteBerita') !!}",{id:rowData.id_berita}).done(function(data){
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

</script>
@stop