<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View {
	
	private $CI;
	
	function __construct(){
		$this->CI =& get_instance();
	}
	function show_view($vars=null)
	{
		if(isset($_SESSION['messages'])){
			$this->show_message();
			$this->remove_message();
		}
		$this->CI->load->view('temas/default/default', $vars);
	}
	function set_message($message,$class){
		$msg['message']=$message;
		$msg['class']=$class;
		$_SESSION['messages'][]=$msg;
	}
	function show_message(){
		echo "<div id='messages'>";
		foreach($_SESSION['messages'] as $message){
			echo "<div class='".$message['class']."'>";
			echo $message['message'];
 			echo "</div>";
		}
		echo "</div>";
		?>
			<script>
			setTimeout(function() {
				$('#messages').fadeOut(700);}, 5000);
			</script>
		<?php 
	}
	function remove_message(){
		unset($_SESSION['messages']);
	}
}