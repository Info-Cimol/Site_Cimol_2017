<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto extends MX_Controller {
	public function __construct(){
		parent::__construct();
		//$this->load->model('feintec/Projeto');
	}
	
	function index(){
		print_r($_SESSION['user_data']);
	}

}