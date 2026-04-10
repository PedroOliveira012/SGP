fetch('http://localhost/SGP/public/dados-grafico')
  .then(response => response.json())
  .then(data => {
        let paineisVendidos = data.fechamento
        let paineisEntregues = data.entregue
        let meses = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];
        
        console.log(data);
        console.log(data.entregue);

        renderChartProjetos(paineisEntregues, paineisVendidos, meses);
    }
)

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

function renderChartTarefas(){
    var options = {
        series: [44, 55],
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
renderChartTarefas()
