<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Classe Inicio
 * Esta classe carrega o conteúdo inicial da página Home do site 
 * @see Versão 1.1 Atualização do sistema para 2017
 * @since 04/04/2017
 * @name Início
 * @version 1.1
 * @author Cândido
 *
 */

class Inicio extends MX_Controller {
	/**
	 * Metodo construtor d classe
	 * @Version 1.1
	 * @Since 04/04/2017
	 * @author Cândido
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('noticia_model');
		$this->load->model('evento_model');
		$this->load->model('imagem_model');
		$this->load->model('curso_model');
		$this->load->model('video_model');
	}
	
	/**
	 * Método inicial destinado a carregar o conteúdo da págian inícial
	 * @name Index
	 * @Version 1.1
	 * @Since 04/04/2017
	 * @author Cândido
	 */
	public function index()
	{
		$this->data['title']="Cimol";
		//$this->data['content']="temas/default/construcao";
		$this->data['content']="inicio";
		$this->data['noticias']=$this->noticia_model->listar_inicial();
		//$this->data['eventos']=$this->evento_model->listar_eventos(2);
		//$this->data['cursos']=$this->curso_model->listar();
		//$this->data['videos']=$this->video_model->listar();
		//print_r($this->data['videos']);
		/*foreach($this->data['noticias'] as $noticia){
			$this->data['imagens'][]=$this->imagem_model->listar_imagem_noticia($noticia->id);
		}*/
		$this->view->show_view($this->data);
	}
}
	
