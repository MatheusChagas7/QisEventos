<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>QISeventos - Buscando localização</title>
		<meta charset="utf-8" />
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
		<link rel="icon" type="image/png" href="assets/img/favicon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="theme-color" content="#4B4B4D"/>
		<meta property="og:locale" content="pt_BR">
		<meta property="og:url" content="http://www.qiseventos.com.br">
		<meta property="og:title" content="QISeventos">
		<meta property="og:site_name" content="QISeventos">
		<meta property="og:description" content="Tudo para seu evento, bem aqui!">
		<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
		<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
		<meta property="og:image:type" content="image/jpg">
		<meta property="og:image:width" content="200"> <!-- pixel -->
		<meta property="og:image:height" content="200"> <!-- pixel -->
		<meta name="description" content="QISeventos é uma plataforma para encontrar serviços de diversos segmentos para seu evento. Encontre DJ's, buffet, decorações e muito mais!">
		<!-- /** CASO SEJA UM SITE NORMAL **/ -->
		<meta property="og:type" content="website">
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<!-- mobile -->
	  	<meta name="apple-mobile-web-app-capable" content="yes"> 
	  	<meta name="mobile-web-app-capable" content="yes">
		<!-- Fonts and icons  -->
		<link href="assets/css/font_material_icons.css" rel="stylesheet" />
		<link href="assets/css/font_roboto.css" rel="stylesheet" />
		<link href="assets/css/bootstrap_font.css" rel="stylesheet" />
		<!-- CSS Files -->
	    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	    <link href="assets/css/material-kit.min.css" rel="stylesheet"/>
	    <link href="assets/css/sly.min.css" rel="stylesheet"/>
		<!-- CSS Just for demo purpose, don't include it in your project -->
		<link href="assets/css/demo.min.css" rel="stylesheet" />
		<link href="assets/sass/material-kit/_example-pages.scss" rel="stylesheet" type="text/html"/>
		<style type="text/css">
			body{
			background-color: #FF8C00!important;
			}
			h2, small{
			font-family: arial, sans-serif;
			color: #fff;
			text-align: center;
			}
			.centro{
			text-align: center;
			width:250px;
			height:250px;
			position:absolute;
			top:50%;
			left:50%;
			margin-top:-125px;
			margin-left:-125px;
			}
			.centro img{
				width: 200px;
				height: 200px;
			}
		</style>
	</head>
<body>
<div class="centro">
	<h2>carregando...</h2>
	<small>(caso necessário, ative sua localização e recarregue, para uma melhor precisão)</small><br/>
	<img src="assets/img/load.gif" />
</div>
<form id="form" method="POST" action="inicio.php">
<input type="hidden" name="estado" id="estado" value="" />
<input type="hidden" name="cidade" id="cidade" value="" />
</form>
<!-- scripts -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<!-- bookmark_bubble -->
<script type="text/javascript" src="assets/js/bookmark_bubble.min.js"></script>
<!-- sly para slide-->
<script type="text/javascript" src="assets/js/sly.min.js"></script>
<script type="text/javascript" src="assets/js/modernizr.min.js" async></script>
<!-- <script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script> -->
<script type="text/javascript" src="assets/js/horizontal.min.js"></script>
<!--   Core JS Files   -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/nouislider.min.js" type="text/javascript" async></script>
<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="assets/js/material-kit.min.js" type="text/javascript"></script>
<!-- script interno -->
<script type="text/javascript">
// apos carregar os scripts
window.onload = function() {
	// em 1900 milis. a funcao func_rec vai ser executada
	setTimeout(function(){ getLocation(); }, 1400);
	// pergunta se permiti a localizacao
	function getLocation() {
		if (navigator.geolocation) {
			// se permitir, pega a localizacao
			navigator.geolocation.getCurrentPosition(func_exec,showError);
		} else { 
			// se nao suportar
			func_rec();
		}
	} // getlocation
	// funcao que busca e executa o script de localizacao
	function func_exec() {
	$.getScript( "assets/js/localizacao.js" )
	.done(function() {
		setTimeout(function(){ func_rec(); }, 1850);
	})
	.fail(function() {
		// se der algum erro, continua
		func_rec();
	});
	}//fim func_exec
	// se nao permitir ou acontecer algum erro diferente, continua
	function showError(error) {
		switch(error.code) {
			case error.PERMISSION_DENIED:
			func_rec();
			break;
			case error.POSITION_UNAVAILABLE:
			func_rec();
			break;
			case error.TIMEOUT:
			func_rec();
			break;
			case error.UNKNOWN_ERROR:
			func_rec();
			break;
		}
	} // fim showerror
	// funcao que recebe os dados e executa
	function func_rec() {
		var formulario = document.getElementById('form');
		var estadorec = localStorage.getItem("estadosave");
		var cidaderec = localStorage.getItem("cidadesave");
		if (estadorec == "" || estadorec == "null" || estadorec == null) {
			estadorec = "RJ"; //colocar estado RJ por enquanto
			cidaderec = "all";
		}
		document.getElementById('estado').value = estadorec;
		document.getElementById('cidade').value = cidaderec;
		// envia formulario
		formulario.submit();
	} // fim fun_rec
} // fim window.onload
</script>