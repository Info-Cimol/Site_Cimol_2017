<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arquivo extends MX_Controller {
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('arquivo_model');
                date_default_timezone_set("Brazil/East");
	}
	
	
	public function index()
    {
        $this->data['title']="Cimol - Área do Administrador";
        $this->data['template']="arquivo/arquivo";
        $this->data['arquivos']=$this->arquivo_model->listar_arquivos();
        $this->view->show_view($this->data);
    }
    
    
    public function buscar_arquivo($id){
    	$this->data['template']="arquivo/ver";
    	$this->data['arquivo']=$this->arquivo_model->buscar_arquivo($id);
    	$this->view->show_view($this->data);
    }
    
    
    
    
    function excluir($id){
    	
    	if($this->arquivo_model->excluir($id)){
    		$this->view->set_message("Aquivo carregado com sucesso!", "alert alert-succes");
    		redirect('admin/arquivo','refresh');
    	}else{
    		$this->view->set_message("Erro ao excluir arquivo", "alert alert-error");
    		redirect('admin/arquivo','refresh');
        }
    }
}				