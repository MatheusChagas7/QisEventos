<?php
//fara a conexao com banco de dados
include_once 'conexao.php';

// recebe as informacoes do usuario que enviou email
$nome = $_POST['nome'];
$email = $_POST['email'];
$texto = $_POST['texto'];
$local_vem = $_POST['local'];
$hora = $_POST['hora'];
//verifica se o local é do AJUDA ou CONTATO
switch ($local_vem) {
	case 'ajuda':
		$local = "AJUDA";
		break;
	case 'contato':
		$local = "CONTATO";
		break;
	case 'propaganda':
		$local = "PROPAGANDA";
		break;
}

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
$headers .= "From: {$email}\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
('Content-type: text/html; charset=iso-8859-1 \r\n');

$subject = "[QIS] AJUDA/CONTATO - QISeventos";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : {$local}<br />
Data do momento do envio : {$hora}<br />
Nome: {$nome}<br />
Mensagem: {$texto}.";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);

switch ($local) {
	case 'AJUDA':
		header('Location: ../../ajuda.php?envio=sucesso#us');
		break;
	case 'CONTATO':
		header('Location: ../../contato-sobrenos.php?envio=sucesso#us');
		break;
	case 'PROPAGANDA':
		header('Location: ../../anunciar.php?envio=sucesso#us');
		break;
}
?>