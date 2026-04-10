@extends('index.index')

@section('conteudo')
<div class="dashboard_header my-4">
    <h1>Bem vindo, {{ Auth::user()->name }}</h1>
</div>

<div class="dashboard_cards d-flex justify-content-between  mb-4 w-fit">
    <div class="dashboard_card card_total">
        <p>Total projetos</p>
        <p>{{$andamento->count() + $encerrados->count()}}</p>
    </div>
    <div class="dashboard_card card_andamento">
        <p>Projetos em montagem</p>
        <p>{{$andamento->where('status', 'Liberado')->count()}}</p>
    </div>
    <div class="dashboard_card card_teste">
        <p>Projetos em teste</p>
        <p>{{ $andamento->where('status', 'Em teste')->count() }}</p>
    </div>
    <div class="dashboard_card card_encerrados">
        <p>Projetos finalizados</p>
        <p>{{$encerrados->count()}}</p>
    </div>
</div>


    <div class="dashboard_search my-3 ms-5">
        <input type="text" class="form-control" id="dashboard-search" placeholder="Buscar por projetos...">
    </div>
<div class="project-data d-flex justify-content-between">
    <div class="projects-list custom-sidebar">
        @foreach ($andamento as $projeto)
        <div class="projects-list-item" id="{{ $projeto->num_projeto }}">
            {{ $projeto->num_projeto }}
            <button class="btn btn-primary projects-list-btn" type="button">Visualizar</button>
        </div>
        @endforeach
    </div>
    <div class="task-info-chart">
        <div class=" m-auto task-info-header">
            <h3>{{ $projeto->num_projeto }} - {{ $projeto->nome_projeto }}</h3>
        </div>
        <div class="task-info">
            <ul>
                <li><b>Cliente: </b><?= $projeto->cliente?></li>
                <li><b>Unidade: </b><?= $projeto->unidade?></li>
                <li><b>Data de fechamento do projeto: </b><?= Carbon\Carbon::parse($projeto->data_fechamento)->isoFormat('DD/MM/YYYY')?></li>
                <li><b>Data de entrega: </b><?= Carbon\Carbon::parse($projeto->data_entrega)->isoFormat('DD/MM/YYYY')?></li>
                <li><b>Status de entrega: </b><?= Carbon\Carbon::parse($projeto->data_fechamento)->diffInDays($projeto->data_finalizacao)?> dias</li>

                @php
                    $total = $cabos->where('project_id', $projeto->id)->count();
                    $feitos = $cabos->where('project_id', $projeto->id)
                                    ->where('status', 2) // ou ->where('concluido', 1)
                                    ->count();

                    $progresso = $total > 0 ? ($feitos / $total) * 100 : 0;
                @endphp
                
                @if ($progresso == 0)
                    <li><b>Progresso dos cabos: </b>Sem cabos cadastrados</li>
                @else
                    <li>
                        <b>Progresso dos cabos: </b>
                        <p>{{  $feitos }}/{{ $total }}</p>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $progresso }}%" aria-valuenow="{{ $feitos }}" aria-valuemin="0" aria-valuemax="{{ $total }}"></div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        <div class=" m-auto" id="projects-tasks-chart"></div>
    </div>
</div>
<div class="project-data d-flex justify-content-between mt-4">
    <div class=" m-auto" id="dashboard_chart"></div>
</div>
@endsection