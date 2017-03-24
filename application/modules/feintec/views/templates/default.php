<?php
require_once(APPPATH."modules/feintec/views/templates/header.php");
require_once(APPPATH."modules/feintec/views/templates/bloco_esquerda.php");
require_once(APPPATH."modules/feintec/views/templates/content.php");
require_once(APPPATH."modules/feintec/views/".$template.".php");
require_once(APPPATH."modules/feintec/views/templates/footer.php");
/*
$CI->load->view('templates/header', $vars);
$CI->load->view($template, $vars);
$CI->load->view('templates/content', $vars);
$CI->load->view('templates/footer', $vars);
*/