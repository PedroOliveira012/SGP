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
            break
    }
}

function limpar_input(){
    document.getElementById('id_projeto').value = ''
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
    sim = document.getElementById('sim')
    nao = document.getElementById('nao')
    paineis = document.getElementById('paineis')

    if (sim.checked) {
        prazo.hidden = false
    }else{
        prazo.hidden = true
    }
}

function Teste(){
    var espera = document.getElementById('espera')
    var barra = document.getElementById('barra')
    if (espera.checked){
        barra.value = 1
    }

}

function Relembrar(){
    var espera = document.getElementById('espera')
    var barra = document.getElementById('barra')
    if (barra.value >= 1){
        espera.checked
    }
}

function atualizarProgresso() {
    const espera = document.getElementById('espera').checked;
    const andamento = document.getElementById('andamento').checked;
    const analise = document.getElementById('analise').checked;
    const revisao = document.getElementById('revisao').checked;
    const aprovacao = document.getElementById('aprovacao').checked;
    const compras = document.getElementById('compras').checked;

    let barra = 0;

    if (barra == 0){
        document.getElementById('espera').disabled = false;
        document.getElementById('andamento').disabled = true;
        document.getElementById('analise').disabled = true;
        document.getElementById('revisao').disabled = true;
        document.getElementById('aprovacao').disabled = true;
        document.getElementById('compras').disabled = true;
    }

    if (espera){
        barra = 1
        document.getElementById('espera').disabled = false;
        document.getElementById('andamento').disabled = false;
        document.getElementById('analise').disabled = true;
        document.getElementById('revisao').disabled = true;
        document.getElementById('aprovacao').disabled = true;
        document.getElementById('compras').disabled = true;
    }

    if (andamento){
        barra = 2;
        document.getElementById('espera').disabled = false;
        document.getElementById('andamento').disabled = false;
        document.getElementById('analise').disabled = false;
        document.getElementById('revisao').disabled = true;
        document.getElementById('aprovacao').disabled = true;
        document.getElementById('compras').disabled = true;
    }

    if (analise){
        barra = 3;
        document.getElementById('espera').disabled = false;
        document.getElementById('andamento').disabled = false;
        document.getElementById('analise').disabled = false;
        document.getElementById('revisao').disabled = false;
        document.getElementById('aprovacao').disabled = true;
        document.getElementById('compras').disabled = true;
    }

    if (revisao){
        barra = 4;
        document.getElementById('espera').disabled = false;
        document.getElementById('andamento').disabled = false;
        document.getElementById('analise').disabled = false;
        document.getElementById('revisao').disabled = false;
        document.getElementById('aprovacao').disabled = false;
        document.getElementById('compras').disabled = true;
    }

    if (aprovacao){
        barra = 5;
        document.getElementById('espera').disabled = false;
        document.getElementById('andamento').disabled = false;
        document.getElementById('analise').disabled = false;
        document.getElementById('revisao').disabled = false;
        document.getElementById('aprovacao').disabled = false;
        document.getElementById('compras').disabled = false;
    }

    if (compras){
        barra = 6;
    }

    document.getElementById('barra').value = barra;

  // Associar a função de atualização a cada vez que uma caixa de seleção é clicada
  document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener('click', atualizarProgresso);
  });
}

