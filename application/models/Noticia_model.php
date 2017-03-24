<?php
class Noticia_model extends CI_Model{
	
    function postar_noticia($noticia){
        if($this->db->insert('noticia', $noticia)){
        	return $this->db->insert_id();
        }else{
        	return false;
        }
    }
    
    function listar_noticias(){
        $this->db->select('*')
                ->from('noticia')
                ->where('status =','ativo')
        		->order_by('id','desc');
        $query=$this->db->get();
        return $query->result();
    }
    
    function listar_inicial(){
    	$this->db->select('*')
    		->from('noticia')
    		->where('status =','ativo')
    		->limit(5)
    		->order_by('id',"desc");
    	$query=$this->db->get();
    	return $query->result();
    	$this->db->query();
    	return $query->result();
    }
    
    function deletar_noticia($id){
        if($this->db->set('status', 'inativo')
                    ->where('id =', $id)
                    ->update('noticia')){
        	return true;
        }else{
        	return false;
        }
    }
    
    function buscar_noticia($id){
        $this->db->select('*')
            ->from('noticia')
            ->where('status =','ativo')
            ->where('id =', $id);
        $query=$this->db->get();
        return $query->result();
    }
    
    function editar($noticia, $id){
    	if($this->db->where('id', $id)
    			->update('noticia', $noticia)){
    				return true;
    	}else{
    		return false;
    	}
    }
    
    function deletar_imagem_noticia($imagem_id, $noticia_id){
    	if($this->db->delete('imagem_noticia', array('imagem_id' => $imagem_id, 'noticia_id'=>$noticia_id))){
    			return true;
    		}else{
    			return false;
    		}
    }
}