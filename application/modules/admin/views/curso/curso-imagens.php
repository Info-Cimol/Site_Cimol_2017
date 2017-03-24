<div class="main-content">
<div class="content-fluid padded">
<div class="box">
	<div class="box-content padded">
		<div class="tab-content">
            <!----CREATION FORM STARTS---->
            	<h3 class="editar-imagem-aviso">Clique na imagem para editar o tamanho:</h3>
                <div class="box-content">
                		<div class='imagem-editar'>
                		<a data-toggle='modal' href='.modal-imagem' onclick='editar_logo("<?php echo $imagem ?>");'><img src="<?php echo base_url().$imagem?>"></img></a>
                		</div>
                		<form action="<?php echo base_url().$_SESSION['form_action']?>" method="post">
	                		<input id='width' type='hidden' name='width'>
	                		<input id='height' type='hidden' name='height'>
	                		<input id='x' type='hidden' name='x'>
	                		<input id='y' type='hidden' name='y'>
	                		<input id='x2' type='hidden' name='x2'>
	                		<input id='y2' type='hidden' name='y2'>
	                		<input type='hidden' name="imagem" value="<?php echo $imagem?>">
                			<br/>
                			<br/>
                			<input type='submit' value='Salvar' class="botao-editar-imagem btn btn-blue">
                		</form>    
                </div>             
			<!----CREATION FORM ENDS--->
		</div>
	</div>
</div>
</div>
</div>