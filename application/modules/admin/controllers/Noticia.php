<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends MX_Controller {
    public function __construct(){
        parent::__construct();
        
       /* if(isset($this->user_data) ){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}*/
		
        $this->load->model('noticia_model');
        $this->load->model('imagem_model');
        date_default_timezone_set("Brazil/East");
    }

    public function index()
    {
        $this->data['title']="Cimol - Área do Administrador";
        $this->data['template']="noticia/noticia";
        $this->data['noticias']=$this->noticia_model->listar_noticias();
        $this->view->show_view($this->data);
        unset($_SESSION["post"]);
        setcookie('noticia');
    }
    
    function exibir_formulario($noticia_id=null){
    	$this->data['template']="noticia/formulario_noticia";
    	if($noticia_id==null){
    		$this->view->show_view($this->data,false);
    	}
    }
    
 	public function adicionar_imagens(){

 		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
 		if(isset($_SESSION['post'])){
 			
 			if(isset($_SESSION['post']['noticia_id'])){
 				
 				if(isset($_POST['imagem'])){
 					for($i=0;$i<count($_POST['imagem']);$i++){
	 					$nome_imagem=explode("/",$_POST['imagem'][$i]);
	 					$nome_imagem=$nome_imagem[count($nome_imagem)-1];
	 					$this->crop->crop_image( $_POST['imagem'][$i], "public/images/geral/".$nome_imagem,
	 							$_POST['width'][$i], $_POST['height'][$i],
	 							$_POST['x'][$i], $_POST['y'][$i]);
	 					$imagem = array(
	 							"nome" => $nome_imagem,
	 							"url_imagem" => "public/images/geral/",
	 							"ip" => $_SERVER['REMOTE_ADDR']
	 				
	 					);
	 					$this->imagem_model->postar_imagem_noticia($imagem,$_SESSION['post']['noticia_id']);
	 					unlink($_POST['imagem'][$i]);
 					}
 				}
 				
 			}else{
 				return;
 			}
 			//unset($_SESSION['post']);
 		}else{
 			if(isset($_POST['noticia_id'])){
    			$_SESSION['post']=$_POST;
    			$_SESSION['form_action']="admin/noticia/adicionar_imagens/";
    			$files=$_FILES['imagens'];
    			$this->editar_imagens($files);
    		
    		}
 		}
 		redirect('admin/noticia', 'refresh');
 	}
    
    
   
 	public function editar_imagens($files=null){
 		
 		$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
 		print_r($files);
 		if(isset($files['tmp_name']['imagem']) and !empty($files['tmp_name']['imagem'])){
 			$ext = pathinfo($files['name']['imagem'], PATHINFO_EXTENSION);
 			if(in_array($ext,$ext_images)){
 				$temp_name = $files['tmp_name']["imagem"];
 				$temp = explode(".",$files['name']['imagem']);
 				$data_nome=date("m-d-Y_H-i-s");
 				$name = "public/images/temp/".$data_nome.".".end($temp);
 				//$name_imagem=$data_nome.".".end($temp);
 				//$_SESSION['post']['imagem-nome']=$name_imagem;
 				echo
 				move_uploaded_file($files['tmp_name']['imagem'], $name);
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
 				$this->data['imagens'][]=$name;
 			}
 		}else if (isset($files['tmp_name'][0]) and !empty($files['tmp_name'][0])) {
 			for($i=0; $i<count($files['name']); $i++) {
 				$ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
 				if(in_array($ext,$ext_images)){
 					$temp_name = $files['tmp_name'][$i];
 					$temp = explode(".",$files['name'][$i]);
 					$data_nome=date("m-d-Y_H-i-s");
 					$name = "public/images/temp/".$data_nome.".".end($temp);
 					move_uploaded_file($files['tmp_name'][$i], $name);
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
 			//Nenhuma mensagem a ser editada
 			return;
 		}
 		$this->data['template']='imagem/crop-imagens';
 		$this->view->show_view($this->data);
 		
 	}
 	
 	public function salvar_noticia(){
 		if(isset($_POST['noticia'])){
 			if(isset($_FILES['noticia'])){
 				if(is_array($_FILES['noticia'])){
	 				$noticia=$_POST['noticia'];
	 				$noticia['data_postagem']=date('Y-m-d');
	 				
	 				$upload_dir = "public/images/noticias/";
	 				
	 				
	 				$temp_name = $_FILES['noticia']['tmp_name']["imagem"];
	 				
	 				/*Obtem dados da imagem*/
	 				list($width, $height, $type, $attr) = getimagesize($temp_name);
	 				
	 				
	 				
	 				
	 				$temp = explode(".",$_FILES['noticia']['name']['imagem']);
	 				$data_nome=date("m-d-Y_H-i-s");
	 				$nome_imagem = $data_nome.".".end($temp);
	 				$upload_file = $upload_dir.$nome_imagem;
	 				
	 				if(!($width==800 and $height==600)){
	 					$upload_file_tmp = "public/images/temp/".$nome_imagem;
	 					if(move_uploaded_file($_FILES['noticia']['tmp_name']['imagem'],$upload_file_tmp)){
	 						
	 					}
	 						
	 				}
	 				
	 				if(!move_uploaded_file($_FILES['noticia']['tmp_name']['imagem'],$upload_file)){
	 				//Mensagem de erro
	 					echo "erro imagem";
	 					$noticia['arquivo_imagem']=null;
	 					$noticia['url_imagem']=null;
	 						
	 				}else{
	 					
	 					$noticia['arquivo_imagem']=$nome_imagem;
	 					$noticia['url_imagem']=$upload_dir;
	 				}
 				}else{
 					$noticia['arquivo_imagem']=null;
 					$noticia['url_imagem']=null;
 				}
 			}else{
 				$noticia['arquivo_imagem']=null;
 				$noticia['url_imagem']=null;
 			}
 			
 			
 				
 			if($noticia_id=$this->noticia_model->postar_noticia($noticia)){
 				$this->view->set_message("Noticia adicionada com sucesso", "alert alert-success");
 			}else{
 				$this->view->set_message("Falha a salvar notícia", "alert alert-error");
 			}
 				
 			
 		}
 		//redirect('admin/noticia', 'refresh');
 	}
   
    public function _salvar_noticia(){
    	//if(isset($_SESSION['post']['noticia'])){
    	//print_r($_POST['noticia']);
    	//print_r(unserialize($_COOKIE['noticia']));
    	if(isset($_COOKIE['noticia']) and isset($_POST["crop"])){
    		//$noticia = $_SESSION['post']['noticia'];
    		$noticia =unserialize($_COOKIE['noticia']);
    		print_r($noticia);
    		if(isset($noticia['feed'])){
    			$noticia['feed']="on";
    		}else{
    			$noticia['feed']="off";
    		}
	    	//print_r($noticia);
	    	if($noticia['id']!=''){
	    		if($this->noticia_model->editar($noticia, $noticia['id'])){
		    		$this->view->set_message("Mudanças salvas com sucesso", "alert alert-success");
		    		redirect('admin/noticia', 'refresh');
		    	}else{
		    		$this->view->set_message("Ocorreu um erro ao salvar mudanças", "alert alert-error");
		    		redirect('admin/noticia', 'refresh');
		    	}
	    	}else{
	    		$noticia['data_postagem']=date("Y-m-d");
		        $noticia['ip']=$_SERVER['REMOTE_ADDR'];
		        
		        if(isset($_POST['imagem'][0])){
		        	$nome_imagem=explode("/",$_POST['imagem'][0]);
		        	$nome_imagem=$nome_imagem[count($nome_imagem)-1];
		        	$this->crop->crop_image( $_POST['imagem'][0], "public/images/geral/".$nome_imagem,
		        			$_POST['width'][0], $_POST['height'][0],
		        			$_POST['x'][0], $_POST['y'][0]);
		        	$noticia['arquivo_imagem']=$nome_imagem;
		        	$noticia['url_imagem']="public/images/geral/";
		        			        
		        }
		        if($noticia_id=$this->noticia_model->postar_noticia($noticia)){
		        	$this->view->set_message("Noticia adicionada com sucesso", "alert alert-success");
		        	/*if(isset($_POST['imagem'][0])){
		            	
		        		$imagem = array(
		    					"nome" => $nome_imagem,
		    					"url_imagem" => "public/images/geral/",
		        				"ip" => $_SERVER['REMOTE_ADDR']
		        				
		    			);
		        		$this->imagem_model->postar_imagem_noticia($imagem,$noticia_id);
		        		unlink($_POST['imagem'][0]);
	                   
		             }*/
		        	redirect('admin/noticia', 'refresh');
		        }else{
		        	$this->view->set_message("Ocorreu um erro ao adicionar noticia", "alert alert-error");
		        	redirect('admin/noticia', 'refresh');
		        }
	    	}
	    	//unset($_SESSION["post"]);
	    	setcookie('noticia');
	    	
    	}else{
    		//print_r($_POST['noticia']);
    		if(isset($_POST['noticia'])){
    			
    			setcookie("noticia",serialize($_POST["noticia"]), time() + 180);
    			$_SESSION['post']=$_POST;
    			$_SESSION['form_action']="admin/noticia/salvar_noticia";
    			setcookie("form_action", "admin/noticia/salvar_noticia", time() + 180);
    			$files=$_FILES['noticia'];
    			$this->editar_imagens($files);
    		
    		}
    	}     
    }
    
    public function deletar_noticia($id){
        if($this->noticia_model->deletar_noticia($id)){
        	$this->view->set_message("Noticia deletada com sucesso", "alert alert-success");
    		redirect('admin/noticia', 'refresh');
    	}else{
    		$this->view->set_message("Ocorreu um erro ao deletar noticia", "alert alert-error");
    		redirect('admin/noticia', 'refresh');
    	}
    }
    
    public function buscar_noticia($id){
        $noticia=$this->noticia_model->buscar_noticia($id);
        $imagens=$this->imagem_model->buscar_imagens($id);
        $resultado=array_merge($noticia, $imagens);
		echo json_encode($resultado);
    }
    
    public function excluir_imagem_noticia($imagem_id, $noticia_id){
    	$this->noticia_model->deletar_imagem_noticia($imagem_id, $noticia_id);
    }
    
    /*public function editar_noticia($id){
    	$noticia = $this->input->post('noticia');
    	if($this->noticia_model->editar($noticia, $id)){
    		$this->view->set_message("Mudanças salvas com sucesso", "alert alert-success");
    		redirect('admin/noticia', 'refresh');
    	}else{
    		$this->view->set_message("Ocorreu um erro ao salvar mudanças", "alert alert-error");
    		redirect('admin/noticia', 'refresh');
    	}
    }
    */
}		