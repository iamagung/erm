<div class="widget-box col-lg-12 col-sm-12" id='panel-add'>
	<div class="widget-header widget-header-blue widget-header-flat">
		<h4 class="widget-title lighter">Form Tambah {!! $title_form !!}</h4>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form method='post' action="{{ route('uploadGaleri') }}" enctype='multipart/form-data'>
				{{ csrf_field() }}
				<input type="hidden" name="kategori" value="{!! $kategori !!}">
				<div class="box-body">
					<div class='col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2' style='padding:0px'>
						<div id="upload">
							<div class='clearfix' style='padding-bottom:5px;'></div>
							<div class="form-group">
								<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Upload foto</label>
								<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
									<input type="file" name="file" id="file_upload"  onchange="loadFilePhoto(event)"  class="form-control input-sm customInput col-md-7 col-xs-12">
								</div>
							</div>
						</div>
						<div class='clearfix' style='padding-bottom:5px;'></div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="crop-edit">
								<center>
									@if(!empty($galeri->file_galeri))
										<img id="preview-photo" src="{!! url('uploads/galeri/'.$galeri->file_galeri) !!}" class="img-polaroid" width="200">
									@else
										<img id="preview-photo" src="{!! url('asminasset/assets/img/default-50x50.png') !!}" class="img-polaroid" width="200">
									@endif
								</center>
							</div>
						</div>
						<div class='clearfix' style='padding-bottom:5px;'></div>
						<div class="form-group">
							<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Deskripsi</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<textarea name="deskripsi" class="form-control"></textarea>
							</div>
						</div>
						<div class='clearfix' style='padding-bottom:5px;'></div>
						<div class="form-group">
							<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Status</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<input type="radio" name="status" value='1' checked required="required" id='ya'><label for='ya' style='margin-right:10px;font-weight:normal'>Aktif</label>
								<input type="radio" name="status" value='0' required="required" id='tidak'><label for='tidak' style='font-weight:normal'>Tidak Aktif</label>
							</div>
						</div>
						<div class='clearfix' style='padding-bottom:2px;'></div>
						<button type="submit" id="btn_simpan" class="btn btn-primary pull-right">Simpan <span class="fa fa-save"></span></button>
						<button type="button" class="btn btn-warning btn-cancel pull-right"><span class="fa fa-chevron-left"></span> Kembali</button>
					</div>
					<div class='clearfix' style='padding-bottom:5px'></div>
				</div>
			</form>
		<br />
		</div>
	</div>
</div>
<script type="text/javascript">
	var onLoad = (function() {
		$('#panel-add').animateCss('bounceInUp');
	})();

	function loadFilePhoto(event) {
        var image = URL.createObjectURL(event.target.files[0]);
            $('#preview-photo').fadeOut(function(){
                $(this).attr('src', image).fadeIn().css({
                    '-webkit-animation' : 'showSlowlyElement 700ms',
                    'animation'         : 'showSlowlyElement 700ms'
                });
            });
    };

	$('.btn-cancel').click(function(e){
    	e.preventDefault();
    	$('#panel-add').animateCss('bounceOutDown');
    	$('.other-page').fadeOut(function(){
    		$('.other-page').empty();
            $('.main-layer').fadeIn();
        });
    });

	$('#upload').show();
	$('#instagram').hide();
	$('#file_upload').attr('required','required');

    $('#btn_upload').click(function(){
    	$('#upload').show();
    	$('#instagram').hide();
    	$('#file_upload').attr('required','required');
    	$('#file_instagram').removeAttr('required');
    });

    $('#btn_instagram').click(function(){
    	$('#instagram').show();
    	$('#upload').hide();
    	$('#file_instagram').attr('required','required');
    	$('#file_upload').removeAttr('required');
    });
</script>