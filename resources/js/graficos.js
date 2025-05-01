//const mesAtual = document.getElementById('mesAtual');
//const proximoMes = document.getElementById('proximoMes');

const graficoMesAtual = document.getElementById('graficoMesAtual');
const despesaAtual = graficoMesAtual.getAttribute('data-despesa');
const restanteAtual = Math.max(0, parseFloat(graficoMesAtual.getAttribute('data-restante')));

const graficoProximoMes = document.getElementById('graficoProximoMes');
const valorDespesaProximoMes = graficoProximoMes.getAttribute('data-despesa');
const restanteProximoMes = Math.max(0, parseFloat(graficoProximoMes.getAttribute('data-restante')));

const graficoTotaisDespesasAtual = document.getElementById('graficoTotaisDespesasAtual');
const descricoesAtual = JSON.parse(graficoTotaisDespesasAtual.getAttribute('data-descricoes'));
const valoresAtual = JSON.parse(graficoTotaisDespesasAtual.getAttribute('data-valorestotais'));

const graficoTotaisProximoMes  = document.getElementById('graficoDespesasProximoMes');
const descricoesProximoMes = JSON.parse(graficoTotaisProximoMes.getAttribute('data-descricoes'));
const valoresProximoMes = JSON.parse(graficoTotaisProximoMes.getAttribute('data-valorestotais'));

console.log(graficoTotaisProximoMes);
console.log(descricoesProximoMes);
console.log(valoresProximoMes);

new Chart(mesAtual, {
    type: 'pie',
        data: {
            labels: ['Despesa', 'Restante'],
            datasets: [{
                label: 'Mês Atual',
                data: [despesaAtual, restanteAtual],
                backgroundColor: [ // cores de preenchimento de cada fatia
                    'rgba(100, 0, 0, 1)',   // vermelho
                    'rgba(0, 100, 0, 1)',   // verde
                ],
                borderWidth: 1
            }]
        }
});

new Chart(proximoMes, {
    type: 'pie',
        data: {
            labels: ['Despesa', 'Restante'],
            datasets: [{
                label: 'Próximo Mês',
                data: [valorDespesaProximoMes, restanteProximoMes],
                backgroundColor: [ // cores de preenchimento de cada fatia
                    'rgba(100, 0, 0, 1)',   // vermelho
                    'rgba(0, 100, 0, 1)',   // verde
                ],
                borderWidth: 1
            }]
        }
});

new Chart(despesaMesAtual, {
    type: 'pie',
        data: {
            labels: descricoesAtual,
            datasets: [{
                label: 'Despesa Mês Atual',
                data: valoresAtual,
                borderWidth: 1
            }]
        }
});

new Chart(despesaProximoMes, {
    type: 'pie',
        data: {
            labels: descricoesProximoMes,
            datasets: [{
                label: 'Despesa Mês Atual',
                data: valoresProximoMes,
                borderWidth: 1
            }]
        }
});