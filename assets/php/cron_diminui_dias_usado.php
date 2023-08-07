<?php

//fara a conexao com banco de dados
include_once 'conexao_bdserver.php';

/*formatacao da data*/
function inverteData($data){
    if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
}

// busco todos os usuarios que sejam anunciantes
$query_b_usu = mysqli_query($con,"SELECT id_usu,email_usu,senha_usu,dt_last_acess,cont_dias_desl FROM usuario WHERE nivel = 3 OR nivel = 5");

while ($linha_b_usu = mysqli_fetch_array($query_b_usu)) {

	$emailusu = $linha_b_usu['email_usu'];
	$dt_l_a = inverteData($linha_b_usu['dt_last_acess']);
	// diminui 1 dia
	$query_up = mysqli_query($con,"UPDATE usuario SET cont_dias_desl = cont_dias_desl - 1 WHERE email_usu = '$emailusu' ");

	// verifica o numero de dias que o usuario nao entrou, se for igual a 15, envia um email de aviso
	if($linha_b_usu['cont_dias_desl'] == 15){
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

		$subject = "[QIS] AVISO! - CONTA DESATUALIZADA";
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
			<h3>Aviso da QISeventos: Último dia de acesso a sua conta: {$dt_l_a} </h3>
			<p>Você não acessa a sua conta a algumas semanas, falta(m) {$linha_b_usu['cont_dias_desl']} dia(s) para a sua conta ser retirada do nosso banco de dados.
		Não fique muito tempo sem usa-lá e mantenha sua conta sempre atualizada! para que os seus futuros clientes possam lhe contactar com mais facilidade, entre hoje mesmo => <a href='https://qiseventos.com.br' target='_blank'>AQUI</a></p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($linha_b_usu['email_usu'], $subject, $mensagem1, $headers);

	}else if($linha_b_usu['cont_dias_desl'] <= 5){
		// se for menor ou igual a 5, enviar email todo o dia
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

		$subject = "[QIS] AVISO! - CONTA DESATUALIZADA";
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
			<h3>Aviso da QISeventos: Último dia de acesso a sua conta: {$dt_l_a} </h3>
			<p>Você não acessa a sua conta a algumas semanas, falta(m) {$linha_b_usu['cont_dias_desl']} dia(s) para a sua conta ser retirada do nosso banco de dados.
		Não fique muito tempo sem usa-lá e mantenha sua conta sempre atualizada! para que os seus futuros clientes possam lhe contactar com mais facilidade, entre hoje mesmo => <a href='https://qiseventos.com.br' target='_blank'>AQUI</a></p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($linha_b_usu['email_usu'], $subject, $mensagem1, $headers);

	}
	// se o cont_dias_desl for igual a 0, exclui a conta do usuario
	if ($linha_b_usu['cont_dias_desl'] <= 0) {
		// OBS: TODO ESTE SCRIPT DE EXCLUIR, E O MESMO DO EXCLUIR_CONTA.PHP
		// recebe as informacoes do usuario
		$id = $linha_b_usu['id_usu'];
		$exemail = $linha_b_usu['email_usu'];
		$exsenha = $linha_b_usu['senha_usu'];

		// verificar a conexao, se tudo estiver certo, vai executar a linha e excluir o usuario, se nao vai informar qual o erro
		if ($con) {

		$buscarsenha = mysqli_query($con, "SELECT senha_usu FROM usuario WHERE email_usu = '$exemail'");
		$senhabd = mysqli_fetch_assoc($buscarsenha );

		if (!empty($exemail) && !empty($id) && $exsenha == $senhabd['senha_usu']) {
		       
		    $query_token = mysqli_query($con, "DELETE FROM token WHERE fk_token_usu = '$exemail'");
		    
		    $del_fc = mysqli_query($con, "SELECT foto_capa FROM usuario WHERE email_usu='$exemail'");
		    $excluir_capa = mysqli_fetch_assoc($del_fc);
		    $capa_ex = $excluir_capa['foto_capa'];

			if (!empty($capa_ex)) {
				unlink('/home/ilion548/public_html/qiseventos'.$capa_ex);
			}

		    $del_fp = mysqli_query($con, "SELECT foto_perfil FROM usuario WHERE email_usu='$exemail'");
		    $excluir_perfil = mysqli_fetch_assoc($del_fp);
		    $perfil_ex = $excluir_perfil['foto_perfil'];

			if (!empty($perfil_ex) && file_exists("/home/ilion548/public_html/qiseventos" . $perfil_ex)) {
				unlink('/home/ilion548/public_html/qiseventos'.$perfil_ex);
			}

		    $query = mysqli_query($con, "DELETE FROM usuario WHERE senha_usu = '$exsenha' AND id_usu ='$id'");


			// envia um e-mail de cadastro
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
		 
			$subject = "Exclusão de conta - QISeventos";
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
			<h3>{$exemail}</h3>
			<p>Você não receberá mais emails nossos, sua conta,propaganda e qualquer outro dado foi excluido
			Obrigado por participar e volte sempre!</p>
			<p>Att: QISeventos</p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
			";
			
			$subject = utf8_decode($subject);
			$mensagem1 = utf8_decode($mensagem1);

			$send_contact=mail($exemail, $subject, $mensagem1, $headers);
		}
		
		} // con
	}

} //while

?>