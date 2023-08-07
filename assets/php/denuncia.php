<?php
//fara a conexao com banco de dados
include_once 'conexao.php';

// recebe os valores da denuncia
$email = $_POST['email'];
$motivo = $_POST['motivo'];
$comentario = $_POST['comen'];
$id_anunciado = $_POST['id'];

// busca algumas informações do usuario que foi denunciado
$query_get = mysqli_query($con, "SELECT nome_completo, email_usu, url_persona FROM usuario WHERE id_usu = '$id_anunciado' ");
$linha = mysqli_fetch_assoc($query_get);

$nome = $linha['nome_completo'];
$url = $linha['url_persona'];
$email_denunciado = $linha['email_usu'];

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

$subject = "[QIS] DENUNCIA - QISeventos";
$mensagem1  = "VOCÊ RECEBEU UMA DENUNCIA.<br />
Motivo : {$motivo}<br />
Email do denunciante: {$email}<br />
Explicação da denuncia: {$comentario}. <br />
Denunciado : {$nome},<br />
Link Denunciado : <a href='https://www.qiseventos.com.br/{$url}' target='_blank'>Clique para visualizar o anuncio</a><br />
Email do denunciado : {$email_denunciado}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);

if ($send_contact) {
	exit("done");
}else{
	return false;
}