@extends('index.index')

@section('conteudo')
<div class="topo">
    <h1 class="titulo">Nova tarefa</h1>
</div>

@if ($errors->any())
<ul class=" container errors alert alert-danger">
    @foreach ($errors->all() as $error)
    <li class="error">{{$error}}</li>
    @endforeach
</ul>
@endif

<div class="container">
    <section>
        <div class="tabs tabs-style-topline">
            <nav>
                <ul>
                    <li><a href="#section-topline-1"><span>Tarefa</span></a></li>
                    <li><a href="#section-topline-2"><span>Funcionários</span></a></li>
                    <li><a href="#section-topline-3"><span>Painel</span></a></li>
                    <li><a href="#section-topline-4"><span>Extra</span></a></li>
                    <!-- <li><a href="#section-topline-5"><span></span></a></li> -->
                </ul>
            </nav>
            <div class="content-wrap">
                <!-- Tarefa -->
                <section id="section-topline-1">
                    <input type="hidden" name="id_projeto" value="{{$projeto}}">
                    <div class="formulario-tarefa">
                        <div class="filtro-tarefas">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3 filtro-div">
                                    <label for="" class="col-form-label" >Tipo:</label>
                                    <select name="tipo" class="form-select text-bg-dark" onchange="escolher_tipo()" id="tipo">
                                        <option value="" class="opcao_padrao" selected disabled hidden></option>
                                        <option value="Armário">Armário</option>
                                        <option value="Quadro">Quadro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group mb-3 filtro-div">
                                    <label for="" class="col-form-label">Área:</label>
                                    <select name="area" class="form-select text-bg-dark" id="area" onchange="escolher_area()"  disabled>
                                        <option value="" class="opcao_padrao" selected disabled hidden></option>
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
                                        <option value="" class="opcao_padrao" selected disabled hidden></option>
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
                        </div>
                        <div class="resultado-tarefas">
                            
                        </div>
                    </div>
                </section>
                <!-- funcionario -->
                <section id="section-topline-2">
                    <div class="funcionarios custom-sidebar">
                        <div class="grupo-funcionarios row row-cols-2">
                            @foreach ($func as $f)
                                <label class="col-md-6 p-3 col-item func-span">
                                    <input type="checkbox" class="input" name="funcionarios[]" value="{{ $f->name }}"> {{ $f->name }}
                                    <span class="custom-checkbox func-checkbox"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- Painel -->
                <section id="section-topline-3">
                    <div class="panel-board custom-sidebar">
                        @foreach ($opcoes as $opcao)
                            <div class="panel-card">
                                <span>
                                    <i class="fa-solid fa-toilet-portable fa-2xl" style="color: #ffffff;"></i>
                                </span>
                                <span>{{ $opcao }}</span>
                                <label>
                                    <input class="input" type="checkbox" />
                                    <span class="custom-checkbox"></span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </section>
                <!-- Extra -->
                <section id="section-topline-4">
                    <div class="extra-board d-flex flex-column justify-content-between">
                        <input type="hidden" name="id_projeto" value="{{$projeto}}">
                        <div class="d-flex align-items-center justify-content-evenly w-100">
                            <div>
                                <div class="">
                                    <label class="col-form-label">A tarefa precisa de mais de uma pessoa?</label>
                                    <div class="yes-no-options">
                                        <div class="radio-button-container d-flex">
                                            <!-- <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio1" name="radio-group">
                                                <label class="radio-button__label" for="radio1">
                                                    <span class="radio-button__custom"></span>
                                                    Sim
                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio2" name="radio-group">
                                                <label class="radio-button__label" for="radio2">
                                                    <span class="radio-button__custom"></span>
                                                    Não
                                                </label>
                                            </div> --> 
                                            <label class="radio-button">
                                                <input type="radio" name="radio-group" value="option1">
                                                <span class="radio"></span>
                                                Sim
                                            </label>

                                            <label class="radio-button">
                                                <input type="radio" name="radio-group" value="option2">
                                                <span class="radio"></span>
                                                Não
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div>
                                    <label class="col-form-label">Gostaria de adicionar um prazo na tarefa?</label>
                                    <div class="yes-no-options">
                                        <div class="radio-button-container d-flex">
                                            <!-- <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio1" name="radio-group">
                                                <label class="radio-button__label" for="radio1">
                                                    <span class="radio-button__custom"></span>
                                                    Sim
                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio2" name="radio-group">
                                                <label class="radio-button__label" for="radio2">
                                                    <span class="radio-button__custom"></span>
                                                    Não
                                                </label>
                                            </div> --> 
                                            <label class="radio-button">
                                                <input type="radio" name="example-radio" value="option1">
                                                <span class="radio"></span>
                                                Sim
                                            </label>

                                            <label class="radio-button">
                                                <input type="radio" name="example-radio" value="option2">
                                                <span class="radio"></span>
                                                Não
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div id="prazo" class="invisible">
                                    <div class="col-md-12  form-group mb-3">
                                        <label class="col-form-label">Prazo:</label>
                                        <input type="date" class="form-control" name="prazo">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-12 form-group mb-3 quadro-div">
                                <label for="message" class="col-form-label">Notas / Observações:</label>
                                <textarea class="form-control text-bg-dark" name="obs" cols="30" rows="4" value="{{ old('obs') }}"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="finish-">
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-success adicionar">
                                    <i class="fa-solid fa-clipboard-check">
                                        <span>Finalizar</span>
                                    </i>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>


@endsection
