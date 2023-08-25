@section('css')
  <link rel="stylesheet" href="{!! url('adminasset/assets/plugin/summernote/dist/summernote-bs4.css') !!}">
@stop
	<center>
		<div id="panel-barang" class="widget-box col-lg-12 col-sm-12">
			<div class="widget-header widget-header-blue widget-header-flat">
				<h4 class="widget-title lighter">Form Identitas Web</h4>
			</div>

			<div class="widget-body">
				<div class="widget-main">
					
					<!-- <form class="form-horizontal" id="validation-form" method="post" action=""  enctype='multipart/form-data' -->
					<form id="form-brg">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Nama Barang : </label>
							<div class="col-xs-12 col-sm-9"  style='padding-bottom:5px'>
								<div class="clearfix">
									<input type="hidden" name="id" id="name" class="col-xs-12 col-sm-8" value="{!! $data['id'] !!}" />
									<input type="text" name="nama_brg" id="name" class="col-xs-12 col-sm-8" value="@if($data['barang'] != '') {!! $data['barang']->nama_brg !!} @endif" />
								</div>
							</div>
						</div>

						<div class="space-2"></div>

						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="alamat">Deskripsi :</label>
							<div class="col-xs-12 col-sm-9"  style='padding-bottom:5px'>
								<div class="clearfix">
									<textarea name="deskripsi" class="summernote col-xs-12 col-sm-8" row="3"  id="contents" title="Contents">@if($data['barang'] != '') {!! $data['barang']->deskripsi !!} @endif</textarea>
								</div>
							</div>
						</div>

						<div class="space-2"></div>

						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="icon">Icon :</label>
							<div class="col-xs-12 col-sm-3" style='padding-bottom:5px'>
								<input type="file" class="upload" onchange="loadFilePhoto(event)" name="foto" accept="image/*" class="form-control customInput input-sm col-md-7 col-xs-12">
							</div>
							<hr>
							<div class="crop-edit center">
								@if(!empty($data['barang']->photo))
									<img id="preview-photo" src="{!! url('adminasset/assets/images/icon/'.$data['barang']->favicon) !!}" class="img-polaroid" width="150" height="150">
								@else
									<img id="preview-photo" src="{!! url('adminasset/assets/img/default-50x50.gif') !!}" class="img-polaroid" width="150" height="150">
								@endif
							</div>
						</div>

						<div class="space-2"></div>

						<div class="form-group">
							<div class="col-xs-12 col-sm-5" style='padding-bottom:5px'>
								<a type="button" class="btn btn-warning btn-cancel pull-right">Batal</a>
								<a type="button" class="btn btn-primary btn-simpan pull-right"> Simpan</a>
							</div>
						</div>
						<div class="space-2"></div>
					</form>
				</div><!-- /.widget-main -->
			</div><!-- /.widget-body -->
		</div>
	</center>

<script type="text/javascript" src="{!! url('adminasset/assets/plugin/summernote/dist/summernote-bs4.js') !!}"></script>
<script type="text/javascript">
	var onLoad = (function() {
      	$(".chosen-container").css('width', '100%');
      	$('#panel-barang').animateCss('bounceInUp');
      	$('.additional-field').hide();
		/*if($('#user-id').val() != ''){
      		load_user($('#user-id').val());
      	}*/
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

    $('.btn-simpan').click(function(){
    	var data = new FormData($('#form-brg')[0]);
    	@if($data['id'] != '')
    		var url = "{!! route('updatedatabrg') !!}"
    	@else
    		var url = "{!! route('simpandatabrg') !!}";
    	@endif

    	$.ajax({
    		url : url,
    		type : 'POST',
    		data : data,
    		cahce : false,
    		async : true,
    		contentType : false,
    		processData : false,
    	}).done(function(result){
    		// $('#form-user').validate(data, 'has-error');
    		if(result.status == 'success'){
    			swal("Sukses!", "Data berhasil disimpan!", "success");
    			$('.other-page').fadeOut(function(){
		    		$('.other-page').empty();
		            $('.main-layer').fadeIn();
		            datagrid.reload();
		        	
		        });
    		} else {
    			$('.btn-save').animateCss('shake', function(){
    				swal('Perhatian', 'Mohon periksa inputan anda', 'warning');
    			});
    		}
    	});
    });

    $('.btn-cancel').click(function(){
    	$('#panel-barang').animateCss('bounceOutDown');
    	$('.other-page').fadeOut(function(){
    		$('.other-page').empty();
            $('.main-layer').fadeIn();
        });
    });

    //summernote
    $(function() {
      $('.summernote').summernote({
        height: 200
      });

      $('form').on('submit', function (e) {
        e.preventDefault();
        alert($('.summernote').summernote('code'));
        alert($('.summernote').val());
      });
    });
  </script>
