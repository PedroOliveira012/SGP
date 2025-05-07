@extends('index.index')
@section('conteudo')

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<div class="topo">
    <h1>Tarefas do Projeto {{$projeto->num_projeto}} - {{$projeto->nome_projeto}}</h1>
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
            <tr class="tabela__head">
                <th>Inicio da Tarefa</th>
                <th>Termino da Tarefa</th>
                <th></th>
                <th>Status da tarefa</th>
                <th>Funcionario</th>
                <th class="tabela__head--esquerda">Tarefa</th>
                <th>Notas / OBS</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                <tr class="tabela__dados">
                    <td class="inicio">
                        <div class="tabela__dados--line centralizado">
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
                    <td class="termino">
                        <div class="tabela__dados--line centralizado">
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
                        </div>
                    </td>
                    <td class="pausa">
                        <div class="tabela__dados--line centralizado">
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

                        </div>
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
                    <td class="funcionario">
                        <div class="tabela__dados--line centralizado"><?= $i->funcionario?></div>
                    </td>
                    <td class="tarefa">
                        <div class="nome-botao">
                            <div class="tabela__dados--line info-tarefa--nome"><?= $i->tarefa?></div>
                            <div class="info-tarefa--botao">
                        <a href="{{ url('/ajuda/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-regular fa-circle-question"></i></button></a>
                            </div>
                        </div>
                    </td>
                    <td class="notas">
                        <div class="tabela__dados--line centralizado"><?= $i->Notas?></div>
                    </td>
                </tr>
            <?php endforeach?>
        <tbody>
    </table>
</div>
@endsection
