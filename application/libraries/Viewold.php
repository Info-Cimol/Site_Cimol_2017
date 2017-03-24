<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View {
	function __construct(){
		$CI =& get_instance();
	}
	function exibir($template, $vars=null)
	{
		if(isset($_SESSION['mensagem'])){
			$this->mostrar_mensagem();
			$this->remover_mensagem();
		}
		
		$CI->load->view('templates/header', $vars);
		$CI->load->view($template, $vars);
		$CI->load->view('templates/footer', $vars);
	}
	function adicionar_mensagem($mensagem,$classe){
		$msg['mensagem']=$mensagem;
		$msg['classe']=$classe;
		$_SESSION['mensagens'][]=$msg;
	}
	function mostrar_mensagem(){
		echo "<div id='mensagens'>";
		foreach($_SESSION['mensagens'] as $mensagem){
			echo "<div class='".$mensagem['classe']."'>";
			echo $mensagem['mensagem'];
 			echo "</div>";
		}
		echo "</div>";
		?>
			<script>
			setTimeout(function() {
				$('#mensagens').fadeOut(700);}, 5000);
			</script>
		<?php 
	}
	function remover_mensagem(){
		unset($_SESSION['mensagens']);
	}
}