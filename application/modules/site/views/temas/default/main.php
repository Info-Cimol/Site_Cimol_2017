<main>
<div style="width:100%; background-color:#fde550; padding:15px">
	<p style="font-size:18px">Em atendimento a legislação, a partir do dia 7 de julho até o final do período eleitoral, estão suspensas as atualizações deste site.</p>

</div>
<div id='messages'>
<?php
	if(isset($_SESSION['messages'])){
		foreach($_SESSION['messages'] as $message){
			echo "<div class='".$message['class']."'>";
			echo $message['message'];
 			echo "</div>";
		}
		unset($_SESSION['messages']);
	}
?>
	<script>
		setTimeout(function() {
		$('#messages').fadeOut(700);}, 5000);
	</script>
</div>
<?php

include APPPATH."modules/site/views/".$content.".php";

?>

</main>