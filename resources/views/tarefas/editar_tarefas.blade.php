@extends('index.index')

@section('conteudo')
<div class="topo">
    <h1 class="titulo">Editar Tarefa</h1>
</div>

@if ($errors->any())
<ul class=" container errors alert alert-danger">
    @foreach ($errors->all() as $error)
    <li class="error">{{$error}}</li>
    @endforeach
</ul>
@endif
{{-- <div class="filtro">
    <form action="{{ url('/tarefas/editar/' .$projeto->id) }}" method="get">
        @csrf
        <div class="row">
            <div class="col-md-12 form-group mb-3 filtro-div">
                <label for="" class="col-form-label" >Tipo:</label>
                <select name="tipo" class="form-select text-bg-dark" onchange="escolher_tipo()"  id="tipo">
                    <option value="" class="opcao_padrao" selected disabled hidden>{{$tipo}}</option>
                    <option value="Armário">Armário</option>
                    <option value="Quadro">Quadro</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group mb-3 filtro-div">
                <label for="" class="col-form-label">Área:</label>
                <select name="area" class="form-select text-bg-dark" id="area" onchange="escolher_area()"  disabled>
                    <option value="" class="opcao_padrao" selected disabled hidden>{{$area}}</option>
                    <option value="Estrutura">Estrutura</option>
                    <option value="Oficina">Oficina</option>
                    <option value="Produção">Produção</option>
                    <option value="Almoxarifado">Almoxarifado</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group mb-3 filtro-div">
                <label for="" class="col-form-label">Processo:</label>
                <select name="processo" class="form-select text-bg-dark" id="processo"  disabled>
                    <option value="" class="opcao_padrao" selected disabled hidden>{{$processo}}</option>
                    <option value="Pré-montagem" id="Pre">Pré-montagem</option>
                    <option value="Inicio de montagem" id="Inicio" disabled hidden>Inicio de montagem</option>
                    <option value="Fim de montagem" id="Final" disabled hidden>Fim de montagem</option>
                    <option value="Placa de montagem" id="Placa" disabled hidden>Placa de montagem</option>
                    <option value="Teto" id="teto" disabled hidden>Teto</option>
                    <option value="Flange" id="flange" disabled hidden>Flange</option>
                    <option value="Porta" id="Porta" disabled hidden>Portas</option>
                    <option value="Fabricação" id="Fabricacao" disabled hidden>Fabricação</option>
                    <option value="Instalação" id="Instalacao" disabled hidden>Instalação</option>
                    <option value="Pendencias" id="Pendencia" disabled hidden>Pendências</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group mb-3 filtrar">
                <button type="submit" class="btn btn-primary" onclick="limpar_input()"><i class="fa-solid fa-filter"> Filtrar</i></button>
            </div>
        </div>
    </form>
</div> --}}

<div class="quadro">
    <form action="{{ url('/tarefas/atualizar/' .$tarefa->id) }}" class="mb-3" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        <input type="hidden" name="id_projeto" value="{{$tarefa->id_projeto}}">

        <div class="row">
            <div class="col-md-12 form-group mb-3 quadro-div">
                <label for="" class="col-form-label">Tarefa:</label>
                <select name="tarefa" class="form-select text-bg-dark" value="{{ old('tarefa') }}">
                    <option value="" selected disabled hidden>{{$tarefa->tarefa}}</option>
                    @foreach ($proc as $p)
                        <option value="{{$p->titulo}}"><?=$p->titulo?></option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group mb-3 quadro-div">
                <label for="" class="col-form-label">Funcionário:</label>
                <select name="funcionario" class="form-select text-bg-dark" value="{{ old('funcionario') }}">
                    <option value="" selected disabled hidden>{{$tarefa->funcionario}}</option>
                    @foreach ($func as $f)
                        <option value="{{$f->name}}"><?=$f->name?></option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group mb-3 quadro-div">
            <label for="message" class="col-form-label">Notas / Observações:</label>
            <textarea class="form-control text-bg-dark" name="obs" cols="30" rows="4" value="{{ old('obs') }}">{{$tarefa->Notas}}</textarea>
            </div>
        </div>
        <div>
            <p>
                * É necessário alterar os valores no campo Tarefa e Funcionário
            </p>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <button type="submit" class="btn btn-success adicionar"><i class="fa-solid fa-clipboard-check">  Finalizar</i></button>
            </div>
        </div>
    </form>
</div>
{{-- @endforeach --}}

@endsection
