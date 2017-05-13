<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CIMOL</title>
	
	<link rel="stylesheet" href="<?php echo base_url();  ?>public/plugins/bootstrap/css/bootstrap.min.css">
	<script src="<?php echo base_url();  ?>public/plugins/jquery.min.js"></script>
	<script src="<?php echo base_url();  ?>public/plugins/bootstrap/js/bootstrap.min.js"></script>
	<link href="<?php echo base_url();  ?>public/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();  ?>public/temas/default/css/style.css" />
</head>
<body>
	<header>
		<div id="info" class="visible-desktop">Visitante</div>
		<div id="icon_nav" class="visible-phone visible-tablet">
			<img onclick="showMenuMobile()" src = "<?php echo base_url();  ?>public/temas/default/images/threelines.png" alt = "nav"/>
		</div>
		<div id="escola_mobile">
			<img src = "<?php echo base_url();  ?>public/temas/default/images/img-logo-MOBILE.png" alt = "escola"  class="visible-phone visible-tablet"/>
			</div>
		
		<nav class="navbar navbar-default visible-desktop">
		  <div class="container-fluid">
			 
			 <div class="navbar-header">
				<a class="navbar-brand" href="#"><img src = "<?php echo base_url();  ?>public/temas/default/images/logo_desktop.png" id="logo_desktop" alt = "escola" class="visible-desktop"/></a>
			 </div>
			 <ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo base_url();  ?>">Ínicio</a></li>
				<li><a href="<?php echo base_url();  ?>institucional">Institucional</a></li>
				<li><a href="<?php echo base_url();  ?>curso">Cursos</a></li>
				<li><a href="<?php echo base_url();  ?>noticia">Noticias</a></li>
				<li><a href="<?php echo base_url();  ?>evento">Eventos</a></li>
			 </ul>
				<form class="navbar-form navbar-left">
				  <div class="input-group">
					 <input type="text" class="form-control" placeholder="Search">
					 <div class="input-group-btn">
						<button class="btn btn-default" type="submit">
						  <i class="glyphicon glyphicon-search"></i>
						</button>
					 </div>
				  </div>
				</form>
			<ul class="nav navbar-nav navbar-right ">
				<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			 </ul>
		  </div>
		</nav>
		
		<a href="#" id="icone-login-mobile" class="visible-phone visible-tablet" onclick="showFormLogin()"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		<a href="" class="visible-phone visible-tablet" id="icone-busca-mobile" onclick="showFormBuscaMobile()"><i class="glyphicon glyphicon-search"></i></a>
	  
	</header>
		<div id="form-busca-mobile">
			<form class="navbar-form navbar-left">
			  <div class="input-group">
				 <input type="text" class="form-control" placeholder="Search">
				 <div class="input-group-btn">
					<button class="btn btn-default" type="submit">
					  <i class="glyphicon glyphicon-search"></i>
					</button>
				 </div>
			  </div>
			</form>
		</div>
		<div id="nav-mobile">
	<nav  class="visible-phone visible-tablet" >
		

		<ul class="nav nav-pills nav-stacked">
		  <li><a href="#">Ínicio</a></li>
				<li><a href="<?php echo base_url();  ?>">Institucional</a></li>
				<li><a href="<?php echo base_url();  ?>curso">Cursos</a></li>
				<li><a href="<?php echo base_url();  ?>noticia">Noticias</a></li>
				<li><a href="<?php echo base_url();  ?>evento">Eventos</a></li>
				<li><a href="<?php echo base_url();  ?>estagio">Estágio</a></li>
				
				<li><a tabindex="0" data-toggle="dropdown" data-submenu class="item-dropdown">
						Redes Sociais 
						<span class="caret"></span>
						<uL class="dropdown-menu">
							<li class="dropdown">Facebook</li>
							<li class="dropdown">Twitter</li>
							<li class="dropdown">Moodle</li>
						</ul>
					</a>
				</li>
				<li><a tabindex="0" data-toggle="dropdown" data-submenu class="item-dropdown">
						Status 
						<span class="caret"></span>
						<uL class="dropdown-menu">
							<li class="dropdown">Vistante</li>
							<li class="dropdown">Administrador</li>
							<li class="dropdown">-------</li>
						</ul>
					</a>
				</li>
		</ul>
	</nav>
	</div>
	