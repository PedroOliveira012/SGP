<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Procedure;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\Console\Input\Input;

class TarefasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $filtro_painel = Project::all();
        $tarefa = Task::all();
        $search = request('search');
        if($search){
            $filtro_painel = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $filtro_painel = Project::all();
        }
        return view('tarefas.index_tarefas', ['lista' => $filtro_painel, 'tarefa' => $tarefa]);
    }

    public function mostra($id){
        $busca = Task::find($id);
        $busca->visualizado = 1;
        $busca->save();

        $horas = 0;
        $minutos = $busca->tempo_total;

        while($minutos >= 60){
            $minutos = $minutos - 60;
            $horas++;
        }

        if (empty($busca)){
            return view('tarefas.mostra_tarefas',['i' => $busca, 'total_horas' => $horas, 'total_minutos' => $minutos]);
        }

        return view('tarefas.mostra_tarefas',['i' => $busca, 'total_horas' => $horas, 'total_minutos' => $minutos/*, 'diffFimJornada' => $diffFimJornada, 'diffInicioJornada' => $diffInicioJornada, 'totalDiff' => $totalDiff, 'dias' => $dias'retorno' => $retorno*/]);
    }

    public function adiciona(){
        $tarefa = new Task;
        $tarefa->id_projeto = request('id_projeto');
        $tarefa->funcionario = request('funcionario');
        $tarefa->tarefa = request('tarefa');
        $tarefa->envio_tarefa = Carbon::now()->subHour(3);
        $tarefa->inicio_tarefa = request('inicio_tarefa');
        $tarefa->termino_tarefa = request('termino_tarefa');
        $tarefa->prazo = request('prazo');
        $tarefa->painel = request('painel');
        $tarefa->Notas = request('obs');
        if($tarefa->tarefa == 'Pendencia'){
            $tarefa->status = 'pendencia';
        }else{
            $tarefa->status = request('status');
        }
        $tarefa->save();

        return redirect()->action([TarefasController::class, 'lista'], ['id' => $tarefa->id_projeto]);
    }

    public function adicionaConjunto(){
        $busca = Procedure::where([
            ['processo', 'like', '%' . request('conjunto') . '%'],
            ['tipo', '=', request('chaparia')]
        ])->get();

        $id_projeto = request('id_projeto');
        $itensSelecionados = request('tarefas', []);

        foreach ($itensSelecionados as $tarefa_id) {
            // Verifica se o ID da tarefa está nos resultados da busca
            $tarefaEncontrada = $busca->contains('id_tarefa', $tarefa_id);

            // Cria a nova Task apenas se a tarefa não for encontrada na busca
            if (!$tarefaEncontrada) {
                $funcionarios = implode('/', request('funcionarios', []));

                $conjunto = new Task;
                $conjunto->id_projeto = $id_projeto;
                $conjunto->funcionario = $funcionarios;
                $conjunto->envio_tarefa = Carbon::now()->subHour(3);
                $conjunto->painel = request('painel');
                $conjunto->tarefa = $tarefa_id; // Ajuste para usar o ID da tarefa, não um array
                $conjunto->tarefa_conjunta = request('tarefaConjunta');
                $conjunto->prazo = request('prazo');
                $conjunto->status = 'aguardo';
                $conjunto->visualizado = 0;
                $conjunto->save();
            }
        }

        return redirect()->action([TarefasController::class, 'lista'], ['id' => $id_projeto]);
    }


    public function nova_tarefa($id){
        $projeto = Project::find($id);
        $func = User::where('cargo', 'like', '%Montador%')->get();
        $tarefa = Procedure::all();
        $opcoes = explode('; ', $projeto->paineis);

        $tipo = request('tipo');
        $area = request('area');
        $processo = request('processo');

        if ($tipo == '' && $area == '' && $processo == ''){
            $tipo = '--Selecione o tipo de painel--';
            $area = '--Selecione a área da produção--';
            $processo = '--Selecione um processo--';
        }

        if ($tipo and $area and $processo){
            $tarefa = Procedure::where([
            ['tipo', '=', $tipo],
            ['area', '=', $area],
            ['processo', '=', $processo]
            ])->get();
        }

        return view('tarefas.formulario_tarefas', ['func' => $func, 'tarefa' => $tarefa, 'projeto' => $projeto->id, 'tipo' => $tipo, 'area' => $area, 'processo' => $processo, 'opcoes' => $opcoes]);
    }

    public function novo_conjunto($id){
        $projeto = Project::find($id);
        $opcoes = explode('; ', $projeto->paineis);
        $func = User::where('cargo', 'like', '%Montador%')->get();
        $tarefa = Procedure::all();
        $opcoes = explode('; ', $projeto->paineis);

        $chaparia = request('chaparia');
        $conjunto = request('conjunto');

        if ($chaparia == '' && $conjunto == ''){
            $chaparia = '--Selecione o tipo de painel--';
            $conjunto = '--Selecione a área da produção--';
            $painel = '--Selecione um processo--';
        }

        if ($chaparia and $conjunto){
            $tarefa = Procedure::where([
            ['tipo', '=', $chaparia],
            ['processo', '=', $conjunto],
            ])->get();
        }

        return view('tarefas.conjunto_tarefas', ['func' => $func, 'tarefa' => $tarefa,'projeto' => $projeto->id, 'opcoes' => $opcoes, 'opcoes' => $opcoes]);
    }

    public function remove($id){
        $tarefa = Task::find($id);
        $tarefa->delete();
        return redirect()->action([TarefasController::class, 'lista'], ['id' => $tarefa->id_projeto]);
    }

    public function editar($id){
        $func = User::where('nivel_acesso', '=', 1)->get();
        $proc = Procedure::all();
        $tarefa = Task::find($id);

        return view('tarefas.editar_tarefas', ['func'=>$func, 'tarefa' => $tarefa, 'proc'=>$proc]);
    }

    public function atualizar($id){
        // $projeto = Project::find($id);
        // $func = User::where('nivel_acesso', '=', 1)->get();
        // $tarefa = Procedure::all();

        $tarefa = Task::find($id);
        $tarefa->funcionario = request('funcionario');
        $tarefa->tarefa = request('tarefa');
        $tarefa->inicio_tarefa = request('envio_tarefa');
        $tarefa->Notas = request('obs');
        $tarefa->save();

        return redirect()->action([TarefasController::class, 'mostra'], ['id' => $tarefa->id]);
    }

    public function lista($id){
        $projeto = Project::find($id);
        $filtro = Task::where('id_projeto', '=', $projeto->id)->get();

        $painel = request('escolher-painel');
        $status = request('escolher-status');

        if ($painel){
            $filtro = Task::where([
                ['id_projeto', '=', $projeto->id],
                ['painel', '=', $painel]
            ])->get();
        }else{
            $painel = '--Selecione um painel--';
        }

        if($status){
            $filtro = Task::where([
                ['id_projeto', '=', $projeto->id],
                ['status', '=', $status]
            ])->get();
        }else{
            $status = '--Status da tarefa--';
        }

        $opcoes = explode('; ', $projeto->paineis);

        return view('tarefas.lista_tarefas', compact('filtro', 'projeto', 'opcoes', 'painel', 'status'));
    }

    public function concluir($id){
        $tarefa = Task::find($id);
        $tarefa->status = 'concluida';
        $tarefa->save();

        return redirect()->action([TarefasController::class, 'mostra'], ['id' => $tarefa->id]);
        // return redirect()->action([TarefasController::class, 'mostra'], ['id' => $tarefa->id]);
    }

    public function retrabalho($id){
        $busca = Task::find($id);
        $busca->inicio_tarefa = null;
        $busca->termino_tarefa = null;
        $busca->status = 'retrabalho';
        $busca->Notas = request('refazer');

        $busca->save();

        return redirect()->action([TarefasController::class, 'mostra'], ['id' => $busca->id]);
    }
}
