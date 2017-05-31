<?php
class Evento_model extends CI_Model{
	function listar_eventos($limit=null){
		$this->db->select("e.*, i.nome as nome_imagem, i.url_imagem")
		->from('evento e')
		->join('imagem i', 'i.id=e.imagem_id');
		$this->db->where('status =','ativo');
		if($limit!=null){
			$this->db->limit($limit);
		}
		$this->db->order_by('id',"desc");
		$query=$this->db->get();
		return $query->result();
	}
	
	function buscar_eventos_mes($mes, $ano, $dia=null){
		//$query="SELECT * FROM evento WHERE status='ativo' AND MONTH(data)=".$mes." AND YEAR(data)=".$ano;
		$query="SELECT * FROM evento WHERE status='ativo' AND MONTH(data)=".$mes." AND YEAR(data)=".$ano;
		if($dia!=null){
			$query.=" AND DAY(data)=".$dia;
		}
		$result=$this->db->query($query);
		return $result->result();
	}
	
	function postar_evento($evento){
		//print_r($evento);
		if(empty($evento['id'] or $evento['id']!='')){
			if($this->db->insert('evento', $evento)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			if($this->db->set('titulo', $evento['titulo'])
					->set('resumo', $evento['resumo'])
					->set('descricao', $evento['descricao'])
					->set('imagem_id',$evento['imagem_id'])
				->where('id =', $evento['id'])
				->update('evento')){
					return true;
			}else{
				return false;
			}
			
		}
	}
	
	function buscar_evento($id){
		//$this->db->select("*, DATE_FORMAT(data,'%d/%m/%Y') AS data_formatada")
		$this->db->select("*")
		->from('evento')
		->where('status =','ativo')
		->where('id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	
	function deletar_evento($id){
		/*$evento = array(
				"ip" => $_SERVER['REMOTE_ADDR'],
				"usuario_id" => $_SESSION['userdata']['id']
		);*/
		/*$this->db->where('evento_id =', $id)
		->delete('curso_evento');*/
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('evento')){
					return true;
		}else{
			return false;
		}
	}
	
	function editar($evento, $cursos_salvos, $cursos, $id){
		foreach($cursos_salvos as $curso){
			if($cursos!=null){
				if(!in_array($curso['curso_id'], $cursos)){
					$this->db->where('evento_id =', $id)
					->where('curso_id =', $curso['curso_id'])
					->delete('curso_evento');
				}
			}else{
				$this->db->where('evento_id =', $id)
				->delete('curso_evento');
			}
		}
		if($cursos!=null){
			foreach($cursos as $curso){
				$curso_count=0;
				foreach($cursos_salvos as $curso_salvo){
					if($curso==$curso_salvo['curso_id']){
						$curso_count++;
					}
				}
				if($curso_count==0){
					$curso_insert = array(
							'evento_id' => $id,
							'curso_id' => $curso
					);
					$this->db->insert('curso_evento', $curso_insert);
				}
			}
		}
		if($this->db->where('id', $id)
				->update('evento', $evento)){
					return true;
		}else{
			return false;
		}
	}
	
	function buscar_curso_evento($id){
		$this->db->select('curso_id')
		->from('curso_evento')
		->where('evento_id =', $id);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function listarEdicoesEvento($idEvento){
		$this->db->select("e.*, e.id AS evento_id, e.titulo AS titulo_evento, ee.*,ee.titulo AS titulo_edicao,i.*, ee.id AS edicao_evento_id,i.nome AS nome_imagem")
		->from('evento e')
		->join("edicao_evento ee", "ee.evento_id=e.id")
		->join('imagem i', 'i.id=e.imagem_id')
		->where('ee.status =','ativo');
		
		$this->db->order_by('ee.id',"desc");
		$query=$this->db->get();
		return $query->result();
	}
	
	function postarEdicaoEvento($edicao_evento){
		if($this->db->insert('edicao_evento', $edicao_evento)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	function salvarPainelEdicaoEvento($painelEdicaoEvento){
		if($this->db->insert('painel_edicao_evento', $painelEdicaoEvento)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	function listarImagensEdicao($edicaoId){
		$this->db->select('iee.*, i.*')
		->from("imagem_edicao_evento iee")
		->join("edicao_evento ee", "iee.edicao_evento_id=ee.id")
		->join("evento e","e.id=ee.evento_id")
		->join("imagem i","iee.imagem_id=i.id")
		->where("ee.id",$edicaoId);
		$query=$this->db->get();
		return $query->result();
	}
	
	function postarImagemEdicao($imagemEdicaoEvento){
		if($this->db->insert('imagem_edicao_evento', $imagemEdicaoEvento)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	
	function deletarImagemEdicaoEvento($imagemId,$edicaoEventoId){
		if($this->db->delete('imagem_edicao_evento',array('imagem_id'=>$imagemId,'edicao_evento_id'=>$edicaoEventoId))){
			$this->db->delete('imagem',array('id'=>$imagemId));
			return true;
		}else{
			return false;
		}
	} 
	
	function listarPaineisEdicao($eventoId,$edicaoId){
		$this->db->select("e.*, e.titulo AS titulo_evento, ee.*,ee.titulo AS titulo_edicao,i.*, ee.id AS edicao_evento_id,i.nome AS nome_imagem, pee.*")
		->from('evento e')
		->join("edicao_evento ee", "ee.evento_id=e.id")
		->join('imagem i', 'i.id=e.imagem_id')
		->join('painel_edicao_evento pee','pee.edicao_id=ee.id')
		->where('e.id',$eventoId)
		->where('ee.id',$edicaoId)
		->where('ee.status =','ativo');
		
		$this->db->order_by('ee.id',"desc");
		$query=$this->db->get();
		return $query->result();
	}
	
	
	/*
	function deletar_imagem_evento($imagem_id, $evento_id){
		if($this->db->delete('imagem_evento', array('imagem_id' => $imagem_id, 'evento_id'=>$evento_id))){
			return true;
		}else{
			return false;
		}
	}
	*/
}