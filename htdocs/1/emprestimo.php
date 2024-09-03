<?php
	$acao = 'listarDisponivel';
	$controller = 'livro';
	require 'controller.php';
	if (!isset($livros)) {
		$livros = [];
	}

    $acao = 'listar';
	$controller = 'aluno';
	require 'controller.php';
	if (!isset($alunos)) {
		$alunos = [];
	}
?>


<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Biblioteca</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<link rel="shortcut icon" type="imagex/png" href="img/logo1.png">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<nav class="navbar navbar-light" style="background-color: #6ea0ff;">
			<a class="navbar-brand d-flex align-items-center" href="#">
				<img src="img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
				<span class="ms-2">Biblioteca</span>
			</a>

			<div class="container d-flex">
				<div class="flex-grow-1 d-flex justify-content-center">
					<ul class="w-100 nav nav-pills">
						<li class="nav-item">
							<a class="nav-link" href="index.php">Cadastro de Alunos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="cadastro_livro.php">Cadastro de Livros</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="#">Empréstimos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="buscar_livro.php">Pesquisar Livros</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="listarEmprestimo.php">Livros emprestados</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="devolucao.php">Formulário Devolução</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container app">
			<div class="row justify-content-center">
                <div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Emprestimo</h4>
								<hr>

								<form method="post" action="controller.php?acao=inserir&&controller=emprestimo">
									<div class="form-group">
										<label>Livro:</label>
                                        <select name="id_livro" class="form-control">
                                            <option value="">Selecione um livro</option>
                                            <?php foreach ($livros as $livro) { ?>
                                                <option value="<?= $livro->id; ?>"><?= $livro->nome; ?></option>
                                            <?php } ?>
                                        </select>
                                        <br>

                                        <label>Aluno:</label>
                                        <select name="id_aluno" class="form-control">
                                            <option value="">Selecione um aluno</option>
                                            <?php foreach ($alunos as $aluno) { ?>
                                                <option value="<?= $aluno->id; ?>"><?= $aluno->nome; ?></option>
                                            <?php } ?>
                                        </select>
									</div>

									<button class="btn btn-success">Cadastrar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>
		</div>
	</body>
</html>