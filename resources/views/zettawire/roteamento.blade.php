@extends('index.index')

@section('conteudo')

<div class="topo">
    <div class="projetos__titulo">
        <h1><?=$projeto->num_projeto?> - <?=$projeto->nome_projeto?></h1>
    </div>
    <div class="search-and-add">
        <!-- <form action="{{ url('/funcionarios/index') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por projetos...">
        </form> -->
    </div>
</div>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr class="tabela__head">
                <th>Anilha</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Seção transversal</th>
                <th>Cor</th>
                <th>Chicote</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($cabos as $cabo): ?>
                <tr class="align-middle text-center">
                    <td>
                        <p><?= $cabo->tag?></p>
                    </td>
                    <td>
                        <p><?= $cabo->origin?></p>
                    </td>
                    <td>
                        <p><?= $cabo->target?></p>
                    </td>
                    <td>
                        <p><?= $cabo->cable_cross_section?></p>
                    </td>
                    <td>
                        <p><?= $cabo->color?></p>
                    </td>
                    <td>
                        <p><?= $cabo->wire_harness?></p>
                    </td>
                    <td>
                        <!-- <div class="tabela__dados botoes centralizado">
                            <div class="tabela__dados--botoes ">
                                <a class="tabela__dados--link" href="{{ url('/projeto/mostra/' .$cabo->id) }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa-solid fa-list"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="tabela__dados--botoes">
                                {{-- <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja mesmo excluir este projeto?')"><i class="fa-regular fa-trash-can"></i></button> --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropModal{{$cabo->id}}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </div> -->
                    </td>
                </tr>
            <?php endforeach?>
        <tbody>
    </table>
</div>
@endsection
