<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eixo extends MX_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->load->model('feintec/eixo_model');
		$this->eixo_model->teste();
	}

}