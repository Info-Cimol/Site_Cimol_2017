<?php
echo "<img src='".base_url().$usuario->foto."' />";
echo "<h3>".$usuario->nome."</h3>";
echo "<p> Email : ".$usuario->email."</p>";
echo "<p> RG : ".$usuario->rg."</p>";
echo "<p> CPF : ".$usuario->cpf."</p>";
echo "<p> Telefone(s)</p>";
//print_r($usuario->telefones);
foreach($usuario->telefones as $telefone){
	//print_r($telefone);
	echo "<p>". $telefone->ddd." ".$telefone->numero."</p>";
	
}
