	<?php //echo md5("fogaça")?>
	<div class="sidebar-background">
		<div class="primary-sidebar-background">
		
		</div>
	</div>
<div class="primary-sidebar">
	<!-- Main nav -->
    <br />
    <div style="text-align:center;">
    	<a href="<?php echo base_url();?>">
        	<img src="<?php echo base_url();?>public/admin/uploads/logo.png"  style="max-height:100px; max-width:100px;"/>
        </a>
    </div>
   	<br />
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!------página----->
		<!--  <li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/pagina" rel="tooltip" data-placement="right"
				data-original-title="página">
					<img src="<?php echo base_url();?>public/admin/template/images/icons/home.png" />
                    <span>Página</span>
				</a>
		</li>
		-->
		<!------notícia----->
		<?php if(in_array("admin",$_SESSION['user_data']['permissoes'])){
			$permissoes=$_SESSION['user_data']['permissoes']['permissoes_admin'];
			foreach($permissoes AS $permissao){
				$permissoes_admin[]=$permissao->permissao;
			}
		if(in_array("total",$permissoes_admin) OR in_array("noticia",$permissoes_admin)){
		?>
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/noticia" rel="tooltip" data-placement="right" 
                	data-original-title="noticia">
					<!--<i class="icon-columns icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/noticeboard.png" />
					<span>Noticia</span>
				</a>
		</li>
		<?php }
		if(in_array("total",$permissoes_admin) OR in_array("evento",$permissoes_admin)){?>
		<!------evento----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/evento" rel="tooltip" data-placement="right" 
                	data-original-title="evento">
					<!--<i class="icon-columns icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/noticeboard.png" />
					<span>Evento</span>
				</a>
		</li>
		<?php }
		if(in_array("total",$permissoes_admin) OR in_array("curso",$permissoes_admin)){?>
		<!------curso----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/curso" rel="tooltip" data-placement="right" 
                	data-original-title="curso">
					<!--<i class="icon-columns icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/noticeboard.png" />
					<span>Curso</span>
				</a>
		</li>
		<?php }
		if(in_array("total",$permissoes_admin) OR in_array("turma",$permissoes_admin)){?>
		<!------turma----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/turma" rel="tooltip" data-placement="right" 
                	data-original-title="turma">
					<!--<i class="icon-columns icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/noticeboard.png" />
					<span>Turma</span>
				</a>
		</li>
		<?php }
		if(in_array("total",$permissoes_admin) OR in_array("disciplina",$permissoes_admin)){?>
		<!------disciplinas----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/disciplina" rel="tooltip" data-placement="right" 
                	data-original-title="disciplina">
					<!--<i class="icon-columns icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/noticeboard.png" />
					<span>Disciplina</span>
				</a>
		</li>
        <?php }
		if(in_array("total",$permissoes_admin)){?>
        <!------usuário----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/usuario" rel="tooltip" data-placement="right"
				data-original-title="usuário">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/user.png" />
					<span>Usuário</span>
				</a>
		</li>
		<?php }
		if(in_array("total",$permissoes_admin) OR in_array("professor",$permissoes_admin)){?>
		<!------Professor----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/professor" rel="tooltip" data-placement="right"
				data-original-title="professor">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/user.png" />
					<span>Professor</span>
				</a>
		</li>
		<?php }
		if(in_array("total",$permissoes_admin) OR in_array("aluno",$permissoes_admin)){?>
		<!------Aluno----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/aluno" rel="tooltip" data-placement="right"
				data-original-title="aluno">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/user.png" />
					<span>Aluno</span>
				</a>
		</li>
		<?php }
		if(in_array("total",$permissoes_admin) OR in_array("matricula",$permissoes_admin)){?>
		<!------Matricula----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/matricula" rel="tooltip" data-placement="right"
				data-original-title="matricula">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/user.png" />
					<span>Matrícula</span>
				</a>
		</li>
        <?php }
		?>
        <!------imagem----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/imagem" rel="tooltip" data-placement="right"
				data-original-title="imagem">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/teacher.png" />
					<span>Imagem</span>
				</a>
		</li>
        
        <!------banner----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/banner" rel="tooltip" data-placement="right"
				data-original-title="banner">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/parent.png" />
					<span>Banner</span>
				</a>
		</li>
		<?php 
		if(in_array("total",$permissoes_admin) OR in_array("agenda",$permissoes_admin)){?>
		<!------agenda----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/agenda" rel="tooltip" data-placement="right"
				data-original-title="agenda">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/parent.png" />
					<span>Agenda</span>
				</a>
		</li>
		<?php }
		?>
		<!------vídeo----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>admin/video" rel="tooltip" data-placement="right"
				data-original-title="vídeo">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/admin/template/images/icons/parent.png" />
					<span>Vídeo</span>
				</a>
		</li>
		<?php }?>
	</ul>
</div>
<div class="main-content">
	<div class="content-fluid padded">
		<div class="box">
