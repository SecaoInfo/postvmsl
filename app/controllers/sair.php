<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Remove todas as variáveis de sessão
session_unset();

// Destrói a sessão
session_destroy();

// Remove o cookie 'user', se existir
if (isset($_COOKIE['user'])) {
    setcookie('user', '', time() - 3600, '/'); // Define o tempo do cookie para o passado
}

// Redireciona para o index.php
header('Location: /postvmsl/public/index.php?page=index');
exit;
?>
