<?php
    class Aluno{
        private $id;
        private $nome;
        private $matricula;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            return $this->$atributo = $valor;
        }
    }
    
?>