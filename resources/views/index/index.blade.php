<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{ asset('css/index.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/backup.css') }}">
        <title>SGP</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/05b56d1101.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid navbar__div">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navbar__div--menu" id="navbarSupportedContent">
                    <button class="btn btn-primary btn-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                        <i class="fa-solid fa-bars icone-menu"></i>
                    </button>
                    {{-- <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar__div--list">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle navbar__div__link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->cargo == 'Admin')
                                    <li><a class="dropdown-item" href="{{ url('/diretoria/index') }}">Diretoria</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/andamento') }}">Em andamento</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/liberados') }}">Liberados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/teste') }}">Fase de teste</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/encerrados') }}">Encerrados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/tarefas/index') }}">Controle de tarefas</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="dropdown-item">Configurações</li>
                                @elseif (Auth::user()->cargo == 'Diretor')
                                    <li><a class="dropdown-item" href="{{ url('/diretoria/index') }}">Diretoria</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/andamento') }}">Em andamento</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/liberados') }}">Liberados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/teste') }}">Fase de teste</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/encerrados') }}">Encerrados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/tarefas/index') }}">Controle de tarefas</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @elseif (Auth::user()->cargo == 'Coordenador de Engenharia')
                                    <li><a class="dropdown-item" href="{{ url('/projeto/andamento') }}">Em andamento</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/liberados') }}">Liberados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/teste') }}">Fase de teste</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/encerrados') }}">Encerrados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/tarefas/index') }}">Controle de tarefas</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @elseif (Auth::user()->cargo == 'Coordenador de Produção / Montador')
                                    <li><a class="dropdown-item" href="{{ url('/projeto/liberados') }}">Liberados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/teste') }}">Fase de teste</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/encerrados') }}">Encerrados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/tarefas/index') }}">Controle de tarefas</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/funcionarios/index') }}">Pagina de Funcionarios</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @elseif (Auth::user()->cargo == 'Líder de Oficina Mecânica / Montador' || Auth::user()->cargo == 'Líder de Testes / Montador' || Auth::user()->cargo == 'Líder de Montagem / Montador' )
                                    <li><a class="dropdown-item" href="{{ url('/tarefas/index') }}">Controle de tarefas</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/teste') }}">Fase de teste</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/funcionarios/index') }}">Pagina de Funcionarios</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @elseif (Auth::user()->cargo == 'Analista')
                                    <li><a class="dropdown-item" href="{{ url('/projeto/andamento') }}">Em andamento</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/liberados') }}">Liberados</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/teste') }}">Fase de teste</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/projeto/encerrados') }}">Encerrados</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @else
                                   <li><a class="dropdown-item" href="{{ url('/funcionarios/index') }}">Pagina de Funcionarios</a></li>
                                @endif

                            </ul>
                        </li>
                    </ul> --}}
                </div>
                <div class="navbar__div--img">
                    <img src="{{asset('logo/logo.png')}}" class="logo">
                </div>
            </div>
        </nav>
        <div class="offcanvas offcanvas-end text-bg-dark" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="staticBackdropLabel">Menu</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="accordion accordion-flush text-bg-dark"id="accordionExample">
                    @if (Auth::user()->nivel_acesso >= 4)
                        <div class="accordion-item text-light">
                            <h2 class="accordion-header text-light">
                                <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Diretoria
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse bg-dark" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/diretoria/index') }}">Home</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->nivel_acesso >=2)
                        <div class="accordion-item text-light">
                            <h2 class="accordion-header text-light">
                                <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Projetos
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse bg-dark" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/projeto/andamento') }}">Em andamento</a></li>
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/projeto/liberados') }}">Liberados</a></li>
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/projeto/teste') }}">Fase de teste</a></li>
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/projeto/encerrados') }}">Encerrados</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="accordion-item text-light">
                        <h2 class="accordion-header text-light">
                            <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Tarefas
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse bg-dark" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    @if (Auth::user()->nivel_acesso >= 2)
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/tarefas/index') }}">Controle de tarefas</a></li>
                                    @else
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/funcionarios/index') }}">Tarefas designadas</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-light">
                            <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                Chamados
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse bg-dark" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    {{-- @if (Auth::user()->nivel_acesso >= 2)
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/tarefas/index') }}">Controle de tarefas</a></li>
                                    @else
                                        <li class="list-group-item text-bg-dark"><a href="{{ url('/funcionarios/index') }}">Tarefas designadas</a></li>
                                    @endif --}}
                                    <li class="list-group-item text-bg-dark"><a href="{{ url('/chamados/lista') }}">Chamados</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                    </div>
                </div>
                <div class="hist-notificacao">
                    <div class="notificacao-nao-lida">
                        1 Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                    <div class="separador"></div>
                    <div class="notificacao-lida">
                        2 Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                    <div class="separador"></div>
                    <div class="notificacao-lida">
                        3 Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                    <div class="separador"></div>
                    <div class="notificacao-nao-lida">
                        4 Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                    <div class="separador"></div>
                    <div class="notificacao-lida">
                        5 Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                    <div class="separador"></div>
                    <div class="notificacao-nao-lida">
                        6 Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                    <div class="separador"></div>
                    <div class="notificacao-nao-lida">
                        7 Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                </div>
            </div>
            <footer class="rodape">
                <?=Auth::user()->name?>
                <a href="{{ url('/sair') }}">
                    <button class="btn btn-danger btn-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                        <i class="fa-solid fa-arrow-right-from-bracket icone-logout"></i>
                    </button>
                </a>
            </footer>
        </div>
        @yield('conteudo')
    </body>
</html>
