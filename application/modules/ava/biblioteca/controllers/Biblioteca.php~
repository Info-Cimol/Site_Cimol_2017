<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ava extends MX_Controller {
	public function __construct(){
		parent::__construct();
		if(isset($this->user_data)){
			//print_r($this->user_data['permissoes']);
			if(
				!in_array('coordenador', $this->user_data['permissoes']) 
				and 
				!in_array('professor', $this->user_data['permissoes'])
				and 
				!in_array('admin', $this->user_data['permissoes'])
					and
					!in_array('aluno', $this->user_data['permissoes'])
			){
				
				$_SESSION['route']="ava";
				redirect('usuario', 'refresh');
				//redirect('', 'refresh');
			}
		}else{
			$_SESSION['route']="ava";
			redirect('usuario', 'refresh');
		}
		
	}
	
	public function index()
	{
		
		$this->data['conteudo']="inicio";
		$this->load->view('templates/default', $this->data);
		
	}
	
	
	
}
