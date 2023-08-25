<div class="modal fade" id="detail-dialog" tabindex="-1" role="dialog" aria-labelledby="product-detail-dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="product-detail-dialog">
					Form Profil
				</h4>
			</div>
			<div class="modal-body">
				<section class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('updateeditor') }}" enctype='multipart/form-data'>
							{{ csrf_field() }}

	                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                            <label for="name" class="col-md-4 control-label">Name</label>

	                            <div class="col-md-6">
	                                <input id="name" type="text" class="form-control" name="name" value="{!! Auth::user()->name !!}" required autofocus>
	                                <input id="name" type="hidden" class="form-control" name="id" value="{!! Auth::user()->id !!}" required autofocus>
	                                <input id="name" type="hidden" class="form-control" name="akun" value="{!! Auth::user()->id !!}" required autofocus>
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                            <label for="email" class="col-md-4 control-label">E-Mail Address / Username </label>

	                            <div class="col-md-6">
	                                <input id="email" type="text" class="form-control" name="email" value="{!! Auth::user()->email !!}" readonly>
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	                            <label for="phone" class="col-md-4 control-label">Password </label>

	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" name="password">
	                                <span><i>*biarkan kosong, jika tidak mengganti password</i></span>
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	                            <label for="phone" class="col-md-4 control-label">Phone </label>

	                            <div class="col-md-6">
	                                <input id="phone" type="text" class="form-control" name="phone" value="{!! Auth::user()->phone !!}" required>
	                            </div>
	                        </div>

							<div class="form-group">
	                            <label for="upload" class="col-md-4 control-label">Foto</label>
								<div class="col-xs-12 col-sm-6">
									<div class='clearfix' style='padding-bottom:5px'></div>
									<input type="file" id="upload" class="upload" onchange="loadFilePhoto(event)" name="icon" accept="image/*" class="form-control customInput input-sm col-md-7 col-xs-12">
								</div>
								<hr>
								<div class="crop-edit center">
									@if(!empty(Auth::user()->photo))
										<img id="preview-photo" src="{!! url('adminasset/assets/images/editor/') !!}/{!!Auth::user()->photo!!}" class="img-polaroid" width="150" height="150">
									@else
										<img id="preview-photo" src="{!! url('adminasset/assets/img/default-50x50.gif') !!}" class="img-polaroid" width="150" height="150">
									@endif
								</div>
							</div>

	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary btn-save">
	                                    Simpan
	                                </button>
	                                <button type="reset" class="btn btn-warning btn-cancel"><span class="fa fa-refresh"></span> Reset</button>
	                            </div>
	                        </div>
	                    </form>
					</div>
				</section>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
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

	var onLoad = (function() {
		$('#detail-dialog').find('.modal-dialog').css({
	    	'width'			: '80%',
	    });
		$('#detail-dialog').modal('show');
	})();

	$('#detail-dialog').on('hidden.bs.modal', function () {
		$('.modal-dialog').html('');
	})
	
</script>