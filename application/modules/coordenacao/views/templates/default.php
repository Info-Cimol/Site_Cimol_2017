<?php
require_once(APPPATH."modules/coordenacao/views/templates/header.php");
require_once(APPPATH."modules/coordenacao/views/templates/content.php");
require_once(APPPATH."modules/coordenacao/views/".$template.".php");
require_once(APPPATH."modules/coordenacao/views/templates/footer.php");
/*
$CI->load->view('templates/header', $vars);
$CI->load->view($template, $vars);
$CI->load->view('templates/content', $vars);
$CI->load->view('templates/footer', $vars);
*/