@extends('admin.master.layout')
@section('css')
@stop

@section('content')
	<div class="widget-box col-lg-6 col-sm-12">
		<div class="widget-header widget-header-blue widget-header-flat">
			<h4 class="widget-title lighter">Form Identitas Web</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main">
				
				<form class="form-horizontal" id="validation-form" method="post" action="{{ route('updateidentitas') }}"  enctype='multipart/form-data'>
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Nama Web :</label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<input type="text" name="nama_web" id="name" class="col-xs-12 col-sm-10" value="{!! $data['identitas']->nama_web !!}" />
							</div>
						</div>
					</div>

					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url">URL :</label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<input type="text" name="url" id="url" class="col-xs-12 col-sm-8" value="{!! $data['identitas']->url !!}"/>
							</div>
						</div>
					</div>

					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="meta">Meta :</label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<input type="text" name="meta" id="meta" class="col-xs-12 col-sm-6" value="{!! $data['identitas']->meta !!}"/>
							</div>
						</div>
					</div>

					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="alamat">Alamat :</label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<textarea name="alamat" id="alamat" class="col-xs-12 col-sm-10">{!! $data['identitas']->alamat !!}</textarea>
							</div>
						</div>
					</div>

					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Email :</label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<input type="email" name="email" id="email" class="col-xs-12 col-sm-10" value="{!! $data['identitas']->email !!}"/>
							</div>
						</div>
					</div>
					
					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="telp">No. telp / Hp :</label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<input type="text" name="phone" id="telp" class="col-xs-12 col-sm-10" value="{!! $data['identitas']->phone !!}" maxlength="12" />
							</div>
						</div>
					</div>

					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="icon">Icon :</label>
						<div class="col-xs-12 col-sm-9">
							<div class='clearfix' style='padding-bottom:5px'></div>
							<input type="file" class="upload" onchange="loadFilePhoto(event)" name="icon" accept="image/*" class="form-control customInput input-sm col-md-7 col-xs-12">
						</div>
						<hr>
						<div class="crop-edit center">
							@if(!empty($data['identitas']->favicon))
								<img id="preview-photo" src="{!! url('adminasset/assets/images/icon/'.$data['identitas']->favicon) !!}" class="img-polaroid" width="150" height="150">
							@else
								<img id="preview-photo" src="{!! url('adminasset/assets/img/default-50x50.gif') !!}" class="img-polaroid" width="150" height="150">
							@endif
						</div>
					</div>

					<div class="space-2"></div>

					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right">&nbsp;</label>
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

    $('#btn_simpan').click(function(){
    	$('#main_content').hide();
    	$('.loading').show();
    });
</script>
@stop