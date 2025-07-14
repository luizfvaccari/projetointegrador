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
	<title>Cadastro de Funerárias</title>	
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

<form class="faf" name="funerarias" method="post" action="cadastrarfuneraria.php">
<ul>
<ul>
	<center><h1>CADASTRO DE FUNERÁRIAS!</h1></center>
<li>
<li>
    <input type="text" id="cnpj_funeraria" name="cnpj_funeraria" class="field-style field-split align-left" placeholder="CNPJ" />
    <input type="text" name="razao_funeraria" class="field-style field-split align-right" placeholder="Razão Social" />

</li>
<li>
    <input type="text" name="fone_funeraria" class="field-style field-split align-left" placeholder="Telefone" />
    <input type="email" name="email_funeraria" class="field-style field-split align-right" placeholder="E-mail" />
</li>
<li>
    <textarea name="end_funeraria" class="field-style" placeholder="Endereço"></textarea>
    
</li>

<li>
<input type="submit" value="Cadastrar" />
</li>
</ul>
</form>

</body>
</html>
