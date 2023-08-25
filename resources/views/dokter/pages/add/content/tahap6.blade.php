<!-- <div class="col-lg-12 col-md-12">
    <a href="{{route('cetak6')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
    <a href="{{route('cetak6',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
</div> -->
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 tahap61" style="padding: 0px">
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12" style="padding: 0px">
        <div class="col-lg-8 col-md-8" style="padding: 0px">
            <div class="col-lg-6 col-md-6">
                <input type="text" id="searchtext6" name="search" class="form-control" style="border-radius: 10px !important" placeholder="Search...">
                <input type="text" id="searchdate6" style="display: none;border-radius: 10px !important" readonly value="{!! date('Y-m-d') !!}" class="form-control date lahir">
            </div>
            <div class="col-lg-6 col-md-6">
                <select class="form-control" name="searchby6" style="border-radius: 10px !important">
                    <option value="nama_lab">Nama Lab</option>
                    <option value="merk_alat">Alat</option>
                    <option value="periksa_tgl">Tanggal</option>
                    <option value="info1">Info</option>
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12 tahap6" style="padding: 0px">
        <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Lab</th>
                    <th>Alat (Kode) (metode)</th>
                    <th>Hasil </th>
                    <th>Tanggal</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody id="hasillaborat">
                <?php
                $dbcon = pg_connect("host='192.168.1.172' user='postgres' password='postgres5432' dbname='lims2'");
                // $dbcon = pg_connect("host='localhost' user='postgres' password='root' dbname='lims2'");
        
                // Cek Koneksi Ke Server Database
                // PAKAI
                $query = "
                SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                c.nama as nama_lab
                FROM tab_lab_master as a 
                LEFT JOIN tab_lab_detil as b ON b.id_master=a.id 
                LEFT JOIN tab_kdlab as c ON c.id=b.id_lab
                WHERE a.no_rm = '".Session::get('no_RM')."'
                ORDER BY a.periksa_tgl DESC
                LIMIT 10
                ";
                $querytot = "
                SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                c.nama as nama_lab
                FROM tab_lab_master as a 
                LEFT JOIN tab_lab_detil as b ON b.id_master=a.id 
                LEFT JOIN tab_kdlab as c ON c.id=b.id_lab
                WHERE a.no_rm = '".Session::get('no_RM')."'
                ";
                // END PAKAI

                // $query = "
                // SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                // b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                // c.nama as nama_lab
                // FROM tab_lab_master as a 
                // LEFT JOIN tab_lab_detil as b ON b.id_master=a.id 
                // LEFT JOIN tab_kdlab as c ON c.id=b.id_lab
                // ORDER BY a.periksa_tgl DESC
                // LIMIT 10
                // ";
                // $querytot = "
                // SELECT a.nama as nama_pasien,a.periksa_tgl,a.info1,
                // b.satuan,b.metoda,b.merk_alat,b.kode_alat,b.hasil,
                // c.nama as nama_lab
                // FROM tab_lab_master as a 
                // LEFT JOIN tab_lab_detil as b ON b.id_master=a.id 
                // LEFT JOIN tab_kdlab as c ON c.id=b.id_lab
                // ";

                $result = pg_query($dbcon, $query) or die("Query gagal  " );
                $resulttot = pg_query($dbcon, $querytot) or die("Query gagal  " );
                $total = pg_num_rows ($resulttot);  
                if($total!=0){
                    while($arr = pg_fetch_array ($result)){
                     echo '<tr>';
                     echo '<td>'.$arr['nama_lab'].'</td>';
                     echo '<td>'.$arr['merk_alat'].'('.$arr['kode_alat'].') ('.$arr['metoda'].')</td>';
                     echo '<td>'.$arr['hasil'].' '.$arr['satuan'].'</td>';
                     echo '<td>'.date('d-m-Y',strtotime($arr['periksa_tgl'])).'</td>';
                     echo '<td>'.$arr['info1'].'</td>';
                     echo '</tr>';
                    }
                }else{
                    echo '<tr>';
                    echo '<td colspan="5">Data tidak ada</td>';
                }
                ?>
            </tbody>
        </table>
    </div>

    
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12">
        <div>
            <ul class="pagination" id="pagelaborat" style="float:none">
                <?php
                $paging1 = ceil($total/10);
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
                    echo "<li $a><a href='#' onclick='pageLab($i)'>$i</a></li>";
                }
                if($page==$paging1){
                    ?>
                    <li class="disabled"><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li class="disabled"><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
                    <?php
                }else{
                    ?>
                    <li><a href='#' onclick="pageLab({!! $start_number+1 !!})"><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li><a href='#' onclick="pageLab({!! $paging1 !!})"><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
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

    $('select[name=searchby6]').change(function(){
        var searchby = $('select[name=searchby6]').val();
        var cariText = '';
        var cariStatus = $('#searchdate6').val();
        $('#searchtext6').val('');
        if(searchby=='periksa_tgl'){
            $('#searchtext6').hide();
            $('#searchdate6').show();
        }else{
            $('#searchtext6').show();
            $('#searchdate6').hide();
        }
        $.post("{!! route('pageLab') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasillaborat').html('');
                $('#hasillaborat').html(tampilkanLab(data.data));
                $('#pagelaborat').html(halaman_pageLab(data.i,data.data));
            }
        });
    });

    $('#searchdate6').change(function(){
        var searchby = $('select[name=searchby6]').val();
        var cariText = $('#searchtext6').val();
        var cariStatus = $('#searchdate6').val();
        $.post("{!! route('pageLab') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasillaborat').html('');
                $('#hasillaborat').html(tampilkanLab(data.data));
                $('#pagelaborat').html(halaman_pageLab(data.i,data.data));
            }
        });
    });

    $('#searchtext6').keyup(function(){
        var cariText = $('#searchtext6').val();
        var cariStatus = $('#searchdate6').val();
        var by = $('select[name=searchby6]').val();
        $.post("{!! route('pageLab') !!}",{cariText:cariText,cariStatus:cariStatus,by:by,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasillaborat').html('');
                $('#hasillaborat').html(tampilkanLab(data.data));
                $('#pagelaborat').html(halaman_pageLab(data.i,data.data));
            }
        });
    });  

    function halaman_pageLab(i,data){
        var pageination = '';
        if(i==1){
            pageination+= "<li class='disabled'><a href='#'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+= "<li><a href='#' onclick='pageLab(1)'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='pageLab("+(i-1)+")'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }

        var batas = 4;
        var start = '';
        var end = '';
        var akhir = Math.ceil((data.total/10));

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
            pageination+="<li "+a+"><a href='#' onclick='pageLab("+j+")'>"+j+"</a></li>";
        }

        if(i==akhir){
            pageination+="<li class='disabled'><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+="<li><a href='#' onclick='pageLab("+(parseInt(i)+1)+")'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='pageLab("+akhir+")'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }
        return pageination;
    }

    function tampilkanLab(data){
        var d = data.datatot;
        var html = '';
        if(d==0){
            html = '<tr>'+
            '<td colspan="5">Data tidak ada</td>'+
            '</tr>';
        }else{
            for(var i=0;i<d;i++){
                var tglmurni = data.data[i]['periksa_tgl'];
                var tg = tglmurni.split(" ");
                var tgl = tg[0].split("-");
                var tgl1 = tgl[2]+'-'+tgl[1]+'-'+tgl[0];
                var a = '';
                var b = '';
                var c = '';
                if(data.data[i]['merk_alat']==null){}else{var a = data.data[i]['merk_alat']}
                if(data.data[i]['kode_alat']==null){}else{var b = data.data[i]['kode_alat']}
                if(data.data[i]['metoda']==null){}else{var c = data.data[i]['metoda']}
                html += '<tr>'+
                    '<td>'+data.data[i]['nama_lab']+'</td>'+
                    '<td>'+a+' ('+b+') ('+c+')</td>'+
                    '<td>'+data.data[i]['hasil']+' '+data.data[i]['satuan']+'</td>'+
                    '<td>'+tgl1+'</td>'+
                    '<td>'+data.data[i]['info1']+'</td>'+
                    '</tr>';
            }
        }
        return html;
    }  

    function pageLab(i){
        var searchby = $('select[name=searchby6]').val();
        var cariText = $('#searchtext6').val();
        var cariStatus = $('#searchdate6').val();
        var hasil = 'searchby = '+searchby+'\ncariText = '+cariText+'\ncariStatus = '+cariStatus+'\ni = '+i;
        $.post("{!! route('pageLab') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:i}).done(function(data){
            $('#hasillaborat').html('');
            $('#hasillaborat').html(tampilkanLab(data.data));
            $('#pagelaborat').html(halaman_pageLab(data.i,data.data));
        });
    }
</script>
@stop