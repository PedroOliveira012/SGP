/* =====================================================================
   core.js — base compartilhada por todas as telas
   Carregar PRIMEIRO (depois do jQuery e do Bootstrap).
   ===================================================================== */

// Token CSRF em todas as requisições AJAX do jQuery
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Abre/fecha um collapse do Bootstrap pelo id.
// Mantida global porque algumas views ainda a chamam via onclick inline.
function toggleCollapse(id) {
    const element = document.getElementById(id);
    const collapse = bootstrap.Collapse.getOrCreateInstance(element);
    collapse.toggle();
}
