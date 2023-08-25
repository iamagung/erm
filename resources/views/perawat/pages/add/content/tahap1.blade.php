<div class="col-lg-12 col-md-12">
    <a href="{{route('cetak1')}}" target="_blank" class="btn pull-right" title="Cetak"><i class="fa fa-print"></i></a>
    <a href="{{route('cetak1',['download'=>'pdf'])}}" class="btn pull-right" title="Export"><i class="fa fa-file"></i></a>
</div>
<div class="clearfix"></div>
<div class="col-lg-12 col-md-12 syaratClass">
    <form id="formSyarat">
	<?php
        $syarat = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
        $persetujuan=['',''];
        if($syarat->persetujuan!=''){
            $isian = explode("=", $syarat->persetujuan);
            $persetujuan = [$isian[0],$isian[1]];
            $replace = '<textarea id="textarea1" class="form-control" name="syarat[]" placeholder="text-Form">'.$persetujuan[0].'</textarea>';
            $replace1 = '<textarea id="textarea2" class="form-control" name="syarat[]" placeholder="text-Form">'.$persetujuan[1].'</textarea>';
            echo str_replace(["isian1","isian2"], [$replace,$replace1], $identitas->info); 
        }else{
            $replace = '<textarea id="textarea1" class="form-control" name="syarat[]" placeholder="text-Form">'.$persetujuan[0].'</textarea>';
            $replace1 = '<textarea id="textarea2" class="form-control" name="syarat[]" placeholder="text-Form">'.$persetujuan[1].'</textarea>';
            echo str_replace(["isian1","isian2"], [$replace,$replace1], $identitas->info); 
        }
    ?>
    </form>
</div>
<div class="clearfix" style="margin-bottom: 10px"></div>
<div class="col-lg-12 col-md-12" style="text-align: center;">
    <input type="submit" onclick="kirimSyarat()" value="Simpan" class="btn btn-success">
</div>
<div class="clearfix"></div>

<script src="{!! url('adminAsset/js/ckeditor1/ckeditor.js') !!}"></script>
<script src="{!! url('adminAsset/js/ckeditor1/adapters/jquery.js') !!}"></script>
<script type="text/javascript">
    function kirimSyarat(){
        var isian = $('#textarea1').val();
        var isian2 = $('#textarea2').val();
        var i=0;
        if(isian2==''){
            swal('Form nomor 7 harus diisi');
            i++;
        }

        if(isian == ''){
            swal('Form nomor 6 harus diisi');
            i++;
        }
        var data = $('form#formSyarat').serialize();
        if(i==0){
            $.post("{!! route('simpanTahap1') !!}",data,function(data){
                if(data.status=='success'){
                    // swal('Success !','Persyaratan dimasukan','success');
                    // $(".refreshContent").load(location.href + " .refreshContent>*", "");
                    window.location="{{route('content2')}}";
                }else{
                    swal('Whoop !','Persyaratan tidak dimasukan','error');
                }
            });
        }
    }


    CKEDITOR.env.isCompatible = true;
    $( '#editor1' ).ckeditor({width:'100%', height: '400px', toolbar: [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: ['NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-'] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        { name: 'tools', items: [ 'Maximize' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
        { name: 'styles', items: [ 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
        CKEDITOR.env.isCompatible = true,
    ]});
</script>