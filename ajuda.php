<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';
//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache.php';
// propagandas
include_once 'assets/php/propaganda.php';
// visualizacao de propaganda
include_once 'assets/php/visu_prop.php';
$envio = filter_input(INPUT_GET, "envio");
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - Ajuda</title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/ajuda.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Descubra como desfrutar de nossa plataforma, como navegar e usar tudo o que possamos oferecer para o seu evento - QISeventos Tudo para o seu evento bem aqui!">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Descubra como desfrutar de nossa plataforma, como navegar e usar tudo o que possamos oferecer para o seu evento - QISeventos Tudo para o seu evento bem aqui!">
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
	<!--     Fonts and icons     -->
	<link href="assets/css/font_material_icons.css" rel="stylesheet" />
	<link href="assets/css/font_roboto.css" rel="stylesheet" />
	<link href="assets/css/bootstrap_font.css" rel="stylesheet" />
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.min.css" rel="stylesheet"/>
    <link href="assets/css/sly.min.css" rel="stylesheet"/>
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.min.css" rel="stylesheet" />
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
		.ios7ain{
		width: 1.6em;
		height: 1.6em;
		background-image:url(data:image/png;base64,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);
		margin-top: -0.3em;
		background-size: auto 100%;	
		}
		.ath-ai{
		display: inline-block;
		vertical-align: middle;
		background-position: 50%;
		background-repeat: no-repeat;
		text-indent: -9999em;
		overflow: hidden;
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
	    <!-- fim div navbar-header -->
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
		if ($lvl == "1") {
		}else{
		echo "<a class='log-cor' href='perfil.php'>".$nome_log."</a>";
		}
		?>
	    </div>
	    <!-- fim div brand -->
		</div>
		<!-- fim div container -->
	    </div>
	    <!-- fim div logo-container -->
	    <div class="collapse navbar-collapse" id="navigation-index">
	    <?php
	    include 'assets/php/menus.php';
	    ?>
	    </div>
	    <!-- fim div collapse navbar-collapse -->
		</div>
		<!-- fim div logo -->
		</nav>
		<!-- fim div Navbar navbar-fixed-top -->
	<div class="wrapper" style="margin-top: -110px!important;">
	<div class="header"></div>
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main main-raised">
	<div class="container">
	<!-- here you can add your content -->
		<div class="section text-center section-landing">
		    <div class="row">
		    <div class="col-md-8 col-md-offset-2">
		    <h3 class="title">Como funciona</h3>
		    <p class="description">Para usar o QISeventos é bem simples: primeiro crie seu perfil clicando <a href="cadastro.php">aqui</a>. Após criar o seu perfil de usuário você terá acesso a todas as funcionalidades que incluem seguir e favoritar seus anúncios preferidos, ver fotos, assistir a vídeos, realizar comentários, classificá-los e ver seus meios de contatos para contratá-los. Ao favoritar você pode vê-lo mais tarde em seu perfil, na aba "seguindo" para que possa entrar em contato novamente ou ver suas novidades.</p>
		    <p>PS: ao utilizar nossa plataforma em seu dispositivo mobile (celular ou tablet), você poderá baixar nosso aplicativo que aparecerá para baixar ao acessar o site via android. Para iphone será exibida a mensagem de como baixar, clicando no <span class="ios7ain ath-ai"></span> e então em tela de início</p>
		    <p>PS: Caso não permita que a gente busque a sua localização no inicio, as buscas e propagandas exibirão quem quer anunciar em TODOS os estados e cidades. (Você poderá alterar ao pesquisar pelo estado e cidade que deseja)</p>
		    </div>
		    <!-- fim div col-md-8 col-md-offset-2 -->
		    </div>
		    <!-- fim div row -->
	        <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	        <h3 class="title">Publique</h3>
	        <p class="description">Caso você forneça algo para eventos você pode mudar o seu perfil para um perfil profissional. Com seu perfil profissional será possível divulgar informações a respeito de seu trabalho, incluir descrições, fotos, vídeos e tudo mais que julgar necessário para que seja contactado.
			Existem 3 tipos de perfis prossionais:
			<a href="premium.php">Básico, Premium e Master.</a></p>
			<p>PS: Para nosso sistema se manter sempre atualizado, nós excluimos contas que ficam mais de 2 meses sem entrar. Portanto não fique mais de 2 meses sem entrar na sua conta, mantenha atualizada e divulgue o seu link (qiseventos.com.br/seunome) para seu trabalho ter visualizações!</p>
			<p><b>PS</b>: Nosso sistema de ranqueamento é composto por 3 pontos: conta premium, número de acesso e seu rate (quantas estrelas possui). Com base nisso, mostraremos os resultados para quem pesquisar conforme sua categoria e entre outros.</p>
	        </div>
	        <!-- fim div col-md-8 col-md-offset-2 -->
	        </div>
	        <!-- fim div row -->
	        <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	        <h3 class="title">Anuncie sua propaganda</h3>
	        <p class="description">Caso tenha interesse em divulgar banners (uma propaganda de seu trabalho, algum evento futuro ou etc) em alguma das áreas do nosso site você deve clicar em <a href="anunciar.php">propaganda</a> e escolher a área que tem interesse em divulgar. Ao escolher a área desejada você deve clicar em continuar, selecionar a data que sua propaganda deverá ficar no ar, colocar um link (para quem ver sua propaganda clicar e entrar no site desejado), selecionar o estado que deverá exibir sua propaganda e fazer o upload da imagem. Após realizar o pagamento ela será automaticamente iniciada na data agendada.</p>
	        <p><small>Qualquer dúvida em relação ao nossos termos de política de privacidade <a href="politica-privacidade.html" target="_blank">leia aqui</a></small></p>
	        </div>
	        <!-- fim div col-md-8 col-md-offset-2 -->
	        </div>
	        <!-- fim div row -->
	        <!-- contato -->
	        <div class="section landing-section" style="text-align: left;">
	        <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	        <a name="us"></a>
            <h2 class="text-center title">Ainda com dúvida ? fale conosco!</h2>
			<h4 class="text-center description">Caso tenha alguma dúvida, entre em contato conosco pelo nosso e-mail.</h4>
            <form class="contact-form" id="forma" action="assets/php/email_nos.php" method="POST">
	        	<div class="row">
		            <div class="col-md-6">
					<div class="form-group label-floating">
					<label class="control-label">Seu nome</label>
					<input type="text" class="form-control" name="nome" required/>
					</div>
					<!-- fim div form-group label-floating -->
		            </div>
		            <!-- fim div col-md-6 -->
	            	<div class="col-md-6">
					<div class="form-group label-floating">
					<label class="control-label">Seu e-mail</label>
					<input type="email" class="form-control" name="email" required/>
					<input type="hidden" name="local" value="ajuda"/>
					<input type="hidden" id="hora" name="hora" value=""/>
					</div>
					<!-- fim div form-group label-floating -->
	                </div>
	                <!-- fim div col-md-6 -->
	            </div>
	            <!-- fim div row -->
				<div class="form-group label-floating">
					<label class="control-label">Sua mensagem</label>
					<textarea class="form-control" rows="4" name="texto" required></textarea>
				</div>
				<!-- fim div form-group label-floating -->
	            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
	            <button type="button" class="btn btn-primary btn-raised" onclick="envio();">
				<i class="material-icons">send</i>&nbsp;Enviar
				</button>
	            </div>
	            <!-- fim div col-md-4 col-md-offset-4 text-center -->
                </div>
                <!-- fim div row -->
			</form>
	        </div>
	        <!-- fim div col-md-8 col-md-offset-2 -->
	        </div>
	        <!-- fim row -->

	<div class="adsfooter col-md-12 col-sm-offset-2">
	<!-- anuncio-retangular-footer -->
	<?php if (mysqli_num_rows($aj_prop_rodape) == 0) { ?>
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
	<a href="assets/php/clic_prop.php?id_prop=<?php echo $aj_id_prop_5_noum; ?>&local=<?php echo $aj_local6; ?>" target="_blank"><img src="<?php echo $aj_img_prop_5_noum; ?>" /></a>
	<?php
	// chama a funcao de visualizar
	visualiza_prop($aj_local6,$aj_id_prop_5_noum, $con);
	} ?>
	</div>

			</div>
			<!-- fim div section landing-section e CONTATO -->
		</div>
		<!-- fim div section text-center section-landing -->
	</div>
	<!-- fim div container -->
	</div>
	<!-- fim div main main-raised -->
<div id="testenoti">
<div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
</div>
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
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/nouislider.min.js" type="text/javascript" async></script>
<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="assets/js/material-kit.min.js" type="text/javascript"></script>
<script>
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
	function envio() {
		// pega a data e hora do momento do envio
		localtime = new Date();
		document.getElementById("hora").value = localtime;
		if ( !(document.getElementById("hora").value == "") ) {
			//faz o submit
			document.getElementById("forma").submit();
		}
	}
</script>