<?php

require "src/classes/Tarefa.php";
require "src/classes/ArquivoTarefa.php";


if (isset($_POST)) {
    $json = '';
    $arquivoTarefa = new ArquivoTarefa('tarefas.json');
    
    // recupera as tarefas
    $arrTarefas = $arquivoTarefa->le();
    
    foreach ($arrTarefas as &$tarefa) {
        if ($tarefa->getId() == $_POST['id']) {
            //valor default do checkbox é on
            //a primeira validação é ver se o post existe
            //empty - vazio, isset - existe
            if (isset($_POST['status']) && $_POST['status'] == 'on') {
                $tarefa->setStatus(0); //tarefa encerrada
            } else {
                $tarefa->setStatus(1); //tarefa em andamento
            }      
            $json = json_encode([
                'id' => $tarefa->getId(),
                'legenda' => $tarefa->legenda()
            ]);    
        }
    }

    $arquivoTarefa->salva($arrTarefas);

    //header('Location: /');
    echo $json; //echo da tarefa alterada que vai ser enviado para o front end
    //json com os valores da tarefa atualizada, que vai ser enviado como resposta da requisição fetch
}