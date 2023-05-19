@extends('index.index')

@section('conteudo')
<div class="topo">
    <h1>Controle de projetos</h1>
    <div class="search-and-add">
        <form action="{{ url('/projeto/andamento') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control text-light" placeholder="Buscar por projetos...">
        </form>
        <a href="{{ url('/projeto/novo') }}"><button type="button" class="btn search-and-add__button"><i class="fa-solid fa-plus" aria-hidden="true"></i>  Adicionar</button></a>
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
                <th>Valor Contratado</th>
                <th>Prazo de Entrega</th>
                <th class="tabela__head--esquerda">Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                @if ($i->finalizado == 0 && $i->fase_teste == 0 && $i->liberado == 0)
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
                            <div class="tabela__dados--botoes ">
                                <a class="tabela__dados--link" href="{{ url('/projeto/mostra/' .$i->id) }}"><button type="submit" class="btn btn-primary">{{--<i class="fa-solid fa-bars"></i>--}}<i class="fa-solid fa-list"></i></button></a>
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
        <tbody>
    </table>
</div>



@endsection
