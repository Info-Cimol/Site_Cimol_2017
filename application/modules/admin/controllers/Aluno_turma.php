<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_turma extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('aluno_turma_model');
		date_default_timezone_set("Brazil/East");
	}
	
	public function index($turma_id){
		echo $turma_id;
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="aluno_turma/index";
		$this->data['turma_id']=$turma_id;
		$this->data['alunos_turma']=$this->aluno_turma_model->listar($turma_id);
	}
	
	public function listar($turma_id){
		$this->load->model('turma_model');
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="aluno_turma/index";
		$this->data['turma']=$this->turma_model->buscar($turma_id);
		$this->data['alunos_turma']=$this->aluno_turma_model->listar($turma_id);
		
		$this->view->show_view($this->data);
	}
	
	public function salvar(){
		
		if(isset($_POST['alunos_turma'])){
			$alunos_turma['alunos_turma']= $_POST['alunos_turma'];
			$alunos_turma['turma_id']=$_POST['turma_id'];
			
			if($disciplina_id=$this->aluno_turma_model->salvar($alunos_turma)){
		
				$this->view->set_message("Alunos salvos com sucesso", "alert alert-success");
		
		
			}else{
				$this->view->set_message("Erro ao salvar alunos","alert alert-error");
		
			}
			
		}
		redirect("admin/aluno_turma/listar/".$alunos_turma['turma_id'],"redirect");
	}
	
}