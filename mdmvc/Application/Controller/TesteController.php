<?php

//nome do pacote
namespace App\Controller;
//controller --> controla as requisições
//extends --> herdando do Core
class TesteController extends \Core\Classes\Controller
{
    public function index()
    {
        //$nomeTeste = "Lissandra";
        $nomes = ['joão', 'Lis', 'ju'];
        \Core\Classes\View::show('Teste/lista.html', [
            //'nome'=>$nomeTeste,
            'nomes'=> $nomes
        ]);
    }

    public function lis()
    {
        echo "lis";
        //http://localhost/teste/lis -->nome do controller / nome do método
    }
}
