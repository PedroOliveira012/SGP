@extends('index.index')

@section('conteudo')
<div class="topo">
    <h1 class="titulo">Nova Tarefa</h1>
</div>

@if ($errors->any())
<ul class=" container errors alert alert-danger">
    @foreach ($errors->all() as $error)
    <li class="error">{{$error}}</li>
    @endforeach
</ul>
@endif

<div class="filtro">
    <form action="{{ url('/tarefas/novo/'. $projeto) }}" method="get">
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
                    <option value="Teste" id="Teste" disabled hidden>Teste</option>
                </select>
            </div>
        </div>

        <div class="row filtro_e_combinacao">
            <div class="col-md-12 form-group mb-3 filtrar">
                <button type="submit" class="btn btn-primary" onclick="limpar_input_tarefa()"><i class="fa-solid fa-filter"> Filtrar</i></button>
            </div>
        </div>
    </form>
</div>
<div class="quadro">
    <form action="{{ url('/tarefa/adiciona') }}" class="mb-3" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        <input type="hidden" name="id_projeto" value="{{$projeto}}">

        <div class="row">
            <div class="col-md-12 form-group mb-3 quadro-div">
                <label for="" class="col-form-label">Tarefa:</label>
                <select name="tarefa" class="form-select text-bg-dark" value="{{ old('tarefa') }}">
                    <option value="" selected disabled hidden>--Selecione uma tarefa--</option>
                    @foreach ($tarefa as $t)
                        <option value="{{$t->titulo}}"><?=$t->titulo?></option>
                    @endforeach
                    <option value="Pendencia">Pendencia</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group mb-3 quadro-div">
                <label for="" class="col-form-label">Funcionário:</label>
                <select name="funcionario" class="form-select text-bg-dark" value="{{ old('funcionario') }}">
                    <option value="" selected disabled hidden>--Selecione um funcionario--</option>
                    @foreach ($func as $f)
                        <option value="{{$f->name}}"><?=$f->name?></option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group mb-3 quadro-div">
                <label for="" class="col-form-label">Selecione o painel:</label>
                <select name="painel" class="form-select text-bg-dark">
                    <option value="" selected disabled hidden>--Selecione um painel--</option>
                    @foreach ($opcoes as $opcao)
                        <option value="{{ $opcao }}">{{ $opcao }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <label for="" class="col-form-label">Gostaria de adicionar um prazo na tarefa?</label>
            <div class="col-md-3 form-group mb-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="sim_prazo" onclick="Habilita_prazo()">
                <label class="form-check-label" for="sim">Sim</label>
            </div>
            <div class="col-md-3 form-group mb-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="nao_prazo" onclick="Habilita_prazo()">
                <label class="form-check-label" for="nao">Não</label>
            </div>
        </div>

        <div class="row" id="prazo" hidden>
            <div class="col-md-12  form-group mb-3">
                <label for="" class="col-form-label">Prazo:</label>
                <input type="date" class="form-control" name="prazo">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group mb-3 quadro-div">
            <label for="message" class="col-form-label">Notas / Observações:</label>
            <textarea class="form-control text-bg-dark" name="obs" cols="30" rows="4" value="{{ old('obs') }}"></textarea>
            </div>
        </div>

        <input type="hidden" name="status" id="" value="pendente">

        <div class="row">
            <div class="col-md-12 form-group">
                <button type="submit" class="btn btn-success adicionar"><i class="fa-solid fa-clipboard-check">  Finalizar</i></button>
            </div>
        </div>
    </form>
</div>

@endsection
