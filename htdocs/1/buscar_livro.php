<?php
	$acao = 'pesquisar';
	$controller = 'livro';
	require 'controller.php';
	if (!isset($livros)) {
		$livros = [];
	}
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Biblioteca</title>
		<link rel="shortcut icon" type="imagex/png" href="img/logo1.png">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="css/style.css">

        <script>
            $(document).ready(function() {
                $('#pesquisaLivro').on('keyup', function() {
                    let termo = $(this).val();

                    if (termo !== '') {
                        $.post('controller.php?acao=pesquisar&&controller=livro', { termo: termo }, function(data) {
                        let livros = JSON.parse(data);
                        let resultado = '';

                        livros.forEach(function(livro) {
                            resultado += '<li class="list-group-item tarefa-item">' + livro.nome + ' ('+livro.status+')'+ '</li>';
                        });
                        $('#listaLivros').html(resultado);
                        // Adiciona evento de clique para preencher o campo de pesquisa com o valor clicado
                        $('.tarefa-item').on('click', function() {
                            let livroSelecionado = $(this).text();
                            $('#pesquisaLivro').val(livroSelecionado);
                            $('#listaLivros').html(''); // Limpa a lista após a seleção
							
                        });
                    }); 
                    } else {
                        $('#listaLivros').html('');
                    }
                });
            });
        </script>
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
							<a class="nav-link" href="emprestimo.php">Empréstimos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="#">Pesquisar Livros</a>
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
								<h4>Buscar Livros</h4>
								<hr />
								<input type="text" id="pesquisaLivro" class="form-control" placeholder="Digite o livro">
                                <ul id="listaLivros" class="list-group mt-3"></ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

