@extends('index.index')

@section('conteudo')
<div class="topo">
    <h1>Chamados</h1>
</div>

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<div class="painel-status">
    @if (Auth::user()->cargo == 'Admin')
    <div class="filtro-status">
        <form action="{{ url('chamados/lista/')}}" method="get" class="escolher-status-chamados">
            <select class="form-select select-status" name="escolher-status">
                <option value="" selected disabled hidden>Selecione uma opção</option>
                <option value="Reclamação">Reclamação</option>
                <option value="Sugestão">Sugestão</option>
            </select>
            <button type="submit" class="btn btn-primary botao-painel"><i class="fa-solid fa-filter"></i></button>
        </form>
    </div>

    @else
        <a href="{{ url('/chamados/novo') }}">
            <button type="button" class="btn search-and-add__button">
                <i class="fa-solid fa-plus" aria-hidden="true"></i>  Adicionar
            </button>
        </a>
    @endif
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
                @if (Auth::user()->cargo == 'Admin')
                    <th></th>
                @endif
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
                            <div class="tabela__dados tabela__dados--line centralizado"><?= Carbon\Carbon::parse($i->data_e_hora)->isoFormat('DD/MM/YYYY HH:mm')?></div>
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
                                        <a class="tabela__dados--link" href="{{ url('/chamados/mostra/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a>
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
