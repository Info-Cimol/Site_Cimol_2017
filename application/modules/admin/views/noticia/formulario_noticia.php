<div class="box-content">
                	<?php echo form_open_multipart('admin/noticia/editar_imagens' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label">Título:</label>
                                <div class="controls">
                                    <input type="text" name="noticia[titulo]" maxlength="90" class="input-large" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Conteúdo:</label>
                                <div class="controls">

                                    	<textarea name="noticia[conteudo]" class="mceEditor" rows="5" required></textarea>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Resumo:</label>
                                <div class="controls">

                                    		<textarea name="noticia[resumo]" rows="5" maxlength="140" required></textarea>
	
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label">Imagem:</label>
	                            <div id="imagens">
	                            </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" onclick="tinymce.triggerSave();" class="btn btn-blue">Adicionar Notícia</button>
                        </div>
                    </form>                
</div>  