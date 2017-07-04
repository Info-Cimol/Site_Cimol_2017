<?php
class Evento extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('evento_model');
		$this->load->model('imagem_model');
	}
	
	public function index(){
		$this->data['title']="Cimol - Eventos";
		$this->data['eventos']=$this->evento_model->listar_eventos();
		/*foreach($this->data['eventos'] as $evento){
			$this->data['imagens_evento'][]=$this->imagem_model->listar_imagem_evento($evento->id);
		}
		*/
		$this->data['content']="evento/index";
		$this->view->show_view($this->data);
	}
	
	public function ver($id){
		$this->data['title']="Cimol - Eventos";
		$this->data['evento']=$this->evento_model->buscar_evento($id);
		$this->data['edicoes']=$this->evento_model->listarEdicoesEvento($id);
		$this->data['content']="evento/ver_evento";
		$this->view->show_view($this->data);
	}
	
}