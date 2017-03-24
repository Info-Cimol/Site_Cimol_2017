<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MX_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('noticia_model');
		$this->load->model('evento_model');
		$this->load->model('imagem_model');
		$this->load->model('curso_model');
		$this->load->model('video_model');
	}
	
	public function index()
	{
		$this->data['title']="Cimol";
		$this->data['template']="inicio";
		$this->data['noticias']=$this->noticia_model->listar_inicial();
		$this->data['eventos']=$this->evento_model->listar_eventos(2);
		$this->data['cursos']=$this->curso_model->listar();
		$this->data['videos']=$this->video_model->listar();
		//print_r($this->data['videos']);
		foreach($this->data['noticias'] as $noticia){
			$this->data['imagens'][]=$this->imagem_model->listar_imagem_noticia($noticia->id);
		}
		/*
		foreach($this->data['eventos'] as $evento){
			$this->data['imagens_evento'][]=$this->imagem_model->listar_imagem_evento($evento->id);
		}
		*/
		$this->view->show_view($this->data);
	}
}
	
