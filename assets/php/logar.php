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

//recupera as informacoes enviadas pelo cadastro
$email = filter_input(INPUT_POST, "email");
$senha = filter_input(INPUT_POST, "senha");
$foto_perfil = filter_input(INPUT_POST, "foto_perfil");
$migracao = filter_input(INPUT_POST, "local");
$token = filter_input(INPUT_POST, "token");

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) { 
        // verifica se a migracao foi pelo face ou google, nao irao possuir o select com senha, apenas email.
        if (($migracao == "face") OR ($migracao == "gplu") ) {
            $query = mysqli_query($con, "SELECT email_usu,senha_usu FROM usuario WHERE email_usu LIKE '%$email%'");
            $linha = mysqli_fetch_assoc($query);
        }else{
            // twitter e qis vai ter senha
            $query = mysqli_query($con, "SELECT email_usu,senha_usu FROM usuario WHERE email_usu LIKE '%$email%' AND senha_usu='$senha'");
            $linha = mysqli_fetch_assoc($query);
        }

        // se o email digitado for igual ao email encontado no banco, entao ele entra
        if( strtolower($email) === strtolower($linha['email_usu']) ){
            $senhabd = $linha['senha_usu'];
            // atualiza no banco sua situacao
            $query_up = mysqli_query($con, "UPDATE usuario SET situacao_login ='log' WHERE email_usu LIKE '%$email%'");
            $query_token = mysqli_query($con, "INSERT INTO token (id_token,fk_token_usu,token) VALUES ('','$email','$token')");
            // coloca o email e senha em seu cache
            setcookie('email',$email,time()+$lifetime);
            setcookie('senha',$senhabd,time()+$lifetime);

            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senhabd;
            // redireciona
            header('Location: ../../index.php'); 
            
        }else{
            // caso o email nao seja igual, entao retorna com erro
            header('Location: ../../login.php?error=pass_mail'); 
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

$subject = "[QIS] LOGIN";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE LOGAR<br />
ERRO: {$erro}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);

header('Location: ../../login.php?error=foradoar');

}
?>