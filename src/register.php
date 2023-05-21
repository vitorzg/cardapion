<?php


    require_once("../classes/Autenticar.php");
    require_once("../classes/User.php");


    $verificar = new Autenticar("","");
    if ($verificar->verificarAutenticacao() == true) {

        $page = file_get_contents("../html/register.html");
        echo $page;
    
    
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            
            $user = new Usuario($_POST['login'],
                                md5($_POST['senha']),
                                $_POST['cpf'],
                                $_POST['nome'],
                                $_POST['data_nasc'],
                                $_POST['email'],
                                $_POST['tel'],
                                $_SESSION['login']
                                );

            if($user->gravarUsuario() == true){
                echo "<span id=\"user_registrado\">Usuário Registrado</span>";
            }else {
                echo "<span id=\"user_registrado\">Ocorreu um erro, Usuário Não Registrado</span>";
            }
    
        }
    } else{
        header("location: login.php");
    }


?>

