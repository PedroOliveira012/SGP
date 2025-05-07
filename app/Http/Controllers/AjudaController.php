<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Procedure;

class AjudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function desc($id)
    {
        $task = Task::where('id', $id)->first();
        $fit = Procedure::where('titulo', $task->tarefa)->first();
        $passos = explode(';', $fit->descricao);

        return view('ajuda.mostra', ['fit' => $fit, 'passos' => $passos]);
    }

    public function mostra(){
        $tarefa = Procedure::all();
        return view('ajuda.combinacao_ajuda', compact('tarefa', $tarefa));
    }
}
