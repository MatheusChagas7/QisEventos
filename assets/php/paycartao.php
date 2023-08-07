<?php
	//Inclue o arquivo da conexao do banco
	require_once "conexao_bdserver.php";

	if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
		$email = 'matheus.me.ngo@hotmail.com';
		$token = '3DA6A122DBF241F986C2561E6A55A237';

	$url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;
	//Caso use sandbox descontente a linha abaixo.
	//$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;
    
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$transaction= curl_exec($curl);
	curl_close($curl);  
	
	$transaction = simplexml_load_string($transaction);
	$status = $transaction -> status;
	$id_prop = $transaction -> reference;
	$data = $transaction -> lastEventDate;
	$datainicio = substr($data ,0,strrpos($data ,'T'));
	
	if($status == '3'){
		$id = $transaction -> items -> item -> id;
		$pacote = $transaction -> items -> item -> description;
		$email = $transaction -> sender -> email;
		$diasinicio = '31';
		$name = $transaction -> items -> item -> description;
		$soNumeros = preg_replace("/\D/","", $name);
		$resultadodias = $soNumeros * $diasinicio;
	
		$querybuscapacote = mysqli_query($con, "SELECT pacote_usu, cont_dias_pacote FROM usuario WHERE email_usu='$email'");
		//Executa o SQL
		mysqli_query($querybuscapacote);

		$resultado = mysqli_fetch_assoc($querybuscapacote );

		$pacoteativo = $resultado ['pacote_usu'];
		$dias = $resultado ['cont_dias_pacote'];

		if($pacoteativo == $id){
			$query = mysqli_query($con, "UPDATE usuario SET pacote_usu='$id', data_inicio_pagamento='$datainicio', cont_dias_pacote = cont_dias_pacote + $resultadodias WHERE email_usu='$email'");
			//Executa o SQL
			mysqli_query($query);

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

			$subject = "[QIS] PACOTE ATIVADO";
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
				<h3>QISeventos informa, seu pacote {$pacote} foi ativado com sucesso.</h3>
				<p>Aproveite todas as vantagens: <a href='https://www.qiseventos.com.br' target='_blank'>entre</a> agora e veja.</p>
			</div>
			<footer>
				<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
			</footer>
			";

			$subject = utf8_decode($subject);
			$mensagem1 = utf8_decode($mensagem1);
			
			$send_contact=mail($email, $subject, $mensagem1, $headers);

		}else if($pacoteativo > $id){

			$dividequery = $dias * 2;

			$query = mysqli_query($con, "UPDATE usuario SET pacote_usu='$id', data_inicio_pagamento='$datainicio', cont_dias_pacote = $dividequery + $resultadodias WHERE email_usu='$email'");
			//Executa o SQL
			mysqli_query($query);

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

			$subject = "[QIS] PACOTE ATIVADO";
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
				<h3>QISeventos informa, seu pacote {$pacote} foi ativado com sucesso.</h3>
				<p>Aproveite todas as vantagens: <a href='https://www.qiseventos.com.br' target='_blank'>entre</a> agora e veja.</p>
			</div>
			<footer>
				<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
			</footer>
			";

			$subject = utf8_decode($subject);
			$mensagem1 = utf8_decode($mensagem1);

			$send_contact=mail($email, $subject, $mensagem1, $headers);

		}else if($pacoteativo < $id){

			$dividequery = $dias / 2;
			$semvirgula = round($dividequery);

			$query = mysqli_query($con, "UPDATE usuario SET pacote_usu='$id', data_inicio_pagamento='$datainicio', cont_dias_pacote = $semvirgula + $resultadodias WHERE email_usu='$email'");
			//Executa o SQL
			mysqli_query($query);

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

			$subject = "[QIS] PACOTE ATIVADO";
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
				<h3>QISeventos informa, seu pacote {$pacote} foi ativado com sucesso.</h3>
				<p>Aproveite todas as vantagens: <a href='https://www.qiseventos.com.br' target='_blank'>entre</a> agora e veja.</p>
			</div>
			<footer>
				<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
			</footer>
			";

			$subject = utf8_decode($subject);
			$mensagem1 = utf8_decode($mensagem1);

			$send_contact=mail($email, $subject, $mensagem1, $headers);

		}

		if($id_prop != ""){
			$query = mysqli_query($con, "UPDATE propaganda SET ativo='1' WHERE id_propaganda='$id_prop'");
		}
	}
}