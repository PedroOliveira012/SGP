@extends('index.index')

@section('conteudo')
<div class="dashboard_header my-4">
    <h1>Bem vindo, {{ Auth::user()->name }}</h1>
</div>

<div class="dashboard_cards d-flex justify-content-between  mb-4 w-fit">
    <div class="dashboard_card">
        <p>Total projetos</p>
        <p>{{$andamento->count() + $encerrados->count()}}</p>
    </div>
    <div class="dashboard_card">
        <p>Projetos em montagem</p>
        <p>{{$andamento->where('status', 'Liberado')->count()}}</p>
    </div>
    <div class="dashboard_card">
        <p>Projetos em teste</p>
        <p>{{ $andamento->where('status', 'Em teste')->count() }}</p>
    </div>
    <div class="dashboard_card">
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
            <div class="accordion accordion-flush text-bg-dark"id="{{ $projeto->num_projeto }}">
                <div class="accordion-item text-light">
                    <h2 class="accordion-header text-light">
                        <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{ $projeto->id }}" aria-expanded="false" aria-controls="flush-{{ $projeto->id }}">
                            {{ $projeto->num_projeto }}
                        </button>
                    </h2>
                    <div id="flush-{{ $projeto->id }}" class="accordion-collapse collapse bg-dark" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li><b>Nome do projeto: </b><?=$projeto->nome_projeto?></li>
                                <li><b>Cliente: </b><?= $projeto->cliente?></li>
                                <li><b>Unidade: </b><?= $projeto->unidade?></li>
                                <li><b>Data de fechamento do projeto: </b><?= Carbon\Carbon::parse($projeto->data_fechamento)->isoFormat('DD/MM/YYYY')?></li>
                                <li><b>Data de entrega: </b><?= Carbon\Carbon::parse($projeto->data_entrega)->isoFormat('DD/MM/YYYY')?></li>
                                <li><b>Status de entrega: </b><?= Carbon\Carbon::parse($projeto->data_fechamento)->diffInDays($projeto->data_finalizacao)?> dias</li>
                                <li>
                                    <b>Progresso dos cabos: </b>
                                    @php
                                        $total = $cabos->where('project_id', $projeto->id)->count();
                                        $feitos = $cabos->where('project_id', $projeto->id)
                                                        ->where('status', 2) // ou ->where('concluido', 1)
                                                        ->count();

                                        $progresso = $total > 0 ? ($feitos / $total) * 100 : 0;
                                    @endphp
                                    <p>{{  $feitos }}/{{ $total }}</p>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{ $progresso }}%" aria-valuenow="{{ $feitos }}" aria-valuemin="0" aria-valuemax="{{ $total }}"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="dashboard_progress">
        
    </div>
</div>
@endsection