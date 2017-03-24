<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evento extends MX_Controller {
	
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('evento_model');
		$this->load->model('imagem_model');
		$this->load->model('curso_model');
                date_default_timezone_set("Brazil/East");
	}
	
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="evento";
		$this->data['eventos']=$this->evento_model->listar_eventos();
		$this->data['cursos']=$this->curso_model->listar();
		$this->view->show_view($this->data);
	}
	
	public function buscar_evento_editar($id){
		$evento=$this->evento_model->buscar_evento($id);
		$cursos=$this->curso_model->listar();
		$resultado=array_merge($evento, $cursos);
		echo json_encode($resultado);
	}
	
	public function buscar_curso_evento($id){
		$cursos=$this->evento_model->buscar_curso_evento($id);
		echo json_encode($cursos);
	}
	
	public function deletar_evento($id){
		if($this->evento_model->deletar_evento($id)){
			$this->view->set_message("Evento deletado com sucesso", "alert alert-success");
			redirect('admin/evento', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar evento", "alert alert-error");
			redirect('admin/evento', 'refresh');
		}
	}
	
	public function buscar_evento($id){
		$evento=$this->evento_model->buscar_evento($id);
		$imagens=$this->imagem_model->buscar_imagens_evento($id);
		$resultado=array_merge($evento, $imagens);
		echo json_encode($resultado);
	}
	
	public function editar_evento($id){
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
			$data=explode('/',$_POST['evento']['data']);
			$_POST['evento']['data']=$data[2]."-".$data[1]."-".$data[0];
		}
		$evento = $this->input->post('evento');
		$cursos_salvos = $this->evento_model->buscar_curso_evento($id);
		$cursos = $this->input->post('cursos');
		if($this->evento_model->editar($evento, $cursos_salvos, $cursos, $id)){
			$this->view->set_message("Mudanças salvas com sucesso", "alert alert-success");
			redirect('admin/evento', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao salvar evento", "alert alert-error");
			redirect('admin/evento', 'refresh');
		}
	
	}
	public function excluir_imagem_evento($imagem_id, $evento_id){
		$this->evento_model->deletar_imagem_evento($imagem_id, $evento_id);
	}
	
	public function editar_imagens(){
		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
		$_SESSION['post']=$_POST;
		$_SESSION['form_action']="admin/evento/salvar_evento";
                if(!empty($_FILES['imagens']['tmp_name'][0])){
		for($i=0; $i<count($_FILES['imagens']['name']); $i++) {
			$ext = pathinfo($_FILES['imagens']['name'][$i], PATHINFO_EXTENSION);
			if(in_array($ext,$ext_images)){
				$temp_name = $_FILES['imagens']['tmp_name'][$i];
				$temp = explode(".",$_FILES["imagens"]["name"][$i]);
				$data_nome=date("m-d-Y_H-i-s")."-".$i;
				$name = "public/images/temp/".$data_nome.".".end($temp);
				$name_imagem=$data_nome.".".end($temp);
				$_SESSION['post']['imagem-nome'][$i]=$name_imagem;
				move_uploaded_file($_FILES['imagens']['tmp_name'][$i], $name);
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
				$this->data['imagens'][$i]=$name;
			}
		}
                }else{
                       redirect('admin/evento/salvar_evento', 'refresh');
                }
		$this->data['template']='noticia-imagens';
		$this->view->show_view($this->data);
	}
	
	public function salvar_evento(){
		$evento = $_SESSION['post']['evento'];
		$evento['ip']=$_SERVER['REMOTE_ADDR'];
		$evento['usuario_id']=$_SESSION['user_data']['id'];
		$ext_images=array('jpg', 'jpeg', 'png', 'gif', 'bmp');
		date_default_timezone_set("Brazil/East");
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
			$data=explode('/',$_POST['evento']['data']);
			$_POST['evento']['data']=$data[2]."-".$data[1]."-".$data[0];
		}
		$evento['data_registro']=date("Y-m-d");
		if($evento_id=$this->evento_model->postar_evento($evento)){
			$this->view->set_message("Evento adicionado com sucesso", "alert alert-success");
                if(isset($_POST['imagem'])){
        	for($i=0; $i<count($_POST['imagem']); $i++) {
        			$this->crop->crop_image( $_POST['imagem'][$i], "public/images/geral/".$_SESSION['post']['imagem-nome'][$i], $_POST['width'][$i], $_POST['height'][$i], $_POST['x'][$i], $_POST['y'][$i]);
	        		$imagem = array(
	    					"nome" => $_SESSION['post']['imagem-nome'][$i],
	    					"url_imagem" => "public/images/geral/",
	        				"ip" => $_SERVER['REMOTE_ADDR'],
	        				"usuario_id" => $_SESSION['user_data']['id']
	    			);
	        		$this->imagem_model->postar_imagem_evento($imagem,$evento_id);
                                unlink($_POST['imagem'][$i]);
			}
                }
			foreach($_SESSION['post']['cursos'] as $curso){
				$this->curso_model->postar_curso_evento($curso, $evento_id);
			}
			redirect('admin/evento', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao adicionar evento", "alert alert-error");
			redirect('admin/evento', 'refresh');
		}
	}
}	