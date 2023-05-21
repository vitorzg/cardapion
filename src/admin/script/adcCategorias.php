<?php

    require_once("../../../classes/Autenticar.php");
    require_once("../../../classes/Categoria.php");

    $verificar = new Autenticar("","");
    if($verificar->verificarAutenticacao() == false){
        header("location: ../../login.php");    
        exit;
    } 

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $categoria = new Categoria();
        $categoria->gravarCategoria($_POST['nome_categoria'],$_SESSION['login']);
        header("location: ../categorias.php");
        exit;
    }else{
        header("location: ../categorias.php");
        exit;
    }


?>