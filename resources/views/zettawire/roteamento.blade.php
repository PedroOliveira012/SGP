@extends('index.index')

@section('conteudo')

<div class="topo">
    <div class="projetos__titulo">
        <h1><?=$projeto->num_projeto?> - <?=$projeto->nome_projeto?></h1>
    </div>
    <div class="search-and-add">
        <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por tag de origem ou destino">
    </div>
    <button id="alterarStatus" class="btn btn-warning m-2">
        Concluir cabos
    </button>
</div>
<div id="resultsNotFound"></div>
<table class="table table-dark tabela">
    <thead>
        <tr class="tabela__head">
            <th class="d-flex align-items-center justify-content-center">
                Chicote
                <div class="dropdown m-2">
                    <button class="btn dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-size">
                        <li><a class="dropdown-item filtro-opcao" data-filtro="todos" href="#">Mostrar todos</a></li>
                    @foreach ($wire_harness as $wire_harness)
                        <li><a class="dropdown-item filtro-opcao" data-filtro="{{ $wire_harness }}" href="#">{{ $wire_harness }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </th>
            <th>
                Anilha
                <!-- <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                    @foreach ($tags as $tag)
                        <li><a class="dropdown-item" href="#">{{ $tag }}</a></li>
                    @endforeach
                    </ul>
                </div> -->
            </th>
            <th>
                Origem
                <!-- <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                    @foreach ($origins as $origin)
                        <li><a class="dropdown-item" href="#">{{ $origin }}</a></li>
                    @endforeach
                    </ul>
                </div> -->
            </th>
            <th>
                Destino
                <!-- <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                    @foreach ($targets as $target)
                        <li><a class="dropdown-item" href="#">{{ $target }}</a></li>
                    @endforeach
                    </ul>
                </div> -->
            </th>
            <th>
                Seção transversal
                <!-- <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                    @foreach ($cable_cross_sections as $cable_cross_section)
                        <li><a class="dropdown-item" href="#">{{ $cable_cross_section }}</a></li>
                    @endforeach
                    </ul>
                </div> -->
            </th>
            <th>
                Cor
                <!-- <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                    @foreach ($colors as $color)
                        <li><a class="dropdown-item" href="#">{{ $color }}</a></li>
                    @endforeach
                    </ul>
                </div> -->
            </th>
            <th>
                Status
                <!-- <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                    @foreach ($status as $status)
                        <li><a class="dropdown-item" href="#">{{ $status }}</a></li>
                    @endforeach
                    </ul>
                </div> -->
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider" id="resultsFound">
        @foreach ($cabos as $cabo)
        <tr class="align-middle text-center" onclick="toggleCollapse('collapseRow{{ $cabo->id }}')" style="cursor: pointer" data-id="{{ $cabo->id }}">
            <td class="item-filtro item-visivel {{ $cabo->wire_harness }}" data-id="{{ $cabo->id }}">
                <p><?= $cabo->wire_harness?></p>
            </td>
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
                @if($cabo->status == 0)
                    <p class="text-danger"><i class="fa-solid fa-circle-dot" style="color: #dc3545"></i></p>
                @elseif($cabo->status == 1)
                    <p class="text-warning"><i class="fa-solid fa-circle-dot" style="color: #f2b809"></i></p>
                @else
                    <p class="text-success"><i class="fa-solid fa-circle-dot" style="color: #198754"></i></p>
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
                        <p>Comprimento: {{ $cabo->length }}m</p>
                        <p>Terminal origem: {{ $cabo->origin_terminal_type }}</p>
                        <p>Terminal destino: {{ $cabo->target_terminal_type }}</p>
                    </div>
                    <div class="p-3 collapsedRow_content">
                        <strong>Direção origem</strong><br>
                        <p>{{ $cabo->origin_direction }}</p>
                        @include('partials.cabo_collapse', ['direcao' => $cabo->origin_direction])
                    </div>
                    <div class="p-3 collapsedRow_content">
                        <strong>Direção destino</strong>
                        <p>{{ $cabo->target_direction }}</p>
                        @include('partials.cabo_collapse', ['direcao' => $cabo->target_direction])
                    </div>
                    <div class="p-3 collapsedRow_content_buttons" id="collapsedRowButtons">
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
                        <form action="finalizaCabo/{{$cabo->id}}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="">Finaliza</button>
                            <input type="hidden" name="origin_value" value="{{ $cabo->origin_value }}">
                            <input type="hidden" name="target_value" value="{{ $cabo->target_value }}">
                        </form>
                        <p>{{ $cabo->status }}</p>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    <tbody>
</table>
<script>
    function toggleCollapse(id) {
        const element = document.getElementById(id);
        const collapse = bootstrap.Collapse.getOrCreateInstance(element);
        collapse.toggle();
    }

    $('.filtro-opcao').click(function(e) {
        e.preventDefault();

        var filtro = $(this).data('filtro');

        $('table tbody tr').each(function() {
            var categoria = $(this).find('.item-filtro p').text().trim();

            if (filtro === 'todos' || categoria === filtro) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#alterarStatus').on('click', function() {
        // Pega todos os cabos visíveis com data-id
        $('.item-visivel:visible').each(function() {
            var id = $(this).data('id');
            console.log(id);

            if (id) {
                $.ajax({
                    url: 'alterarStatus/'+ id,
                    type: 'POST',
                    success: function(response) {
                        console.log('Cabo ' + id + ' atualizado com sucesso.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao atualizar cabo ' + id + ':', error);
                    }
                });
            }
        });
        window.location.reload();
    });

</script>
<script>
    let debounceTimer;
    let tabelaOriginal = $('#resultsFound').html();
    $(document).ready(function(){
        $('#search').on('keyup', function(){
            clearTimeout(debounceTimer);
            let query = $(this).val();
            debounceTimer = setTimeout(function() {
                if (query.trim() === '') {
                    $('#resultsFound').empty();
                    $('#resultsNotFound').empty();
                    $('#resultsFound').html(tabelaOriginal);   // Se quiser, pode comentar essa linha para manter os resultsFound.
                    return;
                }
                $.ajax({
                    url: "{{ route('buscar', ['id'=> $projeto->id]) }}",
                    type: "GET",
                    data: {query: query},
                    success: function(data){
                        $('#resultsFound').on('click', '.toggle-row', function() {
                            const id = $(this).data('id');
                            toggleCollapse('collapseRow' + id);
                        });
                        if(data.length === 0){
                            $('#resultsNotFound').empty();
                            $('#resultsNotFound').append('Nenhuma tag correspondente');
                        } else {
                            $('#resultsFound').empty();
                            $('#resultsNotFound').empty();
                            $.each(data, function(i, cable_routing){
                                let statusIcon = '';
                                if(cable_routing.status == 0){
                                    statusIcon = '<p class="text-danger"><i class="fa-solid fa-circle-dot" style="color: #dc3545"></i></p>';
                                } else if(cable_routing.status == 1){
                                    statusIcon = '<p class="text-warning"><i class="fa-solid fa-circle-dot" style="color: #f2b809"></i></p>';
                                } else {
                                    statusIcon = '<p class="text-success"><i class="fa-solid fa-circle-dot" style="color: #198754"></i></p>';
                                }
                                $('#resultsFound').append(
                                    '<tr class="align-middle text-center" onclick="toggleCollapse(\'collapseRow' + cable_routing.id + '\')" style="cursor: pointer">' +
                                        '<td><p>' + cable_routing.wire_harness + '</p></td>' + 
                                        '<td><p>' + cable_routing.tag + '</p></td>' + 
                                        '<td><p>' + cable_routing.origin + '</p></td>' + 
                                        '<td><p>' + cable_routing.target + '</p></td>' + 
                                        '<td><p>' + cable_routing.cable_cross_section + '</p></td>' + 
                                        '<td><p>' + cable_routing.color + '</p></td>' + 
                                        '<td>' + statusIcon + '</td>' +
                                    '</tr>' + 
                                    '<tr class="collapsedRow">' +
                                        '<td colspan="7" class="p-0 border-bottom-1 border-top-0">' +
                                            '<div class="collapse collapsedRow_div" id="collapseRow' + cable_routing.id + '">' +
                                                '<div class="p-3 collapsedRow_content">' +
                                                    '<p>Comprimento: ' + cable_routing.length + 'm</p>' +
                                                    '<p>Terminal origem: ' + cable_routing.origin_terminal_type + '</p>' +
                                                    '<p>Terminal destino: ' + cable_routing.target_terminal_type + '</p>' +
                                                '</div>' +
                                                '<div class="p-3 collapsedRow_content">' +
                                                    '<strong>Direção origem</strong>' +
                                                    '<p>' + cable_routing.origin_direction + '</p>' +
                                                    '<p>' +  + '</p>' +
                                                '</div>' +
                                                '<div class="p-3 collapsedRow_content">' +
                                                    '<strong>Direção destino</strong>' +
                                                    '<p>' + cable_routing.target_direction + '</p>' +
                                                    '<p>' +  + '</p>' +
                                                '</div>' +
                                            '</div>' +
                                        '</td>' +
                                    '</tr>'
                                );
                            });
                        }
                    }
                });
            }, 500);
        });
    });
</script>
@endsection
