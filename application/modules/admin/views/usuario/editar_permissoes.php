<style>
	li{
		list-style:none;
	}
</style>
<form method="post" action="<?php echo base_url();?>admin/usuario/setar_permissoes/">

	<?php 
	//print_r($permissoes_usuario);
	//print_r($niveis_permissao_admin);
	//aprint_r($lista_permissoes);
	echo "<img src='".base_url().$usuario[0]->foto."' />";
	echo "<p>".$usuario[0]->nome."</p>";
	foreach($lista_permissoes AS $item){
		echo "<ul>";
		if(in_array($item,$permissoes_usuario)){
			echo "<li><input type='checkbox' checked name='".$item."'>".$item."</input></li>";
		}else{
			echo "<li><input type='checkbox' name='".$item."'>".$item."</input></li>";
		}
		if($item=="admin"){
			echo "<ul>";
			foreach($lista_niveis_permissao_admin AS $nivel_permissao){
				if(in_array($nivel_permissao,$niveis_permissao_admin)){
					echo "<li><input type='checkbox' checked name='".$nivel_permissao->permissao ."'>".$nivel_permissao->permissao."</input></li>";
				}else{
					echo "<li><input type='checkbox' name='".$nivel_permissao->permissao ."'>".$nivel_permissao->permissao."</input></li>";
				}
			}
			echo "</ul>";
		}
		echo "</ul>";
	}?>

</form>