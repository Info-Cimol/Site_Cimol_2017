<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turma extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('turma_model');
		date_default_timezone_set("Brazil/East");
	}
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="turma/index";
		$this->data['turmas']=$this->turma_model->listar();
		$this->load->model('curso_model');
		$this->data['cursos']=$this->curso_model->listar();
		$this->data['segmentos']=$this->curso_model->listar_segmentos();
		$this->view->show_view($this->data);
	}
	
	public function salvar(){
		$turma= $_POST['turma'];
		//$turma['ip']=$_SERVER['REMOTE_ADDR'];
		//$turma['usuario_id']=$_SESSION['user_data']['id'];
	
		if($turma_id=$this->turma_model->salvar($turma)){
			
				$this->view->set_message("Turma salva com sucesso", "alert alert-success");
			
			
		}else{
			$this->view->set_message("Erro ao salvar turma","alert alert-error");
			
		}
		redirect("admin/turma","redirect");
	}
	
	public function editar($id){
		$turma= $_POST['turma'];
		$turma['ip']=$_SERVER['REMOTE_ADDR'];
		$turma['usuario_id']=$_SESSION['user_data']['id'];
		
		if($turma_id=$this->turma_model->salvar($turma,$id)){
				
			$this->view->set_message("Turma salva com sucesso", "alert alert-success");
				
				
		}else{
			$this->view->set_message("Erro ao salvar turma","alert alert-error");
				
		}
		redirect("admin/turma","redirect");
	}
		
	public function deletar($id){
		if($this->turma_model->deletar($id)){
			$this->view->set_message("turma deletado com sucesso", "alert alert-success");
			redirect('admin/turma', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar turma", "alert alert-error");
			redirect('admin/turma', 'refresh');
		}
	}
	
	public function buscar($id){
		$turma=$this->turma_model->buscar($id);
		$this->load->model('curso_model');
		$turma['cursos']=$this->curso_model->listar();
		$turma['segmentos_cursos']=$this->curso_model->listar_segmentos();
		echo json_encode($turma);
	}
	
	public function buscar_turma_json($id){
		$turma=$this->turma_model->buscar($id);
		
		echo json_encode($turma);
	}
	
}