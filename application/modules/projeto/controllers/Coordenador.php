<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto extends MX_Controller {
	public function __construct(){
		parent::__construct();
		if(isset($this->user_data)){
			//print_r($this->user_data['permissoes']);
			if(!in_array('coordenador', $this->user_data['permissoes'])){
				
				$_SESSION['route']="professor";
				redirect('usuario', 'refresh');
				//redirect('', 'refresh');
			}
		}else{
			$_SESSION['route']="professor";
			redirect('usuario', 'refresh');
		}
		
	}
	
	public function index()
	{
		$this->data['title']="Cimol - Área do Professor";
		$this->data['template']="inicio";
		$this->view->show_view($this->data);
	}
	
}
