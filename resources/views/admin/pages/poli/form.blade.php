<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <?php
    $value_status = ['1','0'];
    if($id=='0'){
      $id_poli = $id;
      $nama_poli = '';
      $status_poli = '';
    }else{
      $poliedit = DB::table('poli')->where('id_poli',$id)->first();
      $id_poli = $id;
      $nama_poli = $poliedit->nama_poli;
      $status_poli = $poliedit->status_poli;
    }
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Poli</h4>
      </div>
      <div class="modal-body">
        <?php
          function tampil($style,$type,$label,$name,$required,$value,$ketvalue,$jumlah,$status){
            $form='';
              if($style=='text'){
                $form = '<div class="form-group">'.
                '<label class="col-lg-4 col-md-4">'.$label.'</label>'.
                '<div class="col-lg-8 col-md-8">'.
                '<input type="'.$type.'" name="'.$name.'" id="'.$name.'" class="form-control" style="border-radius: 10px !important" placeholder="'.$label.'" value="'.$value.'" '.$required.'>'.
                '</div>'.
                '</div>'.
                '<div class="clearfix" style="margin-bottom: 10px"></div>';
              }else if($style=='hidden'){
                $form = '<input type="'.$type.'" name="'.$name.'" id="'.$name.'" class="form-control" style="border-radius: 10px !important" placeholder="'.$label.'" value="'.$value.'" '.$required.'>'.
                '<div class="clearfix" style="margin-bottom: 10px"></div>';
              }else if($style=='select'){
                $form = '<div class="form-group">'.
                '<label class="col-lg-4 col-md-4">'.$label.'</label>'.
                '<div class="col-lg-8 col-md-8">'.
                '<select class="form-control" '.$required.'>';
                for($i=0;$i<$jumlah;$i++){
                $form.='<option value="'.$value[$i].'">'.$ketvalue[$i].'</option>';
                }
                $form.='</select>'.
                '</div>'.
                '</div>'.
                '<div class="clearfix" style="margin-bottom: 10px"></div>';
              }else if($style=='radio'){
                $form = '<div class="form-group">'.
                '<label class="col-lg-4 col-md-4">'.$label.'</label>'.
                '<div class="col-lg-8 col-md-8">';
                for($i=0;$i<$jumlah;$i++){
                  if($i!=0){
                    $form .= '<br/>';
                  }
                  if($status==$value[$i]){
                    $check = 'checked';
                  }else{
                    $check = '';
                  }
                  $form.='<label><input type="'.$type.'" name="'.$name.'" value="'.$value[$i].'" '.$required.' '.$check.'>'.$ketvalue[$i].'</label>';
                }
                $form .= '</div>'.
                '</div>'.
                '<div class="clearfix" style="margin-bottom: 10px"></div>';
              }
              echo $form;
          }
          ?>
          <form id="data_poli">
          <div class="col-lg-12 col-md-12">
              <?php
                  // tampil($style,$type,$label,$name,$required,$value,$ketvalue,$jumlah,$status)
                  echo tampil('hidden','hidden','','id_poli','readonly',$id_poli,'','',$status_poli);
                  echo tampil('text','text','Nama Poli','nama_poli','required',$nama_poli,'','',$status_poli);
                  echo tampil('radio','radio','Status','status_poli','required',$value_status,["Aktif","Tidak aktif"],'2',$status_poli);
              ?>
          </div>
          <div class="clearfix"></div>
          </form>
      </div>
      <div class="modal-footer">
          <a href="#" onclick="kirimData()" class="btn btn-success">Proses</a>
      </div>
    </div>

  </div>
</div>

<!-- <script src="{!!  asset('adminAsset/js/jquery-ui-1.10.3.min.js') !!}" type="text/javascript"></script> -->
<script type="text/javascript">
    function kirimData(){
        var data = $('form#data_poli').serialize();
        $.post("{!! route('simpanPoli') !!}",data,function(hasil){
            if(hasil.status=='success'){
                $('#myModal').modal('hide');
                // location.reload();
                // $(".box-body").load(location.href + " .box-body>*", "");
                $("table#dataPoli").load(location.href + " #dataPoli>*", "");
                $("ul.pagination").load(location.href + " .pagination>*", "");
                swal('Berhasil disimpan');
            }else if(hasil.status=='tidak'){
                $('#myModal').modal('hide');
                // location.reload();
                // $(".box-body").load(location.href + " .box-body>*", "");
                $("table#dataPoli").load(location.href + " #dataPoli>*", "");
                $("ul.pagination").load(location.href + " .pagination>*", "");
                swal('Tidak ada yang berubah');
            }else{
                swal('Gagal disimpan');
            }
        },'json');
    }
</script>