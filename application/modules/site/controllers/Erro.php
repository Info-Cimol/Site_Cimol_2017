
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Erro extends MX_Controller{
	public function __construct(){
		parent::__construct();
		
	}

	public function erro_404(){
		$this->data['title']="Cimol - Notícias";
		$this->data['content']="erros/erro_404";
		$this->view->show_view($this->data);
	}
}		
?>