<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends MX_Controller {
	public function __construct(){
		parent::__construct();
		if(isset($this->user_data)){
			//print_r($this->user_data['permissoes']);
			if(!in_array('aluno', $this->user_data['permissoes'])){
				
				$_SESSION['route']="aluno";
				redirect('usuario', 'refresh');
				//redirect('', 'refresh');
			}
		}else{
			$_SESSION['route']="aluno";
			redirect('usuario', 'refresh');
		}
		
	}
	
	public function index()
	{
	    
		$this->data['title']="Cimol - Area do Aluno";
		$this->data['content']="index";
		$this->view->show_view($this->data);
	}
	
	public function horario($pessoa_id){
	    
	    $this->load->model('Horario_turma_model');
	    $this->load->model('Aluno_model');
	    $this->load->model('Turma_model');
	    
	    //buscar a turma do aluno
	    $turma =$this->Aluno_model->buscar_turma($pessoa_id);
	    //print_r($turma);
	    //Buscar horario da turma
	    $horarios = $this->Horario_turma_model->listar_aluno($turma->id);
	    //print_r($horarios);
	    $this->data['horarios']=$horarios;
	    $this->data['title']="Cimol - Área do Aluno";
	    $this->data['content']="horario";
	    $this->view->show_view($this->data);
	        
 
	}
	
	
}
