<?php
	header('Content-Type: text/html; charset=utf-8');
?>

<?php
	session_start();
	include_once("conexao.php");
?>

<?php
/*	session_start();
	$email = $_SESSION['email'];
	if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])){
		header("Location:login.php");
		exit;
	} else {
		echo "$email está logado";
	}*/
?>


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/default.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <link href="css/foundation.css" rel="stylesheet">
	<title>Consultar Funerárias</title>	
</head>
<body>
	<!-- Menu superior -->
	<div class="top-bar" id="top-bar">
	  <div class="top-bar-left">
		<ul class="dropdown vertical medium-horizontal menu"> 
		  <li class="menu-text">Serviço Central de Óbitos - OnLine</li>
		  <li><a href="#"></a></li>
		  <li><a href="#"></a></li>
		</ul>
	  </div>
	  <div class="top-bar-right">
		<ul class="dropdown vertical medium-horizontal menu">
		  <li><a href="faf.php">Cadastrar FAF</a></li>
		  <li><a href="consultarfaf.php">Imprimir FAF</a></li>
		  <li><a href="funerarias.php">Cadastrar Funerárias</a></li>
		  <li><a href="consultarfunerarias.php">Consultar Funerárias</a></li>
		  <li><a class="button" href="logout.php">Sair</a></li>
		</ul>
	  </div>
	</div>




<form class="faf">

<ul>
	<center><h1>FUNERÁRIAS CADASTRADAS!</h1></center>
	<?php
		$sql = "SELECT * FROM funerarias";
		$res = mysqli_query($conn, $sql);
		$total = mysqli_num_rows($res);
		if ($total>0){
			while ($linha = mysqli_fetch_array($res)){
				$cnpj_funeraria = $linha['cnpj_funeraria'];
				$razao_funeraria = $linha['razao_funeraria'];
				$fone_funeraria = $linha['fone_funeraria'];
				$email_funeraria = $linha['email_funeraria'];
				echo "<li><strong>CNPJ: </strong>$cnpj_funeraria</li>";
				echo "<li><strong>Razão Social: </strong>$razao_funeraria</li>";
				echo "<li><strong>Telefone: </strong>$fone_funeraria</li>";
				echo "<li><strong>Email: </strong>$email_funeraria</li>";
				echo "<hr /> <br />";
			}
		} else{
			echo "<center>Ainda não foi cadastrado nenhuma funerária!</center>";
		}
	?>

</ul>
</form>

</body>
</html>
