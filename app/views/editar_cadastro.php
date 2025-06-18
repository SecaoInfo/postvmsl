<?php
session_start();
include_once('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');
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
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location.href = 'chamado.php';</script>";
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
    <link rel="icon" type="image/svg+xml" href="image/iconhome.svg">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(37, 81, 46), rgb(14, 48, 19));
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        .box {
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 15px;
            width: 80%;
            max-width: 400px;
        }
        fieldset {
            border: 3px solid #63f58f;
             
        }
        legend {
            border: 1px solid white;
            padding: 10px;
            text-align: center;
            background-color: linear-gradient(to right, rgba(37, 81, 46, 0.1), rgba(14, 48, 19, 0.3));
            border-radius: 8px;
            margin-top:80px;
        }
        .inputBox {
            position: relative;
            margin-top: 20px; /* Adicione essa linha */
            margin-bottom: 55px;
        }
        .inputUser:focus + .labelInput, 
        .inputUser:not(:placeholder-shown) + .labelInput {
            top: -20px;
            font-size: 12px;
            color: #63f58f;
        }

        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            padding: 5px 0;
            caret-color: #63f58f;
            
        }

        .labelInput {
            position: absolute;
            top: 8px;
            left: 0;
            pointer-events: none;
            transition: 0.3s ease-in-out;
            color: white;
        }
        #endereco {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            margin-bottom: 15px;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.5);
            background: #557e65;
        }

        #endereco:hover{
            background-color: #63f58f;
        }

        #endereco option {
            color: #000000;
            background-color: #ffffff;
        }
        #submit {
            background-color: #557e65;
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover {
            background-color: #63f58f;
        }
        a#voltar {
            text-decoration: none;
            color: white;
            background-color: #557e65;
            padding: 10px;
            border-radius: 10px;
            display: block;
            text-align: center;
            width: 100px;
            margin: 10px auto;
        }
        a#voltar:hover {
            background-color: #63f58f;
        }
    </style>
</head>
<body>
    <a id='voltar' href="chamado.php">Voltar</a>
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
