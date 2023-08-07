<?php 
//conexao c/banco
include_once 'assets/php/conexao.php';

// dia
$hoje = date("d") . "/" . date("m") . "/" . date("Y");

//numero de USUARIOS total
$get_1 = mysqli_query($con,"SELECT id_usu FROM usuario");
$qtd_1 = mysqli_num_rows($get_1);

//numero de COMUNS
$get_5 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE nivel = 2 OR nivel = 4 ");
$qtd_5 = mysqli_num_rows($get_5);

//numero de CLIENTES
$get_2 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE nivel = 3 OR nivel = 5 ");
$qtd_2 = mysqli_num_rows($get_2);

//numero de ANUNCIANTES
$get_6 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE nivel = 4 OR nivel = 5 ");
$qtd_6 = mysqli_num_rows($get_6);

// -------------------------------------------------------

//numero de COMUNS com pacote básico
$get_9 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE nivel = '2' AND pacote_usu = '0' ");
$qtd_9 = mysqli_num_rows($get_9);

//numero de COMUNS com pacote premium
$get_10 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE nivel = '2' AND pacote_usu = '1' ");
$qtd_10 = mysqli_num_rows($get_10);

//numero de COMUNS com pacote master
$get_11 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE nivel = '2' AND pacote_usu = '2' ");
$qtd_11 = mysqli_num_rows($get_11);

// --------------------------------------------------------

//numero de CLIENTES com pacote básico
$get_12 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE (nivel = '3' OR nivel = '5') AND pacote_usu = '0' ");
$qtd_12 = mysqli_num_rows($get_12);

//numero de CLIENTES com pacote premium
$get_13 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE (nivel = '3' OR nivel = '5') AND pacote_usu = '1' ");
$qtd_13 = mysqli_num_rows($get_13);

//numero de CLIENTES com pacote master
$get_14 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE (nivel = '3' OR nivel = '5') AND pacote_usu = '2' ");
$qtd_14 = mysqli_num_rows($get_14);

// --------------------------------------------------------

//numero de ANUNCIANTES com pacote básico
$get_15 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE (nivel = '4' OR nivel = '5') AND pacote_usu = '0' ");
$qtd_15 = mysqli_num_rows($get_15);

//numero de ANUNCIANTES com pacote premium
$get_16 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE (nivel = '4' OR nivel = '5') AND pacote_usu = '1' ");
$qtd_16 = mysqli_num_rows($get_16);

//numero de ANUNCIANTES com pacote master
$get_17 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE (nivel = '4' OR nivel = '5') AND pacote_usu = '2' ");
$qtd_17 = mysqli_num_rows($get_17);


//numero de usuarios por migracao FACEBOOK
$get_20 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE migracao = 'face' ");
$qtd_20 = mysqli_num_rows($get_20);

//numero de usuarios por migracao TWITTER
$get_21 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE migracao = 'twit' ");
$qtd_21 = mysqli_num_rows($get_21);

//numero de usuarios por migracao GOOGLE
$get_22 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE migracao = 'gplu' ");
$qtd_22 = mysqli_num_rows($get_22);

//numero de usuarios por migracao QISeventos
$get_23 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE migracao = 'qis' ");
$qtd_23 = mysqli_num_rows($get_23);

//numero de propagandas no SLIDE PRINCIPAL
$get_24 = mysqli_query($con,"SELECT id_propaganda FROM propaganda WHERE imagem_propaganda1 <> '' AND ativo = 1 ");
$qtd_24 = mysqli_num_rows($get_24);

//numero de propagandas no LATERAL 1
$get_25 = mysqli_query($con,"SELECT id_propaganda FROM propaganda WHERE imagem_propaganda2 <> '' AND localizacao2 like '%in_lat1%' AND ativo = 1 ");
$qtd_25 = mysqli_num_rows($get_25);

//numero de propagandas no LATERAL 2
$get_26 = mysqli_query($con,"SELECT id_propaganda FROM propaganda WHERE imagem_propaganda2 <> '' AND localizacao2 like '%in_lat2%' AND ativo = 1 ");
$qtd_26 = mysqli_num_rows($get_26);

//numero de propagandas no LATERAL 3
$get_27 = mysqli_query($con,"SELECT id_propaganda FROM propaganda WHERE imagem_propaganda3 <> '' AND ativo = 1 ");
$qtd_27 = mysqli_num_rows($get_27);

//numero de propagandas no SLIDE RODAPE
$get_28 = mysqli_query($con,"SELECT id_propaganda FROM propaganda WHERE imagem_propaganda4 <> '' AND ativo = 1 ");
$qtd_28 = mysqli_num_rows($get_28);

//numero de propagandas no RODAPE
$get_29 = mysqli_query($con,"SELECT id_propaganda FROM propaganda WHERE imagem_propaganda5 <> '' AND ativo = 1 ");
$qtd_29 = mysqli_num_rows($get_29);

//numero de PROPAGANDAS EXISTENTES
$get_30 = mysqli_query($con,"SELECT id_propaganda FROM propaganda WHERE ativo = 1 ");
$qtd_30 = mysqli_num_rows($get_30);

//numero do PRECO DE TODAS AS PROPAGANDAS JUNTAS
$get_31 = mysqli_query($con,"SELECT SUM(preco) AS total FROM propaganda WHERE ativo = 1 ");
$linha_31 = mysqli_fetch_assoc($get_31);
$valor_tp = $linha_31['total'];

// ---------------------------------------------------------

//o numero de usuarios com pacote basico multiplicado pelo valor do pacote, mensal
    $valor_b = "GRÁTIS";

//numero total de pacotes premium
$get_18 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE pacote_usu = '1' ");
$qtd_18 = mysqli_num_rows($get_18);
    //o numero de usuarios com pacote master multiplicado pelo valor do pacote, mensal
    $valor_p = $qtd_18 * 1.00;

//numero total de pacotes master
$get_19 = mysqli_query($con,"SELECT id_usu FROM usuario WHERE pacote_usu = '2' ");
$qtd_19 = mysqli_num_rows($get_19);
    //o numero de usuarios com pacote master multiplicado pelo valor do pacote, mensal
    $valor_m = $qtd_19 * 3.00;

// ---------------------------------------------------------

?>
<!doctype html>
<html lang="pt-br">
<head>
    <title>QISeventos - Relatório</title>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="theme-color" content="#4B4B4D"/>
    <meta property="og:locale" content="pt_BR">
    <meta property="og:url" content="http://www.qiseventos.com.br/politica-privacidade.html">
    <meta property="og:title" content="QISeventos">
    <meta property="og:site_name" content="QISeventos">
    <meta property="og:description" content="Politica e Privacidade - QISeventos">
    <meta property="og:image" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
    <meta property="og:image:secure_url" content="https://www.qiseventos.com.br/assets/img/icon_share.jpg">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="200"> <!-- pixel -->
    <meta property="og:image:height" content="200"> <!-- pixel -->
    <meta name="description" content="Politica e Privacidade - QISeventos">
    <!-- /** CASO SEJA UM SITE NORMAL **/ -->
    <meta property="og:type" content="website">
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
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/sass/material-kit/_example-pages.scss" rel="stylesheet" type="text/html" />
    <!-- estilo interno -->
    <style type="text/css">
    #capa-index{
    background-image: url('assets/img/img-login.jpg');
    }
    p{
    font-size: 16px!important;
    }
    .registro{
    margin: 5px;
    padding: 5px;
    }
    .registro tr, .registro th, .registro td, .registro table{
    border: 2px solid black;
    padding: 5px;
    }
    </style>
</head>
<body class="politica-page" onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;">
    <div class="wrapper">
    <div class="header header-filter" id="capa-index">
    </div>
    <div class="main main-raised">
    <div class="container">
    <div class="section text-center section-landing">

<h3 class="text-center">Relátorios do QISeventos</h3>

<label id="bloq">
<p>Quem sou ?</p>
<input type="text" name="resp" id="resp" value="" required>
<button type="button" class="search-but btn btn-primary btn-lg" id="btn-menu" onclick="verific()">Enviar</button>
</label>

<div id="tudo" style="display: none;">
<div class="col-md-12 col-md-offset-0">
    <div class="registro" id="registro_usu">
        <table id="registro_usutb">
            <!-- TR dos detalhes -->
            <tr>
                <td>---</td>
                <td>---</td>
                <td>data</td>
                <td><?php echo $hoje ?></td>
                <td>---</td>
            </tr>           
            <!-- TR dos detalhes -->
            <tr>
                <td>---</td>
                <td>---</td>
                <td>tabela</td>
                <td>usuarios/pacote</td>
                <td>---</td>
            </tr>
            <tr>
                <th><!-- espaço vazio --></th>
                <th>USUÁRIOS</th>
                <th>BÁSICO(pacote)</th>
                <th>PREMIUM(pacote)</th>
                <th>MASTER(pacote)</th>
            </tr>
            <tr>
                <!-- usuario -->
                <td>Comum</td>
                <td><?php if(!empty($qtd_5)){echo $qtd_5;}else{echo "0";} ?></td>
                <!-- pacote -->
                <td><?php if(!empty($qtd_9)){echo $qtd_9;}else{echo "0";} ?></td>
                <td><?php if(!empty($qtd_10)){echo $qtd_10;}else{echo "0";} ?></td>
                <td><?php if(!empty($qtd_11)){echo $qtd_11;}else{echo "0";} ?></td>
            </tr>
            <tr>
                <!-- usuario -->
                <td>Cliente</td>
                <td><?php if(!empty($qtd_2)){echo $qtd_2;}else{echo "0";} ?></td>
                <!-- pacote -->
                <td><?php if(!empty($qtd_12)){echo $qtd_12;}else{echo "0";} ?></td>
                <td><?php if(!empty($qtd_13)){echo $qtd_13;}else{echo "0";} ?></td>
                <td><?php if(!empty($qtd_14)){echo $qtd_14;}else{echo "0";} ?></td>
            </tr>
            <tr>
                <!-- usuario -->
                <td>Anunciante</td>
                <td><?php if(!empty($qtd_6)){echo $qtd_6;}else{echo "0";} ?></td>
                <!-- pacote -->
                <td><?php if(!empty($qtd_15)){echo $qtd_15;}else{echo "0";} ?></td>
                <td><?php if(!empty($qtd_16)){echo $qtd_17;}else{echo "0";} ?></td>
                <td><?php if(!empty($qtd_17)){echo $qtd_17;}else{echo "0";} ?></td>
            </tr>
            <!-- total -->
            <tr>
                <td><b>TOTAL</b></td>
                <td><b><?php if(!empty($qtd_1) ){echo $qtd_1;}else{echo "0";} ?></b></td>
                <!-- pacote -->
                <td><b>R$&nbsp;<?php if(!empty($valor_b)){echo $valor_b;}else{echo "0";} ?></b></td>
                <td><b>R$&nbsp;<?php if(!empty($valor_p)){echo $valor_p;}else{echo "0";} ?></b></td>
                <td><b>R$&nbsp;<?php if(!empty($valor_m)){echo $valor_m;}else{echo "0";} ?></b></td>
            </tr>
            <!-- TR dos detalhes -->
            <tr>
                <td>---</td>
                <td>---</td>
                <td>tabela</td>
                <td>usuario/migração</td>
                <td>---</td>
            </tr>
            <tr>
                <th><!-- espaço vazio --></th>
                <th>USUÁRIOS</th>
            </tr>
            <tr>
                <td>Facebook</td>
                <td><?php if(!empty($qtd_20) ){echo $qtd_20;}else{echo "0";} ?></td>
            </tr>
            <tr>
                <td>Twitter</td>
                <td><?php if(!empty($qtd_21) ){echo $qtd_21;}else{echo "0";} ?></td>
            </tr>
            <tr>
                <td>Google</td>
                <td><?php if(!empty($qtd_22) ){echo $qtd_22;}else{echo "0";} ?></td>
            </tr>
            <tr>
                <td>QISeventos</td>
                <td><?php if(!empty($qtd_23) ){echo $qtd_23;}else{echo "0";} ?></td>
            </tr>
            <tr>
                <td><b>TOTAL</b></td>
                <td><b><?php if(!empty($qtd_1) ){echo $qtd_1;}else{echo "0";} ?></b></td>
            </tr>
            <!-- TR dos detalhes -->
            <tr>
                <td>---</td>
                <td>---</td>
                <td>tabela</td>
                <td>anuncios</td>
            </tr>
            <tr>
                <th><!-- espaço vazio --></th>
                <th>PROPAGANDAS</th>
                <th>VALORES</th>
                <th>TOTAL R$ GANHO</th>
            </tr>
            <tr>
                <td>Slide principal</td>
                <td><?php if(!empty($qtd_24) ){echo $qtd_24;}else{echo "0";} ?></td>
                <td>R$ 7,15</td>
                <td>---</td>
            </tr>
            <tr>
                <td>Lateral (1)</td>
                <td><?php if(!empty($qtd_25) ){echo $qtd_25;}else{echo "0";} ?></td>
                <td>R$ 3,60</td>
                <td>---</td>
            </tr>
            <tr>
                <td>Lateral (2)</td>
                <td><?php if(!empty($qtd_26) ){echo $qtd_26;}else{echo "0";} ?></td>
                <td>R$ 3,60</td>
                <td>---</td>
            </tr>
            <tr>
                <td>Lateral (3)</td>
                <td><?php if(!empty($qtd_27) ){echo $qtd_27;}else{echo "0";} ?></td>
                <td>R$ 1,75</td>
                <td>---</td>
            </tr>
            <tr>
                <td>Slide Rodapé</td>
                <td><?php if(!empty($qtd_28) ){echo $qtd_28;}else{echo "0";} ?></td>
                <td>R$ 0,60</td>
                <td>---</td>
            </tr>
            <tr>
                <td>Rodapé</td>
                <td><?php if(!empty($qtd_29) ){echo $qtd_29;}else{echo "0";} ?></td>
                <td>R$ 1,30</td>
                <td>---</td>
            </tr>
            <tr>
                <td><b>TOTAL</b></td>
                <td><b><?php if(!empty($qtd_30) ){echo $qtd_30;}else{echo "0";} ?></b></td>
                <td>---</td>
                <td><b>R$ <?php if(!empty($valor_tp) ){echo $valor_tp;}else{echo "0.00";} ?></b></td>
            </tr>
        </table>
    </div>

<button id="btn_usu" class="search-but btn btn-primary btn-lg">Exportar Tabela para Excel</button>

</div>
<!-- fim col-md-12 col-md-offset-0 -->
</div>
<!-- fim div tudo -->

    </div>
    <!-- fim section -->
    </div>
    <!-- fim container -->
    </div>
    <!-- fim main -->
</div>
<!-- fim wrapper -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.0.min.js" type="text/javascript"></script>
    <!-- jQuery 3.1.1 -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>   
    <!-- bookmark_bubble -->
    <script type="text/javascript" src="assets/js/bookmark_bubble.min.js"></script>     
    <!--   Core JS Files   -->
    <!-- <script src="assets/js/jquery.min.js" type="text/javascript"></script> -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/material.min.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="assets/js/nouislider.min.js" type="text/javascript" async></script>
    <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
    <script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
    <script src="assets/js/material-kit.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/jquery.table2excel.js"></script>
    <!-- script para exportar -->
    <script>

        $(document).ready(function(){

        $(document).keydown(function(e){
        var tecla=window.event.keyCode;
        if (tecla==123){
        event.returnValue=false;}
        var ctrl=window.event.ctrlKey; 
        if(ctrl && e.which == 85){
        return false;
        }
        });

        });

        function verific() {
            var resp = document.getElementById('resp').value;

            if (resp === "JOREL") {
                document.getElementById('tudo').style.display = "-webkit-inline-box";
                document.getElementById('bloq').style.display = "none";
            }else{
                alert("senha incorreta, otarriô");
            }
        }


        $(function () {
        $("#btn_usu").click(function () {
            $("#registro_usutb").table2excel();
        });
        });
    </script>