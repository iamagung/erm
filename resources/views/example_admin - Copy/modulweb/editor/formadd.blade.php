	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Form Editor</div>

                <div class="panel-body">
                @if(!empty($user))
                    <form class="form-horizontal" method="POST" action="{{ route('updateeditor') }}" enctype='multipart/form-data'>
                        <input type="hidden" class="form-control" name="id" value="{!! $user->id !!}">
                        <input type="hidden" class="form-control" id="pre" value="{!! $user->previllage !!}">
                @else
                    <form class="form-horizontal" method="POST" action="{{ route('simpaneditor') }}" enctype='multipart/form-data'>
                @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="@if(!empty($user)) {!! $user->name !!} @endif{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address / Username </label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="@if(!empty($user)) {!! $user->email !!} @endif{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone </label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="@if(!empty($user)) {!! $user->phone !!} @endif{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Previllage</label>

                            <div class="col-md-6">
                                <input type="checkbox" class="" name="previllage[]" id="berita" value="1"> <label for="berita">Berita</label> &nbsp;
                                <input type="checkbox" class="" name="previllage[]" id="even" value="2"><label for="even">Even</label> &nbsp;
                                <input type="checkbox" class="" name="previllage[]" id="memo" value="3"> <label for="memo">Pengumuman</label> &nbsp;
                                <input type="checkbox" class="" name="previllage[]" id="galeri" value="4"> <label for="galeri">Galeri</label> &nbsp;
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
								@if(!empty($user->photo))
									<img id="preview-photo" src="{!! url('adminasset/assets/images/editor/'.$user->photo) !!}" class="img-polaroid" width="150" height="150">
								@else
									<img id="preview-photo" src="{!! url('adminasset/assets/img/default-50x50.gif') !!}" class="img-polaroid" width="150" height="150">
								@endif
							</div>
						</div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <button type="button" class="btn btn-warning btn-cancel"><span class="fa fa-chevron-left"></span> Kembali</button>
                            </div>
                        </div>
                    </form>
                    <div id="cek"></div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	var onLoad = (function() {
		$('#').animateCss('bounceInUp');
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

    if("{!! $id !!}" != ""){
        $('#email').attr('readonly',true);
        var ck = $('#pre').val();
        var ckb = ck.split(",");
        for (var i = ckb.length - 1; i >= 0; i--) {
            if(ckb[i] == 1){
                $('#berita').attr('checked','true');
            }else if(ckb[i] == 2){
                $('#even').attr('checked','true');
            }else if(ckb[i] == 3){
                $('#memo').attr('checked','true');
            }else if(ckb[i] == 4){
        		$('#galeri').attr('checked','true');
            }
        }
    }

    $('#btn_simpan').click(function(){
    	$('#main_content').hide();
    	$('.loading').show();
    });
</script>
