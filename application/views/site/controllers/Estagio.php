<?php
class Estagio extends MX_Controller{
	public function __construct(){
		parent::__construct();
		
	}
	
	public function index(){
		$this->data['title']="Cimol - Estágio";
		
		
		$this->data['content']="estagio/index";
		$this->view->show_view($this->data);
	}
	
	public function integrado(){
		$this->data['content']="estagio/integrado";
		$this->view->show_view($this->data);
	}
	
}