<?php
	header('Content-Type: text/html; charset=utf-8');
?>

<?php
	session_start();
	include_once("conexao.php");
?>

<html>
<head>
	<title></title>
</head>

<body>



<?php
	$cnpj_funeraria=$_POST['cnpj_funeraria'];
	$razao_funeraria=$_POST['razao_funeraria'];
	$fone_funeraria=$_POST['fone_funeraria'];
	$email_funeraria=$_POST['email_funeraria'];
	$end_funeraria=$_POST['end_funeraria'];


	$sql = "INSERT INTO funerarias (id, cnpj_funeraria, razao_funeraria, fone_funeraria, email_funeraria, end_funeraria) 
	VALUES(NULL,'$cnpj_funeraria', '$razao_funeraria', '$fone_funeraria', '$email_funeraria', '$end_funeraria')";
	
	if($conn->query($sql) === TRUE){
		echo "<center><h1>Funerária cadastrada com sucesso!</h1></center>";
	}else{
		echo "ERRO: ".$result_msg_contatos."<br />".$conn->error;
	}
	$conn->close();
	
	
?>
<center><a href="funerarias.php">Voltar</a></center>
</body>
</html>