<!-- <div class="col-lg-12 col-md-12">
    <a href="{{route('cetak7')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
    <a href="{{route('cetak7',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
</div> -->
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 tahap71" style="padding: 0px">
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12" style="padding: 0px">
        <div class="col-lg-8 col-md-8" style="padding: 0px">
            <div class="col-lg-6 col-md-6">
                <input type="text" id="searchtext7" name="search" class="form-control" style="border-radius: 10px !important" placeholder="Search...">
                <input type="text" id="searchdate7" style="display: none;border-radius: 10px !important" readonly value="{!! date('Y-m-d') !!}" class="form-control date lahir">
            </div>
            <div class="col-lg-6 col-md-6">
                <select class="form-control" name="searchby7" style="border-radius: 10px !important">
                    <option value="photometri">Photometri</option>
                    <option value="objectfile">Nama File</option>
                    <option value="imagedate">Tanggal</option>
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix" style="margin-bottom: 10px"></div>
    <div class="col-lg-12 col-md-12 tahap7" style="padding: 0px">
        <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Photometri</th>
                    <th width="50%">View</th>
                    <th width="10%">Tanggal</th>
                </tr>
            </thead>
            <tbody id="hasilradiologi">
                <?php
                $dbcon = pg_connect("host='192.168.1.172' user='postgres' password='postgres5432' dbname='dicom'");
                
                // $hasil = preg_replace('/[^0-9]/', '', Session::get('no_RM'));
                $hasil = strtoupper(Session::get('no_RM'));
                // Cek Koneksi Ke Server Database
                // PAKAI
                $query = "SELECT * FROM dicomimages WHERE imagepat = '".$hasil."' limit 10";
                $querytot = "SELECT * FROM dicomimages WHERE imagepat = '".$hasil."'";
                // END PAKAI

                // $query = "SELECT * FROM dicomimages limit 10";
                // $querytot = "SELECT * FROM dicomimages";
                
                $result = pg_query($dbcon, $query) or die("Query gagal  " );
                $resulttot = pg_query($dbcon, $querytot) or die("Query gagal  " );
                $total = pg_num_rows ($resulttot);  
                if($total!=0){
                    while($arr = pg_fetch_array ($result)){
                        $ur = "http://192.168.1.8:8192/dwv/viewers/static/index.php?id=file:///Z:/installer/dicomserver1417d/data/".str_replace('\\', '/', $arr['objectfile']);
                     echo '<tr>';
                     echo '<td>'.$arr['photometri'].'</td>';
                     echo "<td><a href='".$ur."' target='_blank'>".str_replace('\\', '/', $arr['objectfile'])."</a></td>";
                     echo '<td>'.date('d-m-Y',strtotime($arr['imagedate'])).'</td>';
                     echo '</tr>';
                    }
                }else{
                    echo '<tr>';
                    echo '<td colspan="3">Data tidak ada</td>';
                    echo '</tr>';
                }
                ?>              
            </tbody>
        </table>
    </div>

    
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12">
        <div>
            <ul class="pagination" id="pageradiologi" style="float:none">
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
                    echo "<li $a><a href='#' onclick='pageRadio($i)'>$i</a></li>";
                }
                if($page==$paging1){
                    ?>
                    <li class="disabled"><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li class="disabled"><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
                    <?php
                }else{
                    ?>
                    <li><a href='#' onclick="pageRadio({!! $start_number+1 !!})"><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li><a href='#' onclick="pageRadio({!! $paging1 !!})"><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal_layout_radio"></div>

@section('js_modal_radio')
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

    $('select[name=searchby7]').change(function(){
        var searchby = $('select[name=searchby7]').val();
        var cariText = '';
        var cariStatus = $('#searchdate7').val();
        $('#searchtext7').val('');
        if(searchby=='imagedate'){
            $('#searchtext7').hide();
            $('#searchdate7').show();
        }else{
            $('#searchtext7').show();
            $('#searchdate7').hide();
        }
        $.post("{!! route('pageRadio') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilradiologi').html('');
                $('#hasilradiologi').html(tampilkanRadio(data.data));
                $('#pageradiologi').html(halaman_pageRadio(data.i,data.data));
            }
        });
    });

    $('#searchdate7').change(function(){
        var searchby = $('select[name=searchby7]').val();
        var cariText = $('#searchtext7').val();
        var cariStatus = $('#searchdate7').val();
        $.post("{!! route('pageRadio') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilradiologi').html('');
                $('#hasilradiologi').html(tampilkanRadio(data.data));
                $('#pageradiologi').html(halaman_pageRadio(data.i,data.data));
            }
        });
    });

    $('#searchtext7').keyup(function(){
        var cariText = $('#searchtext7').val();
        var cariStatus = $('#searchdate7').val();
        var by = $('select[name=searchby7]').val();
        $.post("{!! route('pageRadio') !!}",{cariText:cariText,cariStatus:cariStatus,by:by,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilradiologi').html('');
                $('#hasilradiologi').html(tampilkanRadio(data.data));
                $('#pageradiologi').html(halaman_pageRadio(data.i,data.data));
            }
        });
    });  

    function halaman_pageRadio(i,data){
        var pageination = '';
        if(i==1){
            pageination+= "<li class='disabled'><a href='#'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+= "<li><a href='#' onclick='pageRadio(1)'><span aria-hidden='true'>First</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='pageRadio("+(i-1)+")'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
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
            pageination+="<li "+a+"><a href='#' onclick='pageRadio("+j+")'>"+j+"</a></li>";
        }

        if(i==akhir){
            pageination+="<li class='disabled'><a href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li class='disabled'><a href='#'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }else{
            pageination+="<li><a href='#' onclick='pageRadio("+(parseInt(i)+1)+")'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Previous</span></a></li>"+
                "<li><a href='#' onclick='pageRadio("+akhir+")'><span aria-hidden='true'>Last</span><span class='sr-only'>Previous</span></a></li>";
        }
        return pageination;
    }

    function tampilkanRadio(data){
        var d = data.datatot;
        var html = '';
        if(d==0){
            html = '<tr>'+
            '<td colspan="3">Data tidak ada</td>'+
            '</tr>';
        }else{
            for(var i=0;i<d;i++){
                var tglmurni = data.data[i]['imagedate'];
                var tahun = tglmurni.substring(0,4);
                var bulan = tglmurni.substring(4,6);
                var hari = tglmurni.substring(6,8);
                var tgl = hari+'-'+bulan+'-'+tahun;
                var url_gam = data.data[i]['objectfile'];
                url_gam = url_gam.replace("\\",'/');
                html += '<tr>'+
                '<td>'+data.data[i]['photometri']+'</td>'+
                '<td><a href="http://192.168.1.8/rs_wahidin_dev/public/dwv/viewers/static/index.php?id=file:///Z:/'+url_gam+'" target="_blank">'+data.data[i]['objectfile']+'</a></td>'+
                '<td>'+tgl+'</td>'+
                '</tr>';
            }
        }
        return html;
    }  

    function pageRadio(i){
        var searchby = $('select[name=searchby7]').val();
        var cariText = $('#searchtext7').val();
        var cariStatus = $('#searchdate7').val();
        var hasil = 'searchby = '+searchby+'\ncariText = '+cariText+'\ncariStatus = '+cariStatus+'\ni = '+i;
        $.post("{!! route('pageRadio') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:i}).done(function(data){
            $('#hasilradiologi').html('');
            $('#hasilradiologi').html(tampilkanRadio(data.data));
            $('#pageradiologi').html(halaman_pageRadio(data.i,data.data));
        });
    }
</script>
@stop