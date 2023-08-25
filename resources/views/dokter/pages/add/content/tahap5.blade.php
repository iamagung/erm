<!-- <div class="col-lg-12 col-md-12">
    <a href="{{route('cetak5')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
    <a href="{{route('cetak5',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
</div> -->
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 tahap51" style="padding: 0px">
    <div class="clearfix"></div>
    <!-- TANDA VITAL & ANTROPOMETRI -->
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12" style="padding: 0px">
        <div class="col-lg-8 col-md-8" style="padding: 0px">
            <div class="col-lg-6 col-md-6">
                <input type="text" id="searchtext" name="search" class="form-control" style="border-radius: 10px !important" placeholder="Search...">
                <input type="text" name="searchdate" id="searchdate" style="display: none;border-radius: 10px !important" placeholder="2018-03-09" class="form-control date lahir" value="{{date('Y-m-d')}}" readonly>
            </div>
            <div class="col-lg-6 col-md-6">
                <select class="form-control" name="searchby" style="border-radius: 10px !important">
                    <option value="No_Register">No Registern</option>
                    <option value="Tgl_Register">Tanggal</option>
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12 tahap5" style="padding: 0px">   
        <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>

        <?php
        $rekap = DB::connection('rsu')->table('tr_rawatjalanobat')->select('No_Register')->where('No_RM',Session::get('no_RM'))->limit(10)->distinct()->orderBy('No_Register','DESC')->get();
        $total = DB::connection('rsu')->table('tr_rawatjalanobat')->select('No_Register')->where('No_RM',Session::get('no_RM'))->distinct()->get();
        // $rekap = DB::table('tr_rawatjalanobat')->select('No_Register')->limit(10)->distinct()->get();
        // $total = DB::table('tr_rawatjalanobat')->select('No_Register')->distinct()->get();
        ?>
        <table class="table table-bordered" id="salinanResep">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Register</th>
                    <th>Nama Obat</th>
                    <th>Qty</th>
                    <th width="5%">Tanggal</th>
                </tr>
            </thead>
            <tbody id="hasilCari">
                <?php
                $i=1;
                if(count($rekap)!=0){
                    foreach ($rekap as $key) {
                        ?>
                        <tr>
                            <td>{{$i}}</td>            
                            <td>{{$key->No_Register}}</td>            
                            <td>
                                <ol>
                                <?php
                                $obat = DB::connection('rsu')->table('tr_rawatjalanobat')->select('NamaBrg','Jml','Satuan','TS')->where('No_register',$key->No_Register)->get();
                                foreach ($obat as $keyO) {
                                    ?>
                                    <li>{{$keyO->NamaBrg}}</li>
                                    <?php    
                                }
                                ?>
                                </ol>
                            </td>
                            <td>
                                <ol>
                                <?php
                                foreach ($obat as $keyO) {
                                    ?>
                                    <li>{{$keyO->Jml.' '.$keyO->Satuan}}</li>
                                    <?php    
                                }
                                ?>
                                </ol>
                            </td>
                            <td>
                                <?php
                                $tracer = DB::connection('rsu')->table('tr_tracer')->where('No_Register',$key->No_Register)->first();
                                $tg = '-';
                                if(!empty($tracer)){
                                    $tg = date('Y-m-d',strtotime($tracer->Tgl_Register));
                                }
                                echo $tg;
                                ?>
                            </td>            
                        </tr>
                        <?php
                        $i++;
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="5">Tidak ada data</td>            
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12">
        <div>
            <ul class="pagination" id="pageSalinanObat" style="float:none">
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
<div class="modal_layout_obat"></div>

@section('js_modal_obat')
<script type="text/javascript">
    function tambahObat(){
        $.post("{!! route('modalTambahObat') !!}",{}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout_obat').html(data.content);
                $('.modal_layout_obat').show();
                $('#myModal').modal('show');
            }
        });
    }
    function hapus(i){
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
            $.post("{!! route('hapusObatRekap') !!}",{id:i}).done(function(data){
                if(data.status=='success'){
                    swal("Berhasil!", "Data berhasil dihapus!", "success");
                }else{
                    swal("Gagal!", "Data gagal dihapus!", "error");
                }
                $(".tahap5").load(location.href + " .tahap5>*", "");
            });
        });
    }

    $('select[name=searchby]').change(function(){
        var searchby = $('select[name=searchby]').val();
        var cariText = '';
        var cariStatus = $('#searchdate').val();
        $('#searchtext').val('');
        if(searchby=='Tgl_Register'){
            $('#searchtext').hide();
            $('#searchdate').show();
        }else{
            $('#searchtext').show();
            $('#searchdate').hide();
        }
        $.post("{!! route('salinanResep') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('#pageSalinanObat').html(halaman_page(1,data.data));
            }
        });
    });

    $('input[name=searchdate]').change(function(){
        var searchby = $('select[name=searchby]').val();
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        $.post("{!! route('salinanResep') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('#pageSalinanObat').html(halaman_page(1,data.data));
            }
        });
    });

    $('#searchtext').keyup(function(){
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var by = $('select[name=searchby]').val();
        $.post("{!! route('salinanResep') !!}",{cariText:cariText,cariStatus:cariStatus,by:by,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('#pageSalinanObat').html(halaman_page(1,data.data));
            }
        });
    }); 

    $('.lahir').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        format:'yyyy-mm-dd',
        minView: 2,
        forceParse: 0,
    });

    function page(i){
        var searchby = $('select[name=searchby]').val();
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var hasil = 'searchby = '+searchby+'\ncariText = '+cariText+'\ncariStatus = '+cariStatus+'\ni = '+i;
        $.post("{!! route('salinanResep') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:i}).done(function(data){
            $('#hasilCari').html('');
            $('#hasilCari').html(tampilkan(data.data));
            $('#pageSalinanObat').html(halaman_page(data.i,data.data));
        });
    }

    function halaman_page(i,data){
        var pageination = '';
        if(i==1){
            pageination+= "<li class='disabled'><a href='#'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+= "<li><a href='#' onclick='page(1)'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='page("+(i-1)+")'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }

        var batas = 4;
        var start = '';
        var end = '';
        var akhir = Math.ceil((data.total.length/10));

        if(i>batas){
            start = parseInt(i)-parseInt(batas);
        }else{
            start = 1;
        }

        if(i<(akhir-batas)){
            end = parseInt(i)+parseInt(batas);
        }else{
            end = akhir;
        }

        var a='';
        for (var j = start; j <= end; j++) {
            if(j==i){
                a = 'class="active"';
            }else{
                a ='';
            }
            pageination+="<li "+a+"><a href='#' onclick='page("+j+")'>"+j+"</a></li>";
        }

        if(i==akhir){
            pageination+="<li class='disabled'><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+="<li><a href='#' onclick='page("+(parseInt(i)+1)+")'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='page("+akhir+")'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }
        return pageination;
    }

    function tampilkan(data){
        var d = data.data.length;
        var html = '';
        if(d==0){
            html = '<tr>'+
            '<td colspan="5">Data tidak ada</td>'+
            '</tr>';
        }else{
            var i=1;
            $.each( data.data, function( key, value ) {
            html += '<tr>'+
            '<td>'+i+'</td>'+
            '<td>'+value.No_Register+'</td>'+
            '<td id="obatDet'+i+'">'+obat(value.No_Register,i)+'</td>'+
            '<td id="qtt'+i+'"></td>'+
            '<td id="tglRegister'+i+'"></td>'+
            '</tr>';
            i++;
            });
        }
        return html;
    }  

    function obat(data,i){
        var html1='';
        $.post("{{route('obatDetailSalin')}}",{data:data,i:i},function(dt){
            if(dt.status=='success'){
                var d=dt.dt.length;
                if(d==0){
                    html1 = '-';
                }else{
                    html1 = '<ol>';
                    $.each( dt.dt, function( key, value ) {
                        html1+='<li>'+value.NamaBrg+'</li>';
                    });
                    html1+='</ol>';

                    html2 = '<ol>';
                    $.each( dt.dt, function( key, value ) {
                        html2+='<li>'+value.Jml+' '+value.Satuan+'</li>';
                    });
                    html2+='</ol>';
                }
                $('#obatDet'+dt.i).html(html1);
                $('#qtt'+dt.i).html(html2);
                $('#tglRegister'+dt.i).html(dt.tgl);
            }
        });
    }
</script>
@stop