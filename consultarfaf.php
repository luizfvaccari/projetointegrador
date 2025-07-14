<?php
// consultarfaf.php
header('Content-Type: text/html; charset=utf-8'); // Garante a codificação UTF-8
session_start(); // Inicia a sessão para acesso a variáveis de sessão
include_once("conexao.php"); // Inclui o arquivo de conexão com o banco de dados

// Bloco de verificação de login (descomente e configure se o login for obrigatório)
/*
$email = $_SESSION['email'];
if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])){
    header("Location: login.php");
    exit;
} else {
    // echo "$email está logado"; // Se quiser exibir a informação de login
}
*/

$termo_pesquisa = "";
$registros = [];
$mensagem_status = ""; // Para exibir o status da exclusão ou outros status

// Exibir mensagem de status (da exclusão ou outras operações)
if (isset($_GET['status_exclusao']) && !empty($_GET['status_exclusao'])) {
    $mensagem_status = htmlspecialchars($_GET['status_exclusao']);
}

// Verifica se um termo de pesquisa foi enviado (agora via GET)
if (isset($_GET['falecido']) && !empty($_GET['falecido'])) {
    $termo_pesquisa = $_GET['falecido'];

    // Prepared Statement para SELECT (MUITO IMPORTANTE PARA SEGURANÇA)
    $falecido_pesquisa_like = "%" . $termo_pesquisa . "%"; // Adiciona os curingas para o LIKE

    // Verifica se a conexão com o banco está ativa
    if ($conn) {
        // Seleciona os campos necessários para exibição na tabela de consulta
        // E também os campos que podem ser úteis para a página de impressão
        $stmt = $conn->prepare("SELECT id, falecido, data_falecimento, cpf_falecido, medico, funeraria FROM faf WHERE falecido LIKE ?");

        if ($stmt === false) {
            // Se a preparação da query falhar, loga o erro e informa o usuário
            error_log("Erro ao preparar a consulta em consultarfaf.php: " . $conn->error);
            $registros = []; // Garante que não haverá resultados
            $mensagem_status = "Erro interno ao preparar a consulta. Tente novamente.";
        } else {
            $stmt->bind_param("s", $falecido_pesquisa_like); // "s" indica que é uma string
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                while ($linha = $resultado->fetch_assoc()) { // Usando fetch_assoc para melhor legibilidade
                    $registros[] = $linha;
                }
            }
            $stmt->close();
        }
    } else {
        $mensagem_status = "Erro: Conexão com o banco de dados não estabelecida.";
    }
}
$conn->close(); // Fecha a conexão após todas as operações do banco
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar FAF</title>
    <link href="css/default.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <link href="css/foundation.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; }
        form { margin-bottom: 20px; }
        input[type="text"] { padding: 8px; width: 300px; border: 1px solid #ddd; }
        button[type="submit"] { padding: 8px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        button[type="submit"]:hover { background-color: #0056b3; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .acao { text-align: center; white-space: nowrap; } /* Garante que os links fiquem na mesma linha */
        .acao a { text-decoration: none; margin: 0 3px; padding: 3px 5px; border-radius: 3px; }
        .acao a.editar { color: #007bff; border: 1px solid #007bff; }
        .acao a.editar:hover { background-color: #e6f2ff; }
        .acao a.apagar { color: red; border: 1px solid red; }
        .acao a.apagar:hover { background-color: #ffe6e6; }
        .acao a.imprimir { color: green; border: 1px solid green; }
        .acao a.imprimir:hover { background-color: #e6ffe6; }
        .acao a:hover { text-decoration: none; } /* Remove underline on hover after adding background */

        .mensagem-info { padding: 10px; background-color: #e2f0fb; border: 1px solid #b3dcf1; border-radius: 4px; margin-top: 15px; }
        .status-mensagem {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .status-sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="top-bar" id="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown vertical medium-horizontal menu">
                <li class="menu-text">Serviço Central de Óbitos - On-Line </li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="dropdown vertical medium-horizontal menu">
                <li><a href="faf.php">Cadastrar FAF</a></li>
                <li><a href="consultarfaf.php">Imprimir FAF</a></li> <li><a href="funerarias.php">Cadastrar Funerárias</a></li>
                <li><a href="consultarfunerarias.php">Consultar Funerárias</a></li>
                <li><a class="button" href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <form class="faf" name="consultarfaf" method="get" action="consultarfaf.php" >
            <center><h1>CONSULTAR E GERENCIAR FAFs!</h1></center>
            <ul>
                <li>
                    <input type="text" id="falecido" name="falecido" class="field-style field-full align-none" placeholder="Digite o nome do falecido para consultar/gerenciar a FAF!" value="<?php echo htmlspecialchars($termo_pesquisa); ?>" />
                </li>
                <li>
                    <button type="submit">Consultar</button>
                </li>
            </ul>
        </form>

        <?php if (!empty($mensagem_status)): ?>
            <p class="status-mensagem <?php echo (strpos($mensagem_status, 'sucesso') !== false) ? 'status-sucesso' : 'status-erro'; ?>">
                <?php echo $mensagem_status; ?>
            </p>
        <?php endif; ?>

        <?php if (isset($_GET['falecido']) && empty($registros)): // Mensagem se a pesquisa foi feita e não encontrou resultados ?>
            <p class="mensagem-info">Nenhum registro encontrado para "<?php echo htmlspecialchars($termo_pesquisa); ?>". Verifique e tente novamente!</p>
        <?php elseif (!empty($registros)): ?>
            <h2>Resultados da Pesquisa:</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID FAF</th>
                        <th>Nome do Falecido</th>
                        <th>Data Falecimento</th>
                        <th>CPF Falecido</th>
                        <th>M�dico</th>
                        <th>Funer�ria</th>
                        <th class="acao">A��es</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($registro['id']); ?></td>
                            <td><?php echo htmlspecialchars($registro['falecido']); ?></td>
                            <td><?php echo htmlspecialchars($registro['data_falecimento']); ?></td>
                            <td><?php echo htmlspecialchars($registro['cpf_falecido']); ?></td>
                            <td><?php echo htmlspecialchars($registro['medico']); ?></td>
                            <td><?php echo htmlspecialchars($registro['funeraria']); ?></td>
                            <td class="acao">
                                <a href="editarfaf.php?id=<?php echo htmlspecialchars($registro['id']); ?>" class="editar">Editar</a>
                                <a href="apagarfaf.php?id=<?php echo htmlspecialchars($registro['id']); ?>"
                                   onclick="return confirm('Tem certeza que deseja apagar este registro? Esta a��o � irrevers��vel!');"
                                   class="apagar">Apagar</a>
                                <a href="imprimirfaf.php?id=<?php echo htmlspecialchars($registro['id']); ?>" target="_blank" class="imprimir">Imprimir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: // Mensagem inicial antes de qualquer pesquisa ?>
            <p class="mensagem-info">Utilize o campo acima para pesquisar registros de FAF e depois gerencie os dados com as op��es de Editar, Apagar ou Imprimir.</p>
        <?php endif; ?>
    </div>
</body>
</html>