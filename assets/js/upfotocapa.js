$(document).ready(function(){var $uploadCropcapa,tempFilename,rawImg,imageId;function readFile(input){if(input.files&&input.files[0]){var reader=new FileReader();reader.onload=function(e){$('#upload-demo-capa').addClass('ready');$('#modal-capa').modal('show');rawImg=e.target.result}
reader.readAsDataURL(input.files[0])}
else{swal("Desculpe esse navegador nao suporta esta tecnologia")}}
$uploadCropcapa=$('#upload-demo-capa').croppie({viewport:{width:305,height:125,enforceBoundary:!1,enableExif:!0},});$('#modal-capa').on('shown.bs.modal',function(){$uploadCropcapa.croppie('bind',{url:rawImg}).then(function(){console.log('jQuery bind complete')})});$('#upcapa').on('change',function(){imageId=$(this).data('id');tempFilename=$(this).val();$('#cancelCropBtn-capa').data('id',imageId);readFile(this)});$('#cortarImageBtn-capa').on('click',function(ev){$uploadCropcapa.croppie('result',{type:'base64',format:'jpg',size:{width:1050,height:450}}).then(function(resp){$('#id_capa').attr('src',resp);$('#tupcapa').val(resp);$('#modal-capa').modal('hide')})})})