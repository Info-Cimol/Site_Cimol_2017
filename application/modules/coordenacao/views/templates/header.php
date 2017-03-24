
<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta charset="utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link rel="stylesheet" href="<?php echo base_url();?>public/admin/template/css/font.css">
		<link href="<?php echo base_url();?>public/admin/template/css/ekattor.css" media="screen" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url()."public/coordenacao/css/style.css"?>" />
		<link rel="stylesheet" href="<?php echo base_url()."public/css/calendario.css"?>" />
		<link href="<?php echo base_url()."public/css/jquery.Jcrop.min.css"?>" rel="stylesheet" type="text/css"/>
		<script src="<?php echo base_url();?>public/admin/template/js/ekattor.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>public/js/jquery.maskedinput.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>public/tinymce/tinymce.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>public/js/jquery.Jcrop.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>public/js/script.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>public/js/ajax_modal.js" type="text/javascript"></script>
		<title>Cimol - Área do Professor</title>
    </head>
    <body> 
    <div id="main">
	<div class="navbar navbar-top navbar-inverse">
		<div class="navbar-inner">
			<div class="container-fluid">
				<img src="<?php echo base_url();?>public/images/cimol.png"  style="max-height:100px; max-width:100px; float:left;"/>
				<a class="brand" href="<?php echo base_url();?>" style="float:left;">Coordenação
				</a>
				<!-- the new toggle buttons -->
				<ul class="nav pull-right">
					<li class="toggle-primary-sidebar hidden-desktop" data-toggle="collapse" data-target=".nav-collapse-primary"><button type="button" class="btn btn-navbar"><i class="icon-th-list"></i></button></li>
					<li class="hidden-desktop" data-toggle="collapse" data-target=".nav-collapse-top"><button type="button" class="btn btn-navbar"><i class="icon-align-justify"></i></button></li>
				</ul>
				<div class="nav-collapse nav-collapse-top collapse">
	            	<ul class="nav pull-right">
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <b class="caret"></b></a>
						<!-- Account Selector -->
	                    <ul class="dropdown-menu">
	                    	<li class="with-image">
	                            <div class="avatar">
	                                <img src="<?php echo base_url();?>public/admin/template/images/icons_big/account.png" class="avatar-medium"/>
	                            </div>
	                            <span><?php echo $user_data['nome'];?></span>
	                        </li>
	                    	<li class="divider"></li>
							<li><a href="<?php echo base_url();?>admin/manage_profile">
	                        		<i class="icon-user"></i><span></span></a></li>
	                        <li><a href="<?php echo base_url();?>manage_profile">
	                        		<i class="icon-lock"></i><span></span></a></li>
							<li><a href="<?php echo base_url();?>logout">
	                        		<i class="icon-off"></i><span></span></a></li>
						</ul>
	                	<!-- Account Selector -->
						</li>
					</ul>
	                <ul class="nav pull-right">
						<li class="dropdown">
						<a href="#" ><i class="icon-user"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>