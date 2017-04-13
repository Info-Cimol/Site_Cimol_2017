<?php
if(isset($_SESSION['messages'])){
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
					$('#messages').fadeOut(1500);}, 5000);
				</script>
	<?php 
	unset($_SESSION['messages']);
}	