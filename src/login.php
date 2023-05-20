<?php

    session_start();
    $page = file_get_contents('../html/login.html');
    echo $page;
    
    if (isset($_SESSION['mensagemErro'])) {
        
        echo '<div class="mensagem-erro">' . $_SESSION['mensagemErro'] . '</div>';

        unset($_SESSION['mensagemErro']);
    }




?>