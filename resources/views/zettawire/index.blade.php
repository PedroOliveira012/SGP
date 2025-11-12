@extends('index.index')

@section('conteudo')

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<div class="topo-zettawire">
    <h1>Zettawire - Projetos</h1>
    <div class="search-and-add">
        <form action="{{ url('/zettawire/index') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por projetos...">
        </form>
    </div>
</div>
<div>
    <table class="table table-dark table-hover tabela align-middle">
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
                @if ($i->status=='Liberado')
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
                        <div>
                            <a class="m-1" href="{{ url('/zettawire/roteamento/' .$i->id. '/E01') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </a>
                            <a class="m-1">
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropModal{{$i->id}}">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
                <form action="{{ url('/zettawire/finish-project/' .$i->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal fade" id="staticBackdropModal{{$i->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Concluir projeto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Deseja realmente consluir esse projeto?</p>
                                    <p class="text-danger">ISSO EXCLUIRÁ TODOS OS CABOS!</p>
                                </div>
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
        </tbody>
    </table>
</div>
@endsection
