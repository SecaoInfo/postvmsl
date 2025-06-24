<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiscOM </title>
    <link rel="icon" type="image/png" href="./assets/images/iconhome.svg">
    <link rel="stylesheet" href="./assets/css/pages/esqueceu/esqueceu.css">
</head>
<body>
    <div>
        <h1>Redefinir Senha</h1>
        <form action="/postvmsl/public/index.php?page=verexiste" method="POST">
            <input type="text" name="cpf" placeholder="Digite seu CPF" required>
            <br>
            <input type="text" name="nome" placeholder="Digite seu Nome Completo" required>
            <br>
            <input class="inputSubmit" type="submit" value="Trocar Senha">
        </form>
    </div>
</body>
</html>
