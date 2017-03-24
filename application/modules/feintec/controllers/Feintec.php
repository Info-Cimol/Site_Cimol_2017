<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feintec extends MX_Controller {
	public function __construct(){
		parent::__construct();
		/*if(isset($this->user_data)){
			//print_r($this->user_data['permissoes']);
			if(
				!in_array('coordenador', $this->user_data['permissoes']) 
				and 
				!in_array('feintec', $this->user_data['permissoes'])
				and 
				!in_array('admin', $this->user_data['permissoes'])
			){
				
				$_SESSION['route']="feintec";
				redirect('usuario', 'refresh');
				//redirect('', 'refresh');
			}
		}else{
			$_SESSION['route']="feintec";
			redirect('usuario', 'refresh');
		}*/
		
	}
	
	public function index()
	{
		
		$this->data['title']="Cimol - Feintec";
		$this->data['template']="inicio";
		$this->view->show_view($this->data);
	}
	
	public function inscricao(){
		$this->data['title']="Cimol - Feintec";
		$this->data['template']="inscricao";
		$this->view->show_view($this->data);
	}
	
	
	
	
}
