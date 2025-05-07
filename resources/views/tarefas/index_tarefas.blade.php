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
    <h1>Projetos</h1>
    <div class="search-and-add">
        <form action="{{ url('/tarefas/index') }}" method="GET" class="search-and-add__input">
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
                <th class="tabela__head--esquerda">Nome do Projeto</th>
                <th>Prazo de Entrega</th>
                {{-- <th class="tabela__head--esquerda">Observações</th> --}}
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                @if ($i->liberado == 1)
                <tr>
                    <td class="tabela__dados centralizado">
                        <div class="tabela__dados tabela__dados--line centralizado">{{$i->num_projeto}}</div>
                    </td>
                    <td class="tabela__dados centralizado">
                        <div class="tabela__dados tabela__dados--line centralizado"><?= $i->cliente?></div>
                    </td>
                    <td class="tabela__dados centralizado">
                        <div class="tabela__dados tabela__dados--line centralizado"><?= $i->unidade?></div>
                    </td>
                    <td class="tabela__dados--notificacao">
                        <div class=" tabela__dados tabela__dados--line"><?= $i->nome_projeto?></div>
                        {{-- @foreach ($tarefa as $t)
                            @if ($t->visualizado == 0)
                                <div class="notificacao"></div>
                            @endif
                        @endforeach --}}
                    </td>
                    <td>
                        <div class=" tabela__dados tabela__dados--line centralizado"><?= $i->prazo_entrega?> dias</div>
                    </td>
                    {{-- <td>
                        <div class=" tabela__dados tabela__dados--line"><?= $i->observacoes?></div>
                    </td> --}}
                    <td>
                        <div>
                            <div class="tabela__dados tabela__dados--botoes">
                                <a href="{{ url('/projeto/mostra/' .$i->id) }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="tabela__dados tabela__dados--botoes">
                                <a href="{{ url('/tarefas/lista/' .$i->id) }}">
                                    <button type="submit" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-bars"></i>
                                        {{-- <span class="alerta position-absolute top-0 start-100 translate-middle p-2 border border-light rounded-circle"></span> --}}
                                    </button>
                                </a>
                            </div>
                            <div class="tabela__dados tabela__dados--botoes">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropModal{{$i->id}}">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <form action="{{ url('/projeto/moverparateste/' .$i->id) }}" class="mb-5" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal fade" id="staticBackdropModal{{$i->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Mover projeto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">Deseja realmente mover esse projeto?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Mover</button>
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
