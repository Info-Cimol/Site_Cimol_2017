	<script src="<?php echo base_url();?>public/admin/js/disciplina/disciplina.js" type="text/javascript"></script>
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Disciplinas
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="nova_disciplina()">Nova Disciplina</a>
               
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Discíplina</div></th>
                    		<th><div>Carga Horária</div></th>
                    		<th><div>Curso</div></th>
                    		
                    		<th><div>Segmento</div></th>
                    		<th><div></div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php 
                    	if(isset($disciplinas)){
                    	$count = 1;
                    	foreach($disciplinas as $disciplina):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $disciplina->titulo;?></td>
							
							<td><?php echo $disciplina->carga_horaria." horas";?></td>
							<td><?php echo $disciplina->titulo_curso;?></td>
							<td><?php 
								echo $disciplina->nome_segmento;
								
								?></td>
							<td align="center">
								
                                <a data-toggle="modal" href="#modal-form" onclick="editar_disciplina(<?php echo $disciplina->id; ?>)" class="btn btn-gray btn-small" title="Editar"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/disciplina/deletar/<?php echo $disciplina->id;?>')" class="btn btn-red btn-small" title="Excluir">
                                		<i class="icon-trash"></i> 
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;
                    	}?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
			
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>



