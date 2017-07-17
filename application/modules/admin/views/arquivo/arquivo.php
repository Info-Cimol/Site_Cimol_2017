	<script src="<?php echo base_url();  ?>public/admin/js/arquivo/arquivo.js"></script>
	<div id="arquivos-header" class="box-header">
		<h3>Imagens</h3>
	</div>
	<div id="listar-arquivos" class="box-content padded">
		<div class="tab-content">
		<table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div></div></th>
                    		<th><div>Título</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
		<?php 
			
			if(isset($arquivos[0])){
				foreach($arquivos as $arquivo){
					?>
					<tr>
						<td><?php echo BASEPATH.$arquivo->path_arquivo.$arquivo->nome;?></td>
						<td>
							<input id="link-input-<?php echo $arquivo->id?>" class="mostrar-link" type="text" value="<?php echo base_url().$arquivo->path_arquivo.$arquivo->nome;?>">
						</td>
						
						<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/arquivo/excluir/<?php echo $arquivo->id;?>')" class='btn btn-default botao-excluir'><i class="icon-trash"></i> </a>
						<a id="ver-link-<?php echo $arquivo->id?>" href=""javascript:void(0)"" class="btn btn-primary" onclick="ver_caminho(<?php echo $arquivo->id ?>,'<?php echo base_url().$arquivo->path_arquivo.$arquivo->nome;?>');return false;">Ver Caminho</a>
					</td>
					</tr>
					<?php 
				}
			}
			
		?>
		</tbody>
                </table>
	<div id="botao-adicionar">
		<a data-toggle="modal" href="#modal-form" class="btn btn-primary" onclick="arquivos_formal();return false;">Adicionar mais arquivos</a>
	</div>
	</div>
	</div>
</div>
