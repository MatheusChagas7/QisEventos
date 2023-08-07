<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

$id = $_POST['id_usuario'];
$dt_inicio = $_POST['dt_inicio'];
$dt_fim = $_POST['dt_fim'];
$url_redi = $_POST['url_redi'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
// paginas, q farei um array
$pagina1 = $_POST['pagina1'];
$pagina2 = $_POST['pagina2'];
$pagina3 = $_POST['pagina3'];
$pagina4 = $_POST['pagina4'];
$pagina5 = $_POST['pagina5'];
$pagina6 = $_POST['pagina6'];
// arquivos em string
$file1 = $_POST['file1'];
$file2 = $_POST['file2'];
$file3 = $_POST['file3'];
$file4 = $_POST['file4'];
$file5 = $_POST['file5'];
$file6 = $_POST['file6'];
// checkboxs (todos)
$in_cb_1 = $_POST['in_cb_1'];
$in_cb_2 = $_POST['in_cb_2'];
$in_cb_3 = $_POST['in_cb_3'];
$in_cb_4 = $_POST['in_cb_4'];
$in_cb_5 = $_POST['in_cb_5'];
$in_cb_6 = $_POST['in_cb_6'];

$aj_cb_1 = $_POST['aj_cb_1'];

$an_cb_1 = $_POST['an_cb_1'];
$an_cb_2 = $_POST['an_cb_2'];
$an_cb_3 = $_POST['an_cb_3'];

$cs_cb_1 = $_POST['cs_cb_1'];
$cs_cb_2 = $_POST['cs_cb_2'];

$pe_cb_1 = $_POST['pe_cb_1'];

$pr_cb_1 = $_POST['pr_cb_1'];

//array com as localizacoes dos anuncios
$localizacao1_Arr = array($in_cb_1);
$localizacao1 = implode(',',$localizacao1_Arr);

$localizacao2_Arr = array($in_cb_2, $in_cb_3);
$localizacao2 = implode(',',$localizacao2_Arr);

$localizacao3_Arr = array($in_cb_4);
$localizacao3 = implode(',',$localizacao3_Arr);

$localizacao4_Arr = array($in_cb_5);
$localizacao4 = implode(',',$localizacao4_Arr);

$localizacao5_Arr = array($in_cb_6, $aj_cb_1, $an_cb_1, $an_cb_2, $an_cb_3, $cs_cb_1, $cs_cb_2, $pe_cb_1, $pr_cb_1);
$localizacao5 = implode(',',$localizacao5_Arr);

// cria o array com os elementos das paginas
$pagina_Arr = array($pagina1, $pagina2, $pagina3, $pagina4, $pagina5, $pagina6);
// separa por virgula
$pagina = implode(',',$pagina_Arr);

// caso o arquivo nao esteja vazio
if (!empty($file1)) {

// subir a imagem 1 para o servidor
$anun1 = str_replace('data:image/png;base64,', '', $file1);
$anun2 = str_replace('', '+', $anun1);
$data_anun = base64_decode($anun2);
$novoNomea1 = uniqid ( time () ) . '.' . 'jpg';
$anun1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea1;
file_put_contents($anun1_pre , $data_anun);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio1 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun1_pre);

}
// caso o arquivo nao esteja vazio
if (!empty($file2)) {

// subir a imagem 2 para o servidor
$anun2_1 = str_replace('data:image/png;base64,', '', $file2);
$anun2_2 = str_replace('', '+', $anun2_1);
$data_anun2 = base64_decode($anun2_2);
$novoNomea2_1 = uniqid ( time () ) . '.' . 'jpg';
$anun2_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea2_1;
file_put_contents($anun2_1_pre , $data_anun2);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio2 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun2_1_pre);

}
// caso o arquivo nao esteja vazio
if (!empty($file3)) {

// subir a imagem 3 para o servidor
$anun3_1 = str_replace('data:image/png;base64,', '', $file3);
$anun3_2 = str_replace('', '+', $anun3_1);
$data_anun3 = base64_decode($anun3_2);
$novoNomea3_1 = uniqid ( time () ) . '.' . 'jpg';
$anun3_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea3_1;
file_put_contents($anun3_1_pre , $data_anun3);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio3 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun3_1_pre);

}
// caso o arquivo nao esteja vazio
if (!empty($file4)) {

// subir a imagem 4 para o servidor
$anun4_1 = str_replace('data:image/png;base64,', '', $file4);
$anun4_2 = str_replace('', '+', $anun4_1);
$data_anun4 = base64_decode($anun4_2);
$novoNomea4_1 = uniqid ( time () ) . '.' . 'jpg';
$anun4_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea4_1;
file_put_contents($anun4_1_pre , $data_anun4);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio4 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun4_1_pre);

}
// caso o arquivo nao esteja vazio
if (!empty($file5)) {

// subir a imagem 5 para o servidor
$anun5_1 = str_replace('data:image/png;base64,', '', $file5);
$anun5_2 = str_replace('', '+', $anun5_1);
$data_anun5 = base64_decode($anun5_2);
$novoNomea5_1 = uniqid ( time () ) . '.' . 'jpg';
$anun5_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea5_1;
file_put_contents($anun5_1_pre , $data_anun5);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio5 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun5_1_pre);

}
// caso o arquivo nao esteja vazio
if (!empty($file6)) {

// subir a imagem 5 para o servidor
$anun6_1 = str_replace('data:image/png;base64,', '', $file6);
$anun6_2 = str_replace('', '+', $anun6_1);
$data_anun6 = base64_decode($anun6_2);
$novoNomea6_1 = uniqid ( time () ) . '.' . 'jpg';
$anun6_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea6_1;
file_put_contents($anun6_1_pre , $data_anun6);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio6 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun6_1_pre);

}

// ----------------------------------------------------------------------------------------------------

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) {

	$query = mysqli_query($con, "INSERT INTO propaganda (id_propaganda, fk_propaganda_usu, dt_inicio, dt_fim, url_redi, estado, cidade, pagina, imagem_propaganda1, localizacao1, imagem_propaganda2, localizacao2, imagem_propaganda3, localizacao3,imagem_propaganda4, localizacao4, imagem_propaganda5, imagem_propaganda5m, localizacao5, ativo) VALUES ('', '$id', '$dt_inicio', '$dt_fim', '$url_redi', '$estado', '$cidade', '$pagina', '$anuncio1', '$localizacao1', '$anuncio2', '$localizacao2', '$anuncio3', '$localizacao3', '$anuncio4', '$localizacao4', '$anuncio5', '$anuncio6', '$localizacao5', '0')");

	//apos essa propaganda, busca o id dela para retornar para a pagina e por no campo COLOCAR PARA BUSCAR O ID, ATRAVES DO ULTIMO ID ADD DO USUARIO Q FEZ A PROPAGANDA
	$query_gid = mysqli_query($con, " SELECT max(id_propaganda) FROM propaganda ");
	$linha_gid = mysqli_fetch_assoc($query_gid);
	$id_gid = $linha_gid['max(id_propaganda)'];

	if ( $query && $query_gid) {
		exit($id_gid);
	}else{
		exit("erro");
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

$subject = "[QIS] SEND_PROPAGANDA";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT ENVIAR NOVA PROPAGANDA PRO BANCO<br />
ERRO: {$erro}";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);

header('Location: ../../anunciar.php?error=sim&motivo=errodatabase');
}
?>