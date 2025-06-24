<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once(__DIR__ . '/../../config/config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header('Location: /postvmsl/public/index.php?page=login');
    exit;
}

// Busca os dados do usuário logado
$cpf = $_SESSION['cpf'];
$sql_user = "SELECT nome, cpf, telefone, endereco, numero FROM usuarios WHERE cpf = ?";
$stmt_user = $conexao->prepare($sql_user);
$stmt_user->bind_param('s', $cpf);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user && $result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
} else {
    echo "Erro ao carregar os dados.";
    exit;
}

// Atualiza os dados no banco de dados
if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];

    $sql_update = "UPDATE usuarios SET nome = ?, telefone = ?, endereco = ?, numero = ? WHERE cpf = ?";
    $stmt_update = $conexao->prepare($sql_update);
    $stmt_update->bind_param('sssss', $nome, $telefone, $endereco, $numero, $cpf);

    if ($stmt_update->execute()) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location.href = '/postvmsl/public/index.php?page=chamado';</script>";
    } else {
        echo "Erro ao atualizar o cadastro: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cadastro</title>
    <link rel="icon" type="image/png" href="./assets/images/iconhome.svg">
    <link rel="stylesheet" href="./assets/css/pages/editar_cadastro/editar_cadastro.css">
</head>
<body>
    <a id='voltar' href="/postvmsl/public/index.php?page=chamado">Voltar</a>
    <div class="box">
        <form action="editar_cadastro.php" method="POST">
            <fieldset>
                <legend><b>Editar Cadastro</b></legend>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $user_data['nome']; ?>" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" value="<?php echo $user_data['telefone']; ?>" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
<div class="inputBox">
    <select id="endereco" name="endereco">
        <option value="">Selecione a Rua...</option>
        <option value="RUA CEL AQUILES PEDENEIRAS" <?= $user_data['endereco'] == "RUA CEL AQUILES PEDENEIRAS" ? 'selected' : ''; ?>>RUA CEL AQUILES PEDENEIRAS</option>
        <option value="RUA CEL AMAURY" <?= $user_data['endereco'] == "RUA CEL AMAURY" ? 'selected' : ''; ?>>RUA CEL AMAURY</option>
        <option value="RUA CEL ANDRADE NEVES" <?= $user_data['endereco'] == "RUA CEL ANDRADE NEVES" ? 'selected' : ''; ?>>RUA CEL ANDRADE NEVES</option>
        <option value="RUA CEL CASTRO JUNIOR" <?= $user_data['endereco'] == "RUA CEL CASTRO JUNIOR" ? 'selected' : ''; ?>>RUA CEL CASTRO JUNIOR</option>
        <option value="RUA CEL ESPIRIDAO ROSAS" <?= $user_data['endereco'] == "RUA CEL ESPIRIDAO ROSAS" ? 'selected' : ''; ?>>RUA CEL ESPIRIDAO ROSAS</option>
        <option value="RUA CEL FIUZA DE CASTRO" <?= $user_data['endereco'] == "RUA CEL FIUZA DE CASTRO" ? 'selected' : ''; ?>>RUA CEL FIUZA DE CASTRO</option>
        <option value="RUA CEL HASTIMPHILO DE MOURA" <?= $user_data['endereco'] == "RUA CEL HASTIMPHILO DE MOURA" ? 'selected' : ''; ?>>RUA CEL HASTIMPHILO DE MOURA</option>
        <option value="RUA CEL LINDOLPHO SERRA" <?= $user_data['endereco'] == "RUA CEL LINDOLPHO SERRA" ? 'selected' : ''; ?>>RUA CEL LINDOLPHO SERRA</option>
        <option value="RUA CEL MARTINS PEREIRA" <?= $user_data['endereco'] == "RUA CEL MARTINS PEREIRA" ? 'selected' : ''; ?>>RUA CEL MARTINS PEREIRA</option>
        <option value="RUA CEL PEDRO IVO" <?= $user_data['endereco'] == "RUA CEL PEDRO IVO" ? 'selected' : ''; ?>>RUA CEL PEDRO IVO</option>
        <option value="RUA CEL SILIO PORTELA" <?= $user_data['endereco'] == "RUA CEL SILIO PORTELA" ? 'selected' : ''; ?>>RUA CEL SILIO PORTELA</option>
        <option value="RUA CEL UCHOA" <?= $user_data['endereco'] == "RUA CEL UCHOA" ? 'selected' : ''; ?>>RUA CEL UCHOA</option>
        <option value="RUA DA INDUSTRIA" <?= $user_data['endereco'] == "RUA DA INDUSTRIA" ? 'selected' : ''; ?>>RUA DA INDUSTRIA</option>
        <option value="RUA DUQUE DE CAXIAS" <?= $user_data['endereco'] == "RUA DUQUE DE CAXIAS" ? 'selected' : ''; ?>>RUA DUQUE DE CAXIAS</option>
        <option value="RUA GEN ALTAIR" <?= $user_data['endereco'] == "RUA GEN ALTAIR" ? 'selected' : ''; ?>>RUA GEN ALTAIR</option>
        <option value="RUA GEN OCTAVIO" <?= $user_data['endereco'] == "RUA GEN OCTAVIO" ? 'selected' : ''; ?>>RUA GEN OCTAVIO</option>
        <option value="RUA GEN PARGAS RODRIGUES" <?= $user_data['endereco'] == "RUA GEN PARGAS RODRIGUES" ? 'selected' : ''; ?>>RUA GEN PARGAS RODRIGUES</option>
        <option value="RUA GEN PONDE" <?= $user_data['endereco'] == "RUA GEN PONDE" ? 'selected' : ''; ?>>RUA GEN PONDE</option>
        <option value="RUA GEN WEDMAN" <?= $user_data['endereco'] == "RUA GEN WEDMAN" ? 'selected' : ''; ?>>RUA GEN WEDMAN</option>
        <option value="RUA MAJ DOUTOR AZEVEDO" <?= $user_data['endereco'] == "RUA MAJ DOUTOR AZEVEDO" ? 'selected' : ''; ?>>RUA MAJ DOUTOR AZEVEDO</option>
        <option value="RUA MESTRE CAMARGO" <?= $user_data['endereco'] == "RUA MESTRE CAMARGO" ? 'selected' : ''; ?>>RUA MESTRE CAMARGO</option>
        <option value="RUA MESTRE JORGE" <?= $user_data['endereco'] == "RUA MESTRE JORGE" ? 'selected' : ''; ?>>RUA MESTRE JORGE</option>
        <option value="RUA MESTRE NUNO" <?= $user_data['endereco'] == "RUA MESTRE NUNO" ? 'selected' : ''; ?>>RUA MESTRE NUNO</option>
        <option value="RUA MESTRE SADOCK DE SA" <?= $user_data['endereco'] == "RUA MESTRE SADOCK DE SA" ? 'selected' : ''; ?>>RUA MESTRE SADOCK DE SA</option>
        <option value="RUA PARANA" <?= $user_data['endereco'] == "RUA PARANA" ? 'selected' : ''; ?>>RUA PARANA</option>
        <option value="RUA SAMUEL DA SILVA CALDAS" <?= $user_data['endereco'] == "RUA SAMUEL DA SILVA CALDAS" ? 'selected' : ''; ?>>RUA SAMUEL DA SILVA CALDAS</option>
    </select>
    <br><br>
</div>

                <div class="inputBox">
                    <input type="text" name="numero" id="numero" class="inputUser" value="<?php echo $user_data['numero']; ?>" required>
                    <label for="numero" class="labelInput">Número</label>
                </div>
                <input type="submit" name="submit" id="submit" value="Salvar Alterações">
            </fieldset>
        </form>
    </div>
</body>
</html>
