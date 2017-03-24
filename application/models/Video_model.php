<?php
class Video_model extends CI_Model{
	function listar($limit=null){
		$this->db->select('*')
		->from('video')
		->where('status','ativo')
		->order_by('id','desc');
		if($limit!=null){
			$this->db->limit($limit);
		}
		$query=$this->db->get();
		
		return $query->result();
	}
	function postar_video($video, $id=null){
		$video['ip'] = $_SERVER['REMOTE_ADDR'];
		$video['usuario_id'] = $_SESSION['user_data']['id'];
		if($id==null){
			if($this->db->insert('video', $video)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			if($this->db->where('id', $id)
					->update('video', $video)){
						return true;
			}else{
				return false;
			}
		}
	}
	function buscar_video($id){
		$this->db->select('*')
		->from('video')
		->where('id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	function deletar_video($id){
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('video')){
					return true;
		}else{
			return false;
		}
	}
}
