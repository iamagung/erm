@extends('admin.master.layout')
@section('css')
@stop
@section('content')
	<div class="row">
		<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
			<div class="loading" align="center" style="display: none;">
				<img src="{!! url('adminasset/assets/img/loadings.gif') !!}">
			</div>
		</div>
		<div class="col-xs-12 main-layer">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<table id="simple-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">No. </th>
								<th class="center">Logo</th>
								<th class="center">Rekomendasi Ukuran</th>
								<th class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr class="center">
								<td>1. </td>
								<td><img src="{{ asset('adminasset/assets/images/logo') }}/{!! $data['identitas']->logo !!}" height="100"></td>
								<td>200 x 150 pixel</td>
								<td>
									<a href="javascript:void(0)" class="tooltip-success" data-rel="tooltip" title="Edit" id="edit">
										<span class="green">
											<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
										</span>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- /.span -->
			</div><!-- /.row -->
		</div>
		<div class="other-page"></div>
	</div>
@stop
@section('js')
<script type="text/javascript">
	$('#edit').click(function(){
		$('.loading').show();
		$('.main-layer').hide();
		$.post("{!! route('formlogo') !!}").done(function(data){
			if(data.status == 'success'){
				$('.loading').hide();
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-layer').show();
			}
		});
	});
</script>
@stop