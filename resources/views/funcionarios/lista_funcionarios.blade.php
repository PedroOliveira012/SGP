@extends('index.index')
@section('conteudo')

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<div>
    <h1 class="text-center">Tarefas do Projeto {{$projeto->num_projeto}} - {{$projeto->nome_projeto}}</h1>
</div>
<a href="{{ url('/funcionarios/index/') }}">
    <button class="btn voltar-funcionario">
        <i class="fa-solid fa-chevron-left voltar-icone"></i>
        Voltar
    </button>
</a>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr>
                <th>Inicio da Tarefa</th>
                <th>Termino da Tarefa</th>
                <th></th>
                <th>Status da tarefa</th>
                <th>Funcionario</th>
                <th>Tarefa</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                <tr>
                    <td>
                        <div>
                            @if ($i->inicio_tarefa)
                                <button type="submit" class="btn btn-success" disabled>Horario Gravado</button>
                            @else
                                <form action="{{ url('/funcionarios/inicio/' .$i->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Gravar horario</button>
                                </form>
                            @endif
                        </div>
                    </td>
                    <td>
                        <p>
                            @if ($i->inicio_tarefa == null)
                                <button type="submit" class="btn btn-success" disabled>Esperando inicio da tarefa</button>
                            @elseif ($i->termino_tarefa)
                                <button type="submit" class="btn btn-success" disabled>Horario gravado</button>
                            @else
                                <form action="{{ url('/funcionarios/termino/' .$i->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Gravar horario</button>
                                </form>
                            @endif
                        </p>
                    </td>
                    <td>
                        <p>
                            @if ($i->termino_tarefa || $i->inicio_tarefa == null)
                                <button type="submit" class="btn btn-warning" disabled><i class="fa-solid fa-pause"></i></button>
                            @else
                                @if ($i->inicio_pausa == null)
                                    <form action="{{ url('/funcionarios/inicioPausa/' .$i->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning"><i class="fa-solid fa-pause"></i></button>
                                    </form>
                                @else
                                    <form action="{{ url('/funcionarios/terminoPausa/' .$i->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning"><i class="fa-solid fa-play"></i></button>
                                    </form>
                                @endif
                            @endif
                        </p>
                    </td>
                    <td>
                        <div>
                            @if ($i->inicio_tarefa)
                                @if ($i->inicio_pausa)
                                    Tarefa pausada
                                @else
                                    Tarefa em andamento
                                @endif
                            @else
                                Tarefa não iniciada
                            @endif
                        </div>
                    </td>
                    <td>
                        <p><?= $i->funcionario?></p>
                    </td>
                    <td>
                        <p><?= $i->tarefa?></p>
                    </td>
                </tr>
            <?php endforeach?>
        <tbody>
    </table>
</div>
@endsection
