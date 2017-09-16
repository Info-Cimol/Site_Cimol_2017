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
		$this->db->select("e.*, i.nome as nome_imagem, i.url_imagem")
		->from('evento e')
                ->join('imagem i',"i.id=e.imagem_id")
		->where('e.status =','ativo')
		->where('e.id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	
	function deletar_evento($id){
		
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
	
       
        function buscar_edicao_evento($id){
		$this->db->select("e.*, i.nome as nome_imagem, i.url_imagem, date_format(e.data_final,'%d/%m/%Y') as 'data_final'")
		->from('edicao_evento e')
                ->join('imagem i',"i.id=e.imagem_id")
		->where('e.status =','ativo')
		->where('e.id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
        
	function listarEdicoesEvento($id){
		$this->db->select("e.titulo ,e.resumo,, e.id AS evento_id, e.titulo AS titulo_evento, ee.*,ee.titulo AS titulo_edicao,i.url_imagem, ee.id AS edicao_evento_id,i.nome AS nome_imagem")
		->from('evento e')
		->join("edicao_evento ee", "ee.evento_id=e.id")
		->join('imagem i', 'i.id=ee.imagem_id')
		->where('ee.status =','ativo');
		
		$this->db->order_by('ee.id',"desc");
		$query=$this->db->get();
		return $query->result();
	}
	
	function postarEdicaoEvento($edicao_evento){
		 
		if(!empty($edicao_evento['id']) or $edicao_evento['id']>0){
			if($this->db->set('titulo', $edicao_evento['titulo'])
					->set('edicao', $edicao_evento['edicao'])
					->set('slogan', $edicao_evento['slogan'])
					->set('data_inicial', $edicao_evento['data_inicial'])
					->set('data_final', $edicao_evento['data_final'])
					->set('imagem_id', $edicao_evento['imagem_id'])
					->where('id =', $edicao_evento['id'])
					->update('edicao_evento'))
					//if($this->db->update('evento', $evento)->where('id','id='+$evento['id']))
			{
				echo ":-)";
				return true;;
			}else{
				echo ":-(";
				return false;
			}
		}else{
			if($this->db->insert('edicao_evento', $edicao_evento)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}
	}
	
	function salvarPainelEdicaoEvento($painelEdicaoEvento){
		if(!empty($painelEdicaoEvento['id']) or $painelEdicaoEvento['id']>0){
			if($this->db->set('titulo', $painelEdicaoEvento['titulo'])
					->set('descricao', $painelEdicaoEvento['descricao'])
					->set('data', $painelEdicaoEvento['data'])
					->set('hora', $painelEdicaoEvento['hora'])
					->set('imagem_id', $painelEdicaoEvento['imagem_id'])
					->where('id =', $painelEdicaoEvento['id'])
					->update('painel_edicao_evento'))
					//if($this->db->update('evento', $evento)->where('id','id='+$evento['id']))
			{
				echo ":-)";
				return true;;
			}else{
				echo ":-(";
				return false;
			}
		}else{
		
			if($this->db->insert('painel', $painelEdicaoEvento)){
				return $this->db->insert_id();
			}else{
				return false;
			}
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
	
	function listarPaineisEdicao($edicaoId){
		$this->db->select("e.*, e.titulo AS titulo_evento, ee.*,ee.titulo AS titulo_edicao,i.url_imagem, ee.id AS edicao_evento_id,i.nome AS nome_imagem, p.*, date_format(p.data,'%d/%m/%Y') as 'data', TIME_FORMAT(p.hora, '%H:%i') as 'hora'")
		->from('evento e')
		->join("edicao_evento ee", "ee.evento_id=e.id")
		->join('painel_edicao_evento p','p.edicao_id=ee.id')
		->join('imagem i', 'i.id=p.imagem_id')
		->where('ee.id',$edicaoId)
                 
               	->where('p.status =','ativo');
		
		$this->db->order_by('ee.id',"desc");
		$query=$this->db->get();
		return $query->result();
	}
	
	function buscarPainelEdicaoEvento($evento_id,$edicao_id, $painel_id){
		$this->db->select("pee.*, i.nome as nome_imagem, i.url_imagem")
		->join('imagem i','i.id=pee.imagem_id')
		->from('painel_edicao_evento pee')
		->where('pee.status =','ativo')
		->where('pee.id =', $painel_id);
		$query=$this->db->get();
		return $query->result();
	}
	
	function deletar_painel_edicao_evento($id){
		
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('painel_edicao_evento')){
			return true;
		}else{
			return false;
		}
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