// Detalhe expandido do cabo, montado sob demanda (um listener só no tbody).
(function () {
  const tbody = document.getElementById('resultsFound');
  if (!tbody) return;

  // Mesmas cores da cadeia de @if original. Padrão: brown-cable (MR).
  const CORES = {
    'PT': 'black-cable', '1': 'black-cable', '2': 'black-cable',
    'BR': 'white-cable',
    'AZ CL': 'light-blue-cable',
    'VM': 'red-cable',
    'AM': 'yellow-cable',
    'CZ': 'gray-cable',
    'VD/AM': 'green-yellow-cable',
    'AZ ES': 'dark-blue-cable',
    'LR': 'orange-cable',
    'VI': 'violet-cable',
    'VD': 'green-cable',
    'MR': 'brown-cable',
  };

  // AJUSTE: troque as chaves e ícones pelos valores reais de origin_direction /
  // target_direction e pelo que os partials cabo_collapse(_reverse) renderizam.
  const ICONES_ORIGEM  = { baixo: 'fa-arrow-turn-down', cima: 'fa-arrow-turn-up' };
  const ICONES_DESTINO = { baixo: 'fa-arrow-turn-down', cima: 'fa-arrow-turn-up' };

  const SEM_TERMINAL = 'Pré-Decapado (Sem Terminal)';

  const esc = (s) => String(s ?? '').replace(/[&<>"']/g, (c) => (
    { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]
  ));

  function fechaDetalhes() {
    tbody.querySelectorAll('.detalhe-aberto').forEach((el) => el.remove());
  }

  function montaDetalhe(row) {
    const d = row.dataset;
    const semTerminal = d.originTerm === SEM_TERMINAL;
    const corCabo = CORES[d.color] || 'brown-cable';
    const mostraNumero = d.color === '1' || d.color === '2';
    const numero = mostraNumero ? `<p>${esc(d.color)}</p>` : '';

    const tr = document.createElement('tr');
    tr.className = 'collapsedRow detalhe-aberto';
    tr.dataset.childId = d.id;
    tr.innerHTML = `
      <td colspan="${row.cells.length}" class="p-0 bottom-1 top-0">
        <div class="collapse show collapsedRow_div">

          <div class="p-2 me-3 collapsedRow_content text-end">
            <p class="py-2 fw-bold">Direção origem</p>
            <i class="fa-solid ${ICONES_ORIGEM[d.originDir] || ''} fa-2x"></i>
            <p class="py-2">Terminal origem: ${esc(d.originTerm)}</p>
          </div>

          <div class="d-flex flex-column align-items-center collapsedRow_content">
            <div class="d-flex w-100 h-100 justify-content-between align-items-center">
              <div class="d-flex w-100 h-75 p-1 align-items-center">
                <div class="cable-start m-auto ${semTerminal ? 'copper-cable' : 'terminal-start'}"></div>
                <div class="cable-body m-auto ${corCabo}">
                  ${numero}
                  <p style="background:#fff; color:#000; padding:2px">Comprimento: ${esc(d.length)}m</p>
                  ${numero}
                </div>
                <div class="cable-start m-auto ${semTerminal ? 'copper-cable' : 'terminal-end'}"></div>
              </div>
            </div>
          </div>

          <div class="p-2 ms-3 collapsedRow_content text-start">
            <p class="py-2 fw-bold">Direção destino</p>
            <i class="fa-solid ${ICONES_DESTINO[d.targetDir] || ''} fa-2x"></i>
            <p class="py-2">Terminal destino: ${esc(d.targetTerm)}</p>
          </div>

        </div>
      </td>`;
    return tr;
  }

  tbody.addEventListener('click', (e) => {
    // Clique no botão de status não abre/fecha o detalhe
    if (e.target.closest('.cable-done-button')) return;

    const row = e.target.closest('.cabo-row');
    if (!row) return;

    const jaAberta = row.nextElementSibling?.classList.contains('detalhe-aberto');
    fechaDetalhes();          // mantém só um detalhe aberto por vez
    if (jaAberta) return;     // segundo clique = fecha

    row.after(montaDetalhe(row));
  });

  // Se o filtro de chicote ou a busca esconderem linhas, feche o detalhe para
  // não ficar uma linha de detalhe "solta". Chame window.fechaDetalhesCabo()
  // no final dos seus handlers de filtro/busca.
  window.fechaDetalhesCabo = fechaDetalhes;
})();