<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
Use App\Models\Project;
use Carbon\Carbon;

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
        return view('testes.pendencias_teste', ['lista' => $lista]);
    }

    public function form_pendencia($id){
        $pendencia = Task::find($id);
        $projeto = Project::find($pendencia->id_projeto);
        $opcoes = explode('; ', $projeto->paineis);
        return view('testes.formulario_pendencia_testes', ['projeto' => $projeto, 'opcoes' => $opcoes, 'pendencia' => $pendencia]);
    }

    public function adiciona_pendencia(){
        $pendencia = new Task;
        $pendencia->id_projeto = request('id_projeto');
        $pendencia->painel = request('painel');
        $pendencia->funcionario = 'Sem funcionário';
        $pendencia->tarefa = 'pendencia';
        $pendencia->tarefa_conjunta = 0;
        $pendencia->envio_tarefa = Carbon::now()->subHour(3);
        $pendencia->prazo = request('prazo');
        $pendencia->Notas = request('desc');
        $pendencia->visualizado = 0;
        $pendencia->status = 'pendente';
        $pendencia->save();

        return redirect()->action([TarefasController::class, 'lista'], ['id' => $pendencia->id_projeto]);
    }

    public function remove_pendencia($id){
        $pendencia = Task::find($id);
        $pendencia->delete();

        return redirect()->action([TarefasController::class, 'lista'], ['id' => $pendencia->id_projeto]);
    }

    public function atualiza_pendencia($id){
        $pendencia = Task::find($id);
        $pendencia->painel = request('painel');
        $pendencia->prazo = request('prazo');
        $pendencia->Notas = request('desc');
        $pendencia->save();

        return redirect()->action([TarefasController::class, 'lista'], ['id' => $pendencia->id_projeto]);
    }

    public function info($id){
        $lista = Task::where('id_projeto', '=', $id)->get();
        return view('testes.info_teste', compact('lista'));
    }

    public function checklist(){
        return view('testes.checklist_teste');
    }

    public function comissionamento(){
        return view('testes.comissionamento_teste');
    }

    public function inspecao(){
        return view('testes.inspecao_teste');
    }
}
