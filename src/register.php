<?php

    require_once("../classes/Conexao.php");

    $page = file_get_contents("../html/register.html");
    echo $page;


    if($_SERVER['REQUEST_METHOD'] === "POST"){
        
        $db = new Conexao();

        $query = $db->prepare("INSERT INTO users(login, nome, cpf, email, tel, data_nasc, senha) VALUES(:1, :2, :3, :4, :5, :6, :7)");

        $query->bindValue(":1", $_POST['login']);
        $query->bindValue(":2", $_POST['nome']);
        $query->bindValue(":3", $_POST['cpf']);
        $query->bindValue(":4", $_POST['email']);
        $query->bindValue(":5", $_POST['tel']);
        $query->bindValue(":6", $_POST['data_nasc']);
        $query->bindValue(":7", md5($_POST['senha']));

        $query->execute();

        $db = NULL;

        echo "Usuário Registrado";
    }

?>