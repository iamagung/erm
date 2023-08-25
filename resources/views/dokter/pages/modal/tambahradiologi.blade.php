<div id="myModalRadio" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Hasil Laboratorium</h4>
      </div>
      <div class="modal-body">
        <form id="formtahap7">
          
        <div class="col-lg-12 col-md-12">Keterangan</div>
        <div class="col-lg-12 col-md-12"><textarea class="form-control" name="ket"></textarea></div>
        <div class="col-lg-12 col-md-12">Upload</div>
        <div class="col-lg-12 col-md-12"><input type="file" accept="image/*" id="foto12"></div>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12">
            <input type="hidden" name="foto_radio" id="hfo12">
            <img src="" style="width: 200px" id="hfoto12">
        </div>
        <div class="clearfix"></div>

        </form>
      </div>
      <div class="modal-footer">
            <a href="#" onclick="simpanTahap6()" class="btn btn-success pull-right" >Tambah</a>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  function simpanTahap6(){
      var i=0;

      var ket = $('textarea[name=ket]').val();
      var foto = $('input[name=foto_radio]').val();
      var data = $('form#formtahap7').serialize();

      if(foto==''){
          swal("Foto harus diisi");
          i++;
      }

      if(ket==''){
          swal("Keterangan harus diisi");
          i++;
      }

      if(i==0){
          $.post("{!! route('tambahRadio') !!}",data,function(data){
              if(data.status=='success'){
                  $('#myModalRadio').modal('hide');
                  swal("Success !",'Data berhasil ditambahkan','success');
                  $(".tahap7").load(location.href + " .tahap7>*", "");
              }
          });
      }
  }

  function readURL1(input,id) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#hfoto12').attr('src', e.target.result);
            $('#hfo12').val(e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#foto12").change(function() {
    readURL1(this);
  });
</script>