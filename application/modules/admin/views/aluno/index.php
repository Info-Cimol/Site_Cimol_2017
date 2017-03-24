<script src="<?php echo base_url();?>public/admin/js/aluno/aluno.js" type="text/javascript"></script>

	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					alunos
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
                <a data-toggle="modal" href="#modal-form" class="btn btn-blue" onclick="novo_aluno()">Novo Aluno</a>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Matrícula(s)</div></th>
                    		<th><div>Nome</div></th>
                    		<th><div>Telefone(s)</div></th>
                    		<th><div>Email(s)</div></th>
                    		<th><div>Curso</div></th>
                    		<th><div>Opções</div></th>
						</tr>
					</thead>
					<tbody>
						
                    	<?php 
                    	if(isset($alunos)){
                    		$count = 1;foreach($alunos as $aluno):
                    	
                    	//print_r($alunos);
                    	?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $aluno->matricula;?></td>
							<td><?php 
							if($aluno->foto!=''){
								echo "<img src='".base_url().$aluno->foto."' style='width:70px'/> ";
							}else{
								echo "<img src='".base_url()."public/images/user.jpg' style='width:70px'/> ";
							}
							echo $aluno->nome;
							?></td>
							<td><?php 
								
								foreach($aluno->telefones as $telefone){
									//print_r($telefone);
									echo $telefone->ddd." ".$telefone->numero."<br/>";
								}
							?></td>
							<td><?php 
								foreach($aluno->emails as $email){
									echo $email->email."<br/>";
								}
							?></td>
							<td><?php 
								
									echo $aluno->curso."<br/>";
								
							?></td>
							<td align="center">
								<a data-toggle="modal" href="#modal-form" onclick="editar_aluno(<?php echo $aluno->id; ?>)" class="btn btn-gray btn-small" title="Editar"> 
                                		<i class="icon-wrench"></i>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/aluno/deletar/<?php echo $aluno->id;?>')" class="btn btn-red btn-small" title="Excluir">
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
            <!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open_multipart('admin/aluno/editar_imagem' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                           
                            
                             <div class="control-group">
                                <label class="control-label">Nome</label>
                                <div class="controls">
                                    <input type="text" name="aluno[nome]" maxlength="60" required/>
                                </div>
                             </div>
                             <div class="control-group">
                                <label class="control-label">Curso</label>
                                <div class="controls">
                                    <select name="aluno[curso_id]">
                                    	<option value="">   </option>
                                    	<?php 
                                    	print_r($cursos);
                                    	foreach($cursos as $curso){
                                    		echo "<option value='".$curso->id."'>".$curso->titulo."</option>";
                                    	}
                                    	
                                    	?>
                                    </select>
                                    <select name="aluno[segmento_id]">
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
                                <label class="control-label">Matrícula</label>
                                <div class="controls">
                                    <input type="text" name="aluno[matricula]" maxlength="60" required/>
                                </div>
                             </div>
                             <div class="control-group">
                                <label class="control-label">RG</label>
                                <div class="controls">
                                    <input type="text" name="aluno[rg]" maxlength="60" required/>
                                </div>
                             </div>
                             <div class="control-group">
                                <label class="control-label">CPF</label>
                                <div class="controls">
                                    <input type="text" name="aluno[cpf]" maxlength="60" required/>
                                </div>
                             </div>
                             <div class="control-group">
                                <label class="control-label">Email &nbsp;<button onclick="adicionar_campo_email(); return false;" class="btn btn-blue btn-mini">+</button></label>
                                <div class="controls" id="email">
                                    <input type="text" class="span3" name="aluno[email][]" maxlength="60" />
                                </div>
                             </div>
                             
                             <div class="control-group">
                                <label class="control-label">Telefone(s)&nbsp;<button onclick="adicionar_campo_telefone(); return false;" class="btn btn-blue btn-mini">+</button></label>
                                <div class="controls" id="telefone">
                                    <input type="text" class="span1" name="aluno[telefone][0][ddd]" maxlength="10" placeholder="DDD" required/> 
                                    <input type="text" class="span2" name="aluno[telefone][0][numero]" maxlength="60" placeholder="Número" required/>
                                    <select maxlength="20" name="aluno[telefone][0][tipo]">
                                    	<option value='celular'>Celular</option>
                                    	<option value='comercial'>Comercial</option>
                                    	<option value='residencial'>Residencial</option>
                                    	
                                    </select>
                                </div>
                             </div>
                            
                            
                            <div class="control-group">
                            <label class="control-label">Foto:</label>
	                            <input type="file" name="foto" required>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue">Salvar</button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>


