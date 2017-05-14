<main>
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