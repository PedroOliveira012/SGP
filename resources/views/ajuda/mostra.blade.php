@extends('index.index')

@section('conteudo')
<body>
    <section class="container contorno">
        <div class="">
            <h2>Nome do procedimento: <?= $fit[0]->titulo?></h2>
            <ul>
                <li>Categoria: <?=$fit[0]->tipo?>, <?=$fit[0]->tipo?>, <?= $fit[0]->area?></li>
                <li>Área(s) envolvida(s): <?= $fit[0]->areas_envolvidas?></li>
                <li>Material necessário: <?= $fit[0]->material?></li>
                <li>Ferramentas necessárias: <?= $fit[0]->ferramentas?></li>
                <li>EPI/C: <?= $fit[0]->EPI?></li>
                <li>Referências bibliográficas: <?= $fit[0]->referencias?></li>
            </ul>
        </div>
        <div class="">
            <h2>Descrição:</h2>
            <p><?=$fit[0]->descricao?></p>
        </div>
        <div>
            fotos
        </div>
    </section>
</body>
@endsection
