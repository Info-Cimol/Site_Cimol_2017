<?php
class Aluno_turma_model extends CI_Model{
	
	
	function listar($turma_id){
		$this->db->select('a.id, m.matricula, pe.nome nome_aluno, pe.foto, c.titulo as titulo_curso, t.nome AS nome_turma')
		->from('aluno_turma at')
		->join('aluno a','a.id=at.aluno_id','left')
		->join('pessoa pe','pe.id=a.pessoa_id','left')
		->join('turma t','t.id=at.turma_id','left')
		->join('matricula m','m.aluno_id=at.aluno_id','left')
		->join('curso c','m.segmento_curso_curso_id=c.id','left')
		->where('t.id',$turma_id)
		->where('a.status','ativo');
		$query=$this->db->get();
		return $query->result();
		
		
		
		
		return $alunos;
	}
	
	function salvar($alunos_turma){
		if(count($alunos_turma)>0){
			for($i=0;$i<count($alunos_turma);$i++){
				$aluno_turma['turma_id']=$alunos_turma['turma_id'];
				$aluno_turma['aluno_id']=$alunos_turma['alunos_turma'][$i];
				$this->db->insert("aluno_turma",$aluno_turma);
			}
			return true;
		}
		return false;
	}
	
	
	function buscar($id){
		$this->db->select('a.id, m.*,a.pessoa_id, pe.nome, pe.foto, c.titulo as curso, c.id as curso_id, s.descricao as segmento_descricao')
		->from('aluno a')
		->join('pessoa pe','a.pessoa_id=pe.id')
		->join('matricula m','m.aluno_id=a.id','left')
		->join('curso c','m.segmento_curso_curso_id=c.id')
		->join('segmento s','m.segmento_curso_segmento_id=s.id')
		->where('a.status','ativo')
		->where('a.id =', $id);
		$query=$this->db->get();
		$resultado=$query->result();
		
		$this->db->select("t.ddd, t.numero, t.tipo")
		->from('aluno a')
		->join('telefone t','t.pessoa_id=a.pessoa_id')
		->where('a.status','ativo')
		->where('a.id =', $id);
		$query=$this->db->get();
		$resultado[0]->telefones=$query->result();
		
		$this->db->select("e.email")
		->from('aluno a')
		->join('email e','e.pessoa_id=a.pessoa_id')
		->where('a.status','ativo')
		->where('a.id =', $id);
		$query=$this->db->get();
		$resultado[0]->emails=$query->result();
		
		
		
		return $resultado;
	}
	
	
	function deletar($id){
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('aluno')){
					echo ":-)";
					return true;
		}else{
			echo ":-(";
			return false;
		}
	}
}