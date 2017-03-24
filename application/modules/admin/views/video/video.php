
	<div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					Vídeos
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					Adicionar vídeo
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
	<div class="tab-pane box active" id="list">
	<div id="listar-videos" class="box-content padded">
		<?php 
			foreach($videos as $video){
				?>
				<div class="div-video">
					<iframe width="420" height="315"
					src="<?php echo $video->url?>">
					</iframe>
					<br/>
					<br/>
					<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>admin/video/deletar_video/<?php echo $video->id;?>')" class='btn btn-default botao-excluir'><i class="icon-trash"></i> </a>
					<a id="ver-link-<?php echo $video->id?>" href=""javascript:void(0)"" class="btn btn-primary" onclick="ver_link(<?php echo $video->id ?>,'<?php echo $video->url;?>');return false;">Ver link</a>
					<a data-toggle="modal" href="#modal-form" onclick="editar_video(<?php echo $video->id; ?>)" class="btn btn-gray btn-small"> 
                       <i class="icon-wrench"></i>
                    </a>
                    <div id="link-<?php echo $video->id?>" class="div-link">
						<input id="link-input-<?php echo $video->id?>" class="mostrar-link" type="text" value="<?php echo base_url().$video->url;?>">
					</div>
				</div>	
                       	<?php 
			}
		?>
		</div>	
		</div>	
            <!----TABLE LISTING ENDS--->
            <!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open_multipart('admin/video/salvar_video' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label">Título:</label>
                                <div class="controls">
                                    <input type="text" name="video[titulo]" maxlength="60" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Descrição:</label>
                                <div class="controls">
	                                    <textarea name="video[descricao]" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">URL:</label>
                                <div class="controls">
                                    <input type="url" name="video[url]" maxlength="120" required/>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue">Adicionar Vídeo</button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>
