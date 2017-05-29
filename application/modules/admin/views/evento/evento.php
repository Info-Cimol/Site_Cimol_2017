<script src="<?php echo base_url();?>public/admin/js/evento/evento.js" type="text/javascript"></script>

	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Eventos
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
            	
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="novo_evento()">Novo evento</a>
               
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div></div></th>
                    		<th><div>Título</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
						
                    	<?php 
                    	
                    	$count = 1;
                    	foreach($eventos as $evento):?>
                        <tr>
                        	<td><?php echo $count++;?></td>
                            <td ><?php echo "<img src='".base_url().$evento->url_imagem.$evento->nome_imagem."' style='width:100px'/>";?></td>
							<td><?php echo "<p style='font-size:20px'>".$evento->titulo."</p>";
							echo "<p>".$evento->resumo."</p>";?></td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_evento(<?php echo $evento->id; ?>)" class="btn btn-gray btn-small" title="Editar"> 
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/evento/deletar_evento/<?php echo $evento->id;?>')" class="btn btn-red btn-small" title="Excluir">
                                		<i class="icon-trash"></i> 
                                </a>
                                <a href="<?php echo base_url()."admin/evento/edicoes/".$evento->id ?>"  class="btn btn-blue btn-small" title="Edições"> 
                                		<i class="icon-list"></i>
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