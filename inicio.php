<?php
header( 'Content-Type: text/html; charset=utf8' );
	//fara a conexao com banco de dados
	// include_once 'assets/php/conexao.php';
	//chama a cache, para verificar o cache se esta logado
	// include_once 'assets/php/cache.php';
	// propagandas
	// include_once 'assets/php/propaganda.php';
	// visualizacao de propaganda
	// include_once 'assets/php/visu_prop.php';

	// parametro
	$parametro = $_GET["search"];
	// categoria
	$categoria = $_GET["categoria"];
	// sub-categoria
	$sub_categoria = $_GET["sub"];

	// estado
	switch (true) {
		case empty($_POST["estado"]) && empty($_GET["estado"]) :
			$estado = "RJ";
			break;
		case empty($_POST["estado"]) :
			$estado = $_GET["estado"];
			break;
		case empty($_GET["estado"]) :
			$estado = $_POST["estado"];
			break;
		default:
			$estado = "RJ";
			break;
	}

	// cidade
	switch (true) {
		case empty($_POST["cidade"]) && empty($_GET["cidade"]) :
			$cidade = "all";
			break;
		case empty($_POST["cidade"]) :
			$cidade = $_GET["cidade"];
			break;
		case empty($_GET["cidade"]) :
			$cidade = $_POST["cidade"];
			break;
		default:
			$cidade = "all";
			break;
	}

	// organizar
	if ( empty( $_GET['relevante'] ) ) {
		$ordenar = 'ORDER BY pacote_usu DESC,n_acesso DESC,rating DESC';
	}else{
		$ordenar = $_GET['relevante'];
	}
	// registro por pagina
	if ( empty( $_GET['rpp'] ) ) {
		$rpp = "10";
	}else{
		$rpp = $_GET['rpp'];
	}
	// apos escolher uma categoria, buscar todas as subs
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		// usado para manter a sub-categoria apos a busca
		$query_sub = "SELECT * FROM categoria WHERE nome_categoria='$categoria'";
		$row_sub = mysqli_query($con,$query_sub);
		$optiona = '';
		while($row = mysqli_fetch_assoc($row_sub)){
			if ($row['nome_sub_categoria'] == $sub_categoria) {
				$optiona .= '<option value = "'.$row['nome_sub_categoria'].'" selected="selected" >'.$row['nome_sub_categoria'].'</option>';
			}else{
				$optiona .= '<option value = "'.$row['nome_sub_categoria'].'" >'.$row['nome_sub_categoria'].'</option>';
			}
		}
	}
	// ------------------------------------------ NOVO FILTRO --------------------------------------------------
	include_once 'assets/php/mecanismo_search.php';
	// ------------------------------------------ NOVO FILTRO --------------------------------------------------
	// contador de btns do favorito
	$i_fav = 0;
	// PAGINACAO DAS BUSCAS
	$total_reg = $rpp; // numero de registros por página
	//Se a página não for especificada a variável "pagina" tomará o valor 1, isso evita de exibir a página 0 de início:
	$pagina=$_GET['pagina'];
	if (!$pagina) {
		$pc = "1";
	} else {
		$pc = $pagina;
	}
	//Vamos determinar o valor inicial das buscas limitadas:
	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;  
	//Vamos selecionar os dados e exibir a paginação:
	$limite_bsc = mysqli_query($con,"$get LIMIT $inicio,$total_reg");
	$todos = mysqli_query($con,$get);
	$tr = mysqli_num_rows($todos); // verifica o número total de registros
	$tp = $tr / $total_reg; // verifica o número total de páginas

?>
<!doctype html>
<html lang="pt-br">
	<head>
		<title>QISeventos - Bem Vindo</title>
		<meta charset="utf-8" />
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
		<link rel="icon" type="image/png" href="assets/img/favicon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="theme-color" content="#4B4B4D"/>
		<meta property="og:locale" content="pt_BR">
		<meta property="og:url" content="http://www.qiseventos.com.br">
		<meta property="og:title" content="QISeventos">
		<meta property="og:site_name" content="QISeventos">
		<meta property="og:description" content="Tudo para seu evento esta bem aqui!">
		<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
		<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
		<meta property="og:image:type" content="image/jpeg">
		<meta property="og:image:width" content="200"> <!-- pixel -->
		<meta property="og:image:height" content="200"> <!-- pixel -->
		<meta name="description" content="QISeventos é uma plataforma para encontrar serviços de diversos segmentos para seu evento. Encontre DJ's, buffet, decorações e muito mais!">
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
	    <link href="assets/css/material-kit.min.css" rel="stylesheet"/>
	    <link href="assets/css/sly.min.css" rel="stylesheet"/>
		<!-- CSS Just for demo purpose, don't include it in your project -->
		<link href="assets/css/demo.min.css" rel="stylesheet" />
		<link href="assets/sass/material-kit/_example-pages.scss" rel="stylesheet" type="text/html"/>
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
		.search-dv{
		display: inline-flex;
		width: -webkit-fill-available;
		}
		.search-but{
    	margin-right: 0px;
    	margin-left: 0px;
    	margin-top: 0px;
    	padding: 10px 17px!important;
		}
		@media screen and (max-width: 959px) {
		.mobcompact{
		overflow: hidden;
    	white-space: nowrap;
    	height: 70px;
		}
		}
	    </style>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113		358016-1"></script>
		<script>
  		window.dataLayer = window.dataLayer || [];
  		function gtag(){dataLayer.push(arguments);}
  		gtag('js', new Date());

  		gtag('config', 'UA-113358016-1');
		</script>


		<script src="//cdn.pushbots.com/js/sdk.min.js" type="text/javascript" onload="PB.init()" async></script>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	</head>
	<body id="b_n" class="index-page">
	<!-- notificacao em primeiro plano/alert -->
	<?php include 'assets/php/notificacao-alert.php';?>
	<!-- Navbar -->
	<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
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
	<?php include 'assets/php/menus-index.html'; ?>
	<!-- termino do menu variavel -->
	</div>
	<!-- collapse navbar-collapse -->
	</div>
	<!-- container -->
	</nav>
	<!-- End Navbar -->
	<div class="wrapper">
	<div class="header header-filter" id="capa-index">
	<div class="container">
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<div class="brand"></div> <!-- brand -->
	</div>
	<!-- col-md-8 col-md-offset-2 -->
	</div>
	<!-- row -->
	</div>
	<!-- container -->
	</div>
	<!-- header header-filter -->
	<div class="main main-raised">
	<div class="section section-basic">
	<div class="section" id="carousel" style="">
	<div class="container">
	<div class="row">
	<div class="col-md-9 col-md-offset-1" id="slide">
	<!-- Carousel Card -->
	<div class="card card-raised card-carousel" id="slideprin">
	<div id="imagens-slide" class="carousel slide" data-ride="carousel">
	<div class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
	<!--<li data-target="#imagens-slide" id="0" data-slide-to="0"></li>
		<li data-target="#imagens-slide" id="1" data-slide-to="1"></li>
		<li data-target="#imagens-slide" id="2" data-slide-to="2"></li>	
		<li data-target="#imagens-slide" id="3" data-slide-to="3"></li>
		<li data-target="#imagens-slide" id="4" data-slide-to="4"></li>-->
	</ol>
	<!-- Wrapper for slides-->
	<div class="carousel-inner">
		<?php 
		while ($conteudo_slide = mysqli_fetch_array($in_prop_slide)) {
		$id_prop_slidetop = $conteudo_slide['id_propaganda'];
		$img = $conteudo_slide['imagem_propaganda1'];
		$url_red = $conteudo_slide['url_redi'];
		?>
		<?php
		if ($i == 0) {
		echo "<a href='assets/php/clic_prop.php?id_prop=".$id_prop_slidetop."&local=".$local1."' target='_blank' class='item active imgl".$i."'>";
		}else{
		echo "<a href='assets/php/clic_prop.php?id_prop=".$id_prop_slidetop."&local=".$local1."' target='_blank' class='item imgl".$i."'>";
		}
		?>
		<xi <?php echo $i ?>data-img-src="<?php echo $img ?>" />
		<!--<div class="carousel-caption">
		<h5 class="haga5">VISITE-NOS PARA MAIS INFORMAÇÕES!</h5>
		</div> -->
		</a>
		<!-- tag a, dentro do if(php) -->
		<?php
		// chama a funcao de visualizar
		visualiza_prop($local1,$id_prop_slidetop, $con);
		$i++;
		}
		?>
	</div>
	<!-- fim carousel-inner -->
	<!-- Controls -->
	<a style="" class="left carousel-control" href="#imagens-slide" data-slide="prev">
	<i class="material-icons">keyboard_arrow_left</i>
	</a>
	<a style="" id="vai" class="right carousel-control" href="#imagens-slide" data-slide="next">
	<i class="material-icons">keyboard_arrow_right</i>
	</a>
	</div>
	<!-- carousel-slide -->
	</div>
	<!-- carousel-slide -->
	</div>
	<!-- card-carousel-->
	</div>
	<!-- col-md-9 col-md-offset-1 -->
	</div>
	<!-- row -->
	<!-- buscar a ancora  -->
	<a name="buscar"/>
	</div>
	<!-- container -->
	</div>
	<!-- section id carousel -->
	<!-- resultado -->
	<div class="container" id="conteudo">
	<!-- area de buscar -->
	<div class="col-sm-3 col-sm-offset-0 mobcompact" id="search-index">
	<!-- 1 form -->
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'] . '#buscar'; ?>">
	<div class="form-group">
		<h5 id="mobc">Categoria</h5>
		<input type="hidden" name="relevante" value="<?php echo $ordenar ?>">
		<input type="hidden" name="sub" value="<?php echo $sub_categoria ?>">
		<input type="hidden" name="search" value="<?php echo $parametro ?>" >
		<input type="hidden" name="estado" value="<?php echo $estado ?>">
		<input type="hidden" name="cidade" value="<?php echo $cidade ?>">
		<input type="hidden" name="rpp" value="<?php echo $rpp ?>">
		<select class="form-control" name="categoria" onchange="this.form.submit()">
		<option value="0">Categoria</option>
		<?php
		$result= mysqli_query($con,'SELECT DISTINCT nome_categoria FROM categoria ORDER BY nome_categoria'); ?>
		<?php while($row = mysqli_fetch_assoc($result)) { ?>
		<option value="<?php echo $row['nome_categoria'] ?>" <?php if ($row['nome_categoria'] == $categoria) { ?>selected="selected"<?php } ?>>
		<?php echo htmlspecialchars($row['nome_categoria']); ?>
		</option>
		<?php
		}
		?>
		</select>
	</div>
	<!-- form-group -->
	</form>
	<!-- fim 1 form -->
	<!-- 2 form -->
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'] . '#buscar'; ?>">
		<!-- campos para retornar ao get -->
		<input type="hidden" name="categoria" value="<?php echo $categoria ?>">
		<input type="hidden" name="relevante" value="<?php echo $ordenar ?>">
		<input type="hidden" name="search" value="<?php echo $parametro ?>" >
		<input type="hidden" name="rpp" value="<?php echo $rpp ?>">
		<!-- Sub-categoria -->
		<div class="form-group">
			<h5>Sub-categoria</h5>
			<select class="form-control" name="sub" onchange="this.form.submit()">
			<option value="0">Sub-categoria</option>
			<?php echo $optiona; ?>
			</select>
		</div>
		<!-- Regiao -->
		<div class="form-group">
		<h5>Estado</h5>
		<select class="form-control" id="estado" name="estado" onchange="this.form.submit()">
		</select>
		</div>
		<!-- form-group -->
		<!-- cidade -->
		<div class="form-group">
		<h5>Cidade</h5>
		<select class="form-control" id="cidade" name="cidade" onchange="this.form.submit()">
		<option value="0">Cidade</option>
		</select> 
		</div>
		<!-- form-group -->
		<div class="form-group search-dv">
	    <input type="text" value="<?php echo $parametro ?>" placeholder="Palavra-chave" class="form-control" name="search" />
	    <button type="submit" class="search-but btn btn-primary btn-lg" id="btn-search"><i class="material-icons">search</i></button>
		</div>
		<!-- search-dv -->
	</form>
	<!-- fim 2 form -->
	<!-- 3 form -->
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'] . '#buscar'; ?>">
		<!-- campos para retornar ao get -->
		<input type="hidden" name="categoria" value="<?php echo $categoria ?>">
		<input type="hidden" name="sub" value="<?php echo $sub_categoria ?>">
		<input type="hidden" name="relevante" value="<?php echo $ordenar ?>">
		<input type="hidden" name="search" value="<?php echo $parametro ?>" >
		<h5>Organizar</h5>
		<select class="form-control" name="relevante" onchange="this.form.submit()">
		<option value="ORDER BY pacote_usu DESC,n_acesso DESC,rating DESC" <?=($ordenar == 'ORDER BY pacote_usu DESC,n_acesso DESC,rating DESC')? 'selected' : ''?> >Mais Relevante</option>
		<option value="ORDER BY nome_completo ASC" <?=($ordenar == 'ORDER BY nome_completo ASC')? 'selected' : ''?> >Ordem Alfabética (A-Z)</option>
		<option value="ORDER BY nome_completo DESC" <?=($ordenar == 'ORDER BY nome_completo DESC')? 'selected' : ''?> >Ordem Alfabética (Z-A)</option>
		</select>
		<h5>N° registro por pagina</h5>
		<select class="form-control" name="rpp" onchange="this.form.submit()">
			<option value="10" <?=($rpp == '10')? 'selected' : ''?> >Padrão (10)</option>
			<option value="15" <?=($rpp == '15')? 'selected' : ''?> >15</option>
			<option value="20" <?=($rpp == '20')? 'selected' : ''?> >20</option>
			<option value="25" <?=($rpp == '25')? 'selected' : ''?> >25</option>
		</select>
		<h5>Cidades Próximas</h5>
		<select style="display: none;" id="estado1" name="estado"></select>
		<select class="form-control" id="cidade1" name="cidade" onchange="this.form.submit()">
		<option value="0">Cidade</option>
		</select>
	</form>
	<!-- fim 3 form -->
	</div>
	<!-- col-sm-3 col-sm-offset-0 mobcompact -->
	<!-- resultado -->
	<div class="col-sm-6 col-sm-offset-0" id="search-index" style="padding-top: 10px;">
	<p>Foram encontrados:&nbsp;<?php echo $tr ?>&nbsp;Registros</p>
	<!-- info-box / sera gerada pelo php apresentando os produtos dentro de um while -->
	<?php 
	while ($conteudo_bsc = mysqli_fetch_array($limite_bsc)) {
	$id_fav = $conteudo_bsc['id_usu'];
	$img = $conteudo_bsc['foto_perfil'];
	$nome = $conteudo_bsc['nome_completo'];
	$cat1_cliente_vem = $conteudo_bsc['fk_categoria1_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat1 =  mysqli_query($con,"SELECT nome_sub_categoria FROM categoria WHERE id_categoria = '$cat1_cliente_vem'");
	$linha_cat1 = mysqli_fetch_assoc($query_cat1);
	$cat1_cliente = $linha_cat1['nome_sub_categoria'];
	// 
	$cat2_cliente_vem = $conteudo_bsc['fk_categoria2_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat2 =  mysqli_query($con,"SELECT nome_sub_categoria FROM categoria WHERE id_categoria = '$cat2_cliente_vem'");
	$linha_cat2 = mysqli_fetch_assoc($query_cat2);
	$cat2_cliente = $linha_cat2['nome_sub_categoria'];
	$cat3_cliente_vem = $conteudo_bsc['fk_categoria3_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat3 =  mysqli_query($con,"SELECT nome_sub_categoria FROM categoria WHERE id_categoria = '$cat3_cliente_vem'");
	$linha_cat3 = mysqli_fetch_assoc($query_cat3);
	$cat3_cliente = $linha_cat3['nome_sub_categoria'];
	$sobre = $conteudo_bsc['descricao'];
	$url = $conteudo_bsc['url_persona'];
	$pacote = $conteudo_bsc['pacote_usu'];
	$rate = $conteudo_bsc['rating'];
	?>
	<div class="info-box">
	<!-- notificacao de SEGUINDO -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-info' id='info_fav<?php echo $i_fav ?>'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close' id="fechar_info_fav<?php echo $i_fav ?>" onclick="sumir(<?php echo $i_fav ?>)">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>SEGUINDO</b>
	</div>
	</div>

	<!-- notificacao de DEIXOU DE SEGUIR -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-danger' id='info_fav_un<?php echo $i_fav ?>'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close' id="fechar_info_fav_un<?php echo $i_fav ?>" onclick="sumir_un(<?php echo $i_fav ?>)">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>DEIXOU DE SEGUIR</b>
	</div>
	</div>

	<a href="http://qiseventos.com.br/<?php echo $url ?>" class="a-prod">
	<span class="produto">
	<img src="<?php if(!empty($img)){echo $img;}else{echo 'assets/img/accountp.jpg';} ?>" class="img-bola">
	</span>	
	<div class="info-content-produto">
	<span class="icp-titulo"><?php echo $nome ?> &nbsp;
	<?php
	if ($pacote == 1) {
	echo "<i rel='tooltip' title='Premium' data-html='true' data-placement='top'><img class='pacote_p' style='width:18px!important;height:15px!important;' src='assets/img/premium.png'></i>";
	}else if($pacote == 2){
	echo "<i rel='tooltip' title='Master' data-html='true' data-placement='top'><img class='pacote_m' style='width:35px!important;height:30px!important;' src='assets/img/master.png'></i>";
	}
	?>
	</span>
	<!-- icp-titulo -->
	<p><small><?php if(!empty($cat1_cliente)){ echo $cat1_cliente;} if(!empty($cat1_cliente) && !empty($cat2_cliente)){echo "/";} if(!empty($cat2_cliente)){ echo $cat2_cliente;} if(!empty($cat2_cliente) && !empty($cat3_cliente)){echo "/";} if(!empty($cat3_cliente)){ echo $cat3_cliente;} ?></small></p>						
	<span class="icp-desc"><?php echo $sobre ?></span>
	<span class="icp-rate"><i class="material-icons" style="margin-right: -110px;color:yellow;">star_rate</i><?php echo $rate ?></span>
	</div>
	<!-- info-content-produto -->
	</a>
	<!--primeiro verifico se o usuario ja esta logado,
	caso esteja, pego na tabela favoritos se ele ja foi favoritado pelo usuario..
	se nao, o levo a tela de login/cadastro -->
	<?php
	if($lvl >= 2){
	$query_fav = mysqli_query($con,"SELECT id_fk_usu FROM favoritos WHERE id_fk_cliente ='$id_log'");
	if(mysqli_num_rows($query_fav) == 0){
	echo '
	<button class="btn btn-primary btn-simple btn-fav" id="btn-'.$i_fav.'" onclick="addFav('.$i_fav.','.$id_fav.','.$id_log.')">
	<i class="material-icons favorito" id="i-'.$i_fav.'">favorite_border</i>
	</button>';
	}else{
	while($linha_fav = mysqli_fetch_array($query_fav)) {
	$id_fk_dofav = $linha_fav['id_fk_usu'];
	if($id_fk_dofav == $id_fav){
	echo '
	<button class="btn btn-primary btn-simple btn-fav" id="btn-'.$i_fav.'" onclick="removeFav('.$i_fav.','.$id_fav.','.$id_log.')">
	<i class="material-icons favorito" id="i-'.$i_fav.'">favorite</i>
	</button>';
	break;
	}
	// fim se o id for o msm do favorito
	} //fim while
	if($id_fk_dofav != $id_fav){
	echo '
	<button class="btn btn-primary btn-simple btn-fav" id="btn-'.$i_fav.'" onclick="addFav('.$i_fav.','.$id_fav.','.$id_log.')">
	<i class="material-icons favorito" id="i-'.$i_fav.'">favorite_border</i>
	</button>';
	}
	}
	}else{
	echo '
	<a href="login.php" class="btn btn-primary btn-simple btn-fav">
	<i class="material-icons favorito">favorite_border</i>
	</a>';
	}
	// fim se ele for + que lvl 2
	?>
	</div>
	<?php
	$i_fav++;
	}
	if (mysqli_num_rows($limite_bsc) == 0) {
	echo "<h3 class='text-center'>:( DESCULPE, NÃO TEMOS NADA. TENTE OUTRO TERMO, CATEGORIA/SUB-CATEGORIA OU OUTRA CIDADE/ESTADO</h3>";
	}
	?>
	<!-- paginacao, dentro do while -->
	<div class="paginacao">
	<ul class="pagination pagination-primary">
		<?php
		 // agora vamos criar os botões "Anterior e próximo"
		$anterior = $pc -1;
		$proximo = $pc +1;
		echo "<li><a href='?pagina=".$anterior."&categoria=".$categoria."&sub=".$sub_categoria."&search=".$parametro."&relevante=".$ordenar."&estado=".$estado."&cidade=".$cidade."&rpp=".$rpp."#buscar'><</a></li>";
		// O loop para exibir os valores à esquerda
		for($i = $pc-$tr; $i <= $pc-1; $i++){
		if($i > 0)
		echo "<li><a href='?pagina=".$i."&categoria=".$categoria."&sub=".$sub_categoria."&search=".$parametro."&relevante=".$ordenar."&estado=".$estado."&cidade=".$cidade."&rpp=".$rpp."#buscar'> ".$i." </a></li>";
		}
		// loop para os valores da direita
		echo "<li class='active'><a href='?pagina=".$pc."'>".$pc."</a></li>";
		for($i = $pc+1; $i < $pc+2; $i++){
		if($pc < $tp){
		echo "<li><a href='?pagina=".$i."&categoria=".$categoria."&sub=".$sub_categoria."&search=".$parametro."&relevante=".$ordenar."&estado=".$estado."&cidade=".$cidade."&rpp=".$rpp."#buscar'> ".$i." </a></li>";
		}
		}
		// Depois o link da pagina atual
		// O loop para exibir os valores à direita 
		if ($tp > 1) {
		if ($pc < $tp) {
		echo "<li><a href='?pagina=".$proximo."&categoria=".$categoria."&sub=".$sub_categoria."&search=".$parametro."&relevante=".$ordenar."&estado=".$estado."&cidade=".$cidade."&rpp=".$rpp."#buscar'>></a></li>";	
		}
		}
		?>
	</ul>
	</div>
	<!-- paginacao -->
	</div>
	<!-- propaganda -->
	<div class="col-sm-3 col-sm-offset-0">
	<div class="adslateral">
		<!-- primeira propaganda -->
		<?php if (mysqli_num_rows($in_prop_lat1) == 0) { ?>

		<!-- qis1 -->
		<ins class="adsbygoogle"
     		style="display:inline-block;width:286px;height:765px"
     		data-ad-client="ca-pub-8352280684472674"
     		data-ad-slot="5638276045"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>

		<?php }else{ ?>
		<a href="assets/php/clic_prop.php?id_prop=<?php echo $row_in_prop_lat1['id_propaganda'] ?>&local=<?php echo $local2; ?>" target="_blank"><img src="<?php echo $row_in_prop_lat1['imagem_propaganda2']; ?>" /></a>
		<?php
		// chama a funcao de visualizar
		visualiza_prop($local2,$row_in_prop_lat1['id_propaganda'], $con);
		} ?>
	</div>
	<div class="adslateral" style="padding-top: 20px;">
		<!-- segunda propaganda -->
		<?php if (mysqli_num_rows($in_prop_lat2) == 0) { ?>

		<!-- qis1 -->
		<ins class="adsbygoogle"
     		style="display:inline-block;width:286px;height:765px"
     		data-ad-client="ca-pub-8352280684472674"
     		data-ad-slot="5638276045"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>

		<?php }else{ ?>
		<a href="assets/php/clic_prop.php?id_prop=<?php echo $row_in_prop_lat2['id_propaganda'] ?>&local=<?php echo $local3; ?>" target="_blank"><img src="<?php echo $row_in_prop_lat2['imagem_propaganda2']; ?>" /></a>
		<?php
		// chama a funcao de visualizar
		visualiza_prop($local3,$row_in_prop_lat2['id_propaganda'], $con);
		} ?>
	</div>

	<div class="adslateral" style="padding-top: 20px;">
		<!-- terceira propaganda -->
		<?php if (mysqli_num_rows($in_prop_lat3) == 0) { ?>

		<!-- qis2 -->
		<ins class="adsbygoogle"
     		style="display:inline-block;width:286px;height:280px"
    		data-ad-client="ca-pub-8352280684472674"
    		data-ad-slot="3558907618"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>

		<?php }else{ ?>
		<a href="assets/php/clic_prop.php?id_prop=<?php echo $row_in_prop_lat3['id_propaganda'] ?>&local=<?php echo $local4; ?>" target="_blank"><img src="<?php echo $row_in_prop_lat3['imagem_propaganda3']; ?>" /></a>
		<?php
		// chama a funcao de visualizar
		visualiza_prop($local4,$row_in_prop_lat3['id_propaganda'], $con);
		} ?>

	</div>	
	</div>
	<!-- col-sm-12 /. -->
	</div>
	<!-- container /. -->
	<div class="pagespan container" style="margin-top: 20px;">
	<div class="wrap" id="slideprin">
	<div class="scrollbar">
	<div class="handle">
	<div class="mousearea"></div>
	</div>
	<!-- handle -->
	</div>
	<!-- scrollbar -->
	<!-- SLIDE RODAPE -->
	<div class="frame" id="cyclepages">
	<ul class="clearfix">
	<?php
	while ($conteudo_slyrodape = mysqli_fetch_array($in_prop_sliderodape)) {
	$id_r = $conteudo_slyrodape['id_propaganda'];
	$img_r = $conteudo_slyrodape['imagem_propaganda4'];
	$url_r = $conteudo_slyrodape['url_redi'];
	?>
	<li><a href="assets/php/clic_prop.php?id_prop=<?php echo $id_r ?>&local=<?php echo $local5; ?>" target="_blank"><img class="img_rating" src="<?php echo $img_r ?>"></a></li>
	<?php
	// chama a funcao de visualizar
	visualiza_prop($local5,$id_r, $con);
	}
	?>
	<li><a href="anunciar.php" target="_blank"><img class="img_rating" src="assets/img/anuncio/sistema_anuncio.png"></a></li>
	</ul>
	</div>

	<ul class="pages"></ul>
	<div class="controls center">
	<button class="btn prevPage btn-primary" id="btn-sly"><i class="material-icons">keyboard_arrow_left</i>Voltar</button>
	<button class="btn nextPage btn-primary" id="btn-sly">Avançar<i class="material-icons">keyboard_arrow_right</i></button>
	</div>
	</div>
	</div>
	<!-- pagespan container -->

	<div class="adsfooter col-md-12 col-sm-offset-2" style="margin-top: -37px;">
	<!-- anuncio-retangular-footer -->
	<?php if (mysqli_num_rows($in_prop_rodape) == 0) { ?>
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
	<a href="assets/php/clic_prop.php?id_prop=<?php echo $id_prop_5_noum; ?>&local=<?php echo $local6; ?>" target="_blank"><img src="<?php echo $img_prop_5_noum; ?>" /></a>
	<?php
	// chama a funcao de visualizar
	visualiza_prop($local6,$id_prop_5_noum, $con);
	} ?>
	</div>

	</div>
	<!-- section section-basic /. -->
	</div>
	<!-- main main-raised /. -->
	</div>
	<!-- class wrapper /. -->
	<div id="testenoti">
	<div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
	</div>
	<!-- testenoti -->
	<?php include 'assets/php/modal.php';?>
<!-- footer -->
<?php include 'assets/php/footer.php'; ?>
<!-- footer -->
</div>
<!-- jQuery 3.1.1 -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<!-- temporizador -->
<script src="assets/js/temporizador.js"></script>
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
<!-- script nosso-->
<script src="assets/js/sis_js.js" type="text/javascript"></script>
<!-- api chama estados e cidades -->
<script src="assets/js/cidades-estados-1.2-utf8.js" type="text/javascript" charset="UTF-8"></script>
<script language="JavaScript" type="text/javascript" charset="UTF-8">
	
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
	//funcao para o slide do index
	$(document).ready(function(){
	function clicktroca() {
	// pega o menu
    var cont2 = document.getElementsByClassName('navbar-collapse')[0];
    // verifica se o menu NAO esta aberto
	if ( !cont2.classList.contains("in") ) {
	// caso nao esteja aberto, ele nao executa o click
	$("#vai")[0].click();
	}
	}
	function loadimg() {
	// Crio uma variável com valor 0
	var count = 0;
	// Inicio o laço com a condição
	while ( count <= 4 ) {
	// Escrevo a variável count na página
	$("xi["+count+"data-img-src]").each(function(){
	var src = $(this).attr(count+"data-img-src");
	$("<img alt='imagem slide principal'/>").attr("src", src).appendTo(".imgl"+count);
	$("#0").addClass("active");
	}); 
	// Incremento a variável count em 1 a cada volta do laço
	count++;
	}
	}
	setTimeout(loadimg, 10);
	setInterval(clicktroca, 3000);
	//verifica se e um mobile ou nao
	if ($(window).width() <= 959) {
	document.getElementById("mobc").innerHTML = "Clique para buscar&nbsp;<i class='material-icons'>search</i>";
	var btn_mc = document.getElementsByClassName("mobcompact");
	btn_mc[0].addEventListener('click', function() {
    // if (btn_mc[0].style.height == "auto") {
    // document.getElementById("mobc").innerHTML = "Clique para buscar&nbsp;<i class='material-icons'>search</i>";
    // btn_mc[0].style.height = "70px";
    // } else {
    document.getElementById("mobc").innerHTML = "Categoria";
    btn_mc[0].style.height = "auto";
    // }
	}, false);
	}else{
	document.getElementById("mobc").innerHTML = "Categoria";
	}
	// carrega os estados e cidades, com os valores selecionados
	new dgCidadesEstados({
	cidade: document.getElementById('cidade'),
	estado: document.getElementById('estado'),
	estadoVal: '<?php echo $estado ?>',
	cidadeVal: '<?php echo $cidade ?>'
	})
	// gera o valor TODOS nos estados
	$('#estado').append($('<option>', {
		value: 'all',
		text: 'Todos'
	}));
	// gera o valor TODOS nas cidades
	$('#cidade').append($('<option>', {
		value: 'all',
		text: 'Todos'
	}));
	// cada vez q o usuario selecione um estado, add todos nas cidades
	$("#estado").change(function(e) {
		$('#cidade').append($('<option>', {
			value: 'all',
			text: 'Todos'
		}));
	})
	// carrega os estados e cidades, com os valores selecionados para o campo cidade proximas
	new dgCidadesEstados({
	cidade: document.getElementById('cidade1'),
	estado: document.getElementById('estado1'),
	estadoVal: '<?php echo $estado ?>',
	cidadeVal: '<?php echo $cidade ?>'
	})
	// gera o valor TODOS nas cidades proximas
	$('#cidade1').append($('<option>', {
		value: 'all',
		text: 'Todos'
	}));
	// se o estado for all, deixa o option todos selecionado
	if ( '<?php echo $estado ?>' == 'all' ) { $("#estado").val("all"); }
	// se a cidade for all, deixa o option todos selecionado
	if ( '<?php echo $cidade ?>' == 'all' ) { $("#cidade").val("all"); }
	// se o estado for all, deixa o option todos selecionado
	if ( '<?php echo $estado ?>' == 'all' ) { $("#estado1").val("all"); }
	// se a cidade for all, deixa o option todos selecionado
	if ( '<?php echo $cidade ?>' == 'all' ) { $("#cidade1").val("all"); }
	});
	// TODO SCRIPT DE FAVORITO!!
	// add ao favorito
	function addFav(x,id,id_usu) {
	var btn = document.getElementById('btn-'+x);
	var fav = document.getElementById('i-'+x);
	fav.innerHTML = "favorite";	
	btn.setAttribute('onclick', 'removeFav('+x+','+id+','+id_usu+');');
	// após add no front, usar ajax ou outro qualquer para acessar codigo php e add ao usuario no banco
	$.ajax({
	type: "POST",
	url: "assets/php/favoritei.php",
	data: 'id_fav='+id+'&id_usu='+id_usu,
	sucess: aparecer(x)
	});
	}
	// removo do favorito
	function removeFav(x_r,id_r,id_usu_r) {
	var btn = document.getElementById('btn-'+x_r);
	var fav = document.getElementById('i-'+x_r);
	fav.innerHTML = "favorite_border";	
	btn.setAttribute('onclick', 'addFav('+x_r+','+id_r+','+id_usu_r+');');
	// após remover do front, usar ajax ou outro qualquer para acessar codigo php e remover do usuario no banco
	$.ajax({
	type: "POST",
	url: "assets/php/remover_favorito.php",
	data: 'id_fav='+id_r+'&id_usu='+id_usu_r,
	sucess: aparecer_un(x_r)
	});		
	}
	// funcoes de aparecer e sumir para add
	function aparecer(id_x_a) {
	document.getElementById('info_fav'+id_x_a).style.display = 'block';
	setTimeout(sumir,350,id_x_a);
	}
	function sumir(id_x_s) {
	// $("#fechar_info_fav"+id_x_s).click();
	document.getElementById('info_fav'+id_x_s).style.display = 'none';
	}
	// funcoes de aparecer e sumir para deixar de seguir
	function aparecer_un(id_x_a) {
	document.getElementById('info_fav_un'+id_x_a).style.display = 'block';
	setTimeout(sumir_un,350,id_x_a);
	}
	function sumir_un(id_x_s) {
	// $("#fechar_info_fav_un"+id_x_s).click();
	document.getElementById('info_fav_un'+id_x_s).style.display = 'none';
	}
	// ---------------------- FIM SCRIPT FAVORITO --------------------
</script>