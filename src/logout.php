<?php

    require_once('../classes/Autenticar.php');

    $sair = new Autenticar("","");
    $sair->encerrarSessao();
    header("location: login.php");
    exit;


?>