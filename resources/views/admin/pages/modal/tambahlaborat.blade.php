<div id="myModalLaborat" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c4ff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Hasil Laboratorium</h4>
      </div>
      <div class="modal-body">
        <form id="formtahap6">

        <div class="col-lg-12 col-md-12">Keterangan</div>
        <div class="col-lg-12 col-md-12"><textarea class="form-control" name="ket"></textarea></div>
        <div class="col-lg-12 col-md-12">Upload</div>
        <div class="col-lg-12 col-md-12"><input type="file" accept="image/*" id="foto11"></div>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12">
            <input type="hidden" name="foto_lab" id="hfo11">
            <img src="" style="width: 200px" id="hfoto11">
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
      var foto = $('input[name=foto_lab]').val();
      var data = $('form#formtahap6').serialize();

      if(foto==''){
          swal("Foto harus diisi");
          i++;
      }

      if(ket==''){
          swal("Keterangan harus diisi");
          i++;
      }

      if(i==0){
          $.post("{!! route('tambahLab') !!}",data,function(data){
              if(data.status=='success'){
                  $('#myModalLaborat').modal('hide');
                  swal("Success !",'Data berhasil ditambahkan','success');
                  $(".tahap6").load(location.href + " .tahap6>*", "");
              }
          });
      }
  }

  function readURL1(input,id) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#hfoto11').attr('src', e.target.result);
            $('#hfo11').val(e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#foto11").change(function() {
    readURL1(this);
  });
</script>