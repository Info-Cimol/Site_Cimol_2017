<?php
class Noticia_model extends CI_Model{
	
    function postar_noticia($noticia){
    	echo $noticia['id'];
    	if(empty($noticia['id'])){
	        if($this->db->insert('noticia', $noticia)){
	        	return $this->db->insert_id();
	        }else{
	        	return false;
	        }
    	}else{
    		if($this->db->where('id', $noticia['id'])
    				->update('noticia', $noticia)){
    			return true;
    		}else{
    			return false;
    		}
    		
    	}
    }
    
    function listar_noticias($limit=null){
        $this->db->select("n.*,date_format(n.data_postagem,'%d/%m/%Y') as data_noticia")
                ->from('noticia n')
               
                ->where('n.status =','ativo')
        		->order_by('n.id','desc');
        if($limit){
        	$this->db->limit($limit);
        }
        $query=$this->db->get();
        return $query->result();
    }
    
    function listar_inicial(){
    	$this->db->select('n.id, n.titulo, n.resumo, n.url_imagem, n.arquivo_imagem, date_format(n.data_postagem,"%d/%m/%Y") AS data_postagem')
    		->from('noticia n')
    		->where('n.status =','ativo')
    		->limit(5)
    		->order_by('n.id',"desc");
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
        $this->db->select("*,date_format(data_postagem,'%d/%m/%Y') as data_noticia ")
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