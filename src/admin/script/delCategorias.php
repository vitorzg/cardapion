<?php

    require_once("../../../classes/Autenticar.php");
    require_once("../../../classes/Categoria.php");

    $verificar = new Autenticar("","");
    if($verificar->verificarAutenticacao() == false){
        header("location: ../../login.php");    
        exit;
    }

    $cat = filter_input(INPUT_GET, "categoria");

    if(isset($cat)){

        $deletar = new Categoria();
        $deletar->deletarCategoria($cat);

        header("location: ../categorias.php");
        exit;
    } else{
        header("location: ../categorias.php");
        exit;
    }

?>