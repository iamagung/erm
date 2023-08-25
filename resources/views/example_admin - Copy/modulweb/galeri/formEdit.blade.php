<div class="widget-box col-lg-12 col-sm-12" id='panel-add'>
	<div class="widget-header widget-header-blue widget-header-flat">
		<h4 class="widget-title lighter">Form Edit {!! $title_form !!}</h4>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form method='post' action="{{ route('updateGaleri') }}" enctype='multipart/form-data'>
				{{ csrf_field() }}
				<div class="box-body">
					<div class='col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2' style='padding:0px'>
						<input type="hidden" name="id_galeri" value="{{$galeri->id_galeri}}" class="form-control input-sm customInput col-md-7 col-xs-12">
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
											<img id="preview-photo" src="{!! url('adminasset/assets/images/gallery/'.$galeri->file_galeri) !!}" class="img-polaroid" width="200">
										@else
											<img id="preview-photo" src="{!! url('adminasset/assets/img/default-50x50.jpg') !!}" class="img-polaroid" width="200">
										@endif
									</center>
								</div>
							</div>
						<div class='clearfix' style='padding-bottom:5px;'></div>
						<div class="form-group">
							<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Deskripsi</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<textarea name="deskripsi" class="form-control" row="3">{{$galeri->deskripsi_galeri}}</textarea>
							</div>
						</div>
						<div class='clearfix' style='padding-bottom:5px;'></div>
						<div class="form-group">
							<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>Status</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<?php
								$aktif = [];
								if($galeri->status_galeri=='1'){
									$aktif = ['checked',''];
								}else{
									$aktif = ['','checked'];
								}
								?>
								<input type="radio" name="status" value='1' {{$aktif[0]}} required="required" id='ya'><label for='ya' style='margin-right:10px;font-weight:normal'>Aktif</label>
								<input type="radio" name="status" value='0' {{$aktif[1]}} required="required" id='tidak'><label for='tidak' style='font-weight:normal'>Tidak Aktif</label>
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
			<br />
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
	</script>