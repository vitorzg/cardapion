<?php

    require_once('../classes/Autenticar.php');

    $sair = new Autenticar("PLacehoulder","PLacehoulder");
    $sair->encerrarSessao();
    exit;


?>