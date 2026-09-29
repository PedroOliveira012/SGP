@extends('index.index')

@section('conteudo')

    <div class="container">
        <h1>Detalhes da Tarefa</h1>

        <div class="card card-box">
            <div class="card-body card-box-body">
                <div class="d-flex mb-3 project-info">
                    <aside class="d-flex align-items-center me-3">
                        <i class="fa-regular fa-folder-closed fa-2xl" style="color: #00aac0;"></i>
                    </aside>
                    <section>
                        <p class="card-text-title">PROJETO</p>
                        <p class="card-text-subtitle">{{ $projeto->num_projeto }}</p>
                        <p class="card-text">{{ $projeto->nome_projeto }}</p>
                    </section>
                </div> 
                <div class="d-flex mb-3 task-details">
                    <aside class="d-flex align-items-center me-3">
                        <i class="fa-regular fa-clipboard fa-2xl" style="color: #00aac0;"></i>
                    </aside>
                    <div class="w-100">
                        <section>
                            <p class="card-text-title">TAREFA</p>
                            <p class="card-text"><strong>{{ $tarefa->tarefa }}</strong></p>
                        </section>

                        <section class="d-flex gap-3 mt-3 w-100">
                            <div class="info-box flex-fill d-flex align-items-center">
                                <i class="fa-solid fa-toilet-portable fa-xl me-3" style="color: #00aac0;"></i>
                                <div>
                                    <p class="mb-0 card-text-title">PAINEL</p>
                                    <p class="card-text mb-0"><strong>{{ $tarefa->painel }}</strong></p>
                                </div>
                            </div>

                            <div class="info-box flex-fill d-flex align-items-center">
                                @php
                                    $icone = match($tarefa->status) {
                                        'concluído', 'concluido' => ['fa-solid fa-circle-check', '#00aac0'],
                                        'pendente' => ['fa-solid fa-clock-rotate-left', '#ec720b'],
                                        default => ['fa-regular fa-circle-xmark', '#f25252'],
                                    };
                                @endphp

                                <i class="{{ $icone[0] }} fa-xl me-3" style="color: {{ $icone[1] }};"></i>
                                <div>
                                    <p class="mb-0 card-text-title">STATUS</p>
                                    <p class="card-text mb-0"><strong>{{ $tarefa->status }}</strong></p>
                                </div>
                            </div>

                            <div class="info-box flex-fill d-flex align-items-center">
                                <i class="fa-regular fa-calendar-days fa-xl me-3" style="color: #00aac0;"></i>
                                <div>
                                    <p class="mb-0 card-text-title">PRAZO</p>
                                    <p class="card-text mb-0"><strong>{{ $tarefa->prazo ?? '--' }}</strong></p>
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
                <div>
                    <section class="d-flex mb-2 mt-2 start-finish-dates">
                        <div class="d-flex">
                            <span>
                                <i class="fa-regular fa-calendar fa-xl me-2" style="color: #00aac0;"></i>
                            </span>
                            <p><strong>Data de inicio: </strong> {{ $tarefa->inicio_tarefa ?? '--' }} </p>
                        </div>
                        <div class="d-flex">
                            <span>
                                <i class="fa-regular fa-calendar fa-xl me-2" style="color: #00aac0;"></i>
                            </span>
                            <p><strong>Data de termino: </strong> {{ $tarefa->termino_tarefa ?? '--' }} </p>
                        </div>
                    </section>
                    <section class="d-flex align-items-start mb-2 mt-4">
                        <div class="d-flex align-items-center me-3 ">
                            <span>
                                <i class="fa-regular fa-comment-dots fa-2xl" style="color: #00aac0;"></i>
                            </span>
                        </div>
                        <div>
                            <p class="card-text-title">OBSERVAÇÕES</p>
                        </div>
                    </section>
                    <textarea class="form-control" rows="3" readonly style="background-color: #404040; color: #fff;">{{ $tarefa->Notas ?? '--' }}</textarea>
                </div>         
            </div>
        </div>
    </div>
@endsection