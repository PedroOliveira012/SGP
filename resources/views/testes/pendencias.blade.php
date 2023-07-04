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
    <h1>Pendencias do projeto tal</h1>
    {{-- <div class="search-and-add">
        <form action="{{ url('/projeto/andamento') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control text-light" placeholder="Buscar por projetos...">
        </form>
        <a href="{{ url('/projeto/novo') }}"><button type="button" class="btn search-and-add__button"><i class="fa-solid fa-plus" aria-hidden="true"></i>  Adicionar</button></a>
    </div> --}}
    <a href={{ url("/testes/info/". $lista[0]->id_projeto)}}>
        <button class="btn voltar-projeto">
            <i class="fa-solid fa-chevron-left voltar-icone"></i> Voltar
        </button>
    </a>
</div>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr class="tabela__head">
                <th>Envio da pendencia</th>
                <th>Inicio da pendencia</th>
                <th>Termino da pendencia</th>
                <th>Funcionário</th>
                <th>Descrição da pendencia</th>
                <th>Prazo</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                <tr>
                    <td>
                        <div class="tabela__dados tabela__dados--line numero_projeto centralizado"><?= Carbon\Carbon::parse($i->envio_tarefa)->isoFormat('DD/MM/YYYY HH:mm')?></a></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line centralizado cliente"><?= Carbon\Carbon::parse($i->inicio_tarefa)->isoFormat('DD/MM/YYYY HH:mm')?></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line centralizado unidade"><?= Carbon\Carbon::parse($i->termino_tarefa)->isoFormat('DD/MM/YYYY HH:mm')?></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line nome_projeto"><?= $i->funcionario?></div>
                    </td>
                    <td>
                        <div class="tabela__dados tabela__dados--line centralizado prazo"><?= $i->Notas?></div>
                    </td>
                    <td>
                        @if ($i->prazo)
                            <div class="tabela__dados tabela__dados--line obs"><?= Carbon\Carbon::parse($i->prazo)->isoFormat('DD/MM/YYYY HH:mm')?></div>
                        @else
                            <div class="tabela__dados tabela__dados--line obs">Sem prazo</div>
                        @endif
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
            <?php endforeach?>
        <tbody>
    </table>
</div>



@endsection
