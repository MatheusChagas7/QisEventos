<?php 
//fara a conexao com banco de dados
include_once 'conexao.php';
//chama a cache, para verificar o cache se esta logado
include_once 'cache_visitante.php';
$anunciar = $_GET['anunciar'];

if($con){

$query = mysqli_query($con, "SELECT nivel FROM usuario WHERE id_usu ='$id_log' ");
$linha = mysqli_fetch_assoc($query);

	if ($anunciar == "perfil") {

	if ($linha['nivel'] == 4) {

		$att_lvl =  mysqli_query($con,"UPDATE usuario SET nivel = '5' WHERE id_usu = '$id_log' ");

	}else{
		$att_lvl =  mysqli_query($con,"UPDATE usuario SET nivel = '3' WHERE id_usu = '$id_log' ");
	}
	if ($att_lvl) {
		header('Location: ../../perfil.php?anunciar=perfil#perfila'); 
	}
	}else if($anunciar == "down"){

	if ($linha['nivel'] == 5) {

		$att_lvl =  mysqli_query($con,"UPDATE usuario SET nivel = '4' WHERE id_usu = '$id_log' ");
	}else{
		$att_lvl =  mysqli_query($con,"UPDATE usuario SET nivel = '2' WHERE id_usu = '$id_log' ");
	}

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

$subject = "[QIS] ANUNCIAR";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE UP_LVL<br />
ERRO: {$erro}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);

    header('Location: ../../perfil.php?error=sim&motivo=database');

}
?>