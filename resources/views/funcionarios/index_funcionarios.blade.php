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
    <div class="w-75 m-auto d-flex justify-content-between align-items-center my-3">
        <h1>Projetos</h1>
        <div class="search-bar">
            <input type="text" id="search" class="form-control" placeholder="Buscar por projetos...">
        </div>
    </div>
</div>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr>
                <th>N° de Projeto</th>
                <th>Cliente</th>
                <th>Unidade</th>
                <th>Nome do Projeto</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                @if ($i->status == "Liberado")
                <tr id="{{$i->num_projeto}}">
                    <td>
                        <p>{{$i->num_projeto}}</p>
                    </td>
                    <td>
                        <p><?= $i->cliente?></p>
                    </td>
                    <td>
                        <p><?= $i->unidade?></p>
                    </td>
                    <td>
                        <p><?= $i->nome_projeto?></p>
                    </td>
                    <td>
                        <div>
                            <div class="tabela__dados tabela__dados--botoes">
                                <a href="{{ url('/funcionarios/lista/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-solid fa-bars"></i></button></a>
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
