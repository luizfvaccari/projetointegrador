<?php
// apagarfaf.php
header('Content-Type: text/html; charset=utf-8'); // Garante a codifica��o UTF-8
session_start(); // Inicia a sess�o para acesso a vari�veis de sess�o
include_once("conexao.php"); // Inclui o arquivo de conex�o com o banco de dados

// Bloco de verifica��o de login (descomente e configure se o login for obrigat�rio)
/*
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header("Location: login.php"); // Redireciona para a p�gina de login se n�o estiver logado
    exit;
}
*/

$mensagem_status = ""; // Vari�vel para armazenar a mensagem de sucesso ou erro

// 1. Verifica se o ID do registro foi passado via URL (m�todo GET)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Captura o ID do registro a ser apagado e sanitiza (converte para inteiro)
    $id_faf_apagar = intval($_GET['id']); // intval() garante que � um n�mero inteiro

    // Verifica se a conex�o com o banco de dados foi estabelecida com sucesso
    if ($conn) {
        // 2. Prepara a consulta SQL para exclus�o usando Prepared Statement
        // Isso � crucial para prevenir ataques de SQL Injection
        $sql_delete = "DELETE FROM faf WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);

        // Verifica se a prepara��o da query SQL falhou
        if ($stmt_delete === false) {
            // Loga o erro para depura��o (�til em ambiente de produ��o)
            error_log("Erro ao preparar a declara��o de exclus�o: " . $conn->error);
            $mensagem_status = "Erro interno ao preparar a exclus�o. Tente novamente.";
        } else {
            // 3. Vincula o par�metro ao Prepared Statement
            // "i" indica que o par�metro $id_faf_apagar � um inteiro
            $stmt_delete->bind_param("i", $id_faf_apagar);

            // 4. Executa a exclus�o no banco de dados
            if ($stmt_delete->execute()) {
                // 5. Verifica se alguma linha foi realmente afetada (registro apagado)
                if ($stmt_delete->affected_rows > 0) {
                    $mensagem_status = "Registro ID " . $id_faf_apagar . " apagado com sucesso!";
                } else {
                    $mensagem_status = "Nenhum registro encontrado com o ID " . $id_faf_apagar . " para apagar, ou j� foi removido.";
                }
            } else {
                // Se a execu��o da query falhar
                error_log("Erro ao executar a exclus�o: " . $stmt_delete->error);
                $mensagem_status = "Erro ao apagar registro: " . $stmt_delete->error;
            }
            $stmt_delete->close(); // Fecha o statement
        }
    } else {
        $mensagem_status = "Erro: Conex�o com o banco de dados n�o estabelecida.";
    }
} else {
    // Se o ID n�o foi fornecido na URL
    $mensagem_status = "Requisi��o inv�lida: ID do registro n�o fornecido para exclus�o.";
}

$conn->close(); // Fecha a conex�o com o banco de dados

// Redireciona o usu�rio de volta para a p�gina de consulta/listagem
// A mensagem de status � passada via par�metro de URL (urlencode para seguran�a de caracteres)
header("Location: consultarfaf.php?status_exclusao=" . urlencode($mensagem_status));
exit; // Garante que nenhum outro c�digo PHP seja executado ap�s o redirecionamento
?>