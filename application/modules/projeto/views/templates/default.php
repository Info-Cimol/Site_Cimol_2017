<?php
require_once(APPPATH."modules/projeto/views/templates/header.php");
require_once(APPPATH."modules/projeto/views/templates/content.php");
require_once(APPPATH."modules/projeto/views/".$template.".php");
require_once(APPPATH."modules/projeto/views/templates/footer.php");
/*
$CI->load->view('templates/header', $vars);
$CI->load->view($template, $vars);
$CI->load->view('templates/content', $vars);
$CI->load->view('templates/footer', $vars);
*/