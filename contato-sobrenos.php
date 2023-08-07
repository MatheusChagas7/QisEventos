<?php
//fara a conexao com banco de dados
	// impede erros de NOTICE a aparecer na page, pois caso as variaveis estejam vazias dera erro(notice)
	error_reporting(0);
// include_once 'assets/php/conexao.php';
//chama a cache, para verificar o cache se esta logado
// include_once 'assets/php/cache.php';
// propagandas
// include_once 'assets/php/propaganda.php';
// visualizacao de propaganda
// include_once 'assets/php/visu_prop.php';
$envio = filter_input(INPUT_GET, "envio");
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - sobre nós / contato</title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/contato-sobrenos.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Conheça mais sobre a QISeventos e entre em contato conosco">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Conheça mais sobre a QISeventos e entre em contato conosco">
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
		#titulo-us{
		padding-top: 7%;
		}
		#title-us{
		color: #fff;
		}
	</style>
</head>

<body id="b_n" class="us-page">
	<!-- notificacao em primeiro plano/alert -->
	<?php include 'assets/php/notificacao-alert.php';?>
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
		<!-- fim navbar-toggle -->
		<!-- notificacao -->
		<?php 
		if($lvl >= 2){
		echo "<a href='#' class='navbar-toggle n-notification-a' style='margin-top: 4px;' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
			<span id='n-notification' class='n-notification'></span>
			<i class='material-icons' style='color: #fff;'>notifications</i>
			</a>";
		}
		?>
		<!-- foto do usuario msm coisa com o nome -->
		<?php
		if ($lvl == "1"){
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
	<!-- fim navbar-header -->
	<!-- notificacao de envio -->
	<?php
	if (!empty($envio)) {
	echo "
	<div style='z-index:9999; position:absolute;' class='alert alert-info'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>MENSAGEM ENVIADA COM SUCESSO:</b> Recebemos seu email e logo entraremos em contato!
	</div>
	</div>
	";
	}
	?>
	<div class="brand">
	<!-- nome do usuario caso logado, se nao vai para o login, com o link para login ou perfil -->
	<?php
	if ($lvl == "1") {}else{
	echo "<a class='log-cor' href='perfil.php'>".$nome_log."</a>";
	}
	?>
	</div>
	</div>
	</div>
	<div class="collapse navbar-collapse" id="navigation-example">
	<!-- a partir daqui é o menu que varia -->
	<?php include 'assets/php/menus.php'; ?>
	<!-- termino do menu variavel -->
	</div>
	</div>
	</nav>
	<!-- fim navbar -->
	<div class="wrapper">
		<div class="header header-filter" id="capa-index">
		<div class="container" id="titulo-us">
		<div class="row">
		<div class="col-md-6" style="margin-top: 50px;">
		<h1 class="title" id="title-us">Conheça o QISeventos</h1>
		<h4 id="title-us">O que é o Qiseventos? como posso usa-lo? Fique por dentro do nosso trabalho e conheça um pouco sobre nós!</h4>
		<a class="btn-perfil btn btn-primary btn-lg" id="btn-us" href="#">
		<i class="material-icons">details</i> Saiba Mais
		</a>
		</div>
		</div>
		<!-- fim row -->
		</div>
		<!-- fim container -->
		</div>
		<!-- fim header -->
		<div class="main main-raised">
		<a name="nos"></a>
		<div class="container">
		<div class="section text-center section-landing">
		<div class="row">
		<div class="col-md-8 col-md-offset-2" style="margin-top: -20px;">
		<h2 class="title">Sobre</h2>
		<p class="description">A QISeventos é uma plataforma online que intermedia fornecedores de eventos de forma gratuita ou com pacotes pagos que vêm com melhorias e vantagens.
		Na QISeventos você encontra fornecedores de diversas áreas relacionadas a eventos, tais como DJ's, bandas, fotógrafos, cinegrafistas, músicos, decoradores, empresas para aluguel de som, entre outros. Todos os nossos fornecedores cadastrados estão sempre com seus perfis atualizados para que o usuário tenha a melhor experiência ao buscar o que precisa.</p>
		<p class="description">Você também pode seguir estes fornecedores, ouvir seus melhores hits, acompanhar agenda de trabalhos, vídeos, fotos e muito mais.
		Pode divulgar a sua marca, serviços e até eventos através dos banners disponíveis em todo site. Portanto, com o QISeventos anunciar seu produto/serviço ficou muito mais fácil, qualquer pessoa em qualquer lugar pode ver e contratar seus serviços e você pode compartilhar o seu link para que os outros tenham acessos! Tudo para eventos em um só lugar.</p>
		</div>
		<!-- fim col-md-8 -->
		</div>
		<!-- fim row -->
		<div class="features">
		<div class="row">
		<div class="col-md-4">
		<div class="info">
			<div class="icon icon-primary">
			<i class="material-icons">notifications</i>
			</div>
			<h4 class="info-title">Sempre atualizado</h4>
			<p>Você receberá notificações pelo computador, celular e e-mail sobre novos seguidores ou qualquer uma de nossas novidades e muito mais!</p>
		</div>
		<!-- fim info -->
		</div>
		<!-- fim col-md-4 -->
		<div class="col-md-4">
		<div class="info">
			<div class="icon icon-success">
			<i class="material-icons">verified_user</i>
			</div>
			<h4 class="info-title">Segurança</h4>
			<p>Seus dados estarão a salvos no nosso banco de dados, somente o que você permitir será apresentado para todos.</p>
		</div>
		<!-- fim info -->
		</div>
		<!-- fim col-md-4 -->
		<div class="col-md-4">
		<div class="info">
			<div class="icon icon-danger">
			<i class="material-icons">monetization_on</i>
			</div>
			<h4 class="info-title">Pagamento seguro</h4>
			<p>Pagamento via Pagseguro (no boleto ou no cartão), com toda a segurança que você merece.</p>
		</div>
		<!-- fim info -->
		</div>
		<!-- fim col-md-4 -->
		</div>
		<!-- fim row -->
		</div>
		<!-- fim features -->
		</div>
		<!-- fim section -->
		<div class="adsfooter col-md-12 col-sm-offset-2" style="margin-top: -22px;">
		<!-- anuncio-retangular-footer -->
		<?php if (mysqli_num_rows($cs_prop_mid) == 0) { ?>
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
		<a href="assets/php/clic_prop.php?id_prop=<?php echo $cs_mid_id_prop_5_noum; ?>&local=<?php echo $cs_mid_local6; ?>" target="_blank"><img src="<?php echo $cs_mid_img_prop_5_noum; ?>" /></a>
		<?php
		// chama a funcao de visualizar
		visualiza_prop($cs_mid_local6,$cs_mid_id_prop_5_noum, $con);
		} ?>
		</div>
		<div class="section text-center" style="padding-bottom: 0!important;">
		<h2 class="title">Apoiadores</h2>
		<div class="team">
		<div class="row">
		<div class="col-md-4 col-md-offset-2">
		<div class="team-player">
		<img src="assets/img/1parceria_logo.png" alt="imagem parceria" class="img-raised img-circle"> <!-- img da parceria - ilion -->
		<h4 class="title">Ilion Tecnologia<br /> <!-- nome da parceria - ilion -->
		<small class="text-muted">Desenvolvedor</small> <!-- funcao da parceria - ilion -->
		</h4>
		<p class="description">Responsável pela criação de todo o sistema (tanto back-end quanto front-end) para fazer a QISeventos o que ela é e com a equipe atualizando constantemente para a melhor experiência de nossos usuários.</p> <!-- explicacao da parceria - ilion -->
		<a href="https://www.facebook.com/Iliontecnologia" target="_blank" class="btn btn-simple btn-just-icon btn-default"><i class="fa fa-facebook-square"></i></a>
		<a href="http://www.Iliontecnologia.com.br" target="_blank" class="btn btn-simple btn-just-icon btn-default"><i class="fa fa-globe"></i></a>
		</div>
		<!-- fim team-player -->
		</div>
		<!-- fim col-md-4 -->
		<div class="col-md-4">
		<div class="team-player">
		<img src="assets/img/interrogacao.jpg" alt="imagem parceria" class="img-raised img-circle"> <!-- img da parceria - ? -->
		<h4 class="title">Pode ser você!<br /> <!-- nome da parceria - ? -->
		<small class="text-muted">quer ser nosso parceiro?</small> <!-- funcao da parceria - ? -->
		</h4>
		<p class="description">Entre em <a href="#us">contato</a> conosco e venha ser nosso parceiro ou trabalhar com a gente.</p> <!-- explicacao da parceria - ? -->
		</div>
		<!-- fim team-player -->
		</div>
		<!-- fim col-md-4 -->
		</div>
		<!-- fim row -->
		</div>
		<!-- fim team -->
		</div>
		<!-- fim section -->
		<div class="row">
		<div class="col-md-8 col-md-offset-2" style="margin-top: 60px;">
		<h2 class="title text-center">Criação</h2>
		<p class="description">A plataforma QISeventos foi desenvolvida e criada pela equipe da Ilion Tecnologia, seu nome vem de 3 palavras em latim, Quaerere (buscar), Inveniet (achar) e Simul (combinar), com a ideia de que nossos usuários e visitantes possam Buscar, achar e combinar para o êxito de seu evento.</p>
		<p class="description">Com o intuito de melhorar e facilitar a vida de pessoas que buscam fornecedores para eventos, foi feito o intermedio de pequenos a grandes fornecedores que queiram visiblidade de seus serviços pela sua cidade, estado ou todo o País. Montar a sua festinha ou um grande evento ficou mais fácil!</p>
		</div>
		<!-- fim col-md-8 -->
		</div>
		<!-- fim row -->
		<!-- DEIXE ESSA DIV POR ENQUANTO COMENTADA, DE PORTFÓLIO
		<div class="section text-center">
		<h2 class="title">Portfólio</h2>
		<div class="team">
		<div class="row">
		<div class="col-md-4">
		<div class="team-player">
		<a href="#">
		<img src="assets/img/kendall.jpg" width="150" height="150" rel="tooltip" title="<b>Troia Tecnologia</b>" data-placement="bottom" data-html="true" alt="Troia Tecnologia" class="img-raised img-circle">
		</a>
		</div>
		</div>
		<div class="col-md-4">
		<div class="team-player">
		<a href="#">
		<img src="assets/img/christian.jpg" width="150" height="150" rel="tooltip" title="<b>Troia Tecnologia</b>" data-placement="bottom" data-html="true" alt="Troia Tecnologia" class="img-raised img-circle">
		</a> 
		</div>
		</div>
		<div class="col-md-4">
		<div class="team-player">
		<a href="#">
		<img src="assets/img/marc.jpg" width="150" height="150" rel="tooltip" title="<b>Troia Tecnologia</b>" data-placement="bottom" data-html="true" alt="Troia Tecnologia" class="img-raised img-circle">
		</a>
		</div>
		</div>
		</div>
		</div>
		</div>-->
		<div class="section landing-section">
		<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<a name="us"></a>
		<h2 class="text-center title">Contato</h2>
		<h4 class="text-center description">Caso tenha alguma dúvida, ou deseja entrar em contato para apoiar e/ou a trabalho, entre em contato conosco pelo nosso e-mail.</h4>
		<form class="contact-form" id="formcs" method="POST" action="assets/php/email_nos.php">
		<div class="row">
		<div class="col-md-6">
		<div class="form-group label-floating">
		<label class="control-label">Seu nome</label>
		<input type="text" name="nome" class="form-control" required>
		<input type="hidden" name="local" value="contato"/>
		<input type="hidden" id="hora" name="hora" value="">											
		</div>
		<!-- fim form-group -->
		</div>
		<!-- fim col-md-6 -->
		<div class="col-md-6">
		<div class="form-group label-floating">
		<label class="control-label">Seu e-mail</label>
		<input type="email" name="email" class="form-control" required>
		</div>
		<!-- fim form-group -->
		</div>
		<!-- fim col-md-6 -->
		</div>
		<!-- fim row -->
		<div class="form-group label-floating">
		<label class="control-label">Sua mensagem</label>
		<textarea class="form-control" name="texto" rows="4" required></textarea>
		</div>
		<!-- fim form-group -->
		<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
		<button type="button" class="btn btn-primary btn-raised" onclick="envio();">
		<i class="material-icons">send</i>&nbsp;Enviar
		</button>
		</div>
		<!-- fim col-md-4 -->
		</div>
		<!-- fim row -->
		</form>
		</div>
		<!-- fim col-md-8 -->
		</div>
		<!-- fim row -->
		</div>
		<!-- fim section landing-section -->
		<div class="adsfooter col-md-12 col-sm-offset-2" style="margin-top: -22px;">
		<!-- anuncio-retangular-footer -->
		<?php if (mysqli_num_rows($cs_prop_rodape) == 0) { ?>
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
		<a href="assets/php/clic_prop.php?id_prop=<?php echo $cs_id_prop_5_noum; ?>&local=<?php echo $cs_local6; ?>" target="_blank"><img src="<?php echo $cs_img_prop_5_noum; ?>" /></a>
		<?php
		// chama a funcao de visualizar
		visualiza_prop($cs_local6,$cs_id_prop_5_noum, $con);
		} ?>
		</div>
		</div>
		<!-- fim container -->
	</div>
	<!-- fim main -->
	<div id="testenoti">
	<div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
	</div>
	<?php include 'assets/php/modal.php';?>
	<!-- modal -->
	<?php include 'assets/php/footer.php'; ?>
	<!-- footer -->
	</div>
	<!-- fim wrapper -->

<!-- jQuery 3.1.1 -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<!-- temporizador -->
<script src="assets/js/temporizador.js"></script>
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
<!-- nosso script -->
<script src="assets/js/sis_js.js" type="text/javascript"></script>
<script>
	function envio() {
		// pega a data e hora do momento do envio
		localtime = new Date();
		document.getElementById("hora").value = localtime;
		if ( !(document.getElementById("hora").value == "") ) {
			//faz o submit
			document.getElementById("formcs").submit();
		}
	}
</script>