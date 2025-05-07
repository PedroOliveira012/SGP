<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DiretoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$lista = Project::where('analista', '=', Auth::user()->name)->get();
        // ->orWhere(Auth::user()->cargo, '=', 'Coordenador de Engenharia')->get();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('diretoria.index_diretoria', ['lista' => $lista, 'search' => $search]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista($id)
    {
        $projeto = Project::find($id);

        $para_fazer = Task::where([
            ['id_projeto', '=', $projeto->id],
            ['inicio_tarefa', '=', NULL]
        ])->get();

        $fazendo = Task::where([
            ['id_projeto', '=', $projeto->id],
            ['inicio_tarefa', '<>', NULL],
            ['termino_tarefa', '=', NULL]
        ])->get();

        $feito = Task::where([
            ['id_projeto', '=', $projeto->id],
            ['termino_tarefa', '<>', NULL]
        ])->get();

        $func = User::where('cargo', 'like', '%Montador%')->get();
        $func_escolhido = request('escolher-func');

        if ($func_escolhido) {
            $busca = Task::where([
                ['id_projeto', '=', $projeto->id],
                ['funcionario', '=', $func]
            ])->get();

            $para_fazer = Task::where([
                ['id_projeto', '=', $projeto->id],
                ['inicio_tarefa', '=', NULL],
                ['funcionario', '=', $func_escolhido]
            ])->get();

            $fazendo = Task::where([
                ['id_projeto', '=', $projeto->id],
                ['inicio_tarefa', '<>', NULL],
                ['termino_tarefa', '=', NULL],
                ['funcionario', '=', $func_escolhido]
            ])->get();

            $feito = Task::where([
                ['id_projeto', '=', $projeto->id],
                ['termino_tarefa', '<>', NULL],
                ['funcionario', '=', $func_escolhido]
            ])->get();

        }else{
            $func_escolhido = '--Selecione um funcionario--';
            $busca = Task::where('id_projeto', '=', $projeto->id)->get();
            //$busca = Task::where('funcionario', '=', $func)->get();
        }

        return view('diretoria.lista_diretoria', compact('para_fazer', 'fazendo', 'feito', 'func',  'busca', 'func_escolhido', 'projeto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
