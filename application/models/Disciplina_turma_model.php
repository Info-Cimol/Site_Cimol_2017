<?php
class Disciplina_turma_model extends CI_Model{
	function listar($id_turma=null){
		$this->db->select('d.*, t.id as turma_id, t.nome as turma,p.id as professor_id, pe.nome as nome_professor, c.titulo as curso')
		->from('disciplina d')
		->join('disciplina_turma dt','dt.disciplina_id=d.id')
		->join('turma t','dt.turma_id=t.id')
		->join('curso c','t.segmento_curso_curso_id=c.id')
		->join('professor p','dt.professor_id=p.id')
		->join('pessoa pe', 'p.pessoa_id=pe.id')
		->where("dt.status","ativo");
		if($id_turma != null){
			$this->db->where("dt.turma_id",$id_turma);
		}
		$query=$this->db->get();
		//print_r($query->result());
		return $query->result();
	}
	
	function listar_disciplinas_curso($curso_id, $periodo=null){
		$this->db->select('d.*')
		->from('disciplina d')		
		->where("d.segmento_curso_curso_id =".$curso_id);
		if($periodo != null){
			$this->db->where("d.periodo",$periodo);
		}
		$query=$this->db->get();
		return $query->result();
	}
	
	
	function salvar($disciplina, $id=null){
		
		if($id==null){
			if($this->db->insert("disciplina_turma",$disciplina)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			if($this->db->where('disciplina_id', $id)->where('turma_id', $disciplina['turma_id'])
			->update('disciplina_turma', $disciplina)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	
	function buscar($turma_id,$disciplina_id,$professor_id){
		
		$this->db->select('d.*, t.id as turma_id, t.nome as turma,p.id as professor_id, pe.nome as nome_professor, c.titulo as curso')
		->from('disciplina d')
		->join('disciplina_turma dt','dt.disciplina_id=d.id')
		->join('turma t','dt.turma_id=t.id')
		->join('curso c','t.segmento_curso_id=c.id')
		->join('professor p','dt.professor_id=p.id')
		->join('pessoa pe', 'p.pessoa_id=pe.id')
		->where('dt.disciplina_id =', $disciplina_id)
		->where('dt.turma_id =', $turma_id)
		->where('dt.professor_id =', $professor_id);
		$query=$this->db->get();
		//print_r($query->result());
		return $query->result();
	}
	
	
	function deletar($turma_id,$id){
		if($this->db->set('status', 'inativo')
				->where('disciplina_id =', $id)
				->where('turma_id =', $turma_id)
				->update('disciplina_turma')){
					return true;
		}else{
			return false;
		}
	}
}