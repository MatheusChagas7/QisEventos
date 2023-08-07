<?php

// pega a categoria, e a sub e busca o id
if (!empty($categoria) && !empty($sub_categoria)){
	$b_cat = mysqli_query($con,"SELECT id_categoria FROM categoria WHERE nome_categoria = '".$categoria."' AND nome_sub_categoria = '".$sub_categoria."' ");
	$id_cat = mysqli_fetch_array($b_cat);
	$cat = $id_cat['id_categoria'];
}

switch (true) {
	//se existir parametro E o id da categoria existir E existir nome de categoria
	case ( (!empty($parametro) && ( !empty($cat) && !empty($categoria) ) ) ) :
	// se cidade e estado for todos
	if($cidade == "all" && $estado == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		  	( (nivel = '3' OR nivel = '5') AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) AND 
		  	( (nivel = '3' OR nivel = '5') AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  	AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";
	// se buscar por um estado mas todoas as cidades
	}else if($cidade == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		  	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) AND 
		  	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  	AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";		  
	// se for uma cidade E estado
	}else{
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		  	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) AND 
		  	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  	AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";
	}
		break;
	//se existir parametro E o id da categoria existir OU existir nome de categoria
	case ( (!empty($parametro) && ( !empty($cat) || !empty($categoria) ) ) ) :
	// se cidade e estado for todos
	if($cidade == "all" && $estado == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		  	( (nivel = '3' OR nivel = '5') (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) OR 
		  	( (nivel = '3' OR nivel = '5') (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  	AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";
	// se buscar por um estado mas todoas as cidades
	}else if($cidade == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		  	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) OR 
		  	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  	AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";
	// se for uma cidade E estado
	}else{
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		  	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) OR 
		  	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  	AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";
	}
		break;
	//se parametro for vazio E o id da categoria existir E existir nome de categoria
	case ( (empty($parametro) && ( !empty($cat) && !empty($categoria) ) ) ) :
	// se cidade e estado for todos
	if($cidade == "all" && $estado == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		 	( (nivel = '3' OR nivel = '5') AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) AND 
		 	( (nivel = '3' OR nivel = '5') AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  )
		  $ordenar";
	// se buscar por um estado mas todoas as cidades
	}else if($cidade == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		 	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) AND 
		 	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  )
		  $ordenar";
	// se for uma cidade E estado
	}else{
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		 	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) AND 
		 	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  )
		  $ordenar";
	}	
		break;
	//se parametro for vazio E o id da categoria existir OU existir nome de categoria
	case ( (empty($parametro) && ( !empty($cat) || !empty($categoria) ) ) ) :
	// se cidade e estado for todos
	if($cidade == "all" && $estado == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		 	( (nivel = '3' OR nivel = '5') AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) OR 
		 	( (nivel = '3' OR nivel = '5') AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  )
		  $ordenar";
	// se buscar por um estado mas todoas as cidades
	}else if($cidade == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		 	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) OR 
		 	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  )
		  $ordenar";
	// se for uma cidade E estado
	}else{
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE
		  (
		 	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' OR nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' OR nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' OR nome_categoria_3 = '".$categoria."')) OR 
		 	( (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (fk_categoria1_usu = '".$cat."' AND nome_categoria_1 = '".$categoria."' OR fk_categoria2_usu = '".$cat."' AND nome_categoria_2 = '".$categoria."' OR fk_categoria3_usu = '".$cat."' AND nome_categoria_3 = '".$categoria."'))
		  )
		  $ordenar";
	}	
		break;
	//se existir o parametro E o id da categoria for vazio OU o nome da categoria for vazio
	case ( (!empty($parametro) && ( empty($cat) || empty($categoria) ) ) ):
	// se cidade e estado for todos
	if($cidade == "all" && $estado == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE 
		  (
		  	(nivel = '3' OR nivel = '5') AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";
	// se buscar por um estado mas todoas as cidades
	}else if($cidade == "all"){
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE 
		  (
		  	(nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' ) AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";
	// se for uma cidade E estado
	}else{
		$get = "SELECT 
		id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona
		 FROM usuario
		  WHERE 
		  (
		  	(nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' ) AND (nome_completo LIKE '%".$parametro."%' OR descricao LIKE '%".$parametro."%' OR sobre_usu LIKE '%".$parametro."%')
		  )
		  $ordenar";
	}
		break;
	//padrao, assim que inicia a pagina vai executar esta query
	default:
	// se cidade e estado for todos
	if($cidade == "all" && $estado == "all"){
		$get = "SELECT id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona 
		FROM usuario 
		WHERE 
		(
		 (nivel = '3' OR nivel = '5')
		)
		$ordenar";
	// se buscar por um estado mas todoas as cidades
	}else if($cidade == "all"){
		$get = "SELECT id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona 
		FROM usuario 
		WHERE 
		(
		 (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) OR ( cidade = '".$cidade."' OR cidade = 'all' )
		)
		$ordenar";
	// se for uma cidade E estado
	}else{
		$get = "SELECT id_usu,nome_completo,fk_categoria1_usu,fk_categoria2_usu,fk_categoria3_usu,pacote_usu,foto_perfil,descricao,rating,url_persona 
		FROM usuario 
		WHERE 
		(
		 (nivel = '3' OR nivel = '5') AND ( estado = '".$estado."' OR estado = 'all' ) AND ( cidade = '".$cidade."' OR cidade = 'all' )
		)
		$ordenar";
	}
	break;
}

?>