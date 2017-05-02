<script src="<?php echo base_url();?>public/admin/js/evento/evento.js" type="text/javascript"></script>

	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Paineis Edição
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
            	<p><a>admin</a>/<a>evento</a>/<a>edicao</a>/<a>painel</a>/</p>
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="novo_painel_edicao_evento(<?php echo $evento_id?>,<?php echo $edicao_id?>)">Novo painel</a>
               <?php 
               	echo "<p>Evento : ";
               	
               	echo $titulo_evento."</p>";
              
				echo "<p>Edição : ".$titulo_edicao."</p>"?>
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
                    	foreach($paineis_edicao as $painel_edicao):?>
                        <tr>
                        	<td><?php echo $count++;?></td>
                            <td ><?php echo "<img src='".base_url().$painel_edicao->url_imagem.$painel_edicao->nome_imagem."' style='width:100px'/>";?></td>
							<td><?php echo "<p>".$painel_edicao->titulo."</p>";
							echo "<p>".$painel_edicao->descricao."</p>";
							echo "<p>".$painel_edicao->data." às ".$painel_edicao->hora."</p>";
							
							?></td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_painel_edicao(<?php echo $evento_id; ?>,<?php echo $painel_edicao->id; ?>)" class="btn btn-gray btn-small"> 
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/evento/deletar_edicao/<?php echo $evento_id;?>/<?php echo $painel_edicao->id;?>')" class="btn btn-red btn-small">
                                		<i class="icon-trash"></i> 
                                </a>
                               
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
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