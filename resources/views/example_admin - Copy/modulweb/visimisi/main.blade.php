@extends('admin.master.layout')
@section('css')
@stop

@section('content')
	<div class="widget-box col-lg-12 col-sm-12">
		<div class="widget-header widget-header-blue widget-header-flat">
			<h4 class="widget-title lighter">New Item Wizard</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main">
				
				<form class="form-horizontal" id="validation-form" method="get" action="{!! route('updatevm') !!}" >
					
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="password2">Visi :</label>
						<div class="col-xs-12 col-sm-10">
							<div class="clearfix">
								<textarea name="visi" id="visi" class="col-xs-12 col-sm-10">{!! $data['identitas']->visi !!}</textarea>
							</div>
						</div>
					</div>

					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="password2">Misi :</label>
						<div class="col-xs-12 col-sm-10">
							<div class="clearfix">
								<textarea name="misi" id="misi" class="col-xs-12 col-sm-10">{!! $data['identitas']->misi !!}</textarea>
							</div>
						</div>
					</div>

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
<script>

    function loadFilePhoto(event) {
        var image = URL.createObjectURL(event.target.files[0]);
            $('#preview-photo').fadeOut(function(){
                $(this).attr('src', image).fadeIn().css({
                    '-webkit-animation' : 'showSlowlyElement 700ms',
                    'animation'         : 'showSlowlyElement 700ms'
                });
            });
    };

    $('#btn_simpan').click(function(){
    	$('#main_content').hide();
    	$('.loading').show();
    });

    $('textarea#visi').ckeditor({width:'100%', height: '150px', toolbar: [
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

    $('textarea#misi').ckeditor({width:'100%', height: '150px', toolbar: [
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