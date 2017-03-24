
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
				<form method="post" id="formInscricao" name="formInscricao" ng-controller="inscricao" novalidate>
					<div id="projeto" class="Inscrconteudo">
						<div class="formulario">
							<input class="Campform" type="text" name="titulo" ng-model="titulo" placeholder="Título" required ><br><br>
							<textarea class="Campform" rows="6" cols="80" ng-model="resumo" placeholder="Resumo"></textarea>
						</div>
					</div>	
					<div id="eixoAluno" class="Inscrconteudo">
						<div class="formulario">
							<input class="Campmarc" type="checkbox" ng-model="eixo[1]" value="">Inovação Tecnológica</input>
							<input class="Campmarc" type="checkbox" ng-model="eixo[2]" value="">Inovação Ciêntifica</input>
							<input class="Campmarc" type="checkbox" ng-model="eixo[3]" value="">Trabalho Ciêntifico</input>
							<input class="Campmarc" type="checkbox" ng-model="eixo[4]" value="">Aprimoramento</input>
						</div>
					</div>
					<div id="aluno" class="Inscrconteudo">
						<div class="formulario">
							<h3>Dados do Aluno</h3>
							<button type="button" id="addAluno" class="btn btn-primary addCampo"><span class="glyphicon glyphicon-plus"></span></button>
							</br></br>
							<input class="Campform" type="text" ng-model="aluno.matricula"placeholder="Matrícula">
							</br>
							</br>
							<select class="Campform" ng-model="aluno.tamCamiseta">
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
							<select class="Campform" ng-model="aluno.estiloCamiseta">
								<option value="" disabled="disabled" selected="selected">Estilo de Camiseta</option>
								<option value="babyLook">Baby Look</option>
								<option value="comum">Comum</option>
							</select>
						</div>	
					</div>	
					<div id="orientador" class="Inscrconteudo">
						<div class="formulario">
							<input class="Campform" type="text" ng-model="orientador.nome" placeholder="Orientador"/><br/><input class="Campform" type="text" ng-model="projeto.orientador.email" placeholder="Email Orientador"/>
							<br/>
							<br/>
							<input class="Campform" type="text" ng-model="coorientador.nome" placeholder="Coorientador"/><br/><input class="Campform" type="text" ng-model="projeto.coorientador.email" placeholder="Email Coorientador"/><br><br>
						</div>	
					</div>	
					<button type="submit" class="btn btn-primary btnEnviar" name="enviar" ng-click="enviarInscricao()">Enviar</button>
				</form>
			</div>
		
			<!-- CADASTRO DE PROJETO -->
			<div id="Admaluno" class="conteudo">
				<div class="titulo">
					Alunos
				</div>
				<button class="novo btn btn-primary">Novo Aluno</button>
				<table>
					<tbody>
						<tr class="titulo-registro">
							<td>Nº</td>
							<td>Matrícula(s)</td>
							<td>Projeto</td>
							<td>Nome</td>
							<td>Email(s)</td>
							<td>Telefone(s)</td>
							<td>Turma</td>
							<td>Curso(s)</td>
							<td>Editar</td>
						</tr>
						<tr class="registro" ng-repeat="aluno in alunos">
							<td>1232</td>
							<td>{{aluno.matricula}}</td>
							<td></td>
							<td>{{aluno.nome}}</td>
							<td>{{aluno.email}}</td>
							<td></td>
							<td></td>
							<td></td>
							<td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<!-- CADASTRO DE PROFESSOR -->
			<div id="professor" class="conteudo">
				<div class="titulo">
					Professor
				</div>
				<button class="novo">Novo Professor</button>
				<table>
					<tbody>
						<tr class="titulo-registro">
							<td>Nome</td>
							<td>Telefone</td>
							<td>Email</td>
							<td>Editar</td>
						</tr>
						<tr class="registro">
							<td>Cândido</td>
							<td>(51)-92343243</td>
							<td>candido@gmail.com</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="edicao" class="conteudo">
				<div class="formulario">
					<div class="titulo">Edição</div>
					<form>
						<input class="entrada-dados" type="text" placeholder="Título">
						</br></br>
						<textarea class="Campform" rows="10" cols="30" placeholder="Descrição"></textarea>
						</br></br>
						<input class="entrada-dados" type="text" placeholder="Data Inicial">
						</br></br>
						<input class="entrada-dados" type="text" placeholder="Data Final">
						</br></br>
						<button class="btnModal btn btn-primary" type="submit">Salvar</button>
					</form>	
				</div>	
			</div>
			<div id="eixo" class="conteudo">
				<div class="formulario">
					<div class="titulo">Eixo</div>
					<form>
						<input class="entrada-dados" type="text" placeholder="Título">
						</br></br>
						<textarea id="descEixo" class="Campform" rows="10" cols="30" placeholder="Descrição"></textarea>
						<button type="button" id="addEixo" class="btn btn-primary addCampo">+</button>
					</form>
				</div>
			</div>
			<div class="modal conteudo">
				<div class="titulo">
						Cadastro de	Aluno
				</div>
					<div class="formulario">
						<form>
							<input class="entrada-dados" type="text" placeholder="Matrícula">
							<input class="entrada-dados" type="text" placeholder="Nome">
							<input class="entrada-dados" type="text" placeholder="Nome do Projeto">
							<select class="entrada-dados">
								<option value="" selected="select" disabled="disabled">Curso</option>
								<option value="elo">Eletrônica</option>
								<option value="ele">Eletrotécnica</option>
								<option value="info">Informática</option>
								<option value="design">Design de Móveis</option>
								<option value="moveis">Móveis</option>
								<option value="meio">Meio-Ambiente</option>
								<option value="qui">Química</option>
							</select>
							<select class="entrada-dados">
								<option value="" selected="select">Turma</option>
							</select>
							</br>
							<button class="btnModal btn btn-primary" type="submit">Salvar</button>
						</form>
					</div>
				</div>	

