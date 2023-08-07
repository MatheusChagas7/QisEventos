<?php
$lifetime = 3600 * 240000; // Defini para 10000 Dias
header("Cache-Control: max-age=$lifetime");
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', $lifetime);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params($lifetime);
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){

	header('location:login.php');
	session_destroy();
	setcookie('email',"", time()-3600);
	setcookie('senha',"", time()-3600);
	unset($_COOKIE['email']);
	unset($_COOKIE['senha']);

}else{

	$query_cachevisitante = mysqli_query($con, "SELECT situacao_login FROM usuario WHERE email_usu ='".$_SESSION['email']."' AND senha_usu ='".$_SESSION['senha']."'");
	$linha_cachevisitante = mysqli_fetch_assoc($query_cachevisitante);

	if($linha_cachevisitante['situacao_login'] === ""){
		header('location:login.php');
		session_destroy();
		setcookie('email',"", time()-3600);
		setcookie('senha',"", time()-3600);
		unset($_COOKIE['email']);
		unset($_COOKIE['senha']);

	}else if ($linha_cachevisitante['situacao_login'] == "log"){

		// essa query busca informações do usuario necessárias para rodar pela pag.
		$query_info_cachevisitante = mysqli_query($con, "SELECT id_usu,nome_completo,email_usu,nivel,foto_perfil,foto_capa,pacote_usu,noticias FROM usuario WHERE email_usu='".$_SESSION['email']."'");
		$linha_info_cachevisitante = mysqli_fetch_assoc($query_info_cachevisitante);

		$id_log = $linha_info_cachevisitante['id_usu'];
		$nome_log = $linha_info_cachevisitante['nome_completo'];
		$email_log = $linha_info_cachevisitante['email_usu'];
		$lvl = $linha_info_cachevisitante['nivel'];
		$pacoteusu_log = $linha_info_cachevisitante['pacote_usu'];
		$foto_perfil = $linha_info_cachevisitante['foto_perfil'];
		$foto_capa = $linha_info_cachevisitante['foto_capa'];
		$noticias_log = $linha_info_cachevisitante['noticias'];

		date_default_timezone_set('America/Sao_Paulo');
		$dt_last_acess = date('Y-m-d H:i');
		// caso esteja logado, entao aumenta para o numero maximo de dias = 31 SOMENTE USUARIOS NIVEL 3 QUE SÃO CLIENTES, 5 NAO PODE POIS ALEM DE CLIENTE TEM PROPAGANDAS PELO SITE
		$query_up_cachevisitante = mysqli_query($con,"UPDATE usuario SET cont_dias_desl = 60, dt_last_acess = '$dt_last_acess' WHERE id_usu = '$id_log'");
	}

}

?>