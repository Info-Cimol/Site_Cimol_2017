<div id="content">

<div id="content_left" >
<h3>Solicitar usuário</h3>
<p>Informe os dados, para solicitar uma conta de acesso.</p>
<form action="<?php echo base_url() ?>usuario/registrar_usuario" method="POST" >
	<select name="perfil">
		<option value="">Tipo de usuário</option>
		<option value="aluno">Aluno</option>
		<option value="professor">Professor</option>
		<option value="coordenador">Coordenador</option>
		<option value="administrador">Administrador</option>
	</select>
	<br/>
	<input type="email" name="email"  placeholder="Informe a seu email" required />
	<br/>
	
	<input type="submit" name="enviar" value="Solicitar uma conta de usuário" />
	<p></p>
</form>
</div>