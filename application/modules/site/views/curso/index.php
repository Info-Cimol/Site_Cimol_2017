<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/curso.css" />
<section id="cursos">
	
		
		
			<h4 class="titulo_pagina">Cursos</h4>
			
			<?php 
				
				foreach($cursos AS $curso){
			
			?>
				<div class="curso">
				
					<div class="imagem">
						
						<img src="<?php echo base_url().$curso->logo?>" />
				
					</div>
					
						<div class="texto">
					
							<h2><strong><?php echo $curso->titulo?></strong></h2>
							<?php   if(strlen($curso->descricao)>300){
										echo "<p>".substr($curso->descricao,0,300)."...";
									}else{
										echo "<p>".$curso->descricao;
									}
						?>
							
							<a href="<?php echo base_url()."curso/".$curso->id  ?>" class="saiba_mais">Saiba mais ...</a>
						
						</div>
					
				</div>
				
			
			
			<?php 
				}
			?>	
			
				
			
		
	</section>