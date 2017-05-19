<script src="<?php echo base_url();?>public/admin/js/professor/professor.js" type="text/javascript"></script>

	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					professors
                    	</a></li>
			<!--  <li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					Adicionar Professor
                    	</a></li>-->
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
                <a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="novo_professor()">Novo professor</a>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Nome</div></th>
                    		<th><div>Carga Horária</div></th>
                    		<th><div>Telefone(s)</div></th>
                    		<th><div>Email(s)</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php $count = 1;foreach($professores as $professor):
                    	//print_r($professors);
                    	?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php 
							if($professor->foto!=''){
								echo "<img src='".base_url().$professor->foto."' style='width:70px'/> ";
							}else{
								echo "<img src='".base_url()."public/images/prof.jpg' style='width:70px'/> ";
							}
							echo $professor->nome;
							?></td>
							<td><?php 
								
									echo $professor->carga_horaria;
								
							?></td>
							<td><?php 
								
								foreach($professor->telefones as $telefone){
									//print_r($telefone);
									echo $telefone->ddd." ".$telefone->numero."<br/>";
								}
							?></td>
							<td><?php 
								foreach($professor->emails as $email){
									echo $email->email."<br/>";
								}
							?></td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_professor(<?php echo $professor->id; ?>)" class="btn btn-gray btn-small"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/professor/deletar/<?php echo $professor->id;?>')" class="btn btn-red btn-small">
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

