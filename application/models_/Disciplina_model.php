<?php
class Disciplina_model extends CI_Model{
	function listar(){
		$this->db->select('d.*, c.titulo as titulo_curso, s.nome as nome_segmento')
		->from('disciplina d')
		->join('curso c','d.segmento_curso_curso_id=c.id')
		->join('segmento s','d.segmento_curso_segmento_id=s.id')
		->where('d.status','ativo');
		$query=$this->db->get();
		return $query->result();
	}
	
	
	function salvar($disciplina, $id=null){
		//echo $disciplina['id'];
		if($disciplina['id']==null){
			if($this->db->insert("disciplina",$disciplina)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			if($this->db->where('id', $disciplina['id'])
			->update('disciplina', $disciplina)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	
	function buscar($id){
		
		$this->db->select('d.*, c.titulo as titulo_curso, s.nome as nome_segmento, sc.num_periodos, c.titulo AS titulo_curso')
		->from('disciplina d')
		->join('curso c','d.segmento_curso_curso_id=c.id')
		->join('segmento s','d.segmento_curso_segmento_id=s.id')
		->join('segmento_curso sc','sc.segmento_id=d.segmento_curso_segmento_id and sc.curso_id=d.segmento_curso_curso_id')
		->where('d.status','ativo')
		->where('d.id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	
	
	function deletar($id){
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('disciplina')){
					return true;
		}else{
			return false;
		}
	}
}