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
    <link rel="icon" type="image/png" href="image/iconhome.svg">

    <!-- Ícone para dispositivos iOS -->
    <link rel="apple-touch-icon" href="image/iconhome.png">

    <!-- Definindo o título do aplicativo para dispositivos iOS -->
    <meta name="apple-mobile-web-app-title" content="SiscOM">

    <!-- Cor da barra de status para dispositivos móveis -->
    <meta name="theme-color" content="#557e65">

    <!-- Arquivo Manifest para Progressive Web App (PWA) -->
    <link rel="manifest" href="manifest.json">

    <!-- Adiciona meta tag para permitir que o site seja aberto no modo 'standalone' -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <style>
        /* Ajustando o HTML e o body */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%; /* Garante que a altura seja 100% da tela */
            overflow-x: hidden; /* Impede que o conteúdo ultrapasse a largura da tela */
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            color: #333;
            background: linear-gradient(to right, rgb(37, 81, 46), rgb(14, 48, 19)); /* Gradiente de fundo */
            background-size: cover; /* Garante que o gradiente cubra toda a tela */
            background-position: center; /* Centraliza o fundo */
            height: 100%; /* Garante que o fundo ocupe a altura total da página */
            display: flex; /* Centraliza os elementos */
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .icon-container img {
            width: 150px;
            height: 150px;
        }

        .box {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
        }

        a {
            text-decoration: none;
            color: white;
            border: 3px #557e65;
            border-radius: 10px;
            padding: 10px;
            margin: 5px; /* Adiciona espaçamento entre os links */
        }

        a:hover {
            background-color: #63f58f;
        }

        @media (max-width: 768px) {
            .box {
                width: 80%;
                padding: 20px;
            }

            a {
                font-size: 14px;
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            .box {
                width: 95%;
                padding: 15px;
            }

            a {
                font-size: 12px;
                padding: 6px;
            }
        }

        /* Estilo do cabeçalho */
        #headerone{
            background-color: rgba(0, 0, 0, 0.6);
            color: #ffffff;
            padding: 10px;
            width: 100%;
            text-align: center;
            font-size: 14px;
            position: fixed; /* Fixa o cabeçalho no topo */
            top: 0;
            left: 0;
            z-index: 10; /* Garante que o cabeçalho fique acima de outros elementos */
        }

        /* Estilo do rodapé */
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <div id='headerone'>
       Vila Militar São Lazáro  tel:3483-9093
    </div>

    <div class="icon-container">
        <img src="image/iconhome.svg" alt="Siscom Icon">
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
