<?php
    require_once "../../conexao/model/livro.model.php";
    require_once "../../conexao/all.service.php";
    require_once "../../conexao/conexao.php";
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'inserir'){
        $livro = new Livro;
        $livro->__set('nome', $_POST['nome']);
        $livro->__set('autor', $_POST['autor']);
        $livro->__set('ano', $_POST['ano']);
    
        $conexao = new Conexao;
        
        $livroService = new LivroService($conexao, $livro);
    
        $livroService->inserir(); 
    } else if ($acao=='listar'){
        $livro = new Livro();
        $conexao = new Conexao();
        $livroService = new LivroService($conexao, $livro);
        
        $livros = $livroService->recuperar();

    } else if ($acao=='listarDisponivel'){
        $livro = new Livro();
        $conexao = new Conexao();
        $livroService = new LivroService($conexao, $livro);
        
        $livros = $livroService->recuperarDisponivel();

    }else if($acao =='editar'){
        $livro = new Livro;
        $livro->__set('id',$_GET['id']);
        $livro->__set('nome', $_POST['nome']);
        $livro->__set('autor', $_POST['autor']);
        $livro->__set('ano', $_POST['ano']);
    

        $conexao = new Conexao;
        $livroService = new LivroService($conexao, $livro);
        $livroService->atualizar();

    }else if($acao == 'remover') {
        $livro = new Livro;
        $livro->__set('id', $_GET['id']);
    
        $conexao = new Conexao;
        $livroService = new LivroService($conexao, $livro);
        $livroService->remover();
    
        header('Location: cadastro_livro.php');
         
    } else if($acao == 'pesquisar'){
        $termo = isset($_POST['termo']) ? $_POST['termo'] : '';
        $conexao = new Conexao();
        $livro = new Livro();

        $livroService = new LivroService($conexao, $livro);

        $livros = $livroService->pesquisar($termo);
        // Verifica se é uma requisição AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode($livros);
            exit; // Garante que não haverá processamento adicional
        }
    }


?>