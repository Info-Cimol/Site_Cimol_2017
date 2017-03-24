<head>
		<title><?php  echo $title ?></title>
		<meta charset="UTF-8" />
		<meta name="keywords" content="HTML, CSS, AULA, SITE, CIMOL" />
		<meta name="description" content="Cândido Farias" />
		<meta name="author" content="Cândido  Farias" />
		<link rel="icon" href="<?php echo base_url() ?>public/images/logo/LOGO CIMOL - favicon.png" />
		<script src="<?php echo base_url() ?>public/plugins/jquery-2.1.4.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url() ?>public/admin/template/js/script.js" type="text/javascript"></script>
		<link href="<?php echo base_url() ?>public/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo base_url()."public/css/style.css"?>" />
		
	</head>
	<body>
		<div id="main">
			<div id="banner"><br/></div>
			<div id="header">
				<div id="header_center">

				</div>
			</div>
			<div id="header_mobile">
				
				<div id="header_center">
					<div id="logo_mobile" >
						<h1 style="color:#4c00c0;">CIMOL</h1><!--  </h3><img src="<?php echo base_url() ?>public/images/cimol.png"/>-->
					</div>
					<div id="menu_mobile">
						<img src="<?php echo base_url() ?>public/images/menu.png"/>
					</div>
					<!--  <div id="menu_videos">
						<img src="<?php echo base_url() ?>public/images/video_menu.png"/>
					</div>
					<div id="menu_relacionamentos">
						<img src="<?php echo base_url() ?>public/images/nav_relacionamento.png"/>
					</div>
					-->
				</div>
				
				
				
			</div>
			<!-- 
			<div id="nav_relacionamentos" class="nav">
				<ul>
				<a href='<?php echo base_url()."feintec/"?>'><li>Feintec</li></a>
				<a href='<?php echo base_url()."servicos/"?>'><li>Serviços</li></a>
				<a href='<?php echo base_url()."transporte/"?>'><li>Transporte</li></a>
				<a href='<?php echo base_url()."biblioteca/"?>'><li>Biblioteca</li></a>
				<a href='<?php echo base_url()."agenda/"?>'><li>Calendário</li></a>
				<a href='http://moodle2.cimol.g12.br/'><li>Moodle</li></a>
				<a href='<?php echo base_url()."coordenadores/"?>'><li>Coordenadores</li></a>
				<a href='<?php echo base_url()."sri/"?>'><li>SRI</li></a>
			</ul>
			</div>
			 -->
			
			<div id="nav" class="nav">
				
				<ul>
					<li><a href="<?php echo base_url() ?>">Home</a> </li>
					<li><a href="<?php echo base_url()?>institucional">Institucional</a> </li>
					<li><a href="<?php echo base_url()?>curso">Cursos</a> </li>
					<li><a href="<?php echo base_url()?>noticia">Noticias</a> </li>
					<li><a href="<?php echo base_url()?>evento">Eventos</a> </li>
					<li><a href="<?php echo base_url()?>agenda">Agenda</a> </li>
					<li><a href="<?php echo base_url()?>contato">Contato</a> </li>
					<li id="item_relacionamento"><a href="<?php echo base_url()?>contato">Relacionamento</a> </li>
					<li id="item_videos"><a href="<?php echo base_url()?>contato">Videos</a> </li>
				</ul>
			</div>
			<script>
				$('html, body').animate({
			        scrollTop: $("#nav").offset().top
			    }, 500);

			    $('#menu_mobile').click(function(){
				    if( $('#nav').css('display')=="none"){
				    	$('#nav').css('display','block');	
				    }else{
				    	$('#nav').css('display','none');
				    	$('#nav_relacionamentos').css('display','none');
				    }
			    });
			    $('#menu_relacionamentos').click(function(){
				    if( $('#nav_relacionamentos').css('display')=="none"){
				    	$('#nav_relacionamentos').css('display','block');
				    	$('#nav').css('display','none');	
				    }else{
				    	$('#nav_relacionamentos').css('display','none');
				    }
			    });

			    
			</script>
