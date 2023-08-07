<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

$id_prop = $_POST['id_prop'];
$url_redi = $_POST['url_redi'];
$estado_alt = $_POST['estado_alt'];
$cidade_alt = $_POST['cidade_alt'];
// arquivos em string
$file1 = $_POST['txtanun1'];
$file2 = $_POST['txtanun2'];
$file3 = $_POST['txtanun3'];
$file4 = $_POST['txtanun4'];
$file5 = $_POST['txtanun5'];
$file6 = $_POST['txtanun6'];


$get_img_original = mysqli_query($con, "SELECT imagem_propaganda1,imagem_propaganda2,imagem_propaganda3,imagem_propaganda4,imagem_propaganda5,imagem_propaganda5m FROM propaganda WHERE id_propaganda = $id_prop ");
$row_imgo = mysqli_fetch_assoc($get_img_original);

// caso o arquivo nao esteja vazio significa que foi alterada a imagem, se nao buscar a imagem original para colocar na variavel
if (!empty($file1)) {
	// excluir a imagem antiga
	if (!empty($row_imgo['imagem_propaganda1']) && file_exists("/home/ilion548/public_html/qiseventos" . $$row_imgo['imagem_propaganda1'])) {
		unlink('/home/ilion548/public_html/qiseventos'.$row_imgo['imagem_propaganda1']);
	}

// subir a imagem 1 para o servidor
$anun1 = str_replace('data:image/png;base64,', '', $file1);
$anun2 = str_replace('', '+', $anun1);
$data_anun = base64_decode($anun2);
$novoNomea1 = uniqid ( time () ) . '.' . 'jpg';
$anun1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea1;
file_put_contents($anun1_pre , $data_anun);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio1 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun1_pre);

}else{
	$anuncio1 = $row_imgo['imagem_propaganda1'];
}

// caso o arquivo nao esteja vazio
if (!empty($file2)) {

	// excluir a imagem antiga
	if (!empty($row_imgo['imagem_propaganda2']) && file_exists("/home/ilion548/public_html/qiseventos" . $$row_imgo['imagem_propaganda2'])) {
		unlink('/home/ilion548/public_html/qiseventos'.$row_imgo['imagem_propaganda2']);
	}

// subir a imagem 2 para o servidor
$anun2_1 = str_replace('data:image/png;base64,', '', $file2);
$anun2_2 = str_replace('', '+', $anun2_1);
$data_anun2 = base64_decode($anun2_2);
$novoNomea2_1 = uniqid ( time () ) . '.' . 'jpg';
$anun2_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea2_1;
file_put_contents($anun2_1_pre , $data_anun2);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio2 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun2_1_pre);

}else{
	$anuncio2 = $row_imgo['imagem_propaganda2'];
}

// caso o arquivo nao esteja vazio
if (!empty($file3)) {

	// excluir a imagem antiga
	if (!empty($row_imgo['imagem_propaganda3']) && file_exists("/home/ilion548/public_html/qiseventos" . $$row_imgo['imagem_propaganda3'])) {
		unlink('/home/ilion548/public_html/qiseventos'.$row_imgo['imagem_propaganda3']);
	}

// subir a imagem 3 para o servidor
$anun3_1 = str_replace('data:image/png;base64,', '', $file3);
$anun3_2 = str_replace('', '+', $anun3_1);
$data_anun3 = base64_decode($anun3_2);
$novoNomea3_1 = uniqid ( time () ) . '.' . 'jpg';
$anun3_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea3_1;
file_put_contents($anun3_1_pre , $data_anun3);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio3 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun3_1_pre);

}else{
	$anuncio3 = $row_imgo['imagem_propaganda3'];
}

// caso o arquivo nao esteja vazio
if (!empty($file4)) {

	// excluir a imagem antiga
	if (!empty($row_imgo['imagem_propaganda4']) && file_exists("/home/ilion548/public_html/qiseventos" . $$row_imgo['imagem_propaganda4'])) {
		unlink('/home/ilion548/public_html/qiseventos'.$row_imgo['imagem_propaganda4']);
	}

// subir a imagem 4 para o servidor
$anun4_1 = str_replace('data:image/png;base64,', '', $file4);
$anun4_2 = str_replace('', '+', $anun4_1);
$data_anun4 = base64_decode($anun4_2);
$novoNomea4_1 = uniqid ( time () ) . '.' . 'jpg';
$anun4_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea4_1;
file_put_contents($anun4_1_pre , $data_anun4);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio4 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun4_1_pre);

}else{
	$anuncio4 = $row_imgo['imagem_propaganda4'];
}

// caso o arquivo nao esteja vazio
if (!empty($file5)) {

	// excluir a imagem antiga
	if (!empty($row_imgo['imagem_propaganda5']) && file_exists("/home/ilion548/public_html/qiseventos" . $$row_imgo['imagem_propaganda5'])) {
		unlink('/home/ilion548/public_html/qiseventos'.$row_imgo['imagem_propaganda5']);
	}

// subir a imagem 5 para o servidor
$anun5_1 = str_replace('data:image/png;base64,', '', $file5);
$anun5_2 = str_replace('', '+', $anun5_1);
$data_anun5 = base64_decode($anun5_2);
$novoNomea5_1 = uniqid ( time () ) . '.' . 'jpg';
$anun5_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea5_1;
file_put_contents($anun5_1_pre , $data_anun5);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio5 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun5_1_pre);

}else{
	$anuncio5 = $row_imgo['imagem_propaganda5'];
}

// caso o arquivo nao esteja vazio
if (!empty($file6)) {

	// excluir a imagem antiga
	if (!empty($row_imgo['imagem_propaganda5m']) && file_exists("/home/ilion548/public_html/qiseventos" . $$row_imgo['imagem_propaganda5m'])) {
		unlink('/home/ilion548/public_html/qiseventos'.$row_imgo['imagem_propaganda5m']);
	}

// subir a imagem 5 para o servidor
$anun6_1 = str_replace('data:image/png;base64,', '', $file6);
$anun6_2 = str_replace('', '+', $anun6_1);
$data_anun6 = base64_decode($anun6_2);
$novoNomea6_1 = uniqid ( time () ) . '.' . 'jpg';
$anun6_1_pre = '/home/ilion548/public_html/qiseventos/assets/img/anuncio/'.$novoNomea6_1;
file_put_contents($anun6_1_pre , $data_anun6);
//$data == um monte de caracters gigantes.//$img3 e $img2 == me retorna a imagem msm.
$anuncio6 = str_replace('/home/ilion548/public_html/qiseventos', '', $anun6_1_pre);

}else{
	$anuncio6 = $row_imgo['imagem_propaganda5m'];
}


if ($con) {

	$query_up = mysqli_query($con,"UPDATE propaganda SET url_redi = '$url_redi', estado = '$estado_alt', cidade = '$cidade_alt', imagem_propaganda1 = '$anuncio1', imagem_propaganda2 = '$anuncio2', imagem_propaganda3 = '$anuncio3', imagem_propaganda4 = '$anuncio4', imagem_propaganda5 = '$anuncio5', imagem_propaganda5m = '$anuncio6' WHERE id_propaganda = $id_prop ");

	if ($query_up) {
		header('Location: ../../estatistica.php?res=alterado');
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

		$subject = "[QIS] ALTERAR PROPAGANDA";
		$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE ALTERAR PROPAGANDA<br />
		ERRO: {$erro}";

		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);

		$send_contact=mail($from, $subject, $mensagem1, $headers);

		header('Location: ../../estatistica.php?error=sim&motivo=errodatabase');
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

	$subject = "[QIS] ALTERAR PROPAGANDA";
	$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE ALTERAR PROPAGANDA<br />
	ERRO: {$erro}";

	$subject = utf8_decode($subject);
	$mensagem1 = utf8_decode($mensagem1);

	$send_contact=mail($from, $subject, $mensagem1, $headers);

	header('Location: ../../estatistica.php?error=sim&motivo=errodatabase');

}

?>