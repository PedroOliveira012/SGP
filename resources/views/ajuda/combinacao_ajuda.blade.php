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
    <h1>Combinação de filtro das tarefas</h1>
    <div class="search-and-add">
        <form action="{{ url('/ajuda/combinacao') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control text-light" placeholder="Buscar por tarefas...">
        </form>
    </div>
</div>

<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr class="tabela__head">
                <th>Título</th>
                <th>Tipo</th>
                <th>Área</th>
                <th>Processo</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($tarefa as $i): ?>
                @if ($i->titulo and $i->tipo and $i->processo)
                    <tr>
                        <td>
                            <div class="tabela__dados tabela__dados--line"><?= $i->titulo?></a></div>
                        </td>
                        <td>
                            <div class="tabela__dados tabela__dados--line centralizado"><?= $i->tipo?></div>
                        </td>
                        <td>
                            <div class="tabela__dados tabela__dados--line centralizado"><?= $i->area?></div>
                        </td>
                        <td>
                            <div class="tabela__dados tabela__dados--line centralizado"><?= $i->processo?></div>
                        </td>
                    </tr>
                @endif
            <?php endforeach?>
        <tbody>
    </table>
</div>
@endsection
