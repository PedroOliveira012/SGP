@extends('index.index')

@section('conteudo')
<div>
    <h1>Bem vindo, {{ Auth::user()->name }}</h1>
</div>

<div class="d-flex justify-content-evenly gap-3 mb-4 w-fit">
    
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

<div class="dashboard_search my-3 ms-3">
    <input type="text" class="form-control" placeholder="Buscar por projetos...">
</div>

<div class="d-flex justify-content-evenly project-data">
    <div class="projects-list custom-sidebar">
    @foreach ($andamento as $andamento)
        <div class="accordion accordion-flush text-bg-dark"id="accordionExample">
            <div class="accordion-item text-light">
                <h2 class="accordion-header text-light">
                    <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{ $andamento->id }}" aria-expanded="false" aria-controls="flush-{{ $andamento->id }}">
                        {{ $andamento->num_projeto }}
                    </button>
                </h2>
                <div id="flush-{{ $andamento->id }}" class="accordion-collapse collapse bg-dark" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <ul>
                            <li><b>Nome do projeto: </b><?=$andamento->nome_projeto?></li>
                            <li><b>Cliente: </b><?= $andamento->cliente?></li>
                            <li><b>Unidade: </b><?= $andamento->unidade?></li>
                            <li><b>Data de fechamento do projeto: </b><?= Carbon\Carbon::parse($andamento->data_fechamento)->isoFormat('DD/MM/YYYY')?></li>
                            <li><b>Data de entrega: </b><?= Carbon\Carbon::parse($andamento->data_entrega)->isoFormat('DD/MM/YYYY')?></li>
                            <li class=""><b>Status de entrega: </b><?= Carbon\Carbon::parse($andamento->data_fechamento)->diffInDays($andamento->data_finalizacao)?> dias</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <div class="dashboard_progress">
        Quadro de progresso de paineis
    </div>
</div>
@endsection