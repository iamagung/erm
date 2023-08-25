@extends('dokter.master.main')
@section('content')

<script src="{!! asset('adminAsset/js/highcharts.js') !!}"></script>
<section class="content-header">

    <h1 class="text-center">

        <b>Data User Perawat Poli</b>

    </h1>

</section>
<div class="col-md-12 col-md-12">

    <div class="box">

        <div class="box-header">

            <div class="box-tools pull-right">

                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Minimaze"><i class="fa fa-minus"></i></button>

            </div>

        </div>

        <div class="box-body">
            <div class="col-lg-12 col-md-12">
                <a href="#" class="btn btn-primary" style="border-radius: 10px !important" onclick="formDokter(0)"><i class="fa fa-plus"> Tambah Perawat Poli</i></a>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12" style="padding: 0px">
                <div class="col-lg-8 col-md-8" style="padding: 0px">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" id="searchtext" name="search" class="form-control" style="border-radius: 10px !important" placeholder="Search...">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <select class="form-control" name="searchby" style="border-radius: 10px !important">
                            <option value="nama">Nama Perawat</option>
                            <option value="namaPoli">Nama Poli</option>
                            <option value="username">Username</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div class="col-lg-12 col-md-12">
                <table class="table table-bordered table-striped" id="dataPoli">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Perawat</th>
                            <th>Nama Poli</th>
                            <th width="10%">Username</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="hasilCari">
                        <?php
                        $i=1;
                        foreach ($dokter1 as $key) {
                        ?>
                        <tr>
                            <td>{!! $i !!}</td>
                            <td>{!! $key->nama !!}</td>
                            <td>{!! $key->namaPoli !!}</td>
                            <td>{!! $key->username !!}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" onclick="viewDokter('{!! $key->id !!}')"><i class="fa fa-eye"></i> View</a></li>   
                                        <li><a href="#" onclick="resetDokter('{!! $key->id !!}')"><i class="fa fa-refresh"></i> Reset Password</a></li>
                                        <li><a href="javascript:void(0);" onclick="deleteDokter('{!! $key->id !!}')"><i class="fa fa-trash-o"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        }
                        ?>
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

    </div>

    <div class="modal_layout"></div>
</div>
</section>
@stop
@section('js')
<script type="text/javascript">

    function page(i){
        var searchby = $('select[name=searchby]').val();
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var hasil = 'searchby = '+searchby+'\ncariText = '+cariText+'\ncariStatus = '+cariStatus+'\ni = '+i;
        $.post("{!! route('pagePerawatDokter') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:i}).done(function(data){
            $('#hasilCari').html('');
            $('#hasilCari').html(tampilkan(data.data));
            $('.pagination').html(halaman_page(data.i,data.data));
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

    $('input[name=id]').keyup(function(){
        $('#btnProses').attr('disabled','disabled');
    });

    $('select[name=searchby]').change(function(){
        var searchby = $('select[name=searchby]').val();
        var cariText = '';
        var cariStatus = $('#searchdate').val();
        $('#searchtext').val('');
        if(searchby=='aktif'){
            $('#searchtext').hide();
            $('#searchdate').show();
        }else{
            $('#searchtext').show();
            $('#searchdate').hide();
        }
        $.post("{!! route('pagePerawatDokter') !!}",{cariText:cariText,cariStatus:cariStatus,by:searchby,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('.pagination').html(halaman_page(1,data.data));
            }
        });
    });

    $('#searchtext').keyup(function(){
        var cariText = $('#searchtext').val();
        var cariStatus = $('#searchdate').val();
        var by = $('select[name=searchby]').val();
        $.post("{!! route('pagePerawatDokter') !!}",{cariText:cariText,cariStatus:cariStatus,by:by,i:1}).done(function(data){
            if(data.status=='success'){
                $('#hasilCari').html('');
                $('#hasilCari').html(tampilkan(data.data));
                $('.pagination').html(halaman_page(1,data.data));
            }
        });
    });  

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
            '<td>'+value.nama+'</td>'+
            '<td>'+value.namaPoli+'</td>'+
            '<td>'+value.username+'</td>'+
            '<td>'+
                '<div class="btn-group">'+
                    '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a>'+
                    '<ul class="dropdown-menu pull-right">'+
                        '<li><a href="javascript:void(0);" onclick="viewDokter('+value.i+')"><i class="fa fa-eye"></i> View</a></li>'+  
                        '<li><a href="#" onclick="resetDokter('+value.i+')"><i class="fa fa-refresh"></i> Reset Password</a></li>'+
                        '<li><a href="javascript:void(0);" onclick="deleteDokter('+value.i+')"><i class="fa fa-trash-o"></i> Delete</a></li>'+
                    '</ul>'+
                '</div>'+
            '</td>'+
            '</tr>';
            i++;
            });
        }
        return html;
    }  

    function formDokter(id){
        $.post("{!! route('formPerawatDokter') !!}",{id:id}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout').html(data.content);
                $('.modal_layout').show();
                $('#myModal').modal('show');
            }else{
                swal("Gagal Tampil");
            }
        });
    }

    function viewDokter(id){
        $.post("{!! route('detailPerawatDokter') !!}",{id:id}).done(function(data){
            if(data.status=='success'){
                $('.modal_layout').html(data.content);
                $('.modal_layout').show();
                $('#myModal').modal('show');
            }else{
                swal("Gagal Tampil");
            }
        });
    }

    function deleteDokter(id){
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
            $.post("{!! route('deletePerawatDokter') !!}",{id:id}).done(function(data){
                if(data.status=='success'){
                    swal("Berhasil!", "Data berhasil dihapus!", "success");
                }else{
                    swal("Gagal!", "Data gagal dihapus!", "error");
                }
                $("table#dataPoli").load(location.href + " #dataPoli>*", "");
                $("ul.pagination").load(location.href + " .pagination>*", "");
            });
        });
    }

    function resetDokter(id){
        swal({
        title: "Anda yakin?",
        text: "Password akan direset sama seperti username!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        //closeOnCancel: false
        },
        function(){
            $.post("{!! route('resetPerawatDokter') !!}",{id:id}).done(function(data){
                if(data.status=='success'){
                    swal("Berhasil!", "Data berhasil dihapus!", "success");
                }else{
                    swal("Gagal!", "Data gagal dihapus!", "error");
                }
                $("table#dataPoli").load(location.href + " #dataPoli>*", "");
                $("ul.pagination").load(location.href + " .pagination>*", "");
            });
        });
    }
</script>
@stop