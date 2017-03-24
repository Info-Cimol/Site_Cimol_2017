			<?php echo form_open_multipart('admin/evento/editar_imagens' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label">Título:</label>
                                <div class="controls">
                                    <input type="text" name="evento[titulo]" maxlength="60" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                	<label class="control-label">Descrição:</label>
                                	<div class="controls">
                                    	<textarea name="evento[descricao]" class="mceEditor" rows="5" ></textarea>
                               		 </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Resumo:</label>
                                <div class="controls">

                                    		<textarea name="evento[resumo]" rows="5" maxlength="140" ></textarea>
	
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Data:</label>
                                <div id="data" class="controls">
                                    		<input type="date" class="data" name="evento[data]"  required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Cursos:</label>
                                <div class="controls">
                                    <?php 
                                    foreach($cursos as $curso){
                                    	echo "<input type='checkbox' name='cursos[]' value='".$curso->id."'>".$curso->titulo."<br/>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label">Imagem:</label>
	                            <div id="imagens">
	                            </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue">Adicionar Evento</button>
                        </div>
                    </form>  