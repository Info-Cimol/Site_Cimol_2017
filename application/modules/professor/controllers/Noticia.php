<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends MX_Controller {
    public function __construct(){
        parent::__construct();
        if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
        $this->load->model('noticia_model');
        $this->load->model('imagem_model');
        date_default_timezone_set("Brazil/East");
    }
    public function index()
    {
        $this->data['title']="Cimol - Área do Administrador";
        $this->data['template']="noticia";
        $this->data['noticias']=$this->noticia_model->listar_noticias();
        $this->view->show_view($this->data);
    }
    
    public function editar_imagens(){
    	$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
    	$_SESSION['post']=$_POST;
    	$_SESSION['form_action']="admin/noticia/salvar_noticia";
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
    	$this->data['template']='noticia-imagens';
    	$this->view->show_view($this->data);
        }else{
            redirect('admin/noticia/salvar_noticia','refresh');
        }
    }
    
    public function salvar_noticia(){
        $noticia = $_SESSION['post']['noticia'];
        $noticia['data_postagem']=date("Y-m-d");
        $noticia['ip']=$_SERVER['REMOTE_ADDR'];
        $noticia['usuario_id']=$_SESSION['user_data']['id'];
        if($noticia_id=$this->noticia_model->postar_noticia($noticia)){
        	$this->view->set_message("Noticia adicionada com sucesso", "alert alert-success");
            if(isset($_POST['imagem'])){
        	for($i=0; $i<count($_POST['imagem']); $i++) {
        			$this->crop->crop_image( $_POST['imagem'][$i], "public/images/geral/".$_SESSION['post']['imagem-nome'][$i], $_POST['width'][$i], $_POST['height'][$i], $_POST['x'][$i], $_POST['y'][$i]);
	        		$imagem = array(
	    					"nome" => $_SESSION['post']['imagem-nome'][$i],
	    					"url_imagem" => "public/images/geral/",
	        				"ip" => $_SERVER['REMOTE_ADDR'],
	        				"usuario_id" => $_SESSION['user_data']['id']
	    			);
	        		$this->imagem_model->postar_imagem_noticia($imagem,$noticia_id);
                                unlink($_POST['imagem'][$i]);
        		}
                }
        	redirect('admin/noticia', 'refresh');
        }else{
        	$this->view->set_message("Ocorreu um erro ao adicionar noticia", "alert alert-error");
        	redirect('admin/noticia', 'refresh');
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
    
    public function editar_noticia($id){
    	$noticia = $this->input->post('noticia');
    	if($this->noticia_model->editar($noticia, $id)){
    		$this->view->set_message("Mudanças salvas com sucesso", "alert alert-success");
    		redirect('admin/noticia', 'refresh');
    	}else{
    		$this->view->set_message("Ocorreu um erro ao salvar mudanças", "alert alert-error");
    		redirect('admin/noticia', 'refresh');
    	}
    }
}		