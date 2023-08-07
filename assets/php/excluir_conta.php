<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

// recebe as informacoes do usuario
$id = filter_input(INPUT_POST, "exid");
$exemail = filter_input(INPUT_POST, "exemail");
$exsenha = filter_input(INPUT_POST, "exsenha");

// verificar a conexao, se tudo estiver certo, vai executar a linha e excluir o usuario, se nao vai informar qual o erro
if ($con) {
    // busca a senha no banco pelo email do usuario
    $buscarsenha = mysqli_query($con, "SELECT senha_usu FROM usuario WHERE email_usu = '$exemail'");
    $senhabd = mysqli_fetch_assoc($buscarsenha );
// se a senha for compativel com que veio do usuario e o email e id for diferente de vazio, prossiga
if (!empty($exemail) && !empty($id) && $exsenha == $senhabd['senha_usu']) {
    // apaga tokens existentes deste usuario
    $query_token = mysqli_query($con, "DELETE FROM token WHERE fk_token_usu = '$exemail'");
    // buscar capa e perfil
    $del_imgs = mysqli_query($con, "SELECT foto_perfil,foto_capa FROM usuario WHERE email_usu='$exemail'");
    $excluir_imgs = mysqli_fetch_assoc($del_imgs);
    $capa_ex = $excluir_imgs['foto_capa'];
    $perfil_ex = $excluir_imgs['foto_perfil'];
    // apagar capa se existir
    if (!empty($capa_ex) && file_exists("/home/ilion548/public_html/qiseventos" . $capa_ex) ) {
        unlink('/home/ilion548/public_html/qiseventos'.$capa_ex);
    }
    // pagar perfil se existir
    if (!empty($perfil_ex) && file_exists("/home/ilion548/public_html/qiseventos" . $perfil_ex)) {
        unlink('/home/ilion548/public_html/qiseventos'.$perfil_ex);
    }
    // buscar registro na propaganda
    $query_get_prop = mysqli_query($con,"SELECT * FROM propaganda WHERE fk_propaganda_usu = '$id' ");
    $linha_des = mysqli_fetch_assoc($query_get_prop);
        // apaga a imagem da propaganda no sistema, cada if para ver se a imagem existe em cada espaço
        // 1
        if (!empty($linha_des['imagem_propaganda1']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda1'])) {
            unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda1']);
        }
        // 2
        if (!empty($linha_des['imagem_propaganda2']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda2'])) {
            unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda2']);
        }
        // 3
        if (!empty($linha_des['imagem_propaganda3']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda3'])) {
            unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda3']);
        }
        // 4
        if (!empty($linha_des['imagem_propaganda4']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda4'])) {
            unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda4']);
        }
        // 5
        if (!empty($linha_des['imagem_propaganda5']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda5'])) {
            unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda5']);
        }
        // 5m
        if (!empty($linha_des['imagem_propaganda5m']) && file_exists("/home/ilion548/public_html/qiseventos" . $$linha_des['imagem_propaganda5m'])) {
            unlink('/home/ilion548/public_html/qiseventos'.$linha_des['imagem_propaganda5m']);
        }
    // apaga propaganda
    $query_propaganda = mysqli_query($con, "DELETE FROM propaganda WHERE fk_propaganda_usu = '$id' ");    
    // apagar usuario
    $query = mysqli_query($con, "DELETE FROM usuario WHERE senha_usu = '$exsenha' AND id_usu ='$id'");
    // apagar usuario_continue
    $query_usu_continue = mysqli_query($con, "DELETE FROM usuario_continue WHERE id_fk_usu_continue = '$id' ");
    // apaga notificações (tanto as que foram do usuario, quanto as que foram PARA o usuario)
    $query_noti0 = mysqli_query($con, "DELETE FROM notificacao WHERE id_cli_noti = '$id' ");
    $query_noti1 = mysqli_query($con, "DELETE FROM notificacao WHERE id_usu_noti = '$id' ");
    // apaga contador
    $query_contador = mysqli_query($con, "DELETE FROM contador WHERE fk_cont_usu = '$id' ");
    // apagar favoritos
    $query_favoritos0 = mysqli_query($con, "DELETE FROM favoritos WHERE id_fk_usu = '$id' ");
    $query_favoritos1 = mysqli_query($con, "DELETE FROM favoritos WHERE id_fk_cliente = '$id' ");

    // envia um e-mail explicando a exclusão
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
 
    $subject = "Exclusão de conta - QISeventos";
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
            <h3>{$exemail}</h3>
            <p>Você não receberá mais emails nossos, sua conta,propaganda e qualquer outro dado foi excluido.<br />
            Obrigado por participar e volte sempre!</p>
            <p>Att: QISeventos</p>
        </div>
        <footer>
            <p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
        </footer>
    ";

    $subject = utf8_decode($subject);
    $mensagem1 = utf8_decode($mensagem1);
    
    $send_contact=mail($exemail, $subject, $mensagem1, $headers);

    // apagar cache, session
    session_destroy();
    setcookie('email',"", time()-3600);
    setcookie('senha',"", time()-3600);
    unset($_COOKIE['email']);
    unset($_COOKIE['senha']);
    // redirecionar para o index
    header('Location: ../../index.php');

}else{
    // se as senhas nao se concidirem
    header('Location: ../../perfil.php?error=sim&motivo=exsenhaerrada');
}

}else{

    $erro = mysqli_error($con);
    //email da baco
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

    $subject = "[QIS] EXCLUIR CONTA";
    $mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE EXCLUIR CONTA<br />
    ERRO: {$erro}";

    $subject = utf8_decode($subject);
    $mensagem1 = utf8_decode($mensagem1);

    $send_contact=mail($from, $subject, $mensagem1, $headers);

    header('Location: ../../perfil.php?error=sim&motivo=database');

}
?>