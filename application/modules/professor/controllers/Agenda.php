<?php
class Agenda extends MX_Controller{
	public function __construct(){
		parent::__construct();
                if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('agenda_model');
		date_default_timezone_set("Brazil/East");
	}
	
	public function index(){
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="agenda";
		$this->data['agendas']=$this->agenda_model->listar();
		$this->view->show_view($this->data);
	}
	
	public function buscar_agenda($id){
		$agenda=$this->agenda_model->buscar_agenda($id);
		echo json_encode($agenda);
	}
	
	public function salvar_agenda($id=null){
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
			$data=explode('/',$_POST['agenda']['data']);
			$_POST['agenda']['data']=$data[2]."-".$data[1]."-".$data[0];
		}
		$agenda = $this->input->post('agenda');
		if($this->agenda_model->postar_agenda($agenda, $id)){
			$this->view->set_message("Agenda adicionada com sucesso", "alert alert-success");
			redirect('admin/agenda', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao adicionar agenda", "alert alert-error");
			redirect('admin/agenda', 'refresh');
		}
	}
	
	public function deletar_agenda($id){
		if($this->agenda_model->deletar_agenda($id)){
			$this->view->set_message("Agenda deletada com sucesso", "alert alert-success");
			redirect('admin/agenda', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar agenda", "alert alert-error");
			redirect('admin/agenda', 'refresh');
		}
	}
}