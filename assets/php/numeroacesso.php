<?php
//chama a cache, para verificar o cache se esta logado
include_once 'assets/php/cache.php';
// busca o id do anunciante pela sua url
$query_getid = mysqli_query($con, "SELECT id_usu FROM usuario WHERE url_persona='$url'");
$row_id = mysqli_fetch_assoc($query_getid);
$id_url = $row_id['id_usu'];
if ( empty($id_log) || $id_log !== $id_url ) {
	//Executa o SQL
	$queryacess = mysqli_query($con, "UPDATE usuario SET n_acesso = n_acesso + 1 WHERE url_persona='$url'");
	// mysqli_query($con, $queryacess);
}