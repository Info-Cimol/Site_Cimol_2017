<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->data['title']="Cimol";
		if(empty($this->user_data)){
			
			$this->data['content']="formulario_login";
			
		}else{
			$this->data['content']="usuario/index";
		}
		$this->view->show_view($this->data);
		/*else if(in_array('admin', $this->user_data['permissoes'])){
			print_r($_SESSION['user_data']['permissoes']);
		}
		print_r($_SESSION);
		*/
	}
	
	
	function autenticar(){
		$this->load->model('usuario_model');
		$usuario = $this->input->post('usuario');
		$senha = md5($this->input->post('senha'));
		
		$query=$this->usuario_model->autenticar($usuario,$senha);
		$resultado=$query->row();
		
		if($resultado->pessoa > 0){
			$_SESSION['user_data']['id']=$resultado->id;
			$_SESSION['user_data']['nome']=$resultado->nome;
			$_SESSION['user_data']['rg']=$resultado->rg;
			$_SESSION['user_data']['cpf']=$resultado->cpf;
			if($resultado->admin>0){
				$_SESSION['user_data']['permissoes'][]="admin";
				$_SESSION['user_data']['permissoes']['nivel_admin']=$this->usuario_model->buscarNivelAdmin($resultado->id);
			}
			if($resultado->aluno>0){
				$_SESSION['user_data']['permissoes'][]="aluno";
			}
			if($resultado->professor>0){
				$_SESSION['user_data']['permissoes'][]="professor";
			}
			if($resultado->biblioteca>0){
				$_SESSION['user_data']['permissoes'][]="biblioteca";
			}
			if($resultado->biblioteca>0){
				$_SESSION['user_data']['permissoes'][]="feintec";
			}
			if($resultado->biblioteca>0){
				$_SESSION['user_data']['permissoes'][]="coordenador_curso";
			}
			
			if(isset($_SESSION['route'])){
				redirect($_SESSION['route'], 'refresh');
			}else{
				redirect('', 'refresh');
			}
			
		}else{
			$this->view->set_message("Login ou senha estão incorretos!","alert alert-error");
			redirect('usuario', 'refresh');
		}
		
	}
	function logout(){
		unset($_SESSION['user_data']);
		redirect('', 'refresh');
	}
	
	function esqueceu_senha(){
		
		if(empty($this->user_data)){
			
			$this->data['title']="Cimol";
			$this->data['content']="usuario/esqueceu_senha";
			$this->view->show_view($this->data);
		}
	}
	
	function mensagem_recuperar_senha(){
		$this->load->model('usuario_model');
		if($usuario=$this->usuario_model->existe_usuario($this->input->post('email'))){
			
			print_r($usuario);//verifica email
			//Registrar chave de acesso
			$chave_de_acesso=$this->obter_chave_de_acesso($usuario);
			
			if($this->usuario_model->registra_chave_de_acesso($chave_de_acesso, $usuario->pessoa_id)){
				
				$mensagem="Olá,
					<p>Você esqueceu a sua senha?</p>
					<p> Você está recebendo esta mensagem devido a uma solicitação realizada na seçaão de login 
						do site da Escola Técnica Estadual Monteiro Lobato - CIMOL</p>
					
					<p>Se isso for verdade, clique no link a seguir, para definir uma nova senha.</p>
					<a href='".base_url()."usuario/alterar_senha/".$chave_de_acesso."'>Redefinir senha</a>
					<p> Caso você não tenha realizado esta solicitação clique <a href='#'>aqui</a></p>";
					
				
				echo $mensagem;
			}else{
				
				echo ":-(";
			}
			
			//$this->input->post('email');
			
			$para=$usuario->nome;//Nome do destinatário
			$de = $this->input->post('info.cimol@gmail.com', TRUE);        //'E-mail Remetente'
			$para = $this->input->post($usuario->email, TRUE);    //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail de Destino'
			///$msg = $this->input->post('$mensagem', TRUE);      //CAPTURA O VALOR DA CAIXA DE TEXTO 'Mensagem'
			$this->load->library('email');                   //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
			$this->email->from($de, 'Administração');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
			$this->email->to($para);                         //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE
			$this->email->subject('Recuperação de senha');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
			$this->email->message($mensagem);	                 //Conteúdo da mensagem a ser enviada
			
			if($this->email->send()){//AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
				$this->view->set_message("Mensagem para recuperação de senha enviada com sucesso!", "alert alert-success");
				echo ":-)";
			}else{
				$this->view->set_message("Falha ao enviar mensagem para recuperação de senha! - ", "alert alert-error");
				echo ":-(";
			}
			
		}else{
			$this->view->set_message("usuário não encontrado!", "alert alert-success");
		}
		//print_r($_SESSION);
		//redirect('usuario/resposta_mensagem_recuperar_senha', 'refresh');
	}
	
	function resposta_mensagem_recuperar_senha(){
		$this->data['title']="Cimol";
		$this->data['content']="usuario/resposta_mensagem_recuperar_senha";
		//print_r($_SESSION);
		$this->view->show_view($this->data);
	}
	
	function solicitar_usuario(){
		$this->data['title']="Cimol";
		$this->data['content']="usuario/form_solicitar_usuario";
		
		$this->view->show_view($this->data);
	}
	
	function alterar_senha($chave_de_acesso=null){
		$this->data['title']="Cimol";
		//Verifica envio formulário
		
		$this->data['template']="usuario/alterar_senha";
		//Verificar se é um usuario logado
		if(isset($_SESSION['user_data'])){
			$this->data['usuario']=$_SESSION['user_data'];
			$this->data['usuario']['chave_de_acesso']=obter_chave_de_acesso();
			
		}else{//Caso o usuário não estiver logado
			if($chave_de_acesso){
				echo $chave_de_acesso;
				$this->load->model('usuario_model');
				if($usuario=$this->usuario_model->buscar_usuario_por_chave_de_acesso($chave_de_acesso)){
					$this->data['usuario']=$usuario;
					$this->data['usuario']->chave_de_acesso=$chave_de_acesso;
					
				}else{
					$this->view->set_message("Informações inconsistentes, para utilizar esta funcionalidade! ", "alert alert-error");
					redirect('login', 'refresh');
				}
			}else{
				$this->view->set_message("Não está autorizado a utilizar esta funcionalidade! ", "alert alert-error");
				redirect('login', 'refresh');
			}
			
		}
		$this->view->show_view($this->data);
			
	}
	
	function registrar_alteracao_senha(){
		$this->load->model('usuario_model');
		
		if($this->usuario_model->alterar_senha($this->input->post('chave_de_acesso'),$this->input->post('email'),$this->input->post('senha'))){
			$this->view->set_message("Senha alterada com sucesso! ", "alert alert-success");
			
		}else{
			$this->view->set_message("Falha na tentativa de alterar a senha! ", "alert alert-error");
				
		}
		redirect('login', 'refresh');
	}
	
	function perfil(){
		
	}
	
	function obter_chave_de_acesso($usuario){
		return md5($usuario->nome.date('s'));
	}
	
	function registrar_usuario(){
		echo $this->input->post('email');
		echo "<br/>";
		echo $this->input->post('perfil');
		//Verificar se \Usuario já existe
		$this->load->model('usuario_model');
		if($usuario=$this->usuario_model->existe_usuario($this->input->post('email'))){
			//verifica o perfil do usuario
		}else{
			//aBusca pela pessoa
			//Se a pessoa existir, busca o perfil
				//Registra o usuário
				//Envia mensagem confirmação, com link criação de senha
		}
	}
	
	
}
