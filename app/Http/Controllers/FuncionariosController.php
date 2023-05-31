<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $lista = Project::all();
        return view('funcionarios.index_funcionarios')->with('lista', $lista);
    }

    public function lista(Request $request, $id){
        $projeto = Project::find($id);
        $lista = Task::where([
            ['id_projeto', '=', $projeto->id],
            ['funcionario', 'like', '%'.Auth::user()->name.'%']
        ])->get();

        return view('funcionarios.lista_funcionarios', compact('lista', 'projeto'));
    }

    public function inicio($id){
        $tarefa = Task::find($id);
        $tarefa->inicio_tarefa = Carbon::now()->subHour(3);
        if ($tarefa->tarefa_conjunta == 0){
            $tarefa->funcionario = Auth::user()->name;
        }
        $tarefa->status = 'andamento';
        $tarefa->save();

        return redirect()->back();
    }

    public function termino($id){
        $tarefa = Task::find($id);
        $tarefa->termino_tarefa = Carbon::now()->subHour(3);
        $tarefa->status = 'concluido';
        $tarefa->visualizado = 0;

        $projeto = Project::find($tarefa->id_projeto);

        $inicio = Carbon::parse($tarefa->inicio_tarefa);
        $termino = Carbon::parse($tarefa->termino_tarefa);

        $inicio_jornada = Carbon::now();
        $fim_jornada = Carbon::now();

        $inicio_jornada->month = $inicio->month;
        $inicio_jornada->day = $inicio->day;
        $inicio_jornada->hour = 7;
        $inicio_jornada->minute = 0;

        $fim_jornada->month = $termino->month;
        $fim_jornada->day = $termino->day;
        $fim_jornada->hour = 17;
        $fim_jornada->minute = 3;

        $dias = $termino->diffInWeekdays($inicio);
        $minutos = 0;
        $pausa = $tarefa->total_pausa;
        $intervalo = 0;


        //para tarefas terminadas no mesmo dia
        if (($dias - 1) == 0){

            //começa antes do almoço
            //termina depois do intervalo
            if($inicio->hour < 12 && $termino->hour > 15){
                $intervalo = 90 + $pausa;

            //inicio antes do intervalo
            //termino depois do intervalo
            }elseif($inicio->hour <= 15 && $inicio->hour >= 12 && $termino->hour >= 15){
                $intervalo = 15 + $pausa;

            //inicio depois do almoço
            //termino antes do intervalo
            }elseif($inicio->hour > 12 && $termino->hour < 16){
                $intervalo = 0 + $pausa;

            //inicio antes do almoço
            //termino depois do almoço e antes do intervalo
            }elseif($inicio->hour <= 11 && $inicio->minute <= 25 && $termino->hour >= 12 && $termino->minute <= 40){
                $intervalo = 75 + $pausa;

            //inicia antes do almoço
            //termina antes do almoço
            }elseif($inicio->hour >= 7 && $termino->hour < 12){
                 $intervalo = 0 + $pausa;

            }

            //cálculo de horas
            $minutos = $termino->diffInMinutes($inicio) - $intervalo;
            $tarefa->tempo_total += $minutos;

        }else{
            $minutos = $dias * 603;

            $diffInicioJornada = $inicio->diffInMinutes($inicio_jornada);
            $diffFimJornada = $termino->diffInMinutes($fim_jornada);

            $totalDiff = $diffInicioJornada + $diffFimJornada + ($dias * 90);

            //$minutos - $totalDiff;
            $minutos -= ($totalDiff + $pausa);
            $tarefa->tempo_total += $minutos;
        }

        $projeto->tempo_total += $tarefa->tempo_total;

        $projeto->save();
        $tarefa->save();

        return redirect()->back();
    }

    public function inicioPausa($id){
        $tarefa = Task::find($id);
        $tarefa->inicio_pausa = Carbon::now()->subHour(3);
        $tarefa->save();

        return redirect()->back();
    }

    public function terminoPausa($id){
        $tarefa = Task::find($id);
        $tarefa->termino_pausa = Carbon::now()->subHour(3);
        // $tarefa->termino_pausa;

        $inicio = Carbon::parse($tarefa->inicio_pausa);
        $termino = Carbon::parse($tarefa->termino_pausa);

        $inicio_jornada = Carbon::now();

        $inicio_jornada->month = $inicio->month;
        $inicio_jornada->day = $inicio->day;
        $inicio_jornada->hour = 7;
        $inicio_jornada->minute = 0;

        $fim_jornada = Carbon::now();

        $fim_jornada->month = $termino->month;
        $fim_jornada->day = $termino->day;
        $fim_jornada->hour = 17;
        $fim_jornada->minute = 3;

        $dias = $termino->diffInWeekdays($inicio);
        $pausa = $tarefa->total_pausa;

        //para tarefas terminadas no mesmo dia
        if (($dias - 1) == 0){

            //começa antes do almoço
            //termina depois do intervalo
            if($inicio->hour < 12 && $termino->hour > 15){
                $pausa -= 90;

            //inicio antes do intervalo
            //termino depois do intervalo
            }elseif($inicio->hour <= 15 && $inicio->hour >= 12 && $termino->hour >= 15){
                $pausa -= 15;

            //inicio depois do almoço
            //termino antes do intervalo
            }elseif($inicio->hour > 12 && $termino->hour < 16){
                $pausa -= 0;

            //inicio antes do almoço
            //termino depois do almoço e antes do intervalo
            }elseif($inicio->hour < 12 && $termino->hour <= 15){
                $pausa -= 75;

            //inicia antes do almoço
            //termina antes do almoço
            }elseif($inicio->hour >= 7 && $termino->hour < 12){
                $pausa -= 0;

            }//else{
            //     $retorno = 'não caiu em nenhuma';
            // }

        }else{
            $pausa = $dias * 603;

            $diffInicioJornada = $inicio->diffInMinutes($inicio_jornada);
            $diffFimJornada = $termino->diffInMinutes($fim_jornada);

            $totalDiff = $diffInicioJornada + $diffFimJornada + (($dias - 1) * 90) - 2;

            if ($termino->hour < 11 && $termino->minute <= 25){
                $tarefa->total_pausa += $pausa - $totalDiff;
            }elseif ($termino->hour >= 12 && $termino->hour <= 15) {
                $tarefa->total_pausa += $pausa - $totalDiff - 75;
            }elseif ($termino->hour > 15) {
                $tarefa->total_pausa += $pausa - $totalDiff - 90;
            }

        }

        $tarefa->inicio_pausa = null;
        $tarefa->termino_pausa = null;

        $tarefa->save();

        return redirect()->back();
    }
}
