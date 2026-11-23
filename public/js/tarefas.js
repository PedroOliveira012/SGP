/* =====================================================================
   tarefas.js — filtros e formulário de tarefas
   Depende de: jQuery
   ===================================================================== */

/* ---------- Filtros da lista de tarefas ---------- */

let currentFilters = {
    tipo: null,
    area: null,
    processo: null
};

// Função única para aplicar todos os filtros
function applyFilters() {
    // Itera sobre TODOS os elementos
    $('div .resultado-tarefas label').each(function() {
        const task = $(this);
        const taskType = task.data('tipo');
        const taskArea = task.data('area');
        const taskProcess = task.data('process');
        
        let shouldShow = true;

        // Verifica o filtro de tipo
        if (currentFilters.tipo && currentFilters.tipo !== taskType) {
            shouldShow = false;
        }

        // Verifica o filtro de área
        if (currentFilters.area && currentFilters.area !== taskArea) {
            shouldShow = false;
        }

        // Verifica o filtro de processo
        if (currentFilters.processo && currentFilters.processo !== taskProcess) {
            shouldShow = false;
        }

        // Exibe ou esconde o elemento com base na verificação
        if (shouldShow) {
            task.show();
        } else {
            task.hide();
        }
    });
}

// Event Listeners para atualizar os filtros e chamar a função principal
$('#tipo').on('change', function() {
    currentFilters.tipo = $(this).val();
    console.log('Tipo selecionado:', currentFilters.tipo);
    applyFilters();
});

$('#area').on('change', function() {
    currentFilters.area = $(this).val();
    console.log('Area selecionada:', currentFilters.area);
    applyFilters();
});

$('#processo').on('change', function() {
    currentFilters.processo = $(this).val();
    console.log('Processo selecionado:', currentFilters.processo);
    applyFilters();
});


/* ---------- Formulário de nova tarefa ---------- */

$('.deadline-radio').on('click', function() {
    // Encontra o input de rádio que está marcado dentro de .yes-no-options
    const selectedInput = $('.yes-no-options input[name="example-radio"]:checked');
    const selectedValue = selectedInput.val();

    if (selectedValue === 'sim') {
        $('#prazo').removeClass('invisible');
    } else {
        $('#prazo').addClass('invisible');
    }
});

// (No script.js original esta função estava declarada duas vezes, idêntica.)
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

function Habilita_paineis(){
    sim = document.getElementById('sim_painel')
    nao = document.getElementById('nao_painel')
    painel = document.getElementById('paineis')

    if (sim.checked) {
        painel.hidden = false
    }else{
        painel.hidden = true
    }
}

// Usa como globais os elementos com id inicio, final, placa, porta, etc. (window[id])
function escolher_area(){
    switch(valor_area.value){

        case "Estrutura":
            inicio.hidden = false
            final.hidden = false
            break

        case "Oficina":
            placa.hidden = false
            porta.hidden = false
            break

        case "Produção":
            fabricacao.hidden = false
            instalacao.hidden = false
            pendencia.hidden = false
            teste.hidden = false
            break

        case "Almoxarifado":
            pre.hidden = false
            break
    }
}

function limpar_div(){
    let div = document.getElementById('tarefas')
    div.innerText = ""
}
