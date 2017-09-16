<section id="bloco-esquerda">
			<div class="logo-feintec">
				<img class="img-logo" src="<?php echo base_url();?>public/feintec/imagem/feintec.png">
			</div>
			<aside id="menu" class="linha">
				<div class="opcao">
						<ul id="lista-menu">
							<?php 
							if(isset($user_data['permissoes'])){
								if(in_array("feintec",$user_data['permissoes'])){?>
								<li>Aluno <span class="	glyphicon glyphicon-user"></span></li>
								<li>Projetos <span class="	glyphicon glyphicon-user"></span></li>
								<li>Edições <span class="glyphicon glyphicon-menu-hamburger"></span></li>
								<li>Paineis <span class="glyphicon glyphicon-list-alt"></span></li>
								<li>Eixo <span class="glyphicon glyphicon-tag"></span></li>
								<?php }else{?>
								<li><a href="#" ng-click="incricoes()">Inscrições <span class="glyphicon glyphicon-pencil"></span></a></li>
								<?php }
								}else{
									?>
									<li><a href="#" data-content="configuracoes">Configurações <span class="glyphicon glyphicon-cog"></span></a></li>
									<li><a href="#" data-content="inscricao">Inscrições <span class="glyphicon glyphicon-pencil"></span></a></li>
									<li><a href="#" data-content="avaliador">Avaliador <span class="glyphicon glyphicon-user"></span></a></li>
									<li><a href="#" data-content="eixos">Eixos <span class="glyphicon glyphicon-tag"></span></a></li>
								<?php
								}?>
						</ul>
				</div>
			</aside>
</section>