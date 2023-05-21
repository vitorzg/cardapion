<?php

    class Usuario {
        private $login;
        private $senha;
        private $cpf;
        private $nome;
        private $datanasc;
        private $email;
        private $tel;
        private $user_criou;

        public function __construct($login,$senha,$cpf,$nome,$datanasc,$email,$tel,$user_criou)
        {
            $this->login = $login;
            $this->senha = $senha;
            $this->cpf = $cpf;
            $this->nome = $nome;
            $this->datanasc = $datanasc;
            $this->email = $email;
            $this->tel = $tel;
            $this->user_criou = $user_criou;
        }

        

        public function gravarUsuario(){
            require_once("Conexao.php");

            $db = new Conexao();
    
            $query = $db->prepare("INSERT INTO users(login,
                                                     nome, 
                                                     cpf, 
                                                     email, 
                                                     tel, 
                                                     data_nasc, 
                                                     senha, 
                                                     user_criou) VALUES(:1, :2, :3, :4, :5, :6, :7, :8)");
    
            $query->bindValue(":1", $this->login);
            $query->bindValue(":2", $this->nome);
            $query->bindValue(":3", $this->cpf);
            $query->bindValue(":4", $this->email);
            $query->bindValue(":5", $this->tel);
            $query->bindValue(":6", $this->datanasc);
            $query->bindValue(":7", $this->senha);
            $query->bindValue(":8", $this->user_criou);
    
            $query->execute();

            $db->__destruct();

            return true;

        }

        public function lerUsuario(){
            require_once("Conexao.php");

            $db = new Conexao();
            $query = $db->prepare("SELECT * FROM users WHERE login= :1");
            $query->bindValue("1",$this->login);
            $query->execute();
            $usuario = $query->fetch(PDO::FETCH_ASSOC);

            $dados = [];
            $dados['login'] = $usuario['login'];
            $dados['nome'] = $usuario['nome'];
            $dados['cpf'] = $usuario['cpf'];
            $dados['email'] = $usuario['email'];
            $dados['tel'] = $usuario['tel'];
            $dados['data_nasc'] = $usuario['data_nasc'];
            $dados['senha'] = $usuario['senha'];

            $db->__destruct();

            return $dados;
        }

        public function deletarUsuario(){

            require_once("Conexao.php");
            
            $db = new Conexao();
            $query = $db->prepare("DELETE FROM users WHERE login = :1");
            $query->bindValue("1",$this->login);
            $query->execute();
            $db->__destruct();
            
            return true;
            
        }

        public function atualizarUsuario(){
            require_once("Conexao.php");

            $db = new Conexao();
            $query = $db->prepare("UPDATE users 
                                   SET nome = :2,
                                       cpf = :3,
                                       email = :4,
                                       tel = :5,
                                       data_nasc = :6,
                                       senha = :7,
                                       user_criou = :8 
                                    WHERE login = :1");

            $query->bindValue("2", $this->nome);
            $query->bindValue("3", $this->cpf);
            $query->bindValue("4", $this->email);
            $query->bindValue("5", $this->tel);
            $query->bindValue("6", $this->datanasc);
            $query->bindValue("7", $this->senha);
            $query->bindValue("8", $this->user_criou);
            $query->bindValue("1",$this->login);

            $query->execute();

            $db->__destruct();

            return true;

        }

    }

?>