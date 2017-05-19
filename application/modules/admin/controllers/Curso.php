<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('curso_model');
		date_default_timezone_set("Brazil/East");
	}
	public function index()
	{
		$this->load->model('segmento_model');
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="curso/index";
		$this->data['cursos']=$this->curso_model->listar();
		$this->data['professores']=$this->curso_model->listar_professores();
		
		$this->view->show_view($this->data);
	}
	
	public function listar_cursos_json()
	{
		
		$cursos=$this->curso_model->listar();
		echo json_encode($cursos);
	}
	
	public function listar_segmentos_json()
	{
		$this->load->model('segmento_model');
		$segmentos=$this->segmento_model->listar();
		echo json_encode($segmentos);
	}
	
	public function buscar_info_periodos_curso_json($curso_id,$segmento_id)
	{
		$this->load->model('segmento_model');
		$info=$this->segmento_model->buscar_info_segmento_curso($curso_id,$segmento_id);
		echo json_encode($info);
	}
	
	public function listar_segmentos_curso_json($curso_id)
	{
		$this->load->model('segmento_model');
		$segmentos=$this->curso_model->listar_segmentos($curso_id);
		echo json_encode($segmentos);
	}
	
	public function listar_alunos_curso_json($curso_id,$periodo=null){
		$alunos=$this->curso_model->listar_alunos_curso($curso_id,$periodo);
		echo json_encode($alunos);
	}
	
	public function buscar_curso($id){
		$curso=$this->curso_model->buscar_curso($id);
		//print_r($curso);
		//$professores=$this->curso_model->buscar_professores();
		//$curso[0]->segmentos=$this->curso_model->buscar_segmento_curso($id);
		$resultado['curso']=$curso[0];
		//$resultado['professores']=$professores;
		
		//print_r($segmentos);
		//$resultado=array_merge($curso, $professores);
		echo json_encode($resultado);
	}
	
	public function buscar_curso_editar($id){
		$this->load->model('segmento_model');
		$curso=$this->curso_model->buscar_curso($id);
		//print_r($curso);
		$professores=$this->curso_model->buscar_professores();
		$curso[0]->segmentos=$this->curso_model->buscar_segmento_curso($id);
		$resultado['curso']=$curso[0];
		$resultado['professores']=$professores;
		$resultado['segmentos']=$this->segmento_model->listar();
	
		//print_r($segmentos);
		//$resultado=array_merge($curso, $professores);
		echo json_encode($resultado);
	}
	
	public function listar_Professores(){
		$professores=$this->curso_model->buscar_professores();
		
		echo json_encode($professores);
	}
	
	public function buscar_segmento($id){
		$resultado=$this->curso_model->buscar_segmento_curso($id);
		
		echo json_encode($resultado);
	}
	public function editar_imagem($id=null){
		print_r($_REQUEST);
		/*if(!isset($_FILES['logo'])){
			$this->view->set_message("Deve ser selecionado uma imagem para o curso","alert alert-error");
			redirect("admin/curso","redirect");
		}*/
		print_r($_FILES);
		
		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
		$_SESSION['post']=$_POST;
		if($id==null){
			$_SESSION['form_action']="admin/curso/salvar_curso";
		}else{
			if(!empty($_FILES['logo']['tmp_name'])){
				$_SESSION['id']=$id;
				$_SESSION['form_action']="admin/curso/salvar_curso/".$id;
			}else{
				redirect('admin/curso/salvar_curso/'.$id);
			}
		}
		
		$ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
			if(in_array($ext,$ext_images)){
				$temp_name = $_FILES['logo']['tmp_name'];
				$temp = explode(".",$_FILES["logo"]["name"]);
				$data_nome=date("m-d-Y_H-i-s");
				$name = "public/images/temp/".$data_nome.".".end($temp);
				$name_imagem=$data_nome.".".end($temp);
				$_SESSION['post']['imagem-nome']=$name_imagem;
				move_uploaded_file($_FILES['logo']['tmp_name'], $name);
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
		$this->data['template']='curso/curso-imagens';
		
		$this->view->show_view($this->data);
	}
	
	
	public function editar_curso($id){
		print_r($_SESSION);
		$curso=$_SESSION['post']['curso'];
		$curso['ip']=$_SERVER['REMOTE_ADDR'];
		$curso['usuario_id']=$_SESSION['user_data']['id'];
		if(!empty($_POST['imagem'])){
			$this->crop->crop_image( $_POST['imagem'], "public/images/logo/".$_SESSION['post']['imagem-nome'], $_POST['width'], $_POST['height'], $_POST['x'], $_POST['y']);
			$curso['logo']="public/images/logo/".$_SESSION['post']['imagem-nome'];
           	unlink($_POST['imagem']);
			unlink($_SESSION['post']['old-logo']);
		}
		
		if($this->curso_model->salvar_curso($curso, $id)){
			if($_SESSION['post']['old-coordenador']!=$_SESSION['post']['coordenador_curso']){
				$coordenador_curso = array(
						"professor_id"=> $_SESSION['post']['coordenador_curso'],
						"curso_id" => $id,
						"data_inicio" => date("Y-m-d")
				);
				$old_coordenador = array(
						"data_fim" => date("Y-m-d"),
						"status" => "inativo"
				);
				$this->curso_model->salvar_coordenador($old_coordenador, $id, $_SESSION['post']['old-coordenador']);
				if($this->curso_model->salvar_coordenador($coordenador_curso)){
					$this->view->set_message("Curso salvo com sucesso", "alert alert-success");
					redirect("admin/curso","redirect");
				}else{
					$this->view->set_message("Erro ao salvar curso","alert alert-error");
					redirect("admin/curso","redirect");
				}
			}else{
				$this->view->set_message("Curso salvo com sucesso", "alert alert-success");
				redirect("admin/curso","redirect");
			}
		}else{
			$this->view->set_message("Erro ao salvar curso","alert alert-error");
			redirect("admin/curso","redirect");
		}
	}
	
	public function salvar_curso(){
			$curso= $_SESSION['post']['curso'];
			$curso['ip']=$_SERVER['REMOTE_ADDR'];
			$curso['usuario_id']=$_SESSION['user_data']['id'];
			if(isset($_POST['imagem'])){
				$this->crop->crop_image( $_POST['imagem'], "public/images/logo/".$_SESSION['post']['imagem-nome'], $_POST['width'], $_POST['height'], $_POST['x'], $_POST['y']);
				$curso['logo']="public/images/logo/".$_SESSION['post']['imagem-nome'];
			}
			//print_r($curso);
			//echo "<br/>";
			$segmentos=$curso['segmentos'];
			unset($curso['segmentos']);
			//$periodos=$curso['num_periodos'];
			//unset($curso['num_periodos']);
			//echo "------------ <br/>";
			//print_r($curso);
			//echo "<br/>";
			if($curso_id=$this->curso_model->salvar_curso($curso)){
				$i=0;
				
				for($i=0;$i<count($segmentos['segmento_id']);$i++){
					$this->curso_model->salvar_segmento_curso($curso_id, $segmentos['segmento_id'][$i],$segmentos['num_periodos'][$i]);
					$i++;
				}
				$coordenador_curso = array(
						"professor_id"=> $_SESSION['post']['coordenador_curso'],
						"curso_id" => $curso_id,
						"data_inicio" => date("Y-m-d")
				);
				if($this->curso_model->salvar_coordenador($coordenador_curso)){
					$this->view->set_message("Curso salvo com sucesso", "alert alert-success");
					//redirect("admin/curso","redirect");
				}else{
					$this->view->set_message("Erro ao salvar curso","alert alert-error");
					//redirect("admin/curso","redirect");
				}
			}else{
				$this->view->set_message("Erro ao salvar curso","alert alert-error");
				//redirect("admin/curso","redirect");
			}
			redirect("admin/curso","redirect");
		}
		public function deletar_curso($id){
			if($this->curso_model->deletar_curso($id)){
				$this->view->set_message("Curso deletado com sucesso", "alert alert-success");
				redirect('admin/curso', 'refresh');
			}else{
				$this->view->set_message("Ocorreu um erro ao deletar curso", "alert alert-error");
				redirect('admin/curso', 'refresh');
			}
		}
}