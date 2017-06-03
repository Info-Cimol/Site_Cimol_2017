<script src="<?php echo base_url();?>public/admin/js/curso/curso.js" type="text/javascript"></script>

	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Cursos
                    	</a>
            </li>
			<!--  
			<li>
            	<a href="#add" data-toggle="tab"  onclick="novo_curso()"><i class="icon-plus"></i>
					Adicionar curso
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
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="novo_curso()">Novo Curso</a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Curso</div></th>
                    		<th><div>Segmento</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(isset($cursos)){
						$count = 1;foreach($cursos as $curso):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php 
								
								echo "<img src='".base_url(). $curso->logo."' style='width:100px;float:left;margin:15px'/>";
								echo "<p>".$curso->titulo."</p>";
								echo "<p>".$curso->descricao."<p/>";
							?>
							</td>
							<td>
								<?php 
								
									echo "<ul>";
									
									foreach($curso->segmentos AS $segmento){
										echo "<li>".$segmento->nome."</li>";
									}
									echo "</ul>";
								?>
								
							</td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_curso(<?php echo $curso->id; ?>)" class="btn btn-gray btn-small" title="Editar"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/curso/deletar_curso/<?php echo $curso->id;?>')" class="btn btn-red btn-small" title="Excluir">
                                		<i class="icon-trash"></i> 
                                </a>
                                <!--  
                                <?php if($curso->status=="inativo"){?>
                                <a data-toggle="modal" href="#modal-form" onclick="ativar_curso(<?php echo $curso->id; ?>)" class="btn btn-gray btn-small" title="Ativar"> 
                                		<i class="icon">Ativar</i>
                                </a>
                                <?php }else{ ?>
                                <a data-toggle="modal" href="#modal-form" onclick="desativar_curso(<?php echo $curso->id; ?>)" class="btn btn-gray btn-small" title="Desativar"> 
                                		<i class="icon">Desativar</i>
                                </a>
                                <?php }?>
                               
                               <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/curso/deletar_curso/<?php echo $curso->id;?>')" class="btn btn-warning btn-small">
                                		<i class="icon-tags "></i> 
                                </a>
                                -->
                                <a data-toggle="modal" href="#modal" onclick="modal_delete('<?php echo base_url();?>admin/curso/visualizar_curso/<?php echo $curso->id;?>')" class="btn btn-info btn-small" title="Visualizar">
                                		<i class="icon-eye-open"></i> 
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;
						}?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            <!----CREATION FORM STARTS---->
			<!--  
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content" id="novo_curso" >
                	         
                </div>                
			</div>
			-->
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>
