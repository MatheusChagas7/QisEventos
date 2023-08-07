<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

$id = $_POST['id_usu_re'];
$email = $_POST['email_re'];

if ($con) {

	$get_usu = mysqli_query($con, "SELECT email_usu FROM usuario WHERE id_usu = '$id' ");
	$row_usu = mysqli_fetch_assoc($get_usu);

	if ( strtolower($row_usu['email_usu']) === strtolower($email) ) {
		// se email igual, envia, se nao vola
		if (PHP_VERSION_ID < 50600) {
			iconv_set_encoding('input_encoding', 'UTF-8');
			iconv_set_encoding('output_encoding', 'UTF-8');
			iconv_set_encoding('internal_encoding', 'UTF-8');
		} else {
			ini_set('default_charset', 'UTF-8');
		}

		$headers = "MIME-Version: 1.1\r\n";
		$headers .= "From: QISeventos - <suporte@qiseventos.com.br>\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		('Content-type: text/html; charset=iso-8859-1 \r\n');

		$md5 = md5(strtolower($email));
		$subject = "Reenvio para confirmação de cadastro - QISeventos";
		$link = 'https://www.qiseventos.com.br/confirma.php?h='.$md5;
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
			<h3>Parabéns {$nome}</h3>
			<p>Você acaba de fazer parte da familia QISeventos, seja bem-vindo!
			Agora ficou mais fácil anunciar seu produto ou serviço para eventos, em diversas categorias!
			<a href='$link'>Clique aqui para confirmar seu cadastro.</a></p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($email, $subject, $mensagem1, $headers);

		header('Location: ../../perfil.php');

	}else{

		header('Location: ../../perfil.php?error=sim&motivo=emailerrado');

	}

}else{


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

	$subject = "[QIS] REENVIO DE EMAIL";
	$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT P/ REENVIAR EMAIL P/ CONFIRMAR CADASTRO,<br />
	ERRO: {$erro}<br /> <br />.";

	$subject = utf8_decode($subject);
	$mensagem1 = utf8_decode($mensagem1);

	$send_contact=mail($from, $subject, $mensagem1, $headers);

	header('Location: ../../perfil.php?error=sim&motivo=errodatabase');

}

?>