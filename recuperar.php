<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';

//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache_login.php';

$erro = $_GET['error'];
// ne nada
$logout = $_GET['logout'];
$relogar = $_GET['relogar'];
if(isset($login_url) && !isset($_SESSION['data'])){

}
else{
	// get the data stored from the session
	$data = $_SESSION['data'];
	// echo the name username and photo
	$email_t = $data->email;
	$foto_t = $data->profile_image_url;
	$local = "twit";

} 
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - Recupera��o de senha</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/recuperar.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Recupera��o de senha - QISeventos">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Recupera��o de senha - QISeventos">
	<!-- /** CASO SEJA UM SITE NORMAL **/ -->
	<meta property="og:type" content="website">
	<meta name="google-signin-client_id" content="797736855998-h9r6mg8js0bn0conujgli0bbb6jsebnc.apps.googleusercontent.com">
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
<div class="container" >
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
</div>
</div>
	<div class="collapse navbar-collapse" id="navigation-example" >
	<ul class="nav navbar-nav navbar-right">
	<li>
	<a rel="tooltip" title="Curta nossa <b>Fan Page</b>" data-html="true" data-placement="bottom" href="https://www.facebook.com/qisevento/" target="_blank" class="btn btn-white btn-simple btn-just-icon">
	<i class="fa fa-facebook-square"></i>
	</a>
	</li>
	<li>
	<a rel="tooltip" title="Siga-nos no <b>Instagram</b>" data-html="true" data-placement="bottom" href="https://www.instagram.com/qiseventos/" target="_blank" class="btn btn-white btn-simple btn-just-icon">
	<i class="fa fa-instagram"></i>
	</a>
	</li>
	</ul>
	</div>
</div>
</nav>
<!-- teste notificacao erro -->
<?php
	if (!empty($erro) && $erro = "email") {
	echo "<div style='z-index:9999; position:absolute;' class='alert alert-info'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>E-MAIL:</b> E-mail incoreto, altere e envie novamente, caso persista o erro, entre em contato por favor.
	</div>
	</div>";
	}
?>
<div class="wrapper">
<div class="header header-filter" id="bg-login">
<div class="container">
	<div class="row">
	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
	<div class="card_l card-signup" >
	<form class="form" method="POST" action="assets/php/rec_senha.php" id="form">
		<div class="header_l header header-primary text-center">
		<h4 rel="tooltip" title="Ao enviar, n��s iremos mandar um e-mail com sua senha" data-html="true" data-placement="top">Recupere sua senha</h4>
		<div class="social-line"></div>
		</div>								
		<div class="content">
		<div class="input-group">
		<span class="input-group-addon">
		<i class="material-icons">email</i>
		</span>
		<input type="text" name="email" class="form-control" placeholder="E-mail..." id="email" value="<?php echo $email_t ?>" required />
		</div>
		</div>
		<div class="footer text-center">
			<button type="submit" id="btn_enviar" class="btn btn-simple btn-primary btn-lg">Enviar</button>
		</div>
	</form>
	</div>
	</div>
	</div>
	</div>
<footer class="footer" style="position: sticky!important;width: 100%;z-index: 9999">
	<div class="container">
	<nav class="pull-left">
	<ul>
		<li><a href="index.html">In�cio</a></li>
		<li><a href="contato-sobrenos.php">Sobre n�s</a></li>
		<li><a href="contato-sobrenos.php#us">Contato</a></li>
	</ul>
	</nav>
	<div class="copyright pull-right">
	&copy; 2017, Feito pela <a href="http://www.iliontecnologia.com.br" target="_blank">Ilion Tecnologia</a>
	</div>
</div>
</footer>

</div>
<!-- fim container -->
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