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
        $task = Task::where('id', '=', $id)->get();
        $fit = Procedure::where('titulo', '=', $task[0]->tarefa)->get();

        return view('ajuda.mostra', compact('fit', $fit));
    }

    public function mostra(){
        $tarefa = Procedure::all();
        return view('ajuda.combinacao_ajuda', compact('tarefa', $tarefa));
    }
}
