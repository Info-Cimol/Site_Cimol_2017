
<div id="content">

<div id="content_left" >
<h2>Redefinir a senha</h2>
<p>Informe os dados solicitados para redefinir a sua senha.</p>
<p>Nome : <?php echo $usuario->nome?></p>
<form action="<?php echo base_url() ?>usuario/registrar_alteracao_senha" method="POST" >
	<input type="email" name="email" placeholder="Informe a seu email" required />
	<br/>
	<input type="hidden" name="chave_de_acesso" value="<?php echo $usuario->chave_de_acesso?>" />
	<input type="password" name="senha" placeholder="Informe a a nova senha" required/>
	<br/>
	<input type="password" name="_senha" placeholder="Confirme a nova senha" required/>
	<br/>
	<input type="submit" name="enviar" value="Registrar a nova senha" />
	<p></p>
</form>
</div>