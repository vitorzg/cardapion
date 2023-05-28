<?php

    require_once("../../../classes/Autenticar.php");
    require_once('../../../classes/User.php');

    $cod = filter_input(INPUT_GET, "login");

    $verificar = new Autenticar("","");
    if($verificar->verificarAutenticacao() == false){
        header("location: ../../login.php");    
        exit;
    } 
    
    if(isset($cod) && $_SERVER['REQUEST_METHOD'] === "GET"){
        

        $usuario = new Usuario($cod,'','','','','','','');
        $dados = $usuario->lerUsuario();
        $usuario = NULL;

    } else if($_SERVER['REQUEST_METHOD'] === "POST"){

        $update = new Usuario($cod,
                              md5($_POST['senha']),
                              $_POST['cpf'],
                              $_POST['nome'],
                              $_POST['data_nasc'],
                              $_POST['email'],
                              $_POST['tel'],
                              $_SESSION['login']);

        if($update->atualizarUsuario() == true){
            header("location: ../usuarios.php");
        } else {
            echo "Erro.";
        }

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="../js/script.js"></script>
    <title>Register User - CardapiOn</title>
</head>
<body>
    <header>
        <?php

            echo "
                <img src=\"#\" alt=\"logoCardapiON\">
                <div>
                    <p>Bem-Vindo(a) ". $_SESSION['nome'] . "</p>
                    <a href=\"./src/logout.php\"><button>Logout</button></a>
                </div>
            ";

        ?>
    </header>
    <form method="post" action="">
        <div>
          <label for="login">Login:</label>
          <input type="text" id="login" name="login" disabled value="<?= $dados['login'];?>" >
        </div>
      
        <div>
          <label for="cpf">CPF:</label>
          <input type="text" id="cpf" name="cpf" required value="<?= $dados['cpf'];?>">
        </div>
      
        <div>
          <label for="nome">Nome Completo:</label>
          <input type="text" id="nome" name="nome" required value="<?= $dados['nome'];?>">
        </div>
      
        <div>
          <label for="data_nasc">Data de Nascimento:</label>
          <input type="date" id="data_nasc" name="data_nasc" required value="<?= $dados['data_nasc'];?>"><br> 
        </div>
      
        <div>  
            <label for="email">Email:</label> 
            <input type="email" id="email" name="email" required value="<?= $dados['email'];?>"><br> 
        </div> 
      
        <div>  
            <label for="tel">Telefone:</label> 
            <input type="tel" id="tel" name="tel" required maxlength="12" value="<?= $dados['tel'];?>"><br> 
        </div>

        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required value="<?= $dados['senha'];?>">
        </div>
      
            <button type="submit" id="submit" name="submit">Enviar</button> 
    </form>
    <footer>
        <p>Copyright (c) 2023 Vitor Zucon, Maria Eduarda</p>
    </footer> 
</body>
</html>