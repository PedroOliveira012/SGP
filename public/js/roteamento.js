/* =====================================================================
   roteamento.js — select de tipo de cabo (roteamento)
   Depende de: jQuery
   ===================================================================== */

const isCabletype = document.getElementById('cableType')
if (isCabletype) {
    isCabletype.addEventListener('change', function() {
        $.ajax({
            // ATENÇÃO: arquivos .js não passam pelo Blade, então esta URL é enviada
            // literalmente. Para funcionar, defina a URL na view, por exemplo:
            //   <select id="cableType" data-url="{{ route('roteamento', ['id' => $projeto->id]) }}">
            // e use aqui: url: isCabletype.dataset.url
            url: "{{ route('roteamento', ['id'=> $projeto->id]) }}",
            type: "GET",
        })
    });
}
