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
	
	public function editar_permissoes($usuario_id){
		$this->data['template']="usuario/editar_permissoes";
		$this->data['usuario']=$this->usuario_model->buscarUsuario($usuario_id);
		//print_r($this->data['usuario']);
		$this->data['permissoes_usuario']=$this->usuario_model->listarPermissoesUsuario($usuario_id);
		if(in_array("admin",$this->data['permissoes_usuario'])){
			$this->data["lista_niveis_permissao_admin"]=$this->usuario_model->listarNiveisPermissaoAdmin();
			$this->data['niveis_permissao_admin']=$this->usuario_model->buscarNiveisPermissaoAdmin($usuario_id);
		}else{
			$this->data['niveis_permissao_admin']=null;
			
		}
		$this->data['lista_permissoes']=$this->usuario_model->listarPermissoes();
		
		$this->view->show_view($this->data);
	}
}