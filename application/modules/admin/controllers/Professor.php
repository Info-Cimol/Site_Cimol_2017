<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('professor_model');
		date_default_timezone_set("Brazil/East");
	}
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="professor/index";
		$this->data['professores']=$this->professor_model->listar();
		$this->view->show_view($this->data);
	}
	
	
	public function listar_json()
	{
		
		$this->data['professores']=$this->professor_model->listar();
		echo json_encode($this->data['professores']);
	}
	
	
	public function buscar($id){
		$professor=$this->professor_model->buscar($id);
		//$professores=$this->professor_model->buscar();
		//$resultado=array_merge($professor, $professores);
		echo json_encode($professor);
	}
	
	
	public function editar_imagem(){
		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
		$_SESSION['post']=$_POST;
		if($_POST['professor']['pessoa_id']==null){
			$_SESSION['form_action']="admin/professor/salvar";
		}else{
			if(!empty($_FILES['foto']['tmp_name'])){
				$_SESSION['pessoa_id']=$_POST['professor']['pessoa_id'];
				$_SESSION['form_action']="admin/professor/salvar/";
			}else{
				redirect('admin/professor/salvar/');
			}
		}
		$ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
			if(in_array($ext,$ext_images)){
				$temp_name = $_FILES['foto']['tmp_name'];
				$temp = explode(".",$_FILES["foto"]["name"]);
				$data_nome=date("m-d-Y_H-i-s");
				$name = "public/images/temp/".$data_nome.".".end($temp);
				$name_imagem=$data_nome.".".end($temp);
				$_SESSION['post']['imagem-nome']=$name_imagem;
				move_uploaded_file($_FILES['foto']['tmp_name'], $name);
				list($width, $height) = getimagesize($name);
				if($width!=800 || $height!=600){
					if($width<800 || $height<600 || $height>1000 || $width>1000){
						$this->crop->resize($name, $name, 1000, 1000);
					}
					list($width, $height) = getimagesize($name);
					if($height<610 || $width<810){
						$this->crop->resize($name, $name, 1200, 1200);
					}
					list($width, $height) = getimagesize($name);
					if($height<610 || $width<810){
						$this->crop->resize($name, $name, 1500, 1500);
					}
				}
				$this->data['imagem']=$name;
			}
		$this->data['template']='professor/professor-imagens';
		$this->view->show_view($this->data);
	}
	
	
	
	public function salvar(){
		
		$professor= $_SESSION['post']['professor'];
		//print_r($professor);
		$professor['ip']=$_SERVER['REMOTE_ADDR'];
		$professor['usuario_id']=$_SESSION['user_data']['id'];
		
		if(!empty($_POST['foto'])){
			$this->crop->crop_image( $_POST['foto'], "public/images/logo/".$_SESSION['post']['imagem-nome'], $_POST['width'], $_POST['height'], $_POST['x'], $_POST['y']);
			$professor['foto']="public/images/logo/".$_SESSION['post']['imagem-nome'];
           	unlink($_POST['foto']);
			
		}else{
			$professor['foto']="";
		}
		
		if($professor_id=$this->professor_model->salvar($professor)){
			
			$this->view->set_message("professor salvo com sucesso!","alert alert-success");
			
			redirect("admin/professor","redirect");
		}else{
			$this->view->set_message("Erro ao salvar professor","alert alert-error");
			
			redirect("admin/professor","redirect");
		}
	}
		
		
		public function deletar($id){
			echo $id;
			if($this->professor_model->deletar($id)){
				$this->view->set_message("professor deletado com sucesso", "alert alert-success");
				redirect('admin/professor', 'refresh');
			}else{
				$this->view->set_message("Ocorreu um erro ao deletar professor", "alert alert-error");
				redirect('admin/professor', 'refresh');
			}
		}
}