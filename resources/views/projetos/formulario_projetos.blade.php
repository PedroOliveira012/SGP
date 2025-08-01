@extends('index.index')

@section('conteudo')

<div class="topo">
    <h1 class="titulo">Novo Projeto</h1>
</div>

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<div class="quadro">
    <form action="{{ url('/projeto/adiciona') }}" class="mb-5" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Número do projeto:</label>
                <input type="text" class="form-control" name="numero_projeto" value="{{ old('numero_projeto') }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Cliente:</label>
                <input type="text" class="form-control" name="cliente" value="{{ old('cliente') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Cidade:</label>
                <input type="text" class="form-control" name="cidade" value="{{ old('cidade') }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">UF:</label>
                <input type="text" class="form-control" name="UF" value="{{ old('UF') }}">
            </div>
        </div>
        <div class="col-md-12 form-group mb-3">
            <label for="" class="col-form-label">Nome do projeto:</label>
            <input type="text" class="form-control" name="nome_projeto" value="{{ old('nome_projeto') }}">
        </div>
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Analista:</label>
                <input type="text" class="form-control" name="analista" value="{{ old('analista') }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Projetista:</label>
                <input type="text" class="form-control" name="projetista" value="{{ old('projetista') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Fechamento do projeto em:</label>
                <input type="date" class="form-control" name="data_fechamento" value="{{ old('data_fechamento') }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Data de entrega:</label>
                <input type="date" class="form-control" name="data_entrega" value="{{ old('data_entrega') }}">
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
                <label for="" class="col-form-label">Quantos painéis serão?</label>
                <input type="text" class="form-control" name="paineis" value="{{ old('paineis') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <button type="submit" class="btn btn-primary btn-block adicionar">Finalizar</button>
            </div>
        </div>
    </form>
</div>
@endsection
