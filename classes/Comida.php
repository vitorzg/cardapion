<?php

    class Comida {

        private $nome;
        private $descricao;
        private $id_foto;
        private $preco;
        private $categoria;

        public function __construct($nome,$descricao,$id_foto,$preco,$categoria)
        {
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->id_foto = $id_foto;
            $this->preco = $preco;
            $this->categoria = $categoria;
        }


        public function gravarComida(){
            
        }

    }

?>