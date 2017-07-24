<?php
class Login_model extends CI_Model{
	function autenticar($usuario, $senha){
		
                $query="SELECT usuario.id, pessoa.nome, 
						pessoa.rg, pessoa.cpf, 
						count(administrador.pessoa_id) as admin,
						count(aluno.pessoa_id) as aluno,
						count(professor.pessoa_id) as professor,
						count(pessoa.id) as pessoa from pessoa LEFT JOIN usuario ON usuario.pessoa_id = pessoa.id 
                                                LEFT JOIN email ON email.pessoa_id=pessoa.id 
                                                LEFT JOIN administrador ON administrador.pessoa_id=pessoa.id 
                                                LEFT JOIN aluno ON aluno.pessoa_id=pessoa.id 
                                                LEFT JOIN professor ON professor.pessoa_id=pessoa.id 
                                                WHERE usuario.senha = '".$senha."' AND email.email = '".$usuario."'";
                  $result = $this->db->query($query); 
                  return $result;
				/*$query = $this->db->get();
				return $query;*/
	}
	
	
	
}