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
	//Dados do falecido
	$falecido=$_POST['falecido'];
	$sexo=$_POST['sexo'];
	$rg_falecido=$_POST['rg_falecido'];
	$cpf_falecido=$_POST['cpf_falecido'];
	$end_falecido=$_POST['end_falecido'];
	$end_num_falecido=$_POST['end_num_falecido'];
	$end_comp_falecido=$_POST['end_comp_falecido'];
	$cep_falecido=$_POST['cep_falecido'];
	$bairro_falecido=$_POST['bairro_falecido'];
	$cidade_falecido=$_POST['cidade_falecido'];
	$cep_falecido=$_POST['cep_falecido'];
	$uf_falecido=$_POST['uf_falecido'];
	$pai_falecido=$_POST['pai_falecido'];
	$mae_falecido=$_POST['mae_falecido'];
	$data_nasc_falecido=$_POST['data_nasc_falecido'];
	$data_falecimento=$_POST['data_falecimento'];
	$idade_falecido=$_POST['idade_falecido'];
	$est_civil_falecido=$_POST['est_civil_falecido'];
	
	//Dados do óbito
	$loc_falecimento=$_POST['loc_falecimento'];
	$causa_mortis=$_POST['causa_mortis'];
	$num_dec_obito=$_POST['num_dec_obito'];
	$autopiciado=$_POST['autopiciado'];
	$medico=$_POST['medico'];
	$crm=$_POST['crm'];
	$obs_obito=$_POST['obs_obito'];
	
	//Dados do Sepultamento
	$cemiterio=$_POST['cemiterio'];
	$possui_terreno=$_POST['possui_terreno'];
	$alvara=$_POST['alvara'];
	$funeraria=$_POST['funeraria'];
	$escolha=$_POST['escolha'];
	$taxa=$_POST['taxa'];
	$obs_sepultamento=$_POST['obs_sepultamento'];
	
	//Dados do Declarante
	$declarante=$_POST['declarante'];
	$sexo_declarante=$_POST['sexo_declarante'];
	$rg_declarante=$_POST['rg_declarante'];
	$cpf_declarante=$_POST['cpf_declarante'];
	$end_declarante=$_POST['end_declarante'];
	$end_num_declarante=$_POST['end_num_declarante'];
	$end_comp_declarante=$_POST['end_comp_declarante'];
	$cep_declarante=$_POST['cep_declarante'];
	$bairro_declarante=$_POST['bairro_declarante'];
	$cidade_declarante=$_POST['cidade_declarante'];
	$uf_declarante=$_POST['uf_declarante'];
	$parentesco_declarante=$_POST['parentesco_declarante'];
	$fone_declarante=$_POST['fone_declarante'];
	$celular_declarante=$_POST['celular_declarante'];
	$email_declarante=$_POST['email_declarante'];
	
	$sql = "INSERT INTO faf (id, falecido, sexo, rg_falecido, cpf_falecido, 
	end_falecido, end_num_falecido, end_comp_falecido, cep_falecido, bairro_falecido, 
	cidade_falecido, uf_falecido, pai_falecido, mae_falecido, data_nasc_falecido, data_falecimento, 
	idade_falecido, est_civil_falecido, loc_falecimento, causa_mortis, num_dec_obito, autopiciado, medico, 
	crm, obs_obito, cemiterio, possui_terreno, alvara, obs_sepultamento, declarante, sexo_declarante, 
	rg_declarante, cpf_declarante, end_declarante, end_num_declarante, end_comp_declarante, cep_declarante, 
	bairro_declarante, cidade_declarante, uf_declarante, parentesco_declarante, fone_declarante, celular_declarante, 
	email_declarante, funeraria, escolha, taxa) 
	VALUES(NULL,'$falecido', '$sexo', '$rg_falecido', '$cpf_falecido', '$end_falecido', '$end_num_falecido', 
	'$end_comp_falecido', '$cep_falecido', '$bairro_falecido', '$cidade_falecido', '$uf_falecido', 
	'$pai_falecido', '$mae_falecido', '$data_nasc_falecido', '$data_falecimento', '$idade_falecido', 
	'$est_civil_falecido', '$loc_falecimento', '$causa_mortis', '$num_dec_obito', '$autopiciado', '$medico', 
	'$crm', '$obs_obito', '$cemiterio', '$possui_terreno', '$alvara', '$obs_sepultamento', '$declarante', 
	'$sexo_declarante', '$rg_declarante', '$cpf_declarante', '$end_declarante', '$end_num_declarante', 
	'$end_comp_declarante', '$cep_declarante', '$bairro_declarante', '$cidade_declarante', '$uf_declarante', 
	'$parentesco_declarante', '$fone_declarante', '$celular_declarante', '$email_declarante', '$funeraria', '$escolha', '$taxa')";
	
	if($conn->query($sql) === TRUE){
		echo "<center><h1>FAF cadastrada com sucesso!</h1></center>";
	}else{
		echo "ERRO: ".$result_msg_contatos."<br />".$conn->error;
	}
	$conn->close();
	
	
	
	
?>
<center><a href="faf.php">Voltar</a> || <a href="consultarfaf.php">Imprimir</a></center>
</body>
</html>