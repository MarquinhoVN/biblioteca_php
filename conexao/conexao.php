<?php
    class Conexao {
        private $local = 'localhost';
        private $dbnom = 'biblioteca';
        private $user = 'root';
        private $pass = '';

        public function conectar(){
            try {
                $conexao = new PDO(
                    "mysql:host=$this->local;dbname=$this->dbnom",
                    "$this->user","$this->pass");

                    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $conexao;
                    
                    echo "Sucesso!!";

            }catch(PDOException $e){
                echo '<p>'.$e->getMessage().'<p>';
            }
        }

    }
?>