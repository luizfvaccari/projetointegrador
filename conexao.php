<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "joa@2019";
	$banco = "cemiterio";
	
	//Criar a conex�o
	$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

	if(!$conn){
		die("Falha na Conex�o: ".mysqli_connect_error());
	}else{
		//echo "Conectado com sucesso";
	}
?>
