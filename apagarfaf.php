<?php
// apagarfaf.php
header('Content-Type: text/html; charset=utf-8'); // Garante a codificaзгo UTF-8
session_start(); // Inicia a sessгo para acesso a variбveis de sessгo
include_once("conexao.php"); // Inclui o arquivo de conexгo com o banco de dados

// Bloco de verificaзгo de login (descomente e configure se o login for obrigatуrio)
/*
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header("Location: login.php"); // Redireciona para a pбgina de login se nгo estiver logado
    exit;
}
*/

$mensagem_status = ""; // Variбvel para armazenar a mensagem de sucesso ou erro

// 1. Verifica se o ID do registro foi passado via URL (mйtodo GET)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Captura o ID do registro a ser apagado e sanitiza (converte para inteiro)
    $id_faf_apagar = intval($_GET['id']); // intval() garante que й um nъmero inteiro

    // Verifica se a conexгo com o banco de dados foi estabelecida com sucesso
    if ($conn) {
        // 2. Prepara a consulta SQL para exclusгo usando Prepared Statement
        // Isso й crucial para prevenir ataques de SQL Injection
        $sql_delete = "DELETE FROM faf WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);

        // Verifica se a preparaзгo da query SQL falhou
        if ($stmt_delete === false) {
            // Loga o erro para depuraзгo (ъtil em ambiente de produзгo)
            error_log("Erro ao preparar a declaraзгo de exclusгo: " . $conn->error);
            $mensagem_status = "Erro interno ao preparar a exclusгo. Tente novamente.";
        } else {
            // 3. Vincula o parвmetro ao Prepared Statement
            // "i" indica que o parвmetro $id_faf_apagar й um inteiro
            $stmt_delete->bind_param("i", $id_faf_apagar);

            // 4. Executa a exclusгo no banco de dados
            if ($stmt_delete->execute()) {
                // 5. Verifica se alguma linha foi realmente afetada (registro apagado)
                if ($stmt_delete->affected_rows > 0) {
                    $mensagem_status = "Registro ID " . $id_faf_apagar . " apagado com sucesso!";
                } else {
                    $mensagem_status = "Nenhum registro encontrado com o ID " . $id_faf_apagar . " para apagar, ou jб foi removido.";
                }
            } else {
                // Se a execuзгo da query falhar
                error_log("Erro ao executar a exclusгo: " . $stmt_delete->error);
                $mensagem_status = "Erro ao apagar registro: " . $stmt_delete->error;
            }
            $stmt_delete->close(); // Fecha o statement
        }
    } else {
        $mensagem_status = "Erro: Conexгo com o banco de dados nгo estabelecida.";
    }
} else {
    // Se o ID nгo foi fornecido na URL
    $mensagem_status = "Requisiзгo invбlida: ID do registro nгo fornecido para exclusгo.";
}

$conn->close(); // Fecha a conexгo com o banco de dados

// Redireciona o usuбrio de volta para a pбgina de consulta/listagem
// A mensagem de status й passada via parвmetro de URL (urlencode para seguranзa de caracteres)
header("Location: consultarfaf.php?status_exclusao=" . urlencode($mensagem_status));
exit; // Garante que nenhum outro cуdigo PHP seja executado apуs o redirecionamento
?>