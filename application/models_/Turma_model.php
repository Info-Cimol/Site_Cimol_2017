<?php
class Turma_model extends CI_Model{
	
	function listar(){
		$this->db->select('t.*, c.titulo as titulo_curso, s.nome as nome_segmento')
		->from('turma t')
		->join('curso c','t.segmento_curso_curso_id=c.id')
		->join('segmento s','t.segmento_curso_segmento_id=s.id')
		->where('t.status','ativo');
		$query=$this->db->get();
		return $query->result();
	}
	
	
	function salvar($turma, $id=null){
		//$turma['ip'] = $_SERVER['REMOTE_ADDR'];
		//$turma['usuario_id'] = $_SESSION['user_data']['id'];
		if($id==null){
			if($this->db->insert("turma",$turma)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			if($this->db->where('id', $id)
			->update('turma', $turma)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	
	function buscar($id){
		$this->db->select('t.*, c.titulo as titulo_curso, c.id AS curso_id, s.descricao as descricao_segmento')
		->from('turma t')
		->join('curso c','t.segmento_curso_curso_id=c.id')
		->join('segmento s','t.segmento_curso_segmento_id=s.id')
		->where('c.status','ativo')
		->where('t.id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	
	
	function deletar($id){
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('turma')){
					return true;
		}else{
			return false;
		}
	}
}