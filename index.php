<?php
	session_start();
	include "config.php";
	include "header.php";
	include "conexao.php";
	
?>
	<section>
		<div class="banner"><img src="./images/banner.png"></div>
			
		<div class="conteudo">
			</br></br>
			<?php  
				if(isset($_GET['path'])){
					$path=explode("/",$_GET['path']);
					
					$pagina=$path[0];
					
					if(isset($path[1])){
						$acao=$path[1];
					}
					if(isset($path[2])){
						unset($path[0]);
						unset($path[1]);
						$param=$path;
					}
					include $pagina.".php";
				}
				
			?>
		</div>
	</section>
	
	<?php
		include "footer.php";
	?>