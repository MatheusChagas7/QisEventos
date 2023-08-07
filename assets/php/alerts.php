<?php
	if ($error == "sim" && $motivo == "errodatabase") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Erro no banco de dados, tente novamente mais tarde.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "senhanaoconfere") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	A senha nova nao corresponde com a redigitada. Tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "erroupdate") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Erro ao salvar. Tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "errobuscasenha") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Erro ao buscar senha. Tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "senhaerrada") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Senha atual errada. Tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "erroupdateepassword") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Erro ao salvar e atualizar nova senha. Tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "canalyt") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Canal inválido, por favor altere o canal adicionado e tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "playlistyt") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Playlist adicionada inválida, por favor mude a playlist e tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "exsenhaerrada") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	A senha digitada está errada, digita a sua senha atual e tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}else if ($error == "sim" && $motivo == "emailerrado") {
    echo "
	<div style='z-index:9999;display:block;width:420px;position:absolute;margin-left:-210px;left:50%;' class='alert alert-info' id='info_rate'>
	<div class='container-fluid'>
	<div class='alert-icon'>
	<i class='material-icons'>error_outline</i>
	</div>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	<span aria-hidden='true'><i class='material-icons'>clear</i></span>
	</button>
	Email digitado não corresponde com o email cadastrado. Altere ou tente novamente, caso persista, entre em contato com o suporte.
	</div>
	</div>";
	}
?>