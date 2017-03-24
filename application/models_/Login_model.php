<?php
class Login_model extends CI_Model{
	function autenticar($usuario, $senha){
		/*$this->db
				->select('usuario.id, pessoa.nome, 
						pessoa.rg, pessoa.cpf, 
						count(administrador.pessoa_id) as admin,
						count(aluno.pessoa_id) as aluno,
						count(professor.pessoa_id) as professor,
						count(pessoa.id) as pessoa')
				->from('pessoa')
				->join('usuario', 'usuario.pessoa_id = pessoa.id', 'left')
				->join('email', 'pessoa.id = email.pessoa_id','left')
				->join('administrador', 'pessoa.id=administrador.pessoa_id', 'left')
				->join('aluno', 'pessoa.id=aluno.pessoa_id', 'left')
				->join('professor', 'pessoa.id=professor.pessoa_id', 'left')
				->where('usuario.senha =',$senha)
				->where('email.email =',$usuario);*/
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