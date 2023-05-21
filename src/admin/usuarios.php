<?php

    require_once('../../classes/Autenticar.php');
    require_once('../../classes/Conexao.php');

    $verificar = new Autenticar("","");
    if($verificar->verificarAutenticacao() == false){
        header("location: ../login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários - CardapiON</title>
</head>
<body>
    <header>
    <?php
    echo "
        <img src=\"#\" alt=\"logoCardapiON\">
        <div>
            <p>Bem-Vindo(a) ". $_SESSION['nome'] . "</p>
            <a href=\"../logout.php\"><button>Logout</button></a>
        </div>
        ";
    ?>
    </header>
    <main>
        <div>
            <a href="../register.php"><button>➕ Adicionar</button></a>
            <input type="search" name="buscar" id="buscar" placeholder="🔎 Procurar...">
        </div>
        <table border="1" align="center">

            <tr>
                <th>Nome Completo</th>
                <th>login</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Quem Criou?</th>
                <th>Editar</th>
                <th>Delete</th>
            </tr>
            <?php
            
                $db = new Conexao();
                $query = $db->prepare("SELECT * FROM users");
                $query->execute();
                $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($usuarios as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["login"] . "</td>";
                    echo "<td>" . $row["cpf"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["tel"] . "</td>";
                    echo "<td>" . $row["user_criou"] . "</td>";
                    echo "<td><a href=\"./script/uptUsuarios.php?login={$row['login']}\">🖊</a></td>";
                    echo "<td><a href=\"./script/delUsuarios.php?login={$row['login']}\">❌</a></td>";
                    echo "</tr>";
                }

                $db->__destruct();
            
            ?>

        </table>

        
    </main>
    <footer>
        <p>Copyright (c) 2023 Vitor Zucon.</p>
    </footer>
</body>
</html>