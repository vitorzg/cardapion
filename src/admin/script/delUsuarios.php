<?php
    
    require_once("../../../classes/Autenticar.php");
    require_once("../../../classes/User.php");

    $cod = filter_input(INPUT_GET, "login");

    $verificar = new Autenticar('','');
    if ($verificar->verificarAutenticacao() == false) {

        header("location: ../../login.php");
        exit;

    }
    
    if(isset($cod)){

        $deletar = new Usuario($cod,'','','','','','','');
        $deletar->deletarUsuario();
        
        header("location: ../usuarios.php");
        exit;

    } else{
        header("location: ../usuarios.php");
            exit;
    }




?>

