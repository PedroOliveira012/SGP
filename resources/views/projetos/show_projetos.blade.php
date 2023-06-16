@extends('index.index')

@section('conteudo')
<body onload="Relembrar()">
    <a href={{ url("/projeto/andamento")}}>
        <button class="btn voltar-projeto">
            <i class="fa-solid fa-chevron-left voltar-icone"></i> Voltar
        </button>
    </a>
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
                    {{-- <?= $i->observacoes?> --}}

                </ul>
            </div>
        </div>
        <div class="write-section__comment--write">
            <h2>Comentários sobre o projeto</h2>
            <form action="{{ url('/projeto/add_comentario/' .$i->id) }}" method="post">
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
                @if ($i->liberado == 0 && $i->fase_teste == 0 && $i->finalizado == 0)
                    <div class="liberar">
                        <button type="button" class="btn btn-success btn-liberar" data-bs-toggle="modal" data-bs-target="#staticBackdropModal">
                            <i class="fa-solid fa-check-to-slot"></i> Liberar
                        </button>
                    </div>
                @elseif ($i->liberado == 1 && $i->fase_teste == 0 && $i->finalizado == 0)
                    <div class="designar">
                        <form action="{{ url('/projeto/atualizar/' .$i->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="descricao">
                                <label for="message" class="col-form-label">Definir responsável pelo projeto</label>
                            </div>
                            <div class="interacao">
                                <select class="form-select" name="responsavel_select">
                                    <option value="" hidden selected disabled>{{$i->responsavel}}</option>
                                    @foreach ($func as $f)
                                        <option value="{{$f->name}}">{{$f->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="submit">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i>  Designar</button>
                            </div>
                        </form>
                    </div>
                @elseif ($i->liberado == 0 && $i->fase_teste == 0 && $i->finalizado == 1)
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


    <div class="info-etapa">
        <label class="progresso">
            <input type="checkbox" name="espera" id="espera" onclick="atualizarProgresso()">
            <span class="etapa"></span>
        </label>
        <label  class="progresso">
            <input type="checkbox" name="andamento" id="andamento" onclick="atualizarProgresso()">
            <span class="etapa"></span>
        </label>
        <label  class="progresso">
            <input type="checkbox" name="analise" id="analise" onclick="atualizarProgresso()">
            <span class="etapa"></span>
        </label>
        <label  class="progresso">
            <input type="checkbox" name="revisao" id="revisao" onclick="atualizarProgresso()">

            <span class="etapa"></span>
        </label>
        <label  class="progresso">
            <input type="checkbox" name="aprovacao" id="aprovacao" onclick="atualizarProgresso()">

            <span class="etapa"></span>
        </label>
        <label class="progresso">
            <input type="checkbox" name="compras" id="compras" onclick="atualizarProgresso()">

            <span class="etapa"></span>
        </label>
    </div>

    <div class="info-progresso">
        <progress id="barra" value="" max="6"></progress>
    </div>

    <div class="legenda">
        <label for="espera">Espera</label>
        <label for="andamento">Andamento</label>
        <label for="analise">Análise</label>
        <label for="revisao">Revisão</label>
        <label for="aprovacao">Aprovação</label>
        <label for="compras">Compras</label>
    </div>
    {{-- <p>valor dos input (espera): <?= $esperaValor ?></p> --}}

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

<form action="{{ url('/projeto/libera/' .$i->id) }}" method="POST">
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
