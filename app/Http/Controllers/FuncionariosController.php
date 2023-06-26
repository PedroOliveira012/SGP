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
        $tarefa = Task::find($id); //Pega a tarefa
        $tarefa->termino_tarefa = Carbon::now()->subHour(3); //Subtrai 3 horas do horario que foi gravado
        $tarefa->status = 'concluido'; //Define o status da tarefa como concluido
        $tarefa->visualizado = 0; //Define a tarefa como nao visualizada

        $projeto = Project::find($tarefa->id_projeto); //Pega o projeto

        $inicio = Carbon::parse($tarefa->inicio_tarefa); //Formata o valor do inicio da tarefa
        $termino = Carbon::parse($tarefa->termino_tarefa); //Formata o valor do termino da tarefa

        $inicio_jornada = Carbon::now(); //Pega o dia e hora atual
        $fim_jornada = Carbon::now(); //Pega o dia e hora atual

        $inicio_jornada->month = $inicio->month; //Altera o mes da data de inicio da jornada
        $inicio_jornada->day = $inicio->day; //Altera o dia da data de inicio da jornada
        $inicio_jornada->hour = 7;//Define a hora da data de inicio da jornada
        $inicio_jornada->minute = 0;//Define o minuto da data de inicio da jornada

        $fim_jornada->month = $termino->month; //Altera o dia da data de termino da jornada
        $fim_jornada->day = $termino->day; //Altera o dia da data de termino da jornada
        $fim_jornada->hour = 17; //Define a hora da data de termino da jornada
        $fim_jornada->minute = 3; //Define o minuto da data de termino da jornada

        $dias = $termino->diffInWeekdays($inicio); //Faz o cálculo de diferença de dias entre o inicio e termino excluindo fim de semana
        $minutos = 0;
        $pausa = $tarefa->total_pausa;
        $intervalo = 0;


        //para tarefas terminadas no mesmo dia
        if (($dias - 1) == 0){

        //inicio antes do almoço
            if($inicio->hour <= 11){
                //termino antes do almoço
                if($termino->hour <= 11){
                    $intervalo += $pausa;
                }
                //termino depois do intervalo
                else if($termino->hour > 15 || ($termino->hour == 15 && $termino->minute >= 30)){
                    $intervalo = 90 + $pausa;
                }
                //termino depois do almoço e antes do intervalo
                else{
                    $intervalo = 75 + $pausa;
                }
            //inicio depois do almoço
            }else if($inicio->hour >=12){
                //termino depois do intervalo
                if($termino->hour > 15 || ($termino->hour == 15 && $termino->minute >= 30)){
                    $intervalo = 15 + $pausa;
                }
            }else{
                $intervalo += $pausa;
            }

        }else{
            $minutos = $dias * 603;

            $diffInicioJornada = $inicio->diffInMinutes($inicio_jornada); //Diferença entre o inicio da jornada com o inicio da tarefa
            $diffFimJornada = $termino->diffInMinutes($fim_jornada); //Diferença entre o termino da tarefa com o termino da jornada

            $totalDiff = $diffInicioJornada + $diffFimJornada + ($dias * 90); // soma as diferenças de inicio e termino com o almoço e intervalo dos dias uteis

            $minutos -= ($totalDiff + $pausa);
            $tarefa->tempo_total += $minutos;
        }

        $minutos = $termino->diffInMinutes($inicio) - $intervalo;
        $tarefa->tempo_total = $minutos;

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
