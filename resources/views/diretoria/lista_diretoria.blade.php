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
<div class="painel">
    <div>
        <a href="{{ url('/diretoria/index/') }}">
            <button class="btn voltar-tarefas">
                <i class="fa-solid fa-chevron-left voltar-icone"></i>
                Voltar
            </button>
        </a>
    </div>
    <div>
        <div>
            <form action="{{ url('diretoria/lista/' .$projeto->id)}}" method="get" class="escolher-painel-diretoria">
                <select class="form-select select-func" name="escolher-func">
                    <option value="" selected disabled hidden>{{$func_escolhido}}</option>
                    @foreach ($func as $f)
                        <option value="{{ $f->name }}">{{ $f->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary botao-painel"><i class="fa-solid fa-filter"></i></button>
            </form>
        </div>
        <div class="tempo_total">
            <p>Tempo total do projeto (até o momento): {{$projeto->tempo_total}}</p>
        </div>
    </div>
</div>
<div class="acompanhamento">
    <div class='pra_fazer'>
        <table class="table table-dark table-hover tabela">
            <thead>
                <tr class="tabela__head">
                    <th>Para fazer</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($para_fazer as $fazer): ?>
                    <tr class="tabela__dados">
                        <td class=".tarefas__dados--envio centralizado">
                            <div class="tabela__dados--envio centralizado">
                                {{$fazer->tarefa}}, {{$fazer->funcionario}}
                            </div>
                        </td>
                    </tr>
                <?php endforeach?>
            <tbody>
        </table>
    </div>

    <div class="fazendo">
        <table class="table table-dark table-hover tabela">
            <thead>
                <tr class="tabela__head">
                    <th>Fazendo</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($fazendo as $fazendo): ?>
                    <tr class="tabela__dados">
                        <td class="tarefas__dados--inicio centralizado">
                            <div class="tabela__dados--inicio centralizado">
                                {{$fazendo->tarefa}}, {{$fazendo->funcionario}}
                            </div>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>

    <div class="feito">
        <table class="table table-dark table-hover tabela">
            <thead>
                <tr class="tabela__head">
                    <th>Feito</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($feito as $feito): ?>
                    <tr class="tabela__dados">
                        <td class="tarefas__dados--termino centralizado">
                            <div class="tabela__dados--termino centralizado">
                               {{$feito->tarefa}}, {{$feito->funcionario}}
                            </div>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>
@endsection
