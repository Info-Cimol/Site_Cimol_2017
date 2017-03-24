<?php
class Estagio extends MX_Controller{
	public function __construct(){
		parent::__construct();
		
	}
	
	public function index(){
		$this->data['title']="Cimol - Estágio";
		
		
		$this->data['template']="estagio/index";
		$this->view->show_view($this->data);
	}
	
	public function integrado(){
		$this->data['template']="estagio/integrado";
		$this->view->show_view($this->data);
	}
	
}