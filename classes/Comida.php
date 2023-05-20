<?php

    class Comida {

        private $nome;
        private $descricao;
        private $foto;
        private $preco;
        private $categoria;

        public function __construct($nome,$descricao,$foto,$preco,$categoria)
        {
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->foto = $foto;
            $this->preco = $preco;
            $this->categoria = $categoria;
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

        // Getter para a propriedade $descricao
        public function getDescricao()
        {
            return $this->descricao;
        }

        // Setter para a propriedade $descricao
        public function setDescricao($descricao)
        {
            $this->descricao = $descricao;
        }

        // Getter para a propriedade $foto
        public function getFoto()
        {
            return $this->foto;
        }

        // Setter para a propriedade $foto
        public function setFoto($foto)
        {
            $this->foto = $foto;
        }

        // Getter para a propriedade $preco
        public function getPreco()
        {
            return $this->preco;
        }

        // Setter para a propriedade $preco
        public function setPreco($preco)
        {
            $this->preco = $preco;
        }

        // Getter para a propriedade $categoria
        public function getCategoria()
        {
            return $this->categoria;
        }

        // Setter para a propriedade $categoria
        public function setCategoria($categoria)
        {
            $this->categoria = $categoria;
        }

        public function gravarComida(){
            $dadosComida = [];
            $dadosComida['nome'] = $this->nome;
            $dadosComida['descricao'] = $this->descricao;
            //$dadosComida['foto'] = $this->foto;
            $dadosComida['preco'] = $this->preco;
            $dadosComida['categoria'] = $this->categoria;
            return $dadosComida;
        }

    }

?>