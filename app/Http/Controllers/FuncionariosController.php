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
        return view('funcionarios.index_funcionarios', ['lista' => $lista]);
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
        $minutosTotais = 0;

        //definição dos horários da jornada de trabalho para calcular o tempo útil e inútil, considerando os horários de almoço e café
        //esses horarios funcionam apenas para a comparação do tempo nas condições de inicio e nao de termino
        $inicio_jornada = Carbon::createFromTime(7, 0, 0); // Define a hora de início da jornada
        $inicio_almoço = Carbon::createFromTime(11, 25, 0); // Define a hora de almoço
        $fim_almoço = Carbon::createFromTime(12, 40, 0); // Define a hora de término do almoço
        $inicio_cafe = Carbon::createFromTime(15, 15, 0); // Define a hora de café
        $fim_cafe = Carbon::createFromTime(15, 30, 0); // Define a hora de término do café
        $fim_jornada = Carbon::createFromTime(17, 3, 0); //Define a hora de termino da jornada

        if ($inicio->day == $termino->day) { //se o dia de inicio e de termino forem iguais

            $minutosTotais = $termino->diffInMinutes($inicio);
            switch (true) {
                case $termino->lt($inicio_almoço): //inicio e termino antes do almoço
                    $caso = 1;
                    break;
                case $inicio->lt($inicio_almoço) && ($termino->gt($inicio_almoço) && $termino->lt($inicio_cafe)): //inicio antes do almoço e termino entre o almoço e o café
                    $minutosTotais -= 75; //descontar o tempo do almoço
                    $caso = 2;
                    break;
                case $inicio->lt($inicio_almoço) && $termino->gt($fim_cafe): //inicio antes do almoço e termino depois do café
                    $minutosTotais -= 90; //descontar o tempo do almoço e café
                    $caso = 3;
                    break;
                case ($inicio->gt($inicio_almoço) && $inicio->lt($inicio_cafe)) && $termino->lt($fim_cafe): //inicio entre o almoço e o café e termino entre o almoço e o café
                    $caso = 4;
                    break;
                case ($inicio->gt($inicio_almoço) && $inicio->lt($inicio_cafe)) && $termino->gt($fim_cafe): //inicio entre o almoço e o café e termino depois do café
                    $minutosTotais -= 15; //descontar o tempo do café
                    $caso = 5;
                    break;
                case $inicio->gt($fim_cafe) && $termino->lt($fim_jornada): //inicio depois do café e termino antes do fim da jornada
                    $caso = 6;
                    break;  
            }
        
        }else{
            $inicio_jornada->setYear($inicio->year); //define a data do inicio da jornada usando a data de inicio da tarefa
            $inicio_jornada->setMonth($inicio->month);
            $inicio_jornada->setDay($inicio->day);

            $fim_jornada->setYear($termino->year); //define a data do dim da jornada usando a data de termino da tarefa
            $fim_jornada->setMonth($termino->month);
            $fim_jornada->setDay($termino->day);

            $dias_trabalhados = $termino->diffInWeekdays($inicio) + 1; //calcula a diferença em dias
            $min_uteis = $dias_trabalhados * 603; //define o tempo util do dia
            $diffInicio = $inicio->diffInMinutes($inicio_jornada); //calcula a diferença entre o inicio da tarefa e o inicio da jornada
            $diffTermino = $termino->diffInMinutes($fim_jornada); //calcula a diferença entre o termino da tarefa e o fim da jornada

            //padronização do primeiro dia da tarefa para calcular o tempo útil e inútil, considerando os horários de almoço e café
            $minutos_dia_inicio = 603;
            if ($inicio->lt($inicio_almoço)){ //se o inicio da tarefa for menor que o inicio do almoço no primeiro dia
                $minutos_dia_inicio -= 90; // desconsiderar o tempo do almoço e café
                $descontou = 'descontou 90 minutos dia 1';
            }else if($inicio->gt($fim_almoço) && $inicio->lt($inicio_cafe)){ //se o inicio da tarefa for entre o inicio do almoço e o início do café no primeiro dia
                $minutos_dia_inicio -= 15; //desconsiderar o tempo do café
                $descontou = 'descontou 15 minutos dia 1';
            }else{
                $minutos_dia_inicio -= 0; //não descontar nada
                $descontou = 'não descontou nada dia 1';
            }

            //declaração dos hoarios do ultimo dia da tarefa para calcular o tempo útil e inútil, considerando os horários de almoço e café
            $inicio_jornada = $termino->copy()->setTime(7, 0, 0);
            $inicio_almoço = $termino->copy()->setTime(11, 25, 0);
            $fim_almoço = $termino->copy()->setTime(12, 40, 0);
            $inicio_cafe = $termino->copy()->setTime(15, 15, 0);
            $fim_cafe = $termino->copy()->setTime(15, 30, 0);
            $fim_jornada = $termino->copy()->setTime(17, 3, 0);

            //padronização do ultimo dia da tarefa para calcular o tempo útil e inútil, considerando os horários de almoço e café
            $minutos_dia_termino = 603;
            if ($termino->gt($fim_almoço) && $termino->lt($inicio_cafe)){ //se o termino da tarefa for depois do fim do café no último dia
                $minutos_dia_termino -= 75; //desconsiderar o tempo do almoço
                $descontou_termino = 'descontou 75 minutos dia 2';
            }else if ($termino->gt($fim_cafe)){ //se o termino da tarefa for entre o fim do almoço e o início do café no último dia
                $minutos_dia_termino -= 90; // desconsiderar o tempo do almoço e café
                $descontou_termino = 'descontou 90 minutos dia 2';
            }else{
                $minutos_dia_termino -= 0; //não descontar nada
                $descontou_termino = 'não descontou nada dia 2';
            }
            
            $minutos_dias_intermediarios = 0;
            if ($dias_trabalhados > 2){ //se a tarefa tiver mais de 2 dias, descontar os dias intermediários
                $minutos_dias_intermediarios += ($dias_trabalhados - 2) * 513; //adicionar o tempo útil dos dias intermediários
            }

            $diffTotal = $diffInicio + $diffTermino; //soma das diferenças
            $minutosTotais +=  $minutos_dia_inicio + $minutos_dia_termino + $minutos_dias_intermediarios - $diffTotal; //subtração das diferenças do tempo útil total
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
