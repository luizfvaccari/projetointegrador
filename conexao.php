<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "senha";
	$banco = "cemiterio";
	
	//Criar a conexão
	$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

	if(!$conn){
		die("Falha na Conexão: ".mysqli_connect_error());
	}else{
		//echo "Conectado com sucesso";
	}
?>
