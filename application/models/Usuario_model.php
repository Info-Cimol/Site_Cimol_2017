<?php
class Usuario_model extends CI_Model{
	function autenticar($usuario, $senha){
        $query="SELECT usuario.id, pessoa.nome,pessoa.rg, pessoa.cpf, 
		count(administrador.pessoa_id) as admin,
		count(aluno.pessoa_id) as aluno,
		count(professor.pessoa_id) as professor,
        count(feintec.pessoa_id) as feintec,
        count(biblioteca.pessoa_id) as biblioteca,
        count(coordenador_curso.professor_id) as coordenador_curso,
		count(pessoa.id) as pessoa from pessoa 
        	LEFT JOIN usuario ON usuario.pessoa_id = pessoa.id 
            LEFT JOIN email ON email.pessoa_id=pessoa.id 
            LEFT JOIN administrador ON administrador.pessoa_id=pessoa.id 
            LEFT JOIN aluno ON aluno.pessoa_id=pessoa.id 
            LEFT JOIN professor ON professor.pessoa_id=pessoa.id 
            LEFT JOIN feintec ON feintec.pessoa_id=pessoa.id 
            LEFT JOIN biblioteca ON biblioteca.pessoa_id=pessoa.id 
            LEFT JOIN coordenador_curso ON coordenador_curso.professor_id=professor.id
            WHERE usuario.senha = '".$senha."' AND email.email = '".$usuario."'";
       $result = $this->db->query($query); 
       return $result;
				/*$query = $this->db->get();
				return $query;*/
	}
	
	function existe_usuario($email){
		$query="SELECT pessoa.*, pessoa.id AS pessoa_id, email.email, count(usuario.id) AS num_reg
				FROM usuario 
				LEFT JOIN pessoa on pessoa.id=usuario.pessoa_id
				LEFT JOIN email on email.pessoa_id=pessoa.id
				WHERE 
				email.email='".$email."'";
		echo $query;
		$result = $this->db->query($query);
		//print_r($result);
		if($result->row()->num_reg){
			//print_r($result->row());
			return $result->row();
		}else{
			return false;
		}
		//return $result->row()->num_reg;
	}
	
	
	function registra_chave_de_acesso($chave_de_acesso, $pessoa_id){
		/*$query="UPDATE usuario
				SET chave_de_acesso='".$chave_de_acesso.
		"' WHERE pessoa_id="+$pessoa_id;
		
		echo $query;
		
		if($this->db->query($query)){
			return true;
		}else{
			return false;
		}*/
		if($this->db->set('chave_de_acesso', $chave_de_acesso)
				->where('pessoa_id =', $pessoa_id)
				->update('usuario')){
					return true;
		}else{
			return false;
		}
		
	}
	
	
	function buscar_usuario_por_chave_de_acesso($chave_de_acesso){
		$query="SELECT pessoa.*, pessoa.id AS pessoa_id, email.email, count(usuario.id) AS num_reg
				FROM usuario
				LEFT JOIN pessoa on pessoa.id=usuario.pessoa_id
				LEFT JOIN email on email.pessoa_id=pessoa.id
				WHERE
				usuario.chave_de_acesso='".$chave_de_acesso."'";
		echo $query;
		$result = $this->db->query($query);
		//print_r($result);
		if($result->row()->num_reg){
			//print_r($result->row());
			return $result->row();
		}else{
			return false;
		}
	}
	
	function alterar_senha($chave_de_acesso, $email, $senha){
		$query="UPDATE usuario set senha=".$senha." 
				WHERE chave_de_acesso='".$chave_de_acesso."' 
				AND
				pessoa_id=(SELECT pessoa.id FROM pessoa
				JOIN email ON email.pessoa_id=pessoa.id
				WHERE email.email='".$email."')";
		if($this->db->query($query)){
			return true;
		}else{
			return false;
		}
	}
	
	function buscarNivelAdmin(){
		
		return null;
	}
}