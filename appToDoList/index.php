<?php
// index sera o ponto central

require "src/classes/Tarefa.php";
require "src/classes/ArquivoTarefa.php";

// esta linha redireciona qualquer requisição no index para o endereco
// header('Location: /resource/lista_tarefas.html');

//lendo a template html
// ler o conteudo de um arquivo para string:
$template = file_get_contents('resource/lista_tarefas.html');

//lendo o arquivo
$arquivoTarefa = new ArquivoTarefa('tarefas.json');
$listaTarefasJSON = $arquivoTarefa->le();

$modeloTarefa = file_get_contents('resource/tarefa.html');

$linhasTabela = '';

//iteirando as tarefas
foreach ($listaTarefasJSON as $tarefa) {
    $tr = ''; //uma linha
                      //o que to procurando, o quero colocar no lugar, onde procurar
    $tr = str_replace('#STATUS', $tarefa->legenda(), $modeloTarefa);
    $tr = str_replace('#ID',     $tarefa->getId(), $tr);
    $tr = str_replace('#NOME',  $tarefa->getNome(), $tr);
    $tr = str_replace('#DATALIMITE', $tarefa->getDataLimite(), $tr);
    $tr = str_replace('#MARCADO', $tarefa->getStatus() == 0 ? 'checked' : '', $tr);
    $linhasTabela .= $tr; //concatena
}

echo str_replace('#TAREFAS', $linhasTabela, $template);
// pesquise pela marcação #Tarefas, troque pelo que está na variável linhas tabelas e faz isso no template