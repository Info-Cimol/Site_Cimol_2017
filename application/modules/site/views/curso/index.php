<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/curso.css" />
<section id="cursos">
	
		
		
			<h4>Notícias</h4>
			
			<?php 
				
				foreach($cursos AS $curso){
			
			?>
				<div class="curso">
				
					<div class="imagem">
						
						<img src="<?php echo base_url().$curso->logo?>" />
				
					</div>
					
						<div class="texto">
					
							<h2><strong><?php echo $curso->titulo?></strong></h2>
							<p><?php echo $curso->descricao?></p>
							<a href="<?php echo base_url()."curso/".$curso->id  ?>" class="saiba_mais">Saiba mais ...</a>
						
						</div>
					
				</div>
				
			
			
			<?php 
				}
			?>	
			
				
			
		
	</section>