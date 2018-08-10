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
	function listar_turmas_curso($pessoa_id){
	    $this->db->select('t.*,dt.professor_id, c.titulo as titulo_curso')
	    ->from('turma t')
	    ->join('curso c','t.segmento_curso_curso_id=c.id')
	    ->join('disciplina_turma dt','dt.turma_id=t.id')
	   ->join('professor pr',' pr.id =dt.professor_id')
	    ->where('t.status','ativo')
	   ->where('pr.pessoa_id ',$pessoa_id)
	    ->group_by('t.id');
	    $query=$this->db->get();
	    $resultado=$query->result();
	    
	    return $resultado;
	}
	
	
	
	function buscar($id){
		$this->db->select('t.*, c.titulo as titulo_curso, c.id AS curso_id, s.descricao as descricao_segmento')
		->from('turma t')
		->join('curso c','t.segmento_curso_curso_id=c.id')
		->join('segmento s','t.segmento_curso_segmento_id=s.id')
		->where('c.status','ativo')
		->where('t.id =', $id);
		$query=$this->db->get();
		$resultado= $query->result();
		
		return $resultado;
	}
	
	function buscar_turma_prof($id){
	    $this->db->select('t.*, c.titulo as titulo_curso, c.id AS curso_id, s.descricao as descricao_segmento')
	    ->from('turma t')
	    ->join('curso c','t.segmento_curso_curso_id=c.id')
	    ->join('segmento s','t.segmento_curso_segmento_id=s.id')
	    ->where('c.status','ativo')
	    ->where('t.id =', $id);
	    $query=$this->db->get();
	    $resultado= $query->result();
	    
	    return $resultado[0];
	
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