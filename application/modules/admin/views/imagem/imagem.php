
	<div id="imagens-header" class="box-header">
		<h3>Imagens</h3>
	</div>
	<div id="listar-imagens" class="box-content padded">
		<div class="tab-content">
		<?php 
			foreach($imagens as $imagem){
				?>
				<div class="div-imagem">
					<img src="<?php echo base_url().$imagem->url_imagem.$imagem->nome;?>">
					<br/>
					<div id="link-<?php echo $imagem->id?>" class="div-link">
						<input id="link-input-<?php echo $imagem->id?>" class="mostrar-link" type="text" value="<?php echo base_url().$imagem->url_imagem.$imagem->nome;?>">
					</div>
					<br/>
					<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/imagem/deletar_imagem/<?php echo $imagem->id;?>')" class='btn btn-default botao-excluir'><i class="icon-trash"></i> </a>
					<a id="ver-link-<?php echo $imagem->id?>" href=""javascript:void(0)"" class="btn btn-primary" onclick="ver_link(<?php echo $imagem->id ?>,'<?php echo base_url().$imagem->url_imagem.$imagem->nome;?>');return false;">Ver link</a>
				</div>
				<?php 
			}
		?>
	<div id="botao-adicionar">
		<a data-toggle="modal" href="#modal-form" class="btn btn-primary" onclick="imagens_formal();return false;">Adicionar mais imagens</a>
	</div>
	</div>
	</div>
</div>
