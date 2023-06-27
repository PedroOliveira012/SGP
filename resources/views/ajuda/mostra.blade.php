@extends('index.index')

@section('conteudo')
<body>
    <section class="container contorno">
        <div class="inicio-fit">
            <h2>Nome do procedimento: <?= $fit->titulo?></h2>
            <ul>
                <li>Categoria: <?=$fit->tipo?>, <?=$fit->tipo?>, <?= $fit->area?></li>
                <li>Área(s) envolvida(s): <?= $fit->areas_envolvidas?></li>
                <li>Material necessário: <?= $fit->material?></li>
                <li>Ferramentas necessárias: <?= $fit->ferramentas?></li>
                <li>EPI/C: <?= $fit->EPI?></li>
                <li>Referências bibliográficas: <?= $fit->referencias?></li>
            </ul>
        </div>
        <div class="desc-fit">
            <h2>Descrição:</h2>
            <ul>
                @foreach ($passos as $p)
                    <li>{{$p}}</li>
                @endforeach
            </ul>
            {{-- <p><?=$fit->descricao?></p> --}}
        </div>
        <div class="media-fit">
            <div id="carouselExampleIndicators" class="carousel slide contorno view">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class=" view_conteudo">

                        </div>
                    </div>
                  <div class="carousel-item">
                    <div class="view_conteudo">

                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="view_conteudo" id="notas">

                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="view_conteudo--botao">

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
        </div>
    </section>
</body>
@endsection
