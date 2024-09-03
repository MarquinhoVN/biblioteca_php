<?php

    class AlunoService {
        private $con;
        private $aln;

        public function __construct(Conexao $con, Aluno $aln){
            $this->con = $con->conectar();
            $this->aln = $aln;
        }

        public function inserir() {  
            
            if ($this->con == null) {
                throw new Exception("Falha na conexão com o banco de dados. Conexão retornou null.");
            }

            $query = 'INSERT INTO tb_aluno (nome,matricula) VALUES (:nome,:matricula)';

            $stmt = $this->con->prepare($query);

            $stmt->bindValue(':nome', $this->aln->__get('nome'));
            $stmt->bindValue(':matricula', $this->aln->__get('matricula'));
            $stmt->execute();

            header('Location:index.php');            
        }       

        public function recuperar(){
            $query = 'SELECT id, nome, matricula FROM tb_aluno';
            
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        }

        public function atualizar(){
            $query = 'UPDATE tb_aluno SET nome = :nome, matricula = :matricula WHERE id = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':nome', $this->aln->__get('nome'));
            $stmt->bindValue(':matricula', $this->aln->__get('matricula'));
            $stmt->bindValue(':id', $this->aln->__get('id'));
            $stmt->execute();
            
            header('Location:index.php');
        }


    }

    class LivroService {
        private $con;
        private $lvr;

        public function __construct(Conexao $con, Livro $lvr){
            $this->con = $con->conectar();
            $this->lvr = $lvr;
        }

        public function inserir() {  
            
            if ($this->con == null) {
                throw new Exception("Falha na conexão com o banco de dados. Conexão retornou null.");
            }

            $query = 'INSERT INTO tb_livro (nome,ano,autor) VALUES (:nome,:ano,:autor)';

            $stmt = $this->con->prepare($query);

            $stmt->bindValue(':nome', $this->lvr->__get('nome'));
            $stmt->bindValue(':ano', $this->lvr->__get('ano'));
            $stmt->bindValue(':autor', $this->lvr->__get('autor'));
            $stmt->execute();

            header('Location:cadastro_livro.php');            
        }       

        public function recuperar(){
            $query = 'SELECT l.id, l.nome, l.ano, l.autor, s.status
            FROM tb_livro l, tb_status s 
            WHERE l.id_status = s.id';
            
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        }
        public function recuperarDisponivel(){
            $query = 'SELECT l.id, l.nome, l.ano, l.autor, s.status
            FROM tb_livro l, tb_status s 
            WHERE l.id_status = s.id and l.id_status= 1';
            
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        }

        public function atualizar(){
            $query = 'UPDATE tb_livro SET nome = :nome, ano = :ano, autor= :autor WHERE id = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':nome', $this->lvr->__get('nome'));
            $stmt->bindValue(':ano', $this->lvr->__get('ano'));
            $stmt->bindValue(':autor', $this->lvr->__get('autor'));
            $stmt->bindValue(':id', $this->lvr->__get('id'));
            $stmt->execute();
            
            header('Location:cadastro_livro.php');
        }

        public function remover(){
            $query = "DELETE from tb_livro WHERE id = :id";
            $stmt = $this->con->prepare($query);
            
            $stmt->bindValue(':id', $this->lvr->__get('id'));
            $stmt->execute();

        }

        public function emprestarLivro(){
            $query = "UPDATE tb_livro SET id_status = :id_status WHERE id = :id";
            $stmt = $this->con->prepare($query);

            $stmt->bindValue(':id_status', $this->lvr->__get('id_status'));
            $stmt->bindValue(':id', $this->lvr->__get('id'));
            $stmt->execute();
        }

        public function pesquisar($termo){
            $query = 'SELECT l.id, l.nome, s.status FROM tb_livro l, tb_status s WHERE l.id_status = s.id AND nome LIKE :termo';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':termo',"%$termo%");
            $stmt->execute();

            return $stmt->fetchALL(PDO::FETCH_OBJ);
        }

        public function devolver(){
            $query = "UPDATE tb_livro SET id_status = :id_status WHERE id = :id";
            $stmt = $this->con->prepare($query);

            $stmt->bindValue(':id_status', $this->lvr->__get('id_status'));
            $stmt->bindValue(':id', $this->lvr->__get('id'));
            $stmt->execute();
        }

    }
    
    class EmprestimoService {
        private $con;
        private $emp;

        public function __construct(Conexao $con, Emprestimo $emp){
            $this->con = $con->conectar();
            $this->emp = $emp;
        }

        public function inserir() {  
            
            if ($this->con == null) {
                throw new Exception("Falha na conexão com o banco de dados. Conexão retornou null.");
            }

            $query = 'INSERT INTO tb_emprestimo (id_aluno,id_livro) VALUES (:id_aluno,:id_livro)';

            $stmt = $this->con->prepare($query);

            $stmt->bindValue(':id_aluno', $this->emp->__get('id_aluno'));
            $stmt->bindValue(':id_livro', $this->emp->__get('id_livro'));
            $stmt->execute();   
        }       

        public function recuperar(){
            $query = 'SELECT e.id, l.nome as nomel, a.nome as nomea 
            FROM tb_emprestimo e, tb_aluno a, tb_livro l 
            WHERE l.id = e.id_livro AND a.id = e.id_aluno
            ORDER BY nomel;';
            
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        }

        public function pesquisar($termo){
            $query = 'SELECT l.id, e.id as ide, l.nome as nomel, a.nome as nomea FROM tb_emprestimo e, tb_livro l, tb_aluno a WHERE e.id_aluno = a.id AND e.id_livro = l.id AND l.nome LIKE :termo';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':termo',"%$termo%");
            $stmt->execute();

            return $stmt->fetchALL(PDO::FETCH_OBJ);
        }

        public function devolver(){
            $query = "DELETE from tb_emprestimo WHERE id = :id";
            $stmt = $this->con->prepare($query);
            
            $stmt->bindValue(':id', $this->emp->__get('id'));
            $stmt->execute();


        }

    }
?>