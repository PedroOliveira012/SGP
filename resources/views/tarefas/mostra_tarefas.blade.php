@extends('index.index')

@section('conteudo')

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<body>
    <a href="{{ url('/tarefas/lista/' .$i->id_projeto) }}">
        <button class="btn voltar">
            <i class="fa-solid fa-chevron-left voltar-icone"></i>
              Voltar
        </button>
    </a>
    {{-- <section class="linha">
        <section class="contorno view">

        </section>
        <section class="contorno view">

        </section>
        <section class="contorno view">

        </section>
        <section class="contorno view">

        </section>
    </section> --}}
    <div id="carouselExampleIndicators" class="carousel slide contorno view">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class=" view_conteudo">
                    <ul>
                        <li><h2>Nome do funcionário: </h2><p><?= $i->funcionario?></p></li>
                        <li><h2>Tarefa do funcionario: </h2><p><?= $i->tarefa?></p></li>
                        <li><h2>Ajuda: </h2><p>link para a pagina de ajuda</p></li>
                    </ul>
                </div>
            </div>
          <div class="carousel-item">
            <div class="view_conteudo">
                <ul>
                    <li class="itens_lista"><h3>Data e hora do inicio da tarefa:</h3>
                        @if ($i->inicio_tarefa)
                            <?= Carbon\Carbon::parse($i->inicio_tarefa)->isoFormat('DD/MM/YYYY HH:mm')?>
                        @else
                            <p>--/--/-- --:--</p>
                        @endif
                    </li>
                    <li class="itens_lista" ><h3>Data e hora do termino da tarefa:</h3>
                        @if ($i->termino_tarefa)
                            <?= Carbon\Carbon::parse($i->termino_tarefa)->isoFormat('DD/MM/YYYY HH:mm')?>
                        @else
                            <p>--/--/-- --:--</p>
                        @endif
                    </li>
                    <li class="itens_lista"><h3>Tempo de de execução da tarefa</h3>
                        {{-- @if ($i->termino_tarefa)
                            <input type="hidden" name="hora_inicio" id="hora_inicio">
                            <p>{{Carbon\Carbon::parse($i->termino_tarefa)->diffInWeekdays($i->inicio_tarefa)}} dias</p>
                            <p>{{Carbon\Carbon::parse($i->termino_tarefa)->diffInHours($i->inicio_tarefa)}} horas</p>
                            <p>{{Carbon\Carbon::parse($i->termino_tarefa)->diffInMinutes($i->inicio_tarefa)}} minutos</p>
                            @if ($total_horas == 0)
                                <p>Tempo total: {{$total_min}} minutos</p>
                            @elseif ($total_min == 0)
                                @if ($total_horas > 1)
                                    <p>Tempo total: {{$total_horas}} horas</p>
                                @else
                                    <p>Tempo total: {{$total_horas}} hora</p>
                                @endif
                            @else
                                @if ($total_horas > 1 && $total_min == 1)
                                    <p>Total em horas: {{$total_horas}} horas e {{$total_min}} minuto</p>
                                @elseif ($total_horas > 1 && $total_min > 1)
                                    <p>Total em horas: {{$total_horas}} horas e {{$total_min}} minutos</p>
                                @elseif ($total_horas == 1 && $total_min == 1)
                                    <p>Total em horas: {{$total_horas}} hora e {{$total_min}} minuto</p>
                                @else
                                    <p>Total em horas: {{$total_horas}} hora e {{$total_min}} minutos</p>
                                @endif
                            @endif
                            <p>Tempo total: {{$total_horas}} horas e {{$total_min}} minutos</p>
                        @else
                            <p>--:--</p>
                        @endif --}}
                    </li>
                    <li class="itens_lista"><h3>Tempo de retrabalho: <?= $i->termino_retrabalho?></h3>
                        @if ($i->termino_retrabalho)
                            <?= $i->termino_retrabalho?>
                        @else
                            <p>--:--</p>
                        @endif
                    </li>
                </ul>
            </div>
          </div>
          <div class="carousel-item">
            <div class="view_conteudo" id="notas">
                <div>
                    <h2>Notas da tarefa</h2>
                </div>
                <input type="hidden" name="id_projeto" value="{{$i->id}}">
                <div class="">
                    <textarea class="form-control" name="comentario" cols="60" rows="5" maxlength="255" placeholder="Escreva um comentário (máx 255 caracteres)" disabled>{{$i->Notas}}</textarea>
                </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="view_conteudo--botao">
                @if ($i->tarefa == 'Pendencia')
                    <div class="tabela__dados--botoes">
                        <a href="{{ url('/testes/pendencia/editar/' .$i->id) }}"><button type="submit" class="btn tarefas btn-primary"><i class="fa-solid fa-pen-ruler fa-2x"></i></button></a>
                    </div>
                @else
                    <div class="tabela__dados--botoes">
                        <a href="{{ url('/tarefas/editar/' .$i->id) }}"><button type="submit" class="btn tarefas btn-primary"><i class="fa-solid fa-pen-ruler fa-2x"></i></button></a>
                    </div>
                @endif
                <div class="tabela__dados--botoes">
                    <a href="{{ url('tarefas/concluir/' .$i->id) }}"><button type="submit" class="btn tarefas btn-success"><i class="fa-solid fa-check fa-3x"></i></button></a>
                </div>
                <div class="tabela__dados--botoes">
                    <button type="button" class="btn tarefas btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdropModal"><i class="fa-solid fa-rotate-left fa-3x"></i></button>
                </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</body>
<form action="/tarefas/retrabalho/{{$i->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade modal-lg" id="staticBackdropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-bg-dark ">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Retrabalho</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea name="refazer" id="refazer" cols="100" rows="7" placeholder="Escreva aqui o que precisa ser refeito"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Finalizar</button>
            </div>
            </div>
        </div>
    </div>
</form>
@endsection
