<?php
	session_start();
	include_once("conexao.php");
	if((isset($_POST['email'])) && (isset($_POST['senha']))){
		//$usuario = mysqli_real_escape_string($conn, $_POST['email']);
		//$senha = mysqli_real_escape_string($conn, $_POST['senha']);
		//$senha = md5($senha);
		$usuario = $_POST['email'];
		$senha = $_POST['senha'];
		$sql = "SELECT * FROM usuarios WHERE email = '$usuario' && senha = '$senha'";
		$result = mysqli_query($conn, $sql);
		$resultado = mysqli_fetch_assoc($result);
		
		if (empty($resultado)){
			$_SESSION['loginErro'] = "Usuário ou senha invalido";
			header("Location:login.php");
		}elseif(isset($resultado)){
			header("Location:faf.php");
		}else{
			$_SESSION['loginErro'] = "Usuário ou senha invalido";
			header("Location:login.php");
		}
	}else{
		$_SESSION['loginErro'] = "Usuário ou senha invalido";
		header("Location:login.php");
	}
?>