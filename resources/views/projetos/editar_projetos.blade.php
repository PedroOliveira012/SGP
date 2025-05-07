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
    <h1 class="titulo">Novo Projeto</h1>
</div>
<div class="quadro">
    <form action="{{ url('/projeto/atualizarProjeto/' .$projeto->id) }}" class="mb-5" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Número do projeto:</label>
                <input type="text" class="form-control" name="numero_projeto" value="{{ $projeto->num_projeto }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Cliente:</label>
                <input type="text" class="form-control" name="cliente" value="{{ $projeto->cliente }}">
            </div>
        </div>
        <div class="col-md-12 form-group mb-3">
            <label for="" class="col-form-label">Unidade:</label>
            <input type="text" class="form-control" name="unidade" value="{{ $projeto->unidade }}">
        </div>
        <div class="col-md-12 form-group mb-3">
            <label for="" class="col-form-label">Nome do projeto:</label>
            <input type="text" class="form-control" name="nome_projeto" value="{{ $projeto->nome_projeto }}">
        </div>
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Analista:</label>
                <input type="text" class="form-control" name="analista" value="{{ $projeto->analista }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Projetista:</label>
                <input type="text" class="form-control" name="projetista" value="{{ $projeto->projetista }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Responsável técnico (cliente):</label>
                <input type="text" class="form-control" name="responsavel" value="{{ $projeto->Responsavel_tecnico }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Valor contratado:</label>
                <input type="text" class="form-control" name="valor" step="0,01" lang="pt-BR" value="{{ $projeto->valor_contratado }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Fechamento do projeto em:</label>
                <input type="date" class="form-control" name="data_fechamento" value="{{ \Carbon\Carbon::parse($projeto->data_fechamento)->format('Y-m-d') }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Prazo de entrega (dias):</label>
                <input type="text" class="form-control" name="prazo" value="{{ $projeto->prazo_entrega }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <label for="message" class="col-form-label">Definir responsável pelo projeto</label>
                <select class="form-select" name="responsavel_select">
                    <option value="{{ $projeto->responsavel }}" hidden selected>{{ $projeto->responsavel }}</option>
                    @foreach ($func as $f)
                        <option value="{{$f->name}}">{{$f->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <label for="">O projeto terá mais de um painel?</label>
            <div class="col-md-3 form-group mb-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="sim" onclick="Habilita_paineis()">
                <label class="form-check-label" for="sim">Sim</label>
            </div>
            <div class="col-md-3 form-group mb-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="nao" onclick="Habilita_paineis()">
                <label class="form-check-label" for="nao">Não</label>
            </div>
        </div>
        <div class="row" id="paineis" hidden>
            <div class="col-md-12  form-group mb-3">
                <label for="" class="col-form-label">Nome dos painéis</label>
                <textarea class="form-control" name="paineis" cols="30" rows="4" placeholder="E01; E02; E03; ..." value="{{ $projeto->paineis }}"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <label for="" class="col-form-label">Observações:</label>
                <textarea class="form-control" name="obs" cols="30" rows="4" value="{{ $projeto->observacoes }}"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <button type="submit" class="btn btn-success salvar"><i class="fa-regular fa-floppy-disk">  Salvar</i></button>
            </div>
        </div>
        <input type="hidden" name="nenhum" value="nenhum">
    </form>
</div>
@endsection
