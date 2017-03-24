<?php
	
		$mysqli=new mysqli("localhost","root","vertrigo","bancodecursos");
					
			if(mysqli_connect_error()){
				echo "Falha ao conectar";
			}else{
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$matricula = $_POST['matricula'];
				$id= $_POST['id'];
				
				$sqln="UPDATE aluno SET nome='".$nome."',matricula=".$matricula.",email='".$email."'WHERE id=".$id;
				
				
				$resultado=$mysqli->query($sqln);
				header("location:alunos.php");
		//executar instruçao no banco
		
		
		
		//retornar para pagina alunos
		thtthth
			}



?>