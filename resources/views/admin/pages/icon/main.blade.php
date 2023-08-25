@extends('admin.master.main')
@section('content')
<div class="col-lg-12 col-md-12">
    <h3>Logo</h3>
</div>
<div class="clearfix"></div>
<form method="post" action="{{route('updateLogo')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-lg-12 col-md-12">
    	<img src="{!! asset($identitas->favicon) !!}" style="width: 20%">
    	<input type="file" id="foto11" accept="image/*" name="logo">
    	<img src="" id="hfoto11" style="width: 20%">
    </div>
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12" style="padding: 0px">
        <div class="col-lg-6 col-md-6">
            <div class="col-lg-12 col-md-12" style="padding: 0px">
                <label>Format Pertanyaan</label>
                <textarea id="editor1" class='form-control' name="tanya">{{$identitas->tanya}}</textarea>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="col-lg-12 col-md-12" style="padding: 0px">
                <label>Format Menjawab</label>
              <textarea id="editor2" class='form-control' name="jawab">{{$identitas->jawab}}</textarea>
            </div>
        </div>
    </div>
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12" style="text-align: center;">
        <input type="submit" value="Simpan" class="btn btn-success">
    </div>
    <div class="clearfix"></div>
</form>
@stop
@section('js')
<script type="text/javascript">
	
function readURL1(input,id) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#hfoto11').attr('src', e.target.result);
            $('#hfo11').val(e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#foto11").change(function() {
    readURL1(this);
  });
</script>
<script src="{!! url('adminAsset/js/ckeditor1/ckeditor.js') !!}"></script>
<script src="{!! url('adminAsset/js/ckeditor1/adapters/jquery.js') !!}"></script>
<script type="text/javascript">
    $( '#editor1' ).ckeditor({width:'100%', height: '400px', toolbar: [
        // { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: ['NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        // { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-'] },
        // { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        // { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        // { name: 'tools', items: [ 'Maximize' ] },
        // '/',
        // { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        // { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
        // { name: 'styles', items: [ 'Font', 'FontSize' ] },
        // { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        // { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
        CKEDITOR.env.isCompatible = true,
    ]});
    $( '#editor2' ).ckeditor({width:'100%', height: '400px', toolbar: [
        // { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: ['NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        // { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-'] },
        // { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        // { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        // { name: 'tools', items: [ 'Maximize' ] },
        // '/',
        // { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        // { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
        // { name: 'styles', items: [ 'Font', 'FontSize' ] },
        // { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        // { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
        CKEDITOR.env.isCompatible = true,
    ]});
</script>
@stop