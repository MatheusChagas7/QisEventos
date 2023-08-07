<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';
//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache_visitante.php';
// propagandas
include_once 'assets/php/propaganda.php';
// visualizacao de propaganda
include_once 'assets/php/visu_prop.php';

$anunciar = $_GET['anunciar'];
$error = $_GET['error'];
$motivo = $_GET['motivo'];

$acesso = "677876605734655|1faeae194ea889f6f90736e864215da9"; //api da aplicacao | app secret
// saber o ID do usuario facebook via name
function get_id_facebook_user($acessot,$fbname){

	$facebook_g_url1 = "https://graph.facebook.com/".$fbname."?access_token=".$acessot;
	$get_fb_json_content1 = @file_get_contents($facebook_g_url1,true);
	$decode_fb_json_content1 = json_decode($get_fb_json_content1);
	if ( $decode_fb_json_content1->id ) {
		return $decode_fb_json_content1->id;
	}else{
		return "";
	}
}
// saber se o perfil do cara é pagina ou perfil - facebook
function get_type_facebook_id_by_devildoxx($acesstoken,$fbid){

	$facebook_g_url = "https://graph.facebook.com/".$fbid."?access_token=".$acesstoken."&metadata=1";
	$get_fb_json_content = file_get_contents($facebook_g_url,true);
	$decode_fb_json_content = json_decode($get_fb_json_content);
	return $decode_fb_json_content->metadata->type;
}

// query buscar tudo do usuario
$query_usu =  mysqli_query($con,"SELECT * FROM usuario WHERE id_usu = '$id_log'");
$linha_usu = mysqli_fetch_assoc($query_usu);
//query buscar tudo no usuario continue
$query_usu_continue =  mysqli_query($con,"SELECT soundcloud FROM usuario_continue WHERE id_fk_usu_continue = '$id_log'");
$linha_usu_continue = mysqli_fetch_assoc($query_usu_continue);
//info do usuario na continuacao
$soundcloud = $linha_usu_continue['soundcloud'];

// informacoes do usuario
$cpf = $linha_usu['cpf_usu'];
$rg = $linha_usu['rg_usu'];
$estado = $linha_usu['estado'];
$cidade = $linha_usu['cidade'];
$nascimento = $linha_usu['dt_nasc'];
$sexo = $linha_usu['sexo'];
$pacote = $linha_usu['pacote_usu'];
$n_pacote; //cria a variavel vazia
switch ($pacote) {
	case 1:
		$n_pacote = 'max="600"';
		$n_pacote_rest = "600";
		break;
	case 2:
		$n_pacote = '';
		$n_pacote_rest = "SEM LIMITES";
		break;	
	default:
		$n_pacote = 'max="300"';
		$n_pacote_rest = "300";
		break;
}
$categoria1_fk = $linha_usu['fk_categoria1_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat1 =  mysqli_query($con,"SELECT nome_categoria,nome_sub_categoria FROM categoria WHERE id_categoria = '$categoria1_fk'");
	$linha_cat1 = mysqli_fetch_assoc($query_cat1);
	$categoria_sub_1 = $linha_cat1['nome_sub_categoria'];
	$categoria_nome_1 = $linha_cat1['nome_categoria'];
// 
$categoria2_fk = $linha_usu['fk_categoria2_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat2 =  mysqli_query($con,"SELECT nome_categoria,nome_sub_categoria FROM categoria WHERE id_categoria = '$categoria2_fk'");
	$linha_cat2 = mysqli_fetch_assoc($query_cat2);
	$categoria_sub_2 = $linha_cat2['nome_sub_categoria'];
	$categoria_nome_2 = $linha_cat2['nome_categoria'];
// 
$categoria3_fk = $linha_usu['fk_categoria3_usu'];
	// pega a categoria pelo id da fk no usuario
	$query_cat3 =  mysqli_query($con,"SELECT nome_categoria,nome_sub_categoria FROM categoria WHERE id_categoria = '$categoria3_fk'");
	$linha_cat3 = mysqli_fetch_assoc($query_cat3);
	$categoria_sub_3 = $linha_cat3['nome_sub_categoria'];
	$categoria_nome_3 = $linha_cat3['nome_categoria'];
// 
$sobre = $linha_usu['sobre_usu'];
$descricao = $linha_usu['descricao'];
$rating = $linha_usu['rating'];
$n_rating = $linha_usu['n_rating'];
$numero1 = $linha_usu['numero_1'];
$numero2 = $linha_usu['numero_2'];
$numero3 = $linha_usu['numero_3'];
$email_contato = $linha_usu['email_contato'];
$url_persona = $linha_usu['url_persona'];
$canal = $linha_usu['canal_yt'];
$playlist = $linha_usu['canal_playlist'];
$instagram = $linha_usu['conta_insta'];
$facebook = $linha_usu['conta_face'];
// pega o id
$id_facebook = get_id_facebook_user($acesso,$facebook);
// pega se é perfil ou pagina
if ($id_facebook) {
$ref_facebook_user = get_type_facebook_id_by_devildoxx($acesso,$id_facebook);
}

$skipalbun = $linha_usu['skip_albun'];
// pega o resultado do banco sobre os albuns
$arr = explode(',', $skipalbun); // transforma a string em array.
// array qye vai receber o resultado logo mais.
$arrN = array();
// pego o array, corta e quebra
foreach($arr as $item){
$valor = explode(',', $item); // quebra o elemento atual em um array com duas posições,
//onde o indice zero é a chave e o um o valor em $arrN
$arrN[$valor[0]] = $valor[0];
}
// continua pegando o resto do banco sobre o usuario
$twitter = $linha_usu['conta_twitter'];
$website = $linha_usu['website'];
$dtcriacao = $linha_usu['dt_criacao'];
$n_acesso = $linha_usu['n_acesso'];
$noticias = $linha_usu['noticias'];
$status_confirma = $linha_usu['status_confirma'];
// ideia para formulario com required baseado em seu lvl
if ($lvl == 2 || $lvl == 4) {
	$required = "required";
	$required2 = "";
}else if($lvl == 3 || $lvl == 5){
	$required = "required";
	$required2 = "required";
}
// script para verificar a noticia
switch ($noticias) {
	case $noticias == 2:
		$checked_e = "checked";
		$checked_a = "";
		break;
	case $noticias == 3:
		$checked_e = "checked";
		$checked_a = "checked";
		break;
	case $noticias == 4:
		$checked_e = "";
		$checked_a = "checked";
		break;		
	default:
		$checked_e = "";
		$checked_a = "";
		break;
}
// query de buscar os favoritos do usuario
$get_s = "SELECT id_fk_usu FROM favoritos WHERE id_fk_cliente ='$id_log' ORDER BY id_favoritos DESC"; //SEGUINDO
$query_get_s = mysqli_query($con,$get_s);
$total_seguindo = mysqli_num_rows($query_get_s);

$get = "SELECT id_fk_cliente FROM favoritos WHERE id_fk_usu ='$id_log' ORDER BY id_favoritos DESC"; //SEGUIDORES
$query_get = mysqli_query($con,$get);
$total_seguidor = mysqli_num_rows($query_get);

// variavel cont dos favoritos e dos seguidores
$i_fav = 0;
$i_fav_s = 0;
// PAGINACAO DA ABA SEGUINDO
$total_reg_s = "5"; // número de registros por página
//Se a página não for especificada a variável "pagina" tomará o valor 1, isso evita de exibir a página 0 de início:
$pagina_s = $_GET['pagina'];
if (!$pagina_s) {
$pc_s = "1";
} else {
$pc_s = $pagina_s;
}
//Vamos determinar o valor inicial das buscas limitadas:
$inicio_s = $pc_s - 1;
$inicio_s = $inicio_s * $total_reg_s; 
//Vamos selecionar os dados e exibir a paginação:
$limite_bsc_s = mysqli_query($con,"$get_s LIMIT $inicio_s,$total_reg_s");
$todos_s = mysqli_query($con,$get_s); 
$tr_s = mysqli_num_rows($todos_s); // verifica o número total de registros
$tp_s = $tr_s / $total_reg_s; // verifica o número total de páginas
// ---------------------------------------------------------------
// PAGINACAO DA ABA SEGUIDORES
$total_reg = "5"; // número de registros por página
//Se a página não for especificada a variável "pagina" tomará o valor 1, isso evita de exibir a página 0 de início:
$pagina = $_GET['pagina'];
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
// verifica seu lvl para a configuracacao
if ($lvl == 2 || $lvl == 4) {
	$selecionado2 = 'selected="selected"';
	$selecionado3 = '';
}else{
	$selecionado2 = '';
	$selecionado3 = 'selected="selected"';
}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title><?php echo $nome_log ?></title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/perfil.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Veja seu perfil, suas configurações e muito mais - QISeventos">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Veja seu perfil, suas configurações e muito mais - QISeventos">
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
	<!-- esse bootstrap é especialmente para o rating star -->
	<link href="assets/css/bootstrap_rating.css" rel="stylesheet" />
	<!-- Fonts and icons  -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="assets/css/font_material_icons.css" rel="stylesheet" />
	<link href="assets/css/font_roboto.css" rel="stylesheet" />
	<link href="assets/css/bootstrap_font.css" rel="stylesheet" />
	<link href="assets/css/croppie.2.4.0.css" rel="stylesheet" />
	<link href="assets/css/material-kit.min.css" rel="stylesheet"/>
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.min.css" rel="stylesheet" />
	<link href="assets/sass/material-kit/_example-pages.scss" rel="stylesheet" type="text/html"/>
	<!-- rating star -->
	<link href="assets/css/star-rating.min.css" rel="stylesheet" />
	<!-- css plugin foto facebook -->
	<link href="assets/css/plugin-album-facebook.min.css" rel="stylesheet" />
	<!-- css ligthbox insta -->
	<link href="assets/css/lightbox.min.css" rel="stylesheet" />
	<!-- google ads -->
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- youmax youtube plugin -->
	<link href="assets/css/youmax.min.css" rel="stylesheet" type="text/css"/>
	<?php if(!empty($soundcloud)){ ?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.0.min.js" type="text/javascript"></script>
	<!--SOUNDCLOUD API -->
	<script type="text/javascript" src="https://w.soundcloud.com/player/api.js"></script>
	<!-- PLAYER JAVASCRIPT -->
	<script type="text/javascript" src="assets/js/jquery.nouisliderplayer.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.nouisliderplayer2.min.js"></script>
	<script type="text/javascript" src="assets/js/player.js"></script>
	<!--- CSS FILE PLAYER -->
    <link rel="stylesheet" href="assets/css/player.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/nouisliderplayer.css" />
	<?php } ?>
	<!-- estilo interno CSS -->
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
		@media (max-width: 991px){
		.conteudotab{
		margin-left: 13%;
		}
		}
		.photoI {
  		display: inline-block;
  		width: 25%;
  		height: 0;
  		padding-bottom: 25%;
  		margin-left:5px;
  		background: #eee 50% 50% no-repeat;
  		background-size: cover;
		}
		.photo, .fb-album, .fb-photo {
  		display: inline-block!important;
  		width: 25%!important;
  		height: 0!important;
  		padding-bottom: 25%!important;
  		margin-left:5px!important;
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
		<?php if($pacote == 1){ ?>
		.borda{
	    border: 5px solid #BCC6CC;
	    border-radius: 6px;
	    box-shadow: 0px 0px 30px #BCC6CC!important;
		}
		<?php }else if($pacote == 2){ ?>
		.borda{
	    border: 5px solid #D4AF37;
	    border-radius: 6px;
	    box-shadow: 0px 0px 30px #D4AF37!important;
		}			
		<?php } ?>		
	</style>
</head>
<body id="b_n" class="profile-page" style="margin-bottom: 45px;">
	<!-- notificacao em primeiro plano/alert -->
	<?php include 'assets/php/notificacao-alert.php';?>
	<!-- navbar -->
	<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display />-->
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
	    	echo"
			<a href='#' class='navbar-toggle n-notification-a' data-toggle='modal' data-target='#Modalnoti' style='margin-top: 4px;' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
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
		<!-- fim div logo -->
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
	<!-- fim div logo-container -->
	</div>
	<!-- fim div navbar-header -->
	<div class="collapse navbar-collapse" id="navigation-index">
		<?php 
	    include 'assets/php/menus.php';
		?>
	</div>
	</div>
	<!-- fim div container -->
    </nav>
    <!-- notificacao de envio -->
    <?php 
    include 'assets/php/alerts.php';
	?>
    <!-- fim nav navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll -->
    <div class="wrapper">
		<div class="header header-filter" style="background-image: url('<?php echo $foto_capa ?>'); background-size: cover;"></div>
		<!-- div a cima e capa -->
		<div class="main main-raised">
		<div class="profile-content borda">
		<div class="container">
			<div class="row">
			<div class="profile">
				<div class="avatar">
				<?php if(empty($foto_perfil)){ ?>
					<img src="assets/img/account.jpg" alt="Circle Image" class="img-circle img-raised">
				<?php }else{ ?>
					<img src="<?php echo $foto_perfil ?>" alt="Circle Image" class="img-circle img-raised">
				<?php } ?>
				</div>
	<div class="name">
	<!-- recebera o nome vindo do bd via php -->
	<h3 class="title"><?php echo $nome_log ?>
		<?php
		if($lvl == 3 || $lvl == 5){
		if ($pacote == 1) {
		echo "<i rel='tooltip' title='Premium' data-html='true' data-placement='top'><img class='pacote_p' src='assets/img/premium.png'></i>";
		}else if($pacote == 2){
		echo "<i rel='tooltip' title='Master' data-html='true' data-placement='top'><img class='pacote_m' src='assets/img/master.png'></i>";
		}
		}
		?>		
	</h3>
	<?php
	if($lvl == 3 || $lvl == 5){
	?>
	<div class="estrelas">
	<!-- rate-->
    <input id="input-21f" name="rate" type="submit" disabled data-min=0 data-max=5 data-step=0.1 data-size="md" title="" value="<?php echo $rating ?>">
    <p><?php echo $n_rating ?>&nbsp;Avaliações</p>
    <p>Você tem&nbsp;<?php echo $n_acesso ?>&nbsp;Acessos</p>
	</div>
	<?php } ?>
	<!-- fim estrelas -->
	<!-- recebera a profissao vindo do bd via php -->
	<?php
	if($lvl == 3 || $lvl == 5){
	if (!empty($categoria_sub_1)) {
	echo "
	<h6>".$categoria_sub_1." (".$categoria_nome_1.") </h6>";
	}
	if (!empty($categoria_sub_2)) {
	echo "
	<h6>".$categoria_sub_2." (".$categoria_nome_2.") </h6>";
	}
	if (!empty($categoria_sub_3)) {
	echo "
	<h6>".$categoria_sub_3." (".$categoria_nome_3.") </h6>";
	}
	}
	?>
	</div>
	<!-- fim name -->				
			</div>
			</div>
	<?php
	if (!empty($descricao)) {
	?>			
	<div class="description text-center wrap" style="margin: 0px auto 0px;">
	<!-- recebera a descricao vindo do bd via php -->
	<p><?php echo $descricao ?></p>
	</div>
	<?php } ?>	
	<!-- fim div description text-center -->
	<?php
	if (!empty($descricao) && !empty($sobre)) {
	?>
	<!-- linha divisoria -->
	<div class="linha"></div>
	<?php } ?>
	<?php
	if (!empty($sobre)) {
	?>	
	<div class="description text-center wrap" style="font-size: 16px;max-width: 100%; margin: 0px auto 0px;">
	<!-- recebera a descricao vindo do bd via php -->
	<p><?php echo $sobre ?></p>
	</div>
	<?php } ?>	
	<!-- fim div description text-center -->
		<!-- ancora para os favoritos -->
		<a name="favorites" style="display: none;">
		<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<div class="profile-tabs">
		<div class="nav-align-center">
			<ul class="nav nav-pills" role="tablist">
			<?php
			if ($status_confirma == 1) {
				switch ($lvl) {
					case 3:
					case 5:

						if($anunciar == "perfil"){

							$active_f = "";
							$active_s = "";
							$active_a = "active";

							echo "<li>
							<a href='#fotos' name='fotos' role='tab' data-toggle='tab' style='min-width: 82px;'>
							<i class='material-icons'>camera</i>
							Fotos
							</a>
							</li>";

						}else{

							$active_f = "active";
							$active_s = "";
							$active_a = "";

							echo "<li class='active'>
							<a href='#fotos' name='fotos' role='tab' data-toggle='tab' style='min-width: 82px;'>
							<i class='material-icons'>camera</i>
							Fotos
							</a>
							</li>";

						}

						echo "<li>
						<a href='#videos' name='videos' role='tab' data-toggle='tab' style='min-width: 82px;'>
						<i class='material-icons'>video_library</i>
						Vídeos
						</a>
						</li>
						<li>
						<a href='#seguidores' name='seguidores' role='tab' data-toggle='tab' style='min-width: 82px;'>
						<i class='material-icons'>subdirectory_arrow_right</i>
						Seguidores
						</a>
						</li>
						<li>
						<a href='#seguindo' name='seguindo' role='tab' data-toggle='tab' style='min-width: 82px;'>
						<i class='material-icons'>subdirectory_arrow_left</i>
						Seguindo
						</a>
						</li>";

						break;
					case 2:
					case 4:

						$active_f = "";
						$active_s = "active";

						echo "<li class='active'>
						<a href='#seguindo' name='seguindo' role='tab' data-toggle='tab' style='min-width: 82px;'>
						<i class='material-icons'>subdirectory_arrow_left</i>
						Seguindo
						</a>
						</li>";

						break;
				} // fim switch

				if($anunciar == "perfil"){

				echo "<li class='active'>
				<a href='#perfil' role='tab' data-toggle='tab' style='min-width: 82px;'>
				<i class='material-icons'>person</i>
				Perfil
				</a>
				</li>";

				}else{

				echo "<li>
				<a href='#perfil' role='tab' data-toggle='tab' style='min-width: 82px;'>
				<i class='material-icons'>person</i>
				Perfil
				</a>
				</li>";

				}

				echo "<li>
				<a href='#configuracao' role='tab' data-toggle='tab' style='min-width: 82px;'>
				<i class='material-icons'>settings</i>
				Config.
				</a>
				</li>";

			}else{
				$desativado = "class='disabled' style='pointer-events:none;'";
				$active_statusf = "active";

				echo "<li ".$desativado.">
				<a href='#perfil' role='tab' data-toggle='tab' style='min-width: 82px;'>
				<i class='material-icons'>person</i>
				Perfil
				</a>
				</li>
				<li>
				<a href='#configuracao' role='tab' data-toggle='tab' style='min-width: 82px;'>
				<i class='material-icons'>settings</i>
				Config.
				</a>
				</li>";

			} // fim if status confirma
			?>
			</ul>
		</div>
		<!-- fim div nav-align-center -->
		</div>
		<!-- fim div profile-tabs -->
		</div>
		<!-- fim div col-md-8 col-md-offset-2 -->
	    </div>
		<!-- fim div row -->
		<!-- CONTEUDO DOS BOTÕES DO USUARIO -->
		<div class="tab-content">
			<!-- content caso ainda nao confirme a conta -->
			<div class="tab-pane <?php echo $active_statusf ?>" id="activesuaconta">
			<div class="col-sm-12 col-sm-offset-0 text-center">
				<h5>Ative sua conta para poder usar todo o seu conteúdo <small>(verifique sua caixa de entrada do email cadastrado, ou em seu lixo eletrônico).</small></h5>
				<h4>Ainda nao recebeu ? Deseja reenviar ?</h4>
				<form action="assets/php/reenvio_confirm.php" method="POST">
					<input type="hidden" name="id_usu_re" value="<?php echo $id_log ?>" />
					<input type="email" name="email_re" placeholder="email" />
					<button type="submit" class="btn-perfil btn btn-primary " id="btn-search3">REENVIAR</button>
				</form>
			</div>
			</div>

			<!-- fim tab-pane -->
			<!-- FOTOS -->
			<div class="conteudotab tab-pane <?php echo $active_f ?>" id="fotos">
			<?php
			if(empty($facebook) && empty($instagram)){
				echo "<h3 class='text-center'>:( VOCÊ NÃO ADICIONOU NENHUMA FOTO AINDA<br/><small>(Coloque seu facebook e/ou instagram para que todos possam saber sobre seu trabalho)</small></h3>";
			}
			?>
			<div class="row col-md-10 col-md-offset-2" style="margin-top: 20px;">
				<!-- plugin fotos - facebook -->
				<?php if( $ref_facebook_user == "page"){ ?> <!-- só vai exibir se for página -->
				<div class="fb-album-container"></div>
				<?php } ?>
				<!-- plugin fotos - instagram -->
				<div id="insta-foto">

				</div>
				<!-- fim insta fotos -->
			</div>
			<!-- fim row col-md-9 col-md-offset-2 -->
			</div>
			<!-- fim tab-pane -->
			<!-- VIDEOS -->
			<div class="tab-pane" id="videos">
				<!-- plugin video - youtube -->
				<div class="youmax"></div>
			<?php
			if(empty($canal) || $canal == "https://www.youtube.com/channel/"){
				echo "<h3 class='text-center'>:( VOCÊ AINDA NÃO ADICIONOU UM CANAL DO YOUTUBE<br/><small>(Coloque seu canal do youtube para que todos possam ver seus vídeos sobre seu trabalho)</small></h3>";
			}
			?>				
			</div>
			<!-- fim tab-pane -->
			<!-- SEGUIDORES -->
<div class="tab-pane" id="seguidores">
			<div class="row">	
				<!-- resultado -->
				<div class="container" id="conteudo">
				<div class="col-sm-12 col-sm-offset-0">
				<p>Seguidores: <?php if(!empty($total_seguidor)){echo $total_seguidor;}else{echo "Ninguem";} ?></p>
				<!-- info-box / sera gerada pelo php apresentando os produtos dentro de um while -->
				<?php
				while ($conteudo_bsc_query = mysqli_fetch_array($limite_bsc)) {
				$id_fav = $conteudo_bsc_query['id_fk_cliente'];

				$query_fav_seguidores = mysqli_query($con,"SELECT id_usu,nome_completo,foto_perfil,numero_1,numero_2,numero_3,email_usu,email_contato FROM usuario WHERE id_usu='$id_fav'");
				$conteudo_bsc = mysqli_fetch_assoc($query_fav_seguidores);

				$img = $conteudo_bsc['foto_perfil'];
				$nome = $conteudo_bsc['nome_completo'];
				$n1 = $conteudo_bsc['numero_1'];
				$n2 = $conteudo_bsc['numero_2'];
				$n3 = $conteudo_bsc['numero_3'];
				$email_contato_seguidor = $conteudo_bsc['email_contato'];
				$email_seguidor = $conteudo_bsc['email_usu'];
				?>			
				<div class="info-box">
	<!-- notificacao de SEGUINDO -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-info' id='info_fav_s<?php echo $i_fav ?>'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close' id="fechar_info_fav<?php echo $i_fav ?>" onclick="sumir_s(<?php echo $i_fav ?>)">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>SEGUINDO</b>
	</div>
	</div>
	<!-- notificacao de DEIXOU DE SEGUIR -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-danger' id='info_fav_un_s<?php echo $i_fav ?>'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close' id="fechar_info_fav_un<?php echo $i_fav ?>" onclick="sumir_un_s(<?php echo $i_fav ?>)">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>DEIXOU DE SEGUIR</b>
	</div>
	</div>					
				<!-- <a href="http://qiseventos.com.br/<?php echo $url ?>" class="a-prod"> -->
					<span class="produto">
						<img src="<?php echo $img ?>" alt="Rounded Image" class="img-bola">
					</span>	
					<div class="info-content-produto">
						<span class="icp-titulo"><?php echo $nome ?></span>
						<?php if(!empty($n1)) { ?><span class="icp-desc"><?php echo $n1 ?></span> <?php } ?>
						<?php if(!empty($n2)) { ?><span class="icp-desc"><?php echo $n2 ?></span> <?php } ?>
						<?php if(!empty($n3)) { ?><span class="icp-desc"><?php echo $n3 ?></span> <?php } ?>
						<?php if(!empty($email_seguidor)) { ?><span class="icp-desc"><?php echo $email_seguidor ?></span> <?php } ?>
						<?php if(!empty($email_contato_seguidor)) { ?><span class="icp-desc"><?php echo $email_contato_seguidor ?></span> <?php } ?>
					</div>
				<!-- </a> -->
				<!--primeiro verifico se o usuario ja esta logado,
				 caso esteja, pego na tabela favoritos se ele ja foi favoritado pelo usuario..
				 se nao, o levo a tela de login/cadastro -->
				</div>
				<?php
				$i_fav++;
				}
				if (mysqli_num_rows($limite_bsc) == 0) {
					if($pacote == 2){
					echo "<h3 class='text-center'>:( NINGUÉM ESTÁ SEGUINDO VOCÊ</h3>";
					}else if($pacote == 1){
					echo "<h3 class='text-center'>:( NINGUÉM ESTÁ SEGUINDO VOCÊ<br/><small>(impulsione sua página! se torne <a href='premium.php'>MASTER</a> e esteja no topo de buscas em sua categoria !)</small></h3>";
					}else if($pacote == 0){
					echo "<h3 class='text-center'>:( NINGUÉM ESTÁ SEGUINDO VOCÊ<br/><small>(impulsione sua página! se torne <a href='premium.php'>PREMIUM</a> e esteja no topo de buscas em sua categoria !)</small></h3>";
					}
				}				
				?>	
				</div>
				<!-- fim div col-sm-12 col-sm-offset-0 -->
				</div>
				<!-- fim div container -->
				<div class="paginacao">
					<ul class="pagination pagination-primary">
					<?php
					// agora vamos criar os botões "Anterior e próximo"
					$anterior = $pc -1;
					$proximo = $pc +1;
					echo "<li><a href='?pagina=".$anterior."#favorites'><</a></li>";
					// O loop para exibir os valores à esquerda
					for($i = $pc-$tr_s; $i <= $pc-1; $i++){
						if($i > 0)
						echo "<li><a href='?pagina=".$i."#favorites'> ".$i." </a></li>";
					}
						echo "<li class='active'><a href='?pagina=".$pc."'>".$pc."</a></li>";
					for($i = $pc+1; $i < $pc+$tp; $i++){
						if($pc < $tp){
						echo "<li><a href='?pagina=".$i."#favorites'> ".$i." </a></li>";
						}
					}
						// Depois o link da página atual
						// O loop para exibir os valores à direita 
					if ($tp > 1) {
						if ($pc < $tp) {
						echo "<li><a href='?pagina=".$proximo."#favorites'>></a></li>";
						}
					}
					?>
					</ul>
					<!-- fim ul -->
				</div>
				<!-- fim paginacao -->
			</div>
			<!-- fim div row -->
			</div>
			<!-- fim div tab-pane active -->
			<!-- SEGUINDO -->
<div class="tab-pane <?php echo $active_s ?>" id="seguindo">
			<div class="row">
				<!-- resultado -->
				<div class="container" id="conteudo">
				<div class="col-sm-12 col-sm-offset-0">
				<p>Seguindo: <?php if(!empty($total_seguindo)){echo $total_seguindo;}else{echo "Ninguem";} ?></p>
				<!-- info-box / sera gerada pelo php apresentando os produtos dentro de um while -->
				<?php
				while ($conteudo_bsc_s = mysqli_fetch_array($limite_bsc_s)) {
				$id_fav_s_v = $conteudo_bsc_s['id_fk_usu'];
				$query_fav_usu = mysqli_query($con,"SELECT id_usu,nome_completo,pacote_usu,foto_perfil,descricao,rating,url_persona FROM usuario WHERE nivel = '3' AND id_usu='$id_fav_s_v'");
				$conteudo_bsc_s_usu = mysqli_fetch_assoc($query_fav_usu);

				$id_fav_s = $conteudo_bsc_s_usu['id_usu'];
				$img_s = $conteudo_bsc_s_usu['foto_perfil'];
				$nome_s = $conteudo_bsc_s_usu['nome_completo'];
				$sobre_s = $conteudo_bsc_s_usu['descricao'];
				$url_s = $conteudo_bsc_s_usu['url_persona'];
				$pacote_s = $conteudo_bsc_s_usu['pacote_usu'];
				$rate_s = $conteudo_bsc_s_usu['rating'];
				?>
				<div class="info-box">
	<!-- notificacao de SEGUINDO -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-info' id='info_fav<?php echo $i_fav_s ?>'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close' id="fechar_info_fav<?php echo $i_fav_s ?>" onclick="sumir(<?php echo $i_fav_s ?>)">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>SEGUINDO</b>
	</div>
	</div>
	<!-- notificacao de DEIXOU DE SEGUIR -->
	<div style='z-index:9999;display:none;width:250px;position:absolute;margin-left:-125px;left:50%;' class='alert alert-danger' id='info_fav_un<?php echo $i_fav_s ?>'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close' id="fechar_info_fav_un<?php echo $i_fav_s ?>" onclick="sumir_un(<?php echo $i_fav_s ?>)">
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	<b>DEIXOU DE SEGUIR</b>
	</div>
	</div>					
				<a href="https://qiseventos.com.br/<?php echo $url_s ?>" class="a-prod">										
					<span class="produto">
						<img src="<?php echo $img_s ?>" alt="Rounded Image" class="img-bola">
					</span>	
					<div class="info-content-produto">
						<span class="icp-titulo"><?php echo $nome_s ?> &nbsp;
							<?php
							if ($pacote_s == 1) {
							echo "<i rel='tooltip' title='Premium' data-html='true' data-placement='top'><img class='pacote_p' style='width:18px!important;height:15px!important;' src='assets/img/premium.png'></i>";
							}else if($pacote_s == 2){
							echo "<i rel='tooltip' title='Master' data-html='true' data-placement='top'><img class='pacote_m' style='width:35px!important;height:30px!important;' src='assets/img/master.png'></i>";
							}
							?>
						</span>
						<span class="icp-desc"><?php echo $sobre_s ?></span>
						<span class="icp-rate"><i class="material-icons" style="margin-right: -110px;color:yellow;">star_rate</i><?php echo $rate_s ?></span>
					</div>
				</a>
				<!--primeiro verifico se o usuario ja esta logado,
				 caso esteja, pego na tabela favoritos se ele ja foi favoritado pelo usuario..
				 se nao, o levo a tela de login/cadastro -->
				<?php
				if($lvl >= 2){
				$query_fav = mysqli_query($con,"SELECT id_fk_usu FROM favoritos WHERE id_fk_cliente ='$id_log'");		
				if(mysqli_num_rows($query_fav) == 0){
					 	echo '
							<button class="btn btn-primary btn-simple btn-fav" id="'.$i_fav_s.'" onclick="addFav('.$i_fav_s.','.$id_fav_s.','.$id_log.')">
							<i class="material-icons favorito" id="i-'.$i_fav_s.'">favorite_border</i>
							</button>';
				}else{
				while($linha_fav = mysqli_fetch_array($query_fav)) {
				
				$id_fk_dofav_s = $linha_fav['id_fk_usu'];
				// echo "ID do favorito: ".$id_fk_dofav."<br>";
				// echo "ID do anunciante: ".$id_fav ."<br>";
					if($id_fk_dofav_s == $id_fav_s){
					 	echo '
							<button class="btn btn-primary btn-simple btn-fav" id="'.$i_fav_s.'" onclick="removeFav('.$i_fav_s.','.$id_fav_s.','.$id_log.')">
							<i class="material-icons favorito" id="i-'.$i_fav_s.'">favorite</i>
							</button>';
						break;
						}						
						// fim se o id for o msm do favorito
				} //fim while
				if($id_fk_dofav_s != $id_fav_s){
					echo '
					<button class="btn btn-primary btn-simple btn-fav" id="'.$i_fav_s.'" onclick="addFav('.$i_fav_s.','.$id_fav_s.','.$id_log.')">
					<i class="material-icons favorito" id="i-'.$i_fav_s.'">favorite_border</i>
					</button>';
				}
				// fim se o id NAO for igual
				}
				// fim se a busca for diferente de 0
				}else{
					 echo '
						<a href="login.php" class="btn btn-primary btn-simple btn-fav">
							LOGAR-SE
						</a>';
				}
				// fim se ele for + que lvl 2
				
				?>
				</div>
				<?php
				$i_fav_s++;
				}
				// fim while cliente
				if (mysqli_num_rows($limite_bsc_s) == 0) {
				echo "<h3 class='text-center'>:( VOCÊ NÃO ESTÁ SEGUINDO NINGUÉM<br/><small>(Siga pessoas que você costuma contactar para tê-las sempre por perto)</small></h3>";
				}			
				?>				
				</div>
				<!-- fim div col-sm-12 col-sm-offset-0 -->
				</div>
				<!-- fim div container -->
				<div class="paginacao">
					<ul class="pagination pagination-primary">
					<?php
					// agora vamos criar os botões "Anterior e próximo"
					$anterior = $pc_s -1;
					$proximo = $pc_s +1;
					echo "<li><a href='?pagina=".$anterior."#favorites'><</a></li>";
					// O loop para exibir os valores à esquerda
					for($i = $pc_s-$tr_s; $i <= $pc_s-1; $i++){
						if($i > 0)
						echo "<li><a href='?pagina=".$i."#favorites'> ".$i." </a></li>";
					}
						echo "<li class='active'><a href='?pagina=".$pc_s."'>".$pc_s."</a></li>";
					for($i = $pc_s+1; $i < $pc_s+$tp_s; $i++){
						if($pc_s < $tp_s){
						echo "<li><a href='?pagina=".$i."#favorites'> ".$i." </a></li>";
						}
					}
						// Depois o link da página atual
						// O loop para exibir os valores à direita 
					if ($tp_s > 1) {
						if ($pc_s < $tp_s) {
						echo "<li><a href='?pagina=".$proximo."#favorites'>></a></li>";
						}
					}
					?>
					</ul>
					<!-- fim ul -->
				</div>
				<!-- fim paginacao -->
			</div>
			<!-- fim div row -->
			</div>
			<!-- fim div tab-pane active -->
			<a name="perfila"></a>
			<!-- PERFIL -->
			<div class="tab-pane <?php echo $active_a; ?>" id="perfil">
			<div class="row">
			<form method="post" action="assets/php/salvar_per.php" enctype="multipart/form-data">
			<div class="col-md-6" style="margin-top: 20px;">
			<!-- parte do form, pessoal -->
				<div class="col-sm-9">
					<?php
					if ($anunciar == "perfil") {
					echo '<input type="hidden" name="n_lvl" value="3" />';
					}else{
					echo '<input type="hidden" name="n_lvl" value="'.$lvl.'" />';
					}
					?>
					<h2>Pessoal</h2>
					<div class="form-group">
					<p>Nome:</p>
					<input type="hidden" name="id" value="<?php echo $id_log ?>"/>
		    		<input type="text" name="nome" value="<?php echo $nome_log ?>" placeholder="Nome completo" class="form-control" <?php echo $required ?> />
					</div>
					<div class="form-group" rel="tooltip" title="Altere seu <b>email</b>" data-html="true" data-placement="top">
					<p>E-mail:</p>
					<input type="email" name="email" value="<?php echo $email_log ?>" placeholder="E-mail" class="form-control" <?php echo $required ?> />
					</div>
					<div class="form-group">
					<p>Gênero(opcional):</p>
			    	<select name="sexo" class="form-control">
			    	<option value="" <?php echo $sexo==''?'selected':'';?> >Selecione</option>
				    <option value="m" <?php echo $sexo=='m'?'selected':'';?> >Masculino</option>
				    <option value="f" <?php echo $sexo=='f'?'selected':'';?> >Feminino</option>
				    <option value="o" <?php echo $sexo=='o'?'selected':'';?> >Outros</option>
			    	</select>
					</div>
					<div class="form-group">
					<p>Data de Nascimento(opcional):</p>
			    	<input type="date" name="dt_nasc" value="<?php echo $nascimento ?>" class="form-control" />
					</div>
					<?php
					if ($lvl == 3 || $lvl == 5) {
					?>
					<div class="form-group" rel="tooltip" title="Escolha sua categoria para que busquem você em sua devida categoria" data-html="true" data-placement="top">
					<p>1° Categoria:</p>
			    	<select name="categoria1" placeholder="categoria" class="form-control" <?php echo $required2 ?>>
			    	<option value="">Categoria</option>
					<?php
					$result= mysqli_query($con,"SELECT id_categoria,nome_categoria,nome_sub_categoria FROM categoria ORDER BY nome_categoria ASC, nome_sub_categoria ASC"); ?>
					<?php while($row = mysqli_fetch_assoc($result)) { ?>
					<?php if($nome_cat_primeira !== $row['nome_categoria']){ ?>
					<option disabled>_________</option>
					<option disabled style="color: #ccc"><?php echo $row['nome_categoria'] ?></option>
					<?php } ?>
					<option value="<?php echo $row['id_categoria'] ?>" <?php if ($row['id_categoria'] == $categoria1_fk) { ?>selected="selected"<?php } ?>>
					<?php echo htmlspecialchars($row['nome_sub_categoria']); ?>
					</option>
					<?php
					$nome_cat_primeira = $row['nome_categoria'];
					}
					?>
			    	</select>
					</div>
					<div class="form-group">
					<p>2° Categoria(opcional):</p>
			    	<select name="categoria2" placeholder="categoria" class="form-control" <?php echo $required2 ?>>
			    	<option value="NULL">Categoria</option>
					<?php
					$result= mysqli_query($con,"SELECT id_categoria,nome_categoria,nome_sub_categoria FROM categoria ORDER BY nome_categoria ASC, nome_sub_categoria ASC"); ?>
					<?php while($row = mysqli_fetch_assoc($result)) { ?>
					<?php if($nome_cat_primeira !== $row['nome_categoria']){ ?>
					<option disabled>_________</option>
					<option disabled style="color: #ccc"><?php echo $row['nome_categoria'] ?></option>
					<?php } ?>
					<option value="<?php echo $row['id_categoria'] ?>" <?php if ($row['id_categoria'] == $categoria2_fk) { ?>selected="selected"<?php } ?>>
					<?php echo htmlspecialchars($row['nome_sub_categoria']); ?>
					</option>
					<?php
					$nome_cat_primeira = $row['nome_categoria'];
					}
					?>
			    	</select>
					</div>
					<div class="form-group">
					<p>3° Categoria(opcional):</p>
			    	<select name="categoria3" placeholder="categoria" class="form-control" <?php echo $required2 ?>>
			    	<option value="NULL">Categoria</option>
					<?php
					$result= mysqli_query($con,"SELECT id_categoria,nome_categoria,nome_sub_categoria FROM categoria ORDER BY nome_categoria ASC, nome_sub_categoria ASC"); ?>
					<?php while($row = mysqli_fetch_assoc($result)) { ?>
					<?php if($nome_cat_primeira !== $row['nome_categoria']){ ?>
					<option disabled>_________</option>
					<option disabled style="color: #ccc"><?php echo $row['nome_categoria'] ?></option>
					<?php } ?>
					<option value="<?php echo $row['id_categoria'] ?>" <?php if ($row['id_categoria'] == $categoria3_fk) { ?>selected="selected"<?php } ?>>
					<?php echo htmlspecialchars($row['nome_sub_categoria']); ?>
					</option>
					<?php
					$nome_cat_primeira = $row['nome_categoria'];
					}
					?>
					</select>
					</div>
					<div class="form-group" rel="tooltip" title="Escreva mais sobre você, para que seus contratantes saibam melhor sobre seu trabalho" data-html="true" data-placement="top">
					<p>Sobre(opcional):</p>
					<textarea name="sobre" id="sobre" placeholder="Sobre(opcional)" row="10" <?php echo $n_pacote ?> class="form-control" style="height: 100px;"><?php echo $sobre ?></textarea>
					<p id="n_caracter">0/<?php echo $n_pacote_rest ?></p>
					</div>
					<h2>Financeiro</h2>
					<div class="form-group">
					<p>CPF(opcional):</p>
					<input type="text" name="cpf" value="<?php echo $cpf ?>" data-inputmask='"mask": "999.999.999-99"' min="14" data-mask placeholder="CPF" class="form-control" />
					</div>
					<div class="form-group">
					<p>RG(opcional):</p>
					<input type="text" name="rg" value="<?php echo $rg ?>" data-inputmask='"mask": "99.999.999.9"' min="12" data-mask placeholder="RG" class="form-control" />
					</div>
					<h2>Busca e contato</h2>
					<div class="form-group">
					<p>Estado:</p>
					<select class="form-control" id="estado" name="estado" <?php echo $required2 ?>>
					</select>
					</div>
					<div class="form-group">
					<p>Cidade:</p>
					<select class="form-control" id="cidade" name="cidade" <?php echo $required2 ?>>
						<option value="0">Cidade</option>
					</select>
					</div>
					<div class="form-group" rel="tooltip" title="adicione até 3 números para contato (2 celulares e 1 fixo) para contato (o primeiro é obrigatório)" data-html="true" data-placement="top">
					<p>Número para contato:</p>
					<input type="text" name="numero1" data-inputmask='"mask": "(99)9 9999-9999"' data-mask  value="<?php echo $numero1 ?>" placeholder="número de contato" class="form-control" />
					</div>
					<div class="form-group">
					<p>Número para contato(opcional):</p>
					<input type="text" name="numero2" data-inputmask='"mask": "(99)9 9999-9999"' data-mask  value="<?php echo $numero2 ?>" placeholder="número de contato(opcional)" class="form-control" />
					</div>
					<div class="form-group">
					<p>Número para contato(opcional):</p>
			    	<input type="text" name="numero3" data-inputmask='"mask": "(99) 9999-9999"' data-mask value="<?php echo $numero3 ?>" placeholder="número de contato(opcional)" class="form-control" />
					</div>
					<div class="form-group" rel="tooltip" title="O email para contato pode ou não ser igual ao email usado nesta conta" data-html="true" data-placement="top">
					<p>E-mail para contato:</p>
			    	<input type="email" name="email_contato" value="<?php echo $email_contato ?>" placeholder="email de contato" class="form-control" />
					</div>
					<?php } ?>
				</div>
				<!-- fim div col-sm-9 -->
			</div>
			<!-- fim div col-md-6 -->
			<div class="col-md-6" style="margin-top: 20px">
				<!-- CAPA -->
				<div class="per-capa">
					<img src="<?php if(!empty($foto_capa)){echo $foto_capa;}else{echo "assets/img/capap.jpg";} ?>" id="id_capa" alt="capa image" class="preview-capa img-perfil img-Rounded img-responsive img-raised" style="min-height: 0;"/><br>
					<label class="btn-mudar-capa btn-perfil btn btn-primary btn-lg">
	                <input style="display:none" type="file" id="upcapa" name="upcapa" accept="image/*"/>
					alterar capa
					</label>
					<input type="hidden" id="tupcapa" name="tupcapa">
				</div>
				<!-- fim CAPA -->
				<!-- PERFIL -->
				<div class="per-capa">
        			<img src="<?php if(!empty($foto_perfil)){echo $foto_perfil;}else{echo "assets/img/accountp.jpg";} ?>" alt="perfil image" id="id_fp" name="id_fp" class="preview-perfil img-perfil img-Rounded img-responsive img-raised" style="min-height: 0;" />
					<label class="btn-mudar-foto btn-perfil btn btn-primary btn-lg" >
					<input style="display:none" type="file" id="upperfil" name="upperfil" alt="perfil image" accept="image/*"/>
					alterar foto
					</label>
					<input type="hidden" id="tupperfil" name="tupperfil">
				</div>
				<!-- FIM PERFIL -->
				<!-- DESCRICAO -->
				<div class="form-group" rel="tooltip" title="Uma breve descrição para que as pessoas possam ler ao ver você na busca" data-html="true" data-placement="bottom">
				<input type="text" name="descricao" id="descricao" value='<?php echo $descricao ?>' placeholder="Descrição(opcional)" class="form-control" />
				<p id="n_caracter_desc">0/200</p>
				</div>
				<!-- caixa de informacao -->
				<div class="box box-solid">
				<div class="box-body no-padding">
					<h3 class="box-title">Informação</h3>
					<ul class="nav nav-pills nav-stacked">
						<?php if($pacote <= 1){ ?><li>Para aumentar o número máximo de caracteres em seu campo SOBRE, compre já seu pacote <b>premium</b> ou de um upgrade para o <b>master</b>!</li> <?php } ?>
						<li>O tamanho para a sua capa ideal é 850x350</li>
						<li>A sua descrição será usada para uma breve apresentação ao buscar por você</li>
						<li>Ao alterar seu email você receberá uma mensagem em seu novo endereço, para informação</li>
						<li>para adicionar suas mídias sociais e contatos, vá em configuração.</li>
						<li>Os campos não marcados com OPCIONAL, são obrigatórios.</li>
						<li>As imagens do PERFIL e CAPA, tem um limite de 5MB.</li>
					</ul>
				</div>
				</div>
				<button type="submit" class="btn-perfil btn btn-primary btn_save_p" id="btn-search2" name="btn_save_p"><i class="material-icons">save</i>&nbsp;SALVAR</button>
			</div>
			<!-- fim div col-md-6 -->
			</form>
			</div>
			<!-- fim div row -->
			</div>
			<!-- fim tab-pane -->
			<!-- fim PERFIL -->
		<!-- CONFIGURACAO -->
		<div class="tab-pane" id="configuracao">
		<div class="row">
		<form method="post" id="form_config" action="assets/php/salvar_config.php" enctype="multipart/form-data">			
			<div class="col-md-6">
			<div class="col-sm-9">
			<input type="hidden" name="email" value="<?php echo $email_log ?>" class="form-control" />
				<h2>Mudar a senha</h2>
				<div class="form-group">
				<p>Senha atual:</p>
		    	<input type="password" name="senha_atual" value="" placeholder="Senha atual" class="form-control" />
				</div>
				<div class="form-group">
				<p>Nova senha:</p>
		    	<input type="password" name="senha_nova" value="" placeholder="Nova senha" class="form-control" />
				</div>
				<div class="form-group">
				<p>Confirmar senha:</p>
		    	<input type="password" name="senha_nova_dnovo" value="" placeholder="Redigite novamente a senha" class="form-control" />
				</div>
				<h2>Notificações</h2>
				<div class="checkbox">
				<label>
				<input type="checkbox" name="noti_email" id="cb-email" <?php  echo $checked_e ?> >
				Notificação por e-mail
				</label>
				</div>
				<div class="checkbox">
				<label>
				<input type="checkbox" name="noti_app" id="cb-app" <?php  echo $checked_a ?> >
				Notificação pelo app/site
				</label>
				</div>
				<?php
				if (!($lvl == 3 || $lvl == 5)) {
				echo "<div style='display:none;'>";
				}
				?>
				<h2>Mídias e contatos</h2>
				<!-- so podera mudar a sua URL se for pacote premium ou master -->
				<?php if($pacote >= 1){ ?>
				<div class="form-group" rel="tooltip" title="<b>link</b>(<b>url</b>), para compartilhar com os outros(<b>NÃO é permitido caracteres especiais</b>)" data-html="true" data-placement="top">
				<?php }else{ ?>
				<div class="form-group" rel="tooltip" title="Para alterar seu nome de exibição você precisa ser <b>PREMIUM</b>" data-html="true" data-placement="top">
				<?php } ?>
				<p>Nome de exibição no LINK:</p>
				<?php if($pacote >= 1){ ?>
				<input type="text" id="url_p" name="url_persona" min="5" minlength=5 value="<?php echo $url_persona ?>" placeholder="nome de exibição" class="form-control" <?php echo $required2 ?> pattern="[a-zA-Z0-9]+"/>
				<?php }else{ ?>
				<input type="hidden" name="url_persona" value="<?php echo $url_persona ?>" />
				<input type="text" disabled id="url_p" name="url_persona" min="5" minlength=5 value="<?php echo $url_persona ?>" placeholder="nome de exibição" class="form-control" <?php echo $required2 ?> pattern="[a-zA-Z0-9]+"/>
				<?php } ?>
				<!-- fim url -->
				<p id="info_url"></p>
				<h5>clique e veja como um usuário a sua página de anuncio<small>(a página que abrir é a página que você compartilhará para divulgar o seu trabalho, e é a página que os outros verão )</small></h5>
				<a href="https://www.qiseventos.com.br/<?php echo $url_persona ?>" target="_blank" class="btn-perfil btn btn-primary" style="float: left;">Veja sua página de anuncio</a>
				<input type="text" class="form-control" value="https://www.qiseventos.com.br/<?php echo $url_persona ?>" readonly>
				<small>copie e divulgue seu trabalho!</small>
				</div>
				<div class="form-group" rel="tooltip" title="Adicione sua <b>PAGE</b> do facebook (facebook.com/<b>FANPAGE</b>)" data-html="true" data-placement="top">
				<p>Facebook(opcional):</p>
				<input type="text" name="conta_face" value="<?php echo $facebook ?>" placeholder="https://www.facebook.com.br/SUAFANPAGE(opcional)" class="form-control" />
				</div>
				<div class="form-group" id="inputsalbuns">
				<p>Álbum que NÃO será exibido(opcional):</p>
				<!-- criar um javascript para gerar este campo varias vezes-->
				<button type="button" rel="tooltip" title="Adicionar mais um álbum que <b>NÃO</b> será mostrado" data-html="true" data-placement="top" class="btn-perfil btn btn-primary pull-left" onclick="geradorinput();"><i class="material-icons">plus_one</i></button>
				<?php
				foreach ($arrN as $value) {
					echo '<input type="text" name="skip_albun[]" value="'.$value.'" placeholder="NOME Álbum que NÃO será mostrado(opcional)" class="form-control"/>';
				}
				?>
				</div>
				<div class="form-group" rel="tooltip" title="Adicione sua conta do twitter para ser mostrada na aba <b>contatos</b> de sua página de anuncio" data-html="true" data-placement="top">
				<p>Twitter(opcional):</p>
				<input type="text" name="twitter" value="<?php echo $twitter ?>" placeholder="Twitter(opcional)" class="form-control" />
				</div>
				<div class="form-group" rel="tooltip" title="Adicione sua conta do instagram para <b>buscar</b> suas fotos e apresentar na aba <b>contatos</b>" data-html="true" data-placement="top">
				<p>Instagram(opcional):</p>
				<input type="text" name="instagram" value="<?php echo $instagram ?>" placeholder="Instagram(opcional)" class="form-control" />
				</div>
				<div class="form-group" rel="tooltip" title="Apresente seu website na aba <b>contatos</b>" data-html="true" data-placement="top">
				<p>Website(opcional):</p>
				<input type="text" name="website" value="<?php echo $website ?>" placeholder="Website(opcional)" class="form-control" />
				</div>
				<div class="form-group" rel="tooltip" title="Apresente seu website na aba <b>contatos</b>" data-html="true" data-placement="top">
				<p>
				<a href="#" data-toggle='modal' data-target='#infosc' data-html='true'>
				<b>como fazer ?</b>
				</a>
				&nbsp;Soundcloud(opcional):</p>
				<input type="text" name="soundcloud" value="<?php echo $soundcloud ?>" placeholder="incorpore seu canal Soundcloud(opcional)" class="form-control" />
				</div>
				<div class="form-group" rel="tooltip" title="Adicione seu <b>canal</b> do youtube para mostrar seus videos" data-html="true" data-placement="top">
				<p>Canal Youtube(opcional):</p>
				<input type="text" name="youtube" value="<?php if($canal !== 'https://www.youtube.com/channel/'){echo $canal;} ?>" placeholder="Youtube(opcional)" class="form-control" />
				</div>
				<div class="form-group" rel="tooltip" title="Adicione o LINK da playlist do seu canal do youtube" data-html="true" data-placement="top">
				<p>Playlist Youtube(opcional):</p>
				<input type="text" name="playlist" value="<?php echo $playlist ?>" placeholder="LINK da playlist(Youtube)(opcional)" class="form-control" />
				</div>
				<?php if($lvl == 3 || $lvl == 5){ ?>
				<a class="btn-perfil btn btn-primary pull-left" style="position: absolute;" data-toggle="modal" data-target="#Modaldown" id="btn-down" rel="tooltip" title="Voltar a ser um usuário comum" data-html="true" data-placement="top"><i class="material-icons">keyboard_arrow_down</i>&nbsp;DEIXAR DE ANUNCIAR</a>
				<?php } ?>
				<?php
				if (!($lvl == 3 || $lvl == 5)) {echo "</div>";}
				?>
				<?php if($lvl == 4 || $lvl == 5){ ?>
				<div style="margin-top: 58px;">
				<a class="btn-perfil btn btn-primary pull-left" style="position: absolute;" data-toggle="modal" data-target="#Modaldown_a" id="btn-down_a" rel="tooltip" title="Voltar a ser um usuário ou anunciante comum" data-html="true" data-placement="top"><i class="material-icons">keyboard_arrow_down</i>&nbsp;DEIXAR DE FAZER PROPAGANDA</a>
				</div>
				<?php } ?>
			</div>
			<!-- fim div col-sm-9 -->
			</div>
			<!-- fim div col-md-6 -->
			<div class="col-md-6" style="margin-top: 15px;">
				<!-- caixa de informação -->
				<div class="box box-solid">
				<div class="box-body no-padding">
				<h3 class="box-title">Informação</h3>
				<ul class="nav nav-pills nav-stacked">
					<li>Ao mudar sua senha, você recebéra um e-mail.</li>
					<li>Você continuará recebendo notificações via e-mail, mesmo que as 2 estejam marcadas.</li>
					<?php
					if ($lvl == 3 || $lvl == 5){
					echo "
					<li>As suas mídias sociais adicionadas são apresentadas na sua página de anuncio, para que todos possam ver e entrar em contato.</li>";
					}
					?>
					<li>Os campos <b>não</b> marcados com OPCIONAL, são obrigatórios.</li>
					<li>Por favor, adicionar somente o nome de sua fan page no facebook (sem " / " no final).</li>
					<li>Verifique após salvar, se suas fotos e vídeos estão aparecendo, caso persista algum erro, por favor entre em contato.</li>
					<li><b>DICA</b>: o Facebook apenas permite exibir suas fotos se for uma PÁGINA, e não um PERFIL.</li>
					<li><b>OBS</b>: o Facebook apenas permite exibir as fotos de páginas PÚBLICAS, privadas não serão mostradas.</li>
					<li><b>OBS</b>: Páginas do facebook com nomes que contenham - (traços) não são exibidos.</li>
					<li><b>OBS</b>: Páginas do Instagram privadas não podem ser exibidas.</li>
					<li>Mesmo que não apresente suas fotos, coloque seu facebook para contato.</li>
					<li><b>POR FAVOR, COLOQUE TODO O LINK DA SUA CONTA DO YOUTUBE E/OU sua PLAYLIST</b>.</li>
					<li><b>A sua URL (link), não poderá conter caracteres especiais</b>.</li>
					<li>para alterar seu email, vá em perfil.</li>
					<li>Caso deseja excluir sua conta, seus dados serão apagados do nosso servidor, sem qualquer cobrança, e não será mais possivel que os nosso usuários entre em contato, não enviaremos mais e-mails também.</li>
				</ul>
				</div>
				</div>
				<a class="btn-perfil btn btn-primary pull-left" style="position: absolute;" data-toggle="modal" data-target="#Modalexcluir" id="btn-excluir" rel="tooltip" title="Excluir sua conta" data-html="true" data-placement="top"><i class="material-icons">delete</i>&nbsp;EXCLUIR</a>
				<button type="submit" class="btn-perfil btn btn-primary " id="btn-search"><i class="material-icons">save</i>&nbsp;SALVAR</button>
			</div>
			<!-- fim div col-md-6 -->
		</form>
		</div>
		<!-- fim div row -->
		</div>
		<!-- fim CONFIGURACAO -->
		<!-- fim div tab-pane -->
		</div>
		<!-- fim div tab-content -->
<?php if($pacote <= 1){ ?>
	<div class="adsfooter col-md-12 col-sm-offset-2">
	<!-- anuncio-retangular-footer -->
	<?php if (mysqli_num_rows($pe_prop_rodape) == 0) { ?>
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
	<a href="assets/php/clic_prop.php?id_prop=<?php echo $pe_id_prop_5_noum; ?>&local=<?php echo $pe_local6; ?>" target="_blank"><img src="<?php echo $pe_img_prop_5_noum; ?>" /></a>
	<?php
	// chama a funcao de visualizar
	visualiza_prop($pe_local6,$pe_id_prop_5_noum, $con);
	} ?>
	</div>
<?php } ?>

		</div>
		<!-- fim div container -->
		</div>
		<!-- fim div profile-content -->
    	</div>
    	<!-- fim div main main-raised -->
	</div>
    <!-- fim div wrapper -->

	<!-- modal do soundcloud -->
	<?php include_once 'assets/php/modal_infosc.php'; ?>
    <!-- 2 MODAIS para o RECORTE da foto CAPA e PERFIL -->
    <!-- modal foto capa-->
	<div class="modal fade" id="modal-capa" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
	<div id="id-modal-dialog-capa" class="modal-dialog" role="document">
	<div id="modal-content-capa" class="modal-content">
		<div id="modal-header-capa" class="modal-header">
			<button id="close-capa" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 id="modal-title-capa" class="modal-title">Recorte sua imagem</h4>
		</div>
		<!-- fim div modal-header -->
		<p id="avisoc" class="text-center"></p>
		<div id="modal-body-capa" class="modal-body">
			<div style="display: block; width: 550px; height: 300px; margin-bottom:10px">
				<div id="upload-demo-capa"></div>
			</div>
        	<div class="col-xs-12 col-sm-4 col-sm-offset-4"></div>
      	</div>
      	<!-- fim div modal-body -->
      	<div id="modal-footer-capa" class="modal-footer">
			<button type="button" id="cancelCropBtn-capa" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
			<button type="button" id="cortarImageBtn-capa" class="btn btn-primary">Cortar</button>
		</div>
		<!-- fim div modal-footer -->
	</div>
	<!-- fim div modal-content -->
	</div>
	<!-- fim div modal-dialog -->
	</div>
	<!-- fim div modal fade -->
    <!-- modal foto perfil -->
	<div class="modal fade" id="modal-perfil" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
	<div id="modal-dialog-perfil" class="modal-dialog" role="document">
	<div id="modal-content-perfil" class="modal-content">
		<div id="modal-header-perfil" class="modal-header">
        	<button id="close-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 id="modal-title-perfil" class="modal-title">Recorte sua imagem</h4>
		</div>  
		<!-- fim div modal-header -->
		<p id="avisop" class="text-center"></p>
		<div id="modal-body-perfil" class="modal-body">   
			<div style="display: block; width: 300px; height: 300px;">
				<div id="upload-demo-perfil"></div>
			</div>
          <div class="col-xs-12 col-sm-4 col-sm-offset-4"></div>
      	</div>
      	<!-- fim div modal-body -->
		<div id="modal-footer-perfil" class="modal-footer">
			<button type="button" id="cancelCropBtn-perfil" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
			<button type="button" id="cortarImageBtn-perfil" class="btn btn-primary" data-dismiss="modal">Cortar</button>
		</div>
		<!-- fim div modal-footer -->
    </div>
    <!-- fim modal-content -->
	</div>
	<!-- fim div modal-dialog -->
	</div>
	<!-- fim div modal fade -->
	
<!-- Modal Excluir-->
<div class="modal fade" id="Modalexcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
				<h4 class="modal-title">Deseja realmente excluir sua conta?</h4>
			</div>
			<div class="modal-body">
			<form method="post" action="assets/php/excluir_conta.php" enctype="multipart/form-data">
				<p>A exclusão da conta irá apagar todas os seus dados. Para prosseguir com a exclusão informe sua senha</p>			
				<input type="hidden" name="exemail" value="<?php echo $email_log ?>" class="form-control" />
				<input type="password" id="exsenha" name="exsenha" placeholder="senha" required>
				<input type="hidden" name="exid" value="<?php echo $id_log ?>" class="form-control" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-danger btn-simple" >Excluir</button>			
			</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->
<!-- Modal Downgrade-->
<div class="modal fade" id="Modaldown" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
				<h4 class="modal-title">DEIXAR DE ANUNCIAR?</h4>
			</div>
			<div class="modal-body">
			<form method="post" action="assets/php/down_lvl.php">
				<p>Você realmente deseja deixar de anunciar? Ao deixar de anunciar você <b>não</b> será mais um anunciante (caso tenha uma conta premium/master, você também deixará de ser), não poderá mais anunciar seus serviços.</p>
				<p>obs: Ainda continuará tendo sua conta, podendo buscar, comentar e seguir, porém como um usuário comum.</p>
				<input type="hidden" name="down_email" value="<?php echo $email_log ?>" class="form-control" />
				<input type="password" id="down_senha" name="down_senha" placeholder="senha" required>
				<input type="hidden" name="down_id" value="<?php echo $id_log ?>" class="form-control"/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-danger btn-simple" >Deixar de Anunciar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->
<!-- Modal Downgrade ANUNCIANTE-->
<div class="modal fade" id="Modaldown_a" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
				<h4 class="modal-title">DEIXAR DE FAZER PROPAGANDA?</h4>
			</div>
			<div class="modal-body">
			<form method="post" action="assets/php/down_lvl_anunciante.php">
				<p>Você realmente deseja deixar de fazer propaganda? Ao deixar de fazer propaganda você <b>não</b> será mais um anunciante, não poderá mais fazer propaganda de seus serviços em nossos espaços pelo site.</p>
				<p>obs: Ainda continuará tendo sua conta, podendo buscar, comentar e seguir, porém como um usuário comum ou como um cliente com sua conta como estava.</p>
				<input type="hidden" name="down_email" value="<?php echo $email_log ?>" class="form-control" />
				<input type="password" id="down_senha_anun" name="down_senha" placeholder="senha" required>
				<input type="hidden" name="down_id" value="<?php echo $id_log ?>" class="form-control"/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-danger btn-simple" >Deixar de fazer propaganda</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--  End Modal -->
<div id="testenoti">
<div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
</div>
<?php include 'assets/php/modal.php';?>

<!-- footer -->
<?php include 'assets/php/footer.php'; ?>
<!-- footer -->
<?php if(!empty($soundcloud)){ ?>
<!-- IFRAME SOUNDCLOUD -->
	<div id="player-bottom-wrapper">
	<div id="middle">
		<div id="current_playlist">
			<div id="current_playlist_header">
				<div id="current_playlist_close"></div>
				<div class="current_playlist_header_item"></div>
			</div>
			<iframe id="so" width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/<?php echo $soundcloud ?>&amp;color=%23ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true"></iframe>
		</div>
		<div id="bottom">
			<div id="bottom_controls">
				<div id="prev_button" class="controls_button"></div>
				<div id="playpause">
					<div id="play_button" button class="play_button controls_button" style="display:block" ></div>
					<div id="pause_button" button class="play_button controls_button" style="display:none" ></div>
				</div>
				<div id="next_button" class="controls_button"></div>
			</div>
			<div id="volume">
				<div id="volume_speaker" class="volume_on"></div>
				<div id="volume_back"></div>
			</div>
			<div id="display">
				<div class="display_song_container">
					<div id="display_coverart"></div>
					<div id="display_text">
						<a id="display_song"></a>
					</div>
					<div id="display_time">
						<div id="display_time_count">0:00</div>
						<div id="display_progress"><div id="display_progress_loading"></div></div>
						<div id="display_time_total"></div>
					</div>
				</div>
			</div>
			<div id="playlist_button"></div>
			<div id="top_button">
				<div id="top_text">TOP</div>
			</div>
		</div>
	</div>
	</div>
<?php } ?>

<!-- jQuery 3.1.1 -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<!-- temporizador -->
<script src="assets/js/temporizador.js"></script>
<!-- bookmark_bubble -->
<script type="text/javascript" src="assets/js/bookmark_bubble.min.js"></script>
<script src="assets/js/lightbox-plus-jquery.min.js"></script>
<!-- js plugin facebook -->
<script src="assets/js/albumbrowser.min.js"></script>
<!-- Core JS Files -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/nouislider.min.js" type="text/javascript" async></script>
<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- script nosso -->
<script src="assets/js/sis_js.js" type="text/javascript" async></script>
<!-- youmax youtube plugin -->
<script src="assets/js/youmax.min.js" type="text/javascript"></script>
<!-- InputMask -->
<script src="assets/js/jquery.inputmask.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/croppie.2.4.0.js"></script>
<script type="text/javascript" src="assets/js/upfotocapa.js"></script>
<script type="text/javascript" src="assets/js/upfotoperfil.js"></script>
<!-- rating star -->
<script src="assets/js/star-rating.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/cidades-estados-1.2-utf8.js" type="text/javascript"></script>
<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="assets/js/material-kit.min.js" type="text/javascript"></script>
<!-- script interno JS -->
<script type="text/javascript">
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
		// TODO SCRIPT DE FAVORITO!!
		// removo do favorito
		function removeFav(x_r,id_r,id_usu_r) {
		var btn = document.getElementById(x_r);
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
		// add ao favorito
		function addFav(x,id,id_usu) {
		var btn = document.getElementById(x);
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

		// TODO SCRIPT DE FAVORITO PARA SEGUIDORES!!
		// removo do favorito
		function removeFav_s(x_r,id_r,id_usu_r) {
		var btn = document.getElementById('s_'+x_r);
		var fav = document.getElementById('s_i-'+x_r);
		fav.innerHTML = "favorite_border";	

		btn.setAttribute('onclick', 'addFav_s('+x_r+','+id_r+','+id_usu_r+');');	

		// após remover do front, usar ajax ou outro qualquer para acessar codigo php e remover do usuario no banco
		  $.ajax({
		  type: "POST",
		  url: "assets/php/remover_favorito.php",
		  data: 'id_fav='+id_r+'&id_usu='+id_usu_r,
		  sucess: aparecer_un_s(x_r)
		  });		
		}
		// add ao favorito
		function addFav_s(x,id,id_usu) {
		var btn = document.getElementById('s_'+x);
		var fav = document.getElementById('s_i-'+x);
		fav.innerHTML = "favorite";	

		btn.setAttribute('onclick', 'removeFav_s('+x+','+id+','+id_usu+');');

		// após add no front, usar ajax ou outro qualquer para acessar codigo php e add ao usuario no banco
		  $.ajax({
		  type: "POST",
		  url: "assets/php/favoritei.php",
		  data: 'id_fav='+id+'&id_usu='+id_usu,
		  sucess: aparecer_s(x)
		  });
		}

		// funcoes de aparecer e sumir para add
		function aparecer_s(id_x_a) {
		document.getElementById('info_fav_s'+id_x_a).style.display = 'block';
		setTimeout(sumir_s,1000,id_x_a);
		}
		function sumir_s(id_x_s) {
		// $("#fechar_info_fav"+id_x_s).click();
		document.getElementById('info_fav_s'+id_x_s).style.display = 'none';
		}

		// funcoes de aparecer e sumir para deixar de seguir
		function aparecer_un_s(id_x_a) {
		document.getElementById('info_fav_un_s'+id_x_a).style.display = 'block';
		setTimeout(sumir_un_s,1000,id_x_a);
		}
		function sumir_un_s(id_x_s) {
		// $("#fechar_info_fav_un"+id_x_s).click();
		document.getElementById('info_fav_un_s'+id_x_s).style.display = 'none';
		}
		// ---------------------- FIM SCRIPT FAVORITO PARA SEGUIDORES --------------------

	$(function () {
	//Datemask dd/mm/aaaa
	$("#datemask").inputmask("dd/mm/aaaa", {"placeholder": "dd/mm/aaaa"});    
	$("[data-mask]").inputmask();    
	});
	// funcao gerador de input (para os albuns, config)
	function geradorinput() {
    var x = document.createElement("INPUT");
    var div = document.getElementById("inputsalbuns");
    x.setAttribute("type", "text");
    x.setAttribute("name", "skip_albun[]");
    x.setAttribute("class", "form-control");
    x.setAttribute("placeholder", "NOME do álbum que NÃO será mostrado");
    div.appendChild(x);
	}		

if ("<?php echo $anunciar ?>" == "perfil") {
var submit_clicked = true;
$('.btn_save_p').click(function(){
    submit_clicked = false;
});	
	window.onload = function() {
		
	    window.addEventListener("beforeunload", function (e) {
	    	if(submit_clicked == true){
			if(!e) e = window.event;
			//e.cancelBubble is supported by IE - this will kill the bubbling process.
			e.cancelBubble = true;
			e.returnValue = 'You sure you want to leave?'; //This is displayed on the dialog
		  $.ajax({
		  type: "GET",
		  url: "assets/php/up_lvl.php",
		  data: 'anunciar=down'
		  });
			//e.stopPropagation works in Firefox.
			if (e.stopPropagation) {
				e.stopPropagation();
				e.preventDefault();
			}
		}
	    });
		
	};
}


$(document).ready(function() {
    // function sobre o rating star do cliente
    $("#input-21f").rating({
    starCaptions: function (val) {
    if (val < 3) {
    return val;
    } else {
    return 'high';
    }
    },
    hoverOnClear: false
    });

    // limitar tamanho da foto upada
	var upload = document.getElementById("upperfil");
	upload.addEventListener("change", function(e) {
	    var size = upload.files[0].size;
	    if(size <= (1048576 * 5) ) { //1MB x 5 = 5MB
	    	//Abaixo do permitido
	    	$("#upload-demo-perfil").css("display", "block");
	    	$("#avisop").html("");
	    	$("#avisop").css("display", "none");
			$("#cortarImageBtn-perfil").removeAttr("disabled", "disabled"); //desativa o botao
	    } else {
			$("#upload-demo-perfil").css("display", "none");
	    	$("#avisop").html("TAMANHO DA IMAGEM NÃO SUPORTADO (selecione uma imagem dentro do limite (5MB))");
	    	$("#avisop").css("display", "block");
			upload.value = ""; //Limpa o campo
			$("#cortarImageBtn-perfil").attr("disabled", "disabled"); //desativa o botao
			e.stopPropagation();
	    }
	    e.preventDefault();
	});
    // limitar tamanho da foto upada
	var uploadc = document.getElementById("upcapa");
	uploadc.addEventListener("change", function(e) {
	    var size = uploadc.files[0].size;
	    if(size <= (1048576 * 5) ) { //1MB x 5 = 5MB
	    	$("#upload-demo-capa").css("display", "block");
	    	$("#avisoc").html("");
	    	$("#avisoc").css("display", "none");
			$("#cortarImageBtn-capa").removeAttr("disabled", "disabled"); //desativa o botao
	    } else {
			$("#upload-demo-capa").css("display", "none");
	    	$("#avisoc").html("TAMANHO DA IMAGEM NÃO SUPORTADO (selecione uma imagem dentro do limite (5MB))");
	    	$("#avisoc").css("display", "block");
			uploadc.value = ""; //Limpa o campo
			$("#cortarImageBtn-capa").attr("disabled", "disabled"); //desativa o botao
			e.stopPropagation();
	    }
	    e.preventDefault();
	});    	

    // function script js do facebook
    if ("<?php echo $facebook ?>") {
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=677876605734655";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    // function plugin facebook
    $(".fb-album-container").FacebookAlbumBrowser({
    account: "<?php echo $facebook ?>", // vem do db
    accessToken: "677876605734655|toVDgixKpw54ywgz_PSRncSgUII",
    skipAlbums: ["<?php echo implode('","', $arrN)?>"], // vem do banco 1155489667929155|rzY5iyuDnCo5djBBoxDnnqh0Py4
    showAccountInfo: true,
    showImageCount: true,
    showImageText: true,
    lightbox: true,
    photosCheckbox: true
    });
	}
    // fim facebook
    <?php if(!empty($instagram)){ ?>
    var id_si_insta;
	function instagram_ph() {

    // scriot INSTAGRAM
	var name_insta = "<?php echo $instagram ?>",
	itens_insta;
    $.getJSON("https://query.yahooapis.com/v1/public/yql?callback=?", 
	{
	  q: "select * from json where url='https://www.instagram.com/" + name_insta + "/?__a=1'",
	  format: "json"
	},
    function(data_insta) {
	  if (data_insta.query.results) {
		    itens_insta = data_insta.query.results.json.user.media.nodes;
		    if ( !itens_insta ) {clearInterval(id_si_insta);}
	        $.each(itens_insta, function(n, item) {

				$('#insta-foto').append(
				$("<a class='photoI' rel='tooltip' title='"+item.caption+"' data-html='true' data-placement='top' target='_blank' href='https://www.instagram.com/p/"+item.code+"' />", {
				href: 'https://www.instagram.com/p/'+item.code,
				target: '_blank'
				}).css({
					backgroundImage: 'url(' + item.thumbnail_src + ')'
				}));

	        });
    	}
    });

	}

	id_si_insta = setInterval(function(){
	  if( !$.trim($("#insta-foto").html()) ){
	  	// se for vazio carrega o script
	  	instagram_ph();
	  }
	}, 1000);
	<?php } ?>
    // function plugin video yt
    if (<?php echo $lvl ?> == 3 || <?php echo $lvl ?> == 5) {
    if ( ("<?php echo $canal ?>" != "") && ("<?php echo $canal ?>" !== "https://www.youtube.com/channel/")) {
    if ("<?php echo $playlist ?>" !== "") {
    $(".youmax").youmax({
    apiKey:"AIzaSyAlhAqP5RS7Gxwg_0r_rh9jOv_5WfaJgXw",
    channelLink:"<?php echo $canal ?>",//vem do banco
    playlistLink:"<?php echo $playlist ?>", //vem do banco
    defaultTab:"Uploads",//Uploads|Playlists|Featured
    videoDisplayMode:"popup",//popup|link|inline
    maxResults:"9", //n de videos ao iniciar
    autoPlay:false,
    displayFirstVideoOnLoad :true,//for inline video display mode only
    responsiveBreakpoints   :[600,900,2000,2500],
    loadMoreText            :"<i class=\"fa fa-plus\"></i>&nbsp;&nbsp;Mostrar mais vídeos..",
    previousButtonText      :"<i class=\"fa fa-angle-left\"></i>&nbsp;&nbsp;Anterior",
    nextButtonText          :"Próximo&nbsp;&nbsp;<i class=\"fa fa-angle-right\"></i>",
    loadingText             :"Carregando...",
    allDoneText             :"<i class=\"fa fa-times\"></i>&nbsp;&nbsp;",
    hideHeader              :false,
    hideTabs                :false,
    hideLoadingMechanism    :false,
    });
	}else{
    $(".youmax").youmax({
    apiKey:"AIzaSyAlhAqP5RS7Gxwg_0r_rh9jOv_5WfaJgXw",
    channelLink:"<?php echo $canal ?>",//vem do banco
	playlistLink:"https://www.youtube.com/playlist?list=PLNkCMxwdvR4ohE3mcFY0X_MV028CIyr6t", //vem do banco
    defaultTab:"Uploads",//Uploads|Playlists|Featured
    videoDisplayMode:"popup",//popup|link|inline
    maxResults:"9", //n de videos ao iniciar
    autoPlay:false,
    displayFirstVideoOnLoad :true,//for inline video display mode only
    responsiveBreakpoints   :[600,900,2000,2500],
    loadMoreText            :"<i class=\"fa fa-plus\"></i>&nbsp;&nbsp;Mostrar mais vídeos..",
    previousButtonText      :"<i class=\"fa fa-angle-left\"></i>&nbsp;&nbsp;Anterior",
    nextButtonText          :"Próximo&nbsp;&nbsp;<i class=\"fa fa-angle-right\"></i>",
    loadingText             :"Carregando...",
    allDoneText             :"<i class=\"fa fa-times\"></i>&nbsp;&nbsp;",
    hideHeader              :false,
    hideTabs                :true,
    hideLoadingMechanism    :false,
    });	
	}
	}
	}
    // fim youmax    
});// fim (document).ready

// limitador de caracteres para o campo SOBRE
if ( ("<?php echo $n_pacote_rest ?>" != "SEM LIMITES") ) {
$(document).on("input", "#sobre", function () {
    var limite = <?php if($n_pacote_rest != "SEM LIMITES"){echo $n_pacote_rest;}else{echo "1";} ?>;
    var caracteresDigitados = $(this).val().length;
    var caracteresRestantes = limite - caracteresDigitados;

    $("#n_caracter").text(caracteresRestantes+"/"+limite);

    $('#sobre').keypress(function(e) {
        if (e.which < 0x20) {
            // e.which < 0x20, then it's not a printable character
            // e.which === 0 - Not a character
            return;     // Do nothing
        }
        if (this.value.length == limite) {
            e.preventDefault();
        } else if (this.value.length > limite) {
            // Maximum exceeded
            this.value = this.value.substring(0, limite);
        }
    });    
});
}
// limitador de caracteres para o campo DESCRICAO
$(document).on("input", "#descricao", function () {
    var limite = 200;
    var caracteresDigitados = $(this).val().length;
    var caracteresRestantes = limite - caracteresDigitados;

    $("#n_caracter_desc").text(caracteresRestantes+"/"+limite);

    $('#descricao').keypress(function(e) {
        if (e.which < 0x20) {
            // e.which < 0x20, then it's not a printable character
            // e.which === 0 - Not a character
            return;     // Do nothing
        }
        if (this.value.length == limite) {
            e.preventDefault();
        } else if (this.value.length > limite) {
            // Maximum exceeded
            this.value = this.value.substring(0, limite);
        }
    });
});
// verificar se url e valida
$(document).on("input", "#url_p", function () {
// escreve na tela procurando, para o usuario esperar
$("#info_url").text("Espere,procurando...");
// recebe o valor que o usuario digitou
var url_vem = $(this).val();
	// verifica no banco
	$.post('assets/php/buscarurl.php', {url: url_vem },function(resposta) {
		// se receber um valor igual, parar o envio do formulario e informar o usuario que ja existe essa url, se nao prosseguir
		if(url_vem.toLowerCase() === resposta.toLowerCase()){
			$('#form_config').attr('onsubmit','return false;');
			$("#info_url").text("Já existe!");
			document.getElementById("url_p").focus();
		}else{
			$('#form_config').attr('onsubmit','return true;');
			$("#info_url").text("Disponível!");
		}
	});
});
if (<?php echo $lvl ?> == 3 || <?php echo $lvl ?> == 5) {
// scrípt cidade e estado
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
	// se o estado for all, deixa o option todos selecionado
	if ( '<?php echo $estado ?>' == 'all' ) { $("#estado").val("all"); }
	// se a cidade for all, deixa o option todos selecionado
	if ( '<?php echo $cidade ?>' == 'all' ) { $("#cidade").val("all"); }

}
</script>
<!-- fim js externo -->