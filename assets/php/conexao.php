<?php
//fara a conexao com banco de dados
include_once 'conexao_bdserver.php';

if(!$con){
	header('location:../../error.php');
}

?>