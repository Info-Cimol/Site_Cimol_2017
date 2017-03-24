<?php
class Agenda_model extends CI_Model{
	function listar(){
		$this->db->select('*')
		->from('agenda')
		->where('status','ativo');
		$query=$this->db->get();
		return $query->result();
	}
	function postar_agenda($agenda, $id=null){
		$agenda['ip'] = $_SERVER['REMOTE_ADDR'];
		$agenda['usuario_id'] = $_SESSION['user_data']['id'];
		if($id==null){
			if($this->db->insert('agenda', $agenda)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			if($this->db->where('id', $id)
					->update('agenda', $agenda)){
						return true;
			}else{
				return false;
			}
		}
	}
	
	function buscar_agenda($id){
		$this->db->select('*')
		->from('agenda')
		->where('id =', $id)
		->where('status','ativo');
		$query=$this->db->get();
		return $query->result();
	}
	
	function buscar_eventos_mes($mes, $ano, $dia=null){
		$query="SELECT * FROM agenda WHERE status='ativo' AND MONTH(data)=".$mes." AND YEAR(data)=".$ano;
		if($dia!=null){
			$query.=" AND DAY(data)=".$dia;
		}
		$result=$this->db->query($query);
		return $result->result();
	}
	
	function deletar_agenda($id){
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('agenda')){
					return true;
		}else{
			return false;
		}
	}
}