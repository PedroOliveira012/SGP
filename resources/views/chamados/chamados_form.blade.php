@extends('index.index')

@section('conteudo')

<div class="topo">
    <h1 class="titulo">Novo Chamado</h1>
</div>

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<div class="quadro">
    <form action="{{ url('/chamados/adiciona') }}" class="mb-5" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" value="{{ Auth::user()->name }}" disabled>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="" class="col-form-label">Data e hora:</label>
                <input type="text" class="form-control" name="tempo" value="{{ Carbon\Carbon::now()->subHour(3) }}" disabled>
            </div>
        </div>
        <div class="col-md-12 form-group mb-3">
            <label for="" class="col-form-label">Tipo:</label>
            {{-- <input type="text" class="form-control" name="tipo" value="{{ old('tipo') }}"> --}}

            <select name="tipo" class="form-select " id="tipo">
                <option value="" class="opcao_padrao" selected disabled hidden>Selecione uma opção</option>
                <option value="Reclamação" id="Reclamacao">Reclamação</option>
                <option value="Sugestão" id="Sugestao">Sugestão</option>
            </select>
        </div>
        <div class="col-md-12 form-group mb-3">
            <label for="" class="col-form-label">Assunto:</label>
            <input type="text" class="form-control" name="assunto" value="{{ old('assunto') }}">
        </div>
        <div class="row">

        </div>
        <div class="row" id="conteudo">
            <div class="col-md-12  form-group mb-3">
                <label for="" class="col-form-label"></label>
                <textarea class="form-control" name="conteudo" cols="51" rows="5" placeholder="Escreva aqui a sua requisição (Máx de 255 caracteres)" value="{{ old('conteudo') }}"></textarea>
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
