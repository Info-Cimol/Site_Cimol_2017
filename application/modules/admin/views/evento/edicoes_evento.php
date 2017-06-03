<script src="<?php echo base_url();?>public/admin/js/evento/evento.js" type="text/javascript"></script>

	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Edições evento
                    	</a>
            </li>
            <!--  
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					Adicionar evento
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
            	
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="nova_edicao_evento(<?php echo $evento_id?>)">Nova Edicao</a>
               <?php 
               if(is_array($edicoes_evento)){
	               echo "<p>Evento : ".$edicoes_evento[0]->titulo_evento."</p>";
					echo "<p>Edições</p>"
					?>
	                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
	                	<thead>
	                		<tr>
	                    		<th><div>#</div></th>
	                    		<th><div></div></th>
	                    		<th><div>Edição</div></th>
	                    		<th><div>Opções</div></th>
							</tr>
						</thead>
						<tbody>
	                    	<?php 
	                    	
	                    	$count = 1;
	                    	if(isset($edicoes_evento)){
		                    	foreach($edicoes_evento as $edicao_evento):
		                    	?>
		                        <tr>
		                        	<td><?php echo $count++;?></td>
		                            <td ><?php echo "<img src='".base_url().$edicao_evento->url_imagem.$edicao_evento->nome_imagem."' style='width:100px'/>";?></td>
									<td><?php echo "<p>".$edicao_evento->titulo."</p>";
									echo "<p> de ".$edicao_evento->data_inicial." à ".$edicao_evento->data_final."</p>";
									
									?></td>
									<td align="center">
										<a data-toggle="modal" href="#modal-form" onclick="editar_edicao_evento(<?php echo $evento_id; ?>,<?php echo $edicao_evento->edicao_evento_id; ?>)" class="btn btn-gray btn-small"> 
		                                		<i class="icon-wrench"></i>
		                                </a>
		                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/evento/deletar_edicao/<?php echo $evento_id;?>/<?php echo $edicao_evento->edicao_evento_id;?>')" class="btn btn-red btn-small">
		                                		<i class="icon-trash"></i> 
		                                </a>
		                                <a data-toggle="modal" href="#modal-form" onclick="listar_imagens_edicao(<?php echo $evento_id?>,<?php echo $edicao_evento->edicao_evento_id?>); return false;"  class="btn btn-blue btn-small"> 
		                                		<i class="icon-picture"></i>
		                                </a>
		                              	<a href="<?php echo base_url()."admin/evento/paineis_edicao/".$edicao_evento->evento_id."/".$edicao_evento->edicao_evento_id."/".$edicao_evento->titulo_evento."/".$edicao_evento->titulo ?>"  class="btn btn-blue btn-small"> 
		                                		<i class="icon-list"></i>
		                                </a>
		                            </td>
		                        </tr>
		                        <?php endforeach;
	                    	}?>
	                    </tbody>
	                </table>
	              <?php 
               	}else{
               		echo "<h3>Não há edições para este evento.</h3>";
               		
               	}
	              
	              ?>
			</div>
            <!----TABLE LISTING ENDS--->
            <!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php include "formulario_evento.php"?>              
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
		</div>
	</div>

<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
?>
	<script>
	$(document).ready(function(){
		$('.data').mask("99/99/9999");
	})
	</script>
<?php 
}?>