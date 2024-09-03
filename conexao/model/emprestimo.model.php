<?php
    class Emprestimo{
        private $id;
        private $id_aluno;
        private $id_livro;
        private $data;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            return $this->$atributo = $valor;
        }
    }
    
?>