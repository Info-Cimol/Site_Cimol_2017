<div id="content">
<div id="content_left" >
<?php
echo "Tonto esqueceu a senha";

?>
<form action="<?php echo base_url() ?>usuario/mensagem_recuperar_senha" method="POST" >
	<input type="email" name="email" placeholder="Informe a seu email" />
	<input type="submit" name="enviar" value="Enviar" />
	<p>Uma mensagem, para recuperação da senha, será enviada para o seu email</p>
</form>
</div>