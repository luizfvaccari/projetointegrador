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
		echo "FAF impressa por $email";
	}*/
?>


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/print.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <link href="css/foundation.css" rel="stylesheet">
	<title>Imprimir FAF</title>	
</head>
<body>
<script language="javascript">
	function imprime(text){
		text=document
		print(text)
	}
</script>
<center><input type="button" class="button" style="align:right" name="imprimir" value="Imprimir" onclick="imprime()" />
<br />
<img align="center" src="img/cabecalhofaf.png"/></center>
<form class="faf">

<ul>
	
	<?php
		$falecido=$_POST['falecido'];
		$sql = "SELECT * FROM faf WHERE falecido LIKE  '%".$falecido."%'";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_num_rows($res);
		if ($row>0){
			While($linha = mysqli_fetch_array($res)){
				
				//Dados da FAF
				$id = $linha['id'];
				
				//Dados do Falecido
				$falecido = $linha['falecido'];
				$sexo = $linha['sexo'];
				$rg_falecido = $linha['rg_falecido'];
				$cpf_falecido = $linha['cpf_falecido'];
				$end_falecido = $linha['end_falecido'];
				$end_num_falecido = $linha['end_num_falecido'];
				$end_comp_falecido = $linha['end_comp_falecido'];
				$cep_falecido = $linha['cep_falecido'];
				$bairro_falecido = $linha['bairro_falecido'];
				$cidade_falecido = $linha['cidade_falecido'];
				$uf_falecido = $linha['uf_falecido'];
				$pai_falecido = $linha['pai_falecido'];
				$mae_falecido = $linha['mae_falecido'];
				$data_nasc_falecido = $linha['data_nasc_falecido'];
				$data_falecimento = $linha['data_falecimento'];
				$idade_falecido = $linha['idade_falecido'];
				$est_civil_falecido = $linha['est_civil_falecido'];
				
				//Dados do Óbito
				$loc_falecimento = $linha['loc_falecimento'];
				$causa_mortis = $linha['causa_mortis'];
				$num_dec_obito = $linha['num_dec_obito'];
				$autopiciado = $linha['autopiciado'];
				$medico = $linha['medico'];
				$crm = $linha['crm'];
				$obs_obito = $linha['obs_obito'];
				
				//Dados do Sepultamento
				$cemiterio = $linha['cemiterio'];
				$possui_terreno = $linha['possui_terreno'];
				$alvara = $linha['alvara'];
				$funeraria = $linha['funeraria'];
				$escolha = $linha['escolha'];
				$taxa = $linha['taxa'];
				$obs_sepultamento = $linha['obs_sepultamento'];
				
				//Dados do Declarante
				$declarante = $linha['declarante'];
				$sexo_declarante = $linha['sexo_declarante'];
				$rg_declarante = $linha['rg_declarante'];
				$cpf_declarante = $linha['cpf_declarante'];
				$end_declarante = $linha['end_declarante'];
				$end_num_declarante = $linha['end_num_declarante'];
				$end_comp_declarante = $linha['end_comp_declarante'];
				$cep_declarante = $linha['cep_declarante'];
				$bairro_declarante = $linha['bairro_declarante'];
				$cidade_declarante = $linha['cidade_declarante'];
				$uf_declarante = $linha['uf_declarante'];
				$parentesco_declarante = $linha['parentesco_declarante'];
				$fone_declarante = $linha['fone_declarante'];
				$celular_declarante = $linha['celular_declarante'];
				$email_declarante = $linha['email_declarante'];
				
				//Imprimir Cabeçalho
				echo "<p align=right><strong>FAF Online: </strong>$id</p>";
				
				//Imprimir dados do FALECIDO
				echo "<center><strong>:: 1 :: Dados do Falecido ::</strong></center>";
				echo "<strong>Falecido: </strong>$falecido";
				echo "<strong>  Sexo: </strong>$sexo";
				echo "<strong>RG: </strong>$rg_falecido";
				echo "<strong>  CPF: </strong>$cpf_falecido<br />";
				echo "<strong>Endereço: </strong>$end_falecido";
				echo "<strong>  Número: </strong>$end_num_falecido";
				echo "<strong>  Complemento: </strong>$end_comp_falecido<br />";
				echo "<strong>CEP: </strong>$cep_falecido";
				echo "<strong>  Bairro: </strong>$bairro_falecido";
				echo "<strong>  Cidade: </strong>$cidade_falecido";
				echo "<strong> UF: </strong>$uf_falecido<br />";
				echo "<strong>Pai: </strong>$pai_falecido";
				echo "<strong>  Mãe: </strong>$mae_falecido<br />";
				echo "<strong>  Nascimento: </strong>$data_nasc_falecido";
				echo "<strong>  Falecimento: </strong>$data_falecimento";
				echo "<strong> Idade: </strong>$idade_falecido";
				echo "<strong>  Estado Civil: </strong>$est_civil_falecido<br />";
				
				//Imprimir dados do Óbito
				echo "<br /><center><strong>:: 2 :: Dados do Óbito ::</strong></center>";
				echo "<strong>Local do Falecimento: </strong>$loc_falecimento<br />";
				echo "<strong>  Causa Mortis: </strong>$causa_mortis<br />";
				echo "<strong>Número da Declaração de Óbito: </strong>$num_dec_obito";
				echo "<strong>  Autopiciado(a): </strong>$autopiciado<br />";
				echo "<strong>Médico(a): </strong>$medico";
				echo "<strong>  CRM: </strong>$crm<br />";
				echo "<strong>Observações do Óbito: </strong>$end_comp_falecido<br />";
				
				//Imprimir dados do Sepultamento
				echo "<br /><center><strong>:: 3 :: Dados do Sepultamento ::</strong></center>";
				echo "<strong>Cemiterio: </strong>$cemiterio<br />";
				echo "<strong>  Já possuia terreno?: </strong>$possui_terreno";
				echo "<strong> Número do Alvará: </strong>$alvara<br />";
				echo "<strong>Funerária que prestou o serviço: </strong>$funeraria<br />";
				echo "<strong>Tipo de Escolha: </strong>$escolha";
				echo "<strong>Gerar taxa?: </strong>$taxa<br />";
				echo "<strong>Observações do Sepultamento: </strong>$obs_sepultamento<br />";
				
				//Imprimir dados do Declarante
				echo "<br /><center><strong>:: 4 :: Dados do Declarante ::</strong></center>";
				echo "<strong>Declarante: </strong>$declarante";
				echo "<strong>  Sexo: </strong>$sexo_declarante";
				echo "<strong>  RG: </strong>$rg_declarante";
				echo "<strong>  CPF: </strong>$cpf_declarante<br />";
				echo "<strong>Endereço: </strong>$end_declarante";
				echo "<strong>  Número: </strong>$end_num_declarante";
				echo "<strong>  Complemento: </strong>$end_comp_declarante<br />";
				echo "<strong>CEP: </strong>$cep_declarante";
				echo "<strong>  Bairro: </strong>$bairro_declarante";
				echo "<strong>  Cidade: </strong>$cidade_declarante";
				echo "<strong> UF: </strong>$uf_declarante<br />";
				echo "<strong>Parentesco: </strong>$parentesco_declarante";
				echo "<strong>  Telefone: </strong>$fone_declarante<br />";
				echo "<strong>  Celular: </strong>$celular_declarante";
				echo "<strong>  Email: </strong>$email_declarante<br />";
			
			}	
			
		} else{
			echo "<br /> <hr /><center>Sua pesquisa não corresponde a nenhum registro em nosso banco de dados!</center>";
			echo "<center>Verifique e tente novamente!</center>";
			
		}
	?>

</ul>


</form>

</body>
</html>
