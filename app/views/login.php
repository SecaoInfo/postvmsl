<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiscOM</title>
    <link rel="icon" type="image/svg+xml" href="image/iconhome.svg">
    <link rel="stylesheet" href="./assets/css/pages/login/login.css">

</head>
<body>
    <a id="voltar" href="/postvmsl/public/index.php?page=index">Voltar</a>
    <div>
        <h1>Login</h1>
        <form action="testLogin.php" method="POST">
            <input name="cpf" placeholder="CPF" required>
            <br><br>
            <input type="password" name="senha" placeholder="Senha" required>
            <br><br>
            <label>
                <input type="checkbox" id='check' name="remember_me">
                Manter-me conectado
            </label>
            <br><br>
            <input class="inputSubmit" type="submit" name="submit" value="Login">
        </form>
        <br><br>
        <a id='esquece' href='/postvmsl/public/index.php?page=esqueceu'>Esqueceu a Senha?</a>
    </div>


</body>
</html>
