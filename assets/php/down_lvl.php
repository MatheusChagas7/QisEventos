<?php 
//fara a conexao com banco de dados
include_once 'conexao.php';
//chama a cache, para verificar o cache se esta logado
include_once 'cache_visitante.php';
// recebe as informacoes do usuario
$id = filter_input(INPUT_POST, "down_id");
$down_email = filter_input(INPUT_POST, "down_email");
$down_senha = filter_input(INPUT_POST, "down_senha");

if($con){

$buscarsenha = mysqli_query($con, "SELECT senha_usu,nivel FROM usuario WHERE email_usu = '$down_email' AND id_usu ='$id' ");
$senhabd = mysqli_fetch_assoc($buscarsenha);

if (!empty($down_email) && !empty($id) && $down_senha == $senhabd['senha_usu']) {
	// se o nivel do usuario for 4 ou 3 (anunciante e comum) ele volta a ser 2, se for 5(anunciante e cliente) volta a ser 4
	if ($senhabd['nivel'] == 5) {
	$att_lvl =  mysqli_query($con,"UPDATE usuario SET nivel = '4' WHERE id_usu = '$id' AND email_usu = '$down_email' AND senha_usu = '$down_senha'");
	}else{
	$att_lvl =  mysqli_query($con,"UPDATE usuario SET nivel = '2' WHERE id_usu = '$id' AND email_usu = '$down_email' AND senha_usu = '$down_senha'");
	}

	if ($att_lvl) {
        // envia um e-mail de cadastro
        if (PHP_VERSION_ID < 50600) {
            iconv_set_encoding('input_encoding', 'UTF-8');
            iconv_set_encoding('output_encoding', 'UTF-8');
            iconv_set_encoding('internal_encoding', 'UTF-8');
        } else {
            ini_set('default_charset', 'UTF-8');
        }

        $headers = "MIME-Version: 1.1\r\n";
        $headers .= "From: QIS - <suporte@qiseventos.com.br>\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
        ('Content-type: text/html; charset=iso-8859-1 \r\n');
 
        $subject = "DEIXAR DE ANUNCIAR - QISeventos";
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
            <h3>{$down_email}</h3>
            <p>Você acabou de deixar de anunciar em nosso site, não aparecerá mais em nossas buscas (caso tenha propagandas rodando pelo nosso site, elas ainda continuaram e você ainda poderá fazer suas propagandas futuras), nem terá mais sua conta premium ou master. Caso não seja o {$down_email} por favor entre em contato com o <a href='https://www.qiseventos.com.br/contato-sobrenos.php#us' target='_blank'>suporte</a></p>
            <p>Att: QISeventos</p>
        </div>
        <footer>
            <p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
        </footer>
        ";

        $subject = utf8_decode($subject);
        $mensagem1 = utf8_decode($mensagem1);

        $send_contact=mail($down_email, $subject, $mensagem1, $headers);

		header('Location: ../../perfil.php');
	}
}else{
	header('Location: ../../perfil.php?error=sim&motivo=exsenhaerrada');
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

$subject = "[QIS] DEIXAR DE ANUNCIAR";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE DOWN_LVL<br />
ERRO: {$erro}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);

    header('Location: ../../perfil.php?error=sim&motivo=database');

}
?>