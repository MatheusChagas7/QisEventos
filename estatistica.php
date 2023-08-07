<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';
//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache_visitante.php';

// se excluir a propaganda retorna feito
$done = $_GET['res'];
// id da propaganda para mostrar os detalhes
$prop = $_GET['prop'];

// pegar o dia atual
$hoje = date("d") . "/" . date("m") . "/" . date("Y");

// trata as paginas para retirar as ","
function tratarpag($var){
	$var = str_replace(',', ' ', $var);
	return $var;
}
// pega as propagandas pelo id do usuario
$query_all =  mysqli_query($con,"SELECT id_propaganda,pagina FROM propaganda WHERE fk_propaganda_usu = '$id_log' AND ativo=1");
$cont_all =mysqli_num_rows($query_all);

if (!empty($prop)) {
	// propaganda, pega algumas outras info
	$query_prop =  mysqli_query($con,"SELECT dt_propaganda,dt_inicio,dt_fim,url_redi,estado,cidade FROM propaganda WHERE id_propaganda = '$prop'");
	$row_prop = mysqli_fetch_assoc($query_prop);
	$url_prop = $row_prop['url_redi'];
	$estado_propbd = $row_prop['estado'];
	$cidade_propbd = $row_prop['cidade'];
	$dt_inicio = $row_prop['dt_inicio'];
	$dt_fim = $row_prop['dt_fim'];

	// busca imagem
	$query_img =  mysqli_query($con,"SELECT imagem_propaganda1,imagem_propaganda2,imagem_propaganda3,imagem_propaganda4,imagem_propaganda5,imagem_propaganda5m FROM propaganda WHERE id_propaganda = '$prop'");
	$row_img = mysqli_fetch_assoc($query_img);

	// 1
	if (!empty($row_img['imagem_propaganda1']) ) {
		$imagem1 = $row_img['imagem_propaganda1'];
	}
	// 2
	if (!empty($row_img['imagem_propaganda2']) ) {
		$imagem2 = $row_img['imagem_propaganda2'];
	}
	// 3
	if (!empty($row_img['imagem_propaganda3']) ) {
		$imagem3 = $row_img['imagem_propaganda3'];
	}
	// 4
	if (!empty($row_img['imagem_propaganda4']) ) {
		$imagem4 = $row_img['imagem_propaganda4'];
	}
	// 5
	if (!empty($row_img['imagem_propaganda5']) ) {
		$imagem5 = $row_img['imagem_propaganda5'];
	}
	// 5m
	if (!empty($row_img['imagem_propaganda5m']) ) {
		$imagem5m = $row_img['imagem_propaganda5m'];
	}

	//info contador da propaganda selecionada
	$var = $row_cont['campo'];
	// numero TOTAL de visu
	$query_tv =  mysqli_query($con,"SELECT id_cont FROM contador WHERE qtd_visu=1 ");
	$cont_tv = mysqli_num_rows($query_tv);
	// numero TOTAL de cliques
	$query_tc =  mysqli_query($con,"SELECT id_cont FROM contador WHERE qtd_clique=1 ");
	$cont_tc = mysqli_num_rows($query_tc);
	// numero de cliques
	$query_cliq =  mysqli_query($con,"SELECT id_cont FROM contador WHERE fk_cont_prop = '$prop' AND qtd_clique=1 ");
	$cont_cliq = mysqli_num_rows($query_cliq);
	// numero de visualizacoes
	$query_visu =  mysqli_query($con,"SELECT id_cont FROM contador WHERE fk_cont_prop = '$prop' AND qtd_visu=1 ");
	$cont_visu = mysqli_num_rows($query_visu);

	// cria o calculo das visu e cliques
	if (!empty($cont_visu)) {
		$res_v = $cont_visu / $cont_tv;
		$res_total_v = $res_v * 100;
		$resultado_v = number_format($res_total_v, 2, '.', '');
		if ( empty($resultado_v) ) {
			$resultado_v = "0";
		}
	}else{$resultado_v = "0";}

	if (!empty($cont_cliq)) {
		$res_c = $cont_cliq / $cont_tc;
		$res_total_c = $res_c * 100;
		$resultado_c = number_format($res_total_c, 2, '.', '');
		if ( empty($resultado_c) ) {
			$resultado_c = "0";
		}
	}else{$resultado_c = "0";}

}else{
	$resultado_v = "0";
	$resultado_c = "0";
} // fim if

?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - Estatísticas</title>
	<meta charset="utf-8" />
	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<!-- tag og share face -->
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/estatistica.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Veja como anda suas propagandas - QISeventos">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Acompanhe as estatisticas de suas propagandas - QISeventos">
	<meta property="og:type" content="website">
	<!-- titulo -->
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<!-- mobile -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<!-- manifest / sw-->
	<link rel="manifest" href="assets/js/manifest.json">
	<script src="service-worker.js" type="text/javascript"></script>
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
		.previa_prop{
		max-width: 50%;
		height: auto;
		}
		.limite_prop{
		overflow-y: scroll;
		height:auto; 
		max-height:258px;
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
		<i class='material-icons' style='color: #fff;'>notifications</i></a>";
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
	<!-- info de limite de tamanho de imagem upada -->
	<div style='z-index:9999; position:absolute; display: none;' class='alert alert-danger' id="info_erro_up">
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' aria-label='Close' onclick="$('#info_erro_up').css('display', 'none')">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>ERRO AO SUBIR IMAGEM:</b>O tamanho excedeu o limite. Limite de imagem é de 3 MB. Por favor tente novamente.
	</div>
	</div>
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
	<?php include 'assets/php/menus-index.html'; ?>
	<!-- termino do menu variavel -->
	</div>
	<!-- collapse navbar-collapse -->
	</div>
	<!-- container -->
	<?php include 'assets/php/alerts.php';?>
	<?php
	if ($done == "feito") {
	echo "<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Propaganda excluida com sucesso!
	</div>
	</div>";
	}else if($done == "alterado"){
	echo "<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Propaganda alterada com sucesso!
	</div>
	</div>";
	}
	?>
	</nav>
	<!-- End Navbar -->
<div class="wrapper" style="margin-top: -100px!important;">
<div class="header"></div>
<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
<div class="main main-raised">
<div class="container">
	<!-- here you can add your content -->
	<div class="section text-center section-landing">
	<div class="row">
	<div class="col-md-6">
	<!-- caixa de informacao -->
	<div class="box box-solid">
	<div class="box-body no-padding">
	<h3 class="box-title">Estatísticas</h3>
	<ul class="nav nav-pills nav-stacked">
		<li>Nessa área você pode acompanhar estatísticas de seus banners para melhor acompanhamento do retorno de seu investimento. Lembrando que para melhor aproveitamento dos banners, boas fotos e com pouca quantidade de texto são fundamentais para um melhor resultado.</li>
		<li>Uma regra dos banners é não conter: endereço, telefone e nenhuma informação que realize o contato direto com a sua empresa. Essas informações serão exibidas dentro da página "saiba mais" de cada banner e é importante para sabermos de que forma cada cliente tem entrado em contato com você, quantos clientes e assim gerarmos um relatório mais preciso.</li>
		<li><b>OBS:</b> Caso queira alterar uma propaganda, selecione a propaganda desejada e abaixo da prévia você poderá altera-la.</li>
	</ul>
	</div>
	</div>
	</div>
	<!-- fim col-md-8 col-md-offset-2 -->
	<div class="col-md-6 limite_prop">
	<h3 class="title">Suas propagandas</h3>
	<div class="coluna coluna-12">
	<div class="linhag">
	<?php while ($row_all = mysqli_fetch_array($query_all)) { ?>
	<a href="?prop=<?php echo $row_all['id_propaganda'] ?>"><div class="coluna coluna-4" style="margin-bottom: 5px;"><?php echo tratarpag($row_all['pagina']) ?></div></a>
	<?php } ?>
	<?php if(empty($cont_all)){ ?>
	<h5>Sem propagandas ? <a href="anunciar.php">Anuncie agora !</a></h5>
	<?php } ?>
	</div>
	<!-- fim linhag -->
	<!-- <a id="btn-menu" href="#" class="btn btn-primary btn-lg">Ver geral</a> -->
	</div>
	<!-- fim coluna coluna-12 -->
	</div>
	<!-- fim col-md-8 col-md-offset-2 -->
	</div>
	<!-- fim row -->
	<?php if(!empty($prop)){ ?>
	<div class="row">
	<!-- visualizações -->
	<div class="col-md-6" style="margin-bottom: 50px;">
	<div class="col-md-5 col-md-offset-0">
	<div id="graph-visu" style="height: 150px; width: 100%;"></div>
		<h5>Visualizações <n style="color: #FF8C00;"><?php echo $resultado_v ?></n>/100</h5>
	</div>
	<h5 class="description">Esse gráfico representa a quantidade de pessoas que viu sua propaganda pelo site até o momento (<?php echo $hoje ?>).</h5>
	</div>
	<!-- caixa de informacao -->
	<div class="col-md-6" style="margin-bottom: 50px;">
	<div class="box box-solid">
	<div class="box-body no-padding">
	<h3 class="box-title"></h3>
	<ul class="nav nav-pills nav-stacked">
		<li>Você recebeu <?php echo $resultado_v ?>% de visualizações de 100%.</li>
		<li>Você recebeu <?php echo $resultado_c ?>% de cliques de 100%.</li>
		<li><b>data de exibição: <?php echo $dt_inicio ?> até <?php echo $dt_fim ?></b></li>
		<li> <b>obs:</b>o total(100%), é todos os nossos cliques/visualizações de todas as propagandas que estão rodando em nosso site.</li>
	</ul>
	</div>
	</div>
	</div>
	</div>
	<!-- fim row -->
	<!-- cliques -->
	<div class="row">
	<div class="col-md-6">
	<div class="col-md-5 col-md-offset-0">
	<div id="graph-cliq" style="height: 150px; width: 100%;"></div>
		<h5>Cliques <n style="color: #FF8C00;"><?php echo $resultado_c ?></n>/ 100</h5>
	</div>
	<!-- fim col-md-5 col-md-offset-0 -->
	<h5 class="description">Esse gráfico mostra quantos cliques sua propaganda recebeu até o momento (<?php echo $hoje ?>).</h5>
	</div>
	<!-- fim col-md-6 -->
	<!-- fim col-md-6 -->
	<div class="col-md-6" style="margin-bottom: 50px;">
	<h5 style="margin-top: -2px;">Previa da propaganda escolhida:</h5>
	<!-- aqui você pode alterar a imagem -->
	<form action="assets/php/alterar_prop.php" method="post">
		<h5>*Deseja alterar essa imagem ou o link para redirecionar?</h5>
		<small>* altere a imagem com o tamanho adequado, equivalente ao quadro de <a href="anunciar.php" target="_blank">tamanho</a>. A url alterada será igual para todos os links ligados a esta propagandas em outros tamanhos existentes.</small><br/>
		<?php if(!empty($imagem1)){ ?>
		<p><b>imagem slide principal</b></p>
		<!-- previa da img -->
		<img src="<?php echo $imagem1 ?>" class="previa_prop" id="prev_img1" />
		<!-- subir nova imagem -->
		<input type="file" id="anuncio1" name="anuncioalt1" alt="arquivo anuncio" accept="image/x-png"/>
		<input type="hidden" name="txtanun1" id="txtanun1">
		<?php } ?>
		<?php if(!empty($imagem2)){ ?>
		<p><b>imagem lateral </b></p>
		<!-- previa da img -->
		<img src="<?php echo $imagem2 ?>" class="previa_prop"/>
		<!-- subir nova imagem -->
		<input type="file" id="anuncio2" name="anuncioalt2" alt="arquivo anuncio" accept="image/x-png"/>
		<input type="hidden" name="txtanun2" id="txtanun2">
		<?php } ?>
		<?php if(!empty($imagem3)){ ?>
		<p><b>imagem lateral 3 pequena</b></p>
		<!-- previa da img -->
		<img src="<?php echo $imagem3 ?>" class="previa_prop"/>
		<!-- subir nova imagem -->
		<input type="file" id="anuncio3" name="anuncioalt3" alt="arquivo anuncio" accept="image/x-png"/>
		<input type="hidden" name="txtanun3" id="txtanun3">
		<?php } ?>
		<?php if(!empty($imagem4)){ ?>
		<p><b>imagem slide rodapé</b></p>
		<!-- previa da img -->
		<img src="<?php echo $imagem4 ?>" class="previa_prop"/>
		<!-- subir nova imagem -->
		<input type="file" id="anuncio4" name="anuncioalt4" alt="arquivo anuncio" accept="image/x-png"/>
		<input type="hidden" name="txtanun4" id="txtanun4">
		<?php } ?>
		<?php if(!empty($imagem5)){ ?>
		<p><b>imagem retangular(rodapé)</b></p>
		<!-- previa da img -->
		<img src="<?php echo $imagem5 ?>" class="previa_prop"/>
		<!-- subir nova imagem -->
		<input type="file" id="anuncio5" name="anuncioalt5" alt="arquivo anuncio" accept="image/x-png"/>
		<input type="hidden" name="txtanun5" id="txtanun5">
		<?php } ?>
		<?php if(!empty($imagem5m)){ ?>
		<p><b>imagem rodapé - mobile</b></p>
		<!-- previa da img -->
		<img src="<?php echo $imagem5m ?>" class="previa_prop"/>
		<!-- subir nova imagem -->
		<input type="file" id="anuncio6" name="anuncioalt5m" alt="arquivo anuncio" accept="image/x-png"/>
		<input type="hidden" name="txtanun6" id="txtanun6">
		<?php } ?>
		<!-- id da propaganda -->
		<input type="hidden" name="id_prop" value="<?php echo $prop ?>" />
		<!-- alterar url -->
		<h4>Redirecionamento<small>(link para redirecionar ao clicar em sua propaganda)</small></h4>
		<input type="text" class="form-control" id="url_redi" name="url_redi" placeholder="www.meusite.com..." value="<?php echo $url_prop ?>" required />
		<!-- alterar estado -->
		<h4>Estado<small>(UF)</small></h4>
		<select class="form-control" id="estado_alt" name="estado_alt">
		</select>
		<!-- alterar cidade -->
		<h4>Cidade</h4>
		<select class="form-control" id="cidade_alt" name="cidade_alt">
		</select>
		<button id="btn-menu" type="submit" class="btn btn-primary btn-lg btnalt" disabled="disabled">ALTERAR</button>
	</form>
	<button data-toggle='modal' data-target='#ex_prop' data-html='true' id="btn-menu" type="button" class="btn btn-primary btn-lg">EXCLUIR</button>
	<small>(ao excluir a propaganda, você vai excluir as imagens do sistema, suas estatisticas sobre esta propaganda. Ela não aparecerá mais sobre suas propagandas e nem rodará mais pelo sistema, essa ação é irreversível)</small>
	</div>
	<!-- fim col-md-6 -->
	</div>
	<!-- fim row -->
	<?php }else{ ?>
	<h3 class="text-center">SELECIONE UMA DE SUAS PROPAGANDAS PARA VER SUAS ESTATÍSTICAS.</h3>
	<?php } ?>
	<!-- contato -->
	<div class="row">
	<div class="section landing-section" style="text-align: left;">
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h2 class="text-center title">Melhore seu resultado!</h2>
		<h4 class="text-center description">Anuncie em mais banners pelo site, <a href="anunciar.php" >clique aqui</a> e melhore seu rendimento de cliques e visualizações! </h4>
	</div>
	<!-- fim col-md-8 col-md-offset-2 -->
	</div>
	<!-- fim row -->
	</div>
	<!-- fim section landing-section -->
	</div>
	<!-- fim row -->
<!-- 			<small>Obs: Certifique-se de que a imagem que foi realizado o upload está correta, pois todas as imagens de banners vão para avaliação e após isso caso sejam aceitas, poderão levar até 48 horas para serem alteradas.Para saber mais sobre nossas políticas de privacidade e direito de imagens clique <a href="politica-privacidade.html">AQUI</a>.</small> -->
</div>
<!-- fim container -->
</div>
<!-- fim main main-raised -->
</div>
<!-- class wrapper /. -->

<!-- confirmar a exclusao da propaganda -->
<div class="modal fade" id="ex_prop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
	<i class="material-icons">clear</i>
	</button>
	<h4 class="modal-title">EXCLUIR PROPAGANDA</h4>
</div>
<div class="modal-body">
<form method="post" action="assets/php/excluir_prop.php">
<p>confirmar senha:</p>
<input type="hidden" name="id_propex" value="<?php echo $prop ?>" />
<input type="password" name="senha_exprop" />
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancelar</button>
<button type="submit" class="btn btn-default btn-simple">CONTINUAR ?</button>
</div>
</form>
</div>
</div>
</div>
<div id="testenoti">
	<div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
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
<script type="text/javascript" src="assets/js/cidades-estados-1.2-utf8.js" type="text/javascript"></script>
<script src="assets/js/canvasjs.min.js" type="text/javascript"></script>
<script type="text/javascript">
window.onload = function () {
	// VISUALIZACOES
	var chartv = new CanvasJS.Chart("graph-visu",{
	animationEnabled: true,
	data: [{
		type: "doughnut",
		indexLabelFontColor: "dimgrey",
		indexLabelLineColor: "darkgrey",
		dataPoints: [
		{ y: 100},
		{ y: <?php echo $resultado_v ?>}
	]
	}]
	});
	chartv.render();
	// CLIQUES
	var chartc = new CanvasJS.Chart("graph-cliq",{
		animationEnabled: true,
		data: [{
		type: "doughnut",
		indexLabelFontColor: "dimgrey",
		indexLabelLineColor: "darkgrey",
		dataPoints: [
		{ y: 100},
		{ y: <?php echo $resultado_c ?>}
		]
	}]
	});
	chartc.render();
	}
$(document).ready(function(){

// ao subir uma imagem no anuncio1
$("#anuncio1").change(function(e) {

	// limitar tamanho da foto upada
	var upload1 = document.getElementById("anuncio1");
	var size1 = upload1.files[0].size;
	if(size1 <= (1048576 * 3) ) { //1MB x 3 = 3MB
	//Abaixo do permitido
		// function para converter a imagem em base64
		function getBase64(file) {
   		var reader = new FileReader();
   		reader.readAsDataURL(file);
   		reader.onload = function () {
   		// coloca a base64 em um input
   		$("#txtanun1").val(reader.result);
		// exec a funcao
		verifylocal();
     	// console.log(reader.result);
   		};
		reader.onerror = function (error) {
		console.log('Error: ', error);
		};
		}

		var anuncio1 = getBase64( document.querySelector('#anuncio1').files[0] );

	} else {
	//acima do permitido
		$("#info_erro_up").css("display", "block");
		upload1.value = ""; //Limpa o campo
		e.stopPropagation();
	}
	e.preventDefault();

})

// ao subir uma imagem no anuncio2
$("#anuncio2").change(function(e) {

	// limitar tamanho da foto upada
	var upload2 = document.getElementById("anuncio2");
	var size2 = upload2.files[0].size;
	if(size2 <= (1048576 * 3) ) { //1MB x 3 = 3MB
	//Abaixo do permitido
		// function para converter a imagem em base64
		function getBase64(file) {
   		var reader = new FileReader();
   		reader.readAsDataURL(file);
   		reader.onload = function () {
   		// coloca a base64 em um input
   		$("#txtanun2").val(reader.result);
		// exec a funcao
		verifylocal();
     	// console.log(reader.result);
   		};
		reader.onerror = function (error) {
		console.log('Error: ', error);
		};
		}

		var anuncio2 = getBase64( document.querySelector('#anuncio2').files[0] );

	} else {
	//acima do permitido
		$("#info_erro_up").css("display", "block");
		upload2.value = ""; //Limpa o campo
		e.stopPropagation();
	}
	e.preventDefault();

})

// ao subir uma imagem no anuncio3
$("#anuncio3").change(function(e) {

	// limitar tamanho da foto upada
	var upload3 = document.getElementById("anuncio3");
	var size3 = upload3.files[0].size;
	if(size3 <= (1048576 * 3) ) { //1MB x 3 = 3MB
	//Abaixo do permitido
		// function para converter a imagem em base64
		function getBase64(file) {
   		var reader = new FileReader();
   		reader.readAsDataURL(file);
   		reader.onload = function () {
   		// coloca a base64 em um input
   		$("#txtanun3").val(reader.result);
		// exec a funcao
		verifylocal();
     	// console.log(reader.result);
   		};
		reader.onerror = function (error) {
		console.log('Error: ', error);
		};
		}

		var anuncio3 = getBase64( document.querySelector('#anuncio3').files[0] );

	} else {
	//acima do permitido
		$("#info_erro_up").css("display", "block");
		upload3.value = ""; //Limpa o campo
		e.stopPropagation();
	}
	e.preventDefault();

})

// ao subir uma imagem no anuncio4
$("#anuncio4").change(function(e) {

	// limitar tamanho da foto upada
	var upload4 = document.getElementById("anuncio4");
	var size4 = upload4.files[0].size;
	if(size4 <= (1048576 * 3) ) { //1MB x 3 = 3MB
	//Abaixo do permitido
		// function para converter a imagem em base64
		function getBase64(file) {
   		var reader = new FileReader();
   		reader.readAsDataURL(file);
   		reader.onload = function () {
   		// coloca a base64 em um input
   		$("#txtanun4").val(reader.result);
		// exec a funcao
		verifylocal();
     	// console.log(reader.result);
   		};
		reader.onerror = function (error) {
		console.log('Error: ', error);
		};
		}

		var anuncio4 = getBase64( document.querySelector('#anuncio4').files[0] );

	} else {
	//acima do permitido
		$("#info_erro_up").css("display", "block");
		upload4.value = ""; //Limpa o campo
		e.stopPropagation();
	}
	e.preventDefault();

})

// ao subir uma imagem no anuncio5
$("#anuncio5").change(function(e) {

	// limitar tamanho da foto upada
	var upload5 = document.getElementById("anuncio5");
	var size5 = upload5.files[0].size;
	if(size5 <= (1048576 * 3) ) { //1MB x 3 = 3MB
	//Abaixo do permitido
		// function para converter a imagem em base64
		function getBase64(file) {
   		var reader = new FileReader();
   		reader.readAsDataURL(file);
   		reader.onload = function () {
   		// coloca a base64 em um input
   		$("#txtanun5").val(reader.result);
		// exec a funcao
		verifylocal();
     	// console.log(reader.result);
   		};
		reader.onerror = function (error) {
		console.log('Error: ', error);
		};
		}

		var anuncio5 = getBase64( document.querySelector('#anuncio5').files[0] );

	} else {
	//acima do permitido
		$("#info_erro_up").css("display", "block");
		upload5.value = ""; //Limpa o campo
		e.stopPropagation();
	}
	e.preventDefault();

})

// ao subir uma imagem no anuncio5 mobile
$("#anuncio6").change(function(e) {

	// limitar tamanho da foto upada
	var upload6 = document.getElementById("anuncio6");
	var size6 = upload6.files[0].size;
	if(size6 <= (1048576 * 3) ) { //1MB x 3 = 3MB
	//Abaixo do permitido
		// function para converter a imagem em base64
		function getBase64(file) {
   		var reader = new FileReader();
   		reader.readAsDataURL(file);
   		reader.onload = function () {
   		// coloca a base64 em um input
   		$("#txtanun6").val(reader.result);
		// exec a funcao
		verifylocal();
     	// console.log(reader.result);
   		};
		reader.onerror = function (error) {
		console.log('Error: ', error);
		};
		}

		var anuncio6 = getBase64( document.querySelector('#anuncio6').files[0] );

	} else {
	//acima do permitido
		$("#info_erro_up").css("display", "block");
		upload6.value = ""; //Limpa o campo
		e.stopPropagation();
	}
	e.preventDefault();

})
// funcao para verificar se o estado e cidade estao preenchidos
function verifylocal() {
	if ( $("#estado_alt").val() !== "" && $("#cidade_alt").val() !== "" ) {
		$(".btnalt").removeAttr("disabled", "disabled");
	}else{
		$(".btnalt").attr("disabled", "disabled");
	}
}

// scrípt cidade e estado
	new dgCidadesEstados({
		cidade: document.getElementById('cidade_alt'),
		estado: document.getElementById('estado_alt'),
		estadoVal: '<?php echo $estado_propbd ?>',
		cidadeVal: '<?php echo $cidade_propbd ?>'
	})
	// gera o valor TODOS nos estados
	$('#estado_alt').append($('<option>', {
		value: 'all',
		text: 'Todos'
	}));

	$('#cidade_alt').append($('<option>', {
		value: 'all',
		text: 'Todos'
	}));

	// cada vez q eu selecione um estado, add todos nas cidades
	$("#estado_alt").change(function(e) {
		// exec a funcao
		verifylocal();
		$('#cidade_alt').append($('<option>', {
			value: 'all',
			text: 'Todos'
		}));
	})
	$("#cidade_alt").change(function(e) {
		// exec a funcao
		verifylocal();
	})
	// se o estado for all, deixa o option todos selecionado
	if ( '<?php echo $estado_propbd ?>' == 'all' ) { $("#estado_alt").val("all"); }
	// se a cidade for all, deixa o option todos selecionado
	if ( '<?php echo $cidade_propbd ?>' == 'all' ) { $("#cidade_alt").val("all"); }

})
// fim document ready
</script>
