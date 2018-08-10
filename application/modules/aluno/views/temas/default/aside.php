	<aside class="visible-desktop">
		<div id="area_estagio">
		<h4 class="sessao_aside"><a href="<?php echo base_url();  ?>estagio/">Estágio</a></h4>
		</div>
		
		<?php 
		if((isset($user_data))){
		    if(in_array("admin",  $user_data['permissoes'])){
		        ?>
		<div id="area_estagio">
		    <h4 class="sessao_aside"><a href="<?php echo base_url();  ?>admin/">Admin</a></h4>
		</div>  
		 <?php  
		}
		if(in_array("aluno",  $user_data['permissoes'])){
		    ?>
		<div id="area_estagio">
		    <h4 class="sessao_aside"><a href="<?php echo base_url();  ?>aluno/">Sessao do aluno</a></h4>
		</div>
		    
		 <?php  
		}
		
		if(in_array("professor",  $user_data['permissoes'])){
		    ?>
		<div id="area_estagio">
		    <h4 class="sessao_aside"><a href="<?php echo base_url();  ?>professor/">Sessao do professor</a></h4>
		</div>
		<?php
		}
		}
		
		?>
		<!--  
		<div id="calendario">
			<h4 class="sessao_aside"><a href="<?php echo base_url();  ?>calendario/">Calendário</a></h4>
		</div>
		-->
		<div id="face-desktop">
			<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FcimolOficial%2F&tabs=timeline&width=220&height=350&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="220" height="350" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
		</div>
		<div id="museu">
			<img src="<?php echo base_url();  ?>public/temas/default/images/museu.png"/>
		</div>
	</aside>