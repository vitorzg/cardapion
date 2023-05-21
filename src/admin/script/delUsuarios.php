<?php
    
    require_once("../../../classes/Autenticar.php");
    require_once("../../../classes/User.php");

    $cod = filter_input(INPUT_GET, "login");

    $verificar = new Autenticar('','');
    if ($verificar->verificarAutenticacao() == false) {

        header("location: ../../login.php");
        exit;

    } else if(isset($cod)){

        $deletar = new Usuario($cod,'','','','','','','');
        

        if ($deletar->deletarUsuario() == true) {
            header("location: ../usuarios.php");
            exit;
        }

    }




?>

