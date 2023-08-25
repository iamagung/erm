<div class="box box-warning" id='panel-add'>
	<button type="button" class="btn btn-warning btn-cancel"><span class="fa fa-chevron-left"></span> Kembali</button>
	<hr>
	<form method='post' action="{{ route('updatePasswordAdmin') }}" enctype='multipart/form-data'>
		{{ csrf_field() }}
		<div class="col-md-12" style="padding: 0px">
			<div class="form-group" style="padding: 10px 0px">
				<label class="col-lg-4 col-md-4">
					Password Baru
				</label>
				<div class="col-lg-8 col-md-8">
					<input id="baru" class="form-control" type="password" name="baru" required>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>
			<div class="form-group" style="padding: 10px 0px">
				<label class="col-lg-4 col-md-4">
					Ulangi
				</label>
				<div class="col-lg-8 col-md-8">
					<input id="ulang" class="form-control" type="password" required>
					<p id="hasil"></p>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>
			<div class="form-group" style="padding: 10px 0px">
				<label class="col-lg-4 col-md-4">
					Password Lama
				</label>
				<div class="col-lg-8 col-md-8">
					<input type="password" class="form-control" name="lama" required>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>
			<div class="form-group">
				<div class="col-lg-4 col-md-4">
					<input type="submit" id="simpan" disabled class="btn btn-primary" value="Save" style="width:80%;padding: 20px">								
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 10px"></div>
		</div>
		<div class='clearfix'></div>
	</form>
</div>

<!-- <script src="{!!  asset('adminAsset/js/jquery-ui-1.10.3.min.js') !!}" type="text/javascript"></script> -->
<script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>
<!-- <script src="{!! url('AssetsAdmin/dist/js/ckeditor1/adapters/jquery.js') !!}"></script> -->
<script type="text/javascript">

	
	$('#ulang').keyup(function(){
		var baru = $('#baru').val();
		var ulang = $('#ulang').val();
		if(ulang){
			if(ulang==baru){
				$('#hasil').html("Terima Kasih");
				$('#simpan').removeAttr('disabled');
			}else{
				$('#hasil').html("Maaf tidak sama");
				$('#simpan').attr('disabled','disabled');
			}
		}else{
			$('#hasil').html("Harap diisi sesuai password baru");
			$('#simpan').attr('disabled','disabled');
		}
	});

    $('.btn-cancel').click(function(){
    		$('.other-page').hide();
            $('.main-layer').show();
    });
</script>