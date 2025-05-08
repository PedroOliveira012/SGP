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
    <h1>Projetos em fase de teste</h1>
    <div class="search-and-add">
        <form action="{{ url('/projeto/encerrados') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por projetos...">
        </form>
    </div>
</div>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr class="">
                <th>N° de Projeto</th>
                <th>Cliente</th>
                <th>Unidade</th>
                <th>Nome do Projeto</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                @if ($i->fase_teste == 1)
                <tr class="tabela__dados">
                    <td>
                        <div class="tabela__dados--line"><?= $i->num_projeto?></a></div>
                    </td>
                    <td class="tabela__dados centralizado">
                        <div class="tabela__dados--line"><?= $i->cliente?></div>
                    </td>
                    <td class="tabela__dados centralizado">
                        <div class="tabela__dados--line"><?= $i->unidade?></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line"><?= $i->nome_projeto?></div>
                    </td>
                    <td>
                        <div class="tabela__dados--botoes">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropDevolver{{$i->id}}">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                        </div>
                        <div class="tabela__dados--botoes">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropConcluir{{$i->id}}">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <form action="{{ url('/projeto/concluir/' .$i->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal fade" id="staticBackdropConcluir{{$i->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Concluir projeto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">Deseja mesmo concluir este projeto?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Concluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form action="{{ url('/projeto/devolverLiberado/' .$i->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal fade" id="staticBackdropDevolver{{$i->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Mover projeto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">Deseja realmente mover esse projeto?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Mover</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endif
            <?php endforeach?>
        <tbody>
    </table>
</div>



@endsection
