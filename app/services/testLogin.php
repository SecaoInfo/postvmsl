<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once(__DIR__ . '/../../config/config.php');
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
            header('Location: /postvmsl/public/index.php?page=sistema');
        } else if ($sit_admin == 0) {
            header('Location: /postvmsl/public/index.php?page=chamado');
        }
        exit;
    }
}

// Processo normal de login
if (isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['senha'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf' and senha = '$senha'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        // Login inválido
        unset($_SESSION['cpf']);
        unset($_SESSION['senha']);
        setcookie('user', '', time() - 3600, '/'); // Remove qualquer cookie existente
        header('Location: /postvmsl/public/index.php?page=login');
        exit;
    } else {
        // Usuário encontrado
        $user = $result->fetch_assoc();
        $sit_admin = $user['sit_admin'];

        $_SESSION['cpf'] = $cpf;
        $_SESSION['senha'] = $senha;

        // Verifica se a opção "Manter-me conectado" foi selecionada
        if (isset($_POST['remember_me'])) {
            // Cria um cookie válido por 30 dias
            setcookie('user', $cpf, time() + (30 * 24 * 60 * 60), '/');
        }

        // Redireciona com base no tipo de usuário
        if ($sit_admin == 1) {
            header('Location: /postvmsl/public/index.php?page=sistema');
        } else if ($sit_admin == 0) {
            header('Location: /postvmsl/public/index.php?page=chamado');
        }
        exit;
    }
} else {
    // Não acessa
    header('Location: /postvmsl/public/index.php?page=login');
    exit;
}
?>
