<?php
$lifetime = 3600 * 240000; // Defini para 10000 Dias
header("Cache-Control: max-age=$lifetime");
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', $lifetime);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params($lifetime);
session_start();

//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';
// php detectar dispositivo
include_once 'assets/php/Mobile_Detect.php';

// verifica se cookie esta vazio com o nome da cidade e estado
if ( empty( $_COOKIE['estadoprop'] ) && empty( $_COOKIE['cidadeprop'] ) ) {
	// verifica se o post esta vazio, se sim vai receber all em estado e cidade 
	if ( empty( $_POST['estado'] ) && empty( $_POST['cidade'] ) ) {
		setcookie('estadoprop',"all",time()+$lifetime);
		setcookie('cidadeprop',"all",time()+$lifetime);
		$estado_prop = "all";
		$cidade_prop = "all";
	}else{
		// recebe o estado e cidade do index
		setcookie('estadoprop',$_POST['estado'],time()+$lifetime);
		setcookie('cidadeprop',$_POST['cidade'],time()+$lifetime);
		$estado_prop = $_POST['estado'];
		$cidade_prop = $_POST['cidade'];
	}
}else{
	//verifica se o post esta vazio, se veio de outro lugar se nao o index, se sim recebe o estado e cidade do cookie, e atualiza o dado no cookie
	if ( empty( $_POST['estado'] ) ) {
		setcookie('estadoprop',$_COOKIE['estadoprop'],time()+$lifetime);
		setcookie('cidadeprop',$_COOKIE['cidadeprop'],time()+$lifetime);
		$estado_prop = $_COOKIE['estadoprop'];
		$cidade_prop = $_COOKIE['cidadeprop'];
	}else{
		setcookie('estadoprop',$_POST['estado'],time()+$lifetime);
		setcookie('cidadeprop',$_POST['cidade'],time()+$lifetime);
		$estado_prop = $_POST['estado'];
		$cidade_prop = $_POST['cidade'];
	}
}
// inicia script verifica se e mobile
$detect = new Mobile_Detect;

// info
/* o nome das query's é composto por : o nome da página_propaganda_local */
// pegar o dia atual para pesquisar nas querys
$hoje = date("Y") . "-" . date("m") . "-" . date("d");

// ------------------------------- pagina inicio -----------------------------

// QUERY PROPAGANDA - SLIDE PRINCIPAL
$i = 0; //contador para o slide inicio
$in_prop_slide = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda1,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao1 = 'in_slidetop' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 5");
// localizacao
$local1 = "in_slidetop";

// QUERY PROPAGANDA - LATERAL 1
$in_prop_lat1 = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda2,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao2 like '%in_lat1%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
$row_in_prop_lat1 = mysqli_fetch_assoc($in_prop_lat1);
// localizacao
$local2 = "in_lat1";

// QUERY PROPAGANDA - LATERAL 2
$in_prop_lat2 = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda2,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao2 like '%in_lat2%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
$row_in_prop_lat2 = mysqli_fetch_assoc($in_prop_lat2);
// localizacao
$local3 = "in_lat2";

// QUERY PROPAGANDA - LATERAL 3
$in_prop_lat3 = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda3,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao3 = 'in_lat3' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
$row_in_prop_lat3 = mysqli_fetch_assoc($in_prop_lat3);
// localizacao
$local4 = "in_lat3";

// QUERY PROPAGANDA - SLIDE RODAPÉ
$in_prop_sliderodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda4,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao4 = 'in_slidebot' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 29");
 // localizacao
$local5 = "in_slidebot";

// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - RODAPÉ MOBILE
	$in_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%in_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$local6 = "in_rodape";
	$row_in_prop_rodape = mysqli_fetch_assoc($in_prop_rodape);

	$id_prop_5_noum = $row_in_prop_rodape['id_propaganda'];
	$img_prop_5_noum = $row_in_prop_rodape['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - RODAPÉ
	$in_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%in_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$local6 = "in_rodape";	
	$row_in_prop_rodape = mysqli_fetch_assoc($in_prop_rodape);

	$id_prop_5_noum = $row_in_prop_rodape['id_propaganda'];
	$img_prop_5_noum = $row_in_prop_rodape['imagem_propaganda5'];

}

// ------------------------------- pagina ajuda -----------------------------

// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - RODAPÉ MOBILE
	$aj_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%aj_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$aj_local6 = "aj_rodape";
	$row_aj_prop_rodape = mysqli_fetch_assoc($aj_prop_rodape);

	$aj_id_prop_5_noum = $row_aj_prop_rodape['id_propaganda'];
	$aj_img_prop_5_noum = $row_aj_prop_rodape['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - RODAPÉ
	$aj_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%aj_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$aj_local6 = "aj_rodape";	
	$row_aj_prop_rodape = mysqli_fetch_assoc($aj_prop_rodape);

	$aj_id_prop_5_noum = $row_aj_prop_rodape['id_propaganda'];
	$aj_img_prop_5_noum = $row_aj_prop_rodape['imagem_propaganda5'];

}

// ------------------------------- pagina anuncio -----------------------------

// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - TOP MOBILE
	$an_prop_top = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%an_top%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$an_top_local6 = "an_top";
	$row_an_prop_top = mysqli_fetch_assoc($an_prop_top);

	$an_top_id_prop_5_noum = $row_an_prop_top['id_propaganda'];
	$an_top_img_prop_5_noum = $row_an_prop_top['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - TOP
	$an_prop_top = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%an_top%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$an_top_local6 = "an_top";
	$row_an_prop_top = mysqli_fetch_assoc($an_prop_top);

	$an_top_id_prop_5_noum = $row_an_prop_top['id_propaganda'];
	$an_top_img_prop_5_noum = $row_an_prop_top['imagem_propaganda5'];

}


// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - MID MOBILE
	$an_prop_mid = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%an_mid%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$an_mid_local6 = "an_mid";
	$row_an_prop_mid = mysqli_fetch_assoc($an_prop_mid);

	$an_mid_id_prop_5_noum = $row_an_prop_mid['id_propaganda'];
	$an_mid_img_prop_5_noum = $row_an_prop_mid['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - MID
	$an_prop_mid = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%an_mid%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$an_mid_local6 = "an_mid";
	$row_an_prop_mid = mysqli_fetch_assoc($an_prop_mid);

	$an_mid_id_prop_5_noum = $row_an_prop_mid['id_propaganda'];
	$an_mid_img_prop_5_noum = $row_an_prop_mid['imagem_propaganda5'];

}


// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - RODAPÉ MOBILE
	$an_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%an_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$an_local6 = "an_rodape";
	$row_an_prop_rodape = mysqli_fetch_assoc($an_prop_rodape);

	$an_id_prop_5_noum = $row_an_prop_rodape['id_propaganda'];
	$an_img_prop_5_noum = $row_an_prop_rodape['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - RODAPÉ
	$an_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%an_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$an_local6 = "an_rodape";
	$row_an_prop_rodape = mysqli_fetch_assoc($an_prop_rodape);

	$an_id_prop_5_noum = $row_an_prop_rodape['id_propaganda'];
	$an_img_prop_5_noum = $row_an_prop_rodape['imagem_propaganda5'];

}

// ------------------------------- pagina contato sobre -----------------------------


// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - MID MOBILE
	$cs_prop_mid = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%cs_mid%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$cs_mid_local6 = "cs_mid";
	$row_cs_prop_mid = mysqli_fetch_assoc($cs_prop_mid);

	$cs_mid_id_prop_5_noum = $row_cs_prop_mid['id_propaganda'];
	$cs_mid_img_prop_5_noum = $row_cs_prop_mid['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - MID
	$cs_prop_mid = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%cs_mid%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$cs_mid_local6 = "cs_mid";
	$row_cs_prop_mid = mysqli_fetch_assoc($cs_prop_mid);

	$cs_mid_id_prop_5_noum = $row_cs_prop_mid['id_propaganda'];
	$cs_mid_img_prop_5_noum = $row_cs_prop_mid['imagem_propaganda5'];

}

// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - RODAPÉ MOBILE
	$cs_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%cs_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$cs_local6 = "cs_rodape";
	$row_cs_prop_rodape = mysqli_fetch_assoc($cs_prop_rodape);

	$cs_id_prop_5_noum = $row_cs_prop_rodape['id_propaganda'];
	$cs_img_prop_5_noum = $row_cs_prop_rodape['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - RODAPÉ
	$cs_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%cs_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$cs_local6 = "cs_rodape";
	$row_cs_prop_rodape = mysqli_fetch_assoc($cs_prop_rodape);

	$cs_id_prop_5_noum = $row_cs_prop_rodape['id_propaganda'];
	$cs_img_prop_5_noum = $row_cs_prop_rodape['imagem_propaganda5'];

}

// ------------------------------- pagina perfil -----------------------------

// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - RODAPÉ MOBILE
	$pe_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%pe_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$pe_local6 = "pe_rodape";
	$row_pe_prop_rodape = mysqli_fetch_assoc($pe_prop_rodape);

	$pe_id_prop_5_noum = $row_pe_prop_rodape['id_propaganda'];
	$pe_img_prop_5_noum = $row_pe_prop_rodape['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - RODAPÉ
	$pe_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%pe_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$pe_local6 = "pe_rodape";
	$row_pe_prop_rodape = mysqli_fetch_assoc($pe_prop_rodape);

	$pe_id_prop_5_noum = $row_pe_prop_rodape['id_propaganda'];
	$pe_img_prop_5_noum = $row_pe_prop_rodape['imagem_propaganda5'];

}

// ------------------------------- pagina premium -----------------------------

// SE FOR UM DISPOSITIVO MOVEL/MOBILE/CELULAR usar a query para pegar a imagem 5 versao mobile, se nao SE FOR PC/TABLET/DESKTOP buscar na query imagem 5 normal
if ( $detect->isMobile() ) {

	// QUERY PROPAGANDA - RODAPÉ MOBILE
	$pr_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5m,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%pr_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$pr_local6 = "pr_rodape";
	$row_pr_prop_rodape = mysqli_fetch_assoc($pr_prop_rodape);

	$pr_id_prop_5_noum = $row_pr_prop_rodape['id_propaganda'];
	$pr_img_prop_5_noum = $row_pr_prop_rodape['imagem_propaganda5m'];

}else{

	// QUERY PROPAGANDA - RODAPÉ
	$pr_prop_rodape = mysqli_query($con,"SELECT id_propaganda,imagem_propaganda5,url_redi FROM propaganda WHERE (  dt_inicio <= '$hoje' AND dt_fim >= '$hoje' ) AND localizacao5 like '%pr_rodape%' AND ativo = 1 AND ( estado = '$estado_prop' OR estado = 'all' ) AND ( cidade = '$cidade_prop' OR cidade = 'all' ) ORDER BY rand() LIMIT 1");
	// localizacao
	$pr_local6 = "pr_rodape";
	$row_pr_prop_rodape = mysqli_fetch_assoc($pr_prop_rodape);

	$pr_id_prop_5_noum = $row_pr_prop_rodape['id_propaganda'];
	$pr_img_prop_5_noum = $row_pr_prop_rodape['imagem_propaganda5'];

}
?>