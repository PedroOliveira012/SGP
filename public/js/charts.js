const { data } = require("alpinejs");


fetch('http://localhost/SGP/public/dados-grafico')
    .then(response => response.json())
    .then(data => {
        let paineisVendidos = data.projeto.fechamento
        let paineisEntregues = data.projeto.entregue
        let meses = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];
        
        console.log(data);
        console.log(data.projeto.entregue);

        renderChartProjetos(paineisEntregues, paineisVendidos, meses);
        
    }

)



async function visualizarProjeto(id) {
    const response = await fetch(`http://localhost/SGP/public/dados-projeto/${id}`);
    const data = await response.json();

    atualizarInformacoes(data);
    // renderChartTarefas(data.tarefas_andamento, data.tarefas_concluidas);
    renderChartPainel(data.labels, data.series);
}

window.Apex = {
    chart: { 
        heigth: 445,
        width: '725',
    },
    
    dataLabels:{
        enabled: false
    }
}

function renderChartProjetos(entregue, vendido, meses){
    var options = {
    chart: {
        type: 'area',
    },
    dataLabel:{
        enabled: false
    },
    title:{
        text: 'Projetos Vendidos por mes',
        align: 'center'
    },
    stroke:{
        lineCap:'round'
    },
    theme:{
        mode:'dark'
    },
    fill:{
        colors: ['#00aac0', 'red'],
    },
    series: [{
        name: 'vendido',
        data: vendido
    },{
        name: 'entregue',
        data: entregue
    }],
    xaxis: {
        categories: meses
    }
    }
    var chart = new ApexCharts(document.querySelector("#dashboard_chart"), options);

    chart.render();
}

var chartPainel = null;

function renderChartPainel(labels, series){

    const container = document.querySelector("#projects-tasks-chart");

    const options = {
        series: series,
        chart: {
            type: 'pie',
            background: '#212529',
        },
        labels: labels,
        theme: {
            mode: 'dark'
        }
    };

    console.log(labels);
    console.log(series);

    if (chartPainel) {
        chartPainel.destroy();
    }

    chartPainel = new ApexCharts(container, options);
    chartPainel.render();
}


function atualizarInformacoes(data) {
    document.querySelector('#num_projeto').innerText = data.projeto.num_projeto;
    document.querySelector('#nome_projeto').innerText = data.projeto.nome_projeto;
    document.querySelector('#cliente').innerText = data.projeto.cliente;
    document.querySelector('#unidade').innerText = data.projeto.unidade;
    document.querySelector('#data_fechamento').innerText = formatarData(data.projeto.data_fechamento);
    document.querySelector('#data_entrega').innerText = formatarData(data.projeto.data_entrega);
    document.querySelector('#status_entrega').innerText = data.status_entrega + ' dias';
    document.querySelector('#feitos').innerText = data.feitos;
    document.querySelector('#total').innerText = data.total;
    
    const progressBar = document.querySelector('.progress-bar');
    
    progressBar.style.width = data.progresso + '%';
    progressBar.setAttribute('aria-valuenow', data.feitos);
    progressBar.setAttribute('aria-valuemax', data.total);
}

function formatarData(data) {
    const d = new Date(data);

    const dia = String(d.getDate()).padStart(2, '0');
    const mes = String(d.getMonth() + 1).padStart(2, '0');
    const ano = d.getFullYear();

    return `${dia}/${mes}/${ano}`;
}



function renderChartTarefas(andamento, concluido){
    
    var options = {
        series: [andamento, concluido],
        chart: {
            width: 380,
            type: 'pie',
            background: '#212529',
        },
        theme:{
            mode:'dark'
        },
        fill:{
            colors: ['#00aac0', 'red'],
        },
        labels: ['Em andamento', 'Finalizadas'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#projects-tasks-chart"), options);
    chart.render();
}
