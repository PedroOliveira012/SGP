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
    <h1>Projetos encerrados</h1>
    <div class="search-and-add">
        <form action="{{ url('/projeto/encerrados') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por projetos...">
        </form>
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
                @if ($i->status == "Finalizado")
                <tr class="align-middle">
                    <td>
                        <p><?= $i->num_projeto?></p>
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
                        <div class="tabela__dados--botoes">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropModal{{$i->id}}">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </button>
                            </form>
                        </div>
                        <div class="tabela__dados--botoes ">
                            <a class="tabela__dados--link" href="{{ url('/tarefas/lista/' .$i->id) }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-bars"></i>
                                </button>
                            </a>
                        </div>
                        <div class="tabela__dados--botoes ">
                            <a class="tabela__dados--link" href="{{ url('/projeto/export/' .$i->id) }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-download"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
                <form action="{{ url('/projeto/devolverTeste/' .$i->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal fade" id="staticBackdropModal{{$i->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Mover projeto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">Deseja mesmo mover este projeto?</div>
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


