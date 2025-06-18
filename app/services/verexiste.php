<?php
session_start();
include_once('config.php');

if (!empty($_POST['cpf']) && !empty($_POST['nome'])) {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];

    // Verifica no banco de dados
    $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf' AND nome = '$nome'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        // Usuário encontrado, redireciona para a redefinição de senha
        $_SESSION['cpf_redefinir'] = $cpf;
        header('Location: redefineSenha.php');
        exit;
    } else {
        // Usuário não encontrado
        echo "<script>alert('CPF ou Nome inválido! Tente novamente.');</script>";
        echo "<script>window.location.href = 'esqueceu.php';</script>";
        exit;
    }
} else {
    header('Location: esqueceu.php');
    exit;
}
?>
