<?php 
//fara a conexao com banco de dados
include_once 'conexao_bdserver.php';

// clique
$id_prop = $_GET['id_prop']; //pega o id via get ao clicar na propaganda na pagina
$local = $_GET['local']; //pega o local via get ao clicar na propaganda na pagina

// pega o id e a url do usuario pelo id da propaganda
$query_get = mysqli_query($con, " SELECT fk_propaganda_usu,url_redi FROM propaganda WHERE id_propaganda = $id_prop ");
$row_qg = mysqli_fetch_assoc($query_get);
$id_anunciante = $row_qg['fk_propaganda_usu'];
$redireciona_bd = $row_qg['url_redi'];
// inverte o redireciona_bd
$redireciona_in = strrev($redireciona_bd);

// inseri o contador de cliques
$up_click = mysqli_query($con, " INSERT INTO contador (id_cont,fk_cont_usu,fk_cont_prop,local,qtd_clique,qtd_visu) VALUES ('','$id_anunciante','$id_prop','$local','1','') ");


// verifica se o link de redirecionar e um link valido
if( substr($redireciona_in ,0,strrpos($redireciona_in,'//')) ){
	// se sim, inverte e vai
	$redireciona = strrev($redireciona_in);
}else{
	// se nao, coloca o http + o link e vai
	$redireciona = "http://" . strrev($redireciona_in);
}
//redireciona para a ulr do usuario
header("Location:" . $redireciona);
?>