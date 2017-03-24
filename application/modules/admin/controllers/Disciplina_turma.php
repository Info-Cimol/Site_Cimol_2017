<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disciplina_turma extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('disciplina_turma_model');
		date_default_timezone_set("Brazil/East");
	}
	public function index($turma_id,$turma_nome)
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="disciplina_turma/index";
		$this->data['turma_id']=$turma_id;
		$this->data['turma_nome']=$turma_nome;
		$this->data['disciplinas_turma']=$this->disciplina_turma_model->listar($turma_id);
		$this->load->model('professor_model');
		$this->data['professores']=$this->professor_model->listar();
		if(count($this->data['disciplinas_turma'])>0){
			$this->data['disciplinas']=$this->disciplina_turma_model->listar_disciplinas_curso(
					$this->data['disciplinas_turma'][0]->segmento_curso_curso_id,
					$this->data['disciplinas_turma'][0]->periodo
					);
		}
		$this->view->show_view($this->data);
	}
	
	public function salvar(){
		if(isset($_POST['disciplina'])){
			$disciplina_turma= $_POST['disciplina'];
			
			if($disciplina_id=$this->disciplina_turma_model->salvar($disciplina_turma)){
				
				$this->view->set_message("disciplina salva com sucesso", "alert alert-success");
				
				
			}else{
				$this->view->set_message("Erro ao salvar disciplina","alert alert-error");
				
			}
		}
		redirect("admin/disciplina_turma/"+$disciplina_turma['turma_id'],"redirect");
	}
	
	
	public function deletar($turma_id,$id){
		if($this->disciplina_turma_model->deletar($turma_id,$id)){
			$this->view->set_message("disciplina deletada com sucesso", "alert alert-success");
			
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar disciplina", "alert alert-error");
			//redirect('admin/disciplina/'.$turma_id, 'refresh');
		}
		redirect('admin/disciplina_turma/'.$turma_id, 'refresh');
	}
	
	public function buscar($turma_id, $disciplina_id, $professor_id){
		$disciplina_turma=$this->disciplina_turma_model->buscar($turma_id, $disciplina_id, $professor_id);
		$this->load->model('professor_model');
		$disciplina_turma['professores']=$this->professor_model->listar();
		$disciplina_turma['disciplinas']=$this->disciplina_turma_model->listar_disciplinas_curso(
				$disciplina_turma[0]->segmento_curso_id,
				$disciplina_turma[0]->modulo
				);
		echo json_encode($disciplina_turma);
	}
	public function listar_disciplinas_turma_json($turma_id){
		$disciplinas=$this->disciplina_turma_model->listar($turma_id);
		echo json_encode($disciplinas);
	}
	
	public function listar_disciplinas_curso_json($curso_id, $periodo=null){
		$disciplinas=$this->disciplina_turma_model->listar_disciplinas_curso($curso_id,$periodo);
		echo json_encode($disciplinas);
	}
	
}