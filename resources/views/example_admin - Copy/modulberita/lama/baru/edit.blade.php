<div class="box box-warning" id='panel-add'>
	<button type="button" class="btn btn-warning btn-cancel"><span class="fa fa-chevron-left"></span> Kembali</button>
	<hr>
	<form method='post' action="{{ route('AdmindoUpdateBerita') }}" enctype='multipart/form-data'>
					{{ csrf_field() }}
					<div class="col-md-12" style="padding: 0px">
						<div class="form-group" style="padding: 20px 0px">
							<label class="col-lg-4 col-md-4">
								Status Postingan
							</label>
							<?php
							$status[]="";
							if($berita->status==1){
								$status=["checked",""];
							}else{
								$status=["","checked"];
							}
							?>
							<div class="col-lg-8 col-md-8">
								<input type="radio" name="status" value="1" {{$status[0]}} required>Aktif
								<input type="radio" name="status" value="0" {{$status[1]}} style="margin-left: 30px" required>Tidak Aktif
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Judul
							</label>
							<div class="col-lg-12 col-md-12">
								<input type="text" name="judul" class="form-control" placeholder="Judul berita" required value="{{$berita->judul}}">
								<input type="hidden" name="id" class="form-control" placeholder="Judul berita" required value="{{$berita->id_berita}}">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Kategori
							</label>
							<div class="col-lg-12 col-md-12">
								<select name="kategori" id="kategori" class="form-control" required>
									<option disabled value="">..:: Kategori ::..</option>
									<?php
									$menu = DB::table('menu')->where('aktif','1')->get();
									foreach ($menu as $key) {
										if($berita->menu_id==$key->id_menu){
											?>
											<option value="{{$key->id_menu}}" selected>{{$key->nama_menu}}</option>
											<?php
										}else{
											?>
											<option value="{{$key->id_menu}}">{{$key->nama_menu}}</option>
											<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Gambar
							</label>
							<div class="col-lg-12 col-md-12">
								<input type="file" name="logo" class="form-control upload" onchange="loadFilePhoto(event)">
								<img id="preview-photo" src="{!! url('AssetsSite/img/berita/'.$berita->gambar) !!}" class="img-polaroid" width="200">
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group">
							<label class="col-lg-12 col-md-12">
								Isi Berita
							</label>
							<div class="col-lg-12 col-md-12">
								<textarea id="editor1" name="isi_berita" class="form-control" required>{{$berita->isi}}</textarea>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 10px"></div>
						<div class="form-group" id="tag">
							<label class="col-lg-12 col-md-12">
								Tag Berita
							</label>
							<div class="col-lg-12 col-md-12">
	                            <input type="text" id="category" name="listKeyword" value="{{$berita->tag}}">
	                        </div>
						</div>
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

<link rel="stylesheet" href="{{url('tag_input/bootstrap-tagsinput.css')}}">
<script src="{{url('tag_input/bootstrap-tagsinput.js')}}"></script>
<script src="{{url('tag_input/bootstrap3-typeahead.js')}}"></script>

<script src="{!! url('AssetsAdmin/dist/js/ckeditor1/ckeditor.js') !!}"></script>
<script src="{!! url('AssetsAdmin/dist/js/ckeditor1/adapters/jquery.js') !!}"></script>
<script type="text/javascript">

	$('#category').tagsinput({
	  typeahead: {
	    <?php
	  	$tag = "'";
	  	$tags = DB::table('tag')->get();
	  	foreach ($tags as $key) {
	  		$tag.=$key->nama_tag."','";
	  	}
	  	$tag = substr($tag, 0,-2);
	  	?>
	    source: [<?php echo $tag?>]
	  },
	  freeInput: true
	});
	
	$('#category').on('itemAdded', function(event) {
	    setTimeout(function(){
	        $(">input[type=text]",".bootstrap-tagsinput").val("");
	    },1);
	});

	$( 'textarea#editor1' ).ckeditor(
        CKEDITOR.config.extraPlugins = 'texttransform',
        {width:'100%', height: '150px', toolbar: [
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
        { name: 'texttransform', items: [ 'TransformTextToUppercase', 'TransformTextToLowercase', 'TransformTextCapitalize', 'TransformTextSwitcher' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
        CKEDITOR.env.isCompatible = true,
    ]});

 //    var kat = $('#kategori').val();
 //    if(kat=='7'){
	// 	$('#tag').show();
	// }else{
	// 	$('#tag').hide();
	// }

 //    $('#kategori').change(function(){
 //    	var kateg = $('#kategori').val();
 //    	if(kateg=='7'){
 //    		$('#tag').show();
 //    	}else{
 //    		$('#tag').hide();
 //    	}
 //    })

    $('.btn-cancel').click(function(e){
    	e.preventDefault();
    	$('#panel-add').animateCss('bounceOutDown');
    	$('.other-page').fadeOut(function(){
    		$('.other-page').empty();
            $('.main-layer').fadeIn();
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