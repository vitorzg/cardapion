<?php

    require_once('../../../classes/Autenticar.php');
    require_once('../../../classes/Conexao.php');
    require_once('../../../classes/Comida.php');
    require_once('../../../classes/Foto.php');

    $verificar = new Autenticar("","");
    if($verificar->verificarAutenticacao() == false){
        header("location: ../../login.php");
        exit;
    }

    $cod = filter_input(INPUT_GET, "id");
    $cat = filter_input(INPUT_GET, "cat");

    $db = new Conexao();
    $query = $db->prepare('SELECT * FROM categorias');
    $query->execute();
    $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT * FROM comidas WHERE id_comida = :id");
    $query->bindValue(":id", $cod);
    $query->execute();
    $comida = $query->fetch(PDO::FETCH_ASSOC);

    $db->__destruct();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_FILES['foto'])) {
            
            $foto = $_FILES['foto'];

            if ($foto['size'] > 104857600) {

                $_SESSION['error'] = "Imagem muito grande!! MAX: 100MB";
                header("location: adcComidas.php");
                exit;
            } else {

                if ($_POST['categoria'] !== "NULL") {

                    $pasta = "/server/pictures/";
        
                    if (!is_dir("../../..".$pasta)) {
                        mkdir("../../..".$pasta, 0777, true);
                    }
    
                    $gravarFoto = new Foto();
                    $id_foto = $gravarFoto->gravarFoto($foto['name'],uniqid(),$foto['tmp_name'],$pasta);

                    $comida = new Comida();
                    $comida->alterarComida($cod,$_POST['nome_comida'],$_POST['categoria'],$_POST['descricao'],$_POST['preco'],$id_foto);

                    header("location: ../comidas.php");
                    exit;

                } else{
                    $_SESSION['error'] = "Campo categoria não selecionado!!";
                    header("location: adcComidas.php");
                    exit;
                }

            }

        } else{

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
            <input type="text" name="nome_comida" id="nome_comida"  value="<?=$comida['nome_comida'];?>">
        </div>
        <div>
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" >
                <option value="NULL">--Selecione uma Categoria--</option>
                <?php
                foreach ($categorias as $row) {
                    $selected = ($row['id_categoria'] == $cat) ? "selected" : "";
                    echo "<option value=".$row['id_categoria']." ".$selected.">".$row['nome_categoria']."</option>";
                }
                ?>
            </select>
            <a href="../categorias.php">➕</a>
        </div>
        <div>
            <div>
                <label for="descricao">Descrição:</label>
            </div>
            <textarea name="descricao" id="descricao" cols="30" rows="10"><?=$comida['descricao']?></textarea>
        </div>
        <div>
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto">
        </div>
        <div>
            <label for="preco">Preço</label>
            <input type="number" name="preco" id="preco" value="<?=$comida['preco']?>">
        </div>
        
            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>
</html>