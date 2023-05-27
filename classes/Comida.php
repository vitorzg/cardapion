<?php
    require_once("Conexao.php");
    class Comida {
                
        public function gravarComida($nome, $categoria, $descricao, $preco, $foto_id, $user_criou) {
            $db = new Conexao();
        
            $query = $db->prepare("
                INSERT INTO comidas (
                    categoria_comida_id,
                    user_criou_id,
                    categorias_user_criou_id,
                    fotos_users_upload_id,
                    comida_foto_id,
                    nome_comida,
                    descricao,
                    preco
                )
                SELECT
                    :categoria,
                    :user_criou,
                    (SELECT user_criou_id FROM categorias WHERE id_categoria = :categoria),
                    (SELECT users_upload_id FROM fotos WHERE id_fotos = :foto_id),
                    :foto_id,
                    :nome,
                    :descricao,
                    :preco
            ");
        
            $query->bindValue(":categoria", $categoria);
            $query->bindValue(":user_criou", $user_criou);
            $query->bindValue(":foto_id", $foto_id);
            $query->bindValue(":nome", $nome);
            $query->bindValue(":descricao", $descricao);
            $query->bindValue(":preco", $preco);
            $query->execute();
        
            $db->__destruct();
        
            return true;
        }
        
        
        public function deletarComida($id){
            $db = new Conexao();
        
            $query = $db->prepare("
                SELECT c.comida_foto_id, f.path
                FROM comidas c
                JOIN fotos f ON c.comida_foto_id = f.id_fotos
                WHERE c.id_comida = :id
            ");
            $query->bindValue(":id", $id);
            $query->execute();
        
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $id_foto = $result['comida_foto_id'];
            $caminho = "C:/xampp/htdocs/cardapion".$result['path'];
        
            if ($caminho === false) {
                $_SESSION['error'] = "Erro ao obter o caminho da foto.";
                return false;
            }
        
            if (unlink($caminho)) {
                $queryDeleteFoto = $db->prepare("DELETE FROM fotos WHERE id_fotos = :id_foto");
                $queryDeleteFoto->bindValue(":id_foto", $id_foto);
                $queryDeleteFoto->execute();
                $db->__destruct();
        
                return true;
            } else {
                $error = error_get_last();
                $_SESSION['error'] = $error['message'];
                $db->__destruct();
                return false;
            }
        }
        
        public function alterarComida($id, $nome,$categoria, $descricao, $preco, $foto_id){
            $db = new Conexao();
            $query = $db->prepare("UPDATE comidas SET nome_comida = :1,
                                                      descricao = :2,
                                                      preco = :3,
                                                      categoria_comida_id = :categoria,
                                                      comida_foto_id = :foto_id,
                                                      categorias_user_criou_id = (SELECT user_criou_id FROM categorias WHERE id_categoria = :categoria),
                                                      fotos_users_upload_id = (SELECT users_upload_id FROM fotos WHERE id_fotos = :foto_id)
                                                  WHERE id_comida = :id");

            $query->bindValue(":1",$nome);
            $query->bindValue(":2",$descricao);
            $query->bindValue(":3",$preco);
            $query->bindValue(":categoria",$categoria);
            $query->bindValue(":foto_id",$foto_id);
            $query->bindValue(":id",$id);
            $query->execute();

            $db->__destruct();

            return true;
        }

    }

?>