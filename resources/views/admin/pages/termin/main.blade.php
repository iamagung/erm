@extends('admin.master.main')
@section('content')
<div class="col-lg-12 col-md-12">
    <h3>Syarat dan Ketentuan</h3>
</div>
<div class="clearfix"></div>
<form method="post" action="{{route('updateTerm')}}">
    {{ csrf_field() }}
    <div class="col-lg-12 col-md-12">
        <textarea id="editor1" name="syarat">{!! $identitas->info !!}</textarea>
    </div>
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12" style="text-align: center;">
        <input type="submit" value="Simpan" class="btn btn-success">
    </div>
    <div class="clearfix"></div>
</form>
@stop
@section('js')
<script src="{!! url('adminAsset/js/ckeditor1/ckeditor.js') !!}"></script>
<script src="{!! url('adminAsset/js/ckeditor1/adapters/jquery.js') !!}"></script>
<script type="text/javascript">
    CKEDITOR.env.isCompatible = true;
    $( '#editor1' ).ckeditor({width:'100%', height: '400px', toolbar: [
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
        CKEDITOR.env.isCompatible = true,
    ]});
</script>
@stop