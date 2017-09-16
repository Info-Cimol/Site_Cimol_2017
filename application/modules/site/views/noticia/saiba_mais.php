<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/noticia.css" />
		<section id="noticia">
				<h4 class="titulo_pagina">Notícias</h4>
			
			 	<img src="<?php echo base_url().$noticia[0]->url_imagem.$noticia[0]->arquivo_imagem?>" >
				<h2><?php echo $noticia[0]->titulo?></h2>
				<p><?php echo $noticia[0]->resumo?></p>
				<p><?php echo $noticia[0]->data_noticia?></p>
				<hr/>
				<?php echo $noticia[0]->conteudo?>
						
				
			
		</section>