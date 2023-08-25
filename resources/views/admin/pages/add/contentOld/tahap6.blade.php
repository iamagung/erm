<div class="col-lg-12 col-md-12">
    <a href="{{route('cetak6')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
    <a href="{{route('cetak6',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
</div>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12" style="padding: 0px">
	<div class="clearfix"></div>
	<!-- TANDA VITAL & ANTROPOMETRI -->
	<div class="col-lg-12 col-md-12 tahap6" style="padding: 0px">
		<script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>

		<?php
		$rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();	
		$total = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();	
		?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Keterangan</th>
					<th width="50%">View</th>
					<th width="10%">Tanggal</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>

	
	<div class="clearfix"></div>
    <div class="col-lg-12 col-md-12">
        <div>
            <ul class="pagination" style="float:none">
                <?php
                $paging1 = ceil(count($total)/10);
                $page=1;
                ?>
                <li class='disabled'><a href='#'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>
                <li class='disabled'><a href='#'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>
                <?php
                $batas = 4;
                $start_number = ($page > $batas)? $page - $batas : 1; // Untuk awal link number
                $end_number = ($page < ($paging1 - $batas))? $page + $batas : $paging1; 
                for ($i = $start_number; $i <= $end_number; $i++) {
                    if($i==1){
                        $a = 'class="active"';
                    }else{
                        $a = '';
                    }
                    echo "<li $a><a href='#' onclick='page($i)'>$i</a></li>";
                }
                if($page==$paging1){
                    ?>
                    <li class="disabled"><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li class="disabled"><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
                    <?php
                }else{
                    ?>
                    <li><a href='#' onclick="page({!! $start_number+1 !!})"><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li><a href='#' onclick="page({!! $paging1 !!})"><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal_layout_laborat"></div>

@section('js_modal_laborat')
<script type="text/javascript">
    function tambahLaborat(){
        $.post("{!! route('modalTambahLaborat') !!}",{}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout_laborat').html(data.content);
                $('.modal_layout_laborat').show();
                $('#myModalLaborat').modal('show');
            }
        });
    }

    function deleteLab(i){
    	swal({
        title: "Anda yakin?",
        text: "Data akan dihapus!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        //closeOnCancel: false
        },
        function(){
            $.post("{!! route('hapusLab') !!}",{id:i}).done(function(data){
                if(data.status=='success'){
                    swal("Berhasil!", "Data berhasil dihapus!", "success");
                }else{
                    swal("Gagal!", "Data gagal dihapus!", "error");
                }
                $(".tahap6").load(location.href + " .tahap6>*", "");
            });
        });
    }
</script>
@stop