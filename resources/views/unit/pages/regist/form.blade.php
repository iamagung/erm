<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <?php
    $value_status = ['Y','T'];
    if($id=='0'){
      $id_poli = $id;
      $nama_admin = '';
      $status_admin = '';
      $telp_admin = '';
      $alamat_admin = '';
    }else{
      $poliedit = DB::table('users')->where('id',$id)->first();
      $id_poli = $id;
      $nama_admin = $poliedit->nama;
      $status_admin = $poliedit->aktif;
      $telp_admin = $poliedit->telp;
      $alamat_admin = $poliedit->alamat;
    }
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Admin</h4>
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
                  echo tampil('hidden','hidden','','id_admin','readonly',$id_poli,'','','');
                  echo tampil('text','text','Nama Admin','nama_admin','required',$nama_admin,'','','');
                  if($id==0){
                  echo tampil('text','text','Username Admin','username_admin','required','','','','');
                  echo tampil('text','password','Password Admin','password_admin','required','','','','');
                  }
                  echo tampil('text','text','Telephone Admin','telp_admin','required',$telp_admin,'','','');
                  echo tampil('text','text','Alamat Admin','alamat_admin','required',$alamat_admin,'','','');
                  echo tampil('radio','radio','Status','status_admin','required',$value_status,["Aktif","Tidak aktif"],'2',$status_admin);
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
        var i = 0;
        var id = $('input[name=id_admin]').val();
        var nama = $('input[name=nama_admin]').val();
        var username = $('input[name=username_admin]').val();
        var password = $('input[name=password_admin]').val();
        var telp = $('input[name=telp_admin]').val();
        var alamat = $('input[name=alamat_admin]').val();
        var status = $('input[name=status_admin]:checked');

        if(status.length==0){
          swal('Status harus diisi');
          i++;
        }

        if(alamat==''){
          swal('Alamat harus diisi');
          i++;
        }

        if(telp==''){
          swal('Nomor telepon harus diisi');
          i++;
        }else{
          if(isNaN(telp)){
            swal('Nomer harus angka');
            i++;
          }
        }
        
        if(id==0){
          if(password==''){
            swal('Password harus diisi');
            i++;
          }
          if(username==''){
            swal('Username harus diisi');
            i++;
          }
        }

        if(nama==''){
          swal('Nama Harus diisi');
          i++;
        }

        if(i==0){
          $.post("{!! route('simpanAdmin') !!}",data,function(hasil){
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
              }else if(hasil.status=='exist'){
                  swal('Username Sudah ada');
              }else{
                  swal('Gagal disimpan');
              }
          },'json');
        }else{

        }
    }
</script>