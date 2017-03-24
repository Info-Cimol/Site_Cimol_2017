<div id="content">
<div id="content_left" >
	<div id="outras-imagens">
	<?php foreach($imagens as $imagem){?>
		<div class="outras-imagens">
				<img src="<?php echo base_url().$imagem->url_imagem.$imagem->nome ?>">
		</div>
		<?php 
	}
		?>
		</div>
	<div id="ver_noticia">
		
		<?php $this->load->library('Util')?>
		<h3><?php echo $noticia[0]->titulo; ?></h3>
		<p>Em: <?php 
		
		$data=explode("-",$noticia[0]->data_postagem);
		 echo $this->util->data_por_extenso($data[2], null,$data[1], $data[0]);
		?> </p>
		<p><?php echo $noticia[0]->resumo; ?></p>
		<div id="imagem-principal">
			<img id="imagem-mostrando" src="<?php echo base_url().$imagens[0]->url_imagem.$imagens[0]->nome ?>">
		</div>
		<p><?php echo $noticia[0]->conteudo; ?></p>
	</div>
</div>