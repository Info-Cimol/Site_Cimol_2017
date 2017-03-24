<?php
require_once(APPPATH."modules/admin/views/templates/header.php");
require_once(APPPATH."modules/admin/views/templates/content.php");
require_once(APPPATH."modules/admin/views/templates/mensagens.php");
require_once(APPPATH."modules/admin/views/".$template.".php");
require_once(APPPATH."modules/admin/views/templates/footer.php");
/*
$CI->load->view('templates/header', $vars);
$CI->load->view($template, $vars);
$CI->load->view('templates/content', $vars);
$CI->load->view('templates/footer', $vars);
*/