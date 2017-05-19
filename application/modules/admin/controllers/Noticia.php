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
        $this->data['template']="noticia/noticia";
        $this->data['noticias']=$this->noticia_model->listar_noticias();
        $this->view->show_view($this->data);
    }
    
    function exibir_formulario($noticia_id=null){
    	$this->data['template']="noticia/formulario_noticia";
    	if($noticia_id==null){
    		$this->view->show_view($this->data,false);
    	}
    }
    
    public function editar_imagens(){
    	print_r($_REQUEST);
    	$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
    	$_SESSION['post']=$_POST;
    	$_SESSION['form_action']="admin/noticia/salvar_noticia";
    	
    	if(!empty($_FILES['imagens']['tmp_name'][0])){
    		echo 1;
	    	for($i=0; $i<count($_FILES['imagens']['name']); $i++) {
	    		echo $ext = pathinfo($_FILES['imagens']['name'], PATHINFO_EXTENSION);
	    		echo 2;
	    		
	    		if(in_array($ext,$ext_images)){
	    			echo 3;
	    			$temp_name = $_FILES['imagens']['tmp_name'];
	    			$temp = explode(".",$_FILES["imagens"]["name"]);
	    			$data_nome=date("m-d-Y_H-i-s")."-".$i;
	    			$name = "public/images/temp/".$data_nome.".".end($temp);
	    			$name_imagem=$data_nome.".".end($temp);
	    			$_SESSION['post']['imagem-nome']=$name_imagem;
	    			 
	    			move_uploaded_file($_FILES['imagens']['tmp_name'], $name);
	    			
	    			
	    			list($width, $height) = getimagesize($name);
	    			if($width!=800 || $height!=600){
	    				echo 4;
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
	    	}
	    	$this->data['template']='noticia/noticia-imagens';
	    	$this->view->show_view($this->data);
        }else{
           //redirect('admin/noticia/salvar_noticia','refresh');
        }
    }
    
    public function salvar_noticia(){
    	print_r($_POST);
    	PRINT_R($_SESSION['post']);
    	//$noticia = $_SESSION['post']['noticia'];
    	$noticia = $this->input->post('noticia');
    	if($noticia['id']!=''){
    		    		echo "1";
	    	if($this->noticia_model->editar($noticia, $noticia['id'])){
	    		$this->view->set_message("Mudanças salvas com sucesso", "alert alert-success");
	    		redirect('admin/noticia', 'refresh');
	    	}else{
	    		$this->view->set_message("Ocorreu um erro ao salvar mudanças", "alert alert-error");
	    		redirect('admin/noticia', 'refresh');
	    	}
    	}else{
    		echo 2;
    		$noticia['data_postagem']=date("Y-m-d");
	        $noticia['ip']=$_SERVER['REMOTE_ADDR'];
	        if($noticia_id=$this->noticia_model->postar_noticia($noticia)){
	        	echo 2.1;
	        	$this->view->set_message("Noticia adicionada com sucesso", "alert alert-success");
	            if(isset($_POST['imagem'])){
	            	echo 2.2;
	        	for($i=0; $i<count($_POST['imagem']); $i++) {
	        		echo 2.3;
	        		echo $_POST['imagem'][$i];
	        		echo " - ";
	        		echo "public/images/geral/".$_SESSION['post']['imagem-nome'];
	        		echo " - ";
	        		echo " ".$_POST['width'][$i];
	        		
	        			$this->crop->crop_image( $_POST['imagem'][$i], "public/images/geral/".$_SESSION['post']['imagem-nome'], 
	        					$_POST['width'][$i], $_POST['height'][$i],
	        					 $_POST['x'][$i], $_POST['y'][$i]);
		        		echo 2.31;
		        		$imagem = array(
		    					"nome" => $_SESSION['post']['imagem-nome'][$i],
		    					"url_imagem" => "public/images/geral/",
		        				"ip" => $_SERVER['REMOTE_ADDR']
		        				/*,
		        				"usuario_id" => $_SESSION['user_data']['id']*/
		    			);
		        		echo 2.32;
		        		$this->imagem_model->postar_imagem_noticia($imagem,$noticia_id);
		        		echo 2.33;
	                    unlink($_POST['imagem'][$i]);
	                    echo 2.34;
	        		}
	             }
	        	 //redirect('admin/noticia', 'refresh');
	        }else{
	        	$this->view->set_message("Ocorreu um erro ao adicionar noticia", "alert alert-error");
	        	//redirect('admin/noticia', 'refresh');
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