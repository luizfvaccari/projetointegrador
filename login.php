

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/default.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<link href="css/foundation.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<title>Login</title>
</head>
<body style="max-width: 400px; margin: 50px auto">

<form class="faf" name="loginform" method="post" action="valida.php">
<ul> 
	<center><h1>Acesso Restrito!<span>Central Municipal de Óbitos - OnLine<br>Em Desenvolvimento por Luiz Fernando Vaccari</span>
	<span></span></h1></center>

<li>
	<input type="text" name="email" class="field-style field-full align-none" placeholder="E-mail / Usuario" />
</li>	
<li>	
	<input type="password" name="senha" class="field-style field-full align-none" placeholder="Senha" />
</li>

<li>
	<input type="submit" value="Entrar" />
</li>
</ul>

</form>
<script>
  if (typeof navigator.serviceWorker !== 'undefined') {
    navigator.serviceWorker.register('service-worker.js')
  }
</script>

</body>
</html>
