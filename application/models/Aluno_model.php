<?php
class Aluno_model extends CI_Model{
	
	
	function listar(){
		$this->db->select('a.id, m.matricula,a.pessoa_id, pe.nome, pe.foto, c.titulo as curso')
		->from('aluno a')
		->join('pessoa pe','a.pessoa_id=pe.id')
		->join('matricula m','m.aluno_id=a.id','left')
		->join('curso c','m.segmento_curso_curso_id=c.id','left')
		->where('a.status','ativo');
		$query=$this->db->get();
		$resultado=$query->result();
		$alunos=null;
		foreach($resultado as $aluno){
			//print_r($aluno);
			$this->db->select('e.email')
			->from('email e')
			->join('pessoa p','e.pessoa_id=p.id')
			->where('e.pessoa_id',$aluno->pessoa_id);
			$query=$this->db->get();
			$aluno->emails=$query->result();
			
			$this->db->select('t.ddd, t.numero, t.tipo')
			->from('telefone t')
			->join('pessoa p','t.pessoa_id=p.id')
			->where('t.pessoa_id',$aluno->pessoa_id);
			$query=$this->db->get();
			$aluno->telefones=$query->result();
			
			$alunos[]=$aluno;
		}
		
		
		return $alunos;
	}
	
	function pesquisar_por_nome($parametro){
		$this->db->select('a.id, m.matricula,a.pessoa_id, pe.nome, pe.foto, c.titulo as curso')
		->from('aluno a')
		->join('pessoa pe','a.pessoa_id=pe.id')
		->join('matricula m','m.aluno_id=a.id','left')
		->join('curso c','m.segmento_curso_curso_id=c.id','left')
		->where('a.status','ativo')
		->like('pe.nome',$parametro);
		$query=$this->db->get();
		$resultado=$query->result();
		
	
		return $resultado;
	}
	
	function salvar($aluno){
		print_r($aluno);
		$aluno['ip'] = $_SERVER['REMOTE_ADDR'];
		$aluno['usuario_id'] = $_SESSION['user_data']['id'];
		if($aluno['pessoa_id']==null){
			
			if($this->db->insert("pessoa",array('nome'=>$aluno['nome'], 'rg'=>$aluno['rg'],'cpf'=>$aluno['cpf'], 'foto'=>$aluno['foto']))){
				$pessoa_id=$this->db->insert_id();
				//print_r($aluno['email']);
				foreach($aluno['email'] as $email){
					
					$this->db->insert("email",array('pessoa_id'=>$pessoa_id, 'email'=>$email));
				}
				
				foreach($aluno['telefone'] as $telefone){
					
					$this->db->insert("telefone",array('pessoa_id'=>$pessoa_id, 'ddd'=>$telefone['ddd'], 'numero'=>$telefone['numero'], 'tipo'=>$telefone['tipo']));
				}
				
				if($this->db->insert("aluno",array('pessoa_id'=>$pessoa_id))){
					$aluno_id=$this->db->insert_id();
				
				}
				/*
				if($this->db->insert("matricula",array('aluno_id'=>$aluno_id, 'matricula'=>$aluno['matricula'],'segmento_segmento_id'=>$aluno['segmento_id'], 'segmento_curso_id'=>$aluno['curso_id']))){
					$aluno_id=$this->db->insert_id();
				
				}
				*/
				return true;
			}else{
				return false;
			}
		}else{
			
			if($this->db->where('id', $aluno['pessoa_id'])
			->update('pessoa', array('nome'=>$aluno['nome'], 'rg'=>$aluno['rg'],'cpf'=>$aluno['cpf']))){
				if($this->db->where('pessoa_id', $aluno['pessoa_id'])
					->delete('telefone')){
						foreach($aluno['telefone'] as $telefone){
							if($telefone['numero']!='')
							$this->db->insert("telefone",array('pessoa_id'=>$aluno['pessoa_id'], 'ddd'=>$telefone['ddd'], 'numero'=>$telefone['numero'], 'tipo'=>$telefone['tipo']));
								
						}
				}
					
				if($this->db->where('pessoa_id', $aluno['pessoa_id'])
							->delete('email')){
						foreach($aluno['email'] as $email){
							if($email!='')
							$this->db->insert("email",array('pessoa_id'=>$aluno['pessoa_id'], 'email'=>$email));
					
						}
				}
				if($aluno['foto']!=''){
						$this->db->where('id', $aluno['pessoa_id'])
						->update('pessoa', array('foto'=>$aluno['foto']));
						
				}
				return true;	
			}
			return false;
			
		}
	}
	
	
	function buscar($id){
		/*
		 $this->db->select('a.id, m.*,a.pessoa_id, pe.nome, pe.foto, c.titulo as curso, c.id as curso_id, s.descricao as segmento_descricao')
		->from('aluno a')
		->join('pessoa pe','a.pessoa_id=pe.id')
		->join('matricula m','m.aluno_id=a.id','left')
		->join('curso c','m.segmento_curso_curso_id=c.id')
		->join('segmento s','m.segmento_curso_segmento_id=s.id'
		*/
		$this->db->select('a.id, a.pessoa_id, pe.nome, pe.foto')
		->from('aluno a')
		->join('pessoa pe','a.pessoa_id=pe.id')
		->where('a.status','ativo')
		->where('a.id =', $id);
		$query=$this->db->get();
		$resultado=$query->result();
		
		$this->db->select('m.*, c.titulo as curso, c.id as curso_id, s.descricao as segmento_descricao')
		->from('aluno a')
		->join('matricula m','m.aluno_id=a.id')
		->join('curso c','m.segmento_curso_curso_id=c.id')
		->join('segmento s','s.id=m.segmento_curso_segmento_id')
		->where('a.status','ativo')
		->where('a.id =', $resultado[0]->id);
		$query=$this->db->get();
				
		$resultado[0]->cursos=$query->result();
		
		$this->db->select("t.ddd, t.numero, t.tipo")
		->from('aluno a')
		->join('telefone t','t.pessoa_id=a.pessoa_id')
		->where('a.status','ativo')
		->where('a.id =', $id);
		$query=$this->db->get();
		$telefones=$query->result();
		
		$resultado[0]->telefones=$telefones;
		/*if(!empty($telefones)){
			$resultado[0]->telefones=$telefones;
		}else{
			$resultado[0]->telefones=null;
		}*/
		$this->db->select("e.email")
		->from('aluno a')
		->join('email e','e.pessoa_id=a.pessoa_id')
		->where('a.status','ativo')
		->where('a.id =', $id);
		$query=$this->db->get();
		$resultado[0]->emails=$query->result();
		
		
		//print_r($resultado);
		
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