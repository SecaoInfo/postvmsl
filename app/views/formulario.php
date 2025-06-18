<?php
    
    if(isset($_POST['submit']))
    {
        // print_r('Nome: ' . $_POST['nome']);
        // print_r('<br>');
        // print_r('Email: ' . $_POST['email']);
        // print_r('<br>');
        // print_r('Telefone: ' . $_POST['telefone']);
        // print_r('<br>');
        // print_r('Sexo: ' . $_POST['genero']);
        // print_r('<br>');
        // print_r('Data de nascimento: ' . $_POST['data_nascimento']);
        // print_r('<br>');
        // print_r('Cidade: ' . $_POST['cidade']);
        // print_r('<br>');
        // print_r('Estado: ' . $_POST['estado']);
        // print_r('<br>');
        // print_r('Endereço: ' . $_POST['endereco']);

        include_once('config.php');

        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];


        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,cpf,senha,telefone,endereco,numero) 
        VALUES ('$nome','$cpf','$senha','$telefone','$endereco','$numero')");


        header('Location: login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiscOM </title>
    <link rel="icon" type="image/svg+xml" href="image/iconhome.svg">
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(to right, rgb(37, 81, 46), rgb(14, 48, 19));
        margin: 0;
        padding: 0;
        font-size: 16px;
        overflow-x: hidden;
    }
    .box {
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.6);
        padding: 20px;
        border-radius: 15px;
        width: 80%;
        max-width: 400px;
        margin-top: 120px;
    }
    fieldset {
        border: 3px solid #63f58f;
    }
    legend {
        border: 1px solid white;
        padding: 10px;
        text-align: center;
        background-color: linear-gradient(to right, rgba(37, 81, 46, 0.1), rgba(14, 48, 19, 0.3));
        border-radius: 8px;
    }
    .inputBox {
        position: relative;
        margin-bottom: 14px; /* Espaçamento entre os campos */
    }
 
    .inputUser {
        background: none;
        border: none;
        border-bottom: 1px solid white;
        outline: none;
        color: white;
        font-size: 15px;
        width: 100%;
        letter-spacing: 2px;
    }
    .labelInput {
        position: absolute;
        top: 0px;
        left: 0px;
        pointer-events: none;
        transition: .5s;
        position: static; /* Adicione essa linha */
    }
    #endereco {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        margin-bottom: 15px;
        box-sizing: border-box;
        color: #ffffff;
        background-color: rgba(0, 0, 0, 0.5);
        background: #557e65;
    }
    #endereco:hover{
        background-color: #63f58f;
    }
    

    #endereco option {
        color: #000000;
        background-color: #ffffff;
    }
    #endereco:focus {
        outline: none;
        border-color: #009688;
    }
    .inputUser:focus ~ .labelInput,
    .inputUser:valid ~ .labelInput {
        top: -20px;
        font-size: 9px;
        color: #63f58f;
    }
    #submit {
        background-color: #557e65;
        width: 100%;
        border: none;
        padding: 15px;
        color: white;
        font-size: 15px;
        cursor: pointer;
        border-radius: 10px;
    }
    #submit:hover {
        background-color: #63f58f;
        cursor:pointer;
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
</style>

</head>
<body>
    <a id='voltar' href="index.php">Voltar</a>
    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Cadastro de Moradores </b></legend>
                <br>
                <div class="inputBox">
                    <label for="nome" class="labelInput">Nome completo</label>
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                </div>
                <br>
                <div class="inputBox">
                    <label for="senha" class="labelInput">Senha</label>
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="cpf" class="labelInput">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="inputUser" required pattern="\d{11}" title="Digite exatamente 11 números sem pontos ou traços.">
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="telefone" class="labelInput">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                </div>               
                <br><br>
                <div class="inputBox">
                    <select id="endereco" name="endereco" >
                    <option value="">Selecione a Rua...</option>
                    <option value="RUA CEL AQUILES PEDENEIRAS">RUA CEL AQUILES PEDENEIRAS</option>
                    <option value="RUA CEL AMAURY">RUA CEL AMAURY</option>
                    <option value="RUA CEL ANDRADE NEVES">RUA CEL ANDRADE NEVES</option>
                    <option value="RUA CEL CASTRO JUNIOR">RUA CEL CASTRO JUNIOR</option>
                    <option value="RUA CEL ESPIRIDAO ROSAS">RUA CEL ESPIRIDAO ROSAS</option>
                    <option value="RUA CEL FIUZA DE CASTRO">RUA CEL FIUZA DE CASTRO</option>
                    <option value="RUA CEL HASTIMPHILO DE MOURA">RUA CEL HASTIMPHILO DE MOURA</option>
                    <option value="RUA CEL LINDOLPHO SERRA">RUA CEL LINDOLPHO SERRA</option>
                    <option value="RUA CEL MARTINS PEREIRA">RUA CEL MARTINS PEREIRA</option>
                    <option value="RUA CEL PEDRO IVO">RUA CEL PEDRO IVO</option>
                    <option value="RUA CEL SILIO PORTELA">RUA CEL SILIO PORTELA</option>
                    <option value="RUA CEL UCHOA">RUA CEL UCHOA</option>
                    <option value="RUA DA INDUSTRIA">RUA DA INDUSTRIA</option>
                    <option value="RUA DUQUE DE CAXIAS">RUA DUQUE DE CAXIAS</option>
                    <option value="RUA GEN ALTAIR">RUA GEN ALTAIR</option>
                    <option value="RUA GEN OCTAVIO">RUA GEN OCTAVIO</option>
                    <option value="RUA GEN PARGAS RODRIGUES">RUA GEN PARGAS RODRIGUES</option>
                    <option value="RUA GEN PONDE">RUA GEN PONDE</option>
                    <option value="RUA GEN WEDMAN">RUA GEN WEDMAN</option>
                    <option value="RUA MAJ DOUTOR AZEVEDO">RUA MAJ DOUTOR AZEVEDO</option>
                    <option value="RUA MESTRE CAMARGO">RUA MESTRE CAMARGO</option>
                    <option value="RUA MESTRE JORGE">RUA MESTRE JORGE</option>
                    <option value="RUA MESTRE NUNO">RUA MESTRE NUNO</option>
                    <option value="RUA MESTRE SADOCK DE SA">RUA MESTRE SADOCK DE SA</option>
                    <option value="RUA PARANA">RUA PARANA</option>
                    <option value="RUA SAMUEL DA SILVA CALDAS">RUA SAMUEL DA SILVA CALDAS</option>
                    <option value="APARTAMENTO">APARTAMENTO</option>

                    </select><br /><br />
                </div>

                <div class="inputBox">
                    <label for="numero" class="labelInput">Número</label>
                    <input type="tel" name="numero" id="numero" class="inputUser" required>
                </div> 

                <br><br>
                <button type="submit" name="submit" id="submit">Cadastrar</button>
            </fieldset>
        </form>
    </div>

</body>
</html>