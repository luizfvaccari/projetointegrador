<?php
	header('Content-Type: text/html; charset=utf-8');
?>

<?php
	session_start();
	include_once("conexao.php");
?>

<?php
	/*session_start();
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" /> 
	<link href="css/default.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<link href="css/foundation.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<title>FAF</title>

<!--Script para formatar mascara de entrada -->

<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>

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
	
<form class="faf" name="faf" method="post" action="cadastrarfaf.php">
<ul>
	<center><h1>FICHA DE ACOMPANHAMENTO FUNERAL!</h1></center>
<li>
	<div class="section"><span>1</span>Dados do Falecido</div>
</li>

<li>
    <input  type=text  name="falecido" required="true" class="field-style field-split align-left"  placeholder="Falecido" />
	<select required="true" class="field-style field-split align-right" name="sexo">
		<option value="" disabled selected>Sexo</option>
		<option value="masculino">Masculino</option>
		<option value="feminino">Feminino</option>
	</select>
    <input  type="text" required="true" name="rg_falecido"  id="rg_falecido" class="field-style field-split align-left" placeholder="RG" />
	<input  type="text" required="true" name="cpf_falecido" id="cpf_falecido" class="field-style field-split align-right" placeholder="CPF" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)"/>
</li>
<li>
    <input  type="text" required="true" name="end_falecido" class="field-style field-full align-none" placeholder="Endereço" />
	
</li>
<li>	
    <input  type="text" required="true" name="end_num_falecido" class="field-style field-split align-left" placeholder="Número" />
	<input  type="text" name="end_comp_falecido" class="field-style field-split align-right" placeholder="Complemento" />
	
</li>
<li>
    <input  type="text" required="true" name="cep_falecido" class="field-style field-split align-left" placeholder="CEP" maxlength="10" OnKeyPress="formatar('##.###-###', this)"/>
	<input  type="text" required="true" name="bairro_falecido" class="field-style field-split align-right" placeholder="Bairro" />
    <input  type="text" required="true" name="cidade_falecido" class="field-style field-split align-left" placeholder="Cidade" />
	<input  type="text" required="true" name="uf_falecido" maxlength="2" class="field-style field-split align-right" placeholder="UF" />
</li>
<li>
    <input type="text" name="pai_falecido" class="field-style field-split align-left" placeholder="Pai" />
    <input type="text" name="mae_falecido" class="field-style field-split align-right" placeholder="Mãe" />
</li>
<li>
    <input  type="text" name="data_nasc_falecido" class="field-style field-split align-left" placeholder="Data de Nascimento" maxlength="10" OnKeyPress="formatar('##/##/####', this)"/>
	<input  type="text" name="data_falecimento" class="field-style field-split align-right" placeholder="Data de Falecimento" maxlength="10" OnKeyPress="formatar('##/##/####', this)"/>
    <input  type="text" name="idade_falecido" class="field-style field-split align-left" placeholder="Idade" />
	<select required="true" class="field-style field-split align-right" name="est_civil_falecido">
		<option value="" disabled selected>Estado Civil</option>
		<option value="Casado(a)">Casado(a)</option>
		<option value="Solteiro(a)">Solteiro(a)</option>
		<option value="Divorciado(a)">Divorciado(a)</option>
		<option value="Viúvo(a)">Viúvo(a)</option>
		<option value="União Estável">União Estável</option>
	</select>
</li>

<li></li>

<li>
	<div class="section"><span>2</span>Dados do Óbito</div>
</li>

<li>
	<input  type="text" required="true" name="loc_falecimento" class="field-style field-split align-left" placeholder="Local do Falecimento" />
    <input  type="text" required="true" name="causa_mortis" class="field-style field-split align-right" placeholder="Causa Mortis" />
    
</li>
<li>
	<input  type="text"required="true" name="num_dec_obito" class="field-style field-split align-left" placeholder="Nº Declaração de Óbito" />
	<select required="true" class="field-style field-split align-right" name="autopiciado">
		<option value="" disabled selected>Autopiciado?</option>
		<option value="sim">Sim</option>
		<option value="não">Não</option>
	</select>
</li>
<li>	
	<input  type="text" required="true" name="medico" class="field-style field-split align-left" placeholder="Atestado pelo Médico" />
    <input  type="text" required="true" name="crm" class="field-style field-split align-right" placeholder="Registro CRM" />
</li>	
<li>
<textarea name="obs_obito" class="field-style" placeholder="Observações adicionais"></textarea>
</li>

<li> </li>

<li>
	<div class="section"><span>3</span>Dados do Sepultamento</div>
</li>

<li>
	<input type="text" required="true" name="cemiterio" class="field-style field-full align-none" placeholder="Local do Sepultamento/Cemitério" />
</li>
<li>
	<select required="true" style="width:33%"class="field-style" name="possui_terreno">
		<option value="" disabled selected>Possui Terreno?</option>
		<option value="sim">Sim</option>
		<option value="não">Não</option>
		<option value="não se aplica">Não se aplica</option>
	</select>
	<input style="width:66%" type="text" name="alvara" class="field-style align-right" placeholder="Número do Alvará" />
</li>
<li>	
    <input  type="text" required="true" name="funeraria" class="field-style field-full align-none" placeholder="Funerária que prestou o serviço" />
</li>	
<li>	
	<select required="true" class="field-style field-split align-left" name="escolha">
		<option value="" disabled selected>Tipo de escolha</option>
		<option value="plantao">plantão</option>
		<option value="particular">particular</option>
	</select>
	<select required="true" class="field-style field-split align-right" name="taxa">
		<option value="" disabled selected>Gerar Taxa?</option>
		<option value="sim">sim</option>
		<option value="não">não</option>
	</select>
</li>
	
<li>
<textarea name="obs_sepultamento" class="field-style" placeholder="Observações adicionais sobre o sepultamento"></textarea>
</li>

<li> </li>

<li>
	<div class="section"><span>4</span>Dados da Pessoa Declarante</div>
</li>
<li>
    <input  type=text name="declarante" required="true"  class="field-style field-split align-left" placeholder="Declarante" />
	<select required="true" class="field-style field-split align-right" name="sexo_declarante">
		<option value="" disabled selected>Sexo</option>
		<option value="masculino">Masculino</option>
		<option value="feminino">Feminino</option>
	</select>
</li>
<li>	
    <input  type="text" required="true" name="rg_declarante" class="field-style field-split align-left" placeholder="RG" />
	<input  type="text" required="true" name="cpf_declarante" class="field-style field-split align-right" placeholder="CPF" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)"/>
</li>
<li>
    <input  type="text" required="true" name="end_declarante" class="field-style field-full align-none" placeholder="Endereço" />
</li>
<li>	
	<input  type="text" required="true" name="end_num_declarante" class="field-style field-split align-left" placeholder="Número" />
    <input  type="text" name="end_comp_declarante" class="field-style field-split align-right" placeholder="Complemento" />
</li>
<li>
    <input  type="text" required="true" name="cep_declarante" class="field-style field-split align-left" placeholder="CEP" maxlength="10" OnKeyPress="formatar('##.###-###', this)"/>
	<input  type="text" required="true" name="bairro_declarante" class="field-style field-split align-right" placeholder="Bairro" />
</li>
<li>	
    <input  type="text" required="true" name="cidade_declarante" class="field-style field-split align-left" placeholder="Cidade" />
	<input  type="text" required="true" name="uf_declarante" maxlength="2" class="field-style field-split align-right" placeholder="UF" />
</li>

<li>
    <input  type="text" required="true" name="parentesco_declarante" class="field-style field-split align-left" placeholder="Grau de Parentesco" />
	<input  type="text" name="fone_declarante" class="field-style field-split align-right" placeholder="Telefone" maxlength="12" OnKeyPress="formatar('##-####-####', this)"/>
	
</li>
<li>	
    <input  type="text" name="celular_declarante" class="field-style field-split align-left" placeholder="Celular" maxlength="14" OnKeyPress="formatar('##-# ####-####', this)"/>
	<input  type="text" name="email_declarante" class="field-style field-split align-right" placeholder="E-mail" />
</li>
<li>	
	<input type="submit" value="Cadastrar FAF" />
</li>
</ul>
</form>

</body>
</html>
