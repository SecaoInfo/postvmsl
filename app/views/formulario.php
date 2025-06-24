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

        include_once('/../../config/config.php');

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
    <link rel="icon" type="image/png" href="./assets/images/iconhome.svg">
    <link rel="stylesheet" href="./assets/css/pages/formulario/formulario.css">


</head>
<body>
    <a id='voltar' href="/postvmsl/public/index.php?page=index">Voltar</a>
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