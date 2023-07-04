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
    <section class="container contorno info-testes">
        <div class="div__info--testes">
            {{-- <h1>Número do Projeto: <?= $i->num_projeto?></h1>
            <div class="dados_lista">
                <ul>
                    <li><b>Nome do projeto: </b><?=$i->nome_projeto?></li>
                    <li><b>Cliente: </b><?= $i->cliente?></li>
                    <li><b>Unidade: </b><?= $i->unidade?></li>
                    <li><b>Data de fechamento do projeto: </b><?= Carbon\Carbon::parse($i->data_fechamento)->isoFormat('DD/MM/YYYY')?></li>
                    <li><b>Data de entrega: </b><?= Carbon\Carbon::parse($i->data_entrega)->isoFormat('DD/MM/YYYY')?></li>
                    <li><b>Responsável Técnico (cliente): </b><?= $i->Responsavel_tecnico?></li>
                    <li><b>Analista: </b><?= $i->analista?></li>
                    <li><b>Projetista: </b><?= $i->projetista?></li>
                    <li><b>Valor contratado: </b>R$ <?=number_format($i->valor_contratado,2,',','.')?></li>
                    <li><b>Prazo de entrega: </b><?= $i->prazo_entrega?> dias</li>
                    <li><b>Responsável pelo projeto: </b><?= $i->responsavel?></li>
                    <li><b>Status de projeto: </b></li>
                    {{-- <?= $i->observacoes?> --}}
                {{-- </ul>
            </div> --}}
        </div>
        <div class="div__botoes--testes">
            <a href="{{ url('testes/pendencias/'. $lista[0]->id_projeto) }}">
                <button type="button" class="btn">Pendencia</button>
            </a>
            <a href="{{ url('testes/checklist') }}">
                <button type="button" class="btn">Checklist</button>
            </a>
            <a href="{{ url('testes/comissionamento') }}">
                <button type="button" class="btn">Comissionamento</button>
            </a>
            <a href="{{ url('testes/inspecao') }}">
                <button type="button" class="btn">Inspeção</button>
            </a>
        </div>
    </section>
</body>
@endsection
