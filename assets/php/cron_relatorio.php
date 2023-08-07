<?php
//fara a conexao com banco de dados
include_once 'conexao_bdserver.php';

$query_b_usu = mysqli_query($con,"SELECT id_usu,email_usu,pacote_usu,n_acesso,rating,n_rating FROM usuario WHERE nivel = 3");

while ($linha_b_usu = mysqli_fetch_array($query_b_usu)){

$datam = date("M");

		$n_acesso = $linha_b_usu['n_acesso'];
		$n_rating = $linha_b_usu['n_rating'];
		$rating = $linha_b_usu['rating'];
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

		$subject = "[QIS] RELATORIO MENSAL - mês {$datam}";
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
			<h3>Acompanhe seu relatório</h3>
			<p>Você tem : {$n_acesso} acessos</p>
			<p>Recebeu : {$n_rating} avaliações</p>
			<p>E está com : {$rating} estrelas</p>
		<h4>Não fique em desvantagem, renove ou compre seu pacote hoje mesmo => <a href='https://qiseventos.com.br/premium.php' target='_blank'>AQUI</a></h4>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($linha_b_usu['email_usu'], $subject, $mensagem1, $headers);

}

?>