<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/curso.css" />
		<section id="curso">
				<h4 class="titulo_pagina">Cursos</h4>
				<div id="identificacao_curso">
					<img src="<?php echo base_url().$curso[0]->logo?>" style="width:25%" >
					<div style="float:left; width:70%; margin-left:10px;">
						<h2><?php echo $curso[0]->titulo?></h2>
						<p><?php echo $curso[0]->descricao?></p>
						<p><?php echo "Prossor(a) coordenador(a) : ".$curso[0]->nome_coordenador?></p>
					</div>
					
				</div>
				
				<h4 class="sessao_pagina">Grade(s)</h4>
				<?php foreach($grades AS $grade){
					echo "<h4>Curso ".$grade['nome']."</h4>";
					echo "<table border='1' style='width:100%'>
					<thead>
					<tr>
					<th>Período</th>
					<th>Discíplina</th>
					<th>Carga Horário</th>
					</tr>
					</thead>
					<tbody>";
					foreach($grade['horario'] AS $horario){
						echo"<tr>
							<td> ".$horario->periodo." </td>
							<td> ".$horario->titulo." </td>
							<td> ".$horario->carga_horaria." </td>
						<tr>";
								
						
					}
					echo 	"</tbody>
							</table>
							<hr/>";
					
				}?>		
				
			
		</section>