<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TestesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendencia($id)
    {
        $lista = Task::where([
            ['id_projeto', '=', $id],
            ['tarefa', '=', 'pendencia']
            ])->get();


        // $filtro = Task::where([
        //     ['id_projeto', '=', $projeto->id],
        //     ['painel', '=', $painel]
        // ])->get();
        return view('testes.pendencias', ['lista' => $lista]);
    }

    public function info($id){
        $lista = Task::where('id_projeto', '=', $id)->get();
        return view('testes.info', compact('lista'));
    }

    public function checklist(){
        return view('testes.checklist');
    }

    public function comissionamento(){
        return view('testes.comissionamento');
    }

    public function inspecao(){
        return view('testes.inspecao');
    }
}
