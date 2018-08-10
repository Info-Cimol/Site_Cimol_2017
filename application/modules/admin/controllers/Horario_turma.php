<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horario_turma extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('Horario_turma_model');
		$this->load->model('Disciplina_turma_model');
		$this->load->model('disciplina_turma_model');
		date_default_timezone_set("Brazil/East");
	}
	
	public function index($turma_id,$turma_nome)
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="horario_turma/index";
		$this->data['turma_id']=$turma_id;
		$this->data['turma_nome']=$turma_nome;
		$this->data['horarios_turma']=$this->Horario_turma_model->listar($turma_id);
		$this->data['disciplinas_turma']=$this->Disciplina_turma_model->listar($turma_id);
		//$this->data['disciplinas']=$this->disciplina_model->listar(); */
		$this->data['salas']=$this->Horario_turma_model->listar_salas();
		//$this->data['periodos']=$this->Horario_turma_model->listar_periodos();
		/*if(count($this->data['disciplinas_turma'])>0){
		    $this->data['disciplinas']=$this->Disciplina_turma_model->listar_disciplinas_curso(
		        $this->data['disciplinas_turma'][0]->segmento_curso_curso_id,
		        $this->data['disciplinas_turma'][0]->periodo
		        );
		}*/
		//print_r($this->data['horarios_turma']);
		//print_r($this->data['disciplinas']);
		$this->view->show_view($this->data);
	}
	
	public function salvar(){
	    print_r($_POST);
	    if((isset($_POST['disciplina_turma_id']))&&(isset($_POST['horario_dia']))&&(isset($_POST['periodo_id']))&&(isset($_POST['sala_id']))){
	       
	        $horario['disciplina_turma_id']=$_POST['disciplina_turma_id'];
	        $horario['dia'] = $_POST['horario_dia'];
            $horario['periodo_id']=$_POST['periodo_id'];
            $horario['sala_id']=$_POST['sala_id'];
	            
            if($this->Horario_turma_model->salvar($horario)){
	            $this->view->set_message("Horario salvo com sucesso", "alert alert-success");
	        }else{
	            $this->view->set_message("Erro ao salvar horario","alert alert-error");
	        }
	       //redirect("admin/Horario_turma/"+$horario_turma['turma_id'],"redirect");
	        redirect("admin/horario_turma/".$_POST['turma_id']."/".$_POST['turma_nome'], "refresh");
		}
	}
	
	
	public function deletar($disciplina_turma_id, $periodo_id){
	    
		if($this->Horario_turma_model->deletar($disciplina_turma_id, $periodo_id)){
			$this->view->set_message("horario deletada com sucesso", "alert alert-success");
			redirect("admin/horario_turma/".$_POST['turma_id']."/".$_POST['turma_nome'], "refresh");
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar horario", "alert alert-error");
			redirect("admin/horario_turma/".$_POST['turma_id']."/".$_POST['turma_nome'], "refresh");
		}
	
	}
	
	public function buscar($disciplina_turma_id, $periodo_id, $sala_id){
	   $this->Horario_turma_model->buscar($disciplina_turma_id, $periodo_id, $sala_id);
	      
	   
	   
		//$this->load->model('professor_model');
		//$disciplina_turma['professores']=$this->professor_model->listar();
	}
	public function listar_disciplinas_turma_json($turma_id){
		$disciplinas=$this->disciplina_turma_model->listar($turma_id);
		echo json_encode($disciplinas);
	}
	
	public function listar_salas_json(){
	    $salas=$this->Horario_turma_model->listar_salas();
	    echo json_encode($salas);
	}
	
	public function listar_periodos_json($turno){
	    $periodos=$this->Horario_turma_model->listar_periodos($turno);
	    echo json_encode($periodos);
	}
	
	public function listar_disciplinas_curso_json($id_turma){
	    $disciplinas=$this->Horario_turma_model->listar_disciplinas_curso($id_turma);
		echo json_encode($disciplinas);
	}
	
	
}