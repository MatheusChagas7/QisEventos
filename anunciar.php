<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';

//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache.php';

$envio = $_GET["envio"];
$done = $_GET["done"];

switch ($lvl) {
	//deslogado
	case 1:
		$sit0 = "active";
		$sit1 = "";
		break;
	//usuario comum
	case 2:
		$sit0 = "active";
		$sit1 = "";
		break;
	//usuario cliente
	case 3:
		$sit0 = "active";
		$sit1 = "";
		break;
	// usuario que ja anuncia
	default:
		$sit0 = "";
		$sit1 = "active";
		break;
}

// pega do banco os dados necessários do usu
$query_g_a_usuc =  mysqli_query($con,"SELECT cep_usu FROM usuario_continue WHERE id_fk_usu_continue = '$id_log'");
$linha_g_a_usuc = mysqli_fetch_assoc($query_g_a_usuc);

$cep_bd = $linha_g_a_usuc['cep_usu'];

$query_g_a_usu =  mysqli_query($con,"SELECT nome_completo,email_usu,cpf_usu,numero_1 FROM usuario WHERE id_usu = '$id_log'");
$linha_g_a_usu = mysqli_fetch_assoc($query_g_a_usu);
//info do usuario na continuacao
$nome_bd = $linha_g_a_usu['nome_completo'];
$email_bd = $linha_g_a_usu['email_usu'];
$cpf_usu_bd = $linha_g_a_usu['cpf_usu'];
$numero_1_bd = $linha_g_a_usu['numero_1'];

// tratamento dos dados
function tratarcpf($var_cpf){

	$var_cpf = str_replace('.', '', $var_cpf);
	$var_cpf = str_replace('-', '', $var_cpf);

	return $var_cpf;
}
function tratar_n($numero){

	$numero = strrev($numero);
	$numero = substr($numero ,0,strrpos($numero ,')'));
	$numero = strrev($numero);
	$numero = str_replace(' ', '', $numero);
	$numero = str_replace('-', '', $numero);

	return $numero;
}

function ddd($numero){

$arr = explode(' ', $numero); // transforma a string em array.
$arrN = array();
// pego o array, corta e quebra
foreach($arr as $item){
$valor = explode(')', $item); // quebra o elemento atual em um array com duas posições,
//onde o indice zero é a chave e o um o valor em $arrN
$arrN[$valor[0]] = $valor[0];
}

foreach ($arrN as $value) {
	if($value[1] == "0"){
		return $value[2] . $value[3];
	}else{
		return $value[1] . $value[2];
	}
	break;
}

}
// retirar os pontos e tracos do cpf
if( !empty($cpf_usu_bd) ){
	$cpf = tratarcpf($cpf_usu_bd);
}

// retirar e separar o telefone e ddd
if ( !empty($numero_1_bd) ) {
	$ddd = ddd($numero_1_bd);
	$numero = tratar_n($numero_1_bd);
}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - Propaganda</title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/anunciar.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Anuncie aqui sua propaganda!">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Anuncie aqui sua propaganda!">
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
		#titulo-us{
		padding-top: 7%;
		}
		#title-us{
		color: #fff;
		}
		.list-anuncio{
	  	list-style-type: none;
		}
		.minimo{
		height: auto;
		min-height: 300px;
		top: 0;
		margin-top: 0;
		}
		.info_qtd{
		color: white;
		display: inline-block;
		font-size: 16px;
		}
		.inf_tam{
		display: inline-block;
		color: black;
		font-weight: bold;
		font-size: 10px;
		}
		/*posicao de cada cb de cada pagina*/
		/*inicio*/
		#in_cb_1css{
		margin-top: 10%;
		}
		#in_cb_2css{
		margin-top: 36%;
		margin-left: 74%;
		}
		#in_cb_3css{
		margin-top: 40%;
		margin-left: 74%;
		}
		#in_cb_4css{
		margin-top: 24%;
		margin-left: 74%;
		}
		#in_cb_5css{
		margin-top: 13.7%;
		}
		#in_cb_6css{
		margin-top: 6.35%;
		}
		/*ajuda*/
		#aj_cb_1css{
		margin-top: 85.5%;
		}
		/*anuncio*/
		#an_cb_1css{
		margin-top: 56.5%;
		}
		#an_cb_2css{
		margin-top: 54.5%;
		}
		#an_cb_3css{
		margin-top: 61.5%;
		}
		/*contat-sobre*/
		#cs_cb_1css{
		margin-top: 106%;
		}
		#cs_cb_2css{
		margin-top: 126.5%;
		}
		/*perfil*/
		#pe_cb_1css{
		margin-top: 133.5%;
		}
		/*premium*/
		#pr_cb_1css{
		margin-top: 75%;
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
		echo "<a href='#' class='navbar-toggle n-notification-a' style='margin-top: 4px;' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
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
	<!-- fim logo -->
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
	if ( !empty($done) && $done == "feito" ) {
	echo "
	<div style='z-index:9999; position:absolute;' class='alert alert-info'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>PARABÉNS:</b> Sua propaganda foi feita com sucesso! após o pagamento ela será exibida dentre a data escolhida. Caso o pagamento seja no cartão, ela já é exibida dentre a data escolhida, caso seja boleto ela entrará no sistema após o pagamento. Qualquer dúvida entre em contato com o href='#help'>suporte</a>.
	</div>
	</div>
	";
	}else if( !empty($done) && ( $done == "autenticacao" || $done == "dadosInvalidos" ) ){
	echo "
	<div style='z-index:9999; position:absolute;' class='alert alert-danger'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>ERRO:</b> Não pode ser efetuado o pagamento da propaganda, verifique seus dados ou aguarde alguns instantes. entre em contato com o <a href='#help'>suporte</a> caso o erro persista.
	</div>
	</div>
	";
	}
	?>
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

	<!-- info erro ao enviar a propaganda -->
	<div style='z-index:9999; position:absolute; display: none;' class='alert alert-danger' id="info_erro_send">
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' aria-label='Close' onclick="$('#info_erro_send').css('display', 'none')">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>ERRO AO ENVIAR A PROPAGANDA:</b>Retorne a página anterior, verifique suas opções, imagens e etc e tente novamente, se continuar o erro por favor entre em contato com o <a href="#help">suporte</a>.
	</div>
	</div>

	<div class="brand">
	<!-- nome do usuario caso logado, se nao vai para o login, com o link para login ou perfil -->
	<?php
	if ($lvl == "1") {}else{
	echo "
	<a class='log-cor' href='perfil.php'>".$nome_log."</a>";
	}
	?>
	</div>
	<!-- fim brand -->
	</div>
	<!-- fim  container -->
	</div>
	<!-- fim logo-container -->
	<div class="collapse navbar-collapse" id="navigation-index">
	<!-- a partir daqui é o menu que varia -->
	<?php include 'assets/php/menus.php';?>
	<!-- termino do menu variavel -->
	</div>
	<!-- fim collapse navbar-collapse -->
	</div>
	<!-- fim navbar-header -->
	</nav>
	<!-- End Navbar -->
	<?php include 'assets/php/alerts.php';?>	
	<div class="wrapper" style="margin-top: -130px!important;">
	<div class="header"></div> <!-- header -->
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main main-raised">
	<div class="container">
	<!-- aqui dentro fica as tab-content, com cada um -->
	<div class="tab-content" style="margin-bottom: -100px;">
		<!-- container SE NAO FOR USUARIO (ou comum, ou cliente) -->
		<div class="tab-pane <?php echo $sit0 ?>" id="nlogado">
		<div class="section text-center section-landing">
		<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h3 class="title">CRIE SUA PROPAGANDA !</h3>
			<p class="description text-center">
				Divulgue sua marca, seu show ou o que desejar ! crie sua propaganda, selecione o local em nosso site e agende sua propaganda. Para isto basta você ter uma conta diferenciada especial para anunciantes, onde poderá ver suas estatisticas, quantos cliques e visualizões bem 
				<?php if($lvl > 1){ ?>
				<a href="assets/php/logout.php?propaganda=propaganda">AQUI</a>
				<?php }else{ ?>
				<a href="cadastro_anunciante.php">AQUI</a>
				<?php } ?>
			</p>
			<p class="description text-center">
				Caso você já possua uma conta, ela será elevada ao nivel anunciante, você não perderá nada.
			</p>
		</div>
		<!-- fim col-md-10 col-md-offset-1 -->
		</div>
		<!-- fim row -->
		</div>
		<!-- fim section text-center section-landing -->
		</div>
		<!-- fim tab-pane -->

		<!-- ESCOLHER LOCAL (mapeamento) -->
		<div class="tab-pane <?php echo $sit1 ?>" id="escolha">
		<div class="section text-center section-landing">
		<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<h2 class="title text-center">Seleciona a página</h2>
				<!-- caixa de informacao -->
				<div class="col-md-5">
				<div class="box box-solid">
				<div class="box-body no-padding">
					<h3 class="box-title">Como usar?</h3>
					<ul class="nav nav-pills nav-stacked" style="text-align: justify;">
						<li>Os campos <b>VERDES</b> nas páginas são os espaços Disponíveis para anunciar.</li>
						<li>os número ao lado do selecionador informam quantos espaços existem (estando disponiveis ou não).</li>
						<li>Escolha a página que você deseja anunciar, escolha quais campos queira e confirme.</li>
						<li>Depois selecione a data e o tempo que você deseja anunciar, caso estejam disponiveis.</li>
						<li><b>OBS:</b> Pode escolher mais de 1 página e mais de 1 campo.</li>
						<li><b>OBS:</b> As propagandas do rodapé serão exibidas pelo tamanho (728x90) apenas no modo computador, em mobile será alterada para o tamanho (286x280). <b>Portanto</b> selecione 2 imagens para subir.</li>
						<li><b>OBS:</b>As imagens tem um limite de tamanho de 3MB.</li>
						<li><b>OBS:</b> Apenas imagens formato PNG.</li>
						<li>Tamanho dos espaços existentes -</li>
						<li><b><small>1 </small></b>(960x450) - capa fan page ou evento (facebook)</li>
						<li><b><small>2 </small></b>(286x765)</li>
						<li><b><small>3 </small></b>(286x280)</li>
						<li><b><small>4 </small></b>(200x120)</li>
						<li><b><small>5 </small></b>(728x90)</li>
						<li><a href="#help">Qualquer dúvida por favor entre em contato.</a></li>
					</ul>
				</div>
				</div>
				</div>
			<div class="col-md-2 paginas-anuncio col-md-offset-1">
				<h5>Páginas</h5>
				<!-- <ul id="list-anuncio"> -->
				<a href="#pg_inicio" name="pg_inicio" role="tab" data-toggle="tab"><li class="list-anuncio">Inicio</li></a>
				<a href="#pg_ajuda" name="pg_ajuda" role="tab" data-toggle="tab"><li class="list-anuncio">Ajuda</li></a>
				<a href="#pg_anuncio" name="pg_anuncio" role="tab" data-toggle="tab"><li class="list-anuncio">Anuncio</li></a>
				<a href="#pg_contsob" name="pg_contsob" role="tab" data-toggle="tab"><li class="list-anuncio">Contato/Sobre</li></a>
				<a href="#pg_perfil" name="pg_perfil" role="tab" data-toggle="tab"><li class="list-anuncio">Perfil</li></a>
				<a href="#pg_premium" name="pg_premium" role="tab" data-toggle="tab"><li class="list-anuncio">Premium</li></a>
				<!-- </ul> -->
			</div>
			<!-- fim col-md-3 paginas-anuncio -->

		<form method="post" action="assets/.php" enctype="multipart/form-data">
		<!-- CONTEM AS DIVS COM SUAS PAGINAS E CHECKBOXS -->
		<div class="tab-content" style="display: -webkit-inline-box;">

		<!-- cada img_anuncio tera seu proprio background-image, com sua respectiva pagina -->
		<div class="tab-pane img_anuncio coluna anuncio-choose active margens" id="pg_inicio" style="background-image: url(assets/img/anunciar_img-inicio.png)">

			<div class="checkbox" id="in_cb_1css"><p class="inf_tam">1</p><label><input class="checkb" type="checkbox" id="in_cb_1" name="in_cb_1" value="in_slidetop"/><p class="info_qtd">5</p></label></div>
			<div class="checkbox" id="in_cb_2css"><p class="inf_tam">2</p><label><input class="checkb" type="checkbox" id="in_cb_2" name="in_cb_2" value="in_lat1"/></label></div>
			<div class="checkbox" id="in_cb_3css"><p class="inf_tam">2</p><label><input class="checkb" type="checkbox" id="in_cb_3" name="in_cb_3" value="in_lat2"/></label></div>
			<div class="checkbox" id="in_cb_4css"><p class="inf_tam">3</p><label><input class="checkb" type="checkbox" id="in_cb_4" name="in_cb_4" value="in_lat3"/></label></div>
			<div class="checkbox" id="in_cb_5css"><p class="inf_tam">4</p><label><input class="checkb" type="checkbox" id="in_cb_5" name="in_cb_5" value="in_slidebot"/><p class="info_qtd">29</p></label></div>
			<div class="checkbox" id="in_cb_6css"><p class="inf_tam">5</p><label><input class="checkb" type="checkbox" id="in_cb_6" name="in_cb_6" value="in_rodape"/></label></div>

		</div>
		<!-- fim img_anuncio -->

		<div class="tab-pane img_anuncio1 coluna anuncio-choose " id="pg_ajuda" style="background-image: url(assets/img/anunciar_img-ajuda.png)">

			<div class="checkbox" id="aj_cb_1css"><p class="inf_tam">5</p><label><input class="checkb" type="checkbox" id="aj_cb_1" name="aj_cb_1" value="aj_rodape"/></label></div>

		</div>
		<!-- fim img_anuncio -->

		<div class="tab-pane img_anuncio2 coluna anuncio-choose " id="pg_anuncio" style="background-image: url(assets/img/anunciar_img-anuncio.png)">

			<div class="checkbox" id="an_cb_1css"><p class="inf_tam">5</p><label><input class="checkb" type="checkbox" id="an_cb_1" name="an_cb_1" value="an_top"/></label></div>
			<div class="checkbox" id="an_cb_2css"><p class="inf_tam">5</p><label><input class="checkb" type="checkbox" id="an_cb_2" name="an_cb_2" value="an_mid"/></label></div>
			<div class="checkbox" id="an_cb_3css"><p class="inf_tam">5</p><label><input class="checkb" type="checkbox" id="an_cb_3" name="an_cb_3" value="an_rodape"/></label></div>

		</div>
		<!-- fim img_anuncio -->

		<div class="tab-pane img_anuncio3 coluna anuncio-choose " id="pg_contsob" style="background-image: url(assets/img/anunciar_img-contsobre.png)">

			<div class="checkbox" id="cs_cb_1css"><label><p class="inf_tam">5</p><input class="checkb" type="checkbox" id="cs_cb_1" name="cs_cb_1" value="cs_mid"/></label></div>
			<div class="checkbox" id="cs_cb_2css"><p class="inf_tam">5</p><label><input class="checkb" type="checkbox" id="cs_cb_2" name="cs_cb_2" value="cs_rodape"/></label></div>

		</div>
		<!-- fim img_anuncio -->

		<div class="tab-pane img_anuncio4 coluna anuncio-choose " id="pg_perfil" style="background-image: url(assets/img/anunciar_img-perfil.png)">

			<div class="checkbox" id="pe_cb_1css"><p class="inf_tam">5</p><label><input class="checkb" type="checkbox" id="pe_cb_1" name="pe_cb_1" value="pe_rodape"/></label></div>

		</div>
		<!-- fim img_anuncio -->

		<div class="tab-pane img_anuncio5 coluna anuncio-choose " id="pg_premium" style="background-image: url(assets/img/anunciar_img-premium.png)">

			<div class="checkbox" id="pr_cb_1css"><p class="inf_tam">5</p><label><input class="checkb" type="checkbox" id="pr_cb_1" name="pr_cb_1" value="pr_rodape"/></label></div>

		</div>
		<!-- fim img_anuncio -->

		</div>
		<!-- fim tab-pane -->
		<button type="button" id="btn-menu" href="#agendamento" name="agendamento" role="tab" data-toggle="tab" class="btn btn-primary btn-lg pull-right btnagendamento" style="margin-right: 29px;" disabled="disabled">Agendamento</button>
		</div>
		<!-- fim col-md-10 col-md-offset-1 -->
		</div>
		<!-- fim row -->
		</div>
		<!-- fim section text-center section-landing -->
		</div>
		<!-- fim tab-pane -->

		<!-- container CONFIRMAÇÃO -->
		<div class="tab-pane" id="agendamento">
		<div class="section section-landing">
		<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<div class="col-md-6 minimo">
			<div class="box box-solid">
			<div class="box-body no-padding">
				<h3 class="box-title text-center">Agendamento</h3>
				<ul class="nav nav-pills nav-stacked" style="text-align: justify;">
					<li>Selecione a data em que deseja que sua propaganda seja exibida.</li>
					<li>O tempo entre o inicio e o fim da propaganda ela será exibida no espaço desejado aleatoriamente.</li>
					<li>Ao final da data escolhida, você será notificado em seu e-mail por 10 dias, caso renove ela continuará rodando com a mesma data mas com o o próximo mês.</li>
					<li><b>OBS:</b>As imagens tem um limite de tamanho de 3MB.</li>
					<li><b>OBS:</b> Apenas imagens formato PNG.</li>
					<li>Selecione o estado em que sua propaganda seja exibida. Caso selecione todos será mostrada em todos os estados.</li>
					<li>O preço será equivalente ao espaço + quantidade + tempo de divulgação.
					<a href="#" data-toggle='modal' data-target='#Modalpreco'>Veja aqui uma tabela de preços.</a></li>
					<li><a href="#help">Qualquer dúvida por favor entre em contato.</a></li>
				</ul>
			</div>
			</div>
		</div>
			<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_log ?>"/>
		<div class="col-md-6 minimo">
			<h2 class="text-center">Data</h2>
			<h3>Inicio</h3>
			<div class="form-group">
			<input type="date" class="form-control" id="dt_inicio" name="dt_inicio" required />
			</div>
			<h3>Fim</h3>
			<div class="form-group">
			<input type="date" class="form-control" id="dt_fim" name="dt_fim" disabled="disabled" required />
			</div>
			<h3>Redirecionamento<small>(link para redirecionar ao clicar em sua propaganda)</small></h3>
			<div class="form-group">
			<input type="text" class="form-control" id="url_redi" name="url_redi" placeholder="www.meusite.com..." required />
			<input type="hidden" name="pagina1" id="pagina1" />
			<input type="hidden" name="pagina2" id="pagina2" />
			<input type="hidden" name="pagina3" id="pagina3" />
			<input type="hidden" name="pagina4" id="pagina4" />
			<input type="hidden" name="pagina5" id="pagina5" />
			<input type="hidden" name="pagina6" id="pagina6" />
			</div>
			<h3>Estado<small>(UF)</small></h3>
			<div class="form-group">
			<select class="form-control" id="estado" name="estado">
			</select>
			</div>
			<h3>Cidade</h3>
			<div class="form-group">
			<select class="form-control" id="cidade" name="cidade">
			</select>
			</div>
			<h2 class="text-center">Arquivo</h2>
			<h5 id="tit_an1" style="display: none;">tamanho 1</h5>
			<input type="file" id="anuncio1" name="anuncio1" alt="arquivo anuncio" accept="image/x-png" required style="display: none;"/>
			<input type="hidden" name="txtanun1" id="txtanun1">
			<h5 id="tit_an2" style="display: none;">tamanho 2</h5>
			<input type="file" id="anuncio2" name="anuncio2" alt="arquivo anuncio" accept="image/x-png" style="display: none;"/>
			<input type="hidden" name="txtanun2" id="txtanun2">
			<h5 id="tit_an3" style="display: none;">tamanho 3</h5>
			<input type="file" id="anuncio3" name="anuncio3" alt="arquivo anuncio" accept="image/x-png" style="display: none;"/>
			<input type="hidden" name="txtanun3" id="txtanun3">
			<h5 id="tit_an4" style="display: none;">tamanho 4</h5>
			<input type="file" id="anuncio4" name="anuncio4" alt="arquivo anuncio" accept="image/x-png" style="display: none;"/>
			<input type="hidden" name="txtanun4" id="txtanun4">
			<h5 id="tit_an5" style="display: none;">tamanho 5</h5>
			<!-- tamanho 5 tem 2, pois é o rodapé pc e mobile -->
			<input type="file" id="anuncio5" name="anuncio5" alt="arquivo anuncio" accept="image/x-png" style="display: none;"/>
			<input type="hidden" name="txtanun5" id="txtanun5">
			<h5 id="tit_an6" style="display: none;">tamanho 5 mobile</h5>
			<input type="file" id="anuncio6" name="anuncio6" alt="arquivo anuncio" accept="image/x-png" style="display: none;"/>
			<input type="hidden" name="txtanun6" id="txtanun6">
		</div>
		<!-- fim col-md-6 minimo -->
		<a id="btn-menu" href="#escolha" name="escolha" role="tab" data-toggle="tab" class="btn btn-primary btn-lg pull-left btnescolha">Voltar</a>
		<button type="button" id="btn-menu" href="#finalizar" name="finalizar" role="tab" data-toggle="tab" class="btn btn-primary btn-lg pull-right btnprosseguir" disabled="disabled">Prosseguir</button>
		</div>
		<!-- fim col-md-10 col-md-offset-1 -->
		</div>
		<!-- fim row -->
		</div>
		<!-- fim section section-landing -->
		</div>
		<!-- fim tab-pane -->
		</form>

		<div class="tab-pane" id="finalizar">
		<form action="assets/php/confirm_pag_propaganda.php" method="POST">
		<!-- <div class="row"> -->
		<div class="col-md-6" style="margin-bottom: 50px;">
		<!-- parte do form, pessoal -->
		<h2>Confirme seus dados:</h2>
		<div class="col-sm-9">
		<h3>Pessoal</h3>
		<div class="form-group">
		<input type="hidden" id="id_prop" name="id_prop" required />
		<input type="hidden" name="id_usu" value="<?php echo $id_log ?>" required />
		<h4>Nome</h4>
		<input type="text" id="nome" name="nome" pattern="([A-zÀ-ž\s]){4,}" value="<?php echo $nome_bd ?>" placeholder="nome completo" class="form-control" required />
		</div>
		<div class="form-group">
		<h4>Email</h4>
		<input type="email" id="email_usu" name="email_usu" value="<?php echo $email_bd ?>" placeholder="00000000000" class="form-control" required />
		</div>
		<div class="form-group">
		<h4>CPF</h4>
		<input type="text" id="cpf" name="cpf" pattern="[0-9]{11}" max="11" maxlength="11" value="<?php echo $cpf ?>" placeholder="00000000000" class="form-control" required />
		</div>
		<div class="form-group">
		<h4>CEP</h4>
		<input type="text" id="cep" name="cep" pattern="[0-9]{8}" max="8" maxlength="8" value="<?php echo $cep_bd ?>" placeholder="00000000" class="form-control" required />
		</div>
		<div class="form-group">
		<h4>DDD</h4>
		<input type="text" id="ddd" name="ddd" pattern="[0-9]{2}" max="2" maxlength="2" value="<?php echo $ddd ?>" placeholder="21" class="form-control" required />
		</div>
		<div class="form-group">
		<h4>Telefone</h4>
		<input type="text" id="telefone" name="telefone" max="9" maxlength="9" value="<?php echo $numero ?>" placeholder="00000000/900000000" class="form-control" required/>
		</div>
		<div class="form-group">
		<h4><b>PREÇO</b></h4><small>[em reais(R$) ]</small>
		<input type="text" id="preco_prop" name="preco_prop" value="" class="form-control" required readonly/>
		</div>
		</div>
		<!-- col-sm-9 -->
		</div>
		<div class="col-md-6 minimo">
			<div class="box box-solid">
			<div class="box-body no-padding">
				<h3 class="box-title text-center">Confirme seus dados</h3>
				<ul class="nav nav-pills nav-stacked" style="text-align: justify;">
					<li>Verifique seus dados para escolher o modo de pagamento.</li>
					<li>Os campos numéricos (cep, cpf, numero) são aceitos <b>apenas</b> números sem espaços ou caracteres especiais.</li>
					<li>O preço é o valor que deverá ser pago.</li>
					<li>O preço será equivalente ao espaço + quantidade + tempo de divulgação.
					<a href="#" data-toggle='modal' data-target='#Modalpreco'>Veja aqui uma tabela de preços.</a></li>
					<li><a href="#help">Qualquer dúvida por favor entre em contato.</a></li>
				</ul>
			</div>
			</div>
		</div>
		<a id="btn-menu" href="#agendamento" name="agendamento" role="tab" data-toggle="tab" class="btn btn-primary btn-lg pull-left">Voltar</a>
		<button type="submit" id="btn-menu" name="confirmacao" class="btn btn-primary btn-lg pull-right confirmacao" disabled="disabled">Escolher modo</button>
		</form>
		</div>
		<!-- fim tab-pane -->
	</div>
	<!-- fim tab-content -->
	<!-- div contato -->
	<div class="landing-section" style="margin-top: 165px">
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<a name="help">
	<a name="us">
		<h2 class="text-center title">Dúvida sobre propaganda?</h2>
		<h4 class="text-center description">Caso tenha alguma dúvida sobre como fazer a sua propaganda, ou como você deve prosseguir entre em contato conosco e nós ti ajudaremos.</h4>
	<form class="contact-form" id="forman" method="POST" action="assets/php/email_nos.php">
		<div class="row">
			<div class="col-md-6">
			<div class="form-group label-floating">
				<label class="control-label">Seu nome</label>
				<input type="text" name="nome" class="form-control" required/>
				<input type="hidden" name="local" value="propaganda"/>
				<input type="hidden" id="hora" name="hora" value=""/>
			</div>
			<!-- fim form-group label-floating -->
			</div>
			<!-- fim col-md-6 -->
			<div class="col-md-6">
			<div class="form-group label-floating">
				<label class="control-label">Seu e-mail</label>
				<input type="email" name="email" class="form-control" required/>
			</div>
			<!-- fim form-group label-floating -->
			</div>
			<!-- fim col-md-6 -->
		</div>
		<!-- fim row -->
		<div class="form-group label-floating">
			<label class="control-label">Sua mensagem</label>
			<textarea class="form-control" name="texto" rows="4" required></textarea>
		</div>
		<!-- fim form-group label-floating -->
		<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<button type="submit" class="btn btn-primary btn-raised" onclick="envio();">
			<i class="material-icons">send</i>&nbsp;Enviar
			</button>
		</div>
		<!-- fim col-md-4 col-md-offset-4 text-center -->
		</div>
		<!-- fim row -->
	</form>
	<!-- fim contact-form -->
	</div>
	<!-- fim col-md-8 col-md-offset-2 -->
	</div>
	<!-- fim row -->
	</div>
	<!-- fim contato -->

	</div>
	<!-- fim container -->
	</div>
	<!-- fim main main-raised -->
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
<script src="assets/js/canvasjs.min.js" type="text/javascript"></script>
<!-- api chama estados e cidades -->
<script src="assets/js/cidades-estados-1.2-utf8.js" type="text/javascript" charset="UTF-8"></script>
<script>
$(document).ready(function(){
	// gera os estados e cidades no select
	new dgCidadesEstados({
	cidade: document.getElementById('cidade'),
	estado: document.getElementById('estado')
	})
	// gera o valor TODOS nos estados
	$('#estado').append($('<option>', {
		value: 'all',
		text: 'Todos'
	}));

	$('#cidade').append($('<option>', {
		value: 'all',
		text: 'Todos'
	}));

	// cada vez q eu selecione um estado, add todos nas cidades
	$("#estado").change(function(e) {
		$('#cidade').append($('<option>', {
			value: 'all',
			text: 'Todos'
		}));
	})

// ao clicar na div com a classe checkbox
$(".checkbox").click(function() {

	// caso checkbox da pagina inicio for marcada, colocar o nome da pagina no input pagina
	if ( $("input[name=in_cb_1]").is(":checked") == true || $("input[name=in_cb_2]").is(":checked") == true || $("input[name=in_cb_3]").is(":checked") == true || $("input[name=in_cb_4]").is(":checked") == true || $("input[name=in_cb_5]").is(":checked") == true || $("input[name=in_cb_6]").is(":checked") == true){
		$("#pagina1").val("inicio");
	}else{
		$("#pagina1").val("");
	}

	// caso checkbox da pagina ajuda for marcada, colocar o nome da pagina no input pagina
	if ( $("input[name=aj_cb_1]").is(":checked") == true){
		$("#pagina2").val("ajuda");
	}else{
		$("#pagina2").val("");
	}

	// caso checkbox da pagina anuncio for marcada, colocar o nome da pagina no input pagina
	if ( $("input[name=an_cb_1]").is(":checked") == true || $("input[name=an_cb_2]").is(":checked") == true || $("input[name=an_cb_3]").is(":checked") == true){
		$("#pagina3").val("anuncio");
	}else{
		$("#pagina3").val("");
	}

	// caso checkbox da pagina contato for marcada, colocar o nome da pagina no input pagina
	if ( $("input[name=cs_cb_1]").is(":checked") == true || $("input[name=cs_cb_2]").is(":checked") == true){
		$("#pagina4").val("cont_sobr");
	}else{
		$("#pagina4").val("");
	}

	// caso checkbox da pagina perfil for marcada, colocar o nome da pagina no input pagina
	if ( $("input[name=pe_cb_1]").is(":checked") == true){
		$("#pagina5").val("perfil");
	}else{
		$("#pagina5").val();
	}

	// caso checkbox da pagina premium for marcada, colocar o nome da pagina no input pagina
	if ( $("input[name=pr_cb_1]").is(":checked") == true){
		$("#pagina6").val("premium");
	}else{
		$("#pagina6").val("");
	}

// ------------------------------------------------------------------------------------------------------------------------

	// caso um destes checbox (que pertencem ao tamanho 1) estiverem marcado, libera o segundo input file
	if ( $("input[name=in_cb_1]").is(":checked") == true ){
		document.getElementById('anuncio1').style.display = "block";
		document.getElementById('tit_an1').style.display = "block";
	}else{
		document.getElementById('anuncio1').style.display = "none";
		document.getElementById('tit_an1').style.display = "none";
	}

	// caso um destes checbox (que pertencem ao tamanho 2) estiverem marcado, libera o segundo input file
	if ( $("input[name=in_cb_2]").is(":checked") == true || $("input[name=in_cb_3]").is(":checked") == true ){
		document.getElementById('anuncio2').style.display = "block";
		document.getElementById('tit_an2').style.display = "block";
	}else{
		document.getElementById('anuncio2').style.display = "none";
		document.getElementById('tit_an2').style.display = "none";
	}

	// caso um destes checbox (que pertencem ao tamanho 3) estiverem marcado, libera o segundo input file
	if ( $("input[name=in_cb_4]").is(":checked") == true){
		document.getElementById('anuncio3').style.display = "block";
		document.getElementById('tit_an3').style.display = "block";
	}else{
		document.getElementById('anuncio3').style.display = "none";
		document.getElementById('tit_an3').style.display = "none";
	}

	// caso um destes checbox (que pertencem ao tamanho 4) estiverem marcado, libera o segundo input file
	if ( $("input[name=in_cb_5]").is(":checked") == true){
		document.getElementById('anuncio4').style.display = "block";
		document.getElementById('tit_an4').style.display = "block";
	}else{
		document.getElementById('anuncio4').style.display = "none";
		document.getElementById('tit_an4').style.display = "none";
	}

	// caso um destes checbox (que pertencem ao tamanho 5) estiverem marcado, libera o segundo input file
	if ( $("input[name=in_cb_6]").is(":checked") == true || $("input[name=aj_cb_1]").is(":checked") == true || $("input[name=an_cb_1]").is(":checked") == true || $("input[name=an_cb_2]").is(":checked") == true || $("input[name=an_cb_3]").is(":checked") == true || $("input[name=cs_cb_1]").is(":checked") == true || $("input[name=cs_cb_2]").is(":checked") == true || $("input[name=pe_cb_1]").is(":checked") == true || $("input[name=]").is(":checked") == true || $("input[name=pr_cb_1]").is(":checked") == true ){
		document.getElementById('anuncio5').style.display = "block";
		document.getElementById('anuncio6').style.display = "block";
		document.getElementById('tit_an6').style.display = "block";
		document.getElementById('tit_an5').style.display = "block";
	}else{
		document.getElementById('anuncio5').style.display = "none";
		document.getElementById('anuncio6').style.display = "none";
		document.getElementById('tit_an6').style.display = "none";
		document.getElementById('tit_an5').style.display = "none";
	}


	// pega os checkboxs
	var $boxes = $('input[class=checkb]:checked');
	// se for maior que 0 libero o botao, se nao continua ou coloca novamente o disabled
	if ($boxes.length > 0) {
		$(".btnagendamento").removeAttr("disabled", "disabled");
	}else{
		$(".btnagendamento").attr("disabled", "disabled");
	}

});
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
     	// console.log(reader.result);
		verifyfull();
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
     	// console.log(reader.result);
		verifyfull();
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
     	// console.log(reader.result);
		verifyfull();
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
     	// console.log(reader.result);
		verifyfull();
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
     	// console.log(reader.result);
		verifyfull();
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
     	// console.log(reader.result);
		verifyfull();
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

// se eu mudar a data de inicio
$("#dt_inicio").change(function() {
	// veifica se esta tudo prenchido
	verifyfull();
	// coloca a data inicio como minimo na data fim
	document.getElementById("dt_fim").min = $("#dt_inicio").val();
	// libera o input date fim
	$("#dt_fim").removeAttr("disabled", "disabled");
})
// se eu mudar a data do fim
$("#dt_fim").change(function() {
	verifyfull();
})
// se eu escrever no input da url
$("#url_redi").change(function() {
	verifyfull();
})

// -------------------------------- exibir o preço dinamico ------------------------------------------------

$("#dt_fim").change(function() {

// formatar data
function formatDate (input) {
	var datePart = input.match(/\d+/g),
	year = datePart[0], 
	month = datePart[1], 
	day = datePart[2];
	return month+'/'+day+'/'+year;
}
// cada input tem seu preço, se checked vai juntar ao valor final
// pegarei cada input checked e multiplicarei pelos dias (entre data fim e data inicio); isso será o valor final a pagar

// inicio
if ($("input[name=in_cb_1]").is(":checked") == true) {
	var val1 = 7.15;
}else{
	var val1 = 0;
}

if ($("input[name=in_cb_2]").is(":checked") == true) {
	var val2 = 3.60;
}else{
	var val2 = 0;
}

if ($("input[name=in_cb_3]").is(":checked") == true) {
	var val3 = 3.60;
}else{
	var val3 = 0;
}

if ($("input[name=in_cb_4]").is(":checked") == true) {
	var val4 = 1.75;
}else{
	var val4 = 0;
}

if ($("input[name=in_cb_5]").is(":checked") == true) {
	var val5 = 0.60;
}else{
	var val5 = 0;
}

if ($("input[name=in_cb_6]").is(":checked") == true) {
	var val6 = 1.30;
}else{
	var val6 = 0;
}
// ajuda
if ($("input[name=aj_cb_1]").is(":checked") == true) {
	var val7 = 1.30;
}else{
	var val7 = 0;
}
// anuncio
if ($("input[name=an_cb_1]").is(":checked") == true) {
	var val8 = 1.30;
}else{
	var val8 = 0;
}

if ($("input[name=an_cb_2]").is(":checked") == true) {
	var val9 = 1.30;
}else{
	var val9 = 0;
}

if ($("input[name=an_cb_3]").is(":checked") == true) {
	var val10 = 1.30;
}else{
	var val10 = 0;
}
// contato_sobre
if ($("input[name=cs_cb_1]").is(":checked") == true) {
	var val11 = 1.30;
}else{
	var val11 = 0;
}

if ($("input[name=cs_cb_2]").is(":checked") == true) {
	var val12 = 1.30;
}else{
	var val12 = 0;
}
// perfil
if ($("input[name=pe_cb_1]").is(":checked") == true) {
	var val13 = 1.30;
}else{
	var val13 = 0;
}
// premium
if ($("input[name=pr_cb_1]").is(":checked") == true) {
	var val14 = 1.30;
}else{
	var val14 = 0;
}
// formatar para real
function numberParaReal(numero){
    var formatado = numero.toFixed(2).replace(".",".");
    return formatado;
}

// inicio
var data_inicio = document.getElementById("dt_inicio").value;
// fim
var data = document.getElementById("dt_fim").value;
// calcula a diferença de dias entre as datas
var date1 = new Date(formatDate(data_inicio));
var date2 = new Date(formatDate(data));
// pega em tempo de milisegundo e diminui entre as datas
var timeDiff = Math.abs(date2.getTime() - date1.getTime());
// pega o tempo em milisegundo e divide para achar os das
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

// pega o valor dos checked e multiplica pelos dias
var resultado = (val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8 + val9 + val10 + val11 + val12 + val13 + val14) * diffDays;

// enviar o valor a pagar para a variavel
$("#preco_prop").val( numberParaReal(resultado) );
})


// -------------------------------- exibir o preço dinamico ------------------------------------------------

function verifyfull() {
	// verifica se o input da data inicio, fim, url, e um dos input de arquivo nao estao vazio para liberar o btn prosseguir
	if ( $("#dt_inicio").val().length > 0 && $("#dt_fim").val().length > 0 && $("#url_redi").val().length > 0 && ( $("#txtanun1").val().length > 0 || $("#txtanun2").val().length > 0 || $("#txtanun3").val().length > 0 || $("#txtanun4").val().length > 0 || ( $("#txtanun5").val().length > 0 && $("#txtanun6").val().length > 0 ) ) && $("#estado").val() !== "" && $("#cidade").val() !== "") {
		$(".btnprosseguir").removeAttr("disabled", "disabled");
	}else{
		$(".btnprosseguir").attr("disabled", "disabled");
	}
}

function verifyfullmodo() {
	// verifica no ato de escolher modo de pagamento se os campos estao selecionados para liberar o botao
	if ( $("#nome").val().length > 0 && $("#email_usu").val().length > 0 && $("#cpf").val().length > 0 && $("#cep").val().length > 0 && $("#ddd").val().length > 0 && $("#telefone").val().length > 0 ) {
		$(".confirmacao").removeAttr("disabled", "disabled");
	}else{
		$(".confirmacao").attr("disabled", "disabled");
	}
}

// ao haver mudancas nesses campos, executa o verificador 
$("#nome").change(function() {
	verifyfullmodo();
});
$("#email_usu").change(function() {
	verifyfullmodo();
});
$("#cpf").change(function() {
	verifyfullmodo();
});
$("#cep").change(function() {
	verifyfullmodo();
});
$("#ddd").change(function() {
	verifyfullmodo();
});
$("#telefone").change(function() {
	verifyfullmodo();
});

// ao clicar em prosseguir vai enviar o arquivo com as datas para o servidor e deixar inativo ate o pagamento
$(".btnprosseguir").click(function() {

// verifica cada cb se esta checkado ou nao
// inicio
if( $("input[name=in_cb_1]").is(":checked") == true ){
var check_in_cb_1 = $("#in_cb_1").val();
}else{
var check_in_cb_1 = "NULL";
}

if( $("input[name=in_cb_2]").is(":checked") == true ){
var check_in_cb_2 = $("#in_cb_2").val();
}else{
var check_in_cb_2 = "NULL";
}

if( $("input[name=in_cb_3]").is(":checked") == true ){
var check_in_cb_3 = $("#in_cb_3").val();
}else{
var check_in_cb_3 = "NULL";
}

if( $("input[name=in_cb_4]").is(":checked") == true ){
var check_in_cb_4 = $("#in_cb_4").val();
}else{
var check_in_cb_4 = "NULL";
}

if( $("input[name=in_cb_5]").is(":checked") == true ){
var check_in_cb_5 = $("#in_cb_5").val();
}else{
var check_in_cb_5 = "NULL";
}

if( $("input[name=in_cb_6]").is(":checked") == true ){
var check_in_cb_6 = $("#in_cb_6").val();
}else{
var check_in_cb_6 = "NULL";
}
// ajuda
if( $("input[name=aj_cb_1]").is(":checked") == true ){
var check_aj_cb_1 = $("#aj_cb_1").val();
}else{
var check_aj_cb_1 = "NULL";
}
// anuncio
if( $("input[name=an_cb_1]").is(":checked") == true ){
var check_an_cb_1 = $("#an_cb_1").val();
}else{
var check_an_cb_1 = "NULL";
}

if( $("input[name=an_cb_2]").is(":checked") == true ){
var check_an_cb_2 = $("#an_cb_2").val();
}else{
var check_an_cb_2 = "NULL";
}

if( $("input[name=an_cb_3]").is(":checked") == true ){
var check_an_cb_3 = $("#an_cb_3").val();
}else{
var check_an_cb_3 = "NULL";
}
// contato
if( $("input[name=cs_cb_1]").is(":checked") == true ){
var check_cs_cb_1 = $("#cs_cb_1").val();
}else{
var check_cs_cb_1 = "NULL";
}

if( $("input[name=cs_cb_2]").is(":checked") == true ){
var check_cs_cb_2 = $("#cs_cb_2").val();
}else{
var check_cs_cb_2 = "NULL";
}
// perfil
if( $("input[name=pe_cb_1]").is(":checked") == true ){
var check_pe_cb_1 = $("#pe_cb_1").val();
}else{
var check_pe_cb_1 = "NULL";
}
// premium
if( $("input[name=pr_cb_1]").is(":checked") == true ){
var check_pr_cb_1 = $("#pr_cb_1").val();
}else{
var check_pr_cb_1 = "NULL";
}
// -------------------------------------------------------------------------------
	$.ajax({
		url: 'assets/php/send_propaganda.php',
		method: 'POST',
		data: {
			id_usuario: $("#id_usuario").val(),
			dt_inicio: $("#dt_inicio").val(),
			dt_fim: $("#dt_fim").val(),
			url_redi: $("#url_redi").val(),
			estado: $("#estado").val(),
			cidade: $("#cidade").val(),
			pagina1: $("#pagina1").val(),
			pagina2: $("#pagina2").val(),
			pagina3: $("#pagina3").val(),
			pagina4: $("#pagina4").val(),
			pagina5: $("#pagina5").val(),
			pagina6: $("#pagina6").val(),
			file1: $("#txtanun1").val(),
			file2: $("#txtanun2").val(),
			file3: $("#txtanun3").val(),
			file4: $("#txtanun4").val(),
			file5: $("#txtanun5").val(),
			file6: $("#txtanun6").val(),
			in_cb_1: check_in_cb_1,
			in_cb_2: check_in_cb_2,
			in_cb_3: check_in_cb_3,
			in_cb_4: check_in_cb_4,
			in_cb_5: check_in_cb_5,
			in_cb_6: check_in_cb_6,
			aj_cb_1: check_aj_cb_1,
			an_cb_1: check_an_cb_1,
			an_cb_2: check_an_cb_2,
			an_cb_3: check_an_cb_3,
			cs_cb_1: check_cs_cb_1,
			cs_cb_2: check_cs_cb_2,
			pe_cb_1: check_pe_cb_1,
			pr_cb_1: check_pr_cb_1

		},
		// contentType: false,
		// processData: false,
		success: function(response) {
			if(response != "erro"){
				// console.log("Enviado com sucesso milorde");
				// add o id da propaganda adicionada no campo dos dados para finalizar a compra, e ativo o botao
				$("#id_prop").val(response);
				// executa a funcao de verificar
				verifyfullmodo();
			}else{
				// console.log("Erro milorde");
				// exibo o erro e desativo o botao
				$("#info_erro_send").css("display", "block");
				$(".confirmacao").attr("disabled", "disabled");
			}
		}
	});
})

})
// fim document ready
function envio() {
	// pega a data e hora do momento do envio
	localtime = new Date();
	document.getElementById("hora").value = localtime;
	if ( !(document.getElementById("hora").value == "") ) {
		//faz o submit
		document.getElementById("forman").submit();
	}
}
</script>