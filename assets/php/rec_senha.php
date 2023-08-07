<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

//recupera as informacoes enviadas pelo cadastro
$email = filter_input(INPUT_POST, "email");

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) { 

    $query_busca = mysqli_query($con, "SELECT email_usu,senha_usu FROM usuario WHERE email_usu='".$email."'");
    $linha = mysqli_fetch_assoc($query_busca);
    $senha = $linha['senha_usu'];
    if($email == $linha['email_usu']){
        // email encontrado, enviar msg
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
        $headers .= "From: QIS - <suporte@QISeventos.com.br>\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
        ('Content-type: text/html; charset=iso-8859-1 \r\n');

        $subject = "[QIS] RECUPERAÇÃO DE SENHA";
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
            <h3>Olá {$email}</h3>
            <p>Este email fez um pedido de recuperação de senha.<br/>
            A senha é : {$senha}</p>
        </div>
        <footer>
            <p>Caso não seja o {$email}, por favor ignore e exclua este email.</p>
            <p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
        </footer>
        ";

        $subject = utf8_decode($subject);
        $mensagem1 = utf8_decode($mensagem1);

        $send_contact=mail($linha['email_usu'], $subject, $mensagem1, $headers);

        header('Location: ../../login.php?recuperacao=done');
    }else{

        // retorna informando q email nao condiz
        header('Location: ../../recuperar.php?error=email');
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

$subject = "[QIS] RECUPERAR";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE RECUPERAR SENHA<br />
ERRO: {$erro}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);

header('Location: ../../login.php?error=foradoar');
}
?>