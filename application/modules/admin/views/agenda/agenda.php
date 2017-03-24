
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Agendas
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					Adicionar agenda
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>Data</div></th>
                    		<th><div>Hora</div></th>
                    		<th><div>Evento</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php $count = 1;foreach($agendas as $agenda):?>
                        <tr>
							<td><?php echo $agenda->data;?></td>
							<td><?php echo $agenda->hora;?></td>
							<td><?php echo $agenda->titulo;?></td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_agenda(<?php echo $agenda->id; ?>)" class="btn btn-gray btn-small"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/agenda/deletar_agenda/<?php echo $agenda->id;?>')" class="btn btn-red btn-small">
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
                	<?php echo form_open_multipart('admin/agenda/salvar_agenda' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label">Data:</label>
                                <div class="controls">
                                    <input type="date" class="data" name="agenda[data]" maxlength="60" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Hora:</label>
                                <div class="controls">
                                    <input type="time" class="hora" name="agenda[hora]" maxlength="60" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Título:</label>
                                <div class="controls">
                                    <input type="text" name="agenda[titulo]" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Evento:</label>
                                <div class="controls">
                                    <textarea name="agenda[evento]" class="mceEditor" rows="5"></textarea>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue">Adicionar Agenda</button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>

<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
?>
	<script>
	$(document).ready(function(){
		$('.data').mask("99/99/9999");
		$('.hora').mask("99:99");
	})
	</script>
<?php 
}?>