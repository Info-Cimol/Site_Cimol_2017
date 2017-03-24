<script src="<?php echo base_url();?>public/admin/js/noticia/noticia.js" type="text/javascript"></script>
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Notícias
                    	</a>
            </li>
            <!--  
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					Adicionar notícia
                    	</a>
            </li>
            -->
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="nova_noticia()">Nova noticia</a>
               
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Título</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php $count = 1;foreach($noticias as $noticia):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $noticia->titulo;?></td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_noticia(<?php echo $noticia->id; ?>)" class="btn btn-gray btn-small" title="Editar"> 
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/noticia/deletar_noticia/<?php echo $noticia->id;?>')" class="btn btn-red btn-small" title="Excluir">
                                		<i class="icon-trash"></i> 
                                </a>
                                <a data-toggle="modal" href="#modal-form" onclick="ajaxModal(<?php echo $noticia->id ?>);return false;" class="btn btn-green btn-small" title="Visualizar">
                                <i class="icon-eye-open"></i> 
                                </a>
                                <a data-toggle="modal" href="#modal-form" onclick="listar_imagens(<?php echo $noticia->id ?>);return false;" class="btn btn-blue btn-small" title="Imagens">
                                <i class="icon-tags"></i> 
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            <!----CREATION FORM STARTS---->
            <!--  
			<div class="tab-pane box" id="add" style="padding: 5px">
                <?php 
                include "formulario_noticia.php";
                ?>             
			</div>
			-->
			<!----CREATION FORM ENDS--->
		</div>
	</div>
