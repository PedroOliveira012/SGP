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
    <h1>Diretoria</h1>
    <div class="search-and-add">
        <form action="{{ url('/projeto/andamento') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por projetos...">
        </form>
    </div>
</div>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr class="tabela__head">
                <th>N° de Projeto</th>
                <th>Cliente</th>
                <th>Unidade</th>
                <th>Nome do Projeto</th>
                <th>Valor Contratado</th>
                <th>Prazo de Entrega</th>
                <th>Observações</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                @if($i->liberado == 1)
                <tr>
                    <td>
                        <div class="tabela__dados tabela__dados--line numero_projeto centralizado"><?= $i->num_projeto?></a></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line centralizado cliente"><?= $i->cliente?></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line centralizado unidade"><?= $i->unidade?></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line nome_projeto"><?= $i->nome_projeto?></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line centralizado valor">R$ <?=number_format($i->valor_contratado,2,',','.')?></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line centralizado prazo"><?= $i->prazo_entrega?> dias</div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line obs"><?= $i->observacoes?></div>
                    </td>
                    <td>
                        <div class="tabela__dados botoes centralizado">
                            <div class="tabela__dados--botoes">
                                <a href="{{ url('/diretoria/lista/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-solid fa-list"></i></button></a>
                            </div>
                            <div class="tabela__dados--botoes ">
                                <a class="tabela__dados--link" href="{{ url('/projeto/mostra/' .$i->id) }}"><button type="submit" class="btn btn-primary">{{--<i class="fa-solid fa-circle-info"></i>--}}<i class="fa-solid fa-circle-info"></i></button></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
            <?php endforeach?>
        <tbody>
    </table>
</div>
@endsection
