<?php
// consultarfaf.php
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once("conexao.php");

// Bloco de verificação de login (descomente se estiver usando)
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

// Verifica se um termo de pesquisa foi enviado (agora via GET)
if (isset($_GET['falecido']) && !empty($_GET['falecido'])) {
    $termo_pesquisa = $_GET['falecido'];

    // Prepared Statement para SELECT (MUITO IMPORTANTE PARA SEGURANÇA)
    $falecido_pesquisa = "%" . $termo_pesquisa . "%"; // Adiciona os curingas para o LIKE

    $stmt = $conn->prepare("SELECT id, falecido, data_falecimento, cpf_falecido FROM faf WHERE falecido LIKE ?");
    $stmt->bind_param("s", $falecido_pesquisa); // "s" indica que é uma string
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) { // Usando fetch_assoc para melhor legibilidade
            $registros[] = $linha;
        }
    }
    $stmt->close();
}
$conn->close(); // Fecha a conexão após todas as operações do banco
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/default.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <link href="css/foundation.css" rel="stylesheet">
    <title>Consultar FAF</title>
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
        .acao { text-align: center; }
        .acao a { text-decoration: none; color: #007bff; }
        .acao a:hover { text-decoration: underline; }
        .mensagem-info { padding: 10px; background-color: #e2f0fb; border: 1px solid #b3dcf1; border-radius: 4px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="top-bar" id="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown vertical medium-horizontal menu">
                <li class="menu-text">Servico Central de Obitos - OnLine </li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="dropdown vertical medium-horizontal menu">
                <li><a href="faf.php">Cadastrar FAF</a></li>
                <li><a href="consultarfaf.php">Imprimir FAF</a></li> <li><a href="funerarias.php">Cadastrar Funerarias</a></li>
                <li><a href="consultarfunerarias.php">Consultar Funerarias</a></li>
                <li><a class="button" href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>

    <form class="faf" name="consultarfaf" method="get" action="consultarfaf.php" >
        <center><h1>CONSULTAR E EDITAR FAF!</h1></center>
        <ul>
            <li>
                <input type="text" id="falecido" name="falecido" class="field-style field-full align-none" placeholder="Digite o nome do falecido para consultar/editar a FAF!" value="<?php echo htmlspecialchars($termo_pesquisa); ?>" />
            </li>
            <li>
                <button type="submit">Consultar</button>
            </li>
        </ul>
    </form>

    <div class="container">
        <?php if (!empty($registros)): ?>
            <h2>Resultados da Pesquisa:</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID FAF</th>
                        <th>Nome do Falecido</th>
                        <th>Data Falecimento</th>
                        <th>CPF Falecido</th>
                        <th class="acao">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($registro['id']); ?></td>
                            <td><?php echo htmlspecialchars($registro['falecido']); ?></td>
                            <td><?php echo htmlspecialchars($registro['data_falecimento']); ?></td>
                            <td><?php echo htmlspecialchars($registro['cpf_falecido']); ?></td>
                            <td class="acao"><a href="editarfaf.php?id=<?php echo htmlspecialchars($registro['id']); ?>">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (isset($_GET['falecido'])): // Mostra esta mensagem apenas se a pesquisa foi feita e não encontrou resultados ?>
            <p class="mensagem-info">Nenhum registro encontrado para "<?php echo htmlspecialchars($termo_pesquisa); ?>". Verifique e tente novamente!</p>
        <?php else: // Mensagem inicial antes de qualquer pesquisa ?>
            <p class="mensagem-info">Utilize o campo acima para pesquisar registros de FAF e depois clique em 'Editar' para modificar os dados.</p>
        <?php endif; ?>
    </div>
</body>
</html>