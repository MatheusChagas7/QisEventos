<?php
	//fara a conexao com banco de dados
	include_once 'conexao.php';

	//chama a cache, para verificar o cache se esta logado
	include_once 'cache.php';

	$query_n = "SELECT COUNT(*) AS total FROM notificacao WHERE visu_noti='0' AND id_usu_noti = '$id_log' ";
	$result_n = mysqli_query($con,$query_n);
	$count = mysqli_fetch_assoc($result_n);

	if($count['total'] == "0") {
	
	}else{
	echo $count['total'];
	}
		
?>