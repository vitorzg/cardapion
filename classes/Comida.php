<?php
    require_once("Conexao.php");
    class Comida {
        
        /**
         * gravarComida
         *
         * @param  mixed $nome
         * @param  mixed $categoria
         * @param  mixed $descricao
         * @param  mixed $preco
         * @param  mixed $foto_id
         * @param  mixed $user_criou
         * @return void
         */
        public function gravarComida($nome,$categoria,$descricao,$preco,$foto_id,$user_criou){
            
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
        
        
        
        
        
        /**
         * deletarComida
         *
         * @param  mixed $id
         * @return bool
         */
        public function deletarComida($id){

            $db = new Conexao();
            $queryFoto = $db->prepare("SELECT comida_foto_id FROM comidas WHERE id_comida = :1");
            $queryFoto->bindValue(":1",$id);
            $queryFoto->execute();
            $id_foto = $queryFoto->fetch(PDO::FETCH_ASSOC);

            $queryCaminho = $db->prepare("SELECT path FROM fotos WHERE id_fotos = :2");
            $queryCaminho->bindValue(":2",$id_foto['comida_foto_id']);
            $queryCaminho->execute();
            $caminho = $queryCaminho->fetchColumn();

            $query = $db->prepare("DELETE FROM fotos WHERE id_fotos = :3");
            $query->bindValue(":3",$id_foto['comida_foto_id']);
            $query->execute();
            
            unlink(realpath($caminho));
            
            $db->__destruct();

            return true;
        }


    }

?>