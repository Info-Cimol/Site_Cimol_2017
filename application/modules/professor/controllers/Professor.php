<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends MX_Controller {
	public function __construct(){
		parent::__construct();
		if(isset($this->user_data)){
			//print_r($this->user_data['permissoes']);
			if(!in_array('professor', $this->user_data['permissoes'])){
				
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
		$this->data['content']="index";
		$this->view->show_view($this->data);
	}
	
	public function horario($professor_id)
	{
	    $this->data['title']="Cimol - Área do Professor";
	    $this->data['content']="horario";
	    
	    $this->load->model('Horario_turma_model');
	    $this->load->model('Professor_model');
	    $this->load->model('Turma_model');
	    
	    $turmas= $this->Turma_model->listar_turmas_curso($professor_id);
	    $this->data['turmas']= $turmas;
	    //print_r($turmas);
	    $this->view->show_view($this->data);
	}	
	
	public function horario_turma($professor_id, $turma_id){
	    
	    $this->load->model('Horario_turma_model');
	    $this->load->model('Professor_model');
	    $this->load->model('Turma_model');
	    $this->data['title']="Cimol - Área do Professor";
	    $this->data['content']="horario_turma";
	    $this->data['turma']= $this->Turma_model->buscar_turma_prof($turma_id);
	    
	    
	    
	    $horarios = $this->Professor_model->listar_disciplinas_professor($professor_id, $turma_id);
	    $this->data['horarios']=$horarios;
	    //print_r($horarios);
	    $this->view->show_view($this->data);
	    
	}
	
	
}