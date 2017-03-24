<div class="main-content">
	<div class="content-fluid padded">
		<div class="box">
			<div class="box-header">
		    	<!------CONTROL TABS START------->
				<ul class="nav nav-tabs nav-tabs-left">
					<li class="active">
		            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
							funcionalidades
		                    	</a></li>
					<li>
		            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
							Adicionar sugestão funcionalidade
		                    	</a></li>
				</ul>
		    	<!------CONTROL TABS END------->
		        
			</div>
		</div>
		<div class="box-content padded">
			<div class="tab-content">
	            <!----TABLE LISTING STARTS--->
	            <div class="tab-pane box active" id="list">
	                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
	                	<thead>
	                		<tr>
	                    		<th><div>#</div></th>
	                    		<th><div>Funcionalidade</div></th>
	                    		<th><div>Descrição</div></th>
	                    		<th><div>Proposto por</div></th>
	                    		<th><div>Avaliado por</div></th>
	                    		<th><div>Status</div></th>
	                    		<th><div></div></th>
							</tr>
						</thead>
						<tbody>
	                    	<?php if(isset($funcionalidades)){
	                    		$cont=1;
	                    		foreach($funcionalidades as $funcionalidade):?>
	                    	        <tr>
			                            <td><?php echo $count++;?></td>
										<td><?php echo $funcionalidade->titulo;?></td>
										<td><?php echo $funcionalidade->descricao;?></td>
										<td><?php echo $funcionalidade->autor;?></td>
										<td><?php echo $funcionalidade->revisor;?></td>
										<td><?php echo $funcionalidade->status;?></td>
										<td><?php 
											echo $funcionalidade->descricao_segmento;
											
											?></td>
										<td align="center">
											<a data-toggle="modal" href="<?php echo base_url();?>admin/disciplina_funcionalidade/<?php echo $funcionalidade->id;?>" class="btn btn-blue btn-small"> 
			                                		<i class="icon-th-list"></i>
			                                </a>
			                                
											<a data-toggle="modal" href="#modal-form" onclick="editar_funcionalidade(<?php echo $funcionalidade->id; ?>)" class="btn btn-gray btn-small"> 
			                                		<i class="icon-wrench"></i>
			                                </a>
			                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/funcionalidade/deletar/<?php echo $funcionalidade->id;?>')" class="btn btn-red btn-small">
			                                		<i class="icon-trash"></i> 
			                                </a>
			        					</td>
			                        </tr>
			                        <?php endforeach;
	                        	}
	                    			 ?>
	                    </tbody>
	                </table>
				</div>
			</div>
		</div>
		
	</div>
</div>
