<?php

class ArquivoTarefa
{
    //atributo
    private $caminho;

    public function __construct(string $caminho)
    {
        $this->caminho = $caminho;
    }

    public function salva(array $tarefas)
    {
        //é feito um array para conseguir pegar os atributos privates
        $dataTarefas = [];
        $cont = 1;
        foreach ($tarefas as $key => $tarefa) {
            $arr['id'] = $cont++;
            $arr['nome'] = $tarefa->getNome();
            $arr['descricao'] = $tarefa->getDescricao();
            $arr['dataLimite'] = $tarefa->getDataLimite();
            $arr['status'] = $tarefa->getStatus();
            $arr['imagem'] = $tarefa->getImagem();
            $arr['altura'] = $tarefa->getAltura();
            $arr['largura'] = $tarefa->getLargura();
            $dataTarefas[] = $arr;
        }        
        //json encode --> pega um array e trasnforma em string
        $jsonTarefas = json_encode($dataTarefas); 
        file_put_contents($this->caminho, $jsonTarefas);
    }

    public function le()
    {
        //desfaz o array e volta a ser tarefa
        $jsonTarefas = json_decode(file_get_contents($this->caminho));
        $dataTarefas = [];
        foreach ($jsonTarefas as $key => $obj) {
            $t = new Tarefa($obj->status, $obj->nome, $obj->descricao, $obj->dataLimite, $obj->imagem, $obj->altura, $obj->largura);
            $t->setId($obj->id); //por não ser passado no construtor
            $dataTarefas[] = $t;
        }
        
        return $dataTarefas;
    }
}