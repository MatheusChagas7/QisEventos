<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
	// header('location:login.php');
    if(empty($_SESSION['data'])){
	$lvl = "1";
    // session_destroy();
    setcookie('email',"", time()-3600);
    setcookie('senha',"", time()-3600);
    unset($_COOKIE['email']);
    unset($_COOKIE['senha']);
    }else{}
}else{

    $query_cachelogin = mysqli_query($con, "SELECT situacao_login FROM usuario WHERE email_usu ='".$_SESSION['email']."' AND senha_usu ='".$_SESSION['senha']."'");
         $linha_cachelogin = mysqli_fetch_assoc($query_cachelogin);

    if($linha_cachelogin['situacao_login'] == ""){
	if(empty($_SESSION['data'])){
    // session_destroy();
    setcookie('email',"", time()-3600);
    setcookie('senha',"", time()-3600);
    unset($_COOKIE['email']);
    unset($_COOKIE['senha']);
    }else{}
	
	}else if ($linha_cachelogin['situacao_login'] == "log"){
	
		header('location:index.php');
	
	}         

}

?>