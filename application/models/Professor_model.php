<?php
class Professor_model extends CI_Model{
	
	
	function listar(){
		$this->db->select('p.id, p.pessoa_id, p.carga_horaria, pe.nome, pe.foto')
		->from('professor p')
		->join('pessoa pe','p.pessoa_id=pe.id')
		->where('p.status','ativo');
		$query=$this->db->get();
		$resultado=$query->result();
		$professores=null;
		foreach($resultado as $professor){
			//print_r($professor);
			$this->db->select('e.email')
			->from('email e')
			->join('pessoa p','e.pessoa_id=p.id')
			->where('e.pessoa_id',$professor->pessoa_id);
			$query=$this->db->get();
			$professor->emails=$query->result();
			
			$this->db->select('t.ddd, t.numero, t.tipo')
			->from('telefone t')
			->join('pessoa pe','t.pessoa_id=pe.id')
			->where('t.pessoa_id',$professor->pessoa_id);
			$query=$this->db->get();
			$professor->telefones=$query->result();
			
			$professores[]=$professor;
		}
		
		
		return $professores;
	}
	
	function salvar($professor){
		$professor['ip'] = $_SERVER['REMOTE_ADDR'];
		$professor['usuario_id'] = $_SESSION['user_data']['id'];
		if($professor['pessoa_id']==null){
			if($this->db->insert("pessoa",array('nome'=>$professor['nome'], 'rg'=>$professor['rg'],'cpf'=>$professor['cpf'], 'foto'=>$professor['foto']))){
				$pessoa_id=$this->db->insert_id();
				//print_r($professor['email']);
				foreach($professor['email'] as $email){
					
					$this->db->insert("email",array('pessoa_id'=>$pessoa_id, 'email'=>$email));
				}
				
				foreach($professor['telefone'] as $telefone){
					
					$this->db->insert("telefone",array('pessoa_id'=>$pessoa_id, 'ddd'=>$telefone['ddd'], 'numero'=>$telefone['numero'], 'tipo'=>$telefone['tipo']));
				}
				
				if($this->db->insert("professor",array('pessoa_id'=>$pessoa_id, 'carga_horaria'=>$professor['carga_horaria']))){
					$professor_id=$this->db->insert_id();
				
				}
				return true;
			}else{
				return false;
			}
		}else{
			if($this->db->where('id', $professor['pessoa_id'])
			->update('pessoa', array('nome'=>$professor['nome'], 'rg'=>$professor['rg'],'cpf'=>$professor['cpf']))){
				if($this->db->where('pessoa_id', $professor['pessoa_id'])
						->update('professor', array('carga_horaria'=>$professor['carga_horaria']))){
					if($this->db->where('pessoa_id', $professor['pessoa_id'])
					->delete('telefone')){
						foreach($professor['telefone'] as $telefone){
							if($telefone['numero']!='')
							$this->db->insert("telefone",array('pessoa_id'=>$professor['pessoa_id'], 'ddd'=>$telefone['ddd'], 'numero'=>$telefone['numero'], 'tipo'=>$telefone['tipo']));
								
						}
					}
					
					if($this->db->where('pessoa_id', $professor['pessoa_id'])
							->delete('email')){
						foreach($professor['email'] as $email){
							if($email!='')
							$this->db->insert("email",array('pessoa_id'=>$professor['pessoa_id'], 'email'=>$email));
					
						}
					}
					if($professor['foto']!=''){
						$this->db->where('id', $professor['pessoa_id'])
						->update('pessoa', array('foto'=>$professor['foto']));
						
					}
					
				}
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	function buscar($id){
		$this->db->select("a.*,p.nome, p.rg, p.cpf,p.foto")
		->from('professor a')
		->join('pessoa p','p.id=a.pessoa_id')
		->where('a.status','ativo')
		->where('a.id =', $id);
		$query=$this->db->get();
		$resultado=$query->result();
		
		$this->db->select("t.ddd, t.numero, t.tipo")
		->from('professor a')
		->join('telefone t','t.pessoa_id=a.pessoa_id')
		->where('a.status','ativo')
		->where('a.id =', $id);
		$query=$this->db->get();
		$resultado[0]->telefones=$query->result();
		
		$this->db->select("e.email")
		->from('professor a')
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
				->update('professor')){
					echo ":-)";
					return true;
		}else{
			echo ":-(";
			return false;
		}
	}
}