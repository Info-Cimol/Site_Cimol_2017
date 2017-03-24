<?php
class Imagem_model extends CI_Model{
    function postar_imagem_noticia($imagem, $noticia_id){
        $this->db->insert('imagem', $imagem);
        $imagem_id=$this->db->insert_id();
        $imagem_noticia = array(
            "imagem_id" => $imagem_id,
            "noticia_id" => $noticia_id,
        	"ip" => $_SERVER['REMOTE_ADDR']
        );
        $this->db->insert('imagem_noticia', $imagem_noticia);
    }
    function postar_imagem_evento($imagem, $evento_id){
    	$this->db->insert('imagem', $imagem);
    	$imagem_id=$this->db->insert_id();
    	$imagem_evento = array(
    			"imagem_id" => $imagem_id,
    			"evento_id" => $evento_id,
    			"ip" => $_SERVER['REMOTE_ADDR']
    	);
    	$this->db->insert('imagem_evento', $imagem_evento);
    }
    
    function postar_imagem($imagem){
    	$this->db->insert('imagem', $imagem);
    	$this->db->select('id')
    			->from('imagem')
    			->order_by('id','DESC')
    			->limit(1);
    	$resultado=$this->db->get();
    	$imagem= $resultado->result();
    	return $imagem[0]->id;
    }
    
    function buscar_imagem($id){
    	$this->db->select('*')
    		->from('imagem i')
    		->where('i.id', $id);
    		$query = $this->db->get();
    		return $query->result();
    }
    
    
    function buscar_imagem_join($id){
    	$this->db->select('i.*, count(in.imagem_id) as noticia, count(ie.imagem_id) as evento ')
    	->from('imagem i')
    	->join('imagem_noticia in','i.id=in.imagem_id','left')
    	->join('imagem_evento ie','i.id=ie.imagem_id','left')
        /*->join('noticia n','in.noticia_id=n.id','left')
        ->join('evento e','e.id=ie.evento_id','left')
        ->where('n.status !=','inativo')
        ->or_where('e.status !=','inativo')*/
    	->where('i.id', $id);
    	$query = $this->db->get();
    	return $query->result();
    }
    function deletar($id){
    	if($this->db->where('id='.$id)
    			->delete('imagem')){
    		return true;
    	}else{
    		return false;
    	}
    }
    function buscar_imagens($id){
    	$this->db->select('i.*, noticia_id as noticia_id')
    		->from('imagem i')
    		->join('imagem_noticia in', 'in.imagem_id=i.id')
    		->join('noticia n', 'in.noticia_id=n.id')
    		->order_by("id", "DESC")
    		->where('n.id', $id);
    	
    		$query = $this->db->get();
    		return $query->result();
    }
    function buscar_imagens_noticia($id){
    	$this->db->select('i.*, noticia_id as noticia_id')
    	->from('imagem i')
    	->join('imagem_noticia in', 'in.imagem_id=i.id')
    	->join('noticia n', 'in.noticia_id=n.id')
    	->order_by("id", "DESC")
    	->where('n.id', $id);
    	 
    	$query = $this->db->get();
    	return $query->result();
    }
    function buscar_imagens_evento($id){
    	$this->db->select('i.*, evento_id as evento_id')
    	->from('imagem i')
    	->join('imagem_evento ie', 'ie.imagem_id=i.id')
    	->join('evento e', 'ie.evento_id=e.id')
    	->where('e.id', $id);
    	$query = $this->db->get();
    	return $query->result();
    }
    function listar_imagens(){
    	$this->db->select('*')
    	->from('imagem i')
    	->join('imagem_noticia in', 'in.imagem_id=i.id')
    	->join('noticia n', 'in.noticia_id=n.id');
    	$query = $this->db->get();
    	return $query->result();
    }
    function listar_todas_imagens(){
    	$this->db->select('*')
    	->from('imagem')
    	->order_by("id", "desc");
    	$query = $this->db->get();
    	return $query->result();
    }
    function listar_imagem_noticia($id){
    	$this->db->select('*')
    	->from('imagem_noticia in')
    	->join('imagem i', 'in.imagem_id=i.id')
    	->where('in.noticia_id', $id)
    	->order_by("id", "asc")
    	->limit(1);
    	$query = $this->db->get();
    	return $query->result();
    }
    /*
    function listar_imagem_evento($id){
    	$this->db->select('*')
    	->from('imagem_evento ie')
    	->join('imagem i', 'ie.imagem_id=i.id')
    	->where('ie.evento_id', $id)
    	->order_by("id", "asc")
    	->limit(1);
    	$query = $this->db->get();
    	return $query->result();
    }
    */
}