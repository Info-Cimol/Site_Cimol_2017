<?php
class Evento_model extends CI_Model{
	
	
	function listar_eventos($limit=null){
		//$this->db->select("*, DATE_FORMAT(data,'%d/%m/%Y') AS data_formatada")
		$this->db->select("e.*, i.nome AS nome_imagem, i.url_imagem")
		->from('evento e')
		->join('imagem i','e.imagem_id=i.id');
		$this->db->where('status =','ativo');
		/*if($limit!=null){
			$this->db->limit($limit);
		}*/
		$this->db->order_by('id',"desc");
		$query=$this->db->get();
		//print_r($query->result());
		return $query->result();
	}
	
	
	function buscar_eventos_mes($mes, $ano, $dia=null){
		$query="SELECT * FROM evento WHERE status='ativo' AND MONTH(data)=".$mes." AND YEAR(data)=".$ano;
		if($dia!=null){
			$query.=" AND DAY(data)=".$dia;
		}
		$result=$this->db->query($query);
		return $result->result();
	}
	
	function postar_evento($evento){
		print_r($evento);
		if($evento['id']!=''){
			if($this->db->set('titulo', $evento['titulo'])
					->set('resumo', $evento['resumo'])
					->set('descricao', $evento['descricao'])
					->set('imagem_id', $evento['imagem_id'])
					->where('id =', $evento['id'])
					->update('evento'))
			//if($this->db->update('evento', $evento)->where('id','id='+$evento['id']))
			{
				return true;;
			}else{
				return false;
			}
		}else{
			if($this->db->insert('evento', $evento)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}
	}
	
	function buscar_evento($id){
		//$this->db->select("*, DATE_FORMAT(data,'%d/%m/%Y') AS data_formatada")
		$this->db->select("e.*, i.nome AS nome_imagem, i.url_imagem ")
		->from('evento e')
		->join('imagem i','i.id=e.imagem_id')
		->where('e.status =','ativo')
		->where('e.id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	
	function listar_edicoes($evento_id,$id=null){
		$this->db->select("ee.*, DATE_FORMAT(data_inicial,'%d/%m/%Y') AS data_inicial_formatada,
				DATE_FORMAT(data_final,'%d/%m/%Y') AS data_final_formatada, 
				e.titulo AS titulo_evento, 
				e.descricao AS descricao_evento")
		->from('edicao_evento ee')
		->join('evento e','e.id=ee.evento_id')
		->where('ee.status =','ativo')
		->where('e.id =', $evento_id);
		if($id!=null){
			$this->db->where('ee.id =', $id);
		}
		$query=$this->db->get();
		return $query->result();
	}
	
	function listar_imagens_edicao($evento_id){
		$this->db->select("i.id,i.nome, i.url_imagem")
					->from('edicao_evento ee')
					->join('imagem_edicao_evento iee', 'ee.id=iee.edicao_evento_id')
					->join('imagem i','i.id=iee.imagem_id')
					->where('ee.status =','ativo')
					->where('ee.id =', $evento_id);
		if($evento_id!=null){
			$this->db->where('ee.id =', $evento_id);
		}
		$query=$this->db->get();
		return $query->result();
	}
	
	
	
	
	function deletar_edicao_evento($id){
		
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('edicao_evento')){
			return true;
		}else{
			return false;
		}
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
	
	function deletar_imagem_edicao($imagem_id, $edicao_id){
		if($this->db->delete('imagem_edicao_evento', array('imagem_id' => $imagem_id, 'edicao_evento_id'=>$edicao_id))){
			echo ":-)";
			return true;
		}else{
			echo ":-(";
			return false;
		}
	}
	
	function listar_edicoes_evento($evento_id){
		$this->db->select("ee.*, i.nome AS nome_imagem, i.url_imagem, e.titulo AS titulo_evento")
		->from('edicao_evento ee')
		->join('imagem i','ee.imagem_id=i.id')
		->join('evento e','e.id=ee.evento_id')
		->where('ee.evento_id',$evento_id);
		$this->db->where('ee.status =','ativo');
		
		$this->db->order_by('id',"desc");
		$query=$this->db->get();
		return $query->result();
	}
	
	function listar_paineis_edicao($evento_id,$edicao){
		$this->db->select("p.*, ee.titulo AS titulo_edicao, i.nome AS nome_imagem, i.url_imagem, e.titulo AS titulo_evento")
		->from('painel p')
		->from('edicao_evento ee','p.edicao_evento_id=ee.id')
		->join('imagem i','ee.imagem_id=i.id')
		->join('evento e','e.id=ee.evento_id')
		->where('ee.evento_id',$evento_id);
		$this->db->where('ee.status =','ativo');
	
		$this->db->order_by('id',"desc");
		$query=$this->db->get();
		return $query->result();
	}
	
	function postar_edicao_evento($edicao_evento){
		print_r($edicao_evento);
		if($edicao_evento['id']!=''){
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
			echo ":->";
			if($this->db->insert('edicao_evento', $edicao_evento)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}
	}
	
	function postar_painel_edicao_evento($painel){
		print_r($painel);
		if($painel['id']!=''){
			if($this->db->set('titulo', $edicao_evento['titulo'])
					->set('datal', $edicao_evento['data'])
					->set('hora', $edicao_evento['horas'])
					->set('imagem_id', $edicao_evento['imagem_id'])
					->where('id =', $edicao_evento['id'])
					->update('painel'))
					//if($this->db->update('evento', $evento)->where('id','id='+$evento['id']))
			{
				echo ":-)";
				return true;;
			}else{
				echo ":-(";
				return false;
			}
		}else{
			echo ":->";
			if($this->db->insert('painel', $painel)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}
	}
	
	
	
	function postar_imagem_edicao($imagem_edicao){
		
		if($this->db->insert('imagem_edicao_evento', $imagem_edicao)){
			return $this->db->insert_id();
		}else{
			return false;
		}
		
	}
	
}