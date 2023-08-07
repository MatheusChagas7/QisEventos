<?php
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';

//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache_visitante.php';

$envio = $_GET["envio"];
$done = $_GET["done"];
// recebe em md5 o id
$id_prop = $_GET["id_prop"];
if (!empty($id_prop)) {

// pega os dados da propaganda
$query_getprop = mysqli_query($con, " SELECT id_propaganda,fk_propaganda_usu,pagina,dt_inicio,dt_fim,preco, DATEDIFF(dt_fim,dt_inicio) AS dias FROM propaganda WHERE id_propaganda = '$id_prop'");
$linha_propall = mysqli_fetch_assoc($query_getprop);

$id_dousu = $linha_propall['fk_propaganda_usu'];
$pagina = $linha_propall['pagina'];
$antigo_preco = $linha_propall['preco'];
$dias = $linha_propall['dias'];
// pega o valor anterior, divide pelos dias (data final - data inicial) e depois apenas multiplique pelos novos dias
$novo_preco = number_format( ($antigo_preco / $dias), 2, '.', '');

// exibir a data antiga
$antiga_data = "de " . $linha_propall['dt_inicio'] . " até " . $linha_propall['dt_fim'];
// pega os dados do usuario dono da propaganda
$query_getusu = mysqli_query($con, " SELECT id_usu,nome_completo,email_usu,cpf_usu,numero_1 FROM usuario WHERE id_usu = '$id_dousu'");
$linha_usuall = mysqli_fetch_assoc($query_getusu);

$nome_dousu = $linha_usuall['nome_completo'];
$email_dousu = $linha_usuall['email_usu'];
$cpf_usu_bd = $linha_usuall['cpf_usu'];
$numero_1_bd = $linha_usuall['numero_1'];

// pega do banco os dados necessários do usu
$query_g_a_usuc =  mysqli_query($con,"SELECT cep_usu FROM usuario_continue WHERE id_fk_usu_continue = '$id_dousu'");
$linha_g_a_usuc = mysqli_fetch_assoc($query_g_a_usuc);

$cep_bd = $linha_g_a_usuc['cep_usu'];

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

// trata as paginas para retirar as ","
function tratarpag($var){
	$var = str_replace(',', ' ', $var);
	return $var;
}

} // fim se id for diferente de vazio
?>
<!doctype html>
<html lang="pt-br">
<head>
	<title>QISeventos - Reative sua propaganda</title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="theme-color" content="#4B4B4D"/>
	<meta property="og:locale" content="pt_BR">
	<meta property="og:url" content="http://www.qiseventos.com.br/reativar_propaganda.php">
	<meta property="og:title" content="QISeventos">
	<meta property="og:site_name" content="QISeventos">
	<meta property="og:description" content="Reative a sua propaganda que já expirou">
	<meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200"> <!-- pixel -->
	<meta property="og:image:height" content="200"> <!-- pixel -->
	<meta name="description" content="Reative a sua propaganda que já expirou">
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

<body id="b_n">
	<!-- notificacao em primeiro plano/alert -->
	<?php include 'assets/php/notificacao-alert.php';?>
	<nav class="navbar navbar-fixed-top">
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
	<div class="wrapper" style="margin-top: -130px!important;">
	<div class="header"></div> <!-- header -->
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main main-raised">
	<div class="container">
	<div class="col-md-12 col-md-offset-0" style="margin-top: 108px">
		<!-- info -->
		<div class="col-md-6 minimo">
			<div class="box box-solid">
			<div class="box-body no-padding">
				<h3 class="box-title text-center">Reative sua propaganda</h3>
				<ul class="nav nav-pills nav-stacked" style="text-align: justify;">
					<li>A sua propaganda está desativa pois a data final já passou.</li>
					<li>Para reativar a sua propaganda coloque a nova data que deseja ser exibida.</li>
					<li>Confirme seus dados novamente e escolha o modo de pagamento.</li>
					<li><b>A propaganda que está desativada é a da página - <?php if(!empty($pagina)){ echo tratarpag($pagina); }else{ echo "SEM PROPAGANDA";} ?></b></li>
					<li><b>OBS:</b> Nos dados anteriores você pode ver o preço que a sua propaganda valeu e a antiga data da propaganda veiculada.</li>
				</ul>
			</div>
			</div>
		</div>
		<!-- fim info -->
		<div class="col-md-6" style="margin-bottom: 50px;">
		<!-- parte do form, pessoal -->
		<h3>Data e dados:</h3>
		<div class="col-sm-10">
		<form action="assets/php/reativar_propaganda.php" method="POST">
		<!-- dados antigos -->
		<h4 class="text-center">Dados anteriores</h4>
		<div class="form-group">
		<h5>ANTIGO VALOR</h5><small>[em reais(R$) ]</small>
		<input type="text" id="antigo_preco" name="antigo_preco" value="<?php echo $antigo_preco ?>" class="form-control" required readonly/>
		</div>
		<div class="form-group">
		<h5>Data anterior</h5>
		<input type="text" id="antiga_data" name="antiga_data" value="<?php echo $antiga_data ?>" class="form-control" required readonly/>
		</div>
		<!-- fim dados antigos -->
		<!-- data nova -->
		<h4 class="text-center">Nova Data</h4>
		<h3>Inicio</h3>
		<div class="form-group">
		<input type="date" class="form-control" id="dt_inicio" name="dt_inicio" required />
		</div>
		<h3>Fim</h3>
		<div class="form-group">
		<input type="date" class="form-control" id="dt_fim" name="dt_fim" disabled="disabled" required />
		</div>
		<!-- fim nova data -->
		<!-- dados de pagamento -->
		<h4 class="text-center">Pessoal</h4>
		<div class="form-group">
		<input type="hidden" id="id_prop" name="id_prop" value="<?php echo $id_prop ?>" required />
		<input type="hidden" name="id_usu" value="<?php echo $id_dousu ?>" required />
		<input type="hidden" id="preco_basico" name="preco_basico" value="<?php echo $novo_preco ?>" required />
		<h4>Nome</h4>
		<input type="text" id="nome" name="nome" pattern="([A-zÀ-ž\s]){4,}" value="<?php echo $nome_dousu ?>" placeholder="nome completo" class="form-control" required />
		</div>
		<div class="form-group">
		<h4>Email</h4>
		<input type="email" id="email_usu" name="email_usu" value="<?php echo $email_dousu ?>" placeholder="00000000000" class="form-control" required />
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
		<h4><b>NOVO PREÇO</b></h4><small>[em reais(R$) ]</small>
		<input type="text" id="preco_prop" name="preco_prop" value="" class="form-control" required readonly/>
		</div>
		<!-- fim dados de pagamento -->
		<button type="submit" id="btn-menu" name="confirmacao" class="btn btn-primary btn-lg pull-right confirmacao" disabled="disabled">Escolher modo</button>
		</form>
		<!-- fim form -->
		</div>
		<!-- col-sm-9 -->
		</div>
		<!-- fim col-md-6 dados -->
	</div>
	<!-- fim col-md-12 col-md-offset-0 -->
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
<script>
$(document).ready(function(){
// se eu mudar a data de inicio
$("#dt_inicio").change(function() {
	// coloca a data inicio como minimo na data fim
	document.getElementById("dt_fim").min = $("#dt_inicio").val();
	// libera o input date fim
	$("#dt_fim").removeAttr("disabled", "disabled");
	// veifica se esta tudo prenchido
	verifyfull();
})

$("#dt_fim").change(function() {
	// formatar para real
	function numberParaReal(numero){
	    var formatado = numero.toFixed(2).replace(".",".");
	    return formatado;
	}
	// formatar data
	function formatDate (input) {
		var datePart = input.match(/\d+/g),
		year = datePart[0], 
		month = datePart[1], 
		day = datePart[2];
		return month+'/'+day+'/'+year;
	}

	// inicio
	var data_inicio = document.getElementById("dt_inicio").value;
	// fim
	var data = document.getElementById("dt_fim").value;
	var preco_basico = document.getElementById("preco_basico").value;
	// calcula a diferença de dias entre as datas
	var date1 = new Date(formatDate(data_inicio));
	var date2 = new Date(formatDate(data));
	// pega em tempo de milisegundo e diminui entre as datas
	var timeDiff = Math.abs(date2.getTime() - date1.getTime());
	// pega o tempo em milisegundo e divide para achar os das
	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

	// pega o valor dos checked e multiplica pelos dias
	var resultado = preco_basico * diffDays;

	// enviar o valor a pagar para a variavel
	$("#preco_prop").val( numberParaReal(resultado) );
	// veifica se esta tudo prenchido
	verifyfull();
})

function verifyfull() {
	// verifica no ato de escolher modo de pagamento se os campos estao selecionados para liberar o botao
	if ( $("#nome").val().length > 0 && $("#email_usu").val().length > 0 && $("#cpf").val().length > 0 && $("#cep").val().length > 0 && $("#ddd").val().length > 0 && $("#telefone").val().length > 0 && $("#dt_inicio").val().length > 0 && $("#dt_fim").val().length > 0 ) {
		$(".confirmacao").removeAttr("disabled", "disabled");
	}else{
		$(".confirmacao").attr("disabled", "disabled");
	}
}


// ao haver mudancas nesses campos, executa o verificador 
$("#nome").change(function() {
	verifyfull();
});
$("#email_usu").change(function() {
	verifyfull();
});
$("#cpf").change(function() {
	verifyfull();
});
$("#cep").change(function() {
	verifyfull();
});
$("#ddd").change(function() {
	verifyfull();
});
$("#telefone").change(function() {
	verifyfull();
});


}); //fim document ready
</script>