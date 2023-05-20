<?php

    require_once('../classes/Autenticar.php');
    session_start();

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        
        $user = new Autenticar($_POST['login'],md5($_POST['senha']));

        if ($user->autenticarUser()) {
            header("location: ../index.php");
            unset($_SESSION['senha']);
        } else {
            $_SESSION['mensagemErro'] = 'Usuário ou senha inválidos';
            header('location: login.php');
            exit;
        }

    }

?>
