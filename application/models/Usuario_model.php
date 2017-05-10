<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Classe responsavel por todas as intera��es de usuarios com a base de dados.
 */
class Usuario_model extends CI_Model{
	/**
	 * Fun��o responsavel pela autentica��o dos usuarios pelo e-mail e senha.
	 * @param $usuario
	 * @param $senha
	 * @return $result
	 */
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
	}
	/**
	 * Fun��o que verifica se existe um usuario para o email cadastrado.
	 * @param unknown $email
	 * @return boolean
	 */
	function existe_usuario($email){
		$query="SELECT pessoa.*, pessoa.id AS pessoa_id, email.email, count(usuario.id) AS num_reg
				FROM usuario 
				LEFT JOIN pessoa on pessoa.id=usuario.pessoa_id
				LEFT JOIN email on email.pessoa_id=pessoa.id
				WHERE 
				email.email='".$email."'";
		echo $query;
		$result = $this->db->query($query);
		// Se existir um usuario retorna verdadeiro
		if($result->row()->num_reg){
			return $result->row();
		}
		// Se n�o existir um usuario retorna falso
		else{
			return false;
		}
	}
	/**
	 * Fun��o responsavel pelo registro da chave de acesso do usuario
	 * @param unknown $chave_de_acesso
	 * @param unknown $pessoa_id
	 * @return boolean
	 */
	function registra_chave_de_acesso($chave_de_acesso, $pessoa_id){
		//Faz o registro da chave de licen�a e retorna verdadeiro
		if($this->db->set('chave_de_acesso', $chave_de_acesso)
				->where('pessoa_id =', $pessoa_id)
				->update('usuario')){
					return true;
		}
		//Retorna falso se o registro da chave de licen�a n�o foi efetuado.
		else{
			return false;
		}
		
	}
	/**
	 * Fun��o responsavel por buscar se existe a chave de acesso do usuario
	 * @param unknown $chave_de_acesso
	 * @return boolean
	 */
	function buscar_usuario_por_chave_de_acesso($chave_de_acesso){
		//Faz a consulta no banco de dados
		$query="SELECT pessoa.*, pessoa.id AS pessoa_id, email.email, count(usuario.id) AS num_reg
				FROM usuario
				LEFT JOIN pessoa on pessoa.id=usuario.pessoa_id
				LEFT JOIN email on email.pessoa_id=pessoa.id
				WHERE
				usuario.chave_de_acesso='".$chave_de_acesso."'";
		echo $query;
		// Passa o valor da connsulta para uma variavel
		$result = $this->db->query($query);
		if($result->row()->num_reg){
			//Retorna o usuario para a chave de acesso solicitada
			return $result->row();
		}else{
			//Se a chave de acesso n�o existir retorna falso
			return false;
		}
	}
	/**
	 * Fun��o responsavel pela altera��o de senha.
	 * @param unknown $chave_de_acesso
	 * @param unknown $email
	 * @param unknown $senha
	 * @return boolean
	 */
	function alterar_senha($chave_de_acesso, $email, $senha){
		$query="UPDATE usuario set senha=".$senha." 
				WHERE chave_de_acesso='".$chave_de_acesso."' 
				AND
				pessoa_id=(SELECT pessoa.id FROM pessoa
				JOIN email ON email.pessoa_id=pessoa.id
				WHERE email.email='".$email."')";
		//retorna que a altera��o foi feita com sucesso
		if($this->db->query($query)){
			return true;
		}
		//retorna que a altera��o n�o foi feita 
		else{
			return false;
		}
	}
	/**
	 * Fun��o responsavel por ativar ou desativar usuarios
	 * @param unknown $status
	 * @param unknown $id
	 * @return boolean
	 */
	function status_usuario($status,$id){
		$query="UPDATE usuario SET status='$status' 
				WHERE pessoa_id='$id'";
		//retorna que a altera��o foi feita com sucesso
		if($this->db->query($query)){
			return true;
		}
		//retorna que a altera��o n�o foi feita 
		else{
			return false;
		}
	}
	function buscarNivelAdmin(){
		
		return null;
	}
}