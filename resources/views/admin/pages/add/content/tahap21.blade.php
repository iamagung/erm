<!-- <div class="col-lg-12 col-md-12">
    <a href="{{route('cetak5')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
    <a href="{{route('cetak5',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
</div> -->
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12" style="padding: 0px">
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12" style="padding: 0px">
        <div class="col-lg-8 col-md-8" style="padding: 0px">
            <div class="col-lg-6 col-md-6">
                <input type="text" id="searchtext4" name="search" class="form-control" style="border-radius: 10px !important" placeholder="Search...">
                <input type="text" name="searchdate4" id="searchdate4" style="display: none;border-radius: 10px !important" readonly value="{!! date('Y-m-d') !!}" class="form-control date lahir">
            </div>
            <div class="col-lg-6 col-md-6">
                <select class="form-control" name="searchby4" style="border-radius: 10px !important">
                    <option value="diagnosa">Diagnosa</option>
                    <option value="icd10">ICD 10</option>
                    <option value="tanggalKunjungan">Tanggal Kunjungan</option>
                    <option value="NamaPoli">Nama Poli</option>
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <!-- TANDA VITAL & ANTROPOMETRI -->
    <div class="col-lg-12 col-md-12 tahap21" style="padding: 0px">
        <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>

        <?php
        $rekap = DB::table('rekap_medik')->where('no_RM',Session::get('no_RM'))->orderBy('tanggalKunjungan','DESC')->limit(10)->get();  
        $total = DB::table('rekap_medik')->where('no_RM',Session::get('no_RM'))->get();
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal kunjungan</th>
                    <th>Diagnosa</th>
                    <th>ICD 10</th>
                    <th>Tindakan & Obat-obatan</th>
                    <th>Icd 9 cm</th>
                    <th>Poli</th>
                    <th width="5%">Aksi</th>
                </tr>
            </thead>
            <tbody id="hasilRekapRJ">
                <?php
                if(count($rekap)!=0){
                    foreach ($rekap as $key) {
                    ?>
                    <tr>
                        <td>{{$key->tanggalKunjungan}}</td>
                        <td>
                            <ol>
                            <?php
                            if($key->diagnosa!=''){
                                $diag = explode(";", $key->diagnosa);
                                for ($i=0; $i < count($diag)-1; $i++) {
                                    ?>
                                    <li>{{$diag[$i]}}</li>
                                    <?php
                                }
                            }
                            ?>
                            </ol>
                        </td>
                        <td>
                            <ol>
                            <?php
                            if($key->icd10!=''){
                                $diag = explode(";", $key->icd10);
                                for ($i=0; $i < count($diag)-1; $i++) {
                                    ?>
                                    <li>{{$diag[$i]}}</li>
                                    <?php
                                }
                            }
                            ?>
                            </ol>
                        </td>
                        <td>
                            Obat-obatan
                            <ol>
                            <?php
                            $obat = DB::connection('rsu')->table('tr_rawatjalanobat')->where('No_Register',$key->no_Register)->get();
                            if(count($obat)!=0){
                                foreach ($obat as $keyO) {
                                    echo '<li>'.$keyO->NamaBrg.' <b>( '.$keyO->Jml.' '.$keyO->Satuan.')</b></li>';
                                }
                            }
                            ?>
                            </ol>
                            Tindakan<br/>
                            <ol>
                            <?php
                            if($key->tindakan!=''){
                                $diag = explode(";", $key->tindakan);
                                for ($i=0; $i < count($diag)-1; $i++) {
                                    ?>
                                    <li>{{$diag[$i]}}</li>
                                    <?php
                                }
                            }
                            ?>
                            </ol>
                        </td>
                        <td>
                            <ol>
                            <?php
                            if($key->icd9!=''){
                                $diag = explode(";", $key->icd9);
                                for ($i=0; $i < count($diag)-1; $i++) {
                                    ?>
                                    <li>{{$diag[$i]}}</li>
                                    <?php
                                }
                            }
                            ?>
                            </ol>
                        </td>
                        <td>{{$key->NamaPoli}}</td>
                        <td><a href="#" onclick="detailRekapRJ('{{$key->id_rekapMedik}}')" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="7">Tidak ada data</td>
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
            <ul class="pagination" id="pageRekapRJ" style="float:none">
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
                    echo "<li $a><a href='#' onclick='pageRJ($i)'>$i</a></li>";
                }
                if($page==$paging1){
                    ?>
                    <li class="disabled"><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li class="disabled"><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
                    <?php
                }else{
                    ?>
                    <li><a href='#' onclick="pageRJ({!! $start_number+1 !!})"><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li><a href='#' onclick="pageRJ({!! $paging1 !!})"><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal_layout_obat1"></div>

@section('js_tahap2')
<script type="text/javascript">
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

    $('select[name=searchby4]').change(function(){
        var searchby = $('select[name=searchby4]').val();
        var cariText = '';
        var cariStatus = $('#searchdate4').val();
        $('#searchtext4').val('');
        if(searchby=='tanggalKunjungan'){
            $('#searchtext4').hide();
            $('#searchdate4').show();
        }else{
            $('#searchtext4').show();
            $('#searchdate4').hide();
        }
        $.post("{!! route('RekapRJ') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilRekapRJ').html('');
                $('#hasilRekapRJ').html(tampilkanRJ(data.data));
                $('#pageRekapRJ').html(halaman_pageRJ(data.i,data.data));
            }
        });
    });

    $('input[name=searchdate4]').change(function(){
        var searchby = $('select[name=searchby4]').val();
        var cariText = $('#searchtext4').val();
        var cariStatus = $('#searchdate4').val();
        $.post("{!! route('RekapRJ') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilRekapRJ').html('');
                $('#hasilRekapRJ').html(tampilkanRJ(data.data));
                $('#pageRekapRJ').html(halaman_pageRJ(data.i,data.data));
            }
        });
    });

    $('#searchtext4').keyup(function(){
        var cariText = $('#searchtext4').val();
        var cariStatus = $('#searchdate4').val();
        var by = $('select[name=searchby4]').val();
        $.post("{!! route('RekapRJ') !!}",{cariText:cariText,cariStatus:cariStatus,by:by,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilRekapRJ').html('');
                $('#hasilRekapRJ').html(tampilkanRJ(data.data));
                $('#pageRekapRJ').html(halaman_pageRJ(data.i,data.data));
            }
        });
    });

    function detailRekapRJ(id){
        $.post("{!! route('modalDetRekap') !!}",{id:id}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout_obat1').html(data.content);
                $('.modal_layout_obat1').show();
                $('#myModal').modal('show');
            }
        });
    }
    function pageRJ(i){
        var searchby = $('select[name=searchby]').val();
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var hasil = 'searchby = '+searchby+'\ncariText = '+cariText+'\ncariStatus = '+cariStatus+'\ni = '+i;
        $.post("{!! route('RekapRJ') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:i}).done(function(data){
            $('#hasilRekapRJ').html('');
            $('#hasilRekapRJ').html(tampilkanRJ(data.data));
            $('#pageRekapRJ').html(halaman_pageRJ(data.i,data.data));
        });
    }

    function halaman_pageRJ(i,data){
        var pageination = '';
        if(i==1){
            pageination+= "<li class='disabled'><a href='#'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+= "<li><a href='#' onclick='pageRJ(1)'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='pageRJ("+(i-1)+")'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
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
            pageination+="<li "+a+"><a href='#' onclick='pageRJ("+j+")'>"+j+"</a></li>";
        }

        if(i==akhir){
            pageination+="<li class='disabled'><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+="<li><a href='#' onclick='pageRJ("+(parseInt(i)+1)+")'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='pageRJ("+akhir+")'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }
        return pageination;
    }

    function tampilkanRJ(data){
        var d = data.data.length;
        var html = '';
        if(d==0){
            html = '<tr>'+
            '<td colspan="7">Data tidak ada</td>'+
            '</tr>';
        }else{
            var i=1;
            $.each( data.data, function( key, value ) {
            html += '<tr>'+
            '<td>'+value.tanggalKunjungan+'</td>'+
            '<td>'+daftarlist(value.diagnosa)+'</td>'+
            '<td >'+daftarlist(value.icd10)+'</td>'+
            '<td >'+
            'Obat-obatan'+
            '<div id="obatDetRJ'+i+'">'+obatRJ(value.no_Register,i)+'</div>'+
            'Tindakan<br/>'+
            daftarlist(value.tindakan)+
            '</td>'+
            '<td >'+daftarlist(value.icd9)+'</td>'+
            '<td >'+value.NamaPoli+'</td>'+
            '<td ><a href="#" onclick="detailRekapRJ('+value.id_rekapMedik+')" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>'+
            '</tr>';
            i++;
            });
        }
        return html;
    }

    function daftarlist(data){
        var html1 = '';
        var dt = data;
        var n ='';
        if(dt == null){
            html1='';
        }else{
            n = data.split(';');
            if(n.length!=0){
                html1 = '<ol>';
                for (var i = 0; i < n.length-1; i++) {
                    html1+='<li>'+n[i]+'</li>';
                }
                html1+='</ol>';
            }else{
                html1 = '';
            }
        }
        return html1;
    }

    function obatRJ(data,i){
        var html1='';
        $.post("{{route('obatDetailSalin')}}",{data:data,i:i},function(dt){
            if(dt.status=='success'){
                var d=dt.dt.length;
                if(d==0){
                    html1 = '-';
                }else{
                    html1 = '<ol>';
                    $.each( dt.dt, function( key, value ) {
                        html1+='<li>'+value.NamaBrg+'<b> ('+value.Jml+' '+value.Satuan+' )</b></li>';
                    });
                    html1+='</ol>';
                }
                $('#obatDetRJ'+dt.i).html(html1);
            }
        });
    }
</script>
@stop
