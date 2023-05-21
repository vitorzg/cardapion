
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CardapiON</title>
</head>
<body>
    <header>
    <?php

        require_once("./classes/Autenticar.php");

        $verificar = new Autenticar("","");
        if ($verificar->verificarAutenticacao() == false){
            header("location: ./src/login.php");
            exit;
        } 

        echo "
            <img src=\"#\" alt=\"logoCardapiON\">
            <div>
                <p>Bem-Vindo(a) ". $_SESSION['nome'] . "</p>
                <a href=\"./src/logout.php\"><button>Logout</button></a>
            </div>
        ";

    ?>
    </header>
    <main>
        <table border="1" >
            <tr>
                <th><a href="#"><img src="#" alt="imgCardapio"><h2>Cardápio</h2></a></th>
                <th><a href="./src/admin/usuarios.php"><img src="#" alt="imgUsuario"><h2>Usuários</h2></a></th>
                <th><a href="#"><img src="#" alt="imgComidas"><h2>Comidas</h2></a></th>
            </tr>
            <tr>
                <th><a href="#"><img src="#" alt="imgCategorias"><h2>Categorías</h2></a></th>
                <th><a href="#"><img src="#" alt="imgInterrogação"><h2>Em Breve</h2></a></th>
                <th><a href="#"><img src="#" alt="imgConfiguracoes"><h2>Configurações</h2></a></th>
            </tr>
    </main>
    <footer>
        <p>Copyright (c) 2023 Vitor Zucon.</p>
    </footer>
</body>
</html>

