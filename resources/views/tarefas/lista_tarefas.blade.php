@extends('index.index')

@section('conteudo')

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<div class="topo my-4">
    <h1 class="text-center">Tarefas do Projeto {{$projeto->num_projeto}} - {{$projeto->nome_projeto}}</h1>
</div>
<div class="painel">
    <div class="filtros">
        <div class="div-paineis">
            <form action="{{ url('tarefas/lista/' .$projeto->id)}}" method="get" class="escolher-painel">
                <select class="form-select text-bg-dark select-painel " name="escolher-painel">
                    <option value="" selected hidden>{{$painel}}</option>
                    @foreach ($opcoes as $opcao)
                    <option value="{{ $opcao }}">{{ $opcao }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary botao-painel"><i class="fa-solid fa-filter"></i></button>
            </form>
        </div>
        <div class="div-status d-flex">
            <div class="btn-group add me-3">
                <a href="{{ url('/tarefas/conjunto/' .$projeto->id) }}">
                    <button type="button" class="btn add_group">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                        Tarefa
                    </button>
                </a>
            </div>
            <form action="{{ url('tarefas/lista/' .$projeto->id)}}" method="GET" class="escolher-status">
                <select class="form-select text-bg-dark select-status" name="escolher-status">
                    <option value="" selected disabled hidden>--Status da tarefa--</option>
                    <option value="concluido">Concluído</option>
                    <option value="aguardo">Aguardando revisão</option>
                    <option value="andamento">Andamento</option>
                    <option value="pendente">Pendente</option>
                    <option value="retrabalho">Retrabalho</option>
                    <option value="pendencia">Pendencias</option>
                </select>
                <button type="submit" class="btn btn-primary botao-status"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
</div>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr class="">
                <th>Inicio da Tarefa</th>
                <th>Termino da Tarefa</th>
                <th>Funcionario</th>
                <th>Tarefa</th>
                <th>Prazo</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($filtro as $i): ?>
                <tr class="tabela__dados">
                    <td class="tarefas__dados--inicio centralizado">
                        <div class="tabela__dados--inicio centralizado">
                            @if ($i->inicio_tarefa)
                                {{Carbon\Carbon::parse($i->inicio_tarefa)->isoFormat('DD/MM/YY HH:mm')}}
                            @else
                                Não iniciado
                            @endif
                        </div>
                    </td>
                    <td class="tarefas__dados--termino centralizado">
                        <div class="tabela__dados--termino centralizado">
                            @if ($i->termino_tarefa)
                                {{Carbon\Carbon::parse($i->termino_tarefa)->isoFormat('DD/MM/YY HH:mm')}}
                            @else
                                Não finalizado
                            @endif
                        </div>
                    </td>
                    <td class="tarefas__dados--funcionario centralizado">
                        <div class="tabela__dados--funcionario centralizado"><?= $i->funcionario?></div>
                    </td>
                    <td class="tarefas__dados--tarefa centralizado">
                        <div class="tabela__dados--tarefa centralizado"><?= $i->tarefa?></div>
                    </td>
                    <td>
                        @if ($i->prazo)
                            {{-- <div class="tabela__dados--funcionario centralizado">{{Carbon\Carbon::parse($i->prazo)->isoFormat('DD/MM/YYYY')}}</div> --}}
                            @if (Carbon\Carbon::today()->diffInDays($i->prazo) <= 0)
                                <div class="tabela__dados--funcionario centralizado data-vermelha">{{Carbon\Carbon::parse($i->prazo)->isoFormat('DD/MM/YYYY')}}</div>
                            @elseif (Carbon\Carbon::today()->diffInDays($i->prazo) <= 3 && today()->diffInDays($i->prazo) > 0)
                                <div class="tabela__dados--funcionario centralizado data-laranja">{{Carbon\Carbon::parse($i->prazo)->isoFormat('DD/MM/YYYY')}}</div>
                            @elseif (Carbon\Carbon::today()->diffInDays($i->prazo) <= 7 && today()->diffInDays($i->prazo) > 0)
                                <div class="tabela__dados--funcionario centralizado data-amarela">{{Carbon\Carbon::parse($i->prazo)->isoFormat('DD/MM/YYYY')}}</div>
                            @else
                                <div class="tabela__dados--funcionario centralizado data-verde">{{Carbon\Carbon::parse($i->prazo)->isoFormat('DD/MM/YYYY')}}</div>
                            @endif
                            <!-- <?=Carbon\Carbon::today()->diffInDays($i->prazo)?> -->
                        @else
                            <div class="tabela__dados--funcionario centralizado">Sem prazo definido</div>
                        @endif
                    </td>
                    <td class="tarefas__dados--botoes centralizado">
                        <div>
                            <div class="tabela__dados--botoes centralizado">
                                <a href="{{ url('/tarefas/mostra/' .$i->id) }}">
                                    <button type="submit" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-eye"></i>
                                        @if ($i->termino_tarefa && $i->visualizado == 0)
                                            <span class="alerta position-absolute top-0 start-100 translate-middle p-2 border-light rounded-circle"></span>
                                        @endif
                                    </button>
                                </a>
                            </div>
                            <div class="tabela__dados--botoes centralizado">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$i->id}}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach?>
        <tbody>
    </table>
</div>
@foreach ($filtro as $i)
    <form action="{{ url('/tarefas/remove/' .$i->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="staticBackdrop{{$i->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Deletar tarefa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Deseja mesmo excluir esta tarefa?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endforeach

@endsection
