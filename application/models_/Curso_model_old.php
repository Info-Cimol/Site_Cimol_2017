<?php
class Curso_model extends CI_Model{
	function listar(){
		$this->db->select('*')
		->from('curso')
		->where('status','ativo');
		$query=$this->db->get();
		return $query->result();
	}
	
	function listar_professores(){
		$this->db->select('p.id, pe.nome')
		->from('professor p')
		->join('pessoa pe','p.pessoa_id=pe.id');
		$query=$this->db->get();
		return $query->result();
	}
	function salvar_curso($curso, $id=null){
		$curso['ip'] = $_SERVER['REMOTE_ADDR'];
		$curso['usuario_id'] = $_SESSION['user_data']['id'];
		if($id==null){
			if($this->db->insert("curso",$curso)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			if($this->db->where('id', $id)
			->update('curso', $curso)){
				return true;
			}else{
				return false;
			}
		}
	}
	function postar_curso_evento($curso, $evento_id){
		$curso_evento = array(
				"curso_id" => $curso,
				"evento_id" => $evento_id,
				"ip" => $_SERVER['REMOTE_ADDR'],
				"usuario_id" => $_SESSION['user_data']['id']
		);
		$this->db->insert('curso_evento', $curso_evento);
	}
	
	function salvar_coordenador($coordenador, $curso_id=null, $professor_id=null){
		$coordenador['ip'] = $_SERVER['REMOTE_ADDR'];
		$coordenador['usuario_id'] = $_SESSION['user_data']['id'];
		if($curso_id==null){
			if($this->db->insert("coordenador_curso",$coordenador)){
				return true;
			}else{
				return false;
			}
		}else{
			if($this->db->where('curso_id',$curso_id)
					->where('professor_id', $professor_id)
					->update('coordenador_curso',$coordenador)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	function buscar_curso($id){
		$this->db->select("c.*,cc.professor_id")
		->from('curso c')
		->join('coordenador_curso cc','cc.curso_id=c.id')
		->where('cc.status','ativo')
		->where('c.status','ativo')
		->where('c.id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	
	function buscar_professores(){
		$this->db->select('pr.id, p.nome')
		->from('pessoa p')
		->join('professor pr','p.id=pr.pessoa_id');
		$query=$this->db->get();
		return $query->result();
	}
	function deletar_curso($id){
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('curso')){
					return true;
		}else{
			return false;
		}
	}
}