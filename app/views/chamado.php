<?php
session_start();
include_once('config.php');

// Configurar a conexão para UTF-8
$conexao->set_charset("utf8");

// Restaura a sessão do cookie se necessário
if (!isset($_SESSION['cpf']) && isset($_COOKIE['user'])) {
    $_SESSION['cpf'] = $_COOKIE['user'];
}

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');
    exit;
}

// Busca o nome do usuário logado
$cpf = $_SESSION['cpf'];
$sql_user = "SELECT nome FROM usuarios WHERE cpf = ?";
$stmt_user = $conexao->prepare($sql_user);
$stmt_user->bind_param('s', $cpf);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user && $result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
    $nomeUsuario = htmlspecialchars($user_data['nome']);
} else {
    $nomeUsuario = "Usuário";
}

// Processa o formulário
if (isset($_POST['submit'])) {
    $service = $_POST['service'] ?? null;
    $veiculo = $_POST['veiculo'] ?? null;
    $previsto = $_POST['previsto'] ?? null;
    $obs = $_POST['obs'] ?? null;

    $sql_user_data = "SELECT nome, telefone, endereco, numero FROM usuarios WHERE cpf = ?";
    $stmt_user_data = $conexao->prepare($sql_user_data);
    $stmt_user_data->bind_param('s', $cpf);
    $stmt_user_data->execute();
    $result_user_data = $stmt_user_data->get_result();

    if ($result_user_data && $result_user_data->num_rows > 0) {
        $user_data = $result_user_data->fetch_assoc();

        $sqlInsert = "INSERT INTO chamados (nome, telefone, endereco, numero, service, veiculo, previsto, obs) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conexao->prepare($sqlInsert);
        $stmtInsert->bind_param(
            'ssssssss',
            $user_data['nome'],
            $user_data['telefone'],
            $user_data['endereco'],
            $user_data['numero'],
            $service,
            $veiculo,
            $previsto,
            $obs
        );

        if ($stmtInsert->execute()) {
            echo "<script>alert('Chamado registrado com sucesso!'); window.location.href = 'chamado.php';</script>";
        } else {
            echo "Erro ao registrar o chamado: " . $conexao->error;
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>SiscOM</title>
    <link rel="icon" type="image/svg+xml" href="image/iconhome.svg">
    <link rel="stylesheet" href="./assets/css/pages/chamado/chamado.css">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bem-vindo, <?php echo $nomeUsuario; ?>!</a>
        </div>
        
        <div class="d-flex">
            <a href="my_chamados.php" class="btn btn-secondary me-2">Meus Chamados</a>
            <a href="editar_cadastro.php" class="btn btn-warning me-2">Editar Cadastro</a>
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>

    </nav>
    <br>
    <div class="box">
        <form action="chamado.php" method="POST">
        
            <fieldset>
                <legend><b>SISCOM</b></legend>
                <div class="inputBox">
                    <select id="service" name="service" class="inputUser" required>
                        <option value="">Selecione o Serviço</option>
                        <option value="Visitante">Visitante</option>
                        <option value="Aplicativo de Corrida">Uber</option>
                        <option value="Aplicativo de Delivery">Aplicativo de Delivery</option>
                        <option value="Entrega">Entrega</option>
                        <option value="Mudança">Mudança</option>
                        <option value="Entrega Agendada">Entrega Agendada</option>
                        <option value="Guincho/Reboque">Guincho/Reboque</option>
                    </select>
                </div>
                <div class="inputBox">
                    <input type="text" name="veiculo" id="veiculo" class="inputUser">
                    <label for="veiculo" class="labelInput">Veículo (Opcional)</label>
                </div>
                <div class="inputBox">
                    <label for="previsto">Agendamento</label>
                    <input type="datetime-local" name="previsto" id="previsto" class="inputUser">
                </div>
                <div class="inputBox">
                    <label for="obs">Observações (100 caracteres)</label>
                    <input type="text" name="obs" id="obs" class="inputUser" maxlength="100">
                </div>
                <button type="submit" name="submit" id="submit">Registrar</button>
            </fieldset>
        </form>
    </div>

</body>
</html>
