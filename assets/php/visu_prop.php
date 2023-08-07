<?php 
//fara a conexao com banco de dados
include_once 'assets/php/conexao.php';

// visualizacao
function visualiza_prop($local,$id, mysqli $con){
	// pega o id do usuario pelo id da propaganda
	$query_get = mysqli_query($con, " SELECT fk_propaganda_usu FROM propaganda WHERE id_propaganda = $id ");
	$row_qg = mysqli_fetch_assoc($query_get);
	$id_anunciante = $row_qg['fk_propaganda_usu'];

	// atualiza o numero de visualizacao da propaganda
	$up_visu = mysqli_query($con, " INSERT INTO contador (id_cont,fk_cont_usu,fk_cont_prop,local,qtd_clique,qtd_visu) VALUES ('','$id_anunciante','$id','$local','','1') ");

}
?>