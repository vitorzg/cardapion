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
    <title>Comidas - CardapiON</title>
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
        <a href="../../index.php"><button>Menu</button></a>
        <div>
            <a href="./script/adcComidas.php"><button>➕ Adicionar</button></a>
            <input type="search" name="buscar" id="buscar" placeholder="🔎 Procurar...">
        </div>
        <table border="1" align="center" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Preview</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quem Criou</th>
                <th>Editar</th>
                <th>Delete</th>
            </tr>
            <?php
            
                $db = new Conexao();
                $query = $db->prepare("SELECT * FROM comidas");
                $query->execute();
                $comidas = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($comidas) {
                    foreach ($comidas as $row){
                        $queryPreview = $db->prepare("SELECT path FROM fotos WHERE id_fotos = :1");
                        $queryPreview->bindValue(":1",$row['comida_foto_id']);
                        $queryPreview->execute();
                        $preview = $queryPreview->fetch(PDO::FETCH_ASSOC);

                        $queryCategoria = $db->prepare("SELECT nome_categoria FROM categorias WHERE id_categoria = :1");
                        $queryCategoria->bindValue(":1",$row['categoria_comida_id']);
                        $queryCategoria->execute();
                        $categoria = $queryCategoria->fetch(PDO::FETCH_ASSOC);

                        echo "
                            <tr>
                                <td>".$row['id_comida']."</td>
                                <td><img height=\"90\" src=".$preview['path']." alt=\"previewImagemComida\"></td>
                                <td>".$row['nome_comida']."</td>
                                <td>".$row['descricao']."</td>
                                <td>".$categoria['nome_categoria']."</td>
                                <td>".$row['preco']."</td>
                                <td>".$row['user_criou_id']."</td>
                                <td><a href=\"#\">🖊</a></td>
                                <td><a href=\"./script/delComidas.php?id={$row['id_comida']}\">❌</a></td>
                            </tr>
                        ";
                    }
                } else{
                    echo "
                        <tr>
                            <td colspan=\"9\">Não há Comidas Criadas até o Momento.</td>
                        </tr>
                    ";
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

