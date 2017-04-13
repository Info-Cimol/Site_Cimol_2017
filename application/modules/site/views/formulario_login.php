<style>
#login{
	margin-top:100px;
	margin-left:100px;
}
</style>
<div id="login">
<?php
	echo form_open('usuario/autenticar');
	echo form_label('Usuario: ');
	echo form_input('usuario');
	echo "<br/>";
	echo form_label('Senha: ');
	echo form_password('senha');
	echo form_submit('enviar', 'Enviar');
?>
<div><a href="<?php echo base_url() ?>usuario/esqueceu_senha">Esqueceu a senha</a></div>
<div><a href="<?php echo base_url() ?>usuario/solicitar_usuario">Solicitar usuário</a></div>
</div>