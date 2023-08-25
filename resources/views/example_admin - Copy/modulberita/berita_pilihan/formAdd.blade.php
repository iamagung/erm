
<div class="widget-box col-lg-12 col-sm-12" id='panel-add'>
	<div class="widget-header widget-header-blue widget-header-flat">
		<h4 class="widget-title lighter">Form Tambah {!! $title !!}</h4>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form method='post' action="{{ route('simpanBeritapilihan') }}">
				{{ csrf_field() }}
				<input type="hidden" name="lama" value="{!! $lama !!}">
				<div class="col-md-12" style="padding: 0px">
					<div class="form-group">
						<label class="col-lg-12 col-md-12">
							Judul
						</label>
						<div class="col-lg-12 col-md-12">
							<select data-placeholder="Pilih berita..." class="chosen-select form-control" tabindex="2" name="judul" required id="judul">
					        	@foreach($berita as $b)
					        		<option value="{!! $b->id_berita !!}">{!! $b->judul !!}</option>
					        	@endforeach
					        </select>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="form-group">
						<label class="col-lg-12 col-md-12">
							Gambar
						</label>
						<div class="col-lg-12 col-md-12">
							<img id="preview-photo" src="" class="img-polaroid" width="400" style="display: none">
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>
					<div class="form-group">
						<label class="col-lg-12 col-md-12">
							Isi Berita
						</label>
						<div class="col-lg-12 col-md-12">
							<p id="isi"></p>
						</div>
					<input type="submit" class="btn btn-primary pull-right" value="Save">								
					<button type="button" class="btn btn-warning btn-cancel pull-right"><span class="fa fa-chevron-left"></span> Kembali</button>
					</div>
					<div class="clearfix" style="margin-bottom: 10px"></div>
				</div>
			</form>
		</div>
	</div>
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

	$('#judul').change(function(){
		var id = $('#judul').val();
		$.post("{!! route('getberita') !!}",{id:id}).done(function(data){
			if(data.status=='success'){
				$('#preview-photo').fadeOut(function(){
		        	$('#preview-photo').show();
		            $(this).attr('src', data.path).fadeIn().css({
		                '-webkit-animation' : 'showSlowlyElement 700ms',
		                'animation'         : 'showSlowlyElement 700ms'
		            });
		        });
		        $('#isi').html(data.data.isi);
			}
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
