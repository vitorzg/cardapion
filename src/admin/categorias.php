<?php

    require_once('../../classes/Autenticar.php');
    require_once('../../classes/Conexao.php');
    require_once('../../classes/Categoria.php');

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
    <title>Categorias - CardapiON</title>
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
            <?php
                $cod = filter_input(INPUT_GET, "status");
                $cat = filter_input(INPUT_GET, "categoria");

                if (isset($cod)) {
                    echo"
                        <form action=\"./script/adcCategorias.php\" method=\"post\">
                            <div>
                                <label for=\"nome_categoria\">Nome da Categoria:</label>
                                <input type=\"text\" name=\"nome_categoria\" id=\"nome_categoria\" placeholder=\"Nome da Categoria\">
                            </div>
                            <button type=\"submit\">Criar</button>
                        </form>
                        <a href=\"categorias.php\"><button>Cancelar</button></a>
                    ";
                } else {
                    echo "
                        <a href=\"categorias.php?status=adicionar\"><button>➕ Adicionar</button></a>
                        <input type=\"search\" name=\"buscar\" id=\"buscar\" placeholder=\"🔎 Procurar...\">
                    ";
                }
            ?>
        </div>

        <?php
        
            if (isset($cat)) {
                $categoria = new Categoria();
                $dados = $categoria->lerCategoria($cat);

                echo "
                    <form action=\"./script/uptCategorias.php\" method=\"post\">
                        <div>
                            <input style=\"display: none;\" type=\"number\" name=\"id_categoria\" id=\"id_categoria\" value=".$dados['id_categoria'].">
                        </div>
                        <div>
                            <label for=\"nome_categoria\">Nome da Categoria</label>
                            <input type=\"text\" name=\"nome_categoria\" id=\"nome_categoria\" required value=".$dados['nome_categoria'].">
                        </div>
                        <div>
                            <input style=\"display: none;\" type=\"text\" name=\"user_criou\" id=\"user_criou\" value=".$dados['user_criou_id'].">
                        </div>
                        <button type=\"submit\">Atualizar</button>
                    </form>
                    <a href=\"categorias.php\"><button>Cancelar</button></a>
                ";
            }
        
        ?>

        <table border="1" align="center" cellpadding="10">
        <tr>
            <th>ID Categoria</th>
            <th>Nome da Categoria</th>
            <th>Usuário que criou</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
        
        <?php
        
            $db = new Conexao();
            $query = $db->prepare("SELECT * FROM categorias");
            $query->execute();
            $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($categorias) {
                foreach ($categorias as $row) {
                    echo "
                        <tr>
                        <td>".$row['id_categoria']."</td>
                        <td>".$row['nome_categoria']."</td>
                        <td>".$row['user_criou_id']."</td>
                        <td><a href=\"categorias.php?categoria={$row['id_categoria']}\">🖊</a></td>
                        <td><a href=\"./script/delCategorias.php?categoria={$row['id_categoria']}\">❌</a></td>
                        </tr>
                    ";
                }
            } else {
                echo "
                    <tr>
                    <td colspan=\"5\">Não há Categorias Criadas até o Momento.</td>
                    </tr>
                ";
            }
        
        ?>
        </table>
        
    </main>
    <footer>
        <p>Copyright (c) 2023 Vitor Zucon.</p>
    </footer>
</body>
</html>


