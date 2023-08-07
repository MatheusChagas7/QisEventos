<?php 
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';

//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache.php';
?>
<div class="modal fade" id="modaldenuncia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
				<h4 class="modal-title">DENUNCIAR</h4>
			</div>
			<div class="modal-body">
			<form method="post" action="#" enctype="multipart/form-data" id="form_denuncia">
			<p>motivo da denúncia ?</p>
			<select name="motivo_denuncia" id="mot_den" class="form-control" required>
				<option value="">Selecione</option>
				<option value="Preconceito">Preconceito(racial/religioso/xenofobia/homossexual)</option>
				<option value="Xingamento">Palavras de baixo calão/ Desrespeito</option>
				<option value="Fotos abusivas">Fotos com conteudo abusivo ou crime</option>
				<option value="Contato inexistente">Contato inexistente</option>
				<option value="Fraude">Fraude</option>
				<option value="outro">Outro</option>
			</select>
			<p>Comentário</p>
			<textarea name="coment_den" id="coment_den" placeholder="Explique seu motivo da denuncia" row="10" class="form-control" style="height: 100px;"></textarea>
			<b><h5 id="result_den" style="display: none;"></h5></b>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancelar</button>
				<button type="button" id="btn_send_den" class="btn btn-default btn-simple" onclick="send_den('<?php echo $email_log ?>','<?php echo $id_fav ?>');">DENUNCIAR</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
function send_den(email_den,id_anunciado) {
	// form
	var motivo = document.getElementById('mot_den').value;
	if (motivo == "") {
		document.getElementById('mot_den').focus();
		return;
	}
	var comentario = document.getElementById('coment_den').value;
	// result
	var result = document.getElementById('result_den');
	// envia o form da denuncia
	$.ajax({
	type: "POST",
	url: "assets/php/denuncia.php",
	data: {
		email: email_den,
		motivo: motivo,
		comen: comentario,
		id: id_anunciado
	},
	success: function(resultado) {
	    if (resultado == "done"){
	    	result.style.display = "block";
	    	result.innerHTML = "DENÚNCIA ENVIADA: após analisarmos, enviaremos um email";
	    	$("#btn_send_den").attr("disabled","disabled");
	    }else {
	        result.style.display = "block";
	        result.innerHTML = "ERRO: por favor tent enviar novamente, se persistir espere alguns minutos, ou entre em contato com o suporte.";
	    }
    }
	});
}
</script>