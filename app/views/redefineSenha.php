<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiscOM </title>
    <link rel="icon" type="image/png" href="./assets/images/iconhome.svg">
    <link rel="stylesheet" href="./assets/css/pages/redefineSenha/redefineSenha.css">
</head>
<body>
    <div>
        <h1>Nova Senha</h1>
        <form action="/postvmsl/public/index.php?page=attsenha" method="POST">
            <input type="password" name="nova_senha" placeholder="Digite sua nova senha" required>
            <br>
            <input type="password" name="confirma_senha" placeholder="Confirme sua nova senha" required>
            <br>
            <input class="inputSubmit" type="submit" value="Redefinir Senha">
        </form>
    </div>
</body>
</html>
