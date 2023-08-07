<?php
session_start(); // previamente chamada 

// //fara a conexao com banco de dados
include_once 'conexao.php';

// se esta variavel for preenchida entao o script foi executado atraves da propaganda, que ao clicar: desloga da conta e vai para o cadastro_anunciante
$propaganda = $_GET['propaganda'];

if(isset($_SESSION['email'])){

    $query = mysqli_query($con, "UPDATE usuario SET situacao_login='' WHERE email_usu ='".$_SESSION['email']."'");		
	$query = mysqli_query($con, "DELETE FROM token WHERE fk_token_usu ='".$_SESSION['email']."'");	
    // se você possui algum cookie relacionado com o login deve ser removido
    session_destroy();
    setcookie('email',"", time()-3600);
    setcookie('senha',"", time()-3600);
    unset($_COOKIE['email']);
    unset($_COOKIE['senha']);
    if ($propaganda == "propaganda") {
        header('Location: ../../cadastro_anunciante.php');
    }else{
        header('Location: ../../login.php?sair=logout');
    }
    exit();
}else{
    session_destroy();
    setcookie('email',"", time()-3600);
    setcookie('senha',"", time()-3600);
    unset($_COOKIE['email']);
    unset($_COOKIE['senha']);
    if ($propaganda == "propaganda") {
        header('Location: ../../cadastro_anunciante.php');
    }else{
        header('Location: ../../login.php?sair=logout');
    }
    exit();
}

?>