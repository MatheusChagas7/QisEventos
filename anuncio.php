<?php
//fara a conexao com banco de dados
// include_once 'assets/php/conexao.php';
// propagandas
// include_once 'assets/php/propaganda.php';
// visualizacao de propaganda
// include_once 'assets/php/visu_prop.php';

// recupero a url_persona do usuario
$url = $_GET['url'];
// include_once 'assets/php/numeroacesso.php';
	// impede erros de NOTICE a aparecer na page, pois caso as variaveis estejam vazias dera erro(notice)
	error_reporting(0);
//chama a cache, para verificar o cache se esta logado
// include_once 'assets/php/cache.php';
// $ratiado = filter_input(INPUT_GET, "ratiado");
// via PHP, pegar o numero de likes total da página
$acesso = "677876605734655|1faeae194ea889f6f90736e864215da9"; //api da aplicacao | app secret
$json = file_get_contents('https://graph.facebook.com/v2.10/qiseventos?fields=fan_count&access_token='.$acesso);
$obj = json_decode($json);
$numero = $obj->fan_count;
$compt = rand(10,100);
//pega a URL
$sitev = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//retira qualquer coisa apos o "?", add pelo plugin do facebook
if (strpos($sitev,'?') !== false) {
	$site = substr($sitev,0,strrpos($sitev,'?'));
}else if(strpos($sitev,'#') !== false){
	$site = substr($sitev,0,strrpos($sitev,'#'));
}else{
	$site = $sitev;
}
// saber o ID do usuario facebook via name
function get_id_facebook_user($acessot,$fbname){

	$facebook_g_url1 = "https://graph.facebook.com/".$fbname."?access_token=".$acessot;
	$get_fb_json_content1 = @file_get_contents($facebook_g_url1,true);
	$decode_fb_json_content1 = json_decode($get_fb_json_content1);
	if ( $decode_fb_json_content1->id ) {
		return $decode_fb_json_content1->id;
	}else{
		return "";
	}
}
// saber se o perfil do cara é pagina ou perfil - facebook
function get_type_facebook_id_by_devildoxx($acesstoken,$fbid){

	$facebook_g_url = "https://graph.facebook.com/".$fbid."?access_token=".$acesstoken."&metadata=1";
	$get_fb_json_content = file_get_contents($facebook_g_url,true);
	$decode_fb_json_content = json_decode($get_fb_json_content);
	return $decode_fb_json_content->metadata->type;
}

// recupera do banco as info do usuario
$query = mysqli_query($con,"SELECT id_usu,nome_completo,pacote_usu,foto_perfil,foto_capa,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,sobre_usu,descricao,n_acesso,rating,numero_1,numero_2,numero_3,email_contato,canal_yt,canal_playlist,conta_insta,conta_face,skip_albun,conta_twitter,website FROM usuario WHERE url_persona='$url'");
$linha_usu = mysqli_fetch_assoc($query);

$id_fav = $linha_usu['id_usu'];
//query buscar tudo no usuario continue
$query_usu_continue =  mysqli_query($con,"SELECT soundcloud FROM usuario_continue WHERE id_fk_usu_continue = '$id_fav'");
$linha_usu_continue = mysqli_fetch_assoc($query_usu_continue);

$nome = $linha_usu['nome_completo'];
$categoria1_fk = $linha_usu['fk_categoria1_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat1 =  mysqli_query($con,"SELECT nome_categoria,nome_sub_categoria FROM categoria WHERE id_categoria = '$categoria1_fk'");
	$linha_cat1 = mysqli_fetch_assoc($query_cat1);
	$categoria_sub_1 = $linha_cat1['nome_sub_categoria'];
	$categoria_nome_1 = $linha_cat1['nome_categoria'];
// 
$categoria2_fk = $linha_usu['fk_categoria2_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat2 =  mysqli_query($con,"SELECT nome_categoria,nome_sub_categoria FROM categoria WHERE id_categoria = '$categoria2_fk'");
	$linha_cat2 = mysqli_fetch_assoc($query_cat2);
	$categoria_sub_2 = $linha_cat2['nome_sub_categoria'];
	$categoria_nome_2 = $linha_cat2['nome_categoria'];
// 
$categoria3_fk = $linha_usu['fk_categoria3_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat3 =  mysqli_query($con,"SELECT nome_categoria,nome_sub_categoria FROM categoria WHERE id_categoria = '$categoria3_fk'");
	$linha_cat3 = mysqli_fetch_assoc($query_cat3);
	$categoria_sub_3 = $linha_cat3['nome_sub_categoria'];
	$categoria_nome_3 = $linha_cat3['nome_categoria'];
//
$pacote_anunciante = $linha_usu['pacote_usu'];
// verifica o valor do pacote para colocar o limit em seu sobre
switch ($pacote_anunciante) {
	case 0:
		$limit_sobre = 300;
		break;
	case 1:
		$limit_sobre = 600;
		break;
}
$foto_perfil_anunciante = $linha_usu['foto_perfil'];
$foto_capa_anunciante = $linha_usu['foto_capa'];
$sobre = $linha_usu['sobre_usu'];
$descricao = $linha_usu['descricao'];
$rating = $linha_usu['rating'];
if (empty($rating)) { $rating = "0"; } else{
$rating = $linha_usu['rating'];
}
$numero1 = $linha_usu['numero_1'];
if (substr($numero1 ,0,strrpos($numero1 ,'0000'))) {
	$numero1 = null;
}
$numero2 = $linha_usu['numero_2'];
$numero3 = $linha_usu['numero_3'];
$email_contato = $linha_usu['email_contato'];
$inverte = strrev($email_contato);
if (substr($inverte ,0,strrpos($inverte ,'otatnocedliame'))) {
	$email_contato = null;
}
// verificar o pacote e ver qual rede social permite
switch ($pacote_anunciante) {
	case 0: // gratis
		// ------ FACEBOOK ------ //
		$facebook = $linha_usu['conta_face'];
		$skipalbun = $linha_usu['skip_albun'];
		// pega o resultado do banco sobre os albuns
		$arr = explode(',', $skipalbun); // transforma a string em array.
		// array qye vai receber o resultado logo mais.
		$arrN = array();
		// pego o array, corta e quebra
		foreach($arr as $item){
		$valor = explode(',', $item); // quebra o elemento atual em um array com duas posições,
		//onde o indice zero é a chave e o um o valor em $arrN
		$arrN[$valor[0]] = $valor[0];
		}

		// pega o id
		$id_facebook = get_id_facebook_user($acesso,$facebook);
		// pega se é perfil ou pagina
		if ($id_facebook) {
		$ref_facebook_user = get_type_facebook_id_by_devildoxx($acesso,$id_facebook);
		}
		// ------ FACEBOOK ------ //
		break;
	case 1: // premium
		// ------ INSTAGRAM ------ //
		$instagram = $linha_usu['conta_insta'];
		// ------ INSTAGRAM ------ //
		// ------ FACEBOOK ------ //
		$facebook = $linha_usu['conta_face'];
		$skipalbun = $linha_usu['skip_albun'];
		// pega o resultado do banco sobre os albuns
		$arr = explode(',', $skipalbun); // transforma a string em array.
		// array qye vai receber o resultado logo mais.
		$arrN = array();
		// pego o array, corta e quebra
		foreach($arr as $item){
		$valor = explode(',', $item); // quebra o elemento atual em um array com duas posições,
		//onde o indice zero é a chave e o um o valor em $arrN
		$arrN[$valor[0]] = $valor[0];
		}

		// pega o id
		$id_facebook = get_id_facebook_user($acesso,$facebook);
		// pega se é perfil ou pagina
		if ($id_facebook) {
		$ref_facebook_user = get_type_facebook_id_by_devildoxx($acesso,$id_facebook);
		}
		// ------ FACEBOOK ------ //
		break;
	case 2: // master
		// ------ YT ------ //
		$canal = $linha_usu['canal_yt'];
		$playlist = $linha_usu['canal_playlist'];
		// ------ YT ------ //
		// ------ SOUNDCLOUD ------ //
		$soundcloud = $linha_usu_continue['soundcloud'];
		// ------ SOUNDCLOUD ------ //
		// ------ INSTAGRAM ------ //
		$instagram = $linha_usu['conta_insta'];
		// ------ INSTAGRAM ------ //
		// ------ FACEBOOK ------ //
		$facebook = $linha_usu['conta_face'];
		$skipalbun = $linha_usu['skip_albun'];
		// pega o resultado do banco sobre os albuns
		$arr = explode(',', $skipalbun); // transforma a string em array.
		// array qye vai receber o resultado logo mais.
		$arrN = array();
		// pego o array, corta e quebra
		foreach($arr as $item){
		$valor = explode(',', $item); // quebra o elemento atual em um array com duas posições,
		//onde o indice zero é a chave e o um o valor em $arrN
		$arrN[$valor[0]] = $valor[0];
		}

		// pega o id
		$id_facebook = get_id_facebook_user($acesso,$facebook);
		// pega se é perfil ou pagina
		if ($id_facebook) {
		$ref_facebook_user = get_type_facebook_id_by_devildoxx($acesso,$id_facebook);
		}
		// ------ FACEBOOK ------ //
		break;
}

$twitter = $linha_usu['conta_twitter'];
$website_vem = $linha_usu['website'];
// se o website tiver com http.., entao retira
if ( substr($website_vem ,0,strrpos($website_vem ,'//')) ) {
	$website_inv = strrev($website_vem);
	$website_quase = substr($website_inv ,0,strrpos($website_inv ,'//'));
	$website = strrev($website_quase);
}else{
	$website = $website_vem;
}

// se a pessoa estiver logada, buscar se o cliente esta em seus favoritos
if($lvl >= 2){
$query_fav = mysqli_query($con,"SELECT id_fk_usu FROM favoritos WHERE id_fk_cliente ='$id_log' AND id_fk_usu='$id_fav'");
$linha_fav = mysqli_fetch_assoc($query_fav);
$id_ja_fav = $linha_fav['id_fk_usu'];
}

?>
<!doctype html>
<html lang="pt-br">
<head>
	<title><?php echo $nome ?></title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/<?php echo $url ?>">
	<meta property="og:title" content="<?php echo $nome ?>">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="<?php echo $descricao ?>">
	<meta property="og:image" content="https://www.qiseventos.com.br<?php echo $foto_perfil ?>";>
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br<?php echo $foto_perfil ?>";>
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="150"> <!-- pixel -->
	<meta property="og:image:height" content="150"> <!-- pixel -->
	<meta name="description" content="<?php echo $descricao ?>">
	<!-- /** CASO SEJA UM SITE NORMAL **/ -->
	<meta property="og:type" content="website">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="QISeventos">
	<link rel="apple-touch-icon-precomposed" href="assets/img/apple-icon.png">
	<!-- A2HS -->
	<link rel="stylesheet" type="text/css" href="assets/css/addtohomescreen.css">
	<script src="assets/js/addtohomescreen.js"></script>
	<!-- manifest / sw-->
	<link rel="manifest" href="assets/js/manifest.json">
	<script src="service-worker.js" type="text/javascript"></script>
	<!-- Fonts and icons  -->
	<link href="assets/css/font_material_icons.css" rel="stylesheet" />
	<link href="assets/css/font_roboto.css" rel="stylesheet" />
	<link href="assets/css/bootstrap_font.css" rel="stylesheet" />
	<!-- CSS Files -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<!-- esse bootstrap é especialmente para o rating star --> 
	<link href="assets/css/bootstrap_rating.css" rel="stylesheet" />
	<link href="assets/css/material-kit.min.css" rel="stylesheet"/>
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/sass/material-kit/_example-pages.scss" rel="stylesheet" type="text/html"/>
	<!-- rating star -->
	<link href="assets/css/star-rating.min.css" rel="stylesheet" />
	<!-- css plugin foto facebook -->
	<link href="assets/css/plugin-album-facebook.min.css" rel="stylesheet" />
	<!-- css ligthbox insta -->
	<link href="assets/css/lightbox.min.css" rel="stylesheet" />
	<!-- youmax youtube plugin -->
	<link href="assets/css/youmax.min.css" rel="stylesheet" type="text/css"/>
	<?php if(!empty($soundcloud)){ ?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.0.min.js" type="text/javascript"></script>
	<!--SOUNDCLOUD API -->
	<script type="text/javascript" src="https://w.soundcloud.com/player/api.js"></script>
	<!-- PLAYER JAVASCRIPT -->
	<script type="text/javascript" src="assets/js/jquery.nouisliderplayer.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.nouisliderplayer2.min.js"></script>
	<script type="text/javascript" src="assets/js/player.js"></script>
	<!--- CSS FILE PLAYER -->
    <link rel="stylesheet" href="assets/css/player.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/nouisliderplayer.css" />
	<?php } ?>
	<!-- plugin lock midia social -->
	<link type="text/css" rel="stylesheet" href="assets/css/pandalocker.2.1.0.min.css">
	<!-- estilo interno -->
	<style type="text/css">
		footer {
		position: relative;
		bottom: 0;
		padding: 0 0 0 0;
		}
		.btn-perfil{
		clear: both;
		position: relative;
		float: right;
		margin-top: 50px;
		}
		.estrelas input[type=radio] {
		display: none;
		}
		.estrelas label i.fa:before {
		content:'\f005';
		color: #FC0;
		}
		.estrelas input[type=radio]:checked ~ label i.fa:before {
		color: #CCC;
		}
		@media (max-width: 991px){
		.conteudotab{
		margin-left: 13%;
		}
		}
		.photoI {
  		display: inline-block;
  		width: 25%;
  		height: 0;
  		padding-bottom: 25%;
  		margin-left:5px;
  		background: #eee 50% 50% no-repeat;
  		background-size: cover;
		}
		.photo, .fb-album, .fb-photo {
  		display: inline-block!important;
  		width: 25%!important;
  		height: 0!important;
  		padding-bottom: 25%!important;
  		margin-left:5px!important;
		}		
		.legenda{
		display: none
		}
		.linha{
		height: 1em;
		border-bottom: 1px solid #FF8C00;
		}
		#your-page-column {
		width: 70%;
		margin: 0px auto;
		text-align: center;
		}
		.wrap{
		white-space: pre-wrap;      /* CSS3 */
		white-space: -moz-pre-wrap; /* Firefox */
		white-space: -pre-wrap;     /* Opera <7 */
		white-space: -o-pre-wrap;   /* Opera 7 */
		word-wrap: break-word;      /* IE */
		}
		#notfound{
		left: 50%;
		margin-left: -152.5px; /* A metade de sua largura. */
		position: relative;
		width: 305px; /* O valor que você desejar. */  
	  	margin-top: 10px;
		}
		.btn-fav-anuncio{
	    background-color: transparent;
    	color: #ff7700;
    	/*box-shadow: none;*/
		border-radius: 370px;
		}
		<?php if($pacote_anunciante == 1){ ?>
		.borda{
	    border: 5px solid #BCC6CC;
	    border-radius: 6px;
	    box-shadow: 0px 0px 30px #BCC6CC!important;
		}
		<?php }else if($pacote_anunciante == 2){ ?>
		.borda{
	    border: 5px solid #D4AF37;
	    border-radius: 6px;
	    box-shadow: 0px 0px 30px #D4AF37!important;
		}			
		<?php } ?>
	</style>
<!-- google ads -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113358016-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113358016-1');
</script>
	
</head>
<!-- as estrelinhas, 1 - ruim, 2 - insatisfatória, 3 - regular, 4 - boa, 5 - excelente -->
<body id="b_n" class="profile-page" style="margin-bottom: 45px;">
	<!-- notificacao em primeiro plano/alert -->
	<?php include 'assets/php/notificacao-alert.php';?>	
	<div id="fb-root"></div>
	<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	    <!-- notificação -->
	    	<?php 
	    	if($lvl >= 2){
	    	echo"
			<a href='#' class='navbar-toggle n-notification-a' data-toggle='modal' data-target='#Modalnoti' style='margin-top: 4px;' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
			<span id='n-notification' class='n-notification'></span>
			<i class='material-icons' style='color: #fff;'>notifications</i>
			</a>";
			}
			?>		
	    <!-- foto do usuario msm coisa com o nome -->	                
	    <?php
	    if ($lvl == "1") {
	    echo "<div class='logo-container'>
	          <div class='logo' style='border:none;border-radius:0;'>	                	
	          <a href='index.html' alt='login qiseventos' rel='tooltip' title='<b>Entre</b> e busque o melhor conteudo para seu <b>evento</b>' data-placement='bottom' data-html='true'><img src='assets/img/favicon_negativo.png'></a>";
	    }else{
	    if(empty($foto_perfil)){
	    echo "<div class='logo-container'>
	          <div class='logo'>
	          <a href='perfil.php'><img src='assets/img/account.jpg' alt='entrar no perfil' rel='tooltip' title='<b>Perfil</b>' data-placement='bottom' data-html='true'></a>";
	    }else{
	    echo "<div class='logo-container'>
	          <div class='logo'>
	          <a href='perfil.php'><img src='".$foto_perfil."' alt='entrar no perfil' rel='tooltip' title='<b>Perfil</b>' data-placement='bottom' data-html='true'></a>";
	    }
	    }
	    ?>    
	    </div>
	    <!-- fim div logo -->
	    <div class="brand">
	    <!-- nome do usuario caso logado, se nao vai para o login, com o link para login ou perfil -->
		<?php
	    if ($lvl == "1") {
        }else{
       	echo "
		<a class='log-cor' href='perfil.php'>".$nome_log."</a>                	
       	";
        }
		?>
		</div>
		<!-- fim div brand -->
	</div>
	<!-- fim div container -->
	</div>
	<!-- fim div logo-container -->
	<div class="collapse navbar-collapse" id="navigation-example">
		<!-- a partir daqui é o menu que varia -->
		<?php 
		include 'assets/php/menus.php';
		?>
		<!-- termino do menu variavel -->
	</div>
	</div>
	</nav>
<div class="wrapper">
	<div class="header header-filter" style="background-image: url('<?php echo $foto_capa_anunciante ?>'); background-size: cover;"></div>
	<div class="main main-raised">		
	<div class="profile-content borda">
	<?php 
	if (mysqli_num_rows($query) == 0) {
		echo "<h2 class='text-center'>Este usuário não existe :(</h2><br>
			<h4 class='text-center'><a href='index.html'>Volte</a> e verifique se o nome do usuario está certo</h4><br>
			<img id='notfound' src='assets/img/notfound.png'/>";
		echo "<div style='display:none;'>";
	}
	?>			
	<div class="container">
	<div class="row">
	<div class="profile">
	<div class="avatar">
	<!-- recebera a imagem vindo do bd via php -->
	<?php if(!empty($foto_perfil_anunciante)){ ?>
	<img src="<?php echo $foto_perfil_anunciante ?>" alt="Foto do cliente" class="img-circle img-raised">
	<?php }else{ ?>
	<img src="assets/img/account.jpg" alt="Foto do cliente" class="img-circle img-raised">
	<?php } ?>
	</div>
	<!-- fim avatar -->
	<!-- botao de denuncia -->
	<?php if($lvl >= 2){ ?>
	<button rel='tooltip' data-toggle='modal' data-target='#modaldenuncia' title='Denunciar este usuario ?' data-html='true' data-placement='top' class="btn btn-primary btn-fav btn-fav-anuncio pull-left" id="btn_fav" style="padding-left: 15px;padding-right: 15px;">
	Denuncie
	</button>
	<?php }else{ ?>
	<a href="login.php" rel='tooltip' title='Denunciar este usuario ?' data-html='true' data-placement='top' class="btn btn-primary btn-fav btn-fav-anuncio pull-left" id="btn_fav" style="padding-left: 15px;padding-right: 15px;">
	Denuncie
	</a>	
	<?php } ?>
	<!-- btn para favoritar -->
	<?php if($lvl >= 2){ ?>
	<?php if($id_ja_fav == $id_fav){?>
	<button rel='tooltip' title='Não seguir mais' data-html='true' data-placement='top' class="btn btn-primary btn-fav btn-fav-anuncio" id="btn_fav" onclick="removeFav(<?php echo $id_fav ?>,<?php echo $id_log ?>)">
	<i class="material-icons favorito" id="i_fav">favorite</i>
	<?php }else{ ?>
	<button rel='tooltip' title='Gostou? siga para ter sempre informações!' data-html='true' data-placement='top' class="btn btn-primary btn-fav btn-fav-anuncio" id="btn_fav" onclick="addFav(<?php echo $id_fav ?>,<?php echo $id_log ?>)">
	<i class="material-icons favorito" id="i_fav">favorite_border</i>
	<?php } ?>
	</button>
	<?php }else{ ?>
	<a href="login.php" rel='tooltip' title='Gostou? siga para ter sempre informações dele!' data-html='true' data-placement='top' class="btn btn-primary btn-fav btn-fav-anuncio" id="btn_fav">
	<i class="material-icons favorito">favorite_border</i>
	</a>
	<?php } ?>
	<div class="name">
	<!-- notificacao de SEGUINDO -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-info' id='info_fav'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close' id="fechar_info_fav" onclick="sumir()">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>SEGUINDO</b>
	</div>
	</div>
	<!-- notificacao de DEIXOU DE SEGUIR -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-danger' id='info_fav_un'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close' id="fechar_info_fav_un" onclick="sumir_un()">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>DEIXOU DE SEGUIR</b>
	</div>
	</div>	
	<!-- *********************************** -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>FEITO</b>
	</div>
	</div>
	<!-- recebera o nome vindo do bd via php -->
	<h3 class="title"><?php echo $nome ?>
		<?php
		if ($pacote_anunciante == 1) {
		echo "<i rel='tooltip' title='Premium' data-html='true' data-placement='top'><img class='pacote_p' src='assets/img/premium.png'></i>";
		}else if($pacote_anunciante == 2){
		echo "<i rel='tooltip' title='Master' data-html='true' data-placement='top'><img class='pacote_m' src='assets/img/master.png'></i>";
		}
		?>		
	</h3>
	<?php if ($lvl == 1) {
		$ranquearlogado = "rel='tooltip' title='<b>Entre</b> para poder <b>classificar</b>' data-html='true' data-placement='top' disabled";
	} ?>	
	<div class="estrelas" <?php echo $ranquearlogado ?>>
	<!-- rate-->
    <input id="input-21f" name="rate" <?php echo $ranquearlogado ?> type="submit" data-min=0 data-max=5 data-step=0.1 data-size="md" title="" value="<?php echo $rating ?>">
	</div>
	<!-- fim estrelas -->
	<!-- recebera a profissao vindo do bd via php -->
	<?php
	if (!empty($categoria_sub_1)) {
	echo "
	<h6>".$categoria_sub_1." (".$categoria_nome_1.") </h6>";
	}
	if (!empty($categoria_sub_2)) {
	echo "
	<h6>".$categoria_sub_2." (".$categoria_nome_2.") </h6>";
	}
	if (!empty($categoria_sub_3)) {
	echo "
	<h6>".$categoria_sub_3." (".$categoria_nome_3.") </h6>";
	}
	?>
	</div>
	<!-- fim name -->
	</div>
	<!-- fim profile -->
	</div>
	<!-- fim row -->
	<?php
	if (!empty($descricao)) {
	?>
	<div class="description text-center wrap" style="margin: 0px auto 0px;">
	<!-- recebera a descricao vindo do bd via php -->
	<p><?php echo $descricao ?></p>
	</div>
	<?php } ?>
	<!-- fim div description text-center -->
	<?php
	if (!empty($descricao) && !empty($sobre)) {
	?>
	<!-- linha divisoria -->
	<div class="linha"></div>
	<?php } ?>
	<?php
	if (!empty($sobre)) {
	?>	
	<div class="description text-center wrap" style="font-size: 16px;max-width: 100%; margin: 0px auto 0px;">
	<!-- recebera a descricao vindo do bd via php -->
	<?php if ($pacote_anunciante == 2) { ?>
	<p><?php echo $sobre; ?></p>
	<?php }else{ ?>
	<p><?php echo substr($sobre,0,$limit_sobre); ?></p>	
	<?php } ?>
	</div>
	<?php } ?>

<?php if($pacote_anunciante <= 1){ ?>
	<div class="adsfooter col-md-12 col-sm-offset-2">
	<!-- anuncio-retangular-footer -->
	<?php if (mysqli_num_rows($an_prop_top) == 0) { ?>
	<div class="adsfgoogle">
	<!-- qis3 -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:728px;height:90px"
	     data-ad-client="ca-pub-8352280684472674"
	     data-ad-slot="8044947538"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	</div>

	<?php }else{ ?>
	<a href="assets/php/clic_prop.php?id_prop=<?php echo $an_top_id_prop_5_noum; ?>&local=<?php echo $an_top_local6; ?>" target="_blank"><img src="<?php echo $an_top_img_prop_5_noum; ?>" /></a>
	<?php
	// chama a funcao de visualizar
	visualiza_prop($an_top_local6,$an_top_id_prop_5_noum, $con);
	} ?>
	</div>
<?php } ?>

	<!-- fim div description text-center -->
<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<div class="profile-tabs">
	<div class="nav-align-center">
	<ul class="nav nav-pills" role="tablist">
	<li class="active">
	<a href="#fotos" role="tab" data-toggle="tab" style="min-width: 82px;">
	<i class="material-icons">camera</i>
	FOTOS
	</a>
	</li>
	<li>
	<a href="#videos" role="tab" data-toggle="tab" style="min-width: 82px;">
	<i class="material-icons">video_library</i>
	Vídeos
	</a>
	</li>
	<li>
	<a href="#contatos" role="tab" data-toggle="tab" style="min-width: 82px;">
	<i class="material-icons">contacts</i>
	Contatos
	</a>
	</li>
	</ul>
	<!-- fim nav nav-pills -->
	</div>
	<!-- nav align center -->
	</div>
	<!-- End Profile Tabs -->
	</div>
	<!-- col-md-6 -->
</div>
<!-- row -->
<!-- CONTEUDO DOS BOTÕES DO USUARIO -->
<div class="tab-content">
<!-- FOTOS -->
<div class="conteudotab tab-pane active" id="fotos">
	<?php
	if(empty($facebook) && empty($instagram)){
	echo "<h3 class='text-center'>:( ESSE USUÁRIO NÃO POSSUI FOTOS</h3>";
	}
	?>
<div class="row col-md-10 col-md-offset-2" style="margin-top: 20px;">
	<!-- plugin fotos - facebook -->
	<?php
	if( $ref_facebook_user == "page"){ ?> <!-- só vai exibir se for página -->
	<div class="fb-album-container">
	</div>
	<?php } ?>
<?php if($pacote_anunciante <= 1){ ?>
	<div class="adsfooter col-md-12 col-sm-offset-2" style="margin-left: -447px!important;">
	<!-- anuncio-retangular-footer -->
	<?php if (mysqli_num_rows($an_prop_mid) == 0) { ?>
	<div class="adsfgoogle">
	<!-- qis3 -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:728px;height:90px"
	     data-ad-client="ca-pub-8352280684472674"
	     data-ad-slot="8044947538"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	</div>

	<?php }else{ ?>
	<a href="assets/php/clic_prop.php?id_prop=<?php echo $an_mid_id_prop_5_noum; ?>&local=<?php echo $an_mid_local6; ?>" target="_blank"><img src="<?php echo $an_mid_img_prop_5_noum; ?>" /></a>
	<?php
	// chama a funcao de visualizar
	visualiza_prop($an_mid_local6,$an_mid_id_prop_5_noum, $con);
	} ?>
	</div>
<?php } ?>

	<!-- plugin fotos - instagram -->
	<div id="insta-foto" style="margin-top: 110px;">

	</div>
	<!-- fim insta fotos -->
</div>
<!-- fim row col-md-9 col-md-offset-2 -->
</div>
<!-- fim tab-pane -->
<!-- VIDEOS -->
<div class="tab-pane" id="videos">
	<!-- plugin video - youtube -->
	<div class="youmax"></div>
	<?php
	if(empty($canal) || $canal == "https://www.youtube.com/channel/"){
	echo "<h3 class='text-center'>:( ESTE USUÁRIO NÃO TEM UM CANAL</h3>";
	}
	?>	
</div>
<!-- fim tab-pane -->
<div class="tab-pane" id="contatos">
	<div class="row">
	<div style="display: block;" id="lock" class="to-lock">
	<div class="col-md-6">
	<div class="col-sm-9 text-center">
	<!-- nome das redes sociais, contatos e etc vem do bd -->
	<h2>Rede Sociais</h2>
	<?php if (!empty($facebook)) { ?>
	<a href="https://www.facebook.com/<?php echo $facebook ?>" target="_blank" class="btn btn-round btn-facebook"><i class="fa fa-facebook"></i>&nbsp;&nbsp;Facebook</a>
	<?php } ?>
	<?php if (!empty($twitter)) { ?>
	<a href="https://twitter.com/<?php echo $twitter ?>" target="_blank" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i>&nbsp;&nbsp;Twitter</a>
	<?php } ?>
	<?php if (!empty($instagram)) { ?>
	<a href="https://www.instagram.com/<?php echo $instagram ?>" target="_blank" class="btn btn-round btn-insta"><i class="fa fa-instagram"></i>&nbsp;&nbsp;Instagram</a>
	<?php } ?>
	<?php if (!empty($canal) && ($canal != "https://www.youtube.com/channel/")) { ?>
	<a href="<?php echo $canal ?>" target="_blank" class="btn btn-round btn-youtube"><i class="fa fa-youtube"></i>&nbsp;&nbsp;Youtube</a>
	<?php } ?>
	<?php
	if( empty($facebook) && empty($instagram) && empty($twitter) && (empty($canal) || ($canal == "https://www.youtube.com/channel/")) ){
	echo "<h4 class='text-center'>sem redes sociais :(</h4>";
	}
	?>	
	</div>
	<!-- fim col-sm-9 -->
	</div>
	<!-- fim col-md-6 -->
	<div class="col-md-6">
	<div class="col-sm-9 text-center">
	<h2>Contatos</h2>
	<?php if (!empty($numero1)) { ?>
	<h5 style="margin: 10px 0 20px 0;"><i class="fa fa-whatsapp"></i>&nbsp;&nbsp;<?php echo $numero1 ?></h5>
	<?php } ?>
	<?php if (!empty($numero2)) { ?>
	<h5 style="margin: 10px 0 20px 0;"><i class="fa fa-phone"></i>&nbsp;&nbsp;<?php echo $numero2 ?></h5>
	<?php } ?>
	<?php if (!empty($numero3)) { ?>
	<h5 style="margin: 10px 0 20px 0;"><i class="fa fa-phone"></i>&nbsp;&nbsp;<?php echo $numero3 ?></h5>
	<?php } ?>
	<?php if (!empty($email_contato)) { ?>
	<h5 style="margin: 10px 0 20px 0;"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;<?php echo $email_contato ?></h5>
	<?php } ?>
	<?php if (!empty($website)) { ?>
	<h5 style="margin: 10px 0 20px 0;"><i class="fa fa-laptop"></i>&nbsp;&nbsp;<a href="http://<?php echo $website ?>" target="_blank"><?php echo $website ?></a></h5>
	<?php } ?>
	</div>
	<!-- fim col-sm-9 -->
	</div>
	<!-- fim col-md-6 -->
	</div>
	<!-- lock mct_shareit_locker -->
	</div>
	<!-- fim row -->
</div>
<!-- fim tab-pane -->
</div>
<!-- fim tab-content -->
<?php if($pacote_anunciante <= 1){ ?>
	<div class="adsfooter col-md-12 col-sm-offset-2">
	<!-- anuncio-retangular-footer -->
	<?php if (mysqli_num_rows($an_prop_rodape) == 0) { ?>
	<div class="adsfgoogle">
	<!-- qis3 -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:728px;height:90px"
	     data-ad-client="ca-pub-8352280684472674"
	     data-ad-slot="8044947538"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	</div>

	<?php }else{ ?>
	<a href="assets/php/clic_prop.php?id_prop=<?php echo $an_id_prop_5_noum; ?>&local=<?php echo $an_local6; ?>" target="_blank"><img src="<?php echo $an_img_prop_5_noum; ?>" /></a>
	<?php
	// chama a funcao de visualizar
	visualiza_prop($an_local6,$an_id_prop_5_noum, $con);
	} ?>
	</div>
<?php } ?>
	</div>
	<!-- fim container -->
<!--  plugin comentarios -->
<div style="width: 100%; height: auto;">
	<div class="fb-comments" data-href="<?php echo $site ?>" data-width="100%" data-numposts="5"></div>
</div>
<!-- fim plugin comentario -->
<?php
if (mysqli_num_rows($query) == 0) {
	echo "</div>";
}
?>
</div>
<!-- fim profile-content -->
</div>
<!-- fim main main-raised -->
<div id="testenoti">
<div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
</div>
<?php include 'assets/php/modal.php';
include 'assets/php/modal_denuncia.php';
?>
<!-- footer -->
<?php include 'assets/php/footer.php'; ?>
<!-- footer -->
<?php if(!empty($soundcloud)){ ?>
<!-- IFRAME SOUNDCLOUD -->
	<div id="player-bottom-wrapper">
	<div id="middle">
		<div id="current_playlist">
			<div id="current_playlist_header">
				<div id="current_playlist_close"></div>
				<div class="current_playlist_header_item"></div>
			</div>
			<iframe id="so" width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/<?php echo $soundcloud ?>&amp;color=%23ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true"></iframe>
		</div>
		<div id="bottom">
			<div id="bottom_controls">
				<div id="prev_button" class="controls_button"></div>
				<div id="playpause">
					<div id="play_button" button class="play_button controls_button" style="display:block" ></div>
					<div id="pause_button" button class="play_button controls_button" style="display:none" ></div>
				</div>
				<div id="next_button" class="controls_button"></div>
			</div>
			<div id="volume">
				<div id="volume_speaker" class="volume_on"></div>
				<div id="volume_back"></div>
			</div>
			<div id="display">
				<div class="display_song_container">
					<div id="display_coverart"></div>
					<div id="display_text">
						<a id="display_song"></a>
					</div>
					<div id="display_time">
						<div id="display_time_count">0:00</div>
						<div id="display_progress"><div id="display_progress_loading"></div></div>
						<div id="display_time_total"></div>
					</div>
				</div>
			</div>
			<div id="playlist_button"></div>
			<div id="top_button">
				<div id="top_text">TOP</div>
			</div>
		</div>
	</div>
	</div>
<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- jQuery 3.1.1 -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<!-- temporizador -->
<script src="assets/js/temporizador.js"></script>
<!-- bookmark_bubble -->
<script type="text/javascript" src="assets/js/bookmark_bubble.min.js"></script>
<!-- js plugin facebook -->
<script src="assets/js/albumbrowser.min.js"></script>
<!--   Core JS Files   -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/nouislider.min.js" type="text/javascript" async></script>
<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="assets/js/material-kit.min.js" type="text/javascript"></script>
<!-- script nosso -->
<script src="assets/js/sis_js.js" type="text/javascript" async></script>
<!-- youmax youtube plugin -->
<script src="assets/js/youmax.min.js" type="text/javascript"></script>
<!-- plugin lock midia social -->
<script src="assets/js/jquery.ui.highlight.min.js"></script>
<script src="assets/js/pandalocker.2.1.0.min.js"></script>
<!-- rating star -->
<script src="assets/js/star-rating.min.js" type="text/javascript"></script>
<!-- script interno js-->
<script type="text/javascript">
	var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	// se iOS for true = usando iphone, se nao usando android
	if (iOS) {
	addToHomescreen({
	    detectHomescreen: true,
	    modal: true,
	    lifespan: 0,
	    displayPace: 1440,
	    message: 'Para adicionar este app à tela de início: clique <span class="ios7ai ath-ai"></span> e então <strong>Tela de início</strong>.',
	    startDelay: 2
	});
	}
		// TODO SCRIPT DE FAVORITO!!
		// add ao favorito
		function addFav(id,id_usu) {
		var btn = document.getElementById("btn_fav");
		var fav = document.getElementById("i_fav");
		fav.innerHTML = "favorite";

		btn.setAttribute('onclick', 'removeFav('+id+','+id_usu+');');
		btn.setAttribute('title','Não seguir mais');
		btn.setAttribute('data-original-title','Não seguir mais');

		// após add no front, usar ajax ou outro qualquer para acessar codigo php e add ao usuario no banco
		  $.ajax({
		  type: "POST",
		  url: "assets/php/favoritei.php",
		  data: 'id_fav='+id+'&id_usu='+id_usu,
		  sucess: aparecer()
		  });
		}

		// removo do favorito
		function removeFav(id_r,id_usu_r) {

		var btn = document.getElementById("btn_fav");
		var fav = document.getElementById("i_fav");
		fav.innerHTML = "favorite_border";	

		btn.setAttribute('onclick', 'addFav('+id_r+','+id_usu_r+');');
		btn.setAttribute('title','Gostou? siga para ter sempre informações!');
		btn.setAttribute('data-original-title','Gostou? siga para ter sempre informações!');
		
		// após remover do front, usar ajax ou outro qualquer para acessar codigo php e remover do usuario no banco
		  $.ajax({
		  type: "POST",
		  url: "assets/php/remover_favorito.php",
		  data: 'id_fav='+id_r+'&id_usu='+id_usu_r,
		  sucess: aparecer_un()
		  });		
		}

		// funcoes de aparecer e sumir para add
		function aparecer() {
		document.getElementById('info_fav').style.display = 'block';
		setTimeout(sumir,350);
		}
		function sumir() {
		// $("#fechar_info_fav"+id_x_s).click();
		document.getElementById('info_fav').style.display = 'none';		
		}

		// funcoes de aparecer e sumir para deixar de seguir
		function aparecer_un() {
		document.getElementById('info_fav_un').style.display = 'block';
		setTimeout(sumir_un,350);
		}
		function sumir_un() {
		// $("#fechar_info_fav_un"+id_x_s).click();
		document.getElementById('info_fav_un').style.display = 'none';		
		}
		// ---------------------- FIM SCRIPT FAVORITO --------------------  

$(document).ready(function(){
    // function sobre o rating star do cliente
    $("#input-21f").rating({
    starCaptions: function (val) {
    if (val < 3) {
    return val;
    } else {
    return 'high';
    }
    },
    hoverOnClear: false
    });
    if (<?php echo $lvl ?> !== 1) {
    // inicia o click do rate ao clicar na estrela
    $(".star").bind("click touchstart", function starclick() {
    document.getElementById("input-21f").click();
    oclick(); //executa a funcao de pegar o valor do rate e enviar para o banco
    });
    // funcao de enviar o rate para o banco document.getElementById("info_rate").style.display = "block"
    function oclick() {
    $("#input-21f").click(setTimeout(function() {
        $.ajax({
        type: "POST",
        url: "assets/php/rate.php",
        data: 'rate='+document.getElementById('input-21f').value+"&url="+"<?php echo $url ?>",
        success: function(resul){
        	if (resul == "foi"){
        	// alert("FOI");
        	document.getElementById("info_rate").style.display = "block";
        	}else{
        	// alert("NÃO FOI");
        	document.getElementById("info_rate").innerHTML = "ERRO, APENAS 1 POR PESSOA";
        	document.getElementById("info_rate").style.display = "block";
        	}
        }
        });
    },100));
    };
	}
    // fim rating
    // function script js do facebook
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=677876605734655";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    // function plugin facebook
    if ("<?php echo $facebook ?>") {
    $(".fb-album-container").FacebookAlbumBrowser({
    account: "<?php echo $facebook ?>", // vem do db
    accessToken: "677876605734655|toVDgixKpw54ywgz_PSRncSgUII",
    skipAlbums: ["<?php echo implode('","', $arrN)?>"], // vem do banco 1155489667929155|rzY5iyuDnCo5djBBoxDnnqh0Py4
    showAccountInfo: true,
    showImageCount: true,
    showImageText: true,
    lightbox: true,
    photosCheckbox: true
    });
	}
    // fim facebook
    // function plugin video yt
    if ( ("<?php echo $canal ?>" != "") && ("<?php echo $canal ?>" !== "https://www.youtube.com/channel/")) {
    if ("<?php echo $playlist ?>" !== "") {

    $(".youmax").youmax({
    apiKey:"AIzaSyAlhAqP5RS7Gxwg_0r_rh9jOv_5WfaJgXw",
    channelLink:"<?php echo $canal ?>",//vem do banco
    playlistLink:"<?php echo $playlist ?>", //vem do banco
    defaultTab:"Uploads",//Uploads|Playlists|Featured
    videoDisplayMode:"popup",//popup|link|inline
    maxResults:"9", //n de videos ao iniciar
    autoPlay:false,
    displayFirstVideoOnLoad :true,//for inline video display mode only
    responsiveBreakpoints   :[600,900,2000,2500],
    loadMoreText            :"<i class=\"fa fa-plus\"></i>&nbsp;&nbsp;Mostrar mais vídeos..",
    previousButtonText      :"<i class=\"fa fa-angle-left\"></i>&nbsp;&nbsp;Anterior",
    nextButtonText          :"Próximo&nbsp;&nbsp;<i class=\"fa fa-angle-right\"></i>",
    loadingText             :"Carregando...",
    allDoneText             :"<i class=\"fa fa-times\"></i>&nbsp;&nbsp;",
    hideHeader              :false,
    hideTabs                :false,
    hideLoadingMechanism    :false
    });

	}else{

    $(".youmax").youmax({
    apiKey:"AIzaSyAlhAqP5RS7Gxwg_0r_rh9jOv_5WfaJgXw",
    channelLink:"<?php echo $canal ?>",//vem do banco
    playlistLink:"https://www.youtube.com/playlist?list=PLNkCMxwdvR4ohE3mcFY0X_MV028CIyr6t", //vem do banco
    defaultTab:"Uploads",//Uploads|Playlists|Featured
    videoDisplayMode:"popup",//popup|link|inline
    maxResults:"9", //n de videos ao iniciar
    autoPlay:false,
    displayFirstVideoOnLoad :true,//for inline video display mode only
    responsiveBreakpoints   :[600,900,2000,2500],
    loadMoreText            :"<i class=\"fa fa-plus\"></i>&nbsp;&nbsp;Mostrar mais vídeos..",
    previousButtonText      :"<i class=\"fa fa-angle-left\"></i>&nbsp;&nbsp;Anterior",
    nextButtonText          :"Próximo&nbsp;&nbsp;<i class=\"fa fa-angle-right\"></i>",
    loadingText             :"Carregando...",
    allDoneText             :"<i class=\"fa fa-times\"></i>&nbsp;&nbsp;",
    hideHeader              :false,
    hideTabs                :true,
    hideLoadingMechanism    :false
    });

	}
	}
    // fim youmax	
    // function plugin lock social midia
    if (<?php echo $lvl ?> == 1) {
	// jQuery(document).ready(function ($) {
	//    $('.to-lock').sociallocker({
	// 	text:{
	// 	   header: 'Contato Bloqueado',
	// 	   message: 'Por favor, Curta a nossa fan page(ou entre com a sua <a href="login.php">CONTA</a> e veja na hora gratuitamente) Para ver este conteúdo. Obrigado'
	// 	},
	// 	theme: 'glass',
	// 	overlap:{
	// 	   mode: 'blurring'
	// 	},
	// 	facebook:{
	// 	   like:{
	// 	      url: 'https://www.facebook.com/QISeventos',
	// 	      title: 'Curtir',
	// 	      theConfirmIssue: true
	// 	   },
	// 	   share:{
	// 	      url: 'https://www.facebook.com/QISeventos',
	// 	      title: 'Compartilhar'
	// 	   },
	// 	   appId: '677876605734655'
	// 	},
	// 	buttons:{
	// 	   order: ["facebook-like","facebook-share"],
	// 	   counters: true,
	// 	   lazy: true
	// 	}
	//    });
	// });
    // fim social midia
	}
	<?php if(!empty($instagram)){ ?>
    var id_si_insta;
	function instagram_ph() {

    // scriot INSTAGRAM
	var name_insta = "<?php echo $instagram ?>",
	itens_insta;
    $.getJSON("https://query.yahooapis.com/v1/public/yql?callback=?", 
	{
	  q: "select * from json where url='https://www.instagram.com/" + name_insta + "/?__a=1'",
	  format: "json"
	},
    function(data_insta) {
	  if (data_insta.query.results) {
		    itens_insta = data_insta.query.results.json.user.media.nodes;
		    if ( !itens_insta ) {clearInterval(id_si_insta);}
	        $.each(itens_insta, function(n, item) {

				$('#insta-foto').append(
				$("<a class='photoI' rel='tooltip' title='"+item.caption+"' data-html='true' data-placement='top' target='_blank' href='https://www.instagram.com/p/"+item.code+"' />", {
				href: 'https://www.instagram.com/p/'+item.code,
				target: '_blank'
				}).css({
					backgroundImage: 'url(' + item.thumbnail_src + ')'
				}));

	        });
    	}
    });

	}

	id_si_insta = setInterval(function(){
	  if( !$.trim($("#insta-foto").html()) ){
	  	// se for vazio carrega o script
	  	instagram_ph();
	  }
	}, 1000);
	<?php } ?>
});
// fim (document).ready
</script>
<!-- fim js externo -->