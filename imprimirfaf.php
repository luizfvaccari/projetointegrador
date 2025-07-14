<?php
// imprimirfaf.php
header('Content-Type: text/html; charset=utf-8'); // Garante a codificação UTF-8
session_start(); // Inicia a sessão (se você usa para autenticação)
include_once("conexao.php"); // Inclui o arquivo de conexão com o banco de dados

// Bloco de verificação de login (descomente e configure se o login for obrigatório)
/*
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit;
}
*/

$registro = null; // Variável para armazenar os dados do registro da FAF
$mensagem_erro = ""; // Para exibir mensagens de erro

// 1. Verifica se o ID do registro foi passado via URL (método GET)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_faf = intval($_GET['id']); // Captura o ID e garante que é um número inteiro

    // Verifica se a conexão com o banco de dados foi estabelecida com sucesso
    if ($conn) {
        // 2. Prepara a consulta SQL para buscar o registro específico usando Prepared Statement
        // Isso previne SQL Injection e é essencial para a segurança
        $sql_select = "SELECT * FROM faf WHERE id = ?";
        $stmt_select = $conn->prepare($sql_select);

        // Verifica se a preparação da query falhou
        if ($stmt_select === false) {
            error_log("Erro ao preparar a consulta em imprimirfaf.php: " . $conn->error);
            $mensagem_erro = "Erro interno ao preparar a consulta. Tente novamente mais tarde.";
        } else {
            // 3. Vincula o ID ao Prepared Statement ("i" para inteiro)
            $stmt_select->bind_param("i", $id_faf);

            // 4. Executa a consulta
            $stmt_select->execute();
            $resultado = $stmt_select->get_result(); // Obtém o resultado da consulta

            // 5. Verifica se o registro foi encontrado
            if ($resultado->num_rows > 0) {
                $registro = $resultado->fetch_assoc(); // Obtém os dados do registro como um array associativo
            } else {
                $mensagem_erro = "Nenhum registro encontrado com o ID " . htmlspecialchars($id_faf) . ".";
            }
            $stmt_select->close(); // Fecha o statement
        }
    } else {
        $mensagem_erro = "Erro: Conexão com o banco de dados não estabelecida.";
    }
} else {
    $mensagem_erro = "ID do registro não fornecido para impressão.";
}

$conn->close(); // Fecha a conexão com o banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir FAF - ID <?php echo isset($id_faf) ? htmlspecialchars($id_faf) : ''; ?></title>
    <link href="css/default.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <link href="css/foundation.css" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; margin: 30px; line-height: 1.5; color: #333; }
        .container-imprimir { max-width: 800px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2, h3 { text-align: center; color: #000; margin-bottom: 15px; }
        h1 { font-size: 18pt; margin-top: 0; }
        h2 { font-size: 14pt; border-bottom: 1px solid #eee; padding-bottom: 5px; margin-top: 20px; }
        .section-header { font-weight: bold; border-bottom: 1px solid #000; margin-top: 25px; padding-bottom: 5px; font-size: 13pt; }
        .info-item { display: flex; margin-bottom: 8px; }
        .info-item strong { flex-shrink: 0; width: 180px; margin-right: 10px; color: #555; }
        .info-item span { flex-grow: 1; border-bottom: 1px dotted #ccc; padding-bottom: 2px; }
        .full-width { display: block; width: 100%; margin-bottom: 15px; }
        .alerta { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; font-weight: bold; }
        .botao-voltar { display: block; width: 200px; margin: 20px auto; padding: 10px 20px; background-color: #007bff; color: white; text-align: center; text-decoration: none; border-radius: 5px; }
        .botao-voltar:hover { background-color: #0056b3; }

        @media print {
            body { margin: 0; }
            .container-imprimir { border: none; box-shadow: none; padding: 0; margin: 0; }
            .botao-voltar { display: none; } /* Esconde o botão de voltar na impressão */
        }
    </style>
</head>
<body>
    <div class="container-imprimir">
        <?php if (!empty($mensagem_erro)): ?>
            <p class="alerta"><?php echo htmlspecialchars($mensagem_erro); ?></p>
            <a href="consultarfaf.php" class="botao-voltar">Voltar para a Consulta</a>
        <?php elseif ($registro): ?>
            <h1>FICHA DE AUTORIZAÇÃO FUNERÁRIA (FAF)</h1>
            <p style="text-align: right; font-size: 0.9em; margin-top: -10px;">ID da FAF: **<?php echo htmlspecialchars($registro['id']); ?>**</p>

            <div class="section-header">DADOS DO FALECIDO</div>
            <div class="info-item"><strong>Nome Completo:</strong> <span><?php echo htmlspecialchars($registro['falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Sexo:</strong> <span><?php echo htmlspecialchars($registro['sexo'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>RG:</strong> <span><?php echo htmlspecialchars($registro['rg_falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>CPF:</strong> <span><?php echo htmlspecialchars($registro['cpf_falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Endereço:</strong> <span><?php echo htmlspecialchars(($registro['end_falecido'] ?? '') . ' nº ' . ($registro['end_num_falecido'] ?? '') . ' ' . ($registro['end_comp_falecido'] ?? '')) ; ?></span></div>
            <div class="info-item"><strong>Bairro:</strong> <span><?php echo htmlspecialchars($registro['bairro_falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Cidade/UF:</strong> <span><?php echo htmlspecialchars(($registro['cidade_falecido'] ?? '') . ' / ' . ($registro['uf_falecido'] ?? '')) ; ?></span></div>
            <div class="info-item"><strong>CEP:</strong> <span><?php echo htmlspecialchars($registro['cep_falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Nome do Pai:</strong> <span><?php echo htmlspecialchars($registro['pai_falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Nome da Mãe:</strong> <span><?php echo htmlspecialchars($registro['mae_falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Data Nascimento:</strong> <span><?php echo htmlspecialchars($registro['data_nasc_falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Idade:</strong> <span><?php echo htmlspecialchars($registro['idade_falecido'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Estado Civil:</strong> <span><?php echo htmlspecialchars($registro['est_civil_falecido'] ?? 'N/A'); ?></span></div>

            <div class="section-header">DADOS DO ÓBITO</div>
            <div class="info-item"><strong>Data Falecimento:</strong> <span><?php echo htmlspecialchars($registro['data_falecimento'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Local Falecimento:</strong> <span><?php echo htmlspecialchars($registro['loc_falecimento'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Causa Mortis:</strong> <span><?php echo htmlspecialchars($registro['causa_mortis'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Nº Declaração Óbito:</strong> <span><?php echo htmlspecialchars($registro['num_dec_obito'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Autopiciado:</strong> <span><?php echo htmlspecialchars($registro['autopiciado'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Médico:</strong> <span><?php echo htmlspecialchars($registro['medico'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>CRM:</strong> <span><?php echo htmlspecialchars($registro['crm'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Obs. Óbito:</strong> <span><?php echo htmlspecialchars($registro['obs_obito'] ?? 'N/A'); ?></span></div>

            <div class="section-header">DADOS DO SEPULTAMENTO</div>
            <div class="info-item"><strong>Cemitério:</strong> <span><?php echo htmlspecialchars($registro['cemiterio'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Possui Terreno:</strong> <span><?php echo htmlspecialchars($registro['possui_terreno'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Alvará:</strong> <span><?php echo htmlspecialchars($registro['alvara'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Funerária:</strong> <span><?php echo htmlspecialchars($registro['funeraria'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Escolha:</strong> <span><?php echo htmlspecialchars($registro['escolha'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Taxa:</strong> <span><?php echo htmlspecialchars($registro['taxa'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Obs. Sepultamento:</strong> <span><?php echo htmlspecialchars($registro['obs_sepultamento'] ?? 'N/A'); ?></span></div>

            <div class="section-header">DADOS DO DECLARANTE</div>
            <div class="info-item"><strong>Nome Completo:</strong> <span><?php echo htmlspecialchars($registro['declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Sexo:</strong> <span><?php echo htmlspecialchars($registro['sexo_declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>RG:</strong> <span><?php echo htmlspecialchars($registro['rg_declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>CPF:</strong> <span><?php echo htmlspecialchars($registro['cpf_declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Endereço:</strong> <span><?php echo htmlspecialchars(($registro['end_declarante'] ?? '') . ' nº ' . ($registro['end_num_declarante'] ?? '') . ' ' . ($registro['end_comp_declarante'] ?? '')) ; ?></span></div>
            <div class="info-item"><strong>Bairro:</strong> <span><?php echo htmlspecialchars($registro['bairro_declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Cidade/UF:</strong> <span><?php echo htmlspecialchars(($registro['cidade_declarante'] ?? '') . ' / ' . ($registro['uf_declarante'] ?? '')) ; ?></span></div>
            <div class="info-item"><strong>CEP:</strong> <span><?php echo htmlspecialchars($registro['cep_declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Parentesco:</strong> <span><?php echo htmlspecialchars($registro['parentesco_declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Telefone:</strong> <span><?php echo htmlspecialchars($registro['fone_declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Celular:</strong> <span><?php echo htmlspecialchars($registro['celular_declarante'] ?? 'N/A'); ?></span></div>
            <div class="info-item"><strong>Email:</strong> <span><?php echo htmlspecialchars($registro['email_declarante'] ?? 'N/A'); ?></span></div>

            <br><br><br>
            <p style="text-align: center; margin-top: 50px;">
                _______________________________________<br>
                Assinatura do Declarante
            </p>
            <p style="text-align: center; margin-top: 20px; font-size: 0.9em;">
                Data de Impressão: <?php echo date('d/m/Y H:i:s'); ?>
            </p>

            <a href="javascript:window.print()" class="botao-voltar" style="background-color: #28a745;">Imprimir Documento</a>
            <a href="consultarfaf.php" class="botao-voltar">Voltar para a Consulta</a>

        <?php endif; ?>
    </div>
</body>
</html>