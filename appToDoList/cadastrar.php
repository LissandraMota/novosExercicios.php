<?php

require "src/classes/Tarefa.php";
require "src/classes/ArquivoTarefa.php";

//um serviço
//isset ->conferindo se o post não vem vazio
if (isset($_POST)) {
    $tarefa = new Tarefa(1, $_POST['nome'], $_POST['descricao'], $_POST['dataLimite'], $_POST['imagem'], $_POST['altura'], $_POST['largura']);
    $arquivoTarefa = new ArquivoTarefa('tarefas.json');
    
    // recupera as tarefas
    $arrTarefas = $arquivoTarefa->le();
    $arrTarefas[] = $tarefa;
    $arquivoTarefa->salva($arrTarefas);

    header('Location: /');
}