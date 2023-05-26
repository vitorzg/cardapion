<?php

    require_once('../../../classes/Autenticar.php');
    require_once('../../../classes/Conexao.php');
    require_once('../../../classes/Comida.php');

    $verificar = new Autenticar("","");
    if($verificar->verificarAutenticacao() == false){
        header("location: ../../login.php");
        exit;
    }

    $db = new Conexao();
    $query = $db->prepare('SELECT * FROM categorias');
    $query->execute();
    $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
    $db->__destruct();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_FILES['foto'])) {

            $foto = $_FILES['foto'];

            if ($foto['size'] > 104857600) {
                die("Imagem muito grande!! MAX: 100MB");
            }

            $pasta = "/server/pictures/";

            if (!is_dir("../../..".$pasta)) {
                mkdir("../../..".$pasta, 0777, true);
            }

            $nome_foto = $foto['name'];
            $novo_nome_foto = uniqid();
            $extensao = strtolower(pathinfo($nome_foto,PATHINFO_EXTENSION));
            $path = $pasta.$novo_nome_foto.".".$extensao;

            if ($extensao == 'jpeg' || $extensao == 'jpg' || $extensao == 'png' || $extensao == 'gif') {

                $upload = move_uploaded_file($foto['tmp_name'],"../../.." . $path);

                $db = new Conexao();
                $query = $db->prepare("INSERT INTO fotos(users_upload_id,
                                                         nome_foto,
                                                         path) VALUES (:1,:2,:3)");
                $query->bindValue(":1",$_SESSION['login']);
                $query->bindValue(":2",$nome_foto);
                $query->bindValue(":3",$path);

                $query->execute();
                $id_foto = $db->lastInsertId();

                $db->__destruct();

            }else{
                die("Tipo de Arquivo não aceito");
            }

        }

        if ($_POST['categoria'] != NULL) {
            $comida = new Comida();
            $comida->gravarComida($_POST['nome_comida'],$_POST['categoria'],$_POST['descricao'],$_POST['preco'],$id_foto,$_SESSION['login']);
            echo "Comida cadastrada!!";
        } else{
            die("Campo categoria não selecionado!!");
        }

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Comidas - CardapiON</title>
</head>
<body>
    <main>
        <div>
            <a href="../../../index.php"><button>Menu</button></a>
        </div>
        <a href="../comidas.php"><button>◀</button></a>
        <form action="" method="post" enctype="multipart/form-data">
            
        <div>
            <label for="nome_comida">Nome da Comida:</label>
            <input type="text" name="nome_comida" id="nome_comida" required>
        </div>
        <div>
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" required>
                <option value="NULL" selected>--Selecione uma Categoria--</option>
                <?php
                    foreach ($categorias as $row) {
                        echo "<option value=".$row['id_categoria'].">".$row['nome_categoria']."</option>";
                    }
                ?>
            </select>
            <a href="../categorias.php">➕</a>
        </div>
        <div>
            <div>
                <label for="descricao">Descrição:</label>
            </div>
            <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>
        </div>
        <div>
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto" required>
        </div>
        <div>
            <label for="preco">Preço</label>
            <input type="number" name="preco" id="preco" required>
        </div>
        
            <button type="submit">Adicionar</button>
        </form>
    </main>
</body>
</html>