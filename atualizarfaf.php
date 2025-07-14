<?php
include_once("conexao.php");

$sql = "SELECT id_faf, falecido, data_falecimento FROM ficha_faf ORDER BY id_faf DESC";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Consultar FAFs</title>
  <link href="css/default.css" rel="stylesheet">
  <link href="css/foundation.css" rel="stylesheet">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #f0f0f0;
    }
    .button {
      padding: 5px 10px;
      background-color: #2ba6cb;
      color: white;
      border: none;
      text-decoration: none;
      border-radius: 4px;
    }
    .button:hover {
      background-color: #2284a1;
    }
  </style>
</head>
<body>

<h2>Fichas de Acompanhamento Funerário Cadastradas</h2>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Falecido</th>
      <th>Data de Falecimento</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
      <tr>
        <td><?php echo $row['id_faf']; ?></td>
        <td><?php echo htmlspecialchars($row['falecido']); ?></td>
        <td><?php echo htmlspecialchars($row['data_falecimento']); ?></td>
        <td>
          <a href="editarfaf.php?id_faf=<?php echo $row['id_faf']; ?>" class="button">Editar</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

</body>
</html>