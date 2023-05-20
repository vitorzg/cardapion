<?php

     session_start();
    if ($_SESSION) {
        var_dump($_SESSION);
        
    } else{
        header("location: ./src/login.php");
        exit;
    }
    


?>

<a href="./src/logout.php">LOGOUT</a>