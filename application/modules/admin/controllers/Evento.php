<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evento extends MX_Controller {
	
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				$_SESSION['route']="admin/evento";
				redirect('', 'refresh');
			}
		}else{
			$_SESSION['route']="admin/evento";
			redirect('login', 'refresh');
		}
		$this->load->model('evento_model');
		$this->load->model('imagem_model');
		$this->load->model('curso_model');
        date_default_timezone_set("Brazil/East");
        $this->data['title']="Cimol - Área do Administrador";
	}
	
	public function index()
	{
		$this->data['template']="evento/evento";
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
	
	function buscar_edicoes($evento_id,$id=null){
		$edicao_evento=$this->evento_model->listarEdicoesEvento($evento_id,$id);
		
		echo json_encode($edicao_evento);
	}
	
	function listar_imagens_edicao($id=null){
		$imagens_edicao=$this->evento_model->listarImagensEdicao($id);
	
		echo json_encode($imagens_edicao);
	}
	
	
	function salvar_imagens_edicao($id=null){
		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
			
		if(!isset($_POST['crop'])){
			
			$_SESSION['post']=$_POST;
			$_SESSION['form_action']="admin/evento/salvar_imagens_edicao";
			
			
			//if(!empty($_FILES['imagens']['tmp_name'])){
				for($i=0; $i<count($_FILES['imagens']['name']); $i++) {
					$ext = pathinfo($_FILES['imagens']['name'][$i], PATHINFO_EXTENSION);
					if(in_array($ext,$ext_images)){
						$temp_name = $_FILES['imagens']['tmp_name'][$i];
						$temp = explode(".",$_FILES['imagens']["name"][$i]);
						$data_nome=date("m-d-Y_H-i-s")."-".$i;
						//echo "<br/>".$data_nome;
						$name = "public/images/temp/".$data_nome.".".end($temp);
						//echo "<br/>".$name;
						$name_imagem=$data_nome.".".end($temp);
						//echo "<br/>".$name_imagem;
						$_SESSION['post']['imagem-nome'][$i]=$name_imagem;
						//echo "<br/>".$_SESSION['post']['imagem-nome'][$i];
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
			//}
			$this->data['template']='imagem/crop-imagens';
			$this->view->show_view($this->data);
		}else{
			
			$imagens=$_POST['imagem'];	
			for($i=0; $i<count($imagens);$i++){		
				$this->crop->crop_image( $_POST['imagem'][$i], "public/images/geral/".$_SESSION['post']['imagem-nome'][$i], $_POST['width'][$i], $_POST['height'][$i], $_POST['x'][$i], $_POST['y'][$i]);
				$imagem['nome']=$_SESSION['post']['imagem-nome'][$i];
				$imagem['url_imagem']="public/images/geral/";
				print_r($imagem);
				$imagem_edicao['edicao_evento_id']=$_SESSION['post']['edicao_evento_id'];
				$imagem_edicao['imagem_id']= $this->imagem_model->postar_imagem($imagem);
				
				if($evento_id=$this->evento_model->postarImagemEdicao($imagem_edicao)){
				  	$this->view->set_message("Evento adicionado com sucesso", "alert alert-success");
		          	
					//redirect('admin/evento', 'refresh');
				}else{
					$this->view->set_message("Ocorreu um erro ao adicionar evento", "alert alert-error");
					//redirect('admin/evento', 'refresh');
				}
			}
			redirect('admin/evento/edicoes/'.$_SESSION['post']['evento_id'], 'refresh');
		}
		
	}
	
	public function excluir_imagem_edicao($imagem_id, $edicao_id,$evento_id){
		$this->evento_model->deletarImagemEdicaoEvento($imagem_id,$edicao_id);
	}
	
	
	public function buscar_curso_evento($id){
		$cursos=$this->evento_model->buscar_curso_evento($id);
		echo json_encode($cursos);
	}
	
	public function deletar_evento($id){
		if($this->evento_model->deletar_evento($id)){
			$this->view->set_message("Evento deletado com sucesso", "alert alert-success");
			
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar evento", "alert alert-error");
			
		}
		redirect('admin/evento', 'refresh');
	}
	
	public function deletar_edicao($evento_id,$id){
		if($this->evento_model->deletar_edicao_evento($id)){
			$this->view->set_message("Edição do evento deletado com sucesso", "alert alert-success");
			
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar edição do evento", "alert alert-error");
			
		}
		redirect('admin/evento/edicoes/'.$evento_id, 'refresh');
	}
	
	public function buscar_evento($id){
		$evento=$this->evento_model->buscar_evento($id);
		//$imagens=$this->imagem_model->buscar_imagens_evento($id);
		//$resultado=array_merge($evento, $imagens);
		echo json_encode($evento);
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
	/*
	public function excluir_imagem_evento($imagem_id, $evento_id){
		$this->evento_model->deletar_imagem_evento($imagem_id, $evento_id);
	}
	*/
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
		$this->data['template']='evento/noticia-imagens';
		$this->view->show_view($this->data);
	}
	
	public function salvar_evento(){
		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
			
		if(!isset($_POST['crop'])){
			
			$_SESSION['post']=$_POST;
			$_SESSION['form_action']="admin/evento/salvar_evento";
			//print_r($_FILES);
			//print_r($_SESSION['post']);
			print($_FILES['evento']['tmp_name']['imagem']);
			if(!empty($_FILES['evento']['tmp_name']['imagem'])){
				
				$ext = pathinfo($_FILES['evento']['name']['imagem'], PATHINFO_EXTENSION);
				if(in_array($ext,$ext_images)){
					
					$temp_name = $_FILES['evento']['tmp_name']['imagem'];
					$temp = explode(".",$_FILES['evento']["name"]['imagem']);
					print_r($temp);
					$data_nome=date("m-d-Y_H-i-s");
					//echo "<br/>".$data_nome;
					$name = "public/images/temp/".$data_nome.".".end($temp);
					//echo "<br/>".$name;
					$name_imagem=$data_nome.".".end($temp);
					//echo "<br/>".$name_imagem;
					$_SESSION['post']['imagem-nome']=$name_imagem;
					//echo "<br/>".$_SESSION['post']['imagem-nome'];
					move_uploaded_file($_FILES['evento']['tmp_name']['imagem'], $name);
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
					$this->data['imagens'][0]=$name;
					$this->data['template']='imagem/crop-imagens';
					$this->view->show_view($this->data);
				}
			}
		}else{
			
			$evento = $_SESSION['post']['evento'];
			//$cursos=$evento['cursos'];
			//unset($evento['cursos']);
			//print_r($evento);
			//$evento['ip']=$_SERVER['REMOTE_ADDR'];
			/*date_default_timezone_set("Brazil/East");
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
				$data=explode('/',$_POST['evento']['data']);
				$_POST['evento']['data']=$data[2]."-".$data[1]."-".$data[0];
			}
			*/
			
			//print_r($_SESSION['post']);
			$this->crop->crop_image( $_POST['imagem'][0], "public/images/geral/".$_SESSION['post']['imagem-nome'], $_POST['width'][0], $_POST['height'][0], $_POST['x'][0], $_POST['y'][0]);
			$imagem['nome']=$_SESSION['post']['imagem-nome'];
			$imagem['url_imagem']="public/images/geral/";
			print_r($imagem);
			$evento['imagem_id']= $this->imagem_model->postar_imagem($imagem);
			
			if($evento_id=$this->evento_model->postar_evento($evento)){
			  	$this->view->set_message("Evento adicionado com sucesso", "alert alert-success");
	          	/*	                
				foreach($cursos as $curso){
					$this->curso_model->postar_curso_evento($curso, $evento_id);
				}
				
				*/
				redirect('admin/evento', 'refresh');
			}else{
				$this->view->set_message("Ocorreu um erro ao adicionar evento", "alert alert-error");
				redirect('admin/evento', 'refresh');
			}
		}
	}
	
	function edicoes($evento_id){
		echo $evento_id;
		$this->data['template']="evento/edicoes_evento";
		$this->data['edicoes_evento']=$this->evento_model->listarEdicoesEvento($evento_id);
		$this->data['evento_id']=$evento_id;
		$this->view->show_view($this->data);
	}
	
	function paineis_edicao($evento_id,$edicao_id,$titulo_evento,$titulo_edicao){
	   /* echo $evento_id."<br/>";
	    echo $edicao_id."<br/>";
	   */
		$this->data['template']="evento/paineis_edicao";
		$this->data['paineis_edicao']=$this->evento_model->listarPaineisEdicao($evento_id,$edicao_id);
		//print_r($this->data['paineis_edicao']);
		$this->data['evento_id']=$evento_id;
		$this->data['edicao_id']=$edicao_id;
		$this->data['titulo_edicao']=$titulo_edicao;
		$this->data['titulo_evento']=$titulo_evento;
		$this->view->show_view($this->data);
	}
	
	function salvar_edicao(){
		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
			
		if(!isset($_POST['crop'])){
			date_default_timezone_set("Brazil/East");
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
				$data=explode('/',$_POST['edicao_evento']['data_inicial']);
				$_POST['edicao_evento']['data_inicial']=$data[2]."-".$data[1]."-".$data[0];
				$data=explode('/',$_POST['edicao_evento']['data_final']);
				$_POST['edicao_evento']['data_final']=$data[2]."-".$data[1]."-".$data[0];
			}	
			$_SESSION['post']=$_POST;
			$_SESSION['form_action']="admin/evento/salvar_edicao";
			
			if(!empty($_FILES['edicao_evento']['tmp_name']['imagem'])){
		
				$ext = pathinfo($_FILES['edicao_evento']['name']['imagem'], PATHINFO_EXTENSION);
				if(in_array($ext,$ext_images)){
						
					$temp_name = $_FILES['edicao_evento']['tmp_name']['imagem'];
					$temp = explode(".",$_FILES['edicao_evento']["name"]['imagem']);
					$data_nome=date("m-d-Y_H-i-s");
					$name = "public/images/temp/".$data_nome.".".end($temp);
					$name_imagem=$data_nome.".".end($temp);
					$_SESSION['post']['imagem-nome']=$name_imagem;
					move_uploaded_file($_FILES['edicao_evento']['tmp_name']['imagem'], $name);
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
					$this->data['imagens'][0]=$name;
					$this->data['template']='imagem/crop-imagens';
					$this->view->show_view($this->data);
				}
			}
		}else{
				
			$edicao_evento = $_SESSION['post']['edicao_evento'];
			
			$this->crop->crop_image( $_POST['imagem'][0], "public/images/geral/".$_SESSION['post']['imagem-nome'], $_POST['width'][0], $_POST['height'][0], $_POST['x'][0], $_POST['y'][0]);
			$imagem['nome']=$_SESSION['post']['imagem-nome'];
			$imagem['url_imagem']="public/images/geral/";
			$edicao_evento['imagem_id']= $this->imagem_model->postar_imagem($imagem);
			if($this->evento_model->postarEdicaoEvento($edicao_evento)){
			  	$this->view->set_message("Evento adicionado com sucesso", "alert alert-success");
	        }else{
				$this->view->set_message("Ocorreu um erro ao adicionar evento", "alert alert-error");
				
			}
			redirect('admin/evento/edicoes/'.$edicao_evento['evento_id'], 'refresh');
		}
	}
	
	function salvar_painel_edicao(){
		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
		print_r($_POST);	
		if(!isset($_POST['crop'])){
			//echo 1;
			date_default_timezone_set("Brazil/East");
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
				$data=explode('/',$_POST['painel_edicao_evento']['data']);
				$_POST['painel_edicao_evento']['data']=$data[2]."-".$data[1]."-".$data[0];
				
			}
			//echo 2;
			$_SESSION['post']=$_POST;
			$_SESSION['form_action']="admin/evento/salvar_painel_edicao";
			//echo 3;
			if(!empty($_FILES['painel_edicao_evento']['tmp_name']['imagem'])){
				echo 4;
				$ext = pathinfo($_FILES['painel_edicao_evento']['name']['imagem'], PATHINFO_EXTENSION);
				if(in_array($ext,$ext_images)){
					echo 5;
					$temp_name = $_FILES['painel_edicao_evento']['tmp_name']['imagem'];
					$temp = explode(".",$_FILES['painel_edicao_evento']["name"]['imagem']);
					$data_nome=date("m-d-Y_H-i-s");
					$name = "public/images/temp/".$data_nome.".".end($temp);
					$name_imagem=$data_nome.".".end($temp);
					$_SESSION['post']['imagem-nome']=$name_imagem;
					move_uploaded_file($_FILES['painel_edicao_evento']['tmp_name']['imagem'], $name);
					list($width, $height) = getimagesize($name);
					if($width!=800 || $height!=600){
						echo 6;
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
					$this->data['imagens'][0]=$name;
					$this->data['template']='imagem/crop-imagens';
					$this->view->show_view($this->data);
				}
			}
		}else{
			$painel_edicao_evento = $_SESSION['post']['painel_edicao_evento'];
				
			$this->crop->crop_image( $_POST['imagem'][0], "public/images/geral/".$_SESSION['post']['imagem-nome'], $_POST['width'][0], $_POST['height'][0], $_POST['x'][0], $_POST['y'][0]);
			$imagem['nome']=$_SESSION['post']['imagem-nome'];
			$imagem['url_imagem']="public/images/geral/";
			$painel_edicao_evento['imagem_id']= $this->imagem_model->postar_imagem($imagem);
			if($this->evento_model->salvarPainelEdicaoEvento($painel_edicao_evento)){
				$this->view->set_message("Evento adicionado com sucesso", "alert alert-success");
			}else{
				$this->view->set_message("Ocorreu um erro ao adicionar painel", "alert alert-error");
			}
			redirect('admin/evento/paineis_edicao/'.$painel_edicao_evento['evento_id'].'/'.$painel_edicao_evento['edicao_id'], 'refresh');
		}
	}
}	