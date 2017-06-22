<?php
class Curso extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('curso_model');
	}
	
	public function index($curso_id=null){
		
            $this->data['title']="Cimol - Cursos";
           	$this->data['cursos']=$this->curso_model->listar();
            $this->data['content']="curso/index";
            
            $this->view->show_view($this->data);
            
	}
	
	public function saiba_mais($id){
		
		$this->data['curso']=$this->curso_model->buscar_curso($id);
		$this->data['title']="Cimol - "+$this->data['curso'][0]->titulo;
		$this->data['content']="curso/saiba_mais";
		$this->view->show_view($this->data);
	}
	
    public function lista()
    {
            $this->segmentos=$this->curso_model->listar();
            echo json_encode($this->segmentos);
   }
   public function logos()
   {
            echo json_encode($this->curso_model->listarLogos());
   }
        //public function grade($curso_id)
   public function informacao($id_curso)
        {
            $this->informacao=$this->curso_model->buscar_curso($id_curso);
            echo json_encode($this->informacao);
        }
    public function grade($id_curso)
    {
         $this->segmentos=$this->curso_model->grade($id_curso);
         echo json_encode($this->segmentos);
            
    }
        
        
}
