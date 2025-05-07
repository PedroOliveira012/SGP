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


<div class="quadro">
    <form action="{{ url('/testes/pendencias/atualiza/'. $pendencia->id) }}" class="mb-3" method="POST">
        @method('PUT')
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        <input type="hidden" name="id_projeto" value="{{$projeto->id}}">

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
            <label for="" class="col-form-label">Gostaria de adicionar um prazo na pendencia?</label>
            <div class="col-md-3 form-group mb-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="sim" onclick="Habilita_prazo_pendencia()">
                <label class="form-check-label" for="sim">Sim</label>
            </div>
            <div class="col-md-3 form-group mb-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="nao" onclick="Habilita_prazo_pendencia()">
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
            <label for="message" class="col-form-label">Descrição da pendencia:</label>
            <textarea class="form-control text-bg-dark" name="desc" cols="30" rows="4" value="">{{ $pendencia->Notas }}</textarea>
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
