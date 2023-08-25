		<div class="col-xs-12 main-layer">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row widget-box" id="panel-add">
				<div class="widget-header widget-header-blue widget-header-flat">
					<h4 class="widget-title lighter">New Item Wizard</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<form method='post' action="{{ route('updatelogo') }}" enctype='multipart/form-data'>
							{{ csrf_field() }}
							<div class="box-body">
								<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2' style='padding:0px'>
									<div class="form-group">
										<label class="control-label col-lg-3 col-md-3 col-sm-12 col-xs-12" id='label-input'>
										Logo : 
										</label>
										<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
											<input type="file" class="upload" onchange="loadFilePhoto(event)" name="logo" accept="image/*" class="form-control customInput input-sm col-md-7 col-xs-12">
												<i>* Rekomendasi Ukuran Logo 200x195 pixel | format file .png</i>
										</div>
										<div class='clearfix' style='padding-bottom:5px'></div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="crop-edit">
												<center>
													@if(!empty($identitas->logo))
														<img id="preview-photo" src="{!! url('adminasset/assets/images/logo/'.$identitas->logo) !!}" class="img-polaroid" width="200">
													@else
														<img id="preview-photo" src="{!! url('adminasset/assets/img/default-50x50.gif') !!}" class="img-polaroid" height="150">
													@endif
												</center>
											</div>
										</div>
									</div>
								</div>
								<div class='clearfix' style='padding-bottom:5px'></div>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Simpan <span class="fa fa-save"></span></button>
								<button type="button" class="btn btn-warning btn-cancel pull-right"><span class="fa fa-chevron-left"></span> Kembali</button>&nbsp;
							</div>
						</form>
						<div class='clearfix' style='padding-bottom:5px'></div>
					</div><!-- /.widget-main -->
				</div><!-- /.widget-body -->
			</div><!-- /.row -->
		</div>

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