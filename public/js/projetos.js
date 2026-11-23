// let currentText = null

// Filtra os projetos na dashboard
function applyProjectFilter() {
    //itera sobre todos os accordion
    $('.project-data .projects-list .projects-list-item').each(function() {
        const project = $(this);
        const projectID = project.attr('id');
        
        let shouldShow = true;

        //verifica se o id do projeto contém o texto digitado
        if (projectID.includes(currentText)) {
            shouldShow = true;
        } else {
            shouldShow = false;
        }

        //exibe ou esconde o projeto com base na verificação
        if (shouldShow) {
            project.show();
        } else {
            project.hide();
        }
    });
}

$('#dashboard-search').on('input', function() {
    currentText = $(this).val();
    applyProjectFilter();
});

// Pesquisar por projeto
function searchProject() {
    //itera sobre todos as linhas de qualquer tabela de projetos
     $('div table tbody tr').each(function() {
        const project = $(this);
        const projectID = project.attr('id');

        // Linhas sem id (ex.: tabela de cabos) não são projetos: ignora
        if (!projectID) return;
        
        let shouldShow = true;

        //verifica se o id do projeto contém o texto digitado
        if (projectID.includes(currentText)) {
            shouldShow = true;
        } else {
            shouldShow = false;
        }

        //exibe ou esconde o projeto com base na verificação
        if (shouldShow) {
            project.show();
        } else {
            project.hide();
        }

    });
}

$('#search').on('input', function() {
    currentText = $(this).val();
    console.log('Texto digitado:', currentText);
    searchProject();
});
