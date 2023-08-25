@extends('admin.master.layout')
@section('css')
@stop

@section('content')
	<div class="widget-box col-lg-12 col-sm-12">
		<div class="widget-header widget-header-blue widget-header-flat">
			<h4 class="widget-title lighter">Form {{ $data['profile']->judul }}</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main">
				
				<form class="form-horizontal" id="validation-form" method="post" action="{{ route('updateprofil') }}"  enctype='multipart/form-data'>
					{{ csrf_field() }}
					<input type="hidden" name="kategori" value="{{ $data['profile']->kategori }}">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password2">Icon :</label>
						<div class="col-xs-12 col-sm-9">
							<div class='clearfix' style='padding-bottom:5px'></div>
							<input type="file" class="upload" onchange="loadFilePhoto(event)" name="icon" accept="image/*" class="form-control customInput input-sm col-md-7 col-xs-12">
						</div>
						<hr>
						<div class="crop-edit center">
							@if(!empty($data['profile']->gambar))
								<img id="preview-photo" src="{!! url('adminasset/assets/images/profileweb/'.$data['profile']->gambar) !!}" class="img-polaroid" width="250" height="250">
							@else
								<img id="preview-photo" src="{!! url('adminasset/assets/img/default-50x50.gif') !!}" class="img-polaroid" width="250" height="250">
							@endif
						</div>
					</div>

					<div class="space-2"></div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password2">Deskripsi :</label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<textarea name="deskripsi" id="deskripsi" class="col-xs-12 col-sm-10">{!! $data['profile']->deskripsi !!}</textarea>
							</div>
						</div>
					</div>

					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password2">&nbsp;</label>
						<div class="col-xs-12 col-sm-9">
							<button type="submit" class="btn btn-primary"> Simpan</button>
							<button type="reset" class="btn btn-warning">Reset</button>
						</div>
					</div>
				</form>
			</div><!-- /.widget-main -->
		</div><!-- /.widget-body -->
	</div>
@stop

@section('js')
<script src="{!! url('adminasset/assets/plugin/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! url('adminasset/assets/plugin/ckeditor/adapters/jquery.js') !!}"></script>
<script type="text/javascript">
    function loadFilePhoto(event) {
        var image = URL.createObjectURL(event.target.files[0]);
            $('#preview-photo').fadeOut(function(){
                $(this).attr('src', image).fadeIn().css({
                    '-webkit-animation' : 'showSlowlyElement 700ms',
                    'animation'         : 'showSlowlyElement 700ms'
                });
            });
    };

        $('textarea#deskripsi').ckeditor({width:'100%', height: '150px', toolbar: [
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
        CKEDITOR.env.isCompetible = true,
    ]});

</script>
@stop