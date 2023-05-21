<?php
    class Conexao {
        private $host = "localhost";
        private $user = "root";
        private $pwr = "";
        private $database = "cardapion";
        private $dsn;
        private $conn;

        public function __construct()
        {
        
            $this->dsn = "mysql:host={$this->host};dbname={$this->database}";

            try {

                $this->conn = new PDO($this->dsn, $this->user, $this->pwr);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException  $e) {

                echo "Erro ao conectar com o banco de dados: " .  $e -> getMessage();

            }catch (Exception  $e) {

                echo "Erro:" .  $e -> getMessage();

            }
            
        }

        public function prepare($query)
        {
            return $this->conn->prepare($query);
        }
    
        public function __destruct()
        {
            $this->conn = null;
        }
        
    }


