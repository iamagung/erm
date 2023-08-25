@extends('admin.master.layout')
@section('css')
@stop
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<table id="simple-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">No. </th>
								<th class="center">Nama</th>
								<th class="center">View</th>
								<th class="center">url</th>
								<th class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr class="center">
								<td>1. </td>
								<td>Facebook </td>
								<td><iframe src="https://www.facebook.com/plugins/page.php?href={{ $data['identitas']->fb }}&amp;tabs=timeline&amp;width=300&amp;height=450&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" style="border:none;overflow:hidden" scrolling="no" allowtransparency="true" width="300" height="450" frameborder="0" id='fb'></iframe></td>
								<td>url</td>
								<td>
									<a href="javascript:void(0)" class="tooltip-success" data-rel="tooltip" title="Edit">
										<span class="green">
											<i class="ace-icon fa fa-pencil-square-o bigger-120" class="btn btn-info btn-lg" data-toggle="modal" data-target="#facebook"></i>
										</span>
									</a>

								</td>
							</tr>
							<tr class="center">
								<td>2. </td>
								<td>Video </td>
								<td><iframe width="75%" height="300" src="https://www.youtube.com/embed/{{ str_replace('https://www.youtube.com/watch?v=','',$data['identitas']->profile_video) }}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe></td>
								<td>url</td>
								<td>
									<a href="javascript:void(0)" class="tooltip-success" data-rel="tooltip" title="Edit" id="cek">
										<span class="green">
											<i class="ace-icon fa fa-pencil-square-o bigger-120" class="btn btn-info btn-lg" data-toggle="modal" data-target="#video"></i>
										</span>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- /.span -->
			</div><!-- /.row -->
		</div>
	</div>

	<!-- fb -->
	<div id="facebook" class="modal fade" role="dialog">
		<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Modal Header</h4>
		      </div>
		      <div class="modal-body">
		        <form action="{{ route('updatemedsos') }}" method="POST">
		        	{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">URL Facebook</label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<input type="text" name="fb" class="col-xs-12 col-sm-10" value="{!! $data['identitas']->fb !!}" />
								<hr><p><span><i>* copy url fans page facebook</i></span></p>
							</div>
						</div>
					</div>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			        <button type="submit" class="btn btn-priamry">Simpan</button>
		        </form>
		      </div>
		    </div>
		 </div>
	</div>
	<!-- end fb -->

	<!-- video -->
	<div id="video" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Modal Header</h4>
	      </div>
	      <div class="modal-body">
	        <form action="{{ route('updatemedsos') }}" method="POST">
	        	{{ csrf_field() }}
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Link Video</label>
					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" name="video" class="col-xs-12 col-sm-10" value="{!! $data['identitas']->profile_video !!}" />
							<hr><p><span><i>* link youtube</i></span></p>
						</div>
					</div>
				</div>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		        <button type="submit" class="btn btn-priamry">Simpan</button>
	        </form>
	      </div>
	    </div>

	  </div>
	</div>
	<!-- end video -->
@stop
@section('js')
@stop