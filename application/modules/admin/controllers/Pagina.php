<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('pagina_model');
	}
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="pagina";
		$this->data['paginas']=$this->pagina_model->listar_paginas();
		$this->view->show_view($this->data);
	}	
	public function salvar_pagina($id=null){
		if($id!=null){
			$pagina = $this->input->post('pagina');
			if($this->pagina_model->postar_pagina($pagina, $id)){
				$this->view->set_message("Página editada com sucesso", "alert alert-success");
				redirect('admin/pagina', 'refresh');
			}else{
				$this->view->set_message("Erro ao editar página", "alert alert-error");
				redirect('admin/pagina', 'refresh');
			}
		}else{
			$pagina = $this->input->post('pagina');
			if($this->pagina_model->postar_pagina($pagina)){
				$this->view->set_message("Página adicionada com sucesso", "alert alert-success");
				redirect('admin/pagina', 'refresh');
			}else{
				$this->view->set_message("Erro ao adicionar página", "alert alert-error");
				redirect('admin/pagina', 'refresh');
			}
		}
	}
	public function buscar_pagina($id){
		$pagina=$this->pagina_model->buscar_pagina($id);
		echo json_encode($pagina);
	}
	public function deletar_pagina($id){
		if($this->pagina_model->deletar_pagina($id)){
			$this->view->set_message("Página deletada com sucesso", "alert alert-success");
			redirect('admin/pagina', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar página", "alert alert-error");
			redirect('admin/pagina', 'refresh');
		}
	}
}