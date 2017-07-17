<?php
class Arquivo_model extends CI_Model{
    
	
	function postar_arquivo($arquivo){
        $this->db->insert('arquivo', $arquivo);
       return $this->db->insert_id();
        
    }
    
    
        
    function buscar_arquivo($id){
    	$this->db->select('*')
    		->from('arquivo a')
    		->where('a.id', $id);
    		$query = $this->db->get();
    		return $query->result();
    }
    
    
    
    function excluir($id){
    	if($this->db->where('id='.$id)
    			->delete('arquivo')){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    function listar_arquivos(){
    	$this->db->select('*')
    	->from('arquivo');
    	
    	$query = $this->db->get();
    	return $query->result();
    }
    
    
}