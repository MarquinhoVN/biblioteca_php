<?php
    class Livro{
        private $id;
        private $nome;
        private $ano;
        private $autor;
        private $id_status;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            return $this->$atributo = $valor;
        }
    }
    
?>