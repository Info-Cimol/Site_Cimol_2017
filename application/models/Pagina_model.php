<?php
class Pagina_model extends CI_Model{
	function listar_paginas(){
		$this->db->select('*')
		->from('pagina')
		->where('status','ativo');
		$query=$this->db->get();
		return $query->result();
	}
	function postar_pagina($pagina, $id=null){
		if($id!=null){
		if($this->db->where('id', $id)
			->update('pagina', $pagina)){
				return true;
			}else{
				return false;
			}
		}else{
			if($this->db->insert('pagina', $pagina)){
				return true;
			}else{
				return false;
			}
		}
	}
	function buscar_pagina($id){
		$this->db->select('*')
		->from('pagina')
		->where('status','ativo')
		->where('id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	
	function deletar_pagina($id){
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('pagina')){
					return true;
		}else{
			return false;
		}
	}
	
	function carregar_pagina_curso($id_curso){
		
		$this->db->select('*')
		->from('pagina_curso')
		->where('status','ativo')
		->where('curso_id =', $id_curso);
		$query=$this->db->get();
		$resultado=$query->result();
	
		
		$id=$resultado[0]->pagina_id;
		
		$this->db->select('*')
		->from('pagina')
		->where('status','ativo')
		->where('id =', $id);
		
		$query=$this->db->get();
		
		return $query->result();
	}
}
