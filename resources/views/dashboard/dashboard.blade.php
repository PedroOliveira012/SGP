@extends('index.index')

@section('conteudo')
<div>
    <h1>Bem vindo, {{ Auth::user()->name }}</h1>
</div>

<div class="d-flex justify-content-evenly gap-3 mb-4 w-fit">
    <div class="dashboard_card">
        <p>Total vendido</p>
        <p>R$ 100.000,00</p>
    </div>
    <div class="dashboard_card">
        <p>Total projetos</p>
        <p>20</p>
    </div>
    <div class="dashboard_card">
        <p>Projetos em montagem</p>
        <p>5</p>
    </div>
    <div class="dashboard_card">
        <p>Projetos finalizados</p>
        <p>15</p>
    </div>
</div>

<div class="dashboard_search my-3 ms-3">
    <input type="text" class="form-control" placeholder="Buscar por projetos...">
</div>

<div class="d-flex justify-content-evenly project-data overflow-y-auto">
    
    <div class="projects-list overflow-y-auto">
        <div class="accordion accordion-flush text-bg-dark"id="accordionExample">
            <div class="accordion-item text-light">
                <h2 class="accordion-header text-light">
                    <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseTwo">
                        102030-00
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse bg-dark" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    teste
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard_progress">
        Quadro de progresso de paineis
    </div>
</div>
@endsection