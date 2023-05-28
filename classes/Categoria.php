
<?php

    class Categoria {


        public function gravarCategoria($nome_categoria,$user_criou){
            require_once("Conexao.php");

            $db = new Conexao();
    
            $query = $db->prepare("INSERT INTO categorias(user_criou_id,nome_categoria) VALUES (:1,:2)");
            $query->bindValue("1", $user_criou);
            $query->bindValue("2", $nome_categoria);
            $query->execute();

            $db->__destruct();

            return true;
        }

        public function lerCategoria($id_categoria){
            require_once("Conexao.php");

            $db = new Conexao();

            $query = $db->prepare("SELECT * FROM categorias WHERE id_categoria = :1");
            $query->bindValue("1",$id_categoria);
            $query->execute();
            $dados = $query->fetch(PDO::FETCH_ASSOC);

            $db->__destruct();

            return $dados;

        }

        public function atualizarCategoria($id_categoria,$nome_categoria,$user_criou){
            require_once("Conexao.php");

            $db = new Conexao();

            $query = $db->prepare("UPDATE categorias SET nome_categoria = :nome, user_criou_id = :user WHERE id_categoria = :id");
            $query->bindValue("nome", $nome_categoria);
            $query->bindValue("user", $user_criou);
            $query->bindValue("id", $id_categoria);
            $query->execute();

            $db->__destruct();

            return true;
        }

        public function deletarCategoria($id_categoria){
            require_once("Conexao.php");

            $db = new Conexao();

            $query = $db->prepare("DELETE FROM categorias WHERE id_categoria = :id");
            $query->bindValue("id", $id_categoria);
            $query->execute();

            $db->__destruct();

            return true;
        }
    }
?>