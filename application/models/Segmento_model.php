<?php
class Segmento_model extends CI_Model{
	
	function listar(){
		$this->db->select('*')
		->from('segmento')
		->where('status','ativo');
		$query=$this->db->get();
		
		return $query->result();
	}
	
	function listar_segmentos_curso($curso_id=null){
		$this->db->select('*')
		->from('segmento')
		->where('status','ativo');
		$query=$this->db->get();
	
		return $query->result();
	}
	
	function buscar_info_segmento_curso($curso_id,$segmento_id){
		$this->db->select('s.id, sc.curso_id,s.periodo, num_aulas_periodo, sc.num_periodos')
		->from('segmento s')
		->join("segmento_curso sc","s.id=sc.segmento_id")
		->where('sc.curso_id',$curso_id)
		->where('s.id',$segmento_id);
	
		$query=$this->db->get();
		return $query->result();
	}
	
	
}