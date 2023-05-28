<?php

    require_once("../classes/Conexao.php");

    $db = new Conexao();
    $query = $db->prepare("SELECT nome_categoria,
                                  id_categoria FROM categorias");
    $query->execute();
    $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

    if (!isset($_GET['cat'])) {
        $query = $db->prepare("SELECT c.nome_comida, c.descricao, c.preco, c.categoria_comida_id, c.comida_foto_id, cat.nome_categoria, f.path 
                               FROM comidas c 
                               JOIN categorias cat ON c.categoria_comida_id = cat.id_categoria 
                               JOIN fotos f ON c.comida_foto_id = f.id_fotos;");
        $query->execute();
    
        $comidas = $query->fetchAll(PDO::FETCH_ASSOC);
    
    } else{
        $query = $db->prepare("SELECT c.nome_comida, c.descricao, c.preco, c.categoria_comida_id, c.comida_foto_id, cat.nome_categoria, f.path 
                               FROM comidas c 
                               JOIN categorias cat ON c.categoria_comida_id = cat.id_categoria 
                               JOIN fotos f ON c.comida_foto_id = f.id_fotos
                               WHERE c.categoria_comida_id = :id_categoria;");
        $query->bindValue(":id_categoria",$_GET['cat']);
        $query->execute();
    
        $comidas = $query->fetchAll(PDO::FETCH_ASSOC);
    
    }
    
    $db->__destruct();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - CardapiOn</title>
</head>
<body>
    <header>
        <a href="../index.php" target="_blank">Admin Area</a>
    </header>
    <main>
        <div>
            <ul class="menu-horizontal">
                <li><a href="cardapio.php">Todos</a></li>
                    <?php
                        if (isset($categorias)) {
                            foreach ($categorias as $row) {
                                echo "<li><a href=\"cardapio.php?cat={$row['id_categoria']}\">" . $row['nome_categoria'] . "</a></li>";
                            }
                        }
                    ?>
            </ul>

        </div>
        <hr>

        <div>
            <?php
                if (isset($comidas)) {
                    foreach ($comidas as $row){
                        echo "
                        <div>
                            <div>
                                <h2>".$row['nome_comida']."</h2>
                                <h4>".$row['nome_categoria']."</h4>
                                <p>".$row['descricao']."</p>
                                <h3>R$ ".($row['preco']/100)."</h3>
                            </div>
                            <div>
                                <img src=\"..{$row['path']}\" alt=\"imgComida{$row['nome_comida']}\">
                            </div>
                        </div>
                        <hr>
                        " ;
                    }
                } else{
                    echo"<span>Não há nenhuma comida adicionada até o momento</span>";
                }
            
            ?>

        </div>
    </main>
    <footer>
        <p>Copyright (c) 2023 Vitor Zucon, Maria Eduarda.</p>
    </footer>
</body>
</html>