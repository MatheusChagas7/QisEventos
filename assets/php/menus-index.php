<?php 
/* 
* ESSE MENU É SOMENTO DO INDEX
* mudança de menu conforme o seu nivel de usuario
* lvl 1 - usuario nao conectado - visitado
* lvl 2 - usuario
* lvl 3 - usuario cliente
* lvl 4 - usuario anunciante e comum
* lvl 5 - usuario anunciante e cliente
*/
switch ($lvl) {

case $lvl == 2:
	echo "
	    	<ul class='nav navbar-nav navbar-right'>
	    	<li>
			    <!-- notificação -->
				<a href='#' class='navbar-toggle-n n-notification-a' data-toggle='modal' data-target='#Modalnoti' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
					<span id='n-notification2' class='n-notification'></span>
					<i class='material-icons' style='color: #fff;'>notifications</i>
				</a>
	    	</li>
				<li>
				<a id='btn-menu' href='#' class='btn btn-primary btn-lg' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				<i class='material-icons'>search</i>&nbsp;BUSCAR
    			</a>
				</li>
				<li>
					<a href='index.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>home</i> Início
					</a>
				</li>
				<li>
					<a href='anunciar.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>add_to_queue</i> Propaganda
					</a>
				</li>
				<li>
					<a href='ajuda.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>help_outline</i> Ajuda
					</a>
				</li>
				<li>
					<a href='premium.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>grade</i> premium
					</a>
				</li>
				<li>
					<a href='contato-sobrenos.php#us' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;''>
						<i class='material-icons'>chat_bubble</i> Contato
					</a>
				</li>
				<li>
				<a href='#' data-toggle='modal' data-target='#Modalanunciar' data-html='true' class='btn btn-primary btn-lg' id='btn-menu' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				ANUNCIAR
    			</a>
				</li>
				<li>
					<a href='assets/php/logout.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>exit_to_app</i> sair
					</a>
				</li>
	    	</ul>
	        		";
break;
case $lvl == 3:
	echo "
	    	<ul class='nav navbar-nav navbar-right'>
	    	<li>
			    <!-- notificação -->
				<a href='#' class='navbar-toggle-n n-notification-a' data-toggle='modal' data-target='#Modalnoti' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
					<span id='n-notification2' class='n-notification'></span>
					<i class='material-icons' style='color: #fff;'>notifications</i>
				</a>
	    	</li>
				<li>
				<a id='btn-menu' href='#' class='btn btn-primary btn-lg' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				<i class='material-icons'>search</i>&nbsp;BUSCAR
    			</a>
				</li>
				<li>
					<a href='index.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>home</i> Início
					</a>
				</li>
				<li>
					<a href='anunciar.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>add_to_queue</i> Propaganda
					</a>
				</li>
				<li>
					<a href='ajuda.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>help_outline</i> Ajuda
					</a>
				</li>
				<li>
					<a href='premium.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>grade</i> premium
					</a>
				</li>
				<li>
					<a href='contato-sobrenos.php#us' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;''>
						<i class='material-icons'>chat_bubble</i> Contato
					</a>
				</li>
				<li>
					<a href='assets/php/logout.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>exit_to_app</i> sair
					</a>
				</li>
	    	</ul>
	        		";
break;
case $lvl == 4:
	echo "
	    	<ul class='nav navbar-nav navbar-right'>
	    	<li>
			    <!-- notificação -->
				<a href='#' class='navbar-toggle-n n-notification-a' data-toggle='modal' data-target='#Modalnoti' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
					<span id='n-notification2' class='n-notification'></span>
					<i class='material-icons' style='color: #fff;'>notifications</i>
				</a>
	    	</li>
				<li>
				<a id='btn-menu' href='#' class='btn btn-primary btn-lg' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				<i class='material-icons'>search</i>&nbsp;BUSCAR
    			</a>
				</li>
				<li>
					<a href='index.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>home</i> Início
					</a>
				</li>
				<li>
					<a href='estatistica.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>donut_small</i> Estatística
					</a>
				</li>
				<li>
				<a href='#' data-toggle='modal' data-target='#Modalanunciar' data-html='true' class='btn btn-primary btn-lg' id='btn-menu' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				ANUNCIAR
    			</a>
				</li>
				<li>
					<a href='ajuda.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>help_outline</i> Ajuda
					</a>
				</li>
				<li>
				<a href='anunciar.php' class='btn btn-primary btn-lg' id='btn-menu' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				Propaganda
    			</a>
				</li>
				<li>
					<a href='assets/php/logout.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>exit_to_app</i> sair
					</a>
				</li>
	    	</ul>
	        		";
break;
case $lvl == 5 :
	echo "
	    	<ul class='nav navbar-nav navbar-right'>
	    	<li>
			    <!-- notificação -->
				<a href='#' class='navbar-toggle-n n-notification-a' data-toggle='modal' data-target='#Modalnoti' rel='tooltip' title='Você receberá suas <b>notificações</b> por aqui' data-html='true' data-placement='bottom'>
					<span id='n-notification2' class='n-notification'></span>
					<i class='material-icons' style='color: #fff;'>notifications</i>
				</a>
	    	</li>
				<li>
				<a id='btn-menu' href='#' class='btn btn-primary btn-lg' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				<i class='material-icons'>search</i>&nbsp;BUSCAR
    			</a>
				</li>
				<li>
					<a href='index.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>home</i> Início
					</a>
				</li>
				<li>
					<a href='estatistica.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>donut_small</i> Estatística
					</a>
				</li>
				<li>
					<a href='ajuda.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>help_outline</i> Ajuda
					</a>
				</li>
				<li>
				<a href='anunciar.php' class='btn btn-primary btn-lg' id='btn-menu' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				Propaganda
    			</a>
				</li>
				<li>
					<a href='premium.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>grade</i> premium
					</a>
				</li>
				<li>
					<a href='assets/php/logout.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>exit_to_app</i> sair
					</a>
				</li>
	    	</ul>
	        		";
break;
//default sera o lvl 1, quando nao existe usuario conectado 
default:
	echo "
	    	<ul class='nav navbar-nav navbar-right'>
				<li>
				<a id='btn-menu' href='#' class='btn btn-primary btn-lg' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;''>
    				<i class='material-icons'>search</i>&nbsp;BUSCAR
    			</a>
				</li>
				<li>
					<a href='index.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;''>
						<i class='material-icons'>home</i> Início
					</a>
				</li>
				<li>
					<a href='ajuda.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;''>
						<i class='material-icons'>help_outline</i> Ajuda
					</a>
				</li>
				<li>
					<a href='anunciar.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>add_to_queue</i> Propaganda
					</a>
				</li>
				<li>
					<a href='contato-sobrenos.php#us' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>chat_bubble</i> Contato
					</a>
				</li>
				<li>
					<a href='contato-sobrenos.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
						<i class='material-icons'>info_outline</i> Sobre
					</a>
				</li>
				<li>
					<a href='login.php' class='btn btn-white btn-simple' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;''>
						<i class='material-icons'>fingerprint</i> Login
					</a>
				</li>
				<li>
				<a href='cadastro.php' class='btn btn-primary btn-lg' id='btn-menu' style='margin-right: 0px; margin-left: 0px; padding-left: 15px; padding-right: 15px;'>
    				ANUNCIAR
    			</a>
				</li>
	    	</ul>
	        		";
break;

}
?>