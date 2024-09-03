<?php
$controller = isset($_GET['controller']) ? $_GET['controller'] : $controller;

if($controller == 'aluno'){
    require_once "../../conexao/controller/aluno_controller.php";   

} else if ($controller=='emprestimo'){
    require_once "../../conexao/controller/emprestimo_controller.php";

} else if($controller=='livro'){
    require_once "../../conexao/controller/livro_controller.php";
}
?>

