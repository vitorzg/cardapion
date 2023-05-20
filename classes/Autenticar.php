<?php

require_once '../classes/Conexao.php';

class Autenticar {
    private $login;
    private $senha;

    public function __construct($login, $senha)
    {
        $this->login = $login;
        $this->senha = $senha;
    }

    public function autenticarUser() {
        $db = new Conexao();
        $query = $db->prepare("SELECT * FROM users WHERE login = :login");
        $query->bindValue(':login', $this->login);
        $query->execute();

        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $this->senha == $usuario['senha']) {
            session_start();
            $_SESSION = $usuario;
            $db = null;
            return true;
        }

        $db = null;
        return false;
    }

    public function verificarAutenticacao() {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }
    }

    public function encerrarSessao() {
        session_start();
        session_destroy();
        header("location: login.php");
    }
}

?>
