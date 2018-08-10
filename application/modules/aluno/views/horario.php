<script src="<?php echo base_url();?>public/aluno/js/aluno.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url();  ?>public/aluno/css/aluno.css">
<section id="horario_aluno">
				
					<h4 class="titulo_pagina">SESSAO DO ALUNO</h4>
					
					
				<div class="dia_semana">
				 		 <h4 class="sessao_pagina">Segunda</h4>
				 		 <table  class="table table-striped">
                	     <thead>
                		   <tr>
                		     <th><div>Hora</div></th>
                    		 <th><div>Disciplina</div></th>
							 <th><div>Sala</div></th>
						     <th><div>Professor</div></th>
						   </tr>
					     </thead>
						<tbody>
                    	<?php
                        foreach($horarios->seg as $horario):?>
                        
                        <tr>
							 <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->inicio;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->disciplina;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->sala;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->professor;?></td>
						</tr>
						
						<?php endforeach;?>
						</tbody>
						</table>
					</div>
					
					<div class="dia_semana">
					<h4 class="sessao_pagina">Terca</h4>
						<table  class="table table-striped">
						<thead>
                		   <tr>
                		     <th><div>Hora</div></th>
                    		 <th><div>Disciplina</div></th>
							 <th><div>Sala</div></th>
						     <th><div>Professor</div></th>
						   </tr>
					     </thead>
						<tbody>
                    	<?php
                        foreach($horarios->ter as $horario):?>
                        
                        <tr>
                             <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->inicio;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->disciplina;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->sala;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->professor;?></td>
						</tr>
						
						<?php endforeach;?>
						</tbody>
						</table>
					</div>
					<div class="dia_semana">
					<h4 class="sessao_pagina">Quarta</h4>
						<table  class="table table-striped">
						<thead>
                		   <tr>
                		     <th><div>Hora</div></th>
                    		 <th><div>Disciplina</div></th>
							 <th><div>Sala</div></th>
						     <th><div>Professor</div></th>
						   </tr>
					     </thead>
						<tbody>
						
                    	<?php
                        foreach($horarios->qua as $horario):?>
                        
                        <tr>
                            <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->inicio;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->disciplina;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->sala;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->professor;?></td>
						</tr>
						
						<?php endforeach;?>
						</tbody>
						</table>
					</div>
					<div class="dia_semana">
					<h4 class="sessao_pagina">Quinta</h4>
						<table  class="table table-striped">
						<thead>
                		   <tr>
                		     <th><div>Hora</div></th>
                    		 <th><div>Disciplina</div></th>
							 <th><div>Sala</div></th>
						     <th><div>Professor</div></th>
						   </tr>
					     </thead>
						<tbody>
                    	<?php
                        foreach($horarios->qui as $horario):?>
                        
                        <tr>
                            <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->inicio;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->disciplina;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->sala;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->professor;?></td>
						</tr>
						
						<?php endforeach;?>
						</tbody>
						</table>
					</div>
					<div class="dia_semana">
					<h4 class="sessao_pagina">Sexta</h4>
						<table  class="table table-striped">
						<thead>
                		   <tr>
                		     <th><div>Hora</div></th>
                    		 <th><div>Disciplina</div></th>
							 <th><div>Sala</div></th>
						     <th><div>Professor</div></th>
						   </tr>
					     </thead>
						<tbody>
						
                    	<?php
                        foreach($horarios->sex as $horario):?>
                        
                        <tr>
                            <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->inicio;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->disciplina;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->sala;?></td>
							<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $horario->professor;?></td>
						</tr>
						
						<?php endforeach;?>
						</tbody>
						</table>
				   </div>
				
				
					
</section>
