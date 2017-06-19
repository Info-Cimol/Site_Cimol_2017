<?php
class Curso extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('curso_model');
	}
	
	public function index(){
		$this->data['title']="Cimol - Cursos";
		$this->data['cursos']=$this->curso_model->listar();
		$this->data['template']="curso";
		$this->view->show_view($this->data);
	}
	
	public function pagina($id_curso){
		
		$this->load->model('pagina_model');
		$this->data['pagina']=$this->pagina_model->carregar_pagina_curso($id_curso);
		$this->data['template']="pagina/pagina";
		$this->view->show_view($this->data);
	}
}
