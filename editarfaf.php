<?php
// editarfaf.php
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once("conexao.php"); // Inclui o arquivo de conexão

// Bloco de verificação de login (descomente se estiver usando)
/*
if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])){
    header("Location: login.php");
    exit;
}
*/

$registro = null;
$mensagem_status = "";

// 1. Lógica para CARREGAR os dados do registro para edição
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_faf = $_GET['id'];

    // Prepared Statement para SELECT
    $stmt_select = $conn->prepare("SELECT * FROM faf WHERE id = ?");
    $stmt_select->bind_param("i", $id_faf); // "i" para inteiro (ID)
    $stmt_select->execute();
    $resultado_select = $stmt_select->get_result();

    if ($resultado_select->num_rows > 0) {
        $registro = $resultado_select->fetch_assoc();
    } else {
        $mensagem_status = "Registro não encontrado.";
    }
    $stmt_select->close();
}

// 2. Lógica para ATUALIZAR os dados quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_faf'])) {
    $id_faf_atualizar = $_POST['id_faf'];

    // Coleta dos dados do formulário
    // É CRUCIAL que VOCÊ adicione TODAS as variáveis para todos os campos que deseja editar.
    // Use o array $registro como guia para os nomes das colunas.
    $falecido = $_POST['falecido'];
    $sexo = $_POST['sexo'];
    $rg_falecido = $_POST['rg_falecido'];
    $cpf_falecido = $_POST['cpf_falecido'];
    $end_falecido = $_POST['end_falecido'];
    $end_num_falecido = $_POST['end_num_falecido'];
    $end_comp_falecido = $_POST['end_comp_falecido'];
    $cep_falecido = $_POST['cep_falecido'];
    $bairro_falecido = $_POST['bairro_falecido'];
    $cidade_falecido = $_POST['cidade_falecido'];
    $uf_falecido = $_POST['uf_falecido'];
    $pai_falecido = $_POST['pai_falecido'];
    $mae_falecido = $_POST['mae_falecido'];
    $data_nasc_falecido = $_POST['data_nasc_falecido'];
    $data_falecimento = $_POST['data_falecimento'];
    $idade_falecido = $_POST['idade_falecido'];
    $est_civil_falecido = $_POST['est_civil_falecido'];

    // Dados do Óbito
    $loc_falecimento = $_POST['loc_falecimento'];
    $causa_mortis = $_POST['causa_mortis'];
    $num_dec_obito = $_POST['num_dec_obito'];
    $autopiciado = $_POST['autopiciado'];
    $medico = $_POST['medico'];
    $crm = $_POST['crm'];
    $obs_obito = $_POST['obs_obito'];

    // Dados do Sepultamento
    $cemiterio = $_POST['cemiterio'];
    $possui_terreno = $_POST['possui_terreno'];
    $alvara = $_POST['alvara'];
    $funeraria = $_POST['funeraria'];
    $escolha = $_POST['escolha'];
    $taxa = $_POST['taxa'];
    $obs_sepultamento = $_POST['obs_sepultamento'];

    // Dados do Declarante
    $declarante = $_POST['declarante'];
    $sexo_declarante = $_POST['sexo_declarante'];
    $rg_declarante = $_POST['rg_declarante'];
    $cpf_declarante = $_POST['cpf_declarante'];
    $end_declarante = $_POST['end_declarante'];
    $end_num_declarante = $_POST['end_num_declarante'];
    $end_comp_declarante = $_POST['end_comp_declarante'];
    $cep_declarante = $_POST['cep_declarante'];
    $bairro_declarante = $_POST['bairro_declarante'];
    $cidade_declarante = $_POST['cidade_declarante'];
    $uf_declarante = $_POST['uf_declarante'];
    $parentesco_declarante = $_POST['parentesco_declarante'];
    $fone_declarante = $_POST['fone_declarante'];
    $celular_declarante = $_POST['celular_declarante'];
    $email_declarante = $_POST['email_declarante'];


    // Prepared Statement para UPDATE
    // Adapte este SQL para incluir TODOS os campos que você deseja permitir a edição.
    // Lembre-se de que cada '?' deve corresponder a uma variável no bind_param.
    $sql_update = "UPDATE faf SET
                   falecido = ?, sexo = ?, rg_falecido = ?, cpf_falecido = ?, end_falecido = ?,
                   end_num_falecido = ?, end_comp_falecido = ?, cep_falecido = ?, bairro_falecido = ?,
                   cidade_falecido = ?, uf_falecido = ?, pai_falecido = ?, mae_falecido = ?,
                   data_nasc_falecido = ?, data_falecimento = ?, idade_falecido = ?,
                   est_civil_falecido = ?, loc_falecimento = ?, causa_mortis = ?,
                   num_dec_obito = ?, autopiciado = ?, medico = ?, crm = ?, obs_obito = ?,
                   cemiterio = ?, possui_terreno = ?, alvara = ?, funeraria = ?, escolha = ?,
                   taxa = ?, obs_sepultamento = ?, declarante = ?, sexo_declarante = ?,
                   rg_declarante = ?, cpf_declarante = ?, end_declarante = ?,
                   end_num_declarante = ?, end_comp_declarante = ?, cep_declarante = ?,
                   bairro_declarante = ?, cidade_declarante = ?, uf_declarante = ?,
                   parentesco_declarante = ?, fone_declarante = ?, celular_declarante = ?,
                   email_declarante = ?
                   WHERE id = ?";

    $stmt_update = $conn->prepare($sql_update);

    // Tipos para bind_param (s=string, i=integer, d=double, b=blob)
    // Adapte esta string para incluir os tipos corretos para CADA campo.
    // Ex: "sssssssssssssssssssssssssssssssssssssssssssssssssi"
    // (52 's' para as 52 variáveis de string + 'i' para o ID no final)
    $stmt_update->bind_param(
        "sssssssssssssssissssssssssssssssssssssssssssssi", // String de tipos
        $falecido, $sexo, $rg_falecido, $cpf_falecido, $end_falecido,
        $end_num_falecido, $end_comp_falecido, $cep_falecido, $bairro_falecido,
        $cidade_falecido, $uf_falecido, $pai_falecido, $mae_falecido,
        $data_nasc_falecido, $data_falecimento, $idade_falecido,
        $est_civil_falecido, $loc_falecimento, $causa_mortis,
        $num_dec_obito, $autopiciado, $medico, $crm, $obs_obito,
        $cemiterio, $possui_terreno, $alvara, $funeraria, $escolha,
        $taxa, $obs_sepultamento, $declarante, $sexo_declarante,
        $rg_declarante, $cpf_declarante, $end_declarante,
        $end_num_declarante, $end_comp_declarante, $cep_declarante,
        $bairro_declarante, $cidade_declarante, $uf_declarante,
        $parentesco_declarante, $fone_declarante, $celular_declarante,
        $email_declarante,
        $id_faf_atualizar // O ID deve ser o último para o WHERE
    );

    if ($stmt_update->execute()) {
        $mensagem_status = "Registro atualizado com sucesso!";
        // Recarrega os dados do registro após a edição para que o formulário reflita as novas informações
        // (Este bloco é útil se você não redirecionar e quiser mostrar o formulário com os novos dados)
        $stmt_select_atualizado = $conn->prepare("SELECT * FROM faf WHERE id = ?");
        $stmt_select_atualizado->bind_param("i", $id_faf_atualizar);
        $stmt_select_atualizado->execute();
        $registro = $stmt_select_atualizado->get_result()->fetch_assoc();
        $stmt_select_atualizado->close();
    } else {
        $mensagem_status = "Erro ao atualizar registro: " . $stmt_update->error;
    }
    $stmt_update->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar FAF</title>
    <link href="css/default.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <link href="css/foundation.css" rel="stylesheet">
    <style>
        /* Adicione CSS específico para o formulário de edição aqui, se precisar */
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .form-section { margin-bottom: 30px; border: 1px solid #eee; padding: 15px; border-radius: 5px; background-color: #f9f9f9; }
        .form-section h3 { margin-top: 0; color: #333; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; display: flex; flex-wrap: wrap; }
        .form-group label { flex: 0 0 150px; padding-top: 8px; font-weight: bold; }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group select { flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; max-width: calc(100% - 160px); }
        .form-group input[type="text"].full-width,
        .form-group input[type="date"].full-width,
        .form-group select.full-width { max-width: 100%; flex: 1 100%; }

        button { padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; margin-right: 10px; border-radius: 4px; }
        button:hover { background-color: #218838; }
        .mensagem { margin-top: 15px; padding: 10px; border-radius: 5px; text-align: center; }
        .sucesso { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .erro { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .voltar { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .voltar:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar FAF ID: <?php echo htmlspecialchars($registro['id'] ?? 'N/A'); ?></h1>

        <?php if (!empty($mensagem_status)): ?>
            <p class="mensagem <?php echo (strpos($mensagem_status, 'sucesso') !== false) ? 'sucesso' : 'erro'; ?>">
                <?php echo htmlspecialchars($mensagem_status); ?>
            </p>
        <?php endif; ?>

        <?php if ($registro): ?>
            <form method="POST" action="editarfaf.php?id=<?php echo htmlspecialchars($registro['id']); ?>">
                <input type="hidden" name="id_faf" value="<?php echo htmlspecialchars($registro['id']); ?>">

                <div class="form-section">
                    <h3>Dados do Falecido</h3>
                    <div class="form-group">
                        <label for="falecido">Nome do Falecido:</label>
                        <input type="text" id="falecido" name="falecido" class="full-width" value="<?php echo htmlspecialchars($registro['falecido']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <input type="text" id="sexo" name="sexo" value="<?php echo htmlspecialchars($registro['sexo']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="rg_falecido">RG:</label>
                        <input type="text" id="rg_falecido" name="rg_falecido" value="<?php echo htmlspecialchars($registro['rg_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cpf_falecido">CPF:</label>
                        <input type="text" id="cpf_falecido" name="cpf_falecido" value="<?php echo htmlspecialchars($registro['cpf_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_falecido">Endereço:</label>
                        <input type="text" id="end_falecido" name="end_falecido" class="full-width" value="<?php echo htmlspecialchars($registro['end_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_num_falecido">Número:</label>
                        <input type="text" id="end_num_falecido" name="end_num_falecido" value="<?php echo htmlspecialchars($registro['end_num_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_comp_falecido">Complemento:</label>
                        <input type="text" id="end_comp_falecido" name="end_comp_falecido" value="<?php echo htmlspecialchars($registro['end_comp_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cep_falecido">CEP:</label>
                        <input type="text" id="cep_falecido" name="cep_falecido" value="<?php echo htmlspecialchars($registro['cep_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="bairro_falecido">Bairro:</label>
                        <input type="text" id="bairro_falecido" name="bairro_falecido" value="<?php echo htmlspecialchars($registro['bairro_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cidade_falecido">Cidade:</label>
                        <input type="text" id="cidade_falecido" name="cidade_falecido" value="<?php echo htmlspecialchars($registro['cidade_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="uf_falecido">UF:</label>
                        <input type="text" id="uf_falecido" name="uf_falecido" value="<?php echo htmlspecialchars($registro['uf_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="pai_falecido">Pai:</label>
                        <input type="text" id="pai_falecido" name="pai_falecido" class="full-width" value="<?php echo htmlspecialchars($registro['pai_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="mae_falecido">Mãe:</label>
                        <input type="text" id="mae_falecido" name="mae_falecido" class="full-width" value="<?php echo htmlspecialchars($registro['mae_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="data_nasc_falecido">Data de Nascimento:</label>
                        <input type="date" id="data_nasc_falecido" name="data_nasc_falecido" value="<?php echo htmlspecialchars($registro['data_nasc_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="data_falecimento">Data de Falecimento:</label>
                        <input type="date" id="data_falecimento" name="data_falecimento" value="<?php echo htmlspecialchars($registro['data_falecimento']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="idade_falecido">Idade:</label>
                        <input type="text" id="idade_falecido" name="idade_falecido" value="<?php echo htmlspecialchars($registro['idade_falecido']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="est_civil_falecido">Estado Civil:</label>
                        <input type="text" id="est_civil_falecido" name="est_civil_falecido" value="<?php echo htmlspecialchars($registro['est_civil_falecido']); ?>">
                    </div>
                </div>

                <div class="form-section">
                    <h3>Dados do Óbito</h3>
                    <div class="form-group">
                        <label for="loc_falecimento">Local do Falecimento:</label>
                        <input type="text" id="loc_falecimento" name="loc_falecimento" class="full-width" value="<?php echo htmlspecialchars($registro['loc_falecimento']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="causa_mortis">Causa Mortis:</label>
                        <input type="text" id="causa_mortis" name="causa_mortis" class="full-width" value="<?php echo htmlspecialchars($registro['causa_mortis']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="num_dec_obito">Número da Declaração de Óbito:</label>
                        <input type="text" id="num_dec_obito" name="num_dec_obito" value="<?php echo htmlspecialchars($registro['num_dec_obito']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="autopiciado">Autopsiado:</label>
                        <input type="text" id="autopiciado" name="autopiciado" value="<?php echo htmlspecialchars($registro['autopiciado']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="medico">Médico(a):</label>
                        <input type="text" id="medico" name="medico" value="<?php echo htmlspecialchars($registro['medico']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="crm">CRM:</label>
                        <input type="text" id="crm" name="crm" value="<?php echo htmlspecialchars($registro['crm']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="obs_obito">Observações do Óbito:</label>
                        <input type="text" id="obs_obito" name="obs_obito" class="full-width" value="<?php echo htmlspecialchars($registro['obs_obito']); ?>">
                    </div>
                </div>

                <div class="form-section">
                    <h3>Dados do Sepultamento</h3>
                    <div class="form-group">
                        <label for="cemiterio">Cemitério:</label>
                        <input type="text" id="cemiterio" name="cemiterio" class="full-width" value="<?php echo htmlspecialchars($registro['cemiterio']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="possui_terreno">Já possuía terreno?:</label>
                        <input type="text" id="possui_terreno" name="possui_terreno" value="<?php echo htmlspecialchars($registro['possui_terreno']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="alvara">Número do Alvará:</label>
                        <input type="text" id="alvara" name="alvara" value="<?php echo htmlspecialchars($registro['alvara']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="funeraria">Funerária que prestou o serviço:</label>
                        <input type="text" id="funeraria" name="funeraria" class="full-width" value="<?php echo htmlspecialchars($registro['funeraria']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="escolha">Tipo de Escolha:</label>
                        <input type="text" id="escolha" name="escolha" value="<?php echo htmlspecialchars($registro['escolha']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="taxa">Gerar taxa?:</label>
                        <input type="text" id="taxa" name="taxa" value="<?php echo htmlspecialchars($registro['taxa']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="obs_sepultamento">Observações do Sepultamento:</label>
                        <input type="text" id="obs_sepultamento" name="obs_sepultamento" class="full-width" value="<?php echo htmlspecialchars($registro['obs_sepultamento']); ?>">
                    </div>
                </div>

                <div class="form-section">
                    <h3>Dados do Declarante</h3>
                    <div class="form-group">
                        <label for="declarante">Declarante:</label>
                        <input type="text" id="declarante" name="declarante" class="full-width" value="<?php echo htmlspecialchars($registro['declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sexo_declarante">Sexo:</label>
                        <input type="text" id="sexo_declarante" name="sexo_declarante" value="<?php echo htmlspecialchars($registro['sexo_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="rg_declarante">RG:</label>
                        <input type="text" id="rg_declarante" name="rg_declarante" value="<?php echo htmlspecialchars($registro['rg_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cpf_declarante">CPF:</label>
                        <input type="text" id="cpf_declarante" name="cpf_declarante" value="<?php echo htmlspecialchars($registro['cpf_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_declarante">Endereço:</label>
                        <input type="text" id="end_declarante" name="end_declarante" class="full-width" value="<?php echo htmlspecialchars($registro['end_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_num_declarante">Número:</label>
                        <input type="text" id="end_num_declarante" name="end_num_declarante" value="<?php echo htmlspecialchars($registro['end_num_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_comp_declarante">Complemento:</label>
                        <input type="text" id="end_comp_declarante" name="end_comp_declarante" value="<?php echo htmlspecialchars($registro['end_comp_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cep_declarante">CEP:</label>
                        <input type="text" id="cep_declarante" name="cep_declarante" value="<?php echo htmlspecialchars($registro['cep_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="bairro_declarante">Bairro:</label>
                        <input type="text" id="bairro_declarante" name="bairro_declarante" value="<?php echo htmlspecialchars($registro['bairro_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cidade_declarante">Cidade:</label>
                        <input type="text" id="cidade_declarante" name="cidade_declarante" value="<?php echo htmlspecialchars($registro['cidade_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="uf_declarante">UF:</label>
                        <input type="text" id="uf_declarante" name="uf_declarante" value="<?php echo htmlspecialchars($registro['uf_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="parentesco_declarante">Parentesco:</label>
                        <input type="text" id="parentesco_declarante" name="parentesco_declarante" value="<?php echo htmlspecialchars($registro['parentesco_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="fone_declarante">Telefone:</label>
                        <input type="text" id="fone_declarante" name="fone_declarante" value="<?php echo htmlspecialchars($registro['fone_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="celular_declarante">Celular:</label>
                        <input type="text" id="celular_declarante" name="celular_declarante" value="<?php echo htmlspecialchars($registro['celular_declarante']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email_declarante">Email:</label>
                        <input type="text" id="email_declarante" name="email_declarante" class="full-width" value="<?php echo htmlspecialchars($registro['email_declarante']); ?>">
                    </div>
                </div>

                <center>
                    <button type="submit">Atualizar FAF</button>
                    <a href="consultarfaf.php" class="voltar button secondary">Voltar para a Pesquisa</a>
                </center>
            </form>
        <?php else: ?>
            <p>Por favor, selecione um registro para editar na <a href="consultarfaf.php">página de consulta</a>.</p>
            <a href="consultarfaf.php" class="voltar">&larr; Voltar para a Consulta</a>
        <?php endif; ?>
    </div>
</body>
</html>