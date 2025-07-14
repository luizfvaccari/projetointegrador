<?php
	header('Content-Type: text/html; charset=utf-8');
?>

<?php
	session_start();
	include_once("conexao.php");
?>

<html>
<head><title></title>
	<script type="text/javascript">
	function loginsuccessfully(){
		setTimeout("window.location='faf.php'", 5000);
	}
	
	function loginfailed(){
		setTimeout("window.location='login.php'", 5000);
	}
	</script>
</head>
<body>
<?php
$email=$_POST['email'];
$senha=$_POST['senha'];
$sql=mysql_query("SELECT * FROM usuarios WHERE email='$email' and senha='$senha' ") or die (mysql_error());
$row=mysql_num_rows($sql);
if ($row > 0){
	//session_start();
	$_SESSION['email']=$_POST['email'];
	$_SESSION['senha']=$_POST['senha'];
	echo "<center>Usuário autenticado com sucesso! Aguarde um instante.</center>";
	echo "<script>loginsuccessfully()</script>";
}else{
	echo "<center>Dados inválidos. Aguarde um instante para tentar novamente<center>";
	echo "<script>loginfailed()</script>";
}
?>
</body>
</html>
