<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AulaController extends Controller
{
    //

    //Lista de Todas as Aulas, com Informações de Qtde de Vagas Disponiveis, Datas, e etc.
    public function listarAulas()
    {
       
        return view('site.aula_listagem');

    }
}
