<script src="<?php echo base_url();?>public/admin/js/turma/turma.js" type="text/javascript"></script>
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					turmas
                    	</a></li>
            
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
            	<a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="nova_turma()">Nova Turma</a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Turma</div></th>
                    		<th><div>Periodo</div></th>
                    		<th><div>Ano</div></th>
                    		<th><div>Curso</div></th>
                    		<th><div>Segmento</div></th>
                    		<th><div></div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php $count = 1;foreach($turmas as $turma):
                    	//print_r($turma);?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $turma->nome;?></td>
							<td><?php 
							switch($turma->periodo){
								case '1':
									echo "Primeiro";
									break;
								case '2':
									echo "Segundo";
									break;
								case '3':
									echo "Terceiro";
									break;
								case '4':
									echo "Quarto";
									break;
								case '5':
									echo "Quinto";
									break;
								case '6':
									echo "Sexto";
									break;
		
							}						
							
							
							?></td>
							<td><?php echo $turma->ano;?></td>
							<td><?php echo $turma->titulo_curso;?></td>
							<td><?php 
								echo $turma->nome_segmento;
								
								?></td>
							<td align="center">
								<a data-toggle="modal" href="<?php echo base_url();?>admin/disciplina_turma/<?php echo $turma->id;?>/<?php echo $turma->nome;?>" class="btn btn-blue btn-small" title="Disciplinas"> 
                                		<i class="icon-th-list"></i>
                                </a>
                                <a data-toggle="modal" href="<?php echo base_url();?>admin/aluno_turma/listar/<?php echo $turma->id;?>" class="btn btn-blue btn-small" title="Alunos"> 
                                		<i class="icon-user"></i>
                                </a>
								<a data-toggle="modal" href="#modal-form" onclick="editar_turma(<?php echo $turma->id; ?>)" class="btn btn-gray btn-small" title="Editar"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/turma/deletar/<?php echo $turma->id;?>')" class="btn btn-red btn-small" title="Excluir">
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
                	<?php echo form_open_multipart('admin/turma/salvar' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label">Nome:</label>
                                <div class="controls">
                                    <input type="text" name="turma[nome]" maxlength="60" required/>
                                </div>
                            </div>
                           
                            
                            <div class="control-group">
                                <label class="control-label">Curso</label>
                                <div class="controls">
                                    <select name="turma[segmento_curso_id]">
                                    	<option value="">   </option>
                                    	<?php 
                                    	print_r($cursos);
                                    	foreach($cursos as $curso){
                                    		echo "<option value='".$curso->id."'>".$curso->titulo."</option>";
                                    	}
                                    	
                                    	?>
                                    </select>
                                    <select name="turma[segmento_segmento_id]">
                                    	<option value="">   </option>
                                    	<?php 
                                    	foreach($segmentos as $segmento){
                                    		echo "<option value='".$segmento->id."'>".$segmento->descricao."</option>";
                                    	}
                                    	
                                    	?>
                                    </select>
                                </div>
                            </div>
                            
                             <div class="control-group">
                                <label class="control-label">Ano/Semestre:</label>
                                <div class="controls">
                                    <input class='span1' type="text" name="turma[ano]" maxlength="60" required/>
                                    <select name="turma[semestre]">
                                    	<option value="">   </option>
                                    	<option value="1">Primeiro Semestre</option>
                                    	<option value="2">Segundo Semestre</option>
                                    </select>
                                </div>
                            </div>
                           
                            
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue">Adicionar turma</button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>

<script>
	var i=1;
	
	
	var x=0;
	function editar_turma(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/turma/buscar/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	            console.log(data);
	            
					
	            cursos='';
	            cursos+="<select name='turma[segmento_curso_id]' >"+
	            "<option value='"+data[0].segmento_curso_id+"'>"+data[0].titulo_curso+"<option>";
	            for(i=0;i<data.cursos.length;i++){
					cursos +="<option value='"+data.cursos[i].id+"'>"+data.cursos[i].titulo+"</option>";
	            }
				cursos +="<select>";
				cursos+="<select name='turma[segmento_segmento_id]' >"+
	            "<option value='"+data[0].segmento_segmento_id+"'>"+data[0].descricao_segmento+"<option>";
	            for(i=0;i<data.segmentos_cursos.length;i++){
					cursos +="<option value='"+data.segmentos_cursos[i].id+"'>"+data.segmentos_cursos[i].descricao+"</option>";
	            }
				cursos +="<select>";
				
	        	$('#modal-body').html('');
	        	$('#modal-body').append("<form action='"+base_url+"admin/turma/editar/"+data[0].id+"' method='post' enctype='multipart/form-data'>"+
	        			"<div class='padded'>"+
	        				"<div class='control-group'>"+
			                    "<label class='control-label'>Nome:</label>"+
			                    "<div class='controls'>"+
			                        "<input type='text' name='turma[nome]' value='"+data[0].nome+"' maxlength='60' required/>"+
			                    "</div>"+
			                "</div>"+
			                
			                "<div class='control-group'>"+
		                    "<label class='control-label'>Curso:</label>"+
		                    "<div class='controls'>"+
		                    cursos+
		                    "</div>"+
		                "</div>"+
		                "<div class='control-group'>"+
                        "<label class='control-label'>Ano/Semestre:</label>"+
                        "<div class='controls'>"+
                            "<input class='span1' type='text' name='turma[ano]' value='"+data[0].ano+"' required/>"+
                            "<select name='turma[semestre]'>"+
                            	"<option value='"+data[0].semestre+"'>  </option>"+
                            	"<option value='1'>Primeiro Semestre</option>"+
                            	"<option value='2'>Segundo Semestre</option>"+
                            "</select>"+
                        "</div>"+
                    "</div>"+    
			                
			                
			            "<div class='form-actions'>"+
			                "<input type='submit'  class='btn btn-blue' name='salvar' value='Salvar'>"+
			            "</div>"+
			           
			           
			        "</form>");
	
	        }
	        	
		})
	}
	
	

</script>

