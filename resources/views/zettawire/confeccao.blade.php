@extends('index.index')

@section('conteudo')

<div class="topo">
    <div class="projetos__titulo">
        <h1>Confecção de cabos</h1>
        <h2><?=$projeto->num_projeto?> - <?=$projeto->nome_projeto?></h2>
    </div>
    <button id="cableDone" class="btn btn-warning m-2 d-none">
        Concluir cabos
    </button>
</div>
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
            </th>
            <th class="text-center align-middle">
                Seção transversal
            </th>
            <th class="text-center align-middle">
                Terminal Origem
            </th>
            <th class="text-center align-middle">
                Terminal Destino
            </th>
            <th class="text-center align-middle">
                Status
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider" id="resultsFound">
        @foreach ($cabos as $cabo)
        <!-- <tr class=" align-middle text-center"> -->
        <tr class=" align-middle text-center " onclick="toggleCollapse('collapseRow{{ $cabo->id }}')" style="cursor: pointer" data-id="{{ $cabo->id }}">
            <td class="item-filtro item-visivel {{ $cabo->wire_harness }}" data-id="{{ $cabo->id }}">
                <p><?= $cabo->wire_harness?></p>
            </td>
            <td>
                <p><?= $cabo->tag?></p>
            </td>
            <td>
                <p><?= $cabo->cable_cross_section?></p>
            </td>
            <td>
                <p><?= $cabo->origin_terminal_type?></p>
            </td>
            <td>
                <p><?= $cabo->target_terminal_type?></p>
            </td>
            <td>
                <div class="d-flex w-100 justify-content-center align-items-start ">
                    <form action="cableDone/{{$cabo->id}}" method="POST" class="d-flex w-100 justify-content-center">
                        @csrf
                        @method('POST')
                        <button type="submit" id="cableDone" onclick="event.stopPropagation();" class="cable-done-button">
                            @if($cabo->isdone == 0)
                                <p><i class="fa-regular fa-circle fa-xl" style="color: #dc3545"></i></p>
                            @else
                                <p><i class="fa-solid fa-circle fa-xl" style="color: #198754"></i></p>
                            @endif
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        <tr class="collapsedRow">
            <td colspan="7" class="p-0 bottom-1 top-0">
                @if($cabo->status == 1)
                    <div class="collapse show collapsedRow_div" data-bs-toggle="collapse" id="collapseRow{{$cabo->id}}">
                @else
                    <div class="collapse show collapsedRow_div" data-bs-toggle="collapse" id="collapseRow{{$cabo->id}}">
                @endif
                    <div class="p-2 collapsedRow_content text-end">
                        <strong>Direção origem</strong><br>
                        <p>{{ $cabo->origin_direction }}</p>
                        @include('partials.cabo_collapse', ['direcao' => $cabo->origin_direction])
                        <p>Terminal origem: {{ $cabo->origin_terminal_type }}</p>
                    </div>
                    <div class="d-flex flex-column align-items-center collapsedRow_content">
                        <div class="d-flex w-100 h-100 justify-content-between align-items-center">
                            
                            <div class="d-flex w-100 h-75 p-1 align-items-center">
                                @if($cabo->origin_terminal_type == 'Pré-Decapado (Sem Terminal)')
                                    <div class="cable-start m-auto copper-cable">
                                @else
                                    <div class="cable-start m-auto terminal-start"> 
                                @endif
                                </div>
                                @if($cabo->color == 'PT' || $cabo->color == '1' || $cabo->color == '2')
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
                                @elseif($cabo->color == 'VI')
                                    <div class="cable-body m-auto violet-cable">
                                @elseif($cabo->color == 'VD')
                                    <div class="cable-body m-auto green-cable">
                                @else($cabo->color == 'MR')
                                    <div class="cable-body m-auto brown-cable">
                                @endif
                                    @if ($cabo->color == '1' || $cabo->color == '2')
                                        <p>{{ $cabo->color }}</p>
                                    @endif
                                    <p style="background:#fff; color:#000; padding:2px">Comprimento: {{ $cabo->length }}m</p>
                                    @if ($cabo->color == '1' || $cabo->color == '2')
                                        <p>{{ $cabo->color }}</p>
                                    @endif
                                </div>


                                @if($cabo->origin_terminal_type == 'Pré-Decapado (Sem Terminal)')
                                    <div class="cable-start m-auto copper-cable">
                                @else
                                    <div class="cable-start m-auto terminal-end"> 
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 collapsedRow_content">
                        <strong>Direção destino</strong>
                        <p>{{ $cabo->target_direction }}</p>
                        @include('partials.cabo_collapse_reverse', ['direcao' => $cabo->target_direction])
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
        $('cableDone').removeClass('invisible');
        $('table tbody tr').each(function() {
            var categoria = $(this).find('.item-filtro p').text().trim();

            if (filtro === 'todos' || categoria === filtro) {
                $(this).show();
                $('#cableDone').addClass('d-none');
            } else {
                $(this).hide();
                $('#cableDone').removeClass('d-none');
            }
        });
    });
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#cableDone').on('click', function(e) {
        e.preventDefault();

        var total = $('.item-visivel:visible').length;
        var concluido = 0;

        $('.item-visivel:visible').each(function() {
            var id = $(this).data('id');
            console.log(id);

            if (id) {
                $.ajax({
                    url: 'cableDone/'+ id,
                    type: 'POST',
                    success: function(response) {
                        console.log('Cabo ' + id + ' atualizado com sucesso.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao atualizar cabo ' + id + ':', error);
                    },
                    complete: function() {
                        concluido++;
                        if (concluido === total) {
                            // Só recarrega quando TODOS terminarem
                            location.reload();
                        }
                    }
                });
            }
        });
        // location.reload();
    });
</script>

@endsection
