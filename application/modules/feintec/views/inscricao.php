<!-- CADASTRO DO ALUNO -->
	
		<div id="inscricao" class="conteudo">
			<h2 class="titulo">Inscrição</h2>
			<div class="opAluno">
				<ul id="menu-aluno">
					<li>Projeto</li>
					<li>Eixo</li>
					<li>Aluno</li>
					<li>Orientador</li>
				</ul>	
			</div>
				<div id="projeto" class="Inscrconteudo">
					<form action="" method="post">
						<div class="formulario">
							<label for="titulo">Título</label>
							<input id="titulo" class="Campform" type="text" name="titulo" required >
							<input type="hidden" name="tabela" value="feintec_projeto">
							<input type="hidden" name="ano" value="<?php echo date('Y')?>">
							<label for="resumo">Resumo</label>
							<textarea id="resumo" class="Campform" rows="6" cols="80" name="resumo"></textarea>
							<button type="submit" class="btn btn-primary btnEnviar">Enviar</button>
							<span class="success"></span>
						</div>

					</form>	
				</div>
				<div id="eixoAluno" class="Inscrconteudo">
					<form action="" method="post">
						<div class="formulario">
							<input class="Campmarc" type="radio" name="inovacao-tecnologica">Inovação Tecnológica</input>
							<input class="Campmarc" type="radio" name="inovacao-cientifica">Inovação Ciêntifica</input>
							<input class="Campmarc" type="radio" name="trabalho-cientifico">Trabalho Ciêntifico</input>
							<input class="Campmarc" type="radio" name="aprimoramento">Aprimoramento</input><br>
							<button type="submit" class="btn btn-primary btnEnviar">Enviar</button>
						</div>
					</form>	
				</div>
				<div id="aluno" class="Inscrconteudo">
					<form action="feintec/inscricao" method="post">
						<div class="formulario">
							<h3>Dados do Aluno</h3>
							<button type="button" id="addAluno" class="btn btn-primary addCampo"><span class="glyphicon glyphicon-plus"></span></button>
							</br></br>
							<input class="Campform" type="text" name="matricula" placeholder="Matrícula">
							</br>
							</br>
							<select class="Campform" name="tamanho-camiseta">
								<option value="" disabled="disabled" selected="selected">Tamanho de Camiseta</option>
								<option value="PP">PP</option>
								<option value="P">P</option>
								<option value="M">M</option>
								<option value="G">G</option>
								<option value="GG">GG</option>
								<option value="XG">XG</option>
							</select>
							</br>
							</br>
							<select class="Campform" name="estilo-camiseta">
								<option value="" disabled="disabled" selected="selected">Estilo de Camiseta</option>
								<option value="babyLook">Baby Look</option>
								<option value="comum">Comum</option>
							</select>
							<button type="submit" class="btn btn-primary btnEnviar">Enviar</button>
							<span class="success"></span>
						</div>	
					</form>	
				</div>	
				<div id="orientador" class="Inscrconteudo">
					<form action="feintec/inscricao" method="post">
						<div class="formulario">
							<input class="Campform" type="text" name="orientador" placeholder="Orientador"><input class="Campform" type="text" name="emailOrientador" placeholder="Email Orientador">
							</br>
							</br>
							<input class="Campform" type="text" name="coOrienador" placeholder="Coorientador"><input class="Campform" type="text" name="emailCoorientador" placeholder="Email Coorientador"><br><br>
							<button type="submit" class="btn btn-primary btnEnviar">Enviar</button>
						</div>
					</form>		
				</div>	
				
		</div>
		