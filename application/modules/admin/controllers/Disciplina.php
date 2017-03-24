<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disciplina extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('disciplina_model');
		date_default_timezone_set("Brazil/East");
	}
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="disciplina/index";
		$this->data['disciplinas']=$this->disciplina_model->listar();
		$this->load->model('curso_model');
		$this->data['cursos']=$this->curso_model->listar();
		$this->data['segmentos']=$this->curso_model->listar_segmentos();
		$this->view->show_view($this->data);
	}
	
	public function salvar(){
		//print_r($_POST);
		$disciplina= $_POST['disciplina'];
		//$disciplina['ip']=$_SERVER['REMOTE_ADDR'];
		//$disciplina['usuario_id']=$_SESSION['user_data']['id'];
		//print_r($disciplina);
		if($disciplina_id=$this->disciplina_model->salvar($disciplina)){
			
				$this->view->set_message("disciplina salva com sucesso", "alert alert-success");
			
			
		}else{
			$this->view->set_message("Erro ao salvar disciplina","alert alert-error");
			
		}
		redirect("admin/disciplina","redirect");
	}
	
	public function editar($id){
		$disciplina= $_POST['disciplina'];
		$disciplina['ip']=$_SERVER['REMOTE_ADDR'];
		$disciplina['usuario_id']=$_SESSION['user_data']['id'];
		
		if($disciplina_id=$this->disciplina_model->salvar($disciplina,$id)){
				
			$this->view->set_message("disciplina salva com sucesso", "alert alert-success");
				
				
		}else{
			$this->view->set_message("Erro ao salvar disciplina","alert alert-error");
				
		}
		redirect("admin/disciplina","redirect");
	}
		
	public function deletar($id){
		if($this->disciplina_model->deletar($id)){
			$this->view->set_message("disciplina deletado com sucesso", "alert alert-success");
			redirect('admin/disciplina', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar disciplina", "alert alert-error");
			redirect('admin/disciplina', 'refresh');
		}
	}
	
	public function buscar($id){
		$disciplina=$this->disciplina_model->buscar($id);
		//$this->load->model('curso_model');
		//$disciplina['cursos']=$this->curso_model->listar();
		//$disciplina['segmentos_cursos']=$this->curso_model->listar_segmentos();
		echo json_encode($disciplina);
	}
	
}