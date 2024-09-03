<?php
    require_once "../../conexao/model/aluno.model.php";
    require_once "../../conexao/all.service.php";
    require_once "../../conexao/conexao.php";
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'inserir'){
        $aluno = new Aluno;
        $aluno->__set('nome', $_POST['nome']);
        $aluno->__set('matricula', $_POST['matricula']);
    
        $conexao = new Conexao;
        
        $alunoService = new AlunoService($conexao, $aluno);
    
        $alunoService->inserir(); 
    } else if ($acao=='listar'){
        $aluno = new Aluno();
        $conexao = new Conexao();
        $alunoService = new AlunoService($conexao, $aluno);
        
        $alunos = $alunoService->recuperar();

    } else if($acao =='editar'){
        $aluno = new Aluno;
        $aluno->__set('id',$_GET['id']);
        $aluno->__set('nome',$_POST['nome']);
        $aluno->__set('matricula', $_POST['matricula']);

        $conexao = new Conexao;
        $alunoService = new AlunoService($conexao, $aluno);
        $alunoService->atualizar();
    }

?>