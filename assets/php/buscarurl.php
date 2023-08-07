<?php
session_start();

//fara a conexao com banco de dados
include_once 'conexao.php';
 
// Recebe o valor enviado
$url = $_POST['url'];

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) {

$query  = mysqli_query($con, "SELECT url_persona FROM usuario WHERE url_persona='$url'");
$linha = mysqli_fetch_assoc($query);

if($query){
	$url_bd = $linha['url_persona'];

	if(strtolower($url) === strtolower($url_bd)){
		echo strtolower($url_bd);
	}else{
		echo 'URL disponivel';  
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

	$subject = "[QIS] BUSCAR URL";
	$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE BUSCAR URL<br />
	ERRO: {$erro}";

	$subject = utf8_decode($subject);
	$mensagem1 = utf8_decode($mensagem1);

	$send_contact=mail($from, $subject, $mensagem1, $headers);

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

	$subject = "[QIS] BUSCAR URL";
	$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE BUSCAR URL<br />
	ERRO: {$erro}<br />.";

	$subject = utf8_decode($subject);
	$mensagem1 = utf8_decode($mensagem1);

	$send_contact=mail($from, $subject, $mensagem1, $headers);

}
?>