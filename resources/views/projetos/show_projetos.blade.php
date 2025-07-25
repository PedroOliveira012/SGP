@extends('index.index')

@section('conteudo')

@if ($errors->any())
    <ul class=" container errors alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="error">{{$error}}</li>
        @endforeach
    </ul>
@endif

<body onload="Relembrar()">
    <section class="container contorno write-section">
        <div class="info-projeto">
            <h1>Número do Projeto: <?= $i->num_projeto?></h1>
            <h3>Status:
            @if ($i->status == "Liberado")
                Liberado para a fábrica
            @elseif ($i->status == "Em teste")
                Projeto em fase de teste
            @elseif ($i->status == "Encerrado")
                Projeto encerrado
            @endif
            </h3>
            <div class="dados_lista">
                <ul>
                    <li><b>Nome do projeto: </b><?=$i->nome_projeto?></li>
                    <li><b>Cliente: </b><?= $i->cliente?></li>
                    <li><b>Unidade: </b><?= $i->unidade?></li>
                    <li><b>Data de fechamento do projeto: </b><?= Carbon\Carbon::parse($i->data_fechamento)->isoFormat('DD/MM/YYYY')?></li>
                    <li><b>Data de entrega: </b><?= Carbon\Carbon::parse($i->data_entrega)->isoFormat('DD/MM/YYYY')?></li>
                    <li><b>Analista: </b><?= $i->analista?></li>
                    <li><b>Projetista: </b><?= $i->projetista?></li>
                    <!-- @if ($i->finalizado == 0)
                        @if (($i->prazo_entrega * 0.9) <= Carbon\Carbon::today()->diffInDays($i->data_fechamento))
                            <li class="data-vermelha"><b>Status de entrega: </b><?= Carbon\Carbon::today()->diffInDays($i->data_fechamento)?> dias</li>
                        @elseif (( $i->prazo_entrega * 0.7) <= Carbon\Carbon::today()->diffInDays($i->data_fechamento))
                            <li class="data-laranja"><b>Status de entrega: </b><?= Carbon\Carbon::today()->diffInDays($i->data_fechamento)?> dias</li>
                        @elseif (( $i->prazo_entrega * 0.4) <= Carbon\Carbon::today()->diffInDays($i->data_fechamento))
                            <li class="data-amarela"><b>Status de entrega: </b><?= Carbon\Carbon::today()->diffInDays($i->data_fechamento)?> dias</li>
                        @else
                            <li class="data-verde"><b>Status de entrega: </b><?= Carbon\Carbon::today()->diffInDays($i->data_fechamento)?> dias</li>
                        @endif
                    @else
                        @if (($i->prazo_entrega * 0.9) <= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao))
                            <li class="data-vermelha"><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao)?> dias</li>
                        @elseif (( $i->prazo_entrega * 0.7) <= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao))
                            <li class="data-laranja"><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao)?> dias</li>
                        @elseif (( $i->prazo_entrega * 0.4) <= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao))
                            <li class="data-amarela"><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao)?> dias</li>
                        @else
                            <li class="data-verde"><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fecahamento)->diffInDays($i->data_finalizacao)?> dias</li>
                        @endif
                    @endif -->
                    <li class=""><b>Status de entrega: </b><?= Carbon\Carbon::parse($i->data_fechamento)->diffInDays($i->data_finalizacao)?> dias</li>
                </ul>
                <div class="d-flex flex-column align-middle justify-content-center">
                    <div class="div-gravar-cabos">
                        <form action="{{ url('/upload/' .$i->id) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-row">
                            @csrf
                            <label for="file" class="btn custom-file-button">
                                <i class="fa-solid fa-upload"></i>
                                <span>Selecionar arquivo</span>
                            </label>
                            <input type="file" id="file" name="file">
                            
                            <div class="ms-4">
                                <select class="form-select text-bg-dark" name="painel" id="painel">
                                    <option selected hidden>Selecione o painel</option>
                                    @foreach ($paineis as $painel)
                                        <option value="{{ $painel }}">{{ $painel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="ms-4">
                                <button class="btn btn-gravar-cabos" id="saveCables" type="submit" disabled>
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    <span>Gravar cabos</span>
                                </button>
                            </div>
                            
                        </form>
                    </div>
                    <div class="m-auto">
                        <span class="custom-file-name" id="fileName"></span>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

</body>

<form action="{{ url('/projeto/libera/' .$i->id) }}" class="progress-form" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade" id="staticBackdropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Liberar projeto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Deseja mesmo liberar este projeto?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Liberar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $('#file').on('change', function() {
        const file = this.files[0];
        if (file) {
            $('#fileName').text('Arquivo: ' + file.name);
            $('#saveCables').prop('disabled', false);
        } else {
            $('#fileName').text('');
        }
    });
</script>

@endsection
