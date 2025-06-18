<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiscOM </title>
    <link rel="icon" type="image/svg+xml" href="image/iconhome.svg">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(37, 81, 46), rgb(14, 48, 19));
        }
        div {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 40px;
            border-radius: 15px;
            color: #fff;
        }
        input {
            padding: 10px;
            border: none;
            outline: none;
            font-size: 15px;
            margin: 10px 0;
            width: 100%;
        }
        .inputSubmit {
            cursor: pointer;
            background-color: #557e65;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 10px;
            font-size: 15px;
        }
        .inputSubmit:hover {
            background-color: #63f58f;
        }
    </style>
</head>
<body>
    <div>
        <h1>Nova Senha</h1>
        <form action="attsenha.php" method="POST">
            <input type="password" name="nova_senha" placeholder="Digite sua nova senha" required>
            <br>
            <input type="password" name="confirma_senha" placeholder="Confirme sua nova senha" required>
            <br>
            <input class="inputSubmit" type="submit" value="Redefinir Senha">
        </form>
    </div>
</body>
</html>
