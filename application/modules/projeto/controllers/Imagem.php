<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagem extends MX_Controller {
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
        $this->data['template']="imagem";
        $this->data['imagens']=$this->imagem_model->listar_todas_imagens();
        $this->view->show_view($this->data);
    }
    public function buscar_imagens($id){
    	$imagens=$this->imagem_model->buscar_imagens($id);
    	echo json_encode($imagens);
    }
    public function buscar_imagens_evento($id){
    	$imagens=$this->imagem_model->buscar_imagens_evento($id);
    	echo json_encode($imagens);
    }
    
    public function editar_imagens($id=null, $tipo=null){
    	$_SESSION['falha']=0;
    	$ext_images=array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP');
    	$_SESSION['id']=$id;
    	$_SESSION['form_action']="admin/imagem/adicionar_imagens/".$id."/".$tipo;
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
    		}else{
	    		$_SESSION['falha']++;
	    	}
    	}
    	$this->data['template']='noticia-imagens';
    	$this->view->show_view($this->data);
    }
    
    public function adicionar_imagens($id=null, $tipo=null){
    	$uploaded=0;
    	$falha=$_SESSION['falha'];
    	if(isset($_POST['imagem'])){
	    	for($i=0; $i<count($_POST['imagem']); $i++) {
	    			$this->crop->crop_image( $_POST['imagem'][$i], "public/images/geral/".$_SESSION['post']['imagem-nome'][$i], $_POST['width'][$i], $_POST['height'][$i], $_POST['x'][$i], $_POST['y'][$i]);
	    			$imagem = array(
		    				"nome" => $_SESSION['post']['imagem-nome'][$i],
		    				"url_imagem" => "public/images/geral/",
	    					"ip" => $_SERVER['REMOTE_ADDR'],
	    					"usuario_id" => $_SESSION['user_data']['id']
		    		);
	    			if($id==null){
	    				$this->imagem_model->postar_imagem($imagem);
	    			}else{
	    				if($tipo=="noticia"){
	    					$this->imagem_model->postar_imagem_noticia($imagem,$id);
	    				}else if($tipo=="evento"){
	    					$this->imagem_model->postar_imagem_evento($imagem,$id);
	    				}
	    			}
	    			$uploaded++;
                                unlink($_POST['imagem'][$i]);
	    		}
	    	if($uploaded==0){
	    		$this->view->set_message("Nenhuma imagem foi enviada", "alert alert-error");
	    	}
	    	if($uploaded==1){
	    		$this->view->set_message("Uma imagem foi enviada", "alert alert-success");
	    	}
	    	if($uploaded>1){
	    		$this->view->set_message($uploaded." imagens foram enviadas", "alert alert-success");
	    	}
	    	if($falha==1){
	    		$this->view->set_message("Uma imagem não pôde ser enviada", "alert alert-error");
	    	}
	    	if($falha>1){
	    		$this->view->set_message("Erro ao enviar ".$falha." imagens", "alert alert-error");
	    	}
                if($tipo!=null){
	    	   redirect('admin/'.$tipo, 'refresh');
                }else{
                   redirect('admin/imagem', 'refresh');
                }
    	}else{
    		$this->view->set_message("Nenhuma imagem foi enviada", "alert alert-error");
    		if($tipo!=null){
	    	   redirect('admin/'.$tipo, 'refresh');
                }else{
                   redirect('admin/imagem', 'refresh');
                }
    	}
    }
    
    function deletar_imagem($id){
    	$imagem=$this->imagem_model->buscar_imagem_join($id);
    	if($imagem[0]->noticia > 0 || $imagem[0]->evento > 0){
    		$this->view->set_message("Imagem relacionada a noticia ou evento não pode ser deletada", "alert alert-error");
    		redirect('admin/imagem','refresh');
    	}else{
    		if($this->imagem_model->deletar($id)){
    			$this->view->set_message("Imagem excluida com sucesso", "alert alert-success");
    			redirect('admin/imagem','refresh');
    			unlink($imagem[0]->url_imagem.$imagem[0]->nome);
    		}else{
    			$this->view->set_message("Erro ao deletar imagem", "alert alert-error");
    			redirect('admin/imagem','refresh');
    		}
    	}
    }
}				