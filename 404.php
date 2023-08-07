<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';
//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - 404 ERRO</title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/404.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Esta página não existe.">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Esta página não existe.">
	<!-- /** CASO SEJA UM SITE NORMAL **/ -->
	<meta property="og:type" content="website">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<!-- mobile -->
	<meta name="apple-mobile-web-app-capable" content="yes"> 
	<meta name="mobile-web-app-capable" content="yes">
	<!-- manifest / sw-->
	<link rel="manifest" href="assets/js/manifest.json">
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
		.photo{
		width: 130px;
		height: 130px;
		margin-bottom: 6px;
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
	</style>
</head>
<body id="b_n" class="profile-page">
	<!-- notificacao em primeiro plano/alert -->
	<?php include 'assets/php/notificacao-alert.php';?>
	<div id="fb-root"></div>
	<nav class="navbar navbar-fixed-top">
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
		echo "
		<a href='#' class='navbar-toggle n-notification-a' style='margin-top: 4px;' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
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
		if ($lvl == "1") {}else{
		echo "<a class='log-cor' href='perfil.php'>".$nome_log."</a>";
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
	<div class="header header-filter" style="background-image: url('assets/img/img-login.jpg');"></div>
	<div class="main main-raised">
		<h1 class="text-center">Página não encontrada :(</h1><br>
		<h4 class="text-center">A página que você esta tentando acessar pode não existir, <a href="index.html">voltar</a>.</h4>
	</div>
	<!-- fim main -->
	<div id="testenoti">
	<div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
	</div>
	<!-- fim testenoti -->
	<?php include 'assets/php/modal.php';?>
</div>
<!-- fim wrapper -->

<!-- footer -->
<?php include 'assets/php/footer.php'; ?>
<!-- footer -->

<!-- jQuery 3.1.1 -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<!-- temporizador -->
<script src="assets/js/temporizador.js"></script>
<!-- bookmark_bubble -->
<script type="text/javascript" src="assets/js/bookmark_bubble.min.js"></script>
<script src="assets/js/lightbox-plus-jquery.min.js"></script>
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