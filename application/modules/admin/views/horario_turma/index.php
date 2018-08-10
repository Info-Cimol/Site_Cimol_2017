	<script src="<?php echo base_url();?>public/admin/js/horario_turma/horario_turma.js" type="text/javascript"></script>
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Horario Turma
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
			<?php echo "<p style='font-size:18px'><strong>".$turma_nome."</strong></p>"?>
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
			
            	
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="novo_horario_turma(<?php echo $turma_id?>)">Novo Horário</a>
               
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<!-- <th><div>Segmento</div></th> -->
                    		<!-- <th><div>Turma</div></th> -->
                    		<th><div>Disciplina</div></th>
							<th><div>Dia</div></th>
							<th><div>Turno</div></th>
							<!-- ><th><div>Ordem</div></th> --> 
							<th><div>Periodo</div></th>
							<th><div>Sala</div></th>
							<!-- <th><div>Professor</div></th>  -->
							
                    		<th><div></div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php $count = 1;
                    	foreach($horarios_turma as $horario):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<!-- <td><?php echo $horario->segmento;?></td> -->
							<!-- <td><?php echo $horario->turma;?></td> --> 
							<td><?php echo $horario->disciplina;?></td>
							<td><?php echo $horario->dia;?></td>
							<td><?php echo $horario->turno;?></td>
							<!-- <td><?php echo $horario->ordem;?></td> --> 
							<td><?php echo $horario->inicio;?></td>
							<td><?php echo $horario->sala;?></td>
							<!-- <td><?php echo $horario->professor;?></td> -->
							<td align="center">
								
                                <a data-toggle="modal" href="#modal-form" onclick="editar_horario(<?php echo $horario->turma_id;?>)" class="btn btn-gray btn-small"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/horario_turma/deletar/<?php echo $horario->disciplina_turma_id."/".$horario->periodo_id;?>')" class="btn btn-red btn-small">
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

