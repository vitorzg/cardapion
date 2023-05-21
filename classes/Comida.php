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