	<script src="<?php echo base_url();?>public/admin/js/aluno_turma/aluno_turma.js" type="text/javascript"></script>
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Alunos Turma
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
			
			<?php 
				
					echo "<p style='font-size:18px'><strong>".$turma[0]->nome."</strong></p>"
			
			?>
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
            	
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="adicionar_aluno_turma(<?php echo $turma[0]->id ?>)">Adicionar aluno(s)</a>
               
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Aluno</div></th>
                    		<th><div>Matricula</div></th>
                    		<th><div>Email</div></th>
                    		<th><div>Telefone(s)</div></th>
                    		
                    		<th><div></div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php 
                    	if(count($alunos_turma)>0){
	                    	$count = 1;
	                    	foreach($alunos_turma as $aluno):?>
	                        <tr>
	                            <td><?php echo $count++;?></td>
								<td><?php echo $aluno->nome;?></td>
								<td><?php echo $aluno->maticula;?></td>
								<td><?php ?></td>
								<td><?php  ?></td>
								<td align="center">
									
	                                <a data-toggle="modal" href="#modal-form" onclick="editar_aluno(<?php echo $aluno->turma_id.",".$aluno->id.",".$aluno->professor_id;?>)" class="btn btn-gray btn-small"> 
	                                		<i class="icon-wrench"></i>
	                                </a>
	                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/aluno_turma/deletar/<?php echo $aluno->turma_id."/".$aluno->id;?>')" class="btn btn-red btn-small">
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
           
		</div>
	</div>
</div>

