@extends('admin.master.layout')
@section('css')
@stop
@section('content')
				<?php
					$a = explode(',', Auth::user()->previllage);
					$galeri = 0;
					$memo = 0;
					$berita = 0;
					$even = 0;

					for($i = 0; $i < count($a)-1; $i++ ){
						if($a[$i] == 1){
							$berita = 1;
						}elseif($a[$i] == 2){
							$even = 1;
						}elseif($a[$i] == 3){
							$memo = 1;
						}elseif($a[$i] == 4){
							$galeri = 1;
						}
					}
				?>
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>

				<i class="ace-icon fa fa-check green"></i>
				Welcome to web Admin <strong> Al-Aminku.com</strong>
			</div>

			<div class="row">
				<div class="space-6"></div>

				<div class="col-sm-12 infobox-container">
					@if(Auth::user()->level == 0)
					<a class="infobox infobox-green" href="{!! route('identitas') !!}">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-user"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number">Identitas</span>
						</div>
					</a>

					<a class="infobox infobox-blue" href="{!! route('medsos') !!}">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-twitter"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number">Sosial Media</span>
						</div>
					</a>

					<a class="infobox infobox-red"  href="{!! route('logo') !!}">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-camera-retro"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number">Logo</span>
						</div>
					</a>

					<a class="infobox infobox-blue2" href="{!! route('visimisi') !!}">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-comments"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number">Visi & Misi</span>
						</div>
					</a>

					<a class="infobox infobox-pink" href="{!! route('profil') !!}">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-graduation-cap"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number">Profil</span>
						</div>
					</a>
					<a class="infobox infobox-grey" href="{!! route('pengantar') !!}">
						<div class="infobox-icon">
							<i class="ace-icon fa  fa-volume-up"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number"><small>Kata Pengantar</small></span>
						</div>
					</a>
					@endif

					@if((Auth::user()->level == 0 ) || (Auth::user()->level == 1  && $galeri == 1))

						<a class="infobox infobox-pink" href="@if(Auth::user()->level == 0) {!! route('admingalleri') !!} @else {!! route('editorgalleri') !!} @endif">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-picture-o"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number">Gallery</span>
						</div>
					</a>
					@endif

					@if((Auth::user()->level == 0 ) || (Auth::user()->level == 1  && $berita == 1))
						<a class="infobox infobox-orange2" href="@if(Auth::user()->level == 0) {!! route('beritaSekolah',['id'=>1]) !!} @else {!! route('editorberitaSekolah',['id'=>1]) !!}@endif">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-newspaper-o"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp</div>
							<span class="infobox-data-number">Berita</span>
						</div>
					</a>
					@endif
					
					@if((Auth::user()->level == 0 ) || (Auth::user()->level == 1  && $even == 1))
						<a class="infobox infobox-grey" href="@if(Auth::user()->level == 0) {!! route('beritaSekolah',['id'=>2]) !!} @else {!! route('editorberitaSekolah',['id'=>2]) !!}@endif">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-clipboard"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number">Even</span>
						</div>
					</a>
					@endif

					@if((Auth::user()->level == 0 ) || (Auth::user()->level == 1  && $memo == 1))
						<a class="infobox infobox-red" href="@if(Auth::user()->level == 0) {!! route('beritaSekolah',['id'=>3]) !!} @else {!! route('editorberitaSekolah',['id'=>3]) !!}@endif">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-file-o"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">&nbsp;</div>
							<span class="infobox-data-number"><small>Pengumuman</small></span>
						</div>
					</a>
					@endif
				</div>

				<div class="vspace-12-sm"></div>
			</div><!-- /.row -->

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
@stop
@section('js')
@stop