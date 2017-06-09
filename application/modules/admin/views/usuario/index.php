	<style>
	.permissao_usuario{
		float:left;
		margin:10px;
	}
	
	</style>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
               
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Nome</div></th>
                    		<th><div>email</div></th>
                    		<th><div>Permissões</div></th>
                    		<th><div></div></th>
						</tr>
					</thead>
					<tbody>
                    	<?php 
                    	if(isset($usuarios)){
                    	$count = 1;foreach($usuarios as $usuario):
                    	
                    	//print_r($professors);
                    	?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php 
							if($usuario->foto!=''){
								echo "<img src='".base_url().$usuario->foto."' style='width:70px'/> ";
							}else{
								echo "<img src='".base_url()."public/images/user.jpg' style='width:70px'/> ";
							}
							echo $usuario->nome;
							?></td>
							
							
							<td><?php 
								foreach($usuario->emails as $email){
									echo $email->email."<br/>";
								}
							?></td>
							<td>
							<?php 
								foreach($usuario->permissoes as $permissao){
									if($permissao->admin==1){
										echo "<div class='permissao_usuario'>Administrador</div>";
									}
									if($permissao->coordenador_curso==1){
										echo "<div class='permissao_usuario'>Coordenador</div>";
									}
									if($permissao->professor==1){
										echo "<div class='permissao_usuario'>Professor</div>";
									}
									if($permissao->aluno==1){
										echo "<div class='permissao_usuario'>Aluno.</div>";
									}
									if($permissao->biblioteca==1){
										echo "<div class='permissao_usuario'>Biblioteca</div>";
									}
						
								}
							?>
							</td>
							<td align="center">
								
        					</td>
                        </tr>
                        <?php endforeach;
                    	}?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
		
	</div>
</div>

