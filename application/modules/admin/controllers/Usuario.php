<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('usuario_model');
		date_default_timezone_set("Brazil/East");
		$this->data['title']="Cimol - Área do Administrador";
	}
	public function index()
	{
		
		$this->data['template']="usuario/index";
		$this->data['usuarios']=$this->usuario_model->listarUsuarios();
		//print_r($this->data);
		$this->view->show_view($this->data);
	}
}