<?php

    require_once("../classes/Autenticar.php");

    $verificar = new Autenticar("","");
    
    if ($verificar->verificarAutenticacao() == true){
        var_dump($_SESSION);
    } else{
        header("location: ./src/login.php");
        exit;
    }


?>

<a href="./src/logout.php">LOGOUT</a>
<a href="./src/register.php">REGISTER</a>