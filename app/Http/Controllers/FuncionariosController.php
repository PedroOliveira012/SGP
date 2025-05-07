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
        $tarefa = Task::all();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('funcionarios.index_funcionarios', ['lista' => $lista, 'tarefa' => $tarefa]);
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
        $tarefa = Task::find($id); //Acha a tarefa
        $tarefa->termino_tarefa = Carbon::now()->subHour(3); //Subtrai 3 horas do horario que foi gravado
        $tarefa->status = 'concluido'; //Define o status da tarefa como concluido
        $tarefa->visualizado = 0; //Define a tarefa como nao visualizada

        $projeto = Project::find($tarefa->id_projeto); //Acha o projeto

        $inicio = Carbon::parse($tarefa->inicio_tarefa); //Formata o valor do inicio da tarefa
        $termino = Carbon::parse($tarefa->termino_tarefa); //Formata o valor do termino da tarefa

        $inicio_jornada = Carbon::createFromTime(7, 0, 0); // Define a hora de início da jornada
        $horario_almoço = Carbon::createFromTime(11, 25, 0); // Define a hora de almoço
        $horario_cafe = Carbon::createFromTime(15, 15, 0); // Define a hora de café
        $fim_jornada = Carbon::createFromTime(17, 3, 0); //Define a hora de termino da jornada

        $minutosTotais = 0;
        // $pausa = $tarefa->total_pausa;
        // $intervalo = 0;

        if ($inicio->day == $termino->day) { //se o dia de inicio e de termino forem iguais
            if ($termino->lt($horario_almoço)){ //se terminar antes do almoço, não descontar nada
                $minutosTotais = $termino->diffInMinutes($inicio_jornada); //calcula a diferença entre os horarios em minutos sem descontar nada
            }else if($inicio->gt($horario_almoço) && $termino->lt($horario_cafe)){ //se o horario de inicio e termino estiver entre o almoco e o café
                $minutosTotais = $termino->diffInMinutes($inicio); //calcula a diferença entre os horarios em minutos sem descontar nada
            }else{
                switch (true) {
                    case $termino->lt($horario_cafe): //se o horario de termino for menor que o café
                        $minutosTotais = $termino->diffInMinutes($inicio) - 75; //descontar o tempo de almoço no calculo
                        break;
                    default: //se não o horario vai ser maior
                        $minutosTotais = $termino->diffInMinutes($inicio) - 90; //descontar o tempo de almoço e café no calculo
                        break;
                }
            }
        }else{
            $inicio_jornada->setYear($inicio->year); //define a data do inicio da jornada usando a data de inicio da tarefa
            $inicio_jornada->setMonth($inicio->month);
            $inicio_jornada->setDay($inicio->day);

            $fim_jornada->setYear($termino->year); //define a data do dim da jornada usando a data de termino da tarefa
            $fim_jornada->setMonth($termino->month);
            $fim_jornada->setDay($termino->day);

            $dias_trabalhados = $termino->diffInWeekdays($inicio); //calcula a diferença em dias

            if($termino->lt($inicio)){ //se o horario de termino for menor que o de inicio
                $dias_trabalhados += 1; //adiciona 1 dia na diferença de dias
            }

            $min_uteis = $dias_trabalhados * 513; //define o tempo util do dia

            $diffInicio = $inicio->diffInMinutes($inicio_jornada); //calcula a diferença entre o inicio da tarefa e o inicio da jornada
            $diffTermino = $termino->diffInMinutes($fim_jornada); //calcula a diferença entre o termino da tarefa e o fim da jornada

            if($termino->lt($horario_almoço)){ //
                $diffTermino -= 90; //esse tempo é descontado por nao ser "útil" na execução da tarefa, então o 90 é a soma do almoço e café
            }else if($termino->gt($horario_almoço) && $termino->lt($horario_cafe)){
                $diffTermino -= 15; //descontado apenas o tempo do café
            }

            //a lógica é repetida para calcular esse tempo útil e inútil no dia de inicio da tarefa
            //horario cafe e almoço recebe o dia de inicio para esta comparação
            $horario_almoço->setYear($inicio->year);
            $horario_almoço->setMonth($inicio->month);
            $horario_almoço->setDay($inicio->day);

            $horario_cafe->setYear($inicio->year);
            $horario_cafe->setMonth($inicio->month);
            $horario_cafe->setDay($inicio->day);

            if($inicio->gt($horario_almoço)){
                $diffInicio -= 75;
            }else if($inicio->lt($horario_cafe) && $inicio->gt($horario_almoço)){
                $diffInicio -= 90;
            }

            $diffTotal = $diffInicio + $diffTermino; //soma das diferenças
            $minutosTotais +=  $min_uteis - $diffTotal; //subtração das diferenças do tempo útil total
        }

        $tarefa->tempo_total = $minutosTotais;

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
