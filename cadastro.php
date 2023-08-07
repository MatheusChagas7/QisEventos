<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';
//chama o arquivo login_twitter
include_once 'assets/php/cadastro_twitter.php';

$erro = filter_input(INPUT_GET, "error");

if(isset($login_url) && !isset($_SESSION['data'])){
}
else{
	// get the data stored from the session
	$data = $_SESSION['data'];
	// echo the name username and photo
	$nome_t = $data->name;
	$email_t = $data->email;
	$foto_t_vem = $data->profile_image_url;
	$foto_t = substr($foto_t_vem ,0,strrpos($foto_t_vem ,'_normal')) . ".jpg";
	$local = "twit";
}
//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache_login.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - cadastro</title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/cadastro.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Cadastre-se e tenha tudo para seu evento bem aqui. Se torne um anunciante e divulgue o seu trabalho, ou cadastre-se e favorite, vote e muito mais!">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Cadastre-se e tenha tudo para seu evento bem aqui. Se torne um anunciante e divulgue o seu trabalho, ou cadastre-se e favorite, vote e muito mais!">
	<!-- /** CASO SEJA UM SITE NORMAL **/ -->
	<meta property="og:type" content="website">
	<meta name="google-signin-client_id" content="541301617179-lcqjafupn7qrp1pnpr3gl5buoshpume7.apps.googleusercontent.com">
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
	<link href="assets/css/demo.min.css" rel="stylesheet" />
	<link href="assets/sass/material-kit/_example-pages.scss" rel="stylesheet" type="text/html"/>
	<!-- estilo interno -->
	<style type="text/css">
	#bg-login{
	background-image: url('assets/img/img-login.jpg'); 
	width:100%; 
	height: 100%; 
	background-size: cover; 
	background-position: top center;
	}
	.material-icons{
	color:white;
	}
	#sub-reg{
	color:#fff;
	}
	.form-control{
	color: #ccc!important;
	}
	</style>
</head>

<body class="signup-page index-page">
	<nav class="navbar navbar-absolute">
	<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<div class='logo-container'>
	<div class='logo' style='border:none;border-radius:0;'>
	<a href='index.html' alt='login QISeventos' rel='tooltip' title='<b>Entre</b> e busque o melhor conteudo para seu <b>evento</b>' data-placement='bottom' data-html='true'><img src='assets/img/favicon_negativo.png'></a>
	</div>
	<!-- fim logo -->
	</div>
	<!-- fim logo-container -->
	</div>
	<!-- fim navbar-header -->
	<div class="collapse navbar-collapse" id="navigation-example" >
	<ul class="nav navbar-nav navbar-right">
	<li>
	<a rel="tooltip" title="Curta nossa <b>Fan Page</b>" data-html="true" data-placement="bottom" href="https://www.facebook.com/qiseventos/" target="_blank" class="btn btn-white btn-simple btn-just-icon">
	<i class="fa fa-facebook-square"></i>
	</a>
	</li>
	<li>
	<a rel="tooltip" title="Siga-nos no <b>Instagram</b>" data-html="true" data-placement="bottom" href="https://www.instagram.com/qiseventos/" target="_blank" class="btn btn-white btn-simple btn-just-icon">
	<i class="fa fa-instagram"></i>
	</a>
	</li>
	</ul>
	<!-- fim nav -->
	</div>
	<!-- fim collapse -->
	</div>
	<!-- fim container -->
	</nav>
	<!-- fim navbar -->
	<!-- teste notificacao erro -->
	<?php
	if (!empty($erro) && $erro == "email_cadastrado") {
	echo "<div style='z-index:9999; position:absolute;' class='alert alert-info'>
		<div class='container-fluid'>
		<div class='alert-icon'>
		<i class='material-icons'>error_outline</i>
		</div>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'><i class='material-icons'>clear</i></span>
		</button>
		<b>E-MAIL CADASTRADO:</b> Este e-mail ja foi cadastrado, caso não lembre a senha, entre em <a href='recuperar.php' style='color:#333'>recuperar senha</a>.
		</div>
		</div>";
	}else if(!empty($erro) && $erro == "foradoar"){
	echo "<div style='z-index:9999; position:absolute;' class='alert alert-info'>
		<div class='container-fluid'>
		<div class='alert-icon'>
		<i class='material-icons'>error_outline</i>
		</div>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'><i class='material-icons'>clear</i></span>
		</button>
		<b>FORA DO AR:</b> Nosso servidor deve estar fora do ar, por favor espere alguns minutos e tente novamente, se persistir o erro entre em contato.
		</div>
		</div>";
	}
	?>
<div class="wrapper">
<div class="header header-filter" id="bg-login">
	<div class="container">
	<div class="row">
	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
	<div class="card_l card-signup" id="boxlogin" style="display: none;">
	<form class="form" method="POST" action="assets/php/cadastro_sis.php">
	<div class="header_l header header-primary text-center">
	<h4 rel="tooltip" title="Entre com alguma de suas redes sociais" data-html="true" data-placement="top">cadastrar</h4>
	<div class="social-line">
		<!-- login Facebook -->
		<a onclick="login()" class="btn btn-simple btn-just-icon">
		<i class="fa fa-facebook-square"></i>
		</a>
		<!-- login Twitter -->
		<a href="<?php echo $login_url ?>" class="btn btn-simple btn-just-icon">
		<i class="fa fa-twitter"></i>
		</a>
		<!-- login Google -->
		<a href="#" onclick="logarg()" id="googlebl" class="btn btn-simple btn-just-icon">
		<i class="fa fa-google-plus"></i>
		</a>
		<a style="display:none;" class="g-signin2" data-onsuccess="onSignIn"></a>
	</div>
	<!-- fim social-line -->
	</div>
	<!-- fim header_l -->
	<a href="login.php"><p class="text-divider" id="sub-reg">Ou entre com seu login</p></a>
	<div class="content">
		<div class="input-group">
		<span class="input-group-addon">
		<i class="material-icons">face</i>
		</span>
		<!-- fim input-group-addon -->
		<input type="text" name="nome" id="nome" class="form-control" placeholder="Nome(apresentação)" value="<?php echo $nome_t ?>" required />
		</div>
		<!-- fim input-group -->
		<div class="input-group">
		<span class="input-group-addon">
		<i class="material-icons">email</i>
		</span>
		<!-- fim input-group-addon -->
		<input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="<?php echo $email_t ?>" required />
		</div>
		<!-- fim input-group -->
		<div class="input-group">
		<span class="input-group-addon">
		<i class="material-icons">lock_outline</i>
		</span>
		<!-- fim input-group-addon -->
		<input type="password" minlength="8" name="senha" id="senha" placeholder="Senha" class="form-control" required />
		<!-- get token -->
		<input type="hidden" id="token" name="token" />
		<!-- get img -->
		<input type="hidden"  id="foto_perfil" name="foto_perfil" value="<?php echo $foto_t ?>" />
		<!-- get data de nascimento -->
		<input type="hidden" id="nascimento" name="nascimento" />
		<!-- get genero -->
		<input type="hidden" id="genero" name="genero" />
		<!-- migracao -->
		<input type="hidden" id="local" name="local" value="<?php echo $local ?>" />
		</div>
		<!-- fim input-group -->
		<!-- marcando a opcao de acc nossa politica de privacidade -->
		<div class="checkbox">
		<label>
		<input type="checkbox" id="term_acc" name="acc-pp">
		Li e concordo com os Termos de Uso e <a href="politica-privacidade.html" target="_blank">politica e privacidade</a>.
		</label>
		</div>
		<!-- fim checkbox -->
	</div>
	<!-- fim content -->
	<div class="footer text-center">
		<button type="submit" id="btn_send" class="btn btn-simple btn-primary btn-lg">Começar</button>
	</div>
	</form>
	<!-- fim form -->
	</div>
	<!-- fim card card-signup -->
	</div>
	<!-- fim col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 -->
	</div>
	<!-- fim linha -->
	</div>
	<!-- fim container -->

	<footer class="footer" style="width: 100%;z-index: 9999;position: relative;">
	<div class="container">
		<nav class="pull-left">
		<ul>
			<li><a href="index.html">Início</a></li>
			<li><a href="contato-sobrenos.php">Sobre nós</a></li>
			<li><a href="contato-sobrenos.php#us">Contato</a></li>
		</ul>
		</nav>
		<div class="copyright pull-right">
		&copy; 2018, Feito pela <a href="http://www.iliontecnologia.com.br" target="_blank">Ilion Tecnologia</a>
		</div>
	</div>
	<!-- fim container -->
	</footer>
	<!-- fim footer -->

</div>
<!-- fim header -->
</div>
<!-- fim wrapper -->

<!-- jQuery 3.1.1 -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<!-- bookmark_bubble -->
<script type="text/javascript" src="assets/js/bookmark_bubble.min.js"></script>
<!--   Core JS Files   -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/nouislider.min.js" type="text/javascript" async></script>
<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="assets/js/material-kit.min.js" type="text/javascript"></script>
<!-- script para pegar o token do usuario -->
<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
<script src="https://apis.google.com/js/client:platform.js" async defer></script>
<!-- script interno -->
<script type="text/javascript">
window.onload = function() {
	document.getElementById('boxlogin').style.display = 'block';//liberando qndo terminar
}
$(document).ready(function(){
	$('#btn_send').attr('disabled',true);
	$('input').click(function(){
		if( $('#term_acc').is(':checked') ){
			$('#btn_send').attr('disabled', false);
		}else{
			$('#btn_send').attr('disabled',true);
		}
	})
});	
// Initialize Firebase
 var config = {
    apiKey: "AIzaSyDNFQ3fEcYylZ2wVVkxYV4Ch-FB-TwQsdY",
    authDomain: "qiseventos.firebaseapp.com",
    databaseURL: "https://qiseventos.firebaseio.com",
    projectId: "qiseventos",
    storageBucket: "qiseventos.appspot.com",
    messagingSenderId: "330761437937"
  };
  firebase.initializeApp(config);
const messaging = firebase.messaging();
navigator.serviceWorker.register('assets/js/firebase-messaging-sw.js')
.then((registration) => {
	messaging.useServiceWorker(registration);
	// Request permission and get token.....
	messaging.requestPermission()
	.then(function () {
		return messaging.getToken();
	})
	.then(function (token) {
		// console.log('TOKEN: ' + token);
		//cadastro sistema padrao
		document.getElementById('token').value = token;
	})
	.catch(function (err) {})
});
// script login FACEBOOK
// initialize and setup facebook js sdk
window.fbAsyncInit = function() {
	FB.init({
		appId      : '677876605734655',
		xfbml      : true,
		version    : 'v2.10'
	});
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {} else if (response.status === 'not_authorized') {} else {}
	});
};
(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
// login with facebook with extra permissions
function login() {
	FB.login(function(response) {
	if (response.status === 'connected') {
		getInfo();
	} else if (response.status === 'not_authorized') {} else {}
	}, {scope: 'email,user_birthday'});
}
// getting basic user info
function getInfo() {
	FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,email,birthday,picture.width(150).height(150),gender'}, function(response) {
	// FORMATAR DATA QUE VEM DO FACEBOOK PQ ELE É UM FDP, DIFERENTAO DO CARALHO
	function formatDate (input) {
		var datePart = input.match(/\d+/g),
		month = datePart[0], 
		day = datePart[1], 
		year = datePart[2];
		return day+'/'+month+'/'+year;
	}
	// console.log("DATA DE NASCIMENTO:" + formatDate(response.birthday));
	// console.log("DATA DE NASCIMENTO FACEBOOK:" + response.birthday);
	// pega o nome do input e coloca o elemento dentro dele
	document.getElementById("nome").value = response.name;
	document.getElementById("email").value = response.email;
	document.getElementById("genero").value = response.gender;
	document.getElementById("nascimento").value = formatDate(response.birthday);
	document.getElementById("foto_perfil").value = response.picture.data.url;
	document.getElementById("local").value = "face";
	});
}
// script login GOOGLE
function logarg() {
	var el = document.getElementsByClassName('abcRioButton');
	for (var i=0;i<el.length; i++) {
		el[i].click();
	}
}
function onSignIn(googleUser) {
	var profile = googleUser.getBasicProfile();
	// console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
	//console.log('Name: ' + profile.getName());
	//console.log('Image URL: ' + profile.getImageUrl());
	// console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
	// document.getElementById('estatus').innerHTML = "Nome: " + profile.getName() + "<br> Email :"+ profile.getEmail() + "<br>Foto: " + "<img src="+ profile.getImageUrl() +">";
	document.getElementById("nome").value = profile.getName();
	document.getElementById("email").value = profile.getEmail();
	document.getElementById("foto_perfil").value = profile.getImageUrl();
	document.getElementById("local").value = "gplu";
}
function signOut() {
	var auth2 = gapi.auth2.getAuthInstance();
	auth2.signOut().then(function () {
		console.log('User signed out.');
	});
}
</script>