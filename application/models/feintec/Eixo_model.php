<?php
class Eixo_model extends CI_Model{
	
	public function busca(){
		$this->db->select('id,titulo');
		return $this->db->get('feintec_eixo')->result_array();

	}

	
}