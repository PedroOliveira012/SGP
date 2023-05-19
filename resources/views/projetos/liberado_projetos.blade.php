@extends('index.index')

@section('conteudo')
<div class="topo">
    <h1>Projetos liberados para a fábrica</h1>
    <div class="search-and-add">
        <form action="{{ url('/projeto/liberados') }}" method="GET" class="search-and-add__input">
            <input type="text" id="search" name="search" class="form-control " placeholder="Buscar por projetos...">
        </form>
    </div>
</div>
<div>
    <table class="table table-dark table-hover tabela">
        <thead>
            <tr class="tabela__head">
                <th>N° de Projeto</th>
                <th>Cliente</th>
                <th>Unidade</th>
                <th>Nome do Projeto</th>
                <th>Valor Contratado</th>
                <th>Prazo de Entrega (dias)</th>
                <th>Observações</th>
                <th>Responsável</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($lista as $i): ?>
                @if ($i->liberado == 1)
                <tr class="tabela__dados">
                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->num_projeto?></p></a></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->cliente?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->unidade?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line"><p><?= $i->nome_projeto?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line centralizado"><p>R$ <?=number_format($i->valor_contratado,2,',','.')?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->prazo_entrega?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--line"><p><?= $i->observacoes?></p></div>
                    </td>

                    <td>
                        <div class="tabela__dados--line centralizado"><p><?= $i->responsavel?></p></div>
                    </td>
                    <td>
                        <div class="tabela__dados--botoes ">
                            <a class="tabela__dados--link" href="{{ url('/projeto/mostra/' .$i->id) }}"><button type="submit" class="btn btn-primary"><i class="fa-solid fa-bars"></i></button></a>
                        </div>
                    </td>
                </tr>
                @endif
            <?php endforeach?>
        </tbody>
    </table>
</div>
@endsection
