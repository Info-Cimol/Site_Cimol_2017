<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
	public function __construct(){
		parent::__construct();
		if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				$_SESSION['route']="admin";
				redirect('', 'refresh');
			}
		}else{
			$_SESSION['route']="admin";
			redirect('login', 'refresh');
		}
	}
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="teste";
		$this->view->show_view($this->data);
	}
	public function buscar_agenda($id){
		$agenda=$this->agenda_model->buscar_agenda($id);
		echo json_encode($agenda);
	}
}
