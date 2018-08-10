<?php
class Horario_turma_model extends CI_Model{
	function listar($id_turma){
		$this->db->select('s.nome as segmento, s.id as segmento_id,
        c.titulo as curso, t.nome as turma, t.id as turma_id, d.titulo as disciplina, 
        d.id as disciplina_id, dtp.dia as dia, p.turno as turno, p.ordem as ordem, 
        p.inicio as inicio, p.id as periodo_id,  pe.nome as professor, pr.id as professor_id, sa.nome as sala, sa.id as sala_id,
        dtp.disciplina_turma_id as disciplina_turma_id')
		->from('curso c')
		->join('segmento_curso sc','sc.curso_id=c.id')
		->join('segmento s','s.id=sc.segmento_id')
		->join('turma t','t.segmento_curso_segmento_id=s.id and t.segmento_curso_curso_id=c.id')
		->join('disciplina_turma dt','dt.turma_id=t.id')
		->join('disciplina d', 'd.id=dt.disciplina_id')
		->join('disciplina_turma_periodo dtp', 'dtp.disciplina_turma_id=dt.id')
		->join('periodo p', 'dtp.periodo_id = p.id')
		->join('professor pr', 'dt.professor_id = pr.id')
		->join('pessoa pe', 'pr.pessoa_id = pe.id')
		->join('sala sa' , 'dtp.sala_id = sa.id')
		
		->where('dt.turma_id',$id_turma);
		$query=$this->db->get();
		$resultado = $query->result();
		
		return $resultado;
		
	}
	
	function listar_aluno($id_turma){
	    if ($this->db->select('*')->from('view_consulta_horario')
	        ->where('turma_id',$id_turma)
	        ->where('dia','seg')
	        ->order_by('inicio','asc')) {
	            $query=$this->db->get();
	            
	            $resultado->seg = $query->result();
	            
	        }
	        if ($this->db->select('*')->from('view_consulta_horario')
	            ->where('turma_id',$id_turma)
	            ->where('dia','ter')
	            ->order_by('inicio','asc')){
	           $query=$this->db->get();
	           $resultado->ter = $query->result();
	   }
	   if ($this->db->select('*')->from('view_consulta_horario')
	       ->where('turma_id',$id_turma)
	       ->where('dia','qua')
	       ->order_by('inicio','asc')){
	           $query=$this->db->get();
	           $resultado->qua = $query->result();
	   }
	   if ($this->db->select('*')->from('view_consulta_horario')
	       ->where('turma_id',$id_turma)
	       ->where('dia','qui')
	       ->order_by('inicio','asc')){
	           $query=$this->db->get();
	           $resultado->qui = $query->result();
	   }
	   if ($this->db->select('*')->from('view_consulta_horario')
	       ->where('turma_id',$id_turma)
	       ->where('dia','sex')
	       ->order_by('inicio','asc')){
	           $query=$this->db->get();
	           $resultado->sex = $query->result();
	   }
	    //print_r($resultado);
	    return $resultado;
	}
	
	function listar_salas(){
	    $this->db->select('s.*')
	    ->from('sala s');
	    $query=$this->db->get();
	    return $query->result();
	}
	
	function listar_periodos($turno){
	    if($turno==1){
    	    $this->db->select('p.*')
    	    ->from('periodo p')
    	    ->where("p.final < '12:00:00'");
	    }else if($turno==2){
	        $this->db->select('p.*')
	        ->from('periodo p')
	        ->where("p.inicio > '12:59:00'");
	    }
	    $query=$this->db->get();
	    return $query->result();
	}
	
	function listar_disciplinas_curso($id_turma){
	    $this->db->select('d.*, dt.id as disciplina_turma_id')
	    ->from('disciplina d')
	    ->join('disciplina_turma dt','dt.disciplina_id=d.id')
	    ->join('turma t','dt.turma_id=t.id')
	    ->join('curso c','t.segmento_curso_curso_id=c.id')
	    ->join('professor p','dt.professor_id=p.id')
	    ->join('pessoa pe', 'p.pessoa_id=pe.id')
	    ->where("dt.status","ativo")
	    ->where("dt.turma_id", $id_turma)
	    ->group_by("d.id");
	    $query=$this->db->get();
	    return $query->result();
	    
	}
	
	
	
	function salvar($horario){
	    
	    if($this->db->insert("disciplina_turma_periodo",$horario)){
	        return true;
	    }else{
	        return false;
	    }
	    
	    }
	
	
	
	function buscar($disciplina_turma_id,$periodo_id,$sala_id){
		
	    $this->db->select('s.nome as segmento, s.id as segmento_id,
        c.titulo as curso, t.nome as turma, t.id as turma_id, d.titulo as disciplina,
        d.id as disciplina_id, dtp.dia as dia, p.turno as turno, p.ordem as ordem,
        p.inicio as inicio, p.id as periodo_id,  pe.nome as professor, pr.id as professor_id, sa.nome as sala,sa.id as sala_id,
        dtp.disciplina_turma_id as disciplina_turma_id')
        ->from('curso c')
        ->join('segmento_curso sc','sc.curso_id=c.id')
        ->join('segmento s','s.id=sc.segmento_id')
        ->join('turma t','t.segmento_curso_segmento_id=s.id and t.segmento_curso_curso_id=c.id')
        ->join('disciplina_turma dt','dt.turma_id=t.id')
        ->join('disciplina d', 'd.id=dt.disciplina_id')
        ->join('disciplina_turma_periodo dtp', 'dtp.disciplina_turma_id=dt.id')
        ->join('periodo p', 'dtp.periodo_id = p.id')
        ->join('professor pr', 'dt.professor_id = pr.id')
        ->join('pessoa pe', 'pr.pessoa_id = pe.id')
        ->join('sala sa' , 'dtp.sala_id = sa.id')
		->where('dtp.disciplina_turma_id =',$disciplina_turma_id)
		->where('dtp.periodo_id =',$periodo_id)
		->where('dtp.sala_id =',$sala_id);
		$query=$this->db->get();
		//print_r($query->result());
		return $query->row();
	}
	
	
	function deletar($disciplina_turma_id, $periodo_id){
	    
	       
		if($this->db->where('disciplina_turma_id', $disciplina_turma_id)
		             ->where('periodo_id',$periodo_id)
				    ->delete('disciplina_turma_periodo')){
					return true;
		}else{
			return false;
		}
	}
}