<?php
require_once(APPPATH."modules/feintec/views/temas/default/header.php");
require_once(APPPATH."modules/feintec/views/temas/default/bloco_esquerda.php");
require_once(APPPATH."modules/feintec/views/temas/default/content.php");
require_once(APPPATH."modules/feintec/views/".$template.".php");
require_once(APPPATH."modules/feintec/views/temas/default/footer.php");
/*
$CI->load->view('templates/header', $vars);
$CI->load->view($template, $vars);
$CI->load->view('templates/content', $vars);
$CI->load->view('templates/footer', $vars);
*/