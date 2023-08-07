<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

// recebe as informacoes do usuario
$id = $_POST['id'];
$nome = addslashes($_POST['nome']);
$email = $_POST['email'];
$n_lvl = $_POST['n_lvl'];
$sexo = $_POST['sexo'];
$dt_nasc = $_POST['dt_nasc'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$categoria1 = $_POST['categoria1'];
if (empty($categoria1)) {$categoria1 = "NULL";}
$categoria2 = $_POST['categoria2'];
if (empty($categoria2)) {$categoria2 = "NULL";}
$categoria3 = $_POST['categoria3'];
if (empty($categoria3)) {$categoria3 = "NULL";}
// caso cat1/2 estiverem vazias mas a 3 não, então colocar a 3 no 1, e assim sucessivamente
if (empty($categoria1) && empty($categoria2)) {
    $categoria1 = $_POST['categoria3']; // e categoria 3 ficará vazia
    $categoria3 = "NULL";
}
if(empty($categoria1) && empty($categoria3)){
    $categoria1 = $_POST['categoria2']; // e categoria 2 ficará vazia
    $categoria2 = "NULL";
}
// caso exista a categoria, buscar o nome dela
if (!empty($categoria1) && $categoria1 !== "NULL") {
    $query_cat1 = mysqli_query($con, "SELECT nome_categoria FROM categoria WHERE id_categoria='$categoria1' ");
    $rec_cat1 = mysqli_fetch_assoc($query_cat1);
    $nome_categoria1 = $rec_cat1['nome_categoria'];
}
if (!empty($categoria2) && $categoria2 !== "NULL") {
    $query_cat2 = mysqli_query($con, "SELECT nome_categoria FROM categoria WHERE id_categoria='$categoria2' ");
    $rec_cat2 = mysqli_fetch_assoc($query_cat2);
    $nome_categoria2 = $rec_cat2['nome_categoria'];
}
if (!empty($categoria3) && $categoria3 !== "NULL") {
    $query_cat3 = mysqli_query($con, "SELECT nome_categoria FROM categoria WHERE id_categoria='$categoria3' ");
    $rec_cat3 = mysqli_fetch_assoc($query_cat3);
    $nome_categoria3 = $rec_cat3['nome_categoria'];
}

$sobre = addslashes($_POST['sobre']);
$cpf = $_POST['cpf'];
if (empty($cpf)) {$cpf = "NULL";}
$rg = $_POST['rg'];
if (empty($rg)) {$rg = "NULL";}
$numero1 = $_POST['numero1'];
$numero2 = $_POST['numero2'];
$numero3 = $_POST['numero3'];
$email_contato = $_POST['email_contato'];
$descricao = addslashes($_POST['descricao']);

// pega a foto da CAPA
$imgc1 = $_POST['tupcapa'];
if (!empty($imgc1)) {

$imgc2 = str_replace('data:image/png;base64,', '', $imgc1);
$imgc3 = str_replace('', '+', $imgc2);
$datac = base64_decode($imgc3);
$novoNomec = uniqid ( time () ) . '.' . 'jpg';
$filec1 = '/home/ilion548/public_html/qiseventos/assets/img/usuario/'.$novoNomec;
file_put_contents($filec1 , $datac);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$fotocapa = str_replace('/home/ilion548/public_html/qiseventos', '', $filec1);

$del_fc = mysqli_query($con, "SELECT foto_capa FROM usuario WHERE email_usu='$email'");
$excluir_capa = mysqli_fetch_assoc($del_fc);
$capa_ex = $excluir_capa['foto_capa'];
if (!empty($capa_ex)) {
unlink('/home/ilion548/public_html/qiseventos'.$capa_ex);
}
}

// pega a foto do PERFIL
$img1 = $_POST['tupperfil'];
if (!empty($img1)) {

$img2 = str_replace('data:image/png;base64,', '', $img1);
$img3 = str_replace('', '+', $img2);
$data = base64_decode($img3);
$novoNome = uniqid ( time () ) . '.' . 'jpg';
$file1 = '/home/ilion548/public_html/qiseventos/assets/img/usuario/'.$novoNome;
file_put_contents($file1 , $data);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$fotoperfil = str_replace('/home/ilion548/public_html/qiseventos', '', $file1);

$del_fp = mysqli_query($con, "SELECT foto_perfil FROM usuario WHERE email_usu='$email'");
$excluir_perfil = mysqli_fetch_assoc($del_fp);
$perfil_ex = $excluir_perfil['foto_perfil'];
if (!empty($perfil_ex) && file_exists("/home/ilion548/public_html/qiseventos" . $perfil_ex)) {
unlink('/home/ilion548/public_html/qiseventos'.$perfil_ex);
}
}

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) { 
// busca seu email atual
    $query_e = mysqli_query($con, "SELECT email_usu FROM usuario WHERE id_usu='$id'");
    $linha_e = mysqli_fetch_assoc($query_e);
    $email_atual = $linha_e['email_usu'];
    if ($email_atual != $email) {
        // envia um e-mail de mudança de email
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
 
        $subject = "Mudança de email - QISeventos";
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
            <h3>{$email}</h3>
            <p>Você acaba de atualizar o seu endereço de email!<br />
            De: {$email_atual}<br/>
            Para: {$email}</p>
        </div>
        <footer>
            <p>Caso Você não seja o {$email}, ou não tenha feito a troca de email, por favor entre em contato <a href='https://qiseventos.com.br/contato-sobrenos.php#us'>AQUI<a/>.</p>
            <p>Esta é uma mensagem automática, por favor não responda. Obrigado!</p>
        </footer>
        ";
            
        $subject = utf8_decode($subject);
        $mensagem1 = utf8_decode($mensagem1);

        $send_contact=mail($email, $subject, $mensagem1, $headers);
    }
// COM CAPA e COM PERFIL
if (!empty($imgc1) && !empty($img1)) {
       
    $query = mysqli_query($con, " UPDATE usuario SET nome_completo='$nome', email_usu='$email', nivel='$n_lvl', sexo='$sexo', dt_nasc='$dt_nasc', fk_categoria1_usu=$categoria1, nome_categoria_1 = '$nome_categoria1', fk_categoria2_usu=$categoria2, nome_categoria_2 = '$nome_categoria2', fk_categoria3_usu=$categoria3, nome_categoria_3 = '$nome_categoria3', sobre_usu='$sobre', cpf_usu='$cpf', rg_usu='$rg', estado='$estado', cidade='$cidade', numero_1='$numero1', numero_2='$numero2', numero_3='$numero3', email_contato='$email_contato', descricao='$descricao', foto_perfil='$fotoperfil', foto_capa='$fotocapa' WHERE id_usu='$id'");
// SEM CAPA e COM PERFIl
}else if(!empty($imgc1) && empty($img1)){

    $query = mysqli_query($con, " UPDATE usuario SET nome_completo='$nome', email_usu='$email', nivel='$n_lvl', sexo='$sexo', dt_nasc='$dt_nasc', fk_categoria1_usu=$categoria1, nome_categoria_1 = '$nome_categoria1', fk_categoria2_usu=$categoria2, nome_categoria_2 = '$nome_categoria2', fk_categoria3_usu=$categoria3, nome_categoria_3 = '$nome_categoria3', sobre_usu='$sobre', cpf_usu='$cpf', rg_usu='$rg', estado='$estado', cidade='$cidade', numero_1='$numero1', numero_2='$numero2', numero_3='$numero3', email_contato='$email_contato', descricao='$descricao', foto_capa='$fotocapa' WHERE id_usu='$id'");
// COM CAPA e SEM PERFIL
}else if (empty($imgc1) && !empty($img1)) {

    $query = mysqli_query($con, " UPDATE usuario SET nome_completo='$nome', email_usu='$email', nivel='$n_lvl', sexo='$sexo', dt_nasc='$dt_nasc', fk_categoria1_usu=$categoria1, nome_categoria_1 = '$nome_categoria1', fk_categoria2_usu=$categoria2, nome_categoria_2 = '$nome_categoria2', fk_categoria3_usu=$categoria3, nome_categoria_3 = '$nome_categoria3', sobre_usu='$sobre', cpf_usu='$cpf', rg_usu='$rg', estado='$estado', cidade='$cidade', numero_1='$numero1', numero_2='$numero2', numero_3='$numero3', email_contato='$email_contato', descricao='$descricao', foto_perfil='$fotoperfil' WHERE id_usu='$id'");
// SEM CAPA E SEM PERFIL
}else{

    $query = mysqli_query($con, " UPDATE usuario SET nome_completo='$nome', email_usu='$email', nivel='$n_lvl', sexo='$sexo', dt_nasc='$dt_nasc', fk_categoria1_usu=$categoria1, nome_categoria_1 = '$nome_categoria1', fk_categoria2_usu=$categoria2, nome_categoria_2 = '$nome_categoria2', fk_categoria3_usu=$categoria3, nome_categoria_3 = '$nome_categoria3', sobre_usu='$sobre', cpf_usu='$cpf', rg_usu='$rg', estado='$estado', cidade='$cidade', numero_1='$numero1', numero_2='$numero2', numero_3='$numero3', email_contato='$email_contato', descricao='$descricao' WHERE id_usu='$id'");
}
    // se tudo der certo redireiona
    if ($query) {
        // se email for diferente, indica q houve alteracao de email, desloga para logar novamente
        if ($email_atual != $email) {
            header('Location: ../../login.php?relogar=ealt');
        }else{
            header('Location: ../../perfil.php');
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

        $subject = "[QIS] SALVAR PERFIL";
        $mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE QUERY UPDATE PERFIL USUARIO<br />
        ERRO: {$erro}";

        $subject = utf8_decode($subject);
        $mensagem1 = utf8_decode($mensagem1);

        $send_contact=mail($from, $subject, $mensagem1, $headers);
        header('Location: ../../perfil.php?error=sim&motivo=erroupdate');
        // die("Erro: ".mysqli_error($con));


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

$subject = "[QIS] PERFIL";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE SALVAR PERFIL USUARIO<br />
ERRO: {$erro}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);
    header('Location: ../../perfil.php?error=sim&motivo=database');

}
?>