<?php
//fara a conexao com banco de dados
include_once 'conexao_bdserver.php';

// pegar o dia atual para pesquisar nas querys
$hoje = date("Y") . "-" . date("m") . "-" . date("d");

// buscar as propagandas
$query_get = mysqli_query($con,"SELECT id_propaganda,fk_propaganda_usu,dt_propaganda,dt_fim FROM propaganda WHERE ativo=1 ");
$teste = mysqli_fetch_assoc($query_get);
// buscar as propagandas DESATIVADAS
$query_get_des = mysqli_query($con,"SELECT * FROM propaganda WHERE ativo=2 ");
// buscar as propagandas NÃO CONCLUIDAS/PAGAS
$query_get_ina = mysqli_query($con,"SELECT * FROM propaganda WHERE ativo=0 ");

$rtidprop = $teste['id_propaganda'];

// enquanto existir registro faca
while ( $linha = mysqli_fetch_array($query_get) ) {
	// se a data final da propaganda for menor que o dia de hoje (ou seja, passou a data) desativa e manda email
	if ( $linha['dt_fim'] < $hoje ) {
		// desativa
		$query_up_prop = mysqli_query($con,"UPDATE propaganda SET ativo = 2 WHERE id_propaganda = ". $linha['id_propaganda']." ");
		// busca o email do dono da propaganda
		$query_get_usu = mysqli_query($con,"SELECT email_usu FROM usuario WHERE id_usu = ".$linha['fk_propaganda_usu']." ");
		$row_qgu = mysqli_fetch_assoc($query_get_usu);
		$email_usu = $row_qgu['email_usu'];
			
	
		// envia um email para o usuario avisando
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

		$md5 = md5(strtolower($rtidprop));
		$subject = "[QIS] AVISO! - SUA PROPAGANDA EXPIROU";
		$link = 'https://www.qiseventos.com.br/reativar_propaganda.php?id_prop='.$md5;
		
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
			<h3>Aviso da QISeventos: A sua propaganda expirou!</h3>
			<p>A data do termino de sua propaganda passou ({$linha['dt_fim']}), ela será desativada.
			após 5 dias ela será excluida de nosso sistema.</p>
			<p><b>Reative sua propaganda!</b>
			Clique <a href='$link' target='_blank'>aqui e reative a sua propaganda</a></p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($email_usu, $subject, $mensagem1, $headers);

	} // fim if

} // fim while

// 2° while para buscar os registros que estão desativados para enviar o email de aviso
while ( $linha_des = mysqli_fetch_array($query_get_des) ) {

	$time_inicial = strtotime($linha_des['dt_fim']);
	$time_final = strtotime($hoje);
	// Calcula a diferença de segundos entre as duas datas:
	$diferenca = $time_final - $time_inicial; // 19522800 segundos
	// Calcula a diferença de dias
	$dias = (int)floor( $diferenca / (60 * 60 * 24)); //

	// se a data de termino for menor que 5 dias, envia um email, se nao (se for maior que 5 dias, significa que ja se passou 5 dias que ela foi desativada) excluir a propaganda (do banco e da imagem tbm)
	if ( $dias <= 5 ) {

		// busca o email do dono da propaganda
		$query_get_usu = mysqli_query($con,"SELECT email_usu FROM usuario WHERE id_usu = ".$linha_des['fk_propaganda_usu']." ");
		$row_qgu = mysqli_fetch_assoc($query_get_usu);
		$email_usu = $row_qgu['email_usu'];
		// envia um email para o usuario avisando
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

		$md5 = md5(strtolower($rtidprop));
		$subject = "[QIS] AVISO! - SUA PROPAGANDA EXPIROU";
		$link = 'https://www.qiseventos.com.br/reativar_propaganda.php?id_prop='.$md5;
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
			<h3>Aviso da QISeventos: A sua propaganda expirou!</h3>
			<p>A data do termino de sua propaganda passou ({$linha['dt_fim']}), ela será desativada.
			após 5 dias ela será excluida de nosso sistema.</p>
			<p><b>Reative sua propaganda!</b>
			Clique <a href='$link' target='_blank'>aqui e reative a sua propaganda</a></p>
		</div>
		<footer>
			<p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
		</footer>
		";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($email_usu, $subject, $mensagem1, $headers);

	}else{

		// apaga o contador desta propaganda no banco
		$query_del_cont = mysqli_query($con," DELETE FROM contador WHERE fk_cont_prop = ".$linha_des['id_propaganda']." ");

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
		$query_del_prop = mysqli_query($con," DELETE FROM propaganda WHERE id_propaganda = ".$linha_des['id_propaganda']." ");

	}

}

// 3° while para buscar as propagandas que não foram pagas e apagar
while ( $linha_ina = mysqli_fetch_array($query_get_ina) ) {

	$time_inicial = strtotime($linha_ina['dt_fim']);
	$time_final = strtotime($hoje);
	// Calcula a diferença de segundos entre as duas datas:
	$diferenca = $time_final - $time_inicial; // 19522800 segundos
	// Calcula a diferença de dias
	$dias = (int)floor( $diferenca / (60 * 60 * 24)); //

	// (se for maior que 10 dias, significa que ja se passou 10 dias que ela está inativa) excluir a propaganda (do banco e da imagem tbm)
	if ( $dias <= 10 ) {}else{
		
		// apaga o contador desta propaganda no banco
		$query_del_cont_ina = mysqli_query($con," DELETE FROM contador WHERE fk_cont_prop = ".$linha_ina['id_propaganda']." ");

		// apaga a imagem da propaganda no sistema, cada if para ver se a imagem existe em cada espaço
		// 1
		if (!empty($linha_ina['imagem_propaganda1']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_ina['imagem_propaganda1'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_ina['imagem_propaganda1']);
		}
		// 2
		if (!empty($linha_ina['imagem_propaganda2']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_ina['imagem_propaganda2'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_ina['imagem_propaganda2']);
		}
		// 3
		if (!empty($linha_ina['imagem_propaganda3']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_ina['imagem_propaganda3'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_ina['imagem_propaganda3']);
		}
		// 4
		if (!empty($linha_ina['imagem_propaganda4']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_ina['imagem_propaganda4'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_ina['imagem_propaganda4']);
		}
		// 5
		if (!empty($linha_ina['imagem_propaganda5']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_ina['imagem_propaganda5'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_ina['imagem_propaganda5']);
		}
		// 5m
		if (!empty($linha_ina['imagem_propaganda5m']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_ina['imagem_propaganda5m'])) {
			unlink('/home/ilion548/public_html/qiseventos'.$linha_ina['imagem_propaganda5m']);
		}

		// apaga a propaganda do banco
		$query_del_prop = mysqli_query($con," DELETE FROM propaganda WHERE id_propaganda = ".$linha_ina['id_propaganda']." ");

	}
}
?>