<?php
class Matricula_model extends CI_Model{
	
	
	function listar(){
		$this->db->select('m.*, p.nome AS nome_aluno, p.foto AS foto_aluno, c.titulo AS nome_curso')
		->from('matricula m')
		->join('aluno a','a.id=m.aluno_id')
		->join('pessoa p','p.id=a.pessoa_id')
		->join('curso c','c.id=m.segmento_curso_curso_id')
		->where('m.status','ativo');;
		$query=$this->db->get();
		return $query->result();
	}
	
	function salvar($matricula){
		$matricula['data_matricula']=date("Y-m-d");
		if($this->db->insert('matricula',$matricula)){
			return true;
		}
		return false;
	}
	
	
	function buscar($matricula){
		
	}
	
	function pesquisar_por_nome($matricula){
		$this->db->select('*')
		->from('matricula')
		
		->where('matricula',$matricula);
		
		$query=$this->db->get();
		return $query->num_rows();
		
	}
	
	function verifica_matricula_aluno_curso($aluno_id, $curso_id, $segmento_id){
		$this->db->select('*')
		->from('matricula')
		->where('aluno_id',$aluno_id)
		->where('segmento_curso_curso_id',$curso_id)
		->where('segmento_curso_segmento_id',$segmento_id);
		
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	function deletar($matricula){
		if($this->db->set('status', 'inativo')
				->where('matricula =', $matricula)
				->update('matricula')){
					return true;
		}
		return false;
		
	}
}