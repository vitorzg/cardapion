<?php

    class Comida {

        public function gravarComida($nome,$categoria,$descricao,$preco,$foto_id,$user_criou){
            require_once("Conexao.php");

            $db = new Conexao();

            $queryCategoria = $db->prepare("SELECT user_criou_id FROM categorias WHERE id_categoria = :1");
            $queryCategoria->bindValue(":1",$categoria);
            $queryCategoria->execute();
            $user_criou_categoria_id = $queryCategoria->fetch(PDO::FETCH_ASSOC);

            $queryFoto = $db->prepare("SELECT users_upload_id FROM fotos WHERE id_fotos = :1");
            $queryFoto->bindValue(":1",$foto_id);
            $queryFoto->execute();
            $user_upload_id = $queryFoto->fetch(PDO::FETCH_ASSOC);

            $query = $db->prepare("INSERT INTO comidas(categoria_comida_id,
                                                       user_criou_id,
                                                       categorias_user_criou_id,
                                                       fotos_users_upload_id,
                                                       comida_foto_id,
                                                       nome_comida,
                                                       descricao,
                                                       preco) VALUES(:1,
                                                                     :2,
                                                                     :3,
                                                                     :4,
                                                                     :5,
                                                                     :6,
                                                                     :7,
                                                                     :8)");

            $query->bindValue(":1", $categoria);
            $query->bindValue(":2", $user_criou);
            $query->bindValue(":3", $user_criou_categoria_id['user_criou_id']);
            $query->bindValue(":4", $user_upload_id['users_upload_id']);
            $query->bindValue(":5", $foto_id);
            $query->bindValue(":6", $nome);
            $query->bindValue(":7", $descricao);
            $query->bindValue(":8", $preco);
            $query->execute();

            $db->__destruct();

            return true;
        }

        public function deletarComida($id){

        }

    }

?>