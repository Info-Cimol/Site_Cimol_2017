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
				<form method="post">
					<div id="projeto" class="Inscrconteudo">
						<div class="formulario">
							<input class="Campform" type="text" name="titulo" placeholder="Título" required ><br><br>
							<textarea class="Campform" rows="6" cols="80" placeholder="Resumo"></textarea>
						</div>
					</div>	
					<div id="eixoAluno" class="Inscrconteudo">
						<div class="formulario">
							<input class="Campmarc" type="checkbox">Inovação Tecnológica</input>
							<input class="Campmarc" type="checkbox">Inovação Ciêntifica</input>
							<input class="Campmarc" type="checkbox">Trabalho Ciêntifico</input>
							<input class="Campmarc" type="checkbox">Aprimoramento</input>
						</div>
					</div>
					<div id="aluno" class="Inscrconteudo">
						<div class="formulario">
							<h3>Dados do Aluno</h3>
							<button type="button" id="addAluno" class="btn btn-primary addCampo"><span class="glyphicon glyphicon-plus"></span></button>
							</br></br>
							<input class="Campform" type="text" name="matricula" placeholder="Matrícula">
							</br>
							</br>
							<select class="Campform">
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
							<select class="Campform">
								<option value="" disabled="disabled" selected="selected">Estilo de Camiseta</option>
								<option value="babyLook">Baby Look</option>
								<option value="comum">Comum</option>
							</select>
						</div>	
					</div>	
					<div id="orientador" class="Inscrconteudo">
						<div class="formulario">
							<input class="Campform" type="text" name="orientador" placeholder="Orientador"><input class="Campform" type="text" name="emailOrientador" placeholder="Email Orientador">
							</br>
							</br>
							<input class="Campform" type="text" name="coOrienador" placeholder="Coorientador"><input class="Campform" type="text" name="emailCoorientador" placeholder="Email Coorientador"><br><br>
						</div>	
					</div>	
					<button type="submit" class="btn btn-primary btnEnviar">Enviar</button>
				</form>
			</div>
		