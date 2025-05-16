@extends('index.index')

@section('conteudo')

<div class="topo">
    <div class="projetos__titulo">
        <h1><?=$projeto->num_projeto?> - <?=$projeto->nome_projeto?></h1>
    </div>
    <div class="search-and-add">
        <!-- <form action="{{ url('/funcionarios/index') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por projetos...">
        </form> -->
    </div>
</div>
<div>
    <table class="table table-dark tabela">
        <thead>
            <tr class="tabela__head">
                <th>Anilha</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Seção transversal</th>
                <th>Cor</th>
                <th>Chicote</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($cabos as $cabo)
            <tr class="align-middle text-center" onclick="toggleCollapse('collapseRow{{ $cabo->id }}')" style="cursor: pointer;">
                <td>
                    <p><?= $cabo->tag?></p>
                </td>
                <td>
                    <p><?= $cabo->origin?></p>
                </td>
                <td>
                    <p><?= $cabo->target?></p>
                </td>
                <td>
                    <p><?= $cabo->cable_cross_section?></p>
                </td>
                <td>
                    <p><?= $cabo->color?></p>
                </td>
                <td>
                    <p><?= $cabo->wire_harness?></p>
                </td>
                <td>
                    @if($cabo->status == 0)
                        <p class="text-danger"><?= $cabo->status?></p>
                    @elseif($cabo->status == 1)
                        <p class="text-warning"><?= $cabo->status?></p>
                    @else
                        <p class="text-success"><?= $cabo->status?></p>
                    @endif
                </td>
            </tr>
            <tr class="collapsedRow">
                <td colspan="7" class="p-0 border-bottom-1 border-top-0">
                    @if($cabo->status == 0 || $cabo->status == 2)
                        <div class="collapse collapsedRow_div" data-bs-toggle="collapse" id="collapseRow{{$cabo->id}}">
                    @elseif($cabo->status == 1)
                        <div class="collapse show collapsedRow_div" data-bs-toggle="collapse" id="collapseRow{{$cabo->id}}">
                    @endif
                        <div class="p-3 collapsedRow_content">
                            <strong>Direção origem</strong><br>
                            <p>{{ $cabo->origin_direction }}</p>
                            @if($cabo->origin_direction == 'Para cima, para a esquerda')
                                <p><i class="fa-solid fa-arrow-turn-up fa-rotate-270" style="color: #ffffff;"></i></p>
                            @elseif($cabo->origin_direction == 'Para a esquerda, para baixo')
                                <i class="fa-solid fa-arrow-turn-up fa-rotate-180" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para baixo, para a direita')
                                <i class="fa-solid fa-arrow-turn-up fa-rotate-90" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para a direita, para cima')
                                <i class="fa-solid fa-arrow-turn-up" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para cima, para a direita')
                                <i class="fa-solid fa-arrow-turn-down fa-rotate-270" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para a esquerda, para cima')
                                <i class="fa-solid fa-arrow-turn-down fa-rotate-180" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para baixo, para a esquerda')
                                <i class="fa-solid fa-arrow-turn-down fa-rotate-90" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para a direita, para baixo')
                                <i class="fa-solid fa-arrow-turn-down" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para cima')
                                <i class="fa-solid fa-arrow-up" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para baixo')
                                <i class="fa-solid fa-arrow-down" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para a esquerda')
                                <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
                            @elseif($cabo->origin_direction == 'Para a direita')
                                <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
                            @endif
                        </div>
                        <div class="p-3 collapsedRow_content">
                            <strong>Direção destino</strong>
                            <p>{{ $cabo->target_direction }}</p>
                            @if($cabo->target_direction == 'Para cima, para a esquerda')
                                <i class="fa-solid fa-arrow-turn-up fa-rotate-270" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para a esquerda, para baixo')
                                <i class="fa-solid fa-arrow-turn-up fa-rotate-180" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para baixo, para a direita')
                                <i class="fa-solid fa-arrow-turn-up fa-rotate-90" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para a direita, para cima')
                                <i class="fa-solid fa-arrow-turn-up" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para cima, para a direita')
                                <i class="fa-solid fa-arrow-turn-down fa-rotate-270" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para a esquerda, para cima')
                                <i class="fa-solid fa-arrow-turn-down fa-rotate-180" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para baixo, para a esquerda')
                                <i class="fa-solid fa-arrow-turn-down fa-rotate-90" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para a direita, para baixo')
                                <i class="fa-solid fa-arrow-turn-down" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para cima')
                                <i class="fa-solid fa-arrow-up" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para baixo')
                                <i class="fa-solid fa-arrow-down" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para a esquerda')
                                <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
                            @elseif($cabo->target_direction == 'Para a direita')
                                <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
                            @endif
                        </div>
                        <div class="p-3 collapsedRow_content">
                            <strong>Comprimento: {{ $cabo->length }}m</strong>
                        </div>
                        <div class="p-3 collapsedRow_content">
                            <form action="origem/{{$cabo->id}}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="">origem</button>
                                <input type="hidden" name="origin_value" value="{{ $cabo->origin_value }}">
                            </form>
                            <p>{{ $cabo->origin_value }}</p>
                            <form action="destino/{{$cabo->id}}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="">destino</button>
                                <input type="hidden" name="target_value" value="{{ $cabo->target_value }}">
                            </form>
                            <p>{{ $cabo->target_value }}</p>
                            <strong>{{ $cabo->status }}</strong>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        <tbody>
    </table>
</div>
<script>
    function toggleCollapse(id) {
        const element = document.getElementById(id);
        const collapse = bootstrap.Collapse.getOrCreateInstance(element);
        collapse.toggle();
    }
</script>
@endsection
