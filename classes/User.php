<?php

    class User {
        private $login;
        private $senha;
        private $cpf;
        private $nome;
        private $datanasc;
        private $email;
        private $tel;

        public function __construct($login,$senha,$cpf,$nome,$datanasc,$email,$tel)
        {
            $this->login = $login;
            $this->senha = $senha;
            $this->cpf = $cpf;
            $this->nome = $nome;
            $this->datanasc = $datanasc;
            $this->email = $email;
            $this->tel = $tel;
        }

        public function getLogin()
        {
            return $this->login;
        }

        // Setter para a propriedade $login
        public function setLogin($login)
        {
            $this->login = $login;
        }

        // Getter para a propriedade $senha
        public function getSenha()
        {
            return $this->senha;
        }

        // Setter para a propriedade $senha
        public function setSenha($senha)
        {
            $this->senha = $senha;
        }

        // Getter para a propriedade $cpf
        public function getCpf()
        {
            return $this->cpf;
        }

        // Setter para a propriedade $cpf
        public function setCpf($cpf)
        {
            $this->cpf = $cpf;
        }

        // Getter para a propriedade $nome
        public function getNome()
        {
            return $this->nome;
        }

        // Setter para a propriedade $nome
        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        // Getter para a propriedade $datanasc
        public function getDatanasc()
        {
            return $this->datanasc;
        }

        // Setter para a propriedade $datanasc
        public function setDatanasc($datanasc)
        {
            $this->datanasc = $datanasc;
        }

        // Getter para a propriedade $email
        public function getEmail()
        {
            return $this->email;
        }

        // Setter para a propriedade $email
        public function setEmail($email)
        {
            $this->email = $email;
        }

        // Getter para a propriedade $tel
        public function getTel()
        {
            return $this->tel;
        }

        // Setter para a propriedade $tel
        public function setTel($tel)
        {
            $this->tel = $tel;
        }

        public function gravar(){
            $dados = [];
            $dados["login"] = $this->login;
            $dados["senha"] = $this->senha;
            $dados["cpf"] = $this->cpf;
            $dados["nome"] = $this->nome;
            $dados['datanasc'] = $this->datanasc;
            $dados["email"] = $this->email;
            $dados["tel"] = $this->tel;
            return $dados;
        }

    }

?>