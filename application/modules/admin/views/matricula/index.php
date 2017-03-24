<script src="<?php echo base_url();?>public/admin/js/matricula/matricula.js" type="text/javascript"></script>

	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Matriculas
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
                <a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="nova_matricula()">Nova Matrícula</a>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Matrícula(s)</div></th>
                    		<th><div>Nome</div></th>
                    		<th><div>Curso</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
						
                    	<?php 
                    	if(isset($matriculas)){
                    		$count = 1;foreach($matriculas as $matricula):
                    	
                    	//print_r($alunos);
                    	?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $matricula->matricula;?></td>
							<td><?php 
							if($matricula->foto_aluno!=''){
								echo "<img src='".base_url().$matricula->foto_aluno."' style='width:70px'/> ";
							}else{
								echo "<img src='".base_url()."public/images/logo/pessoa.png' style='width:70px'/> ";
							}
							echo $matricula->nome_aluno;
							?></td>
							
							<td><?php 
								
									echo $matricula->nome_curso."<br/>";
								
							?></td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_matricula(<?php echo $matricula->matricula; ?>)" class="btn btn-gray btn-small" title="Editar"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/matricula/deletar/<?php echo $matricula->matricula;?>')" class="btn btn-red btn-small" title="Excluir">
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


