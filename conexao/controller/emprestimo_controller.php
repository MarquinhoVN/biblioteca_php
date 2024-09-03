<?php
    require_once "../../conexao/model/emprestimo.model.php";
    require_once "../../conexao/model/livro.model.php";
    require_once "../../conexao/all.service.php";
    require_once "../../conexao/conexao.php";
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'inserir'){
        $emprestimo = new Emprestimo;
        $emprestimo->__set('id_aluno', $_POST['id_aluno']);
        $emprestimo->__set('id_livro', $_POST['id_livro']);
    
        $conexao = new Conexao;
        
        $emprestimoService = new EmprestimoService($conexao, $emprestimo);
    
        $emprestimoService->inserir(); 

        $conexao = new Conexao;
        $livro = new Livro;
        $livro-> __set('id',$_POST['id_livro']);
        $livro->__set('id_status', 2);
        $livroService = new LivroService($conexao,$livro);

        $livroService->emprestarLivro();

        header('Location: emprestimo.php');
        
    } else if ($acao=='listar'){
        $emprestimo = new Emprestimo();
        $conexao = new Conexao();
        $emprestimoService = new EmprestimoService($conexao, $emprestimo);
        
        $emprestimos = $emprestimoService->recuperar();

    } else if($acao == 'pesquisar'){
        $termo = isset($_POST['termo']) ? $_POST['termo'] : '';
        $conexao = new Conexao();
        $emprestimo = new Emprestimo();

        $emprestimoService = new EmprestimoService($conexao, $emprestimo);

        $emprestimos = $emprestimoService->pesquisar($termo);
        // Verifica se é uma requisição AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode($emprestimos);
            exit; // Garante que não haverá processamento adicional
        }
    } else if($acao == 'devolver'){
        $conexao = new Conexao();
        $emprestimo = new Emprestimo();
        $emprestimo->__set('id',$_POST['emprestimo_ide']);
        $emprestimoService = new EmprestimoService($conexao, $emprestimo);
        $emprestimoService->devolver();

        $conexao = new Conexao();
        $livro = new Livro();
        $livro->__set('id',$_POST['emprestimo_id']);
        $livro->__set('id_status', 1);
        $livroService = new LivroService($conexao, $livro);
        $livroService->devolver();

        header('Location: devolucao.php');
    }
?>

