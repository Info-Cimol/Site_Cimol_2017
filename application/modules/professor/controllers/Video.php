<?php
class Video extends MX_Controller{
	public function __construct(){
		parent::__construct();
		if(isset($this->user_data)){
			if(!in_array('admin', $this->user_data['permissoes'])){
				redirect('', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
		$this->load->model('video_model');
	}
	
	public function index()
	{
		$this->data['title']="Cimol - Área do Administrador";
		$this->data['template']="video";
		$this->data['videos']=$this->video_model->listar();
		$this->view->show_view($this->data);
	}
	
	public function salvar_video($id=null){
		if($id!=null){
			$video = $this->input->post('video');
			if($this->video_model->postar_video($video, $id)){
				$this->view->set_message("Vídeo editado com sucesso", "alert alert-success");
				redirect('admin/video', 'refresh');
			}else{
				$this->view->set_message("Erro ao editar página", "alert alert-error");
				redirect('admin/video', 'refresh');
			}
		}else{
			$video = $this->input->post('video');
			if($this->video_model->postar_video($video)){
				$this->view->set_message("Vídeo adicionado com sucesso", "alert alert-success");
				redirect('admin/video', 'refresh');
			}else{
				$this->view->set_message("Erro ao adicionar vídeo", "alert alert-error");
				redirect('admin/video', 'refresh');
			}
		}
	}
	
	public function buscar_video($id){
		$video=$this->video_model->buscar_video($id);
		echo json_encode($video);
	}
	
	public function deletar_video($id){
		if($this->video_model->deletar_video($id)){
			$this->view->set_message("Vídeo deletado com sucesso", "alert alert-success");
			redirect('admin/video', 'refresh');
		}else{
			$this->view->set_message("Ocorreu um erro ao deletar vídeo", "alert alert-error");
			redirect('admin/video', 'refresh');
		}
	}
}