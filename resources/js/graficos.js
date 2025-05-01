const mesAtual = document.getElementById('mesAtual');

const graficoMesAtual = document.getElementById('graficoMesAtual');
const despesaAtual = graficoMesAtual.getAttribute('data-despesa');
const restanteAtual = graficoMesAtual.getAttribute('data-restante');

const graficoProximoMes = document.getElementById('graficoProximoMes');
const despesaProximoMes = graficoProximoMes.getAttribute('data-despesa');
const restanteProximoMes = graficoProximoMes.getAttribute('data-restante');

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
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
});



const proximoMes = document.getElementById('proximoMes');

new Chart(proximoMes, {
    type: 'pie',
        data: {
            labels: ['Despesa', 'Restante'],
            datasets: [{
                label: 'Próximo Mês',
                data: [despesaProximoMes, restanteProximoMes],
                backgroundColor: [ // cores de preenchimento de cada fatia
                    'rgba(100, 0, 0, 1)',   // vermelho
                    'rgba(0, 100, 0, 1)',   // verde
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
});
