<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('noticia_model');
		$this->load->model('imagem_model');
	}
	
	public function index(){
		$this->data['title']="Cimol - Notícias";
		$this->data['noticias']=$this->noticia_model->listar_noticias();
		/*foreach($this->data['noticias'] as $noticia){
			$this->data['imagens'][]=$this->imagem_model->listar_imagem_noticia($noticia->id);
		}*/
		$this->data['content']="noticia/index";
		$this->view->show_view($this->data);
	}
	
	public function saiba_mais($id){
		$this->data['title']="Cimol - Notícias";
		$this->data['noticia']=$this->noticia_model->buscar_noticia($id);
		$this->data['imagens']=$this->imagem_model->buscar_imagens($id);
		$this->data['content']="noticia/saiba_mais";
		$this->view->show_view($this->data);
	}
	
	  function feed()
      {
        //parent::Controller();
        $this->data['noticias']=$this->noticia_model->listar_noticias(5);
        $this->load->helper('xml');
        $this->load->helper('text');
        
        $this->data['feed_name'] = 'cimol.g12.br';
        $this->data['encoding'] = 'utf-8'; // the encoding
        $this->data['feed_url'] = 'http://www.cimol.g12.br/feed';
        $this->data['page_description'] = 'Notícias do CIMOL';
        $this->data['page_language'] = 'pt-br';
        $this->data['creator_email'] = 'info_cimol@gmail.com';
        header("Content-Type: application/rss+xml");
         
        $this->load->view('noticia/rss', $this->data);
        
      }
}