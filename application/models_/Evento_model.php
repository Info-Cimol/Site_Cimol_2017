<?php
class Evento_model extends CI_Model{
	function listar_eventos($limit=null){
		$this->db->select("*, DATE_FORMAT(data,'%d/%m/%Y') AS data_formatada")
		->from('evento');
		$this->db->where('status =','ativo');
		if($limit!=null){
			$this->db->limit($limit);
		}
		$this->db->order_by('id',"desc");
		$query=$this->db->get();
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
		if($this->db->insert('evento', $evento)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	function buscar_evento($id){
		$this->db->select("*, DATE_FORMAT(data,'%d/%m/%Y') AS data_formatada")
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
		$this->db->where('evento_id =', $id)
		->delete('curso_evento');
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
	
	function deletar_imagem_evento($imagem_id, $evento_id){
		if($this->db->delete('imagem_evento', array('imagem_id' => $imagem_id, 'evento_id'=>$evento_id))){
			return true;
		}else{
			return false;
		}
	}
}