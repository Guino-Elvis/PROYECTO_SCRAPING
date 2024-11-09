<div>
    <div style="max-width: 700px; height: auto">
        <canvas id="lineasGrafica"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('lineasGrafica').getContext('2d');

        var data = {
            labels: {!! json_encode($meses) !!}, // Etiquetas para los meses
            datasets: [{
                label: 'Ofertas Laborales por Mes',
                data: {!! json_encode($ofertasPorMes) !!}, // Datos de ofertas por mes
                borderColor: '#048BD0', // Color de la línea
                backgroundColor: 'rgba(4, 139, 208, 0.2)', // Color de fondo bajo la línea
                borderWidth: 2, // Ancho de la línea
                fill: true, // Rellenar el área bajo la línea
                pointBackgroundColor: '#048BD0', // Color de los puntos de datos
                pointBorderColor: '#ffffff', // Color del borde de los puntos
                pointBorderWidth: 2, // Ancho del borde de los puntos
                pointRadius: 5, // Radio de los puntos
                pointHoverRadius: 7 // Radio de los puntos al pasar el ratón
            }]
        };

        var myLineChart = new Chart(ctx, {
            type: 'line', // Tipo de gráfico
            data: data,
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Meses'
                        },
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 12
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Ofertas'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
</div>
