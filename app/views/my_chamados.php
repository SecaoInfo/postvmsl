<?php
session_start();
include_once('/../../config/config.php');

// Configurar a conexão para UTF-8
$conexao->set_charset("utf8");

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');
    exit;
}

// Busca os chamados do usuário logado pelo CPF
$cpf = $_SESSION['cpf'];
$sql_chamados = "SELECT c.id, c.service, c.veiculo, c.previsto, c.obs 
                 FROM chamados AS c 
                 INNER JOIN usuarios AS u ON u.nome = c.nome
                 WHERE u.cpf = ? 
                 ORDER BY c.id DESC";


$stmt_chamados = $conexao->prepare($sql_chamados);
$stmt_chamados->bind_param('s', $cpf);
$stmt_chamados->execute();
$result_chamados = $stmt_chamados->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>SiscOM</title>
    <link rel="icon" type="image/svg+xml" href="image/iconhome.svg">
    <link rel="stylesheet" href="./assets/css/pages/my_chamados/my_chamados.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SiscOM</a>
            <div class="d-flex">
                <a href="/postvmsl/public/index.php?page=chamado" class="btn btn-secondary me-2">Voltar</a>
                <a href="/postvmsl/public/index.php?page=sair" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>Meus Chamados</h1>
        <div class="m-5 table-responsive">
            <?php if ($result_chamados && $result_chamados->num_rows > 0): ?>
                <table class="table text-white table-bg">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Serviço</th>
                            <th>Veículo</th>
                            <th>Agendamento</th>
                            <th>Observações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_chamados->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['service']); ?></td>
                                <td><?php echo htmlspecialchars($row['veiculo'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($row['previsto'] ? date('d/m/Y H:i', strtotime($row['previsto'])) : 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($row['obs'] ?? ''); ?></td>
                                <td>
                                    <a class='btn btn-sm btn-danger' href='deletemy.php?id=<?php echo $row['id']; ?>' title='Deletar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Nenhum chamado encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>

