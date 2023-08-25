<link rel="stylesheet" type="text/css" href="{{url('datepicker/bootstrap-datetimepicker.min.css')}}">
<div class="box box-warning" id='panel-add'>
	<button type="button" class="btn btn-warning btn-cancel"><span class="fa fa-chevron-left"></span> Kembali</button>
	<hr>
	<form method='post' action="{{ route('uploadBeritaSekolah') }}" enctype='multipart/form-data'>
		{{ csrf_field() }}
		<div class="box-body">
			<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='padding:0px'>
				<div class="form-group">
					<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Judul</label>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<input type="text" name="judul" required="required" class="form-control input-sm customInput col-md-7 col-xs-12">
						<input type="hidden" name="kategori" required="required" class="form-control input-sm customInput col-md-7 col-xs-12" value="{{$kategori}}">
					</div>
				</div>
				<?php
				if($kategori==2){
					?>
					<div class='clearfix' style='padding-bottom:5px;'></div>
					<div class="form-group">
						<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Tanggal Acara</label>
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	                        <input class="form-control form_date" data-date-format="yyyy-mm-dd" type="text" name="tanggal_acara" value="<?php echo date('Y-m-d')?>" required="required">
	                    </div>
					</div>
					<?php
				}
				?>
				<div class='clearfix' style='padding-bottom:5px;'></div>
				<div class="form-group">
					<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Isi {{$title}}</label>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<textarea id="editor1" name="isi_berita" rows="40" cols="100"></textarea>
					</div>
				</div>
				<?php
				if($kategori!=2){
					?>
					<div class='clearfix' style='padding-bottom:5px;'></div>
					<div class="form-group">
						<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Gambar</label>
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
							<input type="file" name="gambar" class="form-control upload" onchange="loadFilePhoto(event)" required>
							<img id="preview-photo" src="{!! url('uploads/default.jpg') !!}" class="img-polaroid" width="200" style="display: none">
						</div>
					</div>
					<?php
				}
				?>
				<div class='clearfix' style='padding-bottom:5px;'></div>
				<div class="form-group">
					<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Status</label>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<input type="radio" name="status" value='1' checked required="required" id='ya'><label for='ya' style='margin-right:10px;font-weight:normal'>Aktif</label>
						<input type="radio" name="status" value='0' required="required" id='tidak'><label for='tidak' style='font-weight:normal'>Tidak Aktif</label>
					</div>
				</div>
				<div class='clearfix' style='padding-bottom:2px;'></div>
			</div>
			<div class='clearfix' style='padding-bottom:5px'></div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary pull-right">Simpan <span class="fa fa-save"></span></button>
		</div>
	</form>
</div>
<script src="{{url('datepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">
	var onLoad = (function() {
		$('#panel-add').animateCss('bounceInUp');
	})();

	$('.btn-cancel').click(function(e){
    	e.preventDefault();
    	$('#panel-add').animateCss('bounceOutDown');
    	$('.other-page').fadeOut(function(){
    		$('.other-page').empty();
            $('.main-layer').fadeIn();
        });
    });

    $('.form_date').datetimepicker({
		autoclose: 1,
		startView: 2,
		minView: 4,
		forceParse: 0,
	});

    function loadFilePhoto(event) {
        var image = URL.createObjectURL(event.target.files[0]);
        $('#preview-photo').fadeOut(function(){
        	$(this).attr('src', image).fadeIn().css({
        		'-webkit-animation' : 'showSlowlyElement 700ms',
        		'animation'         : 'showSlowlyElement 700ms'
        	});
        });
    };
</script>
<script src="{!! url('AssetsAdmin/dist/js/ckeditor1/ckeditor.js') !!}"></script>
<script src="{!! url('AssetsAdmin/dist/js/ckeditor1/adapters/jquery.js') !!}"></script>
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
</script>