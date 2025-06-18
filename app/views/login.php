<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiscOM</title>
    <link rel="icon" type="image/svg+xml" href="image/iconhome.svg">

    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(to right, rgb(37, 81, 46), rgb(14, 48, 19));
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    div {
        background-color: rgba(0, 0, 0, 0.6);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 80px;
        margin-top:30px;
        border-radius: 15px;
        color: #fff;
        width: 90%; /* Ajusta a largura para dispositivos móveis */
        max-width: 400px; /* Largura máxima para evitar que fique grande demais */
    }

    input {
        padding: 15px;
        border: none;
        outline: none;
        font-size: 15px;
        width: 100%; /* Preenche toda a largura disponível */
        margin-bottom: 10px; /* Espaço entre os campos */
    }

    .inputSubmit {
        cursor: pointer;
        background-color: #557e65;
        transition: background-color 0.3s ease;
        border: none;
        padding: 15px;
        width: 100%;
        border-radius: 10px;
        color: white;
        font-size: 15px;
    }

    .inputSubmit:hover {
        background-color: #63f58f;
        cursor: pointer;
    }

    #esquece {
        color: #ffffff;
        text-decoration: none;
        font-size: 14px;
        margin-top: 10px;
        display: block;
        text-align: center;
    }

    #esquece:hover {
        color: #63f58f;
    }

    /* Personalizar o botão 'Voltar' */
    a#voltar {
        text-decoration: none;
        color: white;
        border: 3px ;
        border-radius: 10px;
        padding: 10px;
        background-color: #557e65;
        display: block;
        text-align: center;
        margin-bottom: 20px;
        width: 100px; /* Ajusta o tamanho do botão */
        margin: 0 auto;
    }

    a#voltar:hover {
        background-color: #63f58f;
        cursor: pointer;
    }

   

    /* Ajustes para dispositivos móveis */
    @media (max-width: 768px) {
        div {
            width: 80%;
            padding: 40px;
        }

        input {
            font-size: 14px;
        }

        .inputSubmit {
            font-size: 14px;
        }

        #voltar {
            width: 120px; /* Ajusta o tamanho do botão 'Voltar' para dispositivos menores */
        }
    }

    /* Alinha o checkbox e o texto na mesma linha e evita quebra de linha */
    label {
        display: flex;
        align-items: center; /* Alinha verticalmente */
        font-size: 14px; /* Ajusta o tamanho da fonte */
        white-space: nowrap; /* Impede quebra de linha */
    }

    input[type="checkbox"] {
        margin-right: -130px; /* Diminui a distância entre o checkbox e o texto */
    }
    </style>

</head>
<body>
    <a id="voltar" href="index.php">Voltar</a>
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
        <a id='esquece' href='esqueceu.php'>Esqueceu a Senha?</a>
    </div>


</body>
</html>
