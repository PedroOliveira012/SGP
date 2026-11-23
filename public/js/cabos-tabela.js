// /* =====================================================================
//    cabos-tabela.js — tabela de cabos: cache, filtros, busca e progresso
//    Depende de: jQuery, core.js
//    Deve carregar ANTES de cabos-status.js (que usa atualizaProgresso).

//    Desempenho: varre o DOM UMA vez e guarda tudo em memória, em vez de fazer
//    buscas globais ($('...')) dentro de loops sobre as ~2200 linhas.
//    ===================================================================== */

// /* ---------- Cache e helpers ---------- */

// // As linhas vêm do servidor e não mudam durante a vida da página.
// let _cacheCabos = null;
// function getCache() {
//     if (_cacheCabos) return _cacheCabos;

//     const detalhes = new Map(); // id do cabo -> <tr> de detalhe (vazio na tela de confecção)
//     document.querySelectorAll('table tbody tr[data-child-id]').forEach(tr => {
//         detalhes.set(tr.dataset.childId, tr);
//     });

//     const linhas = [];
//     document.querySelectorAll('table tbody tr[data-id]').forEach(tr => {
//         const p = tr.querySelector('.item-filtro p');
//         linhas.push({
//             tr,
//             id: tr.dataset.id,
//             chicote: p ? p.textContent.trim() : '',
//         });
//     });

//     _cacheCabos = { linhas, detalhes };
//     return _cacheCabos;
// }

// // Mostra/esconde a linha (e o detalhe, se existir) sem .show()/.hide() do jQuery.
// // O atributo hidden vira display:none (o Bootstrap 5 usa !important para isso).
// function setLinhaVisivel(linha, detalhes, visivel) {
//     linha.tr.hidden = !visivel;
//     const det = detalhes.get(linha.id);
//     if (det) det.hidden = !visivel;
// }

// // Fecha o detalhe aberto sob demanda (confeccao-detalhe.js), se existir.
// function fechaDetalhesSeExistir() {
//     if (typeof window.fechaDetalhesCabo === 'function') window.fechaDetalhesCabo();
// }

// // Contador "Progresso: x/y": 2 consultas no total, em vez de um loop com .find()
// function atualizaProgresso() {
//     const total = document.querySelectorAll('table tbody tr[data-id]').length;
//     const feitos = document.querySelectorAll(
//         'table tbody tr[data-id] .status-icon.green-icon, ' +
//         'table tbody tr[data-id] .cable-done-icon.green-icon'
//     ).length;
//     $('.progress-count').text(feitos + '/' + total);
// }

// // Mostra só as opções do dropdown de chicote que existem nas linhas visíveis.
// // exato=true  -> comparação exata
// // exato=false -> "contém"
// function atualizaOpcoesChicote(chicotesVisiveis, exato) {
//     const lista = [...chicotesVisiveis];
//     document.querySelectorAll('.pluck-option').forEach(opt => {
//         const texto = opt.textContent.trim();
//         const mostrar = exato
//             ? chicotesVisiveis.has(texto)
//             : lista.some(c => texto.includes(c));
//         opt.classList.toggle('d-none', !mostrar);
//     });
// }


// /* ---------- Inicialização ---------- */

// $(function() {
//     const { linhas } = getCache();
//     if (!linhas.length) return; // página sem tabela de cabos

//     atualizaProgresso();

//     const chicotes = new Set(linhas.map(l => l.chicote).filter(Boolean));
//     atualizaOpcoesChicote(chicotes, true);
// });


// /* ---------- Filtro por chicote ---------- */

// $('.filtro-opcao').on('click', function(e) {
//     e.preventDefault();
//     const filtro = this.dataset.filtro;
//     const { linhas, detalhes } = getCache();

//     fechaDetalhesSeExistir();
//     linhas.forEach(l => setLinhaVisivel(l, detalhes, filtro === 'todos' || l.chicote === filtro));

//     $('#alterarStatus').toggleClass('d-none', filtro === 'todos');
// });


// /* ---------- Cabos singelos x multivias (chicotes com '=-' ou 'SH' são multivias) ---------- */

// const MARCAS_MULTIVIAS = ['=-', 'SH'];

// function mostraTipoCabo(multivias) {
//     const { linhas, detalhes } = getCache();
//     const visiveis = new Set();

//     fechaDetalhesSeExistir();
//     linhas.forEach(l => {
//         const ehMulti = MARCAS_MULTIVIAS.some(m => l.chicote.includes(m));
//         const mostrar = multivias ? ehMulti : !ehMulti;
//         setLinhaVisivel(l, detalhes, mostrar);
//         if (mostrar && l.chicote) visiveis.add(l.chicote);
//     });

//     atualizaOpcoesChicote(visiveis, false);
// }

// // Botão para mostrar chicotes de cabos singelos
// $('.single').on('click', function() {
//     $(this).attr('disabled', 'disabled');
//     $(this).closest('.toolbar').find('.multi').removeAttr('disabled');
//     mostraTipoCabo(false);
// });

// // Botão para mostrar chicotes de cabos multivias
// $('.multi').on('click', function() {
//     $(this).attr('disabled', 'disabled');
//     $(this).closest('.toolbar').find('.single').removeAttr('disabled');
//     mostraTipoCabo(true);
// });


// /* ---------- Barra de pesquisa (por chicote) ---------- */

// $(function() {
//     let debounceTimer;
//     $('#search').on('keyup', function() {
//         clearTimeout(debounceTimer);
//         const query = this.value.toUpperCase();

//         debounceTimer = setTimeout(function() {
//             const { linhas, detalhes } = getCache();
//             if (!linhas.length) return; // outras telas usam #search para outra coisa

//             fechaDetalhesSeExistir();
//             linhas.forEach(l => {
//                 setLinhaVisivel(l, detalhes, !query || l.chicote.toUpperCase().includes(query));
//             });
//         }, 300);
//     });
// });


// /* ---------- Troca de painel ---------- */

// $('.panel-cables').on('change', function() {
//     const selectedPanel = $(this).val();
//     console.log('Painel selecionado:', selectedPanel);
//     window.location.href = selectedPanel;
// });

/* =====================================================================
   cabos-tabela.js — tabela de cabos: cache, filtros, busca e progresso
   Depende de: jQuery, core.js
   Deve carregar ANTES de cabos-status.js (que usa atualizaProgresso).

   Desempenho: varre o DOM UMA vez e guarda tudo em memória, em vez de fazer
   buscas globais ($('...')) dentro de loops sobre as linhas.

   Duas telas usam este arquivo:
   - Roteamento: todas as linhas no DOM; filtro/busca/singelo-multi no cliente.
   - Confecção: só o chicote atual (ou o resultado da busca) vem do servidor;
     chicote, tipo e busca são links/formulário (recarregam a página). O contador
     "Progresso" mostra o PAINEL INTEIRO, vindo do servidor em data-total/data-feitos.
   ===================================================================== */

/* ---------- Cache e helpers ---------- */

// As linhas vêm do servidor e não mudam durante a vida da página.
let _cacheCabos = null;
function getCache() {
    if (_cacheCabos) return _cacheCabos;

    const detalhes = new Map(); // id do cabo -> <tr> de detalhe (vazio na tela de confecção)
    document.querySelectorAll('table tbody tr[data-child-id]').forEach(tr => {
        detalhes.set(tr.dataset.childId, tr);
    });

    const linhas = [];
    document.querySelectorAll('table tbody tr[data-id]').forEach(tr => {
        const p = tr.querySelector('.item-filtro p');
        linhas.push({
            tr,
            id: tr.dataset.id,
            chicote: p ? p.textContent.trim() : '',
        });
    });

    _cacheCabos = { linhas, detalhes };
    return _cacheCabos;
}

// Mostra/esconde a linha (e o detalhe, se existir) sem .show()/.hide() do jQuery.
// O atributo hidden vira display:none (o Bootstrap 5 usa !important para isso).
function setLinhaVisivel(linha, detalhes, visivel) {
    linha.tr.hidden = !visivel;
    const det = detalhes.get(linha.id);
    if (det) det.hidden = !visivel;
}

// Fecha o detalhe aberto sob demanda (confeccao-detalhe.js), se existir.
function fechaDetalhesSeExistir() {
    if (typeof window.fechaDetalhesCabo === 'function') window.fechaDetalhesCabo();
}


/* ---------- Progresso ---------- */

// Quantos ícones de "feito" (verdes) existem nas linhas carregadas
function contaIconesVerdes() {
    return document.querySelectorAll(
        'table tbody tr[data-id] .status-icon.green-icon, ' +
        'table tbody tr[data-id] .cable-done-icon.green-icon'
    ).length;
}

// Modo servidor (confecção): o servidor informa o total/feitos do painel (e do
// chicote) em data-*. Guardamos também quantos verdes já vinham no HTML, e a cada
// clique somamos a diferença. Assim o contador do painel inteiro fica correto
// mesmo com só parte das linhas no DOM.
let _progressoServidor = null;

function lerProgressoServidor() {
    const painel = document.querySelector('.progress-count:not(.chicote-count)');
    if (!painel || !painel.dataset.total) return null;

    const chicote = document.querySelector('.chicote-count');
    return {
        painelTotal: Number(painel.dataset.total),
        painelFeitos: Number(painel.dataset.feitos),
        chicoteTotal: chicote ? Number(chicote.dataset.total) : null,
        chicoteFeitos: chicote ? Number(chicote.dataset.feitos) : null,
        verdesIniciais: contaIconesVerdes(),
    };
}

// Contador "Progresso: x/y"
function atualizaProgresso() {
    if (_progressoServidor) {
        const p = _progressoServidor;
        const delta = contaIconesVerdes() - p.verdesIniciais;

        $('.progress-count:not(.chicote-count)').text((p.painelFeitos + delta) + '/' + p.painelTotal);
        if (p.chicoteTotal !== null) {
            $('.chicote-count').text((p.chicoteFeitos + delta) + '/' + p.chicoteTotal);
        }
        return;
    }

    // Modo cliente (roteamento): conta direto nas linhas do DOM
    const total = document.querySelectorAll('table tbody tr[data-id]').length;
    $('.progress-count').text(contaIconesVerdes() + '/' + total);
}

// Mostra só as opções do dropdown de chicote que existem nas linhas visíveis.
// exato=true  -> comparação exata
// exato=false -> "contém"
function atualizaOpcoesChicote(chicotesVisiveis, exato) {
    const lista = [...chicotesVisiveis];
    document.querySelectorAll('.pluck-option').forEach(opt => {
        const texto = opt.textContent.trim();
        const mostrar = exato
            ? chicotesVisiveis.has(texto)
            : lista.some(c => texto.includes(c));
        opt.classList.toggle('d-none', !mostrar);
    });
}


/* ---------- Inicialização ---------- */

$(function() {
    const { linhas } = getCache();
    if (!linhas.length) return; // página sem tabela de cabos (ou busca sem resultado)

    _progressoServidor = lerProgressoServidor();
    atualizaProgresso();

    const chicotes = new Set(linhas.map(l => l.chicote).filter(Boolean));
    atualizaOpcoesChicote(chicotes, true);
});


/* ---------- Filtro por chicote (roteamento; na confecção são links) ---------- */

$('.filtro-opcao').on('click', function(e) {
    e.preventDefault();
    const filtro = this.dataset.filtro;
    const { linhas, detalhes } = getCache();

    fechaDetalhesSeExistir();
    linhas.forEach(l => setLinhaVisivel(l, detalhes, filtro === 'todos' || l.chicote === filtro));

    $('#alterarStatus').toggleClass('d-none', filtro === 'todos');
});


/* ---------- Cabos singelos x multivias (roteamento; na confecção são links) ---------- */

// Chicotes com '=-' ou 'SH' no nome são multivias
const MARCAS_MULTIVIAS = ['=-', 'SH'];

function mostraTipoCabo(multivias) {
    const { linhas, detalhes } = getCache();
    const visiveis = new Set();

    fechaDetalhesSeExistir();
    linhas.forEach(l => {
        const ehMulti = MARCAS_MULTIVIAS.some(m => l.chicote.includes(m));
        const mostrar = multivias ? ehMulti : !ehMulti;
        setLinhaVisivel(l, detalhes, mostrar);
        if (mostrar && l.chicote) visiveis.add(l.chicote);
    });

    atualizaOpcoesChicote(visiveis, false);
}

// Botão para mostrar chicotes de cabos singelos
$('.single').on('click', function() {
    $(this).attr('disabled', 'disabled');
    $(this).closest('.toolbar').find('.multi').removeAttr('disabled');
    mostraTipoCabo(false);
});

// Botão para mostrar chicotes de cabos multivias
$('.multi').on('click', function() {
    $(this).attr('disabled', 'disabled');
    $(this).closest('.toolbar').find('.single').removeAttr('disabled');
    mostraTipoCabo(true);
});


/* ---------- Barra de pesquisa (roteamento: por chicote, no cliente) ---------- */

$(function() {
    let debounceTimer;
    $('#search').on('keyup', function() {
        // Na confecção a busca é feita no servidor (formulário GET, Enter): não filtrar aqui
        if (this.hasAttribute('data-busca-servidor')) return;

        clearTimeout(debounceTimer);
        const query = this.value.toUpperCase();

        debounceTimer = setTimeout(function() {
            const { linhas, detalhes } = getCache();
            if (!linhas.length) return; // outras telas usam #search para outra coisa

            fechaDetalhesSeExistir();
            linhas.forEach(l => {
                setLinhaVisivel(l, detalhes, !query || l.chicote.toUpperCase().includes(query));
            });
        }, 300);
    });
});


/* ---------- Troca de painel ---------- */

$('.panel-cables').on('change', function() {
    const selectedPanel = $(this).val();
    console.log('Painel selecionado:', selectedPanel);
    window.location.href = selectedPanel;
});