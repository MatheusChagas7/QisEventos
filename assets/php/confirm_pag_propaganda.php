<?php
//fara a conexao com banco de dados
include_once 'conexao.php';

// dados
$id_usu = $_POST['id_usu'];
$id_prop = $_POST['id_prop'];
$nome = $_POST['nome'];
$email = $_POST['email_usu'];
$ddd = $_POST['ddd'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$cep = $_POST['cep'];
$preco = $_POST['preco_prop'];

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) {
	// primeiro add o CEP ao registro de usuario_continue
	$query_usuc = mysqli_query($con, " UPDATE usuario_continue SET CEP = '$cep' WHERE id_fk_usu_continue = '$id_usu' ");
	// atualizo o CPF 
	$query_usu = mysqli_query($con, " UPDATE usuario SET cpf_usu = '$cpf' WHERE id_usu = '$id_usu' ");
	// coloca o preco da propaganda
	$query_upprop = mysqli_query($con, " UPDATE propaganda SET preco = '$preco' WHERE id_propaganda = '$id_prop' ");

	$url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

	$data['email'] = 'matheus.me.ngo@hotmail.com';
	$data['token'] = '3DA6A122DBF241F986C2561E6A55A237';
	$data['currency'] = 'BRL';
	$data['itemId1'] = $id_prop;
	$data['itemDescription1'] = 'Propaganda QISeventos';
	$data['itemAmount1'] = $preco;
	$data['itemQuantity1'] = '1';
	$data['reference'] = $id_usu;
	$data['senderName'] = $nome;
	$data['senderAreaCode'] = $ddd;
	$data['senderPhone'] = $telefone;
	$data['senderCPF'] = $cpf;
	$data['senderEmail'] = $email;
	$data['redirectURL'] = 'https://www.qiseventos.com.br/anunciar.php?done=feito';

	$data = http_build_query($data);

	$curl = curl_init($url);

	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$xml= curl_exec($curl);

	if($xml == 'Unauthorized'){
		//Insira seu código de prevenção a erros

		header('Location: ../../anunciar.php?done=autenticacao');
		exit;//Mantenha essa linha
	}
	curl_close($curl);

	$xml= simplexml_load_string($xml);
	if(count($xml -> error) > 0){
		//Insira seu código de tratamento de erro, talvez seja útil enviar os códigos de erros.

		header('Location: ../../anunciar.php?done=dadosInvalidos');
		exit;
	}
	header('Location: https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $xml -> code);


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

	$subject = "[QIS] CONFIRM_PAG_PROPAGANDA";
	$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT ENVIAR O PAGAMENTO DA PROPAGANDA<br />
	ERRO: {$erro}";

	$subject = utf8_decode($subject);
	$mensagem1 = utf8_decode($mensagem1);

	$send_contact=mail($from, $subject, $mensagem1, $headers);

	header('Location: ../../anunciar.php?error=sim&motivo=errodatabase');

}
?>