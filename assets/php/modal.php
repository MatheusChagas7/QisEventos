<?php
// modal anunciar
echo '
<div class="modal fade" id="Modalanunciar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
				<h4 class="modal-title">ANUNCIAR</h4>
			</div>
			<div class="modal-body">
			<form method="post" action="assets/php/excluir_conta.php" enctype="multipart/form-data">
				<p>Ao <b>anunciar</b> você mudará seu perfil para um perfil <b>PROFISSIONAL</b>, onde poderá oferecer seus serviços, se tornar um usuário premium, adicionar seus contatos, entre outros.</p>
				<p>Para isso após <b>continuar</b>, você será redirecionado para o seu perfil, onde deverá completar o seu cadastro, adicionar sua categoria e muito mais!</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-default btn-simple"><a href="assets/php/up_lvl.php?anunciar=perfil">CONTINUAR ?</a></button>
			</div>
			</form>
		</div>
	</div>
</div>
';

// modal tabela preço anunciar
echo '
<div class="modal fade" id="Modalpreco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
				<h4 class="modal-title">PREÇOS</h4>
			</div>
			<div class="modal-body" style="overflow-y:scroll;height:auto;max-height:300px;">
			<p>O preço será o valor do campo selecionado multiplicado pelos dias em exibição.</p>
			<p><b>Inicio</b></p>
				<p>Slide principal: R$ 7,15</p>
				<p>Lateral: R$ 3,60</p>
				<p>Lateral(pequeno): R$ 1,75</p>
				<p>Slide rodapé: R$ 0,60</p>
				<p>Rodapé: R$ 1,30</p>
			<p><b>Ajuda</b></p>
				<p>Rodapé: R$ 1,30</p>
			<p><b>Anuncio</b></p>
				<p>Inicio: R$ 1,30</p>
				<p>Meio: R$ 1,30</p>
				<p>Rodapé: R$ 1,30</p>
			<p><b>Contato/sobre</b></p>
				<p>meio: R$ 1,30</p>
				<p>Rodapé: R$ 1,30</p>
			<p><b>Perfil</b></p>
				<p>Rodapé: R$ 1,30</p>
			<p><b>Premium</b></p>
				<p>Rodapé: R$ 1,30</p>

			<h5>Exemplo:</h5>
			<b>1</b> slide principal na página inicio = R$ 7,15
			por 10 dias em exibição.
			Valor final = R$ 71,5
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
';
?>