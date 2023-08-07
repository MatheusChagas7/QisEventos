<?php
session_start();
//fara a conexao com banco de dados
include_once 'conexao.php';

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

// recebe as informacoes da configuracao do usuario
$email = $_POST['email'];
$senha_atual = $_POST['senha_atual'];
$senha_nova = $_POST['senha_nova'];
$senha_nova_dnovo = $_POST['senha_nova_dnovo'];
// checkbox
$noti_email = $_POST['noti_email'];
$noti_app = $_POST['noti_app'];
$url_persona = sanitizeString($_POST['url_persona']);
// pega o facebook
$conta_face_chega = $_POST['conta_face'];
// se o usuario colocar o link completo do face com seu link da pagina
if (substr($conta_face_chega ,0,strrpos($conta_face_chega ,'facebook'))) {
	// primeiro inverte sua string
	$conta_face_inverse = strrev($conta_face_chega);
	// agora corte e pegue apenas o nome da sua fan page
	$conta_face_cut = substr($conta_face_inverse ,0,strrpos($conta_face_inverse ,'/moc.'));
	// se a string conter pg, corta tambem
	if ( substr($conta_face_chega ,0,strrpos($conta_face_chega ,'pg/')) ){
		$conta_face_cut = substr($conta_face_inverse ,0,strrpos($conta_face_inverse ,'/gp'));
	}
	// inverte e tera o nome da fan page certinho
	$conta_face = strrev($conta_face_cut);
	// ate aqui tudo certo, agora verificar se tem uma barra no final, e corta-la
	if ( substr($conta_face ,0,strrpos($conta_face ,'/')) ) {
		$conta_face = substr($conta_face ,0,strrpos($conta_face ,'/'));
	}
}else{
	$conta_face = $_POST['conta_face'];
}
// array com nomes dos albuns
$albun = $_POST['skip_albun'];
if (empty($albun)) {$albun_a = "";}else{
	$albun_a = implode(',',$albun);
}
// pega o twitter
$conta_twitter_chega = $_POST['twitter'];
// se o usuario colocar o link completo do twitter com seu link da pagina
if (substr($conta_twitter_chega ,0,strrpos($conta_twitter_chega ,'twitter'))) {
	// primeiro inverte sua string
	$conta_twitter_inverse = strrev($conta_twitter_chega);
	// agora corte e pegue apenas o nome da sua fan page
	$conta_twitter_cut = substr($conta_twitter_inverse ,0,strrpos($conta_twitter_inverse ,'/moc.'));
	// inverte e tera o nome da fan page certinho
	$conta_twitter = strrev($conta_twitter_cut);
	// ate aqui tudo certo, agora verificar se tem uma barra no final, e corta-la
	if ( substr($conta_twitter ,0,strrpos($conta_twitter ,'/')) ) {
	    $conta_twitter = substr($conta_twitter ,0,strrpos($conta_twitter ,'/'));
	}
}else{
	$conta_twitter = $_POST['twitter'];
}
// pega o instagram
$conta_instagram_chega = $_POST['instagram'];
// se o usuario colocar o link completo do instagram com seu link da pagina
if (substr($conta_instagram_chega ,0,strrpos($conta_instagram_chega ,'instagram'))) {
	// primeiro inverte sua string
	$conta_instagram_inverse = strrev($conta_instagram_chega);
	// agora corte e pegue apenas o nome da sua fan page
	$conta_instagram_cut = substr($conta_instagram_inverse ,0,strrpos($conta_instagram_inverse ,'/moc.'));
	// inverte e tera o nome da fan page certinho
	$conta_instagram = strrev($conta_instagram_cut);
	// ate aqui tudo certo, agora verificar se tem uma barra no final, e corta-la
	if ( substr($conta_instagram ,0,strrpos($conta_instagram ,'/')) ) {
		$conta_instagram = substr($conta_instagram ,0,strrpos($conta_instagram ,'/'));
	}
}else{
	$conta_instagram = $_POST['instagram'];
}

//recebe o valor do input, o iframe do soundcloud
$soundcloud_vem = $_POST['soundcloud'];
// troca o sinal "<"" por "&lt;" para que o valor acima seja lido como uma string"
$soundcloud_mud = str_replace('<', '&lt;', $soundcloud_vem);
//se nao estiver com <, entao esta vindo apenas o numero
if ( !is_numeric($soundcloud_vem) ) {

	//corta a string ate o valor "&amp;color"
	$soundcloud_cut = substr($soundcloud_mud ,0,strrpos($soundcloud_mud ,'&amp;color'));
	$soundcloud_cut2 = substr($soundcloud_mud ,0,strrpos($soundcloud_mud ,'&color'));
	//para caso haja 2 versoes de iframe
	if ($soundcloud_cut) {
		//inverte a string
		$soundcloud_inverte = strrev($soundcloud_cut);
		//corta novamente, agora com a string invertida, ate o valor "/sresu/" ou "/stsilyalp/"
		$soundcloud_quase = substr($soundcloud_inverte ,0,strrpos($soundcloud_inverte ,'/stsilyalp/'));
		$soundcloud_quase = substr($soundcloud_inverte ,0,strrpos($soundcloud_inverte ,'/sresu/'));
		//inverte de novo para o normal
		$soundcloud = strrev($soundcloud_quase);
	}else if ($soundcloud_cut2) {
		//inverte a string
		$soundcloud_inverte = strrev($soundcloud_cut2);
		//corta novamente, agora com a string invertida, ate o valor "/sresu/" ou "/stsilyalp/"
		$soundcloud_quase = substr($soundcloud_inverte ,0,strrpos($soundcloud_inverte ,'/stsilyalp/'));
		$soundcloud_quase = substr($soundcloud_inverte ,0,strrpos($soundcloud_inverte ,'/sresu/'));
		//inverte de novo para o normal
		$soundcloud = strrev($soundcloud_quase);
	}

}else{
	$soundcloud = $_POST['soundcloud'];
}

// pega canal
$youtube_vem = $_POST['youtube'];
// verifica se o canal esta escrito COM HTTPS(PORTANTO UM LINK COMPLETO), ou SEM (SE SEM,VERIFICA SE E APENAS O NOME DO CANAL,OU UM LINK SEM O HTTPS)
if( substr($youtube_vem,0,strrpos($youtube_vem ,'://www.')) ){
	// echo "tem todo o link<br>";
	// o link completo
	$youtube = $youtube_vem;
	// caso o link tenha complemento apos o fim do nome do canal, corta
	if ( substr($youtube,0,strrpos($youtube,'/videos')) || substr($youtube,0,strrpos($youtube,'/playlists')) ){
		$youtube = substr($youtube ,0,strrpos($youtube ,'/'));
	}
	// verifica se a url esta on(funcionando)
	// echo "URL: ".$youtube_vem . "<br>";
	$headers = @get_headers( $youtube_vem );
	if($headers !== FALSE && strpos($headers[0],'200') !== FALSE){
		// echo "OK";
	}else{
		// echo "nao funciona";
	}
}else{
	// echo "nao e o link completo<br>";
	// se for apenas o nome do canal, eu verifico agora se TEM HTTPS ou SE E REALMENTE SOMENTE O NOME DO CANAL
	if(substr($youtube_vem,0,strrpos($youtube_vem ,'.youtube'))  == "www"){
		// se nao tiver https mas for um link, eu add o https
		// echo "NAO TEM HTTPS(mas agora vai ter, add o https://...)<br>";
		$youtube = "https://" . $youtube_vem;
		// caso o link tenha complemento apos o fim do nome do canal, corta
		if ( substr($youtube,0,strrpos($youtube,'/videos')) || substr($youtube,0,strrpos($youtube,'/playlists')) ){
			$youtube = substr($youtube ,0,strrpos($youtube ,'/'));
		}
		// agora verifica novamente
		// echo "URL: ".$youtube . "<br>";
		$headers = @get_headers( $youtube );
		if($headers !== FALSE && strpos($headers[0],'200') !== FALSE){
			// echo "OK";
		}else{
			// echo "nao funciona";
			$ok = "nao";
		}
	}else{
		// echo "E APENAS O NOME DO CANAL(mas agora vai ter o link todo, add o https://www.youtube.com/...)<br>";
		//agora vai ter, primeiro tenta add o restante do link da pessoa com o termo USER
		$youtube = "https://www.youtube.com/user/" . $youtube_vem;
		// caso o link tenha complemento apos o fim do nome do canal, corta
		if ( substr($youtube,0,strrpos($youtube,'/videos')) || substr($youtube,0,strrpos($youtube,'/playlists')) ){
			$youtube = substr($youtube ,0,strrpos($youtube ,'/'));
		}
		//verifica se o link funciona
		$headers = @get_headers( $youtube );
		if($headers !== FALSE && strpos($headers[0],'200') !== FALSE){
			// echo "URL: ".$youtube . "<br>";
			// echo "OK<br>";
		}else{
			// nao funciona(alterar o USER, para CHANNEL..)
			$ok = "nao";
		} //fim se, teste
		// se a tentativa com USER, nao funcionar, alterar para CHANNEL, e tentar novamente
		if($ok == "nao"){
			$youtube = "https://www.youtube.com/channel/" . $youtube_vem;
			// caso o link tenha complemento apos o fim do nome do canal, corta
			if ( substr($youtube,0,strrpos($youtube,'/videos')) || substr($youtube,0,strrpos($youtube,'/playlists')) ){
				$youtube = substr($youtube ,0,strrpos($youtube ,'/'));
			}
			// agora verifica novamente
			// echo "URL: ".$youtube . "<br>";
			$headers = @get_headers( $youtube );
			if($headers !== FALSE && strpos($headers[0],'200') !== FALSE){
				// echo "OK";
			}else{
				// echo "nao funciona";
				$ok = "nao";
			}
		}// fim se tentativa de user ou channel
	}// fim else, se e o link completo
} // fim se, verifica se e link completo, incompleto ou so o nome do canal
// recebe o website
$website = $_POST['website'];
// recebe a playlist
$playlist = $_POST['playlist'];
// var de noticias que vai receber o resultado dos cbs
$noticias;
// script para os cb's
if (empty($noti_app) && empty($noti_email)) {
    $noticias = "1";
}else if (empty($noti_app) && !empty($noti_email)) {
    $noticias = "2";
}else if (!empty($noti_app) && !empty($noti_email)) {
    $noticias = "3";
}else{
    $noticias = "4";
} // fim if noticias

// verificar a conexao, se tudo estiver certo, vai executar a linha e enviar o novo registro, se nao vai informar qual o erro
if ($con) {
// verifica se é um canal valido
if( substr($youtube ,0,strrpos($youtube ,'channel')) || substr($youtube ,0,strrpos($youtube ,'user')) || empty($youtube)){
// verifica se playlist é valida
if( substr($playlist ,0,strrpos($playlist ,'playlist?list')) || empty($playlist)){

// se a senha atual for diferente de vazia, significa q tentou mudar de senha, se a senha nova for diferente da senha nova de novo, entao digitou errado e nao pode mudar a senha, retorna para a pagina com erro
if ( !empty($senha_atual) && ($senha_nova != $senha_nova_dnovo)) {
	header('Location: ../../perfil.php?error=sim&motivo=senhanaoconfere');
// se a senha nova for diferente de vazio, significa q tentou mudar de senha, se a senha nova for igual a senha nova de novo, entao ocorre a mudanca de senha certinho e continua
}else if( !empty($senha_atual) && ($senha_nova == $senha_nova_dnovo)){

	$query_s = mysqli_query($con, "SELECT senha_usu FROM usuario WHERE email_usu='$email' AND senha_usu='$senha_atual'");
	$linha_s = mysqli_fetch_assoc($query_s);
	// se a query funcionar, entao continua, se nao ele digitou a senha errada
	if ($query_s) {
		$verificar = $linha_s['senha_usu'];
		// pega a senha do banco, se for igual a senha digitada continua
	if ($verificar == $senha_atual) {
		// atualiza a senha no banco, com a nova
		$query_pass = mysqli_query($con, "UPDATE usuario set senha_usu='$senha_nova' WHERE email_usu='$email'");
		// salva a nova configuracao
		$query_up = mysqli_query($con, "UPDATE usuario set conta_face='$conta_face', conta_twitter='$conta_twitter', conta_insta='$conta_instagram', canal_yt='$youtube', canal_playlist='$playlist', skip_albun='$albun_a', noticias='$noticias', website='$website', url_persona='$url_persona' WHERE email_usu='$email'");
		// busca o id do usuario
		$query_get_id =  mysqli_query($con,"SELECT id_usu FROM usuario WHERE email_usu='$email' ");
		$linha_get_id = mysqli_fetch_assoc($query_get_id);
		//pega o id e coloca na variavel
		$id_dousu = $linha_get_id['id_usu'];
		// atualiza o soundcloud no usuario_continue
		$query_up_usu_continue = mysqli_query($con, "UPDATE usuario_continue set soundcloud = '$soundcloud' WHERE id_fk_usu_continue = '$id_dousu' ");
		// envia um e-mail de mudança de senha
		if (PHP_VERSION_ID < 50600) {
			iconv_set_encoding('input_encoding', 'UTF-8');
			iconv_set_encoding('output_encoding', 'UTF-8');
			iconv_set_encoding('internal_encoding', 'UTF-8');
		}else{
			ini_set('default_charset', 'UTF-8');
		}
		$headers = "MIME-Version: 1.1\r\n";
		$headers .= "From: QISeventos - <suporte@qiseventos.com.br>\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		('Content-type: text/html; charset=iso-8859-1 \r\n');
		$subject = "Mudança de senha - QISeventos";
		$mensagem1  = "{$email}<br />
		Você acaba de atualizar a sua senha!<br />
		sua nova senha é : {$senha_nova}<br />
		Esta é uma mensagem automática, por favor não responda. Obrigado!<br />
		Caso Você não seja o {$email}, ou não tenha feito a troca de senha, por favor entre em contato <a href='https://qiseventos.com.br/contato-sobrenos.php#us'>AQUI<a/>.";
		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);
		$send_contact=mail($email, $subject, $mensagem1, $headers); 
		// se tudo der certo, sai para relogar com a nova senha
		if ($query_pass && $query_up && $query_up_usu_continue) {
			header('Location: ../../login.php?relogar=sim');
		}else{
			header('Location: ../../perfil.php?error=sim&motivo=erroupdateepassword');
		} // fim se, erro em algum momento das querys
	}else{
		header('Location: ../../perfil.php?error=sim&motivo=senhaerrada');
	} // fim se, verificar senha do banco com a digitada
	}else{
		header('Location: ../../perfil.php?error=sim&motivo=errobuscasenha');
	} // fim se, senha errada, query_s
// se nao, nao houve pedido de nova senha, e continua
}else{
	// salvar a nova configuracao
	$query = mysqli_query($con, "UPDATE usuario set conta_face='$conta_face', conta_twitter='$conta_twitter', conta_insta='$conta_instagram', canal_yt='$youtube', canal_playlist='$playlist', skip_albun='$albun_a', noticias='$noticias', website='$website', url_persona='$url_persona' WHERE email_usu='$email'");
	// busca o id do usuario
	$query_get_id =  mysqli_query($con,"SELECT id_usu FROM usuario WHERE email_usu='$email' ");
	$linha_get_id = mysqli_fetch_assoc($query_get_id);
	//coloca o id na variavel
	$id_dousu = $linha_get_id['id_usu'];
	// atualiza o soundcloud do usuario, no usuario_continue
	$query_up_usu_continue = mysqli_query($con, "UPDATE usuario_continue set soundcloud = '$soundcloud' WHERE id_fk_usu_continue = '$id_dousu' ");
	// se a atualizacao der certo, continua
	if ($query) {
		header('Location: ../../perfil.php');
	}else{
		$erro = mysqli_error($con);
		//email da qis
		$from = "suporte@qiseventos.com.br";
		// envia um e-mail informando o erro
		if (PHP_VERSION_ID < 50600) {
			iconv_set_encoding('input_encoding', 'UTF-8');
			iconv_set_encoding('output_encoding', 'UTF-8');
			iconv_set_encoding('internal_encoding', 'UTF-8');
		}else{
			ini_set('default_charset', 'UTF-8');
		}
		$headers = "MIME-Version: 1.1\r\n";
		$headers .= "From: QIS@scripts_interno\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		('Content-type: text/html; charset=iso-8859-1 \r\n');
		$subject = "[QIS] CONFIGURACAO";
		$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE UPDATE QUERY CONFIGURACAO DO USUARIO<br />
		ERRO: {$erro}";
		$subject = utf8_decode($subject);
		$mensagem1 = utf8_decode($mensagem1);
		$send_contact=mail($from, $subject, $mensagem1, $headers);
		('Location: ../../perfil.php?error=sim&motivo=erroupdate');
	} // fim se erro ao salvar config
} // fim se, salvar config sem mudar a senha
}else{
	header('Location: ../../perfil.php?error=sim&motivo=playlistyt');
}// fim se verifica playlist
}else{
	header('Location: ../../perfil.php?error=sim&motivo=canalyt');
}// fim se verifica canal
// else con
}else{

	$erro = mysqli_error($con);
	//email da qis
	$from = "suporte@qiseventos.com.br";
	// envia um e-mail informando o erro
	if (PHP_VERSION_ID < 50600) {
		iconv_set_encoding('input_encoding', 'UTF-8');
		iconv_set_encoding('output_encoding', 'UTF-8');
		iconv_set_encoding('internal_encoding', 'UTF-8');
	}else{
		ini_set('default_charset', 'UTF-8');
	}
	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "From: QIS@scripts_interno\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
	('Content-type: text/html; charset=iso-8859-1 \r\n');
	$subject = "[QIS] SALVAR CONFIGURACAO";
	$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE CONFIGURACAO DO USUARIO<br />
	ERRO: {$erro}";
	$subject = utf8_decode($subject);
	$mensagem1 = utf8_decode($mensagem1);
	$send_contact=mail($from, $subject, $mensagem1, $headers);
	header('Location: ../../perfil.php?error=sim&motivo=errodatabase');
} // fim se conexao
?>