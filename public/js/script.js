function escolher_tipo(){
    var escolha = document.getElementById('tipo')
    if (escolha.value == 'Armário'){
        teto.disabled = false
        teto.hidden = false
        flange.disabled = true
        flange.hidden = true
        // console.log(escolha.value)
    }
    else if (escolha.value == 'Quadro'){
        flange.disabled = false
        flange.hidden = false
        teto.disabled = true
        teto.hidden = true
        // console.log(escolha.value)
    }
    else{
        flange.disabled = true
        flange.hidden = true
        teto.disabled = true
        teto.hidden = true
    }

    var proximo_campo = document.getElementById('area')
    proximo_campo.disabled = false
}

function escolher_area(){
    var processo = document.getElementById('processo')
    processo.disabled = false

    var valor_area = document.getElementById('area')

    var pre = document.getElementById('Pre')
    var inicio = document.getElementById('Inicio')
    var final = document.getElementById('Final')
    var placa = document.getElementById('Placa')
    var flange = document.getElementById('flange')
    var teto = document.getElementById('teto')
    var porta = document.getElementById('Porta')
    var escolha = document.getElementById('tipo')
    var fabricacao = document.getElementById('Fabricacao')
    var instalacao = document.getElementById('Instalacao')
    var pendencia = document.getElementById('Pendencia')
    var teste = document.getElementById('Teste')


    switch(valor_area.value){

        case "Estrutura":
            pre.disabled = true
            pre.hidden = true
            inicio.hidden = false
            inicio.disabled = false
            final.hidden = false
            final.disabled = false
            placa.hidden = true
            placa.disabled = true
            porta.hidden = true
            porta.disabled = true
            teto.disabled = true
            teto.hidden = true
            flange.disabled = true
            flange.hidden = true
            fabricacao.hidden = true
            fabricacao.disabled = true
            instalacao.hidden = true
            instalacao.disabled = true
            pendencia.hidden = true
            pendencia.disabled = true
            teste.hidden = true
            teste.disabled = true
            break

        case "Oficina":
            pre.disabled = true
            pre.hidden = true
            inicio.hidden = true
            inicio.disabled = true
            final.hidden = true
            final.disabled = true
            placa.hidden = false
            placa.disabled = false
            porta.hidden = false
            porta.disabled = false
            fabricacao.hidden = true
            fabricacao.disabled = true
            instalacao.hidden = true
            instalacao.disabled = true
            pendencia.hidden = true
            pendencia.disabled = true
            teste.hidden = true
            teste.disabled = true
            break

        case "Produção":
            pre.disabled = true
            pre.hidden = true
            inicio.hidden = true
            inicio.disabled = true
            final.hidden = true
            final.disabled = true
            placa.hidden = true
            placa.disabled = true
            porta.hidden = true
            porta.disabled = true
            teto.disabled = true
            teto.hidden = true
            flange.disabled = true
            flange.hidden = true
            fabricacao.hidden = false
            fabricacao.disabled = false
            instalacao.hidden = false
            instalacao.disabled = false
            pendencia.hidden = false
            pendencia.disabled = false
            teste.hidden = false
            teste.disabled = false
            break

        case "Almoxarifado":
            pre.disabled = false
            pre.hidden = false
            inicio.hidden = true
            inicio.disabled = true
            final.hidden = true
            final.disabled = true
            placa.hidden = true
            placa.disabled = true
            porta.hidden = true
            porta.disabled = true
            teto.disabled = true
            teto.hidden = true
            flange.disabled = true
            flange.hidden = true
            fabricacao.hidden = true
            fabricacao.disabled = true
            instalacao.hidden = true
            instalacao.disabled = true
            pendencia.hidden = true
            pendencia.disabled = true
            teste.hidden = true
            teste.disabled = true
            break
    }
}

function limpar_input_tarefa(){
    document.getElementById('id_projeto').value = ''
}

function limpar_div(){
    let div = document.getElementById('tarefas')
    div.innerText = ""
}

function Habilita_paineis(){
    sim = document.getElementById('sim')
    nao = document.getElementById('nao')
    paineis = document.getElementById('paineis')

    if (sim.checked) {
        paineis.hidden = false
    }else{
        paineis.hidden = true
    }
}

function Habilita_prazo(){
    sim = document.getElementById('sim_prazo')
    nao = document.getElementById('nao_prazo')
    prazo = document.getElementById('prazo')

    if (sim.checked) {
        prazo.hidden = false
    }else{
        prazo.hidden = true
    }
}

function Habilita_prazo_pendencia(){
    sim = document.getElementById('sim')
    nao = document.getElementById('nao')
    paineis = document.getElementById('paineis')

    if (sim.checked) {
        prazo.hidden = false
    }else{
        prazo.hidden = true
    }
}

const isCabletype = document.getElementById('cableType')
if (isCabletype) {
    isCabletype.addEventListener('change', function() {
        $.ajax({
            url: "{{ route('roteamento', ['id'=> $projeto->id]) }}",
            type: "GET",
        })
    });
}

function toggleCollapse(id) {
    const element = document.getElementById(id);
    const collapse = bootstrap.Collapse.getOrCreateInstance(element);
    collapse.toggle();
}

$('document').ready(function() {
    const charactere = '=-';
    $('table tbody tr[data-id]').each(function() {
        const $mainRow = $(this);
        const mainRowId = $mainRow.data('id');
        const cableType = $mainRow.find('td:nth-child(1) p').text();
        const $detailRow = $('table tbody tr[data-child-id="' + mainRowId + '"]');

        const shouldHideRow = cableType.includes(charactere);

        if (shouldHideRow) {
            $mainRow.hide();
            if ($detailRow.length) {
                $detailRow.hide();
            }
        } else {
            $mainRow.show();
            $detailRow.show();
        }
    });
});

$('.filtro-opcao').click(function(e) {
    e.preventDefault();

    var filtro = $(this).data('filtro');
    $('table tbody tr[data-id]').each(function() {
        const $mainRow = $(this);
        const mainRowId = $mainRow.data('id');
        const $detailRow = $('table tbody tr[data-child-id="' + mainRowId + '"]');

        var categoria = $(this).find('.item-filtro p').text();

        if (filtro === 'todos' || categoria === filtro) {
            $mainRow.show();
            $detailRow.show();
            if (filtro === 'todos'){
                $('#alterarStatus').addClass('d-none');
            } else {
                $('#alterarStatus').removeClass('d-none');
            }
            console.log('Exibindo: ' + categoria);
        } else {
            $mainRow.hide();
            $detailRow.hide();
        }
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#alterarStatus').on('click', function() {
    $('table tbody tr:visible').each(function() {
        const icon = $(this).find('.status-icon');
        const id = $(this).data('id');

        if (id) {
            $.ajax({
                url: 'alterarStatus/'+ id,
                type: 'POST',
                success: function() {
                    console.log('Cabo ' + id + ' atualizado com sucesso.');
                    icon.removeClass('fa-regular red-icon');
                    icon.addClass('fa-solid green-icon');
                },
                error: function(error) {
                    console.error('Erro ao atualizar cabo ' + id + ':', error);
                },
            });
        }
    });
});

$('.cable-start-button').on('click', function(e) {
    e.preventDefault();
    const $button = $(this); 
    const id = $button.data('id');
    const $startIcon = $button.find('.cable-start-button-icon'); 

    const iconId = 'cableId' + id;
    const $statusIcon = $('#' + iconId);
    
    let originValueFromButton = $button.data('origin-value');
    
    let valueToSend;
    if (originValueFromButton == "1") {
        valueToSend = 1; 
    } else {
        valueToSend = -1; 
    }

    if (id) {
        $.ajax({
            url: "origem/{id}".replace('{id}', id),
            type: 'POST',
            data: {
                origin_value: valueToSend,  
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Alteração feita:', response);
                if(response.success){
                    const newStatus = response.new_status;
                    console.log(newStatus);
                    $startIcon.toggleClass('red-icon green-icon');
                    $statusIcon.removeClass('fa-regular fa-solid fa-circle fa-circle-half-stroke red-icon yellow-icon green-icon');

                    if (newStatus === 0) {
                        $statusIcon.addClass('fa-regular fa-circle red-icon');
                    } else if (newStatus === 1) {
                        $statusIcon.addClass('fa-solid fa-circle-half-stroke yellow-icon');
                    } else {
                        $statusIcon.addClass('fa-solid fa-circle green-icon');
                    }

                    $button.data('origin-value', valueToSend * -1);
                    console.log('Novo data-origin-value do botão (após update):', $button.data('origin-value'));
                }
            },
            error: function(xhr) {
                console.log('Erro:', xhr);
            }
        });
    }
});

$('.cable-end-button').on('click', function(e) {
    e.preventDefault();
    const $button = $(this); 
    const id = $button.data('id');
    const $endIcon = $button.find('.cable-end-button-icon'); 

    const iconId = 'cableId' + id;
    const $statusIcon = $('#' + iconId);
    
    let targetValueFromButton = $button.data('target-value');
    
    let valueToSend;
    if (targetValueFromButton == "1") {
        valueToSend = 1; 
    } else {
        valueToSend = -1; 
    }

    if (id) {
        $.ajax({
            url: "destino/{id}".replace('{id}', id),
            type: 'POST',
            data: {
                target_value: valueToSend,  
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Alteração feita:', response);
                if(response.success){
                    const newStatus = response.new_status;
                    $endIcon.toggleClass('red-icon green-icon');
                    console.log(newStatus);
                    $statusIcon.removeClass('fa-regular fa-solid fa-circle fa-circle-half-stroke red-icon yellow-icon green-icon');

                    if (newStatus === 0) {
                        $statusIcon.addClass('fa-regular fa-circle red-icon');
                    } else if (newStatus === 1) {
                        $statusIcon.addClass('fa-solid fa-circle-half-stroke yellow-icon');
                    } else {
                        $statusIcon.addClass('fa-solid fa-circle green-icon');
                    }

                    $button.data('target-value', valueToSend * -1);
                    console.log('Novo data-target-value do botão (após update):', $button.data('target-value'));
                }
            },
            error: function(xhr) {
                console.log('Erro:', xhr);
            }
        });
    }
});

$('.finish-button').on('click', function(e) {
    e.preventDefault();
    const $button = $(this); 
    const id = $button.data('id');
    const $finishIcon = $button.find('.status-icon');

    // Obtém a linha pai do botão
    const $parentRow = $button.closest('tr');
    // Encontra a linha colapsada associada
    const $collapsedRow = $parentRow.next('.collapsedRow');
    // Procura dentro da linha colapsada para encontrar o div que contém os botões
    const $collapsedContentDiv = $collapsedRow.find('.collapsedRow_div');

    // Obtém o botãos de origem dentro do conteúdo colapsado
    const $startButton = $collapsedContentDiv.find('.cable-start-button');
    // Obtém o ícone do botão da ponta de origem do cabo
    const $startIcon = $startButton.find('.cable-start-button-icon');

    // Obtém o botão de destino dentro do conteúdo colapsado
    const $endButton = $collapsedContentDiv.find('.cable-end-button');
    // Obtém o ícone do botão da ponta de destino do cabo 
    const $endIcon = $endButton.find('.cable-end-button-icon');

    if (id) {
        $.ajax({
            url: "finalizaCabo/{id}".replace('{id}', id),
            type: 'POST',
            data: {

                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Cabo finalizado:', response);
                if(response.success){
                    const newStatus = response.new_status;
                    $finishIcon.removeClass('fa-regular fa-solid fa-circle fa-circle-half-stroke red-icon yellow-icon green-icon');
                    $startIcon.removeClass('red-icon green-icon');
                    $endIcon.removeClass('red-icon green-icon');
                    if (newStatus === 0) {
                        $finishIcon.addClass('fa-regular fa-circle red-icon');
                        $startIcon.addClass('red-icon');
                        $endIcon.addClass('red-icon');
                    } else {
                        $finishIcon.addClass('fa-solid fa-circle green-icon');
                        $startIcon.addClass('green-icon');
                        $endIcon.addClass('green-icon');
                    }
                }
            },
            error: function(xhr) {
                console.log('Erro:', xhr);
            }
        });
    }
});

$('.cable-done-button').on('click', function() {
    const $button = $(this);
    const id = $button.data('id');
    const $icon = $button.find('.cable-done-icon');

    if (id) {
        $.ajax({
            url: "cableDone/{id}".replace('{id}', id),
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Cabo feito:', response);
                if(response.success){
                    const doneStatus = response.done_status;
                    $icon.removeClass('fa-regular fa-solid fa-circle fa-circle-half-stroke red-icon yellow-icon green-icon');

                    if (doneStatus === 0) {
                        $icon.addClass('fa-regular fa-circle red-icon');
                    } else {
                        $icon.addClass('fa-solid fa-circle green-icon');
                    }
                }
            },
            error: function(xhr) {
                console.log('Erro:', xhr);
            }
        });
    }
});

$('.single').click(function() {
    const single = $(this);
    const toolbar = single.closest('.toolbar');
    const multi = toolbar.find('.multi');
    const charactere = '=-';
    
    single.attr('disabled', 'disabled');
    multi.removeAttr('disabled'); 

    $('table tbody tr[data-id]').each(function() {
        const $mainRow = $(this);
        const mainRowId = $mainRow.data('id');
        const cableType = $mainRow.find('td:nth-child(1) p').text();
        const $detailRow = $('table tbody tr[data-child-id="' + mainRowId + '"]');

        const shouldHideRow = cableType.includes(charactere);

        if (shouldHideRow) {
            $mainRow.hide();
            if ($detailRow.length) {
                $detailRow.hide();
            }
        } else {
            $mainRow.show();
            $detailRow.show();
        }
    });
});

$('.multi').click(function() {
    const multi = $(this);
    const toolbar = multi.closest('.toolbar');
    const single = toolbar.find('.single');

    multi.attr('disabled', 'disabled');
    single.removeAttr('disabled'); 

    const charactere = '=-';

    $('table tbody tr[data-id]').each(function() {
        const $mainRow = $(this);
        const mainRowId = $mainRow.data('id');
        const cableType = $mainRow.find('td:nth-child(1) p').text(); 

        const $detailRow = $('table tbody tr[data-child-id="' + mainRowId + '"]');

        const shouldHideRow = cableType.includes(charactere);

        if (!shouldHideRow) {
            $mainRow.hide(); 
            $detailRow.hide();
        } else {
            $mainRow.show();
            $detailRow.show();
        }
    });
});

let debounceTimer;
$(document).ready(function(){
    $('#search').on('keyup', function(){
        clearTimeout(debounceTimer);
        let query = $(this).val();
        debounceTimer = setTimeout(function() {
            if (query){
                $('table tbody tr[data-id]').each(function() {
                    const $mainRow = $(this);
                    const mainRowId = $mainRow.data('id');
                    const $detailRow = $('table tbody tr[data-child-id="' + mainRowId + '"]');

                    const wireHarness = $mainRow.find('td:nth-child(1) p').text().toUpperCase();
                    const searchQuery = query.toUpperCase();

                    if (wireHarness.includes(searchQuery)) {
                        $mainRow.show();
                        $detailRow.show();
                    } else {
                        $mainRow.hide();
                        $detailRow.hide();
                    }
                });
            }else{
                $('table tbody tr[data-id]').show();
                $('table tbody tr[data-child-id]').show();
            }
        }, 500);
    });
});