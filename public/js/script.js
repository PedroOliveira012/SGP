function escolher_tipo(){
    var escolha = document.getElementById('tipo')
    if (escolha.value == 'Armário'){
        teto.disabled = false
        teto.hidden = false
        flange.disabled = true
        flange.hidden = true
        // console.log(escolha.value)
    }
    else if (escolha.value == 'Quadro'){
        flange.disabled = false
        flange.hidden = false
        teto.disabled = true
        teto.hidden = true
        // console.log(escolha.value)
    }
    else{
        flange.disabled = true
        flange.hidden = true
        teto.disabled = true
        teto.hidden = true
    }

    var proximo_campo = document.getElementById('area')
    proximo_campo.disabled = false
}

function escolher_area(){
    var processo = document.getElementById('processo')
    processo.disabled = false

    var valor_area = document.getElementById('area')

    var pre = document.getElementById('Pre')
    var inicio = document.getElementById('Inicio')
    var final = document.getElementById('Final')
    var placa = document.getElementById('Placa')
    var flange = document.getElementById('flange')
    var teto = document.getElementById('teto')
    var porta = document.getElementById('Porta')
    var escolha = document.getElementById('tipo')
    var fabricacao = document.getElementById('Fabricacao')
    var instalacao = document.getElementById('Instalacao')
    var pendencia = document.getElementById('Pendencia')
    var teste = document.getElementById('Teste')


    switch(valor_area.value){

        case "Estrutura":
            pre.disabled = true
            pre.hidden = true
            inicio.hidden = false
            inicio.disabled = false
            final.hidden = false
            final.disabled = false
            placa.hidden = true
            placa.disabled = true
            porta.hidden = true
            porta.disabled = true
            teto.disabled = true
            teto.hidden = true
            flange.disabled = true
            flange.hidden = true
            fabricacao.hidden = true
            fabricacao.disabled = true
            instalacao.hidden = true
            instalacao.disabled = true
            pendencia.hidden = true
            pendencia.disabled = true
            teste.hidden = true
            teste.disabled = true
            break

        case "Oficina":
            pre.disabled = true
            pre.hidden = true
            inicio.hidden = true
            inicio.disabled = true
            final.hidden = true
            final.disabled = true
            placa.hidden = false
            placa.disabled = false
            porta.hidden = false
            porta.disabled = false
            fabricacao.hidden = true
            fabricacao.disabled = true
            instalacao.hidden = true
            instalacao.disabled = true
            pendencia.hidden = true
            pendencia.disabled = true
            teste.hidden = true
            teste.disabled = true
            break

        case "Produção":
            pre.disabled = true
            pre.hidden = true
            inicio.hidden = true
            inicio.disabled = true
            final.hidden = true
            final.disabled = true
            placa.hidden = true
            placa.disabled = true
            porta.hidden = true
            porta.disabled = true
            teto.disabled = true
            teto.hidden = true
            flange.disabled = true
            flange.hidden = true
            fabricacao.hidden = false
            fabricacao.disabled = false
            instalacao.hidden = false
            instalacao.disabled = false
            pendencia.hidden = false
            pendencia.disabled = false
            teste.hidden = false
            teste.disabled = false
            break

        case "Almoxarifado":
            pre.disabled = false
            pre.hidden = false
            inicio.hidden = true
            inicio.disabled = true
            final.hidden = true
            final.disabled = true
            placa.hidden = true
            placa.disabled = true
            porta.hidden = true
            porta.disabled = true
            teto.disabled = true
            teto.hidden = true
            flange.disabled = true
            flange.hidden = true
            fabricacao.hidden = true
            fabricacao.disabled = true
            instalacao.hidden = true
            instalacao.disabled = true
            pendencia.hidden = true
            pendencia.disabled = true
            teste.hidden = true
            teste.disabled = true
            break
    }
}

function limpar_input_tarefa(){
    document.getElementById('id_projeto').value = ''
}

function limpar_div(){
    let div = document.getElementById('tarefas')
    div.innerText = ""
}

function Habilita_paineis(){
    sim = document.getElementById('sim')
    nao = document.getElementById('nao')
    paineis = document.getElementById('paineis')

    if (sim.checked) {
        paineis.hidden = false
    }else{
        paineis.hidden = true
    }
}

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

function Habilita_prazo_pendencia(){
    sim = document.getElementById('sim')
    nao = document.getElementById('nao')
    paineis = document.getElementById('paineis')

    if (sim.checked) {
        prazo.hidden = false
    }else{
        prazo.hidden = true
    }
}
