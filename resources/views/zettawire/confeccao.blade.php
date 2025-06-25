@extends('index.index')

@section('conteudo')

<div class="topo">
    <div class="w-100 m-auto">
        <h1 class="text-center">Confecção de cabos</h1>
        <h2 class="text-center"><?=$projeto->num_projeto?> - <?=$projeto->nome_projeto?></h2>
    </div>
</div>
@include('partials.toolbar')
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
                    <button type="submit" onclick="event.stopPropagation();" class="cable-done-button" data-id="{{ $cabo->id }}" id="cableId{{ $cabo->id }}">
                        @if($cabo->isdone == 0)
                            <p><i class="fa-regular fa-circle fa-xl red-icon cable-done-icon"></i></p>
                        @else
                            <p><i class="fa-solid fa-circle fa-xl green-icon cable-done-icon"></i></p>
                        @endif
                    </button
                </div>
            </td>
        </tr>
        <tr class="collapsedRow" data-child-id="{{ $cabo->id }}">
            <td colspan="7" class="p-0 bottom-1 top-0">
                <div class="collapse collapsedRow_div" data-bs-toggle="collapse" id="collapseRow{{$cabo->id}}">
                    <div class="p-2 me-3 collapsedRow_content text-end">
                        <p class="py-2 fw-bold">Direção origem</p>
                        @include('partials.cabo_collapse', ['direcao' => $cabo->origin_direction])
                        <p class="py-2">Terminal origem: {{ $cabo->origin_terminal_type }}</p>
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
                    <div class="p-2 ms-3 collapsedRow_content text-start">
                        <p class="py-2 fw-bold">Direção destino</p>
                        @include('partials.cabo_collapse_reverse', ['direcao' => $cabo->target_direction])
                        <p class="py-2">Terminal destino: {{ $cabo->target_terminal_type }}</p>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    <tbody>
</table>
@endsection
