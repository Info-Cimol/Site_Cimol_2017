<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('aluno_model');
		date_default_timezone_set("Brazil/East");
	}
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="aluno/index";
		$this->data['alunos']=$this->aluno_model->listar();
		$this->load->model('curso_model');
		$this->data['cursos']=$this->curso_model->listar();
		$this->data['segmentos']=$this->curso_model->listar_segmentos();
		$this->view->show_view($this->data);
	}
	public function listar_json()
	{
		
		$this->data['alunos']=$this->aluno_model->listar();
		
		echo json_encode($this->data);
	}
	
	function pesquisar_por_nome_json($parametro){
		$this->data['alunos']=$this->aluno_model->pesquisar_por_nome($parametro);
		
		echo json_encode($this->data);
	}
	
	public function buscar($id){
		$aluno=$this->aluno_model->buscar($id);
		$this->load->model('curso_model');
		//$cursos=$this->curso_model->listar();
		//$segmentos=$this->curso_model->listar_segmentos();
		//$aluno['cursos']=$cursos;
		//$aluno['segmentos_cursos']=$segmentos;
		
		echo json_encode($aluno);
	}
	
	
	public function editar_imagem($id=null){
		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
		$_SESSION['post']=$_POST;
		if($id!=null){
			if(!empty($_FILES['foto']['tmp_name'])){
				$_SESSION['id']=$id;
				$_SESSION['form_action']="admin/aluno/salvar/".$id;
			}else{
				redirect('admin/aluno/salvar/'.$id);
			}
		}else{
			$_SESSION['form_action']="admin/aluno/salvar/";
		}
		
		if(!empty($_FILES['foto']['name'])){
			
		
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
			$this->data['template']='aluno/aluno-imagens';
			$this->view->show_view($this->data);
		}else{
			$caminho=$_SESSION['form_action'];
			unset($_SESSION['form_action']);
			redirect($caminho);
		}
	}
	/*
	public function editar($id){
		//print_r($_SESSION);
		$aluno=$_SESSION['post']['aluno'];
		$aluno['ip']=$_SERVER['REMOTE_ADDR'];
		$aluno['usuario_id']=$_SESSION['user_data']['id'];
		if(!empty($_POST['foto'])){
			$this->crop->crop_image( $_POST['foto'], "public/images/logo/".$_SESSION['post']['imagem-nome'], $_POST['width'], $_POST['height'], $_POST['x'], $_POST['y']);
			$aluno['foto']="public/images/logo/".$_SESSION['post']['imagem-nome'];
           	unlink($_POST['foto']);
			
		}
		print_r($aluno);
		if($this->aluno_model->salvar($aluno, $id)){
			
				$this->view->set_message("aluno salvo com sucesso", "alert alert-success");
			
		}else{
			$this->view->set_message("Erro ao salvar aluno","alert alert-error");
			
		}
		redirect("admin/aluno","redirect");
	}
	*/
	
	public function salvar(){
		
		$aluno= $_SESSION['post']['aluno'];
		//print_r($aluno);
		$aluno['ip']=$_SERVER['REMOTE_ADDR'];
		$aluno['usuario_id']=$_SESSION['user_data']['id'];
		if(isset($_POST['foto'])){
			$this->crop->crop_image( $_POST['foto'], "public/images/logo/".$_SESSION['post']['imagem-nome'], $_POST['width'], $_POST['height'], $_POST['x'], $_POST['y']);
			$aluno['foto']="public/images/logo/".$_SESSION['post']['imagem-nome'];
		}else{
			$aluno['foto']='';
		}
		if($aluno_id=$this->aluno_model->salvar($aluno)){
			
			$this->view->set_message("Aluno salvo com sucesso!","alert alert-success");
			
		}else{
			$this->view->set_message("Erro ao salvar aluno","alert alert-error");
			
		}
		redirect("admin/aluno","redirect");
	}
		
		
		public function deletar($id){
			echo $id;
			if($this->aluno_model->deletar($id)){
				$this->view->set_message("aluno deletado com sucesso", "alert alert-success");
				redirect('admin/aluno', 'refresh');
			}else{
				$this->view->set_message("Ocorreu um erro ao deletar aluno", "alert alert-error");
				redirect('admin/aluno', 'refresh');
			}
		}
}