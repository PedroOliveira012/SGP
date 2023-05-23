@extends('index.index')

@section('conteudo')
<div class="topo">
    <h1>Chamados</h1>
    {{-- <div class="search-and-add">
        <form action="{{ url('/projeto/andamento') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control text-light" placeholder="Buscar por projetos...">
        </form>
        <a href="{{ url('/projeto/novo') }}"><button type="button" class="btn search-and-add__button"><i class="fa-solid fa-plus" aria-hidden="true"></i>  Adicionar</button></a>
    </div> --}}
</div>
<div class="painel">
    {{-- <div> isso é o botão de voltar, colocar no chamados mostra
        <a href="{{ url('/chamados/lista/') }}">
            <button class="btn voltar-tarefas">
                <i class="fa-solid fa-chevron-left voltar-icone"></i>
                Voltar
            </button>
        </a>
    </div> --}}
    {{-- <div> --}}
        <div>
            {{-- <form action="{{ url('diretoria/lista/' .$lista->id)}}" method="get" class="escolher-painel-diretoria"> --}}
                <select class="form-select select-func" name="escolher-status">
                    <option value="" selected disabled hidden>{{----}}</option>
                    <option value="Reclamação">Reclamação</option>
                    <option value="Sugestão">Sugestão</option>
                </select>
                <button type="submit" class="btn btn-primary botao-painel"><i class="fa-solid fa-filter"></i></button>
            {{-- </form> --}}
        </div>
    {{-- </div> --}}
</div>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr class="tabela__head">
                <th>Id</th>
                <th>Usuário</th>
                <th>Data e hora</th>
                <th class="tabela__head--esquerda">Tipo</th>
                <th>Assunto</th>
                <th>Status</th>
                {{-- <th class="tabela__head--esquerda">Status</th> --}}
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                @if ($i->status == 0 )
                    <tr>
                        <td>
                            <div class="tabela__dados tabela__dados--line centralizado"><?= $i->id?></a></div>
                        </td>
                        <td>
                            <div class="tabela__dados tabela__dados--line centralizado"><?= $i->nome?></div>
                        </td>
                        <td>
                            <div class="tabela__dados tabela__dados--line centralizado"><?= $i->data_e_hora?></div>
                        </td>
                        <td>
                            <div class="tabela__dados tabela__dados--line centralizadoe"><?= $i->tipo?></div>
                        </td>
                        <td>
                            <div class="tabela__dados tabela__dados--line centralizado"><?= $i->assunto?></div>
                        </td>
                        <td>
                            @if ($i->status == 0)
                                <div class="tabela__dados tabela__dados--line centralizado ">Pendente</div>
                            @else
                                <div class="tabela__dados tabela__dados--line centralizado">Finalizado</div>
                            @endif
                        </td>
                        @if (Auth::user()->cargo == 'Admin')
                            <td>
                                <div class="tabela__dados botoes centralizado">
                                    <div class="tabela__dados--botoes ">
                                        <a class="tabela__dados--link" href="{{ url('/projeto/mostra/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a>
                                    </div>
                                    @if (Auth::user()->cargo == 'Admin')
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropModal{{$i->id}}">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    @else
                                        <div class="tabela__dados--botoes">
                                            <a href="{{ url('/projeto/editar/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-ruler"></i></button></a>
                                        </div>
                                    @endif
                                    {{-- <div class="tabela__dados--botoes">
                                        <a href="{{ url('/projeto/editar/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-ruler"></i></button></a>
                                    </div> --}}
                                    {{-- <div class="tabela__dados--botoes">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropModal{{$i->id}}">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div> --}}
                                </div>
                            </td>
                        @endif
                    </tr>
                    <form action="{{ url('/chamados/concluir/' .$i->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal fade" id="staticBackdropModal{{$i->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Concluir chamado</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Deseja realmente concluir esse chamado?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Concluir</button>
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
