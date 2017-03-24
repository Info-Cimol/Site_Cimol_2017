<div class="main-content">
<div class="content-fluid padded">
<script>
	


</script>
<div class="box">
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Páginas
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					Adicionar página
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
                    		<th><div>#</div></th>
                    		<th><div>Título</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php $count = 1;foreach($paginas as $pagina):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $pagina->titulo;?></td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_pagina(<?php echo $pagina->id; ?>)" class="btn btn-gray btn-small"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/pagina/deletar_pagina/<?php echo $pagina->id;?>')" class="btn btn-red btn-small">
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
                	<?php echo form_open_multipart('admin/pagina/salvar_pagina' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label">Título:</label>
                                <div class="controls">
                                    <input type="text" name="pagina[titulo]" maxlength="60" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Relação:</label>
                                <div class="controls">
	                                <div class="box">
	                                    <checbox name="relacao[curso]" value="curso" id="curso" >Curso</checbox>
	                                    
	                                    
	                                </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CSS:</label>
                                <div class="controls">
	                                <div class="box">
	                                    <textarea name="pagina[css]" rows="8" id="css" >
	                                    
	                                    </textarea>
	                                </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">JS-Cabeçalho:</label>
                                <div class="controls">
	                                <div class="box">
	                                    <textarea name="pagina[js_head]" id="js_head" rows="8" >
	                                    
	                                    </textarea>
	                                </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Conteúdo:</label>
                                <div class="controls">
                                <div class="box">
                                    <textarea name="pagina[conteudo]"  rows="20" id="conteudo" required>
                                    
                                    </textarea>
                                </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">JS-Rodapé:</label>
                                <div class="controls">
	                                <div class="box">
	                                    <textarea name="pagina[js_footer]" id="js_footer" rows="5" >
	                                    
	                                    </textarea>
	                                </div>
                                </div>
                            </div>
                            
                        <div class="form-actions">
                            <button data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="mostrar_pagina();return false;">Mostrar Página</button>
                            <button type="submit" class="btn btn-blue">Adicionar Página</button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>
<script>
function mostrar_pagina(){
		$('#modal-body').html('');
		var css="<style>";
		css +=$('#css').val();
		css +="</style>";
		$('#modal-body').append(css);
		$('#modal-body').append("<script>");
		$('#modal-body').append($("#js_head").val());
		$('#modal-body').append("<//script>");
		var html=$('#conteudo').val();
		$('#modal-body').append(html);
		$('#modal-body').append("<script>"+$('#js_footer').val()+"<//script>");
		
		callTinymce();
}

function editar_pagina(id){
	$('#modal-body').html('');
	$.ajax({
        url: base_url+"admin/pagina/buscar_pagina/"+id,
        dataType: 'json',
        type: "post",
        success: function(data){
        			$('#modal-body').html('');
        			$('#modal-body').append("<form action='"+base_url+"admin/pagina/salvar_pagina/"+id+"' method='post'>"+
        					"<div class='padded'>"+
		                        "<div class='control-group'>"+
		                            "<label class='control-label'>Título:</label>"+
		                            "<div class='controls'>"+
		                                "<input type='text' name='pagina[titulo]' value='"+data[0].titulo+"' required/>"+
		                            "</div>"+
		                        "</div>"+
		                        "<div class='control-group'>"+
		                            "<label class='control-label'>CSS:</label>"+
		                            "<div class='controls'>"+
		                            "<div class='box'>"+
		                                            "<div class='chat-message-box'>"+
		                                				"<textarea name='pagina[css]'  id='css' rows='5' required>"+data[0].css+"</textarea>"+
		                                			"</div>"+	
		                            "</div>"+
		                            "</div>"+
		                        "</div>"+
		                        "<br/>"+
			                    "<div class='control-group'>"+
		                            "<label class='control-label'>JS:</label>"+
		                            "<div class='controls'>"+
		                            "<div class='box'>"+
		                                            "<div class='chat-message-box'>"+
		                                				"<textarea name='pagina[js_head]' id='js_head' rows='5' required>"+data[0].js_head+"</textarea>"+
		                                			"</div>"+	
		                            "</div>"+
		                            "</div>"+
		                        "</div>"+
		                        "<br/>"+
			                    "<div class='control-group'>"+
		                            "<label class='control-label'>Conteúdo:</label>"+
		                            "<div class='controls'>"+
		                            "<div class='box closable-chat-box'>"+
		                                            "<div class='chat-message-box'>"+
		                                				"<textarea name='pagina[conteudo]' rows='5' class='mceEditor' required>"+data[0].conteudo+"</textarea>"+
		                                			"</div>"+	
		                            "</div>"+
		                            "</div>"+
		                        "</div>"+
		                        "<br/>"+
			                    "<div class='control-group'>"+
		                            "<label class='control-label'>JS:</label>"+
		                            "<div class='controls'>"+
		                            "<div class='box'>"+
		                                            "<div class='chat-message-box'>"+
		                                				"<textarea name='pagina[js_head]' id='js_footer' rows='5' required>"+data[0].js_footer+"</textarea>"+
		                                			"</div>"+	
		                            "</div>"+
		                            "</div>"+
		                        "</div>"+
		                       
		                        
		                        
		                        "<div class='form-actions'>"+
									//" <button data-toggle='modal' href='#modal-form' class='btn btn-blue' onclick='mostrar_pagina();return false;'>Mostrar Página</button>"+
			                           
		                    		"<button type='submit' class='btn btn-blue'>Salvar Mudanças</button>"+
			                    "</div>"+
        				"</form>");	
        			callTinymce();
        }
	})
}

</script>
</div>
</div>
</div>