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
    @if (Auth::user()->cargo == 'Coordenador de Engenharia' or Auth::user()->cargo == 'Analista' or Auth::user()->cargo == 'Diretor' or Auth::user()->cargo == 'Admin')
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
        <div class="write-section__lista">
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
                    <li><b>Responsável Técnico (cliente): </b><?= $i->Responsavel_tecnico?></li>
                    <li><b>Analista: </b><?= $i->analista?></li>
                    <li><b>Projetista: </b><?= $i->projetista?></li>
                    <li><b>Valor contratado: </b>R$ <?=number_format($i->valor_contratado,2,',','.')?></li>
                    <li><b>Prazo de entrega: </b><?= $i->prazo_entrega?> dias</li>
                    <li><b>Responsável pelo projeto: </b><?= $i->responsavel?></li>
                    @if ($i->finalizado == 0)
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
                    @endif

                    <li><b>Status de projeto: </b></li>
                </ul>
            </div>
        </div>
        <div class="write-section__comment--write">
            <h2>Comentários sobre o projeto</h2>
            <form action="{{ url('/projeto/add_comentario/' .$i->id) }}" class="progress-form" method="post">
                <input hidden name="_token" value="{{{ csrf_token() }}}">
                <input type="hidden" name="id_projeto" value="{{$i->id}}">
                <div class="write-section__textarea">
                    <textarea class="form-control" id="comentario" name="comentario" cols="60" rows="5" maxlength="255" placeholder="Escreva um comentário (máx 255 caracteres)"></textarea>
                </div>
                <div class="write-section__button">
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </div>
            </form>
            <div class="controle">
                @if ($i->finalizado == 1)
                    <div class="liberar">
                        <a href="{{ url('/projeto/export/' .$i->id) }}">
                            <button type="button" class="btn btn-success btn-download">
                                <i class="fa-solid fa-file-arrow-down icone-download"></i>Download
                            </button>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>


    {{-- <form action="{{ url("/projeto/atualizarProgresso/$i->id/1") }}" class="progress-form" method="POST">
        @csrf
        @method('PUT')
        <div class="info-etapa">
            <button class="progress-button" type="submit" name="espera" id= id="1" onclick="atualizarProgresso()">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>

            <button class="progress-button" type="submit" name="andamento" id= id="2" onclick="atualizarProgresso()">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>

            <button class="progress-button" type="submit" name="analise" id= id="3" onclick="atualizarProgresso()">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>

            <button class="progress-button" type="submit" name="revisao" id= id="4" onclick="atualizarProgresso()">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>

            <button class="progress-button" type="submit" name="aprovacao" id= id="5" onclick="atualizarProgresso()">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>

            <button class="progress-button" type="submit" name="compras" id= id="6" onclick="atualizarProgresso()">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>
        </div>
    </form> --}}

    <div class="info-etapa">
        {{-- <form action="{{ url("/projeto/atualizarProgresso/$i->id/1") }}" class="progress-form" method="POST">
            @csrf
            @method('PUT') --}}
            @if ($i->progresso >= 1)
            <button class="progress-button progress-button-checked" type="submit" name="espera" id="1">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>
            @else
            <button class="progress-button" type="submit" name="espera" id="1">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>
            @endif
        {{-- </form> --}}
        {{-- <form action="{{ url("/projeto/atualizarProgresso/$i->id/2") }}" class="progress-form" method="POST">
            @csrf
            @method('PUT') --}}
            <button class="progress-button" type="submit" name="andamento" id="2">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>
        {{-- </form> --}}
        {{-- <form action="{{ url("/projeto/atualizarProgresso/$i->id/3") }}" class="progress-form" method="POST">
            @csrf
            @method('PUT') --}}
            <button class="progress-button" type="submit" name="analise" id="3">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>
        {{-- </form> --}}
        {{-- <form action="{{ url("/projeto/atualizarProgresso/$i->id/4") }}" class="progress-form" method="POST">
            @csrf
            @method('PUT') --}}
            <button class="progress-button" type="submit" name="revisao" id="4">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>
        {{-- </form> --}}
        {{-- <form action="{{ url("/projeto/atualizarProgresso/$i->id/5") }}" class="progress-form" method="POST">
            @csrf
            @method('PUT') --}}
            <button class="progress-button" type="submit" name="aprovacao" id="5">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>
        {{-- </form> --}}
        {{-- <form action="{{ url("/projeto/atualizarProgresso/$i->id/6") }}" class="progress-form" method="POST">
            @csrf
            @method('PUT') --}}
            <button class="progress-button" type="submit" name="compras" id="6">
                <i class="fa-solid fa-check" style="color: #f0f0f0;"></i>
            </button>
        {{-- </form> --}}
    </div>

    <div class="info-progresso">
        <progress id="barra" value="{{ $progresso }}" max="6"></progress>
    </div>

    <div class="legenda">
        <label for="espera">Espera</label>
        <label for="andamento">Andamento</label>
        <label for="analise">Análise</label>
        <label for="revisao">Revisão</label>
        <label for="aprovacao">Aprovação</label>
        <label for="compras">Compras</label>
    </div>

    <section class="container contorno comment-section">
        <div class="comment-section__comment--show">
            <?php foreach ($comentario as $c): ?>
                <div class="comment">
                    <div class="usuario">
                        <b>{{$c->usuario}}</b>
                    </div>
                    <div class="timestamp">
                        {{Carbon\Carbon::parse($c->created_at)->subHour(3)->isoFormat('DD/MM/YYYY HH:mm')}}
                    </div>
                    <div class="conteudo_comentario">
                        {{$c->comentario}}
                    </div>
                </div>
            <?php endforeach?>
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
