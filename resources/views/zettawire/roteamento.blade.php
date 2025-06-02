@extends('index.index')

@section('conteudo')

<div class="topo">
    <div class="projetos__titulo">
        <h1><?=$projeto->num_projeto?> - <?=$projeto->nome_projeto?></h1>
    </div>
    <!-- <div class="search-and-add">
        <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por tag de origem ou destino">
    </div> -->
    <button id="alterarStatus" class="btn btn-warning m-2 d-none">
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
            <th class="text-center align-middle">
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
            <th class="text-center align-middle">
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
            <th class="text-center align-middle">
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
            <th class="text-center align-middle">
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
            <th class="text-center align-middle">
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
            <th class="text-center align-middle">
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
        <tr class=" align-middle text-center " onclick="toggleCollapse('collapseRow{{ $cabo->id }}')" style="cursor: pointer" data-id="{{ $cabo->id }}">
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
                <div class="d-flex w-100 justify-content-center align-items-start ">
                    <form action="finalizaCabo/{{$cabo->id}}" method="POST" class="d-flex w-100 justify-content-center">
                        @csrf
                        @method('POST')
                        <button type="submit" onclick="event.stopPropagation();" class="finish-button">
                            @if($cabo->status == 0)
                                <p><i class="fa-regular fa-circle fa-xl" style="color: #dc3545"></i></p>
                            @elseif($cabo->status == 1)
                                <p><i class="fa-solid fa-circle-half-stroke fa-xl" style="color: #f2b809"></i></p>
                            @else
                                <p><i class="fa-solid fa-circle fa-xl" style="color: #198754"></i></p>
                            @endif
                        </button>
                        <input type="hidden" name="origin_value" value="{{ $cabo->origin_value }}">
                        <input type="hidden" name="target_value" value="{{ $cabo->target_value }}">
                    </form>
                </div>
            </td>
        </tr>
        <tr class="collapsedRow">
            <td colspan="7" class="p-0 bottom-1 top-0">
                @if($cabo->status == 1)
                    <div class="collapse show collapsedRow_div" data-bs-toggle="collapse" id="collapseRow{{$cabo->id}}">
                @else
                    <div class="collapse collapsedRow_div" data-bs-toggle="collapse" id="collapseRow{{$cabo->id}}">
                @endif
                    <div class="p-2 collapsedRow_content text-end">
                        <strong>Direção origem</strong><br>
                        <p>{{ $cabo->origin_direction }}</p>
                        @include('partials.cabo_collapse', ['direcao' => $cabo->origin_direction])
                        <p>Terminal origem: {{ $cabo->origin_terminal_type }}</p>
                    </div>
                    <div class="d-flex flex-column align-items-center collapsedRow_content">
                        <div class="d-flex w-100 h-100 justify-content-between align-items-center">
                            <div>
                                <form action="origem/{{$cabo->id}}" method="POST" class="d-flex justify-content-center align-items-center">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="cable-button">
                                        @if($cabo->origin_value == 1)
                                            <i class="fa-solid fa-circle fa-xl" style="color: #E60026"></i>
                                        @else
                                            <i class="fa-solid fa-circle fa-xl" style="color: #138808"></i>
                                        @endif
                                    </button>
                                    <input type="hidden" name="origin_value" value="{{ $cabo->origin_value }}">
                                </form>
                            </div>
                            <div class="d-flex w-100 h-75 p-1 align-items-center">
                                @if($cabo->origin_terminal_type == 'Pré-Decapado (Sem Terminal)')
                                    <div class="cable-start m-auto copper-cable">
                                @else
                                    <div class="cable-start m-auto terminal-start"> 
                                @endif
                                </div>
                                @if($cabo->color == 'PT')
                                    <div class="cable-body m-auto black-cable">
                                @elseif($cabo->color == 'BR')
                                    <div class="cable-body m-auto white-cable">
                                @elseif($cabo->color == 'AZ CL')
                                    <div class="cable-body m-auto light-blue-cable">
                                @elseif($cabo->color == 'VM')
                                    <div class="cable-body m-auto red-cable">
                                @elseif($cabo->color == 'AM')
                                    <div class="cable-body m-auto yellow-cable">
                                @elseif($cabo->color == 'CZ')
                                    <div class="cable-body m-auto gray-cable">
                                @elseif($cabo->color == 'VD/AM')
                                    <div class="cable-body m-auto green-yellow-cable">
                                @elseif($cabo->color == 'AZ ES')
                                    <div class="cable-body m-auto dark-blue-cable">
                                @elseif($cabo->color == 'LR')
                                    <div class="cable-body m-auto orange-cable">
                                @else($cabo->color == 'VI')
                                    <div class="cable-body m-auto violet-cable">
                                @endif
                                    <p style="background:#fff; color:#000; padding:2px">Comprimento: {{ $cabo->length }}m</p>
                                </div>
                                @if($cabo->origin_terminal_type == 'Pré-Decapado (Sem Terminal)')
                                    <div class="cable-start m-auto copper-cable">
                                @else
                                    <div class="cable-start m-auto terminal-end"> 
                                @endif
                                </div>
                            </div>
                            <div>
                                <form action="destino/{{$cabo->id}}" method="POST" class="d-flex justify-content-center align-items-center">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="cable-button">
                                        @if($cabo->target_value == 1)
                                            <i class="fa-solid fa-circle fa-xl" style="color: #E60026"></i>
                                        @else
                                            <i class="fa-solid fa-circle fa-xl" style="color: #138808"></i>
                                        @endif
                                    </button>
                                    <input type="hidden" name="target_value" value="{{ $cabo->target_value }}">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 collapsedRow_content">
                        <strong>Direção destino</strong>
                        <p>{{ $cabo->target_direction }}</p>
                        @include('partials.cabo_collapse', ['direcao' => $cabo->target_direction])
                        <p>Terminal destino: {{ $cabo->target_terminal_type }}</p>
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
        $('alterarStatus').removeClass('d-none');
        $('table tbody tr').each(function() {
            var categoria = $(this).find('.item-filtro p').text().trim();

            if (filtro === 'todos' || categoria === filtro) {
                $(this).show();
                if (filtro === 'todos'){
                    $('#alterarStatus').addClass('d-none')
                }
                else {
                    $('#alterarStatus').removeClass('d-none');
                }
                console.log('Exibindo: ' + categoria);
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
        // window.location.reload();
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
                    $('#resultsFound').html(tabelaOriginal);
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
                                    statusIcon = '<p><i class="fa-regular fa-circle fa-xl" style="color: #dc3545"></i></p>';
                                } else if(cable_routing.status == 1){
                                    statusIcon = '<p><i class="fa-solid fa-circle-half-stroke fa-xl" style="color: #f2b809"></i></p>';
                                } else {
                                    statusIcon = '<p><i class="fa-solid fa-circle fa-xl" style="color: #198754"></i></p>';
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
                                    '<td colspan="7" class="p-0 bottom-1 top-0">'+
                                    '<tr class="collapsedRow">' +
                                        '<td colspan="7" class="p-0 bottom-1 top-0">' +
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
