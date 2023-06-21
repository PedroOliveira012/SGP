@extends('index.index')

@section('conteudo')

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<body>
    <a href="{{ url('/chamados/lista/') }}">
        <button class="btn voltar">
            <i class="fa-solid fa-chevron-left voltar-icone"></i>
            Voltar
        </button>
    </a>
    <div id="carouselExampleIndicators" class="carousel slide contorno view">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class=" view_conteudo">
                    <ul>
                        <li><h2>Funcionario: </h2><p><?= $chamado->nome?></p></li>
                        <li><h2>Data e hora: </h2><p><?= $chamado->data_e_hora?></p></li>
                        <li><h2>Tipo de chamado: </h2><p><?= $chamado->tipo?></p></li>
                        <li><h2>Assunto do chamado: </h2><p><?= $chamado->assunto?></p></li>
                    </ul>
                </div>
            </div>
            <div class="carousel-item">
                <div class="conteudo-chamado">
                    <div>
                        <h2>Problema</h2>
                    </div>
                    <textarea class="form-control" name="conteudo-chamado-input" cols="60" rows="5" maxlength="255" disabled>{{$chamado->conteudo}}</textarea>
                </div>
            </div>
            <div class="carousel-item">
                <div class="solucao-chamado">
                    <div>
                        <div>
                            <h2>Solução adotada:</h2>
                        </div>
                        <textarea class="form-control" name="solucao-chamado-input" cols="60" rows="5" maxlength="255" placeholder="Escreva aqui a solução"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</body>
{{-- <form action="/tarefas/retrabalho/{{$i->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade modal-lg" id="staticBackdropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-bg-dark ">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Retrabalho</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea name="refazer" id="refazer" cols="100" rows="7" placeholder="Escreva aqui o que precisa ser refeito"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Finalizar</button>
            </div>
            </div>
        </div>
    </div>
</form> --}}
@endsection
