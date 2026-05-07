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
            <button onclick="visualizarProjeto('{{ $projeto->id }}')" class="btn btn-primary projects-list-btn" type="button">
                Visualizar
            </button>
        </div>
        @endforeach
    </div>
    <div class="task-info-chart">
        <div class=" m-auto task-info-header">
            <h3><span id="num_projeto"></span> - <span id="nome_projeto"></span></h3>
        </div>
        <div class="task-info">
            <ul>
                <li><b>Cliente: </b><span id="cliente"></span></li>
                <li><b>Unidade: </b><span id="unidade"></span></li>
                <li><b>Data de fechamento do projeto: </b><span id="data_fechamento"></span></li>
                <li><b>Data de entrega: </b><span id="data_entrega"></span></li>
                <li><b>Status de entrega: </b><span id="status_entrega"></span></li>                
                {{-- @if ($progresso == 0)
                    <li><b>Progresso dos cabos: </b>Sem cabos cadastrados</li>
                @else --}}
                    <li>
                        <b>Progresso dos cabos: </b>
                        <p><span id="feitos"></span>/<span id="total"></span></p>
                        <div class="progress">
                            <div class="progress-bar" style="" aria-valuenow="" aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                    </li>
                {{-- @endif --}}
            </ul>
        </div>
        <div class=" m-auto" id="projects-tasks-chart"></div>
    </div>
</div>
<div class="project-data d-flex justify-content-between mt-4">
    <div class=" m-auto" id="dashboard_chart"></div>
</div>
@endsection