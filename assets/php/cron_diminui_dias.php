<?php
//fara a conexao com banco de dados
include_once 'conexao_bdserver.php';
// busco todos os usuarios que possuam pacotes
$query_b_usu = mysqli_query($con,"SELECT id_usu,email_usu,cont_dias_pacote,pacote_usu FROM usuario WHERE pacote_usu >= 1");

while ($linha_b_usu = mysqli_fetch_array($query_b_usu)) {
	$emailusu = $linha_b_usu['email_usu'];
	// se o contador de dias do pacote for maior que 0, entre no loop, diminui 1 dia
	if($linha_b_usu['cont_dias_pacote'] > 0){
		// diminui 1 dia
		$query_up = mysqli_query($con,"UPDATE usuario SET cont_dias_pacote = cont_dias_pacote - 1 WHERE email_usu = '$emailusu' ");
	}else{
		// retira o seu pacote
		$query_up = mysqli_query($con,"UPDATE usuario SET pacote_usu = '0' WHERE email_usu = '$emailusu' ");

		//email da qis
		$from = "suporte@qiseventos.com.br";
		// envia um e-mail de ajuda ou contato para nos
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

		$subject = "[QIS] AVISO! - SEU PACOTE {$pacote} FOI EXPIRADO";
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
			<h3>Aviso da QISeventos: Seu pacote expirou!</h3>
			<p>Não fique em desvantagem, compre seu pacote hoje mesmo => <a href='https://qiseventos.com.br/premium.php' target='_blank'>AQUI</a></p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($emailusu, $subject, $mensagem1, $headers);

		$queryf_noti = mysqli_query($con, "INSERT INTO notificacao (id_noti,msg_noti,id_cli_noti,id_usu_noti) VALUES ('','Seu pacote expirou! <a href=premium.php>COMPRAR</a>','0','".$linha_b_usu['id_usu']."')");
	}

}
?>