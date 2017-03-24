<?php
class Curso_model extends CI_Model{
	
	function listar(){
		$this->db->select('*')
		->from('curso')
		->where('status','ativo');
		$query=$this->db->get();
		$resultado=$query->result();
		$cursos=null;
		foreach($resultado AS $curso){
			$this->db->select("s.*,sc.num_periodos,s.num_aulas_periodo")
			->from('segmento_curso sc')
			->join('segmento s', 's.id=sc.segmento_id')
			->where('sc.curso_id',$curso->id);
			$query=$this->db->get();
			$curso->segmentos=$query->result();
			$cursos[]=$curso;
		}
		return $cursos;
	}
	
	function listar_professores(){
		$this->db->select('p.id, pe.nome')
		->from('professor p')
		->join('pessoa pe','p.pessoa_id=pe.id');
		$query=$this->db->get();
		return $query->result();
	}
	
	function listar_alunos_curso($curso_id,$periodo=null){
		$this->db->select('a.*, pe.nome, m.*')
		->from('aluno a')
		->join('pessoa pe','a.pessoa_id=pe.id')
		->join('matricula m','m.aluno_id=a.id')
		->where('m.segmento_curso_curso_id', $curso_id);
		if($periodo!=null){
			$this->db->where('a.periodo', $periodo);
		}
		
		$query=$this->db->get();
		return $query->result();
	}
	
	function listar_segmentos($curso_id=null){
		$this->db->select('s.*')
		->from('segmento s');
		if($curso_id!=null){
			$this->db->join("segmento_curso sc","s.id=sc.segmento_id")
			->where('sc.curso_id',$curso_id);
		}
		$query=$this->db->get();
		return $query->result();
	}
	
	
	
	function salvar_segmento_curso($curso_id, $segmento_id, $num_periodos){
		/*$this->db->where('curso_id',$curso_id)
		->where('segmento_id',$segmento_id)
		->delete("segmento_curso");
		*/	
		$segmento_curso=array('curso_id'=>$curso_id, 'segmento_id'=>$segmento_id, 'num_periodos'=>$num_periodos);
		if($this->db->insert("segmento_curso",$segmento_curso)){
			return true;
		}else{
			return false;
		}
	}
	
	
	
	function salvar_curso($curso){
		$curso['ip'] = $_SERVER['REMOTE_ADDR'];
		$curso['usuario_id'] = $_SESSION['user_data']['id'];
		$curso['status']="ativo";
		echo $curso['id'];
		if($curso['id']==''){
			if($this->db->insert("curso",$curso)){
				return $this->db->insert_id();
			}else{
				return false;
			}
		}else{
			if($this->db->where('id', $curso['id'])
			->update('curso', $curso)){
				return $curso['id'];
			}else{
				return false;
			}
		}
	}
	function postar_curso_evento($curso, $evento_id){
		$curso_evento = array(
				"curso_geral_id" => $curso,
				"evento_id" => $evento_id,
				"ip" => $_SERVER['REMOTE_ADDR'],
				"usuario_id" => $_SESSION['user_data']['id']
		);
		$this->db->insert('curso_evento', $curso_evento);
	}
	
	function salvar_coordenador($coordenador, $curso_id=null, $professor_id=null){
		$coordenador['ip'] = $_SERVER['REMOTE_ADDR'];
		$coordenador['usuario_id'] = $_SESSION['user_data']['id'];
		if($curso_id==null){
			if($this->db->insert("coordenador_curso",$coordenador)){
				return true;
			}else{
				return false;
			}
		}else{
			if($this->db->where('curso_geral_id',$curso_id)
					->where('professor_id', $professor_id)
					->update('coordenador_curso',$coordenador)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	function buscar_curso($id){
		$this->db->select("c.*,cc.professor_id")
		->from('curso c')
		->join('coordenador_curso cc','cc.curso_id=c.id')
		->where('cc.status','ativo')
		->where('c.status','ativo')
		->where('c.id =', $id);
				
		$query=$this->db->get();
		$resultado=$query->result();
		
		
		return $resultado;
	}
	
	function buscar_segmento_curso($id){
		$this->db->select("s.*, sc.num_periodos")
		->from('segmento s')
		->join('segmento_curso sc', 'sc.segmento_id=s.id')
		->where('sc.curso_id =', $id);
		$query=$this->db->get();
		return $query->result();
	}
	
	function buscar_professores(){
		$this->db->select('pr.id, p.nome')
		->from('pessoa p')
		->join('professor pr','p.id=pr.pessoa_id');
		$query=$this->db->get();
		return $query->result();
	}
	function deletar_curso($id){
		if($this->db->set('status', 'inativo')
				->where('id =', $id)
				->update('curso')){
					return true;
		}else{
			return false;
		}
	}

	 public function grade($curso_id)
        {
            $resultado=$this->db->query("select * from segmento")->result_array();
				$segmento=null;
            foreach($resultado AS $segmento)
            {
              
					$segmento['horario']=$this->db->query("select d.periodo, d.titulo, 
                                  d.carga_horaria from curso c
                                  join disciplina d on d.segmento_curso_curso_id = c.id
                                  where c.id=".$curso_id." and d.segmento_curso_segmento_id=".$segmento['id']." order by d.periodo")->result();
            	$segmentos[]=$segmento;
				}
            return $segmentos;
            
            
           
        }


}
