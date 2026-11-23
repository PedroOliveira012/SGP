/* =====================================================================
   cabos-status.js — ações de status dos cabos (confeccionado, conectado, finalizado)
   Depende de: jQuery, core.js e cabos-tabela.js (atualizaProgresso, getCache)
   ===================================================================== */

// Botão para concluir o status de mais de um cabo (confeccionado ou conectado)
// ATENÇÃO: dispara 1 POST por cabo visível. O ideal é um endpoint em lote.
$('#alterarStatus').on('click', function() {
    $(getCache().linhas.filter(l => !l.tr.hidden).map(l => l.tr)).each(function() {
        let icon = $(this).find('.status-icon');

        let url = window.location.pathname.split("/");
        url[url.length - 2] = 'alterarStatus';

        if (icon.length === 0) {
            icon = $(this).find('.cable-done-icon');
            url[url.length - 2] = "cableDone";
        }
        const id = $(this).data('id');
        
        url[url.length - 1] = id;
        url = url.join("/")

        if (id) {
            $.ajax({
                url: url,
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

// Botão para marcar que o início foi conectado
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

    let url = window.location.pathname.split("/");
    url[url.length - 2] = "origem";
    url[url.length - 1] = id;
    url = url.join("/");

    if (id) {
        $.ajax({
            url: url,
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
                    atualizaProgresso();

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

// Botão para marcar que o final do cabo foi conectado
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

    let url = window.location.pathname.split("/");
    url[url.length - 2] = "destino";
    url[url.length - 1] = id;
    url = url.join("/");

    if (id) {
        $.ajax({
            url: url,
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
                    atualizaProgresso();

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

// Botão para marcar cabo como finalizado
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

    // Obtém o botão de origem dentro do conteúdo colapsado
    const $startButton = $collapsedContentDiv.find('.cable-start-button');
    // Obtém o ícone do botão da ponta de origem do cabo
    const $startIcon = $startButton.find('.cable-start-button-icon');

    // Obtém o botão de destino dentro do conteúdo colapsado
    const $endButton = $collapsedContentDiv.find('.cable-end-button');
    // Obtém o ícone do botão da ponta de destino do cabo 
    const $endIcon = $endButton.find('.cable-end-button-icon');

    let url = window.location.pathname.split("/");
    url[url.length - 2] = "finalizaCabo";
    url[url.length - 1] = id;
    url = url.join("/");

    if (id) {
        $.ajax({
            url: url,
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
                    atualizaProgresso();
                }
            },
            error: function(xhr) {
                console.log('Erro:', xhr);
            }
        });
    }
});

// Botão para marcar cabo como confeccionado
// Delegação de evento: um listener só, em vez de um por botão.
$(document).on('click', '.cable-done-button', function() {
    const $button = $(this);
    const id = $button.data('id');
    const $icon = $button.find('.cable-done-icon');

    let url = window.location.pathname.split('/');
    url[url.length - 2] = "cableDone";
    url[url.length - 1] = id;
    url = url.join("/");

    if (id) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success){
                    const doneStatus = response.done_status;
                    $icon.removeClass('fa-regular fa-solid red-icon green-icon');

                    if (doneStatus === 0) {
                        $icon.addClass('fa-regular fa-circle red-icon');
                    } else {
                        $icon.addClass('fa-solid fa-circle green-icon');
                    }
                    atualizaProgresso();
                }
            },
            error: function(xhr) {
                console.log('Erro:', xhr);
            }
        });
    }
});
