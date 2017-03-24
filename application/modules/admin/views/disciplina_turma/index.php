	<script src="<?php echo base_url();?>public/admin/js/disciplina_turma/disciplina_turma.js" type="text/javascript"></script>
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Disciplinas Turma
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
			<?php echo "<p style='font-size:18px'><strong>".$turma_nome."</strong></p>"?>
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
            	
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="nova_disciplina_turma(<?php echo $turma_id?>)">Nova Disciplina</a>
               
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Disciplina</div></th>
                    		<th><div>Turma</div></th>
                    		<th><div>Pofessor</div></th>
                    		
                    		<th><div></div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php $count = 1;foreach($disciplinas_turma as $disciplina):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $disciplina->titulo;?></td>
							<td><?php echo $disciplina->turma;?></td>
							<td><?php echo $disciplina->nome_professor;?></td>
							<td align="center">
								
                                <a data-toggle="modal" href="#modal-form" onclick="editar_disciplina(<?php echo $disciplina->turma_id.",".$disciplina->id.",".$disciplina->professor_id;?>)" class="btn btn-gray btn-small"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/disciplina_turma/deletar/<?php echo $disciplina->turma_id."/".$disciplina->id;?>')" class="btn btn-red btn-small">
                                		<i class="icon-trash"></i> 
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
           
		</div>
	</div>
</div>

