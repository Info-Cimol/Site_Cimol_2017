<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		if(empty($this->user_data)){
			$this->data['title']="Cimol";
			$this->data['content']="usuario/formulario_login";
			$this->view->show_view($this->data);
		}else if(in_array('admin', $this->user_data['permissoes'])){
				print_r($_SESSION['user_data']['permissoes']);
			}
	}
	function autenticar(){
		$this->load->model('login_model');
		$usuario = $this->input->post('usuario');
		$senha = md5($this->input->post('senha'));
		
		$query=$this->login_model->autenticar($usuario,$senha);
		$resultado=$query->row();
		if($resultado->pessoa > 0){
			$_SESSION['user_data']['id']=$resultado->id;
			$_SESSION['user_data']['nome']=$resultado->nome;
			$_SESSION['user_data']['rg']=$resultado->rg;
			$_SESSION['user_data']['cpf']=$resultado->cpf;
			if($resultado->admin>0){
				$_SESSION['user_data']['permissoes'][]="admin";
			}
			if($resultado->aluno>0){
				$_SESSION['user_data']['permissoes'][]="aluno";
			}
			if($resultado->professor>0){
				$_SESSION['user_data']['permissoes'][]="professor";
			}
			redirect('admin', 'refresh');
		}else{
			$this->view->set_message("Login ou senha estão incorretos!","alert alert-error");
			redirect('login', 'refresh');
		}
	}
	function logout(){
		unset($_SESSION['user_data']);
		redirect('', 'refresh');
	}
}