<?php

    require_once('Conexao.php');

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
                $db->__destruct();
                return true;
            }

            $db->__destruct();
            return false;
        }

        public function verificarAutenticacao() {
            session_start();

            if ($_SESSION) {
                return true;
            }
        }

        public function encerrarSessao() {
            session_start();
            session_destroy();
            return true;
        }
    }

?>
