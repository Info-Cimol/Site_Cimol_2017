<?php
class Projeto_model extends CI_Model{
	
	
	function listar_projetos($limit=null){
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
	
	
	function buscar_projetos_edicao_evento($mes, $ano, $dia=null){
		$query="SELECT * FROM evento WHERE status='ativo' AND MONTH(data)=".$mes." AND YEAR(data)=".$ano;
		if($dia!=null){
			$query.=" AND DAY(data)=".$dia;
		}
		$result=$this->db->query($query);
		return $result->result();
	}
	
	
	
}