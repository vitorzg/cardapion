<?php

    require_once("../../../classes/Autenticar.php");
    require_once("../../../classes/Categoria.php");

    $verificar = new Autenticar("","");
    if($verificar->verificarAutenticacao() == false){
        header("location: ../../login.php");    
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $categoria = new Categoria();
        $categoria->atualizarCategoria($_POST['id_categoria'],$_POST['nome_categoria'],$_POST['user_criou']);

        header("location: ../categorias.php");
        exit;

    }

?>