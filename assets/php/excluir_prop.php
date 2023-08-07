<?php
include_once 'conexao.php';

$id = $_POST['id_propex'];
$senha = $_POST['senha_exprop'];

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) {

	// buscar o id do usuario pela propaganda
	$buscarid = mysqli_query($con, "SELECT fk_propaganda_usu FROM propaganda WHERE id_propaganda = '$id'");
	$idbd = mysqli_fetch_assoc($buscarid);

	// buscar a senha com o id do usuario
	$buscarsenha = mysqli_query($con, "SELECT senha_usu FROM usuario WHERE id_usu = '". $idbd['fk_propaganda_usu']."' ");
	$senhabd = mysqli_fetch_assoc($buscarsenha);

	// se as senhas baterem prossiga
	if ( $senha == $senhabd['senha_usu'] ) {
	
		// buscar tudo da propaganda
		$buscarprop = mysqli_query($con, " SELECT * FROM propaganda WHERE id_propaganda = '".$id."' ");
		$linha_des = mysqli_fetch_assoc($buscarprop);

		// apaga o contador desta propaganda no banco
		$query_del_cont = mysqli_query($con," DELETE FROM contador WHERE fk_cont_prop = ".$id." ");

		// apaga a imagem da propaganda no sistema, cada if para ver se a imagem existe em cada espaço
		// 1
		if (!empty($linha_des['imagem_propaganda1']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda1'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda1']);
		}
		// 2
		if (!empty($linha_des['imagem_propaganda2']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda2'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda2']);
		}
		// 3
		if (!empty($linha_des['imagem_propaganda3']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda3'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda3']);
		}
		// 4
		if (!empty($linha_des['imagem_propaganda4']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda4'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda4']);
		}
		// 5
		if (!empty($linha_des['imagem_propaganda5']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda5'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda5']);
		}
		// 5m
		if (!empty($linha_des['imagem_propaganda5m']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda5m'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda5m']);
		}

		// apaga a propaganda do banco
		$query_del_prop = mysqli_query($con," DELETE FROM propaganda WHERE id_propaganda = ".$id." ");

		header('Location: ../../estatistica.php?res=feito');

	}else{

		header('Location: ../../estatistica.php?error=sim&motivo=exsenhaerrada');

	}

}else{

	// erro no banco
	$erro = mysqli_error($con);
	//email da baco
	$from = "suporte@qiseventos.com.br";
	// envia um e-mail informando o erro
	if (PHP_VERSION_ID < 50600) {
		iconv_set_encoding('input_encoding', 'UTF-8');
		iconv_set_encoding('output_encoding', 'UTF-8');
		iconv_set_encoding('internal_encoding', 'UTF-8');
	} else {
		ini_set('default_charset', 'UTF-8');
	}

	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "From: QIS@scripts_interno\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
	('Content-type: text/html; charset=iso-8859-1 \r\n');

	$subject = "[QIS] EXCLUIR PROPAGANDA";
	$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE EXCLUIR PROPAGANDA<br/>
	ERRO: {$erro}";

	$subject = utf8_decode($subject);
	$mensagem1 = utf8_decode($mensagem1);

	$send_contact=mail($from, $subject, $mensagem1, $headers);

	header('Location: ../../estatistica.php?error=sim&motivo=database');

}
?>