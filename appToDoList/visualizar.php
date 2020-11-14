<?php

require "src/classes/Tarefa.php";
require "src/classes/ArquivoTarefa.php";

if (isset($_GET['id'])) {
    //recuperou as tarefas
    $arquivoTarefa = new ArquivoTarefa('tarefas.json');
    
    //leu as tarefas
    $arrTarefas = $arquivoTarefa->le();
    
    $template = file_get_contents('resource/visualizar.html');      
    $encontrou = false;
    foreach ($arrTarefas as $tarefa) {
        if ($tarefa->getId() == $_GET['id']) {                  
            $encontrou = true;
            $template = str_replace('#STATUS', $tarefa->legenda(), $template);
            $template = str_replace('#ID',     $tarefa->getId(), $template);
            $template = str_replace('#NOME',  $tarefa->getNome(), $template);
            $template = str_replace('#DESCRICAO',  $tarefa->getDescricao(), $template);
            $template = str_replace('#DATALIMITE', $tarefa->getDataLimite(), $template);
            $template = str_replace('#IMAGEM', $tarefa->getImagem(), $template);
            $template = str_replace('#LARGURA', $tarefa->getLargura(), $template);
            $template = str_replace('#ALTURA', $tarefa->getAltura(), $template);
        }
    }   
    if ($encontrou) {
        echo $template;
    } else {
        echo 'Tarefa não existe!';
    }
    
} else {
    echo 'ID não informado!';
}