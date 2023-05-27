<?php

    require_once("Conexao.php");

    class Foto {

        public function gravarFoto($nome_foto,$novo_nome,$tmp_name,$pasta){

                $extensao = strtolower(pathinfo($nome_foto,PATHINFO_EXTENSION));
                $path = $pasta.$novo_nome.".".$extensao;
    
                if ($extensao == 'jpeg' || $extensao == 'jpg' || $extensao == 'png' || $extensao == 'gif') {

                    if (move_uploaded_file($tmp_name,"../../.." . $path)) {
        
                        $db = new Conexao();
                        $query = $db->prepare("INSERT INTO fotos(users_upload_id,
                                                                 nome_foto,
                                                                 path) VALUES (:1,:2,:3)");
                        $query->bindValue(":1",$_SESSION['login']);
                        $query->bindValue(":2",$nome_foto);
                        $query->bindValue(":3",$path);
                        $query->execute();

                        $id_foto = $db->lastInsertId();
        
                        $db->__destruct();
                        
                        return $id_foto;
    
                    } else {
                        $_SESSION['error'] = "Falha no Upload.";
                        return false;
                    }
                } else{
                    $_SESSION['error'] = "Tipo de Arquivo não aceito.";
                    return false;
                }
                
        }
    }

?>