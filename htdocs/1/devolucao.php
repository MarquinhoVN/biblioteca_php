<?php
	$acao = 'pesquisar';
	$controller = 'emprestimo';
	require 'controller.php';
	if (!isset($emprestimos)) {
		$emprestimos = [];
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
                $('#pesquisaEmprestimo').on('keyup', function() {
                    let termo = $(this).val();

                    if (termo !== '') {
                        $.post('controller.php?acao=pesquisar&&controller=emprestimo', { termo: termo }, function(data) {
                        let emprestimos = JSON.parse(data);
						
						
                        let resultado = '';
						
                        emprestimos.forEach(function(emprestimo) {
                            resultado += '<li class="list-group-item tarefa-item" data-ide="' + emprestimo.ide + '" data-id="' + emprestimo.id + '">' + emprestimo.nomel + ' ('+emprestimo.nomea+')'+ '</li>';
                        });
						
                        $('#listaEmprestimos').html(resultado);
                        // Adiciona evento de clique para preencher o campo de pesquisa com o valor clicado
                        $('.tarefa-item').on('click', function() {
                            let emprestimoSelecionado = $(this).text();
							let emprestimoIde = $(this).data('ide');
							let emprestimoId = $(this).data('id');
                            $('#pesquisaEmprestimo').val(emprestimoSelecionado);
							$('#emprestimoIde').val(emprestimoIde);
							$('#emprestimoId').val(emprestimoId);

                            $('#listaEmprestimos').html(''); // Limpa a lista após a seleção
							
                        });
                    }); 
                    } else {
                        $('#listaEmprestimo').html('');
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
							<a class="nav-link" href="buscar_livro.php">Pesquisar Livros</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="listarEmprestimo.php">Livros emprestados</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="#">Formulário Devolução</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>



		<div class="container app ">
			<div class="row justify-content-center">

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Devolver Livros</h4>
								<hr />
								
								<form method="post" action="controller.php?acao=devolver&&controller=emprestimo">
									<div class="form-group">
										<input type="text" id="pesquisaEmprestimo" class="form-control" placeholder="Digite o livro">
										<ul id="listaEmprestimos" class="list-group mt-3"></ul>
										<input type="hidden" name="emprestimo_ide" id="emprestimoIde" class="form-control">
										<input type="hidden" name="emprestimo_id" id="emprestimoId" class="form-control">
										
										<button class="btn btn-success">Devolver</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

