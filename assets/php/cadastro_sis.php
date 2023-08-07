<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

/*formatacao da data*/
function inverteData($data){
    if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
}
/* funcao retirar acentos e caracters especiais*/
function sanitizeString($str) {
    // maiuscula
    $str = preg_replace('/[ÁÀÃÂÄ]/ui', 'A', $str);
    $str = preg_replace('/[ÉÈÊË]/ui', 'E', $str);
    $str = preg_replace('/[ÍÌÎÏ]/ui', 'I', $str);
    $str = preg_replace('/[ÓÒÕÔÖ]/ui', 'O', $str);
    $str = preg_replace('/[ÚÙÛÜ]/ui', 'U', $str);
    $str = preg_replace('/[Ç]/ui', 'C', $str);
    $str = preg_replace('/[&]/ui', 'e', $str);
    // normal
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    //$str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
    $str = preg_replace('/[^a-z0-9]/i', '_', $str);
    $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
    return $str;
}
//recupera as informacoes enviadas pelo cadastro
$nome = filter_input(INPUT_POST, "nome");
$email = filter_input(INPUT_POST, "email");
$senha = filter_input(INPUT_POST, "senha");
$genero = filter_input(INPUT_POST, "genero");
$nascimento = filter_input(INPUT_POST, "nascimento");
// cria a url personalizavel 
$aux = $nome.time(); //cadeia de numeros aleatorios
$parte = explode(' ', $nome); //mais o primeiro nome do usuario
$url_persona = sanitizeString($parte[0]) . substr(md5($aux),0,6);
$dateFormat = inverteData($nascimento);
// add a imagem, mas alterar o form e alterar a query
$foto_perfil = filter_input(INPUT_POST, "foto_perfil");
$token = filter_input(INPUT_POST, "token");
$migracao = filter_input(INPUT_POST, "local");

if (empty($migracao)) {
    $migracao = "qis";
}

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) {

    $query_busca = mysqli_query($con, "SELECT email_usu FROM usuario WHERE email_usu like '%$email%'");
    $linha = mysqli_fetch_assoc($query_busca);
 
    if(strtolower($email) === strtolower($linha['email_usu']) ){
        header('Location: ../../cadastro.php?error=email_cadastrado'); 
    }else{
        $query = mysqli_query($con, " INSERT INTO usuario (id_usu, nome_completo, email_usu, senha_usu, dt_nasc, sexo, nivel, pacote_usu, foto_perfil, url_persona, migracao, situacao_login) VALUES ('','$nome','$email','$senha', '$dateFormat', '$genero', '2', '0', '$foto_perfil', '$url_persona', '$migracao', 'log') ");
        //apos add esse usuario acima, buscar ele
        $query2 = mysqli_query($con, "SELECT id_usu FROM usuario WHERE email_usu = '$email' ");
        $linha2 = mysqli_fetch_assoc($query2);
        $idreg = $linha2['id_usu'];

        $query_usu_continue = mysqli_query($con, " INSERT INTO usuario_continue (id_usu_continue, id_fk_usu_continue, soundcloud) VALUES ('','$idreg','') ");

        if($query && $query_usu_continue){
        // coloca o email e senha em seu cache
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;

        // envia um e-mail de cadastro
        if (PHP_VERSION_ID < 50600) {
            iconv_set_encoding('input_encoding', 'UTF-8');
            iconv_set_encoding('output_encoding', 'UTF-8');
            iconv_set_encoding('internal_encoding', 'UTF-8');
        } else {
            ini_set('default_charset', 'UTF-8');
        }
        
        $headers = "MIME-Version: 1.1\r\n";
        $headers .= "From: QISeventos - <suporte@qiseventos.com.br>\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
        ('Content-type: text/html; charset=iso-8859-1 \r\n');
        
        $md5 = md5(strtolower($email));
        $subject = "Confirmação de cadastro - QISeventos";
        $link = 'https://www.qiseventos.com.br/confirma.php?h='.$md5;
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
            <h3>Parabéns {$nome}</h3>
            <p>Você acaba de fazer parte da familia QISeventos, seja bem-vindo!
            Agora ficou mais fácil anunciar seu produto ou serviço para eventos, em diversas categorias!
            <a href='$link'>Clique aqui para confirmar seu cadastro.</a></p>
        </div>
        <footer>
            <p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
        </footer>
        ";
            
        $subject = utf8_decode($subject);
        $mensagem1 = utf8_decode($mensagem1);

        $send_contact=mail($email, $subject, $mensagem1, $headers);

        header('Location: ../../index.php');
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

            $subject = "[QIS] CADASTRO";
            $mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE CADASTRAR<br />
            ERRO: {$erro}";

            $subject = utf8_decode($subject);
            $mensagem1 = utf8_decode($mensagem1);

            $send_contact=mail($from, $subject, $mensagem1, $headers);

            header('Location: ../../cadastro.php?error=foradoar');

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

$subject = "[QIS] CADASTRO";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE CADASTRAR<br />
ERRO: {$erro}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);

header('Location: ../../cadastro.php?error=foradoar');
}
?>