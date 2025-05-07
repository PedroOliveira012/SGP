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
    <h1>Projetos liberados para a fábrica</h1>
    <div class="search-and-add">
        <form action="{{ url('/projeto/liberados') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por projetos...">
        </form>
        <a href="{{ url('/projeto/novo') }}">
            <button type="button" class="btn search-and-add__button">
                <i class="fa-solid fa-plus" aria-hidden="true"></i>
                <span>Adicionar</span>
            </button>
        </a>
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
                {{-- <th>Observações</th> --}}
                <th>Responsável</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                @if ($i->liberado == 1)
                <tr class="tabela__dados">
                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->num_projeto?></p></a></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->cliente?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->unidade?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line"><p><?= $i->nome_projeto?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line centralizado"><p>R$ <?=number_format($i->valor_contratado,2,',','.')?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->prazo_entrega?> dias</p></div>
                    </td>
                    {{-- <td>
                        <div class="tabela__dados--line"><p><?= $i->observacoes?></p></div>
                    </td> --}}

                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->responsavel?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados botoes centralizado">
                            <div class="tabela__dados--botoes ">
                                <a class="tabela__dados--link" href="{{ url('/projeto/mostra/' .$i->id) }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa-solid fa-list"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="tabela__dados--botoes">
                                <a href="{{ url('/projeto/editar/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-ruler"></i></button></a>
                            </div>
                            <div class="tabela__dados--botoes">
                                {{-- <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja mesmo excluir este projeto?')"><i class="fa-regular fa-trash-can"></i></button> --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropModal{{$i->id}}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <form action="{{ url('/projeto/remove/' .$i->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal fade" id="staticBackdropModal{{$i->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Deletar projeto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">Deseja realmente excluir esse projeto?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endif
            <?php endforeach?>
        </tbody>
    </table>
</div>
@endsection
