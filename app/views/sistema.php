<?php
    session_start();
    include_once('config.php');

    $conexao->set_charset("utf8mb4");

    // print_r($_SESSION);
  if (!isset($_SESSION['cpf']) && isset($_COOKIE['user'])) {
    // Restaura a sessão a partir do cookie
    $_SESSION['cpf'] = $_COOKIE['user'];
    }

    // Verifica se o usuário está logado
    if (!isset($_SESSION['cpf'])) {
        header('Location: login.php');
        exit;
    }
   
     if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM chamados WHERE id LIKE '%$data%' or nome LIKE '%$data%' or endereco LIKE '%$data%' ORDER BY id DESC";
    }
    else
    {
        $sql = "SELECT * FROM chamados ORDER BY id DESC";
    }
    $result = $conexao->query($sql);
?>

   



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>SiscOM </title>
    <link rel="icon" type="image/svg+xml" href="image/iconhome.svg">
    <style>
        /* Estilos para o body */
        body {
            background: linear-gradient(to right, rgb(57, 99, 65), rgb(17, 56, 22));
            color: white;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.2em;
            margin: 0;
            padding: 0;
            width: auto;
            overflow-x: hidden;
        }

        /* Estilos para a navbar */
        .navbar {
            background: linear-gradient(to right, rgb(19, 57, 15), rgb(7, 33, 9));
        }

        /* Estilos para a tabela com fundo */
        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
            word-wrap: break-word;
            white-space: nowrap; /* Impede a quebra de linha dentro das células */
            max-width: 100%;
            width: 100%;
        }

        /* Estilos para a tabela */
        .table-responsive {
            overflow-x: auto; /* Permite scroll horizontal */
            -webkit-overflow-scrolling: touch; /* Suaviza o scroll em dispositivos móveis */
            padding: 10px; /* Ajusta o espaçamento */
        }

        /* Estilos para a caixa de pesquisa */
        .box-search {
            display: flex;
            justify-content: center;
            gap: 0.1%;
        }

        #btn-search {
            background-color: #557e65;
            border: none;
        }

        #btn-search:hover {
            background-color: #63f58f;
        }

        /* Media query para telas menores que 768px */
        @media (max-width: 768px) {
            .table-bg {
                border-radius: 5px 5px 0 0;
                padding: 2px;
                margin: 2px auto;
                overflow-x: auto;
                width: 100%;
                max-width: 100%;
                transform: scale(0.8);
                transform-origin: top left;
                zoom: 0.8;
            }

            /* Ajuste do fundo no body para dispositivos móveis */
            body {
                background-size: 100% 100%;
                background-position: center;
            }

            /* Estilos para a navbar em dispositivos móveis */
            .navbar {
                flex-direction: column;
                align-items: center;
            }

            .navbar > * {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SiscOM</a>

        </div>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <br>

    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>
    </div>
    <div class="m-5 table-responsive">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Número</th>
                    <th scope="col">Veiculo</th>
                    <th scope="col">Serviço</th>
                    <th scope="col">Previsão</th>
                    <th scope="col">Obs</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['telefone']."</td>";
                        echo "<td>".$user_data['endereco']."</td>";
                        echo "<td>".$user_data['numero']."</td>";
                        echo "<td>".$user_data['veiculo']."</td>";
                        echo "<td>".$user_data['service']."</td>";
                        echo "<td>".$user_data['previsto']."</td>";
                        echo "<td>".$user_data['obs']."</td>";
                        echo "<td>

                            <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]' title='Deletar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>

</body>
<script>
var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        searchData();
    }
});

function searchData() {
    window.location = 'sistema.php?search=' + search.value;
}
</script>

</html>