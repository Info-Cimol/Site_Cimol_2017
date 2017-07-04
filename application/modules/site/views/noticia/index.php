<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/noticia.css" />
<section id="noticias">
	
		
		
			<h4 class="titulo_pagina">Notícias</h4>
			
			<?php 
				
				foreach($noticias AS $noticia){
			
			?>
				<div class="noticia">
				
					<div class="imagem">
						
						<img src="<?php echo base_url().$noticia->url_imagem.$noticia->arquivo_imagem?>" />
				
					</div>
					
					<div class="texto">
					
							<h2><?php echo $noticia->titulo?></h2>
							<p><?php echo $noticia->data_noticia.": ".$noticia->resumo?></p>
							<a href="<?php echo base_url()."noticia/".$noticia->id  ?>" class="saiba_mais">Saiba mais ...</a>
						
					</div>
					
				</div>
			
			
			<?php 
				}
			?>	
			
				
			
		
	</section>