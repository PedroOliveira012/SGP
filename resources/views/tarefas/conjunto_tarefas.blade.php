@extends('index.index')

@section('conteudo')
<div class="topo">
    <h1 class="titulo">Novo Conjunto</h1>
</div>

@if ($errors->any())
<ul class=" container errors alert alert-danger">
    @foreach ($errors->all() as $error)
    <li class="error">{{$error}}</li>
    @endforeach
</ul>
@endif

<div class="filtro">
    <form action="{{ url('/tarefas/adiciona_conjunto') }}" method="post">
        @csrf
        <input type="hidden" name="id_projeto" value="{{$projeto}}">
        <div class="row">
            <div class="col-md-12 form-group mb-3 filtro-div">
                <label for="" class="col-form-label">Chaparia:</label>
                <select name="chaparia" class="form-select text-bg-dark" id="chaparia">
                    <option value="" class="opcao_padrao" selected disabled hidden>Selecione uma chaparia</option>
                    <option value="Armário" id="Armario">Armário</option>
                    <option value="Quadro" id="Quadro">Quadro</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group mb-3 filtro-div">
                <label for="" class="col-form-label">Área:</label>
                <select name="conjunto" class="form-select text-bg-dark" id="processo">
                    <option value="" class="opcao_padrao" selected disabled hidden>Selecione uma área</option>
                    <option value="Inicio de montagem" id="InicioMontagem">Início de Montagem</option>
                    <option value="Fim de montagem" id="InicioMontagem">Fim de Montagem</option>
                    <option value="Placa de montagem" id="Placa">Placa de montagem</option>
                    <option value="Porta" id="Portas">Porta</option>
                    <option value="Fabricação" id="Fabricacao">Fabricação</option>
                    <option value="Instalação" id="Instalacao">Instalação</option>
                    {{-- <option value="Pendência" id="Pendencia">Pendência</option> --}}
                    <option value="Pré-montagem" id="Pre">Pré-montagem</option>
                </select>
            </div>
        </div>

        @foreach ($func as $f)
            <input type="checkbox" class="form-check-input" name="funcionarios[]" value="{{ $f->name }}"> {{ $f->name }}<br>
        @endforeach

        <div class="row">
            <label for="" class="col-form-label">A tarefa precisa de mais de uma pessoa?</label>
            <div class="col-md-3 form-group mb-3">
                <input class="form-check-input" type="radio" name="tarefaConjunta" id="sim" value="1">
                <label class="form-check-label" for="sim">Sim</label>
            </div>
            <div class="col-md-3 form-group mb-3">
                <input class="form-check-input" type="radio" name="tarefaConjunta" id="nao" value="0">
                <label class="form-check-label" for="nao">Não</label>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 form-group">
                <button type="submit" class="btn btn-success adicionar"><i class="fa-solid fa-clipboard-check">  Finalizar</i></button>
            </div>
        </div>
    </form>
</div>


@endsection
