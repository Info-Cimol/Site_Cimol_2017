<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matricula extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('matricula_model');
		date_default_timezone_set("Brazil/East");
	}
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="matricula/index";
		$this->data['matriculas']=$this->matricula_model->listar();
		
		$this->view->show_view($this->data);
	}
	
	public function salvar(){
		if($this->matricula_model->salvar($_POST['matricula'])){
			$this->view->set_message("Matricula salva com sucesso!","alert alert-success");
			
		}else{
				$this->view->set_message("Erro ao salvar matricula","alert alert-error");
				
		}
		redirect("admin/matricula","redirect");
	}
	
	function verifica_existencia_matricula_json($matricula){
		
		echo $this->matricula_model->pesquisar_por_nome($matricula);
	}
	
	function verifica_matricula_aluno_curso_json($aluno_id, $curso_id, $segmento_id){
		echo $this->matricula_model->verifica_matricula_aluno_curso($aluno_id, $curso_id, $segmento_id);
		
	}
	
	public function buscar($id){
		
	}
	
	public function deletar($matricula){
		if($this->matricula_model->deletar($matricula)){
			$this->view->set_message("matricula deletada com sucesso", "alert alert-success");
			redirect('admin/matricula', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar matricula", "alert alert-error");
			redirect('admin/matricula', 'refresh');
		}
	}
	
}