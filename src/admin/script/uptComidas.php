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


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            
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
                    
                    $queryPath = $db->prepare("SELECT * FROM fotos WHERE id_fotos = (SELECT comida_foto_id FROM comidas WHERE id_comida = :id)");
                    $queryPath->bindValue(":id", $cod);
                    $queryPath->execute();
                    $fotoSQL = $queryPath->fetch(PDO::FETCH_ASSOC);
                    $caminho = "C:/xampp/htdocs/cardapion" . $fotoSQL['path'];

                    if (unlink($caminho)){
                        $gravarFoto = new Foto();
                        $id_foto = $gravarFoto->gravarFoto($foto['name'],uniqid(),$foto['tmp_name'],$pasta);
    
                        $comida = new Comida();
                        $comida->alterarComida($cod,$_POST['nome_comida'],$_POST['categoria'],$_POST['descricao'],$_POST['preco'],$id_foto);

                        $gravarFoto->deletarFoto($fotoSQL['id_fotos']);

                        $db->__destruct();
    
                        header("location: ../comidas.php");
                        exit;
                    } else {
                        $_SESSION['error'] = "erro ao excluir o arquivo antigo!! Tente novamente.";
                        header("location: adcComidas.php");
                        exit;
                    }


                } else{
                    $_SESSION['error'] = $caminho;
                    header("location: adcComidas.php");
                    exit;
                }

            }

        } else{

            $queryFoto = $db->prepare("SELECT comida_foto_id FROM comidas WHERE id_comida = :idcomida");
            $queryFoto->bindValue(":idcomida", $cod);
            $queryFoto->execute();
            $id_foto = $queryFoto->fetchColumn();

            $db->__destruct();

            var_dump($id_foto);

            $comida = new Comida();
            $comida->alterarComida($cod,$_POST['nome_comida'],$_POST['categoria'],$_POST['descricao'],$_POST['preco'],$id_foto);
    
            header("location: ../comidas.php");
            exit;
        }
    }

    $db->__destruct();


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
    <footer>
        <p>Copyright (c) 2023 Vitor Zucon, Maria Eduarda</p>
    </footer>
</body>
</html>