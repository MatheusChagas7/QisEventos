<?php
// inicia a sessao
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

//recupera as informacoes enviadas pelo cadastro
$id_fav = filter_input(INPUT_POST, "id_fav");
$id_usu = filter_input(INPUT_POST, "id_usu");

// essa query busca informações do usuario necessarias
$query_info = mysqli_query($con, "SELECT email_usu,noticias FROM usuario WHERE id_usu = '$id_fav' ");
$linha_info = mysqli_fetch_assoc($query_info);
$email_log = $linha_info['email_usu'];
$noticias_log = $linha_info['noticias'];

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) {
// atualiza o rate apos a media, com seu novo numero de rate
$query = mysqli_query($con, "INSERT INTO favoritos (id_favoritos,id_fk_usu,id_fk_cliente) VALUES ('','$id_fav','$id_usu')");
// verifica se usuario logado permitiu o envio de notificacao
switch ($noticias_log) {
	case 3:
		//email da qis
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
		$headers .= "From: {$from}\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		('Content-type: text/html; charset=iso-8859-1 \r\n');

		$subject = "[QIS] NOTIFICAÇÃO";
		$mensagem1  = "
		<!DOCTYPE html>
		<html>
		<head>
			<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
			<style type='text/css'>
				.topo{
					-webkit-mask-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)));
					margin-bottom: -20px;
				}
				.topo img{
					background-repeat: no-repeat;
					width: 100%;
					background-size: 40%;
					height: auto;
				}
				h1,h2,h3,h4,h5,p{
					font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif;
					color: #4b4b4d;
				}
				footer{
					font-size: 10px;
					position: fixed;
					bottom: 0;
				}
				a{
					color: #FF8C00;
					text-decoration: none;
				}
				.cont{
					width: 100%;
					height: auto;
				}
			</style>
		</head>
		<body>
		<div class='topo'>
			<img src='https://www.qiseventos.com.br/assets/img/capa_email.png'>
		</div>
		<div class='cont'>
			<h3>QISeventos informa, você tem uma nova notificação.</h3>
			<p>NOTIFICAÇÃO: Você tem um novo seguidor! <a href='https://www.qiseventos.com.br' target='_blank'>entre</a> agora e veja.</p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($email_log, $subject, $mensagem1, $headers);

		$queryf_noti = mysqli_query($con, "INSERT INTO notificacao (id_noti,msg_noti,id_cli_noti,id_usu_noti) VALUES ('','
			Está seguindo você','$id_usu','$id_fav')");
		
		// teste notificacao
		include_once 'sendSinglePush.php';

		break;
	case 2:
	
		//email da qis
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
		$headers .= "From: {$from}\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		('Content-type: text/html; charset=iso-8859-1 \r\n');

		$subject = "[QIS] NOTIFICAÇÃO";
		$mensagem1  = "
		<!DOCTYPE html>
		<html>
		<head>
			<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
			<style type='text/css'>
				.topo{
					-webkit-mask-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)));
					margin-bottom: -20px;
				}
				.topo img{
					background-repeat: no-repeat;
					width: 100%;
					background-size: 40%;
					height: auto;
				}
				h1,h2,h3,h4,h5,p{
					font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif;
					color: #4b4b4d;
				}
				footer{
					font-size: 10px;
					position: fixed;
					bottom: 0;
				}
				a{
					color: #FF8C00;
					text-decoration: none;
				}
				.cont{
					width: 100%;
					height: auto;
				}
			</style>
		</head>
		<body>
		<div class='topo'>
			<img src='https://www.qiseventos.com.br/assets/img/capa_email.png'>
		</div>
		<div class='cont'>
			<h3>QISeventos informa, você tem uma nova notificação.</h3>
			<p>NOTIFICAÇÃO: Você tem um novo seguidor! <a href='https://www.qiseventos.com.br' target='_blank'>entre</a> agora e veja.</p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($email_log, $subject, $mensagem1, $headers);

		break;
	case 4:
		$queryf_noti = mysqli_query($con, "INSERT INTO notificacao (id_noti,msg_noti,id_cli_noti,id_usu_noti) VALUES ('','
			Está seguindo você','$id_usu','$id_fav')");
		// teste notificacao
		include_once 'sendSinglePush.php';
		break;
	default:
		// caso seja 1, entao nao enviara para ninguem
		break;
}
}else{
	// erro no banco
$erro = mysqli_error($con);
//email da qis
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

$subject = "[QIS] FAVORITAR";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE FAVORITAR CLIENTE<br />
ERRO: {$erro}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);
}