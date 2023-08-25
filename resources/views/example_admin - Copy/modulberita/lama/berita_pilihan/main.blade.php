@extends('Admin.master.layout')

@section('extended_css')
<link rel="stylesheet" type="text/css" href="{{url('chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('chosen/docsupport/prism.css')}}">
@stop

@section('content')
<section class="content-header">
	<h1>
		{{ $title }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboardAdmin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><i class="fa fa-newspaper-o"></i> Modul Berita</li>
		<li class="active">Berita Pilihan</li>
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
				<form method='post' action="{{ route('AdminsimpanPilihan') }}">
					{{ csrf_field() }}
					<div class="col-md-12" style="padding: 0px">
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Judul
							</label>
							<div class="col-lg-12 col-md-12">
								<select data-placeholder="Pilih berita..." class="chosen-select form-control" tabindex="2" name="judul" required id="judul">
						            <option value=""></option>
						            <?php
						            $berita_pilihan = App\Http\Models\Berita_pilihan::select('berita_id')->get();
						            $berita = DB::table('berita')->whereNotIn('id_berita',$berita_pilihan)->where('status','1')->orderBy('id_berita','DESC')->get();
						            foreach ($berita as $key) {
						            	?>
						            	<option value="{{$key->id_berita}}">{{$key->judul}}</option>
						            	<?php
						            }
						            ?>
						        </select>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Kategori
							</label>
							<div class="col-lg-12 col-md-12">
								<input class="form-control" type="text" id="kategori" readonly>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Gambar
							</label>
							<div class="col-lg-12 col-md-12">
								<img id="preview-photo" src="" class="img-polaroid" width="200" style="display: none">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Isi Berita
							</label>
							<div class="col-lg-12 col-md-12">
								<p id="isi"></p>
							</div>
						</div>
						<!-- <div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Tag Berita
							</label>
							<div class="col-lg-12 col-md-12">
	                            <input type="text" id="category" name="listKeyword" value="">
	                        </div>
						</div> -->
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<div class="col-lg-4 col-md-4">
								<input type="submit" class="btn btn-primary" value="Save" style="width:80%;padding: 20px">								
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
					</div>
					<div class='clearfix'></div>
				</form>
			</div>
			<div class="other-page"></div>
			<div class="modal-dialog"></div>
		</div>
	</section>
@stop
@section('script')

<script src="{{url('chosen/chosen.jquery.js')}}" type="text/javascript"></script>
<script src="{{url('chosen/docsupport/prism.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{url('chosen/docsupport/init.js')}}" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" href="{{url('tag_input/bootstrap-tagsinput.css')}}">
<script src="{{url('tag_input/bootstrap-tagsinput.js')}}"></script>
<script src="{{url('tag_input/bootstrap3-typeahead.js')}}"></script>

<script src="{!! url('AssetsAdmin/dist/js/ckeditor1/ckeditor.js') !!}"></script>
<script src="{!! url('AssetsAdmin/dist/js/ckeditor1/adapters/jquery.js') !!}"></script>
<script type="text/javascript">

	$('#category').tagsinput({
	  typeahead: {
	    source: ['Mojokerto','Jombang','Kediri','Pare']
	  },
	  freeInput: true
	});
	
	$('#category').on('itemAdded', function(event) {
	    setTimeout(function(){
	        $(">input[type=text]",".bootstrap-tagsinput").val("");
	    },1);
	});

	$( 'textarea#editor1' ).ckeditor({width:'100%', height: '150px', toolbar: [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: ['NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-'] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        { name: 'tools', items: [ 'Maximize' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
        { name: 'styles', items: [ 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
    ]});

	$('#judul').change(function(){
		var id = $('#judul').val();
		$.post("{!! route('AdmingetPilihan') !!}",{id:id}).done(function(data){
			if(data.status=='success'){
				$('#kategori').val(data.kategori.nama_menu);
				$('#preview-photo').fadeOut(function(){
		        	$('#preview-photo').show();
		            $(this).attr('src', data.path).fadeIn().css({
		                '-webkit-animation' : 'showSlowlyElement 700ms',
		                'animation'         : 'showSlowlyElement 700ms'
		            });
		        });
		        $('#isi').html(data.berita.isi);
			}
		});
	});

    function loadFilePhoto(event) {
        var image = URL.createObjectURL(event.target.files[0]);
        $('#preview-photo').fadeOut(function(){
        	$('#preview-photo').show();
            $(this).attr('src', image).fadeIn().css({
                '-webkit-animation' : 'showSlowlyElement 700ms',
                'animation'         : 'showSlowlyElement 700ms'
            });
        });
    };
</script>
@stop