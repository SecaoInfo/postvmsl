<?php

    if(!empty($_GET['id']))
    {
        include_once(__DIR__ . '/../../config/config.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM chamados WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM chamados WHERE id=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: my_chamados.php');
   
?>