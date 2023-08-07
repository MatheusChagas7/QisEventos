<?php
// inicia a sessao
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';
//recupera as informacoes enviadas pelo cadastro
$rate = filter_input(INPUT_POST, "rate");
$url= filter_input(INPUT_POST, "url");
// echo "rate:" . $rate . "<br/>";
// echo "id: " . $id . "<br/>";

if ($_COOKIE['url'] !== $url) {

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) {
	// pega o numero de vezes q ele recebeu rate
	$query = mysqli_query($con, "SELECT n_rating FROM usuario WHERE url_persona='$url'");
	$linha = mysqli_fetch_assoc($query);
	//acrescenta +1 ao numero de rating
	$num = $linha['n_rating'];
	$num_novo = $num + 1;
	// pega o rate dele atual
	$query = mysqli_query($con, "SELECT rating FROM usuario WHERE url_persona='$url'");
	$linha = mysqli_fetch_assoc($query);
	// faz a media do rating dele
	$rate_bd = $linha['rating'];
	$novorate_antes = ($rate_bd + $rate) / $num_novo;
	// formata
	$novorate = number_format($novorate_antes,1,'.', ' ');
	// atualiza o rate apos a media, com seu novo numero de rate
	$query = mysqli_query($con, "UPDATE usuario SET rating='$novorate', n_rating='$num_novo' WHERE url_persona='$url'");
	
	setcookie('url',$url,time()+99999999999);

	echo "foi";
	return true;

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

	$subject = "[QIS] RATE";
	$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE DAR RATING<br />
	ERRO: {$erro}";

	$subject = utf8_decode($subject);
	$mensagem1 = utf8_decode($mensagem1);

	$send_contact=mail($from, $subject, $mensagem1, $headers);

	echo "nao foi";
	return false;
}

}else{
	echo "nao foi";
	return false;
}