<?php
session_start();
include_once('config.php');

if (!empty($_POST['nova_senha']) && !empty($_POST['confirma_senha']) && isset($_SESSION['cpf_redefinir'])) {
    $nova_senha = $_POST['nova_senha'];
    $confirma_senha = $_POST['confirma_senha'];
    $cpf = $_SESSION['cpf_redefinir'];

    if ($nova_senha === $confirma_senha) {
        // Atualiza a senha no banco de dados
        $sql = "UPDATE usuarios SET senha = '$nova_senha' WHERE cpf = '$cpf'";
        if ($conexao->query($sql) === TRUE) {
            echo "<script>alert('Senha redefinida com sucesso!');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Erro ao redefinir a senha. Tente novamente.');</script>";
            echo "<script>window.location.href = 'redefineSenha.php';</script>";
        }
    } else {
        echo "<script>alert('As senhas não correspondem!');</script>";
        echo "<script>window.location.href = 'redefineSenha.php';</script>";
    }
} else {
    header('Location: esqueceu.php');
    exit;
}
?>
