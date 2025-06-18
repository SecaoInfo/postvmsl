<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'if0_37957315_vmsl';
    

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $conexao->set_charset("utf8mb4");


    // if($conexao->connect_errno)
    // {
    //     echo "Erro";
    // }
    // else
    // {
    //     echo "Conexão efetuada com sucesso";
    // }

?>