<?php

    require_once("../../../classes/Autenticar.php");
    require_once("../../../classes/Comida.php");

    $cod = filter_input(INPUT_GET, "id");

    $verificar = new Autenticar("","");
    if($verificar->verificarAutenticacao() == false){
        header("location: ../../login.php");    
        exit;
    }

    echo $cod;

    if(isset($cod)){
        
        $deletar = new Comida();
        if($deletar->deletarComida($cod)){
            header("location: ../comidas.php");
            exit;
        }

    }

?>

