<?php
header( 'Content-Type: text/html; charset=utf8' );
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.iso-8859-1', 'portuguese' );
include_once 'conexao.php';

include_once 'cache.php';

	if (isset($_POST['getData'])) {
		$conn = new mysqli("localhost","ilion548_qis","j0L8sI73pj","ilion548_qiseventos");

		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);

		$sql = $conn->query("SELECT * FROM notificacao WHERE id_usu_noti = '$id_log' ORDER BY id_noti DESC LIMIT $limit OFFSET $start ");
		$i_noti = $_POST['start'];
		if ($sql->num_rows > 0) {
			$response = "";

			while($data = $sql->fetch_array()) {
        $id_noti = $data['id_noti'];
        $msg_noti = utf8_encode($data['msg_noti']);
        $data_noti_vem = $data['data_noti'];
        $data_noti = date_create($data_noti_vem)->format('M d Y h:i A');
        $data_noti = utf8_encode(strftime('%a, %d de %b de %Y as %H:%M', strtotime($data_noti_vem)));
        $visu_noti = $data['visu_noti'];
        if($visu_noti == 0){
        	$style_visu = 'background-color:#f0e2e2;';
    	}else{
    		$style_visu = 'background-color:#fff;';
    	}
		if($visu_noti == 0){
			$btn_ler = '<button class="btn btn-primary btn-simple btn-fav" style="display:table-cell;color:#4b4b4b;padding-right:2px;padding-left:0;margin-left:77%;" onclick="visuNoti('.$i_noti.','.$id_noti.','.$id_log.')" rel="tooltip" title="Marcar como lido" data-html="true" data-placement="top">
		    <i id="ni-'.$i_noti.'" class="material-icons favorito" style="color:blue;">remove_red_eye</i> <!-- nao viu -->
		    </button>';
		}else{
		    $btn_ler = '<button class="btn btn-primary btn-simple btn-fav" style="display:table-cell;color:#4b4b4b;padding-right:2px;padding-left:0;margin-left:77%;" rel="tooltip" title="lido" data-html="true" data-placement="top">
		    <i id="ni-'.$i_noti.'" class="material-icons favorito" style="color:#ccc;">remove_red_eye</i> <!-- ja viu -->
		    </button>';
		}
        $id_cli_noti = $data['id_cli_noti'];
        $id_usu_noti = $data['id_usu_noti'];

	      $query_fp_noti_cli = mysqli_query($con,"SELECT nome_completo,foto_perfil FROM usuario WHERE id_usu = '$id_cli_noti' ");
	      $con_fp_noti_cli = mysqli_fetch_assoc($query_fp_noti_cli);
			$fp_noti_cli = $con_fp_noti_cli['foto_perfil'];
			if($id_cli_noti == 0){
				$fp_noti_cli = 'assets/img/favicon.png';
			}else if(!empty($fp_noti_cli)){
				$fp_noti_cli;
			}else if(empty($fp_noti_cli)){
				$fp_noti_cli = 'assets/img/accountp.jpg';
			}
			$nome_noti_cli = utf8_encode($con_fp_noti_cli['nome_completo']);

				$response .='
<div id="mb-'.$i_noti.'"style="'.$style_visu.'padding:4px 0 4px 0;">
        <p class="pull-right" style="margin: -2px 7px -8px 0px"><small>'.$data_noti.'</small></p>
          <div class="logo-container" style="width:100%;overflow-x:hidden;">
          <div class="logo" style="display: inline; width: 40px!important;">
                 <a href="#"><img src="'.$fp_noti_cli.'"></a>
                </div>
              <div class="icp-desc" style="padding:10px 0 0 5px;white-space:normal!important;width:75%;float:left;margin-bottom: 15px;">
              <p><strong>'.$nome_noti_cli.'</strong> '. $msg_noti.'</p>
              </div>
              </div>
              <button class="btn btn-primary btn-simple btn-fav" style="display:table-cell;color:#4b4b4b;padding-right:1px;padding-left:10px;" onclick="exNoti('.$i_noti.','.$id_noti.','.$id_log.')" rel="tooltip" title="Excluir" data-html="true" data-placement="top">
              <i class="material-icons favorito">close</i>
              </button>
			'.$btn_ler.'            
            </div>
';
				// $response .= '
				// 	<div>
				// 		<h2>'.$data['id_noti'].'</h2>
				// 		<p>'.$data['msg_noti'].'</p>
				// 	</div>
				// ';

$i_noti++;
			}
			exit($response);
		} else
			exit('reachedMax');
	}
?>