<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/inicio.css" />
<section id="inicio">
	<?php if(isset($noticias[0])){
	?>
	
	<div id="noticia_destaque">
		<div class="img_noticia">
			<img src="<?php echo base_url().$noticias[0]->url_imagem.$noticias[0]->arquivo_imagem ?>" />
		</div>
		<div class="resumo_noticia">
			
			
			<h2><?php echo $noticias[0]->titulo ?></h2>
			<p><?php echo $noticias[0]->resumo ?></p>
			<p>Em:<?php echo $noticias[0]->data_postagem ?></p>
			<a href="<?php echo base_url()."noticia/".$noticias[0]->id  ?>" class="saiba_mais">Saiba mais ...</a>
					
		</div>
	</div>

		<div id="lista_noticias_recentes">
			<?php 
			for($i=1; $i<=4;$i++){
				if(isset($noticias[$i])){?>
				<div class="noticias_recentes">
					<div class="img_noticia">
						<img src="<?php echo base_url().$noticias[$i]->url_imagem.$noticias[$i]->arquivo_imagem; ?>"/>
					</div>
					<div class="resumo_noticia">
						<h2><?php 
						$noticias[$i]->titulo=strtoupper($noticias[$i]->titulo);
						if(strlen($noticias[$i]->titulo)>20){
							echo substr($noticias[$i]->titulo,0,20)."...";
						}else{
							echo $noticias[$i]->titulo;
						}
						?></h2>
						<p>
						<?php 
						if(strlen($noticias[$i]->resumo)>90){
							echo substr($noticias[$i]->resumo,0,90)."...";
						}else{
							echo $noticias[$i]->resumo;
						}
						?>
						</p>
						<p>Em:<?php echo $noticias[$i]->data_postagem ?></p>
						<a href="<?php echo base_url()."noticia/".$noticias[$i]->id  ?>" class="saiba_mais">Saiba mais ...</a>
					</div>
				
				</div>
			<?php 
				}
			}?>
		</div>
	<?php 
	}?>


</section>