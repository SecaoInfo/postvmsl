<?php
session_start();
include_once('config.php');

// Verifica se existe um cookie para manter o login ativo
if (isset($_COOKIE['user'])) {
    $cpf = $_COOKIE['user'];

    // Busca o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) > 0) {
        $user = $result->fetch_assoc();
        $sit_admin = $user['sit_admin'];

        // Restaura a sessão
        $_SESSION['cpf'] = $cpf;

        // Redireciona com base no tipo de usuário
        if ($sit_admin == 1) {
            header('Location: sistema.php');
        } else if ($sit_admin == 0) {
            header('Location: chamado.php');
        }
        exit;
    }
}

// Caso não haja cookie ou login, continua na página inicial
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiscOM</title>
    <!-- Ícone para o navegador -->
    <link rel="icon" type="image/png" href="./assets/images/iconhome.svg">

    <!-- Ícone para dispositivos iOS -->
    <link rel="apple-touch-icon" href="./assets/images/iconhome.png">

    <!-- Definindo o título do aplicativo para dispositivos iOS -->
    <meta name="apple-mobile-web-app-title" content="SiscOM">

    <!-- Cor da barra de status para dispositivos móveis -->
    <meta name="theme-color" content="#557e65">

    <!-- Arquivo Manifest para Progressive Web App (PWA) -->
    <link rel="manifest" href="manifest.json">

    <!-- Adiciona meta tag para permitir que o site seja aberto no modo 'standalone' -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="stylesheet" href="./assets/css/pages/index/index.css">

</head>
<body>
    <!-- Cabeçalho -->
    <div id='headerone'>
       Vila Militar São Lazáro  tel:3483-9093
    </div>

    <div class="icon-container">
        <img src="./assets/images/iconhome.svg" alt="Siscom Icon">
    </div>

    <div class="box">
        <a href="login.php">Login</a>
        <a href="formulario.php">Cadastre-se</a>
    </div>

    <!-- Rodapé -->
    <div class="footer">
        Felipe Aluizio Ferreira - Desenvolvedor Jr - v1.1
    </div>
</body>
</html>
