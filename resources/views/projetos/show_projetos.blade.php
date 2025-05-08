@extends('index.index')

@section('conteudo')

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<body onload="Relembrar()">
    @if (Auth::user()->cargo == 'Coordenador de Engenharia' or Auth::user()->cargo == 'Analista' or Auth::user()->cargo == 'Admin')
        <a href={{ url("/projeto/liberados")}}>
            <button class="btn voltar-projeto">
                <i class="fa-solid fa-chevron-left voltar-icone"></i> Voltar
            </button>
        </a>
    @else
        <a href={{ url("/projeto/liberados")}}>
            <button class="btn voltar-projeto">
                <i class="fa-solid fa-chevron-left voltar-icone"></i> Voltar
            </button>
        </a>
    @endif

    <section class="container contorno write-section">
        <div class="info-projeto">
            <h1>Número do Projeto: <?= $i->num_projeto?></h1>
            <h3>Status:
            @if ($i->liberado == 1)
                Liberado para a fábrica
            @elseif ($i->fase_teste == 1)
                Projeto em fase de teste
            @elseif ($i->finalizado == 1)
                Projeto finalizado
            @else
                Em desenvolvimento na engenharia
            @endif
            </h3>
            <div class="dados_lista">
                <ul>
                    <li><b>Nome do projeto: </b><?=$i->nome_projeto?></li>
                    <li><b>Cliente: </b><?= $i->cliente?></li>
                    <li><b>Unidade: </b><?= $i->unidade?></li>
                    <li><b>Data de fechamento do projeto: </b><?= Carbon\Carbon::parse($i->data_fechamento)->isoFormat('DD/MM/YYYY')?></li>
                    <li><b>Data de entrega: </b><?= Carbon\Carbon::parse($i->data_entrega)->isoFormat('DD/MM/YYYY')?></li>
                    <li><b>Analista: </b><?= $i->analista?></li>
                    <li><b>Projetista: </b><?= $i->projetista?></li>
                    <!-- @if ($i->finalizado == 0)
                        @if (($i->prazo_entrega * 0.9) <= Carbon\Carbon::today()->diffInDays($i->data_fechamento))
                            <li class="data-vermelha"><b>Status de entrega: </b><?= Carbon\Carbon::today()->diffInDays($i->data_fechamento)?> dias</li>
                        @elseif (( $i->prazo_entrega * 0.7) <= Carbon\Carbon::today()->diffInDays($i->data_fechamento))
                            <li class="data-laranja"><b>Status de entrega: </b><?= Carbon\Carbon::today()->diffInDays($i->data_fechamento)?> dias</li>
                        @elseif (( $i->prazo_entrega * 0.4) <= Carbon\Carbon::today()->diffInDays($i->data_fechamento))
                            <li class="data-amarela"><b>Status de entrega: </b><?= Carbon\Carbon::today()->diffInDays($i->data_fechamento)?> dias</li>
                        @else
                            <li class="data-verde"><b>Status de entrega: </b><?= Carbon\Carbon::today()->diffInDays($i->data_fechamento)?> dias</li>
                        @endif
                    @else
                        @if (($i->prazo_entrega * 0.9) <= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao))
                            <li class="data-vermelha"><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao)?> dias</li>
                        @elseif (( $i->prazo_entrega * 0.7) <= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao))
                            <li class="data-laranja"><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao)?> dias</li>
                        @elseif (( $i->prazo_entrega * 0.4) <= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao))
                            <li class="data-amarela"><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao)?> dias</li>
                        @else
                            <li class="data-verde"><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao)?> dias</li>
                        @endif
                    @endif -->
                    <li class=""><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fechamento)->diffInDays($i->data_finalizacao)?> dias</li>
                </ul>
            </div>
        </div>
    </section>

</body>

<form action="{{ url('/projeto/libera/' .$i->id) }}" class="progress-form" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade" id="staticBackdropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Liberar projeto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Deseja mesmo liberar este projeto?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Liberar</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
