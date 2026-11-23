{{-- @extends('index.index')

@section('conteudo')

<div class="topo">
    <div class="w-100 m-auto">
        <h1 class="text-center">Confecção de cabos</h1>
        <h2 class="text-center">{{ $projeto->num_projeto }} - {{ $projeto->nome_projeto }}</h2>
    </div>
</div>

@include('partials.toolbar')

<table class="table table-dark tabela">
    <thead>
        <tr class="tabela__head">
            <th class="col-chicote d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center">
                    Chicote
                    <div class="dropdown m-2">
                        <button class="btn dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-size">
                            <li><a class="dropdown-item filtro-opcao" data-filtro="todos" href="#">Mostrar todos</a></li>
                            @foreach ($wire_harness as $harness)
                                <li><a class="dropdown-item filtro-opcao" data-filtro="{{ $harness }}" href="#">{{ $harness }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </th>
            <th class="col-anilha text-center align-middle">Anilha</th>
            <th class="col-secao text-center align-middle">Seção transversal</th>
            <th class="col-terminal-origem text-center align-middle">Terminal Origem</th>
            <th class="col-comp-origem text-center align-middle">Componente Origem</th>
            <th class="col-terminal-destino text-center align-middle">Terminal Destino</th>
            <th class="col-comp-destino text-center align-middle">Componente Destino</th>
            <th class="col-status text-center align-middle">Status</th>
            <th class="text-center align-middle" hidden>Painel</th>
        </tr>
    </thead>

    <tbody class="table-group-divider" id="resultsFound">
        @foreach ($cabos as $cabo) --}}
            {{-- Sem segunda <tr> e sem onclick inline: o detalhe é montado no clique (confeccao-detalhe.js) --}}
            {{-- <tr class="cabo-row align-middle text-center" style="cursor: pointer"
                data-id="{{ $cabo->id }}"
                data-color="{{ $cabo->color }}"
                data-length="{{ $cabo->length }}"
                data-origin-dir="{{ $cabo->origin_direction }}"
                data-target-dir="{{ $cabo->target_direction }}"
                data-origin-term="{{ $cabo->origin_terminal_type }}"
                data-target-term="{{ $cabo->target_terminal_type }}">

                <td class="col-chicote item-filtro item-visivel {{ $cabo->wire_harness }}" data-id="{{ $cabo->id }}"><p>{{ $cabo->wire_harness }}</p></td>
                <td class="col-anilha"><p>{{ $cabo->tag }}</p></td>
                <td class="col-secao"><p>{{ $cabo->cable_cross_section }}</p></td>
                <td class="col-terminal-origem"><p>{{ $cabo->origin_terminal_type }}</p></td>
                <td class="col-comp-origem"><p>{{ $cabo->origin }}</p></td>
                <td class="col-terminal-destino"><p>{{ $cabo->target_terminal_type }}</p></td>
                <td class="col-comp-destino"><p>{{ $cabo->target }}</p></td>
                <td class="col-status">
                    <div class="d-flex w-100 justify-content-center align-items-start">
                        <button type="submit" class="cable-done-button" data-id="{{ $cabo->id }}" id="cableId{{ $cabo->id }}">
                            <p>
                                <i class="{{ $cabo->isdone == 0 ? 'fa-regular red-icon' : 'fa-solid green-icon' }} fa-circle fa-xl cable-done-icon"></i>
                            </p>
                        </button>
                    </div>
                </td>
                <td hidden>
                    <div class="d-flex w-100 justify-content-center align-items-start">
                        <p class="panel-text">{{ $cabo->panel }}</p>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection --}}

@extends('index.index')

@section('conteudo')

@php
    $busca        = $busca ?? '';
    $chicotes     = $chicotes ?? collect();
    $progresso    = $progresso ?? ['total' => 0, 'feitos' => 0];
    // URL da própria tela, preservando painel e acrescentando chicote/tipo/busca (null = omite)
    $rotaPainel = fn (array $extra = []) => route($route_name, array_merge(
        ['id' => $projeto->id, 'panel' => $selected_panel],
        array_filter($extra, fn ($v) => $v !== null && $v !== '')
    ));

    // Variáveis lidas por partials.toolbar (só existem nesta tela)
    $busca_servidor = true;
    $mostra_concluir = $chicoteAtual !== null && $busca === '';
    $tipo_links = [
        // clicar no botão já ativo volta a listar todos os tipos
        'singelo' => $rotaPainel(['tipo' => $tipo === 'singelo' ? null : 'singelo']),
        'multi'   => $rotaPainel(['tipo' => $tipo === 'multi' ? null : 'multi']),
    ];
@endphp

<div class="topo">
    <div class="w-100 m-auto">
        <h1 class="text-center">Confecção de cabos</h1>
        <h2 class="text-center">{{ $projeto->num_projeto }} - {{ $projeto->nome_projeto }}</h2>
    </div>
</div>

@include('partials.toolbar')

@if ($busca !== '')
    <div class="alert alert-dark d-flex justify-content-between align-items-center mx-4 mt-3 mb-0">
        <span>
            Resultados para "<strong>{{ $busca }}</strong>" em todo o painel {{ $selected_panel }}:
            {{ $totalBusca }} cabo(s)
            @if ($totalBusca > $cabos->count())
                &mdash; mostrando os primeiros {{ $cabos->count() }}. Refine a busca.
            @endif
        </span>
        <a class="btn btn-sm btn-outline-light" href="{{ $rotaPainel(['tipo' => $tipo]) }}">Limpar busca</a>
    </div>
@endif

<table class="table table-dark tabela">
    <thead>
        <tr class="tabela__head">
            <th class="col-chicote">
                <div class="d-flex align-items-center justify-content-center">
                    Chicote
                    <div class="dropdown m-2">
                        <button class="btn dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-size">
                            @forelse ($chicotes as $c)
                                <li>
                                    <a class="dropdown-item {{ $chicoteAtual && $chicoteAtual->wire_harness === $c->wire_harness ? 'active' : '' }}"
                                       href="{{ $rotaPainel(['chicote' => $c->wire_harness, 'tipo' => $tipo]) }}">
                                        {{ $c->wire_harness }}
                                        <small class="opacity-75">({{ $c->feitos }}/{{ $c->total }})</small>
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item disabled">Nenhum chicote</span></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </th>
            <th class="col-anilha text-center align-middle">Anilha</th>
            <th class="col-secao text-center align-middle">Seção transversal</th>
            <th class="col-terminal-origem text-center align-middle">Terminal Origem</th>
            <th class="col-comp-origem text-center align-middle">Componente Origem</th>
            <th class="col-terminal-destino text-center align-middle">Terminal Destino</th>
            <th class="col-comp-destino text-center align-middle">Componente Destino</th>
            <th class="col-status text-center align-middle">Status</th>
            <th class="text-center align-middle" hidden>Painel</th>
        </tr>
    </thead>

    <tbody class="table-group-divider" id="resultsFound">
        @forelse ($cabos as $cabo)
            {{-- Sem segunda <tr> e sem onclick inline: o detalhe é montado no clique (confeccao-detalhe.js) --}}
            <tr class="cabo-row align-middle text-center" style="cursor: pointer"
                data-id="{{ $cabo->id }}"
                data-color="{{ $cabo->color }}"
                data-length="{{ $cabo->length }}"
                data-origin-dir="{{ $cabo->origin_direction }}"
                data-target-dir="{{ $cabo->target_direction }}"
                data-origin-term="{{ $cabo->origin_terminal_type }}"
                data-target-term="{{ $cabo->target_terminal_type }}">

                <td class="col-chicote item-filtro item-visivel {{ $cabo->wire_harness }}" data-id="{{ $cabo->id }}"><p>{{ $cabo->wire_harness }}</p></td>
                <td class="col-anilha"><p>{{ $cabo->tag }}</p></td>
                <td class="col-secao"><p>{{ $cabo->cable_cross_section }}</p></td>
                <td class="col-terminal-origem"><p>{{ $cabo->origin_terminal_type }}</p></td>
                <td class="col-comp-origem"><p>{{ $cabo->origin }}</p></td>
                <td class="col-terminal-destino"><p>{{ $cabo->target_terminal_type }}</p></td>
                <td class="col-comp-destino"><p>{{ $cabo->target }}</p></td>
                <td class="col-status">
                    <div class="d-flex w-100 justify-content-center align-items-start">
                        <button type="submit" class="cable-done-button" data-id="{{ $cabo->id }}" id="cableId{{ $cabo->id }}">
                            <p>
                                <i class="{{ $cabo->isdone == 0 ? 'fa-regular red-icon' : 'fa-solid green-icon' }} fa-circle fa-xl cable-done-icon"></i>
                            </p>
                        </button>
                    </div>
                </td>
                <td hidden>
                    <div class="d-flex w-100 justify-content-center align-items-start">
                        <p class="panel-text">{{ $cabo->panel }}</p>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center py-4">
                    {{ $busca !== '' ? 'Nenhum cabo encontrado para essa busca.' : 'Nenhum cabo neste painel.' }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- <script src="{{ asset('js/confeccao-detalhe.js') }}" defer></script> --}}
@endsection