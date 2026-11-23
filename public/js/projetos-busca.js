/* =====================================================================
   projetos-busca.js — pesquisa/filtro de projetos (dashboard e listas de projetos).
   Depende de: jQuery.
   ===================================================================== */

let currentText = null;

// Filtra os projetos (accordion) da dashboard pelo id
function applyProjectFilter() {
    $('.project-data .projects-list .projects-list-item').each(function () {
        const project = $(this);
        const projectID = project.attr('id');
        if (!projectID) return;

        // Mostra se o id do projeto contém o texto digitado
        project.toggle(projectID.includes(currentText));
    });
}

$('#dashboard-search').on('input', function () {
    currentText = $(this).val();
    applyProjectFilter();
});

// Pesquisa em qualquer tabela de projetos (linhas com id)
function searchProject() {
    $('div table tbody tr').each(function () {
        const project = $(this);
        const projectID = project.attr('id');

        // Linhas sem id (ex.: tabela de cabos) não são projetos: ignora
        if (!projectID) return;

        project.toggle(projectID.includes(currentText));
    });
}

$('#search').on('input', function () {
    currentText = $(this).val();
    searchProject();
});
