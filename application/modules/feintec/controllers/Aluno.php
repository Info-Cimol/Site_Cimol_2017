<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends MX_Controller {
	public function __construct(){
		parent::__construct();
		if(isset($this->user_data)){
			//print_r($this->user_data['permissoes']);
			if(
				!in_array('coordenador', $this->user_data['permissoes']) 
				and 
				!in_array('feintec', $this->user_data['permissoes'])
				and 
				!in_array('admin', $this->user_data['permissoes'])
			){
				
				$_SESSION['route']="feintec/aluno";
				redirect('usuario', 'refresh');
				//redirect('', 'refresh');
			}
		}else{
			$_SESSION['route']="feintec/aluno";
			redirect('usuario', 'refresh');
		}
		$this->load->model('aluno_model');
		
	}
	
	public function index()
	{
		$this->data['alunos']=$this->aluno_model->listar();
		
		echo json_encode($this->data);
		
	}
	
	public function listar(){
		$this->data['alunos']=$this->aluno_model->listar();
		
		echo json_encode($this->data);
	}
	
	
	
	
}
