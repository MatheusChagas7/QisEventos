<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';
//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache.php';
// propagandas
include_once 'assets/php/propaganda.php';
// visualizacao de propaganda
include_once 'assets/php/visu_prop.php';
// se for menor que lvl 2, bloqueia os botoes e libera a frase
if ($lvl <= 2 || $lvl == 4 ) {
	$bloq_pag = "disableda";
	$bloq_pagtag = "disabled";
	$bloq_frase = "Para liberar os botões e comprar seu pacote, torne-se <a href='#' data-toggle='modal' data-target='#Modalanunciar' data-html='true'>anunciante</a> !";
}
// se for maior ou igual a 2, desativa o botao free
if ($lvl >= 2 || $lvl == 5) {
	$bloq_pagfree = "disableda";
	$bloq_pagfreetag = "disabled";
}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - Premium</title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/premium.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Se torne premium e aumente suas chances de ser contactado, tenha mais vantagens e muito mais - QISeventos">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Se torne premium e aumente suas chances de ser contactado, tenha mais vantagens e muito mais - QISeventos">
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
	<link href="assets/css/material-kit.min.css" rel="stylesheet"/>
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.min.css" rel="stylesheet" />
	<link href="assets/sass/material-kit/_example-pages.scss" rel="stylesheet" type="text/html"/>
	<!-- google ads -->
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- estilo interno -->
	<style type="text/css">
	footer {
	position: relative;
	bottom: 0;
	padding: 0 0 0 0;
	}
	#capa-index{
	background-image: url('assets/img/img-login.jpg');
	}
	#premium-card{
	background-color: #fff!important;
	}
	#premium-header{
	background: #FF8C00;
	}
	.btn_master{
	border: 1px solid yellow;
	border-radius: 6px;
	box-shadow: 0px 0px 10px yellow!important;
	}
	.btn_premium{
	border: 1px solid silver;
	border-radius: 6px;
	box-shadow: 0px 0px 10px silver!important;
	margin: 0 8px 0 8px;
	}
	.min-altura{
	min-height: 115px;
	}
	@media (max-width: 496px){
	.centrado{
	width: 100%!important;
	text-align: center!important;
	}
	.largura_borda{
	width: 80px;
	}
	.largura_borda_font{
	font-size: 10px;
	}
	}
	@media (min-width: 317px) and (max-width: 380px){
	.largura_borda{
	width: 68px;
	}
	.largura_borda_font{
	font-size: 8px!important;
	}
	}
	.disableda {
	pointer-events: none;
	cursor: default;
	}
	.radio{
	display: -webkit-inline-box!important;
	}
	</style>
</head>

<body id="b_n">
	<!-- notificacao em primeiro plano/alert -->
	<?php include 'assets/php/notificacao-alert.php';?>
	<!-- Navbar -->
<nav class="navbar navbar-fixed-top">
	<div class="container">
	<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	</button>
	<!-- notificacao -->
	<?php 
	if($lvl >= 2){
	echo"<a href='#' class='navbar-toggle n-notification-a' data-toggle='modal' data-target='#Modalnoti' style='margin-top: 4px;' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
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
	<a href='index.html' alt='login QISeventos' rel='tooltip' title='<b>Entre</b> e busque o melhor conteudo para seu <b>evento</b>' data-placement='bottom' data-html='true'><img src='assets/img/favicon_negativo.png'></a>";
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
	<!-- navbar-header -->
	<div class="brand">
	<!-- nome do usuario caso logado, se nao vai para o login, com o link para login ou perfil -->
	<?php
	if ($lvl == "1") {}else{
	echo "<a class='log-cor' href='perfil.php'>".$nome_log."</a>";
	}
	?>
	</div>
	</div>
	<!-- logo -->
	</div>
	<!-- logo-container -->
	<div class="collapse navbar-collapse" id="navigation-index">
	<!-- a partir daqui é o menu que varia -->
	<?php include 'assets/php/menus.php'; ?>
	<!-- termino do menu variavel -->
	</div>
	<!-- collapse navbar-collapse -->
	</div>
	<!-- container -->
</nav>
<!-- End Navbar -->
<div class="wrapper" style="margin-top: -110px!important;">
	<div class="header"></div>
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main main-raised">
	<div class="container">
	<!-- here you can add your content -->
	<div class="section text-center section-landing">
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h2 class="title">Promova sua conta</h2>
	<p class="description">Selecione abaixo o perfil profissional que você deseja entre básico, premium e master: Os perfis tem grande diferença, o perfil master tem as seguintes vantagens como por exemplo, melhor rankeamento nos termos de busca, o que consequentemente gera maior visibilidade e consequentemente maior possibilidade do contato de clientes interessados em sua marca.</p>
	<p class="description">Outra informação bem interessante é que durante o acesso dos buscadores não serão exibidas propagandas em seu perfil, entre outras.</p>
	<p class="description"><strong><?php echo $bloq_frase ?></strong></p>
	<p class="description">Obs: o pacote será ativado ao fazer o pagamento (se for no cartão é liberado logo, caso seja boleto será após o pagamento)</p>
	</div>
	</div>
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h2 class="title">Escolha seu pacote e promova!</h2>
	<!-- Tabs with icons on Card -->
	<div class="card card-nav-tabs" id="premium-card">
	<div class="header" id="premium-header">
	<div class="nav-tabs-navigation">
	<div class="nav-tabs-wrapper">
		<ul class="nav nav-tabs" data-tabs="tabs" style="margin-left: 5%;">
		<li id="basico" class="largura_borda active" style="width: 30%">
		<a href="#p1" data-toggle="tab" class="largura_borda_font"><i class="material-icons">star_border</i>Básico</a>
		</li>
		<li id="medio" class="largura_borda btn_premium" style="width: 30%">
		<a href="#p2" data-toggle="tab" class="largura_borda_font"><i class="material-icons">star_half</i>Premium</a>
		</li>
		<li id="master" class="largura_borda btn_master" style="width: 30%">
		<a href="#p3" data-toggle="tab" class="largura_borda_font"><i class="material-icons">star</i>Master</a>
		</li>
		</ul>
		<!-- fim nav nav-tabs -->
	</div>
	<!-- fim nav-tabs-wrapper -->
	</div>
	<!-- fim nav-tabs-navigation -->
	</div>
	<!-- fim header -->
	<div class="content text-center" style="text-align: left;">
	<div class="tab-content">
	<div class="tab-pane active" id="p1">
		<div class="box-solid min-altura">
		<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li>&#x2714; CRIAÇÃO DE PERFIL.</li>
			<li>&#x2714; INSERÇÃO DE TEXTO(LIMITE DE 300 CARACTERES).</li>
			<li>&#x2714; INTEGRAÇÃO COM REDES SOCIAIS(página FACEBOOK)</li>
		</ul>
		</div>
		<!-- fim box-body -->
		</div>
		<!-- fim box-solid -->
		<n class="title pull-left centrado" style="cursor: default;margin-bottom: 0!important;"><h2>GRÁTIS</h2></n>
		<x class="title pull-right centrado" style="margin-top: 18px">
		<a href="assets/php/up_lvl.php?anunciar=perfil" class="<?php echo $bloq_pagfree ?> <?php echo $bloq_pag ?> title btn btn-primary btn-lg" <?php echo $bloq_pagfreetag ?> <?php echo $bloq_pagtag ?> >FECHAR PACOTE</a>
		</x> 
	</div>

	<!-- fim p1 -->
	<div class="tab-pane" id="p2">
		<div class=" box-solid min-altura">
		<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li>&#x2714; CRIAÇÃO DE PERFIL.</li>
			<li>&#x2714; INSERÇÃO DE TEXTO(LIMITE DE 600 CARACTERES).</li>
			<li>&#x2714; INTEGRAÇÃO COM REDES SOCIAIS(página FACEBOOK, INSTAGRAM)</li>
			<li>&#x2714; NOME PERSONALIZÁVEL NA URL (link de compartilhamento)</li>
			<!-- <li>&#x2714; &nbsp;&nbsp;</li> -->
		</ul>
		</div>
		<!-- fim box-body -->
		</div>
		<!-- fim box-solid -->
		<n class="title pull-left centrado" style="cursor: default;margin-bottom: 0!important;"><h2>R$<n id="precop" style="color: #FF8C00;">1,99</n><small>(promoção)</small></h2></n>
		<!-- check radio para 1 mes -->
		<div class="radio">
		<label>
		<input type="radio" id="bp1" required="required" name="pagamentop" value="1" style="margin-right: 10px;">
		1 mês
		</label>
		</div>
		<!-- 6 meses -->
		<div class="radio">
		<label>
		<input type="radio" id="bp2" name="pagamentop" required="required" value="2" style="margin: 10px;">
		6 meses
		</label>
		</div>
		<!-- 1 ano -->
		<div class="radio">
		<label>
		<input type="radio" id="bp3" name="pagamentop" required="required" value="3" style="margin: 10px;">
		12 meses
		</label>
		</div>
		<a class="title pull-right centrado" style="margin-top: 18px">
		<form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
		<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
		<input id="pagp" type="hidden" name="code" value="5587631B5959F49DD410BFBF7ABD9A8B" />
		<input type="hidden" name="iot" value="button" />
		<button id="pagamento2" class="<?php echo $bloq_pag ?> title btn btn-primary btn-lg" name="submit" <?php echo $bloq_pagtag ?> >FECHAR PACOTE</button>
		</form>
		</a>
		<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
	</div>
	<!-- fim p2 -->

	<div class="tab-pane" id="p3">
		<div class="box-solid min-altura">
		<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li>&#x2714; CRIAÇÃO DE PERFIL.</li>
			<li>&#x2714; INSERÇÃO DE TEXTO(SEM LIMITES).</li>
			<li>&#x2714; INTEGRAÇÃO COM REDES SOCIAIS(página FACEBOOK, INSTAGRAM, YOUTUBE e SOUNDCLOUD)</li>
			<li>&#x2714; SEM PROPAGANDA NO PERFIL E ANUNCIO</li>
			<li>&#x2714; NOME PERSONALIZÁVEL NA URL (link de compartilhamento)</li>
		</ul>
		</div>
		<!-- fim box-body -->
		</div>
		<!-- fim box-solid -->
		<n class="title pull-left centrado" style="cursor: default;margin-bottom: 0!important;"><h2>R$<n id="precom" style="color: #FF8C00;">3,99</n><small>(promoção)</small></h2></n>
		<!-- fim check radio de 1 mes -->
		<div class="radio">
		<label>
		<input id="bm1" required="required" value="1" name="pagamentom" type="radio" style="margin-right: 10px;">
		1 mês
		</label>
		</div>
		<!-- 6 meses -->
		<div class="radio">
		<label>
		<input id="bm2" required="required" value="2" name="pagamentom" type="radio" style="margin: 10px;">
		6 meses
		</label>
		</div>
		<!-- fim 1 ano -->
		<div class="radio">
		<label>
		<input id="bm3" required="required" value="3" name="pagamentom" type="radio" style="margin: 10px;">
		12 meses
		</label>
		</div>
		<a class="title pull-right centrado" style="margin-top: 18px">
		<form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
		<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
		<input id="pagm" type="hidden" name="code" value="374130AD64647EBEE4B19F8D9FBD90D7" />
		<input type="hidden" name="iot" value="button" />
		<button id="pagamento3" class="<?php echo $bloq_pag ?> title btn btn-primary btn-lg" name="submit" <?php echo $bloq_pagtag ?>>FECHAR PACOTE</button>
		</form>
		</a>
		<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
	</div>
	<!-- fim p3 -->
	</div>
	<!-- tab-content -->
	</div>
	<!-- fim content text-center -->
	</div>
	<!-- fim card card-nav-tabs -->
	</div>
	<!-- fim col-md-8 col-md-offset-2 -->
	</div>
	<!-- fim row -->
	<h4 class="title">Caso precise de ajuda ou queira entrar em contato, por favor <a href="" style="color: #FF8C00;">CLIQUE AQUI</a></h4>
	<!-- <small>*Os banners serão exibidos randomicamente pelas áreas do site, podendo ser exibidos tanto no topo, quanto entre banners do rodapé e etc.</small> -->
	</div>
	<!-- fim section text-center section-landing -->
	<div class="adsfooter col-md-12 col-sm-offset-2">
	<!-- anuncio-retangular-footer -->
	<?php if (mysqli_num_rows($pr_prop_rodape) == 0) { ?>

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
	<a href="assets/php/clic_prop.php?id_prop=<?php echo $pr_id_prop_5_noum; ?>&local=<?php echo $pr_local6; ?>" target="_blank"><img src="<?php echo $pr_img_prop_5_noum; ?>" /></a>
	<?php
	// chama a funcao de visualizar
	visualiza_prop($pr_local6,$pr_id_prop_5_noum, $con);
	} ?>
	</div>

	</div>
	<!-- fim container -->
	</div>
	<!-- fim main main-raised -->

</div>
<!-- class wrapper /. -->

	<div id="testenoti">
	<div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
	</div>
	<!-- fim testenoti -->
	<!-- modais -->
	<?php include 'assets/php/modal.php';?>

<!-- footer -->
<?php include 'assets/php/footer.php'; ?>
<!-- footer -->

	<!-- jQuery 3.1.1 -->
	<script src="assets/js/jquery-3.1.1.min.js"></script>
	<!-- temporizador -->
	<script src="assets/js/temporizador.js"></script>
	<!-- bookmark_bubble -->
	<script type="text/javascript" src="assets/js/bookmark_bubble.min.js"></script>
	<!-- sly para slide-->
	<script type="text/javascript" src="assets/js/sly.min.js"></script>
	<script type="text/javascript" src="assets/js/modernizr.min.js"></script>
	<script type="text/javascript" src="assets/js/horizontal.min.js"></script>
	<!--   Core JS Files   -->
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/material.min.js"></script>
	<script src="assets/js/divspagamento.js" type="text/javascript" ></script> 
	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="assets/js/nouislider.min.js" type="text/javascript" async></script>
	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="assets/js/material-kit.min.js" type="text/javascript"></script>
	<!-- nosso script -->
	<script src="assets/js/sis_js.js" type="text/javascript"></script>